@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Student</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/student/list') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Student List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Edit Student Details</h3>
                        </div>

                        @include('admin.layouts._message')

                        <form action="{{ url('admin/student/edit/'.$getRecord->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $getRecord->name) }}" placeholder="First Name">
                                        <div class="text-danger mt-1">{{ $errors->first('name') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $getRecord->last_name) }}" placeholder="Last Name">
                                        <div class="text-danger mt-1">{{ $errors->first('last_name') }}</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Admission Number <span class="text-danger">*</span></label>
                                        <input type="text" name="admission_number" class="form-control @error('admission_number') is-invalid @enderror" value="{{ old('admission_number', $getRecord->admission_number) }}" placeholder="Admission Number">
                                        <div class="text-danger mt-1">{{ $errors->first('admission_number') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Roll Number</label>
                                        <input type="text" name="roll_number" class="form-control @error('roll_number') is-invalid @enderror" value="{{ old('roll_number', $getRecord->roll_number) }}" placeholder="Roll Number">
                                        <div class="text-danger mt-1">{{ $errors->first('roll_number') }}</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Class <span class="text-danger">*</span></label>
                                        <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                                            <option value="">Select Class</option>
                                            @foreach($getClass as $class)
                                                <option value="{{ $class->id }}" {{ old('class_id', $getRecord->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger mt-1">{{ $errors->first('class_id') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender', $getRecord->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', $getRecord->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender', $getRecord->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <div class="text-danger mt-1">{{ $errors->first('gender') }}</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}">
                                        <div class="text-danger mt-1">{{ $errors->first('date_of_birth') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Caste</label>
                                        <input type="text" name="caste" class="form-control @error('caste') is-invalid @enderror" value="{{ old('caste', $getRecord->caste) }}" placeholder="Caste">
                                        <div class="text-danger mt-1">{{ $errors->first('caste') }}</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Religion</label>
                                        <input type="text" name="religion" class="form-control @error('religion') is-invalid @enderror" value="{{ old('religion', $getRecord->religion) }}" placeholder="Religion">
                                        <div class="text-danger mt-1">{{ $errors->first('religion') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number', $getRecord->mobile_number) }}" placeholder="Mobile Number">
                                        <div class="text-danger mt-1">{{ $errors->first('mobile_number') }}</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Admission Date <span class="text-danger">*</span></label>
                                        <input type="date" name="admission_date" class="form-control @error('admission_date') is-invalid @enderror" value="{{ old('admission_date', $getRecord->admission_date) }}">
                                        <div class="text-danger mt-1">{{ $errors->first('admission_date') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Profile Pic</label>
                                        <input type="file" name="profile_pic" class="form-control @error('profile_pic') is-invalid @enderror">
                                        <div class="text-danger mt-1">{{ $errors->first('profile_pic') }}</div>
                                        @if(!empty($getRecord->getProfilePicUrl()))
                                            <div class="mt-2">
                                                <img src="{{ $getRecord->getProfilePicUrl() }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Blood Group</label>
                                        <input type="text" name="blood_group" class="form-control @error('blood_group') is-invalid @enderror" value="{{ old('blood_group', $getRecord->blood_group) }}" placeholder="Blood Group">
                                        <div class="text-danger mt-1">{{ $errors->first('blood_group') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Height</label>
                                        <input type="text" name="height" class="form-control @error('height') is-invalid @enderror" value="{{ old('height', $getRecord->height) }}" placeholder="Height">
                                        <div class="text-danger mt-1">{{ $errors->first('height') }}</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Weight</label>
                                        <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $getRecord->weight) }}" placeholder="Weight">
                                        <div class="text-danger mt-1">{{ $errors->first('weight') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            <option value="0" {{ old('status', $getRecord->status) == '0' ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ old('status', $getRecord->status) == '1' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <div class="text-danger mt-1">{{ $errors->first('status') }}</div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $getRecord->email) }}" placeholder="Email">
                                        <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Password <small class="text-muted">(Leave blank if you don't want to change)</small></label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                        <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ url('admin/student/list') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
