<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Services\UserService;
use App\Models\FileManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function myProfile()
    {
        $data['activeProfile'] = 'active';
        $data['user'] = $this->userService->userData();
        return view('super_admin.profile.index',$data);
    }

    public function changePassword()
    {
        $data['pageTitle'] = 'Change Password';
        $data['navAccountSettingActiveClass'] = 'mm-active';
        $data['subNavChangePasswordActiveClass'] = 'mm-active';
        return view('admin.profile.change-password', $data);
    }

    public function changePasswordUpdate(Request $request)
    {
        $pass1 = $request->get('pass1','');
        $pass2 = $request->get('pass2','');
        $user = Auth::User();

        if($pass1 != '' || $pass2 != ''){
            $request->validate([
                'pass1' => 'required|min:6',
                'pass2' => 'required|min:6|same:pass1',
            ]);
            $user->password = Hash::make($request->pass1);
        }

        if ($request->image) {
            $new_file = FileManager::where('id', $user->image)->first();
            if ($new_file) {
                $new_file->removeFile();
                $upload = $new_file->upload('User', $request->image, '', $new_file->id);
                $user->image = $upload->id;
            } else {
                $new_file = new FileManager();
                $upload = $new_file->upload('User', $request->image);
                $user->image = $upload->id;
            }
        }
        /*End*/
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    public function update(ProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);
        /*File Manager Call upload*/
        if ($request->profile_image) {
            $new_file = FileManager::where('id', $user->image)->first();
            if ($new_file) {
                $new_file->removeFile();
                $upload = $new_file->upload('User', $request->profile_image, '', $new_file->id);
                $user->image = $upload->id;
            } else {
                $new_file = new FileManager();
                $upload = $new_file->upload('User', $request->profile_image);
                $user->image = $upload->id;
            }
        }
        /*End*/
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('success', 'Profile has been updated');
    }
}
