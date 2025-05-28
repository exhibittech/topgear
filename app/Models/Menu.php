<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'Menus';

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'ParentID', 'ID')
            ->where('IsActive', 1)
            ->where('IsDeleted', 0)
            ->orderBy('ID');
    }

    public function getDynamicSubmenusAttribute()
    {
        if ($this->ID == 3) {
            return DB::table('FeatureCategory')
                ->where('IsActive', 1)
                ->where('IsDeleted', 0)
                ->orderBy('ID')
                ->get();
        }

        return collect();
    }

    public function getReviewSubmenusAttribute()
    {
        if (in_array($this->ID, [9, 11])) {
            return DB::table('ReviewsCategory')
                ->where('IsActive', 1)
                ->where('IsDeleted', 0)
                ->where(function ($query) {
                    $query->where('MenuID', 'like', "%{$this->ID}%")
                        ->orWhere('MenuID', $this->ID);
                })
                ->orderBy('ID')
                ->get();
        }

        return collect();
    }
}
