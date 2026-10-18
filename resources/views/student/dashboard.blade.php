@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Student Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('student/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Welcome Banner -->
            <div class="card card-outline card-primary shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3 text-primary fs-1">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Hello, <strong>{{ Auth::user()->name }}</strong>!</h4>
                            <p class="text-muted mb-0">Student Portal &bull; Check your class routine, registered subjects, attendance, and exam results.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- My Subjects -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-journal-bookmark"></i></h3>
                            <p class="mb-0">My Subjects</p>
                        </div>
                        <a href="{{ url('student/my_subject') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Subjects <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- My Timetable -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-calendar-week"></i></h3>
                            <p class="mb-0">My Timetable</p>
                        </div>
                        <a href="{{ url('student/my_timetable') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Schedule <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- My Attendance -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-clipboard-check"></i></h3>
                            <p class="mb-0">My Attendance</p>
                        </div>
                        <a href="{{ url('student/my_attendance') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Attendance <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- My Exam Result -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-award"></i></h3>
                            <p class="mb-0">My Exam Results</p>
                        </div>
                        <a href="{{ url('student/my_exam_result') }}" class="small-box-footer link-dark text-decoration-none mt-2 d-inline-block">
                            View Results <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
