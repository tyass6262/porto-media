<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg: #060a13;
            --surface: rgba(15, 23, 42, 0.55);
            --border: rgba(255, 255, 255, 0.07);
            --accent: #10b981;
            --accent-hover: #34d399;
            --accent-glow: rgba(16, 185, 129, 0.2);
            --accent-subtle: rgba(16, 185, 129, 0.07);
            --cyan: #06b6d4;
            --text: #f1f5f9;
            --text-2: #94a3b8;
            --text-3: #475569;
            --rose: #f43f5e;
            --indigo: #818cf8;
            --amber: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 3px; }

        /* ═══════ AMBIENT ═══════ */
        .ambient { position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
        .ambient .orb { position: absolute; border-radius: 50%; filter: blur(100px); opacity: 0.3; }
        .ambient .orb-1 {
            width: 500px; height: 500px; top: -8%; right: -5%;
            background: radial-gradient(circle, rgba(16,185,129,0.07), transparent 70%);
            animation: od1 24s ease-in-out infinite;
        }
        .ambient .orb-2 {
            width: 420px; height: 420px; bottom: 10%; left: -6%;
            background: radial-gradient(circle, rgba(6,182,212,0.05), transparent 70%);
            animation: od2 30s ease-in-out infinite;
        }
        .ambient .orb-3 {
            width: 280px; height: 280px; top: 45%; right: 20%;
            background: radial-gradient(circle, rgba(129,140,248,0.035), transparent 70%);
            animation: od3 20s ease-in-out infinite;
        }
        @keyframes od1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-40px,55px)} }
        @keyframes od2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(55px,-40px)} }
        @keyframes od3 { 0%,100%{transform:translate(-50%,-50%) scale(1)} 50%{transform:translate(-50%,-50%) scale(1.15)} }

        .grid-bg {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
            background-size: 72px 72px;
            mask-image: radial-gradient(ellipse 60% 40% at 50% 15%, black 10%, transparent 80%);
        }

        /* ═══════ NAVBAR ═══════ */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; height: 58px;
            background: rgba(6, 10, 19, 0.55);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: background 0.3s;
        }
        .navbar.scrolled { background: rgba(6, 10, 19, 0.9); }
        .nav-brand { display: flex; align-items: center; gap: 9px; text-decoration: none; }
        .nav-logo {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: #fff;
        }
        .nav-text { font-size: 15px; font-weight: 800; color: var(--text); letter-spacing: -0.3px; }
        .nav-right { display: flex; align-items: center; gap: 8px; }
        .btn-back {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 7px 15px; border-radius: 8px;
            font-size: 12px; font-weight: 600; text-decoration: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s; border: 1px solid var(--border);
            color: var(--text-2); background: transparent;
        }
        .btn-back i { font-size: 10px; transition: transform 0.2s; }
        .btn-back:hover { color: var(--text); background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.12); }
        .btn-back:hover i { transform: translateX(-2px); }

        /* ═══════ MAIN ═══════ */
        .main { position: relative; z-index: 1; max-width: 900px; margin: 0 auto; padding: 0 24px 80px; }

        /* Hero */
        .detail-hero {
            padding: 48px 0 0;
            animation: fu 0.6s 0.05s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fu {
            from { opacity: 0; transform: translateY(18px); filter: blur(3px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        .back-link-inline {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 12.5px; font-weight: 500; color: var(--text-3);
            text-decoration: none; margin-bottom: 24px;
            transition: color 0.2s;
        }
        .back-link-inline i { font-size: 10px; transition: transform 0.2s; }
        .back-link-inline:hover { color: var(--accent); }
        .back-link-inline:hover i { transform: translateX(-3px); }

        .detail-meta-row {
            display: flex; align-items: center; gap: 10px; flex-wrap: wrap; margin-bottom: 14px;
        }
        .detail-cat {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 7px;
            font-size: 11.5px; font-weight: 600; color: var(--accent);
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.12);
        }
        .detail-cat i { font-size: 9px; }
        .detail-date {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11.5px; color: var(--text-3);
        }
        .detail-date i { font-size: 9px; }
        .detail-media-count {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 12px; border-radius: 7px;
            font-size: 11.5px; font-weight: 600; color: var(--text-3);
            background: rgba(255,255,255,0.03); border: 1px solid var(--border);
        }
        .detail-media-count i { font-size: 9px; }

        .detail-title {
            font-size: clamp(28px, 5vw, 42px);
            font-weight: 900; letter-spacing: -0.03em;
            line-height: 1.15; margin-bottom: 18px;
        }

        .detail-desc {
            font-size: 15.5px; color: var(--text-2); line-height: 1.75;
            max-width: 720px;
        }

        /* Divider */
        .section-divider {
            height: 1px; margin: 40px 0;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
        }

        /* ═══════ MEDIA SECTION ═══════ */
        .media-section {
            animation: fu 0.6s 0.15s cubic-bezier(0.16,1,0.3,1) both;
        }
        .media-section-header {
            display: flex; align-items: center; gap: 10px; margin-bottom: 20px;
        }
        .media-section-header i {
            width: 32px; height: 32px; border-radius: 9px;
            background: rgba(6,182,212,0.08); border: 1px solid rgba(6,182,212,0.12);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; color: var(--cyan);
        }
        .media-section-header h2 {
            font-size: 16px; font-weight: 700; color: var(--text);
        }
        .media-section-header .media-total {
            margin-left: auto;
            font-size: 12px; color: var(--text-3); font-weight: 500;
        }

        .media-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        /* Media Item */
        .media-item {
            background: var(--surface);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            opacity: 0; transform: translateY(16px);
            transition: all 0.5s cubic-bezier(0.16,1,0.3,1);
        }
        .media-item.vis { opacity: 1; transform: translateY(0); }
        .media-item:hover {
            border-color: rgba(255,255,255,0.1);
            box-shadow: 0 16px 48px rgba(0,0,0,0.25);
        }

        .media-wrap {
            position: relative; overflow: hidden;
            background: rgba(0,0,0,0.3);
        }

        .media-wrap.img-wrap img {
            width: 100%; display: block;
            max-height: 520px; object-fit: contain;
            background: rgba(0,0,0,0.2);
            transition: transform 0.4s cubic-bezier(0.16,1,0.3,1);
        }
        .media-item:hover .media-wrap.img-wrap img { transform: scale(1.015); }

        .media-wrap.vid-wrap { position: relative; }
        .media-wrap.vid-wrap video {
            width: 100%; display: block;
            max-height: 520px; background: #000;
        }

        .media-wrap.emb-wrap iframe {
            width: 100%; display: block;
            height: 420px; border: none; background: #000;
        }

        /* Media badge */
        .m-badge {
            position: absolute; top: 12px; left: 12px;
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 7px;
            font-size: 10.5px; font-weight: 700; z-index: 2;
            text-transform: uppercase; letter-spacing: 0.4px;
            backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        }
        .m-badge.img-b { background: rgba(0,0,0,0.55); color: #fff; border: 1px solid rgba(255,255,255,0.1); }
        .m-badge.vid-b { background: rgba(244,63,94,0.3); color: var(--rose); border: 1px solid rgba(244,63,94,0.2); }
        .m-badge.emb-b { background: rgba(129,140,248,0.3); color: var(--indigo); border: 1px solid rgba(129,140,248,0.2); }

        /* Image lightbox */
        .img-zoom-btn {
            position: absolute; top: 12px; right: 12px;
            width: 34px; height: 34px; border-radius: 8px;
            background: rgba(0,0,0,0.55); border: 1px solid rgba(255,255,255,0.1);
            color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; z-index: 2;
            transition: all 0.2s; backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .img-zoom-btn:hover { background: rgba(0,0,0,0.75); border-color: rgba(255,255,255,0.2); }

        /* Media footer */
        .media-foot {
            padding: 12px 16px;
            display: flex; align-items: center; justify-content: space-between;
            border-top: 1px solid var(--border);
        }
        .media-filename {
            font-size: 12px; color: var(--text-3);
            display: flex; align-items: center; gap: 6px;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
            max-width: 70%;
        }
        .media-filename i { font-size: 10px; flex-shrink: 0; }
        .media-index {
            font-size: 11px; color: var(--text-3); font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        /* ═══════ LIGHTBOX ═══════ */
        .lightbox {
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,0.92);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden;
            transition: all 0.25s; cursor: zoom-out;
            padding: 40px;
        }
        .lightbox.open { opacity: 1; visibility: visible; }
        .lightbox img {
            max-width: 100%; max-height: 100%;
            object-fit: contain; border-radius: 8px;
            transform: scale(0.92);
            transition: transform 0.35s cubic-bezier(0.16,1,0.3,1);
            cursor: default;
        }
        .lightbox.open img { transform: scale(1); }
        .lb-close {
            position: absolute; top: 20px; right: 20px;
            width: 40px; height: 40px; border-radius: 10px;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1);
            color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; transition: all 0.2s;
        }
        .lb-close:hover { background: rgba(255,255,255,0.15); }
        .lb-nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 44px; height: 44px; border-radius: 12px;
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
            color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; transition: all 0.2s;
        }
        .lb-nav:hover { background: rgba(255,255,255,0.12); }
        .lb-prev { left: 20px; }
        .lb-next { right: 20px; }
        .lb-counter {
            position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
            font-size: 12px; color: rgba(255,255,255,0.4); font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        /* ═══════ BACK TO PORTFOLIO ═══════ */
        .back-cta {
            margin-top: 48px;
            animation: fu 0.6s 0.3s cubic-bezier(0.16,1,0.3,1) both;
        }
        .back-cta a {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 13px 26px; border-radius: 12px;
            font-size: 14px; font-weight: 700; text-decoration: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: rgba(255,255,255,0.03);
            border: 1.5px solid var(--border);
            color: var(--text-2);
            transition: all 0.25s;
        }
        .back-cta a i { font-size: 12px; transition: transform 0.2s; }
        .back-cta a:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.15);
            color: var(--text); transform: translateX(-3px);
        }
        .back-cta a:hover i { transform: translateX(-3px); }

        /* ═══════ FOOTER ═══════ */
        .footer {
            position: relative; z-index: 1;
            border-top: 1px solid var(--border);
            padding: 22px 32px;
            display: flex; align-items: center; justify-content: space-between;
            font-size: 12px; color: var(--text-3);
        }
        .footer a { color: var(--text-3); text-decoration: none; transition: color 0.2s; }
        .footer a:hover { color: var(--text-2); }

        /* ═══════ RESPONSIVE ═══════ */
        @media (max-width: 768px) {
            .navbar { padding: 0 16px; }
            .nav-text { display: none; }
            .main { padding: 0 16px 60px; }
            .detail-hero { padding: 36px 0 0; }
            .detail-title { font-size: 26px; }
            .detail-desc { font-size: 14px; }
            .media-wrap.emb-wrap iframe { height: 220px; }
            .media-wrap.img-wrap img { max-height: 320px; }
            .lightbox { padding: 16px; }
            .lb-nav { width: 36px; height: 36px; font-size: 14px; }
            .lb-prev { left: 10px; }
            .lb-next { right: 10px; }
            .back-cta a { width: 100%; justify-content: center; }
            .footer { flex-direction: column; gap: 10px; text-align: center; padding: 20px 16px; }
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

<div class="ambient">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
</div>
<div class="grid-bg"></div>

<!-- ═══════ NAVBAR ═══════ -->
<nav class="navbar" id="navbar">
    <a href="{{ route('portfolio.index') }}" class="nav-brand">
        <div class="nav-logo"><i class="fas fa-rocket"></i></div>
        <span class="nav-text">Portfolio</span>
    </a>
    <div class="nav-right">
        <a href="{{ route('portfolio.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Semua Project
        </a>
    </div>
</nav>

<!-- ═══════ MAIN ═══════ -->
<main class="main">

    <!-- Hero -->
    <div class="detail-hero">
        <a href="{{ route('portfolio.index') }}" class="back-link-inline">
            <i class="fas fa-chevron-left"></i>
            Kembali ke Portfolio
        </a>

        <div class="detail-meta-row">
            @if($project->category)
                <span class="detail-cat">
                    <i class="fas fa-tag"></i>
                    {{ $project->category->name }}
                </span>
            @endif

            <span class="detail-date">
                <i class="fas fa-calendar"></i>
                {{ $project->created_at->format('d M Y') }}
            </span>

            <span class="detail-media-count">
                <i class="fas fa-images"></i>
                {{ $project->media->count() }} media
            </span>
        </div>

        <h1 class="detail-title">{{ $project->title }}</h1>

        @if($project->description)
            <p class="detail-desc">{{ $project->description }}</p>
        @endif
    </div>

    <div class="section-divider"></div>

    <!-- Media Section -->
    @if($project->media->count() > 0)
    <div class="media-section">
        <div class="media-section-header">
            <i class="fas fa-photo-film"></i>
            <h2>Media Project</h2>
            <span class="media-total">{{ $project->media->count() }} file</span>
        </div>

        <div class="media-grid" id="mediaGrid">
            @foreach($project->media as $media)
            <div class="media-item" data-delay="{{ $loop->index * 70 }}">

                <div class="media-wrap {{ $media->file_type == 'image' ? 'img-wrap' : ($media->file_type == 'video' ? 'vid-wrap' : 'emb-wrap') }}">

                    @if($media->file_type == 'image')
                        <span class="m-badge img-b"><i class="fas fa-image"></i> Image</span>
                        <button class="img-zoom-btn" onclick="openLightbox('{{ asset('storage/'.$media->file_path) }}', {{ $loop->index }})" title="Perbesar">
                            <i class="fas fa-expand"></i>
                        </button>
                        <img src="{{ asset('storage/'.$media->file_path) }}" alt="{{ $project->title }}" loading="lazy">

                    @elseif($media->file_type == 'video')
                        <span class="m-badge vid-b"><i class="fas fa-play"></i> Video</span>
                        <video controls preload="metadata">
                            <source src="{{ asset('storage/'.$media->file_path) }}">
                        </video>

                    @elseif($media->file_type == 'embed')
                        @php
                            $url = $media->embed_url;
                            if(str_contains($url,'watch?v=')){
                                $url = str_replace('watch?v=','embed/',$url);
                            }
                            if(str_contains($url,'youtu.be/')){
                                $url = str_replace('youtu.be/','youtube.com/embed/',$url);
                            }
                        @endphp
                        <span class="m-badge emb-b"><i class="fas fa-code"></i> Embed</span>
                        <iframe src="{{ $url }}" allowfullscreen loading="lazy"></iframe>
                    @endif
                </div>

                <div class="media-foot">
                    <div class="media-filename">
                        <i class="fas fa-file"></i>
                        {{ basename($media->file_path ?? $media->embed_url ?? '') }}
                    </div>
                    <div class="media-index">{{ $loop->index + 1 }} / {{ $project->media->count() }}</div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Back CTA -->
    <div class="back-cta">
        <a href="{{ route('portfolio.index') }}">
            <i class="fas fa-arrow-left"></i>
            Lihat Semua Project
        </a>
    </div>

</main>

<!-- ═══════ LIGHTBOX ═══════ -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
    <button class="lb-close" onclick="closeLightbox(event)" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
    <button class="lb-nav lb-prev" onclick="navLightbox(-1, event)" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
    <img id="lbImg" src="" alt="Preview">
    <button class="lb-nav lb-next" onclick="navLightbox(1, event)" aria-label="Selanjutnya"><i class="fas fa-chevron-right"></i></button>
    <div class="lb-counter" id="lbCounter"></div>
</div>

<!-- ═══════ FOOTER ═══════ -->
<footer class="footer">
    <span>&copy; {{ date('Y') }} Portfolio Media System</span>
    <a href="{{ route('portfolio.index') }}">portfolio.index</a>
</footer>

<script>
/* ═══════ Scroll reveal ═══════ */
(function() {
    var items = document.querySelectorAll('.media-item');
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) {
                var d = parseInt(e.target.dataset.delay) || 0;
                setTimeout(function() { e.target.classList.add('vis'); }, d);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.06, rootMargin: '0px 0px -20px 0px' });
    items.forEach(function(i) { obs.observe(i); });
})();

/* ═══════ Navbar scroll ═══════ */
window.addEventListener('scroll', function() {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
});

/* ═══════ Lightbox ═══════ */
var imgSources = [];
var currentLbIndex = 0;

document.querySelectorAll('.img-zoom-btn').forEach(function(btn) {
    var img = btn.closest('.media-wrap').querySelector('img');
    if (img) imgSources.push(img.src);
});

function openLightbox(src, idx) {
    currentLbIndex = imgSources.indexOf(src);
    if (currentLbIndex < 0) currentLbIndex = 0;
    updateLightbox();
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    if (e.target === document.getElementById('lightbox') || e.currentTarget.classList.contains('lb-close')) {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
}

function navLightbox(dir, e) {
    e.stopPropagation();
    currentLbIndex += dir;
    if (currentLbIndex < 0) currentLbIndex = imgSources.length - 1;
    if (currentLbIndex >= imgSources.length) currentLbIndex = 0;
    updateLightbox();
}

function updateLightbox() {
    document.getElementById('lbImg').src = imgSources[currentLbIndex];
    document.getElementById('lbCounter').textContent = (currentLbIndex + 1) + ' / ' + imgSources.length;
}

document.addEventListener('keydown', function(e) {
    var lb = document.getElementById('lightbox');
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') { lb.classList.remove('open'); document.body.style.overflow = ''; }
    if (e.key === 'ArrowLeft') navLightbox(-1, e);
    if (e.key === 'ArrowRight') navLightbox(1, e);
});
</script>

</body>
</html>