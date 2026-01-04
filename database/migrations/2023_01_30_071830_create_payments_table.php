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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('paymentable_id');
            $table->string('paymentable_type');
            $table->unsignedBigInteger('gateway_id');
            $table->string('paymentId')->nullable();
            $table->string('tnxId')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->integer('deposit_slip')->nullable();
            $table->decimal('sub_total', 12, 2)->default(0.00);
            $table->decimal('tax', 12, 2)->default(0.00);
            $table->string('system_currency')->nullable();
            $table->string('payment_currency')->nullable();
            $table->decimal('conversion_rate', 18,8)->default(0.00);
            $table->decimal('grand_total_with_conversation_rate', 18,8)->default(0.00);
            $table->decimal('grand_total', 12, 2)->default(0.00);
            $table->longText('payment_details')->nullable();
            $table->longText('gateway_callback_details')->nullable();
            $table->dateTime('payment_time')->nullable();
            $table->tinyInteger('payment_status')->default(1);
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
        Schema::dropIfExists('payments');
    }
};
