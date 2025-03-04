<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight text-center bg-green-800 py-4 rounded-t-lg">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg rounded-lg p-6 text-white">
                <h3 class="text-xl font-semibold text-green-400 mb-4">รายละเอียดคอร์ส</h3>
                <p class="text-gray-300 text-lg leading-relaxed">{{ $course->description }}</p>
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="w-full mt-6 rounded-lg shadow-md">
                
                <div class="mt-6">
                    @php
                        $youtube_link = $course->youtube_link;
                        if (strpos($youtube_link, 'youtu.be') !== false) {
                            $video_id = substr(parse_url($youtube_link, PHP_URL_PATH), 1);
                        } elseif (strpos($youtube_link, 'youtube.com') !== false) {
                            parse_str(parse_url($youtube_link, PHP_URL_QUERY), $query_params);
                            $video_id = $query_params['v'] ?? null;
                        } else {
                            $video_id = null;
                        }
                    @endphp

                    @if ($video_id)
                        <div class="relative overflow-hidden mt-6 w-full" style="padding-top: 56.25%">
                            <iframe class="absolute top-0 left-0 w-full h-full rounded-lg" src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <p class="text-red-500 font-semibold mt-4">เกิดข้อผิดพลาด โปรดลองอีกครั้งในภายหลัง (ID การเล่น: {{ $course->youtube_link }})</p>
                    @endif
                </div>
                
                <div class="mt-6 p-4 bg-gray-700 rounded-lg">
                    @if (session('results'))
                        <h3 class="text-lg font-semibold text-green-400">คะแนนล่าสุด:</h3>
                        @php
                            $sessionTotalQuestions = count(session('results'));
                            $sessionCorrectAnswers = count(array_filter(session('results')));
                        @endphp
                        <p class="text-gray-300 text-lg">คุณได้ {{ $sessionCorrectAnswers }} จาก {{ $sessionTotalQuestions }} คำถาม</p>
                    @else
                        @php
                            $totalQuestions = $course->questions->count();
                            $correctAnswers = \App\Models\Answers::where('user_id', Auth::id())
                                ->whereIn('question_id', $course->questions->pluck('id'))
                                ->where('is_correct', true)
                                ->count();
                        @endphp
                        @if ($totalQuestions > 0)
                            <h3 class="text-lg font-semibold text-green-400">คะแนนล่าสุด:</h3>
                            <p class="text-gray-300 text-lg">คุณได้ {{ $correctAnswers }} จาก {{ $totalQuestions }} คำถาม</p>
                        @endif
                    @endif
                </div>

                <div class="mt-6 text-center">
                    @if ($course->userHasAnswered)
                        <a href="{{ url('courses/' . $course->id . '/questions') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-green-700 transition">ทำแบบทดสอบใหม่</a>
                    @else
                        <a href="{{ url('courses/' . $course->id . '/questions') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-green-600 transition">ทำแบบทดสอบ</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
