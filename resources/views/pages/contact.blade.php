   @extends('layouts.app')

   @section('title', 'Aloqa - EvalEd')

   @section('content')
   <!-- Contact Section -->
   <section class="py-12 bg-white">
       <div class="container mx-auto px-4">
           <div class="max-w-6xl mx-auto">
               <div class="text-center mb-12">
                   <h1 class="text-3xl font-bold text-gray-800 mb-4">Biz bilan Bog'laning</h1>
                   <p class="text-gray-600 max-w-2xl mx-auto">Savollaringiz, takliflaringiz yoki muammolaringiz bo'lsa, bizga murojaat qiling. Biz sizga yordam berishdan mamnunmiz.</p>
               </div>

               <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                   <!-- Contact Information -->
                   <div class="lg:col-span-1">
                       <div class="bg-gray-50 rounded-xl p-6">
                           <h2 class="text-xl font-bold text-gray-800 mb-6">Aloqa Ma'lumotlari</h2>

                           <div class="space-y-6">
                               <div class="flex items-start">
                                   <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                                       <i class="fas fa-map-marker-alt text-indigo-600"></i>
                                   </div>
                                   <div>
                                       <h3 class="font-medium text-gray-800">Manzil</h3>
                                       <p class="text-gray-600">Guliston shahar,<br>Yunusobod tumani,<br>O'zbekiston</p>
                                   </div>
                               </div>

                               <div class="flex items-start">
                                   <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                       <i class="fas fa-phone text-green-600"></i>
                                   </div>
                                   <div>
                                       <h3 class="font-medium text-gray-800">Telefon</h3>
                                       <p class="text-gray-600">+998 71 123 45 67<br>+998 90 123 45 67</p>
                                   </div>
                               </div>

                               <div class="flex items-start">
                                   <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                       <i class="fas fa-envelope text-blue-600"></i>
                                   </div>
                                   <div>
                                       <h3 class="font-medium text-gray-800">Elektron Pochta</h3>
                                       <p class="text-gray-600">info@evaled.uz<br>support@evaled.uz</p>
                                   </div>
                               </div>

                               <div class="flex items-start">
                                   <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                       <i class="fas fa-clock text-purple-600"></i>
                                   </div>
                                   <div>
                                       <h3 class="font-medium text-gray-800">Ish Vaqti</h3>
                                       <p class="text-gray-600">Dushanba - Juma: 9:00 - 18:00<br>Shanba: 9:00 - 14:00</p>
                                   </div>
                               </div>
                           </div>

                           <div class="mt-8 pt-6 border-t border-gray-200">
                               <h3 class="font-medium text-gray-800 mb-4">Ijtimoiy Tarmoqlar</h3>
                               <div class="flex space-x-4">
                                   <a href="#" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-indigo-600 hover:text-white transition">
                                       <i class="fab fa-telegram"></i>
                                   </a>
                                   <a href="#" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-indigo-600 hover:text-white transition">
                                       <i class="fab fa-facebook-f"></i>
                                   </a>
                                   <a href="#" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-indigo-600 hover:text-white transition">
                                       <i class="fab fa-instagram"></i>
                                   </a>
                                   <a href="#" class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-indigo-600 hover:text-white transition">
                                       <i class="fab fa-youtube"></i>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>

                   <!-- Contact Form -->
                   <div class="lg:col-span-2">
                       <div class="bg-white rounded-xl shadow-lg p-6">
                           <h2 class="text-xl font-bold text-gray-800 mb-6">Xabar Qoldiring</h2>

                           <form id="contactForm">
                               <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                   <div>
                                       <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">Ism</label>
                                       <input type="text" id="firstName" name="firstName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ismingiz" required>
                                   </div>
                                   <div>
                                       <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Familiya</label>
                                       <input type="text" id="lastName" name="lastName" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Familiyangiz" required>
                                   </div>
                               </div>

                               <div class="mb-6">
                                   <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Elektron Pochta</label>
                                   <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="siz@example.uz" required>
                               </div>

                               <div class="mb-6">
                                   <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Mavzu</label>
                                   <select id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                                       <option value="">Mavzuni tanlang</option>
                                       <option value="technical">Texnik yordam</option>
                                       <option value="content">Kontent bilan bog'liq</option>
                                       <option value="suggestion">Taklif</option>
                                       <option value="partnership">Hamkorlik</option>
                                       <option value="other">Boshqa</option>
                                   </select>
                               </div>

                               <div class="mb-6">
                                   <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Xabar</label>
                                   <textarea id="message" name="message" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Xabaringizni bu yerga yozing..." required></textarea>
                               </div>

                               <div class="flex items-center mb-6">
                                   <input id="agree" name="agree" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" required>
                                   <label for="agree" class="ml-2 block text-sm text-gray-700">
                                       <a href="privacy.html" class="text-indigo-600 hover:text-indigo-500">Maxfiylik siyosati</a> va
                                       <a href="terms.html" class="text-indigo-600 hover:text-indigo-500">foydalanish shartlari</a> bilan tanishdim va roziman
                                   </label>
                               </div>

                               <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                   Xabarni Yuborish
                               </button>
                           </form>
                       </div>
                   </div>
               </div>

               <!-- FAQ Section -->
               <div class="mt-16">
                   <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Ko'p So'raladigan Savollar</h2>

                   <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                       <div class="bg-white rounded-xl shadow-sm p-6">
                           <h3 class="text-lg font-bold text-gray-800 mb-2">Platformadan qanday foydalansam bo'ladi?</h3>
                           <p class="text-gray-600">Platformadan foydalanish uchun ro'yxatdan o'tish shart emas. Bosh sahifadan darslarni tanlab, o'rganishni boshlashingiz mumkin.</p>
                       </div>

                       <div class="bg-white rounded-xl shadow-sm p-6">
                           <h3 class="text-lg font-bold text-gray-800 mb-2">Sertifikat olish uchun qanday shartlar bajarilishi kerak?</h3>
                           <p class="text-gray-600">Sertifikat olish uchun barcha darslarni tugatishingiz va testlardan kamida 70% ball to'plashingiz kerak.</p>
                       </div>

                       <div class="bg-white rounded-xl shadow-sm p-6">
                           <h3 class="text-lg font-bold text-gray-800 mb-2">Platforma bepulmi?</h3>
                           <p class="text-gray-600">Ha, EvalEd platformasi butunlay bepul. Barcha darslar, mashqlar va simulyatorlar bepul foydalanish uchun ochiq.</p>
                       </div>

                       <div class="bg-white rounded-xl shadow-sm p-6">
                           <h3 class="text-lg font-bold text-gray-800 mb-2">Texnik muammolar bo'lsa kimga murojaat qilish kerak?</h3>
                           <p class="text-gray-600">Texnik muammolar bo'yicha support@evaled.uz manziliga yozishingiz yoki +998 71 123 45 67 telefon raqamiga qo'ng'iroq qilishingiz mumkin.</p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>

   @endsection