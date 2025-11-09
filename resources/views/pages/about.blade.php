@extends('layouts.app')

@section('title', 'Loyiha haqida - EvalEd')

@section('content')
<!-- Page Header -->
<section class="hero-gradient text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">EvalEd haqida</h1>
        <p class="text-xl max-w-2xl mx-auto">Raqamli baholash kompetensiyasini rivojlantirish bo'yicha yetakchi platforma</p>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Bizning Maqsadimiz</h2>
                    <p class="text-gray-600 mb-4">
                        EvalEd - bu o'qituvchilar va ta'lim mutaxassislari uchun raqamli baholash kompetensiyasini rivojlantirishga yo'naltirilgan innovatsion platforma.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Bizning maqsadimiz - zamonaviy ta'limda muhim ahamiyatga ega bo'lgan baholash ko'nikmalarini rivojlantirishga yordam berish,
                        o'qituvchilarga formativ va summativ baholash usullarini o'rgatish, ularning pedagogik mahoratini oshirish.
                    </p>
                    <p class="text-gray-600">
                        Platformamiz orqali siz nazariy bilimlar, amaliy mashqlar va baholash simulyatorlari orqali o'z ko'nikmalaringizni rivojlantirishingiz mumkin.
                    </p>
                </div>
                <div class="bg-indigo-50 rounded-xl p-8">
                    <div class="text-center">
                        <i class="fas fa-bullseye text-indigo-600 text-5xl mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Bizning Vizyonimiz</h3>
                        <p class="text-gray-600">Har bir o'qituvchi raqamli baholashning zamonaviy usullarini mukammal o'zlashtirsin</p>
                    </div>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Platforma Xususiyatlari</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-video text-indigo-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Video Darslar</h3>
                        <p class="text-gray-600">Baholashning turli jihatlari bo'yicha sifatli video darslar</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-tasks text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Amaliy Mashqlar</h3>
                        <p class="text-gray-600">Rubrikalar to'ldirish, teskari aloqa berish kabi amaliy topshiriqlar</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-laptop-code text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Baholash Simulyatori</h3>
                        <p class="text-gray-600">Virtual o'quvchilar javoblarini baholash orqali amaliy ko'nikmalar orttirish</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-xl p-8 mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Platforma Statistikasi</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl font-bold text-indigo-600 mb-2">500+</div>
                        <div class="text-gray-600">Faol Foydalanuvchi</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-indigo-600 mb-2">25+</div>
                        <div class="text-gray-600">Nazariy Darslar</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-indigo-600 mb-2">150+</div>
                        <div class="text-gray-600">Amaliy Mashqlar</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-indigo-600 mb-2">98%</div>
                        <div class="text-gray-600">Mamnun Foydalanuvchilar</div>
                    </div>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Jamoa A'zolari</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 text-center">
                        <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-indigo-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Aziz Alimov</h3>
                        <p class="text-indigo-600 mb-3">Loyiha Rahbari</p>
                        <p class="text-gray-600">Ta'lim texnologiyalari bo'yicha mutaxassis, 10 yillik tajriba</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 text-center">
                        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Dilobar Xolmatova</h3>
                        <p class="text-indigo-600 mb-3">Pedagogik Konsultant</p>
                        <p class="text-gray-600">Baholash metodikasi bo'yicha mutaxassis, PhD</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 text-center">
                        <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-purple-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Javohir Ismoilov</h3>
                        <p class="text-indigo-600 mb-3">Dasturiy Ta'minot Muhandisi</p>
                        <p class="text-gray-600">Full-stack dasturchi, ta'lim texnologiyalari bo'yicha mutaxassis</p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Qo'shimcha Ma'lumot</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                    EvalEd platformasi 2023-yilda ta'lim sohasidagi mutaxassislar tomonidan ishlab chiqilgan.
                    Platforma doimiy ravishda yangilanib va takomillashib boradi.
                </p>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <a href="{{ route('contact') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                        Bog'lanish
                    </a>
                    <a href="{{ route('lessons.index') }}" class="bg-white text-indigo-600 border border-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                        Darslarni Ko'rish
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection