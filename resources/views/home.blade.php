@extends('layouts.app')

@section('title', 'Beranda - SILOKASI')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden animated-gradient text-white">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="text-center fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Sistem Pemilihan Lokasi<br>Perumahan Cerdas
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-100">
                Menggunakan Metode ANP & BORDA untuk Keputusan Terbaik
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/results') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                    <i class="fas fa-chart-line mr-2"></i>Lihat Hasil Ranking
                </a>
                <a href="{{ url('/about') }}" class="glass text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:bg-opacity-20 transition">
                    <i class="fas fa-info-circle mr-2"></i>Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>
    
    <!-- Wave SVG -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f9fafb" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,106.7C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 -mt-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-list-check text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">8</h3>
                <p class="text-gray-600">Kriteria Penilaian</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">5</h3>
                <p class="text-gray-600">Alternatif Lokasi</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-pink-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">3</h3>
                <p class="text-gray-600">Decision Makers</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 text-center card-hover">
                <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-orange-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">100%</h3>
                <p class="text-gray-600">Akurasi Konsensus</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Mengapa Pilih SILOKASI?
            </h2>
            <p class="text-xl text-gray-600">
                Sistem pengambilan keputusan yang objektif dan terukur
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-network-wired text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Metode ANP</h3>
                <p class="text-gray-600">
                    Analytic Network Process menangani dependensi antar kriteria dengan jaringan kompleks untuk hasil yang lebih akurat.
                </p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-users-cog text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Metode BORDA</h3>
                <p class="text-gray-600">
                    Agregasi preferensi dari multiple Decision Makers untuk mencapai konsensus kelompok yang optimal.
                </p>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 w-16 h-16 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Visualisasi Data</h3>
                <p class="text-gray-600">
                    Dashboard interaktif dengan grafik dan chart yang memudahkan interpretasi hasil analisis.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Top Locations Section -->
<section class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Top 3 Lokasi Terbaik
            </h2>
            <p class="text-xl text-gray-600">
                Hasil ranking berdasarkan konsensus kelompok
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Rank 1 -->
            <div class="bg-white rounded-xl shadow-xl p-8 card-hover relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-gradient-to-br from-yellow-400 to-yellow-500 text-white px-4 py-2 rounded-bl-xl">
                    <i class="fas fa-trophy mr-2"></i>Rank #1
                </div>
                <div class="mt-8 mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-3xl font-bold">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Bekonang</h3>
                    <p class="text-center text-gray-600 mb-4">Kode: A3</p>
                    <div class="bg-yellow-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-600 mb-1">BORDA Points</p>
                        <p class="text-3xl font-bold text-yellow-600">8.4</p>
                    </div>
                </div>
                <a href="{{ url('/alternatives/3') }}" class="block w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-white text-center py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Lihat Detail
                </a>
            </div>
            
            <!-- Rank 2 -->
            <div class="bg-white rounded-xl shadow-xl p-8 card-hover relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-gradient-to-br from-gray-400 to-gray-500 text-white px-4 py-2 rounded-bl-xl">
                    <i class="fas fa-medal mr-2"></i>Rank #2
                </div>
                <div class="mt-8 mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-3xl font-bold">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Gentan</h3>
                    <p class="text-center text-gray-600 mb-4">Kode: A1</p>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-600 mb-1">BORDA Points</p>
                        <p class="text-3xl font-bold text-gray-600">7.5</p>
                    </div>
                </div>
                <a href="{{ url('/alternatives/1') }}" class="block w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white text-center py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Lihat Detail
                </a>
            </div>
            
            <!-- Rank 3 -->
            <div class="bg-white rounded-xl shadow-xl p-8 card-hover relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-gradient-to-br from-orange-400 to-orange-500 text-white px-4 py-2 rounded-bl-xl">
                    <i class="fas fa-award mr-2"></i>Rank #3
                </div>
                <div class="mt-8 mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-3xl font-bold">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Palur Raya</h3>
                    <p class="text-center text-gray-600 mb-4">Kode: A2</p>
                    <div class="bg-orange-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-600 mb-1">BORDA Points</p>
                        <p class="text-3xl font-bold text-orange-600">3.8</p>
                    </div>
                </div>
                <a href="{{ url('/alternatives/2') }}" class="block w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white text-center py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-2xl overflow-hidden">
            <div class="px-8 py-16 md:px-16 text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Siap Menemukan Lokasi Terbaik?
                </h2>
                <p class="text-xl mb-8 text-blue-100">
                    Explore semua fitur dan temukan lokasi perumahan ideal Anda
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/results') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                        <i class="fas fa-chart-bar mr-2"></i>Lihat Semua Hasil
                    </a>
                    <a href="{{ url('/criteria') }}" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                        <i class="fas fa-list-check mr-2"></i>Lihat Kriteria
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
