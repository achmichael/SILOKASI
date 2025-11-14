<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SILOKASI')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @stack('styles')
    
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
            background: transparent;
            border: none;
            color: inherit;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            text-align: left;
            font: inherit;
            border-radius: 12px;
        }

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
            padding: 0.75rem 1.5rem 0.75rem 2.6rem;
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
        }

        @media (max-width: 480px) {
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

    @stack('additional-styles')
</head>
<body>
    <!-- Background Decoration -->
    <div class="bg-decoration"></div>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    <script>
        // Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }

        // Load User Data
        window.addEventListener('load', () => {
            const user = localStorage.getItem('user');
            if (user) {
                const userData = JSON.parse(user);
                const userFullName = document.getElementById('userFullName');
                const userAvatar = document.getElementById('userAvatar');
                
                if (userFullName) {
                    userFullName.textContent = userData.name || 'Admin User';
                }
                if (userAvatar) {
                    userAvatar.textContent = (userData.name || 'A')[0].toUpperCase();
                }
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
            const current = window.location.pathname.replace(/\/$/, '');
            let activeLink = document.querySelector(`.submenu a.nav-link[href='${current}'], .submenu a.nav-link[href='${current}/']`);
            
            if (!activeLink) {
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
            }
        })();
    </script>

    @stack('additional-scripts')
</body>
</html>
