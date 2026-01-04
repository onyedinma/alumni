<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_category_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('thumbnail');
            $table->dateTime('date');
            $table->tinyInteger('type')->default(EVENT_TYPE_FREE);
            $table->text('location');
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('number_of_ticket')->default(0);
            $table->integer('number_of_ticket_left')->default(0);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(STATUS_PENDING);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
};
