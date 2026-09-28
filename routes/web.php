<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AuthController::class, 'login_admin'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'auth_login_admin']);
Route::post('/admin/logout', [AuthController::class, 'logout_admin'])->name('admin.logout');

Route::middleware(['web', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
    // Admin Management
    Route::get('/admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::get('/admin/admin/add', [AdminController::class, 'add'])->name('admin.admin.add');
    Route::post('/admin/admin/add', [AdminController::class, 'insert']);
    Route::get('/admin/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::post('/admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('/admin/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.admin.delete');
    
    // Customer Management
    Route::get('/admin/customer/list', [\App\Http\Controllers\Admin\CustomerController::class, 'list'])->name('admin.customer.list');
    Route::get('/admin/customer/delete/{id}', [\App\Http\Controllers\Admin\CustomerController::class, 'delete'])->name('admin.customer.delete');
});

// customer auth routes
Route::post('user/register', [AuthController::class, 'userRegister'])->name('user.register');
Route::post('user/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::get('user/logout', [AuthController::class, 'userLogout'])->name('user.logout');

// customer dashboard routes (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('user/dashboard', [CustomerController::class, 'dashboard'])->name('user.dashboard');
    Route::post('user/profile/update', [CustomerController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('user/password/update', [CustomerController::class, 'updatePassword'])->name('user.password.update');
});
