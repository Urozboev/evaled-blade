<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simulator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SimulatorController extends Controller
{
    public function index()
    {
        $simulators = Simulator::all();
        return view('admin.simulators.index', compact('simulators'));
    }
    
    public function create()
    {
        return view('admin.simulators.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'subject' => 'required|string|max:100',
            'task_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'student_answers' => 'required|json',
            'criteria' => 'required|json',
            'correct_scores' => 'required|json',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'student_count' => 'required|integer|min:1',
        ]);
        
        $data = $request->only([
            'title', 'description', 'subject', 'student_answers',
            'criteria', 'correct_scores', 'duration', 'difficulty', 'student_count'
        ]);
        
        $data['is_active'] = $request->has('is_active');
        
        // JSON ma'lumotlarni formatlash
        $data['student_answers'] = json_decode($request->student_answers, true);
        $data['criteria'] = json_decode($request->criteria, true);
        $data['correct_scores'] = json_decode($request->correct_scores, true);
        
        if ($request->hasFile('task_image')) {
            $data['task_image'] = $request->file('task_image')->store('simulators', 'public');
        }
        
        Simulator::create($data);
        
        return redirect()->route('admin.simulators.index')
            ->with('success', 'Simulyator muvaffaqiyatli yaratildi.');
    }
    
    public function edit(Simulator $simulator)
    {
        return view('admin.simulators.edit', compact('simulator'));
    }
    
    public function update(Request $request, Simulator $simulator)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'subject' => 'required|string|max:100',
            'task_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'student_answers' => 'required|json',
            'criteria' => 'required|json',
            'correct_scores' => 'required|json',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'student_count' => 'required|integer|min:1',
        ]);
        
        $data = $request->only([
            'title', 'description', 'subject', 'student_answers',
            'criteria', 'correct_scores', 'duration', 'difficulty', 'student_count'
        ]);
        
        $data['is_active'] = $request->has('is_active');
        
        // JSON ma'lumotlarni formatlash
        $data['student_answers'] = json_decode($request->student_answers, true);
        $data['criteria'] = json_decode($request->criteria, true);
        $data['correct_scores'] = json_decode($request->correct_scores, true);
        
        if ($request->hasFile('task_image')) {
            // Eski rasmni o'chirish
            if ($simulator->task_image) {
                Storage::disk('public')->delete($simulator->task_image);
            }
            $data['task_image'] = $request->file('task_image')->store('simulators', 'public');
        }
        
        $simulator->update($data);
        
        return redirect()->route('admin.simulators.index')
            ->with('success', 'Simulyator muvaffaqiyatli yangilandi.');
    }
    
    public function destroy(Simulator $simulator)
    {
        // Rasmni o'chirish
        if ($simulator->task_image) {
            Storage::disk('public')->delete($simulator->task_image);
        }
        
        $simulator->delete();
        
        return redirect()->route('admin.simulators.index')
            ->with('success', 'Simulyator muvaffaqiyatli o\'chirildi.');
    }
}