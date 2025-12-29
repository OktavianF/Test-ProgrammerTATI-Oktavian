<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Log Harian - PEMDA X</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: -3s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 overflow-x-hidden">
    <!-- Decorative blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-300/30 to-purple-300/30 blob animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-br from-purple-300/20 to-pink-300/20 blob animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-radial from-indigo-100/40 to-transparent rounded-full"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 px-6 py-4 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-800">LogHarian<span class="text-indigo-600">.id</span></span>
            </div>
            
            @if (Route::has('login'))
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-white shadow-sm border border-gray-200 text-gray-700 font-medium hover:shadow-md hover:border-indigo-200 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-5 py-2.5 text-gray-600 font-medium hover:text-indigo-600 transition-colors duration-300">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-6 py-2.5 rounded-xl gradient-bg text-white font-medium shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-0.5 transition-all duration-300">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative z-10 pt-16 pb-24 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left content -->
                <div class="space-y-8 animate-fade-in">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 border border-indigo-100">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse mr-2"></span>
                        <span class="text-sm font-medium text-indigo-700">Sistem Aktif & Siap Digunakan</span>
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                        Kelola Log Harian
                        <span class="gradient-text">Lebih Efisien</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 leading-relaxed max-w-xl">
                        Sistem pencatatan aktivitas harian pegawai yang terintegrasi dengan fitur verifikasi hierarki. 
                        Mudah, cepat, dan transparan untuk Pemerintah Daerah X.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 rounded-xl gradient-bg text-white font-semibold text-lg shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-1 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Mulai Sekarang
                        </a>
                        <a href="#features" 
                           class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-white border border-gray-200 text-gray-700 font-semibold text-lg hover:border-indigo-200 hover:shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pelajari Fitur
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="flex items-center gap-8 pt-4">
                        <div>
                            <div class="text-3xl font-bold text-gray-900">99.9%</div>
                            <div class="text-sm text-gray-500">Uptime</div>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">5+</div>
                            <div class="text-sm text-gray-500">Role Pengguna</div>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">24/7</div>
                            <div class="text-sm text-gray-500">Akses Kapanpun</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right content - Dashboard Preview -->
                <div class="relative animate-slide-up hidden lg:block">
                    <div class="relative">
                        <!-- Browser frame -->
                        <div class="glass-card rounded-2xl shadow-2xl shadow-indigo-500/10 overflow-hidden hover-lift">
                            <!-- Browser header -->
                            <div class="bg-gray-100 px-4 py-3 flex items-center space-x-2 border-b">
                                <div class="flex space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                                </div>
                                <div class="flex-1 mx-4">
                                    <div class="bg-white rounded-lg px-4 py-1.5 text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                        logharian.pemda-x.go.id
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard preview content -->
                            <div class="p-6 bg-gradient-to-br from-slate-50 to-indigo-50">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="bg-white rounded-xl p-4 shadow-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <span class="text-xs text-green-600 font-medium">+12%</span>
                                        </div>
                                        <div class="mt-3">
                                            <div class="text-2xl font-bold text-gray-800">24</div>
                                            <div class="text-xs text-gray-500">Log Bulan Ini</div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-xl p-4 shadow-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <span class="text-xs text-green-600 font-medium">100%</span>
                                        </div>
                                        <div class="mt-3">
                                            <div class="text-2xl font-bold text-gray-800">22</div>
                                            <div class="text-xs text-gray-500">Disetujui</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-sm">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm font-semibold text-gray-700">Log Terbaru</span>
                                        <span class="text-xs text-indigo-600">Lihat Semua</span>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                                <span class="text-sm text-gray-600">Rapat koordinasi...</span>
                                            </div>
                                            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">Disetujui</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                                <span class="text-sm text-gray-600">Penyusunan laporan...</span>
                                            </div>
                                            <span class="text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating notification -->
                        <div class="absolute -right-4 top-1/4 glass-card rounded-xl p-4 shadow-xl animate-float">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-800">Log Disetujui!</div>
                                    <div class="text-xs text-gray-500">Baru saja</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative z-10 py-24 px-6 lg:px-8 bg-white/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Fitur Unggulan
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Dirancang khusus untuk memudahkan pencatatan dan verifikasi log harian pegawai
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="glass-card rounded-2xl p-8 hover-lift">
                    <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Pencatatan Mudah</h3>
                    <p class="text-gray-600">Input log harian dengan antarmuka yang sederhana dan intuitif. Cukup isi tanggal dan aktivitas.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="glass-card rounded-2xl p-8 hover-lift">
                    <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Verifikasi Berjenjang</h3>
                    <p class="text-gray-600">Sistem verifikasi otomatis sesuai hierarki organisasi. Dari staff hingga kepala dinas.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="glass-card rounded-2xl p-8 hover-lift">
                    <div class="w-14 h-14 rounded-xl bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Multi Role</h3>
                    <p class="text-gray-600">Dukungan berbagai role pengguna: Kepala Dinas, Kepala Bidang, dan Staff dengan akses berbeda.</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="glass-card rounded-2xl p-8 hover-lift">
                    <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Dashboard Interaktif</h3>
                    <p class="text-gray-600">Pantau statistik log harian dengan dashboard yang informatif dan mudah dipahami.</p>
                </div>
                
                <!-- Feature 5 -->
                <div class="glass-card rounded-2xl p-8 hover-lift">
                    <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Realtime Status</h3>
                    <p class="text-gray-600">Lacak status verifikasi log secara realtime: Pending, Disetujui, atau Ditolak.</p>
                </div>
                
                <!-- Feature 6 -->
                <div class="glass-card rounded-2xl p-8 hover-lift">
                    <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-600">Data terenkripsi dan akses dibatasi sesuai peran pengguna untuk menjaga kerahasiaan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative z-10 py-24 px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="gradient-bg rounded-3xl p-12 text-center shadow-2xl shadow-indigo-500/30">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Siap Meningkatkan Produktivitas?
                </h2>
                <p class="text-lg text-indigo-100 mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan sistem log harian yang efisien dan transparan untuk Pemerintah Daerah X.
                </p>
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center px-8 py-4 rounded-xl bg-white text-indigo-600 font-semibold text-lg shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    Masuk ke Sistem
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 py-8 px-6 lg:px-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Sistem Log Harian - Pemerintah Daerah X. Hak Cipta Dilindungi.
            </p>
        </div>
    </footer>
</body>
</html>
