<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin KPK JHOANG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>
<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image: url('{{ asset('images/kpk1.jpg') }}')">
  <div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-7 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">
       <img src="{{ asset('images/kpk2.png') }}" width="150" alt="" srcset="" />
        <span class="text-gray-300">ADMIN KPK JHOANG</span>
      </div>
     <!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-4 text-lg">
        <x-input-label for="email" :value="__('Email')" />
        <input id="email" class="rounded-3xl border-none bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md block mt-1 w-full" 
               type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="id@email.com" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mb-4 text-lg">
        <x-input-label for="password" :value="__('Password')" />
        <input id="password" class="rounded-3xl border-none bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md block mt-1 w-full"
               type="password" name="password" required autocomplete="current-password" placeholder="*********" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex justify-center mt-4 w-full max-w-md">
        <button type="submit" class="rounded-3xl bg-yellow-400 bg-opacity-50 px-10 py-2 text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-yellow-600">
            {{ __('Log in') }}
        </button>
    </div>
</form>
