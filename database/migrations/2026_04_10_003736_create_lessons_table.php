<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết tới bảng courses [cite: 66]
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Tiêu đề bài học [cite: 74]
            $table->text('content'); // Nội dung bài học [cite: 75]
            $table->string('video_url')->nullable(); // URL Video bài giảng [cite: 76]
            $table->integer('order')->default(0); // Thứ tự sắp xếp [cite: 77]
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('lessons');
    }
};
