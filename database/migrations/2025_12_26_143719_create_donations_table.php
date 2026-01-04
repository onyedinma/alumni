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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('tenant_id')->default(1);
            $table->unsignedBigInteger('user_id')->nullable(); // nullable for guest donations
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone')->nullable();
            $table->decimal('amount', 12, 2);
            $table->text('message')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->tinyInteger('status')->default(0); // 0=pending, 1=completed, 2=failed
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
