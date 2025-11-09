@extends('layouts.app')

@section('title', $exercise->title . ' - EvalEd')

@section('styles')
<style>
    .rubric-table {
        border-collapse: collapse;
        width: 100%;
    }
    .rubric-table th, .rubric-table td {
        border: 1px solid #e5e7eb;
        padding: 12px;
        text-align: left;
    }
    .rubric-table th {
        background-color: #f9fafb;
        font-weight: 600;
    }
    .level-btn {
        transition: all 0.3s ease;
    }
    .level-btn:hover {
        background-color: #f3f4f6;
    }
    .level-btn.selected {
        background-color: #4f46e5;
        color: white;
    }
    .comment-box {
        transition: all 0.3s ease;
    }
    .comment-box:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
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
                        <a href="{{ route('exercises.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Mashqlar</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $exercise->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Exercise Header -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $exercise->title }}</h1>
                    <p class="text-gray-600">{{ $exercise->lesson->title }} darsi uchun amaliy mashq</p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center space-x-4">
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Davomiylik</div>
                        <div class="text-lg font-bold text-indigo-600">{{ $exercise->duration }} daqiqa</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Qiyinlik</div>
                        <div class="text-lg font-bold text-gray-800 capitalize">{{ $exercise->difficulty }}</div>
                    </div>
                </div>
            </div>

            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                <div class="bg-indigo-600 h-2.5 rounded-full progress-bar" style="width: 60%"></div>
            </div>
            <div class="flex justify-between text-sm text-gray-500">
                <span>Progress</span>
                <span>60%</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Task Description -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Topshiriq Tavsifi</h2>
                    <div class="prose max-w-none">
                        <p><strong>Topshiriq:</strong> "Global isish haqida insho yozing"</p>
                        <p><strong>Talaba:</strong> Aziza</p>
                        <p><strong>Talablar:</strong></p>
                        <ul class="list-disc list-inside text-gray-600">
                            <li>500 so'zlik insho</li>
                            <li>Ilmiy ma'lumotlardan foydalanish</li>
                            <li>Mantiqiy tuzilish</li>
                            <li>Grammatik to'g'rilik</li>
                        </ul>
                    </div>
                </div>

                <!-- Student Work -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Talaba Ishi</h2>
                    
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold text-gray-800 mb-3">"Global Isish - Zamonaviy Muammo"</h3>
                        <div class="text-gray-700 space-y-4">
                            <p>Global isish - bu Yer sayyorasining haroratining ko'tarilishi. Bu sanoat inqilobidan keyin boshlangan. Ko'p mamlakatlar bu muammoni hal qilish uchun kelishmovchiliklar mavjud.</p>
                            
                            <p>Global isishga asosan insoniyat sabab bo'lmoqda. Fabrikalar, avtomobillar va boshqa sanoat obyektlari ko'p miqdorda uglerod dioksid chiqaradi. Bu gazlar atmosferada qoplanib, issiqlikni saqlab qoladi.</p>
                            
                            <p>Global isishning oqibatlari juda xavfli. Muzliklar eriydi, dengiz sathi ko'tariladi va ob-havo o'zgaradi. Ba'zi joylarda qurg'oqchilik, boshqa joylarda esa kuchli yog'ingarchilik bo'ladi.</p>
                            
                            <p>Bu muammoni hal qilish uchun hamma mamlakatlar birgalikda ishlashi kerak. Qayta tiklanadigan energiya manbalaridan foydalanish, daraxt ekish va energiya tejash muhim.</p>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600"><strong>So'zlar soni:</strong> 248 so'z</p>
                        </div>
                    </div>
                </div>

                <!-- Rubric Table -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Baholash Rubrikasi</h2>
                    <p class="text-gray-600 mb-6">Quyidagi rubrika asosida talaba ishini baholang. Har bir mezon uchun mos darajani tanlang va izoh qoldiring.</p>

                    <div class="overflow-x-auto">
                        <table class="rubric-table">
                            <thead>
                                <tr>
                                    <th class="w-1/4">Mezon</th>
                                    <th class="w-1/5">4 - A'lo</th>
                                    <th class="w-1/5">3 - Yaxshi</th>
                                    <th class="w-1/5">2 - Qoniqarli</th>
                                    <th class="w-1/5">1 - Qoniqarsiz</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Criterion 1 -->
                                <tr>
                                    <td class="font-medium">
                                        <div>Mazmun va tushuncha</div>
                                        <div class="text-xs text-gray-500 font-normal">Mavzuni chuqur tushunish va ilmiy ma'lumotlardan foydalanish</div>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="1" data-level="4">
                                            Mavzu mukammal tushuntirilgan, ilmiy ma'lumotlar aniq keltirilgan
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="1" data-level="3">
                                            Mavzu yaxshi tushuntirilgan, ba'zi ilmiy ma'lumotlar keltirilgan
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="1" data-level="2">
                                            Mavzu soddalashtirilgan, ilmiy ma'lumotlar kam
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="1" data-level="1">
                                            Mavzu yomon tushuntirilgan, ilmiy ma'lumotlar yo'q
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Criterion 2 -->
                                <tr>
                                    <td class="font-medium">
                                        <div>Tuzilish va mantiq</div>
                                        <div class="text-xs text-gray-500 font-normal">Matnning mantiqiy tuzilishi va paragraflar</div>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="2" data-level="4">
                                            Ankir kirish, asosiy qism va xulosa, mantiqiy tuzilish
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="2" data-level="3">
                                            Yaxshi tuzilish, biroq ba'zi mantiqiy xatolar
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="2" data-level="2">
                                            Tuzilishda kamchiliklar, mantiqiy bog'liqlik zaif
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="2" data-level="1">
                                            Tuzilish yo'q, mantiqiy bog'liqlik yo'q
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Criterion 3 -->
                                <tr>
                                    <td class="font-medium">
                                        <div>Til va uslub</div>
                                        <div class="text-xs text-gray-500 font-normal">Grammatik to'g'rilik va til xususiyatlari</div>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="3" data-level="4">
                                            Grammatik jihatdan mukammal, boy lug'at
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="3" data-level="3">
                                            Bir nechta grammatik xatolar, yaxshi lug'at
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="3" data-level="2">
                                            Ko'p grammatik xatolar, cheklangan lug'at
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="3" data-level="1">
                                            Ko'p xatolar, tushunish qiyin
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Criterion 4 -->
                                <tr>
                                    <td class="font-medium">
                                        <div>Talablarga muvofiqlik</div>
                                        <div class="text-xs text-gray-500 font-normal">So'zlar soni va topshiriq talablariga rioya qilish</div>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="4" data-level="4">
                                            Barcha talablar mukammal bajarilgan
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="4" data-level="3">
                                            Asosiy talablar bajarilgan, biroq kamchiliklar mavjud
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="4" data-level="2">
                                            Talablarning yarmi bajarilgan
                                        </button>
                                    </td>
                                    <td>
                                        <button class="level-btn w-full py-2 border border-gray-300 rounded text-sm" data-criterion="4" data-level="1">
                                            Talablar deyarli bajarilmagan
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Current Selections -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-medium text-blue-800 mb-2">Tanlangan Baholar</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span class="text-blue-700">Mazmun:</span>
                                <span class="font-medium ml-1" id="score-1">Tanlanmagan</span>
                            </div>
                            <div>
                                <span class="text-blue-700">Tuzilish:</span>
                                <span class="font-medium ml-1" id="score-2">Tanlanmagan</span>
                            </div>
                            <div>
                                <span class="text-blue-700">Til:</span>
                                <span class="font-medium ml-1" id="score-3">Tanlanmagan</span>
                            </div>
                            <div>
                                <span class="text-blue-700">Talablar:</span>
                                <span class="font-medium ml-1" id="score-4">Tanlanmagan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Overall Feedback -->
                    <div class="mt-6">
                        <label for="overallFeedback" class="block text-sm font-medium text-gray-700 mb-2">Umumiy Teskari Aloqa</label>
                        <textarea id="overallFeedback" rows="4" class="comment-box w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Talabaga umumiy teskari aloqa bering...">Aziza, siz global isish mavzusini yaxshi tushunganingiz ko'rinadi. Biroq, inshongizda ilmiy ma'lumotlar va statistikalar yetarli emas. Tuzilish jihatdan kirish, asosiy qism va xulosa aniq ajratilmagan. Grammatik jihatdan bir nechta xatolar mavjud. Keyingi safar so'zlar soniga va ilmiy ma'lumotlarning aniqligiga e'tibor bering.</textarea>
                    </div>

                    <!-- Final Score -->
                    <div class="mt-6 bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-medium text-gray-800">Yakuniy Baho</h4>
                                <p class="text-sm text-gray-600">16 ball maksimum</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-indigo-600" id="finalScore">0</div>
                                <div class="text-sm text-gray-600" id="finalGrade">Baholanmagan</div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex justify-between">
                        <button class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-save mr-2"></i> Qoralama Saqlash
                        </button>
                        <button onclick="submitExercise()" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-check-circle mr-2"></i> Baholashni Yakunlash
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Mashq Ma'lumotlari</h3>
                    
                    <div class="space-y-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Mashq turi</p>
                            <p class="font-medium text-gray-800 capitalize">{{ $exercise->task_type }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Fan</p>
                            <p class="font-medium text-gray-800">{{ $exercise->lesson->title }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Mavzu</p>
                            <p class="font-medium text-gray-800">Global isish</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Baholash turi</p>
                            <p class="font-medium text-gray-800">Summativ baholash</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Taxminiy vaqt</p>
                            <p class="font-medium text-gray-800">{{ $exercise->duration }} daqiqa</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-medium text-gray-800 mb-2">Baholash Ko'rsatkichlari</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Mezonlar soni:</span>
                                <span class="font-medium">4 ta</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Maksimal ball:</span>
                                <span class="font-medium">{{ $exercise->max_score }} ball</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Vaqt sarflandi:</span>
                                <span class="font-medium">12 daqiqa</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-lightbulb text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-yellow-800">Maslahat</h4>
                                <div class="mt-1 text-sm text-yellow-700">
                                    <p>Har bir mezon uchun talaba ishini diqqat bilan baholang. Teskari aloqada ijobiy va quritici fikrlarni muvozanatda bering.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('exercises.index') }}" class="w-full bg-gray-200 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-300 transition flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i> Mashqlar Ro'yxati
                        </a>
                        <button class="w-full bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Natijani Yuklab Olish
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let scores = {
    1: 0,
    2: 0,
    3: 0,
    4: 0
};

