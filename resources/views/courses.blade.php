<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-600 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                        @foreach ($courses as $course)
                            <a href="{{ route('courses.show', $course->id) }}" class="max-w-sm rounded border border-gray-300 overflow-hidden bg-white flex flex-col justify-between no-underline text-gray-900 transition-transform transform hover:scale-105">
                                <div>
                                    <img class="w-full" src="{{ asset('storage/' . $course->thumbnail) }}" alt="Course Thumbnail">
                                    <div class="px-6 py-4">
                                        <div class="font-bold text-xl mb-2">{{ $course->title }}</div>
                                        <p class="text-gray-700 text-base">{{ Str::limit($course->description, 50) }}</p>
                                        <p>
                                            @if ($course->userHasAnswered)
                                                <span class="text-green-500">ทำแบบทดสอบแล้ว</span>
                                            @else
                                                <span class="text-red-500">ยังไม่เรียน</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
