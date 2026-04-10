<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot; // Sử dụng Pivot thay vì Model cho bảng trung gian

class Enrollment extends Pivot
{
    protected $table = 'enrollments';

    // Không cần định nghĩa thêm nhiều hàm ở đây trừ khi bạn muốn thêm các logic tính toán riêng cho đợt đăng ký
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
