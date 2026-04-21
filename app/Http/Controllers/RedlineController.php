<?php

namespace App\Http\Controllers;

use App\Models\RedlineMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class RedlineController extends Controller
{
    public function index()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'Redline Club | TopGear India',
            'MetaDescription' => 'Join the Redline Club',
            'Keyword' => 'Redline Club, TopGear India, Car Enthusiasts'
        ];

        $razorpayKey = env('RAZORPAY_KEY_ID');

        return view('redline', compact('seodata', 'menu', 'razorpayKey'));
    }

    /**
     * Save user details to DB when they click "Proceed".
     * Returns the member ID for tracking.
     */
    public function saveDetails(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'mobile'         => 'required|string|max:15',
            'email'          => 'required|email|max:255',
            'car_brand'      => 'required|string|max:255',
            'car_model'      => 'required|string|max:255',
            'car_number'     => 'required|string|max:20',
            'instagram_link' => 'nullable|url|max:255',
            'linkedin_link'  => 'nullable|url|max:255',
            'tshirt_size'    => 'required|string|in:XS,S,M,L,XL,XXL,XXXL',
        ]);

        $member = RedlineMember::create(array_merge($validated, [
            'payment_status' => 'pending',
        ]));

        Log::info('Redline member saved', ['member_id' => $member->id, 'email' => $member->email]);

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
                'receipt'         => 'redline_' . $memberId . '_' . time(),
                'amount'          => 100, // ₹1 in paise
                'currency'        => 'INR',
                'payment_capture' => 1,
                'notes'           => [
                    'member_id' => $memberId,
                ],
            ]);

            // Save the order ID against the member
            if ($memberId) {
                RedlineMember::where('id', $memberId)->update([
                    'razorpay_order_id' => $order['id'],
                ]);
            }

            return response()->json([
                'order_id' => $order['id'],
                'amount'   => $order['amount'],
                'currency' => $order['currency'],
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay Create Order Error: ' . $e->getMessage());
            return response()->json(['error' => 'Could not create order.'], 500);
        }
    }

    /**
     * Verify Razorpay payment signature and update payment status.
     */
    public function verifyPayment(Request $request)
    {
        $input = $request->all();

        Log::info('Razorpay verifyPayment called', $input);

        $validated = $request->validate([
            'member_id'               => 'required|integer|exists:redline_members,id',
            'razorpay_payment_id'     => 'required|string',
            'razorpay_order_id'       => 'required|string',
            'razorpay_signature'      => 'required|string',
        ]);

        // Verify the payment signature
        try {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            $attributes = [
                'razorpay_order_id'   => $validated['razorpay_order_id'],
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature'  => $validated['razorpay_signature'],
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Signature valid — update member as paid
            RedlineMember::where('id', $validated['member_id'])->update([
                'payment_status'      => 'paid',
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature'  => $validated['razorpay_signature'],
                'paid_at'             => now(),
            ]);

            Log::info('Razorpay payment verified & member updated', [
                'member_id'  => $validated['member_id'],
                'payment_id' => $validated['razorpay_payment_id'],
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay Signature Verification Failed: ' . $e->getMessage());

            // Mark as failed
            RedlineMember::where('id', $validated['member_id'])->update([
                'payment_status' => 'failed',
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment verified successfully! Welcome to the Redline Club.',
        ]);
    }

    /**
     * Razorpay Webhook handler.
     * URL: https://www.topgearmag.in/redline/webhook
     * Events: payment.captured, payment.failed
     */
    public function webhook(Request $request)
    {
        $payload   = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');
        $secret    = env('RAZORPAY_WEBHOOK_SECRET');

        // Verify webhook signature
        try {
            $expectedSignature = hash_hmac('sha256', $payload, $secret);

            if (!hash_equals($expectedSignature, $signature ?? '')) {
                Log::warning('Razorpay webhook signature mismatch.');
                return response()->json(['status' => 'invalid signature'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Razorpay webhook signature error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }

        $data  = json_decode($payload, true);
        $event = $data['event'] ?? '';

        Log::info('Razorpay Webhook Received', ['event' => $event]);

        switch ($event) {
            case 'payment.captured':
                $payment = $data['payload']['payment']['entity'] ?? [];
                $orderId = $payment['order_id'] ?? null;

                if ($orderId) {
                    RedlineMember::where('razorpay_order_id', $orderId)->update([
                        'payment_status'      => 'paid',
                        'razorpay_payment_id' => $payment['id'] ?? null,
                        'paid_at'             => now(),
                    ]);
                }

                Log::info('Razorpay Payment Captured via Webhook', [
                    'payment_id' => $payment['id'] ?? null,
                    'order_id'   => $orderId,
                ]);
                break;

            case 'payment.failed':
                $payment = $data['payload']['payment']['entity'] ?? [];
                $orderId = $payment['order_id'] ?? null;

                if ($orderId) {
                    RedlineMember::where('razorpay_order_id', $orderId)->update([
                        'payment_status' => 'failed',
                    ]);
                }

                Log::warning('Razorpay Payment Failed via Webhook', [
                    'payment_id' => $payment['id'] ?? null,
                    'order_id'   => $orderId,
                ]);
                break;

            default:
                Log::info('Razorpay Webhook: unhandled event', ['event' => $event]);
                break;
        }

        return response()->json(['status' => 'ok']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_number' => 'required|string|max:20',
            'instagram_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'tshirt_size' => 'required|string|in:XS,S,M,L,XL,XXL,XXXL',
        ]);

        return redirect()->back()->with('success', 'Thank you for joining the Redline Club! We will get back to you soon.');
    }
}