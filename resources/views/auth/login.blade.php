@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 py-12 px-4">
    <!-- Logo -->
    <div class="mb-8">
        <img src="{{ asset('images/medis_logo.png') }}" alt="Medis Logo" class="h-32 w-auto">
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-md">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" />

            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span>
                <x-text-input id="email"
                    class="block w-full pl-12 pr-3 py-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username" />
            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input id="password"
                    class="block w-full pl-12 pr-3 py-3 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-6">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <label for="remember_me" class="ml-2 text-sm text-gray-600">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 px-6 py-3 text-sm font-semibold rounded-xl shadow bg-indigo-600 hover:bg-indigo-700 transition ease-in-out duration-200 flex items-center justify-center gap-2">
                <i class="fas fa-sign-in-alt"></i> {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
