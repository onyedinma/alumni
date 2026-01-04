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
        Schema::dropIfExists('notifications');
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->text('link')->nullable();
            $table->tinyInteger('view_status')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('notifications');
    }
};
