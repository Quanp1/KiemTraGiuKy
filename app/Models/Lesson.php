<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'content', 'video_url', 'order'];

    // 1 Bài học thuộc về 1 Khóa học
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}