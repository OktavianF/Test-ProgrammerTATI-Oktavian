@extends('layouts.app')

@section('title', 'Edit Log Harian')

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
        <h1 class="mt-3 text-2xl sm:text-3xl font-bold text-slate-900">
            Edit Log Harian
        </h1>
        <p class="mt-2 text-slate-500">Perbarui detail aktivitas harian Anda</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Form Edit Log</h3>
                    <p class="text-sm text-slate-500">Perbarui detail aktivitas</p>
                </div>
            </div>
        </div>
        
        <form action="{{ route('daily-logs.update', $dailyLog) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="date" class="block text-sm font-semibold text-slate-700 mb-2">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="date" name="date" id="date" 
                           value="{{ old('date', $dailyLog->date->format('Y-m-d')) }}"
                           max="{{ date('Y-m-d') }}"
                           class="block w-full py-3 px-4 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm @error('date') border-red-300 bg-red-50 @enderror">
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                @error('date')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="activity" class="block text-sm font-semibold text-slate-700 mb-2">
                    Aktivitas <span class="text-red-500">*</span>
                </label>
                <textarea name="activity" id="activity" rows="8"
                          placeholder="Jelaskan aktivitas yang Anda lakukan..."
                          class="block w-full py-3 px-4 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all text-sm resize-none @error('activity') border-red-300 bg-red-50 @enderror">{{ old('activity', $dailyLog->activity) }}</textarea>
                @error('activity')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
                <div class="mt-2 flex items-center justify-between text-xs text-slate-500">
                    <span>Minimal 10 karakter, maksimal 1000 karakter</span>
                    <span id="charCount">0 / 1000</span>
                </div>
            </div>

            <!-- Status Info Box -->
            @if($dailyLog->isAutoApproved())
            <div class="bg-purple-50 rounded-xl p-4 border border-purple-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-purple-800">Log Otomatis Disetujui</h4>
                        <p class="mt-1 text-sm text-purple-700">
                            Log ini telah <strong>otomatis disetujui</strong> karena Anda adalah Kepala Dinas. Anda tetap dapat mengedit log ini.
                        </p>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-amber-50 rounded-xl p-4 border border-amber-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-amber-800">Perhatian</h4>
                        <p class="mt-1 text-sm text-amber-700">
                            Log harian hanya bisa diedit selama status masih <strong>Pending</strong>. Setelah diverifikasi oleh atasan, log akan menjadi read-only.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                <a href="{{ route('daily-logs.index') }}" 
                   class="inline-flex items-center px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-medium hover:bg-slate-200 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-2.5 rounded-xl gradient-bg text-white font-medium shadow-lg shadow-indigo-500/20 hover:shadow-xl hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Character counter
    const textarea = document.getElementById('activity');
    const charCount = document.getElementById('charCount');
    
    function updateCount() {
        const count = textarea.value.length;
        charCount.textContent = count + ' / 1000';
        charCount.className = count > 1000 ? 'text-red-600' : (count >= 10 ? 'text-emerald-600' : 'text-slate-500');
    }
    
    textarea.addEventListener('input', updateCount);
    updateCount();
</script>
@endsection
