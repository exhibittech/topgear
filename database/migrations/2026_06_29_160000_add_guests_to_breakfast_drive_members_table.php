<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('breakfast_drive_members', function (Blueprint $table) {
            $table->unsignedTinyInteger('guests_count')->default(0)->after('instagram_link'); // 0, 1, or 2
            $table->json('guests')->nullable()->after('guests_count'); // [{name, mobile}, ...]
            $table->unsignedInteger('amount_paise')->default(150000)->after('guests'); // total in paise
        });
    }

    public function down(): void
    {
        Schema::table('breakfast_drive_members', function (Blueprint $table) {
            $table->dropColumn(['guests_count', 'guests', 'amount_paise']);
        });
    }
};
