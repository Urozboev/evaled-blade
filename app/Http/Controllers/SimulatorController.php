<?php

namespace App\Http\Controllers;

use App\Models\Simulator;
use App\Models\User;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    public function index(Request $request)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $simulators = Simulator::active()->get();
        
        return view('pages.simulators', compact('simulators', 'user'));
    }
    
    public function show(Request $request, $id)
    {
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $simulator = Simulator::active()->findOrFail($id);
        
        return view('pages.simulator-detail', compact('simulator', 'user'));
    }
    
    public function evaluate(Request $request, $id)
    {
        $request->validate([
            'ratings' => 'required|array',
            'feedback' => 'required|array',
        ]);
        
        $userController = new UserController();
        $user = $userController->getOrCreateUser($request);
        
        $simulator = Simulator::active()->findOrFail($id);
        
        // Baholash logikasi
        $totalScore = 0;
        $maxScore = 0;
        
        foreach ($request->ratings as $studentId => $criteria) {
            foreach ($criteria as $criterionId => $score) {
                $totalScore += $score;
                $maxScore += 5; // Har bir mezon uchun maksimum 5 ball
            }
        }
        
        return response()->json([
            'success' => true,
            'total_score' => $totalScore,
            'max_score' => $maxScore,
            'percentage' => round(($totalScore / $maxScore) * 100),
        ]);
    }
}