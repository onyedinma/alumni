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
        Schema::create('in_memoriam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // If they were a registered alumni
            $table->string('name');
            $table->string('photo')->nullable();
            $table->year('graduation_year')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_passing');
            $table->text('obituary')->nullable();
            $table->text('tribute')->nullable();
            $table->string('house')->nullable();
            $table->string('class_arm')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->boolean('is_approved')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_memoriam');
    }
};
