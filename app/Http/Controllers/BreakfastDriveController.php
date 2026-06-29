<?php

namespace App\Http\Controllers;

use App\Mail\BreakfastDriveWelcomeMail;
use App\Models\BreakfastDriveMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;

class BreakfastDriveController extends Controller
{
    public function index()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'Breakfast Drive | TopGear India',
            'MetaDescription' => 'Join TopGear India\'s Breakfast Drive – 5th July 2026 at JW Marriott Sahar, Mumbai.',
            'Keyword' => 'Breakfast Drive, TopGear India, Car Enthusiasts, Mumbai Drive'
        ];

        $razorpayKey = env('RAZORPAY_KEY_ID');

        return view('breakfast-drive', compact('seodata', 'menu', 'razorpayKey'));
    }

    /**
     * Save user details to DB when they click "Proceed".
     * Returns the member ID for tracking.
     */
    public function saveDetails(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'mobile'        => 'required|string|digits:10',
            'email'         => 'required|email|max:255',
            'car_brand'     => 'required|string|max:255',
            'car_model'     => 'required|string|max:255',
            'car_number'    => 'required|string|min:9|max:10',
            'instagram_link'=> 'nullable|url|max:255',
        ]);

        $member = BreakfastDriveMember::create(array_merge($validated, [
            'payment_status' => 'pending',
        ]));

        Log::info('Breakfast Drive member saved', ['member_id' => $member->id, 'email' => $member->email]);

        return response()->json([
            'success'   => true,
            'member_id' => $member->id,
        ]);
    }

    /**
     * Create a Razorpay order and return the order ID.
     */
    public function createOrder(Request $request)
    {
        try {
            $memberId = $request->input('member_id');

            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            $order = $api->order->create([
                'receipt'         => 'breakfast_' . $memberId . '_' . time(),
                'amount'          => 150000, // ₹1,500 in paise
                'currency'        => 'INR',
                'payment_capture' => 1,
                'notes'           => [
                    'member_id' => $memberId,
                ],
            ]);

            if ($memberId) {
                BreakfastDriveMember::where('id', $memberId)->update([
                    'razorpay_order_id' => $order['id'],
                ]);
            }

            return response()->json([
                'order_id' => $order['id'],
                'amount'   => $order['amount'],
                'currency' => $order['currency'],
            ]);
        } catch (\Exception $e) {
            Log::error('Breakfast Drive Razorpay Create Order Error: ' . $e->getMessage());
            return response()->json(['error' => 'Could not create order.'], 500);
        }
    }

    /**
     * Verify Razorpay payment signature and update payment status.
     */
    public function verifyPayment(Request $request)
    {
        $input = $request->all();

        Log::info('Breakfast Drive Razorpay verifyPayment called', $input);

        $validated = $request->validate([
            'member_id'           => 'required|integer|exists:breakfast_drive_members,id',
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
        ]);

        try {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            $attributes = [
                'razorpay_order_id'   => $validated['razorpay_order_id'],
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature'  => $validated['razorpay_signature'],
            ];

            $api->utility->verifyPaymentSignature($attributes);

            BreakfastDriveMember::where('id', $validated['member_id'])->update([
                'payment_status'      => 'paid',
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature'  => $validated['razorpay_signature'],
                'paid_at'             => now(),
            ]);

            Log::info('Breakfast Drive payment verified & member updated', [
                'member_id'  => $validated['member_id'],
                'payment_id' => $validated['razorpay_payment_id'],
            ]);

            $this->sendWelcomeEmail($validated['member_id']);

        } catch (\Exception $e) {
            Log::error('Breakfast Drive Razorpay Signature Verification Failed: ' . $e->getMessage());

            BreakfastDriveMember::where('id', $validated['member_id'])->update([
                'payment_status' => 'failed',
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment verified successfully! Your spot for the Breakfast Drive is confirmed.',
        ]);
    }

    /**
     * Check payment status by querying Razorpay API directly.
     * Fallback for when handler callback or webhook doesn't work.
     */
    public function checkPaymentStatus(Request $request)
    {
        $memberId = $request->input('member_id');

        $member = BreakfastDriveMember::find($memberId);

        if (!$member) {
            return response()->json(['success' => false, 'message' => 'Member not found.'], 404);
        }

        if ($member->payment_status === 'paid') {
            return response()->json([
                'success' => true,
                'paid'    => true,
                'message' => 'Payment verified successfully! Your spot for the Breakfast Drive is confirmed.',
            ]);
        }

        if (!$member->razorpay_order_id) {
            return response()->json([
                'success' => true,
                'paid'    => false,
                'message' => 'No order found.',
            ]);
        }

        try {
            $api   = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $order = $api->order->fetch($member->razorpay_order_id);

            Log::info('Breakfast Drive Razorpay order status check', [
                'member_id' => $memberId,
                'order_id'  => $member->razorpay_order_id,
                'status'    => $order['status'],
            ]);

            if ($order['status'] === 'paid') {
                $payments  = $api->order->fetch($member->razorpay_order_id)->payments();
                $paymentId = null;
                if (!empty($payments['items'])) {
                    foreach ($payments['items'] as $payment) {
                        if ($payment['status'] === 'captured') {
                            $paymentId = $payment['id'];
                            break;
                        }
                    }
                }

                $member->update([
                    'payment_status'      => 'paid',
                    'razorpay_payment_id' => $paymentId,
                    'paid_at'             => now(),
                ]);

                Log::info('Breakfast Drive payment confirmed via API polling', [
                    'member_id'  => $memberId,
                    'payment_id' => $paymentId,
                ]);

                $this->sendWelcomeEmail($memberId);

                return response()->json([
                    'success' => true,
                    'paid'    => true,
                    'message' => 'Payment verified successfully! Your spot for the Breakfast Drive is confirmed.',
                ]);
            }

            return response()->json([
                'success' => true,
                'paid'    => false,
                'message' => 'Payment not yet captured. Status: ' . $order['status'],
            ]);

        } catch (\Exception $e) {
            Log::error('Breakfast Drive Razorpay order status check failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'paid'    => false,
                'message' => 'Could not check payment status.',
            ], 500);
        }
    }

    /**
     * Razorpay Webhook handler.
     */
    public function webhook(Request $request)
    {
        $payload   = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');
        $secret    = env('RAZORPAY_WEBHOOK_SECRET');

        if (!empty($secret)) {
            try {
                $expectedSignature = hash_hmac('sha256', $payload, $secret);

                if (!hash_equals($expectedSignature, $signature ?? '')) {
                    Log::warning('Breakfast Drive Razorpay webhook signature mismatch.');
                    return response()->json(['status' => 'invalid signature'], 400);
                }
            } catch (\Exception $e) {
                Log::error('Breakfast Drive Razorpay webhook signature error: ' . $e->getMessage());
                return response()->json(['status' => 'error'], 500);
            }
        } else {
            Log::warning('RAZORPAY_WEBHOOK_SECRET is not set — skipping signature verification.');
        }

        $data  = json_decode($payload, true);
        $event = $data['event'] ?? '';

        Log::info('Breakfast Drive Razorpay Webhook Received', ['event' => $event]);

        switch ($event) {
            case 'payment.authorized':
            case 'payment.captured':
                $payment = $data['payload']['payment']['entity'] ?? [];
                $orderId = $payment['order_id'] ?? null;

                if ($orderId) {
                    $member = BreakfastDriveMember::where('razorpay_order_id', $orderId)->first();
                    if ($member) {
                        $member->update([
                            'payment_status'      => 'paid',
                            'razorpay_payment_id' => $payment['id'] ?? null,
                            'paid_at'             => now(),
                        ]);
                        $this->sendWelcomeEmail($member->id);
                    }
                }

                Log::info('Breakfast Drive Payment ' . ($event === 'payment.captured' ? 'Captured' : 'Authorized') . ' via Webhook', [
                    'payment_id' => $payment['id'] ?? null,
                    'order_id'   => $orderId,
                ]);
                break;

            case 'payment.failed':
                $payment = $data['payload']['payment']['entity'] ?? [];
                $orderId = $payment['order_id'] ?? null;

                if ($orderId) {
                    BreakfastDriveMember::where('razorpay_order_id', $orderId)->update([
                        'payment_status' => 'failed',
                    ]);
                }

                Log::warning('Breakfast Drive Payment Failed via Webhook', [
                    'payment_id' => $payment['id'] ?? null,
                    'order_id'   => $orderId,
                ]);
                break;

            default:
                Log::info('Breakfast Drive Razorpay Webhook: unhandled event', ['event' => $event]);
                break;
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Send welcome email to a member after successful payment.
     * Guarded by welcome_email_sent flag to prevent duplicate emails.
     */
    private function sendWelcomeEmail(int $memberId): void
    {
        try {
            $updatedRows = BreakfastDriveMember::where('id', $memberId)
                ->where('welcome_email_sent', false)
                ->update(['welcome_email_sent' => true]);

            if ($updatedRows === 0) {
                Log::info('Breakfast Drive sendWelcomeEmail: email already sent, skipping', ['member_id' => $memberId]);
                return;
            }

            $member = BreakfastDriveMember::find($memberId);

            if (!$member) {
                Log::warning('Breakfast Drive sendWelcomeEmail: member not found', ['member_id' => $memberId]);
                return;
            }

            Mail::to($member->email)->send(new BreakfastDriveWelcomeMail($member));

            Log::info('Breakfast Drive welcome email sent', [
                'member_id' => $memberId,
                'email'     => $member->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send Breakfast Drive welcome email: ' . $e->getMessage(), [
                'member_id' => $memberId,
            ]);
        }
    }
}
