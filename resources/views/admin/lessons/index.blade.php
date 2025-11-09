@extends('layouts.admin')

@section('title', 'Darslarni Boshqarish - EvalEd')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Darslar</h1>
            <p class="text-gray-600">Barcha darslarni boshqarish</p>
        </div>
        <a href="{{ route('admin.lessons.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Yangi Dars
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Muvaffaqiyatli</h3>
                <div class="mt-1 text-sm text-green-700">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Lessons Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Davomiylik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tartib</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Holati</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amallar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($lessons as $lesson)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $lesson->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($lesson->image)
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-lg object-cover" src="{{ Storage::url($lesson->image) }}" alt="{{ $lesson->title }}">
                                </div>
                                @else
                                <div class="h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-book text-indigo-600"></i>
                                </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $lesson->title }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($lesson->description, 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $lesson->duration }} daqiqa</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $lesson->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($lesson->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Faol
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Nofaol
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-edit"></i> Tahrirlash
                            </a>
                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" class="inline" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i> O'chirish
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function confirmDelete() {
    return confirm('Haqiqatan ham ushbu darsni o\'chirmoqchimisiz? Bu amalni ortga qaytarib bo\'lmaydi.');
}
</script>
@endsection