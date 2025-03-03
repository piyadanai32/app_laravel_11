<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questions;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Questions::latest()->paginate(10); // ดึงข้อมูลและแบ่งหน้า
        return view('admin.questions', compact('questions')); // ส่งข้อมูลไปยัง View
    }

    public function create()
    {
        return view('admin.questions.create'); // แสดงฟอร์มสร้างคำถามใหม่
    }
}
