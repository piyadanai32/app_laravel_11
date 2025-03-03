<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('แก้ไขคอร์ส') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label class="block text-gray-700">ชื่อคอร์ส:</label>
                            <input type="text" name="title" value="{{ $course->title }}" class="w-full border rounded p-2">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">คำอธิบาย:</label>
                            <textarea name="description" class="w-full border rounded p-2">{{ $course->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">รูปปกคอร์ส:</label>
                            <input type="file" name="thumbnail" class="w-full border rounded p-2">
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="mt-2 w-32">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">ลิงก์ YouTube:</label>
                            <input type="text" name="youtube_link" value="{{ $course->youtube_link }}" class="w-full border rounded p-2">
                        </div>

                        <div id="questions-container">
                            <h3 class="text-lg font-semibold mb-4">Questions</h3>
                            @foreach($course->questions as $index => $question)
                            <div class="question mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Question:</label>
                                <textarea name="questions[{{ $index }}][question_text]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $question->question_text }}</textarea>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Option A:</label>
                                <input type="text" name="questions[{{ $index }}][option_a]" value="{{ $question->option_a }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Option B:</label>
                                <input type="text" name="questions[{{ $index }}][option_b]" value="{{ $question->option_b }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Option C:</label>
                                <input type="text" name="questions[{{ $index }}][option_c]" value="{{ $question->option_c }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Option D:</label>
                                <input type="text" name="questions[{{ $index }}][option_d]" value="{{ $question->option_d }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Correct Answer:</label>
                                <select name="questions[{{ $index }}][correct_answer]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="a" {{ $question->correct_answer == 'a' ? 'selected' : '' }}>A</option>
                                    <option value="b" {{ $question->correct_answer == 'b' ? 'selected' : '' }}>B</option>
                                    <option value="c" {{ $question->correct_answer == 'c' ? 'selected' : '' }}>C</option>
                                    <option value="d" {{ $question->correct_answer == 'd' ? 'selected' : '' }}>D</option>
                                </select>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-question" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Question</button>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                            บันทึกการเปลี่ยนแปลง
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-question').addEventListener('click', function() {
            const container = document.getElementById('questions-container');
            const questionCount = container.getElementsByClassName('question').length;
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question', 'mb-4');
            newQuestion.innerHTML = `
                <label class="block text-gray-700 text-sm font-bold mb-2">Question:</label>
                <textarea name="questions[${questionCount}][question_text]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                <label class="block text-gray-700 text-sm font-bold mb-2">Option A:</label>
                <input type="text" name="questions[${questionCount}][option_a]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option B:</label>
                <input type="text" name="questions[${questionCount}][option_b]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option C:</label>
                <input type="text" name="questions[${questionCount}][option_c]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option D:</label>
                <input type="text" name="questions[${questionCount}][option_d]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <label class="block text-gray-700 text-sm font-bold mb-2">Correct Answer:</label>
                <select name="questions[${questionCount}][correct_answer]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
            `;
            container.appendChild(newQuestion);
        });
    </script>
</x-app-layout>
