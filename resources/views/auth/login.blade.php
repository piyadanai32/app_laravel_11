<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-purple-900 p-8 rounded-xl shadow-lg w-96 text-white">
        @csrf

        <h2 class="text-2xl font-bold mb-4 text-center text-yellow-400">เข้าสู่ระบบ</h2>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-yellow-300" />
            <x-text-input id="email" class="block mt-1 w-full p-3 bg-purple-700 border border-purple-600 text-white rounded-lg focus:ring-yellow-500 focus:border-yellow-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-300" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-yellow-300" />
            <x-text-input id="password" class="block mt-1 w-full p-3 bg-purple-700 border border-purple-600 text-white rounded-lg focus:ring-yellow-500 focus:border-yellow-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-300" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4 text-sm">
            <a class="text-yellow-300 hover:underline" href="{{ route('register') }}">
                {{ __('No have account?') }}
            </a>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full bg-yellow-500 hover:bg-yellow-600 text-purple-900 font-semibold py-3 rounded-lg transition">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
