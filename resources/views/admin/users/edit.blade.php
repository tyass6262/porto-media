<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna — {{ $user->name }}</title>
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

        /* User Profile Summary */
        .profile-summary {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 16px; padding: 20px 24px;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 18px;
            animation: fadeUp 0.4s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); filter: blur(2px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        .profile-avatar-large {
            width: 56px; height: 56px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; font-weight: 700; color: white; flex-shrink: 0;
            text-transform: uppercase;
        }
        .profile-info { flex: 1; min-width: 0; }
        .profile-name { font-size: 17px; font-weight: 700; color: var(--text-primary); }
        .profile-email { font-size: 13px; color: var(--text-muted); margin-top: 2px; }
        .profile-meta { display: flex; align-items: center; gap: 12px; margin-top: 6px; flex-wrap: wrap; }
        .profile-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 10px; border-radius: 6px;
            font-size: 12px; font-weight: 600;
        }
        .profile-badge .dot { width: 6px; height: 6px; border-radius: 50%; }
        @php
            $roleSlug = strtolower($user->role->slug ?? '');
            $roleClass = 'role-default';
            $roleLabel = ucfirst($roleSlug) ?: '-';
            if ($roleSlug === 'admin') { $roleClass = 'role-admin'; $roleLabel = 'Admin'; }
            elseif ($roleSlug === 'user') { $roleClass = 'role-user'; $roleLabel = 'User'; }
            elseif ($roleSlug === 'editor') { $roleClass = 'role-editor'; $roleLabel = 'Editor'; }
        @endphp
        .role-admin { background: var(--indigo-subtle); border: 1px solid rgba(129,140,248,0.15); color: var(--indigo); }
        .role-admin .dot { background: var(--indigo); }
        .role-user { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .role-user .dot { background: var(--accent); }
        .role-editor { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.15); color: var(--amber); }
        .role-editor .dot { background: var(--amber); }
        .role-default { background: rgba(255,255,255,0.03); border: 1px solid var(--input-border); color: var(--text-muted); }
        .role-default .dot { background: var(--text-muted); }
        .profile-date {
            font-size: 12px; color: var(--text-muted);
            display: flex; align-items: center; gap: 5px;
        }
        .profile-date i { font-size: 11px; opacity: 0.6; }

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
        .icon-amber { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.2); color: var(--amber); }
        .form-card-header span { font-size: 15px; font-weight: 700; color: var(--text-primary); }

        .field-group { margin-bottom: 22px; }
        .field-group:last-of-type { margin-bottom: 0; }
        .field-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-secondary); margin-bottom: 8px; letter-spacing: 0.3px;
        }
        .field-group label .required { color: var(--danger); margin-left: 2px; }
        .field-group label .optional {
            font-weight: 400; color: var(--text-muted); font-size: 12px;
            margin-left: 4px;
        }
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

        .toggle-password {
            position: absolute; right: 14px; background: none; border: none;
            color: var(--text-muted); cursor: pointer; font-size: 15px;
            padding: 4px; transition: color 0.2s; z-index: 2;
        }
        .toggle-password:hover { color: var(--text-secondary); }

        .strength-bar-container { display: flex; gap: 4px; margin-top: 8px; }
        .strength-segment {
            flex: 1; height: 3px; border-radius: 2px;
            background: rgba(255,255,255,0.06); transition: background 0.3s;
        }
        .strength-label { font-size: 11.5px; margin-top: 5px; color: var(--text-muted); transition: color 0.3s; min-height: 16px; }

        .field-hint {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; color: var(--text-muted); margin-top: 6px;
        }
        .field-hint i { font-size: 11px; }

        /* Optional section divider */
        .optional-divider {
            display: flex; align-items: center; gap: 16px;
            margin: 28px 0 24px;
        }
        .optional-divider::before,
        .optional-divider::after {
            content: ''; flex: 1; height: 1px; background: var(--card-border);
        }
        .optional-divider span {
            font-size: 12px; color: var(--text-muted); text-transform: uppercase;
            letter-spacing: 1px; font-weight: 500;
        }

        /* Form actions */
        .form-actions-row {
            display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px;
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
        .alert-success {
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.2);
            border-radius: 12px; padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: var(--accent-hover); animation: shakeIn 0.5s ease;
        }
        .alert-success i { color: var(--accent); font-size: 16px; flex-shrink: 0; }

        /* ==================== Responsive ==================== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .mobile-menu-btn { display: flex; }
            .page-content { padding: 20px 16px; }
            .form-card { padding: 24px 20px; }
            .page-header h1 { font-size: 22px; }
            .profile-summary { flex-direction: column; text-align: center; padding: 20px; }
            .profile-meta { justify-content: center; }
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
            <a href="{{ route('admin.categories.index') }}" class="nav-link">
                <i class="fas fa-tags"></i> Kategori
                <span class="link-badge green">{{ $categoryCount ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link active">
                <i class="fas fa-users"></i> Pengguna
                <span class="link-badge cyan">{{ $userCount ?? 0 }}</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-folder-open"></i> Semua Project
                <span class="link-badge amber">{{ $projectCount ?? 0 }}</span>
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
                <div class="breadcrumb-bar">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{ route('admin.users.index') }}">Pengguna</a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="current">{{ Str::limit($user->name, 25) }}</span>
                </div>
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

            <!-- Page Header -->
            <div class="page-header">
                <h1>Edit Pengguna</h1>
                <p>Perbarui informasi akun pengguna di bawah ini</p>
            </div>

            <!-- Profile Summary -->
            <div class="profile-summary">
                @php
                    $avatarColors = ['background: linear-gradient(135deg, #10b981, #059669)', 'background: linear-gradient(135deg, #06b6d4, #0891b2)', 'background: linear-gradient(135deg, #f59e0b, #d97706)', 'background: linear-gradient(135deg, #818cf8, #6366f1)', 'background: linear-gradient(135deg, #f43f5e, #e11d48)'];
                    $colorIdx = ord(substr($user->name, 0, 1)) % count($avatarColors);
                @endphp
                <div class="profile-avatar-large" style="{{ $avatarColors[$colorIdx] }}">
                    {{ substr($user->name, 0, 2) }}
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ $user->name }}</div>
                    <div class="profile-email">{{ $user->email }}</div>
                    <div class="profile-meta">
                        <span class="profile-badge {{ $roleClass }}">
                            <span class="dot"></span>
                            {{ $roleLabel }}
                        </span>
                        <span class="profile-date">
                            <i class="fas fa-calendar"></i>
                            Bergabung {{ $user->created_at->format('d M Y') }}
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

            <!-- Form: Data Akun -->
            <div class="form-card">
                <div class="form-card-header">
                    <i class="icon-green"><i class="fas fa-user-pen"></i></i>
                    <span>Informasi Akun</span>
                </div>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="userForm">
                    @csrf
                    @method('PUT')

                    <div class="field-group">
                        <label for="name">Nama Lengkap <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="field-input {{ $errors->has('name') ? 'input-error' : '' }}"
                                placeholder="Contoh: Budi Santoso"
                                value="{{ old('name', $user->name) }}"
                                required
                                maxlength="100"
                                autocomplete="name"
                            >
                        </div>
                        @if($errors->has('name'))
                        <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="field-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="field-input {{ $errors->has('email') ? 'input-error' : '' }}"
                                placeholder="nama@email.com"
                                value="{{ old('email', $user->email) }}"
                                required
                                maxlength="150"
                                autocomplete="email"
                            >
                        </div>
                        @if($errors->has('email'))
                        <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <!-- Divider: Password Opsional -->
                    <div class="optional-divider">
                        <span>Ubah Password</span>
                    </div>

                    <div class="field-group">
                        <label for="password">
                            Password Baru
                            <span class="optional">(kosongkan jika tidak diubah)</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-key input-icon"></i>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="field-input {{ $errors->has('password') ? 'input-error' : '' }}"
                                placeholder="Minimal 8 karakter"
                                minlength="8"
                                autocomplete="new-password"
                            >
                            <button type="button" class="toggle-password" aria-label="Toggle password" onclick="togglePassword('password', 'eyeIcon1')">
                                <i class="fas fa-eye" id="eyeIcon1"></i>
                            </button>
                        </div>
                        <div class="strength-bar-container" id="strengthContainer" style="opacity:0; transition:opacity 0.3s;">
                            <div class="strength-segment" id="seg1"></div>
                            <div class="strength-segment" id="seg2"></div>
                            <div class="strength-segment" id="seg3"></div>
                            <div class="strength-segment" id="seg4"></div>
                        </div>
                        <div class="strength-label" id="strengthLabel"></div>
                        @if($errors->has('password'))
                        <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="field-group" id="confirmGroup" style="opacity:0; transition:opacity 0.3s;">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="field-input"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password"
                            >
                            <button type="button" class="toggle-password" aria-label="Toggle password" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                                <i class="fas fa-eye" id="eyeIcon2"></i>
                            </button>
                        </div>
                        <div class="strength-label" id="matchLabel" style="color: var(--text-muted);"></div>
                    </div>

                    <div class="field-hint" style="margin-top: 4px;">
                        <i class="fas fa-circle-info"></i>
                        <span>Biarkan kolom password kosong jika tidak ingin mengubah password saat ini.</span>
                    </div>

                    <div class="form-actions-row">
                        <a href="{{ route('admin.users.index') }}" class="btn-cancel">
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
        // === Toggle Password ===
        function togglePassword(inputId, iconId) {
            var input = document.getElementById(inputId);
            var icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // === Password strength (tampil hanya saat diketik) ===
        var passwordInput = document.getElementById('password');
        var strengthContainer = document.getElementById('strengthContainer');
        var confirmGroup = document.getElementById('confirmGroup');
        var segments = [
            document.getElementById('seg1'),
            document.getElementById('seg2'),
            document.getElementById('seg3'),
            document.getElementById('seg4')
        ];
        var strengthLabel = document.getElementById('strengthLabel');
        var strengthLevels = [
            { label: '', color: '' },
            { label: 'Lemah', color: '#ef4444' },
            { label: 'Cukup', color: '#f59e0b' },
            { label: 'Kuat', color: '#10b981' },
            { label: 'Sangat Kuat', color: '#06b6d4' }
        ];

        function checkStrength(password) {
            var score = 0;
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
            if (/\d/.test(password)) score++;
            if (/[^a-zA-Z0-9]/.test(password)) score++;
            return score;
        }

        passwordInput.addEventListener('input', function() {
            var val = this.value;
            var hasInput = val.length > 0;

            // Tampilkan/sembunyikan strength bar dan confirm field
            strengthContainer.style.opacity = hasInput ? '1' : '0';
            confirmGroup.style.opacity = hasInput ? '1' : '0';

            if (hasInput) {
                var score = checkStrength(val);
                segments.forEach(function(seg, i) {
                    seg.style.background = i < score ? strengthLevels[score].color : 'rgba(255,255,255,0.06)';
                });
                strengthLabel.textContent = strengthLevels[score].label;
                strengthLabel.style.color = strengthLevels[score].color || 'var(--text-muted)';
            } else {
                segments.forEach(function(seg) { seg.style.background = 'rgba(255,255,255,0.06)'; });
                strengthLabel.textContent = '';
            }
            checkMatch();
        });

        // === Password Match ===
        var confirmInput = document.getElementById('password_confirmation');
        var matchLabel = document.getElementById('matchLabel');

        function checkMatch() {
            var pass = passwordInput.value;
            var confirm = confirmInput.value;
            if (!pass.length || !confirm.length) {
                matchLabel.textContent = '';
                confirmInput.classList.remove('input-error');
                return;
            }
            if (pass === confirm) {
                matchLabel.textContent = 'Password cocok';
                matchLabel.style.color = 'var(--accent)';
                confirmInput.classList.remove('input-error');
            } else {
                matchLabel.textContent = 'Password tidak cocok';
                matchLabel.style.color = 'var(--danger)';
                confirmInput.classList.add('input-error');
            }
        }
        confirmInput.addEventListener('input', checkMatch);

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

        // === Submit logic ===
        document.getElementById('userForm').addEventListener('submit', function(e) {
            var pass = passwordInput.value;
            var confirm = confirmInput.value;

            // Jika password diisi, validasi cocok dan kuat
            if (pass.length > 0) {
                if (pass !== confirm) {
                    e.preventDefault();
                    matchLabel.textContent = 'Password tidak cocok';
                    matchLabel.style.color = 'var(--danger)';
                    confirmInput.classList.add('input-error');
                    confirmInput.focus();
                    return;
                }
                if (checkStrength(pass) < 2) {
                    e.preventDefault();
                    strengthLabel.textContent = 'Password terlalu lemah';
                    strengthLabel.style.color = 'var(--danger)';
                    passwordInput.focus();
                    return;
                }
            }

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
    </script>
</body>
</html>