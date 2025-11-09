@extends('layouts.app')

@section('title', $lesson->title . ' - Test - EvalEd')

@section('content')
<!-- Page Header -->
<section class="bg-white py-8 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                                <i class="fas fa-home mr-2"></i>
                                Bosh sahifa
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400"></i>
                                <a href="{{ route('lessons.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Darslar</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400"></i>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $lesson->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $lesson->title }} - Test</h1>
                <p class="text-gray-600">Dars materiallarini o'rganganingizni tekshiring</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center">
                <div class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-lg">
                    <i class="far fa-clock mr-2"></i>
                    <span id="timer">00:00</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quiz Section -->
<section class="py-8 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Quiz Info Card -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Test Talablari</h2>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="far fa-question-circle mr-2 text-indigo-600"></i>
                                <span>{{ $quizzes->count() }} ta savol</span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-check-circle mr-2 text-green-600"></i>
                                <span>Minimum 70% to'g'ri javob</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-redo mr-2 text-blue-600"></i>
                                <span>Cheklovsiz urinishlar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg">
                        <div class="text-sm font-medium">Sertifikat olish uchun</div>
                        <div class="font-bold text-lg">70% dan yuqori ball</div>
                    </div>
                </div>
            </div>

            <!-- Quiz Form -->
            <form id="quizForm" class="bg-white rounded-xl shadow-md overflow-hidden">
                @csrf

                <!-- Progress Bar -->
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Test progressi</span>
                        <span class="text-sm font-medium text-gray-700">
                            <span id="currentQuestion">1</span> / {{ $quizzes->count() }}
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="quizProgress" class="bg-indigo-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>

                <!-- Questions -->
                <div class="p-6">
                    @foreach($quizzes as $index => $quiz)
                    <div class="quiz-question mb-8 {{ $index === 0 ? 'active' : 'hidden' }}" data-question="{{ $index + 1 }}">
                        <div class="flex items-start mb-6">
                            <span class="bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3 flex-shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $quiz->question }}</h3>
                        </div>

                        @if($quiz->image)
                        <div class="mb-6">
                            <img src="{{ Storage::url($quiz->image) }}" alt="Savol uchun rasm" class="rounded-lg max-w-full h-auto">
                        </div>
                        @endif

                        <div class="space-y-3">
                            @foreach(['a', 'b', 'c', 'd'] as $option)
                            @if($quiz->{'option_'.$option})
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                <input type="radio" id="quiz_{{ $quiz->id }}_{{ $option }}" name="answers[{{ $quiz->id }}]" value="{{ $option }}" class="hidden peer">
                                <label for="quiz_{{ $quiz->id }}_{{ $option }}" class="flex items-center w-full cursor-pointer">
                                    <span class="bg-gray-100 text-gray-800 rounded w-8 h-8 flex items-center justify-center text-sm font-medium mr-3 peer-checked:bg-indigo-600 peer-checked:text-white transition">
                                        {{ strtoupper($option) }}
                                    </span>
                                    <span class="text-gray-700 peer-checked:font-medium">{{ $quiz->{'option_'.$option} }}</span>
                                </label>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        <!-- Navigation -->
                        <div class="flex justify-between mt-8 pt-6 border-t">
                            <button type="button" class="prev-question-btn bg-gray-100 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-200 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center {{ $index === 0 ? 'invisible' : '' }}">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Oldingi
                            </button>

                            @if($index === $quizzes->count() - 1)
                            <button type="button" id="submitQuiz" class="bg-green-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-green-700 transition flex items-center">
                                Testni Yakunlash
                                <i class="fas fa-check ml-2"></i>
                            </button>
                            @else
                            <button type="button" class="next-question-btn bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition flex items-center">
                                Keyingi
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>

            <!-- Quiz Tips -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start">
                    <i class="fas fa-lightbulb text-blue-600 text-xl mt-1 mr-3"></i>
                    <div>
                        <h3 class="font-semibold text-blue-800 mb-2">Test berish bo'yicha maslahatlar</h3>
                        <ul class="text-blue-700 space-y-1 text-sm">
                            <li>• Barcha savollarga javob bering</li>
                            <li>• Vaqtingizni samarali taqsimlang</li>
                            <li>• Savollarni diqqat bilan o'qing</li>
                            <li>• Dars materiallarini qayta ko'rib chiqing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Results Modal -->
