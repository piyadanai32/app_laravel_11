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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ใครเป็นคนตอบ
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); // ตอบคำถามข้อไหน
            $table->enum('selected_answer', ['a', 'b', 'c', 'd']); // คำตอบที่ผู้ใช้เลือก
            $table->boolean('is_correct')->default(false); // ตรวจสอบว่าถูกต้องหรือไม่
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
