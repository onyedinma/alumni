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
        Schema::table('alumnus', function (Blueprint $table) {
            $table->unsignedBigInteger('first_class_id')->nullable()->after('passing_year_id');
            $table->unsignedBigInteger('final_class_id')->nullable()->after('first_class_id');
            $table->unsignedBigInteger('first_house_id')->nullable()->after('final_class_id');
            $table->unsignedBigInteger('final_house_id')->nullable()->after('first_house_id');

            // Foreign key constraints
            $table->foreign('first_class_id')->references('id')->on('classes')->onDelete('set null');
            $table->foreign('final_class_id')->references('id')->on('classes')->onDelete('set null');
            $table->foreign('first_house_id')->references('id')->on('houses')->onDelete('set null');
            $table->foreign('final_house_id')->references('id')->on('houses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnus', function (Blueprint $table) {
            $table->dropForeign(['first_class_id']);
            $table->dropForeign(['final_class_id']);
            $table->dropForeign(['first_house_id']);
            $table->dropForeign(['final_house_id']);

            $table->dropColumn(['first_class_id', 'final_class_id', 'first_house_id', 'final_house_id']);
        });
    }
};
