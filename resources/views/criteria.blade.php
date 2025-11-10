<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kriteria Evaluasi - SILOKASI</title>
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
                        url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1920&q=80') center/cover;
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
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 5%;
        }

        /* Criteria Grid */
        .criteria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .criteria-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid rgba(218, 165, 32, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .criteria-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #DAA520, #FFD700);
        }

        .criteria-card:hover {
            transform: translateY(-10px);
            border-color: rgba(218, 165, 32, 0.4);
            box-shadow: 0 20px 60px rgba(218, 165, 32, 0.2);
        }

        .criteria-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .criteria-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(218, 165, 32, 0.2) 0%, rgba(255, 215, 0, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .criteria-title-group h3 {
            font-size: 1.5rem;
            margin-bottom: 0.3rem;
            color: #fff;
        }

        .criteria-code {
            color: #DAA520;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .criteria-description {
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .criteria-weight {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: rgba(30, 30, 30, 0.5);
            border-radius: 10px;
            border: 1px solid rgba(218, 165, 32, 0.1);
        }

        .weight-label {
            color: #999;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .weight-value {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Chart Container */
        .chart-container {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            border: 1px solid rgba(218, 165, 32, 0.2);
            margin-top: 4rem;
        }

        .chart-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #DAA520;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .criteria-grid {
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
            <li><a href="/criteria" class="active">Kriteria</a></li>
            <li><a href="/alternatives">Alternatif</a></li>
            <li><a href="/about">Tentang</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1>Kriteria Evaluasi</h1>
        <p>8 kriteria yang digunakan untuk mengevaluasi lokasi perumahan</p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Criteria Grid -->
        <div class="criteria-grid">
            <!-- KT -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">🏗️</div>
                    <div class="criteria-title-group">
                        <h3>Kondisi Tanah</h3>
                        <div class="criteria-code">KT</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Kelayakan struktur tanah untuk konstruksi. Meliputi daya dukung tanah, kepadatan, dan kestabilan untuk pembangunan perumahan.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.06</span>
                </div>
            </div>

            <!-- BB -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">🌊</div>
                    <div class="criteria-title-group">
                        <h3>Bebas Banjir</h3>
                        <div class="criteria-code">BB</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Risiko banjir di area tersebut. Evaluasi drainase, elevasi tanah, dan riwayat banjir untuk memastikan keamanan lokasi.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.05</span>
                </div>
            </div>

            <!-- LL -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">📏</div>
                    <div class="criteria-title-group">
                        <h3>Luas Lahan</h3>
                        <div class="criteria-code">LL</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Ukuran area yang tersedia untuk pembangunan. Menentukan kapasitas dan fleksibilitas pengembangan proyek perumahan.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.02</span>
                </div>
            </div>

            <!-- LPD -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">🚀</div>
                    <div class="criteria-title-group">
                        <h3>Prospek Pengembangan</h3>
                        <div class="criteria-code">LPD</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Potensi pengembangan kawasan di masa depan. Termasuk rencana infrastruktur, pertumbuhan ekonomi, dan investasi daerah.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.26</span>
                </div>
            </div>

            <!-- ST -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">📜</div>
                    <div class="criteria-title-group">
                        <h3>Status Tanah</h3>
                        <div class="criteria-code">ST</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Legalitas kepemilikan atau izin lahan. Status sertifikat, hak guna bangunan, dan kelengkapan dokumen legal tanah.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.09</span>
                </div>
            </div>

            <!-- BPT -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">💰</div>
                    <div class="criteria-title-group">
                        <h3>Biaya Pematangan Tanah</h3>
                        <div class="criteria-code">BPT</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Biaya penyiapan lahan agar layak bangun. Meliputi pengurugan, pemerataan, drainase, dan infrastruktur dasar.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.12</span>
                </div>
            </div>

            <!-- SPL -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">🗺️</div>
                    <div class="criteria-title-group">
                        <h3>Kesesuaian Peruntukan Lahan</h3>
                        <div class="criteria-code">SPL</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Kesesuaian dengan tata ruang kota. Evaluasi peruntukan lahan dalam RTRW dan izin penggunaan untuk perumahan.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.05</span>
                </div>
            </div>

            <!-- VM -->
            <div class="criteria-card">
                <div class="criteria-header">
                    <div class="criteria-icon">🏞️</div>
                    <div class="criteria-title-group">
                        <h3>Pemandangan Menarik</h3>
                        <div class="criteria-code">VM</div>
                    </div>
                </div>
                <p class="criteria-description">
                    Nilai estetika dan kenyamanan lingkungan. View, udara bersih, keindahan alam, dan kualitas lingkungan sekitar.
                </p>
                <div class="criteria-weight">
                    <span class="weight-label">Bobot ANP</span>
                    <span class="weight-value">0.01</span>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="chart-container">
            <h3 class="chart-title">Distribusi Bobot Kriteria</h3>
            <canvas id="criteriaChart" style="max-height: 400px;"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('criteriaChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['LPD (26%)', 'BPT (12%)', 'ST (9%)', 'KT (6%)', 'BB (5%)', 'SPL (5%)', 'LL (2%)', 'VM (1%)'],
                datasets: [{
                    data: [0.26, 0.12, 0.09, 0.06, 0.05, 0.05, 0.02, 0.01],
                    backgroundColor: [
                        'rgba(218, 165, 32, 0.9)',
                        'rgba(255, 215, 0, 0.8)',
                        'rgba(205, 127, 50, 0.8)',
                        'rgba(192, 192, 192, 0.7)',
                        'rgba(169, 169, 169, 0.7)',
                        'rgba(128, 128, 128, 0.7)',
                        'rgba(100, 100, 100, 0.7)',
                        'rgba(80, 80, 80, 0.7)'
                    ],
                    borderColor: '#0a0a0a',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            font: { size: 13 },
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + (context.parsed * 100).toFixed(0) + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
