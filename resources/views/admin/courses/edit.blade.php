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

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                            บันทึกการเปลี่ยนแปลง
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
