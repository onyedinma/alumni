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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('language')->unique();
            $table->string('iso_code', 20)->unique();
            $table->unsignedBigInteger('flag_id')->nullable();
            $table->unsignedBigInteger('font')->nullable();
            $table->tinyInteger('rtl')->default(STATUS_DEACTIVATE)->nullable();
            $table->tinyInteger('status')->default(STATUS_ACTIVE);
            $table->tinyInteger('default')->default(STATUS_PENDING)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
