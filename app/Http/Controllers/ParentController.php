<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;

class ParentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getParent();
        $data['header_title'] = "Parent List";
        return view('admin.parent.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Parent";
        return view('admin.parent.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'occupation' => 'nullable|string|max:255',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'address' => 'required|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:0,1',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'address.required' => 'Address is required.',
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

        $parent = new User;
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->occupation = trim($request->occupation);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->address = trim($request->address);
        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/profile/'), $filename);
            $parent->profile_pic = $filename;
        }

        $parent->save();

        return redirect('admin/parent/list')->with('success', "Parent Successfully Created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord']) && $data['getRecord']->user_type == 4) {
            $data['header_title'] = "Edit Parent";
            return view('admin.parent.edit', $data);
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
            'occupation' => 'nullable|string|max:255',
            'mobile_number' => 'nullable|string|min:8|max:15',
            'address' => 'required|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:0,1',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ], [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'gender.required' => 'Please select Gender.',
            'address.required' => 'Address is required.',
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

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->occupation = trim($request->occupation);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->address = trim($request->address);
        $parent->status = trim($request->status);
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

        return redirect('admin/parent/list')->with('success', "Parent Successfully Updated");
    }

    public function delete($id)
    {
        $parent = User::getSingle($id);
        if (!empty($parent)) {
            $parent->is_delete = 1;
            $parent->save();
            return redirect()->back()->with('success', "Parent Successfully Deleted");
        } else {
            abort(404);
        }
    }

    public function myStudent($id)
    {
        $data['getParent'] = User::getSingle($id);
        if (!empty($data['getParent']) && $data['getParent']->user_type == 4) {
            $data['parent_id'] = $id;
            $data['getSearchStudent'] = User::getSearchStudent();
            $data['getRecord'] = User::getMyStudent($id);
            $data['header_title'] = "Parent Student List";
            return view('admin.parent.my_student', $data);
        } else {
            abort(404);
        }
    }

    public function assignStudentParent($student_id, $parent_id)
    {
        $student = User::getSingle($student_id);
        if (!empty($student)) {
            $student->parent_id = $parent_id;
            $student->save();
            return redirect()->back()->with('success', "Student Successfully Assign");
        } else {
            abort(404);
        }
    }

    public function assignStudentParentDelete($student_id)
    {
        $student = User::getSingle($student_id);
        if (!empty($student)) {
            $student->parent_id = null;
            $student->save();
            return redirect()->back()->with('success', "Student Successfully Assign Deleted");
        } else {
            abort(404);
        }
    }
}
