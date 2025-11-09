@extends('layouts.admin')

@section('title', 'Yangi Dars Yaratish - EvalEd')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Yangi Dars Yaratish</h1>
        <p class="text-gray-600">Yangi dars qo'shish uchun quyidagi formani to'ldiring</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.lessons.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Dars Nomi *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Formativ baholash tushunchasi" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Tavsif *</label>
                    <textarea id="description" name="description" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                              placeholder="Dars haqida batafsil ma'lumot..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video URL -->
                <div class="md:col-span-2">
                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">Video Havolasi</label>
                    <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="https://youtube.com/embed/...">
                    @error('video_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PDF File -->
                <div>
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">PDF Fayl</label>
                    <input type="file" id="pdf_file" name="pdf_file" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                           accept=".pdf">
                    @error('pdf_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Rasm</label>
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
                    <input type="number" id="duration" name="duration" value="{{ old('duration', 15) }}" min="1" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                    @error('duration')
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

                <!-- Status -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
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
                    Darsni Saqlash
                </button>
            </div>
        </form>
    </div>
@endsection