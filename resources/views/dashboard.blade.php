<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SILOKASI</title>
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

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(249, 195, 73, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
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

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(249, 195, 73, 0.3);
            box-shadow: 0 15px 40px rgba(249, 195, 73, 0.15);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1.5rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            background: rgba(249, 195, 73, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .stat-trend {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .stat-trend.up {
            background: rgba(40, 167, 69, 0.2);
            color: #51cf66;
        }

        .stat-trend.down {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, #F9C349);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #888;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Chart Section */
        .chart-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .chart-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(249, 195, 73, 0.15);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .chart-filter {
            display: flex;
            gap: 0.5rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            background: rgba(249, 195, 73, 0.05);
            border: 1px solid rgba(249, 195, 73, 0.2);
            color: #ccc;
            border-radius: 8px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: rgba(249, 195, 73, 0.15);
            border-color: #F9C349;
            color: #F9C349;
        }

        /* Activity Table */
        .activity-table {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(249, 195, 73, 0.15);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .table-title {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .view-all-btn {
            color: #F9C349;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            opacity: 0.8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1.2rem;
            text-align: left;
            border-bottom: 1px solid rgba(249, 195, 73, 0.1);
        }

        th {
            color: #888;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            color: #ccc;
            font-size: 0.95rem;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(249, 195, 73, 0.05);
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-approved {
            background: rgba(40, 167, 69, 0.2);
            color: #51cf66;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #ffd93d;
        }

        .status-rejected {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 1.5rem;
            background: rgba(249, 195, 73, 0.1);
            border: 1px solid rgba(249, 195, 73, 0.2);
            border-radius: 12px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: rgba(249, 195, 73, 0.15);
            border-color: #F9C349;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(249, 195, 73, 0.2);
        }

        .action-icon {
            font-size: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .chart-section {
                grid-template-columns: 1fr;
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

            .top-bar {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .user-info {
                display: none;
            }

            .chart-filter {
                flex-wrap: wrap;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 0.8rem;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .greeting-text h1 {
                font-size: 1.3rem;
            }

            .stat-value {
                font-size: 1.8rem;
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
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-text">SILOKASI</div>
                <div class="logo-subtitle">DASHBOARD</div>
            </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <span class="nav-icon">📊</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item has-children" data-menu="kriteria">
                    <button type="button" class="nav-link nav-parent" aria-haspopup="true" aria-expanded="false">
                        <span class="nav-icon">📋</span>
                        <span>Kriteria</span>
                        <span class="chevron">▾</span>
                    </button>
                    <ul class="submenu">
                        <li>
                            <a href="/criteria" class="nav-link" data-submenu="daftar-kriteria">Daftar Kriteria</a>
                        </li>
                        <li>
                            <a href="/criteria-comparison" class="nav-link" data-submenu="perbandingan-kriteria">Perbandingan Kriteria</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-children" data-menu="alternatif">
                    <button type="button" class="nav-link nav-parent" aria-haspopup="true" aria-expanded="false">
                        <span class="nav-icon">📍</span>
                        <span>Alternatif</span>
                        <span class="chevron">▾</span>
                    </button>
                    <ul class="submenu">
                        <li>
                            <a href="/alternatives" class="nav-link" data-submenu="daftar-alternatif">Daftar Alternatif</a>
                        </li>
                        <li>
                            <a href="/alternative-comparison" class="nav-link" data-submenu="perbandingan-alternatif">Perbandingan Alternatif</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/results" class="nav-link">
                        <span class="nav-icon">🏆</span>
                        <span>Hasil Ranking</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon">👥</span>
                        <span>Decision Makers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="nav-icon">⚙️</span>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Top Bar -->
            <div class="top-bar">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <div class="greeting">
                    <div class="greeting-text">
                        <h1>Welcome Back, <span id="userName">Admin</span>! 👋</h1>
                        <p>Here's what's happening with your projects today</p>
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

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">👥</div>
                        <span class="stat-trend up">↑ 12%</span>
                    </div>
                    <div class="stat-value" id="totalUsers">24</div>
                    <div class="stat-label">Total Users</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">📋</div>
                        <span class="stat-trend up">↑ 8%</span>
                    </div>
                    <div class="stat-value" id="totalRequests">152</div>
                    <div class="stat-label">Total Requests</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">✅</div>
                        <span class="stat-trend up">↑ 15%</span>
                    </div>
                    <div class="stat-value" id="approvedItems">89</div>
                    <div class="stat-label">Approved Items</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">⏳</div>
                        <span class="stat-trend down">↓ 5%</span>
                    </div>
                    <div class="stat-value" id="pendingItems">23</div>
                    <div class="stat-label">Pending Items</div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Activity Overview</h3>
                        <div class="chart-filter">
                            <button class="filter-btn active">7 Days</button>
                            <button class="filter-btn">30 Days</button>
                            <button class="filter-btn">90 Days</button>
                        </div>
                    </div>
                    <canvas id="activityChart" style="max-height: 300px;"></canvas>
                </div>

                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Status Distribution</h3>
                    </div>
                    <canvas id="statusChart" style="max-height: 300px;"></canvas>
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="margin-bottom: 3rem;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.3rem; font-weight: 700;">Quick Actions</h3>
                <div class="quick-actions">
                    <a href="javascript:void(0)" onclick="openModal('addCriteriaModal')" class="action-btn">
                        <span class="action-icon">➕</span>
                        <span>Add Criteria</span>
                    </a>
                    <a href="javascript:void(0)" onclick="openModal('addAlternativeModal')" class="action-btn">
                        <span class="action-icon">📍</span>
                        <span>Add Alternative</span>
                    </a>
                    <a href="/results" class="action-btn">
                        <span class="action-icon">📊</span>
                        <span>View Results</span>
                    </a>
                    <a href="#" class="action-btn">
                        <span class="action-icon">📤</span>
                        <span>Export Data</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="activity-table">
                <div class="table-header">
                    <h3 class="table-title">Recent Activity</h3>
                    <a href="#" class="view-all-btn">View All →</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Alternative</th>
                            <th>Decision Maker</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Bekonang (A3)</strong></td>
                            <td>DM 1</td>
                            <td>Pairwise Comparison</td>
                            <td><span class="status-badge status-approved">Approved</span></td>
                            <td>2 hours ago</td>
                        </tr>
                        <tr>
                            <td><strong>Gentan (A1)</strong></td>
                            <td>DM 2</td>
                            <td>Weight Calculation</td>
                            <td><span class="status-badge status-approved">Approved</span></td>
                            <td>5 hours ago</td>
                        </tr>
                        <tr>
                            <td><strong>Palur Raya (A2)</strong></td>
                            <td>DM 3</td>
                            <td>ANP Analysis</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>1 day ago</td>
                        </tr>
                        <tr>
                            <td><strong>Makamhaji (A4)</strong></td>
                            <td>DM 1</td>
                            <td>BORDA Consensus</td>
                            <td><span class="status-badge status-approved">Approved</span></td>
                            <td>2 days ago</td>
                        </tr>
                        <tr>
                            <td><strong>Baturetno (A5)</strong></td>
                            <td>DM 2</td>
                            <td>Final Ranking</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>3 days ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Include Add Item Modal Component -->
    @include('components.add-item-modal')

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
                document.getElementById('userName').textContent = userData.name.split(' ')[0];
                document.getElementById('userFullName').textContent = userData.name;
                document.getElementById('userAvatar').textContent = userData.name.charAt(0).toUpperCase();
            }
        });

        // Activity Chart
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Requests',
                    data: [12, 19, 15, 25, 22, 30, 28],
                    borderColor: '#F9C349',
                    backgroundColor: 'rgba(249, 195, 73, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#F9C349',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#888'
                        },
                        grid: {
                            color: 'rgba(249, 195, 73, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#888'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Approved', 'Pending', 'Rejected'],
                datasets: [{
                    data: [89, 23, 12],
                    backgroundColor: [
                        'rgba(81, 207, 102, 0.8)',
                        'rgba(255, 217, 61, 0.8)',
                        'rgba(255, 107, 107, 0.8)'
                    ],
                    borderColor: [
                        '#51cf66',
                        '#ffd93d',
                        '#ff6b6b'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ccc',
                            padding: 15,
                            font: {
                                size: 12,
                                family: 'Poppins'
                            }
                        }
                    }
                }
            }
        });

        // Filter Buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
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
                // Default active for /dashboard
                if (current === '' || current === '/dashboard') {
                    const dashboardLink = document.querySelector("a.nav-link[href='/dashboard']");
                    if (dashboardLink) dashboardLink.classList.add('active');
                }
            }
        })();
    </script>
</body>
</html>
