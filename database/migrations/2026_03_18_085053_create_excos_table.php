<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('excos', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id')->nullable();
            $table->unsignedBigInteger('exco_tenor_id');
            $table->string('name');
            $table->string('position');
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->integer('order')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Inactive');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('exco_tenor_id')->references('id')->on('exco_tenors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excos');
    }
};
