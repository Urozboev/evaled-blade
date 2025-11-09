@extends('layouts.admin')

@section('title', 'Amaliy Mashqlar - EvalEd')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Amaliy Mashqlar</h1>
            <p class="text-gray-600">Barcha amaliy mashqlarni boshqarish</p>
        </div>
        <a href="{{ route('admin.exercises.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Yangi Mashq
        </a>
    </div>

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

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dars</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Turi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qiyinlik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Holati</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amallar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($exercises as $exercise)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $exercise->id }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $exercise->title }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($exercise->instruction, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $exercise->lesson->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $typeColors = [
                                    'rubric' => 'bg-purple-100 text-purple-800',
                                    'feedback' => 'bg-blue-100 text-blue-800',
                                    'match' => 'bg-green-100 text-green-800',
                                    'text' => 'bg-yellow-100 text-yellow-800'
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeColors[$exercise->task_type] }}">
                                {{ $exercise->task_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @php
                                $difficultyColors = [
                                    'easy' => 'text-green-600',
                                    'medium' => 'text-yellow-600',
                                    'hard' => 'text-red-600'
                                ];
                            @endphp
                            <span class="{{ $difficultyColors[$exercise->difficulty] }} capitalize">
                                {{ $exercise->difficulty }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($exercise->is_active)
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
                            <a href="{{ route('admin.exercises.edit', $exercise->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-edit"></i> Tahrirlash
                            </a>
                            <form action="{{ route('admin.exercises.destroy', $exercise->id) }}" method="POST" class="inline" onsubmit="return confirmDelete()">
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
    return confirm('Haqiqatan ham ushbu mashqni o\'chirmoqchimisiz?');
}
</script>
@endsection