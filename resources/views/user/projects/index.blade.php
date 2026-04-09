<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #0a0f1a;
            --bg-secondary: #111827;
            --card-bg: rgba(17, 24, 39, 0.65);
            --card-border: rgba(255, 255, 255, 0.08);
            --card-hover-border: rgba(16, 185, 129, 0.25);
            --accent: #10b981;
            --accent-hover: #34d399;
            --accent-glow: rgba(16, 185, 129, 0.25);
            --accent-subtle: rgba(16, 185, 129, 0.08);
            --cyan: #06b6d4;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --input-bg: rgba(15, 23, 42, 0.8);
            --input-border: rgba(255, 255, 255, 0.1);
            --input-focus: rgba(16, 185, 129, 0.4);
            --danger: #ef4444;
            --danger-bg: rgba(239, 68, 68, 0.1);
            --danger-hover: #dc2626;
            --amber: #f59e0b;
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
            position: relative;
            overflow-x: hidden;
            padding-bottom: 60px;
        }

        /* === Background === */
        .bg-layer {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .bg-layer::before {
            content: '';
            position: absolute;
            top: -40%;
            left: -20%;
            width: 80vw;
            height: 80vw;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.06) 0%, transparent 70%);
            animation: floatBlob1 20s ease-in-out infinite;
        }

        .bg-layer::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -20%;
            width: 70vw;
            height: 70vw;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.05) 0%, transparent 70%);
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

        .grid-pattern {
            position: fixed;
            inset: 0;
            z-index: 1;
            background-image:
                linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center top, black 20%, transparent 70%);
            pointer-events: none;
        }

        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
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
            10% { opacity: 0.5; }
            90% { opacity: 0.2; }
            100% { opacity: 0; transform: translateY(-10vh) scale(1); }
        }

        /* === Navbar === */
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10, 15, 26, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
        }

        .nav-brand-text {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.3px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 6px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16, 185, 129, 0.15);
            border-radius: 40px;
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.25s;
        }

        .nav-user:hover {
            border-color: rgba(16, 185, 129, 0.3);
            color: var(--text-primary);
        }

        .nav-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
            font-weight: 700;
        }

        /* === Main Content === */
        .main-content {
            position: relative;
            z-index: 10;
            max-width: 1120px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        /* === Page Header === */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 32px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .page-header-left h1 {
            font-size: 30px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .page-header-left p {
            font-size: 14.5px;
            color: var(--text-muted);
        }

        .page-header-left .project-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16, 185, 129, 0.15);
            color: var(--accent);
            font-size: 13px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            margin-top: 10px;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 24px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.2px;
            flex-shrink: 0;
        }

        .btn-add::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px var(--accent-glow);
        }

        .btn-add:hover::before {
            left: 100%;
        }

        .btn-add:active {
            transform: translateY(0);
        }

        .btn-add i {
            font-size: 13px;
        }

        /* === Toolbar (Search + Filter) === */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 220px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 14px;
            pointer-events: none;
            transition: color 0.3s;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none;
            transition: all 0.3s;
        }

        .search-box input::placeholder {
            color: var(--text-muted);
        }

        .search-box input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--input-focus);
        }

        .search-box input:focus + i {
            color: var(--accent);
        }

        .view-toggle {
            display: flex;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 10px;
            overflow: hidden;
        }

        .view-btn {
            padding: 10px 14px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .view-btn.active {
            background: var(--accent-subtle);
            color: var(--accent);
        }

        .view-btn:hover:not(.active) {
            color: var(--text-secondary);
        }

        /* === Project Grid === */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
        }

        .projects-grid.list-view {
            grid-template-columns: 1fr;
        }

        /* === Project Card === */
        .project-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
            animation: cardReveal 0.5s ease forwards;
        }

        .project-card:nth-child(1) { animation-delay: 0.05s; }
        .project-card:nth-child(2) { animation-delay: 0.1s; }
        .project-card:nth-child(3) { animation-delay: 0.15s; }
        .project-card:nth-child(4) { animation-delay: 0.2s; }
        .project-card:nth-child(5) { animation-delay: 0.25s; }
        .project-card:nth-child(6) { animation-delay: 0.3s; }
        .project-card:nth-child(7) { animation-delay: 0.35s; }
        .project-card:nth-child(8) { animation-delay: 0.4s; }

        @keyframes cardReveal {
            to { opacity: 1; transform: translateY(0); }
        }

        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--cyan));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .project-card:hover {
            border-color: var(--card-hover-border);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px -8px rgba(0,0,0,0.4), 0 0 40px -12px var(--accent-glow);
        }

        .project-card:hover::before {
            opacity: 1;
        }

        .card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .card-icon.green {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--accent);
        }

        .card-icon.cyan {
            background: rgba(6, 182, 212, 0.1);
            border: 1px solid rgba(6, 182, 212, 0.2);
            color: var(--cyan);
        }

        .card-icon.amber {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: var(--amber);
        }

        .card-icon.rose {
            background: rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(244, 63, 94, 0.2);
            color: #f43f5e;
        }

        .card-menu {
            position: relative;
        }

        .card-menu-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: none;
            border: 1px solid transparent;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.2s;
        }

        .card-menu-btn:hover {
            background: rgba(255,255,255,0.05);
            border-color: var(--input-border);
            color: var(--text-secondary);
        }

        .card-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 6px;
            background: #1e293b;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 6px;
            min-width: 160px;
            box-shadow: 0 16px 48px -8px rgba(0,0,0,0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(0.95);
            transition: all 0.2s ease;
            z-index: 50;
        }

        .card-dropdown.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            color: var(--text-secondary);
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s;
            border: none;
            background: none;
            width: 100%;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .dropdown-item:hover {
            background: rgba(255,255,255,0.05);
            color: var(--text-primary);
        }

        .dropdown-item i {
            width: 16px;
            text-align: center;
            font-size: 13px;
        }

        .dropdown-item.danger {
            color: #fca5a5;
        }

        .dropdown-item.danger:hover {
            background: var(--danger-bg);
            color: var(--danger);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--card-border);
            margin: 4px 0;
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
            letter-spacing: -0.2px;
            line-height: 1.3;
        }

        .card-description {
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .meta-item i {
            font-size: 11px;
            opacity: 0.7;
        }

        /* List view adjustments */
        .list-view .project-card {
            padding: 20px 28px;
        }

        .list-view .card-body-row {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .list-view .card-icon {
            flex-shrink: 0;
        }

        .list-view .card-text-area {
            flex: 1;
            min-width: 0;
        }

        .list-view .card-description {
            margin-bottom: 0;
            -webkit-line-clamp: 1;
        }

        .list-view .card-top {
            margin-bottom: 0;
        }

        .list-view .card-menu {
            flex-shrink: 0;
        }

        /* === Empty State === */
        .empty-state {
            text-align: center;
            padding: 80px 24px;
            animation: cardReveal 0.5s ease forwards;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16, 185, 129, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--accent);
            margin: 0 auto 24px;
        }

        .empty-state h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: var(--text-muted);
            max-width: 360px;
            margin: 0 auto 28px;
            line-height: 1.6;
        }

        /* === Modal Konfirmasi Hapus === */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s;
            padding: 24px;
        }

        .modal-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            background: #1e293b;
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 32px;
            max-width: 400px;
            width: 100%;
            transform: scale(0.9) translateY(20px);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 25px 60px -12px rgba(0,0,0,0.5);
        }

        .modal-overlay.open .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: var(--danger-bg);
            border: 1px solid rgba(239, 68, 68, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--danger);
            margin-bottom: 20px;
        }

        .modal-box h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .modal-box p {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .modal-box p strong {
            color: var(--text-secondary);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
        }

        .btn-modal {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-cancel {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--input-border);
            color: var(--text-secondary);
        }

        .btn-cancel:hover {
            background: rgba(255,255,255,0.08);
            color: var(--text-primary);
        }

        .btn-delete-confirm {
            background: var(--danger);
            color: white;
        }

        .btn-delete-confirm:hover {
            background: var(--danger-hover);
            box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);
        }

        /* === Toast === */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 24px;
            z-index: 2000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: #1e293b;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13.5px;
            color: var(--text-secondary);
            box-shadow: 0 12px 40px -8px rgba(0,0,0,0.4);
            animation: toastIn 0.4s ease forwards;
            min-width: 280px;
        }

        .toast.removing {
            animation: toastOut 0.3s ease forwards;
        }

        .toast i {
            font-size: 16px;
            flex-shrink: 0;
        }

        .toast.success i { color: var(--accent); }
        .toast.error i { color: var(--danger); }

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes toastOut {
            to { opacity: 0; transform: translateX(40px); }
        }

        /* === Session error alert === */
        .session-alert {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .alert-custom {
            background: var(--danger-bg);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 20px;
            margin-bottom: 8px;
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

        /* === Responsive === */
        @media (max-width: 768px) {
            .top-nav {
                padding: 0 16px;
            }

            .nav-brand-text {
                display: none;
            }

            .main-content {
                padding: 24px 16px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .projects-grid {
                grid-template-columns: 1fr;
            }

            .toolbar {
                flex-direction: column;
            }

            .search-box {
                min-width: 100%;
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

    <!-- Background -->
    <div class="bg-layer"></div>
    <div class="grid-pattern"></div>
    <div class="particles" id="particles"></div>

    <!-- Navbar -->
    <nav class="top-nav">
        <a href="/" class="nav-brand">
            <div class="nav-logo"><i class="fas fa-shield-halved"></i></div>
            <span class="nav-brand-text">MyApp</span>
        </a>
        <div class="nav-actions">
            <a href="#" class="nav-user">
                <div class="nav-avatar">U</div>
                <span>User</span>
            </a>
        </div>
    </nav>

    <!-- Session Error -->
    @if(session('error'))
    <div class="session-alert">
        <div class="alert-custom">
            <i class="fas fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-left">
                <h1>My Projects</h1>
                <p>Kelola semua project kamu di satu tempat</p>
                @if($projects->count() > 0)
                <div class="project-count">
                    <i class="fas fa-folder"></i>
                    {{ $projects->count() }} project
                </div>
                @endif
            </div>
            <a href="{{ route('user.projects.create') }}" class="btn-add">
                <i class="fas fa-plus"></i>
                Tambah Project
            </a>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari project..." autocomplete="off">
                <i class="fas fa-search"></i>
            </div>
            <div class="view-toggle">
                <button class="view-btn active" id="gridViewBtn" onclick="setView('grid')" aria-label="Grid view">
                    <i class="fas fa-grid-2"></i>
                </button>
                <button class="view-btn" id="listViewBtn" onclick="setView('list')" aria-label="List view">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        <!-- Projects Grid -->
        @if($projects->count() > 0)
        <div class="projects-grid" id="projectsGrid">
            @foreach($projects as $project)
            <div class="project-card" data-title="{{ strtolower($project->title) }}" data-desc="{{ strtolower($project->description) }}">
                <div class="card-top">
                <div class="card-icon {{ ['green','cyan','amber','rose'][$loop->index % 4] }}">
                <i class="fas fa-{{ ['code','database','globe','rocket','palette','chart-line','cube','layer-group'][$loop->index % 8] }}"></i>
                    </div>
                    <div class="card-menu">
                        <button class="card-menu-btn" onclick="toggleDropdown(this)" aria-label="Menu">
                            <i class="fas fa-ellipsis-vertical"></i>
                        </button>
                        <div class="card-dropdown">
                            <a href="{{ route('user.projects.show', $project->id) }}" class="dropdown-item">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item danger" onclick="confirmDelete('{{ $project->title }}', '{{ route('user.projects.destroy', $project->id) }}')">
                                <i class="fas fa-trash-can"></i> Hapus Project
                            </button>
                        </div>
                    </div>
                </div>
                <h3 class="card-title">{{ $project->title }}</h3>
                <p class="card-description">{{ $project->description or 'Tidak ada deskripsi' }}</p>
                <div class="card-meta">
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        {{ $project->created_at->format('d M Y') }}
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-hashtag"></i>
                        #{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <h3>Belum ada project</h3>
            <p>Kamu belum membuat project apapun. Mulai buat project pertamamu dan kelola dengan mudah.</p>
            <a href="{{ route('user.projects.create') }}" class="btn-add" style="display:inline-flex">
                <i class="fas fa-plus"></i>
                Buat Project Pertama
            </a>
        </div>
        @endif
    </main>

    <!-- Modal Hapus -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon">
                <i class="fas fa-trash-can"></i>
            </div>
            <h3>Hapus Project</h3>
            <p>Apakah kamu yakin ingin menghapus <strong id="deleteProjectName"></strong>? Tindakan ini tidak bisa dibatalkan.</p>
            <form id="deleteForm" method="POST" class="modal-actions">
                @csrf
                @method('DELETE')
                <button type="button" class="btn-modal btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button type="submit" class="btn-modal btn-delete-confirm">Ya, Hapus</button>
            </form>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script>
        // === Dropdown menu ===
        function toggleDropdown(btn) {
            const dropdown = btn.nextElementSibling;
            // Tutup dropdown lain yang terbuka
            document.querySelectorAll('.card-dropdown.open').forEach(d => {
                if (d !== dropdown) d.classList.remove('open');
            });
            dropdown.classList.toggle('open');
        }

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.card-menu')) {
                document.querySelectorAll('.card-dropdown.open').forEach(d => d.classList.remove('open'));
            }
        });

        // === Modal Hapus ===
        function confirmDelete(name, url) {
            document.getElementById('deleteProjectName').textContent = name;
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.add('open');
            // Tutup dropdown
            document.querySelectorAll('.card-dropdown.open').forEach(d => d.classList.remove('open'));
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('open');
        }

        // Tutup modal saat klik overlay
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Tutup modal dengan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
                document.querySelectorAll('.card-dropdown.open').forEach(d => d.classList.remove('open'));
            }
        });

        // === View Toggle ===
        function setView(mode) {
            const grid = document.getElementById('projectsGrid');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            if (mode === 'list') {
                grid.classList.add('list-view');
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
            } else {
                grid.classList.remove('list-view');
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
            }
        }

        // === Search / Filter ===
        document.getElementById('searchInput').addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.project-card');

            cards.forEach(card => {
                const title = card.dataset.title || '';
                const desc = card.dataset.desc || '';
                const match = title.includes(query) || desc.includes(query);
                card.style.display = match ? '' : 'none';
            });
        });

        // === Toast notification ===
        function showToast(message, type) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast ' + type;
            const icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-xmark';
            toast.innerHTML = '<i class="fas ' + icon + '"></i><span>' + message + '</span>';
            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('removing');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // === Background particles ===
        (function createParticles() {
            const container = document.getElementById('particles');
            const count = 20;
            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                p.style.left = Math.random() * 100 + '%';
                p.style.width = (Math.random() * 3 + 1.5) + 'px';
                p.style.height = p.style.width;
                p.style.animationDuration = (Math.random() * 15 + 10) + 's';
                p.style.animationDelay = (Math.random() * 15) + 's';
                p.style.background = Math.random() > 0.5
                    ? 'rgba(16, 185, 129, 0.5)'
                    : 'rgba(6, 182, 212, 0.35)';
                container.appendChild(p);
            }
        })();
    </script>
</body>
</html>