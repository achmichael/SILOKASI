<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang SILOKASI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(218, 165, 32, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #DAA520, #FFD700);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a.active {
            color: #DAA520;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, rgba(10,10,10,0.95) 0%, rgba(30,30,30,0.9) 100%),
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&q=80') center/cover;
            padding: 5rem 5% 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(218, 165, 32, 0.1) 0%, transparent 70%);
        }

        .page-header h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, #DAA520 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }

        .page-header p {
            font-size: 1.2rem;
            color: #ccc;
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 5%;
        }

        /* Content Sections */
        .content-section {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            border: 1px solid rgba(218, 165, 32, 0.2);
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #DAA520;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 40px;
            background: linear-gradient(180deg, #DAA520, #FFD700);
            border-radius: 2px;
        }

        .content-text {
            color: #ccc;
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .content-text strong {
            color: #DAA520;
        }

        /* Method Cards */
        .method-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .method-card {
            background: rgba(30, 30, 30, 0.5);
            padding: 2rem;
            border-radius: 15px;
            border: 1px solid rgba(218, 165, 32, 0.2);
            transition: all 0.3s ease;
        }

        .method-card:hover {
            transform: translateY(-5px);
            border-color: rgba(218, 165, 32, 0.4);
            box-shadow: 0 10px 30px rgba(218, 165, 32, 0.2);
        }

        .method-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #DAA520;
        }

        .method-card p {
            color: #ccc;
            line-height: 1.6;
        }

        /* Feature List */
        .feature-list {
            list-style: none;
            margin-top: 1.5rem;
        }

        .feature-list li {
            padding: 1rem 0;
            padding-left: 2.5rem;
            position: relative;
            color: #ccc;
            line-height: 1.6;
            border-bottom: 1px solid rgba(218, 165, 32, 0.1);
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #DAA520;
            font-size: 1.3rem;
            font-weight: 700;
        }

        /* Team Section */
        .team-section {
            text-align: center;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .team-card {
            background: rgba(30, 30, 30, 0.5);
            padding: 2rem;
            border-radius: 15px;
            border: 1px solid rgba(218, 165, 32, 0.2);
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            border-color: rgba(218, 165, 32, 0.4);
        }

        .team-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(218, 165, 32, 0.3), rgba(255, 215, 0, 0.2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 1rem;
        }

        .team-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.3rem;
        }

        .team-role {
            color: #DAA520;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .team-desc {
            color: #999;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, rgba(218, 165, 32, 0.1) 0%, rgba(255, 215, 0, 0.05) 100%);
            text-align: center;
            padding: 4rem 2rem;
            border-radius: 20px;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, #DAA520 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cta-desc {
            color: #ccc;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            color: #000;
            padding: 1.2rem 3rem;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(218, 165, 32, 0.4);
        }

        .cta-button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(218, 165, 32, 0.6);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .method-grid,
            .team-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">SILOKASI</div>
        <ul class="nav-links">
            <li><a href="/">Beranda</a></li>
            <li><a href="/results">Hasil Ranking</a></li>
            <li><a href="/criteria">Kriteria</a></li>
            <li><a href="/alternatives">Alternatif</a></li>
            <li><a href="/about" class="active">Tentang</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1>Tentang SILOKASI</h1>
        <p>
            Sistem Pendukung Keputusan Cerdas untuk Pemilihan Lokasi Perumahan 
            menggunakan Metode ANP & BORDA
        </p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- About Section -->
        <div class="content-section">
            <h2 class="section-title">Apa itu SILOKASI?</h2>
            <p class="content-text">
                <strong>SILOKASI</strong> adalah sistem pendukung keputusan kelompok (Group Decision Support System) 
                yang dirancang untuk membantu proses pemilihan lokasi perumahan secara objektif dan terstruktur. 
                Sistem ini menggunakan kombinasi dua metode powerful: <strong>ANP (Analytic Network Process)</strong> 
                dan <strong>BORDA</strong> untuk menghasilkan keputusan konsensus yang akurat.
            </p>
            <p class="content-text">
                Dikembangkan berdasarkan penelitian ilmiah tentang pemilihan lokasi perumahan di Kabupaten Sukoharjo, 
                sistem ini mengevaluasi lokasi berdasarkan 8 kriteria komprehensif dan mengagregasi preferensi 
                dari multiple decision makers untuk menghasilkan ranking final yang objektif.
            </p>
        </div>

        <!-- Methodology Section -->
        <div class="content-section">
            <h2 class="section-title">Metodologi</h2>
            <div class="method-grid">
                <div class="method-card">
                    <h3>🎯 ANP (Analytic Network Process)</h3>
                    <p>
                        Metode analisis multi-kriteria yang mempertimbangkan hubungan dependensi antar kriteria. 
                        ANP menghasilkan bobot untuk setiap kriteria dan alternatif berdasarkan perbandingan berpasangan.
                    </p>
                </div>
                <div class="method-card">
                    <h3>🤝 BORDA Method</h3>
                    <p>
                        Metode voting untuk agregasi preferensi kelompok. BORDA mengkonversi ranking individual 
                        dari setiap decision maker menjadi skor konsensus untuk menentukan alternatif terbaik.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="content-section">
            <h2 class="section-title">Fitur Unggulan</h2>
            <ul class="feature-list">
                <li><strong>Evaluasi Multi-Kriteria</strong> - 8 kriteria komprehensif mencakup aspek teknis, legal, ekonomi, dan estetika</li>
                <li><strong>Keputusan Kelompok</strong> - Mengagregasi preferensi dari 3 decision makers dengan keahlian berbeda</li>
                <li><strong>Analisis Dependensi</strong> - Mempertimbangkan hubungan dan pengaruh antar kriteria menggunakan ANP</li>
                <li><strong>Konsensus Objektif</strong> - Metode BORDA menghasilkan ranking final yang fair dan terukur</li>
                <li><strong>Transparansi Proses</strong> - Setiap langkah kalkulasi dapat ditelusuri dan diaudit</li>
                <li><strong>Interface Modern</strong> - Tampilan clean, smooth, dan responsive untuk pengalaman optimal</li>
                <li><strong>Visualisasi Data</strong> - Chart dan grafik interaktif untuk memudahkan interpretasi hasil</li>
                <li><strong>Scalable</strong> - Mudah dikembangkan untuk menambah kriteria atau alternatif baru</li>
            </ul>
        </div>

        <!-- How It Works -->
        <div class="content-section">
            <h2 class="section-title">Cara Kerja Sistem</h2>
            <p class="content-text">
                <strong>Langkah 1: Input Data</strong><br>
                Decision makers melakukan pairwise comparison untuk kriteria dan alternatif berdasarkan expertise masing-masing.
            </p>
            <p class="content-text">
                <strong>Langkah 2: Kalkulasi ANP</strong><br>
                Sistem menghitung bobot kriteria dan alternatif menggunakan eigenvector method, dengan mempertimbangkan 
                dependensi antar kriteria.
            </p>
            <p class="content-text">
                <strong>Langkah 3: Ranking Individual</strong><br>
                Setiap decision maker menghasilkan ranking alternatif berdasarkan weighted sum dari bobot ANP.
            </p>
            <p class="content-text">
                <strong>Langkah 4: Agregasi BORDA</strong><br>
                Ranking individual digabungkan menggunakan metode BORDA untuk menghasilkan konsensus final ranking.
            </p>
            <p class="content-text">
                <strong>Langkah 5: Hasil & Rekomendasi</strong><br>
                Sistem menampilkan hasil ranking final beserta detail evaluasi untuk setiap alternatif lokasi.
            </p>
        </div>

        <!-- Tech Stack -->
        <div class="content-section">
            <h2 class="section-title">Teknologi yang Digunakan</h2>
            <div class="method-grid">
                <div class="method-card">
                    <h3>💻 Backend</h3>
                    <p>Laravel 11 - PHP Framework modern dengan arsitektur MVC yang robust dan scalable</p>
                </div>
                <div class="method-card">
                    <h3>🎨 Frontend</h3>
                    <p>HTML5, CSS3, JavaScript - Interface modern dengan animasi smooth dan design premium</p>
                </div>
                <div class="method-card">
                    <h3>📊 Visualization</h3>
                    <p>Chart.js - Library charting interaktif untuk visualisasi data yang menarik</p>
                </div>
                <div class="method-card">
                    <h3>🗄️ Database</h3>
                    <p>MySQL - Relational database dengan UUID untuk keamanan dan scalability</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta-section">
            <h2 class="cta-title">Siap Menemukan Lokasi Ideal Anda?</h2>
            <p class="cta-desc">
                Gunakan SILOKASI untuk membuat keputusan investasi properti yang tepat
            </p>
            <a href="/results" class="cta-button">Lihat Hasil Ranking</a>
        </div>
    </div>
</body>
</html>
