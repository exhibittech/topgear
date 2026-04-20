<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('redline', compact('seodata', 'menu'));
    }

    public function store(Request $request)
    {
        // Validate the form data
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

        // Here you can save the data to your database
        // For now, we'll just return a success message
        // Example: RedlineMember::create($validated);

        return redirect()->back()->with('success', 'Thank you for joining the Redline Club! We will get back to you soon.');
    }
}