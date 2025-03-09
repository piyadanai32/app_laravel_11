<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-purple-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-yellow-500"> 
                    <a href="{{ route('admin.questions.create') }}" class="btn btn-primary bg-yellow-500 text-purple-500">สร้างคำถามใหม่</a>

                </div>


            </div>
        </div>
    </div>
</x-app-layout>
