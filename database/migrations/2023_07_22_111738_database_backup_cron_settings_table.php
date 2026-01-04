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
        Schema::create('database_backup_cron_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['active', 'inactive']);
            $table->time('hour_of_day')->default('00:00');
            $table->string('backup_after_days')->nullable();
            $table->string('delete_backup_after_days')->nullable();
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
        //
    }
};
