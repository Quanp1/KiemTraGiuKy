<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\CourseRequest; // Chứa logic Validation
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // 1. Danh sách khóa học
    public function index(Request $request)
    {
        // Khởi tạo query và tối ưu N+1 
        $query = Course::withCount('lessons') // Đếm số bài học [cite: 57]
                       ->with(['lessons', 'students']); // Nạp trước quan hệ

        // Xử lý Tìm kiếm nâng cao [cite: 114-118]
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc và sắp xếp theo ngày tạo
        $courses = $query->latest()->paginate(10); // Phân trang [cite: 56]

        return view('courses.index', compact('courses'));
    }

    // 2. Form thêm khóa học
    public function create()
    {
        return view('courses.create');
    }

    // 3. Xử lý lưu khóa học
    public function store(CourseRequest $request) // Sử dụng Form Request [cite: 133-135]
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name); // Tự sinh slug [cite: 38]

        // Xử lý upload ảnh [cite: 47]
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
    }

    // 4. Form sửa khóa học
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course')); // Sẽ hiển thị lại dữ liệu cũ [cite: 60]
    }

    // 5. Cập nhật khóa học
    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa mềm [cite: 62]
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Đã chuyển khóa học vào thùng rác.');
    }

    // 7. Khôi phục khóa học [cite: 63]
    public function restore($id)
    {
        Course::withTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('success', 'Khôi phục khóa học thành công.');
    }

    public function show(Course $course)
    {
        // Nạp khóa học kèm bài học, sắp xếp bài học theo cột order
        $course->load(['lessons' => function($query) {
            $query->orderBy('order', 'asc');
        }]);

        return view('courses.show', compact('course'));
    }
}
