<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    // กำหนดตารางที่โมเดลนี้ใช้
    protected $table = 'questions';

    // กำหนดฟิลด์ที่สามารถกำหนดค่าได้โดยใช้ Mass Assignment
    protected $fillable = [
        'course_id',
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer'
    ];

    /**
     * ความสัมพันธ์กับ Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * ความสัมพันธ์กับ Answers
     */
    public function answers()
    {
        return $this->hasMany(Answers::class);
    }
}
