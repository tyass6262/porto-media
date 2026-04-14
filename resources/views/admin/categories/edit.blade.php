<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori — {{ $category->name }}</title>
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
            --input-focus: rgba(16, 185, 129, 0.4);
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

        /* ==================== SIDEBAR ==================== */
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
        .sidebar-user-name { font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-role { font-size: 11.5px; color: var(--text-muted); }
        .logout-btn {
            background: none; border: none; cursor: pointer;
            padding: 8px; border-radius: 8px;
            color: var(--text-muted); font-size: 15px;
            transition: all 0.2s; display: flex;
            align-items: center; justify-content: center;
        }
        .logout-btn:hover { color: var(--danger); background: var(--danger-bg); }
        .sidebar-overlay {
            display: none; position: fixed; inset: 0; z-index: 90;
            background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
        }
        .sidebar-overlay.open { display: block; }

        /* ==================== MAIN ==================== */
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
        .breadcrumb-bar { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-muted); }
        .breadcrumb-bar a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .breadcrumb-bar a:hover { color: var(--accent); }
        .breadcrumb-bar i { font-size: 10px; opacity: 0.5; }
        .breadcrumb-bar .current { color: var(--text-secondary); font-weight: 500; }

        .page-content { flex: 1; padding: 32px; }

        .page-header { margin-bottom: 28px; }
        .page-header h1 { font-size: 26px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; margin-bottom: 6px; }
        .page-header p { font-size: 14.5px; color: var(--text-muted); }

        /* Info Summary */
        .info-summary {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 16px; padding: 18px 24px;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 16px;
            animation: fadeUp 0.4s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); filter: blur(2px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        .info-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 18px;
            flex-shrink: 0;
        }
        @php
            $catColors = [
                'background:var(--accent-subtle);border:1px solid rgba(16,185,129,0.15);color:var(--accent)',
                'background:rgba(6,182,212,0.08);border:1px solid rgba(6,182,212,0.15);color:var(--cyan)',
                'background:var(--amber-subtle);border:1px solid rgba(245,158,11,0.15);color:var(--amber)',
                'background:var(--rose-subtle);border:1px solid rgba(244,63,94,0.15);color:var(--rose)',
                'background:var(--indigo-subtle);border:1px solid rgba(129,140,248,0.15);color:var(--indigo)',
            ];
            $colorIdx = ord(substr($category->name, 0, 1)) % count($catColors);
        @endphp
        .info-detail { flex: 1; min-width: 0; }
        .info-name { font-size: 16px; font-weight: 700; color: var(--text-primary); }
        .info-meta { display: flex; align-items: center; gap: 14px; margin-top: 5px; flex-wrap: wrap; }
        .info-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 6px;
            font-size: 12px; font-weight: 600; font-family: 'Courier New', monospace;
            background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.15); color: var(--cyan);
        }
        .info-badge .dot { width: 5px; height: 5px; border-radius: 50%; background: var(--cyan); }
        .status-badge-inline {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 6px;
            font-size: 12px; font-weight: 600;
        }
        .status-badge-inline .dot { width: 5px; height: 5px; border-radius: 50%; }
        .s-active { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .s-active .dot { background: var(--accent); }
        .s-inactive { background: rgba(255,255,255,0.03); border: 1px solid var(--input-border); color: var(--text-muted); }
        .s-inactive .dot { background: var(--text-muted); }
        .info-projects {
            font-size: 12px; color: var(--text-muted);
            display: flex; align-items: center; gap: 5px;
        }
        .info-projects i { font-size: 11px; opacity: 0.6; }

        /* Form Card */
        .form-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px; padding: 36px;
            margin-bottom: 20px;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
            animation-delay: 0.08s;
        }
        .form-card-header {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 28px;
        }
        .form-card-header i {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 15px;
        }
        .icon-green { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.2); color: var(--accent); }
        .form-card-header span { font-size: 15px; font-weight: 700; color: var(--text-primary); }

        .field-group { margin-bottom: 22px; }
        .field-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-secondary); margin-bottom: 8px; letter-spacing: 0.3px;
        }
        .field-group label .required { color: var(--danger); margin-left: 2px; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper .input-icon {
            position: absolute; left: 16px; font-size: 14px;
            color: var(--text-muted); transition: color 0.3s; pointer-events: none; z-index: 2;
        }
        .field-input {
            width: 100%; padding: 13px 16px 13px 46px;
            background: var(--input-bg); border: 1.5px solid var(--input-border);
            border-radius: 12px; color: var(--text-primary);
            font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s; outline: none;
        }
        .field-input::placeholder { color: var(--text-muted); font-size: 13.5px; }
        .field-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--input-focus), 0 0 20px -4px var(--accent-glow);
            background: rgba(15,23,42,1);
        }
        .field-input.input-error { border-color: var(--danger); box-shadow: 0 0 0 3px rgba(239,68,68,0.12); }
        .field-error { font-size: 12px; color: #fca5a5; margin-top: 6px; display: flex; align-items: center; gap: 6px; }
        .field-error i { font-size: 11px; }

        /* Slug preview */
        .slug-preview {
            margin-top: 24px; padding: 18px 20px;
            background: rgba(6,182,212,0.04);
            border: 1px solid rgba(6,182,212,0.12);
            border-radius: 14px;
            display: flex; align-items: center; gap: 14px;
            transition: all 0.3s;
        }
        .slug-preview.has-value { border-color: rgba(6,182,212,0.25); }
        .slug-preview-changed {
            border-color: rgba(245,158,11,0.3) !important;
            background: rgba(245,158,11,0.04) !important;
        }
        .slug-preview-icon {
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(6,182,212,0.1); border: 1px solid rgba(6,182,212,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: var(--cyan); flex-shrink: 0;
            transition: all 0.3s;
        }
        .slug-preview-changed .slug-preview-icon {
            background: var(--amber-subtle); border-color: rgba(245,158,11,0.15); color: var(--amber);
        }
        .slug-preview-info { flex: 1; min-width: 0; }
        .slug-preview-label { font-size: 11.5px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; display: flex; align-items: center; gap: 8px; }
        .slug-change-badge {
            font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 4px;
            background: var(--amber-subtle); color: var(--amber); text-transform: uppercase; letter-spacing: 0.3px;
            display: none;
        }
        .slug-preview-changed .slug-change-badge { display: inline-flex; }
        .slug-preview-value {
            font-size: 14px; font-weight: 600; color: var(--cyan);
            font-family: 'Courier New', monospace;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            transition: color 0.3s;
        }
        .slug-preview-changed .slug-preview-value { color: var(--amber); }

        .slug-hint {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; color: var(--text-muted); margin-top: 6px;
        }
        .slug-hint i { font-size: 11px; }

        /* Form actions */
        .form-actions-row {
            display: flex; justify-content: flex-end; gap: 12px; margin-top: 28px;
            padding-top: 24px; border-top: 1px solid var(--card-border);
        }
        .btn-cancel {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 24px; border-radius: 12px;
            background: rgba(255,255,255,0.04); border: 1.5px solid var(--input-border);
            color: var(--text-secondary); font-size: 14px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.25s; text-decoration: none;
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.07); color: var(--text-primary); border-color: rgba(255,255,255,0.15); }
        .btn-submit {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 28px; border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: white; border: none;
            font-size: 14px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.3s;
            position: relative; overflow: hidden;
        }
        .btn-submit::before {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 28px var(--accent-glow); }
        .btn-submit:hover::before { left: 100%; }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        /* Validation errors */
        .validation-errors {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px; padding: 16px 20px; margin-bottom: 24px;
            animation: shakeIn 0.5s ease;
        }
        .validation-errors .error-title {
            font-size: 13px; font-weight: 700; color: #fca5a5; margin-bottom: 8px;
            display: flex; align-items: center; gap: 8px;
        }
        .validation-errors .error-title i { font-size: 14px; }
        .validation-errors ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px; }
        .validation-errors ul li { font-size: 13px; color: #fca5a5; padding-left: 20px; position: relative; }
        .validation-errors ul li::before {
            content: ''; position: absolute; left: 4px; top: 50%;
            width: 5px; height: 5px; border-radius: 50%; background: var(--danger);
            transform: translateY(-50%);
        }
        @keyframes shakeIn {
            0%{opacity:0;transform:translateX(-10px)} 25%{transform:translateX(6px)} 50%{transform:translateX(-4px)} 75%{transform:translateX(2px)} 100%{opacity:1;transform:translateX(0)}
        }

        /* Session alerts */
        .session-alert { margin-bottom: 20px; }
        .alert-custom {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px; padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: #fca5a5; animation: shakeIn 0.5s ease;
        }
        .alert-custom i { color: var(--danger); font-size: 16px; flex-shrink: 0; }
        .alert-success-custom {
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.2);
            border-radius: 12px; padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: var(--accent-hover); animation: shakeIn 0.5s ease;
        }
        .alert-success-custom i { color: var(--accent); font-size: 16px; flex-shrink: 0; }

        /* ==================== Responsive ==================== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .mobile-menu-btn { display: flex; }
            .page-content { padding: 20px 16px; }
            .form-card { padding: 24px 20px; }
            .page-header h1 { font-size: 22px; }
            .info-summary { flex-direction: column; text-align: center; padding: 16px; }
            .info-meta { justify-content: center; }
            .form-actions-row { flex-direction: column; }
            .form-actions-row a, .form-actions-row button { width: 100%; justify-content: center; text-align: center; }
            .btn-cancel, .btn-submit { padding: 12px 16px; }
            .topbar { padding: 0 16px; }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="fas fa-table-cells"></i> Dashboard
            </a>
            <div class="nav-section-title">Manajemen</div>
            <a href="{{ route('admin.categories.index') }}" class="nav-link active">
                <i class="fas fa-tags"></i> Kategori
                <span class="link-badge green">{{ $categoryCount ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="fas fa-users"></i> Pengguna
                <span class="link-badge cyan">{{ $userCount ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link">
                <i class="fas fa-folder-open"></i> Semua Project
                <span class="link-badge amber">{{ $projectCount ?? 0 }}</span>
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
                <div class="breadcrumb-bar">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{ route('admin.categories.index') }}">Kategori</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">{{ Str::limit($category->name, 25) }}</span>
                </div>
            </div>
        </header>

        <div class="page-content">

            @if(session('success'))
            <div class="session-alert">
                <div class="alert-success-custom">
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

            <!-- Page Header -->
            <div class="page-header">
                <h1>Edit Kategori</h1>
                <p>Perbarui nama kategori. Slug akan otomatis menyesuaikan.</p>
            </div>

            <!-- Info Summary -->
            <div class="info-summary">
                <div class="info-icon" style="{{ $catColors[$colorIdx] }}">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="info-detail">
                    <div class="info-name">{{ $category->name }}</div>
                    <div class="info-meta">
                        <span class="info-badge"><span class="dot"></span>{{ $category->slug }}</span>
                        <span class="status-badge-inline {{ $category->is_active ? 's-active' : 's-inactive' }}">
                            <span class="dot"></span>
                            {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <span class="info-projects">
                            <i class="fas fa-folder"></i>
                            {{ $category->projects_count }} project
                        </span>
                    </div>
                </div>
            </div>

            <!-- Validation Errors -->
            @if($errors->any())
            <div class="validation-errors">
                <div class="error-title">
                    <i class="fas fa-triangle-exclamation"></i>
                    Mohon perbaiki {{ $errors->count() }} kesalahan berikut
                </div>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form -->
            <div class="form-card">
                <div class="form-card-header">
                    <i class="icon-green"><i class="fas fa-pen-to-square"></i></i>
                    <span>Perbarui Nama</span>
                </div>

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')

                    <div class="field-group">
                        <label for="name">Nama Kategori <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-tag input-icon"></i>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="field-input {{ $errors->has('name') ? 'input-error' : '' }}"
                                placeholder="Contoh: Web Development"
                                value="{{ old('name', $category->name) }}"
                                required
                                maxlength="60"
                                autocomplete="off"
                            >
                        </div>
                        @if($errors->has('name'))
                        <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <!-- Slug Preview -->
                    <div class="slug-preview has-value" id="slugPreview">
                        <div class="slug-preview-icon"><i class="fas fa-link"></i></div>
                        <div class="slug-preview-info">
                            <div class="slug-preview-label">
                                Slug Preview
                                <span class="slug-change-badge" id="slugChangeBadge">Berubah</span>
                            </div>
                            <div class="slug-preview-value" id="slugPreviewValue">{{ $category->slug }}</div>
                        </div>
                    </div>

                    <div class="slug-hint">
                        <i class="fas fa-circle-info"></i>
                        <span>Slug akan otomatis diperbarui saat nama diubah. Jika slug sudah ada, sistem akan menambahkan angka di akhir.</span>
                    </div>

                    <div class="form-actions-row">
                        <a href="{{ route('admin.categories.index') }}" class="btn-cancel">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn-submit" id="btnSubmit">
                            <i class="fas fa-check"></i>
                            <span id="btnText">Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        // === Slug preview with change detection ===
        var nameInput = document.getElementById('name');
        var slugPreview = document.getElementById('slugPreview');
        var slugPreviewValue = document.getElementById('slugPreviewValue');
        var slugChangeBadge = document.getElementById('slugChangeBadge');
        var originalSlug = '{{ $category->slug }}';

        function toSlug(text) {
            return text
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }

        nameInput.addEventListener('input', function() {
            var val = this.value.trim();
            var newSlug = val.length > 0 ? toSlug(val) : originalSlug;

            slugPreviewValue.textContent = newSlug;

            // Deteksi apakah slug berubah dari aslinya
            if (newSlug !== originalSlug) {
                slugPreview.classList.add('slug-preview-changed');
                slugPreview.classList.remove('has-value');
            } else {
                slugPreview.classList.remove('slug-preview-changed');
                slugPreview.classList.add('has-value');
            }
        });

        // === Focus glow ===
        document.querySelectorAll('.input-wrapper .field-input').forEach(function(input) {
            input.addEventListener('focus', function() {
                var icon = input.closest('.input-wrapper').querySelector('.input-icon');
                if (icon) icon.style.color = 'var(--accent)';
            });
            input.addEventListener('blur', function() {
                var icon = input.closest('.input-wrapper').querySelector('.input-icon');
                if (icon) icon.style.color = '';
            });
        });

        // === Loading state ===
        document.getElementById('editForm').addEventListener('submit', function() {
            var btn = document.getElementById('btnSubmit');
            var txt = document.getElementById('btnText');
            btn.disabled = true;
            txt.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:6px"></i>Menyimpan...';
        });

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

        // === Auto-hide alerts ===
        setTimeout(function() {
            document.querySelectorAll('.session-alert').forEach(function(el) {
                el.style.transition = 'all 0.4s ease';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(function() { el.remove(); }, 400);
            });
        }, 5000);

        // === Auto-focus ===
        nameInput.focus();
        nameInput.select();
    </script>
</body>
</html>