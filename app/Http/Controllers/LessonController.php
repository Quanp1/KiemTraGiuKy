<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Xử lý lưu bài học mới vào khóa học
     */
    public function store(Request $request, Course $course)
    {
        // Kiểm tra dữ liệu đầu vào (Đã bao gồm video_url)
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required',
            'video_url' => 'nullable|url', // Cho phép trống, nếu có phải là định dạng URL
            'order'     => 'required|integer|min:1'
        ], [
            'title.required' => 'Vui lòng nhập tên bài học.',
            'content.required' => 'Vui lòng nhập nội dung bài học.',
            'video_url.url'  => 'Đường dẫn video không hợp lệ (Phải bắt đầu bằng http:// hoặc https://).',
            'order.required' => 'Vui lòng nhập thứ tự bài học.'
        ]);

        // Tạo bài học mới liên kết với khóa học hiện tại
        $course->lessons()->create($request->all());

        return redirect()->back()->with('success', 'Thêm bài học thành công!');
    }

    /**
     * Xử lý xóa bài học
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();
        
        return redirect()->back()->with('success', 'Đã xóa bài học thành công.');
    }
}