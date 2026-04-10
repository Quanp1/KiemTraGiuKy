@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Chi tiết Khóa Học</h2>
    <div>
        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Sửa khóa học</a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại danh sách</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="Image" class="rounded me-4" style="width: 150px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded me-4 d-flex align-items-center justify-content-center text-muted" style="width: 150px; height: 100px;">
                            Không có ảnh
                        </div>
                    @endif
                    
                    <div>
                        <h3 class="mb-2 text-primary">{{ $course->name }}</h3>
                        <p class="mb-2 text-dark fs-5">Giá: <strong>{{ number_format($course->price, 0, ',', '.') }} VNĐ</strong></p>
                        <span class="badge {{ $course->status == 'published' ? 'bg-success' : 'bg-secondary' }} fs-6">
                            {{ $course->status == 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                        </span>
                    </div>
                </div>
                <hr>
                <div class="mt-4">
    <h5 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Mô tả chi tiết:</h5>
    <div class="p-3 bg-light rounded border">
        @if(!empty($course->description))
            {!! nl2br(e($course->description)) !!}
        @else
            <span class="text-muted fst-italic">Khóa học này chưa có nội dung mô tả chi tiết.</span>
        @endif
    </div>
</div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i> Danh sách bài học ({{ $course->lessons->count() }})</h5>
            </div>
            <div class="card-body p-0">
                @if($course->lessons->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($course->lessons as $lesson)
                            <li class="list-group-item d-flex justify-content-between align-items-start py-3">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold fs-5 mb-1">
                                        <span class="badge bg-primary me-2">Bài {{ $lesson->order }}</span>
                                        {{ $lesson->title }}
                                    </div>
                                    <div class="text-muted mb-2" style="font-size: 0.95rem;">
                                        {{ Str::limit($lesson->content, 120) }}
                                    </div>
                                    
                                    @if($lesson->video_url)
                                        <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-play-circle-fill me-1"></i> Xem Video Bài Giảng
                                        </a>
                                    @else
                                        <span class="text-muted fst-italic" style="font-size: 0.85rem;">(Không có video)</span>
                                    @endif
                                </div>
                                
                                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài học này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger ms-3" title="Xóa bài học"><i class="bi bi-trash"></i></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-5 text-center text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        Khóa học này chưa có bài học nào. Hãy thêm bài học ở form bên cạnh nhé!
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-primary sticky-top" style="top: 20px;">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Thêm Bài Học Mới</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('courses.lessons.store', $course->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên bài học <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="VD: Bài 1: Giới thiệu..." required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Thứ tự (Order) <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ old('order', $course->lessons->count() + 1) }}" required>
                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Video URL</label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" name="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/...">
                        @error('video_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Link video bài giảng (không bắt buộc).</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5" placeholder="Nhập tóm tắt nội dung bài học..." required>{{ old('content') }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100 fw-bold fs-5"><i class="bi bi-save me-2"></i> Lưu Bài Học</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection