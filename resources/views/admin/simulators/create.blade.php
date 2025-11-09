@extends('layouts.admin')

@section('title', 'Yangi Simulyator - EvalEd')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Yangi Simulyator Yaratish</h1>
        <p class="text-gray-600">Yangi baholash simulyatori qo'shish</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.simulators.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 gap-6 mb-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Simulyator Nomi *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Matematika Darsi - Formativ Baholash">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Tavsif *</label>
                    <textarea id="description" name="description" rows="3" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Simulyator haqida batafsil ma'lumot...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Fan *</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Matematika">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Task Image -->
                <div>
                    <label for="task_image" class="block text-sm font-medium text-gray-700 mb-2">Topshiriq Rasmi</label>
                    <input type="file" id="task_image" name="task_image" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           accept="image/*">
                    @error('task_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student Answers (JSON) -->
                <div>
                    <label for="student_answers" class="block text-sm font-medium text-gray-700 mb-2">O'quvchi Javoblari (JSON) *</label>
                    <textarea id="student_answers" name="student_answers" rows="6" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 font-mono text-sm"
                              placeholder='[{"name": "Aziza", "answer": "2/3 + 1/4 = 3/7"}]'>{{ old('student_answers') }}</textarea>
                    @error('student_answers')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Criteria (JSON) -->
                <div>
                    <label for="criteria" class="block text-sm font-medium text-gray-700 mb-2">Baholash Mezonlari (JSON) *</label>
                    <textarea id="criteria" name="criteria" rows="6" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 font-mono text-sm"
                              placeholder='[{"name": "Umumiy tushuncha", "max_score": 5}]'>{{ old('criteria') }}</textarea>
                    @error('criteria')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Correct Scores (JSON) -->
                <div>
                    <label for="correct_scores" class="block text-sm font-medium text-gray-700 mb-2">To'g'ri Baholar (JSON) *</label>
                    <textarea id="correct_scores" name="correct_scores" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 font-mono text-sm"
                              placeholder='{"student1": {"criterion1": 5, "criterion2": 4}}'>{{ old('correct_scores') }}</textarea>
                    @error('correct_scores')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Davomiylik (daqiqa) *</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', 25) }}" min="1" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('duration')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Difficulty -->
                <div>
                    <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-2">Qiyinlik Darajasi *</label>
                    <select id="difficulty" name="difficulty" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="easy" {{ old('difficulty') == 'easy' ? 'selected' : '' }}>Oson</option>
                        <option value="medium" {{ old('difficulty', 'medium') == 'medium' ? 'selected' : '' }}>O'rta</option>
                        <option value="hard" {{ old('difficulty') == 'hard' ? 'selected' : '' }}>Qiyin</option>
                    </select>
                    @error('difficulty')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student Count -->
                <div>
                    <label for="student_count" class="block text-sm font-medium text-gray-700 mb-2">O'quvchilar Soni *</label>
                    <input type="number" id="student_count" name="student_count" value="{{ old('student_count', 3) }}" min="1" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('student_count')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">Simulyator faol holatda</label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.simulators.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Bekor qilish
                </a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Simulyatorni Saqlash
                </button>
            </div>
        </form>
    </div>

    <!-- JSON Examples -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-lightbulb text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-blue-800">JSON Format Misollari</h4>
                <div class="mt-1 text-sm text-blue-700 space-y-2">
                    <div>
                        <strong>O'quvchi Javoblari:</strong>
                        <pre class="text-xs bg-white p-2 rounded border mt-1">
[
    {
        "name": "Aziza",
        "answer": "2/3 + 1/4 = 3/7",
        "submitted_at": "10 daqiqa oldin"
    }
]</pre>
                    </div>
                    <div>
                        <strong>Baholash Mezonlari:</strong>
                        <pre class="text-xs bg-white p-2 rounded border mt-1">
[
    {
        "name": "Umumiy tushuncha",
        "description": "Kasrlarni qo'shishning asosiy tamoyilini tushunish",
        "max_score": 5
    }
]</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
// JSON format validation
document.addEventListener('DOMContentLoaded', function() {
    const jsonFields = ['student_answers', 'criteria', 'correct_scores'];
    
    jsonFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('blur', function() {
                try {
                    if (this.value.trim()) {
                        JSON.parse(this.value);
                        this.classList.remove('border-red-300');
                        this.classList.add('border-green-300');
                    }
                } catch (e) {
                    this.classList.remove('border-green-300');
                    this.classList.add('border-red-300');
                    console.error('Invalid JSON format in ' + fieldId + ':', e);
                }
            });
        }
    });
});
</script>
@endsection