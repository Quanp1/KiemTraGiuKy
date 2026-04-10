@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h2 class="h3">Dashboard Thống Kê</h2>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng số khóa học</h5>
                <h2 class="card-text">{{ $stats['total_courses'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng số học viên</h5>
                <h2 class="card-text">{{ $stats['total_students'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng doanh thu</h5>
                <h2 class="card-text">{{ number_format($stats['total_revenue'], 0, ',', '.') }} VNĐ</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Khóa học nhiều học viên nhất</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                @if($stats['top_course'])
                    <h4 class="text-primary">{{ $stats['top_course']->name }}</h4>
                    <p class="mb-1">Giá: <strong>{{ number_format($stats['top_course']->price, 0, ',', '.') }} VNĐ</strong></p>
                    <p class="mb-0 text-muted">Số lượng đăng ký: <span class="badge bg-success fs-6">{{ $stats['top_course']->students_count }} học viên</span></p>
                @else
                    <p class="text-muted">Chưa có dữ liệu</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">5 Khóa học mới nhất</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($stats['latest_courses'] as $course)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $course->name }}</strong><br>
                                <small class="text-muted">{{ $course->created_at->format('d/m/Y') }}</small>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ number_format($course->price, 0, ',', '.') }}đ</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">Chưa có khóa học nào</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection