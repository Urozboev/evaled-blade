<!-- Mobile Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" class="sidebar bg-indigo-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out z-50">
    <div class="flex items-center space-x-2 px-4">
        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
            <i class="fas fa-graduation-cap text-indigo-600 text-lg"></i>
        </div>
        <span class="text-xl font-bold">EvalEd Admin</span>
    </div>

    <nav>
        <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700' : '' }}">
            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
        </a>
        
        <a href="{{ route('admin.lessons.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 hover:text-white {{ request()->routeIs('admin.lessons.*') ? 'bg-indigo-700' : '' }}">
            <i class="fas fa-book mr-2"></i>Darslar
        </a>
        
        <a href="{{ route('admin.quizzes.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 hover:text-white {{ request()->routeIs('admin.quizzes.*') ? 'bg-indigo-700' : '' }}">
            <i class="fas fa-question-circle mr-2"></i>Test Savollar
        </a>
        
        <a href="{{ route('admin.exercises.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 hover:text-white {{ request()->routeIs('admin.exercises.*') ? 'bg-indigo-700' : '' }}">
            <i class="fas fa-tasks mr-2"></i>Mashqlar
        </a>
        
        <a href="{{ route('admin.simulators.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 hover:text-white {{ request()->routeIs('admin.simulators.*') ? 'bg-indigo-700' : '' }}">
            <i class="fas fa-laptop-code mr-2"></i>Simulyatorlar
        </a>
        
        <form method="POST" action="{{ route('admin.logout') }}" class="block">
            @csrf
            <button type="submit" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-700 hover:text-white">
                <i class="fas fa-sign-out-alt mr-2"></i>Chiqish
            </button>
        </form>
    </nav>
</aside>