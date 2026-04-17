<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 3px; }

        /* ═══ TOPBAR ═══ */
        .topbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10, 15, 26, 0.82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--card-border);
            height: 56px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px;
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 12px; border-radius: 7px;
            font-size: 12px; font-weight: 500;
            color: var(--text-muted); text-decoration: none;
            background: transparent;
            border: 1px solid var(--card-border);
            cursor: pointer; transition: all 0.18s;
            font-family: 'Inter', sans-serif;
        }
        .btn-back i { font-size: 10px; transition: transform 0.18s; }
        .btn-back:hover {
            color: var(--text-primary);
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.12);
        }
        .btn-back:hover i { transform: translateX(-1px); }

        .topbar-sep { width: 1px; height: 20px; background: var(--card-border); }

        .topbar-brand {
            display: flex; align-items: center; gap: 9px;
            font-size: 14px; font-weight: 700; color: var(--text-primary);
            letter-spacing: -0.02em;
        }
        .topbar-brand-icon {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #059669);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: #fff;
            box-shadow: 0 3px 10px var(--accent-glow);
        }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .user-pill {
            display: flex; align-items: center; gap: 8px;
            padding: 5px 12px 5px 5px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--card-border);
            border-radius: 100px;
        }
        .user-pill .up-av {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff;
        }
        .user-pill .up-name { font-size: 12px; font-weight: 500; color: var(--text-secondary); }

        /* ═══ PAGE ═══ */
        .page {
            max-width: 880px;
            margin: 0 auto;
            padding: 28px 32px 60px;
        }

        /* ── Breadcrumb ── */
        .breadcrumb {
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 24px;
            font-size: 13px; color: var(--text-muted);
        }
        .breadcrumb a {
            color: var(--accent); text-decoration: none; transition: color 0.15s;
        }
        .breadcrumb a:hover { color: var(--accent-hover); }
        .breadcrumb .sep { color: var(--text-muted); opacity: 0.4; }

        /* ── Hero ── */
        .hero { margin-bottom: 32px; }

        .hero h1 {
            font-size: 28px; font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.03em; line-height: 1.25;
            margin-bottom: 16px;
        }

        .hero-meta {
            display: flex; flex-wrap: wrap; align-items: center; gap: 14px;
            margin-bottom: 20px;
        }

        .meta-chip {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; color: var(--text-muted);
        }
        .meta-chip i { font-size: 12px; }

        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 6px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.04em;
        }
        .status-badge.published { background: var(--accent-subtle); color: var(--accent); }
        .status-badge.draft { background: var(--amber-subtle); color: var(--amber); }
        .status-badge .dot {
            width: 5px; height: 5px; border-radius: 50%; background: currentColor;
        }

        .hero-desc {
            font-size: 15px; color: var(--text-secondary);
            line-height: 1.7; max-width: 680px;
        }

        /* ── Author ── */
        .author-bar {
            display: flex; align-items: center; gap: 14px;
            padding: 16px; background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px; margin-bottom: 32px;
        }
        .author-av {
            width: 42px; height: 42px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .author-label {
            font-size: 11px; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.06em;
            font-weight: 500; margin-bottom: 1px;
        }
        .author-name { font-size: 14px; font-weight: 600; color: var(--text-primary); }

        /* ── Section ── */
        .section { margin-bottom: 32px; }

        .section-header {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--card-border);
        }
        .section-header i { font-size: 14px; color: var(--accent); }
        .section-header h3 {
            font-size: 15px; font-weight: 700; color: var(--text-primary);
            letter-spacing: -0.01em;
        }
        .section-header .cnt {
            margin-left: auto;
            font-size: 12px; color: var(--text-muted); font-weight: 500;
            background: rgba(255,255,255,0.04);
            padding: 2px 10px; border-radius: 100px;
        }

        /* ── Tags ── */
        .tags-row { display: flex; flex-wrap: wrap; gap: 8px; }

        .tag {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            background: rgba(6, 182, 212, 0.06);
            border: 1px solid rgba(6, 182, 212, 0.12);
            color: var(--cyan); transition: all 0.2s;
        }
        .tag:hover {
            background: rgba(6, 182, 212, 0.12);
            border-color: rgba(6, 182, 212, 0.22);
            transform: translateY(-1px);
        }
        .tag i { font-size: 10px; opacity: 0.6; }

        .empty-inline {
            text-align: center; padding: 36px 20px;
            color: var(--text-muted); font-size: 13px;
            background: rgba(255,255,255,0.02);
            border: 1px dashed var(--card-border);
            border-radius: 12px;
        }
        .empty-inline i { display: block; font-size: 24px; margin-bottom: 8px; opacity: 0.3; }

        /* ── Media Grid ── */
        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 14px;
        }

        .mcard {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.25s ease;
        }
        .mcard:hover {
            border-color: rgba(255,255,255,0.12);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        .mcard-preview {
            position: relative;
            aspect-ratio: 16/10;
            background: rgba(5,8,15,0.8);
            overflow: hidden;
        }
        .mcard-preview img {
            width: 100%; height: 100%; object-fit: cover; display: block;
            transition: transform 0.35s ease;
        }
        .mcard:hover .mcard-preview img { transform: scale(1.04); }
        .mcard-preview video { width: 100%; height: 100%; object-fit: cover; }
        .mcard-preview iframe { width: 100%; height: 100%; border: none; }

        .mcard-type {
            position: absolute; top: 8px; left: 8px;
            padding: 3px 9px; border-radius: 6px;
            font-size: 10px; font-weight: 600;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            color: var(--text-secondary);
            display: flex; align-items: center; gap: 4px;
            text-transform: uppercase; letter-spacing: 0.04em;
        }
        .mcard-type i { font-size: 9px; color: var(--accent); }

        /* File card */
        .mcard.file-card .mcard-preview {
            aspect-ratio: auto;
            padding: 28px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
        }
        .file-icon-wrap {
            width: 56px; height: 56px; border-radius: 14px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.1);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 10px;
        }
        .file-icon-wrap i { font-size: 22px; color: var(--accent); }
        .file-label {
            font-size: 12px; color: var(--text-muted); margin-bottom: 12px;
        }
        .btn-dl {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            color: var(--cyan); text-decoration: none;
            background: rgba(6,182,212,0.06);
            border: 1px solid rgba(6,182,212,0.12);
            transition: all 0.2s;
        }
        .btn-dl:hover {
            background: rgba(6,182,212,0.12);
            border-color: rgba(6,182,212,0.22);
        }
        .btn-dl i { font-size: 11px; }

        .mcard-bottom {
            padding: 10px 14px;
            display: flex; align-items: center;
            border-top: 1px solid rgba(255,255,255,0.03);
        }
        .mcard-fname {
            font-size: 11px; color: var(--text-muted);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            flex: 1;
        }

        /* ═══ LIGHTBOX ═══ */
        .lb {
            display: none; position: fixed; inset: 0; z-index: 10000;
            background: rgba(0,0,0,0.92);
            backdrop-filter: blur(20px);
            align-items: center; justify-content: center;
            cursor: zoom-out;
        }
        .lb.show { display: flex; animation: fi 0.2s ease; }
        .lb img {
            max-width: 90vw; max-height: 85vh;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        .lb video {
            max-width: 90vw; max-height: 85vh;
            border-radius: 12px;
        }
        .lb-x {
            position: absolute; top: 18px; right: 22px;
            width: 38px; height: 38px; border-radius: 9px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff; font-size: 15px; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .lb-x:hover { background: rgba(255,255,255,0.14); }
        @keyframes fi { from { opacity:0; } to { opacity:1; } }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 640px) {
            .topbar { padding: 0 16px; }
            .page { padding: 20px 16px 50px; }
            .hero h1 { font-size: 22px; }
            .media-grid { grid-template-columns: 1fr; }
            .hero-meta { gap: 10px; }
            .user-pill .up-name { display: none; }
        }
    </style>
</head>
<body>

<!-- ═══ TOPBAR ═══ -->
<header class="topbar">
    <div class="topbar-left">
        <a href="{{ route('user.projects.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
        <div class="topbar-sep"></div>
        <div class="topbar-brand">
            <div class="topbar-brand-icon"><i class="fas fa-cube"></i></div>
            <span>Detail Project</span>
        </div>
    </div>
    <div class="topbar-right">
        <div class="user-pill">
            <div class="up-av">{{ substr($project->user->name, 0, 1) }}</div>
            <span class="up-name">{{ $project->user->name }}</span>
        </div>
    </div>
</header>

<!-- ═══ PAGE ═══ -->
<main class="page">

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('user.projects.index') }}">Project Saya</a>
        <span class="sep">/</span>
        <span>Detail</span>
    </div>

    <!-- Hero -->
    <section class="hero">
        <h1>{{ $project->title }}</h1>

        <div class="hero-meta">
            <span class="status-badge {{ $project->status == 'published' ? 'published' : 'draft' }}">
                <span class="dot"></span>
                {{ $project->status }}
            </span>
            <span class="meta-chip">
                <i class="far fa-calendar"></i>
                {{ $project->created_at->format('d M Y') }}
            </span>
            <span class="meta-chip">
                <i class="fas fa-photo-film"></i>
                {{ $project->media->count() }} media
            </span>
        </div>

        @if($project->description)
            <p class="hero-desc">{{ $project->description }}</p>
        @endif
    </section>

    <!-- Author -->
    <div class="author-bar">
        <div class="author-av">{{ substr($project->user->name, 0, 1) }}</div>
        <div>
            <div class="author-label">Dibuat oleh</div>
            <div class="author-name">{{ $project->user->name }}</div>
        </div>
    </div>

    <!-- Categories -->
    <section class="section">
        <div class="section-header">
            <i class="fas fa-tags"></i>
            <h3>Kategori</h3>
            <span class="cnt">{{ $project->categories->count() }}</span>
        </div>

        @if($project->categories->count() > 0)
            <div class="tags-row">
                @foreach($project->categories as $cat)
                    <span class="tag"><i class="fas fa-hashtag"></i>{{ $cat->name }}</span>
                @endforeach
            </div>
        @else
            <div class="empty-inline">
                <i class="fas fa-tags"></i>
                Tidak ada kategori
            </div>
        @endif
    </section>

    <!-- Media -->
    <section class="section">
        <div class="section-header">
            <i class="fas fa-photo-film"></i>
            <h3>Media & Lampiran</h3>
            <span class="cnt">{{ $project->media->count() }}</span>
        </div>

        @if($project->media->count() > 0)
            <div class="media-grid">

                @foreach($project->media as $media)

                    {{-- IMAGE --}}
                    @if($media->type == 'image')
                        <div class="mcard">
                            <div class="mcard-preview" style="cursor:zoom-in"
                                 onclick="openLb('{{ asset('storage/'.$media->file_path) }}', 'image')">
                                <img src="{{ asset('storage/'.$media->file_path) }}" alt="Media" loading="lazy">
                                <span class="mcard-type"><i class="fas fa-image"></i> Image</span>
                            </div>
                            <div class="mcard-bottom">
                                <span class="mcard-fname">{{ basename($media->file_path) }}</span>
                            </div>
                        </div>

                    {{-- VIDEO --}}
                    @elseif($media->type == 'video')
                        <div class="mcard">
                            <div class="mcard-preview"
                                 onclick="openLb('{{ asset('storage/'.$media->file_path) }}', 'video')"
                                 style="cursor:pointer">
                                <video muted preload="metadata">
                                    <source src="{{ asset('storage/'.$media->file_path) }}">
                                </video>
                                <span class="mcard-type"><i class="fas fa-play"></i> Video</span>
                            </div>
                            <div class="mcard-bottom">
                                <span class="mcard-fname">{{ basename($media->file_path) }}</span>
                            </div>
                        </div>

                    {{-- FILE --}}
                    @elseif($media->type == 'file')
                        <div class="mcard file-card">
                            <div class="mcard-preview">
                                <div class="file-icon-wrap"><i class="fas fa-file-arrow-down"></i></div>
                                <div class="file-label">{{ basename($media->file_path) }}</div>
                                <a href="{{ asset('storage/'.$media->file_path) }}" target="_blank" class="btn-dl">
                                    <i class="fas fa-download"></i> Download File
                                </a>
                            </div>
                        </div>

                    {{-- EMBED --}}
                    @elseif($media->type == 'embed')
                        <div class="mcard">
                            <div class="mcard-preview">
                                <iframe src="{{ $media->embed_url }}" loading="lazy" allowfullscreen></iframe>
                                <span class="mcard-type"><i class="fas fa-code"></i> Embed</span>
                            </div>
                            <div class="mcard-bottom">
                                <span class="mcard-fname">Embedded content</span>
                            </div>
                        </div>
                    @endif

                @endforeach

            </div>
        @else
            <div class="empty-inline">
                <i class="fas fa-photo-film"></i>
                Tidak ada media yang diunggah untuk project ini
            </div>
        @endif
    </section>

</main>

<!-- ═══ LIGHTBOX ═══ -->
<div class="lb" id="lb" onclick="closeLb(event)">
    <button class="lb-x" onclick="closeLb(event)">
        <i class="fas fa-xmark"></i>
    </button>
    <img id="lbImg" src="" alt="Preview" style="display:none;">
    <video id="lbVid" controls style="display:none;"></video>
</div>

<script>
    function openLb(src, type) {
        const lb = document.getElementById('lb');
        const img = document.getElementById('lbImg');
        const vid = document.getElementById('lbVid');

        if (type === 'image') {
            img.src = src;
            img.style.display = 'block';
            vid.style.display = 'none';
            vid.src = '';
        } else if (type === 'video') {
            vid.src = src;
            vid.style.display = 'block';
            img.style.display = 'none';
            img.src = '';
        }

        lb.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeLb(e) {
        if (e.target.tagName === 'VIDEO') return;
        const lb = document.getElementById('lb');
        lb.classList.remove('show');
        document.body.style.overflow = '';
        setTimeout(() => {
            document.getElementById('lbImg').src = '';
            document.getElementById('lbVid').src = '';
        }, 200);
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLb(e);
    });
</script>

</body>
</html>