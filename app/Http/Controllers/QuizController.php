<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Request $request, $lessonId)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $lesson = Lesson::active()->findOrFail($lessonId);
        $quizzes = Quiz::where('lesson_id', $lessonId)->ordered()->get();
        
        return view('pages.quiz', compact('lesson', 'quizzes', 'user'));
    }
    
    public function submit(Request $request, $lessonId)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);
        
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $quizzes = Quiz::where('lesson_id', $lessonId)->get();
        $correctAnswers = 0;
        $totalQuestions = $quizzes->count();
        
        foreach ($quizzes as $quiz) {
            if (isset($request->answers[$quiz->id])) {
                if ($request->answers[$quiz->id] === $quiz->correct_answer) {
                    $correctAnswers++;
                }
            }
        }
        
        $score = round(($correctAnswers / $totalQuestions) * 100);
        
        // Quiz attempt ni saqlash
        QuizAttempt::create([
            'user_id' => $user->id,
            'lesson_id' => $lessonId,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'completed_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'score' => $score,
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions,
        ]);
    }
}