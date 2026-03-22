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
        Schema::table('event_tickets', function (Blueprint $table) {
            $table->string('qr_code')->nullable()->after('ticket_number');
            $table->timestamp('checked_in_at')->nullable()->after('qr_code');
            $table->unsignedBigInteger('checked_in_by')->nullable()->after('checked_in_at');

            $table->foreign('checked_in_by')->references('id')->on('users')->nullOnDelete();
            $table->index(['event_id', 'checked_in_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_tickets', function (Blueprint $table) {
            $table->dropForeign(['checked_in_by']);
            $table->dropIndex(['event_id', 'checked_in_at']);
            $table->dropColumn(['qr_code', 'checked_in_at', 'checked_in_by']);
        });
    }
};
