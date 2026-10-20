@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Teacher List (Total : {{ $getRecord->total() }})</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add New Teacher
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
                    <h3 class="card-title fw-bold">Search Teacher</h3>
                </div>
                <form method="get" action="">
                    <div class="card-body">
                        <!-- Row 1 -->
                        <div class="row g-3 mb-3">
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
                                <label class="form-label fw-semibold">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ Request::get('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ Request::get('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ Request::get('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Mobile Number</label>
                                <input type="text" name="mobile_number" class="form-control" value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Marital Status</label>
                                <input type="text" name="marital_status" class="form-control" value="{{ Request::get('marital_status') }}" placeholder="Marital Status">
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row g-3 align-items-end">
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Current Address</label>
                                <input type="text" name="address" class="form-control" value="{{ Request::get('address') }}" placeholder="Current Address">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="100" {{ Request::get('status') == '100' ? 'selected' : '' }}>Active</option>
                                    <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Date Of Joining</label>
                                <input type="date" name="date_of_joining" class="form-control" value="{{ Request::get('date_of_joining') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Created Date</label>
                                <input type="date" name="date" class="form-control" value="{{ Request::get('date') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-search me-1"></i> Search
                                </button>
                                <a href="{{ url('admin/teacher/list') }}" class="btn btn-success">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Flash Message -->
            @include('admin.layouts._message')

            <!-- Teacher List Table Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Teacher List</h3>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-nowrap">
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
                                <th>Teacher Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Date Of Joining</th>
                                <th>Mobile Number</th>
                                <th>Marital Status</th>
                                <th>Current Address</th>
                                <th>Permanent Address</th>
                                <th>Qualification</th>
                                <th>Work Experience</th>
                                <th>Note</th>
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
                                    <td>{{ $value->gender }}</td>
                                    <td>
                                        @if(!empty($value->date_of_birth))
                                            {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($value->date_of_joining))
                                            {{ date('d-m-Y', strtotime($value->date_of_joining)) }}
                                        @endif
                                    </td>
                                    <td>{{ $value->mobile_number }}</td>
                                    <td>{{ $value->marital_status }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->permanent_address }}</td>
                                    <td>{{ $value->qualification }}</td>
                                    <td>{{ $value->work_experience }}</td>
                                    <td>{{ $value->note }}</td>
                                    <td>
                                        @if($value->status == 0)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ url('admin/teacher/edit/'.$value->id) }}" class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                        <a href="{{ url('admin/teacher/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this teacher?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="text-center text-muted py-4">No Teacher Found.</td>
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
