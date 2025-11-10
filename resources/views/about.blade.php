@extends('layouts.app')

@section('title', 'Tentang SILOKASI')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang SILOKASI</h1>
        <p class="text-xl text-indigo-100">Group Decision Support System untuk Pemilihan Lokasi Perumahan</p>
    </div>
</section>

<!-- Content -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Introduction -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Apa itu SILOKASI?</h2>
            <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                <strong>SILOKASI (Sistem Informasi Lokasi)</strong> adalah sebuah sistem pendukung keputusan kelompok (Group Decision Support System - GDSS) yang dirancang khusus untuk membantu pengambilan keputusan dalam pemilihan lokasi pembangunan perumahan.
            </p>
            <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                Sistem ini menggabungkan dua metode powerful: <strong>Analytic Network Process (ANP)</strong> dan <strong>BORDA</strong> untuk menghasilkan keputusan yang objektif, terukur, dan merepresentasikan konsensus dari berbagai stakeholder.
            </p>
        </div>
        
        <!-- Methods -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <!-- ANP Method -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg p-8">
                <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-network-wired text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Metode ANP</h3>
                <p class="text-gray-700 mb-4">
                    <strong>Analytic Network Process (ANP)</strong> adalah pengembangan dari metode AHP yang mempertimbangkan hubungan dependensi dan feedback antar kriteria.
                </p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-600 mr-2 mt-1"></i>
                        <span>Menangani kompleksitas hubungan antar kriteria</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-600 mr-2 mt-1"></i>
                        <span>Pembobotan yang lebih akurat dan realistis</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-600 mr-2 mt-1"></i>
                        <span>Memperhitungkan interdependensi variabel</span>
                    </li>
                </ul>
            </div>
            
            <!-- BORDA Method -->
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl shadow-lg p-8">
                <div class="bg-purple-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-users-cog text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Metode BORDA</h3>
                <p class="text-gray-700 mb-4">
                    <strong>Metode BORDA</strong> adalah teknik agregasi preferensi untuk mencapai konsensus dari multiple decision makers.
                </p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-purple-600 mr-2 mt-1"></i>
                        <span>Agregasi ranking dari berbagai DM</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-purple-600 mr-2 mt-1"></i>
                        <span>Sistem voting yang adil dan demokratis</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-purple-600 mr-2 mt-1"></i>
                        <span>Menghasilkan konsensus kelompok</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- System Architecture -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                <i class="fas fa-cogs text-indigo-600 mr-2"></i>
                Arsitektur Sistem
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-database text-blue-600 text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Backend</h4>
                    <p class="text-gray-600 text-sm">Laravel 11 + MySQL</p>
                    <p class="text-gray-600 text-sm">RESTful API</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-paint-brush text-purple-600 text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Frontend</h4>
                    <p class="text-gray-600 text-sm">Blade Templates</p>
                    <p class="text-gray-600 text-sm">Tailwind CSS + Alpine.js</p>
                </div>
                <div class="text-center">
                    <div class="bg-pink-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-bar text-pink-600 text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Visualization</h4>
                    <p class="text-gray-600 text-sm">Chart.js</p>
                    <p class="text-gray-600 text-sm">Interactive Dashboards</p>
                </div>
            </div>
        </div>
        
        <!-- Process Flow -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                <i class="fas fa-project-diagram text-indigo-600 mr-2"></i>
                Alur Proses Pengambilan Keputusan
            </h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-indigo-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">1</div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Definisi Kriteria</h4>
                        <p class="text-gray-600">Penetapan 8 kriteria penilaian (KT, BB, LL, LPD, ST, BPT, SPL, VM)</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-indigo-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">2</div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Pairwise Comparison</h4>
                        <p class="text-gray-600">Perbandingan berpasangan antar kriteria dan alternatif oleh setiap Decision Maker</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-indigo-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">3</div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Perhitungan ANP</h4>
                        <p class="text-gray-600">Menghitung bobot kriteria dengan mempertimbangkan dependensi dan feedback</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-indigo-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">4</div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Individual Ranking</h4>
                        <p class="text-gray-600">Setiap DM menghasilkan ranking alternatif berdasarkan perhitungan ANP</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-indigo-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">5</div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Agregasi BORDA</h4>
                        <p class="text-gray-600">Menggabungkan ranking dari semua DM untuk menghasilkan konsensus final</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-indigo-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-4 flex-shrink-0">6</div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Final Decision</h4>
                        <p class="text-gray-600">Lokasi dengan BORDA points tertinggi menjadi pilihan terbaik</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decision Makers -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                <i class="fas fa-users text-indigo-600 mr-2"></i>
                Decision Makers
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 text-center">
                    <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-tie text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">DM Lahan</h4>
                    <p class="text-sm text-gray-600">Expert dalam analisis kondisi tanah dan legalitas</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 text-center">
                    <div class="bg-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-cog text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">DM Infrastruktur</h4>
                    <p class="text-sm text-gray-600">Expert dalam infrastruktur dan aksesibilitas</p>
                </div>
                <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-lg p-6 text-center">
                    <div class="bg-pink-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-graduate text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">DM Sosial Ekonomi</h4>
                    <p class="text-sm text-gray-600">Expert dalam aspek sosial dan ekonomi</p>
                </div>
            </div>
        </div>
        
        <!-- Benefits -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg p-8 text-white">
            <h2 class="text-3xl font-bold mb-6">
                <i class="fas fa-star mr-2"></i>
                Keunggulan SILOKASI
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-yellow-300 text-2xl mr-4 mt-1 flex-shrink-0"></i>
                    <div>
                        <h4 class="font-bold mb-2">Objektif & Terukur</h4>
                        <p class="text-indigo-100">Keputusan berdasarkan data dan perhitungan matematis, bukan subjektivitas</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-yellow-300 text-2xl mr-4 mt-1 flex-shrink-0"></i>
                    <div>
                        <h4 class="font-bold mb-2">Konsensus Kelompok</h4>
                        <p class="text-indigo-100">Mengakomodasi preferensi semua stakeholder</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-yellow-300 text-2xl mr-4 mt-1 flex-shrink-0"></i>
                    <div>
                        <h4 class="font-bold mb-2">Komprehensif</h4>
                        <p class="text-indigo-100">Mempertimbangkan multiple kriteria dan dependensinya</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle text-yellow-300 text-2xl mr-4 mt-1 flex-shrink-0"></i>
                    <div>
                        <h4 class="font-bold mb-2">User-Friendly</h4>
                        <p class="text-indigo-100">Interface modern dan mudah dipahami</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection
