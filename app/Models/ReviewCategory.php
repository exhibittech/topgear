<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCategory extends Model
{
    use HasFactory;

    protected $table = 'ReviewsCategory';

    public function reviews()
    {
        return $this->hasMany(Review::class, 'ReviewsCategoryID', 'ID');

    }
}
