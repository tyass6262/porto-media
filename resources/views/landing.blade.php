<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Media</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg: #060a13;
            --surface: rgba(15, 23, 42, 0.55);
            --border: rgba(255, 255, 255, 0.06);
            --accent: #10b981;
            --accent-hover: #34d399;
            --accent-glow: rgba(16, 185, 129, 0.2);
            --accent-subtle: rgba(16, 185, 129, 0.07);
            --cyan: #06b6d4;
            --cyan-glow: rgba(6, 182, 212, 0.15);
            --text: #f1f5f9;
            --text-2: #94a3b8;
            --text-3: #475569;
            --amber: #f59e0b;
            --rose: #f43f5e;
            --indigo: #818cf8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.1); }

        /* ═══════ CANVAS PARTICLES ═══════ */
        #particleCanvas {
            position: fixed; inset: 0; z-index: 0;
            pointer-events: none;
        }

        /* ═══════ AMBIENT BG ═══════ */
        .ambient {
            position: fixed; inset: 0; z-index: 0;
            pointer-events: none; overflow: hidden;
        }
        .ambient .orb {
            position: absolute; border-radius: 50%;
            filter: blur(100px); opacity: 0.3;
        }
        .ambient .orb-1 {
            width: 600px; height: 600px;
            top: -15%; right: -10%;
            background: radial-gradient(circle, rgba(16,185,129,0.08), transparent 70%);
            animation: orbDrift1 25s ease-in-out infinite;
        }
        .ambient .orb-2 {
            width: 500px; height: 500px;
            bottom: -10%; left: -8%;
            background: radial-gradient(circle, rgba(6,182,212,0.06), transparent 70%);
            animation: orbDrift2 30s ease-in-out infinite;
        }
        .ambient .orb-3 {
            width: 300px; height: 300px;
            top: 50%; left: 40%;
            background: radial-gradient(circle, rgba(129,140,248,0.04), transparent 70%);
            animation: orbDrift3 20s ease-in-out infinite;
        }
        @keyframes orbDrift1 {
            0%,100%{ transform: translate(0,0) scale(1); }
            50%{ transform: translate(-60px,80px) scale(1.1); }
        }
        @keyframes orbDrift2 {
            0%,100%{ transform: translate(0,0) scale(1); }
            50%{ transform: translate(80px,-60px) scale(1.08); }
        }
        @keyframes orbDrift3 {
            0%,100%{ transform: translate(-50%,-50%) scale(1); }
            50%{ transform: translate(-50%,-50%) scale(1.2); }
        }

        .grid-bg {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(ellipse 70% 50% at 50% 30%, black 10%, transparent 80%);
        }

        /* ═══════ NAVBAR ═══════ */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 40px; height: 68px;
            background: rgba(6, 10, 19, 0.5);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: all 0.4s;
        }
        .navbar.scrolled {
            background: rgba(6, 10, 19, 0.85);
            border-bottom-color: rgba(255,255,255,0.08);
        }
        .nav-brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .nav-logo {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: #fff;
            box-shadow: 0 4px 16px rgba(16,185,129,0.2);
        }
        .nav-brand-text {
            font-size: 16px; font-weight: 800; color: var(--text);
            letter-spacing: -0.3px;
        }
        .nav-links { display: flex; align-items: center; gap: 6px; }
        .nav-link {
            padding: 8px 18px; border-radius: 9px;
            font-size: 13px; font-weight: 500; color: var(--text-2);
            text-decoration: none; transition: all 0.2s;
            border: 1px solid transparent;
        }
        .nav-link:hover {
            color: var(--text); background: rgba(255,255,255,0.04);
        }
        .nav-link.btn-nav {
            background: var(--accent); color: #fff;
            font-weight: 700; border-color: transparent;
            box-shadow: 0 2px 12px var(--accent-glow);
        }
        .nav-link.btn-nav:hover {
            background: var(--accent-hover);
            box-shadow: 0 4px 20px rgba(16,185,129,0.3);
            transform: translateY(-1px); color: #fff;
        }

        /* ═══════ HERO ═══════ */
        .hero {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
        }
        .hero-inner { max-width: 780px; }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 16px 6px 8px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.12);
            border-radius: 100px;
            font-size: 12px; font-weight: 600; color: var(--accent);
            margin-bottom: 28px;
            opacity: 0; animation: fadeUp 0.7s 0.1s cubic-bezier(0.16,1,0.3,1) forwards;
        }
        .hero-badge-dot {
            width: 20px; height: 20px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 9px; color: #fff;
        }

        .hero h1 {
            font-size: clamp(36px, 6vw, 64px);
            font-weight: 900; line-height: 1.1;
            letter-spacing: -0.03em;
            margin-bottom: 20px;
            opacity: 0; animation: fadeUp 0.7s 0.2s cubic-bezier(0.16,1,0.3,1) forwards;
        }
        .hero h1 .gradient-text {
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: clamp(15px, 2vw, 18px);
            color: var(--text-2); line-height: 1.7;
            max-width: 560px; margin: 0 auto 36px;
            opacity: 0; animation: fadeUp 0.7s 0.3s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .hero-actions {
            display: flex; align-items: center; justify-content: center;
            gap: 14px; flex-wrap: wrap;
            opacity: 0; animation: fadeUp 0.7s 0.4s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .btn-hero {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 30px; border-radius: 12px;
            font-size: 14px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-decoration: none; cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            border: none; position: relative; overflow: hidden;
        }
        .btn-hero.primary {
            background: linear-gradient(135deg, var(--accent), #059669);
            color: #fff;
            box-shadow: 0 4px 24px var(--accent-glow), inset 0 1px 0 rgba(255,255,255,0.15);
        }
        .btn-hero.primary::before {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
            transition: left 0.6s;
        }
        .btn-hero.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 36px rgba(16,185,129,0.3), inset 0 1px 0 rgba(255,255,255,0.15);
            color: #fff;
        }
        .btn-hero.primary:hover::before { left: 100%; }
        .btn-hero.primary:active { transform: translateY(0); }

        .btn-hero.ghost {
            background: rgba(255,255,255,0.03);
            border: 1.5px solid rgba(255,255,255,0.1);
            color: var(--text-2);
        }
        .btn-hero.ghost:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.18);
            color: var(--text); transform: translateY(-2px);
        }
        .btn-hero i { font-size: 13px; }

        .hero-stats {
            display: flex; align-items: center; justify-content: center;
            gap: 40px; margin-top: 56px;
            opacity: 0; animation: fadeUp 0.7s 0.55s cubic-bezier(0.16,1,0.3,1) forwards;
        }
        .hero-stat { text-align: center; }
        .hero-stat-val {
            font-size: 28px; font-weight: 800;
            background: linear-gradient(135deg, var(--text), var(--text-2));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-stat-label { font-size: 12px; color: var(--text-3); margin-top: 2px; font-weight: 500; }
        .hero-stat-divider { width: 1px; height: 36px; background: var(--border); }

        /* Scroll indicator */
        .scroll-hint {
            position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%);
            display: flex; flex-direction: column; align-items: center; gap: 8px;
            opacity: 0; animation: fadeUp 0.7s 0.7s cubic-bezier(0.16,1,0.3,1) forwards;
        }
        .scroll-mouse {
            width: 22px; height: 34px; border-radius: 11px;
            border: 1.5px solid rgba(255,255,255,0.12);
            position: relative;
        }
        .scroll-mouse::before {
            content: ''; position: absolute; top: 7px; left: 50%; transform: translateX(-50%);
            width: 3px; height: 8px; border-radius: 2px;
            background: var(--accent); opacity: 0.6;
            animation: scrollPulse 2s ease-in-out infinite;
        }
        @keyframes scrollPulse {
            0%,100%{ transform: translateX(-50%) translateY(0); opacity: 0.6; }
            50%{ transform: translateX(-50%) translateY(6px); opacity: 0.2; }
        }
        .scroll-text { font-size: 10px; color: var(--text-3); letter-spacing: 1px; text-transform: uppercase; font-weight: 600; }

        /* ═══════ SECTION ═══════ */
        section { position: relative; z-index: 1; }

        .section-label {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 5px 14px; border-radius: 8px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            font-size: 11px; font-weight: 700; color: var(--text-3);
            text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 14px;
        }
        .section-label i { font-size: 10px; }

        .section-title {
            font-size: clamp(26px, 4vw, 36px);
            font-weight: 800; letter-spacing: -0.03em;
            margin-bottom: 10px;
        }
        .section-desc {
            font-size: 15px; color: var(--text-2);
            max-width: 520px; line-height: 1.7;
        }

        /* ═══════ FEATURES ═══════ */
        .features {
            padding: 100px 24px;
            max-width: 1120px; margin: 0 auto;
        }
        .features-header {
            text-align: center; margin-bottom: 60px;
        }
        .features-header .section-desc { margin: 0 auto; }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .feature-card {
            background: var(--surface);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 18px; padding: 32px;
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
            position: relative; overflow: hidden;
            opacity: 0; transform: translateY(24px);
        }
        .feature-card.visible {
            opacity: 1; transform: translateY(0);
        }
        .feature-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent);
        }
        .feature-card::after {
            content: ''; position: absolute; top: -60px; right: -60px;
            width: 160px; height: 160px; border-radius: 50%;
            opacity: 0; transition: opacity 0.4s; pointer-events: none;
        }
        .feature-card:hover {
            border-color: rgba(255,255,255,0.1);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .feature-card:hover::after { opacity: 1; }

        .feature-card:nth-child(1)::after { background: radial-gradient(circle, rgba(16,185,129,0.06), transparent 70%); }
        .feature-card:nth-child(1):hover { border-color: rgba(16,185,129,0.15); }
        .feature-card:nth-child(2)::after { background: radial-gradient(circle, rgba(6,182,212,0.06), transparent 70%); }
        .feature-card:nth-child(2):hover { border-color: rgba(6,182,212,0.15); }
        .feature-card:nth-child(3)::after { background: radial-gradient(circle, rgba(245,158,11,0.06), transparent 70%); }
        .feature-card:nth-child(3):hover { border-color: rgba(245,158,11,0.15); }
        .feature-card:nth-child(4)::after { background: radial-gradient(circle, rgba(129,140,248,0.06), transparent 70%); }
        .feature-card:nth-child(4):hover { border-color: rgba(129,140,248,0.15); }

        .feature-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .feature-card:hover .feature-icon { transform: scale(1.08) rotate(-3deg); }
        .fi-green { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.12); color: var(--accent); }
        .fi-cyan { background: rgba(6,182,212,0.07); border: 1px solid rgba(6,182,212,0.12); color: var(--cyan); }
        .fi-amber { background: rgba(245,158,11,0.07); border: 1px solid rgba(245,158,11,0.12); color: var(--amber); }
        .fi-indigo { background: rgba(129,140,248,0.07); border: 1px solid rgba(129,140,248,0.12); color: var(--indigo); }

        .feature-title {
            font-size: 16px; font-weight: 700; margin-bottom: 8px;
            color: var(--text);
        }
        .feature-desc {
            font-size: 13.5px; color: var(--text-2); line-height: 1.65;
        }
        .feature-tags {
            display: flex; flex-wrap: wrap; gap: 6px; margin-top: 16px;
        }
        .feature-tag {
            padding: 3px 10px; border-radius: 6px;
            font-size: 11px; font-weight: 600;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            color: var(--text-3);
        }

        /* ═══════ HOW IT WORKS ═══════ */
        .how-section {
            padding: 100px 24px;
            max-width: 900px; margin: 0 auto;
        }
        .how-header { text-align: center; margin-bottom: 64px; }
        .how-header .section-desc { margin: 0 auto; }

        .how-steps { display: flex; flex-direction: column; gap: 0; position: relative; }
        .how-steps::before {
            content: ''; position: absolute; left: 28px; top: 48px; bottom: 48px;
            width: 2px;
            background: linear-gradient(to bottom, rgba(16,185,129,0.2), rgba(6,182,212,0.2), transparent);
        }

        .how-step {
            display: flex; gap: 24px; align-items: flex-start;
            padding: 28px 0;
            opacity: 0; transform: translateX(-16px);
            transition: all 0.6s cubic-bezier(0.16,1,0.3,1);
        }
        .how-step.visible { opacity: 1; transform: translateX(0); }

        .how-num {
            width: 56px; height: 56px; border-radius: 16px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 800;
            background: var(--surface); border: 1px solid var(--border);
            position: relative; z-index: 1;
            transition: all 0.3s;
        }
        .how-step:hover .how-num {
            border-color: rgba(16,185,129,0.2);
            box-shadow: 0 0 24px rgba(16,185,129,0.08);
        }
        .how-step:nth-child(1) .how-num { color: var(--accent); }
        .how-step:nth-child(2) .how-num { color: var(--cyan); }
        .how-step:nth-child(3) .how-num { color: var(--amber); }

        .how-content { flex: 1; padding-top: 4px; }
        .how-content h3 {
            font-size: 17px; font-weight: 700; margin-bottom: 6px;
        }
        .how-content p {
            font-size: 13.5px; color: var(--text-2); line-height: 1.65;
        }

        /* ═══════ CTA ═══════ */
        .cta-section {
            padding: 80px 24px 120px;
            max-width: 1120px; margin: 0 auto;
        }
        .cta-card {
            background: var(--surface);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 64px 48px;
            text-align: center;
            position: relative; overflow: hidden;
            opacity: 0; transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.16,1,0.3,1);
        }
        .cta-card.visible { opacity: 1; transform: translateY(0); }
        .cta-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(16,185,129,0.2), rgba(6,182,212,0.2), transparent);
        }
        .cta-card::after {
            content: ''; position: absolute;
            top: -100px; left: 50%; transform: translateX(-50%);
            width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,0.04), transparent 60%);
            pointer-events: none;
        }
        .cta-icon {
            width: 64px; height: 64px; border-radius: 20px;
            background: linear-gradient(135deg, var(--accent-subtle), rgba(6,182,212,0.06));
            border: 1px solid rgba(16,185,129,0.12);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 26px; color: var(--accent);
            margin-bottom: 24px;
            box-shadow: 0 8px 32px rgba(16,185,129,0.08);
        }
        .cta-card h2 {
            font-size: clamp(24px, 3.5vw, 32px);
            font-weight: 800; letter-spacing: -0.03em;
            margin-bottom: 12px; position: relative; z-index: 1;
        }
        .cta-card p {
            font-size: 15px; color: var(--text-2); line-height: 1.7;
            max-width: 460px; margin: 0 auto 32px;
            position: relative; z-index: 1;
        }
        .cta-actions {
            display: flex; align-items: center; justify-content: center;
            gap: 14px; flex-wrap: wrap;
            position: relative; z-index: 1;
        }

        /* ═══════ FOOTER ═══════ */
        .footer {
            position: relative; z-index: 1;
            border-top: 1px solid var(--border);
            padding: 28px 40px;
            display: flex; align-items: center; justify-content: space-between;
            font-size: 12.5px; color: var(--text-3);
        }
        .footer-links { display: flex; gap: 20px; }
        .footer-links a {
            color: var(--text-3); text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--text-2); }

        /* ═══════ ANIMATIONS ═══════ */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); filter: blur(4px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        /* ═══════ RESPONSIVE ═══════ */
        @media (max-width: 768px) {
            .navbar { padding: 0 20px; }
            .nav-brand-text { display: none; }
            .nav-link { padding: 7px 14px; font-size: 12px; }
            .hero { padding: 100px 20px 80px; }
            .hero-stats { gap: 24px; }
            .hero-stat-val { font-size: 22px; }
            .features-grid { grid-template-columns: 1fr; }
            .feature-card { padding: 24px; }
            .cta-card { padding: 48px 24px; border-radius: 18px; }
            .footer { flex-direction: column; gap: 12px; text-align: center; padding: 24px 20px; }
            .how-steps::before { left: 22px; }
            .how-num { width: 44px; height: 44px; border-radius: 12px; font-size: 15px; }
            .how-step { gap: 16px; }
        }
        @media (max-width: 480px) {
            .hero-actions { flex-direction: column; width: 100%; }
            .btn-hero { width: 100%; justify-content: center; }
            .hero-stats { flex-direction: column; gap: 16px; }
            .hero-stat-divider { width: 40px; height: 1px; }
            .cta-actions { flex-direction: column; width: 100%; }
            .cta-actions .btn-hero { width: 100%; justify-content: center; }
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

<canvas id="particleCanvas"></canvas>
<div class="ambient">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>
<div class="grid-bg"></div>

<!-- ═══════ NAVBAR ═══════ -->
<nav class="navbar" id="navbar">
    <a href="/" class="nav-brand">
        <div class="nav-logo"><i class="fas fa-rocket"></i></div>
        <span class="nav-brand-text">Portfolio</span>
    </a>
    <div class="nav-links">
        <a href="{{ route('portfolio.index') }}" class="nav-link">
            <i class="fas fa-eye" style="margin-right:5px;font-size:11px"></i>Lihat Portfolio
        </a>
        <a href="{{ route('login') }}" class="nav-link">Login</a>
        <a href="{{ route('register') }}" class="nav-link btn-nav">Daftar Gratis</a>
    </div>
</nav>

<!-- ═══════ HERO ═══════ -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-badge">
            <div class="hero-badge-dot"><i class="fas fa-sparkles"></i></div>
            Platform Portfolio Modern
        </div>

        <h1>
            Bangun Portfolio<br>
            <span class="gradient-text">Yang Berkesan</span>
        </h1>

        <p class="hero-desc">
            Upload project, gambar, video, dan tampilkan karya terbaikmu ke dunia.
            Satu tempat untuk semua portofolio kreatifmu.
        </p>

        <div class="hero-actions">
            <a href="{{ route('register') }}" class="btn-hero primary">
                Mulai Sekarang <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('portfolio.index') }}" class="btn-hero ghost">
                <i class="fas fa-play"></i> Lihat Portfolio
            </a>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-val">500+</div>
                <div class="hero-stat-label">Portfolio Aktif</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-val">2.4K</div>
                <div class="hero-stat-label">Project Uploaded</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-val">99.9%</div>
                <div class="hero-stat-label">Uptime Server</div>
            </div>
        </div>
    </div>

    <div class="scroll-hint">
        <div class="scroll-mouse"></div>
        <span class="scroll-text">Scroll</span>
    </div>
