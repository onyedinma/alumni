<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BirthdayWishNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected User $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $appName = getOption('app_name', 'Alumni Association');
        $year = $this->user->alumni?->passing_year;
        $setInfo = $year ? " (Set of {$year})" : '';

        return (new MailMessage)
            ->subject("🎂 Happy Birthday, {$this->user->name}!")
            ->greeting("Happy Birthday, {$this->user->name}!")
            ->line("On behalf of the entire {$appName}{$setInfo}, we want to wish you a wonderful birthday!")
            ->line("May this special day bring you joy, happiness, and all the success in the year ahead.")
            ->line("Your contributions to our alumni community are truly valued and appreciated.")
            ->action('Visit Alumni Portal', url('/'))
            ->line("With warm wishes from your alumni family! 🎉");
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'birthday_wish',
            'title' => '🎂 Happy Birthday!',
            'message' => "Wishing you a wonderful birthday filled with joy and happiness!",
            'user_id' => $this->user->id,
        ];
    }
}
