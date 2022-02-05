<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = "Welcome, ".Auth::user()->fullName();
        return view('user.dashboard.index', $data);
    }
}
