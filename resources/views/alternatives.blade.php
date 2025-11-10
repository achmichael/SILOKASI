<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alternatif Lokasi - SILOKASI</title>
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
                        url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=1920&q=80') center/cover;
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

        /* Alternatives Grid */
        .alternatives-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 2.5rem;
        }

        .alternative-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(218, 165, 32, 0.2);
            transition: all 0.3s ease;
            position: relative;
        }

        .alternative-card:hover {
            transform: translateY(-10px);
            border-color: rgba(218, 165, 32, 0.4);
            box-shadow: 0 25px 60px rgba(218, 165, 32, 0.2);
        }

        .alternative-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            position: relative;
        }

        .alternative-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            color: #000;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .alternative-content {
            padding: 2rem;
        }

        .alternative-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .alternative-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.3rem;
        }

        .alternative-code {
            color: #DAA520;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .alternative-rank {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .alternative-description {
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .alternative-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-item {
            background: rgba(30, 30, 30, 0.5);
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid rgba(218, 165, 32, 0.1);
        }

        .stat-label {
            color: #999;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.3rem;
        }

        .stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #DAA520;
        }

        /* Comparison Table */
        .comparison-section {
            margin-top: 4rem;
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            border: 1px solid rgba(218, 165, 32, 0.2);
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #DAA520;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1.2rem;
            text-align: left;
            border-bottom: 1px solid rgba(218, 165, 32, 0.1);
        }

        th {
            background: rgba(30, 30, 30, 0.5);
            color: #DAA520;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        td {
            color: #ccc;
        }

        tr:hover {
            background: rgba(218, 165, 32, 0.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .alternatives-grid {
                grid-template-columns: 1fr;
            }

            .alternative-stats {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 0.8rem;
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
            <li><a href="/alternatives" class="active">Alternatif</a></li>
            <li><a href="/about">Tentang</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1>Alternatif Lokasi</h1>
        <p>5 lokasi perumahan yang dievaluasi dalam sistem</p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Alternatives Grid -->
        <div class="alternatives-grid">
            <!-- A3 - Bekonang -->
            <div class="alternative-card">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800&q=80" alt="Bekonang" class="alternative-image">
                    <div class="alternative-badge">🏆 TERBAIK</div>
                </div>
                <div class="alternative-content">
                    <div class="alternative-header">
                        <div>
                            <h3 class="alternative-title">Bekonang</h3>
                            <div class="alternative-code">Kode: A3</div>
                        </div>
                        <div class="alternative-rank">#1</div>
                    </div>
                    <p class="alternative-description">
                        Lokasi dengan skor tertinggi. Unggul dalam prospek pengembangan, infrastruktur, dan kondisi lahan yang ideal untuk pembangunan perumahan.
                    </p>
                    <div class="alternative-stats">
                        <div class="stat-item">
                            <div class="stat-label">BORDA Score</div>
                            <div class="stat-value">8.4</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">ANP Weight</div>
                            <div class="stat-value">0.25</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- A1 - Gentan -->
            <div class="alternative-card">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800&q=80" alt="Gentan" class="alternative-image">
                    <div class="alternative-badge" style="background: linear-gradient(135deg, #C0C0C0, #E8E8E8);">🥈 RUNNER-UP</div>
                </div>
                <div class="alternative-content">
                    <div class="alternative-header">
                        <div>
                            <h3 class="alternative-title">Gentan</h3>
                            <div class="alternative-code">Kode: A1</div>
                        </div>
                        <div class="alternative-rank">#2</div>
                    </div>
                    <p class="alternative-description">
                        Peringkat kedua dengan keunggulan aksesibilitas dan infrastruktur yang sudah berkembang baik di sekitar lokasi.
                    </p>
                    <div class="alternative-stats">
                        <div class="stat-item">
                            <div class="stat-label">BORDA Score</div>
                            <div class="stat-value">7.5</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">ANP Weight</div>
                            <div class="stat-value">0.20</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- A2 - Palur Raya -->
            <div class="alternative-card">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1558036117-15d82a90b9b1?w=800&q=80" alt="Palur Raya" class="alternative-image">
                    <div class="alternative-badge" style="background: linear-gradient(135deg, #CD7F32, #E6A85C);">🥉 3rd PLACE</div>
                </div>
                <div class="alternative-content">
                    <div class="alternative-header">
                        <div>
                            <h3 class="alternative-title">Palur Raya</h3>
                            <div class="alternative-code">Kode: A2</div>
                        </div>
                        <div class="alternative-rank">#3</div>
                    </div>
                    <p class="alternative-description">
                        Lokasi dengan potensi pengembangan masa depan yang baik, didukung rencana infrastruktur daerah yang progresif.
                    </p>
                    <div class="alternative-stats">
                        <div class="stat-item">
                            <div class="stat-label">BORDA Score</div>
                            <div class="stat-value">3.8</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">ANP Weight</div>
                            <div class="stat-value">0.18</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- A4 - Makamhaji -->
            <div class="alternative-card">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80" alt="Makamhaji" class="alternative-image">
                </div>
                <div class="alternative-content">
                    <div class="alternative-header">
                        <div>
                            <h3 class="alternative-title">Makamhaji</h3>
                            <div class="alternative-code">Kode: A4</div>
                        </div>
                        <div class="alternative-rank">#4</div>
                    </div>
                    <p class="alternative-description">
                        Memiliki keunggulan pada aspek legalitas lahan dan kesesuaian dengan peruntukan tata ruang wilayah.
                    </p>
                    <div class="alternative-stats">
                        <div class="stat-item">
                            <div class="stat-label">BORDA Score</div>
                            <div class="stat-value">3.2</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">ANP Weight</div>
                            <div class="stat-value">0.19</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- A5 - Baturetno -->
            <div class="alternative-card">
                <div style="position: relative;">
                    <img src="https://images.unsplash.com/photo-1605146769289-440113cc3d00?w=800&q=80" alt="Baturetno" class="alternative-image">
                </div>
                <div class="alternative-content">
                    <div class="alternative-header">
                        <div>
                            <h3 class="alternative-title">Baturetno</h3>
                            <div class="alternative-code">Kode: A5</div>
                        </div>
                        <div class="alternative-rank">#5</div>
                    </div>
                    <p class="alternative-description">
                        Lokasi dengan nilai estetika tinggi dan pemandangan menarik, cocok untuk perumahan dengan konsep premium view.
                    </p>
                    <div class="alternative-stats">
                        <div class="stat-item">
                            <div class="stat-label">BORDA Score</div>
                            <div class="stat-value">3.1</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">ANP Weight</div>
                            <div class="stat-value">0.16</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparison Table -->
        <div class="comparison-section">
            <h2 class="section-title">Tabel Perbandingan Alternatif</h2>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Kode</th>
                        <th>Nama Lokasi</th>
                        <th>BORDA Score</th>
                        <th>ANP Weight</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>1</strong></td>
                        <td>A3</td>
                        <td>Bekonang</td>
                        <td><strong>8.4</strong></td>
                        <td>0.25</td>
                        <td><span style="color: #DAA520;">⭐ Terbaik</span></td>
                    </tr>
                    <tr>
                        <td><strong>2</strong></td>
                        <td>A1</td>
                        <td>Gentan</td>
                        <td><strong>7.5</strong></td>
                        <td>0.20</td>
                        <td><span style="color: #C0C0C0;">⭐ Sangat Baik</span></td>
                    </tr>
                    <tr>
                        <td><strong>3</strong></td>
                        <td>A2</td>
                        <td>Palur Raya</td>
                        <td><strong>3.8</strong></td>
                        <td>0.18</td>
                        <td><span style="color: #CD7F32;">⭐ Baik</span></td>
                    </tr>
                    <tr>
                        <td><strong>4</strong></td>
                        <td>A4</td>
                        <td>Makamhaji</td>
                        <td><strong>3.2</strong></td>
                        <td>0.19</td>
                        <td><span style="color: #999;">⭐ Cukup</span></td>
                    </tr>
                    <tr>
                        <td><strong>5</strong></td>
                        <td>A5</td>
                        <td>Baturetno</td>
                        <td><strong>3.1</strong></td>
                        <td>0.16</td>
                        <td><span style="color: #999;">⭐ Cukup</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
