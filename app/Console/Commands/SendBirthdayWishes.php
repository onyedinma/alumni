<?php

namespace App\Console\Commands;

use App\Models\Alumni;
use App\Models\Post;
use App\Models\User;
use App\Notifications\BirthdayWishNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendBirthdayWishes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthdays:send-wishes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto-post birthday wishes and send email notifications for alumni celebrating their birthday today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if Birthday Auto-Post is enabled
        if (getOption('birthday_auto_post_status') != STATUS_ACTIVE) {
            $this->info("Birthday Auto-Post is disabled.");
            return self::SUCCESS;
        }

        $today = Carbon::today();

        // Find alumni with birthdays today
        $birthdayAlumni = Alumni::whereRaw('MONTH(date_of_birth) = ? AND DAY(date_of_birth) = ?', [
            $today->month,
            $today->day
        ])->with('user')->get();

        $postCount = 0;
        $notificationCount = 0;

        foreach ($birthdayAlumni as $alumni) {
            if (!$alumni->user || $alumni->user->status != 1) {
                continue;
            }

            // Check if we already posted for this person today
            $existingPost = Post::where('created_by', $alumni->user_id)
                ->where('type', 'birthday')
                ->whereDate('created_at', $today)
                ->first();

            if (!$existingPost) {
                // Create birthday post
                Post::create([
                    'tenant_id' => $alumni->tenant_id,
                    'created_by' => $alumni->user_id,
                    'type' => 'birthday',
                    'body' => $this->getBirthdayMessage($alumni->user),
                    'status' => 1,
                ]);

                $postCount++;
                Log::info("Birthday post created for: {$alumni->user->name}");
            }

            // Send email notification (only once per day)
            try {
                $alumni->user->notify(new BirthdayWishNotification($alumni->user));
                $notificationCount++;
                Log::info("Birthday notification sent to: {$alumni->user->email}");
            } catch (\Exception $e) {
                Log::error("Failed to send birthday notification to {$alumni->user->email}: " . $e->getMessage());
            }
        }

        $this->info("Birthday wishes: {$postCount} posts created, {$notificationCount} notifications sent.");

        return self::SUCCESS;
    }

    /**
     * Generate a personalized birthday message.
     */
    private function getBirthdayMessage(User $user): string
    {
        $year = $user->alumni?->passing_year ?? '';
        $setInfo = $year ? " (Set of {$year})" : '';

        // Fetch custom messages from settings or use default
        $rawMessages = getOption('birthday_messages');
        if ($rawMessages) {
            $messages = array_filter(array_map('trim', explode("\n", $rawMessages)));
        }

        if (empty($messages)) {
            $messages = [
                "🎂 Happy Birthday to our amazing alumni, {name}{set}! 🎉 Wishing you a wonderful day filled with joy and blessings!",
                "🎈 Today we celebrate {name}{set}! 🎂 Happy Birthday! May this year bring you success and happiness!",
                "🎉 It's {name}'s special day{set}! Happy Birthday! 🎂 The alumni family wishes you all the best!",
            ];
        }

        $selectedMessage = $messages[array_rand($messages)];

        // Replace placeholders
        return str_replace(
            ['{name}', '{set}'],
            [$user->name, $setInfo],
            $selectedMessage
        );
    }
}

