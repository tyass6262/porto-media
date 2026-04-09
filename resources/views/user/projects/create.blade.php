<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Project</title>
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
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* === Background === */
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
            mask-image: radial-gradient(ellipse at center top, black 20%, transparent 70%);
        }
        .particles { position: fixed; inset: 0; z-index: 1; pointer-events: none; }
        .particle {
            position: absolute; width: 3px; height: 3px; background: var(--accent);
            border-radius: 50%; opacity: 0; animation: particleFloat linear infinite;
        }
        @keyframes particleFloat {
            0%{opacity:0;transform:translateY(100vh) scale(0)} 10%{opacity:.5} 90%{opacity:.2} 100%{opacity:0;transform:translateY(-10vh) scale(1)}
        }

        /* === Navbar === */
        .top-nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10,15,26,0.8); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 12px; text-decoration: none;
        }
        .nav-logo {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: white;
        }
        .nav-brand-text { font-size: 18px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; }
        .nav-back {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 16px; border-radius: 10px;
            background: rgba(255,255,255,0.04); border: 1px solid var(--input-border);
            color: var(--text-secondary); font-size: 13px; font-weight: 500;
            text-decoration: none; transition: all 0.25s;
        }
        .nav-back:hover { background: rgba(255,255,255,0.07); color: var(--text-primary); border-color: rgba(255,255,255,0.15); }

        /* === Main === */
        .main-content {
            position: relative; z-index: 10;
            max-width: 780px; margin: 0 auto;
            padding: 40px 24px 80px;
            animation: fadeUp 0.6s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); filter: blur(3px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        /* Page header */
        .page-header { margin-bottom: 36px; }
        .page-header .breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: var(--text-muted); margin-bottom: 16px;
        }
        .breadcrumb a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb i { font-size: 10px; opacity: 0.5; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; margin-bottom: 6px; }
        .page-header p { font-size: 14.5px; color: var(--text-muted); }

        /* === Form Card === */
        .form-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 36px;
            margin-bottom: 20px;
        }

        .section-label {
            display: flex; align-items: center; gap: 10px;
            font-size: 14px; font-weight: 700; color: var(--text-primary);
            margin-bottom: 24px; letter-spacing: 0.2px;
        }
        .section-label i {
            width: 32px; height: 32px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }
        .section-label .icon-green { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: var(--accent); }
        .section-label .icon-cyan { background: rgba(6,182,212,0.1); border: 1px solid rgba(6,182,212,0.2); color: var(--cyan); }
        .section-label .icon-amber { background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2); color: var(--amber); }

        /* Input groups */
        .field-group { margin-bottom: 22px; }
        .field-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-secondary); margin-bottom: 8px; letter-spacing: 0.3px;
        }
        .field-group label .required { color: var(--danger); margin-left: 2px; }

        .input-wrapper {
            position: relative; display: flex; align-items: center;
        }
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

        /* Tanpa icon */
        .field-input.no-icon { padding-left: 16px; }

        /* Textarea */
        textarea.field-input {
            min-height: 120px; resize: vertical; line-height: 1.65;
        }

        /* Character counter */
        .char-counter {
            text-align: right; font-size: 12px; color: var(--text-muted);
            margin-top: 6px; transition: color 0.2s;
        }
        .char-counter.warn { color: var(--amber); }
        .char-counter.limit { color: var(--danger); }

        /* Select */
        .select-wrapper {
            position: relative;
        }
        .select-wrapper::after {
            content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            position: absolute; right: 16px; top: 50%; transform: translateY(-50%);
            font-size: 12px; color: var(--text-muted); pointer-events: none;
        }
        select.field-input {
            appearance: none; -webkit-appearance: none;
            padding-right: 44px; cursor: pointer;
        }
        select.field-input option {
            background: #1e293b; color: var(--text-primary); padding: 8px;
        }

        /* === Checkbox Grid (Kategori) === */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 10px;
        }
        .category-chip {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            cursor: pointer; transition: all 0.25s;
            user-select: none;
        }
        .category-chip:hover {
            border-color: rgba(255,255,255,0.18);
            background: rgba(30,41,59,0.6);
        }
        .category-chip input[type="checkbox"] { display: none; }
        .chip-check {
            width: 18px; height: 18px; border-radius: 5px;
            border: 1.5px solid var(--input-border);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.25s; flex-shrink: 0;
        }
        .chip-check i {
            font-size: 10px; color: white; opacity: 0; transform: scale(0); transition: all 0.25s;
        }
        .category-chip input:checked ~ .chip-check {
            background: var(--accent); border-color: var(--accent);
        }
        .category-chip input:checked ~ .chip-check i {
            opacity: 1; transform: scale(1);
        }
        .category-chip input:checked ~ .chip-label {
            color: var(--text-primary);
        }
        .chip-label {
            font-size: 13.5px; color: var(--text-secondary); transition: color 0.2s;
        }
        .category-chip.selected {
            border-color: var(--accent);
            background: var(--accent-subtle);
        }

        /* === File Upload === */
        .upload-zone {
            border: 2px dashed var(--input-border);
            border-radius: 16px;
            padding: 40px 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            background: rgba(15,23,42,0.4);
        }
        .upload-zone:hover, .upload-zone.dragover {
            border-color: var(--accent);
            background: var(--accent-subtle);
        }
        .upload-zone.dragover {
            transform: scale(1.01);
        }
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

        /* File preview list */
        .file-list {
            display: flex; flex-direction: column; gap: 8px;
            margin-top: 16px;
        }
        .file-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
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
            width: 24px; height: 24px; border-radius: 6px;
            background: none; border: none; color: var(--text-muted);
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 12px; transition: all 0.2s; flex-shrink: 0;
        }
        .file-item .file-remove:hover { background: var(--danger-bg); color: var(--danger); }

        /* === Form Actions === */
        .form-actions {
            display: flex; align-items: center; gap: 12px;
            justify-content: flex-end;
            padding-top: 8px;
        }
        .btn-cancel {
            padding: 13px 24px; border-radius: 12px;
            background: rgba(255,255,255,0.04); border: 1.5px solid var(--input-border);
            color: var(--text-secondary); font-size: 14px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.25s; text-decoration: none;
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.07); color: var(--text-primary); border-color: rgba(255,255,255,0.15); }
        .btn-submit {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 13px 28px; border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), #059669);
            color: white; border: none;
            font-size: 14px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.3s;
            position: relative; overflow: hidden; letter-spacing: 0.2px;
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

        /* === Error styling === */
        .field-input.input-error { border-color: var(--danger); box-shadow: 0 0 0 3px rgba(239,68,68,0.12); }
        .field-error { font-size: 12px; color: #fca5a5; margin-top: 6px; display: flex; align-items: center; gap: 6px; }
        .field-error i { font-size: 11px; }

        /* Session errors */
        .session-alert { max-width: 780px; margin: 0 auto; padding: 0 24px; }
        .alert-custom {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px; padding: 14px 18px; margin-top: 20px; margin-bottom: 8px;
            display: flex; align-items: flex-start; gap: 12px;
            font-size: 13.5px; color: #fca5a5; line-height: 1.5;
            animation: shakeIn 0.5s ease;
        }
        .alert-custom i { color: var(--danger); font-size: 16px; flex-shrink: 0; margin-top: 1px; }
        @keyframes shakeIn {
            0%{opacity:0;transform:translateX(-10px)} 25%{transform:translateX(6px)} 50%{transform:translateX(-4px)} 75%{transform:translateX(2px)} 100%{opacity:1;transform:translateX(0)}
        }

        /* Validation errors list */
        .validation-errors {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px; padding: 16px 20px; margin-bottom: 20px;
            animation: shakeIn 0.5s ease;
        }
        .validation-errors .error-title {
            font-size: 13px; font-weight: 700; color: #fca5a5; margin-bottom: 8px;
            display: flex; align-items: center; gap: 8px;
        }
        .validation-errors .error-title i { font-size: 14px; }
        .validation-errors ul {
            list-style: none; padding: 0; margin: 0;
            display: flex; flex-direction: column; gap: 4px;
        }
        .validation-errors ul li {
            font-size: 13px; color: #fca5a5; padding-left: 20px; position: relative;
        }
        .validation-errors ul li::before {
            content: ''; position: absolute; left: 4px; top: 50%;
            width: 5px; height: 5px; border-radius: 50%; background: var(--danger);
            transform: translateY(-50%);
        }

        /* === Responsive === */
        @media (max-width: 768px) {
            .top-nav { padding: 0 16px; }
            .nav-brand-text { display: none; }
            .main-content { padding: 24px 16px 60px; }
            .form-card { padding: 24px; }
            .page-header h1 { font-size: 24px; }
            .category-grid { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
            .form-actions a, .form-actions button { width: 100%; justify-content: center; text-align: center; }
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
        <a href="{{ route('user.projects.index') }}" class="nav-back">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
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
            <div class="breadcrumb">
                <a href="{{ route('user.projects.index') }}">Projects</a>
                <i class="fas fa-chevron-right"></i>
                <span style="color:var(--text-secondary)">Tambah Project</span>
            </div>
            <h1>Tambah Project Baru</h1>
            <p>Isi informasi di bawah untuk membuat project baru</p>
        </div>

        <form action="{{ route('user.projects.store') }}" method="POST" enctype="multipart/form-data" id="projectForm">
            @csrf

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

            <!-- Section 1: Informasi Dasar -->
            <div class="form-card">
                <div class="section-label">
                    <i class="icon-green"><i class="fas fa-file-lines"></i></i>
                    Informasi Dasar
                </div>

                <!-- Title -->
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
                        >
                    </div>
                    <div class="char-counter" id="titleCounter">0 / 120</div>
                    @if($errors->has('title'))
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('title') }}</div>
                    @endif
                </div>

                <!-- Description -->
                <div class="field-group" style="margin-bottom:0">
                    <label for="description">Deskripsi</label>
                    <div class="input-wrapper">
                        <i class="fas fa-align-left input-icon" style="top:16px;transform:none"></i>
                        <textarea
                            id="description"
                            name="description"
                            class="field-input {{ $errors->has('description') ? 'input-error' : '' }}"
                            placeholder="Jelaskan tentang project ini secara singkat..."
                            maxlength="1000"
                        >{{ old('description') }}</textarea>
                    </div>
                    <div class="char-counter" id="descCounter">0 / 1000</div>
                    @if($errors->has('description'))
                    <div class="field-error"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('description') }}</div>
                    @endif
                </div>
            </div>

            <!-- Section 2: Pengaturan -->
            <div class="form-card">
                <div class="section-label">
                    <i class="icon-cyan"><i class="fas fa-sliders"></i></i>
                    Pengaturan
                </div>

                <!-- Status -->
                <div class="field-group">
                    <label for="status">Status</label>
                    <div class="select-wrapper">
                        <select id="status" name="status" class="field-input no-icon">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>

                <!-- Kategori -->
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
                    <div class="field-error" style="margin-top:10px"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('categories') }}</div>
                    @endif
                </div>
            </div>

            <!-- Section 3: Media -->
            <div class="form-card">
                <div class="section-label">
                    <i class="icon-amber"><i class="fas fa-cloud-arrow-up"></i></i>
                    Upload Media
                </div>

                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="media[]" multiple id="fileInput" accept="image/*,video/*,.pdf,.doc,.docx,.zip">
                    <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                    <div class="upload-title">Seret file ke sini atau klik untuk memilih</div>
                    <div class="upload-hint">Mendukung gambar, video, PDF, dokumen — <span>maksimal 10MB per file</span></div>
                </div>

                <div class="file-list" id="fileList"></div>

                @if($errors->has('media'))
                <div class="field-error" style="margin-top:10px"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('media') }}</div>
                @endif
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('user.projects.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit" id="btnSubmit">
                    <i class="fas fa-check"></i>
                    <span id="btnText">Simpan Project</span>
                </button>
            </div>
        </form>
    </main>

    <script>
        // === Character Counters ===
        const titleInput = document.getElementById('title');
        const titleCounter = document.getElementById('titleCounter');
        const descInput = document.getElementById('description');
        const descCounter = document.getElementById('descCounter');

        titleInput.addEventListener('input', function() {
            const len = this.value.length;
            titleCounter.textContent = len + ' / 120';
            titleCounter.className = 'char-counter' + (len > 100 ? ' warn' : '') + (len >= 120 ? ' limit' : '');
        });

        descInput.addEventListener('input', function() {
            const len = this.value.length;
            descCounter.textContent = len + ' / 1000';
            descCounter.className = 'char-counter' + (len > 800 ? ' warn' : '') + (len >= 1000 ? ' limit' : '');
        });

        // Trigger counter untuk old values
        titleInput.dispatchEvent(new Event('input'));
        descInput.dispatchEvent(new Event('input'));

        // === Category chip selected state ===
        document.querySelectorAll('.category-chip input').forEach(cb => {
            cb.addEventListener('change', function() {
                this.closest('.category-chip').classList.toggle('selected', this.checked);
            });
        });

        // === File Upload Preview ===
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');
        const uploadZone = document.getElementById('uploadZone');
        let selectedFiles = [];

        function getFileIcon(name) {
            const ext = name.split('.').pop().toLowerCase();
            const map = {
                jpg: 'fa-file-image', jpeg: 'fa-file-image', png: 'fa-file-image', gif: 'fa-file-image', webp: 'fa-file-image', svg: 'fa-file-image',
                mp4: 'fa-file-video', mov: 'fa-file-video', avi: 'fa-file-video', mkv: 'fa-file-video',
                pdf: 'fa-file-pdf',
                doc: 'fa-file-word', docx: 'fa-file-word',
                zip: 'fa-file-zipper', rar: 'fa-file-zipper', '7z': 'fa-file-zipper',
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
            selectedFiles.forEach((file, idx) => {
                const item = document.createElement('div');
                item.className = 'file-item';
                item.innerHTML = `
                    <i class="fas ${getFileIcon(file.name)} file-type-icon"></i>
                    <span class="file-name">${file.name}</span>
                    <span class="file-size">${formatSize(file.size)}</span>
                    <button type="button" class="file-remove" data-idx="${idx}" aria-label="Hapus file">
                        <i class="fas fa-xmark"></i>
                    </button>
                `;
                fileList.appendChild(item);
            });

            // Event hapus file dari preview
            fileList.querySelectorAll('.file-remove').forEach(btn => {
                btn.addEventListener('click', function() {
                    const idx = parseInt(this.dataset.idx);
                    selectedFiles.splice(idx, 1);
                    updateFileInput();
                    renderFiles();
                });
            });
        }

        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(f => dt.items.add(f));
            fileInput.files = dt.files;
        }

        fileInput.addEventListener('change', function() {
            const newFiles = Array.from(this.files);
            // Filter duplikat berdasarkan nama + ukuran
            newFiles.forEach(f => {
                const dup = selectedFiles.some(sf => sf.name === f.name && sf.size === f.size);
                if (!dup) selectedFiles.push(f);
            });
            updateFileInput();
            renderFiles();
        });

        // Drag & Drop
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
            const dropped = Array.from(e.dataTransfer.files);
            dropped.forEach(f => {
                const dup = selectedFiles.some(sf => sf.name === f.name && sf.size === f.size);
                if (!dup) selectedFiles.push(f);
            });
            updateFileInput();
            renderFiles();
        });

        // === Focus glow pada icon ===
        document.querySelectorAll('.input-wrapper .field-input').forEach(input => {
            input.addEventListener('focus', () => {
                const icon = input.closest('.input-wrapper').querySelector('.input-icon');
                if (icon) icon.style.color = 'var(--accent)';
            });
            input.addEventListener('blur', () => {
                const icon = input.closest('.input-wrapper').querySelector('.input-icon');
                if (icon) icon.style.color = '';
            });
        });

        // === Loading state submit ===
        document.getElementById('projectForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            const btnText = document.getElementById('btnText');
            btn.disabled = true;
            btnText.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:6px"></i>Menyimpan...';
        });

        // === Particles ===
        (function() {
            const c = document.getElementById('particles');
            for (let i = 0; i < 18; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                p.style.left = Math.random() * 100 + '%';
                p.style.width = p.style.height = (Math.random() * 3 + 1.5) + 'px';
                p.style.animationDuration = (Math.random() * 15 + 10) + 's';
                p.style.animationDelay = (Math.random() * 15) + 's';
                p.style.background = Math.random() > 0.5 ? 'rgba(16,185,129,0.5)' : 'rgba(6,182,212,0.35)';
                c.appendChild(p);
            }
        })();
    </script>
</body>
</html>