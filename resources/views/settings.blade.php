<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - SILOKASI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%); color: #fff; overflow-x: hidden; min-height: 100vh; }
        .bg-decoration { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none; overflow: hidden; }
        .bg-decoration::before { content: ''; position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(249, 195, 73, 0.08) 0%, transparent 70%); top: -200px; right: -100px; border-radius: 50%; animation: float 25s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translate(0, 0) rotate(0deg); } 33% { transform: translate(30px, -30px) rotate(120deg); } 66% { transform: translate(-20px, 20px) rotate(240deg); } }
        .dashboard-layout { display: flex; position: relative; z-index: 1; min-height: 100vh; }
        .sidebar { width: 280px; background: rgba(15, 15, 15, 0.95); backdrop-filter: blur(20px); border-right: 1px solid rgba(249, 195, 73, 0.15); padding: 2rem 0; position: fixed; left: 0; top: 0; height: 100vh; overflow-y: auto; transition: transform 0.3s; z-index: 1000; }
        .sidebar-logo { padding: 0 2rem 2rem; border-bottom: 1px solid rgba(249, 195, 73, 0.1); margin-bottom: 2rem; }
        .logo-text { font-size: 1.8rem; font-weight: 900; letter-spacing: 2px; background: linear-gradient(135deg, #F9C349 0%, #FFD700 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .logo-subtitle { font-size: 0.75rem; color: #888; letter-spacing: 1px; margin-top: 0.3rem; }
        .nav-menu { list-style: none; padding: 0 1rem; }
        .nav-item { margin-bottom: 0.5rem; }
        .nav-link { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.5rem; color: #ccc; text-decoration: none; border-radius: 12px; transition: all 0.3s ease; position: relative; }
        .nav-link::before { content: ''; position: absolute; left: 0; top: 0; width: 4px; height: 100%; background: linear-gradient(180deg, #F9C349, #FFD700); transform: scaleY(0); transition: transform 0.3s ease; }
        .nav-link:hover { background: rgba(249, 195, 73, 0.1); color: #F9C349; transform: translateX(5px); }
        .nav-link:hover::before { transform: scaleY(1); }
        .nav-link.active { background: rgba(249, 195, 73, 0.15); color: #F9C349; font-weight: 600; }
        .nav-link.active::before { transform: scaleY(1); }
        .nav-icon { font-size: 1.3rem; width: 24px; text-align: center; }
        .main-content { flex: 1; margin-left: 280px; padding: 2rem; transition: margin-left 0.3s; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; padding: 1.5rem 2rem; background: rgba(20, 20, 20, 0.8); backdrop-filter: blur(20px); border-radius: 16px; border: 1px solid rgba(249, 195, 73, 0.15); }
        .menu-toggle { display: none; background: rgba(249, 195, 73, 0.1); border: 1px solid rgba(249, 195, 73, 0.3); color: #F9C349; padding: 0.7rem 1rem; border-radius: 10px; cursor: pointer; font-size: 1.3rem; }
        .page-title h1 { font-size: 1.8rem; font-weight: 700; margin-bottom: 0.3rem; }
        .page-title p { color: #888; font-size: 0.95rem; }
        .settings-card { background: rgba(20, 20, 20, 0.8); backdrop-filter: blur(20px); border-radius: 16px; border: 1px solid rgba(249, 195, 73, 0.15); padding: 2rem; margin-bottom: 2rem; }
        .settings-card h2 { font-size: 1.5rem; margin-bottom: 1.5rem; color: #F9C349; }
        .setting-item { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; background: rgba(30, 30, 30, 0.6); border-radius: 12px; margin-bottom: 1rem; }
        .setting-info h3 { font-size: 1.1rem; margin-bottom: 0.3rem; }
        .setting-info p { color: #888; font-size: 0.9rem; }
        .toggle-switch { position: relative; width: 60px; height: 30px; background: rgba(100, 100, 100, 0.3); border-radius: 15px; cursor: pointer; transition: all 0.3s ease; }
        .toggle-switch.active { background: linear-gradient(135deg, #F9C349, #FFD700); }
        .toggle-slider { position: absolute; top: 3px; left: 3px; width: 24px; height: 24px; background: #fff; border-radius: 50%; transition: all 0.3s ease; }
        .toggle-switch.active .toggle-slider { transform: translateX(30px); }
        .btn-primary { padding: 0.8rem 1.5rem; background: linear-gradient(135deg, #F9C349, #FFD700); color: #000; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(249, 195, 73, 0.3); }
        @media (max-width: 768px) { .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); } .main-content { margin-left: 0; } .menu-toggle { display: block; } }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: rgba(249, 195, 73, 0.3); border-radius: 4px; }
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
                <li class="nav-item"><a href="/dashboard" class="nav-link"><span class="nav-icon">📊</span><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="/criteria" class="nav-link"><span class="nav-icon">📋</span><span>Kriteria</span></a></li>
                <li class="nav-item"><a href="/alternatives" class="nav-link"><span class="nav-icon">📍</span><span>Alternatif</span></a></li>
                <li class="nav-item"><a href="/results" class="nav-link"><span class="nav-icon">🏆</span><span>Hasil Ranking</span></a></li>
                <li class="nav-item"><a href="/decision-makers" class="nav-link"><span class="nav-icon">👥</span><span>Decision Makers</span></a></li>
                <li class="nav-item"><a href="/settings" class="nav-link active"><span class="nav-icon">⚙️</span><span>Settings</span></a></li>
                <li class="nav-item"><a href="/about" class="nav-link"><span class="nav-icon">ℹ️</span><span>About</span></a></li>
                <li class="nav-item"><a href="/" class="nav-link"><span class="nav-icon">🏠</span><span>Homepage</span></a></li>
            </ul>
        </aside>
        <main class="main-content" id="mainContent">
            <div class="top-bar">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <div class="page-title">
                    <h1>Pengaturan ⚙️</h1>
                    <p>Konfigurasi sistem SILOKASI</p>
                </div>
            </div>
            <div class="settings-card">
                <h2>🎨 Tampilan</h2>
                <div class="setting-item">
                    <div class="setting-info">
                        <h3>Mode Gelap</h3>
                        <p>Gunakan tema gelap untuk tampilan</p>
                    </div>
                    <div class="toggle-switch active" onclick="this.classList.toggle('active')">
                        <div class="toggle-slider"></div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h3>Animasi</h3>
                        <p>Aktifkan animasi transisi</p>
                    </div>
                    <div class="toggle-switch active" onclick="this.classList.toggle('active')">
                        <div class="toggle-slider"></div>
                    </div>
                </div>
            </div>
            <div class="settings-card">
                <h2>🔔 Notifikasi</h2>
                <div class="setting-item">
                    <div class="setting-info">
                        <h3>Notifikasi Email</h3>
                        <p>Terima pemberitahuan melalui email</p>
                    </div>
                    <div class="toggle-switch" onclick="this.classList.toggle('active')">
                        <div class="toggle-slider"></div>
                    </div>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h3>Notifikasi Push</h3>
                        <p>Terima notifikasi real-time</p>
                    </div>
                    <div class="toggle-switch active" onclick="this.classList.toggle('active')">
                        <div class="toggle-slider"></div>
                    </div>
                </div>
            </div>
            <div class="settings-card">
                <h2>🔧 Sistem</h2>
                <div class="setting-item">
                    <div class="setting-info">
                        <h3>API URL</h3>
                        <p>http://localhost:8000/api</p>
                    </div>
                    <button class="btn-primary">Edit</button>
                </div>
                <div class="setting-item">
                    <div class="setting-info">
                        <h3>Versi Sistem</h3>
                        <p>SILOKASI v1.0.0</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('expanded');
        });
    </script>
</body>
</html>
