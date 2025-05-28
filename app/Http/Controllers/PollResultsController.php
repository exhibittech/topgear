<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;  // Use DB facade for database queries

class PollResultsController extends Controller
{
    public function showResults()
    {
        // Category names mapping for cars
        $carCategories = [
            'cat1' => 'Hatchback of the Year',
            'cat2' => 'Sedan of the Year',
            'cat3' => 'Luxury Sedan of the year',
            'cat4' => 'Compact SUV of the year',
            'cat5' => 'SUV under 30 lakhs',
            'cat6' => 'Premium Mid-Size SUV of the year',
            'cat7' => 'Performance SUV of the year',
            'cat8' => 'Luxury SUV of the year',
            'cat9' => 'MPV of the Year',
            'cat10' => 'CNG Car of the Year',
            'cat11' => 'Enthusiasts Choice of the Year',
            'cat12' => 'Facelift of the Year',
            'cat13' => 'Lifestyle vehicle of the Year',
            'cat14' => 'Design of the Year',
            'cat15' => 'Electric Car of the Year',
            'cat16' => 'Premium EV of the Year',
            'cat17' => 'Luxury EV of the Year',
            'cat18' => 'Performance Car of the Year',
            'cat19' => 'Car of the Year',
        ];

        // Category names mapping for bikes
        $bikeCategories = [
            'bcat1' => 'Motorcycle of the Year',
            'bcat2' => 'Performance Motorcycle of the Year',
            'bcat3' => 'Electric Motorcycle of the Year',
            'bcat4' => 'Scooter of the Year',
            'bcat5' => 'Commuter of the Year',
            'bcat6' => 'Two-wheeler of the year up to 250cc',
            'bcat7' => 'Roadster of the Year Up To 500cc',
            'bcat8' => 'Two-wheeler of the year up to 400cc',
            'bcat9' => 'Two-wheeler of the year up to 700cc',
            'bcat10' => 'Premium Motorcycle of the Year',
        ];

        // Fetch the menu and SEO data (same as before)
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear India Score',
            'MetaDescription' => 'TopGear India Ranking',
            'Keyword' => 'TopGear India Score',
        ];

        // Fetch car votes data
        $carVoteCounts = [];
        foreach ($carCategories as $key => $name) {
            $carVoteCounts[$key] = DB::table('car_votes')
                ->select($key, DB::raw('COUNT(*) as vote_count'))
                ->groupBy($key)
                ->orderByDesc('vote_count')
                ->get();
        }
	//dd($carVoteCounts);
        // Fetch bike votes data
        $bikeVoteCounts = [];
        foreach ($bikeCategories as $key => $name) {
            $bikeVoteCounts[$key] = DB::table('bike_votes')
                ->select($key, DB::raw('COUNT(*) as vote_count'))
                ->groupBy($key)
                ->orderByDesc('vote_count')
                ->get();
        }

        // Pass both car and bike data to the view
        return view('awards.results', compact('carCategories', 'carVoteCounts', 'bikeCategories', 'bikeVoteCounts', 'seodata', 'menu'));
    }
}
