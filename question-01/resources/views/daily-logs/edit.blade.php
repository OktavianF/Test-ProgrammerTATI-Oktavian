@extends('layouts.app')

@section('title', 'Edit Log Harian')

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
            Edit Log Harian
        </h1>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('daily-logs.update', $dailyLog) }}" method="POST" class="space-y-6 p-6">
            @csrf
            @method('PUT')

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input type="date" name="date" id="date" 
                       value="{{ old('date', $dailyLog->date->format('Y-m-d')) }}"
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
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('activity') border-red-300 @enderror">{{ old('activity', $dailyLog->activity) }}</textarea>
                @error('activity')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">
                    Minimal 10 karakter, maksimal 1000 karakter.
                </p>
            </div>

            @if($dailyLog->isAutoApproved())
            <div class="bg-purple-50 border-l-4 border-purple-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-purple-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-purple-700">
                            Log ini telah <strong>otomatis disetujui</strong> karena Anda adalah Kepala Dinas. Anda tetap dapat mengedit log ini.
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Log harian hanya bisa diedit selama status masih <strong>Pending</strong>. Setelah diverifikasi oleh atasan, log akan menjadi read-only.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('daily-logs.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
