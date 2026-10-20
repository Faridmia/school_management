@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Account</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('student/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts._message')

                    <div class="card card-primary card-outline shadow-sm mb-4">
                        <form action="{{ url('student/account') }}" method="POST" enctype="multipart/form-data">
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

                                    <!-- Row 3: Caste & Religion -->
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

                                    <!-- Row 4: Mobile Number & Profile Pic -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number', $getRecord->mobile_number) }}" placeholder="Mobile Number">
                                        <div class="text-danger mt-1">{{ $errors->first('mobile_number') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Profile Pic</label>
                                        <input type="file" name="profile_pic" class="form-control @error('profile_pic') is-invalid @enderror">
                                        <div class="text-danger mt-1">{{ $errors->first('profile_pic') }}</div>
                                        @if(!empty($getRecord->getProfilePicUrl()))
                                            <div class="mt-2">
                                                <img src="{{ $getRecord->getProfilePicUrl() }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Row 5: Blood Group & Height -->
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

                                    <!-- Row 6: Weight -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Weight</label>
                                        <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $getRecord->weight) }}" placeholder="Weight">
                                        <div class="text-danger mt-1">{{ $errors->first('weight') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <!-- Empty spacer to match 2-column layout -->
                                    </div>

                                    <!-- Row 7: Email -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $getRecord->email) }}" placeholder="Email">
                                        <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
