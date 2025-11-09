<footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <span class="text-xl font-bold">EvalEd</span>
                </div>
                <p class="text-gray-400">Raqamli baholash kompetensiyasini rivojlantirish tizimi. O'qituvchilar va ta'lim mutaxassislari uchun.</p>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Bo'limlar</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('lessons.index') }}" class="text-gray-400 hover:text-white transition">Darslar</a></li>
                    <li><a href="{{ route('exercises.index') }}" class="text-gray-400 hover:text-white transition">Mashqlar</a></li>
                    <li><a href="{{ route('simulators.index') }}" class="text-gray-400 hover:text-white transition">Simulyator</a></li>
                    <li><a href="{{ route('certificate') }}" class="text-gray-400 hover:text-white transition">Sertifikat</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Platforma</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">Biz haqimizda</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">Aloqa</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Maxfiylik siyosati</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Foydalanish shartlari</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Aloqa</h4>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-2 text-gray-400"></i>
                        <span class="text-gray-400">info@evaled.uz</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-2 text-gray-400"></i>
                        <span class="text-gray-400">+998 71 123 45 67</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                        <span class="text-gray-400">Toshkent, O'zbekiston</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>© 2023 EvalEd. Barcha huquqlar himoyalangan.</p>
        </div>
    </div>
</footer>