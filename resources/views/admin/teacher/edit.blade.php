@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Teacher</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/teacher/list') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Teacher List
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
                            <h3 class="card-title fw-bold">Edit Teacher Details</h3>
                        </div>

                        @include('admin.layouts._message')

                        <form action="{{ url('admin/teacher/edit/'.$getRecord->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <!-- Row 1: First Name & Last Name -->
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

                                    <!-- Row 2: Gender & Date of Birth -->
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

                                    <!-- Row 3: Date Of Joining & Mobile Number -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Date Of Joining <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_joining" class="form-control @error('date_of_joining') is-invalid @enderror" value="{{ old('date_of_joining', $getRecord->date_of_joining) }}">
                                        <div class="text-danger mt-1">{{ $errors->first('date_of_joining') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number', $getRecord->mobile_number) }}" placeholder="Mobile Number">
                                        <div class="text-danger mt-1">{{ $errors->first('mobile_number') }}</div>
                                    </div>

                                    <!-- Row 4: Marital Status & Profile Pic -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Marital Status</label>
                                        <input type="text" name="marital_status" class="form-control @error('marital_status') is-invalid @enderror" value="{{ old('marital_status', $getRecord->marital_status) }}" placeholder="Marital Status">
                                        <div class="text-danger mt-1">{{ $errors->first('marital_status') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Profile Pic</label>
                                        <input type="file" name="profile_pic" class="form-control @error('profile_pic') is-invalid @enderror">
                                        <div class="text-danger mt-1">{{ $errors->first('profile_pic') }}</div>
                                        @if(!empty($getRecord->getProfilePicUrl()))
                                            <div class="mt-2">
                                                <img src="{{ $getRecord->getProfilePicUrl() }}" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Row 5: Current Address & Permanent Address -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Current Address <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Current Address">{{ old('address', $getRecord->address) }}</textarea>
                                        <div class="text-danger mt-1">{{ $errors->first('address') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Permanent Address</label>
                                        <textarea name="permanent_address" class="form-control @error('permanent_address') is-invalid @enderror" rows="3" placeholder="Permanent Address">{{ old('permanent_address', $getRecord->permanent_address) }}</textarea>
                                        <div class="text-danger mt-1">{{ $errors->first('permanent_address') }}</div>
                                    </div>

                                    <!-- Row 6: Qualification & Work Experience -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Qualification</label>
                                        <textarea name="qualification" class="form-control @error('qualification') is-invalid @enderror" rows="3" placeholder="Qualification">{{ old('qualification', $getRecord->qualification) }}</textarea>
                                        <div class="text-danger mt-1">{{ $errors->first('qualification') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Work Experience</label>
                                        <textarea name="work_experience" class="form-control @error('work_experience') is-invalid @enderror" rows="3" placeholder="Work Experience">{{ old('work_experience', $getRecord->work_experience) }}</textarea>
                                        <div class="text-danger mt-1">{{ $errors->first('work_experience') }}</div>
                                    </div>

                                    <!-- Row 7: Note & Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Note</label>
                                        <textarea name="note" class="form-control @error('note') is-invalid @enderror" rows="3" placeholder="Note">{{ old('note', $getRecord->note) }}</textarea>
                                        <div class="text-danger mt-1">{{ $errors->first('note') }}</div>
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
                                    <!-- Row 8: Email -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $getRecord->email) }}" placeholder="Email">
                                        <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                                    </div>

                                    <!-- Row 9: Password -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                        <div class="form-text text-muted">Do you want to change password so Please add new password</div>
                                        <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ url('admin/teacher/list') }}" class="btn btn-outline-secondary">Cancel</a>
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
