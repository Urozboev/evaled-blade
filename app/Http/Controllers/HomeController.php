<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $lessons = Lesson::active()->ordered()->take(3)->get();
        $progress = $user->overall_progress;
        
        return view('pages.index', compact('lessons', 'progress', 'user'));
    }
    
    public function about()
    {
        return view('pages.about');
    }
    
    public function contact()
    {
        return view('pages.contact');
    }
}