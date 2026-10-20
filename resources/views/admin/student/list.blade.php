@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Student List (Total : {{ $getRecord->total() }})</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/student/add') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add New Student
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Search / Filter Card -->
            <div class="card card-outline card-primary shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Search Student</h3>
                </div>
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}" placeholder="Name">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ Request::get('last_name') }}" placeholder="Last Name">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Admission Number</label>
                                <input type="text" name="admission_number" class="form-control" value="{{ Request::get('admission_number') }}" placeholder="Admission Number">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Roll Number</label>
                                <input type="text" name="roll_number" class="form-control" value="{{ Request::get('roll_number') }}" placeholder="Roll Number">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Class</label>
                                <input type="text" name="class" class="form-control" value="{{ Request::get('class') }}" placeholder="Class">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ Request::get('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ Request::get('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ Request::get('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ Request::get('date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                                <a href="{{ url('admin/student/list') }}" class="btn btn-success">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Flash Message -->
            @include('admin.layouts._message')

            <!-- Student List Table Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Student List</h3>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-nowrap">
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Admission Number</th>
                                <th>Roll Number</th>
                                <th>Class</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Caste</th>
                                <th>Religion</th>
                                <th>Mobile Number</th>
                                <th>Admission Date</th>
                                <th>Blood Group</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($getRecord as $value)
                                <tr class="text-nowrap">
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        @if(!empty($value->getProfilePicUrl()))
                                            <img src="{{ $value->getProfilePicUrl() }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $value->name }} {{ $value->last_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->admission_number }}</td>
                                    <td>{{ $value->roll_number }}</td>
                                    <td>{{ $value->class_name }}</td>
                                    <td>{{ $value->gender }}</td>
                                    <td>
                                        @if(!empty($value->date_of_birth))
                                            {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                        @endif
                                    </td>
                                    <td>{{ $value->caste }}</td>
                                    <td>{{ $value->religion }}</td>
                                    <td>{{ $value->mobile_number }}</td>
                                    <td>
                                        @if(!empty($value->admission_date))
                                            {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                        @endif
                                    </td>
                                    <td>{{ $value->blood_group }}</td>
                                    <td>{{ $value->height }}</td>
                                    <td>{{ $value->weight }}</td>
                                    <td>
                                        @if($value->status == 0)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/student/edit/'.$value->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="{{ url('admin/student/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="19" class="text-center text-muted py-4">No Student Found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($getRecord->hasPages())
                    <div class="card-footer clearfix">
                        <div class="float-end">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
