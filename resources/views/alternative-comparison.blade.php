<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbandingan Alternatif - SILOKASI</title>
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

        .criteria-tabs {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .tab-btn {
            padding: 0.8rem 1.5rem;
            background: rgba(30, 30, 30, 0.6);
            border: 1px solid rgba(249, 195, 73, 0.2);
            color: #ccc;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .tab-btn:hover {
            background: rgba(249, 195, 73, 0.1);
            border-color: #F9C349;
            color: #F9C349;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #F9C349, #FFD700);
            color: #000;
            border-color: #F9C349;
            font-weight: 600;
        }

        .comparison-matrix {
            overflow-x: auto;
            margin: 2rem 0;
        }

        .matrix-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .matrix-table th,
        .matrix-table td {
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(249, 195, 73, 0.2);
        }

        .matrix-table th {
            background: rgba(249, 195, 73, 0.15);
            color: #F9C349;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .matrix-table td {
            background: rgba(30, 30, 30, 0.6);
        }

        .matrix-table input {
            width: 80px;
            padding: 0.5rem;
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid rgba(249, 195, 73, 0.3);
            border-radius: 6px;
            color: #fff;
            text-align: center;
            font-size: 0.95rem;
        }

        .matrix-table input:focus {
            outline: none;
            border-color: #F9C349;
            background: rgba(50, 50, 50, 0.9);
        }

        .matrix-table .diagonal {
            background: rgba(249, 195, 73, 0.2);
            font-weight: 600;
            color: #F9C349;
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

        .weight-value {
            font-weight: 600;
            color: #F9C349;
            font-size: 1.1rem;
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

        .progress-info {
            background: rgba(0, 200, 0, 0.1);
            border: 1px solid rgba(0, 200, 0, 0.3);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            color: #0f0;
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
                <li class="nav-item"><a href="/alternative-comparison" class="nav-link active"><span
                            class="nav-icon">🔀</span><span>Perbandingan Alternatif</span></a></li>
                <li class="nav-item"><a href="/consensus-ranking" class="nav-link"><span
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
                    <h1>Perbandingan Alternatif 🔀</h1>
                    <p>Pairwise comparison alternatif untuk setiap kriteria</p>
                </div>
            </div>

            <div class="info-box">
                <h3>📋 Langkah Perbandingan Alternatif</h3>
                <p>Bandingkan setiap pasangan alternatif untuk <strong>setiap kriteria</strong> menggunakan skala Saaty
                    (1-9).
                    Sistem akan menghitung bobot lokal ANP per kriteria, kemudian menggabungkannya dengan bobot kriteria
                    menggunakan
                    <strong>Weighted Product</strong> untuk mendapatkan bobot final.
                </p>
            </div>

            <div id="progressContainer"></div>

            <div class="card">
                <div class="card-header">
                    <h2>🎯 Pilih Kriteria</h2>
                </div>

                <div id="criteriaTabsContainer">
                    <div class="loading-spinner"></div>
                    <p style="text-align: center; color: #888; margin-top: 1rem;">Memuat kriteria...</p>
                </div>
            </div>

            <div class="card" id="comparisonCard" style="display: none;">
                <div class="card-header">
                    <h2 id="currentCriteriaTitle">Matriks Perbandingan</h2>
                    <button class="btn btn-secondary" id="btnReset">🔄 Reset</button>
                </div>

                <div id="matrixContainer"></div>

                <div class="action-buttons">
                    <button class="btn btn-primary" id="btnCalculateLocal">🧮 Hitung Bobot Lokal</button>
                    <button class="btn btn-secondary" id="btnSaveComparison">💾 Simpan</button>
                </div>

                <div id="localResultsContainer" style="display: none;"></div>
            </div>

            <div class="card" id="finalResultsCard" style="display: none;">
                <div class="card-header">
                    <h2>🏆 Bobot Final (Weighted Product)</h2>
                </div>

                <button class="btn btn-primary" id="btnCalculateFinal" style="margin-bottom: 2rem;">
                    🎯 Hitung Bobot Final dengan Weighted Product
                </button>

                <div id="finalResultsContainer" style="display: none;">
                    <div class="results-section">
                        <h3>📊 Hasil Bobot Final Alternatif</h3>
                        <table class="results-table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Kode</th>
                                    <th>Nama Alternatif</th>
                                    <th>Bobot Final (WP)</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody id="finalWeightsTableBody">
                                <!-- Populated by JavaScript -->
                            </tbody>
                        </table>

                        <div class="action-buttons" style="margin-top: 2rem;">
                            <a href="/consensus-ranking" class="btn btn-primary">▶️ Lanjut ke Konsensus Ranking</a>
                            <a href="/criteria-comparison" class="btn btn-secondary">◀️ Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const API_URL = 'http://localhost:8000/api';
        let criteriaData = [];
        let alternativesData = [];
        let currentCriteriaIndex = 0;
        let comparisonMatrices = {}; // Store matrices for all criteria
        let completedCriteria = new Set();

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const criteriaTabsContainer = document.getElementById('criteriaTabsContainer');
        const comparisonCard = document.getElementById('comparisonCard');
        const matrixContainer = document.getElementById('matrixContainer');
        const currentCriteriaTitle = document.getElementById('currentCriteriaTitle');
        const btnCalculateLocal = document.getElementById('btnCalculateLocal');
        const btnSaveComparison = document.getElementById('btnSaveComparison');
        const btnReset = document.getElementById('btnReset');
        const localResultsContainer = document.getElementById('localResultsContainer');
        const progressContainer = document.getElementById('progressContainer');
        const finalResultsCard = document.getElementById('finalResultsCard');
        const btnCalculateFinal = document.getElementById('btnCalculateFinal');
        const finalResultsContainer = document.getElementById('finalResultsContainer');
        const finalWeightsTableBody = document.getElementById('finalWeightsTableBody');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('expanded');
        });

        // Load data
        async function loadData() {
            try {
                const [criteriaRes, alternativesRes] = await Promise.all([
                    fetch(`${API_URL}/criteria`),
                    fetch(`${API_URL}/alternatives`)
                ]);

                const criteriaResult = await criteriaRes.json();
                const alternativesResult = await alternativesRes.json();

                if (criteriaResult.success && alternativesResult.success) {
                    criteriaData = criteriaResult.data;
                    alternativesData = alternativesResult.data;

                    if (criteriaData.length === 0 || alternativesData.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Tidak Lengkap',
                            text: 'Pastikan sudah ada kriteria dan alternatif',
                            background: 'rgba(20, 20, 20, 0.95)',
                            color: '#fff'
                        });
                        return;
                    }

                    renderCriteriaTabs();
                    updateProgress();
                } else {
                    throw new Error('Gagal memuat data');
                }
            } catch (error) {
                console.error('Error loading data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data. Silakan refresh halaman.',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        }

        function updateProgress() {
            const total = criteriaData.length;
            const completed = completedCriteria.size;
            const percentage = total > 0 ? Math.round((completed / total) * 100) : 0;

            progressContainer.innerHTML = `
                <div class="progress-info">
                    ✅ Progress: ${completed}/${total} kriteria selesai (${percentage}%)
                </div>
            `;

            if (completed === total && total > 0) {
                finalResultsCard.style.display = 'block';
            }
        }

        function renderCriteriaTabs() {
            let html = '<div class="criteria-tabs">';
            criteriaData.forEach((criteria, index) => {
                const isCompleted = completedCriteria.has(criteria.id);
                const icon = isCompleted ? '✅' : '⏳';
                html += `<button class="tab-btn ${index === currentCriteriaIndex ? 'active' : ''}" 
                         onclick="selectCriteria(${index})">
                         ${icon} ${criteria.code} - ${criteria.name}
                         </button>`;
            });
            html += '</div>';
            criteriaTabsContainer.innerHTML = html;
        }

        window.selectCriteria = function(index) {
            currentCriteriaIndex = index;
            renderCriteriaTabs();
            initializeMatrix();
            comparisonCard.style.display = 'block';
        };

        function initializeMatrix() {
            const criteria = criteriaData[currentCriteriaIndex];
            const n = alternativesData.length;

            currentCriteriaTitle.textContent = `Matriks Perbandingan untuk: ${criteria.code} - ${criteria.name}`;

            // Initialize or load existing matrix
            if (!comparisonMatrices[criteria.id]) {
                comparisonMatrices[criteria.id] = Array(n).fill(null).map(() => Array(n).fill(1));
            }

            renderMatrix();
        }

        function renderMatrix() {
            const criteria = criteriaData[currentCriteriaIndex];
            const matrix = comparisonMatrices[criteria.id];
            const n = alternativesData.length;

            let html = '<div class="comparison-matrix"><table class="matrix-table"><thead><tr><th>Alternatif</th>';

            alternativesData.forEach(alt => {
                html += `<th>${alt.code}</th>`;
            });
            html += '</tr></thead><tbody>';

            for (let i = 0; i < n; i++) {
                html += `<tr><th>${alternativesData[i].code}</th>`;

                for (let j = 0; j < n; j++) {
                    if (i === j) {
                        html += `<td class="diagonal">1</td>`;
                    } else if (i < j) {
                        html += `<td><input type="number" step="0.1" min="0.1" max="9" 
                                 value="${matrix[i][j]}" data-row="${i}" data-col="${j}" 
                                 class="matrix-input" onchange="updateMatrix(${i}, ${j}, this.value)"></td>`;
                    } else {
                        html += `<td id="cell-${criteria.id}-${i}-${j}">${matrix[i][j].toFixed(3)}</td>`;
                    }
                }

                html += '</tr>';
            }

            html += '</tbody></table></div>';
            matrixContainer.innerHTML = html;
            localResultsContainer.style.display = 'none';
        }

        window.updateMatrix = function(row, col, value) {
            const criteria = criteriaData[currentCriteriaIndex];
            const val = parseFloat(value) || 1;

            if (val < 0.1 || val > 9) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Nilai Tidak Valid',
                    text: 'Gunakan nilai antara 0.1 sampai 9',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff',
                    timer: 2000
                });
                return;
            }

            comparisonMatrices[criteria.id][row][col] = val;
            comparisonMatrices[criteria.id][col][row] = 1 / val;

            const reciprocalCell = document.getElementById(`cell-${criteria.id}-${col}-${row}`);
            if (reciprocalCell) {
                reciprocalCell.textContent = (1 / val).toFixed(3);
            }
        };

        btnCalculateLocal.addEventListener('click', async () => {
            const criteria = criteriaData[currentCriteriaIndex];

            try {
                Swal.fire({
                    title: 'Menghitung...',
                    text: 'Memproses bobot lokal',
                    allowOutsideClick: false,
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch(`${API_URL}/alternative-comparison/local-weights`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        criteria_id: criteria.id,
                        matrix: comparisonMatrices[criteria.id]
                    })
                });

                const result = await response.json();

                if (result.success) {
                    displayLocalResults(result.data, criteria);
                    completedCriteria.add(criteria.id);
                    updateProgress();
                    renderCriteriaTabs();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Bobot lokal berhasil dihitung',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff',
                        timer: 1500
                    });
                } else {
                    throw new Error(result.message || 'Gagal menghitung');
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

        btnSaveComparison.addEventListener('click', async () => {
            const criteria = criteriaData[currentCriteriaIndex];
            const comparisons = [];
            const n = alternativesData.length;

            for (let i = 0; i < n; i++) {
                for (let j = i + 1; j < n; j++) {
                    comparisons.push({
                        criteria_id: criteria.id,
                        alternative_id_1: alternativesData[i].id,
                        alternative_id_2: alternativesData[j].id,
                        value: comparisonMatrices[criteria.id][i][j]
                    });
                }
            }

            try {
                const response = await fetch(`${API_URL}/alternative-comparison/comparisons`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        comparisons
                    })
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: 'Perbandingan berhasil disimpan',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff',
                        timer: 1500
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menyimpan data',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        });

        btnReset.addEventListener('click', () => {
            const criteria = criteriaData[currentCriteriaIndex];
            const n = alternativesData.length;
            comparisonMatrices[criteria.id] = Array(n).fill(null).map(() => Array(n).fill(1));
            renderMatrix();
        });

        function displayLocalResults(data, criteria) {
            const weights = data.weights || [];
            let html = `
                <div class="results-section" style="margin-top: 2rem;">
                    <h3>📊 Bobot Lokal untuk ${criteria.name}</h3>
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Alternatif</th>
                                <th>Bobot Lokal</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            weights.forEach((weight, index) => {
                const alt = alternativesData[index];
                html += `
                    <tr>
                        <td><strong>${alt.code}</strong></td>
                        <td>${alt.name}</td>
                        <td><span class="weight-value">${weight.toFixed(4)}</span></td>
                    </tr>
                `;
            });

            html += '</tbody></table></div>';
            localResultsContainer.innerHTML = html;
            localResultsContainer.style.display = 'block';
        }

        btnCalculateFinal.addEventListener('click', async () => {
            try {
                Swal.fire({
                    title: 'Menghitung Weighted Product...',
                    text: 'Menggabungkan semua bobot',
                    allowOutsideClick: false,
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch(`${API_URL}/alternative-comparison/final-weights`, {
                    method: 'POST'
                });

                const result = await response.json();

                if (result.success) {
                    displayFinalResults(result.data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Bobot final berhasil dihitung',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                } else {
                    throw new Error(result.message || 'Gagal menghitung bobot final');
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

        function displayFinalResults(data) {
            const results = data.final_weights || [];
            const sorted = [...results].sort((a, b) => b.final_weight - a.final_weight);

            let html = '';
            sorted.forEach((item, index) => {
                const rank = index + 1;
                const percentage = (item.final_weight * 100).toFixed(2);
                html += `
                    <tr>
                        <td><strong>#${rank}</strong></td>
                        <td><strong>${item.code}</strong></td>
                        <td>${item.name}</td>
                        <td><span class="weight-value">${item.final_weight.toFixed(6)}</span></td>
                        <td>${percentage}%</td>
                    </tr>
                `;
            });

            finalWeightsTableBody.innerHTML = html;
            finalResultsContainer.style.display = 'block';
        }

        loadData();
    </script>
</body>

</html>
