<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Support\Facades\DB;

class EditorialController extends Controller
{
    public function list()
    {
        $menu = MenuController::loadMenu();
        $editorialList = Editorial::where('IsDeleted', 0)
            ->where('IsActive', 1)
            ->orderBy('PublishDate', 'DESC')
            ->paginate(9);

        $seodata = [
            'MetaTitle' => 'Latest Editorials | BBC Topgear India Magazine',
            'MetaDescription' => 'TopGear India brings you the latest editorials on cars & bikes. Stay updated with expert opinions and in-depth articles.',
            'Keyword' => 'editorials, topgear india, car reviews, bike reviews, automotive industry, expert opinions, latest editorials',
        ];

        return view('editorial.list', compact('editorialList', 'menu', 'seodata'));
    }

    public function details($code)
    {
        $menu = MenuController::loadMenu();

        $record = Editorial::where('Code', $code)->firstOrFail();

        $increment = rand(1, 15);
        DB::table('Editorial')
            ->where('EditorialID', $record->EditorialID)  // Adjusted primary key column
            ->increment('views', $increment);

        $breadcrumbs = [
            (object) ['title' => 'Editorial', 'link' => '', 'separetor' => '/'],
            (object) ['title' => $record->Name, 'link' => '#', 'separetor' => ''],
        ];

        $relatedArticles = Editorial::where('EditorialID', '!=', $record->EditorialID)  // Adjusted primary key column
            ->where('IsDeleted', 0)
            ->orderBy('PublishDate', 'DESC')
            ->take(3)
            ->get();

        $seodata = [
            'MetaTitle' => $record->MetaTitle ?? 'Latest Editorials | BBC Topgear India Magazine',
            'MetaDescription' => $record->MetaDescription ?? 'TopGear India brings you the latest editorials on cars & bikes. Stay updated with expert opinions and in-depth articles.',
            'Keyword' => $record->Keyword ?? 'editorials, topgear india, car reviews, bike reviews, automotive industry, expert opinions, latest editorials',
        ];

        return view('editorial.details', compact('record', 'breadcrumbs', 'relatedArticles', 'seodata', 'menu'));
    }
}
