<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $course->title }} - Questions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-700">ตอบคำถามต่อไปนี้</h3>
                <form action="{{ route('courses.submit', $course->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @foreach ($course->questions as $question)
                        <div class="mb-6 border-b pb-4">
                            <p class="text-lg font-medium text-gray-800 mb-3">{{ $question->question_text }}</p>
                            <div class="space-y-2">
                                <label class="flex items-center space-x-2 bg-gray-100 p-2 rounded-lg cursor-pointer hover:bg-gray-200">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="a" class="form-radio">
                                    <span>{{ $question->option_a }}</span>
                                </label>
                                <label class="flex items-center space-x-2 bg-gray-100 p-2 rounded-lg cursor-pointer hover:bg-gray-200">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="b" class="form-radio">
                                    <span>{{ $question->option_b }}</span>
                                </label>
                                <label class="flex items-center space-x-2 bg-gray-100 p-2 rounded-lg cursor-pointer hover:bg-gray-200">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="c" class="form-radio">
                                    <span>{{ $question->option_c }}</span>
                                </label>
                                <label class="flex items-center space-x-2 bg-gray-100 p-2 rounded-lg cursor-pointer hover:bg-gray-200">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="d" class="form-radio">
                                    <span>{{ $question->option_d }}</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">ส่งคำตอบ</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
