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
        Schema::create('frontend_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('page_title')->nullable();
            $table->text('title')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('has_page_title')->nullable();
            $table->tinyInteger('has_banner_image')->default(0);
            $table->tinyInteger('has_image')->default(0);
            $table->tinyInteger('has_description')->default(0);
            $table->longText('description')->nullable();
            $table->integer('banner_image')->nullable();
            $table->integer('image')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('frontend_sections');
    }
};
