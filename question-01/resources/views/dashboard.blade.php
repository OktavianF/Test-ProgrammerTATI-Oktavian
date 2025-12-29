@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                Dashboard
            </h1>
            <p class="mt-1 text-slate-500">
                Selamat datang kembali, <span class="font-medium text-slate-700">{{ $user->name }}</span>! 
            </p>
        </div>
        <a href="{{ route('daily-logs.create') }}" 
           class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl gradient-bg text-white font-medium shadow-lg shadow-indigo-500/20 hover:shadow-xl hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Log Baru
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- My Logs This Month -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-100 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Bulan Ini</span>
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ $myLogsThisMonth }}</div>
            <p class="text-sm text-slate-500 mt-1">Total Log</p>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-100 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                @if($myPendingLogs > 0)
                <span class="flex items-center space-x-1 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>Menunggu</span>
                </span>
                @endif
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ $myPendingLogs }}</div>
            <p class="text-sm text-slate-500 mt-1">Menunggu Verifikasi</p>
        </div>

        <!-- Approved -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-100 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ $myApprovedLogs }}</div>
            <p class="text-sm text-slate-500 mt-1">Disetujui</p>
        </div>

        <!-- Rejected -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-100 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center shadow-lg shadow-red-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-slate-900">{{ $myRejectedLogs }}</div>
            <p class="text-sm text-slate-500 mt-1">Ditolak</p>
        </div>
    </div>

    @if($subordinatesStats)
    <!-- Supervisor Section -->
    <div class="relative overflow-hidden rounded-2xl gradient-bg p-6 sm:p-8 shadow-xl shadow-indigo-500/20">
        <!-- Background decoration -->
        <div class="absolute top-0 right-0 -mt-16 -mr-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>
        
        <div class="relative">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Statistik Bawahan</h3>
                        <p class="text-indigo-100 text-sm">Monitor aktivitas tim Anda</p>
                    </div>
                </div>
                @if($subordinatesStats['pending_logs'] > 0)
                <a href="{{ route('verifications.index') }}" 
                   class="inline-flex items-center px-5 py-2.5 rounded-xl bg-white/20 hover:bg-white/30 text-white font-medium backdrop-blur-sm transition-all duration-200 border border-white/20">
                    Verifikasi Sekarang
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="text-indigo-100 text-sm">Total Bawahan</span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $subordinatesStats['total_subordinates'] }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-amber-400/30 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-indigo-100 text-sm">Menunggu Verifikasi</span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $subordinatesStats['pending_logs'] }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="text-indigo-100 text-sm">Log Bulan Ini</span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $subordinatesStats['logs_this_month'] }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Logs -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Log Terbaru Saya</h3>
                </div>
                <a href="{{ route('daily-logs.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                    Lihat Semua →
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentLogs as $log)
                <a href="{{ route('daily-logs.show', $log) }}" class="flex items-center px-6 py-4 hover:bg-slate-50 transition-colors">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">
                            {{ \Illuminate\Support\Str::limit($log->activity, 50) }}
                        </p>
                        <p class="text-xs text-slate-500 mt-1 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $log->date->format('d M Y') }}
                        </p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $log->status_badge_class }}">
                        {{ $log->status_display }}
                    </span>
                </a>
                @empty
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-medium text-slate-900 mb-1">Belum ada log</h4>
                    <p class="text-sm text-slate-500 mb-4">Mulai catat aktivitas harian Anda</p>
                    <a href="{{ route('daily-logs.create') }}" 
                       class="inline-flex items-center px-4 py-2 rounded-lg gradient-bg text-white text-sm font-medium shadow-md shadow-indigo-500/20 hover:shadow-lg transition-all duration-200">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Log Pertama
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pending Verifications (for supervisors) -->
        @if($subordinatesStats && $pendingVerifications->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Menunggu Verifikasi</h3>
                        <p class="text-xs text-slate-500">Log dari bawahan Anda</p>
                    </div>
                </div>
                <a href="{{ route('verifications.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                    Lihat Semua →
                </a>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach($pendingVerifications as $log)
                <a href="{{ route('verifications.show', $log) }}" class="flex items-center px-6 py-4 hover:bg-slate-50 transition-colors">
                    <div class="w-9 h-9 rounded-full gradient-bg flex items-center justify-center text-white font-medium text-sm mr-4 shadow-md">
                        {{ substr($log->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">
                            {{ \Illuminate\Support\Str::limit($log->activity, 40) }}
                        </p>
                        <p class="text-xs text-slate-500 mt-0.5">
                            {{ $log->user->name }} • {{ $log->date->format('d M Y') }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                            Pending
                        </span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @elseif(!$subordinatesStats)
        <!-- Quick Tips for non-supervisors -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Tips Pencatatan</h3>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-indigo-600">1</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Catat Aktivitas Harian</p>
                        <p class="text-xs text-slate-500 mt-0.5">Tuliskan aktivitas Anda dengan jelas dan detail</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-indigo-600">2</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Kirim untuk Verifikasi</p>
                        <p class="text-xs text-slate-500 mt-0.5">Log akan dikirim ke atasan untuk diverifikasi</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-indigo-600">3</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Pantau Status</p>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat status verifikasi log Anda di dashboard</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
