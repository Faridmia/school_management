@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Class List</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/class/add') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add New Class
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
                    <h3 class="card-title fw-bold">Search Class</h3>
                </div>
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}" placeholder="Name">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ Request::get('date') }}">
                            </div>
                            <div class="col-md-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search me-1"></i> Search
                                </button>
                                <a href="{{ url('admin/class/list') }}" class="btn btn-success">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Flash Message -->
            @include('admin.layouts._message')

            <!-- Class List Table Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Class List</h3>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td class="fw-semibold">{{ $value->name }}</td>
                                    <td>
                                        @if($value->status == 0)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_by_name ?? 'N/A' }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/class/edit/'.$value->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="{{ url('admin/class/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this class?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No Class Found.</td>
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
