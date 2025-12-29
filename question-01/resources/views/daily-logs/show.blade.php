@extends('layouts.app')

@section('title', 'Detail Log Harian')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ route('daily-logs.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Log
        </a>
        <div class="mt-3 flex items-center justify-between">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                Detail Log Harian
            </h1>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $dailyLog->status_badge_class }}">
                {{ $dailyLog->status_display }}
            </span>
        </div>
    </div>

    <!-- Log Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <!-- Header with date and user info -->
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-bold">{{ $dailyLog->date->format('d F Y') }}</p>
                        <p class="text-indigo-100 text-sm">{{ $dailyLog->date->translatedFormat('l') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Details Grid -->
        <div class="px-6 py-5 border-b border-slate-100">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pegawai</p>
                    <p class="text-sm font-medium text-slate-900">{{ $dailyLog->user->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Dibuat Pada</p>
                    <p class="text-sm font-medium text-slate-900">{{ $dailyLog->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Activity Section -->
        <div class="px-6 py-5 border-b border-slate-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Aktivitas</p>
            <div class="bg-slate-50 rounded-xl p-4 text-sm text-slate-700 whitespace-pre-wrap leading-relaxed">{{ $dailyLog->activity }}</div>
        </div>

        @if($dailyLog->verified_by)
        <!-- Verification Info -->
        <div class="px-6 py-5 bg-slate-50">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 rounded-xl {{ $dailyLog->isApproved() ? 'bg-emerald-100' : 'bg-red-100' }} flex items-center justify-center">
                    @if($dailyLog->isApproved())
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    @endif
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Informasi Verifikasi</h3>
                    <p class="text-sm text-slate-500">Log telah diverifikasi</p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl border border-slate-200 divide-y divide-slate-100">
                <div class="px-4 py-3 flex items-center justify-between">
                    <span class="text-sm text-slate-500">Diverifikasi Oleh</span>
                    <div class="flex items-center">
                        @if($dailyLog->isAutoApproved())
                            <div class="w-7 h-7 rounded-full bg-purple-100 flex items-center justify-center mr-2">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-purple-600">Otomatis (Kepala Dinas)</span>
                        @else
                            <div class="w-7 h-7 rounded-full gradient-bg flex items-center justify-center text-white text-xs font-medium mr-2">
                                {{ substr($dailyLog->verifier->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-slate-900">{{ $dailyLog->verifier->name }}</span>
                        @endif
                    </div>
                </div>
                <div class="px-4 py-3 flex items-center justify-between">
                    <span class="text-sm text-slate-500">Waktu Verifikasi</span>
                    <span class="text-sm font-medium text-slate-900">{{ $dailyLog->verified_at->format('d F Y, H:i') }}</span>
                </div>
                @if($dailyLog->approval_note && !$dailyLog->isAutoApproved())
                <div class="px-4 py-3">
                    <span class="text-sm text-slate-500 block mb-2">Catatan Verifikasi</span>
                    <div class="bg-slate-50 rounded-lg p-3 text-sm text-slate-700">{{ $dailyLog->approval_note }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Actions -->
        @if($dailyLog->canBeEdited() && $dailyLog->user_id === auth()->id())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('daily-logs.edit', $dailyLog) }}" 
               class="inline-flex items-center px-5 py-2.5 rounded-xl gradient-bg text-white font-medium shadow-md shadow-indigo-500/20 hover:shadow-lg transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Log
            </a>
            <form action="{{ route('daily-logs.destroy', $dailyLog) }}" method="POST" class="inline"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus log ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-5 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-medium shadow-md shadow-red-500/20 hover:shadow-lg transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
