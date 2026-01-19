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

        // Check for existing registrations from same device (fingerprint) - allow up to 3 per device
        if ($deviceFingerprint) {
            $registrationsFromDevice = VotingUser::where('device_fingerprint', $deviceFingerprint)->count();
            
            if ($registrationsFromDevice >= 10) {
                return redirect()->back()->with('error', 'Maximum registration limit (5 accounts) reached from this device. Please login with one of your existing emails.');
            }
        }

        // Check for excessive registrations from same IP (limit to 3 per IP to allow shared networks)
        $registrationsFromIp = VotingUser::where('ip_address', $ipAddress)->count();
        
        if ($registrationsFromIp >= 600) {
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



    public function showResults()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026 - Results',
            'MetaDescription' => 'View the TopGear Awards 2026 voting results.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, Auto Awards 2026 Results',
        ];

        // Define car categories with their names and image folder
        $carCategories = [
            'cat1' => ['name' => 'Car of the Year', 'folder' => 'cars'],
            'cat2' => ['name' => 'Sedan of the Year', 'folder' => 'cars'],
            'cat3' => ['name' => 'Compact SUV of the Year', 'folder' => 'cars'],
            'cat4' => ['name' => 'Sub-Compact SUV of the Year', 'folder' => 'cars'],
            'cat5' => ['name' => 'Mid-Size SUV of the Year', 'folder' => 'cars'],
            'cat6' => ['name' => 'MPV of the Year', 'folder' => 'cars'],
            'cat7' => ['name' => 'Performance Car of the Year', 'folder' => 'cars'],
            'cat8' => ['name' => 'Sports Car of the Year', 'folder' => 'cars'],
            'cat9' => ['name' => 'Supercar of the Year', 'folder' => 'cars'],
            'cat10' => ['name' => 'EV of the Year', 'folder' => 'cars'],
            'cat11' => ['name' => 'EV SUV of the Year', 'folder' => 'cars'],
            'cat12' => ['name' => 'Luxury Mid-Size SUV of the Year', 'folder' => 'cars'],
            'cat13' => ['name' => 'Luxury/Performance SUV of the Year', 'folder' => 'cars'],
            'cat14' => ['name' => 'Luxury Car of the Year', 'folder' => 'cars'],
            'cat15' => ['name' => 'SUV of the Year', 'folder' => 'cars'],
        ];

        // Define bike categories with their names and image folder
        $bikeCategories = [
            'bcat1' => ['name' => 'Motorcycle of the Year', 'folder' => 'bikes'],
            'bcat2' => ['name' => 'Scooter of the Year', 'folder' => 'bikes'],
            'bcat3' => ['name' => 'EV Two-Wheeler of the Year', 'folder' => 'bikes'],
            'bcat4' => ['name' => 'Entry-level Motorcycle of the Year (under 150cc)', 'folder' => 'bikes'],
            'bcat5' => ['name' => 'Motorcycle of the Year (under 200cc or equivalent EV)', 'folder' => 'bikes'],
            'bcat6' => ['name' => 'Entry-level Performance Motorcycle of the Year', 'folder' => 'bikes'],
            'bcat7' => ['name' => 'Adventure Motorcycle of the Year', 'folder' => 'bikes'],
            'bcat8' => ['name' => 'Performance Motorcycle of the Year (under 1000cc)', 'folder' => 'bikes'],
            'bcat9' => ['name' => 'Performance Motorcycle of the Year (over 1000cc)', 'folder' => 'bikes'],
            'bcat10' => ['name' => 'Premium Motorcycle of the Year', 'folder' => 'bikes'],
        ];

        // Calculate car results
        $carResults = [];
        foreach ($carCategories as $catKey => $catInfo) {
            $votes = CarVote::select($catKey)
                ->whereNotNull($catKey)
                ->where($catKey, '!=', '')
                ->get()
                ->groupBy($catKey)
                ->map(function ($items) {
                    return $items->count();
                });

            $totalVotes = $votes->sum();
            $results = [];

            foreach ($votes as $nominationName => $voteCount) {
                if (!empty($nominationName)) {
                    $percentage = $totalVotes > 0 ? round(($voteCount / $totalVotes) * 100, 1) : 0;
                    // Generate image filename from nomination name
                    $imageName = str_replace(' ', '-', $nominationName) . '.jpg';
                    // Handle special filenames
                    $imageName = str_replace(['Victoris'], ['Victoris.jpeg'], $imageName);
                    $imageName = str_replace('.jpeg.jpg', '.jpeg', $imageName);
                    
                    $results[] = [
                        'name' => $nominationName,
                        'percentage' => $percentage,
                        'image' => 'uploads/awards26/' . $catInfo['folder'] . '/' . $imageName,
                    ];
                }
            }

            // Sort by percentage descending
            usort($results, function ($a, $b) {
                return $b['percentage'] <=> $a['percentage'];
            });

            $carResults[$catKey] = [
                'name' => $catInfo['name'],
                'nominations' => $results,
                'totalVotes' => $totalVotes,
            ];
        }

        // Calculate bike results
        $bikeResults = [];
        foreach ($bikeCategories as $catKey => $catInfo) {
            $votes = BikeVote::select($catKey)
                ->whereNotNull($catKey)
                ->where($catKey, '!=', '')
                ->get()
                ->groupBy($catKey)
                ->map(function ($items) {
                    return $items->count();
                });

            $totalVotes = $votes->sum();
            $results = [];

            foreach ($votes as $nominationName => $voteCount) {
                if (!empty($nominationName)) {
                    $percentage = $totalVotes > 0 ? round(($voteCount / $totalVotes) * 100, 1) : 0;
                    // Generate image filename from nomination name
                    $imageName = str_replace(' ', '-', $nominationName) . '.jpg';
                    
                    $results[] = [
                        'name' => $nominationName,
                        'percentage' => $percentage,
                        'image' => 'uploads/awards26/' . $catInfo['folder'] . '/' . $imageName,
                    ];
                }
            }

            // Sort by percentage descending
            usort($results, function ($a, $b) {
                return $b['percentage'] <=> $a['percentage'];
            });

            $bikeResults[$catKey] = [
                'name' => $catInfo['name'],
                'nominations' => $results,
                'totalVotes' => $totalVotes,
            ];
        }

        return view('admin.voting-results', compact('seodata', 'menu', 'carResults', 'bikeResults'));
    }
}
