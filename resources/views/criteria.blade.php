<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kriteria - SILOKASI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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

        /* Background Animation */
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
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        /* Layout Container */
        .dashboard-layout {
            display: flex;
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        /* Sidebar */
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

        .nav-item.has-children .nav-parent {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            justify-content: space-between;
            /* reset default button look so it matches regular nav links when not hovered */
            background: transparent;
            border: none;
            color: inherit;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            text-align: left;
            font: inherit;
            border-radius: 12px; /* keep same radius as .nav-link */
        }

        /* keep visible keyboard focus without changing idle background */
        .nav-item.has-children .nav-parent:focus-visible {
            outline: 2px solid rgba(249, 195, 73, 0.6);
            outline-offset: 2px;
        }

        .chevron {
            margin-left: auto;
            transition: transform 0.25s ease;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .nav-item.open .chevron {
            transform: rotate(180deg);
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

        /* Submenu */
        .submenu {
            list-style: none;
            padding: 0.3rem 0 0.4rem;
            margin: 0.2rem 0 0.4rem;
            display: none;
        }

        .nav-item.open > .submenu {
            display: block;
        }

        .submenu .nav-link {
            padding: 0.75rem 1.5rem 0.75rem 2.6rem; /* indent */
            background: transparent;
            color: #bbb;
        }

        .submenu .nav-link:hover {
            background: rgba(249, 195, 73, 0.08);
            color: #F9C349;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Top Bar */
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

        .greeting {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .greeting-text h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .greeting-text p {
            color: #888;
            font-size: 0.95rem;
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

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.7rem 1.2rem;
            background: rgba(249, 195, 73, 0.05);
            border-radius: 50px;
            border: 1px solid rgba(249, 195, 73, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: rgba(249, 195, 73, 0.1);
            border-color: rgba(249, 195, 73, 0.4);
            transform: translateY(-2px);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #F9C349, #FFD700);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: #000;
        }

        .user-info h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .user-info p {
            font-size: 0.8rem;
            color: #888;
        }

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

            .top-bar {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .user-info {
                display: none;
            }

            .criteria-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
            }

            .greeting-text h1 {
                font-size: 1.3rem;
            }
        }

        /* Scrollbar Styling */
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
    <!-- Background Decoration -->
    <div class="bg-decoration"></div>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
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
                <div class="chart-header">
                    <h3 class="chart-title">Distribusi Bobot Kriteria</h3>
                </div>
                <canvas id="criteriaChart" style="max-height: 400px;"></canvas>
            </div>
        </main>
    </div>

    <script>
        // Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Load User Data
        window.addEventListener('load', () => {
            const user = localStorage.getItem('user');
            if (user) {
                const userData = JSON.parse(user);
                document.getElementById('userFullName').textContent = userData.name || 'Admin User';
                document.getElementById('userAvatar').textContent = (userData.name || 'A')[0].toUpperCase();
            }
        });

        // Sidebar submenu toggle and active state
        (function initSidebar() {
            const parents = document.querySelectorAll('.nav-item.has-children .nav-parent');
            parents.forEach(btn => {
                btn.addEventListener('click', () => {
                    const item = btn.closest('.nav-item.has-children');
                    const isOpen = item.classList.toggle('open');
                    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            });

            // Active link highlight + auto-open parent
            const current = window.location.pathname.replace(/\/$/, ''); // trim trailing slash
            // mark exact match in submenu first
            let activeLink = document.querySelector(`.submenu a.nav-link[href='${current}'], .submenu a.nav-link[href='${current}/']`);
            if (!activeLink) {
                // try top-level
                activeLink = document.querySelector(`.nav-menu > .nav-item > a.nav-link[href='${current}'], .nav-menu > .nav-item > a.nav-link[href='${current}/']`);
            }

            if (activeLink) {
                activeLink.classList.add('active');
                const parentItem = activeLink.closest('.nav-item.has-children');
                if (parentItem) {
                    parentItem.classList.add('open');
                    const parentBtn = parentItem.querySelector('.nav-parent');
                    if (parentBtn) parentBtn.setAttribute('aria-expanded', 'true');
                }
            } else {
                // Default active for /criteria
                if (current === '' || current === '/criteria') {
                    const criteriaLink = document.querySelector("a.nav-link[href='/criteria']");
                    if (criteriaLink) criteriaLink.classList.add('active');
                }
            }
        })();

        // Criteria Chart
        const ctx = document.getElementById('criteriaChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['LPD (26%)', 'BPT (12%)', 'ST (9%)', 'KT (6%)', 'BB (5%)', 'SPL (5%)', 'LL (2%)', 'VM (1%)'],
                datasets: [{
                    data: [0.26, 0.12, 0.09, 0.06, 0.05, 0.05, 0.02, 0.01],
                    backgroundColor: [
                        'rgba(249, 195, 73, 0.9)',
                        'rgba(255, 215, 0, 0.8)',
                        'rgba(205, 127, 50, 0.8)',
                        'rgba(192, 192, 192, 0.7)',
                        'rgba(169, 169, 169, 0.7)',
                        'rgba(128, 128, 128, 0.7)',
                        'rgba(100, 100, 100, 0.7)',
                        'rgba(80, 80, 80, 0.7)'
                    ],
                    borderColor: 'rgba(20, 20, 20, 0.8)',
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
                            font: { 
                                size: 13,
                                family: 'Poppins'
                            },
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