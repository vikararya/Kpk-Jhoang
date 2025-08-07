<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>
<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url('https://images.unsplash.com/photo-1499123785106-343e69e68db1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1748&q=80')">
  <div class="rounded-xl bg-gray-800 bg-opacity-50 px-6 py-7 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">
        <img src="https://www.logo.wine/a/logo/Instagram/Instagram-Glyph-Color-Logo.wine.svg" width="150" alt="" srcset="" />
        <span class="text-gray-300">ADMIN KPK JHOANG</span>
      </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

      <!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class=" mt-1 w-full text-black py-1 pl-2 " type="email" name="email" :value="old('email')" required autofocus />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