<div id="resultsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
        <div class="p-6 text-center">
            <div id="resultIcon" class="text-6xl mb-4">
                <!-- Icon will be set dynamically -->
            </div>
            <h3 id="resultTitle" class="text-2xl font-bold mb-2"></h3>
            <p id="resultMessage" class="text-gray-600 mb-6"></p>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-700">Sizning balingiz:</span>
                    <span id="resultScore" class="text-xl font-bold"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div id="resultProgress" class="h-3 rounded-full"></div>
                </div>
                <div class="flex justify-between text-sm text-gray-600 mt-1">
                    <span>0%</span>
                    <span>100%</span>
                </div>
            </div>

            <div class="flex flex-col space-y-3">
                <a href="{{ route('lessons.show', $lesson->id) }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition flex items-center justify-center">
                    <i class="fas fa-book-open mr-2"></i>
                    Darsga Qaytish
                </a>
                <a href="{{ route('lessons.index') }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition flex items-center justify-center">
                    <i class="fas fa-list mr-2"></i>
                    Barcha Darslar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quiz navigation
        const questions = document.querySelectorAll('.quiz-question');
        const prevButtons = document.querySelectorAll('.prev-question-btn');
        const nextButtons = document.querySelectorAll('.next-question-btn');
        const currentQuestionSpan = document.getElementById('currentQuestion');
        const quizProgress = document.getElementById('quizProgress');
        const submitButton = document.getElementById('submitQuiz');
        const quizForm = document.getElementById('quizForm');
        const resultsModal = document.getElementById('resultsModal');

        let currentQuestion = 1;
        const totalQuestions = questions.length;

        // Update progress
        function updateProgress() {
            const progress = ((currentQuestion - 1) / totalQuestions) * 100;
            quizProgress.style.width = progress + '%';
            currentQuestionSpan.textContent = currentQuestion;
        }

        // Show question
        function showQuestion(index) {
            questions.forEach((question, i) => {
                if (i === index - 1) {
                    question.classList.remove('hidden');
                    question.classList.add('active');
                } else {
                    question.classList.add('hidden');
                    question.classList.remove('active');
                }
            });

            // Update navigation buttons
            const prevBtn = document.querySelector('.active .prev-question-btn');
            const nextBtn = document.querySelector('.active .next-question-btn');

            if (prevBtn) {
                prevBtn.disabled = index === 1;
            }

            updateProgress();
        }

        // Next question
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (currentQuestion < totalQuestions) {
                    currentQuestion++;
                    showQuestion(currentQuestion);
                }
            });
        });

        // Previous question
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (currentQuestion > 1) {
                    currentQuestion--;
                    showQuestion(currentQuestion);
                }
            });
        });

        // Radio button selection styling
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove all checked styles from siblings
                const parent = this.closest('.flex.items-center');
                parent.parentElement.querySelectorAll('.flex.items-center').forEach(div => {
                    const span = div.querySelector('span:first-child');
                    span.classList.remove('bg-indigo-600', 'text-white');
                    span.classList.add('bg-gray-100', 'text-gray-800');
                });

                // Add checked style to selected
                const selectedSpan = parent.querySelector('span:first-child');
                selectedSpan.classList.remove('bg-gray-100', 'text-gray-800');
                selectedSpan.classList.add('bg-indigo-600', 'text-white');
            });
        });

        // Timer functionality
        let startTime = Date.now();
        const timerElement = document.getElementById('timer');

        function updateTimer() {
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            const minutes = Math.floor(elapsed / 60);
            const seconds = elapsed % 60;
            timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        setInterval(updateTimer, 1000);

        // Submit quiz
        submitButton.addEventListener('click', function() {
            const formData = new FormData(quizForm);
            const answers = {};

            // Collect answers
            document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                const name = radio.name.match(/answers\[(\d+)\]/)[1];
                answers[name] = radio.value;
            });

            // Check if all questions are answered
            if (Object.keys(answers).length < totalQuestions) {
                if (!confirm(`${totalQuestions - Object.keys(answers).length} ta savolga javob bermagansiz. Testni shu holatda yakunlamoqchimisiz?`)) {
                    return;
                }
            }

            // Disable submit button
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Jo\'natilmoqda...';

            // Submit via AJAX
            fetch('{{ route("quiz.submit", $lesson->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        answers: answers
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showResults(data);
                    } else {
                        alert('Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.');
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Testni Yakunlash <i class="fas fa-check ml-2"></i>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.');
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Testni Yakunlash <i class="fas fa-check ml-2"></i>';
                });
        });

        // Show results
        function showResults(data) {
            const score = data.score;
            const correctAnswers = data.correct_answers;
            const totalQuestions = data.total_questions;

            // Set result elements
            document.getElementById('resultScore').textContent = `${score}% (${correctAnswers}/${totalQuestions})`;
            document.getElementById('resultProgress').style.width = `${score}%`;

            // Determine pass/fail
            if (score >= 70) {
                document.getElementById('resultIcon').innerHTML = '<i class="fas fa-trophy text-yellow-500"></i>';
                document.getElementById('resultTitle').textContent = 'Tabriklaymiz!';
                document.getElementById('resultTitle').className = 'text-2xl font-bold mb-2 text-green-600';
                document.getElementById('resultMessage').textContent = 'Siz testdan muvaffaqiyatli o\'tdingiz va sertifikat olish huquqiga ega bo\'ldingiz!';
                document.getElementById('resultProgress').className = 'h-3 rounded-full bg-green-500';
            } else {
                document.getElementById('resultIcon').innerHTML = '<i class="fas fa-redo-alt text-blue-500"></i>';
                document.getElementById('resultTitle').textContent = 'Qaytadan Urinib Ko\'ring';
                document.getElementById('resultTitle').className = 'text-2xl font-bold mb-2 text-blue-600';
                document.getElementById('resultMessage').textContent = 'Siz testdan o\'ta olmadingiz. Dars materiallarini qayta ko\'rib, qaytadan urinib ko\'ring.';
                document.getElementById('resultProgress').className = 'h-3 rounded-full bg-blue-500';
            }

            // Show modal
            resultsModal.classList.remove('hidden');
        }

        // Close modal when clicking outside
        resultsModal.addEventListener('click', function(e) {
            if (e.target === resultsModal) {
                resultsModal.classList.add('hidden');
            }
        });

        // Initialize first question
        showQuestion(1);
    });
</script>

<style>
    .quiz-question {
        transition: all 0.3s ease;
    }

    .card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .progress-bar {
        transition: width 0.5s ease;
    }

    input[type="radio"]:checked+label span:first-child {
        background-color: #4f46e5;
        color: white;
    }
</style>