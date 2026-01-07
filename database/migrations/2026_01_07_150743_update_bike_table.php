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
        Schema::table('bike_votes', function (Blueprint $table) {
            $table->string('bcat11')->nullable();
            $table->string('bcat12')->nullable();
            $table->string('bcat13')->nullable();
            $table->string('bcat14')->nullable();
            $table->string('bcat15')->nullable();
            $table->string('bcat16')->nullable();
            $table->string('bcat17')->nullable();
            $table->string('bcat18')->nullable();
            $table->string('bcat19')->nullable();
            $table->string('bcat20')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bike_votes', function (Blueprint $table) {
            $table->dropColumn('bcat11');
            $table->dropColumn('bcat12');
            $table->dropColumn('bcat13');
            $table->dropColumn('bcat14');
            $table->dropColumn('bcat15');
            $table->dropColumn('bcat16');
            $table->dropColumn('bcat17');
            $table->dropColumn('bcat18');
            $table->dropColumn('bcat19');
            $table->dropColumn('bcat20');
        });
    }
};
