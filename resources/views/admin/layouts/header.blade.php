<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto align-items-center">
            @if(Auth::check())
                <li class="nav-item me-3">
                    <span class="text-secondary small me-1">Logged in as:</span>
                    <strong>{{ Auth::user()->name }}</strong>
                    <span class="badge ms-1 
                        @if(Auth::user()->user_type == 1) bg-danger
                        @elseif(Auth::user()->user_type == 2) bg-success
                        @elseif(Auth::user()->user_type == 3) bg-primary
                        @elseif(Auth::user()->user_type == 4) bg-warning text-dark
                        @endif">
                        @if(Auth::user()->user_type == 1) Admin
                        @elseif(Auth::user()->user_type == 2) Teacher
                        @elseif(Auth::user()->user_type == 3) Student
                        @elseif(Auth::user()->user_type == 4) Parent
                        @endif
                    </span>
                </li>
                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="btn btn-sm btn-outline-danger me-2">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="fullscreen" href="#" role="button"><i class="bi bi-arrows-fullscreen"></i></a>
            </li>
        </ul>
    </div>
</nav>
<!--end::Header-->

<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="
            @if(Auth::check())
                @if(Auth::user()->user_type == 1) {{ url('admin/dashboard') }}
                @elseif(Auth::user()->user_type == 2) {{ url('teacher/dashboard') }}
                @elseif(Auth::user()->user_type == 3) {{ url('student/dashboard') }}
                @elseif(Auth::user()->user_type == 4) {{ url('parent/dashboard') }}
                @endif
            @else
                {{ url('/') }}
            @endif
        " class="brand-link">
            <span class="brand-text fw-bold">
                @if(Auth::check())
                    @if(Auth::user()->user_type == 1) School Admin
                    @elseif(Auth::user()->user_type == 2) School Teacher
                    @elseif(Auth::user()->user_type == 3) School Student
                    @elseif(Auth::user()->user_type == 4) School Parent
                    @endif
                @else
                    School Management
                @endif
            </span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        @if(Auth::check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center px-3 border-bottom border-secondary">
                <div class="image me-2 text-white">
                    <i class="bi bi-person-circle fs-3"></i>
                </div>
                <div class="info">
                    <a href="#" class="d-block text-white text-decoration-none fw-semibold">{{ Auth::user()->name }}</a>
                    <span class="badge 
                        @if(Auth::user()->user_type == 1) bg-danger
                        @elseif(Auth::user()->user_type == 2) bg-success
                        @elseif(Auth::user()->user_type == 3) bg-primary
                        @elseif(Auth::user()->user_type == 4) bg-warning text-dark
                        @endif">
                        @if(Auth::user()->user_type == 1) Admin
                        @elseif(Auth::user()->user_type == 2) Teacher
                        @elseif(Auth::user()->user_type == 3) Student
                        @elseif(Auth::user()->user_type == 4) Parent
                        @endif
                    </span>
                </div>
            </div>
        @endif

        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                {{-- ============================================== --}}
                {{-- 1. ADMIN MENU (user_type == 1)                 --}}
                {{-- ============================================== --}}
                @if(Auth::check() && Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                            <i class="nav-icon bi bi-person-gear"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/teacher/list') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
                            <i class="nav-icon bi bi-person-badge"></i>
                            <p>Teacher</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                            <i class="nav-icon bi bi-mortarboard"></i>
                            <p>Student</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Parent</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                            <i class="nav-icon bi bi-building"></i>
                            <p>Class</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                            <i class="nav-icon bi bi-journal-bookmark"></i>
                            <p>Subject</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/assign_subject/list') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
                            <i class="nav-icon bi bi-journal-check"></i>
                            <p>Assign Subject</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/class_timetable/list') }}" class="nav-link @if(Request::segment(2) == 'class_timetable') active @endif">
                            <i class="nav-icon bi bi-calendar-week"></i>
                            <p>Class Timetable</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/attendance/student') }}" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                            <i class="nav-icon bi bi-clipboard-check"></i>
                            <p>Attendance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon bi bi-key"></i>
                            <p>Change Password</p>
                        </a>
                    </li>

                {{-- ============================================== --}}
                {{-- 2. TEACHER MENU (user_type == 2)               --}}
                {{-- ============================================== --}}
                @elseif(Auth::check() && Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a href="{{ url('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
                            <i class="nav-icon bi bi-mortarboard"></i>
                            <p>My Students</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_class_subject') }}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
                            <i class="nav-icon bi bi-journal-bookmark"></i>
                            <p>My Class & Subject</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_timetable') active @endif">
                            <i class="nav-icon bi bi-calendar-week"></i>
                            <p>My Timetable</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/attendance/student') }}" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                            <i class="nav-icon bi bi-clipboard-check"></i>
                            <p>Student Attendance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>My Account</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon bi bi-key"></i>
                            <p>Change Password</p>
                        </a>
                    </li>

                {{-- ============================================== --}}
                {{-- 3. STUDENT MENU (user_type == 3)               --}}
                {{-- ============================================== --}}
                @elseif(Auth::check() && Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_subject') }}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
                            <i class="nav-icon bi bi-journal-bookmark"></i>
                            <p>My Subjects</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_timetable') active @endif">
                            <i class="nav-icon bi bi-calendar-week"></i>
                            <p>My Timetable</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_attendance') }}" class="nav-link @if(Request::segment(2) == 'my_attendance') active @endif">
                            <i class="nav-icon bi bi-clipboard-check"></i>
                            <p>My Attendance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_exam_result') }}" class="nav-link @if(Request::segment(2) == 'my_exam_result') active @endif">
                            <i class="nav-icon bi bi-award"></i>
                            <p>My Exam Result</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>My Account</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon bi bi-key"></i>
                            <p>Change Password</p>
                        </a>
                    </li>

                {{-- ============================================== --}}
                {{-- 4. PARENT MENU (user_type == 4)                --}}
                {{-- ============================================== --}}
                @elseif(Auth::check() && Auth::user()->user_type == 4)
                    <li class="nav-item">
                        <a href="{{ url('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
                            <i class="nav-icon bi bi-people"></i>
                            <p>My Children</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/my_student/attendance') }}" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                            <i class="nav-icon bi bi-clipboard-check"></i>
                            <p>Child Attendance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/my_student/exam_result') }}" class="nav-link @if(Request::segment(2) == 'exam_result') active @endif">
                            <i class="nav-icon bi bi-award"></i>
                            <p>Child Exam Result</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>My Account</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                            <i class="nav-icon bi bi-key"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                @endif

                {{-- ============================================== --}}
                {{-- LOGOUT (All Roles)                             --}}
                {{-- ============================================== --}}
                <li class="nav-item mt-3 pt-3 border-top border-secondary">
                    <a href="{{ url('logout') }}" class="nav-link text-danger">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<!--end::Sidebar-->
