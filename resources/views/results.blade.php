@extends('layouts.dashboard')

@section('title', 'Hasil Ranking - SILOKASI')

@push('additional-styles')
<style>
    .ranking-card {
        background: rgba(20, 20, 20, 0.8);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        border: 1px solid rgba(249, 195, 73, 0.15);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .ranking-item {
        display: flex;
        align-items: center;
        gap: 2rem;
        padding: 1.5rem;
        background: rgba(30, 30, 30, 0.6);
        border-radius: 12px;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .ranking-item:hover {
        background: rgba(249, 195, 73, 0.1);
        transform: translateX(10px);
    }

    .rank-badge {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .rank-1 {
        background: linear-gradient(135deg, #FFD700, #FFA500);
        color: #000;
    }

    .rank-2 {
        background: linear-gradient(135deg, #C0C0C0, #808080);
        color: #000;
    }

    .rank-3 {
        background: linear-gradient(135deg, #CD7F32, #8B4513);
        color: #fff;
    }

    .rank-other {
        background: rgba(100, 100, 100, 0.3);
        color: #F9C349;
    }

    .ranking-info {
        flex: 1;
    }

    .ranking-info h3 {
        font-size: 1.3rem;
        margin-bottom: 0.3rem;
    }

    .ranking-info p {
        color: #888;
        font-size: 0.9rem;
    }

    .ranking-score {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #F9C349, #FFD700);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .loading {
        text-align: center;
        padding: 3rem;
        color: #888;
    }

    .spinner {
        border: 3px solid rgba(249, 195, 73, 0.1);
        border-top: 3px solid #F9C349;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endpush

@section('content')
<div class="top-bar">
    <button class="menu-toggle" id="menuToggle">☰</button>
    <div class="page-title">
        <h1>Hasil Ranking Lokasi 🏆</h1>
        <p>Peringkat lokasi berdasarkan metode ANP-Borda</p>
    </div>
</div>
<div class="ranking-card">
    <h2 style="margin-bottom: 2rem; color: #F9C349;">📊 Peringkat Alternatif</h2>
    <div id="rankingContainer">
        <div class="loading">
            <div class="spinner"></div>
            <p>Memuat hasil ranking...</p>
        </div>
    </div>
</div>
@endsection

@push('additional-scripts')
<script>
    const API_URL = 'http://localhost:8000/api';
    const rankingContainer = document.getElementById('rankingContainer');

    async function fetchResults() {
        try {
            const response = await fetch(`${API_URL}/consensus/results`);
            const result = await response.json();

            if (result.success && result.data) {
                renderRanking(result.data);
            } else {
                showError('Belum ada hasil ranking. Silakan jalankan perhitungan terlebih dahulu.');
            }
        } catch (error) {
            console.error('Error fetching results:', error);
            showError('Terjadi kesalahan saat memuat data');
        }
    }

    function renderRanking(data) {
        if (!data || data.length === 0) {
            rankingContainer.innerHTML =
                '<p style="text-align: center; padding: 3rem; color: #888;">Belum ada hasil ranking</p>';
            return;
        }

        const sorted = [...data].sort((a, b) => (b.borda_score || 0) - (a.borda_score || 0));

        rankingContainer.innerHTML = sorted.map((item, index) => {
            const rank = index + 1;
            let rankClass = 'rank-other';
            let medal = '🎖️';

            if (rank === 1) {
                rankClass = 'rank-1';
                medal = '🥇';
            } else if (rank === 2) {
                rankClass = 'rank-2';
                medal = '🥈';
            } else if (rank === 3) {
                rankClass = 'rank-3';
                medal = '🥉';
            }

            return `
                <div class="ranking-item">
                    <div class="rank-badge ${rankClass}">${medal}</div>
                    <div class="ranking-info">
                        <h3>${item.alternative_name || 'Alternatif #' + (item.alternative_id || item.id)}</h3>
                        <p>Peringkat ${rank} • Skor Borda: ${(item.borda_score || 0).toFixed(2)}</p>
                    </div>
                    <div class="ranking-score">#${rank}</div>
                </div>
            `;
        }).join('');
    }

    function showError(message) {
        rankingContainer.innerHTML = `
            <p style="text-align: center; padding: 3rem; color: #ff6b6b;">⚠️ ${message}</p>
        `;
    }

    fetchResults();
</script>
@endpush
