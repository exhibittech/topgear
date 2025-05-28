<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voting_user_id');
            $table->string('cat1')->nullable();
            $table->string('cat2')->nullable();
            $table->string('cat3')->nullable();
            $table->string('cat4')->nullable();
            $table->string('cat5')->nullable();
            $table->string('cat6')->nullable();
            $table->string('cat7')->nullable();
            $table->string('cat8')->nullable();
            $table->string('cat9')->nullable();
            $table->string('cat10')->nullable();
            $table->string('cat11')->nullable();
            $table->string('cat12')->nullable();
            $table->string('cat13')->nullable();
            $table->string('cat14')->nullable();
            $table->string('cat15')->nullable();
            $table->string('cat16')->nullable();
            $table->string('cat17')->nullable();
            $table->string('cat18')->nullable();
            $table->string('cat19')->nullable();
            $table->foreign('voting_user_id')->references('id')->on('voting_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_votes');
    }
};
