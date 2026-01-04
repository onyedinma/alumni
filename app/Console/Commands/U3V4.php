<?php

namespace App\Console\Commands;

use App\Models\Alumni;
use App\Models\Bank;
use App\Models\Batch;
use App\Models\Chat;
use App\Models\ContactUs;
use App\Models\Currency;
use App\Models\Department;
use App\Models\EmailTemplate;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventTicket;
use App\Models\FileManager;
use App\Models\Gateway;
use App\Models\JobPost;
use App\Models\Membership;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use App\Models\Notice;
use App\Models\NoticeCategory;
use App\Models\Notification;
use App\Models\NotificationSeen;
use App\Models\PassingYear;
use App\Models\Payment;
use App\Models\PhotoGallery;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostMedia;
use App\Models\Setting;
use App\Models\Story;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserInstitution;
use App\Models\UserMembershipPlan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class U3V4 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'u3v4 {--lqs=} {--v=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {

            $dbBuildVersion = getCustomerCurrentBuildVersion();
            $v = $this->option('v');

            if($dbBuildVersion < $v){

                //create tenant
                Tenant::where('id', '!=', 0)->delete();
                $tenant = Tenant::create(['id' => 1]);
                $tenant->domains()->delete();
                $central_domains = Config::get('tenancy.central_domains')[0];
                $central_domains = getHostFromURL($central_domains);
                $tenant->domains()->create(['domain' => 'default.'.$central_domains]);

                User::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Alumni::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Bank::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Batch::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Chat::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                ContactUs::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Currency::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Department::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                EmailTemplate::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Event::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                EventCategory::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                EventTicket::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                FileManager::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Gateway::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                JobPost::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Membership::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                News::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                NewsCategory::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                NewsTag::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Notice::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                NoticeCategory::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Notification::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                NotificationSeen::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                PassingYear::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Payment::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                PhotoGallery::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Post::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                PostComment::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                PostMedia::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Setting::whereNotIn('option_key', superAdminSetting())->update(['tenant_id' => $tenant->id]);
                Story::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                Transaction::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                User::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                UserInstitution::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);
                UserMembershipPlan::where('id', '!=', 0)->update(['tenant_id' => $tenant->id]);

                //Add super admin
                $google2fa = app('pragmarx.google2fa');
                User::create([
                    'uuid' => \Str::uuid(),
                    'name' => 'Super Admin',
                    'email_verified_at' => now(),
                    'mobile' => '+0000123456',
                    'role' => USER_ROLE_SUPER_ADMIN,
                    'email' => 'superadmin@gmail.com',
                    'password' => Hash::make(123456),
                    'status' => USER_STATUS_ACTIVE,
                    'google2fa_secret' => $google2fa->generateSecretKey(),
                    'email_verification_status' => STATUS_ACTIVE,
                    'phone_verification_status' => STATUS_ACTIVE
                ]);

                Artisan::call('set-tenancy-data --tenant=NULL');

                $lqs = $this->option('lqs');

                $lqs = utf8_decode(urldecode($lqs));
                if(!is_null($lqs) && $lqs != ''){
                    DB::unprepared($lqs);
                }

                setCustomerBuildVersion($v);
                setCustomerCurrentVersion();
                Log::info('from uxvy');
                DB::commit();
                echo "Command run successfully";
                return true;
            }else{
                DB::rollBack();
                return true;
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage() . $exception->getFile() . $exception->getLine());
            return false;
        }

        return true;
    }
}
