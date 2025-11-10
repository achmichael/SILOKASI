<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SILOKASI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(218, 165, 32, 0.1) 0%, transparent 70%);
            top: -250px;
            right: -250px;
            border-radius: 50%;
        }

        body::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
            bottom: -300px;
            left: -300px;
            border-radius: 50%;
        }

        .login-container {
            background: rgba(20, 20, 20, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 3rem;
            max-width: 450px;
            width: 100%;
            border: 1px solid rgba(218, 165, 32, 0.3);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: 3px;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .logo-subtitle {
            color: #999;
            font-size: 0.9rem;
            letter-spacing: 2px;
        }

        h2 {
            color: #fff;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .subtitle {
            color: #999;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            color: #DAA520;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input {
            width: 100%;
            padding: 1rem 1.2rem;
            background: rgba(30, 30, 30, 0.6);
            border: 1px solid rgba(218, 165, 32, 0.2);
            border-radius: 12px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #DAA520;
            background: rgba(30, 30, 30, 0.8);
            box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.1);
        }

        input::placeholder {
            color: #666;
        }

        .password-toggle {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #DAA520;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: #FFD700;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #ccc;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .forgot-password {
            color: #DAA520;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #FFD700;
        }

        .btn-login {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%);
            border: none;
            border-radius: 12px;
            color: #000;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(218, 165, 32, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(218, 165, 32, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
            color: #666;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(218, 165, 32, 0.2);
        }

        .register-link {
            text-align: center;
            color: #999;
            font-size: 0.95rem;
        }

        .register-link a {
            color: #DAA520;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: #FFD700;
        }

        .back-home {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-home a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            color: #DAA520;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: none;
        }

        .alert.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.4);
            color: #ff6b6b;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid rgba(40, 167, 69, 0.4);
            color: #51cf66;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #000;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .logo {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">SILOKASI</div>
            <div class="logo-subtitle">DECISION SUPPORT SYSTEM</div>
        </div>

        <h2>Selamat Datang</h2>
        <p class="subtitle">Login untuk mengakses sistem</p>

        <!-- Alert Messages -->
        <div id="alertBox" class="alert"></div>

        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Masukkan email Anda"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-toggle">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan password Anda"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        👁️
                    </button>
                </div>
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <span>Ingat Saya</span>
                </label>
                <a href="#" class="forgot-password">Lupa Password?</a>
            </div>

            <button type="submit" class="btn-login" id="loginBtn">
                Masuk
            </button>
        </form>

        <div class="divider">atau</div>

        <div class="register-link">
            Belum punya akun? <a href="/register">Daftar Sekarang</a>
        </div>

        <div class="back-home">
            <a href="/">← Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        const API_BASE_URL = '/api';
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const alertBox = document.getElementById('alertBox');

        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁️';
            }
        }

        // Show Alert Message
        function showAlert(message, type = 'error') {
            alertBox.textContent = message;
            alertBox.className = `alert alert-${type} show`;
            
            setTimeout(() => {
                alertBox.classList.remove('show');
            }, 5000);
        }

        // Handle Login Form Submit
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;

            // Disable button and show loading
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<span class="spinner"></span>Memproses...';

            try {
                const response = await fetch(`${API_BASE_URL}/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    // Store token
                    localStorage.setItem('auth_token', data.token);
                    localStorage.setItem('user', JSON.stringify(data.user));
                    
                    if (remember) {
                        localStorage.setItem('remember_me', 'true');
                    }

                    showAlert('Login berhasil! Mengalihkan...', 'success');
                    
                    // Redirect after 1 second
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
                } else {
                    // Handle error response
                    const errorMessage = data.message || 'Email atau password salah';
                    showAlert(errorMessage, 'error');
                    
                    // Re-enable button
                    loginBtn.disabled = false;
                    loginBtn.innerHTML = 'Masuk';
                }
            } catch (error) {
                console.error('Login error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                
                // Re-enable button
                loginBtn.disabled = false;
                loginBtn.innerHTML = 'Masuk';
            }
        });

        // Check if already logged in
        window.addEventListener('load', () => {
            const token = localStorage.getItem('auth_token');
            if (token) {
                // Verify token is still valid
                fetch(`${API_BASE_URL}/me`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '/';
                    }
                })
                .catch(error => {
                    console.error('Token verification failed:', error);
                });
            }
        });
    </script>
</body>
</html>
