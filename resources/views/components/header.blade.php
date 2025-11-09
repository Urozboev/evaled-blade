<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-lg"></i>
                </div>
                <span class="text-xl font-bold text-gray-800">EvalEd</span>
            </a>
        </div>
        
        <nav class="hidden md:flex space-x-8">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">Bosh Sahifa</a>
            <a href="{{ route('lessons.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('lessons.*') ? 'text-indigo-600' : '' }}">Darslar</a>
            <a href="{{ route('exercises.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('exercises.*') ? 'text-indigo-600' : '' }}">Mashqlar</a>
            <a href="{{ route('simulators.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('simulators.*') ? 'text-indigo-600' : '' }}">Simulyator</a>
            <a href="{{ route('about') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('about') ? 'text-indigo-600' : '' }}">Loyiha haqida</a>
        </nav>
        
        <div class="flex items-center space-x-4">
            @if(isset($user) && $user->email)
                <span class="hidden md:inline text-gray-600">{{ $user->full_name ?? 'Foydalanuvchi' }}</span>
            @endif
            
            <a href="{{ route('admin.login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">
                <i class="fas fa-user mr-2"></i>Admin Kirish
            </a>
            
            <button class="md:hidden text-gray-600" id="mobileMenuButton">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-white py-4 px-4 shadow-md" id="mobileMenu">
        <div class="flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">Bosh sahifa</a>
            <a href="{{ route('lessons.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('lessons.*') ? 'text-indigo-600' : '' }}">Darslar</a>
            <a href="{{ route('exercises.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('exercises.*') ? 'text-indigo-600' : '' }}">Mashqlar</a>
            <a href="{{ route('simulators.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('simulators.*') ? 'text-indigo-600' : '' }}">Simulyator</a>
            <a href="{{ route('about') }}" class="text-gray-600 hover:text-indigo-600 font-medium {{ request()->routeIs('about') ? 'text-indigo-600' : '' }}">Loyiha haqida</a>
        </div>
    </div>
</header>