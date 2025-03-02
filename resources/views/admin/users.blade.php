<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายการผู้ใช้') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border-b">ชื่อ</th>
                                <th class="py-2 px-4 border-b">อีเมล</th>
                                <th class="py-2 px-4 border-b">บทบาท</th>
                                <th class="py-2 px-4 border-b">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $user->name }}</td>
                                    <td class="py-2 px-4">{{ $user->email }}</td>
                                    <td class="py-2 px-4">{{ $user->usertype }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-black py-1 px-2 rounded">
                                            แก้ไขสิทธิ์
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบผู้ใช้นี้?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-black py-1 px-2 rounded">
                                                ลบ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
