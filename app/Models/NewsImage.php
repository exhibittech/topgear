<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'NewsImage';

    public $timestamps = false;

    protected $primaryKey = 'NewsImageID';

    protected $fillable = ['NewsID', 'ImagePath'];

    public function news()
    {
        return $this->belongsTo(News::class, 'NewsID', 'NewsID'); // Ensure correct foreign key and local key
    }
}
