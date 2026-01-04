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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('compensation_n_benefits');
            $table->string('salary')->default(0);
            $table->integer('company_logo');
            $table->string('location');
            $table->text('post_link');
            $table->dateTime('application_deadline');
            $table->text('job_responsibility');
            $table->text('job_context');
            $table->text('educational_requirements');
            $table->text('additional_requirements')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('employee_status');
            $table->tinyInteger('status')->default(STATUS_PENDING);
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
        Schema::dropIfExists('job_posts');
    }
};
