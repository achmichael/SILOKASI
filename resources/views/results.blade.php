@extends('layouts.app')

@section('title', 'Hasil Ranking - SILOKASI')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Hasil Ranking Lokasi</h1>
        <p class="text-xl text-blue-100">Hasil konsensus menggunakan metode ANP & BORDA</p>
    </div>
</section>

<!-- Results Content -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Alternatif</p>
                        <h3 class="text-3xl font-bold text-gray-900">5</h3>
                    </div>
                    <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Decision Makers</p>
                        <h3 class="text-3xl font-bold text-gray-900">3</h3>
                    </div>
                    <div class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-pink-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Lokasi Terbaik</p>
                        <h3 class="text-2xl font-bold text-gray-900">Bekonang</h3>
                    </div>
                    <div class="bg-pink-100 w-14 h-14 rounded-full flex items-center justify-center">
                        <i class="fas fa-trophy text-pink-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Ranking Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                <h2 class="text-2xl font-bold">Peringkat Final (Metode BORDA)</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peringkat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Lokasi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">BORDA Points</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 w-10 h-10 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold">1</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">A3</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Bekonang</div>
                                <div class="text-sm text-gray-500">Lokasi Bekonang</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2" style="width: 150px;">
                                        <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 100%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">8.4</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-trophy mr-1"></i> Terbaik
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="#" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-br from-gray-400 to-gray-500 w-10 h-10 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold">2</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">A1</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Gentan</div>
                                <div class="text-sm text-gray-500">Lokasi Gentan</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2" style="width: 150px;">
                                        <div class="bg-gray-500 h-2.5 rounded-full" style="width: 89%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">7.5</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    <i class="fas fa-medal mr-1"></i> Sangat Baik
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="#" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-br from-orange-400 to-orange-500 w-10 h-10 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold">3</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">A2</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Palur Raya</div>
                                <div class="text-sm text-gray-500">Lokasi Palur Raya</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2" style="width: 150px;">
                                        <div class="bg-orange-500 h-2.5 rounded-full" style="width: 45%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">3.8</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                    <i class="fas fa-award mr-1"></i> Baik
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="#" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-gray-300 w-10 h-10 rounded-full flex items-center justify-center">
                                        <span class="text-gray-700 font-bold">4</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">A4</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Makamhaji</div>
                                <div class="text-sm text-gray-500">Lokasi Makamhaji</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2" style="width: 150px;">
                                        <div class="bg-blue-400 h-2.5 rounded-full" style="width: 38%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">3.2</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Cukup
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="#" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-gray-300 w-10 h-10 rounded-full flex items-center justify-center">
                                        <span class="text-gray-700 font-bold">5</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">A5</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Baturetno</div>
                                <div class="text-sm text-gray-500">Lokasi Baturetno</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2" style="width: 150px;">
                                        <div class="bg-purple-400 h-2.5 rounded-full" style="width: 37%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">3.1</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    Cukup
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="#" class="text-blue-600 hover:text-blue-900 font-medium">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Bar Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
                    Perbandingan BORDA Points
                </h3>
                <canvas id="bordaChart"></canvas>
            </div>
            
            <!-- Pie Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-chart-pie text-purple-600 mr-2"></i>
                    Distribusi Skor
                </h3>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        
        <!-- DM Rankings Comparison -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-users text-pink-600 mr-2"></i>
                Perbandingan Ranking dari Decision Makers
            </h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Alternatif</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">DM Lahan</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">DM Infrastruktur</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">DM Sosial Ekonomi</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase bg-blue-50">Konsensus</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Gentan (A1)</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">1</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">2</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">2</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center bg-blue-50">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">2</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Palur Raya (A2)</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">5</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">4</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">3</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center bg-blue-50">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">3</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Bekonang (A3)</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">3</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">1</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">1</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center bg-blue-50">
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">1</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Makamhaji (A4)</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">2</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">3</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">4</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center bg-blue-50">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">4</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Baturetno (A5)</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">4</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">5</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">5</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center bg-blue-50">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">5</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</section>
@endsection

@push('scripts')
<script>
    // BORDA Points Bar Chart
    const bordaCtx = document.getElementById('bordaChart').getContext('2d');
    new Chart(bordaCtx, {
        type: 'bar',
        data: {
            labels: ['Bekonang', 'Gentan', 'Palur Raya', 'Makamhaji', 'Baturetno'],
            datasets: [{
                label: 'BORDA Points',
                data: [8.4, 7.5, 3.8, 3.2, 3.1],
                backgroundColor: [
                    'rgba(251, 191, 36, 0.8)',
                    'rgba(156, 163, 175, 0.8)',
                    'rgba(251, 146, 60, 0.8)',
                    'rgba(96, 165, 250, 0.8)',
                    'rgba(192, 132, 252, 0.8)'
                ],
                borderColor: [
                    'rgb(251, 191, 36)',
                    'rgb(156, 163, 175)',
                    'rgb(251, 146, 60)',
                    'rgb(96, 165, 250)',
                    'rgb(192, 132, 252)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10
                }
            }
        }
    });
    
    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Bekonang', 'Gentan', 'Palur Raya', 'Makamhaji', 'Baturetno'],
            datasets: [{
                data: [8.4, 7.5, 3.8, 3.2, 3.1],
                backgroundColor: [
                    'rgba(251, 191, 36, 0.8)',
                    'rgba(156, 163, 175, 0.8)',
                    'rgba(251, 146, 60, 0.8)',
                    'rgba(96, 165, 250, 0.8)',
                    'rgba(192, 132, 252, 0.8)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
