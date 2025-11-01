<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Review extends Model
{
    use HasFactory;

    protected $table = 'Reviews';

    protected $primaryKey = 'ReviewsID';

    protected $keyType = 'int';
    public $incrementing = true;

    public $timestamps = false;
    const CREATED_AT = 'CreatedDateTime';
    const UPDATED_AT = 'ModifiedDateTime';
    protected $fillable = [
        'AttributeGroupID', 'MenuID', 'MakeID', 'ModelID', 'VariantID',
        'ReviewsCategoryID', 'ReviewsTitle', 'Rating', 'PunchLine', 
        'GoodStuff', 'BadStuff', 'Code', 'ImagePath', 'ReviewsContent', 
        'MetaTitle', 'MetaDescription', 'Keyword', 'Author', 
        'PublishDate', 'IsActive', 'IsDeleted', 'IP', 'views'
    ];

    public function category()
    {
        return $this->belongsTo(ReviewCategory::class, 'ReviewsCategoryID', 'ID');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'MenuID', 'ID');
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class, 'ReviewsID', 'ReviewsID')->orderBy('DisplayOrder', 'asc');
    }

    public function content()
    {
        return $this->hasMany(ReviewContent::class, 'ReviewsID', 'ReviewsID');
    }
    protected $dates = ['ModifiedDateTime'];
    public static function boot()
{
    parent::boot();

    static::creating(function ($review) {
        $review->Code = Str::slug($review->ReviewsTitle);
        $review->CreatedDateTime = now();
        $review->ModifiedDateTime = now();  // Set current time during creation to avoid NULL error
    });

    static::updating(function ($review) {
        $review->ModifiedDateTime = now();  // Update ModifiedDateTime during updates
    });
}
}
