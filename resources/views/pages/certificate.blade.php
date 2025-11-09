@extends('layouts.app')

@section('title', 'Sertifikat Olish - EvalEd')

@section('content')
<!-- Page Header -->
<section class="bg-white py-8 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Sertifikat olish</h1>
                <p class="text-gray-600">Kursni muvaffaqiyatli tugatganingizdan so'ng raqamli baholash mutaxassisi sertifikatini oling</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-lg">
                    <i class="fas fa-chart-line mr-2"></i>
                    Umumiy progress: {{ $progress }}%
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certificate Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Progress Alert -->
            @if(!$canGetCertificate)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-8">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Diqqat</h3>
                        <div class="mt-1 text-sm text-yellow-700">
                            <p>Sertifikat olish uchun siz barcha darslarni tugatishingiz va kamida 70% ball to'plashingiz kerak. Hozirda sizning progressingiz: <strong>{{ $progress }}%</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-8">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-800">Tabriklaymiz!</h3>
                        <div class="mt-1 text-sm text-green-700">
                            <p>Siz sertifikat olish uchun barcha talablarni bajardingiz. Quyidagi formani to'ldiring va sertifikatingizni oling.</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Certificate Preview -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="certificate-border p-1">
                        <div class="certificate-content p-8 text-center">
                            <div class="mb-6">
                                <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-award text-indigo-600 text-3xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">SERTIFIKAT</h2>
                                <p class="text-gray-600">Ushbu sertifikat quyidagi shaxsning</p>
                            </div>

                            <div class="my-8">
                                <h3 class="text-3xl font-bold text-indigo-600 mb-2" id="certificateName">
                                    {{ $user->full_name ? strtoupper($user->full_name) : 'ISM FAMILIYA' }}
                                </h3>
                                <p class="text-gray-700 mb-4">"Raqamli baholash kompetensiyasini rivojlantirish" kursini</p>
                                <p class="text-gray-700 mb-2">muvaffaqiyatli tamomlaganligini tasdiqlaydi</p>
                            </div>

                            <div class="flex justify-between items-center mt-8">
                                <div class="text-center">
                                    <div class="h-16 w-32 border-b-2 border-gray-300 mb-2"></div>
                                    <p class="text-sm text-gray-600">Rektor</p>
                                </div>
                                <div class="text-center">
                                    <div class="h-16 w-32 border-b-2 border-gray-300 mb-2"></div>
                                    <p class="text-sm text-gray-600">Sana</p>
                                    <p class="text-sm text-gray-800 font-medium" id="certificateDate">{{ date('d.m.Y') }}</p>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <p class="text-sm text-gray-500">Sertifikat raqami: <span id="certificateCode">{{ $user->id ? 'EVAL-' . date('Y') . '-' . str_pad($user->id, 6, '0', STR_PAD_LEFT) : 'EVAL-2025-001' }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificate Form -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Sertifikat ma'lumotlari</h3>

                    <form id="certificateForm" method="POST" action="{{ route('certificate.generate') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Ism familiya *</label>
                            <input type="text" id="full_name" name="full_name"
                                value="{{ old('full_name', $user->full_name) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('full_name') border-red-500 @enderror"
                                placeholder="Ismingiz va familiyangizni kiriting"
                                required
                                {{ !$canGetCertificate ? 'disabled' : '' }}>
                            @error('full_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kurs natijalari</label>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Umumiy progress</p>
                                        <p class="font-medium text-gray-800">{{ $progress }}%</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Test natijasi</p>
                                        <p class="font-medium text-gray-800">{{ $user->quiz_score ?? 0 }}%</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Mashqlar</p>
                                        <p class="font-medium text-gray-800">{{ $user->exercise_score ?? 0 }}%</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Simulyator</p>
                                        <p class="font-medium text-gray-800">{{ $user->simulator_score ?? 0 }}%</p>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="h-2 rounded-full progress-bar 
                                            @if($progress >= 70) bg-green-500
                                            @elseif($progress >= 50) bg-yellow-500
                                            @else bg-red-500 @endif"
                                        style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Elektron pochta *</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                                placeholder="siz@example.uz"
                                required
                                {{ !$canGetCertificate ? 'disabled' : '' }}>
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Sertifikat ushbu manzilga yuboriladi</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sertifikat formati</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="format" value="pdf"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                        checked
                                        {{ !$canGetCertificate ? 'disabled' : '' }}>
                                    <span class="ml-2 text-gray-700">PDF</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="format" value="image"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                        {{ !$canGetCertificate ? 'disabled' : '' }}>
                                    <span class="ml-2 text-gray-700">Rasm (PNG)</span>
                                </label>
                            </div>
                        </div>

                        @if(!$canGetCertificate)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Ma'lumot</h3>
                                    <div class="mt-1 text-sm text-blue-700">
                                        <p>Sertifikatni olish uchun kamida 70% ball to'plashingiz kerak. Hozirda sizning ballingiz {{ $progress }}%. Iltimos, qolgan topshiriqlarni tugatib, qaytadan urinib ko'ring.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($canGetCertificate)
                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sertifikatni olish
                        </button>
                        @else
                        <button type="button" class="w-full bg-gray-400 text-white py-3 px-4 rounded-lg font-medium cursor-not-allowed" disabled>
                            Sertifikat olish (Progress 70% dan past)
                        </button>
                        @endif
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Kursni tugatish uchun <a href="{{ route('lessons.index') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">darslar</a> bo'limiga qayting
                        </p>
                    </div>
                </div>
            </div>

            <!-- Success Modal -->
            <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
                <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
                    <div class="p-6 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Tabriklaymiz!</h3>
                        <p class="text-gray-600 mb-6" id="successMessage">Sertifikatingiz muvaffaqiyatli yaratildi va elektron pochtangizga yuborildi.</p>

                        <div class="flex flex-col space-y-3">
                            <a id="downloadCertificate" href="#" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition text-center">
                                <i class="fas fa-download mr-2"></i>
                                Sertifikatni yuklab olish
                            </a>
                            <a href="{{ route('home') }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition text-center">
                                Bosh sahifaga qaytish
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requirements Section -->
            <div class="mt-12 bg-green-50 border border-green-200 rounded-xl p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-trophy text-indigo-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Sertifikat olish talablari</h3>
                        <p class="text-gray-600">Quyidagi talablarni bajarganingizda sertifikat olishingiz mumkin:</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <i class="fas fa-check {{ $progress >= 100 ? 'text-green-500' : 'text-gray-300' }} mr-2"></i>
                        <span class="text-gray-700 {{ $progress >= 100 ? 'font-medium' : '' }}">Barcha nazariy darslarni tugatish</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check {{ ($user->quiz_score ?? 0) >= 70 ? 'text-green-500' : 'text-gray-300' }} mr-2"></i>
                        <span class="text-gray-700 {{ ($user->quiz_score ?? 0) >= 70 ? 'font-medium' : '' }}">Testlardan kamida 70% o'tish</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check {{ ($user->exercise_score ?? 0) >= 70 ? 'text-green-500' : 'text-gray-300' }} mr-2"></i>
                        <span class="text-gray-700 {{ ($user->exercise_score ?? 0) >= 70 ? 'font-medium' : '' }}">Amaliy mashqlarni bajarish</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check {{ ($user->simulator_score ?? 0) >= 70 ? 'text-green-500' : 'text-gray-300' }} mr-2"></i>
                        <span class="text-gray-700 {{ ($user->simulator_score ?? 0) >= 70 ? 'font-medium' : '' }}">Baholash simulyatorlarida qatnashish</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .certificate-border {
        border: 20px solid #4f46e5;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .certificate-content {
        background: white;
        min-height: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .progress-bar {
        transition: width 0.5s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const certificateForm = document.getElementById('certificateForm');
        const successModal = document.getElementById('successModal');
        const downloadButton = document.getElementById('downloadCertificate');
        const successMessage = document.getElementById('successMessage');
        const certificateName = document.getElementById('certificateName');
        const fullNameInput = document.getElementById('full_name');

        // Update certificate preview when name is entered
        if (fullNameInput) {
            fullNameInput.addEventListener('input', function() {
                const name = this.value || 'ISM FAMILIYA';
                certificateName.textContent = name.toUpperCase();
            });
        }

        // Form submission with AJAX
        if (certificateForm) {
            certificateForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');

                // Disable submit button
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Yaratilmoqda...';

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Update success message
                            successMessage.textContent = data.message || 'Sertifikatingiz muvaffaqiyatli yaratildi.';
                            
                            // Set download link
                            if (data.download_url) {
                                downloadButton.href = data.download_url;
                                downloadButton.target = '_blank'; // Yangi tabda ochish
                                downloadButton.onclick = null; // Oldingi onclick ni olib tashlash
                            }
                            
                            // Show success modal
                            successModal.classList.remove('hidden');
                        } else {
                            alert(data.message || 'Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const errorMessage = error.message || 'Server xatosi';
                        alert('Xatolik yuz berdi: ' + errorMessage);
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Sertifikatni olish';
                    });
            });
        }

        // Close modal when clicking outside
        successModal.addEventListener('click', function(e) {
            if (e.target === successModal) {
                successModal.classList.add('hidden');
            }
        });

        // Download button bosilganda yangi tabda ochish
        if (downloadButton) {
            downloadButton.addEventListener('click', function(e) {
                if (this.href && this.href !== '#') {
                    // Yangi tabda ochish
                    window.open(this.href, '_blank');
                    successModal.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush