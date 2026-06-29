<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreakfastDriveMember extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'car_brand',
        'car_model',
        'car_number',
        'instagram_link',
        'guests_count',
        'guests',
        'amount_paise',
        'payment_status',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'paid_at',
        'welcome_email_sent',
    ];

    protected $casts = [
        'paid_at'      => 'datetime',
        'guests'       => 'array',
        'guests_count' => 'integer',
        'amount_paise' => 'integer',
    ];
}
