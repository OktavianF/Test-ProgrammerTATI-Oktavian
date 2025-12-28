@extends('layouts.app')

@section('title', 'Verifikasi Log Bawahan')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Verifikasi Log Bawahan
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Kelola log harian dari bawahan langsung Anda.
            </p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="GET" action="{{ route('verifications.index') }}" class="space-y-4 sm:space-y-0 sm:flex sm:flex-wrap sm:items-end sm:gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari Aktivitas</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Kata kunci..."
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Bawahan</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua Bawahan</option>
                        @foreach($subordinates as $subordinate)
                        <option value="{{ $subordinate->id }}" {{ request('user_id') == $subordinate->id ? 'selected' : '' }}>
                            {{ $subordinate->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="pending" {{ request('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua</option>
                    </select>
                </div>
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Filter
                    </button>
                    <a href="{{ route('verifications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pegawai
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aktivitas
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Aksi</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($dailyLogs as $log)
                <tr class="{{ $log->isPending() ? 'bg-yellow-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-indigo-600 font-medium">
                                        {{ substr($log->user->name, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $log->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $log->user->role_display }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $log->date->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="max-w-xs truncate">
                            {{ \Illuminate\Support\Str::limit($log->activity, 60) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $log->status_badge_class }}">
                            {{ $log->status_display }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        @if($log->isPending())
                        <a href="{{ route('verifications.show', $log) }}" 
                           class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Verifikasi
                        </a>
                        @else
                        <a href="{{ route('verifications.show', $log) }}" class="text-indigo-600 hover:text-indigo-900">
                            Lihat Detail
                        </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada log</h3>
                        <p class="mt-1 text-sm text-gray-500">Tidak ada log dari bawahan yang sesuai dengan filter.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($dailyLogs->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $dailyLogs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
