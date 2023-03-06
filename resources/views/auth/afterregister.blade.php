<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <p>郵便番号：<input id="zip" type="text" name="zip" size="7">例：1020072（半角数字）</p>
            <button class="api-address" type="button">住所を自動入力</button>
            <x-input-label for="pref" :value="__('都道府県')" />
            <input id="address"><x-text-input id="pref" class="block mt-1 w-full" type="text" pref="pref" :value="old('pref')" required autofocus autocomplete="address-level1" />
            <x-input-error :messages="$errors->get('pref')" class="mt-2" />
        </div>
        <div>    
            <x-input-label for="city" :value="__('市区町村')" />
            <x-text-input id="city" class="block mt-1 w-full" type="city" name="city" :value="old('city')" required autocomplete="address-level2" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="birthday" :value="__('生年月日')" />
            <x-text-input id="birthday" class="block mt-1 w-full" type="text" birthday="birthday" :value="old('birthday')" required autofocus autocomplete="bday" />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="sex" :value="__('性別')" />
            <x-text-input id="sex" class="block mt-1 w-full" type="sex" name="sex" :value="old('sex')" required autocomplete="sex" />
            <x-input-error :messages="$errors->get('sex')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="job" :value="__('職業')" />
            <x-text-input id="job" class="block mt-1 w-full" type="job" name="job" :value="old('job')" required autocomplete="organization-title" />
            <x-input-error :messages="$errors->get('job')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script src="{{ asset('js/api-address.js') }}"></script>

@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
        @endauth
    </div>
@endif