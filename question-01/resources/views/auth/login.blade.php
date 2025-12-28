@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                📋 Sistem Log Harian
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Pemerintah Daerah X
            </p>
        </div>

        <div class="bg-white py-8 px-4 shadow-lg sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-300 @enderror">
                    </div>
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-300 @enderror">
                    </div>
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Masuk
                    </button>
                </div>
            </form>

            <!-- Demo accounts -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Akun Demo</span>
                    </div>
                </div>

                <div class="mt-4 space-y-2 text-sm text-gray-600">
                    <div class="flex justify-between items-center p-2 bg-purple-50 rounded">
                        <span class="font-medium text-purple-800">Kepala Dinas:</span>
                        <code class="text-xs bg-purple-100 px-2 py-1 rounded">kepala.dinas@pemda.go.id</code>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-blue-50 rounded">
                        <span class="font-medium text-blue-800">Kepala Bidang 1:</span>
                        <code class="text-xs bg-blue-100 px-2 py-1 rounded">kepala.bidang1@pemda.go.id</code>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-blue-50 rounded">
                        <span class="font-medium text-blue-800">Kepala Bidang 2:</span>
                        <code class="text-xs bg-blue-100 px-2 py-1 rounded">kepala.bidang2@pemda.go.id</code>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                        <span class="font-medium text-gray-800">Staff 1:</span>
                        <code class="text-xs bg-gray-100 px-2 py-1 rounded">staff1@pemda.go.id</code>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                        <span class="font-medium text-gray-800">Staff 2:</span>
                        <code class="text-xs bg-gray-100 px-2 py-1 rounded">staff2@pemda.go.id</code>
                    </div>
                    <p class="text-center text-xs text-gray-500 mt-2">Password: <code class="bg-gray-100 px-2 py-0.5 rounded">password</code></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
