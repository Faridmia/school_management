<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;

class TeacherController extends Controller
{
    // ==========================================
    // ADMIN TEACHER MANAGEMENT
    // ==========================================
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('admin.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Teacher";
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'marital_status' => 'nullable|string|max:50',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string',
            'permanent_address' => 'nullable|string',
            'qualification' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'note' => 'nullable|string',
            'status' => 'required|in:0,1',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'date_of_birth.required' => 'Date of Birth is required.',
            'date_of_joining.required' => 'Date of Joining is required.',
            'address.required' => 'Current Address is required.',
            'status.required' => 'Please select Status.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'profile_pic.image' => 'The profile picture must be an image.',
            'profile_pic.mimes' => 'The profile picture must be a file of type: jpeg, png, jpg, webp.',
            'profile_pic.max' => 'The profile picture size must not exceed 2MB.',
            'mobile_number.min' => 'Mobile number must be at least 8 digits.',
            'mobile_number.max' => 'Mobile number cannot exceed 15 digits.',
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = trim($request->date_of_birth);
        $teacher->date_of_joining = trim($request->date_of_joining);
        $teacher->admission_date = trim($request->date_of_joining);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $teacher->profile_pic = $filename;
        }

        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Successfully Created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord']) && $data['getRecord']->user_type == 2) {
            $data['header_title'] = "Edit Teacher";
            return view('admin.teacher.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'marital_status' => 'nullable|string|max:50',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string',
            'permanent_address' => 'nullable|string',
            'qualification' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'note' => 'nullable|string',
            'status' => 'required|in:0,1',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'date_of_birth.required' => 'Date of Birth is required.',
            'date_of_joining.required' => 'Date of Joining is required.',
            'address.required' => 'Current Address is required.',
            'status.required' => 'Please select Status.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already taken by another account.',
            'password.min' => 'Password must be at least 6 characters if you wish to change it.',
            'profile_pic.image' => 'The profile picture must be an image.',
            'profile_pic.mimes' => 'The profile picture must be a file of type: jpeg, png, jpg, webp.',
            'profile_pic.max' => 'The profile picture size must not exceed 2MB.',
            'mobile_number.min' => 'Mobile number must be at least 8 digits.',
            'mobile_number.max' => 'Mobile number cannot exceed 15 digits.',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = trim($request->date_of_birth);
        $teacher->date_of_joining = trim($request->date_of_joining);
        $teacher->admission_date = trim($request->date_of_joining);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);

        if (!empty($request->password)) {
            $teacher->password = Hash::make($request->password);
        }

        if (!empty($request->file('profile_pic'))) {
            if (!empty($teacher->profile_pic) && file_exists(public_path('upload/profile/' . $teacher->profile_pic))) {
                unlink(public_path('upload/profile/' . $teacher->profile_pic));
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $teacher->profile_pic = $filename;
        }

        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Successfully Updated");
    }

    public function delete($id)
    {
        $teacher = User::getSingle($id);
        if (!empty($teacher)) {
            $teacher->is_delete = 1;
            $teacher->save();
            return redirect()->back()->with('success', "Teacher Successfully Deleted");
        } else {
            abort(404);
        }
    }

    // ==========================================
    // TEACHER PORTAL: MY ACCOUNT / EDIT PROFILE
    // ==========================================
    public function myAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        return view('teacher.my_account', $data);
    }

    public function updateMyAccount(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'marital_status' => 'nullable|string|max:50',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string',
            'permanent_address' => 'nullable|string',
            'qualification' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'date_of_birth.required' => 'Date of Birth is required.',
            'address.required' => 'Current Address is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already taken by another account.',
            'profile_pic.image' => 'The profile picture must be an image.',
            'profile_pic.mimes' => 'The profile picture must be a file of type: jpeg, png, jpg, webp.',
            'profile_pic.max' => 'The profile picture size must not exceed 2MB.',
            'mobile_number.min' => 'Mobile number must be at least 8 digits.',
            'mobile_number.max' => 'Mobile number cannot exceed 15 digits.',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = trim($request->date_of_birth);
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->email = trim($request->email);

        if (!empty($request->file('profile_pic'))) {
            if (!empty($teacher->profile_pic) && file_exists(public_path('upload/profile/' . $teacher->profile_pic))) {
                unlink(public_path('upload/profile/' . $teacher->profile_pic));
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $teacher->profile_pic = $filename;
        }

        $teacher->save();

        return redirect()->back()->with('success', "Account Successfully Updated");
    }
}
