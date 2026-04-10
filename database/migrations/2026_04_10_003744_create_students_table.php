<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên học viên [cite: 87]
            $table->string('email')->unique(); // Email định danh [cite: 88]
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('students');
    }
};