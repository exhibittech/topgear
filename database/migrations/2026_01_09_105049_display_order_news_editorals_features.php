<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('newsimage', function (Blueprint $table) {
            $table->integer('DisplayOrder')->nullable()->after('Title');
        });
        Schema::table('featuresimage', function (Blueprint $table) {
            $table->integer('DisplayOrder')->nullable()->after('Title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newsimage', function (Blueprint $table) {
            $table->dropColumn('DisplayOrder');
        });
        Schema::table('featuresimage', function (Blueprint $table) {
            $table->dropColumn('DisplayOrder');
        });
    }
};
