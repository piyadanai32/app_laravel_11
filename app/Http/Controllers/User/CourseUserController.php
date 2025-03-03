<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseUserController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10); // ดึงข้อมูลและแบ่งหน้า
        return view('courses', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }
}
