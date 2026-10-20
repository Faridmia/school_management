@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Parent Student List ({{ $getParent->name }} {{ $getParent->last_name }})</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/parent/list') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Parent List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Search Student Card -->
            <div class="card card-outline card-primary shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Search Student</h3>
                </div>
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Student ID</label>
                                <input type="text" name="id" class="form-control" value="{{ Request::get('id') }}" placeholder="Student ID">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}" placeholder="Name">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ Request::get('last_name') }}" placeholder="Last Name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                                <a href="{{ url('admin/parent/my-student/'.$parent_id) }}" class="btn btn-success">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Flash Message -->
            @include('admin.layouts._message')

            <!-- Search Result: Student List Card -->
            @if(!empty($getSearchStudent))
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
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Parent Name</th>
                                    <th>Created Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getSearchStudent as $value)
                                    <tr class="text-nowrap">
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            @if(!empty($value->getProfilePicUrl()))
                                                <img src="{{ $value->getProfilePicUrl() }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $value->name }} {{ $value->last_name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>
                                            @if(!empty($value->parent_name))
                                                {{ $value->parent_name }} {{ $value->parent_last_name }}
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/parent/assign_student_parent/'.$value->id.'/'.$parent_id) }}" class="btn btn-primary btn-sm">
                                                Add Student to Parent
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">No Student Found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Parent Student List Card (Currently Assigned Students) -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Parent Student List</h3>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-nowrap">
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Parent Name</th>
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
                                    <td>
                                        @if(!empty($value->parent_name))
                                            {{ $value->parent_name }} {{ $value->parent_last_name }}
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/parent/assign_student_parent_delete/'.$value->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this student from this parent?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No Student Assigned to this Parent.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
