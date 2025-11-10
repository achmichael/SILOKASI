@extends('layouts.app')

@section('title', 'Alternatif Lokasi - SILOKASI')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Alternatif Lokasi</h1>
        <p class="text-xl text-blue-100">5 Lokasi potensial untuk pembangunan perumahan</p>
    </div>
</section>

<!-- Alternatives Content -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Map Illustration -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                <i class="fas fa-map-marked-alt text-blue-600 mr-2"></i>
                Peta Lokasi Alternatif
            </h2>
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-12 text-center">
                <i class="fas fa-map text-blue-300 text-9xl mb-4"></i>
                <p class="text-gray-600 text-lg">Wilayah Kabupaten Sukoharjo, Jawa Tengah</p>
            </div>
        </div>
        
        <!-- Alternatives Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Alternative 1: Gentan -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <div class="bg-gradient-to-r from-gray-400 to-gray-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center">
                            <span class="text-gray-700 font-bold text-xl">2</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Gentan</h3>
                            <span class="text-gray-100 text-sm">Kode: A1</span>
                        </div>
                    </div>
                    <span class="bg-white bg-opacity-20 px-4 py-2 rounded-lg text-white font-semibold">
                        <i class="fas fa-medal mr-1"></i>Rank #2
                    </span>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div class="bg-gray-100 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">BORDA Points</span>
                                <span class="text-2xl font-bold text-gray-700">7.5</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-500 h-2 rounded-full" style="width: 89%"></div>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4">Lokasi Gentan merupakan alternatif terbaik kedua dengan aksesibilitas yang baik dan infrastruktur yang memadai.</p>
                        
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="text-center">
                                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-road text-blue-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Akses Jalan</p>
                                <p class="font-semibold text-gray-900">Baik</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-bolt text-green-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Infrastruktur</p>
                                <p class="font-semibold text-gray-900">Lengkap</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-chart-line text-purple-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Potensi</p>
                                <p class="font-semibold text-gray-900">Tinggi</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Ranking per DM:</h4>
                        <div class="flex items-center space-x-2">
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">DM1: #1</span>
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM2: #2</span>
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM3: #2</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alternative 2: Palur Raya -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <div class="bg-gradient-to-r from-orange-400 to-orange-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center">
                            <span class="text-orange-700 font-bold text-xl">3</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Palur Raya</h3>
                            <span class="text-orange-100 text-sm">Kode: A2</span>
                        </div>
                    </div>
                    <span class="bg-white bg-opacity-20 px-4 py-2 rounded-lg text-white font-semibold">
                        <i class="fas fa-award mr-1"></i>Rank #3
                    </span>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div class="bg-orange-50 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">BORDA Points</span>
                                <span class="text-2xl font-bold text-orange-700">3.8</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4">Lokasi Palur Raya memiliki potensi yang cukup baik dengan harga lahan yang kompetitif.</p>
                        
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="text-center">
                                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-road text-blue-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Akses Jalan</p>
                                <p class="font-semibold text-gray-900">Cukup</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-bolt text-green-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Infrastruktur</p>
                                <p class="font-semibold text-gray-900">Sedang</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-chart-line text-purple-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Potensi</p>
                                <p class="font-semibold text-gray-900">Sedang</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Ranking per DM:</h4>
                        <div class="flex items-center space-x-2">
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM1: #5</span>
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM2: #4</span>
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">DM3: #3</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alternative 3: Bekonang - BEST -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover border-4 border-yellow-400">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center">
                            <span class="text-yellow-700 font-bold text-xl">1</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Bekonang</h3>
                            <span class="text-yellow-100 text-sm">Kode: A3</span>
                        </div>
                    </div>
                    <span class="bg-white bg-opacity-20 px-4 py-2 rounded-lg text-white font-semibold">
                        <i class="fas fa-trophy mr-1"></i>Rank #1
                    </span>
                </div>
                <div class="p-6">
                    <div class="bg-yellow-50 px-4 py-2 rounded-lg mb-4 text-center">
                        <span class="text-yellow-800 font-bold">🏆 LOKASI TERBAIK</span>
                    </div>
                    
                    <div class="mb-6">
                        <div class="bg-yellow-50 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">BORDA Points</span>
                                <span class="text-2xl font-bold text-yellow-700">8.4</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4">Lokasi Bekonang merupakan pilihan terbaik dengan skor tertinggi dari konsensus Decision Makers.</p>
                        
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="text-center">
                                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-road text-blue-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Akses Jalan</p>
                                <p class="font-semibold text-gray-900">Sangat Baik</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-bolt text-green-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Infrastruktur</p>
                                <p class="font-semibold text-gray-900">Sangat Baik</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-chart-line text-purple-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Potensi</p>
                                <p class="font-semibold text-gray-900">Sangat Tinggi</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Ranking per DM:</h4>
                        <div class="flex items-center space-x-2">
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">DM1: #3</span>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">DM2: #1</span>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">DM3: #1</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alternative 4: Makamhaji -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <div class="bg-gradient-to-r from-blue-400 to-blue-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center">
                            <span class="text-blue-700 font-bold text-xl">4</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Makamhaji</h3>
                            <span class="text-blue-100 text-sm">Kode: A4</span>
                        </div>
                    </div>
                    <span class="bg-white bg-opacity-20 px-4 py-2 rounded-lg text-white font-semibold">
                        Rank #4
                    </span>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div class="bg-blue-50 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">BORDA Points</span>
                                <span class="text-2xl font-bold text-blue-700">3.2</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 38%"></div>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4">Lokasi Makamhaji memiliki potensi pengembangan dengan beberapa aspek yang perlu ditingkatkan.</p>
                        
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="text-center">
                                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-road text-blue-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Akses Jalan</p>
                                <p class="font-semibold text-gray-900">Cukup</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-bolt text-green-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Infrastruktur</p>
                                <p class="font-semibold text-gray-900">Berkembang</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-chart-line text-purple-600"></i>
                                </div>
                                <p class="text-xs text-gray-600">Potensi</p>
                                <p class="font-semibold text-gray-900">Cukup</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Ranking per DM:</h4>
                        <div class="flex items-center space-x-2">
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM1: #2</span>
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-semibold">DM2: #3</span>
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM3: #4</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Alternative 5: Baturetno -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-400 to-purple-500 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center">
                            <span class="text-purple-700 font-bold text-xl">5</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Baturetno</h3>
                            <span class="text-purple-100 text-sm">Kode: A5</span>
                        </div>
                    </div>
                    <span class="bg-white bg-opacity-20 px-4 py-2 rounded-lg text-white font-semibold">
                        Rank #5
                    </span>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="bg-purple-50 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm text-gray-600">BORDA Points</span>
                                    <span class="text-2xl font-bold text-purple-700">3.1</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-500 h-2 rounded-full" style="width: 37%"></div>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-4">Lokasi Baturetno memiliki ruang untuk berkembang dengan perhatian pada peningkatan aksesibilitas dan infrastruktur.</p>
                        </div>
                        
                        <div>
                            <div class="grid grid-cols-3 gap-4 mb-4">
                                <div class="text-center">
                                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-road text-blue-600"></i>
                                    </div>
                                    <p class="text-xs text-gray-600">Akses Jalan</p>
                                    <p class="font-semibold text-gray-900">Perlu Ditingkatkan</p>
                                </div>
                                <div class="text-center">
                                    <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-bolt text-green-600"></i>
                                    </div>
                                    <p class="text-xs text-gray-600">Infrastruktur</p>
                                    <p class="font-semibold text-gray-900">Berkembang</p>
                                </div>
                                <div class="text-center">
                                    <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-chart-line text-purple-600"></i>
                                    </div>
                                    <p class="text-xs text-gray-600">Potensi</p>
                                    <p class="font-semibold text-gray-900">Masa Depan</p>
                                </div>
                            </div>
                            
                            <div class="border-t pt-4">
                                <h4 class="font-semibold text-gray-900 mb-3">Ranking per DM:</h4>
                                <div class="flex items-center space-x-2">
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM1: #4</span>
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM2: #5</span>
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">DM3: #5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</section>
@endsection
