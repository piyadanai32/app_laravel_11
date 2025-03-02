<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('แก้ไขผู้ใช้') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PATCH')

                        <!-- ชื่อ และอีเมลจะถูกซ่อนหรือไม่แสดงในฟอร์ม -->
                        <div class="mb-4">
                            <label class="block text-gray-700">ชื่อ:</label>
                            <input type="text" name="name" value="{{ $user->name }}" disabled
                                class="w-full border rounded p-2 bg-gray-200">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">อีเมล:</label>
                            <input type="email" name="email" value="{{ $user->email }}" disabled
                                class="w-full border rounded p-2 bg-gray-200">
                        </div>

                        <!-- แก้ไขเฉพาะ usertype -->
                        <div class="mb-4">
                            <label class="block text-gray-700">บทบาท:</label>
                            <select name="usertype" class="w-full border rounded p-2">
                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                            บันทึกการเปลี่ยนแปลง
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
