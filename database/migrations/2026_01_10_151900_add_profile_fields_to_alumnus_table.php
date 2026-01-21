<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Adds additional profile fields for FGCO alumni:
     * - nickname, state_of_origin, lga_of_origin
     * - current_job, expertise, company_name, work_address, bio
     */
    public function up(): void
    {
        Schema::table('alumnus', function (Blueprint $table) {
            // Personal info
            $table->string('nickname', 100)->nullable();
            $table->string('state_of_origin', 100)->nullable();
            $table->string('lga_of_origin', 100)->nullable();

            // Professional info
            $table->string('current_job', 255)->nullable();
            $table->string('expertise', 255)->nullable();
            $table->string('company_name', 255)->nullable();
            $table->text('work_address')->nullable();

            // Bio/Portfolio
            $table->text('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnus', function (Blueprint $table) {
            $table->dropColumn([
                'nickname',
                'state_of_origin',
                'lga_of_origin',
                'current_job',
                'expertise',
                'company_name',
                'work_address',
                'bio'
            ]);
        });
    }
};
