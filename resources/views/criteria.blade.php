@extends('layouts.dashboard')

@section('title', 'Kriteria - SILOKASI')

@push('additional-styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>
    /* Page Header */
    .page-header {
        margin-bottom: 3rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #fff 0%, #F9C349 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }

    .page-description {
        color: #888;
        font-size: 1.1rem;
    }

    /* Criteria Grid */
    .criteria-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .criteria-card {
        background: rgba(20, 20, 20, 0.8);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid rgba(249, 195, 73, 0.15);
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
        height: 3px;
        background: linear-gradient(90deg, #F9C349, #FFD700);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .criteria-card:hover {
        transform: translateY(-5px);
        border-color: rgba(249, 195, 73, 0.3);
        box-shadow: 0 15px 40px rgba(249, 195, 73, 0.15);
    }

    .criteria-card:hover::before {
        transform: scaleX(1);
    }

    .criteria-header {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        margin-bottom: 1.2rem;
    }

    .criteria-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        background: rgba(249, 195, 73, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .criteria-title-group h3 {
        font-size: 1.3rem;
        margin-bottom: 0.3rem;
        color: #fff;
        font-weight: 700;
    }

    .criteria-code {
        color: #F9C349;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .criteria-description {
        color: #ccc;
        line-height: 1.6;
        margin-bottom: 1.2rem;
        font-size: 0.95rem;
    }

    .criteria-weight {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background: rgba(249, 195, 73, 0.05);
        border-radius: 10px;
        border: 1px solid rgba(249, 195, 73, 0.1);
    }

    .weight-label {
        color: #888;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .weight-value {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #F9C349 0%, #FFD700 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Chart Container */
    .chart-container {
        background: rgba(20, 20, 20, 0.8);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 2.5rem;
        border: 1px solid rgba(249, 195, 73, 0.15);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .chart-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .criteria-grid {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
    <!-- Top Bar -->
    <div class="top-bar">
        <button class="menu-toggle" id="menuToggle">☰</button>
        <div class="greeting">
            <div class="greeting-text">
                <h1>Kriteria Evaluasi 📋</h1>
                <p>Kelola dan tinjau kriteria untuk evaluasi lokasi perumahan</p>
            </div>
        </div>
        <div class="user-profile">
            <div class="user-avatar" id="userAvatar">A</div>
            <div class="user-info">
                <h4 id="userFullName">Admin User</h4>
                <p>Administrator</p>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h2 class="page-title">Kriteria Evaluasi</h2>
        <p class="page-description">8 kriteria yang digunakan untuk mengevaluasi lokasi perumahan</p>
    </div>

    <!-- Criteria Grid -->
    <div class="criteria-grid">
        <!-- KT -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">🏗️</div>
                <div class="criteria-title-group">
                    <h3>Kondisi Tanah</h3>
                    <span class="criteria-code">KT</span>
                </div>
            </div>
            <p class="criteria-description">
                Kelayakan struktur tanah untuk konstruksi. Meliputi daya dukung tanah, kepadatan, dan kestabilan untuk pembangunan perumahan.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.25</span>
            </div>
        </div>

        <!-- BB -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">💧</div>
                <div class="criteria-title-group">
                    <h3>Bahaya Banjir</h3>
                    <span class="criteria-code">BB</span>
                </div>
            </div>
            <p class="criteria-description">
                Tingkat risiko banjir di lokasi. Evaluasi ketinggian, drainase, dan sejarah banjir untuk keamanan jangka panjang.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.20</span>
            </div>
        </div>

        <!-- LL -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">🌏</div>
                <div class="criteria-title-group">
                    <h3>Bahaya Longsor</h3>
                    <span class="criteria-code">LL</span>
                </div>
            </div>
            <p class="criteria-description">
                Risiko tanah longsor berdasarkan kemiringan dan stabilitas lereng. Penting untuk keselamatan konstruksi.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.15</span>
            </div>
        </div>

        <!-- LPD -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">📍</div>
                <div class="criteria-title-group">
                    <h3>Lokasi Pusat Desa</h3>
                    <span class="criteria-code">LPD</span>
                </div>
            </div>
            <p class="criteria-description">
                Kedekatan dengan pusat desa dan fasilitas umum. Mempengaruhi aksesibilitas dan kemudahan aktivitas sehari-hari.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.12</span>
            </div>
        </div>

        <!-- ST -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">🌊</div>
                <div class="criteria-title-group">
                    <h3>Sumber Tsunami</h3>
                    <span class="criteria-code">ST</span>
                </div>
            </div>
            <p class="criteria-description">
                Jarak dari pantai dan zona rawan tsunami. Kriteria keamanan untuk wilayah pesisir.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.10</span>
            </div>
        </div>

        <!-- BPT -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">🌾</div>
                <div class="criteria-title-group">
                    <h3>Bukan Pertanian</h3>
                    <span class="criteria-code">BPT</span>
                </div>
            </div>
            <p class="criteria-description">
                Memastikan lahan bukan area pertanian produktif. Menjaga ketahanan pangan dan keseimbangan ekosistem.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.08</span>
            </div>
        </div>

        <!-- SPL -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">🏞️</div>
                <div class="criteria-title-group">
                    <h3>Sempadan Pantai</h3>
                    <span class="criteria-code">SPL</span>
                </div>
            </div>
            <p class="criteria-description">
                Jarak minimal dari garis pantai sesuai regulasi. Melindungi dari abrasi dan pasang air laut.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.06</span>
            </div>
        </div>

        <!-- VM -->
        <div class="criteria-card">
            <div class="criteria-header">
                <div class="criteria-icon">🌋</div>
                <div class="criteria-title-group">
                    <h3>Vulkanologi & Mitigasi</h3>
                    <span class="criteria-code">VM</span>
                </div>
            </div>
            <p class="criteria-description">
                Jarak dari zona bahaya gunung berapi. Evaluasi risiko erupsi dan lahar untuk keamanan jangka panjang.
            </p>
            <div class="criteria-weight">
                <span class="weight-label">Bobot</span>
                <span class="weight-value">0.04</span>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="chart-container">
        <div class="chart-header">
            <h3 class="chart-title">Distribusi Bobot Kriteria</h3>
        </div>
        <canvas id="criteriaChart" style="max-height: 400px;"></canvas>
    </div>
@endsection

@push('additional-scripts')
<script>
    // Criteria Chart
    const ctx = document.getElementById('criteriaChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Kondisi Tanah', 'Bahaya Banjir', 'Bahaya Longsor', 'Lokasi Pusat Desa', 
                     'Sumber Tsunami', 'Bukan Pertanian', 'Sempadan Pantai', 'Vulkanologi & Mitigasi'],
            datasets: [{
                data: [0.25, 0.20, 0.15, 0.12, 0.10, 0.08, 0.06, 0.04],
                backgroundColor: [
                    'rgba(249, 195, 73, 0.8)',
                    'rgba(255, 215, 0, 0.8)',
                    'rgba(218, 165, 32, 0.8)',
                    'rgba(184, 134, 11, 0.8)',
                    'rgba(249, 195, 73, 0.6)',
                    'rgba(255, 215, 0, 0.6)',
                    'rgba(218, 165, 32, 0.6)',
                    'rgba(184, 134, 11, 0.6)'
                ],
                borderColor: 'rgba(249, 195, 73, 0.3)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#ccc',
                        padding: 15,
                        font: { size: 12 }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(20, 20, 20, 0.9)',
                    titleColor: '#F9C349',
                    bodyColor: '#fff',
                    borderColor: 'rgba(249, 195, 73, 0.3)',
                    borderWidth: 1
                }
            }
        }
    });
</script>
@endpush
