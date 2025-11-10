<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SILOKASI - Sistem Pemilihan Lokasi Perumahan')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Gradient animations */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animated-gradient {
            background: linear-gradient(-45deg, #3b82f6, #8b5cf6, #ec4899, #f59e0b);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        /* Card hover effect */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-2 rounded-lg">
                            <i class="fas fa-home text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            SILOKASI
                        </span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ url('/criteria') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">
                        <i class="fas fa-list-check mr-2"></i>Kriteria
                    </a>
                    <a href="{{ url('/alternatives') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">
                        <i class="fas fa-map-marker-alt mr-2"></i>Alternatif
                    </a>
                    <a href="{{ url('/results') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">
                        <i class="fas fa-chart-bar mr-2"></i>Hasil
                    </a>
                    <a href="{{ url('/about') }}" class="text-gray-700 hover:text-blue-600 transition font-medium">
                        <i class="fas fa-info-circle mr-2"></i>Tentang
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="md:hidden border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                <a href="{{ url('/criteria') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-list-check mr-2"></i>Kriteria
                </a>
                <a href="{{ url('/alternatives') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-map-marker-alt mr-2"></i>Alternatif
                </a>
                <a href="{{ url('/results') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-chart-bar mr-2"></i>Hasil
                </a>
                <a href="{{ url('/about') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-info-circle mr-2"></i>Tentang
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-2 rounded-lg">
                            <i class="fas fa-home text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">SILOKASI</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Sistem Informasi Pemilihan Lokasi Perumahan menggunakan metode ANP dan BORDA 
                        untuk pengambilan keputusan kelompok yang lebih objektif dan terukur.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ url('/criteria') }}" class="text-gray-400 hover:text-white transition">Kriteria</a></li>
                        <li><a href="{{ url('/alternatives') }}" class="text-gray-400 hover:text-white transition">Alternatif</a></li>
                        <li><a href="{{ url('/results') }}" class="text-gray-400 hover:text-white transition">Hasil</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i>info@silokasi.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Sukoharjo, Jawa Tengah</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SILOKASI. All rights reserved. | Powered by ANP & BORDA Methods</p>
            </div>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>
