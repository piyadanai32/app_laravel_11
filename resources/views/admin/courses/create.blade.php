<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('สร้าง Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold">ชื่อคอร์ส:</label>
                            <input id="title" type="text" name="title" class="w-full border rounded p-2 focus:ring focus:ring-blue-200" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold">คำอธิบาย:</label>
                            <textarea id="description" name="description" class="w-full border rounded p-2 focus:ring focus:ring-blue-200"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold">รูปปกคอร์ส:</label>
                            <input id="thumbnail" type="file" name="thumbnail" class="w-full border rounded p-2 focus:ring focus:ring-blue-200" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold">ลิงก์ YouTube:</label>
                            <input id="youtube_link" type="text" name="youtube_link" class="w-full border rounded p-2 focus:ring focus:ring-blue-200">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold">ไฟล์คอร์ส:</label>
                            <input id="file" type="file" name="file" class="w-full border rounded p-2 focus:ring focus:ring-blue-200">
                        </div>
                        <div id="questions-container" class="space-y-6">
                            <h3 class="text-lg font-semibold mb-4">Questions</h3>
                            <div class="question mb-4 p-4 border rounded-lg bg-gray-50">
                                <label class="block text-gray-700 text-sm font-bold mb-2">คำถาม:</label>
                                <textarea name="questions[0][question_text]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"></textarea>
                                <label class="block text-gray-700 text-sm font-bold mb-2">ตัวเลือก A:</label>
                                <input type="text" name="questions[0][option_a]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                                <label class="block text-gray-700 text-sm font-bold mb-2">ตัวเลือก B:</label>
                                <input type="text" name="questions[0][option_b]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                                <label class="block text-gray-700 text-sm font-bold mb-2">ตัวเลือก C:</label>
                                <input type="text" name="questions[0][option_c]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                                <label class="block text-gray-700 text-sm font-bold mb-2">ตัวเลือก D:</label>
                                <input type="text" name="questions[0][option_d]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                                <label class="block text-gray-700 text-sm font-bold mb-2">คำตอบที่ถูกต้อง:</label>
                                <select name="questions[0][correct_answer]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" id="add-question" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none">Add Question</button>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Course</button>
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
            newQuestion.classList.add('question', 'mb-4', 'p-4', 'border', 'rounded-lg', 'bg-gray-50');
            newQuestion.innerHTML = `
                <label class="block text-gray-700 text-sm font-bold mb-2">Question:</label>
                <textarea name="questions[${questionCount}][question_text]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"></textarea>
                <label class="block text-gray-700 text-sm font-bold mb-2">Option A:</label>
                <input type="text" name="questions[${questionCount}][option_a]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option B:</label>
                <input type="text" name="questions[${questionCount}][option_b]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option C:</label>
                <input type="text" name="questions[${questionCount}][option_c]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                <label class="block text-gray-700 text-sm font-bold mb-2">Option D:</label>
                <input type="text" name="questions[${questionCount}][option_d]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                <label class="block text-gray-700 text-sm font-bold mb-2">Correct Answer:</label>
                <select name="questions[${questionCount}][correct_answer]" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
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
