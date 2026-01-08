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
        Schema::table('voting_users', function (Blueprint $table) {
            $table->string('device_fingerprint')->nullable()->after('email');
            $table->string('ip_address')->nullable()->after('device_fingerprint');
            $table->text('user_agent')->nullable()->after('ip_address');
            
            // Add indexes for faster lookups
            $table->index('device_fingerprint');
            $table->index('ip_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voting_users', function (Blueprint $table) {
            $table->dropIndex(['device_fingerprint']);
            $table->dropIndex(['ip_address']);
            $table->dropColumn(['device_fingerprint', 'ip_address', 'user_agent']);
        });
    }
};
