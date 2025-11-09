@extends('layouts.app')

@section('title', $simulator->title . ' - EvalEd')

@section('styles')
<style>
    .student-answer {
        transition: all 0.3s ease;
    }
    .student-answer:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .criteria-item {
        transition: all 0.3s ease;
    }
    .criteria-item:hover {
        background-color: #f8fafc;
    }
    .rating-btn {
        transition: all 0.2s ease;
    }
    .rating-btn.active {
        background-color: #4f46e5;
        color: white;
    }
    .sticky-sidebar {
        position: sticky;
        top: 6rem;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-home mr-2"></i>
                        Bosh sahifa
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('simulators.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Simulyatorlar</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $simulator->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Simulator Header -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $simulator->title }}</h1>
                    <p class="text-gray-600">{{ $simulator->description }}</p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center space-x-4">
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Baholangan</div>
                        <div class="text-lg font-bold text-indigo-600">2/3</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Qiyinlik</div>
                        <div class="text-lg font-bold text-gray-800 capitalize">{{ $simulator->difficulty }}</div>
                    </div>
                </div>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                <div class="bg-indigo-600 h-2.5 rounded-full progress-bar" style="width: 67%"></div>
            </div>
            <div class="flex justify-between text-sm text-gray-500">
                <span>Progress</span>
                <span>67%</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Task Description -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Topshiriq Tavsifi</h2>
                    <div class="prose max-w-none">
                        <p><strong>Mavzu:</strong> Kasrlar bilan amallar</p>
                        <p><strong>Topshiriq:</strong> Quyidagi masalani yeching: 2/3 + 1/4 = ?</p>
                        <p><strong>Talablar:</strong></p>
                        <ul class="list-disc list-inside text-gray-600">
                            <li>Yechim qadamlarini ko'rsating</li>
                            <li>Javobni soddalashtiring</li>
                            <li>Izoh qoldiring (agar kerak bo'lsa)</li>
                        </ul>
                    </div>
                </div>

                <!-- Student Answers -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">O'quvchilar Javoblari</h2>
                    
                    <!-- Student 1 -->
                    <div class="student-answer border border-gray-200 rounded-lg p-6 mb-6" id="student-1">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Aziza</h3>
                                    <p class="text-sm text-gray-600">10 daqiqa oldin topshirgan</p>
                                </div>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">Baholash kerak</span>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <h4 class="font-medium text-gray-800 mb-2">Aziza ning javobi:</h4>
                            <p class="text-gray-700">2/3 + 1/4 = 3/7</p>
                        </div>

                        <!-- Rubric Criteria -->
                        <div class="mb-6">
                            <h4 class="font-bold text-gray-800 mb-3">Baholash Mezonlari</h4>
                            
                            <div class="space-y-4">
                                <!-- Criterion 1 -->
                                <div class="criteria-item border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h5 class="font-medium text-gray-800">Umumiy tushuncha</h5>
                                            <p class="text-sm text-gray-600">Kasrlarni qo'shishning asosiy tamoyilini tushunish</p>
                                        </div>
                                        <span class="score-display bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">2 ball</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        @foreach([1,2,3,4,5] as $score)
                                        <button class="rating-btn px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" 
                                                data-student="1" 
                                                data-criterion="1" 
                                                data-value="{{ $score }}">
                                            {{ $score }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Criterion 2 -->
                                <div class="criteria-item border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h5 class="font-medium text-gray-800">Maxrajlarni tenglashtirish</h5>
                                            <p class="text-sm text-gray-600">Kasrlarni qo'shishdan oldin maxrajlarni tenglashtirish</p>
                                        </div>
                                        <span class="score-display bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">0 ball</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        @foreach([1,2,3,4,5] as $score)
                                        <button class="rating-btn px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" 
                                                data-student="1" 
                                                data-criterion="2" 
                                                data-value="{{ $score }}">
                                            {{ $score }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Criterion 3 -->
                                <div class="criteria-item border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h5 class="font-medium text-gray-800">To'g'ri javob</h5>
                                            <p class="text-sm text-gray-600">Masalaga to'g'ri javob berish</p>
                                        </div>
                                        <span class="score-display bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded">0 ball</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        @foreach([1,2,3,4,5] as $score)
                                        <button class="rating-btn px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" 
                                                data-student="1" 
                                                data-criterion="3" 
                                                data-value="{{ $score }}">
                                            {{ $score }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback -->
                        <div class="mb-4">
                            <label for="feedback-1" class="block text-sm font-medium text-gray-700 mb-2">Teskari Aloqa</label>
                            <textarea id="feedback-1" rows="3" class="feedback-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Aziza ga teskari aloqa bering..."></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button class="save-rating-btn px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium" data-student="1">
                                Baholashni Saqlash
                            </button>
                        </div>
                    </div>

                    <!-- Student 2 (Completed) -->
                    <div class="student-answer border border-green-200 rounded-lg p-6 mb-6 bg-green-50">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Javohir</h3>
                                    <p class="text-sm text-gray-600">12 daqiqa oldin topshirgan</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">Baholangan</span>
                        </div>

                        <div class="bg-white rounded-lg p-4 mb-4">
                            <h4 class="font-medium text-gray-800 mb-2">Javohir ning javobi:</h4>
                            <p class="text-gray-700">2/3 + 1/4 = 8/12 + 3/12 = 11/12</p>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="font-medium text-green-800">Sizning bahoyingiz: 14/15 ball</span>
                            </div>
                            <p class="text-green-700 text-sm">Ajoyib ish! Javohir kasrlarni qo'shishni mukammal tushunib, to'g'ri yechim bergan.</p>
                        </div>
                    </div>

                    <!-- Student 3 -->
                    <div class="student-answer border border-gray-200 rounded-lg p-6" id="student-3">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Dilshod</h3>
                                    <p class="text-sm text-gray-600">15 daqiqa oldin topshirgan</p>
                                </div>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">Baholash kerak</span>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <h4 class="font-medium text-gray-800 mb-2">Dilshod ning javobi:</h4>
                            <p class="text-gray-700">2/3 + 1/4 = 0.666 + 0.25 = 0.916</p>
                        </div>

                        <!-- Rubric Criteria for Dilshod -->
                        <div class="mb-6">
                            <h4 class="font-bold text-gray-800 mb-3">Baholash Mezonlari</h4>
                            
                            <div class="space-y-4">
                                <!-- Criterion 1 -->
                                <div class="criteria-item border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h5 class="font-medium text-gray-800">Umumiy tushuncha</h5>
                                            <p class="text-sm text-gray-600">Kasrlarni qo'shishning asosiy tamoyilini tushunish</p>
                                        </div>
                                        <span class="score-display bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded">Baholanmagan</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        @foreach([1,2,3,4,5] as $score)
                                        <button class="rating-btn px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" 
                                                data-student="3" 
                                                data-criterion="1" 
                                                data-value="{{ $score }}">
                                            {{ $score }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Criterion 2 -->
                                <div class="criteria-item border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h5 class="font-medium text-gray-800">Maxrajlarni tenglashtirish</h5>
                                            <p class="text-sm text-gray-600">Kasrlarni qo'shishdan oldin maxrajlarni tenglashtirish</p>
                                        </div>
                                        <span class="score-display bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded">Baholanmagan</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        @foreach([1,2,3,4,5] as $score)
                                        <button class="rating-btn px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" 
                                                data-student="3" 
                                                data-criterion="2" 
                                                data-value="{{ $score }}">
                                            {{ $score }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Criterion 3 -->
                                <div class="criteria-item border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h5 class="font-medium text-gray-800">To'g'ri javob</h5>
                                            <p class="text-sm text-gray-600">Masalaga to'g'ri javob berish</p>
                                        </div>
                                        <span class="score-display bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded">Baholanmagan</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        @foreach([1,2,3,4,5] as $score)
                                        <button class="rating-btn px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" 
                                                data-student="3" 
                                                data-criterion="3" 
                                                data-value="{{ $score }}">
                                            {{ $score }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback for Dilshod -->
                        <div class="mb-4">
                            <label for="feedback-3" class="block text-sm font-medium text-gray-700 mb-2">Teskari Aloqa</label>
                            <textarea id="feedback-3" rows="3" class="feedback-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Dilshod ga teskari aloqa bering..."></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button class="save-rating-btn px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium" data-student="3">
                                Baholashni Saqlash
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky-sidebar">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Simulyator Ma'lumotlari</h3>
                    
                    <div class="space-y-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Fan</p>
                            <p class="font-medium text-gray-800">{{ $simulator->subject }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Mavzu</p>
                            <p class="font-medium text-gray-800">Kasrlar bilan amallar</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Baholash turi</p>
                            <p class="font-medium text-gray-800">Formativ baholash</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">O'quvchilar soni</p>
                            <p class="font-medium text-gray-800">{{ $simulator->student_count }} ta</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Taxminiy vaqt</p>
                            <p class="font-medium text-gray-800">{{ $simulator->duration }} daqiqa</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-medium text-gray-800 mb-2">Baholash Ko'rsatkichlari</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Baholangan:</span>
                                <span class="font-medium">2/3</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>O'rtacha ball:</span>
                                <span class="font-medium">14/15</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Vaqt sarflandi:</span>
                                <span class="font-medium">18 daqiqa</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-lightbulb text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-blue-800">Maslahat</h4>
                                <div class="mt-1 text-sm text-blue-700">
                                    <p>Har bir o'quvchi javobini diqqat bilan o'qib, rubrika asosida baholang. Teskari aloqada konstruktiv bo'ling.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button onclick="completeSimulator()" class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i> Simulyatorni Yakunlash
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Store ratings data
let ratings = {
    1: {1: 2, 2: 0, 3: 0}, // Aziza: criterion1=2, criterion2=0, criterion3=0
    3: {1: 0, 2: 0, 3: 0}  // Dilshod: all criteria unrated
};

// Rating buttons functionality
document.addEventListener('DOMContentLoaded', function() {
    const ratingButtons = document.querySelectorAll('.rating-btn');
    
    ratingButtons.forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.getAttribute('data-student');
            const criterion = this.getAttribute('data-criterion');
            const value = parseInt(this.getAttribute('data-value'));
            
            // Update ratings data
            ratings[studentId][criterion] = value;
            
            // Remove active class from all buttons in this criteria
            const parent = this.closest('.criteria-item');
            const allButtons = parent.querySelectorAll('.rating-btn');
            allButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Update score display
            const scoreSpan = parent.querySelector('.score-display');
            if (scoreSpan) {
                scoreSpan.textContent = value + ' ball';
                scoreSpan.className = 'score-display bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded';
            }
            
            // Update progress
            updateProgress();
        });
    });

    // Save rating buttons
    const saveButtons = document.querySelectorAll('.save-rating-btn');
    saveButtons.forEach(button => {
        button.addEventListener('click', function() {
            const studentId = this.getAttribute('data-student');
            saveStudentRating(studentId);
        });
    });

    // Initialize with pre-selected values for demo
    initializeDemoRatings();
});

function initializeDemoRatings() {
    // Set Aziza's initial ratings
    setTimeout(() => {
        const azizaButtons = document.querySelectorAll('[data-student="1"][data-criterion="1"][data-value="2"]');
        azizaButtons.forEach(button => button.click());
    }, 100);
}

function updateProgress() {
    // Calculate progress based on rated students
    let ratedCount = 0;
    Object.keys(ratings).forEach(studentId => {
        const studentRatings = ratings[studentId];
        const hasRatings = Object.values(studentRatings).some(score => score > 0);
        if (hasRatings) ratedCount++;
    });

    const progress = (ratedCount / Object.keys(ratings).length) * 100;
    const progressBar = document.querySelector('.progress-bar');
    const progressText = document.querySelector('.flex.justify-between.text-sm.text-gray-500 span:last-child');
    
    if (progressBar) progressBar.style.width = progress + '%';
    if (progressText) progressText.textContent = Math.round(progress) + '%';
}

function saveStudentRating(studentId) {
    const feedback = document.getElementById(`feedback-${studentId}`).value;
    const studentRatings = ratings[studentId];
    
    // Calculate total score
    const totalScore = Object.values(studentRatings).reduce((sum, score) => sum + score, 0);
    const maxScore = Object.keys(studentRatings).length * 5;
    
    // Prepare data for submission
    const formData = {
        ratings: studentRatings,
        feedback: feedback,
        student_id: studentId,
        _token: '{{ csrf_token() }}'
    };
    
    // Show loading state
    const saveButton = document.querySelector(`[data-student="${studentId}"]`);
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saqlanmoqda...';
    saveButton.disabled = true;
    
    // Submit to server
    fetch('{{ route("simulators.evaluate", $simulator->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI to show completed state
            const studentElement = document.getElementById(`student-${studentId}`);
            const statusSpan = studentElement.querySelector('.bg-yellow-100');
            
            if (statusSpan) {
                statusSpan.className = 'bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full';
                statusSpan.textContent = 'Baholangan';
            }
            
            // Show success message
            showSuccessMessage(`Aziza baholandi! Umumiy ball: ${totalScore}/${maxScore} (${data.percentage}%)`);
            
            // Update progress
            updateProgress();
        } else {
            alert('Xatolik yuz berdi: ' + (data.message || 'Noma\'lum xatolik'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.');
    })
    .finally(() => {
        // Restore button state
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
}

function completeSimulator() {
    const unratedStudents = Object.keys(ratings).filter(studentId => {
        const studentRatings = ratings[studentId];
        return Object.values(studentRatings).some(score => score === 0);
    });
    
    if (unratedStudents.length > 0) {
        if (!confirm(`${unratedStudents.length} ta o'quvchi hali baholanmagan. Simulyatorni shu holatda yakunlamoqchimisiz?`)) {
            return;
        }
    }
    
    // Calculate overall score
    let totalScore = 0;
    let maxScore = 0;
    
    Object.keys(ratings).forEach(studentId => {
        const studentRatings = ratings[studentId];
        const studentTotal = Object.values(studentRatings).reduce((sum, score) => sum + score, 0);
        const studentMax = Object.keys(studentRatings).length * 5;
        
        totalScore += studentTotal;
        maxScore += studentMax;
    });
    
    const percentage = maxScore > 0 ? Math.round((totalScore / maxScore) * 100) : 0;
    
    // Show completion message
    showSuccessMessage(`Simulyator muvaffaqiyatli yakunlandi! Sizning umumiy balingiz: ${totalScore}/${maxScore} (${percentage}%)`);
    
    // Redirect after delay
    setTimeout(() => {
        window.location.href = '{{ route("simulators.index") }}';
    }, 2000);
}

function showSuccessMessage(message) {
    // Create success notification
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300';
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endpush