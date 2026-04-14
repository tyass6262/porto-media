<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #0a0f1a;
            --card-bg: rgba(17, 24, 39, 0.65);
            --card-border: rgba(255, 255, 255, 0.08);
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
            --danger: #ef4444;
            --danger-bg: rgba(239, 68, 68, 0.1);
            --amber: #f59e0b;
            --amber-subtle: rgba(245, 158, 11, 0.08);
            --rose: #f43f5e;
            --rose-subtle: rgba(244, 63, 94, 0.08);
            --indigo: #818cf8;
            --indigo-subtle: rgba(129, 140, 248, 0.08);
            --sidebar-w: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-primary);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* === Background === */
        .bg-layer {
            position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none;
        }
        .bg-layer::before {
            content: ''; position: absolute; top: -30%; right: -10%;
            width: 60vw; height: 60vw;
            background: radial-gradient(circle, rgba(16,185,129,0.05) 0%, transparent 70%);
            animation: floatBlob1 22s ease-in-out infinite;
        }
        .bg-layer::after {
            content: ''; position: absolute; bottom: -20%; left: 10%;
            width: 50vw; height: 50vw;
            background: radial-gradient(circle, rgba(6,182,212,0.04) 0%, transparent 70%);
            animation: floatBlob2 28s ease-in-out infinite;
        }
        @keyframes floatBlob1 {
            0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(-8%,10%) scale(1.08)}
        }
        @keyframes floatBlob2 {
            0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(10%,-8%) scale(1.05)}
        }
        .grid-pattern {
            position: fixed; inset: 0; z-index: 1; pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,.012) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.012) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at 70% 30%, black 20%, transparent 70%);
        }

        /* ============================
           SIDEBAR
        ============================ */
        .sidebar {
            position: fixed; left: 0; top: 0; bottom: 0;
            width: var(--sidebar-w); z-index: 100;
            background: rgba(10, 15, 26, 0.95);
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            border-right: 1px solid var(--card-border);
            display: flex; flex-direction: column;
            transition: transform 0.35s cubic-bezier(0.16,1,0.3,1);
        }
        .sidebar-header {
            padding: 24px 22px; border-bottom: 1px solid var(--card-border);
            display: flex; align-items: center; gap: 12px;
        }
        .sidebar-logo {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; color: white; flex-shrink: 0;
        }
        .sidebar-brand { font-size: 17px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; }
        .sidebar-badge {
            margin-left: auto; font-size: 10px; font-weight: 700;
            padding: 3px 8px; border-radius: 6px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.2);
            color: var(--accent); text-transform: uppercase; letter-spacing: 0.5px;
        }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 16px 12px; }
        .nav-section-title {
            font-size: 11px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 1.2px;
            padding: 16px 12px 8px; margin-top: 4px;
        }
        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: 10px;
            text-decoration: none; font-size: 13.5px; font-weight: 500;
            color: var(--text-muted); transition: all 0.2s;
            margin-bottom: 2px; position: relative;
        }
        .nav-link i { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
        .nav-link:hover { color: var(--text-secondary); background: rgba(255,255,255,0.03); }
        .nav-link.active { color: var(--accent); background: var(--accent-subtle); }
        .nav-link.active::before {
            content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            width: 3px; height: 20px; border-radius: 0 3px 3px 0; background: var(--accent);
        }
        .nav-link .link-badge {
            margin-left: auto; font-size: 11px; font-weight: 600;
            padding: 2px 8px; border-radius: 6px; min-width: 22px; text-align: center;
        }
        .link-badge.green { background: var(--accent-subtle); color: var(--accent); }
        .link-badge.cyan { background: rgba(6,182,212,0.08); color: var(--cyan); }
        .link-badge.amber { background: var(--amber-subtle); color: var(--amber); }

        .sidebar-footer { padding: 16px 12px; border-top: 1px solid var(--card-border); }
        .sidebar-user {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 12px; background: rgba(255,255,255,0.03);
        }
        .sidebar-avatar {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: white; font-weight: 700; flex-shrink: 0;
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name {
            font-size: 13px; font-weight: 600; color: var(--text-primary);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-role { font-size: 11.5px; color: var(--text-muted); }

        .logout-btn {
            background: none; border: none; cursor: pointer;
            padding: 8px; border-radius: 8px;
            color: var(--text-muted); font-size: 15px;
            transition: all 0.2s; display: flex;
            align-items: center; justify-content: center;
        }
        .logout-btn:hover { color: var(--danger); background: var(--danger-bg); }

        /* ============================
           MAIN
        ============================ */
        .main-wrapper {
            flex: 1; margin-left: var(--sidebar-w);
            position: relative; z-index: 10;
            min-height: 100vh; display: flex; flex-direction: column;
        }
        .topbar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(10,15,26,0.75);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--card-border);
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .mobile-menu-btn {
            display: none; width: 38px; height: 38px; border-radius: 10px;
            background: rgba(255,255,255,0.04); border: 1px solid var(--input-border);
            color: var(--text-muted); cursor: pointer; font-size: 16px;
            align-items: center; justify-content: center; transition: all 0.2s;
        }
        .mobile-menu-btn:hover { color: var(--text-primary); background: rgba(255,255,255,0.07); }
        .topbar-title { font-size: 16px; font-weight: 700; color: var(--text-primary); }
        .topbar-right { display: flex; align-items: center; gap: 8px; }
        .topbar-btn {
            width: 38px; height: 38px; border-radius: 10px;
            background: rgba(255,255,255,0.04); border: 1px solid var(--input-border);
            color: var(--text-muted); cursor: pointer; font-size: 14px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s; position: relative;
        }
        .topbar-btn:hover { color: var(--text-primary); background: rgba(255,255,255,0.07); }
        .topbar-btn .notif-dot {
            position: absolute; top: 7px; right: 7px;
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--danger); border: 2px solid var(--bg-primary);
        }

        /* Page Content */
        .page-content { flex: 1; padding: 32px; }

        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, rgba(16,185,129,0.12) 0%, rgba(6,182,212,0.08) 100%);
            border: 1px solid rgba(16,185,129,0.15);
            border-radius: 20px; padding: 36px 40px;
            margin-bottom: 28px; position: relative; overflow: hidden;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); filter: blur(2px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        .welcome-banner::before {
            content: ''; position: absolute; top: -60px; right: -40px;
            width: 240px; height: 240px;
            background: radial-gradient(circle, rgba(16,185,129,0.12), transparent 70%);
            border-radius: 50%;
        }
        .welcome-banner::after {
            content: ''; position: absolute; bottom: -80px; right: 80px;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(6,182,212,0.1), transparent 70%);
            border-radius: 50%;
        }
        .welcome-content { position: relative; z-index: 2; }
        .welcome-content h1 {
            font-size: 26px; font-weight: 800; color: var(--text-primary);
            letter-spacing: -0.5px; margin-bottom: 8px;
        }
        .welcome-content h1 span { color: var(--accent); }
        .welcome-content p { font-size: 14.5px; color: var(--text-secondary); line-height: 1.6; max-width: 540px; }
        .welcome-decoration {
            position: absolute; right: 40px; top: 50%; transform: translateY(-50%);
            font-size: 100px; opacity: 0.04; color: var(--accent); pointer-events: none;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 16px; margin-bottom: 28px;
        }
        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 16px; padding: 22px;
            transition: all 0.3s; position: relative; overflow: hidden;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        .stat-card:nth-child(1) { animation-delay: 0.06s; }
        .stat-card:nth-child(2) { animation-delay: 0.12s; }
        .stat-card:nth-child(3) { animation-delay: 0.18s; }
        .stat-card:nth-child(4) { animation-delay: 0.24s; }
        .stat-card:hover {
            border-color: rgba(255,255,255,0.12);
            transform: translateY(-3px);
            box-shadow: 0 8px 28px -4px rgba(0,0,0,0.3);
        }
        .stat-card::after {
            content: ''; position: absolute; top: 0; right: 0;
            width: 80px; height: 80px; border-radius: 50%;
            filter: blur(40px); opacity: 0.4; pointer-events: none;
        }
        .stat-card.green::after { background: var(--accent); }
        .stat-card.cyan::after { background: var(--cyan); }
        .stat-card.amber::after { background: var(--amber); }
        .stat-card.rose::after { background: var(--rose); }

        .stat-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }
        .stat-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 17px;
        }
        .stat-icon.green { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .stat-icon.cyan { background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.15); color: var(--cyan); }
        .stat-icon.amber { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.15); color: var(--amber); }
        .stat-icon.rose { background: var(--rose-subtle); border: 1px solid rgba(244,63,94,0.15); color: var(--rose); }

        .stat-trend {
            font-size: 12px; font-weight: 600; padding: 3px 8px; border-radius: 6px;
            display: flex; align-items: center; gap: 4px;
        }
        .stat-trend.up { background: var(--accent-subtle); color: var(--accent); }
        .stat-trend.down { background: var(--rose-subtle); color: var(--rose); }
        .stat-trend i { font-size: 10px; }

        .stat-value {
            font-size: 28px; font-weight: 800; color: var(--text-primary);
            letter-spacing: -0.5px; margin-bottom: 4px;
        }
        .stat-label { font-size: 13px; color: var(--text-muted); }

        /* Quick Actions */
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 18px;
        }
        .section-header h2 {
            font-size: 18px; font-weight: 700; color: var(--text-primary); letter-spacing: -0.3px;
        }
        .section-header a {
            font-size: 13px; font-weight: 600; color: var(--accent);
            text-decoration: none; transition: color 0.2s;
        }
        .section-header a:hover { color: var(--accent-hover); text-decoration: underline; }

        .quick-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 28px; }
        .quick-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 16px; padding: 24px;
            text-decoration: none; transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            position: relative; overflow: hidden;
            display: flex; flex-direction: column; gap: 14px;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        .quick-card:nth-child(1) { animation-delay: 0.3s; }
        .quick-card:nth-child(2) { animation-delay: 0.36s; }
        .quick-card:nth-child(3) { animation-delay: 0.42s; }
        .quick-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            opacity: 0; transition: opacity 0.3s;
        }
        .quick-card:nth-child(1)::before { background: linear-gradient(90deg, var(--accent), var(--cyan)); }
        .quick-card:nth-child(2)::before { background: linear-gradient(90deg, var(--cyan), var(--indigo)); }
        .quick-card:nth-child(3)::before { background: linear-gradient(90deg, var(--amber), var(--rose)); }
        .quick-card:hover {
            border-color: rgba(255,255,255,0.14);
            transform: translateY(-4px);
            box-shadow: 0 12px 36px -8px rgba(0,0,0,0.4);
        }
        .quick-card:hover::before { opacity: 1; }

        .quick-card-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center; font-size: 20px;
        }
        .quick-card:nth-child(1) .quick-card-icon { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .quick-card:nth-child(2) .quick-card-icon { background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.15); color: var(--cyan); }
        .quick-card:nth-child(3) .quick-card-icon { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.15); color: var(--amber); }

        .quick-card-title { font-size: 15px; font-weight: 700; color: var(--text-primary); }
        .quick-card-desc { font-size: 13px; color: var(--text-muted); line-height: 1.5; }
        .quick-card-arrow {
            margin-top: auto; display: flex; align-items: center; gap: 6px;
            font-size: 12.5px; font-weight: 600; color: var(--text-muted); transition: all 0.25s;
        }
        .quick-card:hover .quick-card-arrow { color: var(--accent); gap: 10px; }

        /* Activity List */
        .activity-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 16px; padding: 28px;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
            animation-delay: 0.48s;
        }
        .activity-list { display: flex; flex-direction: column; }
        .activity-item {
            display: flex; align-items: flex-start; gap: 14px;
            padding: 14px 0; border-bottom: 1px solid var(--card-border);
        }
        .activity-item:last-child { border-bottom: none; padding-bottom: 0; }
        .activity-item:first-child { padding-top: 0; }

        .activity-dot {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; flex-shrink: 0; margin-top: 2px;
        }
        .activity-dot.green { background: var(--accent-subtle); color: var(--accent); }
        .activity-dot.cyan { background: rgba(6,182,212,0.08); color: var(--cyan); }
        .activity-dot.amber { background: var(--amber-subtle); color: var(--amber); }
        .activity-dot.rose { background: var(--rose-subtle); color: var(--rose); }
        .activity-dot.indigo { background: var(--indigo-subtle); color: var(--indigo); }

        .activity-info { flex: 1; min-width: 0; }
        .activity-text { font-size: 13.5px; color: var(--text-secondary); line-height: 1.5; }
        .activity-text strong { color: var(--text-primary); font-weight: 600; }
        .activity-time { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

        /* Session alerts */
        .session-alert { margin-bottom: 20px; }
        .alert-custom {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px; padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: #fca5a5; animation: shakeIn 0.5s ease;
        }
        .alert-custom i { color: var(--danger); font-size: 16px; flex-shrink: 0; }
        .alert-success {
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.2);
            border-radius: 12px; padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: var(--accent-hover); animation: shakeIn 0.5s ease;
        }
        .alert-success i { color: var(--accent); font-size: 16px; flex-shrink: 0; }
        @keyframes shakeIn {
            0%{opacity:0;transform:translateX(-10px)} 25%{transform:translateX(6px)} 50%{transform:translateX(-4px)} 75%{transform:translateX(2px)} 100%{opacity:1;transform:translateX(0)}
        }

        /* Sidebar overlay */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0; z-index: 90;
            background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
        }
        .sidebar-overlay.open { display: block; }

        /* === Responsive === */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .quick-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .mobile-menu-btn { display: flex; }
            .page-content { padding: 20px 16px; }
            .welcome-banner { padding: 28px 24px; }
            .welcome-content h1 { font-size: 22px; }
            .welcome-decoration { display: none; }
            .stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            .stat-card { padding: 18px; }
            .stat-value { font-size: 22px; }
            .topbar { padding: 0 16px; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
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

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><i class="fas fa-shield-halved"></i></div>
            <span class="sidebar-brand">MyApp</span>
            <span class="sidebar-badge">Admin</span>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="fas fa-table-cells"></i> Dashboard
            </a>

            <div class="nav-section-title">Manajemen</div>
            <a href="{{ route('admin.categories.index') }}" class="nav-link">
                <i class="fas fa-tags"></i> Kategori
                <span class="link-badge green">{{ $categoryCount ?? 0 }}</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i> Pengguna
                <span class="link-badge cyan">{{ $userCount ?? 0 }}</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-folder-open"></i> Semua Project
                <span class="link-badge amber">{{ $projectCount ?? 0 }}</span>
            </a>

            <div class="nav-section-title">Laporan</div>
            <a href="#" class="nav-link">
                <i class="fas fa-chart-pie"></i> Statistik
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-file-export"></i> Ekspor Data
            </a>

            <div class="nav-section-title">Sistem</div>
            <a href="#" class="nav-link">
                <i class="fas fa-gear"></i> Pengaturan
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">A</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ optional(auth()->user())->name ?? 'Admin' }}</div>
                    <div class="sidebar-user-role">Super Admin</div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout" aria-label="Logout">
                        <i class="fas fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ==================== MAIN ==================== -->
    <div class="main-wrapper">

        <header class="topbar">
            <div class="topbar-left">
                <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="topbar-title">Dashboard</span>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn" title="Notifikasi" aria-label="Notifikasi">
                    <i class="fas fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <button class="topbar-btn" title="Pengaturan" aria-label="Pengaturan">
                    <i class="fas fa-gear"></i>
                </button>
            </div>
        </header>

        <div class="page-content">

            <!-- Session alerts -->
            @if(session('success'))
            <div class="session-alert">
                <div class="alert-success">
                    <i class="fas fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="session-alert">
                <div class="alert-custom">
                    <i class="fas fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif

            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="welcome-content">
                    <h1>Selamat datang, <span>{{ optional(auth()->user())->name ?? 'Admin' }}</span></h1>
                    <p>Pantau aktivitas platform dan kelola semua data dari satu tempat. Berikut ringkasan hari ini.</p>
                </div>
                <div class="welcome-decoration"><i class="fas fa-chart-line"></i></div>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card green">
                    <div class="stat-top">
                        <div class="stat-icon green"><i class="fas fa-users"></i></div>
                        <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 12%</span>
                    </div>
                    <div class="stat-value">{{ $userCount ?? 0 }}</div>
                    <div class="stat-label">Total Pengguna</div>
                </div>
                <div class="stat-card cyan">
                    <div class="stat-top">
                        <div class="stat-icon cyan"><i class="fas fa-folder-open"></i></div>
                        <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 8%</span>
                    </div>
                    <div class="stat-value">{{ $projectCount ?? 0 }}</div>
                    <div class="stat-label">Total Project</div>
                </div>
                <div class="stat-card amber">
                    <div class="stat-top">
                        <div class="stat-icon amber"><i class="fas fa-tags"></i></div>
                        <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 3%</span>
                    </div>
                    <div class="stat-value">{{ $categoryCount ?? 0 }}</div>
                    <div class="stat-label">Kategori</div>
                </div>
                <div class="stat-card rose">
                    <div class="stat-top">
                        <div class="stat-icon rose"><i class="fas fa-image"></i></div>
                        <span class="stat-trend down"><i class="fas fa-arrow-down"></i> 2%</span>
                    </div>
                    <div class="stat-value">{{ $mediaCount ?? 0 }}</div>
                    <div class="stat-label">Media Diunggah</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="section-header">
                <h2>Aksi Cepat</h2>
            </div>
            <div class="quick-grid">
                <a href="{{ route('admin.categories.index') }}" class="quick-card">
                    <div class="quick-card-icon"><i class="fas fa-tags"></i></div>
                    <div class="quick-card-title">Kelola Kategori</div>
                    <div class="quick-card-desc">Tambah, edit, atau hapus kategori project yang tersedia.</div>
                    <div class="quick-card-arrow">Buka halaman <i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="#" class="quick-card">
                    <div class="quick-card-icon"><i class="fas fa-users-gear"></i></div>
                    <div class="quick-card-title">Kelola Pengguna</div>
                    <div class="quick-card-desc">Atur hak akses, verifikasi, dan kelola akun pengguna.</div>
                    <div class="quick-card-arrow">Buka halaman <i class="fas fa-arrow-right"></i></div>
                </a>
                <a href="#" class="quick-card">
                    <div class="quick-card-icon"><i class="fas fa-file-export"></i></div>
                    <div class="quick-card-title">Ekspor Laporan</div>
                    <div class="quick-card-desc">Unduh data project dan pengguna dalam format CSV atau PDF.</div>
                    <div class="quick-card-arrow">Buka halaman <i class="fas fa-arrow-right"></i></div>
                </a>
            </div>

            <!-- Recent Activity -->
            <div class="section-header">
                <h2>Aktivitas Terbaru</h2>
                <a href="#">Lihat semua</a>
            </div>
            <div class="activity-card">
                <div class="activity-list">

                    @php
                        $dotColors = ['green','cyan','amber','rose','indigo'];
                    @endphp

                    @if(isset($recentActivities) && $recentActivities->count() > 0)
                        @foreach($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="activity-dot {{ $dotColors[$loop->index % count($dotColors)] }}">
                                <i class="fas fa-{{ $activity['icon'] ?? 'circle' }}"></i>
                            </div>
                            <div class="activity-info">
                                <div class="activity-text">{!! $activity['text'] !!}</div>
                                <div class="activity-time">{{ $activity['time'] ?? '' }}</div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="activity-item">
                            <div class="activity-dot green">
                                <i class="fas fa-circle-info"></i>
                            </div>
                            <div class="activity-info">
                                <div class="activity-text">Belum ada aktivitas terbaru untuk ditampilkan.</div>
                                <div class="activity-time">Aktivitas akan muncul saat ada perubahan data.</div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <script>
        // === Sidebar toggle ===
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('open');
            }
        });

        // === Counter animation ===
        function animateCounters() {
            document.querySelectorAll('.stat-value').forEach(function(el) {
                var target = parseInt(el.textContent.replace(/[^0-9]/g, ''));
                if (isNaN(target) || target === 0) return;
                var duration = 800;
                var start = performance.now();
                el.textContent = '0';

                function step(now) {
                    var progress = Math.min((now - start) / duration, 1);
                    var ease = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(target * ease).toLocaleString('id-ID');
                    if (progress < 1) requestAnimationFrame(step);
                    else el.textContent = target.toLocaleString('id-ID');
                }
                requestAnimationFrame(step);
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', animateCounters);
        } else {
            animateCounters();
        }

        // === Auto-hide session alerts ===
        setTimeout(function() {
            document.querySelectorAll('.session-alert').forEach(function(el) {
                el.style.transition = 'all 0.4s ease';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(function() { el.remove(); }, 400);
            });
        }, 5000);
    </script>
</body>
</html>