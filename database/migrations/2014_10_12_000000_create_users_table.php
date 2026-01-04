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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('nick_name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('image')->nullable();
            $table->tinyInteger('role')->default(USER_ROLE_ALUMNI);
            $table->tinyInteger('email_verification_status')->default(0);
            $table->tinyInteger('phone_verification_status')->default(0);
            $table->tinyInteger('google_auth_status')->default(0);
            $table->text('google2fa_secret')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('verify_token')->nullable();
            $table->integer('otp')->nullable();
            $table->dateTime('otp_expiry')->nullable();
            $table->tinyInteger('show_email_in_public')->default(STATUS_ACTIVE);
            $table->tinyInteger('show_phone_in_public')->default(STATUS_ACTIVE);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->tinyInteger('status')->default(STATUS_ACTIVE);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
