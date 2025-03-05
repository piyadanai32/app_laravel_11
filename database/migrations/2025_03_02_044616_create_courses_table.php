<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable(); // รูปปกคอร์ส
            $table->string('youtube_link')->nullable(); // วีดีโอเรียน
            $table->string('file_path')->nullable(); // ไฟล์คอร์ส
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ผู้สอน
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
