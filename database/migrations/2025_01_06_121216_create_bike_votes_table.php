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
        Schema::create('bike_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voting_user_id');
            $table->string('bcat1')->nullable();
            $table->string('bcat2')->nullable();
            $table->string('bcat3')->nullable();
            $table->string('bcat4')->nullable();
            $table->string('bcat5')->nullable();
            $table->string('bcat6')->nullable();
            $table->string('bcat7')->nullable();
            $table->string('bcat8')->nullable();
            $table->string('bcat9')->nullable();
            $table->string('bcat10')->nullable();
            $table->foreign('voting_user_id')->references('id')->on('voting_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bike_votes');
    }
};
