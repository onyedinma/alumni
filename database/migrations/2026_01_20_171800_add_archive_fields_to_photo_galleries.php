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
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->string('decade')->nullable()->after('caption'); // '1990s', '2000s', '2010s', etc.
            $table->boolean('is_historical')->default(false)->after('decade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->dropColumn(['decade', 'is_historical']);
        });
    }
};
