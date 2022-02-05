<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = "Update Profile";
        return view('user.profile.index', $data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        $User = Auth::user();
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->save();
        return redirect()->back()->with('success_message', 'Information updated');
    }
    public function changePassword(Request $request)
    {
        $data['page_title'] = "Change Password";
        return view('user.profile.change_password', $data);
    }
    public function changePasswordAction(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if (!Hash::check($request->password, Auth::user()->password)) {
            return redirect()->back()->with('error_message', 'Currennt password not matched');
        }
        $User = Auth::user();
        $User->password = $request->password;
        $User->save();
        return redirect()->back()->with('success_message', 'Information updated');

    }
}
