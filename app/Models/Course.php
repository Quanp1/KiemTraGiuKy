<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes; // Khai báo sử dụng Soft Delete

    protected $fillable = [
        'name', 'slug', 'price', 'description', 'image', 'status'
    ];

    // 1 Course -> nhiều Lesson (hasMany) [cite: 66, 160]
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Quan hệ Many-to-Many với Student qua bảng enrollments [cite: 70, 162]
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id')
                    ->withTimestamps(); // Lưu thời gian tạo bản ghi trung gian
    }

    // --- CÁC SCOPE YÊU CẦU --- 
    
    // Lấy các khóa học đã xuất bản
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Lấy các khóa học trong khoảng giá
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }
    
}
