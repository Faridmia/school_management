@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Teacher Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('teacher/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Welcome Banner -->
            <div class="card card-outline card-success shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3 text-success fs-1">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Welcome back, <strong>{{ Auth::user()->name }}</strong>!</h4>
                            <p class="text-muted mb-0">Teacher Portal &bull; Here you can manage your students, class routines, subjects, and student attendance.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- My Students -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-mortarboard"></i></h3>
                            <p class="mb-0">My Students</p>
                        </div>
                        <a href="{{ url('teacher/my_student') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Students <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- My Class & Subject -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-journal-bookmark"></i></h3>
                            <p class="mb-0">My Class & Subject</p>
                        </div>
                        <a href="{{ url('teacher/my_class_subject') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Classes <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- My Timetable -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-calendar-week"></i></h3>
                            <p class="mb-0">My Timetable</p>
                        </div>
                        <a href="{{ url('teacher/my_timetable') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Schedule <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- Student Attendance -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-secondary p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-clipboard-check"></i></h3>
                            <p class="mb-0">Attendance</p>
                        </div>
                        <a href="{{ url('teacher/attendance/student') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            Mark Attendance <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
