<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Hash;
use Auth;
use Str;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('admin.student.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";
        return view('admin.student.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'admission_number' => 'required|string|max:50',
            'roll_number' => 'nullable|string|max:50',
            'class_id' => 'required|integer',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'caste' => 'nullable|string|max:50',
            'religion' => 'nullable|string|max:50',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'admission_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'blood_group' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'status' => 'required|in:0,1',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'admission_number.required' => 'Admission Number is required.',
            'class_id.required' => 'Please select a Class.',
            'gender.required' => 'Please select Gender.',
            'date_of_birth.required' => 'Date of Birth is required.',
            'admission_date.required' => 'Admission Date is required.',
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

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);

        if (!empty($request->admission_date)) {
            $student->admission_date = trim($request->admission_date);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $student->profile_pic = $filename;
        }

        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        return redirect('admin/student/list')->with('success', "Student Successfully Created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord']) && $data['getRecord']->user_type == 3) {
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = "Edit Student";
            return view('admin.student.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'admission_number' => 'required|string|max:50',
            'roll_number' => 'nullable|string|max:50',
            'class_id' => 'required|integer',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'caste' => 'nullable|string|max:50',
            'religion' => 'nullable|string|max:50',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'admission_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'blood_group' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'status' => 'required|in:0,1',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'admission_number.required' => 'Admission Number is required.',
            'class_id.required' => 'Please select a Class.',
            'gender.required' => 'Please select Gender.',
            'date_of_birth.required' => 'Date of Birth is required.',
            'admission_date.required' => 'Admission Date is required.',
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

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);

        if (!empty($request->admission_date)) {
            $student->admission_date = trim($request->admission_date);
        }

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

        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);

        if (!empty($request->password)) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect('admin/student/list')->with('success', "Student Successfully Updated");
    }

    public function delete($id)
    {
        $student = User::getSingle($id);
        if (!empty($student)) {
            $student->is_delete = 1;
            $student->save();
            return redirect()->back()->with('success', "Student Successfully Deleted");
        } else {
            abort(404);
        }
    }
}
