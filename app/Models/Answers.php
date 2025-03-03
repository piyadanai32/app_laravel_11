<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    // กำหนดตารางที่โมเดลนี้ใช้
    protected $table = 'answers';

    // กำหนดฟิลด์ที่สามารถกำหนดค่าได้โดยใช้ Mass Assignment
    protected $fillable = [
        'user_id',
        'question_id',
        'selected_answer',
        'is_correct'
    ];

    /**
     * ความสัมพันธ์กับ User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ความสัมพันธ์กับ Question
     */
    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
}
