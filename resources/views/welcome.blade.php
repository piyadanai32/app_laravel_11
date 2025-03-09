<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval: 3000 // Set interval to 5000 milliseconds (5 seconds)
                });
            });
        </script>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                @tailwind base;
                @tailwind components;
                @tailwind utilities;
            </style>

            <script src="{{ asset('js/app.js') }}" defer></script>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @endif
    </head>
    <body class="bg-[#ffffff] text-[#2C2C2C] flex justify-content items-center min-h-screen flex-col h-full w-full">
        <header class="bg-[#fab71c] w-full text-[#2C2C2C] mb-1 shadow-lg">
            @if (Route::has('login'))
            <nav class="navbar navbar-light px-4 d-flex justify-content-between align-items-center position-sticky sticky-nav">
                <div class="d-flex align-items-center">
                    <img src="https://www.bru.ac.th/wp-content/uploads/2018/09/LOGO-bru-227x300.png" width="50" height="50" alt="" class="navbar-brand">
                    <a href="/" class="navbar-brand text-[#2c2c2c] text-2xl font-bold">BRU E-Learning</a>
                </div>
                <div>
                    @auth
                        <a href="{{ Auth::user()->usertype == 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                            class="btn btn-outline-dark me-2">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-purple">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
            @endif
        </header>
        <div id="carouselExampleIndicators" class="carousel slide w-full h-full" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://lh3.googleusercontent.com/p/AF1QipN-yuiaK4YzoiIZ-TlLv2d3aYWpOettT8dB5Zrt=s1360-w1360-h1020" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://lh3.googleusercontent.com/p/AF1QipNEUIwjl_AlY9iguTJCngaGZ1TTmvt318xTRzoV=s1360-w1360-h1020" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://lh3.googleusercontent.com/p/AF1QipPiI-3CXiwFKRZZTDO_HD3Ytu33DtXjBFHeMkmR=s1360-w1360-h1020" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="max-w-7xl mx-auto p-6">
            <h2 class="text-2xl font-bold mb-4 text-[#FFD700]">คอร์สเรียนแนะนำ</h2>
            <p class="text-gray-600 mb-6">คุณต้องชอบคอร์สเหล่านี้แน่นอน!</p>
        
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($courses as $course)
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white flex flex-col justify-between">
                        <div>
                            <img class="w-full" src="{{ asset('storage/' . $course->thumbnail) }}" alt="Course Thumbnail">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ $course->title }}</div>
                                <p class="text-gray-700 text-base">{{ Str::limit($course->description, 50) }}</p>
                            </div>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <a href="{{ route('courses.show', $course->id) }}" class="inline-block bg-purple-600 text-white rounded-full px-3 py-1 text-sm font-semibold">View Course</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-[#FFD700] text-center text-[#2C2C2C] shadow-lg">
            <p>© 2025 BRU E-Learning. All rights reserved.</p>
        </footer>
    </body>
</html>