// Rubric functionality
document.addEventListener('DOMContentLoaded', function() {
    const levelButtons = document.querySelectorAll('.level-btn');
    const finalScoreElement = document.getElementById('finalScore');
    const finalGradeElement = document.getElementById('finalGrade');
    
    levelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const criterion = this.getAttribute('data-criterion');
            const level = parseInt(this.getAttribute('data-level'));
            
            // Remove selected class from all buttons in this row
            const row = this.closest('tr');
            const rowButtons = row.querySelectorAll('.level-btn');
            rowButtons.forEach(btn => btn.classList.remove('selected'));
            
            // Add selected class to clicked button
            this.classList.add('selected');
            
            // Update score for this criterion
            scores[criterion] = level;
            
            // Update score display
            document.getElementById(`score-${criterion}`).textContent = level + ' ball';
            
            // Calculate and update final score
            updateFinalScore();
        });
    });
    
    function updateFinalScore() {
        const totalScore = Object.values(scores).reduce((sum, score) => sum + score, 0);
        finalScoreElement.textContent = totalScore;
        
        // Determine grade based on total score
        let grade = '';
        if (totalScore >= 14) {
            grade = 'A\'lo (5)';
        } else if (totalScore >= 11) {
            grade = 'Yaxshi (4)';
        } else if (totalScore >= 8) {
            grade = 'Qoniqarli (3)';
        } else if (totalScore >= 5) {
            grade = 'Qoniqarsiz (2)';
        } else {
            grade = 'Yomon (1)';
        }
        
        finalGradeElement.textContent = grade;
    }
    
    // Initialize with some pre-selected values for demo
    setTimeout(() => {
        // Simulate pre-selected values
        const preSelectedButtons = document.querySelectorAll('[data-criterion="1"][data-level="3"], [data-criterion="2"][data-level="2"], [data-criterion="3"][data-level="3"], [data-criterion="4"][data-level="2"]');
        preSelectedButtons.forEach(button => {
            button.click();
        });
    }, 500);
});

function submitExercise() {
    const feedback = document.getElementById('overallFeedback').value;
    const totalScore = Object.values(scores).reduce((sum, score) => sum + score, 0);
    
    // Prepare data for submission
    const formData = {
        answers: scores,
        feedback: feedback,
        total_score: totalScore,
        _token: '{{ csrf_token() }}'
    };
    
    // Submit to server
    fetch('{{ route("exercises.submit", $exercise->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Mashq muvaffaqiyatli yakunlandi! Sizning balingiz: ' + data.score + '/' + data.max_score);
            // Redirect or show success message
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.');
    });
}
</script>
@endsection