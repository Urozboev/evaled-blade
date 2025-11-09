<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $lessons = Lesson::active()->ordered()->get();
        
        // Har bir dars uchun progressni olish
        $lessons->each(function ($lesson) use ($user) {
            $progress = UserProgress::where('user_id', $user->id)
                ->where('lesson_id', $lesson->id)
                ->first();
                
            $lesson->user_progress = $progress;
            $lesson->completed = $progress ? $progress->completed : false;
            $lesson->user_score = $progress ? $progress->score : 0;
        });
        
        return view('pages.lessons', compact('lessons', 'user'));
    }
    
    public function show(Request $request, $id)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $lesson = Lesson::with(['quizzes' => function($query) {
            $query->ordered();
        }, 'exercises' => function($query) {
            $query->active();
        }])->active()->findOrFail($id);
        
        $userProgress = UserProgress::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->first();
            
        $allLessons = Lesson::active()->ordered()->get();
        
        return view('pages.lesson-detail', compact('lesson', 'userProgress', 'allLessons', 'user'));
    }
    
    public function markCompleted(Request $request, $id)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $lesson = Lesson::active()->findOrFail($id);
        
        UserProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'completed' => true,
                'completed_at' => now(),
            ]
        );
        
        return response()->json(['success' => true]);
    }
}