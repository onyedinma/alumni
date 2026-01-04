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
        Schema::table('user_packages', function (Blueprint $table) {
            $table->tinyInteger('subscription_type')->after('end_date')->default(SUBSCRIPTION_TYPE_MONTHLY);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_packages', function (Blueprint $table) {
            $table->dropColumn('subscription_type');
        });
    }
};
