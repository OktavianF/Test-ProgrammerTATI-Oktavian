@extends('layouts.app')

@section('title', 'Verifikasi Log')

@section('content')
<div class="max-w-2xl mx-auto" x-data="{ showRejectModal: false, showApproveModal: false }">
    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ route('verifications.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar
        </a>
        <div class="mt-3 flex items-center justify-between">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                Verifikasi Log
            </h1>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $dailyLog->status_badge_class }}">
                {{ $dailyLog->status_display }}
            </span>
        </div>
    </div>

    <!-- Employee Info Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-6">
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex items-center">
                <div class="w-16 h-16 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm text-white text-2xl font-bold">
                    {{ substr($dailyLog->user->name, 0, 1) }}
                </div>
                <div class="ml-4">
                    <p class="text-xl font-bold text-white">{{ $dailyLog->user->name }}</p>
                    <p class="text-indigo-100 text-sm">{{ $dailyLog->user->role_display }} • {{ $dailyLog->user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Details Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Detail Log Harian</h3>
                    <p class="text-sm text-slate-500">Tanggal: {{ $dailyLog->date->format('d F Y') }} • {{ $dailyLog->date->translatedFormat('l') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Meta Info -->
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center text-sm text-slate-600">
                <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Disubmit pada {{ $dailyLog->created_at->format('d F Y, H:i') }}
            </div>
        </div>

        <!-- Activity Content -->
        <div class="px-6 py-5 border-b border-slate-100">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Aktivitas</p>
            <div class="bg-slate-50 rounded-xl p-5 text-sm text-slate-700 whitespace-pre-wrap leading-relaxed border border-slate-100">{{ $dailyLog->activity }}</div>
        </div>

        @if($dailyLog->verified_by)
        <!-- Verification Info (already verified) -->
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
                        <div class="w-7 h-7 rounded-full gradient-bg flex items-center justify-center text-white text-xs font-medium mr-2">
                            {{ substr($dailyLog->verifier->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-slate-900">{{ $dailyLog->verifier->name }}</span>
                    </div>
                </div>
                <div class="px-4 py-3 flex items-center justify-between">
                    <span class="text-sm text-slate-500">Waktu Verifikasi</span>
                    <span class="text-sm font-medium text-slate-900">{{ $dailyLog->verified_at->format('d F Y, H:i') }}</span>
                </div>
                @if($dailyLog->approval_note)
                <div class="px-4 py-3">
                    <span class="text-sm text-slate-500 block mb-2">Catatan Verifikasi</span>
                    <div class="bg-slate-50 rounded-lg p-3 text-sm text-slate-700">{{ $dailyLog->approval_note }}</div>
                </div>
                @endif
            </div>
        </div>
        @else
        <!-- Verification Actions -->
        <div class="px-6 py-5 bg-slate-50">
            <div class="flex items-center justify-end space-x-3">
                <button @click="showRejectModal = true" type="button"
                        class="inline-flex items-center px-5 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-medium shadow-md shadow-red-500/20 hover:shadow-lg transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Tolak
                </button>
                <button @click="showApproveModal = true" type="button"
                        class="inline-flex items-center px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-medium shadow-md shadow-emerald-500/20 hover:shadow-lg transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showApproveModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" 
                 @click="showApproveModal = false"></div>

            <div x-show="showApproveModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                 class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:max-w-lg w-full">
                <form action="{{ route('verifications.verify', $dailyLog) }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="approve">
                    
                    <!-- Modal Header -->
                    <div class="px-6 py-5 border-b border-slate-100 bg-emerald-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Setujui Log Harian</h3>
                                <p class="text-sm text-slate-500">Konfirmasi persetujuan log</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="px-6 py-5">
                        <p class="text-sm text-slate-600 mb-4">
                            Apakah Anda yakin ingin menyetujui log harian dari <strong>{{ $dailyLog->user->name }}</strong>?
                        </p>
                        
                        <div>
                            <label for="approve_note" class="block text-sm font-semibold text-slate-700 mb-2">
                                Catatan (opsional)
                            </label>
                            <textarea name="approval_note" id="approve_note" rows="3"
                                      placeholder="Tambahkan catatan jika diperlukan..."
                                      class="block w-full py-3 px-4 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all text-sm resize-none"></textarea>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end space-x-3">
                        <button type="button" @click="showApproveModal = false"
                                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-medium hover:bg-slate-200 transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-medium shadow-md shadow-emerald-500/20 hover:shadow-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Ya, Setujui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-show="showRejectModal" x-cloak
         class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showRejectModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" 
                 @click="showRejectModal = false"></div>

            <div x-show="showRejectModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                 class="relative bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:max-w-lg w-full">
                <form action="{{ route('verifications.verify', $dailyLog) }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="reject">
                    
                    <!-- Modal Header -->
                    <div class="px-6 py-5 border-b border-slate-100 bg-red-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Tolak Log Harian</h3>
                                <p class="text-sm text-slate-500">Berikan alasan penolakan</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="px-6 py-5">
                        <p class="text-sm text-slate-600 mb-4">
                            Apakah Anda yakin ingin menolak log harian dari <strong>{{ $dailyLog->user->name }}</strong>?
                        </p>
                        
                        <div>
                            <label for="reject_note" class="block text-sm font-semibold text-slate-700 mb-2">
                                Alasan Penolakan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="approval_note" id="reject_note" rows="3" required
                                      placeholder="Jelaskan alasan penolakan..."
                                      class="block w-full py-3 px-4 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 transition-all text-sm resize-none"></textarea>
                            <p class="mt-2 text-xs text-slate-500">Alasan penolakan akan dikirim ke pegawai terkait</p>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end space-x-3">
                        <button type="button" @click="showRejectModal = false"
                                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-medium hover:bg-slate-200 transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-medium shadow-md shadow-red-500/20 hover:shadow-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Ya, Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
