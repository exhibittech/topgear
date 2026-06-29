<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('breakfast_drive_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile', 15);
            $table->string('email');
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('car_number', 20);
            $table->string('instagram_link')->nullable();
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->boolean('welcome_email_sent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breakfast_drive_members');
    }
};
