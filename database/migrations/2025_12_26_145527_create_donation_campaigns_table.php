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
        Schema::create('donation_campaigns', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('tenant_id')->default(1);
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('image_id')->nullable(); // FileManager ID
            $table->decimal('goal_amount', 12, 2)->nullable(); // Target amount
            $table->decimal('raised_amount', 12, 2)->default(0); // Amount raised so far
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('beneficiary_name')->nullable(); // For burial/sick member
            $table->tinyInteger('status')->default(1); // 1=active, 0=inactive
            $table->boolean('is_featured')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_campaigns');
    }
};
