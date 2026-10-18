@extends('admin.layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Assign Subject</h3>
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
                            <h3 class="card-title fw-bold">Edit Assigned Subjects</h3>
                        </div>

                        @include('admin.layouts._message')

                        <form action="{{ url('admin/assign_subject/edit/'.$getRecord->id) }}" method="POST">
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
                                    <label class="form-label fw-semibold d-block">Subject Name <span class="text-danger">*</span></label>
                                    <div class="border rounded p-3 bg-light">
                                        @foreach($getSubject as $subject)
                                            @php
                                                $checked = "";
                                            @endphp
                                            @foreach($getAssignSubjectID as $subjectAssign)
                                                @if($subjectAssign->subject_id == $subject->id)
                                                    @php
                                                        $checked = "checked";
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="{{ $subject->id }}" name="subject_id[]" id="subject_{{ $subject->id }}" {{ $checked }}>
                                                <label class="form-check-label fw-medium" for="subject_{{ $subject->id }}">
                                                    {{ $subject->name }} <span class="text-muted small">({{ $subject->type }})</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
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
