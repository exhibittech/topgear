<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureCategory extends Model
{
    use HasFactory;

    protected $table = 'FeatureCategory';

    public function features()
    {
        return $this->hasMany(Feature::class, 'ID', 'ID');
    }
}
