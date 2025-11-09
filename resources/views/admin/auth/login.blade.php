<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kirish - EvalEd</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .login-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
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
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 font-medium">
                Platformaga qaytish
            </a>
        </div>
    </header>

    <!-- Login Section -->
    <section class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="login-gradient py-6 px-8 text-white text-center">
                    <h2 class="text-2xl font-bold">Admin Paneliga Kirish</h2>
                    <p class="mt-2 opacity-90">Ma'muriyat uchun maxsus kirish sahifasi</p>
                </div>
                
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.login.post') }}">
                        @csrf
                        
                        @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400 mt-1"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Xatolik</h3>
                                    <div class="mt-1 text-sm text-red-700">
                                        @foreach($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Elektron Pochta</label>
                            <div class="relative">
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="admin@evaled.uz" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Parol</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="••••••••" required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Eslab qolish</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Tizimga kirish
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Bu sahifa faqat ma'muriyat xodimlari uchun.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Diqqat</h3>
                            <div class="mt-1 text-sm text-yellow-700">
                                <p>Ushbu sahifaga faqat ruxsat etilgan admin foydalanuvchilari kira oladi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>© 2023 EvalEd. Barcha huquqlar himoyalangan.</p>
        </div>
    </footer>
</body>
</html>