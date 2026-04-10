@extends('layouts.master')

@section('content')
<div class="mb-4">
    <h2>Danh sách Học viên theo Khóa học</h2>
</div>

<div class="row">
    @foreach ($courses as $course)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $course->name }}</h5>
                <span class="badge bg-light text-dark rounded-pill">{{ $course->students_count }} học viên</span>
            </div>
            
            <div class="card-body p-0">
                @if($course->students->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach ($course->students as $student)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $student->name }}</strong><br>
                                    <small class="text-muted">{{ $student->email }}</small>
                                </div>
                                <span class="text-muted text-sm">
                                    Ngày ĐK: {{ $student->pivot->created_at ? $student->pivot->created_at->format('d/m/Y') : 'N/A' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-3 text-center text-muted">
                        Chưa có học viên nào đăng ký khóa học này.
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection