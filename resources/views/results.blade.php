<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ranking - SILOKASI</title>
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
                        url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1920&q=80') center/cover;
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

        /* Main Content */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 5%;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .stat-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(218, 165, 32, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #DAA520, #FFD700);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(218, 165, 32, 0.4);
            box-shadow: 0 10px 40px rgba(218, 165, 32, 0.2);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-label {
            color: #999;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, #DAA520 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Ranking Cards */
        .ranking-section {
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
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

        .ranking-list {
            display: grid;
            gap: 1.5rem;
        }

        .ranking-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(218, 165, 32, 0.2);
            display: flex;
            align-items: center;
            gap: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .ranking-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(218, 165, 32, 0.05) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .ranking-card:hover::before {
            opacity: 1;
        }

        .ranking-card:hover {
            transform: translateX(10px);
            border-color: rgba(218, 165, 32, 0.4);
            box-shadow: 0 10px 40px rgba(218, 165, 32, 0.2);
        }

        .rank-badge {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 900;
            flex-shrink: 0;
            position: relative;
        }

        .rank-badge.gold {
            background: linear-gradient(135deg, #FFD700 0%, #DAA520 100%);
            color: #000;
            box-shadow: 0 10px 40px rgba(255, 215, 0, 0.5);
        }

        .rank-badge.silver {
            background: linear-gradient(135deg, #C0C0C0 0%, #A8A8A8 100%);
            color: #000;
            box-shadow: 0 10px 40px rgba(192, 192, 192, 0.3);
        }

        .rank-badge.bronze {
            background: linear-gradient(135deg, #CD7F32 0%, #B87333 100%);
            color: #fff;
            box-shadow: 0 10px 40px rgba(205, 127, 50, 0.3);
        }

        .rank-badge.default {
            background: rgba(40, 40, 40, 0.8);
            color: #DAA520;
            border: 2px solid rgba(218, 165, 32, 0.3);
        }

        .ranking-info {
            flex: 1;
        }

        .location-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .location-code {
            color: #DAA520;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .location-desc {
            color: #999;
            line-height: 1.6;
        }

        .ranking-score {
            text-align: right;
        }

        .score-label {
            color: #999;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .score-value {
            font-size: 3rem;
            font-weight: 900;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .score-bar {
            width: 150px;
            height: 8px;
            background: rgba(40, 40, 40, 0.8);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .score-fill {
            height: 100%;
            background: linear-gradient(90deg, #DAA520 0%, #FFD700 100%);
            border-radius: 4px;
            transition: width 1s ease;
        }

        /* Chart Section */
        .chart-container {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            border: 1px solid rgba(218, 165, 32, 0.2);
            margin-bottom: 4rem;
        }

        .chart-title {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #DAA520;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .ranking-card {
                flex-direction: column;
                text-align: center;
            }

            .ranking-score {
                text-align: center;
            }

            .score-bar {
                margin: 0.5rem auto 0;
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
            <li><a href="/results" class="active">Hasil Ranking</a></li>
            <li><a href="/criteria">Kriteria</a></li>
            <li><a href="/alternatives">Alternatif</a></li>
            <li><a href="/about">Tentang</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1>Hasil Ranking Lokasi</h1>
        <p>Hasil konsensus menggunakan metode ANP & BORDA</p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📍</div>
                <div class="stat-label">Total Alternatif</div>
                <div class="stat-value">5</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Decision Makers</div>
                <div class="stat-value">3</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏆</div>
                <div class="stat-label">Lokasi Terbaik</div>
                <div class="stat-value" style="font-size: 2rem;">Bekonang</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-label">Kriteria Evaluasi</div>
                <div class="stat-value">8</div>
            </div>
        </div>

        <!-- Ranking Section -->
        <div class="ranking-section">
            <h2 class="section-title">Peringkat Final</h2>
            
            <div class="ranking-list">
                <!-- Rank 1 -->
                <div class="ranking-card">
                    <div class="rank-badge gold">1</div>
                    <div class="ranking-info">
                        <h3 class="location-name">Bekonang</h3>
                        <div class="location-code">Kode: A3</div>
                        <p class="location-desc">Lokasi dengan skor tertinggi berdasarkan evaluasi komprehensif dari 8 kriteria dan konsensus 3 decision makers.</p>
                    </div>
                    <div class="ranking-score">
                        <div class="score-label">BORDA Points</div>
                        <div class="score-value">8.4</div>
                        <div class="score-bar">
                            <div class="score-fill" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Rank 2 -->
                <div class="ranking-card">
                    <div class="rank-badge silver">2</div>
                    <div class="ranking-info">
                        <h3 class="location-name">Gentan</h3>
                        <div class="location-code">Kode: A1</div>
                        <p class="location-desc">Peringkat kedua dengan keunggulan pada aspek infrastruktur dan aksesibilitas lokasi.</p>
                    </div>
                    <div class="ranking-score">
                        <div class="score-label">BORDA Points</div>
                        <div class="score-value">7.5</div>
                        <div class="score-bar">
                            <div class="score-fill" style="width: 89%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Rank 3 -->
                <div class="ranking-card">
                    <div class="rank-badge bronze">3</div>
                    <div class="ranking-info">
                        <h3 class="location-name">Palur Raya</h3>
                        <div class="location-code">Kode: A2</div>
                        <p class="location-desc">Peringkat ketiga dengan potensi pengembangan yang baik di masa depan.</p>
                    </div>
                    <div class="ranking-score">
                        <div class="score-label">BORDA Points</div>
                        <div class="score-value">3.8</div>
                        <div class="score-bar">
                            <div class="score-fill" style="width: 45%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Rank 4 -->
                <div class="ranking-card">
                    <div class="rank-badge default">4</div>
                    <div class="ranking-info">
                        <h3 class="location-name">Makamhaji</h3>
                        <div class="location-code">Kode: A4</div>
                        <p class="location-desc">Memiliki keunggulan pada legalitas lahan dan kesesuaian tata ruang.</p>
                    </div>
                    <div class="ranking-score">
                        <div class="score-label">BORDA Points</div>
                        <div class="score-value">3.2</div>
                        <div class="score-bar">
                            <div class="score-fill" style="width: 38%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Rank 5 -->
                <div class="ranking-card">
                    <div class="rank-badge default">5</div>
                    <div class="ranking-info">
                        <h3 class="location-name">Baturetno</h3>
                        <div class="location-code">Kode: A5</div>
                        <p class="location-desc">Lokasi dengan nilai estetika dan pemandangan yang menarik.</p>
                    </div>
                    <div class="ranking-score">
                        <div class="score-label">BORDA Points</div>
                        <div class="score-value">3.1</div>
                        <div class="score-bar">
                            <div class="score-fill" style="width: 37%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <h3 class="chart-title">Visualisasi Perbandingan Skor</h3>
            <canvas id="rankingChart" style="max-height: 400px;"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart
        const ctx = document.getElementById('rankingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Bekonang (A3)', 'Gentan (A1)', 'Palur Raya (A2)', 'Makamhaji (A4)', 'Baturetno (A5)'],
                datasets: [{
                    label: 'BORDA Points',
                    data: [8.4, 7.5, 3.8, 3.2, 3.1],
                    backgroundColor: [
                        'rgba(218, 165, 32, 0.8)',
                        'rgba(192, 192, 192, 0.8)',
                        'rgba(205, 127, 50, 0.8)',
                        'rgba(100, 100, 100, 0.6)',
                        'rgba(100, 100, 100, 0.6)'
                    ],
                    borderColor: [
                        'rgba(218, 165, 32, 1)',
                        'rgba(192, 192, 192, 1)',
                        'rgba(205, 127, 50, 1)',
                        'rgba(100, 100, 100, 1)',
                        'rgba(100, 100, 100, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff',
                            font: { size: 14 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#999' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    },
                    x: {
                        ticks: { color: '#999' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    }
                }
            }
        });

        // Animate score bars on load
        window.addEventListener('load', () => {
            document.querySelectorAll('.score-fill').forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>
</body>
</html>
