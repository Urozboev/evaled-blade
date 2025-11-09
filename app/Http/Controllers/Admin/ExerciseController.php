<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::with('lesson')->get();
        return view('admin.exercises.index', compact('exercises'));
    }

    public function create()
    {
        $lessons = Lesson::active()->get();
        return view('admin.exercises.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'instruction' => 'required|string',
            'task_type' => 'required|in:rubric,feedback,match,text',
            'content' => 'nullable|json',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'max_score' => 'required|integer|min:1',
        ]);

        $data = $request->only([
            'lesson_id',
            'title',
            'instruction',
            'task_type',
            'content',
            'duration',
            'difficulty',
            'max_score'
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('exercises', 'public');
        }

        // JSON content ni formatlash
        if ($request->filled('content')) {
            $data['content'] = json_decode($request->content, true);
        }

        Exercise::create($data);

        return redirect()->route('admin.exercises.index')
            ->with('success', 'Mashq muvaffaqiyatli yaratildi.');
    }

    public function edit(Exercise $exercise)
    {
        $lessons = Lesson::active()->get();
        return view('admin.exercises.edit', compact('exercise', 'lessons'));
    }

    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'instruction' => 'required|string',
            'task_type' => 'required|in:rubric,feedback,match,text',
            'content' => 'nullable|json',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'max_score' => 'required|integer|min:1',
        ]);

        $data = $request->only([
            'lesson_id',
            'title',
            'instruction',
            'task_type',
            'content',
            'duration',
            'difficulty',
            'max_score'
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('file')) {
            // Eski faylni o'chirish
            if ($exercise->file) {
                Storage::disk('public')->delete($exercise->file);
            }
            $data['file'] = $request->file('file')->store('exercises', 'public');
        }

        // JSON content ni formatlash
        if ($request->filled('content')) {
            $data['content'] = json_decode($request->content, true);
        }

        $exercise->update($data);

        return redirect()->route('admin.exercises.index')
            ->with('success', 'Mashq muvaffaqiyatli yangilandi.');
    }

    public function destroy(Exercise $exercise)
    {
        // Faylni o'chirish
        if ($exercise->file) {
            Storage::disk('public')->delete($exercise->file);
        }

        $exercise->delete();

        return redirect()->route('admin.exercises.index')
            ->with('success', 'Mashq muvaffaqiyatli o\'chirildi.');
    }
}
