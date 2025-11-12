<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsensus Ranking - SILOKASI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #fff;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .bg-decoration::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(249, 195, 73, 0.08) 0%, transparent 70%);
            top: -200px;
            right: -100px;
            border-radius: 50%;
            animation: float 25s ease-in-out infinite;
        }

        .bg-decoration::after {
            content: '';
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(218, 165, 32, 0.05) 0%, transparent 70%);
            bottom: -300px;
            left: -200px;
            border-radius: 50%;
            animation: float 30s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }

        .dashboard-layout {
            display: flex;
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: rgba(15, 15, 15, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(249, 195, 73, 0.15);
            padding: 2rem 0;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-logo {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid rgba(249, 195, 73, 0.1);
            margin-bottom: 2rem;
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 900;
            letter-spacing: 2px;
            background: linear-gradient(135deg, #F9C349 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-subtitle {
            font-size: 0.75rem;
            color: #888;
            letter-spacing: 1px;
            margin-top: 0.3rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0 1rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: #ccc;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #F9C349, #FFD700);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(249, 195, 73, 0.1);
            color: #F9C349;
            transform: translateX(5px);
        }

        .nav-link:hover::before {
            transform: scaleY(1);
        }

        .nav-link.active {
            background: rgba(249, 195, 73, 0.15);
            color: #F9C349;
            font-weight: 600;
        }

        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-icon {
            font-size: 1.3rem;
            width: 24px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding: 1.5rem 2rem;
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            border: 1px solid rgba(249, 195, 73, 0.15);
        }

        .menu-toggle {
            display: none;
            background: rgba(249, 195, 73, 0.1);
            border: 1px solid rgba(249, 195, 73, 0.3);
            color: #F9C349;
            padding: 0.7rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: rgba(249, 195, 73, 0.2);
            transform: scale(1.05);
        }

        .page-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .page-title p {
            color: #888;
            font-size: 0.95rem;
        }

        .card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            border: 1px solid rgba(249, 195, 73, 0.15);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(249, 195, 73, 0.1);
        }

        .card-header h2 {
            font-size: 1.5rem;
            color: #F9C349;
        }

        .info-box {
            background: rgba(249, 195, 73, 0.1);
            border: 1px solid rgba(249, 195, 73, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-box h3 {
            color: #F9C349;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .info-box p {
            color: #ccc;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .dm-section {
            background: rgba(30, 30, 30, 0.6);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(249, 195, 73, 0.2);
        }

        .dm-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .dm-header h3 {
            color: #F9C349;
            font-size: 1.2rem;
        }

        .dm-badge {
            background: linear-gradient(135deg, #F9C349, #FFD700);
            color: #000;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .ranking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .ranking-item {
            background: rgba(40, 40, 40, 0.6);
            border: 1px solid rgba(249, 195, 73, 0.2);
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .ranking-item:hover {
            background: rgba(249, 195, 73, 0.1);
            border-color: #F9C349;
            transform: scale(1.05);
        }

        .ranking-item .rank {
            font-size: 1.5rem;
            font-weight: 800;
            color: #F9C349;
            margin-bottom: 0.3rem;
        }

        .ranking-item .alt-name {
            font-size: 0.85rem;
            color: #ccc;
        }

        .ranking-input-container {
            margin-top: 1rem;
        }

        .ranking-inputs {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .rank-input-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(40, 40, 40, 0.6);
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: 1px solid rgba(249, 195, 73, 0.2);
        }

        .rank-input-group label {
            color: #ccc;
            font-size: 0.9rem;
            min-width: 80px;
        }

        .rank-input-group select {
            flex: 1;
            padding: 0.5rem;
            background: rgba(50, 50, 50, 0.8);
            border: 1px solid rgba(249, 195, 73, 0.3);
            border-radius: 6px;
            color: #fff;
            font-size: 0.95rem;
        }

        .rank-input-group select:focus {
            outline: none;
            border-color: #F9C349;
        }

        .btn {
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #F9C349, #FFD700);
            color: #000;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(249, 195, 73, 0.4);
        }

        .btn-secondary {
            background: rgba(100, 100, 100, 0.3);
            color: #fff;
            border: 1px solid rgba(249, 195, 73, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(249, 195, 73, 0.1);
            border-color: #F9C349;
        }

        .btn-success {
            background: rgba(0, 200, 0, 0.3);
            color: #0f0;
            border: 1px solid rgba(0, 200, 0, 0.5);
        }

        .btn-success:hover {
            background: rgba(0, 200, 0, 0.4);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .results-section {
            margin-top: 3rem;
            padding: 2rem;
            background: rgba(30, 30, 30, 0.6);
            border-radius: 12px;
            border: 1px solid rgba(249, 195, 73, 0.2);
        }

        .results-section h3 {
            color: #F9C349;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-table th,
        .results-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(249, 195, 73, 0.1);
        }

        .results-table th {
            color: #F9C349;
            font-weight: 600;
        }

        .results-table td {
            color: #ccc;
        }

        .score-value {
            font-weight: 600;
            color: #F9C349;
            font-size: 1.1rem;
        }

        .rank-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
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

        .loading-spinner {
            border: 3px solid rgba(249, 195, 73, 0.1);
            border-top: 3px solid #F9C349;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(20, 20, 20, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(249, 195, 73, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(249, 195, 73, 0.5);
        }
    </style>
</head>

<body>
    <div class="bg-decoration"></div>

    <div class="dashboard-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-text">SILOKASI</div>
                <div class="logo-subtitle">DASHBOARD</div>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="/dashboard" class="nav-link"><span
                            class="nav-icon">📊</span><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="/criteria" class="nav-link"><span
                            class="nav-icon">📋</span><span>Kriteria</span></a></li>
                <li class="nav-item"><a href="/criteria-comparison" class="nav-link"><span
                            class="nav-icon">⚖️</span><span>Perbandingan Kriteria</span></a></li>
                <li class="nav-item"><a href="/alternatives" class="nav-link"><span
                            class="nav-icon">📍</span><span>Alternatif</span></a></li>
                <li class="nav-item"><a href="/alternative-comparison" class="nav-link"><span
                            class="nav-icon">🔀</span><span>Perbandingan Alternatif</span></a></li>
                <li class="nav-item"><a href="/consensus-ranking" class="nav-link active"><span
                            class="nav-icon">👥</span><span>Konsensus Ranking</span></a></li>
                <li class="nav-item"><a href="/results" class="nav-link"><span class="nav-icon">🏆</span><span>Hasil
                            Ranking</span></a></li>
                <li class="nav-item"><a href="/about" class="nav-link"><span
                            class="nav-icon">ℹ️</span><span>About</span></a></li>
            </ul>
        </aside>

        <main class="main-content" id="mainContent">
            <div class="top-bar">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <div class="page-title">
                    <h1>Konsensus Ranking (BORDA) 👥</h1>
                    <p>Input ranking dari multiple Decision Makers</p>
                </div>
            </div>

            <div class="info-box">
                <h3>📋 Tentang Metode BORDA</h3>
                <p>Metode BORDA digunakan untuk mencapai konsensus dari ranking yang diberikan oleh beberapa Decision
                    Makers (DM).
                    Setiap DM memberikan ranking preferensi mereka, kemudian sistem menghitung skor BORDA dengan
                    formula:
                    <strong>Skor = N - Rank + 1</strong>, di mana N adalah jumlah alternatif.
                    Skor dari semua DM dijumlahkan untuk mendapatkan konsensus final.
                </p>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>👥 Input Ranking Decision Makers</h2>
                    <button class="btn btn-secondary" id="btnAddDM">➕ Tambah Decision Maker</button>
                </div>

                <div id="dmContainer">
                    <div class="loading-spinner"></div>
                    <p style="text-align: center; color: #888; margin-top: 1rem;">Memuat data...</p>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-success" id="btnGenerateRankings">📊 Generate Rankings</button>
                    <button class="btn btn-primary" id="btnCalculateBorda">🎯 Hitung Konsensus BORDA</button>
                </div>
            </div>

            <div id="resultsContainer" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <h2>🏆 Hasil Konsensus BORDA</h2>
                    </div>

                    <div class="results-section">
                        <h3>📊 Ranking Konsensus Final</h3>
                        <table class="results-table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Kode</th>
                                    <th>Nama Alternatif</th>
                                    <th>Skor BORDA</th>
                                    <th>Rata-rata Rank</th>
                                </tr>
                            </thead>
                            <tbody id="bordaResultsTableBody">
                                <!-- Populated by JavaScript -->
                            </tbody>
                        </table>

                        <div class="action-buttons" style="margin-top: 2rem;">
                            <a href="/results" class="btn btn-primary">🏆 Lihat Hasil Akhir</a>
                            <a href="/alternative-comparison" class="btn btn-secondary">◀️ Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const API_URL = 'http://localhost:8000/api';
        let alternativesData = [];
        let decisionMakers = [];
        let dmCounter = 1;

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const dmContainer = document.getElementById('dmContainer');
        const btnAddDM = document.getElementById('btnAddDM');
        const btnGenerateRankings = document.getElementById('btnGenerateRankings');
        const btnCalculateBorda = document.getElementById('btnCalculateBorda');
        const resultsContainer = document.getElementById('resultsContainer');
        const bordaResultsTableBody = document.getElementById('bordaResultsTableBody');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('expanded');
        });

        async function loadAlternatives() {
            try {
                const response = await fetch(`${API_URL}/alternatives`);
                const result = await response.json();

                if (result.success && result.data) {
                    alternativesData = result.data;

                    if (alternativesData.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Kosong',
                            text: 'Tidak ada alternatif. Silakan tambahkan alternatif terlebih dahulu.',
                            background: 'rgba(20, 20, 20, 0.95)',
                            color: '#fff'
                        });
                        return;
                    }

                    addDecisionMaker(); // Add first DM by default
                } else {
                    throw new Error('Gagal memuat alternatif');
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data. Silakan refresh halaman.',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        }

        function addDecisionMaker() {
            const dmId = dmCounter++;
            const dm = {
                id: dmId,
                name: `Decision Maker ${dmId}`,
                rankings: {}
            };
            decisionMakers.push(dm);
            renderDecisionMakers();
        }

        function removeDecisionMaker(dmId) {
            decisionMakers = decisionMakers.filter(dm => dm.id !== dmId);
            renderDecisionMakers();
        }

        function renderDecisionMakers() {
            if (alternativesData.length === 0) return;

            let html = '';

            decisionMakers.forEach(dm => {
                html += `
                    <div class="dm-section">
                        <div class="dm-header">
                            <h3>👤 ${dm.name}</h3>
                            <div style="display: flex; gap: 0.5rem;">
                                <span class="dm-badge">DM #${dm.id}</span>
                                ${decisionMakers.length > 1 ? `<button class="btn btn-secondary" style="padding: 0.4rem 1rem; font-size: 0.9rem;" onclick="removeDM(${dm.id})">🗑️</button>` : ''}
                            </div>
                        </div>
                        
                        <div class="ranking-input-container">
                            <p style="color: #ccc; margin-bottom: 1rem; font-size: 0.95rem;">
                                Urutkan alternatif dari yang terbaik (rank 1) hingga terburuk (rank ${alternativesData.length})
                            </p>
                            <div class="ranking-inputs">
                `;

                alternativesData.forEach(alt => {
                    html += `
                        <div class="rank-input-group">
                            <label>${alt.code}</label>
                            <select onchange="updateRanking(${dm.id}, ${alt.id}, this.value)">
                                <option value="">-</option>
                    `;

                    for (let rank = 1; rank <= alternativesData.length; rank++) {
                        const selected = dm.rankings[alt.id] == rank ? 'selected' : '';
                        html += `<option value="${rank}" ${selected}>${rank}</option>`;
                    }

                    html += `
                            </select>
                        </div>
                    `;
                });

                html += `
                            </div>
                        </div>
                    </div>
                `;
            });

            dmContainer.innerHTML = html;
        }

        window.updateRanking = function(dmId, altId, rank) {
            const dm = decisionMakers.find(d => d.id === dmId);
            if (dm) {
                dm.rankings[altId] = parseInt(rank);
            }
        };

        window.removeDM = function(dmId) {
            Swal.fire({
                title: 'Hapus Decision Maker?',
                text: 'Data ranking akan hilang',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: 'rgba(20, 20, 20, 0.95)',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeDecisionMaker(dmId);
                }
            });
        };

        btnAddDM.addEventListener('click', () => {
            addDecisionMaker();
        });

        btnGenerateRankings.addEventListener('click', async () => {
            // Validate rankings
            for (const dm of decisionMakers) {
                const ranks = Object.values(dm.rankings);
                if (ranks.length !== alternativesData.length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ranking Tidak Lengkap',
                        text: `${dm.name} belum melengkapi semua ranking`,
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                    return;
                }

                // Check for duplicates
                const uniqueRanks = new Set(ranks);
                if (uniqueRanks.size !== ranks.length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ranking Duplikat',
                        text: `${dm.name} memiliki ranking yang sama untuk beberapa alternatif`,
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                    return;
                }
            }

            try {
                Swal.fire({
                    title: 'Menyimpan Rankings...',
                    allowOutsideClick: false,
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const rankings = [];
                decisionMakers.forEach((dm, index) => {
                    Object.entries(dm.rankings).forEach(([altId, rank]) => {
                        rankings.push({
                            dm_id: index + 1, // Can be user ID in production
                            alternative_id: parseInt(altId),
                            rank: rank
                        });
                    });
                });

                const response = await fetch(`${API_URL}/consensus/generate-rankings`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        rankings
                    })
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Rankings berhasil disimpan',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff',
                        timer: 1500
                    });
                } else {
                    throw new Error(result.message || 'Gagal menyimpan rankings');
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message,
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        });

        btnCalculateBorda.addEventListener('click', async () => {
            try {
                Swal.fire({
                    title: 'Menghitung BORDA...',
                    text: 'Memproses konsensus dari semua DM',
                    allowOutsideClick: false,
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch(`${API_URL}/consensus/calculate-borda`, {
                    method: 'POST'
                });

                const result = await response.json();

                if (result.success) {
                    displayBordaResults(result.data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Konsensus BORDA berhasil dihitung',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                } else {
                    throw new Error(result.message || 'Gagal menghitung konsensus');
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message,
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        });

        function displayBordaResults(data) {
            const results = data.results || [];
            const sorted = [...results].sort((a, b) => b.borda_score - a.borda_score);

            let html = '';
            sorted.forEach((item, index) => {
                const rank = index + 1;
                let rankBadgeClass = '';
                if (rank === 1) rankBadgeClass = 'rank-1';
                else if (rank === 2) rankBadgeClass = 'rank-2';
                else if (rank === 3) rankBadgeClass = 'rank-3';

                const alt = alternativesData.find(a => a.id === item.alternative_id);
                const avgRank = item.average_rank ? item.average_rank.toFixed(2) : '-';

                html += `
                    <tr>
                        <td><span class="rank-badge ${rankBadgeClass}">#${rank}</span></td>
                        <td><strong>${alt ? alt.code : item.alternative_id}</strong></td>
                        <td>${alt ? alt.name : 'Unknown'}</td>
                        <td><span class="score-value">${item.borda_score}</span></td>
                        <td>${avgRank}</td>
                    </tr>
                `;
            });

            bordaResultsTableBody.innerHTML = html;
            resultsContainer.style.display = 'block';
            resultsContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }

        loadAlternatives();
    </script>
</body>

</html>
