@extends('layouts.admin')

@section('title', $lesson->title . ' - Tahrirlash - EvalEd')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $lesson->title }} - Tahrirlash</h1>
        <p class="text-gray-600">Dars ma'lumotlarini yangilash</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Dars Nomi *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $lesson->title) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Tavsif *</label>
                    <textarea id="description" name="description" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                              required>{{ old('description', $lesson->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video URL -->
                <div class="md:col-span-2">
                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">Video Havolasi</label>
                    <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $lesson->video_url) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    @error('video_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Files -->
                @if($lesson->pdf_file)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Joriy PDF Fayl</label>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-file-pdf text-red-600 mr-3"></i>
                        <span class="text-sm text-gray-600">PDF fayl yuklangan</span>
                        <a href="{{ Storage::url($lesson->pdf_file) }}" target="_blank" class="ml-auto text-indigo-600 hover:text-indigo-800">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                @endif

                @if($lesson->image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Joriy Rasm</label>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-image text-green-600 mr-3"></i>
                        <span class="text-sm text-gray-600">Rasm yuklangan</span>
                        <a href="{{ Storage::url($lesson->image) }}" target="_blank" class="ml-auto text-indigo-600 hover:text-indigo-800">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                @endif

                <!-- PDF File -->
                <div>
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">Yangi PDF Fayl</label>
                    <input type="file" id="pdf_file" name="pdf_file" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           accept=".pdf">
                    @error('pdf_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Yangi Rasm</label>
                    <input type="file" id="image" name="image" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           accept="image/*">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Davomiylik (daqiqa) *</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', $lesson->duration) }}" min="1" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('duration')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Tartib Raqami *</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $lesson->order) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $lesson->is_active) ? 'checked' : '' }} 
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">Dars faol holatda</label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.lessons.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Bekor qilish
                </a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Yangilash
                </button>
            </div>
        </form>
    </div>
@endsection