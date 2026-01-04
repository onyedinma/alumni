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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug');
            $table->integer('alumni_limit')->default(UNLIMITED);
            $table->tinyInteger('custom_domain')->default(DEACTIVATE);
            $table->integer('event_limit')->default(UNLIMITED);
            $table->integer('icon_id')->nullable();
            $table->text('others')->nullable();
            $table->decimal('monthly_price', 12, 2)->default(0.00);
            $table->decimal('yearly_price', 12, 2)->default(0.00);
            $table->tinyInteger('status')->default(DEACTIVATE)->comment('active for 1 , deactivate for 0');
            $table->tinyInteger('is_default')->default(DEACTIVATE)->comment('active for 1 , deactivate for 0');
            $table->tinyInteger('is_trail')->default(DEACTIVATE)->comment('active for 1 , deactivate for 0');
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
        Schema::dropIfExists('packages');
    }
};
