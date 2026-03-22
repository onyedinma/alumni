<?php

namespace App\Http\Services;

use App\Models\Notification;
use App\Models\User;

class AdminNotificationService
{
    /**
     * Send notification to all admins
     */
    public static function notifyAdmins($title, $body, $link = null)
    {
        $tenantId = getTenantId();

        // Get all admin users for this tenant
        $admins = User::where('tenant_id', $tenantId)
            ->whereIn('role', [USER_ROLE_ADMIN, USER_ROLE_SUPER_ADMIN])
            ->get();

        foreach ($admins as $admin) {
            Notification::create([
                'tenant_id' => $tenantId,
                'user_id' => $admin->id,
                'title' => $title,
                'body' => $body,
                'link' => $link,
                'view_status' => 0,
                'status' => 1,
            ]);
        }
    }

    /**
     * Notify admins of new registration pending approval
     */
    public static function newRegistration($user)
    {
        self::notifyAdmins(
            __('New Registration Pending'),
            __(':name has registered and needs approval.', ['name' => $user->name]),
            route('admin.alumni.list-pending-alumni-with-filter')
        );
    }

    /**
     * Notify admins of new event pending approval
     */
    public static function newEvent($event, $creator)
    {
        self::notifyAdmins(
            __('New Event Pending Approval'),
            __(':name created event: :event', ['name' => $creator->name, 'event' => $event->title]),
            route('admin.event.pending.index')
        );
    }

    /**
     * Notify admins of new post
     */
    public static function newPost($post, $creator)
    {
        self::notifyAdmins(
            __('New Post Created'),
            __(':name created a new post.', ['name' => $creator->name]),
            url('/admin/dashboard') // Posts are managed from dashboard
        );
    }
}
