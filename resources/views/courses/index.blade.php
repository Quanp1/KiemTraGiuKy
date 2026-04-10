@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Danh sách khóa học</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg"></i> Thêm khóa học mới
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">Ảnh</th>
                        <th>Tên khóa học</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Số bài học</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                    <tr>
                        <td class="ps-3">
                            <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://via.placeholder.com/50' }}" 
                                 class="rounded shadow-sm" alt="Course Image" style="width: 55px; height: 55px; object-fit: cover;">
                        </td>
                        
                        <td class="fw-bold text-primary">{{ $course->name }}</td>
                        
                        <td>{{ number_format($course->price, 0, ',', '.') }} VNĐ</td>
                        
                        <td>
                            <span class="badge {{ $course->status == 'published' ? 'bg-success' : 'bg-secondary' }} px-3 py-2">
                                {{ strtoupper($course->status) }}
                            </span>
                        </td>
                        
                        <td class="text-center">
                            <span class="badge bg-info text-white">{{ $course->lessons()->count() }} bài</span>
                        </td>
                        
                        <td class="text-center">
                            <div class="btn-group shadow-sm" role="group">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-info text-white" title="Xem & Quản lý bài học">
                                    <i class="bi bi-eye-fill"></i> Xem
                                </a>

                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning" title="Sửa khóa học">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>

                                <button type="button" class="btn btn-sm btn-danger" 
                                        onclick="if(confirm('Bạn có chắc chắn muốn xóa khóa học này?')) { document.getElementById('delete-form-{{ $course->id }}').submit(); }" 
                                        title="Xóa khóa học">
                                    <i class="bi bi-trash-fill"></i> Xóa
                                </button>
                            </div>

                            <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Chưa có khóa học nào trong hệ thống.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $courses->links() }}
</div>
@endsection