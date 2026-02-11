<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    public function awards()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'BBC TopGear India Awards',
            'MetaDescription' => 'Check out the winners and highlights of the BBC TopGear India Awards.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, Auto Awards',
        ];

        return view('awards.index', compact('seodata', 'menu'));
    }

    public function votingclosed()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026 Voting Closed',
            'MetaDescription' => 'Check out the winners and highlights of the TopGear Awards 2026.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, 2026 Awards',
        ];

        return view('awards.votingclosed', compact('seodata', 'menu'));
    }

    public function winners23()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2023 Winners',
            'MetaDescription' => 'Check out the winners and highlights of the TopGear Awards 2023.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, 2023 Awards',
        ];

        return view('awards.winners23', compact('seodata', 'menu'));
    }

    public function voting26()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026 | Cars',
            'MetaDescription' => 'Winners of TopGear Awards India will be announced in February 2026',
            'Keyword' => 'TopGear Awards 2026, Winners of TopGear Awards India',
        ];

        return view('awards.voting26', compact('seodata', 'menu'));
    }
    public function bikes26()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026 | Bikes',
            'MetaDescription' => 'Winners of TopGear Awards India will be announced in February 2026',
            'Keyword' => 'TopGear Awards 2026, Winners of TopGear Awards India',
        ];

        return view('awards.bikes26', compact('seodata', 'menu'));
    }

    public function winners24()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2024 Winners',
            'MetaDescription' => 'Check out the winners and highlights of the TopGear Awards 2024.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, 2024 Awards',
        ];

        return view('awards.winners24', compact('seodata', 'menu'));
    }

    public function winners25()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2025 Winners',
            'MetaDescription' => 'Check out the winners and highlights of the TopGear Awards 2025.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, 2025 Awards',
        ];

        return view('awards.winners25', compact('seodata', 'menu'));
    }

    public function winners26()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2026 Winners',
            'MetaDescription' => 'Check out the winners and highlights of the TopGear Awards 2026.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards, 2026 Awards',
        ];

        return view('awards.winners26', compact('seodata', 'menu'));
    }

    public function voting()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2025',
            'MetaDescription' => 'Vote for the TopGear Awards 2025.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards,Auto Awards 2025 Awards',
        ];

        return view('awards.voting', compact('seodata', 'menu'));
    }

    public function bikes()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2025 | Bikes',
            'MetaDescription' => 'Vote for Bikes in the TopGear Awards 2025.',
            'Keyword' => 'TopGear Awards,Car Awards, Bike Awards,Auto Awards 2025 Awards',
        ];

        return view('awards.bikes', compact('seodata', 'menu'));
    }

    public function signup()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear Awards 2025 Register',
            'MetaDescription' => 'Signup to vote for the TopGear Awards 2025.',
            'Keyword' => 'TopGear Awards, Car Awards, Bike Awards,Auto Awards 2025 Awards',
        ];

        return view('awards.signup', compact('seodata', 'menu'));
    }

    public function results()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'TopGear India Score',
            'MetaDescription' => 'TopGear India Ranking',
            'Keyword' => 'TopGear India Score',
        ];

        return view('awards.results', compact('seodata', 'menu'));
    }

    public function about()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'About Us | TopGear India ',
            'MetaDescription' => 'About BBC TopGear India ',
            'Keyword' => 'TopGear India, Automotive Magazine',
        ];

        return view('about', compact('seodata', 'menu'));
    }
    public function contact()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'Contact Us | TopGear India',
            'MetaDescription' => 'Contact BBC TopGear India',
            'Keyword' => 'TopGear India, Car and Bike Magazine',
        ];

        return view('contact', compact('seodata', 'menu'));
    }
    public function career()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'Work With Us | TopGear India ',
            'MetaDescription' => 'Work With  BBC TopGear India ',
            'Keyword' => 'Jobs in TopGear India, Automotive Magazine',
        ];

        return view('career', compact('seodata', 'menu'));
    }

    public function terms()
    {
        $menu = MenuController::loadMenu();

        $seodata = [
            'MetaTitle' => 'Terms & Conditions | TopGear India',
            'MetaDescription' => 'BBC TopGear India - Terms and Conditions',
            'Keyword' => 'TopGear India Policy, TopGear India Terms and Condiotions',
        ];

        return view('terms-conditions', compact('seodata', 'menu'));
    }

}
