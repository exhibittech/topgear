<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingUser;
use App\Models\CarVote;
use App\Models\BikeVote;
class VotingController extends Controller
{
    public function showsignup()
    {

        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026 Register',
            'MetaDescription' => 'awards.signup to vote for the TopGear Awards 2026.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards,Auto Awards 2026 Awards',
        ];

        return view('awards.signup', compact('seodata', 'menu'));

    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'device_fingerprint' => 'nullable|string|max:255',
        ]);

        // Get device information
        $deviceFingerprint = $request->input('device_fingerprint');
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');

        // Check if a user already exists with this email
        $existingUserByEmail = VotingUser::where('email', $validated['email'])->first();
        
        if ($existingUserByEmail) {
            // If the user already exists, just log them in
            session(['voting_user_id' => $existingUserByEmail->id]);
            return redirect()->route('awards.options');
        }

        // Check for existing registration from same device (fingerprint)
        if ($deviceFingerprint) {
            $existingUserByFingerprint = VotingUser::where('device_fingerprint', $deviceFingerprint)->first();
            
            if ($existingUserByFingerprint) {
                return redirect()->back()->with('error', 'A registration from this device already exists. Please login with your existing email: ' . $this->maskEmail($existingUserByFingerprint->email));
            }
        }

        // Check for excessive registrations from same IP (limit to 3 per IP to allow shared networks)
        $registrationsFromIp = VotingUser::where('ip_address', $ipAddress)->count();
        
        if ($registrationsFromIp >= 100) {
            return redirect()->back()->with('error', 'Maximum registration limit reached from this network. If you believe this is an error, please contact support.');
        }

        // Create new user with device tracking
        $user = VotingUser::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'device_fingerprint' => $deviceFingerprint,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        session(['voting_user_id' => $user->id]);

        return redirect()->route('awards.options');
    }

    /**
     * Mask email address for privacy (e.g., j***@example.com)
     */
    private function maskEmail(string $email): string
    {
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return '***';
        }
        
        $name = $parts[0];
        $domain = $parts[1];
        
        $maskedName = strlen($name) > 1 
            ? substr($name, 0, 1) . str_repeat('*', min(20, strlen($name) - 1)) 
            : '*';
            
        return $maskedName . '@' . $domain;
    }

    public function showOptions()
    {
        $userId = session('voting_user_id');
        if (!$userId) {
            return redirect()->route('signup');
        }
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026 - Choose Category',
            'MetaDescription' => 'Choose your category to vote for the TopGear Awards 2026.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, Auto Awards 2026',
        ];

        $carVote = CarVote::where('voting_user_id', $userId)->first();
        $bikeVote = BikeVote::where('voting_user_id', $userId)->first();

        return view('awards.options', compact('seodata', 'menu', 'carVote', 'bikeVote'));
    }

    public function showVoting()
    {
        $userId = session('voting_user_id');
        //     if (!$userId) {
        //       return redirect()->route('signup');
        // }
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026',
            'MetaDescription' => 'Vote for the TopGear Awards 2026.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards,Auto Awards 2026 Awards',
        ];

        $carVote = CarVote::where('voting_user_id', $userId)->first();
        $bikeVote = BikeVote::where('voting_user_id', $userId)->first();
        return view('awards.voting', compact('seodata', 'menu', 'carVote', 'bikeVote'));
    }

    public function storeCarVotes(Request $request)
    {
        $userId = session('voting_user_id');

        CarVote::updateOrCreate(
            ['voting_user_id' => $userId],
            $request->only(['cat1', 'cat2', 'cat3', 'cat4', 'cat5', 'cat6', 'cat7', 'cat8', 'cat9', 'cat10', 'cat11', 'cat12', 'cat13', 'cat14', 'cat15'])
        );

        return redirect()->route('awards.options')->with('success', 'Car votes submitted successfully!');
    }

    public function showBikes()
    {
        $userId = session('voting_user_id');
        if (!$userId) {
            return redirect()->route('signup');
        }
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2025',
            'MetaDescription' => 'Vote for the TopGear Awards 2025.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards,Auto Awards 2025 Awards',
        ];

        // Check if the user has already voted
        $carVote = CarVote::where('voting_user_id', $userId)->first();
        $bikeVote = BikeVote::where('voting_user_id', $userId)->first();
        return view('awards.bikes', compact('seodata', 'menu', 'carVote', 'bikeVote')); // Render bike voting form
    }

    public function storeBikeVotes(Request $request)
    {
        $userId = session('voting_user_id');

        if (!$userId) {
            return redirect()->route('signup')->with('error', 'Please sign up before voting.');
        }

        // Store bike votes
        BikeVote::updateOrCreate(
            ['voting_user_id' => $userId],
            $request->only(['bcat1', 'bcat2', 'bcat3', 'bcat4', 'bcat5', 'bcat6', 'bcat7', 'bcat8', 'bcat9', 'bcat10', 'bcat11', 'bcat12', 'bcat13', 'bcat14', 'bcat15', 'bcat16', 'bcat17', 'bcat18', 'bcat19', 'bcat20'])
        );

        // Redirect back to options page with success message
        return redirect()->route('awards.options')->with('success', 'Bike votes submitted successfully!');
    }



}
