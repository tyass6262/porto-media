<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} — Detail Project</title>
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
            max-width: 900px; margin: 0 auto;
            padding: 40px 24px 80px;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: var(--text-muted); margin-bottom: 28px;
        }
        .breadcrumb a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb i { font-size: 10px; opacity: 0.5; }

        /* Hero Section */
        .detail-hero {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); filter: blur(3px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        .detail-hero::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--cyan));
        }

        .hero-glow {
            position: absolute; top: -80px; right: -80px;
            width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(16,185,129,0.08), transparent 70%);
            border-radius: 50%; pointer-events: none;
        }

        .hero-top {
            display: flex; align-items: flex-start; justify-content: space-between;
            gap: 20px; margin-bottom: 20px; position: relative; z-index: 2;
            flex-wrap: wrap;
        }

        .hero-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: var(--accent); flex-shrink: 0;
        }

        .hero-title-area { flex: 1; min-width: 0; }
        .hero-title-area h1 {
            font-size: 28px; font-weight: 800; color: var(--text-primary);
            letter-spacing: -0.5px; line-height: 1.25; margin-bottom: 6px;
            word-break: break-word;
        }

        .hero-actions {
            display: flex; gap: 8px; flex-shrink: 0;
        }
        .btn-action {
            width: 40px; height: 40px; border-radius: 10px;
            background: rgba(255,255,255,0.04); border: 1px solid var(--input-border);
            color: var(--text-muted); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; transition: all 0.25s; text-decoration: none;
        }
        .btn-action:hover { background: rgba(255,255,255,0.07); color: var(--text-primary); border-color: rgba(255,255,255,0.15); }
        .btn-action.danger:hover { background: var(--danger-bg); color: var(--danger); border-color: rgba(239,68,68,0.2); }

        .hero-desc {
            font-size: 15px; color: var(--text-secondary); line-height: 1.75;
            position: relative; z-index: 2; word-break: break-word;
        }

        .hero-meta-row {
            display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
            margin-top: 24px; position: relative; z-index: 2;
        }

        .meta-badge {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 6px 14px; border-radius: 20px;
            font-size: 12.5px; font-weight: 600; letter-spacing: 0.2px;
        }
        .meta-badge i { font-size: 11px; }

        .badge-status-published {
            background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: var(--accent);
        }
        .badge-status-draft {
            background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2); color: var(--amber);
        }

        .meta-text {
            display: flex; align-items: center; gap: 7px;
            font-size: 13px; color: var(--text-muted);
        }
        .meta-text i { font-size: 12px; opacity: 0.7; }

        /* === Section Cards === */
        .section-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 20px;
            animation: fadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        .section-card:nth-child(2) { animation-delay: 0.08s; }
        .section-card:nth-child(3) { animation-delay: 0.16s; }

        .section-label {
            display: flex; align-items: center; gap: 10px;
            font-size: 14px; font-weight: 700; color: var(--text-primary);
            margin-bottom: 20px; letter-spacing: 0.2px;
        }
        .section-label i {
            width: 32px; height: 32px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center; font-size: 14px;
        }
        .icon-cyan { background: rgba(6,182,212,0.1); border: 1px solid rgba(6,182,212,0.2); color: var(--cyan); }
        .icon-amber { background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2); color: var(--amber); }
        .icon-rose { background: rgba(244,63,94,0.1); border: 1px solid rgba(244,63,94,0.2); color: #f43f5e; }

        /* Kategori Chips */
        .category-chips {
            display: flex; flex-wrap: wrap; gap: 10px;
        }
        .cat-chip {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 16px; border-radius: 10px;
            font-size: 13px; font-weight: 500;
            background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.15);
            color: var(--cyan);
        }
        .cat-chip i { font-size: 11px; opacity: 0.7; }

        .empty-chips {
            font-size: 14px; color: var(--text-muted); font-style: italic;
        }

        /* === Media Gallery === */
        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
        }
        .media-item {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--card-border);
            background: var(--input-bg);
            transition: all 0.3s;
            cursor: pointer;
            aspect-ratio: 4/3;
        }
        .media-item:hover {
            border-color: rgba(255,255,255,0.15);
            transform: translateY(-3px);
            box-shadow: 0 8px 28px -4px rgba(0,0,0,0.4);
        }
        .media-item img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.4s;
        }
        .media-item:hover img { transform: scale(1.06); }

        .media-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
            display: flex; flex-direction: column; justify-content: flex-end;
            padding: 14px;
            opacity: 0; transition: opacity 0.3s;
        }
        .media-item:hover .media-overlay { opacity: 1; }

        .media-overlay .media-name {
            font-size: 12px; font-weight: 600; color: white;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .media-overlay .media-size {
            font-size: 11px; color: rgba(255,255,255,0.6); margin-top: 2px;
        }
        .media-overlay .media-expand {
            position: absolute; top: 10px; right: 10px;
            width: 30px; height: 30px; border-radius: 8px;
            background: rgba(255,255,255,0.15); backdrop-filter: blur(8px);
            border: none; color: white; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; transition: background 0.2s;
        }
        .media-overlay .media-expand:hover { background: rgba(255,255,255,0.25); }

        /* Non-image media item */
        .media-item-non-image {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 10px; text-align: center; padding: 20px;
            aspect-ratio: 4/3;
        }
        .media-item-non-image i {
            font-size: 36px; color: var(--text-muted); opacity: 0.5;
        }
        .media-item-non-image .file-name {
            font-size: 12px; font-weight: 500; color: var(--text-secondary);
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
            max-width: 100%;
        }
        .media-item-non-image .file-ext {
            font-size: 11px; color: var(--text-muted); text-transform: uppercase;
        }

        .empty-media {
            text-align: center; padding: 40px 20px;
        }
        .empty-media i {
            font-size: 36px; color: var(--text-muted); opacity: 0.3; margin-bottom: 12px;
        }
        .empty-media p { font-size: 14px; color: var(--text-muted); }

        /* === Lightbox === */
        .lightbox {
            position: fixed; inset: 0; z-index: 2000;
            background: rgba(0,0,0,0.85); backdrop-filter: blur(12px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: all 0.3s;
            padding: 40px; cursor: zoom-out;
        }
        .lightbox.open { opacity: 1; visibility: visible; }
        .lightbox img {
            max-width: 90%; max-height: 85vh;
            border-radius: 12px;
            box-shadow: 0 24px 80px -12px rgba(0,0,0,0.6);
            transform: scale(0.9); transition: transform 0.35s cubic-bezier(0.16,1,0.3,1);
        }
        .lightbox.open img { transform: scale(1); }
        .lightbox-close {
            position: absolute; top: 20px; right: 20px;
            width: 44px; height: 44px; border-radius: 12px;
            background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.1);
            color: white; cursor: pointer; font-size: 18px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .lightbox-close:hover { background: rgba(255,255,255,0.2); }
        .lightbox-info {
            position: absolute; bottom: 24px; left: 50%; transform: translateX(-50%);
            background: rgba(30,41,59,0.9); border: 1px solid var(--card-border);
            border-radius: 10px; padding: 10px 20px;
            font-size: 13px; color: var(--text-secondary); white-space: nowrap;
        }

        /* === Modal Hapus === */
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
        .btn-cancel { background: rgba(255,255,255,0.05); border: 1px solid var(--input-border); color: var(--text-secondary); }
        .btn-cancel:hover { background: rgba(255,255,255,0.08); color: var(--text-primary); }
        .btn-delete-confirm { background: var(--danger); color: white; }
        .btn-delete-confirm:hover { background: #dc2626; box-shadow: 0 4px 16px rgba(239,68,68,0.3); }

        /* Session alert */
        .session-alert { max-width: 900px; margin: 0 auto; padding: 0 24px; }
        .alert-custom {
            background: var(--danger-bg); border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px; padding: 14px 18px; margin-top: 20px; margin-bottom: 8px;
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: #fca5a5; animation: shakeIn 0.5s ease;
        }
        .alert-custom i { color: var(--danger); font-size: 16px; flex-shrink: 0; }
        @keyframes shakeIn {
            0%{opacity:0;transform:translateX(-10px)} 25%{transform:translateX(6px)} 50%{transform:translateX(-4px)} 75%{transform:translateX(2px)} 100%{opacity:1;transform:translateX(0)}
        }

        /* === Responsive === */
        @media (max-width: 768px) {
            .top-nav { padding: 0 16px; }
            .nav-brand-text { display: none; }
            .main-content { padding: 24px 16px 60px; }
            .detail-hero { padding: 28px 24px; }
            .section-card { padding: 24px 20px; }
            .hero-title-area h1 { font-size: 22px; }
            .hero-top { flex-direction: column; }
            .hero-actions { align-self: flex-start; }
            .media-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
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

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('user.projects.index') }}">Projects</a>
            <i class="fas fa-chevron-right"></i>
            <span style="color:var(--text-secondary)">{{ Str::limit($project->title, 40) }}</span>
        </div>

        <!-- Hero -->
        <div class="detail-hero">
            <div class="hero-glow"></div>
            <div class="hero-top">
                <div style="display:flex; gap:18px; align-items:flex-start; flex:1; min-width:0;">
                    <div class="hero-icon">
                    <i class="fas fa-{{ ['code','database','globe','rocket','palette','chart-line','cube','layer-group'][0] }}"></i>
                    </div>
                    <div class="hero-title-area">
                        <h1>{{ $project->title }}</h1>
                    </div>
                </div>
                <div class="hero-actions">
                    <button class="btn-action danger" title="Hapus project" aria-label="Hapus" onclick="confirmDelete('{{ $project->title }}', '{{ route('user.projects.destroy', $project->id) }}')">
                        <i class="fas fa-trash-can"></i>
                    </button>
                </div>
            </div>

            @if($project->description)
            <p class="hero-desc">{{ $project->description }}</p>
            @endif

            <div class="hero-meta-row">
                <span class="meta-badge badge-status-{{ $project->status }}">
                    <i class="fas fa-{{ $project->status === 'published' ? 'circle-check' : 'pencil' }}"></i>
                    {{ ucfirst($project->status) }}
                </span>
                <span class="meta-text">
                    <i class="fas fa-calendar"></i>
                    {{ $project->created_at->format('d M Y') }}
                </span>
                <span class="meta-text">
                    <i class="fas fa-clock"></i>
                    {{ $project->created_at->diffForHumans() }}
                </span>
                <span class="meta-text">
                    <i class="fas fa-hashtag"></i>
                    #{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <!-- Kategori -->
        <div class="section-card">
            <div class="section-label">
                <i class="icon-cyan"><i class="fas fa-tags"></i></i>
                Kategori
            </div>
            @if($project->categories->count() > 0)
            <div class="category-chips">
                @foreach($project->categories as $cat)
                <span class="cat-chip">
                    <i class="fas fa-tag"></i>
                    {{ $cat->name }}
                </span>
                @endforeach
            </div>
            @else
            <p class="empty-chips">Belum ada kategori yang ditambahkan.</p>
            @endif
        </div>

        <!-- Media -->
        <div class="section-card">
            <div class="section-label">
                <i class="icon-amber"><i class="fas fa-images"></i></i>
                Media
                <span style="margin-left:auto; font-size:12px; font-weight:500; color:var(--text-muted);">
                    {{ $project->media->count() }} file
                </span>
            </div>
            @if($project->media->count() > 0)
            <div class="media-grid">
                @foreach($project->media as $media)
                    @php
                        $ext = strtolower(pathinfo($media->file_name, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp','svg','bmp']);
                    @endphp

                    @if($isImage)
                    <div class="media-item" onclick="openLightbox('{{ asset('storage/'.$media->file_path) }}', '{{ $media->file_name }}')">
                        <img src="{{ asset('storage/'.$media->file_path) }}" alt="{{ $media->file_name }}" loading="lazy">
                        <div class="media-overlay">
                            <button class="media-expand" aria-label="Perbesar" onclick="event.stopPropagation(); openLightbox('{{ asset('storage/'.$media->file_path) }}', '{{ $media->file_name }}')">
                                <i class="fas fa-expand"></i>
                            </button>
                            <span class="media-name">{{ $media->file_name }}</span>
                            <span class="media-size">{{ strtoupper($ext) }}</span>
                        </div>
                    </div>
                    @else
                    <div class="media-item media-item-non-image">
                        <i class="fas fa-{{ in_array($ext, ['mp4','mov','avi','mkv']) ? 'file-video' : (in_array($ext, ['pdf']) ? 'file-pdf' : (in_array($ext, ['doc','docx']) ? 'file-word' : (in_array($ext, ['zip','rar','7z']) ? 'file-zipper' : 'file'))) }}"></i>
                        <span class="file-name">{{ $media->file_name }}</span>
                        <span class="file-ext">{{ $ext }}</span>
                    </div>
                    @endif
                @endforeach
            </div>
            @else
            <div class="empty-media">
                <i class="fas fa-cloud-arrow-up"></i>
                <p>Belum ada media yang diunggah untuk project ini.</p>
            </div>
            @endif
        </div>

    </main>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
        <img id="lightboxImg" src="" alt="">
        <div class="lightbox-info" id="lightboxInfo"></div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash-can"></i></div>
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

    <script>
        // === Lightbox ===
        function openLightbox(src, name) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightboxInfo').textContent = name;
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
                closeDeleteModal();
            }
        });

        // === Modal Hapus ===
        function confirmDelete(name, url) {
            document.getElementById('deleteProjectName').textContent = name;
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.add('open');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('open');
        }

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
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