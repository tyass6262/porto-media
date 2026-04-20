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
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ==================== Background Layers ==================== */
        .bg-layer {
            position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none;
        }
        .bg-layer::before {
            content: ''; position: absolute; top: -25%; right: -15%;
            width: 65vw; height: 65vw;
            background: radial-gradient(circle, rgba(16,185,129,0.06) 0%, transparent 65%);
            animation: floatBlob1 22s ease-in-out infinite;
        }
        .bg-layer::after {
            content: ''; position: absolute; bottom: -25%; left: -10%;
            width: 55vw; height: 55vw;
            background: radial-gradient(circle, rgba(6,182,212,0.045) 0%, transparent 65%);
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
            mask-image: radial-gradient(ellipse at 60% 20%, black 15%, transparent 70%);
        }
        /* Extra ambient orbs */
        .ambient-orb {
            position: fixed; border-radius: 50%; pointer-events: none; z-index: 0;
            filter: blur(80px); opacity: 0.35;
        }
        .ambient-orb.orb-1 {
            width: 300px; height: 300px; top: 10%; left: 50%;
            background: rgba(16,185,129,0.07);
            animation: orbFloat1 18s ease-in-out infinite;
        }
        .ambient-orb.orb-2 {
            width: 200px; height: 200px; bottom: 20%; right: 15%;
            background: rgba(6,182,212,0.06);
            animation: orbFloat2 24s ease-in-out infinite;
        }
        @keyframes orbFloat1 {
            0%,100%{transform:translate(-50%,0)} 50%{transform:translate(-50%,30px)}
        }
        @keyframes orbFloat2 {
            0%,100%{transform:translate(0,0)} 50%{transform:translate(-20px,-25px)}
        }

        /* ==================== Top Bar ==================== */
        .top-bar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(10,15,26,0.6);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            padding: 0 40px; height: 68px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .topbar-left { display: flex; align-items: center; gap: 20px; }
        .topbar-brand {
            display: flex; align-items: center; gap: 11px;
            text-decoration: none;
        }
        .topbar-logo {
            width: 38px; height: 38px; border-radius: 11px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; color: white; flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(16,185,129,0.2);
        }
        .topbar-brand-text { font-size: 16px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; }
        .topbar-divider { width: 1px; height: 28px; background: var(--card-border); }
        .breadcrumb-bar { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-muted); }
        .breadcrumb-bar a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .breadcrumb-bar a:hover { color: var(--accent); }
        .breadcrumb-bar i { font-size: 9px; opacity: 0.4; }
        .breadcrumb-bar .current { color: var(--text-secondary); font-weight: 500; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-user-chip {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 14px 6px 6px; border-radius: 12px;
            background: rgba(255,255,255,0.03); border: 1px solid var(--card-border);
            cursor: default;
        }
        .topbar-avatar {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: white; font-weight: 700;
        }
        .topbar-user-name { font-size: 13px; font-weight: 600; color: var(--text-secondary); }
        .logout-btn {
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(255,255,255,0.03); border: 1px solid var(--card-border);
            color: var(--text-muted); cursor: pointer; font-size: 14px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s; text-decoration: none;
        }
        .logout-btn:hover { color: var(--danger); background: var(--danger-bg); border-color: rgba(239,68,68,0.2); }

        /* ==================== Page Content ==================== */
        .page-wrapper {
            position: relative; z-index: 10;
            max-width: 780px; margin: 0 auto;
            padding: 40px 24px 80px;
        }

        /* Page Header */
        .page-header {
            text-align: center; margin-bottom: 36px;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        .page-header-icon {
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, var(--accent-subtle), rgba(6,182,212,0.06));
            border: 1px solid rgba(16,185,129,0.15);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 22px; color: var(--accent);
            margin-bottom: 18px;
            box-shadow: 0 8px 32px rgba(16,185,129,0.08);
        }
        .page-header h1 {
            font-size: 28px; font-weight: 800; color: var(--text-primary);
            letter-spacing: -0.5px; margin-bottom: 8px;
        }
        .page-header p { font-size: 14.5px; color: var(--text-muted); line-height: 1.6; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); filter: blur(3px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        @keyframes fadeUp2 {
            from { opacity: 0; transform: translateY(16px); filter: blur(2px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; } to { opacity: 1; }
        }

        /* ==================== Info Summary ==================== */
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
        .info-summary {
            background: var(--card-bg);
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--card-border);
            border-radius: 18px; padding: 22px 26px;
            margin-bottom: 24px;
            display: flex; align-items: center; gap: 18px;
            animation: fadeUp2 0.5s cubic-bezier(0.16,1,0.3,1) both;
            animation-delay: 0.08s;
            position: relative; overflow: hidden;
        }
        .info-summary::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(16,185,129,0.2), transparent);
        }
        .info-icon {
            width: 50px; height: 50px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .info-detail { flex: 1; min-width: 0; }
        .info-name { font-size: 17px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px; }
        .info-meta { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .info-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 8px;
            font-size: 12.5px; font-weight: 600; font-family: 'Courier New', monospace;
            background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.15); color: var(--cyan);
        }
        .info-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--cyan); animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
        .status-badge-inline {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 8px; font-size: 12.5px; font-weight: 600;
        }
        .status-badge-inline .dot { width: 6px; height: 6px; border-radius: 50%; }
        .s-active { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .s-active .dot { background: var(--accent); animation: pulse 2s infinite; }
        .s-inactive { background: rgba(255,255,255,0.03); border: 1px solid var(--input-border); color: var(--text-muted); }
        .s-inactive .dot { background: var(--text-muted); }
        .info-projects {
            font-size: 12.5px; color: var(--text-muted);
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 8px;
            background: rgba(255,255,255,0.02); border: 1px solid var(--card-border);
        }
        .info-projects i { font-size: 11px; opacity: 0.5; }

        /* ==================== Form Card ==================== */
        .form-card {
            background: var(--card-bg);
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--card-border);
            border-radius: 22px; padding: 40px;
            margin-bottom: 24px;
            animation: fadeUp2 0.55s cubic-bezier(0.16,1,0.3,1) both;
            animation-delay: 0.14s;
            position: relative; overflow: hidden;
        }
        .form-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(16,185,129,0.15), transparent);
        }
        .form-card::after {
            content: ''; position: absolute; top: -120px; right: -120px;
            width: 280px; height: 280px; border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,0.03) 0%, transparent 70%);
            pointer-events: none;
        }
        .form-card-header {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 32px; position: relative; z-index: 1;
        }
        .form-card-header-icon {
            width: 42px; height: 42px; border-radius: 12px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.18);
            display: flex; align-items: center; justify-content: center; font-size: 16px; color: var(--accent);
        }
        .form-card-header-text { font-size: 16px; font-weight: 700; color: var(--text-primary); }
        .form-card-header-sub { font-size: 12.5px; color: var(--text-muted); margin-top: 2px; }

        /* Fields */
        .field-group { margin-bottom: 24px; position: relative; z-index: 1; }
        .field-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-secondary); margin-bottom: 10px; letter-spacing: 0.3px;
        }
        .field-group label .required { color: var(--danger); margin-left: 2px; }
        .field-group label .char-count {
            float: right; font-weight: 500; font-size: 12px; color: var(--text-muted);
            font-family: 'Courier New', monospace;
        }
        .field-group label .char-count.warn { color: var(--amber); }
        .field-group label .char-count.danger { color: var(--danger); }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper .input-icon {
            position: absolute; left: 18px; font-size: 15px;
            color: var(--text-muted); transition: color 0.3s; pointer-events: none; z-index: 2;
        }
        .field-input {
            width: 100%; padding: 15px 18px 15px 50px;
            background: var(--input-bg); border: 1.5px solid var(--input-border);
            border-radius: 14px; color: var(--text-primary);
            font-size: 15px; font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1); outline: none;
        }
        .field-input::placeholder { color: var(--text-muted); font-size: 14px; }
        .field-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--input-focus), 0 0 32px -6px var(--accent-glow);
            background: rgba(15,23,42,1);
        }
        .field-input.input-error {
            border-color: var(--danger);
            box-shadow: 0 0 0 4px rgba(239,68,68,0.1);
        }
        .field-input.input-error:focus {
            box-shadow: 0 0 0 4px rgba(239,68,68,0.15);
        }
        .field-error {
            font-size: 12.5px; color: #fca5a5; margin-top: 8px;
            display: flex; align-items: center; gap: 7px;
        }
        .field-error i { font-size: 12px; }

        /* Slug Preview */
        .slug-preview {
            margin-top: 28px; padding: 20px 22px;
            background: rgba(6,182,212,0.03);
            border: 1px solid rgba(6,182,212,0.1);
            border-radius: 16px;
            display: flex; align-items: center; gap: 16px;
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
            position: relative; z-index: 1;
        }
        .slug-preview.has-value { border-color: rgba(6,182,212,0.2); }
        .slug-preview-changed {
            border-color: rgba(245,158,11,0.25) !important;
            background: rgba(245,158,11,0.03) !important;
        }
        .slug-preview-icon {
            width: 40px; height: 40px; border-radius: 11px;
            background: rgba(6,182,212,0.1); border: 1px solid rgba(6,182,212,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; color: var(--cyan); flex-shrink: 0;
            transition: all 0.3s;
        }
        .slug-preview-changed .slug-preview-icon {
            background: var(--amber-subtle); border-color: rgba(245,158,11,0.15); color: var(--amber);
        }
        .slug-preview-info { flex: 1; min-width: 0; }
        .slug-preview-label {
            font-size: 11px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 6px;
            display: flex; align-items: center; gap: 8px;
        }
        .slug-change-badge {
            font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 5px;
            background: var(--amber-subtle); color: var(--amber);
            text-transform: uppercase; letter-spacing: 0.3px;
            display: none; animation: fadeIn 0.3s ease;
        }
        .slug-preview-changed .slug-change-badge { display: inline-flex; }
        .slug-preview-value {
            font-size: 15px; font-weight: 600; color: var(--cyan);
            font-family: 'Courier New', monospace;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            transition: color 0.3s; letter-spacing: 0.3px;
        }
        .slug-preview-changed .slug-preview-value { color: var(--amber); }
        .slug-hint {
            display: flex; align-items: flex-start; gap: 7px;
            font-size: 12.5px; color: var(--text-muted); margin-top: 12px;
            line-height: 1.5;
            position: relative; z-index: 1;
        }
        .slug-hint i { font-size: 12px; margin-top: 3px; flex-shrink: 0; opacity: 0.6; }

        /* Divider */
        .form-divider {
            height: 1px; margin: 32px 0;
            background: linear-gradient(90deg, transparent, var(--card-border), transparent);
            position: relative; z-index: 1;
        }

        /* Form Actions */
        .form-actions-row {
            display: flex; justify-content: space-between; align-items: center;
            margin-top: 0; position: relative; z-index: 1;
        }
        .btn-cancel {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 22px; border-radius: 12px;
            background: rgba(255,255,255,0.03); border: 1.5px solid var(--input-border);
            color: var(--text-secondary); font-size: 14px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.25s; text-decoration: none;
        }
        .btn-cancel:hover {
            background: rgba(255,255,255,0.06); color: var(--text-primary);
            border-color: rgba(255,255,255,0.15); transform: translateX(-2px);
        }
        .btn-submit {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 13px 32px; border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: white; border: none;
            font-size: 14px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            position: relative; overflow: hidden;
            box-shadow: 0 4px 20px rgba(16,185,129,0.15);
        }
        .btn-submit::before {
            content: ''; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
            transition: left 0.6s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 36px rgba(16,185,129,0.25);
        }
        .btn-submit:hover::before { left: 100%; }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none !important; }

        /* ==================== Validation Errors ==================== */
        .validation-errors {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.18);
            border-radius: 14px; padding: 18px 22px; margin-bottom: 24px;
            animation: shakeIn 0.5s ease;
            position: relative; z-index: 1;
        }
        .validation-errors .error-title {
            font-size: 13.5px; font-weight: 700; color: #fca5a5; margin-bottom: 10px;
            display: flex; align-items: center; gap: 8px;
        }
        .validation-errors .error-title i { font-size: 15px; }
        .validation-errors ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 5px; }
        .validation-errors ul li {
            font-size: 13px; color: #fca5a5; padding-left: 22px; position: relative;
        }
        .validation-errors ul li::before {
            content: ''; position: absolute; left: 6px; top: 50%;
            width: 5px; height: 5px; border-radius: 50%; background: var(--danger);
            transform: translateY(-50%);
        }
        @keyframes shakeIn {
            0%{opacity:0;transform:translateX(-12px)} 25%{transform:translateX(8px)} 50%{transform:translateX(-5px)} 75%{transform:translateX(3px)} 100%{opacity:1;transform:translateX(0)}
        }

        /* ==================== Session Alerts ==================== */
        .session-alert { margin-bottom: 24px; animation: fadeUp2 0.4s cubic-bezier(0.16,1,0.3,1) both; }
        .alert-custom {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.18);
            border-radius: 14px; padding: 16px 20px;
            display: flex; align-items: center; gap: 14px;
            font-size: 14px; color: #fca5a5; animation: shakeIn 0.5s ease;
        }
        .alert-custom i { color: var(--danger); font-size: 18px; flex-shrink: 0; }
        .alert-success-custom {
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.18);
            border-radius: 14px; padding: 16px 20px;
            display: flex; align-items: center; gap: 14px;
            font-size: 14px; color: var(--accent-hover); animation: fadeUp2 0.5s ease;
        }
        .alert-success-custom i { color: var(--accent); font-size: 18px; flex-shrink: 0; }

        /* ==================== Footer Note ==================== */
        .footer-note {
            text-align: center; margin-top: 32px;
            animation: fadeUp2 0.6s cubic-bezier(0.16,1,0.3,1) both;
            animation-delay: 0.22s;
        }
        .footer-note p {
            font-size: 12.5px; color: var(--text-muted);
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .footer-note i { font-size: 11px; opacity: 0.4; }

        /* ==================== Keyboard Shortcut Hint ==================== */
        .kbd-hint {
            display: inline-flex; align-items: center; gap: 4px; margin-left: 6px;
        }
        .kbd {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 2px 7px; border-radius: 5px;
            background: rgba(255,255,255,0.05); border: 1px solid var(--input-border);
            font-size: 11px; font-weight: 600; color: var(--text-muted);
            font-family: 'Courier New', monospace; line-height: 1.4;
        }

        /* ==================== Responsive ==================== */
        @media (max-width: 768px) {
            .top-bar { padding: 0 16px; height: 60px; }
            .topbar-brand-text, .topbar-divider { display: none; }
            .topbar-user-name { display: none; }
            .page-wrapper { padding: 24px 16px 60px; }
            .form-card { padding: 28px 22px; border-radius: 18px; }
            .page-header h1 { font-size: 24px; }
            .page-header-icon { width: 48px; height: 48px; font-size: 19px; border-radius: 14px; }
            .info-summary { flex-direction: column; text-align: center; padding: 18px; gap: 14px; }
            .info-meta { justify-content: center; }
            .form-actions-row {
                flex-direction: column-reverse; gap: 10px;
            }
            .form-actions-row a, .form-actions-row button {
                width: 100%; justify-content: center; text-align: center;
            }
            .btn-cancel, .btn-submit { padding: 14px 16px; }
            .slug-preview { flex-direction: column; text-align: center; gap: 12px; }
            .slug-preview-value { text-align: center; }
            .kbd-hint { display: none; }
        }
        @media (max-width: 480px) {
            .info-meta { flex-direction: column; align-items: stretch; gap: 6px; }
            .info-badge, .status-badge-inline, .info-projects { justify-content: center; }
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
    <div class="ambient-orb orb-1"></div>
    <div class="ambient-orb orb-2"></div>

    <!-- ==================== Top Bar ==================== -->
    <header class="top-bar">
        <div class="topbar-left">
            <a href="{{ route('admin.dashboard') }}" class="topbar-brand">
                <div class="topbar-logo"><i class="fas fa-shield-halved"></i></div>
                <span class="topbar-brand-text">MyApp</span>
            </a>
            <div class="topbar-divider"></div>
            <div class="breadcrumb-bar">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('admin.categories.index') }}">Kategori</a>
                <i class="fas fa-chevron-right"></i>
                <span class="current">{{ Str::limit($category->name, 22) }}</span>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-user-chip">
                <div class="topbar-avatar">{{ mb_substr(optional(auth()->user())->name ?? 'A', 0, 1) }}</div>
                <span class="topbar-user-name">{{ optional(auth()->user())->name ?? 'Admin' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn" title="Logout" aria-label="Logout">
                    <i class="fas fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </header>

    <!-- ==================== Page Content ==================== -->
    <div class="page-wrapper">

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
            <div class="page-header-icon">
                <i class="fas fa-pen-to-square"></i>
            </div>
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

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon">
                    <i class="fas fa-pen-to-square"></i>
                </div>
                <div>
                    <div class="form-card-header-text">Perbarui Nama</div>
                    <div class="form-card-header-sub">Ubah nama kategori sesuai kebutuhan</div>
                </div>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                <div class="field-group">
                    <label for="name">
                        Nama Kategori <span class="required">*</span>
                        <span class="char-count" id="charCount">{{ strlen(old('name', $category->name)) }}/60</span>
                    </label>
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

                <div class="form-divider"></div>

                <div class="form-actions-row">
                    <a href="{{ route('admin.categories.index') }}" class="btn-cancel">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn-submit" id="btnSubmit">
                        <i class="fas fa-check"></i>
                        <span id="btnText">Simpan Perubahan</span>
                        <span class="kbd-hint"><span class="kbd">Ctrl</span><span class="kbd">S</span></span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer Note -->
        <div class="footer-note">
            <p>
                <i class="fas fa-lock"></i>
                Perubahan tersimpan secara aman dan dapat dilacak di log aktivitas
            </p>
        </div>

    </div>

    <script>
        // === Elements ===
        var nameInput = document.getElementById('name');
        var slugPreview = document.getElementById('slugPreview');
        var slugPreviewValue = document.getElementById('slugPreviewValue');
        var slugChangeBadge = document.getElementById('slugChangeBadge');
        var charCount = document.getElementById('charCount');
        var originalSlug = '{{ $category->slug }}';

        // === Slug generator ===
        function toSlug(text) {
            return text
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }

        // === Character count & slug preview ===
        function updateCharCount(len) {
            charCount.textContent = len + '/60';
            charCount.classList.remove('warn', 'danger');
            if (len >= 55) charCount.classList.add('danger');
            else if (len >= 45) charCount.classList.add('warn');
        }

        nameInput.addEventListener('input', function() {
            var val = this.value;
            var len = val.length;
            updateCharCount(len);

            var newSlug = val.trim().length > 0 ? toSlug(val) : originalSlug;
            slugPreviewValue.textContent = newSlug;

            if (newSlug !== originalSlug) {
                slugPreview.classList.add('slug-preview-changed');
                slugPreview.classList.remove('has-value');
            } else {
                slugPreview.classList.remove('slug-preview-changed');
                slugPreview.classList.add('has-value');
            }
        });

        // Init char count
        updateCharCount(nameInput.value.length);

        // === Focus glow on icon ===
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

        // === Keyboard shortcut Ctrl+S ===
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('editForm').dispatchEvent(new Event('submit', { cancelable: true }));
            }
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

        // === Auto-focus ===
        nameInput.focus();
        nameInput.select();
    </script>
</body>
</html>