<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $table = 'Editorial';

    protected $primaryKey = 'EditorialID';
    protected $keyType = 'int';
    public $incrementing = true;

    public $timestamps = false;

    // Define custom timestamp column names
    const CREATED_AT = 'CreatedDateTime';

    const UPDATED_AT = 'ModifiedDateTime';

    protected $fillable = [
        'Name',
        'Code',
        'Description', 'MetaTitle', 'MetaDescription', 'Keyword',
        'ImagePath',
        'PublishDate',  'IsActive', 'Ip',
        'views',
        'Author',
    ];
}
