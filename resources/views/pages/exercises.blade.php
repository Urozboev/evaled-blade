@extends('layouts.app')

@section('title', 'Amaliy Mashqlar - EvalEd')

@section('content')
<!-- Page Header -->
<section class="bg-white py-8 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Amaliy Mashqlar</h1>
                <p class="text-gray-600">Rubrikalar to'ldirish, teskari aloqa berish va boshqa amaliy topshiriqlar</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex space-x-3">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option>Barcha turdagi mashqlar</option>
                        <option>Rubrika to'ldirish</option>
                        <option>Teskari aloqa</option>
                        <option>Moslashtirish</option>
                        <option>Matnli javob</option>
                    </select>
                    <div class="relative">
                        <input type="text" placeholder="Mashq qidirish..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Exercises Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($exercises as $type => $typeExercises)
            @if ($typeExercises->count() < 1)
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-600">
                <i class="fas fa-info-circle text-4xl mb-4"></i>
                <p class="text-lg">Hozircha "{{ $type }}" turidagi mashqlar mavjud emas. Iltimos, keyinroq qayta urinib ko'ring.</p>
            </div>
            @else
            @foreach($typeExercises as $exercise)
            <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                <div class="h-48 
                            @if($exercise->task_type == 'rubric') bg-green-100
                            @elseif($exercise->task_type == 'feedback') bg-blue-100
                            @elseif($exercise->task_type == 'match') bg-purple-100
                            @else bg-yellow-100 @endif
                            flex items-center justify-center relative">

                    @if($exercise->task_type == 'rubric')
                    <i class="fas fa-tasks text-green-600 text-5xl"></i>
                    @elseif($exercise->task_type == 'feedback')
                    <i class="fas fa-comment-dots text-blue-600 text-5xl"></i>
                    @elseif($exercise->task_type == 'match')
                    <i class="fas fa-puzzle-piece text-purple-600 text-5xl"></i>
                    @else
                    <i class="fas fa-edit text-yellow-600 text-5xl"></i>
                    @endif

                    <div class="absolute top-4 right-4 
                                @if($exercise->task_type == 'rubric') bg-green-100 text-green-800
                                @elseif($exercise->task_type == 'feedback') bg-blue-100 text-blue-800
                                @elseif($exercise->task_type == 'match') bg-purple-100 text-purple-800
                                @else bg-yellow-100 text-yellow-800 @endif
                                text-xs font-medium px-2.5 py-0.5 rounded capitalize">
                        {{ $exercise->task_type }}
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $exercise->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($exercise->instruction, 100) }}</p>

                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <i class="far fa-clock mr-1"></i>
                        <span>{{ $exercise->duration }} daqiqa</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-tag mr-1"></i>
                        <span>{{ $exercise->lesson->title }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-star mr-1"></i>
                            <span class="capitalize">Qiyinlik: {{ $exercise->difficulty }}</span>
                        </div>
                        <a href="{{ route('exercises.show', $exercise->id) }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                            Boshlash
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            @endforeach
        </div>

        <!-- Stats Section -->
        <div class="mt-12 bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Mashqlar Statistikasi</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-3xl font-bold text-indigo-600 mb-2">
                        {{ $exercises->flatten()->count() }}
                    </div>
                    <div class="text-gray-600">Jami Mashqlar</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-green-600 mb-2">
                        {{ $exercises->flatten()->where('difficulty', 'easy')->count() }}
                    </div>
                    <div class="text-gray-600">Oson</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-600 mb-2">
                        {{ $exercises->flatten()->where('difficulty', 'medium')->count() }}
                    </div>
                    <div class="text-gray-600">O'rta</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-red-600 mb-2">
                        {{ $exercises->flatten()->where('difficulty', 'hard')->count() }}
                    </div>
                    <div class="text-gray-600">Qiyin</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection