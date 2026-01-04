<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Batch;
use App\Models\Department;
use App\Models\FileManager;
use App\Models\PassingYear;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\ResponseTrait;
use Config;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, ResponseTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        if(isAddonInstalled('ALUSAAS') && !isCentralDomain() && getPackageLimit(PACKAGE_RULE_ALUMNI_LIMIT) != -1 && getPackageLimit(PACKAGE_RULE_ALUMNI_LIMIT) <= 0){
            return back()->with('error', __('The alumni limit has been finished. Please contact with admin to upgrade the plan'));
        }

        if (!isCentralDomain() || !isAddonInstalled('ALUSAAS')) {
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
        } else {
            $this->validatorCentral($request->all())->validate();
            event(new Registered($user = $this->createCentral($request->all())));
        }

        if(is_null($user) || is_null($user->id)){
            return back()->with('error', __(SOMETHING_WENT_WRONG));
        }
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            "email" => ['required', 'email', 'max:255', 'unique:users'],
            "name" => ['required', 'string', 'max:255'],
            "mobile" => 'bail|required|min:6|unique:users',
            "batch_id" => 'required',
            "department_id" => 'required',
            "passing_year_id" => 'required',
            "id_number" => 'bail|required|min:1',
            "file" => ['bail', 'nullable', 'mimetypes:application/pdf'],
            "date_of_birth" => 'required|date|before:today',
            "gender" => 'bail|required',
            "password" => ['required', 'string', 'min:6', 'confirmed'],
        ];

        if (getOption('register_file_required', 0)) {
            $rules['file'] = ['bail', 'required', 'mimetypes:application/pdf'];
        }

        if (!empty(getOption('google_recaptcha_status')) && getOption('google_recaptcha_status') == STATUS_ACTIVE) {
            $rules['g-recaptcha-response'] = 'required|recaptchav3:register';
        }
        return Validator::make($data, $rules);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorCentral(array $data)
    {
        $rules = [
            "email" => ['required', 'email', 'max:255', 'unique:users'],
            "name" => ['required', 'string', 'max:255'],
            "mobile" => 'bail|required|min:6|unique:users',
            "date_of_birth" => 'required|date|before:today',
            "gender" => 'bail|required',
            "password" => ['required', 'string', 'min:6', 'confirmed'],
        ];

        if (!empty(getOption('google_recaptcha_status')) && getOption('google_recaptcha_status') == STATUS_ACTIVE) {
            $rules['g-recaptcha-response'] = 'required|recaptchav3:register';
        }
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $remember_token = Str::random(64);

        $google2fa = app('pragmarx.google2fa');

        $file = NULL;
        if (isset($data['file']) && !is_null($data['file'])) {
            $new_file = new FileManager();
            $uploaded = $new_file->upload('users', $data['file']);
            $file = $uploaded->id;
        }
        if (getOption('registration_approval') == 1) {
            $status = USER_STATUS_INACTIVE;
        } else {
            $status = USER_STATUS_ACTIVE;
        }

        $tenantId = getTenantId();

        $newUser = User::create([
            'tenant_id' => $tenantId,
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'remember_token' => $remember_token,
            'status' => $status,
            'verify_token' => str_replace('-', '', Str::uuid()->toString()),
            'google2fa_secret' => $google2fa->generateSecretKey(),
            'email_verification_status' => (!empty(getOption('email_verification_status')) && getOption('email_verification_status') == STATUS_ACTIVE) ? STATUS_PENDING : STATUS_ACTIVE,
            'phone_verification_status' => 0
        ]);


        Alumni::create([
            'tenant_id' => $tenantId,
            'user_id' => $newUser->id,
            'batch_id' => $data['batch_id'],
            'department_id' => $data['department_id'],
            'passing_year_id' => $data['passing_year_id'],
            'id_number' => $data['id_number'],
            'file' => $file,
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
        ]);

        return $newUser;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function createCentral(array $data)
    {
        DB::beginTransaction();
        try{

            $remember_token = Str::random(64);

            $google2fa = app('pragmarx.google2fa');

            $tenant = $this->createTenant();

            $newUser = User::create([
                'name' => $data['name'],
                'tenant_id' => $tenant->id,
                'role' => USER_ROLE_ADMIN,
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'password' => Hash::make($data['password']),
                'remember_token' => $remember_token,
                'status' => STATUS_ACTIVE,
                'verify_token' => str_replace('-', '', Str::uuid()->toString()),
                'google2fa_secret' => $google2fa->generateSecretKey(),
                'email_verification_status' => (!empty(getOption('email_verification_status')) && getOption('email_verification_status') == STATUS_ACTIVE) ? STATUS_PENDING : STATUS_ACTIVE,
                'phone_verification_status' => 0
            ]);

            Alumni::create([
                'tenant_id' => $tenant->id,
                'user_id' => $newUser->id,
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
            ]);

            Artisan::call('set-tenancy-data --tenant='.$tenant->id);

            DB::commit();
            return $newUser;
        }catch (Exception $e){
            DB::rollBack();
            return new User();
        }

    }


    /**
     * create new tenant.
     *
     * @return \Illuminate\View\View
     */
    public function createTenant()
    {
        //create Tenant
        $random = generateRandomString();
        $central_domains = Config::get('tenancy.central_domains')[0];
        $central_domains = getHostFromURL($central_domains);
        $domain = $random . '.' . $central_domains;

        //getLast Tenant
        $lastTenant = Tenant::orderBy('id', 'DESC')->first();
        $lastTenantId = $lastTenant->id ?? 0;

        $tenant = Tenant::create(['id' => ++$lastTenantId]);
        $tenant->domains()->create(['domain' => $domain]);

        return $tenant;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        if (getOption('disable_registration') != 1) {
            $data['passingYears'] = PassingYear::all();
            $data['batches'] = Batch::all();
            $data['departments'] = Department::all();
            return view('auth.register', $data);
        } else {
            return redirect()->back()->with('error', 'Registration is disable!');
        }
    }
}
