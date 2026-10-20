@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Parent List (Total : {{ $getRecord->total() }})</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add New Parent
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
                    <h3 class="card-title fw-bold">Search Parent</h3>
                </div>
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}" placeholder="Name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ Request::get('date') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                                <a href="{{ url('admin/parent/list') }}" class="btn btn-success">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Flash Message -->
            @include('admin.layouts._message')

            <!-- Parent List Table Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Parent List</h3>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light text-nowrap">
                            <tr>
                                <th>#</th>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Mobile Number</th>
                                <th>Occupation</th>
                                <th>Address</th>
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
                                    <td>{{ $value->mobile_number }}</td>
                                    <td>{{ $value->occupation }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>
                                        @if($value->status == 0)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ url('admin/parent/my-student/'.$value->id) }}" class="btn btn-sm btn-info text-white">
                                            My Student
                                        </a>
                                        <a href="{{ url('admin/parent/edit/'.$value->id) }}" class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                        <a href="{{ url('admin/parent/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this parent?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted py-4">No Parent Found.</td>
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
