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

                    <form method="POST" action="{{ route('admin.questions.update', $course->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                            บันทึกการเปลี่ยนแปลง
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