</section>

<!-- ═══════ FEATURES ═══════ -->
<section class="features" id="features">
    <div class="features-header">
        <div class="section-label"><i class="fas fa-grid-2"></i> Fitur Unggulan</div>
        <h2 class="section-title">Semua yang Kamu Butuhkan</h2>
        <p class="section-desc">Dirancang untuk kreator yang ingin tampil profesional tanpa ribet</p>
    </div>

    <div class="features-grid">
        <div class="feature-card" data-delay="0">
            <div class="feature-icon fi-green"><i class="fas fa-photo-film"></i></div>
            <div class="feature-title">Multi Media Upload</div>
            <div class="feature-desc">Upload gambar, video, dokumen, atau sematkan link dari platform manapun dalam satu tempat.</div>
            <div class="feature-tags">
                <span class="feature-tag">Gambar</span>
                <span class="feature-tag">Video</span>
                <span class="feature-tag">Embed</span>
                <span class="feature-tag">File</span>
            </div>
        </div>

        <div class="feature-card" data-delay="80">
            <div class="feature-icon fi-cyan"><i class="fas fa-layer-group"></i></div>
            <div class="feature-title">Kategori Terorganisir</div>
            <div class="feature-desc">Kelompokkan project berdasarkan kategori agar pengunjung mudah menelusuri karya terbaikmu.</div>
            <div class="feature-tags">
                <span class="feature-tag">Custom Category</span>
                <span class="feature-tag">Filter</span>
                <span class="feature-tag">Sort</span>
            </div>
        </div>

        <div class="feature-card" data-delay="160">
            <div class="feature-icon fi-amber"><i class="fas fa-globe"></i></div>
            <div class="feature-title">Halaman Publik</div>
            <div class="feature-desc">Setiap portfolio punya halaman publik yang bisa dibagikan ke klien, rekruter, atau teman.</div>
            <div class="feature-tags">
                <span class="feature-tag">Shareable Link</span>
                <span class="feature-tag">SEO Friendly</span>
            </div>
        </div>

        <div class="feature-card" data-delay="240">
            <div class="feature-icon fi-indigo"><i class="fas fa-shield-halved"></i></div>
            <div class="feature-title">Moderasi Admin</div>
            <div class="feature-desc">Kontrol penuh atas konten. Aktifkan, nonaktifkan, atau hapus project yang tidak sesuai.</div>
            <div class="feature-tags">
                <span class="feature-tag">Toggle Status</span>
                <span class="feature-tag">Content Review</span>
                <span class="feature-tag">Logs</span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════ HOW IT WORKS ═══════ -->
