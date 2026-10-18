@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Admin Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Total Admins -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalAdmin ?? 0 }}</h3>
                            <p class="mb-0">Total Admins</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-gear fs-1 opacity-50"></i>
                        </div>
                        <a href="{{ url('admin/admin/list') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            More info <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Teachers -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalTeacher ?? 0 }}</h3>
                            <p class="mb-0">Total Teachers</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-badge fs-1 opacity-50"></i>
                        </div>
                        <a href="{{ url('admin/teacher/list') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            More info <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Students -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalStudent ?? 0 }}</h3>
                            <p class="mb-0">Total Students</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-mortarboard fs-1 opacity-50"></i>
                        </div>
                        <a href="{{ url('admin/student/list') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            More info <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Parents -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalParent ?? 0 }}</h3>
                            <p class="mb-0">Total Parents</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-people fs-1 opacity-50"></i>
                        </div>
                        <a href="{{ url('admin/parent/list') }}" class="small-box-footer link-dark text-decoration-none mt-2 d-inline-block">
                            More info <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="card card-outline card-primary shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-info-circle me-1"></i> Welcome to School Management System</h3>
                </div>
                <div class="card-body">
                    <h5>Hello, <strong>{{ Auth::user()->name }}</strong> (Super Admin)!</h5>
                    <p class="text-muted">You have full access to manage school administrators, teachers, students, parents, classes, subjects, timetables, and attendance.</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
