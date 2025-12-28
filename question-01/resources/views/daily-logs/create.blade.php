@extends('layouts.app')

@section('title', 'Tambah Log Harian')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Page Header -->
    <div class="mb-6">
        <a href="{{ route('daily-logs.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <h1 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">
            Tambah Log Harian
        </h1>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('daily-logs.store') }}" method="POST" class="space-y-6 p-6">
            @csrf

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input type="date" name="date" id="date" 
                       value="{{ old('date', date('Y-m-d')) }}"
                       max="{{ date('Y-m-d') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date') border-red-300 @enderror">
                @error('date')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="activity" class="block text-sm font-medium text-gray-700">
                    Aktivitas <span class="text-red-500">*</span>
                </label>
                <textarea name="activity" id="activity" rows="6"
                          placeholder="Jelaskan aktivitas yang Anda lakukan hari ini... (minimal 10 karakter)"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('activity') border-red-300 @enderror">{{ old('activity') }}</textarea>
                @error('activity')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    Minimal 10 karakter, maksimal 1000 karakter.
                </p>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('daily-logs.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Log
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
