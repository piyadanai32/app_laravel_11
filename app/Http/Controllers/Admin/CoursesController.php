<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Questions;

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
            'questions.*.question_text' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_answer' => 'required|string|in:a,b,c,d',
        ]);

        // อัปโหลดไฟล์รูปภาพ
        $thumbnailPath = $request->file('thumbnail')->store('courses', 'public');

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'youtube_link' => $request->youtube_link,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($request->questions as $question) {
            Questions::create([
                'course_id' => $course->id,
                'question_text' => $question['question_text'],
                'option_a' => $question['option_a'],
                'option_b' => $question['option_b'],
                'option_c' => $question['option_c'],
                'option_d' => $question['option_d'],
                'correct_answer' => $question['correct_answer'],
            ]);
        }

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
            'questions.*.question_text' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_answer' => 'required|string|in:a,b,c,d',
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

        foreach ($request->questions as $index => $question) {
            $questionModel = Questions::find($index);
            if ($questionModel) {
                $questionModel->update([
                    'question_text' => $question['question_text'],
                    'option_a' => $question['option_a'],
                    'option_b' => $question['option_b'],
                    'option_c' => $question['option_c'],
                    'option_d' => $question['option_d'],
                    'correct_answer' => $question['correct_answer'],
                ]);
            } else {
                Questions::create([
                    'course_id' => $course->id,
                    'question_text' => $question['question_text'],
                    'option_a' => $question['option_a'],
                    'option_b' => $question['option_b'],
                    'option_c' => $question['option_c'],
                    'option_d' => $question['option_d'],
                    'correct_answer' => $question['correct_answer'],
                ]);
            }
        }

        return redirect()->route('admin.courses')->with('success', 'คอร์สถูกแก้ไขเรียบร้อยแล้ว!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'คอร์สถูกลบเรียบร้อยแล้ว!');
    }
}
