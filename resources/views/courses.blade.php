<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full mt-4">
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('courses.show', $course->id) }}" class="text-blue-500 hover:underline">
                                            {{ $course->title }}
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $course->description }}</td>
                                    <td class="border px-4 py-2">
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="w-32">
                                    </td>                             
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
