<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    use HasFactory;

    protected $table = 'ReviewsImage';
    protected $primaryKey = 'ReviewsImageID';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['ReviewsID', 'ImagePath', 'ImageName', 'Title', 'DisplayOrder'];
}
