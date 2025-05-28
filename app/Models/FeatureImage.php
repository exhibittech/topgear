<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureImage extends Model
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'FeaturesImage';

    protected $fillable = ['FeatureID', 'ImagePath', 'ImageName', 'Title', 'CreatedDateTime'];

    protected $primaryKey = 'FeaturesImageID';

    public $timestamps = false;

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'FeatureID', 'FeatureID');
    }
}
