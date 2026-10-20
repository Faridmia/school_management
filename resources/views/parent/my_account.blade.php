@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Parent</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('parent/dashboard') }}">Home</a></li>
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
                        <form action="{{ url('parent/account') }}" method="POST" enctype="multipart/form-data">
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

                                    <!-- Row 2: Gender & Occupation -->
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
                                        <label class="form-label fw-semibold">Occupation</label>
                                        <input type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ old('occupation', $getRecord->occupation) }}" placeholder="Occupation">
                                        <div class="text-danger mt-1">{{ $errors->first('occupation') }}</div>
                                    </div>

                                    <!-- Row 3: Mobile Number & Address -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number', $getRecord->mobile_number) }}" placeholder="Mobile Number">
                                        <div class="text-danger mt-1">{{ $errors->first('mobile_number') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $getRecord->address) }}" placeholder="Address">
                                        <div class="text-danger mt-1">{{ $errors->first('address') }}</div>
                                    </div>

                                    <!-- Row 4: Profile Pic & Status -->
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
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="0" {{ old('status', $getRecord->status) == '0' ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ old('status', $getRecord->status) == '1' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <div class="text-danger mt-1">{{ $errors->first('status') }}</div>
                                    </div>

                                    <!-- Row 5: Email -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $getRecord->email) }}" placeholder="Email">
                                        <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                                    </div>

                                    <!-- Row 6: Password -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                        <div class="form-text text-muted">Due you want to change password so Please add new password</div>
                                        <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
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
