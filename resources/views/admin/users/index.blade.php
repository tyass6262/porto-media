<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
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

        /* Page Header */
        .page-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 28px; gap: 16px; flex-wrap: wrap;
        }
        .page-header h1 { font-size: 26px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; margin-bottom: 4px; }
        .page-header p { font-size: 14px; color: var(--text-muted); }
        .count-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15);
            color: var(--accent); font-size: 12.5px; font-weight: 600;
            padding: 4px 12px; border-radius: 20px; margin-top: 8px;
        }
        .btn-add {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 11px 22px; border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: white; border: none;
            font-size: 13.5px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.3s;
            text-decoration: none; position: relative; overflow: hidden;
        }
        .btn-add::before {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 6px 24px var(--accent-glow); }
        .btn-add:hover::before { left: 100%; }
        .btn-add:active { transform: translateY(0); }

        /* Toolbar */
        .toolbar {
            display: flex; align-items: center; gap: 12px; margin-bottom: 18px; flex-wrap: wrap;
        }
        .search-box { flex: 1; min-width: 200px; position: relative; }
        .search-box i {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 14px; pointer-events: none; transition: color 0.3s;
        }
        .search-box input {
            width: 100%; padding: 11px 14px 11px 42px;
            background: var(--input-bg); border: 1.5px solid var(--input-border);
            border-radius: 10px; color: var(--text-primary);
            font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none; transition: all 0.3s;
        }
        .search-box input::placeholder { color: var(--text-muted); }
        .search-box input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--input-focus); }
        .search-box input:focus + i { color: var(--accent); }

        .filter-chips { display: flex; gap: 6px; }
        .filter-chip {
            padding: 9px 16px; border-radius: 10px;
            background: rgba(255,255,255,0.04); border: 1.5px solid var(--input-border);
            color: var(--text-muted); font-size: 13px; font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.2s;
        }
        .filter-chip:hover { color: var(--text-secondary); background: rgba(255,255,255,0.06); }
        .filter-chip.active { background: var(--accent-subtle); border-color: rgba(16,185,129,0.25); color: var(--accent); font-weight: 600; }

        /* Table Card */
        .table-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px; overflow: hidden;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
            animation-delay: 0.1s;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); filter: blur(2px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: rgba(255,255,255,0.02); }
        th {
            padding: 14px 20px; text-align: left;
            font-size: 12px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.8px;
            border-bottom: 1px solid var(--card-border);
            white-space: nowrap;
        }
        td {
            padding: 16px 20px; font-size: 14px;
            border-bottom: 1px solid var(--card-border);
            color: var(--text-secondary); vertical-align: middle;
        }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(255,255,255,0.02); }
        tbody tr:last-child td { border-bottom: none; }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: 14px; }
        .user-avatar {
            width: 40px; height: 40px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: white; flex-shrink: 0;
            text-transform: uppercase;
        }
        .avatar-colors-0 { background: linear-gradient(135deg, #10b981, #059669); }
        .avatar-colors-1 { background: linear-gradient(135deg, #06b6d4, #0891b2); }
        .avatar-colors-2 { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .avatar-colors-3 { background: linear-gradient(135deg, #818cf8, #6366f1); }
        .avatar-colors-4 { background: linear-gradient(135deg, #f43f5e, #e11d48); }
        .user-name { font-weight: 600; color: var(--text-primary); }
        .user-email { font-size: 12.5px; color: var(--text-muted); margin-top: 2px; }

        /* Role badge */
        .role-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }
        .role-badge .dot { width: 6px; height: 6px; border-radius: 50%; }
        .role-admin { background: rgba(129,140,248,0.1); border: 1px solid rgba(129,140,248,0.15); color: var(--indigo); }
        .role-admin .dot { background: var(--indigo); box-shadow: 0 0 6px var(--indigo); }
        .role-user { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .role-user .dot { background: var(--accent); box-shadow: 0 0 6px var(--accent); }
        .role-editor { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.15); color: var(--amber); }
        .role-editor .dot { background: var(--amber); box-shadow: 0 0 6px var(--amber); }
        .role-default { background: rgba(255,255,255,0.03); border: 1px solid var(--input-border); color: var(--text-muted); }
        .role-default .dot { background: var(--text-muted); }

        /* Status badge */
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }
        .status-badge .dot { width: 6px; height: 6px; border-radius: 50%; }
        .status-active { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .status-active .dot { background: var(--accent); box-shadow: 0 0 6px var(--accent); }
        .status-inactive { background: rgba(255,255,255,0.03); border: 1px solid var(--input-border); color: var(--text-muted); }
        .status-inactive .dot { background: var(--text-muted); }

        .date-text { font-size: 13px; color: var(--text-muted); white-space: nowrap; }

        /* Action buttons */
        .action-btns { display: flex; gap: 6px; }
        .btn-icon {
            width: 34px; height: 34px; border-radius: 8px;
            background: rgba(255,255,255,0.03); border: 1px solid var(--input-border);
            color: var(--text-muted); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; transition: all 0.2s; text-decoration: none;
        }
        .btn-icon:hover { background: rgba(255,255,255,0.06); color: var(--text-primary); }
        .btn-icon.danger:hover { background: var(--danger-bg); color: var(--danger); border-color: rgba(239,68,68,0.2); }

        /* Empty state */
        .empty-state { text-align: center; padding: 60px 24px; }
        .empty-icon {
            width: 64px; height: 64px; border-radius: 18px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; color: var(--accent); margin: 0 auto 16px; opacity: 0.6;
        }
        .empty-state h3 { font-size: 16px; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
        .empty-state p { font-size: 13.5px; color: var(--text-muted); }

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

        /* Modal */
        .modal-overlay {
            position: fixed; inset: 0; z-index: 1000;
            background: rgba(0,0,0,0.6); backdrop-filter: blur(6px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: all 0.25s; padding: 24px;
        }
        .modal-overlay.open { opacity: 1; visibility: visible; }
        .modal-box {
            background: #1e293b; border: 1px solid var(--card-border);
            border-radius: 20px; padding: 32px; max-width: 400px; width: 100%;
            transform: scale(0.9) translateY(20px);
            transition: transform 0.3s cubic-bezier(0.16,1,0.3,1);
            box-shadow: 0 25px 60px -12px rgba(0,0,0,0.5);
        }
        .modal-overlay.open .modal-box { transform: scale(1) translateY(0); }
        .modal-icon {
            width: 56px; height: 56px; border-radius: 16px;
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: var(--danger); margin-bottom: 20px;
        }
        .modal-box h3 { font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px; }
        .modal-box p { font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 28px; }
        .modal-box p strong { color: var(--text-secondary); }
        .modal-actions { display: flex; gap: 10px; }
        .btn-modal {
            flex: 1; padding: 12px; border-radius: 10px;
            font-size: 14px; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.2s; border: none;
        }
        .btn-cancel { background: rgba(255,255,255,0.05); border: 1px solid var(--input-border) !important; color: var(--text-secondary); }
        .btn-cancel:hover { background: rgba(255,255,255,0.08); color: var(--text-primary); }
        .btn-delete-confirm { background: var(--danger); color: white; }
        .btn-delete-confirm:hover { background: #dc2626; box-shadow: 0 4px 16px rgba(239,68,68,0.3); }

        /* No results row */
        .no-results { text-align: center; padding: 48px 24px; }
        .no-results i { font-size: 28px; color: var(--text-muted); opacity: 0.3; margin-bottom: 10px; }
        .no-results p { font-size: 14px; color: var(--text-muted); }

        /* ==================== Responsive ==================== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .mobile-menu-btn { display: flex; }
            .page-content { padding: 20px 16px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .topbar { padding: 0 16px; }
            .hide-mobile { display: none; }
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
                <span class="link-badge cyan">{{ $users->count() }}</span>
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
                    <span class="current">Pengguna</span>
                </div>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn" title="Refresh" aria-label="Refresh" onclick="location.reload()">
                    <i class="fas fa-rotate-right"></i>
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

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>Kelola Pengguna</h1>
                    <p>Kelola akun pengguna, atur peran, dan pantau aktivitas</p>
                    <div class="count-badge">
                        <i class="fas fa-users"></i>
                        {{ $users->count() }} pengguna
                    </div>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Tambah Pengguna
                </a>
            </div>

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari nama atau email..." autocomplete="off">
                    <i class="fas fa-search"></i>
                </div>
                <div class="filter-chips">
                    <button class="filter-chip active" data-filter="all" onclick="setFilter('all', this)">Semua</button>
                    <button class="filter-chip" data-filter="admin" onclick="setFilter('admin', this)">Admin</button>
                    <button class="filter-chip" data-filter="user" onclick="setFilter('user', this)">User</button>
                </div>
            </div>

            <!-- User Table -->
            <div class="table-card">
                @if($users->count() > 0)
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th style="width:30%">Pengguna</th>
                                <th style="width:20%">Email</th>
                                <th style="width:12%">Peran</th>
                                <th class="hide-mobile" style="width:14%">Bergabung</th>
                                <th style="width:12%; text-align:right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">
                            @php
                                $avatarColors = ['avatar-colors-0','avatar-colors-1','avatar-colors-2','avatar-colors-3','avatar-colors-4'];
                            @endphp
                            @foreach($users as $user)
                            @php
                                $roleSlug = strtolower($user->role->slug ?? '');
                                $roleClass = 'role-default';
                                $roleLabel = ucfirst($roleSlug) ?: '-';
                                if ($roleSlug === 'admin') { $roleClass = 'role-admin'; $roleLabel = 'Admin'; }
                                elseif ($roleSlug === 'user') { $roleClass = 'role-user'; $roleLabel = 'User'; }
                                elseif ($roleSlug === 'editor') { $roleClass = 'role-editor'; $roleLabel = 'Editor'; }

                                $initials = substr($user->name, 0, 2);
                                $colorIdx = $loop->index % count($avatarColors);
                            @endphp
                            <tr
                                data-name="{{ strtolower($user->name) }}"
                                data-email="{{ strtolower($user->email) }}"
                                data-role="{{ $roleSlug }}"
                            >
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar {{ $avatarColors[$colorIdx] }}">{{ $initials }}</div>
                                        <div>
                                            <div class="user-name">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-size:13.5px">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="role-badge {{ $roleClass }}">
                                        <span class="dot"></span>
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td class="hide-mobile">
                                    <span class="date-text">{{ $user->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <div class="action-btns" style="justify-content:flex-end">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-icon" title="Edit pengguna" aria-label="Edit">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>
                                        <button
                                            class="btn-icon danger"
                                            title="Hapus pengguna"
                                            aria-label="Hapus"
                                            onclick="confirmDelete('{{ $user->name }}', '{{ route('admin.users.destroy', $user->id) }}')"
                                        >
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-users"></i></div>
                    <h3>Belum ada pengguna</h3>
                    <p>Mulai tambahkan pengguna pertama menggunakan tombol di atas.</p>
                </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash-can"></i></div>
            <h3>Hapus Pengguna</h3>
            <p>Apakah kamu yakin ingin menghapus pengguna <strong id="deleteUserName"></strong>? Semua data terkait pengguna ini akan ikut terhapus.</p>
            <form id="deleteForm" method="POST" class="modal-actions">
                @csrf
                @method('DELETE')
                <button type="button" class="btn-modal btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button type="submit" class="btn-modal btn-delete-confirm">Ya, Hapus</button>
            </form>
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

        // === Search ===
        document.getElementById('searchInput').addEventListener('input', applyFilters);

        // === Filter ===
        var currentFilter = 'all';
        function setFilter(filter, btn) {
            currentFilter = filter;
            document.querySelectorAll('.filter-chip').forEach(function(c) { c.classList.remove('active'); });
            btn.classList.add('active');
            applyFilters();
        }

        function applyFilters() {
            var query = document.getElementById('searchInput').value.toLowerCase().trim();
            var rows = document.querySelectorAll('#userTable tr');
            var visibleCount = 0;

            rows.forEach(function(row) {
                var name = row.dataset.name || '';
                var email = row.dataset.email || '';
                var role = row.dataset.role || '';
                var matchSearch = name.includes(query) || email.includes(query);
                var matchFilter = currentFilter === 'all' || role === currentFilter;
                var show = matchSearch && matchFilter;
                row.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            // Tampilkan pesan "tidak ditemukan" jika semua row tersembunyi
            var noResults = document.getElementById('noResults');
            if (visibleCount === 0 && rows.length > 0) {
                if (!noResults) {
                    noResults = document.createElement('tr');
                    noResults.id = 'noResults';
                    noResults.innerHTML = '<td colspan="5"><div class="no-results"><i class="fas fa-search"></i><p>Tidak ada pengguna yang cocok dengan filter.</p></div></td>';
                    document.getElementById('userTable').appendChild(noResults);
                }
                noResults.style.display = '';
            } else if (noResults) {
                noResults.style.display = 'none';
            }
        }

        // === Modal Hapus ===
        function confirmDelete(name, url) {
            document.getElementById('deleteUserName').textContent = name;
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.add('open');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('open');
        }
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDeleteModal();
        });

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