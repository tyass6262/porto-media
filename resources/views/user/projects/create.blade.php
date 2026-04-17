<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Project</title>
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
            position: relative;
            overflow-x: hidden;
            padding-bottom: 60px;
        }

        .bg-layer {
            position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none;
        }
        .bg-layer::before {
            content: ''; position: absolute; top: -40%; left: -20%;
            width: 80vw; height: 80vw;
            background: radial-gradient(circle, rgba(16,185,129,0.06) 0%, transparent 70%);
            animation: floatBlob1 20s ease-in-out infinite;
        }
        .bg-layer::after {
            content: ''; position: absolute; bottom: -30%; right: -20%;
            width: 70vw; height: 70vw;
            background: radial-gradient(circle, rgba(6,182,212,0.05) 0%, transparent 70%);
            animation: floatBlob2 25s ease-in-out infinite;
        }
        @keyframes floatBlob1 {
            0%,100%{transform:translate(0,0) scale(1)} 33%{transform:translate(10%,15%) scale(1.1)} 66%{transform:translate(-5%,8%) scale(.95)}
        }
        @keyframes floatBlob2 {
            0%,100%{transform:translate(0,0) scale(1)} 33%{transform:translate(-12%,-10%) scale(1.05)} 66%{transform:translate(8%,-5%) scale(.9)}
        }
        .grid-pattern {
            position: fixed; inset: 0; z-index: 1; pointer-events: none;
            background-image: linear-gradient(rgba(255,255,255,.015) 1px,transparent 1px), linear-gradient(90deg,rgba(255,255,255,.015) 1px,transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 80%);
        }
        .particles { position: fixed; inset: 0; z-index: 1; pointer-events: none; }
        .particle {
            position: absolute; width: 3px; height: 3px; background: var(--accent);
            border-radius: 50%; opacity: 0; animation: particleFloat linear infinite;
        }
        @keyframes particleFloat {
            0%{opacity:0;transform:translateY(100vh) scale(0)} 10%{opacity:.5} 90%{opacity:.2} 100%{opacity:0;transform:translateY(-10vh) scale(1)}
        }

        .top-nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10, 15, 26, 0.85);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 12px; text-decoration: none;
        }
        .nav-logo {
            width: 38px; height: 38px; border-radius: 11px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: white;
        }
        .nav-brand-text { font-size: 17px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; }
        .nav-actions { display: flex; align-items: center; gap: 10px; }
        .nav-user {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 14px 6px 6px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15);
            border-radius: 40px; color: var(--text-secondary); font-size: 13px;
            font-weight: 500; text-decoration: none; transition: all 0.25s;
        }
        .nav-user:hover { border-color: rgba(16,185,129,0.3); color: var(--text-primary); }
        .nav-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; color: white; font-weight: 700;
        }
        .nav-icon-btn {
            width: 38px; height: 38px; border-radius: 10px;
            background: rgba(255,255,255,0.04); border: 1px solid var(--input-border);
            color: var(--text-muted); cursor: pointer; font-size: 14px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s; text-decoration: none; position: relative;
        }
        .nav-icon-btn:hover { color: var(--text-primary); background: rgba(255,255,255,0.07); }
        .notif-dot {
            position: absolute; top: 7px; right: 7px;
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--danger); border: 2px solid var(--bg-primary);
        }

        .main-content {
            position: relative; z-index: 10;
            max-width: 720px; margin: 0 auto;
            padding: 40px 24px;
        }

        .page-header { margin-bottom: 32px; }
        .breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: var(--text-muted); margin-bottom: 16px;
        }
        .breadcrumb a { color: var(--text-muted); text-decoration: none; transition: color 0.2px; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb i { font-size: 10px; opacity: 0.5; }
        .breadcrumb .current { color: var(--text-secondary); font-weight: 500; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; margin-bottom: 6px; }
        .page-header p { font-size: 14.5px; color: var(--text-muted); line-height: 1.5; }

        .form-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px; padding: 36px;
            margin-bottom: 20px;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        .form-card:nth-child(2) { animation-delay: 0.08s; }
        .form-card:nth-child(3) { animation-delay: 0.16s; }
        .form-card:nth-child(4) { animation-delay: 0.24s; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); filter: blur(2px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }
        .form-card-header {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 24px;
        }
        .form-card-header i {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 15px;
        }
        .icon-green { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.2); color: var(--accent); }
        .icon-cyan { background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.2); color: var(--cyan); }
        .icon-amber { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.2); color: var(--amber); }
        .icon-indigo { background: var(--indigo-subtle); border: 1px solid rgba(129,140,248,0.2); color: var(--indigo); }
        .form-card-header span { font-size: 15px; font-weight: 700; color: var(--text-primary); }

        .field-group { margin-bottom: 20px; }
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

        .field-input.no-icon { padding-left: 16px; }

        textarea.field-input {
            min-height: 120px; resize: vertical; line-height: 1.65;
        }
        .char-counter {
            text-align: right; font-size: 12px; color: var(--text-muted);
            margin-top: 6px; transition: color 0.2s;
        }
        .char-counter.warn { color: var(--amber); }
        .char-counter.limit { color: var(--danger); }

        .select-wrapper { position: relative; }
        .select-wrapper::after {
            content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            position: absolute; right: 16px; top: 50%; transform: translateY(-50%);
            font-size: 12px; color: var(--text-muted); pointer-events: none;
        }
        select.field-input { appearance: none; -webkit-appearance: none; padding-right: 44px; cursor: pointer; }
        select.field-input option { background: #1e293b; color: var(--text-primary); padding: 8px; }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 8px;
        }
        .category-chip {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 14px; border-radius: 10px;
            background: var(--input-bg); border: 1.5px solid var(--input-border);
            cursor: pointer; transition: all 0.25s;
            user-select: none;
        }
        .category-chip:hover { border-color: rgba(255,255,255,0.18); background: rgba(30,41,59,0.6); }
        .category-chip input[type="checkbox"] { display: none; }
        .chip-check {
            width: 18px; height: 18px; border-radius: 5px;
            border: 1.5px solid var(--input-border);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.25s; flex-shrink: 0;
        }
        .chip-check i {
            font-size: 10px; color: white; opacity: 0; transform: scale(0);
            transition: all 0.25s;
        }
        .category-chip input:checked ~ .chip-check {
            background: var(--accent); border-color: var(--accent);
        }
        .category-chip input:checked ~ .chip-label { color: var(--text-primary); }
        .category-chip.selected {
            border-color: var(--accent);
            background: var(--accent-subtle);
        }
        .chip-label { font-size: 13.5px; color: var(--text-secondary); transition: color 0.2s; }

        .upload-zone {
            border: 2px dashed var(--input-border);
            border-radius: 16px; padding: 36px 24px;
            text-align: center; cursor: pointer;
            transition: all 0.3s; position: relative;
            background: rgba(15,23,42,0.4);
        }
        .upload-zone:hover, .upload-zone.dragover {
            border-color: var(--accent);
            background: var(--accent-subtle);
        }
        .upload-zone.dragover { transform: scale(1.01); }
        .upload-zone input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer;
        }
        .upload-icon {
            width: 56px; height: 56px; border-radius: 16px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: var(--accent); margin: 0 auto 16px;
            transition: transform 0.3s;
        }
        .upload-zone:hover .upload-icon { transform: translateY(-2px); }
        .upload-title { font-size: 15px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; }
        .upload-hint { font-size: 13px; color: var(--text-muted); line-height: 1.5; }
        .upload-hint span { color: var(--accent); font-weight: 600; }
        .file-list { display: flex; flex-direction: column; gap: 8px; margin-top: 16px; }
        .file-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px; border-radius: 10px;
            background: var(--input-bg); border: 1px solid var(--input-border);
            font-size: 13px; color: var(--text-secondary);
            animation: fileIn 0.3s ease;
        }
        @keyframes fileIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .file-item i.file-type-icon { font-size: 18px; color: var(--cyan); flex-shrink: 0; }
        .file-item .file-name { flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .file-item .file-size { color: var(--text-muted); font-size: 12px; flex-shrink: 0; }
        .file-item .file-remove {
            width: 26px; height: 26px; border-radius: 6px; background: none;
            border: none; color: var(--text-muted); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; transition: all 0.2s; flex-shrink: 0;
        }
        .file-item .file-remove:hover { background: var(--danger-bg); color: var(--danger); }

        .embed-list { display: flex; flex-direction: column; gap: 10px; }
        .embed-row {
            display: flex; gap: 8px; align-items: center;
        }
        .embed-input { flex: 1; }
        .embed-input input {
            width: 100%; padding: 11px 14px 11px 42px;
            background: var(--input-bg); border: 1.5px solid var(--input-border);
            border-radius: 10px; color: var(--text-primary);
            font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s; outline: none;
        }
        .embed-input input::placeholder { color: var(--text-muted); font-size: 13px; }
        .embed-input input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--input-focus); background: rgba(15,23,42,1); }
        .embed-input .input-icon { font-size: 13px; }
        .btn-remove-embed {
            width: 34px; height: 34px; border-radius: 8px;
            background: rgba(255,255,255,0.03); border: 1px solid var(--input-border);
            color: var(--text-muted); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; transition: all 0.2s; flex-shrink: 0;
        }
        .btn-remove-embed:hover { background: var(--danger-bg); color: var(--danger); border-color: rgba(239,68,68,0.2); }
        .btn-add-embed {
            width: 34px; height: 34px; border-radius: 8px;
            background: var(--accent-subtle); border: 1.5px solid rgba(16,185,129,0.2);
            color: var(--accent); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; transition: all 0.2s; flex-shrink: 0;
        }
        .btn-add-embed:hover { background: rgba(16,185,129,0.15); border-color: rgba(16,185,129,0.35); }
        .embed-hint {
            font-size: 12px; color: var(--text-muted); margin-top: 8px;
            display: flex; align-items: center; gap: 6px;
        }
        .embed-hint i { font-size: 11px; }

        .form-actions-row {
            display: flex; justify-content: flex-end; gap: 12px; margin-top: 28px;
            padding-top: 24px; border-top: 1px solid var(--card-border);
        }
        .btn-cancel {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 24px; border-radius: 12px;
            background: rgba(255,255,255,0.04); border: 1.5px solid var(--input-border);
            color: var(--text-secondary); font-size: 14px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.25s; text-decoration: none;
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.07); color: var(--text-primary); border-color: rgba(255,255,255,0.15); }
        .btn-submit {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 28px; border-radius: 12px;
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

        .session-alert { margin-bottom: 20px; }
        .alert-custom {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px; padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: #fca5a5; animation: shakeIn 0.5s ease;
        }
        .alert-custom i { color: var(--danger); font-size: 16px; flex-shrink: 0; }

        @media (max-width: 768px) {
            .top-nav { padding: 0 16px; }
            .nav-brand-text { display: none; }
            .main-content { padding: 20px 16px; }
            .form-card { padding: 24px 20px; }
            .page-header h1 { font-size: 22px; }
            .category-grid { grid-template-columns: 1fr; }
            .form-actions-row { flex-direction: column; }
            .form-actions-row a, .form-actions-row button { width: 100%; justify-content: center; text-align: center; }
            .btn-cancel, .btn-submit { padding: 13px 16px; }
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

    <nav class="top-nav">
        <a href="/" class="nav-brand">
            <div class="nav-logo"><i class="fas fa-shield-halved"></i></div>
            <span class="nav-brand-text">MyApp</span>
        </a>
        <div class="nav-actions">
            <a href="#" class="nav-user">
                <div class="nav-avatar">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</div>
                <span>{{ auth()->user()->name ?? 'User' }}</span>
            </a>
            <a href="#" class="nav-icon-btn" title="Notifikasi" aria-label="Notifikasi">
                <i class="fas fa-bell"></i>
                <span class="notif-dot"></span>
            </a>
        </div>
    </nav>

    <main class="main-content">

        @if(session('error'))
        <div class="session-alert">
            <div class="alert-custom">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <div class="page-header">
            <div class="breadcrumb">
                <a href="{{ route('user.projects.index') }}">Project</a>
                <i class="fas fa-chevron-right"></i>
                <span class="current">Buat Baru</span>
            </div>
            <h1>Buat Project Baru</h1>
            <p>Isi detail project yang ingin kamu buat</p>
        </div>

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

        <form action="{{ route('user.projects.store') }}" method="POST" enctype="multipart/form-data" id="projectForm">
            @csrf

            <div class="form-card">
                <div class="form-card-header">
                    <i class="icon-green"><i class="fas fa-file-lines"></i></i>
                    <span>Informasi Dasar</span>
                </div>

                <div class="field-group">
                    <label for="title">Judul Project <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <i class="fas fa-heading input-icon"></i>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="field-input {{ $errors->has('title') ? 'input-error' : '' }}"
                            placeholder="Contoh: Website E-Commerce"
                            value="{{ old('title') }}"
                            required
                            maxlength="120"
                            autocomplete="off"
                        >
                    </div>
                    <div class="char-counter" id="titleCounter">0 / 120</div>
                    @if($errors->has('title'))
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('title') }}</div>
                    @endif
                </div>

                <div class="field-group" style="margin-bottom:0">
                    <label for="description">Deskripsi</label>
                    <div class="input-wrapper">
                        <i class="fas fa-align-left input-icon" style="top:16px;transform:none"></i>
                        <textarea
                            id="description"
                            name="description"
                            class="field-input {{ $errors->has('description') ? 'input-error' : '' }}"
                            placeholder="Jelaskan tentang project ini..."
                            rows="5"
                            maxlength="2000"
                        >{{ old('description') }}</textarea>
                    </div>
                    <div class="char-counter" id="descCounter">0 / 2000</div>
                    @if($errors->has('description'))
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('description') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <i class="icon-cyan"><i class="fas fa-sliders"></i></i>
                    <span>Pengaturan</span>
                </div>

                <div class="field-group">
                    <label>Status</label>
                    <div class="select-wrapper">
                        <select id="status" name="status" class="field-input no-icon">
                            <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', '') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div style="font-size:12px;color:var(--text-muted);margin-top:6px;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-circle-info" style="font-size:11px;opacity:0.6"></i>
                        Draft hanya terlihat oleh kamu, Published terlihat oleh semua pengguna
                    </div>
                </div>

                <div class="field-group" style="margin-bottom:0">
                    <label>Kategori</label>
                    <div class="category-grid">
                        @foreach($categories as $cat)
                        <label class="category-chip {{ in_array($cat->id, old('categories', [])) ? 'selected' : '' }}">
                            <input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ in_array($cat->id, old('categories', [])) ? 'checked' : '' }}>
                            <span class="chip-check"><i class="fas fa-check"></i></span>
                            <span class="chip-label">{{ $cat->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    @if($errors->has('categories'))
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('categories') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <i class="icon-amber"><i class="fas fa-cloud-arrow-up"></i></i>
                    <span>Upload Media</span>
                </div>

                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="media[]" multiple id="fileInput" accept="image/*,video/*,.pdf,.doc,.docx,.zip" multiple>
                    <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                    <div class="upload-title">Seret file ke sini atau klik untuk memilih</div>
                    <div class="upload-hint">Gambar, video, PDF, dokumen — <span>maks 10MB per file</span></div>
                </div>

                <div class="file-list" id="fileList"></div>
                @if($errors->has('media'))
                <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('media') }}</div>
                @endif
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <i class="icon-indigo"><i class="fas fa-code"></i></i>
                    <span>Embed URL</span>
                </div>

                <div style="font-size:13px;color:var(--text-muted);margin-bottom:16px;line-height:1.6;">
                    Tambahkan embed dari YouTube, Vimeo, atau layanan lainnya. Biarkan kosong jika tidak diperlukan.
                </div>

                <div class="embed-list" id="embedList">
                    @php
                        $oldEmbeds = array_values(old('embed_urls', []));
                        if (empty($oldEmbeds)) $oldEmbeds = [''];
                    @endphp
                    @foreach($oldEmbeds as $i => $embedUrl)
                    <div class="embed-row">
                        <div class="embed-input">
                            <i class="fas fa-link input-icon" style="font-size:13px"></i>
                            <input
                                type="url"
                                name="embed_urls[]"
                                placeholder="https://youtube.com/watch?v=..."
                                value="{{ $embedUrl }}"
                            >
                        </div>
                        <button type="button" class="btn-remove-embed" onclick="removeEmbedRow(this)" title="Hapus" aria-label="Hapus embed">
                            <i class="fas fa-xmark"></i>
                        </button>
                    @endforeach
                </div>

                <button type="button" class="btn-add-embed" onclick="addEmbedRow()" title="Tambah embed" aria-label="Tambah embed">
                    <i class="fas fa-plus"></i>
                </button>

                <div class="embed-hint">
                    <i class="fas fa-circle-info" style="font-size:11px;opacity:0.6"></i>
                    <span>Gunakan format URL yang valid. Bisa berupa YouTube, Vimeo, Google Maps, dll.</span>
                </div>
            </div>

            <div class="form-actions-row">
                <a href="{{ route('user.projects.index') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn-submit" id="btnSubmit">
                    <i class="fas fa-check"></i>
                    <span id="btnText">Buat Project</span>
                </button>
            </div>
        </form>
    </main>

    <script>
        var titleInput = document.getElementById('title');
        var titleCounter = document.getElementById('titleCounter');
        var descInput = document.getElementById('description');
        var descCounter = document.getElementById('descCounter');

        titleInput.addEventListener('input', function() {
            var len = this.value.length;
            titleCounter.textContent = len + ' / 120';
            titleCounter.className = 'char-counter' + (len > 100 ? ' warn' : '') + (len >= 120 ? ' limit' : '');
        });

        descInput.addEventListener('input', function() {
            var len = this.value.length;
            descCounter.textContent = len + ' / 2000';
            descCounter.className = 'char-counter' + (len > 1600 ? ' warn' : '') + (len >= 2000 ? ' limit' : '');
        });

        titleInput.dispatchEvent(new Event('input'));
        descInput.dispatchEvent(new Event('input'));

        document.querySelectorAll('.category-chip input').forEach(function(cb) {
            cb.addEventListener('change', function() {
                this.closest('.category-chip').classList.toggle('selected', this.checked);
            });
        });

        var fileInput = document.getElementById('fileInput');
        var fileList = document.getElementById('fileList');
        var uploadZone = document.getElementById('uploadZone');
        var selectedFiles = [];

        function getFileIcon(name) {
            var ext = name.split('.').pop().toLowerCase();
            var map = {
                jpg: 'fa-file-image', jpeg: 'fa-file-image', png: 'fa-file-image', gif: 'fa-file-image', webp: 'fa-file-image', svg: 'fa-file-image',
                mp4: 'fa-file-video', mov: 'fa-file-video', avi: 'fa-file-video', mkv: 'fa-file-video',
                pdf: 'fa-file-pdf',
                doc: 'fa-file-word', docx: 'fa-file-word',
                zip: 'fa-file-zipper', rar: 'fa-file-zipper',
            };
            return map[ext] || 'fa-file';
        }

        function formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        }

        function renderFiles() {
            fileList.innerHTML = '';
            selectedFiles.forEach(function(file, idx) {
                var item = document.createElement('div');
                item.className = 'file-item';
                item.innerHTML =
                    '<i class="fas ' + getFileIcon(file.name) + ' file-type-icon"></i>' +
                    '<span class="file-name">' + file.name + '</span>' +
                    '<span class="file-size">' + formatSize(file.size) + '</span>' +
                    '<button type="button" class="file-remove" data-idx="' + idx + '" aria-label="Hapus file"><i class="fas fa-xmark"></i></button>';
                fileList.appendChild(item);
            });

            fileList.querySelectorAll('.file-remove').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    selectedFiles.splice(parseInt(this.dataset.idx), 1);
                    updateFileInput();
                    renderFiles();
                });
            });
        }

        function updateFileInput() {
            var dt = new DataTransfer();
            selectedFiles.forEach(function(f) { dt.items.add(f); });
            fileInput.files = dt.files;
        }

        fileInput.addEventListener('change', function() {
            var newFiles = Array.from(this.files);
            newFiles.forEach(function(f) {
                var dup = selectedFiles.some(function(sf) { return sf.name === f.name && sf.size === f.size; });
                if (!dup) selectedFiles.push(f);
            });
            updateFileInput();
            renderFiles();
        });

        uploadZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        uploadZone.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });
        uploadZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            var dropped = Array.from(e.dataTransfer.files);
            dropped.forEach(function(f) {
                var dup = selectedFiles.some(function(sf) { return sf.name === f.name && sf.size === f.size; });
                if (!dup) selectedFiles.push(f);
            });
            updateFileInput();
            renderFiles();
        });

        function addEmbedRow() {
            var list = document.getElementById('embedList');
            var row = document.createElement('div');
            row.className = 'embed-row';
            row.innerHTML =
                '<div class="embed-input">' +
                    '<i class="fas fa-link input-icon" style="font-size:13px"></i>' +
                    '<input type="url" name="embed_urls[]" placeholder="https://youtube.com/watch?v=...">' +
                '</div>' +
                '<button type="button" class="btn-remove-embed" onclick="removeEmbedRow(this)" title="Hapus" aria-label="Hapus embed">' +
                    '<i class="fas fa-xmark"></i>' +
                '</button>';
            list.appendChild(row);
            row.querySelector('input').focus();
        }

        function removeEmbedRow(btn) {
            btn.closest('.embed-row').remove();
        }

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

        document.getElementById('projectForm').addEventListener('submit', function() {
            var btn = document.getElementById('btnSubmit');
            var txt = document.getElementById('btnText');
            btn.disabled = true;
            txt.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:6px"></i>Membuat Project...';
        });

        document.querySelectorAll('a[href*="logout"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = this.href;
                var csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = document.querySelector('meta[name="csrf-token"]')?.content || '';
                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            });
        });

        (function() {
            var c = document.getElementById('particles');
            for (var i = 0; i < 18; i++) {
                var p = document.createElement('div');
                p.classList.add('particle');
                p.style.left = Math.random() * 100 + '%';
                p.style.width = p.style.height = (Math.random() * 3 + 1.5) + 'px';
                p.style.animationDuration = (Math.random() * 15 + 10) + 's';
                p.style.animationDelay = (Math.random() * 15) + 's';
                p.style.background = Math.random() > 0.5 ? 'rgba(16,185,129,0.5)' : 'rgba(6,182,212,0.35)';
                c.appendChild(p);
            }
        })();

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
