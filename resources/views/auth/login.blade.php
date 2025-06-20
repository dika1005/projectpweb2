<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login', request()->only('redirect')) }}">

        @csrf

        <div class="mb-4 text-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-7">
                {{ __('Log in ke') }} <span class="text-purple-600">Toko Sepatu MassDik</span>
            </h1>
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mb-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="mt-6">
            <a href="{{ route('google.redirect') }}"
                class="w-full inline-flex justify-center items-center space-x-3 border border-gray-300 dark:border-pink-800 rounded-xl px-4 py-3 hover:bg-gray-50 dark:hover:bg-[#2d2d2d] transition-colors">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5" alt="Google">
                <span class="text-sm font-medium text-gray-700 dark:text-pink-200">Google</span>
            </a>
        </div>
    </form>
</x-guest-layout>