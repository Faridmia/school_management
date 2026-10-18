<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;

// Authentication Routes
Route::get('/', [AuthController::class, 'login_admin'])->name('login');
Route::get('/login', [AuthController::class, 'login_admin']);
Route::post('/login', [AuthController::class, 'auth_login_admin']);
Route::get('/logout', [AuthController::class, 'logout_admin'])->name('logout');

// Compatibility for admin routes
Route::get('/admin', [AuthController::class, 'login_admin'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'auth_login_admin']);
Route::post('/admin/logout', [AuthController::class, 'logout_admin'])->name('admin.logout');

// ---------------------------------------------
// Admin Role Routes (user_type = 1)
// ---------------------------------------------
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Management
    Route::get('/admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::get('/admin/admin/add', [AdminController::class, 'add'])->name('admin.admin.add');
    Route::post('/admin/admin/add', [AdminController::class, 'insert']);
    Route::get('/admin/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::post('/admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('/admin/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.admin.delete');

    // Class Management
    Route::get('/admin/class/list', [\App\Http\Controllers\ClassController::class, 'list'])->name('admin.class.list');
    Route::get('/admin/class/add', [\App\Http\Controllers\ClassController::class, 'add'])->name('admin.class.add');
    Route::post('/admin/class/add', [\App\Http\Controllers\ClassController::class, 'insert']);
    Route::get('/admin/class/edit/{id}', [\App\Http\Controllers\ClassController::class, 'edit'])->name('admin.class.edit');
    Route::post('/admin/class/edit/{id}', [\App\Http\Controllers\ClassController::class, 'update']);
    Route::get('/admin/class/delete/{id}', [\App\Http\Controllers\ClassController::class, 'delete'])->name('admin.class.delete');

    // Subject Management
    Route::get('/admin/subject/list', [\App\Http\Controllers\SubjectController::class, 'list'])->name('admin.subject.list');
    Route::get('/admin/subject/add', [\App\Http\Controllers\SubjectController::class, 'add'])->name('admin.subject.add');
    Route::post('/admin/subject/add', [\App\Http\Controllers\SubjectController::class, 'insert']);
    Route::get('/admin/subject/edit/{id}', [\App\Http\Controllers\SubjectController::class, 'edit'])->name('admin.subject.edit');
    Route::post('/admin/subject/edit/{id}', [\App\Http\Controllers\SubjectController::class, 'update']);
    Route::get('/admin/subject/delete/{id}', [\App\Http\Controllers\SubjectController::class, 'delete'])->name('admin.subject.delete');

    // Assign Subject Management
    Route::get('/admin/assign_subject/list', [\App\Http\Controllers\ClassSubjectController::class, 'list'])->name('admin.assign_subject.list');
    Route::get('/admin/assign_subject/add', [\App\Http\Controllers\ClassSubjectController::class, 'add'])->name('admin.assign_subject.add');
    Route::post('/admin/assign_subject/add', [\App\Http\Controllers\ClassSubjectController::class, 'insert']);
    Route::get('/admin/assign_subject/edit/{id}', [\App\Http\Controllers\ClassSubjectController::class, 'edit'])->name('admin.assign_subject.edit');
    Route::post('/admin/assign_subject/edit/{id}', [\App\Http\Controllers\ClassSubjectController::class, 'update']);
    Route::get('/admin/assign_subject/delete/{id}', [\App\Http\Controllers\ClassSubjectController::class, 'delete'])->name('admin.assign_subject.delete');
    Route::get('/admin/assign_subject/edit_single/{id}', [\App\Http\Controllers\ClassSubjectController::class, 'edit_single'])->name('admin.assign_subject.edit_single');
    Route::post('/admin/assign_subject/edit_single/{id}', [\App\Http\Controllers\ClassSubjectController::class, 'update_single']);

    // User Management
    Route::get('/admin/customer/list', [CustomerController::class, 'list'])->name('admin.customer.list');
    Route::get('/admin/customer/delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
});

// ---------------------------------------------
// Teacher Role Routes (user_type = 2)
// ---------------------------------------------
Route::group(['middleware' => 'teacher'], function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
});

// ---------------------------------------------
// Student Role Routes (user_type = 3)
// ---------------------------------------------
Route::group(['middleware' => 'student'], function () {
    Route::get('/student/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');
});

// ---------------------------------------------
// Parent Role Routes (user_type = 4)
// ---------------------------------------------
Route::group(['middleware' => 'parent'], function () {
    Route::get('/parent/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');
});
