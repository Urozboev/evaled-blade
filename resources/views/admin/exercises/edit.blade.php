@extends('layouts.admin')

@section('title', $exercise->title . ' - Tahrirlash - EvalEd')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $exercise->title }} - Tahrirlash</h1>
        <p class="text-gray-600">Mashq ma'lumotlarini yangilash</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.exercises.update', $exercise->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6 mb-6">
                <!-- Lesson Selection -->
                <div>
                    <label for="lesson_id" class="block text-sm font-medium text-gray-700 mb-2">Dars *</label>
                    <select id="lesson_id" name="lesson_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Darsni tanlang</option>
                        @foreach($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ old('lesson_id', $exercise->lesson_id) == $lesson->id ? 'selected' : '' }}>
                                {{ $lesson->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('lesson_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Mashq Nomi *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $exercise->title) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instruction -->
                <div>
                    <label for="instruction" class="block text-sm font-medium text-gray-700 mb-2">Yo'riqnoma *</label>
                    <textarea id="instruction" name="instruction" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">{{ old('instruction', $exercise->instruction) }}</textarea>
                    @error('instruction')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Task Type -->
                <div>
                    <label for="task_type" class="block text-sm font-medium text-gray-700 mb-2">Mashq Turi *</label>
                    <select id="task_type" name="task_type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="rubric" {{ old('task_type', $exercise->task_type) == 'rubric' ? 'selected' : '' }}>Rubrika to'ldirish</option>
                        <option value="feedback" {{ old('task_type', $exercise->task_type) == 'feedback' ? 'selected' : '' }}>Teskari aloqa</option>
                        <option value="match" {{ old('task_type', $exercise->task_type) == 'match' ? 'selected' : '' }}>Moslashtirish</option>
                        <option value="text" {{ old('task_type', $exercise->task_type) == 'text' ? 'selected' : '' }}>Matnli javob</option>
                    </select>
                    @error('task_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current File -->
                @if($exercise->file)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Joriy Fayl</label>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        @if(Str::endsWith($exercise->file, ['.jpg', '.jpeg', '.png', '.gif']))
                            <i class="fas fa-image text-green-600 mr-3"></i>
                        @else
                            <i class="fas fa-file text-blue-600 mr-3"></i>
                        @endif
                        <span class="text-sm text-gray-600">Fayl yuklangan</span>
                        <a href="{{ Storage::url($exercise->file) }}" target="_blank" class="ml-auto text-indigo-600 hover:text-indigo-800 mr-3">
                            <i class="fas fa-eye"></i> Ko'rish
                        </a>
                    </div>
                </div>
                @endif

                <!-- File Upload -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        @if($exercise->file)
                            Yangi Fayl (eskisini almashtirish)
                        @else
                            Fayl
                        @endif
                    </label>
                    <input type="file" id="file" name="file" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           accept=".jpeg,.png,.jpg,.pdf">
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content (JSON) -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Mazmun (JSON)</label>
                    <textarea id="content" name="content" rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 font-mono text-sm"
                              placeholder='{"criteria": [], "levels": []}'>{{ old('content', $exercise->content ? json_encode($exercise->content, JSON_PRETTY_PRINT) : '') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Davomiylik (daqiqa) *</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', $exercise->duration) }}" min="1" 
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
                        <option value="easy" {{ old('difficulty', $exercise->difficulty) == 'easy' ? 'selected' : '' }}>Oson</option>
                        <option value="medium" {{ old('difficulty', $exercise->difficulty) == 'medium' ? 'selected' : '' }}>O'rta</option>
                        <option value="hard" {{ old('difficulty', $exercise->difficulty) == 'hard' ? 'selected' : '' }}>Qiyin</option>
                    </select>
                    @error('difficulty')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Max Score -->
                <div>
                    <label for="max_score" class="block text-sm font-medium text-gray-700 mb-2">Maksimal Ball *</label>
                    <input type="number" id="max_score" name="max_score" value="{{ old('max_score', $exercise->max_score) }}" min="1" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('max_score')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $exercise->is_active) ? 'checked' : '' }} 
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">Mashq faol holatda</label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.exercises.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Bekor qilish
                </a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Yangilash
                </button>
            </div>
        </form>
    </div>

    <!-- JSON Helper -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-blue-800">JSON Format Maslahatlari</h4>
                <div class="mt-1 text-sm text-blue-700">
                    <p class="mb-2"><strong>Rubrika turi uchun namunaviy format:</strong></p>
                    <pre class="text-xs bg-white p-2 rounded border">
{
    "criteria": [
        {
            "name": "Mazmun va tushuncha",
            "description": "Mavzuni chuqur tushunish"
        }
    ],
    "levels": [
        {
            "name": "4 - A'lo",
            "description": "Mukammal tushuntirilgan"
        }
    ]
}</pre>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
// JSON format validation
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');
    
    contentTextarea.addEventListener('blur', function() {
        try {
            if (this.value.trim()) {
                JSON.parse(this.value);
                this.classList.remove('border-red-300');
                this.classList.add('border-green-300');
            }
        } catch (e) {
            this.classList.remove('border-green-300');
            this.classList.add('border-red-300');
            console.error('Invalid JSON format:', e);
        }
    });
});
</script>
@endsection