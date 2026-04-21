<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedlineMember extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'car_brand',
        'car_model',
        'car_number',
        'instagram_link',
        'linkedin_link',
        'tshirt_size',
        'payment_status',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];
}
