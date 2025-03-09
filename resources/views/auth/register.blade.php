<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="bg-purple-900 p-6 rounded-lg shadow-lg text-yellow-300">
        @csrf
        <h2 class="text-center text-2xl font-bold text-yellow-400 mb-6">สมัครสมาชิก</h2>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-yellow-300" />
            <x-text-input id="name" class="block mt-1 w-full border-yellow-500 focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 bg-purple-800 text-yellow-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-yellow-300" />
            <x-text-input id="email" class="block mt-1 w-full border-yellow-500 focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 bg-purple-800 text-yellow-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-yellow-300" />
            <x-text-input id="password" class="block mt-1 w-full border-yellow-500 focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 bg-purple-800 text-yellow-300"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-yellow-300" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-yellow-500 focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 bg-purple-800 text-yellow-300"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-yellow-300 hover:text-yellow-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 text-purple-900 font-bold">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
