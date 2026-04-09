<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Masuk ke Akunmu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #0a0f1a;
            --bg-secondary: #111827;
            --card-bg: rgba(17, 24, 39, 0.65);
            --card-border: rgba(255, 255, 255, 0.08);
            --accent: #10b981;
            --accent-hover: #34d399;
            --accent-glow: rgba(16, 185, 129, 0.25);
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --input-bg: rgba(15, 23, 42, 0.8);
            --input-border: rgba(255, 255, 255, 0.1);
            --input-focus: rgba(16, 185, 129, 0.4);
            --danger: #ef4444;
            --danger-bg: rgba(239, 68, 68, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* === Latar Belakang Animasi === */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .bg-layer::before {
            content: '';
            position: absolute;
            top: -40%;
            left: -20%;
            width: 80vw;
            height: 80vw;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%);
            animation: floatBlob1 20s ease-in-out infinite;
        }

        .bg-layer::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -20%;
            width: 70vw;
            height: 70vw;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.06) 0%, transparent 70%);
            animation: floatBlob2 25s ease-in-out infinite;
        }

        @keyframes floatBlob1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(10%, 15%) scale(1.1); }
            66% { transform: translate(-5%, 8%) scale(0.95); }
        }

        @keyframes floatBlob2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-12%, -10%) scale(1.05); }
            66% { transform: translate(8%, -5%) scale(0.9); }
        }

        /* Grid pattern overlay */
        .grid-pattern {
            position: fixed;
            inset: 0;
            z-index: 1;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
        }

        /* Partikel floating */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: var(--accent);
            border-radius: 50%;
            opacity: 0;
            animation: particleFloat linear infinite;
        }

        @keyframes particleFloat {
            0% { opacity: 0; transform: translateY(100vh) scale(0); }
            10% { opacity: 0.6; }
            90% { opacity: 0.3; }
            100% { opacity: 0; transform: translateY(-10vh) scale(1); }
        }

        /* === Layout Utama === */
        .login-wrapper {
            position: relative;
            z-index: 10;
            display: flex;
            width: 920px;
            max-width: 95vw;
            min-height: 560px;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--card-border);
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.03),
                0 25px 60px -12px rgba(0,0,0,0.5),
                0 0 120px -40px var(--accent-glow);
            animation: cardEntry 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes cardEntry {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.96);
                filter: blur(4px);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        /* === Panel Kiri (Branding) === */
        .brand-panel {
            flex: 1;
            background: linear-gradient(160deg, #064e3b 0%, #0a0f1a 50%, #0c1a2e 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 30% 70%, rgba(16,185,129,0.15), transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(6,182,212,0.1), transparent 50%);
        }

        .brand-panel .brand-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .brand-logo {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--accent), #06b6d4);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 28px;
            font-size: 32px;
            color: white;
            box-shadow: 0 8px 32px var(--accent-glow);
            animation: logoPulse 3s ease-in-out infinite;
        }

        @keyframes logoPulse {
            0%, 100% { box-shadow: 0 8px 32px var(--accent-glow); }
            50% { box-shadow: 0 8px 48px rgba(16,185,129,0.4); }
        }

        .brand-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .brand-subtitle {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.7;
            max-width: 280px;
            margin: 0 auto;
        }

        .brand-features {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            text-align: left;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--text-secondary);
            font-size: 14px;
            opacity: 0;
            animation: featureSlide 0.6s ease forwards;
        }

        .brand-feature:nth-child(1) { animation-delay: 0.4s; }
        .brand-feature:nth-child(2) { animation-delay: 0.55s; }
        .brand-feature:nth-child(3) { animation-delay: 0.7s; }

        @keyframes featureSlide {
            from { opacity: 0; transform: translateX(-16px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .feature-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 14px;
            flex-shrink: 0;
        }

        /* Decorative orb pada panel kiri */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: orbFloat 8s ease-in-out infinite;
        }

        .orb-1 {
            width: 200px;
            height: 200px;
            background: rgba(16, 185, 129, 0.12);
            top: -60px;
            right: -60px;
        }

        .orb-2 {
            width: 150px;
            height: 150px;
            background: rgba(6, 182, 212, 0.1);
            bottom: -40px;
            left: -40px;
            animation-delay: -4s;
        }

        @keyframes orbFloat {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, -20px); }
        }

        /* === Panel Kanan (Form) === */
        .form-panel {
            flex: 1;
            background: var(--card-bg);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            padding: 52px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 36px;
        }

        .form-header h2 {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .form-header p {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Alert Error */
        .alert-custom {
            background: var(--danger-bg);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #fca5a5;
            animation: shakeIn 0.5s ease;
        }

        .alert-custom i {
            color: var(--danger);
            font-size: 16px;
            flex-shrink: 0;
        }

        @keyframes shakeIn {
            0% { opacity: 0; transform: translateX(-10px); }
            25% { transform: translateX(6px); }
            50% { transform: translateX(-4px); }
            75% { transform: translateX(2px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        /* Input Group */
        .input-group-custom {
            margin-bottom: 22px;
            position: relative;
        }

        .input-group-custom label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i.input-icon {
            position: absolute;
            left: 16px;
            font-size: 15px;
            color: var(--text-muted);
            transition: color 0.3s;
            pointer-events: none;
            z-index: 2;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-wrapper input::placeholder {
            color: var(--text-muted);
            font-size: 13.5px;
        }

        .input-wrapper input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--input-focus), 0 0 20px -4px var(--accent-glow);
            background: rgba(15, 23, 42, 1);
        }

        .input-wrapper input:focus + i,
        .input-wrapper input:focus ~ i.input-icon {
            color: var(--accent);
        }

        /* Perbaikan: icon berada di atas input dalam DOM */
        .input-wrapper {
            position: relative;
        }
        .input-wrapper .input-icon {
            position: absolute;
            left: 16px;
            z-index: 2;
        }

        /* Toggle password */
        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 15px;
            padding: 4px;
            transition: color 0.2s;
            z-index: 2;
        }

        .toggle-password:hover {
            color: var(--text-secondary);
        }

        /* Remember me */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .checkbox-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .checkbox-custom input[type="checkbox"] {
            display: none;
        }

        .checkmark {
            width: 18px;
            height: 18px;
            border: 1.5px solid var(--input-border);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s;
            flex-shrink: 0;
        }

        .checkmark i {
            font-size: 10px;
            color: white;
            opacity: 0;
            transform: scale(0);
            transition: all 0.25s;
        }

        .checkbox-custom input:checked + .checkmark {
            background: var(--accent);
            border-color: var(--accent);
        }

        .checkbox-custom input:checked + .checkmark i {
            opacity: 1;
            transform: scale(1);
        }

        .forgot-link {
            font-size: 13px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px var(--accent-glow), 0 2px 8px rgba(0,0,0,0.2);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 16px var(--accent-glow);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--input-border);
        }

        .divider span {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        /* Social buttons */
        .social-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-social {
            flex: 1;
            padding: 12px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            color: var(--text-secondary);
            font-size: 18px;
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-social:hover {
            border-color: rgba(255,255,255,0.2);
            background: rgba(30, 41, 59, 0.8);
            transform: translateY(-1px);
        }

        /* Register link */
        .register-link {
            text-align: center;
            margin-top: 28px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .register-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }

        /* === Responsive === */
        @media (max-width: 768px) {
            body {
                padding: 16px;
                align-items: flex-start;
                padding-top: 32px;
            }

            .login-wrapper {
                flex-direction: column;
                min-height: auto;
                max-width: 440px;
            }

            .brand-panel {
                padding: 36px 32px;
            }

            .brand-features {
                display: none;
            }

            .form-panel {
                padding: 36px 28px;
            }
        }

        @media (max-width: 480px) {
            .form-panel {
                padding: 28px 20px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

    <div class="bg-layer"></div>
    <div class="grid-pattern"></div>
    <div class="particles" id="particles"></div>

    <div class="login-wrapper">

        <div class="brand-panel">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="brand-content">
                <div class="brand-logo">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h1 class="brand-title">Portofolio-Media</h1>
                <p class="brand-subtitle">Platform terpercaya untuk membuat portfolio digital yang memungkinkan pengguna membuat project, mengunggah media, dan mengategorikannya untuk tampilan gallery yang mudah difilter.</p>

                <div class="brand-features">
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-lock"></i></div>
                        <span>Keamanan berlapis dengan enkripsi end-to-end</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <span>Performa tinggi dengan respons instan</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-globe"></i></div>
                        <span>Akses kapan saja, di mana saja</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-panel">
            <div class="form-header">
                <h2>Selamat Datang</h2>
                <p>Masukkan kredensial untuk mengakses akunmu</p>
            </div>

            @if(session('error'))
            <div class="alert-custom">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <form method="POST" action="/login" id="loginForm">
                @csrf

                <div class="input-group-custom">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="nama@email.com"
                            required
                            autocomplete="email"
                        >
                    </div>
                </div>

                <div class="input-group-custom">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-key input-icon"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-password" aria-label="Toggle password visibility" onclick="togglePassword()">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-custom">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"><i class="fas fa-check"></i></span>
                        Ingat saya
                    </label>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    <span id="btnText">Masuk</span>
                </button>
            </form>

            <p class="register-link">
                Belum punya akun? <a href="/register">Daftar sekarang</a>
            </p>
        </div>
    </div>

    <script>
       
        function togglePassword() {
            const passInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnLogin');
            const btnText = document.getElementById('btnText');
            btn.disabled = true;
            btn.style.opacity = '0.7';
            btnText.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:8px"></i>Memproses...';
        });

        (function createParticles() {
            const container = document.getElementById('particles');
            const count = 25;
            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                
                p.style.left = Math.random() * 100 + '%';
                p.style.width = (Math.random() * 3 + 1.5) + 'px';
                p.style.height = p.style.width;
                p.style.animationDuration = (Math.random() * 15 + 10) + 's';
                p.style.animationDelay = (Math.random() * 15) + 's';
                
                p.style.background = Math.random() > 0.5
                    ? 'rgba(16, 185, 129, 0.6)'
                    : 'rgba(6, 182, 212, 0.4)';
                container.appendChild(p);
            }
        })();

        document.querySelectorAll('.input-wrapper input').forEach(input => {
            input.addEventListener('focus', () => {
                input.closest('.input-wrapper').querySelector('.input-icon').style.color = 'var(--accent)';
            });
            input.addEventListener('blur', () => {
                input.closest('.input-wrapper').querySelector('.input-icon').style.color = '';
            });
        });
    </script>
</body>
</html>