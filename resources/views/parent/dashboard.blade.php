@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Parent Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('parent/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Welcome Banner -->
            <div class="card card-outline card-warning shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3 text-warning fs-1">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">Welcome, <strong>{{ Auth::user()->name }}</strong>!</h4>
                            <p class="text-muted mb-0">Parent Portal &bull; Monitor your children's academic performance, class timetable, daily attendance, and exam grades.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- My Children -->
                <div class="col-lg-4 col-6">
                    <div class="small-box text-bg-warning p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-person-hearts"></i></h3>
                            <p class="mb-0">My Children</p>
                        </div>
                        <a href="{{ url('parent/my_student') }}" class="small-box-footer link-dark text-decoration-none mt-2 d-inline-block">
                            View Children <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- Child Attendance -->
                <div class="col-lg-4 col-6">
                    <div class="small-box text-bg-success p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-clipboard-check"></i></h3>
                            <p class="mb-0">Child Attendance</p>
                        </div>
                        <a href="{{ url('parent/my_student/attendance') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Attendance <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <!-- Child Exam Result -->
                <div class="col-lg-4 col-6">
                    <div class="small-box text-bg-info p-3 rounded mb-4 shadow-sm">
                        <div class="inner">
                            <h3 class="fw-bold"><i class="bi bi-award"></i></h3>
                            <p class="mb-0">Child Exam Results</p>
                        </div>
                        <a href="{{ url('parent/my_student/exam_result') }}" class="small-box-footer link-light text-decoration-none mt-2 d-inline-block">
                            View Results <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
