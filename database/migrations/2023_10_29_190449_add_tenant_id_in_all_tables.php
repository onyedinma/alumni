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
        Schema::table('alumnus', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('banks', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('batches', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('contact_us', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('currencies', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('email_templates', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('event_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('event_tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('file_managers', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('gateways', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('membership_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('news_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('news_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('notices', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('notice_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('notification_seens', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('passing_years', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('post_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('post_media', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('stories', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('user_institutions', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
        });

        Schema::table('user_membership_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
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
            $table->dropColumn('tenant_id');
        });

        Schema::table('banks', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('batches', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('currencies', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('email_templates', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('event_categories', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('event_tickets', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('file_managers', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('gateways', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('membership_plans', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('news_categories', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('news_tags', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('notice_categories', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('notification_seens', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('passing_years', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('post_comments', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('post_media', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('user_institutions', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });

        Schema::table('user_membership_plans', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });
    }
};
