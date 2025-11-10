<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILOKASI - Sistem Lokasi Perumahan Cerdas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background: #0a0a0a;
            color: #fff;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(135deg, rgba(10,10,10,0.9) 0%, rgba(30,30,30,0.85) 100%),
                        url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=80') center/cover no-repeat;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(218, 165, 32, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 5%;
            position: relative;
            z-index: 100;
            background: linear-gradient(180deg, rgba(0,0,0,0.6) 0%, transparent 100%);
        }

        .logo {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 30px rgba(218, 165, 32, 0.5);
            animation: logoGlow 3s ease-in-out infinite;
        }

        @keyframes logoGlow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(218, 165, 32, 0.5)); }
            50% { filter: drop-shadow(0 0 20px rgba(218, 165, 32, 0.8)); }
        }

        .nav-links {
            display: flex;
            gap: 3rem;
            list-style: none;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            position: relative;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #DAA520, #FFD700);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #DAA520;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-login {
            padding: 0.7rem 1.8rem;
            background: transparent;
            border: 1px solid #DAA520;
            color: #DAA520;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-login:hover {
            background: rgba(218, 165, 32, 0.1);
            border-color: #FFD700;
            color: #FFD700;
        }

        .btn-register {
            padding: 0.7rem 1.8rem;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            border: none;
            color: #000;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            box-shadow: 0 5px 15px rgba(218, 165, 32, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(218, 165, 32, 0.5);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            color: #DAA520;
            font-weight: 600;
        }

        .btn-logout {
            padding: 0.7rem 1.8rem;
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.4);
            color: #ff6b6b;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-logout:hover {
            background: rgba(220, 53, 69, 0.3);
            border-color: rgba(220, 53, 69, 0.6);
        }

        /* Hero Content */
        .hero-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem 5%;
            position: relative;
            z-index: 10;
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(135deg, #fff 0%, #DAA520 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: fadeInUp 1s ease-out;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            color: #e0e0e0;
            margin-bottom: 3rem;
            max-width: 700px;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.2s backwards;
            font-weight: 300;
        }

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

        /* Search Bar Section */
        .search-section {
            padding: 3rem 5% 4rem;
            position: relative;
            z-index: 10;
        }

        .search-container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            padding: 1.5rem 2rem;
            display: flex;
            gap: 1.5rem;
            align-items: center;
            border: 1px solid rgba(218, 165, 32, 0.3);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5),
                        0 0 80px rgba(218, 165, 32, 0.2);
            animation: fadeInUp 1s ease-out 0.4s backwards;
            transition: all 0.3s ease;
        }

        .search-container:hover {
            border-color: rgba(218, 165, 32, 0.6);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.6),
                        0 0 100px rgba(218, 165, 32, 0.3);
            transform: translateY(-2px);
        }

        .search-input-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .search-label {
            font-size: 0.75rem;
            color: #DAA520;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .search-input {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1rem;
            padding: 0.5rem 0;
            outline: none;
            font-weight: 500;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .search-divider {
            width: 1px;
            height: 50px;
            background: linear-gradient(to bottom, transparent, rgba(218, 165, 32, 0.5), transparent);
        }

        .search-btn {
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            color: #000;
            border: none;
            padding: 1.2rem 3rem;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(218, 165, 32, 0.4);
        }

        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(218, 165, 32, 0.6);
        }

        .search-btn:active {
            transform: scale(0.98);
        }

        /* Features Section */
        .features {
            padding: 6rem 5%;
            background: linear-gradient(180deg, #0a0a0a 0%, #1a1a1a 100%);
        }

        .features-title {
            text-align: center;
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, #DAA520 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .features-subtitle {
            text-align: center;
            color: #999;
            margin-bottom: 4rem;
            font-size: 1.1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: rgba(30, 30, 30, 0.6);
            padding: 2.5rem;
            border-radius: 20px;
            border: 1px solid rgba(218, 165, 32, 0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: rgba(218, 165, 32, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4),
                        0 0 60px rgba(218, 165, 32, 0.2);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #DAA520;
        }

        .feature-card p {
            color: #ccc;
            line-height: 1.6;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .search-container {
                flex-direction: column;
                padding: 2rem 1.5rem;
                gap: 1rem;
            }

            .search-divider {
                display: none;
            }

            .search-input-group {
                width: 100%;
            }

            .search-btn {
                width: 100%;
                padding: 1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(218, 165, 32, 0.8);
            font-size: 2rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <!-- Navigation -->
        <nav>
            <div class="logo">SILOKASI</div>
            <ul class="nav-links">
                <li><a href="/">Beranda</a></li>
                <li><a href="/results">Hasil Ranking</a></li>
                <li><a href="/criteria">Kriteria</a></li>
                <li><a href="/alternatives">Alternatif</a></li>
                <li><a href="/about">Tentang</a></li>
            </ul>
            <div class="nav-actions">
                <div id="authButtons" style="display: flex; gap: 1rem;">
                    <a href="/login" class="btn-login">Masuk</a>
                    <a href="/register" class="btn-register">Daftar</a>
                </div>
                <div id="userInfo" class="user-info" style="display: none;">
                    <span class="user-name" id="userName"></span>
                    <button class="btn-logout" onclick="logout()">Keluar</button>
                </div>
            </div>
            <button class="mobile-menu-btn">☰</button>
        </nav>

        <!-- Hero Content -->
        <div class="hero-content">
            <h1 class="hero-title">Temukan Lokasi<br>Perumahan Ideal</h1>
            <p class="hero-subtitle">
                Sistem pendukung keputusan cerdas menggunakan metode ANP & BORDA 
                untuk membantu Anda menemukan lokasi perumahan terbaik
            </p>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <div class="search-container">
                <div class="search-input-group">
                    <label class="search-label">Lokasi</label>
                    <input type="text" class="search-input" placeholder="Cari lokasi perumahan...">
                </div>
                
                <div class="search-divider"></div>
                
                <div class="search-input-group">
                    <label class="search-label">Kriteria</label>
                    <input type="text" class="search-input" placeholder="Pilih kriteria prioritas...">
                </div>
                
                <div class="search-divider"></div>
                
                <div class="search-input-group">
                    <label class="search-label">Budget</label>
                    <input type="text" class="search-input" placeholder="Rentang harga...">
                </div>
                
                <button class="search-btn">Mulai</button>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="features-title">Keunggulan Sistem</h2>
        <p class="features-subtitle">Teknologi terdepan untuk keputusan terbaik</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Analisis Presisi</h3>
                <p>Menggunakan metode ANP (Analytic Network Process) untuk analisis multi-kriteria yang akurat dan terstruktur.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3>Keputusan Kelompok</h3>
                <p>Metode BORDA mengagregasi preferensi dari multiple decision makers untuk hasil konsensus yang objektif.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Data Komprehensif</h3>
                <p>8 kriteria evaluasi meliputi kondisi tanah, infrastruktur, legalitas, dan prospek pengembangan.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Proses Cepat</h3>
                <p>Sistem otomatis yang menghasilkan ranking lokasi dalam hitungan detik dengan akurasi tinggi.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Transparan</h3>
                <p>Setiap hasil dapat ditelusuri prosesnya, dari pairwise comparison hingga final ranking.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Responsif</h3>
                <p>Akses dari perangkat apapun - desktop, tablet, atau smartphone dengan pengalaman optimal.</p>
            </div>
        </div>
    </section>

    <script>
        // Check authentication status
        window.addEventListener('load', () => {
            const token = localStorage.getItem('auth_token');
            const user = localStorage.getItem('user');
            
            if (token && user) {
                const userData = JSON.parse(user);
                document.getElementById('authButtons').style.display = 'none';
                document.getElementById('userInfo').style.display = 'flex';
                document.getElementById('userName').textContent = userData.name;
            } else {
                document.getElementById('authButtons').style.display = 'flex';
                document.getElementById('userInfo').style.display = 'none';
            }
        });

        // Logout function
        async function logout() {
            const token = localStorage.getItem('auth_token');
            
            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
            } catch (error) {
                console.error('Logout error:', error);
            } finally {
                // Clear local storage
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                localStorage.removeItem('remember_me');
                
                // Reload page
                window.location.reload();
            }
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Search button action
        document.querySelector('.search-btn').addEventListener('click', function() {
            window.location.href = '/results';
        });
    </script>
</body>
</html>
