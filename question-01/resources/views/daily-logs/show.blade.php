@extends('layouts.app')

@section('title', 'Detail Log Harian')

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
        <div class="mt-2 flex items-center justify-between">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">
                Detail Log Harian
            </h1>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $dailyLog->status_badge_class }}">
                {{ $dailyLog->status_display }}
            </span>
        </div>
    </div>

    <!-- Log Details -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->date->format('d F Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Pegawai</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->created_at->format('d F Y, H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Terakhir Diupdate</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->updated_at->format('d F Y, H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="px-6 py-5 border-b border-gray-200">
            <dt class="text-sm font-medium text-gray-500 mb-2">Aktivitas</dt>
            <dd class="text-sm text-gray-900 whitespace-pre-wrap bg-gray-50 rounded-md p-4">{{ $dailyLog->activity }}</dd>
        </div>

        @if($dailyLog->verified_by)
        <!-- Verification Info -->
        <div class="px-6 py-5 bg-gray-50">
            <h3 class="text-sm font-medium text-gray-500 mb-4">Informasi Verifikasi</h3>
            <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Diverifikasi Oleh</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($dailyLog->isAutoApproved())
                            <span class="text-purple-600 font-medium">Otomatis (Kepala Dinas)</span>
                        @else
                            {{ $dailyLog->verifier->name }}
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Waktu Verifikasi</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->verified_at->format('d F Y, H:i') }}</dd>
                </div>
                @if($dailyLog->approval_note && !$dailyLog->isAutoApproved())
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Catatan Verifikasi</dt>
                    <dd class="mt-1 text-sm text-gray-900 bg-white rounded-md p-3 border border-gray-200">
                        {{ $dailyLog->approval_note }}
                    </dd>
                </div>
                @endif
            </dl>
        </div>
        @endif

        <!-- Actions -->
        @if($dailyLog->canBeEdited() && $dailyLog->user_id === auth()->id())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3">
            <a href="{{ route('daily-logs.edit', $dailyLog) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Log
            </a>
            <form action="{{ route('daily-logs.destroy', $dailyLog) }}" method="POST" class="inline"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus log ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Log
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
