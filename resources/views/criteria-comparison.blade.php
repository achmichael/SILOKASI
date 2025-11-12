<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbandingan Kriteria - SILOKASI</title>
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

        .info-box ul {
            color: #ccc;
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }

        .info-box ul li {
            margin-bottom: 0.3rem;
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

        .cr-indicator {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .cr-valid {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
            border: 1px solid rgba(0, 255, 0, 0.5);
        }

        .cr-invalid {
            background: rgba(255, 0, 0, 0.2);
            color: #ff6b6b;
            border: 1px solid rgba(255, 0, 0, 0.5);
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
                <li class="nav-item"><a href="/criteria-comparison" class="nav-link active"><span
                            class="nav-icon">⚖️</span><span>Perbandingan Kriteria</span></a></li>
                <li class="nav-item"><a href="/alternatives" class="nav-link"><span
                            class="nav-icon">📍</span><span>Alternatif</span></a></li>
                <li class="nav-item"><a href="/alternative-comparison" class="nav-link"><span
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
                    <h1>Perbandingan Kriteria (ANP) ⚖️</h1>
                    <p>Pairwise comparison menggunakan skala Saaty 1-9</p>
                </div>
            </div>

            <div class="info-box">
                <h3>📚 Panduan Skala Saaty untuk Perbandingan Berpasangan</h3>
                <p>Bandingkan setiap pasangan kriteria dengan skala:</p>
                <ul>
                    <li><strong>1</strong> = Sama penting</li>
                    <li><strong>3</strong> = Sedikit lebih penting</li>
                    <li><strong>5</strong> = Lebih penting</li>
                    <li><strong>7</strong> = Sangat lebih penting</li>
                    <li><strong>9</strong> = Mutlak lebih penting</li>
                    <li><strong>2, 4, 6, 8</strong> = Nilai antara</li>
                </ul>
                <p style="margin-top: 1rem;"><em>Nilai reciprocal (1/x) akan otomatis terisi untuk pasangan
                        kebalikan.</em></p>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>🎯 Matriks Perbandingan Berpasangan</h2>
                    <button class="btn btn-secondary" id="btnReset">🔄 Reset Matriks</button>
                </div>

                <div id="matrixContainer">
                    <div class="loading-spinner"></div>
                    <p style="text-align: center; color: #888; margin-top: 1rem;">Memuat kriteria...</p>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-primary" id="btnCalculate" disabled>🧮 Hitung Bobot ANP</button>
                    <button class="btn btn-secondary" id="btnSave" disabled>💾 Simpan Perbandingan</button>
                </div>
            </div>

            <div id="resultsContainer" style="display: none;">
                <div class="results-section">
                    <h3>📊 Hasil Perhitungan Bobot ANP</h3>

                    <div style="margin-bottom: 2rem;">
                        <strong>Consistency Ratio (CR):</strong>
                        <span id="crValue" class="cr-indicator">-</span>
                        <p id="crMessage" style="margin-top: 0.5rem; color: #888;"></p>
                    </div>

                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot ANP</th>
                                <th>Persentase</th>
                            </tr>
                        </thead>
                        <tbody id="weightsTableBody">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>

                    <div class="action-buttons" style="margin-top: 2rem;">
                        <a href="/alternative-comparison" class="btn btn-primary">▶️ Lanjut ke Perbandingan
                            Alternatif</a>
                        <a href="/criteria" class="btn btn-secondary">◀️ Kembali ke Kriteria</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const API_URL = 'http://localhost:8000/api';
        let criteriaData = [];
        let comparisonMatrix = [];

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const matrixContainer = document.getElementById('matrixContainer');
        const btnCalculate = document.getElementById('btnCalculate');
        const btnSave = document.getElementById('btnSave');
        const btnReset = document.getElementById('btnReset');
        const resultsContainer = document.getElementById('resultsContainer');
        const crValue = document.getElementById('crValue');
        const crMessage = document.getElementById('crMessage');
        const weightsTableBody = document.getElementById('weightsTableBody');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('expanded');
        });

        // Load criteria from API
        async function loadCriteria() {
            try {
                const response = await fetch(`${API_URL}/criteria`);
                const result = await response.json();

                if (result.success && result.data) {
                    criteriaData = result.data;
                    initializeMatrix();
                } else {
                    throw new Error('Gagal memuat kriteria');
                }
            } catch (error) {
                console.error('Error loading criteria:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data kriteria. Silakan refresh halaman.',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        }

        // Initialize comparison matrix
        function initializeMatrix() {
            const n = criteriaData.length;
            comparisonMatrix = Array(n).fill(null).map(() => Array(n).fill(1));

            renderMatrix();
            btnCalculate.disabled = false;
            btnSave.disabled = false;
        }

        // Render matrix table
        function renderMatrix() {
            const n = criteriaData.length;

            let html = '<div class="comparison-matrix"><table class="matrix-table"><thead><tr><th>Kriteria</th>';

            // Header row
            criteriaData.forEach(c => {
                html += `<th>${c.code}</th>`;
            });
            html += '</tr></thead><tbody>';

            // Matrix rows
            for (let i = 0; i < n; i++) {
                html += `<tr><th>${criteriaData[i].code}</th>`;

                for (let j = 0; j < n; j++) {
                    if (i === j) {
                        html += `<td class="diagonal">1</td>`;
                    } else if (i < j) {
                        html += `<td><input type="number" step="0.1" min="0.1" max="9" value="1" 
                                 data-row="${i}" data-col="${j}" class="matrix-input" 
                                 onchange="updateMatrix(${i}, ${j}, this.value)"></td>`;
                    } else {
                        html += `<td id="cell-${i}-${j}">1.000</td>`;
                    }
                }

                html += '</tr>';
            }

            html += '</tbody></table></div>';
            matrixContainer.innerHTML = html;
        }

        // Update matrix when input changes
        window.updateMatrix = function(row, col, value) {
            const val = parseFloat(value) || 1;

            // Validate Saaty scale
            if (val < 0.1 || val > 9) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Nilai Tidak Valid',
                    text: 'Gunakan nilai antara 0.1 sampai 9 (skala Saaty)',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
                return;
            }

            comparisonMatrix[row][col] = val;
            comparisonMatrix[col][row] = 1 / val;

            // Update reciprocal cell
            const reciprocalCell = document.getElementById(`cell-${col}-${row}`);
            if (reciprocalCell) {
                reciprocalCell.textContent = (1 / val).toFixed(3);
            }
        };

        // Calculate weights using ANP
        btnCalculate.addEventListener('click', async () => {
            try {
                Swal.fire({
                    title: 'Menghitung...',
                    text: 'Memproses matriks perbandingan',
                    allowOutsideClick: false,
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch(`${API_URL}/criteria-comparison/calculate-weights`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        matrix: comparisonMatrix
                    })
                });

                const result = await response.json();

                if (result.success) {
                    displayResults(result.data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Bobot ANP berhasil dihitung',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                } else {
                    throw new Error(result.message || 'Gagal menghitung bobot');
                }
            } catch (error) {
                console.error('Error calculating weights:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Gagal menghitung bobot ANP',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        });

        // Save comparisons to database
        btnSave.addEventListener('click', async () => {
            try {
                const comparisons = [];
                const n = criteriaData.length;

                for (let i = 0; i < n; i++) {
                    for (let j = i + 1; j < n; j++) {
                        comparisons.push({
                            criteria_id_1: criteriaData[i].id,
                            criteria_id_2: criteriaData[j].id,
                            value: comparisonMatrix[i][j]
                        });
                    }
                }

                const response = await fetch(`${API_URL}/criteria-comparison/comparisons`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        comparisons: comparisons
                    })
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: 'Perbandingan kriteria berhasil disimpan',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff'
                    });
                } else {
                    throw new Error(result.message || 'Gagal menyimpan');
                }
            } catch (error) {
                console.error('Error saving comparisons:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Gagal menyimpan perbandingan',
                    background: 'rgba(20, 20, 20, 0.95)',
                    color: '#fff'
                });
            }
        });

        // Reset matrix
        btnReset.addEventListener('click', () => {
            Swal.fire({
                title: 'Reset Matriks?',
                text: 'Semua input akan dikembalikan ke nilai awal',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Reset',
                cancelButtonText: 'Batal',
                background: 'rgba(20, 20, 20, 0.95)',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    initializeMatrix();
                    resultsContainer.style.display = 'none';
                    Swal.fire({
                        icon: 'success',
                        title: 'Direset!',
                        text: 'Matriks berhasil direset',
                        background: 'rgba(20, 20, 20, 0.95)',
                        color: '#fff',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });

        // Display calculation results
        function displayResults(data) {
            // CR indicator
            const cr = data.consistency_ratio || 0;
            const isValid = cr <= 0.1;

            crValue.textContent = cr.toFixed(4);
            crValue.className = `cr-indicator ${isValid ? 'cr-valid' : 'cr-invalid'}`;

            if (isValid) {
                crMessage.textContent = '✅ Konsistensi BAIK (CR ≤ 0.1)';
                crMessage.style.color = '#00ff00';
            } else {
                crMessage.textContent = '⚠️ Konsistensi BURUK (CR > 0.1) - Harap revisi perbandingan!';
                crMessage.style.color = '#ff6b6b';
            }

            // Weights table
            let weightsHtml = '';
            const weights = data.weights || [];

            weights.forEach((weight, index) => {
                const criteria = criteriaData[index];
                const percentage = (weight * 100).toFixed(2);

                weightsHtml += `
                    <tr>
                        <td><strong>${criteria.code}</strong></td>
                        <td>${criteria.name}</td>
                        <td><span class="weight-value">${weight.toFixed(4)}</span></td>
                        <td>${percentage}%</td>
                    </tr>
                `;
            });

            weightsTableBody.innerHTML = weightsHtml;
            resultsContainer.style.display = 'block';

            // Scroll to results
            resultsContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }

        // Initialize on load
        loadCriteria();
    </script>
</body>

</html>