<section class="how-section" id="how">
    <div class="how-header">
        <div class="section-label"><i class="fas fa-route"></i> Cara Kerja</div>
        <h2 class="section-title">Tiga Langkah Mudah</h2>
        <p class="section-desc">Dari daftar sampai portfolio tayang, cuma butuh hitungan menit</p>
    </div>

    <div class="how-steps">
        <div class="how-step" data-delay="0">
            <div class="how-num">01</div>
            <div class="how-content">
                <h3>Buat Akun dan Profil</h3>
                <p>Daftar gratis, isi profil singkat, dan atuh tampilan portfolio sesuai keinginanmu.</p>
            </div>
        </div>
        <div class="how-step" data-delay="120">
            <div class="how-num">02</div>
            <div class="how-content">
                <h3>Upload Karya Terbaikmu</h3>
                <p>Tambahkan project dengan gambar, video, deskripsi, dan kategori yang relevan.</p>
            </div>
        </div>
        <div class="how-step" data-delay="240">
            <div class="how-num">03</div>
            <div class="how-content">
                <h3>Bagikan ke Dunia</h3>
                <p>Dapatkan link portfolio publik dan bagikan ke sosial media, CV, atau langsung ke klien.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════ CTA ═══════ -->
<section class="cta-section">
    <div class="cta-card" id="ctaCard">
        <div class="cta-icon"><i class="fas fa-rocket"></i></div>
        <h2>Siap Memulai?</h2>
        <p>Bergabung dengan ratusan kreator lainnya. Buat portfolio profesional kamu sekarang, gratis.</p>
        <div class="cta-actions">
            <a href="{{ route('register') }}" class="btn-hero primary">
                Daftar Sekarang <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('login') }}" class="btn-hero ghost">
                <i class="fas fa-sign-in-alt"></i> Sudah Punya Akun
            </a>
        </div>
    </div>
