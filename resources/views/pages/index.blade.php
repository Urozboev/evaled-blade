@extends('layouts.app')

@section('title', 'EvalEd - Raqamli Baholash Kompetensiyasini Rivojlantirish Tizimi')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-16 md:py-24">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            RAQAMLI TA’LIMDA BO‘LAJAK BOSHLANG’ICH SINF O‘QITUVCHILARINI TA’LIM JARAYONINI BAHOLASH KOMPETENSIYALARINI RIVOJLANTIRISH
        </h1>
        <p class="text-xl mb-8 max-w-2xl mx-auto">EvalEd platformasi orqali formativ baholash, rubrikalar yaratish va o'quvchilarning bilimini baholash ko'nikmalarini o'zlashtiring.</p>
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
            <a href="{{ route('lessons.index') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Darslarni boshlash</a>
            <a href="{{ route('about') }}" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:bg-opacity-10 transition">Loyiha haqida</a>
        </div>
    </div>
</section>

<!-- Progress Section -->
<section class="bg-white py-8 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h2 class="text-xl font-bold text-gray-800">Sizning progressingiz</h2>
                <p class="text-gray-600">Darslarni tugatib, sertifikat oling</p>
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Umumiy progress</span>
                    <span class="text-sm font-medium text-gray-700">{{ $progress }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-indigo-600 h-2.5 rounded-full progress-bar" style="width: {{ $progress }}%"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lessons Preview Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Nazariy darslar</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Raqamli baholashning turli jihatlari haqida bilim oling. Har bir dars video, PDF material va testlarni o'z ichiga oladi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lessons as $lesson)
            <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                <div class="h-48 bg-indigo-100 flex items-center justify-center">
                    @if($lesson->image)
                    <img src="{{ Storage::url($lesson->image) }}" alt="{{ $lesson->title }}" class="w-full h-full object-cover">
                    @else
                    <i class="fas fa-book-open text-indigo-600 text-5xl"></i>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-800">{{ $lesson->title }}</h3>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Yangi</span>
                    </div>
                    <p class="text-gray-600 mb-4">{{ Str::limit($lesson->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-clock mr-1"></i>
                            <span>{{ $lesson->duration }} daqiqa</span>
                        </div>
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                            Darsni ko'rish
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('lessons.index') }}" class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800">
                Barcha darslarni ko'rish
                <i class="fas fa-chevron-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Platforma imkoniyatlari</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">EvalEd platformasi orqali raqamli baholashning barcha jihatlarini o'rganing</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book-open text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Nazariy bilimlar</h3>
                <p class="text-gray-600">Baholashning nazariy asoslari, turlari va usullari haqida batafsil ma'lumotlar</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tasks text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Amaliy mashqlar</h3>
                <p class="text-gray-600">Rubrikalar to'ldirish, teskari aloqa berish kabi amaliy topshiriqlar</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-laptop-code text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Baholash simulyatori</h3>
                <p class="text-gray-600">Virtual o'quvchilar javoblarini baholash orqali amaliy ko'nikmalar orttirish</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-indigo-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Sertifikat olishni boshlang</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Kursni tamomlang va raqamli baholash mutaxassisi sertifikatiga ega bo'ling</p>
        <a href="{{ route('lessons.index') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-flex items-center">
            Hoziroq boshlash
            <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</section>
@endsection