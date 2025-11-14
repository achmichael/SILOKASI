@extends('layouts.dashboard')

@section('title', 'Perbandingan Alternatif - SILOKASI')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('additional-styles')
<style>
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
</style>
@endpush

@section('content')
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
@endsection

@push('additional-scripts')
<script>
        const API_URL = 'http://localhost:8000/api';
        let criteriaData = [];
        let alternativesData = [];
        let currentCriteriaIndex = 0;
        let comparisonMatrices = {}; // Store matrices for all criteria
        let completedCriteria = new Set();

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
