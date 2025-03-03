<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    /**
     * แสดงรายการคอร์สทั้งหมด
     */
    public function index()
    {
        $courses = Course::latest()->paginate(10); // ดึงข้อมูลและแบ่งหน้า
        return view('admin.courses', compact('courses'));
    }

    /**
     * แสดงฟอร์มสร้างคอร์สใหม่
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * บันทึกข้อมูลคอร์สใหม่
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_link' => 'nullable|string',
        ]);

        // อัปโหลดไฟล์รูปภาพ
        $thumbnailPath = $request->file('thumbnail')->store('courses', 'public');

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'youtube_link' => $request->youtube_link,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('admin.courses')->with('success', 'คอร์สถูกสร้างเรียบร้อยแล้ว!');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_link' => 'nullable|string',
        ]);

        $course = Course::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses', 'public');
            $course->thumbnail = $thumbnailPath;
        }

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'youtube_link' => $request->youtube_link,
        ]);

        return redirect()->route('admin.courses')->with('success', 'คอร์สถูกแก้ไขเรียบร้อยแล้ว!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'คอร์สถูกลบเรียบร้อยแล้ว!');
    }
}
