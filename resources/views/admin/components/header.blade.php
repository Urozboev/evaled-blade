<header class="bg-white shadow">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center">
            <button id="sidebarToggle" class="text-gray-500 focus:outline-none lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <div class="relative mx-4 lg:mx-0">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <i class="fas fa-search text-gray-400"></i>
                </span>
                <input class="form-input w-32 pl-10 pr-4 rounded-lg" type="text" placeholder="Qidirish">
            </div>
        </div>
        
        <div class="flex items-center">
            <div class="relative">
                <button class="flex items-center text-gray-500 focus:outline-none">
                    <i class="fas fa-bell text-xl"></i>
                </button>
            </div>
            
            <div class="ml-4 relative">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-700 hidden md:block">
                        {{ Auth::guard('admin')->user()->name }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>