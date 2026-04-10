<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Route Dashboard (Trang chủ thống kê)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 2. Routes Quản lý Khóa học
Route::resource('courses', CourseController::class);
// Route riêng để khôi phục khóa học bị xóa mềm (Soft Delete)
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');

// 3. Routes Quản lý Bài học (Lồng bên trong khóa học)
Route::resource('courses.lessons', LessonController::class)->shallow();

// 4. Routes Quản lý Đăng ký học viên (Enrollments)
// Hiển thị danh sách học viên theo từng khóa
Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');

// Hiển thị form đăng ký học viên mới
Route::get('enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');

// Xử lý lưu dữ liệu đăng ký (Post data)
Route::post('enrollments', [EnrollmentController::class, 'register'])->name('enrollments.register');

// Thêm route lồng nhau cho Lesson
Route::resource('courses.lessons', LessonController::class)->shallow()->only(['store', 'destroy']);