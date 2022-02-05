<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.profile.index');
    }
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        $Admin = Auth::guard('admin')->user();
        $Admin->first_name = $request->first_name;
        $Admin->last_name = $request->last_name;
        $Admin->save();
        return redirect()->back()->with('success_message', 'Information updated');
    }
    public function changePassword(Request $request)
    {
        return view('admin.profile.change_password');
    }
    public function changePasswordAction(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if (!Hash::check($request->password, Auth::guard('admin')->user()->password)) {
            return redirect()->back()->with('error_message', 'Currennt password not matched');
        }
        $Admin = Auth::guard('admin')->user();
        $Admin->password = $request->password;
        $Admin->save();
        return redirect()->back()->with('success_message', 'Information updated');

    }
}
