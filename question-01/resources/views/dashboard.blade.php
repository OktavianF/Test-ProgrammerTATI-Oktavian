@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Dashboard
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Selamat datang, {{ $user->name }}!
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('daily-logs.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Log
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- My Logs This Month -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-indigo-500 rounded-md">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Log Bulan Ini</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ $myLogsThisMonth }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-yellow-500 rounded-md">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Menunggu Verifikasi</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ $myPendingLogs }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-green-500 rounded-md">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Disetujui</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ $myApprovedLogs }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-red-500 rounded-md">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Ditolak</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ $myRejectedLogs }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($subordinatesStats)
    <!-- Supervisor Section -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg">
        <div class="px-6 py-5">
            <h3 class="text-lg leading-6 font-medium text-white flex items-center">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Statistik Bawahan
            </h3>
            <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div class="bg-white/10 rounded-lg p-4">
                    <p class="text-white/80 text-sm">Total Bawahan</p>
                    <p class="text-3xl font-bold text-white">{{ $subordinatesStats['total_subordinates'] }}</p>
                </div>
                <div class="bg-white/10 rounded-lg p-4">
                    <p class="text-white/80 text-sm">Log Menunggu Verifikasi</p>
                    <p class="text-3xl font-bold text-white">{{ $subordinatesStats['pending_logs'] }}</p>
                </div>
                <div class="bg-white/10 rounded-lg p-4">
                    <p class="text-white/80 text-sm">Total Log Bulan Ini</p>
                    <p class="text-3xl font-bold text-white">{{ $subordinatesStats['logs_this_month'] }}</p>
                </div>
            </div>
            @if($subordinatesStats['pending_logs'] > 0)
            <div class="mt-4">
                <a href="{{ route('verifications.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-white/30 rounded-md shadow-sm text-sm font-medium text-white bg-white/10 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Lihat Log Menunggu Verifikasi
                    <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Logs -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Log Terbaru Saya</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentLogs as $log)
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ \Illuminate\Support\Str::limit($log->activity, 60) }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $log->date->format('d M Y') }}
                            </p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $log->status_badge_class }}">
                            {{ $log->status_display }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada log</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai buat log harian pertama Anda.</p>
                    <div class="mt-6">
                        <a href="{{ route('daily-logs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Buat Log
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
            @if($recentLogs->count() > 0)
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                <a href="{{ route('daily-logs.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Lihat semua log →
                </a>
            </div>
            @endif
        </div>

        @if($subordinatesStats && $pendingVerifications->count() > 0)
        <!-- Pending Verifications -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Menunggu Verifikasi</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($pendingVerifications as $log)
                <a href="{{ route('verifications.show', $log) }}" class="block px-6 py-4 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $log->user->name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ \Illuminate\Support\Str::limit($log->activity, 50) }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $log->date->format('d M Y') }}
                            </p>
                        </div>
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                <a href="{{ route('verifications.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Lihat semua →
                </a>
            </div>
        </div>
        @elseif(!$subordinatesStats)
        <!-- Supervisor Info Card -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Info Atasan</h3>
            </div>
            <div class="px-6 py-5">
                @if($user->supervisor)
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                            <span class="text-indigo-600 font-medium text-lg">
                                {{ substr($user->supervisor->name, 0, 1) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">{{ $user->supervisor->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->supervisor->role_display }}</p>
                    </div>
                </div>
                <p class="mt-4 text-sm text-gray-500">
                    Log harian Anda akan diverifikasi oleh atasan langsung di atas.
                </p>
                @else
                <p class="text-sm text-gray-500">
                    Anda tidak memiliki atasan langsung (posisi tertinggi).
                </p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
