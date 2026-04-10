<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Hiển thị danh sách học viên theo từng khóa học [cite: 89-91]
     */
    public function index()
    {
        // Lấy tất cả khóa học, kèm theo danh sách học viên và đếm tổng số học viên
        $courses = Course::with('students')->withCount('students')->get();
        
        return view('enrollments.index', compact('courses'));
    }

    /**
     * Hiển thị form đăng ký khóa học [cite: 83-85]
     */
    public function create()
    {
        // Chỉ lấy những khóa học đang ở trạng thái "published" (đã xuất bản) để đăng ký
        $courses = Course::where('status', 'published')->get(); 
        
        return view('enrollments.create', compact('courses'));
    }

    /**
     * Xử lý lưu thông tin đăng ký học viên [cite: 86-88]
     */
    public function register(Request $request)
    {
        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email'
        ], [
            // Tùy chỉnh câu thông báo lỗi bằng tiếng Việt
            'course_id.required' => 'Vui lòng chọn khóa học.',
            'name.required'      => 'Vui lòng nhập tên học viên.',
            'email.required'     => 'Vui lòng nhập email hợp lệ.',
        ]);

        // 2. Tìm học viên trong DB bằng email, nếu chưa có thì tạo mới (firstOrCreate)
        $student = Student::firstOrCreate(
            ['email' => $request->email], // Cột dùng để tìm kiếm
            ['name'  => $request->name]   // Dữ liệu dùng để tạo mới nếu không tìm thấy
        );

        // 3. Gắn học viên vào khóa học qua bảng enrollments
        // Dùng syncWithoutDetaching để nếu học viên đã đăng ký khóa này rồi thì không bị lỗi trùng lặp
        $student->courses()->syncWithoutDetaching([$request->course_id]);

        // 4. Chuyển hướng về trang danh sách và báo thành công
        return redirect()->route('enrollments.index')
                         ->with('success', 'Đăng ký khóa học thành công cho học viên: ' . $student->name);
    }
}