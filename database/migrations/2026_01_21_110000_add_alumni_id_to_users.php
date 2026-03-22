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
        Schema::table('users', function (Blueprint $table) {
            $table->string('alumni_id_number')->nullable()->unique()->after('id');
            $table->string('id_card_qr')->nullable()->after('alumni_id_number');
            $table->timestamp('id_card_generated_at')->nullable()->after('id_card_qr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['alumni_id_number', 'id_card_qr', 'id_card_generated_at']);
        });
    }
};
