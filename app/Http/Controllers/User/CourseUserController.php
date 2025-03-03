<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Answers;
use Illuminate\Support\Facades\Auth;

class CourseUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = Course::latest()->paginate(10);

        foreach ($courses as $course) {
            $course->userHasAnswered = Answers::where('user_id', $user->id)
                ->whereHas('question', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })->exists();
        }

        return view('courses', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        $user = Auth::user();
        $course->userHasAnswered = Answers::where('user_id', $user->id)
            ->whereHas('question', function ($query) use ($course) {
                $query->where('course_id', $course->id);
            })->exists();
        return view('courses.show', compact('course'));
    }

    public function questions($id)
    {
        $course = Course::with('questions')->findOrFail($id);
        return view('courses.questions', compact('course'));
    }
}
