@extends('layouts.app')

@section('title', 'Verifikasi Log')

@section('content')
<div class="max-w-3xl mx-auto" x-data="{ showRejectModal: false, showApproveModal: false }">
    <!-- Page Header -->
    <div class="mb-6">
        <a href="{{ route('verifications.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar
        </a>
        <div class="mt-2 flex items-center justify-between">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">
                Verifikasi Log
            </h1>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $dailyLog->status_badge_class }}">
                {{ $dailyLog->status_display }}
            </span>
        </div>
    </div>

    <!-- Employee Info -->
    <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Pegawai</h3>
        </div>
        <div class="px-6 py-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-12 w-12">
                    <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                        <span class="text-indigo-600 font-medium text-lg">
                            {{ substr($dailyLog->user->name, 0, 1) }}
                        </span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-lg font-medium text-gray-900">{{ $dailyLog->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $dailyLog->user->role_display }} • {{ $dailyLog->user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Details -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Log Harian</h3>
        </div>
        <div class="px-6 py-5 border-b border-gray-200">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->date->format('d F Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Waktu Submit</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->created_at->format('d F Y, H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="px-6 py-5 border-b border-gray-200">
            <dt class="text-sm font-medium text-gray-500 mb-2">Aktivitas</dt>
            <dd class="text-sm text-gray-900 whitespace-pre-wrap bg-gray-50 rounded-md p-4">{{ $dailyLog->activity }}</dd>
        </div>

        @if($dailyLog->verified_by)
        <!-- Verification Info (already verified) -->
        <div class="px-6 py-5 bg-gray-50">
            <h3 class="text-sm font-medium text-gray-500 mb-4">Informasi Verifikasi</h3>
            <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Diverifikasi Oleh</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->verifier->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Waktu Verifikasi</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $dailyLog->verified_at->format('d F Y, H:i') }}</dd>
                </div>
                @if($dailyLog->approval_note)
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Catatan Verifikasi</dt>
                    <dd class="mt-1 text-sm text-gray-900 bg-white rounded-md p-3 border border-gray-200">
                        {{ $dailyLog->approval_note }}
                    </dd>
                </div>
                @endif
            </dl>
        </div>
        @else
        <!-- Verification Actions -->
        <div class="px-6 py-5 bg-gray-50">
            <div class="flex items-center justify-end space-x-3">
                <button @click="showRejectModal = true" type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Tolak
                </button>
                <button @click="showApproveModal = true" type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Setujui
                </button>
            </div>
        </div>
        @endif
    </div>

    <!-- Approve Modal -->
    <div x-show="showApproveModal" x-cloak
         class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showApproveModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 @click="showApproveModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showApproveModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <form action="{{ route('verifications.verify', $dailyLog) }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="approve">
                    
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Setujui Log Harian
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menyetujui log harian ini?
                                </p>
                            </div>
                            <div class="mt-4">
                                <label for="approve_note" class="block text-sm font-medium text-gray-700">
                                    Catatan (opsional)
                                </label>
                                <textarea name="approval_note" id="approve_note" rows="3"
                                          placeholder="Tambahkan catatan jika diperlukan..."
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Setujui
                        </button>
                        <button type="button" @click="showApproveModal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-show="showRejectModal" x-cloak
         class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showRejectModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 @click="showRejectModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showRejectModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <form action="{{ route('verifications.verify', $dailyLog) }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="reject">
                    
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Tolak Log Harian
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menolak log harian ini?
                                </p>
                            </div>
                            <div class="mt-4">
                                <label for="reject_note" class="block text-sm font-medium text-gray-700">
                                    Alasan Penolakan
                                </label>
                                <textarea name="approval_note" id="reject_note" rows="3"
                                          placeholder="Berikan alasan penolakan..."
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Tolak
                        </button>
                        <button type="button" @click="showRejectModal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
