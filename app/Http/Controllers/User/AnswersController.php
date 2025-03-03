<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\Questions;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function submit(Request $request, $courseId)
    {
        $user = Auth::user();
        $answers = $request->input('answers', []);
        $results = [];

        foreach ($answers as $questionId => $selectedAnswer) {
            $question = Questions::find($questionId);
            $isCorrect = $question->correct_answer === $selectedAnswer;

            // Check if the answer already exists
            $existingAnswer = Answers::where('user_id', $user->id)
                ->where('question_id', $questionId)
                ->first();

            if ($existingAnswer) {
                // Update the existing answer
                $existingAnswer->update([
                    'selected_answer' => $selectedAnswer,
                    'is_correct' => $isCorrect,
                ]);
                $answerId = $existingAnswer->id;
            } else {
                // Create a new answer
                $newAnswer = Answers::create([
                    'user_id' => $user->id,
                    'question_id' => $questionId,
                    'selected_answer' => $selectedAnswer,
                    'is_correct' => $isCorrect,
                ]);
                $answerId = $newAnswer->id;
            }

            $results[$questionId] = $isCorrect;
        }

        return redirect()->route('courses.show', $courseId)->with('results', $results);
    }

    public function reset(Request $request, $courseId)
    {
        $user = Auth::user();
        Answers::where('user_id', $user->id)->whereHas('question', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->delete();

        return redirect()->route('courses.show', $courseId);
    }
}
