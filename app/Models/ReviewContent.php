<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewContent extends Model
{
    use HasFactory;

    protected $table = 'ReviewsContent';
    public $incrementing = true;
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = ['ReviewsID', 'TabID', 'Content'];
}
