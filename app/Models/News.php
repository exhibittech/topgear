<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'News';

    protected $primaryKey = 'NewsID';

    public $incrementing = true;

    public $timestamps = false;

    // Define custom timestamp column names
    const CREATED_AT = 'CreatedDateTime';

    const UPDATED_AT = 'ModifiedDateTime';

    protected $fillable = [
        'MenuID',
        'Name',
        'Code',
        'Description',
        'MetaTitle',
        'MetaDescription',
        'Keyword',
        'Author',
        'PublishDate',
        'IsActive',
        'Ip',
        'ImagePath',
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'ID', 'ID');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'MenuID', 'ID');
    }

    public function images()
    {
        return $this->hasMany(NewsImage::class, 'NewsID', 'NewsID')->orderBy('DisplayOrder', 'asc'); // Use correct foreign key and local key
    }
}
