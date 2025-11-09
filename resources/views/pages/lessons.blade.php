@extends('layouts.app')

@section('title', 'Barcha Darslar - EvalEd')

@section('content')
<!-- Page Header -->
<section class="bg-white py-8 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Barcha Darslar</h1>
                <p class="text-gray-600">Raqamli baholash bo'yicha barcha mavzular</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="relative">
                    <input type="text" placeholder="Dars qidirish..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lessons Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if ($lessons->isEmpty())
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-600">
                <i class="fas fa-info-circle text-4xl mb-4"></i>
                <p class="text-lg">Hozircha mavjud darslar yo'q. Iltimos, keyinroq qayta urinib ko'ring.</p>
            </div>
            @else
            @foreach($lessons as $lesson)
            <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                <div class="h-48 bg-indigo-100 flex items-center justify-center relative">
                    @if($lesson->image)
                    <img src="{{ Storage::url($lesson->image) }}" alt="{{ $lesson->title }}" class="w-full h-full object-cover">
                    @else
                    <i class="fas fa-book-open text-indigo-600 text-5xl"></i>
                    @endif

                    @if($lesson->user_progress && $lesson->user_progress->completed)
                    <div class="absolute top-4 right-4 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Tugatilgan</div>
                    @elseif($lesson->user_progress)
                    <div class="absolute top-4 right-4 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Davom etmoqda</div>
                    @else
                    <div class="absolute top-4 right-4 bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Yangi</div>
                    @endif
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $lesson->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($lesson->description, 120) }}</p>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Progress</span>
                            <span>
                                @if($lesson->user_progress && $lesson->user_progress->completed)
                                100%
                                @elseif($lesson->user_progress)
                                {{ $lesson->user_progress->score }}%
                                @else
                                0%
                                @endif
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full progress-bar"
                                style="width: {{ $lesson->user_progress ? ($lesson->user_progress->completed ? 100 : $lesson->user_progress->score) : 0 }}%">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-clock mr-1"></i>
                            <span>{{ $lesson->duration }} daqiqa</span>
                        </div>
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                            @if($lesson->user_progress && $lesson->user_progress->completed)
                            Qayta Ko'rish
                            @elseif($lesson->user_progress)
                            Davom etish
                            @else
                            Boshlash
                            @endif
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

    </div>
</section>
@endsection