</section>

<!-- ═══════ FOOTER ═══════ -->
<footer class="footer">
    <span>&copy; {{ date('Y') }} Portfolio Media System</span>
    <div class="footer-links">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('portfolio.index') }}">Portfolio</a>
    </div>
</footer>

<script>
/* ═══════ PARTICLES ═══════ */
(function() {
    var canvas = document.getElementById('particleCanvas');
    var ctx = canvas.getContext('2d');
    var particles = [];
    var mouse = { x: -999, y: -999 };
    var raf;

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    document.addEventListener('mousemove', function(e) {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
    });

    function Particle() {
        this.reset();
    }
    Particle.prototype.reset = function() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.size = Math.random() * 1.5 + 0.5;
        this.speedX = (Math.random() - 0.5) * 0.3;
        this.speedY = (Math.random() - 0.5) * 0.3;
        this.opacity = Math.random() * 0.3 + 0.05;
    };
    Particle.prototype.update = function() {
        this.x += this.speedX;
        this.y += this.speedY;
        var dx = mouse.x - this.x;
        var dy = mouse.y - this.y;
        var dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 120) {
            var force = (120 - dist) / 120 * 0.015;
            this.speedX -= dx * force * 0.02;
            this.speedY -= dy * force * 0.02;
        }
        this.speedX *= 0.99;
        this.speedY *= 0.99;
        if (this.x < -20 || this.x > canvas.width + 20 || this.y < -20 || this.y > canvas.height + 20) {
            this.reset();
        }
    };
    Particle.prototype.draw = function() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(16, 185, 129, ' + this.opacity + ')';
        ctx.fill();
    };

    var count = Math.min(Math.floor(window.innerWidth * 0.06), 80);
    for (var i = 0; i < count; i++) {
        particles.push(new Particle());
    }

    function drawLines() {
        for (var i = 0; i < particles.length; i++) {
            for (var j = i + 1; j < particles.length; j++) {
                var dx = particles[i].x - particles[j].x;
                var dy = particles[i].y - particles[j].y;
                var dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 140) {
                    var alpha = (1 - dist / 140) * 0.06;
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = 'rgba(16, 185, 129, ' + alpha + ')';
                    ctx.lineWidth = 0.5;
                    ctx.stroke();
                }
            }
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(function(p) {
            p.update();
            p.draw();
        });
        drawLines();
        raf = requestAnimationFrame(animate);
    }
    animate();
})();

/* ═══════ NAVBAR SCROLL ═══════ */
window.addEventListener('scroll', function() {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 30);
});

/* ═══════ SCROLL REVEAL ═══════ */
(function() {
    var els = document.querySelectorAll('.feature-card, .how-step, .cta-card');
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var delay = parseInt(entry.target.dataset.delay) || 0;
                setTimeout(function() {
                    entry.target.classList.add('visible');
                }, delay);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    els.forEach(function(el) { observer.observe(el); });
})();
</script>

</body>
</html>