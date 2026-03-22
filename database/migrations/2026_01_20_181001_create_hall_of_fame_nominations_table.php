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
        Schema::create('hall_of_fame_nominations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('hall_of_fame_id')->nullable(); // If converted to inductee
            $table->string('nominee_name');
            $table->string('nominee_email')->nullable();
            $table->integer('nominee_graduation_year')->nullable();
            $table->string('category');
            $table->text('nomination_reason');
            $table->unsignedBigInteger('nominator_id'); // User who submitted
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->foreign('hall_of_fame_id')->references('id')->on('hall_of_fame')->onDelete('set null');
            $table->foreign('nominator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_of_fame_nominations');
    }
};
