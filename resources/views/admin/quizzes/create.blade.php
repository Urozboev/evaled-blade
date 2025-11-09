@extends('layouts.admin')

@section('title', 'Yangi Test Savoli - EvalEd')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Yangi Test Savoli</h1>
        <p class="text-gray-600">Yangi test savoli qo'shish</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.quizzes.store') }}" method="POST">
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

                <!-- Question -->
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Savol Matni *</label>
                    <textarea id="question" name="question" rows="3" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Savol matnini kiriting...">{{ old('question') }}</textarea>
                    @error('question')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="option_a" class="block text-sm font-medium text-gray-700 mb-2">Variant A *</label>
                        <input type="text" id="option_a" name="option_a" value="{{ old('option_a') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Birinchi variant">
                        @error('option_a')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="option_b" class="block text-sm font-medium text-gray-700 mb-2">Variant B *</label>
                        <input type="text" id="option_b" name="option_b" value="{{ old('option_b') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Ikkinchi variant">
                        @error('option_b')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="option_c" class="block text-sm font-medium text-gray-700 mb-2">Variant C *</label>
                        <input type="text" id="option_c" name="option_c" value="{{ old('option_c') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Uchinchi variant">
                        @error('option_c')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="option_d" class="block text-sm font-medium text-gray-700 mb-2">Variant D *</label>
                        <input type="text" id="option_d" name="option_d" value="{{ old('option_d') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="To'rtinchi variant">
                        @error('option_d')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Correct Answer -->
                <div>
                    <label for="correct_answer" class="block text-sm font-medium text-gray-700 mb-2">To'g'ri Javob *</label>
                    <select id="correct_answer" name="correct_answer" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">To'g'ri javobni tanlang</option>
                        <option value="A" {{ old('correct_answer') == 'A' ? 'selected' : '' }}>Variant A</option>
                        <option value="B" {{ old('correct_answer') == 'B' ? 'selected' : '' }}>Variant B</option>
                        <option value="C" {{ old('correct_answer') == 'C' ? 'selected' : '' }}>Variant C</option>
                        <option value="D" {{ old('correct_answer') == 'D' ? 'selected' : '' }}>Variant D</option>
                    </select>
                    @error('correct_answer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Explanation -->
                <div>
                    <label for="explanation" class="block text-sm font-medium text-gray-700 mb-2">Izoh</label>
                    <textarea id="explanation" name="explanation" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Savolga izoh...">{{ old('explanation') }}</textarea>
                    @error('explanation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Tartib Raqami *</label>
                    <input type="number" id="order" name="order" value="{{ old('order', 0) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.quizzes.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Bekor qilish
                </a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Savolni Saqlash
                </button>
            </div>
        </form>
    </div>
@endsection