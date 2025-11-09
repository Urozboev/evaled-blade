@extends('layouts.app')

@section('title', 'Baholash Simulyatorlari - EvalEd')

@section('content')
<!-- Page Header -->
<section class="bg-white py-8 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Baholash Simulyatorlari</h1>
                <p class="text-gray-600">Virtual o'quvchilar javoblarini baholash orqali amaliy ko'nikmalaringizni oshiring</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex space-x-3">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option>Barcha fanlar</option>
                        <option>Matematika</option>
                        <option>Fizika</option>
                        <option>Biologiya</option>
                        <option>Tarix</option>
                        <option>Adabiyot</option>
                    </select>
                    <div class="relative">
                        <input type="text" placeholder="Simulyator qidirish..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 w-full md:w-64">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Simulators Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if ($simulators->isEmpty())
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-600">
                <i class="fas fa-info-circle text-4xl mb-4"></i>
                <p class="text-lg">Hozircha mavjud simulyatorlar yo'q. Iltimos, keyinroq qayta urinib ko'ring.</p>
            </div>
            @else
            @foreach($simulators as $simulator)
            <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                <div class="h-48 
                        @if($simulator->subject == 'Matematika') bg-indigo-100
                        @elseif($simulator->subject == 'Fizika') bg-green-100
                        @elseif($simulator->subject == 'Adabiyot') bg-blue-100
                        @elseif($simulator->subject == 'Biologiya') bg-purple-100
                        @elseif($simulator->subject == 'Tarix') bg-yellow-100
                        @else bg-gray-100 @endif
                        flex items-center justify-center relative">

                    @if($simulator->subject == 'Matematika')
                    <i class="fas fa-calculator text-indigo-600 text-5xl"></i>
                    @elseif($simulator->subject == 'Fizika')
                    <i class="fas fa-atom text-green-600 text-5xl"></i>
                    @elseif($simulator->subject == 'Adabiyot')
                    <i class="fas fa-book text-blue-600 text-5xl"></i>
                    @elseif($simulator->subject == 'Biologiya')
                    <i class="fas fa-dna text-purple-600 text-5xl"></i>
                    @elseif($simulator->subject == 'Tarix')
                    <i class="fas fa-landmark text-yellow-600 text-5xl"></i>
                    @else
                    <i class="fas fa-laptop-code text-gray-600 text-5xl"></i>
                    @endif

                    <div class="absolute top-4 right-4 
                            @if($simulator->subject == 'Matematika') bg-indigo-100 text-indigo-800
                            @elseif($simulator->subject == 'Fizika') bg-green-100 text-green-800
                            @elseif($simulator->subject == 'Adabiyot') bg-blue-100 text-blue-800
                            @elseif($simulator->subject == 'Biologiya') bg-purple-100 text-purple-800
                            @elseif($simulator->subject == 'Tarix') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif
                            text-xs font-medium px-2.5 py-0.5 rounded">
                        {{ $simulator->subject }}
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $simulator->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($simulator->description, 100) }}</p>

                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <i class="far fa-clock mr-1"></i>
                        <span>{{ $simulator->duration }} daqiqa</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-user-graduate mr-1"></i>
                        <span>{{ $simulator->student_count }} ta o'quvchi</span>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Progress</span>
                            <span>75%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full progress-bar" style="width: 75%"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-star mr-1"></i>
                            <span class="capitalize">Qiyinlik: {{ $simulator->difficulty }}</span>
                        </div>
                        <a href="{{ route('simulators.show', $simulator->id) }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                            Davom etish
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <!-- How It Works Section -->
        <section class="mt-12 py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8">Simulyator Qanday Ishlaydi?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center p-6">
                            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-indigo-600 font-bold text-xl">1</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Simulyatorni Tanlang</h3>
                            <p class="text-gray-600">O'zingizga mos fan va mavzudagi simulyatorni tanlang</p>
                        </div>

                        <div class="text-center p-6">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-green-600 font-bold text-xl">2</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Javoblarni Baholang</h3>
                            <p class="text-gray-600">Virtual o'quvchilarning javoblarini rubrika asosida baholang</p>
                        </div>

                        <div class="text-center p-6">
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-purple-600 font-bold text-xl">3</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Natijalarni Solishtiring</h3>
                            <p class="text-gray-600">O'z bahoingizni mutaxassislar bahosi bilan solishtiring</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection