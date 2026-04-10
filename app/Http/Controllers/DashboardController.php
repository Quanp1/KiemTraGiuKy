<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            // Tổng số khóa học và học viên [cite: 108-109]
            'total_courses' => Course::count(),
            'total_students' => Student::count(),
            
            // Tổng doanh thu (Join bảng enrollments và courses) [cite: 110]
            'total_revenue' => DB::table('enrollments')
                                ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                                ->sum('courses.price'),
            
            // Khóa học nhiều học viên nhất [cite: 111]
            'top_course' => Course::withCount('students')
                                ->orderBy('students_count', 'desc')
                                ->first(),
            
            // 5 khóa học mới [cite: 112]
            'latest_courses' => Course::latest()->take(5)->get() 
        ];

        return view('dashboard', compact('stats'));
    }
}