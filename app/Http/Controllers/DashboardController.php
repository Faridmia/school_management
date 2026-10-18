<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';

        if (Auth::user()->user_type == 1) {
            $data['totalAdmin'] = User::where('user_type', 1)->where('is_delete', 0)->count();
            $data['totalTeacher'] = User::where('user_type', 2)->where('is_delete', 0)->count();
            $data['totalStudent'] = User::where('user_type', 3)->where('is_delete', 0)->count();
            $data['totalParent'] = User::where('user_type', 4)->where('is_delete', 0)->count();
            return view('admin.dashboard', $data);
        } else if (Auth::user()->user_type == 2) {
            return view('teacher.dashboard', $data);
        } else if (Auth::user()->user_type == 3) {
            return view('student.dashboard', $data);
        } else if (Auth::user()->user_type == 4) {
            return view('parent.dashboard', $data);
        }
    }
}
