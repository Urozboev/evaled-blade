@extends('layouts.admin')

@section('title', 'Yangi Mashq - EvalEd')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Yangi Mashq Yaratish</h1>
        <p class="text-gray-600">Yangi amaliy mashq qo'shish</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.exercises.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 gap-6 mb-6">
                <!-- Lesson Selection -->
                <div>
                    <label for="lesson_id" class="block text-sm font-medium text-gray-700 mb-2">Dars *</label>
                    <select id="lesson_id" name="lesson_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Darsni tanlang</option>
                        @foreach($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ old('lesson_id') == $lesson->id ? 'selected' : '' }}>
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
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Rubrikani to'ldiring">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instruction -->
                <div>
                    <label for="instruction" class="block text-sm font-medium text-gray-700 mb-2">Yo'riqnoma *</label>
                    <textarea id="instruction" name="instruction" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Talabaga yo'riqnoma...">{{ old('instruction') }}</textarea>
                    @error('instruction')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Task Type -->
                <div>
                    <label for="task_type" class="block text-sm font-medium text-gray-700 mb-2">Mashq Turi *</label>
                    <select id="task_type" name="task_type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Mashq turini tanlang</option>
                        <option value="rubric" {{ old('task_type') == 'rubric' ? 'selected' : '' }}>Rubrika to'ldirish</option>
                        <option value="feedback" {{ old('task_type') == 'feedback' ? 'selected' : '' }}>Teskari aloqa</option>
                        <option value="match" {{ old('task_type') == 'match' ? 'selected' : '' }}>Moslashtirish</option>
                        <option value="text" {{ old('task_type') == 'text' ? 'selected' : '' }}>Matnli javob</option>
                    </select>
                    @error('task_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content (JSON) -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Mazmun (JSON)</label>
                    <textarea id="content" name="content" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 font-mono text-sm"
                              placeholder='{"criteria": [], "levels": []}'>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Upload -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Fayl</label>
                    <input type="file" id="file" name="file" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           accept=".jpeg,.png,.jpg,.pdf">
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Davomiylik (daqiqa) *</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', 20) }}" min="1" 
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

                <!-- Max Score -->
                <div>
                    <label for="max_score" class="block text-sm font-medium text-gray-700 mb-2">Maksimal Ball *</label>
                    <input type="number" id="max_score" name="max_score" value="{{ old('max_score', 10) }}" min="1" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('max_score')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
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
                    Mashqni Saqlash
                </button>
            </div>
        </form>
    </div>
@endsection