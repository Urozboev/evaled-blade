<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Exercise;
use App\Models\Simulator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_lessons' => Lesson::count(),
            'total_exercises' => Exercise::count(),
            'total_simulators' => Simulator::count(),
            'active_users' => User::where('progress', '>', 0)->count(),
            'certificates_issued' => User::where('progress', '>=', 70)->count(),
        ];
        
        $recentUsers = User::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentUsers'));
    }
}