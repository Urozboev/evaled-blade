<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $exercises = Exercise::with('lesson')
            ->active()
            ->get()
            ->groupBy('task_type');
            
        return view('pages.exercises', compact('exercises', 'user'));
    }
    
    public function show(Request $request, $id)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $exercise = Exercise::with('lesson')->active()->findOrFail($id);
        
        return view('pages.exercise-detail', compact('exercise', 'user'));
    }
    
    public function submit(Request $request, $id)
    {
        $request->validate([
            'answers' => 'required|array',
            'feedback' => 'nullable|string',
        ]);
        
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $exercise = Exercise::active()->findOrFail($id);
        
        // Bu yerda javoblarni tekshirish va ball berish logikasi
        // Soddalik uchun hozir faqat saqlaymiz
        
        return response()->json([
            'success' => true,
            'score' => 8, // Demo uchun
            'max_score' => $exercise->max_score,
            'feedback' => 'Sizning javoblaringiz qabul qilindi!'
        ]);
    }
}