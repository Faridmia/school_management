@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Single Assign Subject</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary card-outline shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Edit Single Assignment</h3>
                        </div>

                        @include('admin.layouts._message')

                        <form action="{{ url('admin/assign_subject/edit_single/'.$getRecord->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Class Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="class_id" required>
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                            <option value="{{ $class->id }}" {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Subject Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="subject_id" required>
                                        <option value="">Select Subject</option>
                                        @foreach($getSubject as $subject)
                                            <option value="{{ $subject->id }}" {{ ($getRecord->subject_id == $subject->id) ? 'selected' : '' }}>
                                                {{ $subject->name }} ({{ $subject->type }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0" {{ ($getRecord->status == 0) ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ ($getRecord->status == 1) ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
