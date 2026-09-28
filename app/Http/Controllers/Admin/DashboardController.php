<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['totalCustomer'] = User::where('is_admin', 0)->where('is_delete', 0)->count();
        $data['header_title'] = 'Dashboard';   
        return view('admin.dashboard', $data);
    }
}
