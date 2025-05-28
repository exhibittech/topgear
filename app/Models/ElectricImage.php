<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricImage extends Model
{
    use HasFactory;

    protected $table = 'ElectricImage';

    protected $primaryKey = 'ElectricImageID';

    public function electric()
    {
        return $this->belongsTo(Electric::class, 'ElectricID', 'ElectricID');
    }
}
