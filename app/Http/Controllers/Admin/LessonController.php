<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::ordered()->get();
        return view('admin.lessons.index', compact('lessons'));
    }
    
    public function create()
    {
        return view('admin.lessons.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'duration' => 'required|integer|min:1',
            'order' => 'required|integer',
        ]);
        
        $data = $request->only(['title', 'description', 'video_url', 'duration', 'order']);
        $data['is_active'] = $request->has('is_active');
        
        // Fayllarni yuklash
        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        }
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        
        Lesson::create($data);
        
        return redirect()->route('admin.lessons.index')
            ->with('success', 'Dars muvaffaqiyatli yaratildi.');
    }
    
    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }
    
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'duration' => 'required|integer|min:1',
            'order' => 'required|integer',
        ]);
        
        $data = $request->only(['title', 'description', 'video_url', 'duration', 'order']);
        $data['is_active'] = $request->has('is_active');
        
        // Fayllarni yangilash
        if ($request->hasFile('pdf_file')) {
            // Eski faylni o'chirish
            if ($lesson->pdf_file) {
                Storage::disk('public')->delete($lesson->pdf_file);
            }
            $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        }
        
        if ($request->hasFile('image')) {
            // Eski rasmni o'chirish
            if ($lesson->image) {
                Storage::disk('public')->delete($lesson->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        
        $lesson->update($data);
        
        return redirect()->route('admin.lessons.index')
            ->with('success', 'Dars muvaffaqiyatli yangilandi.');
    }
    
    public function destroy(Lesson $lesson)
    {
        // Fayllarni o'chirish
        if ($lesson->pdf_file) {
            Storage::disk('public')->delete($lesson->pdf_file);
        }
        if ($lesson->image) {
            Storage::disk('public')->delete($lesson->image);
        }
        
        $lesson->delete();
        
        return redirect()->route('admin.lessons.index')
            ->with('success', 'Dars muvaffaqiyatli o\'chirildi.');
    }
}