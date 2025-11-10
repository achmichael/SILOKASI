@extends('layouts.app')

@section('title', 'Kriteria Penilaian - SILOKASI')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Kriteria Penilaian</h1>
        <p class="text-xl text-purple-100">8 Kriteria utama dalam pemilihan lokasi perumahan</p>
    </div>
</section>

<!-- Criteria Content -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- ANP Weights Chart -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                <i class="fas fa-chart-pie text-purple-600 mr-2"></i>
                Bobot Kriteria (ANP Weights)
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <canvas id="criteriaChart"></canvas>
                </div>
                <div class="flex items-center">
                    <div class="w-full">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-700">Prospek Pengembangan</span>
                                <span class="font-bold text-purple-600">26%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-purple-600 h-3 rounded-full" style="width: 26%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-700">Biaya Pematangan Tanah</span>
                                <span class="font-bold text-blue-600">12%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-blue-600 h-3 rounded-full" style="width: 12%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-700">Status Tanah</span>
                                <span class="font-bold text-pink-600">9%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-pink-600 h-3 rounded-full" style="width: 9%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-700">Kondisi Tanah</span>
                                <span class="font-bold text-orange-600">6%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-orange-600 h-3 rounded-full" style="width: 6%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Criteria Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Criteria 1 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-purple-500">
                <div class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-mountain text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Kondisi Tanah (KT)</h3>
                <p class="text-sm text-gray-600 mb-4">Kelayakan struktur tanah untuk konstruksi</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">6%</span>
                </div>
            </div>
            
            <!-- Criteria 2 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-blue-500">
                <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-water text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Bebas Banjir (BB)</h3>
                <p class="text-sm text-gray-600 mb-4">Risiko banjir di area tersebut</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">5%</span>
                </div>
            </div>
            
            <!-- Criteria 3 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-green-500">
                <div class="bg-green-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-expand text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Luas Lahan (LL)</h3>
                <p class="text-sm text-gray-600 mb-4">Ukuran area yang tersedia untuk pembangunan</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">2%</span>
                </div>
            </div>
            
            <!-- Criteria 4 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-pink-500">
                <div class="bg-pink-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-pink-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Prospek Pengembangan (LPD)</h3>
                <p class="text-sm text-gray-600 mb-4">Potensi pengembangan kawasan di masa depan</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-sm font-semibold">26%</span>
                </div>
            </div>
            
            <!-- Criteria 5 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-yellow-500">
                <div class="bg-yellow-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-file-contract text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Status Tanah (ST)</h3>
                <p class="text-sm text-gray-600 mb-4">Legalitas kepemilikan atau izin lahan</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">9%</span>
                </div>
            </div>
            
            <!-- Criteria 6 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-orange-500">
                <div class="bg-orange-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-coins text-orange-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Biaya Pematangan (BPT)</h3>
                <p class="text-sm text-gray-600 mb-4">Biaya penyiapan lahan agar layak bangun</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold">12%</span>
                </div>
            </div>
            
            <!-- Criteria 7 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-indigo-500">
                <div class="bg-indigo-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-map text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Kesesuaian Lahan (SPL)</h3>
                <p class="text-sm text-gray-600 mb-4">Kesesuaian dengan tata ruang kota</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">5%</span>
                </div>
            </div>
            
            <!-- Criteria 8 -->
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-t-4 border-teal-500">
                <div class="bg-teal-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-eye text-teal-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Pemandangan (VM)</h3>
                <p class="text-sm text-gray-600 mb-4">Nilai estetika dan kenyamanan lingkungan</p>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Bobot ANP</span>
                    <span class="bg-teal-100 text-teal-700 px-3 py-1 rounded-full text-sm font-semibold">1%</span>
                </div>
            </div>
            
        </div>
        
        <!-- Dependencies Network -->
        <div class="mt-12 bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                <i class="fas fa-network-wired text-purple-600 mr-2"></i>
                Jaringan Ketergantungan Kriteria (ANP Network)
            </h2>
            <p class="text-gray-600 mb-6">
                Metode ANP mempertimbangkan hubungan dependensi antar kriteria untuk hasil yang lebih akurat.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Kriteria yang Mempengaruhi LPD</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">BB → LPD</span>
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">Value: 3.0</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">LL → LPD</span>
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">Value: 2.0</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">VM → LPD</span>
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">Value: 3.0</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">ST → LPD</span>
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">Value: 4.0</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-6">
                    <h3 class="font-bold text-gray-900 mb-4">Dependensi Lainnya</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">BB → SPL</span>
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">Value: 2.0</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">ST → SPL</span>
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">Value: 3.0</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">KT → BPT</span>
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">Value: 3.0</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-700">LL → BPT</span>
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">Value: 4.0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Criteria Weight Chart
    const ctx = document.getElementById('criteriaChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['LPD (26%)', 'BPT (12%)', 'ST (9%)', 'KT (6%)', 'BB (5%)', 'SPL (5%)', 'LL (2%)', 'VM (1%)'],
            datasets: [{
                data: [26, 12, 9, 6, 5, 5, 2, 1],
                backgroundColor: [
                    'rgba(236, 72, 153, 0.8)',
                    'rgba(251, 146, 60, 0.8)',
                    'rgba(250, 204, 21, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(99, 102, 241, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(20, 184, 166, 0.8)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });
</script>
@endpush
