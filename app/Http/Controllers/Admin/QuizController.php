<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('lesson')->ordered()->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }
    
    public function create()
    {
        $lessons = Lesson::active()->get();
        return view('admin.quizzes.create', compact('lessons'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string',
            'order' => 'required|integer',
        ]);
        
        Quiz::create($request->all());
        
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Test savoli muvaffaqiyatli yaratildi.');
    }
    
    public function edit(Quiz $quiz)
    {
        $lessons = Lesson::active()->get();
        return view('admin.quizzes.edit', compact('quiz', 'lessons'));
    }
    
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string',
            'order' => 'required|integer',
        ]);
        
        $quiz->update($request->all());
        
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Test savoli muvaffaqiyatli yangilandi.');
    }
    
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Test savoli muvaffaqiyatli o\'chirildi.');
    }
}