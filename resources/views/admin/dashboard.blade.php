<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-600 leading-tight">
            {{ __('แดชบอร์ดผู้ดูแลระบบ') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card: Total Users -->
            <div class="bg-yellow-300 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-purple-700">จำนวนผู้ใช้ทั้งหมด</h3>
                <p class="text-3xl font-bold mt-2 text-purple-900">{{ $users->count() }}</p>
            </div>
            
            <!-- Card: Total Courses -->
            <div class="bg-yellow-300 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-purple-700">จำนวนคอร์สทั้งหมด</h3>
                <p class="text-3xl font-bold mt-2 text-purple-900">{{ $courses->count() }}</p>
            </div>
        </div>

        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-purple-600 mb-4">ข้อมูลผู้ใช้</h3>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-purple-100">
                            <th class="py-2 px-4 border text-purple-600">ชื่อ</th>
                            <th class="py-2 px-4 border text-purple-600">อีเมล</th>
                            <th class="py-2 px-4 border text-purple-600">ลงทะเบียนเมื่อ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="py-2 px-4 border">{{ $user->name }}</td>
                                <td class="py-2 px-4 border">{{ $user->email }}</td>
                                <td class="py-2 px-4 border">{{ $user->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Course Table -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-purple-600 mb-4">ข้อมูลคอร์ส</h3>
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-purple-100">
                            <th class="py-2 px-4 border text-purple-600">ชื่อคอร์ส</th>
                            <th class="py-2 px-4 border text-purple-600">คำอธิบาย</th>
                            <th class="py-2 px-4 border text-purple-600">สร้างเมื่อ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td class="py-2 px-4 border">{{ $course->title }}</td>
                                <td class="py-2 px-4 border">{{ Str::limit($course->description, 50) }}</td>
                                <td class="py-2 px-4 border">{{ $course->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-purple-600 mb-4">สถิติผู้ใช้</h3>
                <canvas id="userChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($userLabels) !!},
                datasets: [{
                    label: 'ผู้ใช้',
                    data: {!! json_encode($userCounts) !!},
                    backgroundColor: 'rgba(106, 13, 173, 0.5)',
                    borderColor: 'rgba(106, 13, 173, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
