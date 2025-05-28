<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electric extends Model
{
    use HasFactory;

    protected $table = 'Electric';

    protected $primaryKey = 'ElectricID';

    public function images()
    {
        return $this->hasMany(ElectricImage::class, 'ElectricID', 'ElectricID');
    }
}
