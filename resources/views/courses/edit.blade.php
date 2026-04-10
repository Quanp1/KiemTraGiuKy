@extends('layouts.master')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-warning text-dark py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Sửa Khóa Học: {{ $course->name }}</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên khóa học</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Giá (VNĐ)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $course->price) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>Published (Xuất bản)</option>
                                <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>Draft (Bản nháp)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả khóa học</label>
                        <textarea name="description" class="form-control" rows="6" placeholder="Nhập nội dung mô tả chi tiết...">{{ old('description', $course->description) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ảnh hiện tại</label>
                        <div class="mb-2">
                            <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://via.placeholder.com/150' }}" 
                                 class="img-thumbnail shadow-sm" style="max-height: 200px; width: 100%; object-fit: cover;">
                        </div>
                        <label class="form-label fw-bold">Thay ảnh mới</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Định dạng: jpg, png. Tối đa 2MB.</small>
                    </div>
                </div>
            </div>

            <hr>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                    <i class="bi bi-save me-1"></i> Cập nhật khóa học
                </button>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4 py-2">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection