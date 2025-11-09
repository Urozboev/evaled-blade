@extends('layouts.app')

@section('title', $lesson->title . ' - EvalEd')

@section('styles')
<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .lesson-nav {
        position: sticky;
        top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-3/4">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-home mr-2"></i>
                            Bosh sahifa
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('lessons.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Darslar</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $lesson->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Lesson Header -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $lesson->title }}</h1>
                        <div class="flex items-center text-gray-600">
                            <i class="far fa-clock mr-2"></i>
                            <span>{{ $lesson->duration }} daqiqa</span>
                            <span class="mx-2">•</span>
                            <i class="far fa-calendar mr-2"></i>
                            <span>{{ $lesson->created_at->format('d.m.Y') }}</span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                        @if($userProgress && $userProgress->completed)
                            <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">Tugatilgan</span>
                        @else
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Yangi</span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center mb-6">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-indigo-600 h-2.5 rounded-full" 
                             style="width: {{ $userProgress ? ($userProgress->completed ? 100 : $userProgress->score) : 0 }}%">
                        </div>
                    </div>
                    <span class="ml-4 text-sm font-medium text-gray-700">
                        {{ $userProgress ? ($userProgress->completed ? 100 : $userProgress->score) : 0 }}%
                    </span>
                </div>

                <p class="text-gray-700 mb-6">{{ $lesson->description }}</p>

                <div class="flex flex-wrap gap-3">
                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded">Baholash</span>
                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded">Formativ</span>
                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded">O'qitish</span>
                </div>
            </div>

            <!-- Video Section -->
            @if($lesson->video_url)
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Video Dars</h2>
                <div class="video-container bg-black rounded-lg mb-4">
                    <iframe style="width: 100%; aspect-ratio: 16/9;" src="{{ $lesson->video_url }}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        <i class="far fa-eye mr-1"></i> Video dars
                    </div>
                    @if(!$userProgress || !$userProgress->completed)
                    <button onclick="markCompleted({{ $lesson->id }})" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                        <i class="fas fa-check mr-2"></i> Tugallandi deb belgilash
                    </button>
                    @endif
                </div>
            </div>
            @endif

            <!-- Lesson Content -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Dars Mazmuni</h2>
                <div class="prose max-w-none">
                    {!! $lesson->description !!}
                </div>
            </div>

            <!-- PDF Materials -->
            @if($lesson->pdf_file)
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Qo'shimcha Materiallar</h2>
                <div class="border border-gray-200 rounded-lg p-4 flex items-center">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800">Dars Materiallari</h3>
                        <p class="text-sm text-gray-600">PDF • Yuklab olish</p>
                    </div>
                    <a href="{{ Storage::url($lesson->pdf_file) }}" download class="ml-auto text-indigo-600 hover:text-indigo-800">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
            @endif

            <!-- Navigation -->
            <div class="flex justify-between">
                <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Oldingi dars
                </a>
                @if($lesson->quizzes->count() > 0)
                <a href="{{ route('quiz.show', $lesson->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                    Testni boshlash <i class="fas fa-arrow-right ml-2"></i>
                </a>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/4">
            <div class="lesson-nav bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Darslar Ro'yxati</h3>
                
                <div class="space-y-3">
                    @foreach($allLessons as $l)
                    <a href="{{ route('lessons.show', $l->id) }}" 
                       class="flex items-center p-3 {{ $l->id == $lesson->id ? 'bg-indigo-50 border border-indigo-200' : 'border border-gray-200 hover:bg-gray-50' }} rounded-lg">
                        <div class="w-8 h-8 {{ $l->id == $lesson->id ? 'bg-indigo-600' : 'bg-gray-300' }} rounded-full flex items-center justify-center mr-3">
                            <span class="text-{{ $l->id == $lesson->id ? 'white' : 'gray-700' }} text-sm font-medium">{{ $loop->iteration }}</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">{{ Str::limit($l->title, 30) }}</h4>
                            <div class="flex items-center text-xs text-gray-600">
                                <i class="far fa-clock mr-1"></i>
                                <span>{{ $l->duration }} daqiqa</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                
                @if($lesson->quizzes->count() > 0)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('quiz.show', $lesson->id) }}" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition flex items-center justify-center">
                        <i class="fas fa-play-circle mr-2"></i> Testni boshlash
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function markCompleted(lessonId) {
    fetch(`/lesson/${lessonId}/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection