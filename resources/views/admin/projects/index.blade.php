<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Project</title>
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
            margin-bottom: 28px; gap: 20px; flex-wrap: wrap;
        }
        .page-header h1 { font-size: 26px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; margin-bottom: 4px; }
        .page-header p { font-size: 14.5px; color: var(--text-muted); }
        .count-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15);
            color: var(--accent); font-size: 12.5px; font-weight: 600;
            padding: 4px 12px; border-radius: 20px; margin-top: 8px;
        }

        /* Stats mini */
        .stats-mini {
            display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;
        }
        .stat-mini {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 18px; border-radius: 12px;
            background: var(--card-bg);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            animation: fadeUp 0.4s cubic-bezier(0.16,1,0.3,1) both;
        }
        .stat-mini:nth-child(1) { animation-delay: 0.04s; }
        .stat-mini:nth-child(2) { animation-delay: 0.08s; }
        .stat-mini:nth-child(3) { animation-delay: 0.12s; }
        .stat-mini-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 14px;
        }
        .stat-mini-icon.green { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .stat-mini-icon.cyan { background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.15); color: var(--cyan); }
        .stat-mini-icon.amber { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.15); color: var(--amber); }
        .stat-mini-val { font-size: 18px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; }
        .stat-mini-label { font-size: 12px; color: var(--text-muted); }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); filter: blur(2px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        /* Toolbar */
        .toolbar {
            display: flex; align-items: center; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;
        }
        .search-box { flex: 1; min-width: 220px; position: relative; }
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

        .view-toggle {
            display: flex; background: var(--input-bg);
            border: 1.5px solid var(--input-border); border-radius: 10px; overflow: hidden;
        }
        .view-btn {
            padding: 9px 14px; background: none; border: none;
            color: var(--text-muted); cursor: pointer; font-size: 14px; transition: all 0.2s;
        }
        .view-btn.active { background: var(--accent-subtle); color: var(--accent); }
        .view-btn:hover:not(.active) { color: var(--text-secondary); }

        /* Project Grid */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 18px;
        }
        .projects-grid.list-view {
            grid-template-columns: 1fr;
        }

        /* Project Card */
        .project-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            opacity: 0; transform: translateY(20px);
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
        .project-card:nth-child(9) { animation-delay: 0.45s; }
        @keyframes cardReveal {
            to { opacity: 1; transform: translateY(0); }
        }

        .project-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--cyan));
            opacity: 0; transition: opacity 0.3s; z-index: 2;
        }
        .project-card:hover {
            border-color: rgba(16, 185, 129, 0.25);
            transform: translateY(-4px);
            box-shadow: 0 12px 40px -8px rgba(0,0,0,0.4), 0 0 40px -12px var(--accent-glow);
        }
        .project-card:hover::before { opacity: 1; }

        /* Card image */
        .card-image {
            position: relative; width: 100%; aspect-ratio: 16/9;
            background: var(--input-bg); overflow: hidden;
        }
        .card-image img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.5s;
        }
        .project-card:hover .card-image img { transform: scale(1.06); }
        .card-image-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(10,15,26,0.5) 0%, transparent 50%);
        }
        .card-no-image {
            display: flex; align-items: center; justify-content: center;
            width: 100%; aspect-ratio: 16/9; background: var(--input-bg);
            font-size: 32px; color: var(--text-muted); opacity: 0.2;
        }
        .card-status-float {
            position: absolute; top: 12px; right: 12px;
            padding: 4px 10px; border-radius: 8px;
            font-size: 11px; font-weight: 600; z-index: 3;
            backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        }
        .status-published {
            background: rgba(16,185,129,0.2); border: 1px solid rgba(16,185,129,0.3); color: var(--accent);
        }
        .status-draft {
            background: rgba(245,158,11,0.2); border: 1px solid rgba(245,158,11,0.3); color: var(--amber);
        }

        .card-body { padding: 20px; }
        .card-title {
            font-size: 16px; font-weight: 700; color: var(--text-primary);
            letter-spacing: -0.2px; line-height: 1.3; margin-bottom: 8px;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .card-desc {
            font-size: 13px; color: var(--text-muted); line-height: 1.6;
            margin-bottom: 14px;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }

        /* Categories */
        .card-cats { display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 14px; }
        .cat-chip {
            font-size: 11px; font-weight: 600; padding: 3px 8px;
            border-radius: 6px;
        }
        @php
            $catColors = [
                'background:var(--accent-subtle);color:var(--accent);border:1px solid rgba(16,185,129,0.15)',
                'background:rgba(6,182,212,0.08);color:var(--cyan);border:1px solid rgba(6,182,212,0.15)',
                'background:var(--amber-subtle);color:var(--amber);border:1px solid rgba(245,158,11,0.15)',
                'background:var(--indigo-subtle);color:var(--indigo);border:1px solid rgba(129,140,248,0.15)',
                'background:var(--rose-subtle);color:var(--rose);border:1px solid rgba(244,63,94,0.15)',
            ];
        @endphp

        /* Card footer */
        .card-footer {
            display: flex; align-items: center; justify-content: space-between;
            padding-top: 14px; border-top: 1px solid var(--card-border);
        }
        .card-author {
            display: flex; align-items: center; gap: 8px; min-width: 0;
        }
        .author-avatar {
            width: 26px; height: 26px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; font-weight: 700; color: white; flex-shrink: 0;
            text-transform: uppercase;
        }
        .author-name {
            font-size: 12.5px; font-weight: 600; color: var(--text-secondary);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .card-meta-right {
            display: flex; align-items: center; gap: 12px; flex-shrink: 0;
        }
        .meta-item {
            display: flex; align-items: center; gap: 5px;
            font-size: 12px; color: var(--text-muted);
        }
        .meta-item i { font-size: 11px; opacity: 0.7; }

        /* List view */
        .list-view .project-card { display: flex; }
        .list-view .card-image { width: 220px; aspect-ratio: auto; min-height: 160px; flex-shrink: 0; }
        .list-view .card-no-image { width: 220px; min-height: 160px; flex-shrink: 0; }
        .list-view .card-body { flex: 1; display: flex; flex-direction: column; justify-content: center; min-width: 0; }

        /* Empty state */
        .empty-state { text-align: center; padding: 80px 24px; }
        .empty-icon {
            width: 72px; height: 72px; border-radius: 20px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: var(--accent); margin: 0 auto 20px; opacity: 0.5;
        }
        .empty-state h3 { font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px; }
        .empty-state p { font-size: 14px; color: var(--text-muted); max-width: 380px; margin: 0 auto; line-height: 1.6; }
        .no-results-inline {
            text-align: center; padding: 48px 24px;
            grid-column: 1 / -1;
        }
        .no-results-inline i { font-size: 28px; color: var(--text-muted); opacity: 0.3; margin-bottom: 10px; }
        .no-results-inline p { font-size: 14px; color: var(--text-muted); }

        /* Pagination */
        .pagination-wrapper { margin-top: 32px; }
        .pagination {
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .pagination a, .pagination span {
            display: flex; align-items: center; justify-content: center;
            min-width: 40px; height: 40px; border-radius: 10px;
            font-size: 13px; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
            border: 1.5px solid var(--input-border);
            background: rgba(255,255,255,0.03);
            color: var(--text-muted); padding: 0 4px;
        }
        .pagination a:hover {
            border-color: rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.06);
            color: var(--text-primary);
        }
        .pagination .active {
            background: linear-gradient(135deg, var(--accent), #059669);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 16px var(--accent-glow);
        }
        .pagination .disabled {
            opacity: 0.35; cursor: not-allowed; pointer-events: none;
        }
        .pagination .dots {
            border: none; background: none; color: var(--text-muted);
            min-width: auto; padding: 0 4px;
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
        @keyframes shakeIn {
            0%{opacity:0;transform:translateX(-10px)} 25%{transform:translateX(6px)} 50%{transform:translateX(-4px)} 75%{transform:translateX(2px)} 100%{opacity:1;transform:translateX(0)}
        }

        /* ==================== Responsive ==================== */
        @media (max-width: 1024px) {
            .projects-grid { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); }
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .mobile-menu-btn { display: flex; }
            .page-content { padding: 20px 16px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .topbar { padding: 0 16px; }
            .projects-grid { grid-template-columns: 1fr; }
            .list-view .project-card { flex-direction: column; }
            .list-view .card-image, .list-view .card-no-image { width: 100%; min-height: 0; aspect-ratio: 16/9; }
            .stats-mini { gap: 8px; }
            .stat-mini { flex: 1; min-width: 0; padding: 10px 12px; }
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
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="fas fa-users"></i> Pengguna
                <span class="link-badge cyan">{{ $userCount ?? 0 }}</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link active">
                <i class="fas fa-folder-open"></i> Semua Project
                <span class="link-badge amber">{{ $projects->total() }}</span>
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
                    <span class="current">Semua Project</span>
                </div>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn" title="Refresh" aria-label="Refresh" onclick="location.reload()" style="width:38px;height:38px;border-radius:10px;background:rgba(255,255,255,0.04);border:1px solid var(--input-border);color:var(--text-muted);cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;">
                    <i class="fas fa-rotate-right"></i>
                </button>
            </div>
        </header>

        <div class="page-content">

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
                    <h1>Semua Project</h1>
                    <p>Pantau semua project dari seluruh pengguna platform</p>
                    <div class="count-badge">
                        <i class="fas fa-folder-open"></i>
                        {{ $projects->total() }} project
                    </div>
                </div>
            </div>

            <!-- Stats Mini -->
            @php
                $publishedCount = $projects->getCollection()->where('status', 'published')->count();
                $draftCount = $projects->getCollection()->where('status', 'draft')->count();
                $totalMedia = 0;
                foreach($projects as $p) { $totalMedia += $p->media->count(); }
            @endphp
            <div class="stats-mini">
                <div class="stat-mini">
                    <div class="stat-mini-icon green"><i class="fas fa-globe"></i></div>
                    <div>
                        <div class="stat-mini-val">{{ $publishedCount }}</div>
                        <div class="stat-mini-label">Published</div>
                    </div>
                </div>
                <div class="stat-mini">
                    <div class="stat-mini-icon amber"><i class="fas fa-pencil"></i></div>
                    <div>
                        <div class="stat-mini-val">{{ $draftCount }}</div>
                        <div class="stat-mini-label">Draft</div>
                    </div>
                </div>
                <div class="stat-mini">
                    <div class="stat-mini-icon cyan"><i class="fas fa-image"></i></div>
                    <div>
                        <div class="stat-mini-val">{{ $totalMedia }}</div>
                        <div class="stat-mini-label">Total Media</div>
                    </div>
                </div>
            </div>

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari project atau pengguna..." autocomplete="off">
                    <i class="fas fa-search"></i>
                </div>
                <div class="filter-chips">
                    <button class="filter-chip active" data-filter="all" onclick="setFilter('all', this)">Semua</button>
                    <button class="filter-chip" data-filter="published" onclick="setFilter('published', this)">Published</button>
                    <button class="filter-chip" data-filter="draft" onclick="setFilter('draft', this)">Draft</button>
                </div>
                <div class="view-toggle">
                    <button class="view-btn active" id="gridViewBtn" onclick="setView('grid')" aria-label="Grid">
                        <i class="fas fa-table-cells-large"></i>
                    </button>
                    <button class="view-btn" id="listViewBtn" onclick="setView('list')" aria-label="List">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>

            <!-- Projects Grid -->
            @if($projects->count() > 0)
            <div class="projects-grid" id="projectsGrid">
                @php
                    $avatarBgs = [
                        'background:linear-gradient(135deg,#10b981,#059669)',
                        'background:linear-gradient(135deg,#06b6d4,#0891b2)',
                        'background:linear-gradient(135deg,#f59e0b,#d97706)',
                        'background:linear-gradient(135deg,#818cf8,#6366f1)',
                        'background:linear-gradient(135deg,#f43f5e,#e11d48)',
                    ];
                @endphp
                @foreach($projects as $project)
                @php
                    $authorName = $project->user->name ?? 'Unknown';
                    $authorColorIdx = ord(substr($authorName, 0, 1)) % count($avatarBgs);
                    $firstMedia = $project->media->first();
                    $hasImage = $firstMedia && in_array(strtolower(pathinfo($firstMedia->file_name, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif','webp','svg','bmp']);
                @endphp
                <div class="project-card"
                     data-title="{{ strtolower($project->title) }}"
                     data-author="{{ strtolower($authorName) }}"
                     data-status="{{ $project->status }}">
                    @if($hasImage)
                    <div class="card-image">
                        <img src="{{ asset($firstMedia->file_path) }}" alt="{{ $project->title }}" loading="lazy">
                        <div class="card-image-overlay"></div>
                        <span class="card-status-float status-{{ $project->status }}">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>
                    @else
                    <div class="card-no-image">
                        <i class="fas fa-folder-open"></i>
                        <span class="card-status-float status-{{ $project->status }}" style="position:absolute;">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>
                    @endif

                    <div class="card-body">
                        <div class="card-title">{{ $project->title }}</div>
                        @if($project->description)
                        <div class="card-desc">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>
                        @endif

                        @if($project->categories->count() > 0)
                        <div class="card-cats">
                            @foreach($project->categories as $cat)
                            <span class="cat-chip" style="{{ $catColors[$loop->index % count($catColors)] }}">
                                {{ $cat->name }}
                            </span>
                            @endforeach
                        </div>
                        @endif

                        <div class="card-footer">
                            <div class="card-author">
                                <div class="author-avatar" style="{{ $avatarBgs[$authorColorIdx] }}">
                                    {{ substr($authorName, 0, 1) }}
                                </div>
                                <span class="author-name">{{ $authorName }}</span>
                            </div>
                            <div class="card-meta-right">
                                @if($project->media->count() > 0)
                                <span class="meta-item">
                                    <i class="fas fa-image"></i>
                                    {{ $project->media->count() }}
                                </span>
                                @endif
                                <span class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    {{ $project->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-folder-open"></i></div>
                <h3>Belum ada project</h3>
                <p>Belum ada project yang dibuat oleh pengguna manapun di platform ini.</p>
            </div>
            @endif

            <!-- Pagination -->
            @if($projects->hasPages())
            <div class="pagination-wrapper">
                {{ $projects->links('pagination::custom-tailwind') }}
            </div>
            @endif

        </div>
    </div>

    <script>
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
            var cards = document.querySelectorAll('.project-card');
            var visibleCount = 0;

            cards.forEach(function(card) {
                var title = card.dataset.title || '';
                var author = card.dataset.author || '';
                var status = card.dataset.status || '';
                var matchSearch = title.includes(query) || author.includes(query);
                var matchFilter = currentFilter === 'all' || status === currentFilter;
                var show = matchSearch && matchFilter;
                card.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            var noResults = document.getElementById('noResults');
            if (visibleCount === 0 && cards.length > 0) {
                if (!noResults) {
                    noResults = document.createElement('div');
                    noResults.id = 'noResults';
                    noResults.className = 'no-results-inline';
                    noResults.innerHTML = '<i class="fas fa-search"></i><p>Tidak ada project yang cocok dengan filter.</p>';
                    document.getElementById('projectsGrid').appendChild(noResults);
                }
                noResults.style.display = '';
            } else if (noResults) {
                noResults.style.display = 'none';
            }
        }

        // === View Toggle ===
        function setView(mode) {
            var grid = document.getElementById('projectsGrid');
            var gridBtn = document.getElementById('gridViewBtn');
            var listBtn = document.getElementById('listViewBtn');
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

        // === Style pagination links ===
        document.querySelectorAll('.pagination a, .pagination span').forEach(function(el) {
            el.style.display = 'flex';
            el.style.alignItems = 'center';
            el.style.justifyContent = 'center';
            el.style.minWidth = '40px';
            el.style.height = '40px';
            el.style.borderRadius = '10px';
            el.style.fontSize = '13px';
            el.style.fontWeight = '600';
            el.style.textDecoration = 'none';
            el.style.transition = 'all 0.2s';
            el.style.border = '1.5px solid var(--input-border)';
            el.style.background = 'rgba(255,255,255,0.03)';
            el.style.color = 'var(--text-muted)';
            el.style.padding = '0 4px';
            el.style.fontFamily = "'Plus Jakarta Sans', sans-serif";
        });
        document.querySelectorAll('.pagination .page-link').forEach(function(el) {
            el.addEventListener('mouseenter', function() {
                this.style.borderColor = 'rgba(255,255,255,0.15)';
                this.style.background = 'rgba(255,255,255,0.06)';
                this.style.color = 'var(--text-primary)';
            });
            el.addEventListener('mouseleave', function() {
                this.style.borderColor = 'var(--input-border)';
                this.style.background = 'rgba(255,255,255,0.03)';
                this.style.color = 'var(--text-muted)';
            });
        });
        document.querySelectorAll('.pagination .active .page-link').forEach(function(el) {
            el.style.background = 'linear-gradient(135deg, var(--accent), #059669)';
            el.style.borderColor = 'transparent';
            el.style.color = 'white';
            el.style.boxShadow = '0 4px 16px var(--accent-glow)';
        });
        document.querySelectorAll('.pagination .disabled .page-link').forEach(function(el) {
            el.style.opacity = '0.35';
            el.style.cursor = 'not-allowed';
            el.style.pointerEvents = 'none';
        });
        document.querySelectorAll('.pagination .dots').forEach(function(el) {
            el.style.border = 'none';
            el.style.background = 'none';
            el.style.color = 'var(--text-muted)';
            el.style.minWidth = 'auto';
            el.style.padding = '0 4px';
        });
    </script>
</body>
</html>