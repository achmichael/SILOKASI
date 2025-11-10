<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SILOKASI</title>
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

        .register-container {
            background: rgba(20, 20, 20, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 3rem;
            max-width: 500px;
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

        input, select {
            width: 100%;
            padding: 1rem 1.2rem;
            background: rgba(30, 30, 30, 0.6);
            border: 1px solid rgba(218, 165, 32, 0.2);
            border-radius: 12px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #DAA520;
            background: rgba(30, 30, 30, 0.8);
            box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.1);
        }

        input::placeholder {
            color: #666;
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23DAA520' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        select option {
            background: #1a1a1a;
            color: #fff;
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

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .terms-checkbox {
            display: flex;
            align-items: start;
            gap: 0.7rem;
            margin-bottom: 1.5rem;
            color: #ccc;
            font-size: 0.9rem;
        }

        .terms-checkbox input[type="checkbox"] {
            width: auto;
            margin-top: 0.2rem;
            cursor: pointer;
        }

        .terms-checkbox a {
            color: #DAA520;
            text-decoration: none;
        }

        .terms-checkbox a:hover {
            color: #FFD700;
        }

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(218, 165, 32, 0.5);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register:disabled {
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

        .login-link {
            text-align: center;
            color: #999;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #DAA520;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
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

        /* Password Strength Indicator */
        .password-strength {
            height: 4px;
            background: rgba(218, 165, 32, 0.2);
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .strength-weak { 
            width: 33%; 
            background: #ff6b6b; 
        }

        .strength-medium { 
            width: 66%; 
            background: #ffd93d; 
        }

        .strength-strong { 
            width: 100%; 
            background: #51cf66; 
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 2rem 1.5rem;
            }

            .logo {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-section">
            <div class="logo">SILOKASI</div>
            <div class="logo-subtitle">DECISION SUPPORT SYSTEM</div>
        </div>

        <h2>Buat Akun Baru</h2>
        <p class="subtitle">Daftar untuk mengakses sistem</p>

        <!-- Alert Messages -->
        <div id="alertBox" class="alert"></div>

        <form id="registerForm">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Masukkan nama lengkap Anda"
                    required
                >
            </div>

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

            <div class="form-row">
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="decision_maker">Decision Maker</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="expertise">Keahlian</label>
                    <select id="expertise" name="expertise">
                        <option value="">Pilih Keahlian</option>
                        <option value="teknik">Teknik</option>
                        <option value="ekonomi">Ekonomi</option>
                        <option value="lingkungan">Lingkungan</option>
                        <option value="hukum">Hukum</option>
                        <option value="umum">Umum</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-toggle">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Minimal 8 karakter"
                        required
                        minlength="8"
                        onkeyup="checkPasswordStrength()"
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                        👁️
                    </button>
                </div>
                <div class="password-strength">
                    <div id="strengthBar" class="password-strength-bar"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="password-toggle">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Ulangi password Anda"
                        required
                        minlength="8"
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                        👁️
                    </button>
                </div>
            </div>

            <label class="terms-checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <span>Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a></span>
            </label>

            <button type="submit" class="btn-register" id="registerBtn">
                Daftar Sekarang
            </button>
        </form>

        <div class="divider">atau</div>

        <div class="login-link">
            Sudah punya akun? <a href="/login">Login Disini</a>
        </div>

        <div class="back-home">
            <a href="/">← Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        const API_BASE_URL = '/api';
        const registerForm = document.getElementById('registerForm');
        const registerBtn = document.getElementById('registerBtn');
        const alertBox = document.getElementById('alertBox');

        // Toggle Password Visibility
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleBtn = passwordInput.nextElementSibling;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁️';
            }
        }

        // Check Password Strength
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthBar');
            
            // Reset classes
            strengthBar.className = 'password-strength-bar';
            
            if (password.length === 0) {
                return;
            }
            
            let strength = 0;
            
            // Check length
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            
            // Check for numbers
            if (/\d/.test(password)) strength++;
            
            // Check for special characters
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
            
            // Check for uppercase and lowercase
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
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

        // Handle Register Form Submit
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const role = document.getElementById('role').value;
            const expertise = document.getElementById('expertise').value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const termsAccepted = document.getElementById('terms').checked;

            // Validation
            if (password !== passwordConfirmation) {
                showAlert('Password dan konfirmasi password tidak cocok', 'error');
                return;
            }

            if (!termsAccepted) {
                showAlert('Anda harus menyetujui syarat dan ketentuan', 'error');
                return;
            }

            // Disable button and show loading
            registerBtn.disabled = true;
            registerBtn.innerHTML = '<span class="spinner"></span>Memproses...';

            try {
                const response = await fetch(`${API_BASE_URL}/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        role: role,
                        expertise: expertise || null,
                        password: password,
                        password_confirmation: passwordConfirmation
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    showAlert('Registrasi berhasil! Mengalihkan ke halaman login...', 'success');
                    
                    // Redirect to login after 2 seconds
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                } else {
                    // Handle error response
                    let errorMessage = 'Registrasi gagal. ';
                    
                    if (data.errors) {
                        // Laravel validation errors
                        const errors = Object.values(data.errors).flat();
                        errorMessage += errors.join(', ');
                    } else if (data.message) {
                        errorMessage += data.message;
                    }
                    
                    showAlert(errorMessage, 'error');
                    
                    // Re-enable button
                    registerBtn.disabled = false;
                    registerBtn.innerHTML = 'Daftar Sekarang';
                }
            } catch (error) {
                console.error('Register error:', error);
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                
                // Re-enable button
                registerBtn.disabled = false;
                registerBtn.innerHTML = 'Daftar Sekarang';
            }
        });

        // Show/hide expertise field based on role
        document.getElementById('role').addEventListener('change', function() {
            const expertiseField = document.getElementById('expertise').parentElement;
            if (this.value === 'decision_maker') {
                expertiseField.style.display = 'block';
                document.getElementById('expertise').required = true;
            } else {
                expertiseField.style.display = 'none';
                document.getElementById('expertise').required = false;
            }
        });
    </script>
</body>
</html>
