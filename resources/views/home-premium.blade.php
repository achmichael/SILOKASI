<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILOKASI - Smart Location Decision System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gold: #D4AF37;
            --primary-dark: #0A0E27;
            --secondary-dark: #1A1F3A;
            --accent-gold: #F4D03F;
            --text-light: #E8E8E8;
            --text-muted: #A0A0A0;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            color: var(--text-light);
            background: var(--primary-dark);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #0A0E27 0%, #1A1F3A 100%);
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070') center/cover no-repeat;
            opacity: 0.15;
            z-index: 0;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(10, 14, 39, 0.95) 0%, rgba(26, 31, 58, 0.85) 100%);
            z-index: 1;
        }

        /* Animated Background Pattern */
        .pattern-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(244, 208, 63, 0.05) 0%, transparent 50%);
            z-index: 2;
            animation: patternMove 20s ease-in-out infinite;
        }

        @keyframes patternMove {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(50px, 50px); }
        }

        /* Navigation */
        .navbar {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 5%;
            animation: fadeInDown 1s ease-out;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-gold);
            text-decoration: none;
            letter-spacing: 2px;
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
        }

        .logo:hover {
            text-shadow: 0 0 30px rgba(212, 175, 55, 0.6);
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-gold);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Content */
        .hero-content {
            position: relative;
            z-index: 10;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem 5%;
            animation: fadeInUp 1.2s ease-out;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #FFFFFF 0%, var(--primary-gold) 50%, var(--accent-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textGlow 3s ease-in-out infinite;
        }

        @keyframes textGlow {
            0%, 100% { filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.3)); }
            50% { filter: drop-shadow(0 0 40px rgba(212, 175, 55, 0.6)); }
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 2vw, 1.4rem);
            color: var(--text-muted);
            max-width: 700px;
            margin-bottom: 3rem;
            line-height: 1.6;
            font-weight: 300;
            letter-spacing: 0.5px;
            animation: fadeIn 1.5s ease-out;
        }

        /* Search Bar Section */
        .search-section {
            position: relative;
            z-index: 10;
            padding: 2rem 5% 4rem;
            display: flex;
            justify-content: center;
            animation: fadeInUp 1.5s ease-out;
        }

        .search-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 900px;
            width: 100%;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 0 30px rgba(212, 175, 55, 0.1),
                0 0 40px rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .search-container:hover {
            border-color: rgba(212, 175, 55, 0.6);
            box-shadow: 
                0 12px 48px rgba(0, 0, 0, 0.4),
                inset 0 0 40px rgba(212, 175, 55, 0.15),
                0 0 60px rgba(212, 175, 55, 0.4);
            transform: translateY(-2px);
        }

        .search-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            color: var(--text-light);
            font-size: 1.1rem;
            padding: 1rem;
            font-weight: 400;
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-divider {
            width: 1px;
            height: 40px;
            background: rgba(212, 175, 55, 0.3);
        }

        .search-btn {
            background: linear-gradient(135deg, var(--primary-gold) 0%, var(--accent-gold) 100%);
            color: var(--primary-dark);
            border: none;
            padding: 1rem 3rem;
            border-radius: 40px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
        }

        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 30px rgba(212, 175, 55, 0.5);
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--primary-gold) 100%);
        }

        .search-btn:active {
            transform: scale(0.98);
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Floating Particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.2);
            pointer-events: none;
            z-index: 3;
        }

        .particle-1 {
            width: 8px;
            height: 8px;
            top: 20%;
            left: 10%;
            animation: float 6s ease-in-out infinite;
        }

        .particle-2 {
            width: 12px;
            height: 12px;
            top: 60%;
            right: 15%;
            animation: float 8s ease-in-out infinite;
            animation-delay: 2s;
        }

        .particle-3 {
            width: 6px;
            height: 6px;
            bottom: 30%;
            left: 20%;
            animation: float 7s ease-in-out infinite;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-30px) translateX(30px); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1.5rem;
                padding: 1.5rem 5%;
            }

            .nav-links {
                gap: 1.5rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .search-container {
                flex-direction: column;
                padding: 1.5rem;
                border-radius: 30px;
                gap: 1.5rem;
            }

            .search-divider {
                width: 100%;
                height: 1px;
            }

            .search-btn {
                width: 100%;
                padding: 1.2rem;
            }

            .hero-content {
                padding: 1rem 5%;
            }
        }

        /* Additional Premium Effects */
        .glow-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
            z-index: 1;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.8; transform: translate(-50%, -50%) scale(1.1); }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <!-- Background Elements -->
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="pattern-overlay"></div>
        <div class="glow-effect"></div>
        
        <!-- Floating Particles -->
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>

        <!-- Navigation -->
        <nav class="navbar">
            <a href="/" class="logo">SILOKASI</a>
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/results">Results</a></li>
                <li><a href="/criteria">Criteria</a></li>
                <li><a href="/alternatives">Locations</a></li>
                <li><a href="/about">About</a></li>
                @auth
                    <li><a href="/dashboard" style="color: var(--primary-gold);">Dashboard</a></li>
                @else
                    <li><a href="/login">Login</a></li>
                @endauth
            </ul>
        </nav>

        <!-- Hero Content -->
        <div class="hero-content">
            <h1 class="hero-title">Find Your Perfect Location</h1>
            <p class="hero-subtitle">
                Advanced Decision Support System using ANP & BORDA methods 
                for intelligent housing site selection. Make data-driven decisions with confidence.
            </p>
        </div>

        <!-- Search/Action Bar -->
        <div class="search-section">
            <div class="search-container">
                <input 
                    type="text" 
                    class="search-input" 
                    placeholder="Enter location preferences or criteria..."
                >
                <div class="search-divider"></div>
                <button class="search-btn" onclick="window.location.href='/results'">
                    Explore Results
                </button>
            </div>
        </div>
    </div>

    <script>
        // Smooth scroll for navigation
        document.querySelectorAll('.nav-links a').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });

        // Add parallax effect to hero background
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroBg = document.querySelector('.hero-bg');
            if (heroBg) {
                heroBg.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add dynamic particles
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.width = Math.random() * 10 + 4 + 'px';
            particle.style.height = particle.style.width;
            particle.style.top = Math.random() * 100 + '%';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animation = `float ${Math.random() * 5 + 5}s ease-in-out infinite`;
            particle.style.animationDelay = Math.random() * 5 + 's';
            document.querySelector('.hero-section').appendChild(particle);
        }

        // Create additional particles
        for (let i = 0; i < 5; i++) {
            setTimeout(createParticle, i * 1000);
        }
    </script>
</body>
</html>
