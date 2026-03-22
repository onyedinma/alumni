<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mini_polls', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('mini_poll_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mini_poll_id')->constrained('mini_polls')->onDelete('cascade');
            $table->string('option_text');
            $table->integer('vote_count')->default(0);
            $table->timestamps();
        });

        // Track user votes to prevent spam
        Schema::create('mini_poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mini_poll_id')->constrained('mini_polls')->onDelete('cascade');
            $table->foreignId('user_id')->nullable(); // If logged in
            $table->string('ip_address')->nullable(); // For guests/double check
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mini_poll_votes');
        Schema::dropIfExists('mini_poll_options');
        Schema::dropIfExists('mini_polls');
    }
};
