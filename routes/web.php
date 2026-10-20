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
    Route::get('/admin/admin/add', [AdminController::class, 'create'])->name('admin.admin.add');
    Route::post('/admin/admin/add', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::get('/admin/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::match(['post', 'put'], '/admin/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.admin.update');
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

    // Student Management
    Route::get('/admin/student/list', [\App\Http\Controllers\StudentController::class, 'list'])->name('admin.student.list');
    Route::get('/admin/student/add', [\App\Http\Controllers\StudentController::class, 'add'])->name('admin.student.add');
    Route::post('/admin/student/add', [\App\Http\Controllers\StudentController::class, 'insert']);
    Route::get('/admin/student/edit/{id}', [\App\Http\Controllers\StudentController::class, 'edit'])->name('admin.student.edit');
    Route::post('/admin/student/edit/{id}', [\App\Http\Controllers\StudentController::class, 'update']);
    Route::get('/admin/student/delete/{id}', [\App\Http\Controllers\StudentController::class, 'delete'])->name('admin.student.delete');

    // Parent Management
    Route::get('/admin/parent/list', [\App\Http\Controllers\ParentController::class, 'list'])->name('admin.parent.list');
    Route::get('/admin/parent/add', [\App\Http\Controllers\ParentController::class, 'add'])->name('admin.parent.add');
    Route::post('/admin/parent/add', [\App\Http\Controllers\ParentController::class, 'insert']);
    Route::get('/admin/parent/edit/{id}', [\App\Http\Controllers\ParentController::class, 'edit'])->name('admin.parent.edit');
    Route::post('/admin/parent/edit/{id}', [\App\Http\Controllers\ParentController::class, 'update']);
    Route::get('/admin/parent/delete/{id}', [\App\Http\Controllers\ParentController::class, 'delete'])->name('admin.parent.delete');
    Route::get('/admin/parent/my-student/{id}', [\App\Http\Controllers\ParentController::class, 'myStudent'])->name('admin.parent.my-student');
    Route::get('/admin/parent/assign_student_parent/{student_id}/{parent_id}', [\App\Http\Controllers\ParentController::class, 'assignStudentParent']);
    Route::get('/admin/parent/assign_student_parent_delete/{student_id}', [\App\Http\Controllers\ParentController::class, 'assignStudentParentDelete']);

    // Teacher Management
    Route::get('/admin/teacher/list', [\App\Http\Controllers\TeacherController::class, 'list'])->name('admin.teacher.list');
    Route::get('/admin/teacher/add', [\App\Http\Controllers\TeacherController::class, 'add'])->name('admin.teacher.add');
    Route::post('/admin/teacher/add', [\App\Http\Controllers\TeacherController::class, 'insert']);
    Route::get('/admin/teacher/edit/{id}', [\App\Http\Controllers\TeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::post('/admin/teacher/edit/{id}', [\App\Http\Controllers\TeacherController::class, 'update']);
    Route::get('/admin/teacher/delete/{id}', [\App\Http\Controllers\TeacherController::class, 'delete'])->name('admin.teacher.delete');

    // Admin Account
    Route::get('/admin/account', [\App\Http\Controllers\UserController::class, 'MyAccount'])->name('admin.account');
    Route::post('/admin/account', [\App\Http\Controllers\UserController::class, 'UpdateMyAccountAdmin']);

    // User Management
    Route::get('/admin/customer/list', [CustomerController::class, 'list'])->name('admin.customer.list');
    Route::get('/admin/customer/delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
});

// ---------------------------------------------
// Teacher Role Routes (user_type = 2)
// ---------------------------------------------
Route::group(['middleware' => 'teacher'], function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/account', [\App\Http\Controllers\UserController::class, 'MyAccount'])->name('teacher.account');
    Route::post('/teacher/account', [\App\Http\Controllers\UserController::class, 'UpdateMyAccount']);
});

// ---------------------------------------------
// Student Role Routes (user_type = 3)
// ---------------------------------------------
Route::group(['middleware' => 'student'], function () {
    Route::get('/student/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/account', [\App\Http\Controllers\UserController::class, 'MyAccount'])->name('student.account');
    Route::post('/student/account', [\App\Http\Controllers\UserController::class, 'UpdateMyAccountStudent']);
});

// ---------------------------------------------
// Parent Role Routes (user_type = 4)
// ---------------------------------------------
Route::group(['middleware' => 'parent'], function () {
    Route::get('/parent/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');
    Route::get('/parent/account', [\App\Http\Controllers\UserController::class, 'MyAccount'])->name('parent.account');
    Route::post('/parent/account', [\App\Http\Controllers\UserController::class, 'UpdateMyAccountParent']);
});
