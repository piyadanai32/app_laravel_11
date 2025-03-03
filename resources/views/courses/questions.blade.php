<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }} - Questions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('courses.submit', $course->id) }}" method="POST">
                        @csrf
                        @foreach ($course->questions as $question)
                            <div class="mb-4">
                                <p>{{ $question->question_text }}</p>
                                <div>
                                    <label>
                                        <input type="radio" name="answers[{{ $question->id }}]" value="a">
                                        {{ $question->option_a }}
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="radio" name="answers[{{ $question->id }}]" value="b">
                                        {{ $question->option_b }}
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="radio" name="answers[{{ $question->id }}]" value="c">
                                        {{ $question->option_c }}
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="radio" name="answers[{{ $question->id }}]" value="d">
                                        {{ $question->option_d }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">ส่งคำตอบ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
