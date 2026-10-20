<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{
    // ====================================================
    // MY ACCOUNT (Common route for all roles)
    // ====================================================
    public function MyAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";

        if (Auth::user()->user_type == 1) {
            return view('admin.my_account', $data);
        } else if (Auth::user()->user_type == 2) {
            return view('teacher.my_account', $data);
        } else if (Auth::user()->user_type == 3) {
            return view('student.my_account', $data);
        } else if (Auth::user()->user_type == 4) {
            return view('parent.my_account', $data);
        } else {
            abort(404);
        }
    }

    // ====================================================
    // 1. ADMIN UPDATE MY ACCOUNT
    // ====================================================
    public function UpdateMyAccountAdmin(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
        ]);

        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        $admin->save();

        return redirect()->back()->with('success', "Account Successfully Updated");
    }

    // ====================================================
    // 2. TEACHER UPDATE MY ACCOUNT
    // ====================================================
    public function UpdateMyAccount(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'nullable|date',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'marital_status' => 'nullable|string|max:50',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'address' => 'required|string',
            'permanent_address' => 'nullable|string',
            'qualification' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'note' => 'nullable|string',
            'status' => 'nullable|in:0,1',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'date_of_birth.required' => 'Date of Birth is required.',
            'address.required' => 'Current Address is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'profile_pic.image' => 'The profile picture must be an image.',
            'profile_pic.max' => 'The profile picture size must not exceed 2MB.',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->date_of_birth = trim($request->date_of_birth);
        if ($request->has('date_of_joining')) {
            $teacher->date_of_joining = trim($request->date_of_joining);
        }
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        if ($request->has('note')) {
            $teacher->note = trim($request->note);
        }
        if ($request->has('status') && $request->status !== null) {
            $teacher->status = trim($request->status);
        }
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

    // ====================================================
    // 3. STUDENT UPDATE MY ACCOUNT
    // ====================================================
    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'caste' => 'nullable|string|max:50',
            'religion' => 'nullable|string|max:50',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'blood_group' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'date_of_birth.required' => 'Date of Birth is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'profile_pic.image' => 'The profile picture must be an image.',
            'profile_pic.max' => 'The profile picture size must not exceed 2MB.',
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->date_of_birth = trim($request->date_of_birth);
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->email = trim($request->email);

        if (!empty($request->file('profile_pic'))) {
            if (!empty($student->profile_pic) && file_exists(public_path('upload/profile/' . $student->profile_pic))) {
                unlink(public_path('upload/profile/' . $student->profile_pic));
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $student->profile_pic = $filename;
        }

        $student->save();

        return redirect()->back()->with('success', "Account Successfully Updated");
    }

    // ====================================================
    // 4. PARENT UPDATE MY ACCOUNT
    // ====================================================
    public function UpdateMyAccountParent(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'occupation' => 'nullable|string|max:255',
            'mobile_number' => 'required|string|min:8|max:15',
            'address' => 'required|string',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'nullable|in:0,1',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'mobile_number.required' => 'Mobile Number is required.',
            'address.required' => 'Address is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'password.min' => 'Password must be at least 6 characters.',
            'profile_pic.image' => 'The profile picture must be an image.',
            'profile_pic.max' => 'The profile picture size must not exceed 2MB.',
        ]);

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->occupation = trim($request->occupation);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->address = trim($request->address);
        if ($request->has('status') && $request->status !== null) {
            $parent->status = trim($request->status);
        }
        $parent->email = trim($request->email);

        if (!empty($request->password)) {
            $parent->password = Hash::make($request->password);
        }

        if (!empty($request->file('profile_pic'))) {
            if (!empty($parent->profile_pic) && file_exists(public_path('upload/profile/' . $parent->profile_pic))) {
                unlink(public_path('upload/profile/' . $parent->profile_pic));
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $parent->profile_pic = $filename;
        }

        $parent->save();

        return redirect()->back()->with('success', "Account Successfully Updated");
    }
}
