<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
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
            width: 520px; height: 520px; top: -10%; right: -6%;
            background: radial-gradient(circle, rgba(16,185,129,0.07), transparent 70%);
            animation: od1 24s ease-in-out infinite;
        }
        .ambient .orb-2 {
            width: 440px; height: 440px; bottom: -6%; left: -5%;
            background: radial-gradient(circle, rgba(6,182,212,0.05), transparent 70%);
            animation: od2 30s ease-in-out infinite;
        }
        @keyframes od1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-40px,60px)} }
        @keyframes od2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(60px,-40px)} }

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
        .navbar.scrolled { background: rgba(6, 10, 19, 0.88); }
        .nav-brand { display: flex; align-items: center; gap: 9px; text-decoration: none; }
        .nav-logo {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: #fff;
        }
        .nav-text { font-size: 15px; font-weight: 800; color: var(--text); letter-spacing: -0.3px; }
        .nav-right { display: flex; align-items: center; gap: 8px; }
        .nav-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 15px; border-radius: 8px;
            font-size: 12px; font-weight: 600; text-decoration: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s; border: 1px solid var(--border);
            color: var(--text-2); background: transparent; cursor: pointer;
        }
        .nav-btn:hover { color: var(--text); background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.12); }
        .nav-btn i { font-size: 10px; }
        .nav-btn.green {
            background: var(--accent); color: #fff; border-color: transparent;
            box-shadow: 0 2px 12px var(--accent-glow);
        }
        .nav-btn.green:hover { background: var(--accent-hover); color: #fff; box-shadow: 0 4px 18px rgba(16,185,129,0.3); transform: translateY(-1px); }

        /* ═══════ HEADER ═══════ */
        .hero-head {
            position: relative; z-index: 1;
            text-align: center; padding: 56px 24px 0;
            max-width: 640px; margin: 0 auto;
        }
        .hero-pill {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 5px 14px 5px 7px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.12);
            border-radius: 100px;
            font-size: 11.5px; font-weight: 600; color: var(--accent);
            margin-bottom: 18px;
            animation: fu 0.6s 0.05s cubic-bezier(0.16,1,0.3,1) both;
        }
        .hero-pill-dot {
            width: 19px; height: 19px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 8px; color: #fff;
        }
        .hero-head h1 {
            font-size: clamp(26px, 5vw, 40px);
            font-weight: 900; letter-spacing: -0.03em;
            line-height: 1.15; margin-bottom: 10px;
            animation: fu 0.6s 0.12s cubic-bezier(0.16,1,0.3,1) both;
        }
        .hero-head h1 .g {
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-head p {
            font-size: 14.5px; color: var(--text-2); line-height: 1.7;
            animation: fu 0.6s 0.18s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fu {
            from { opacity: 0; transform: translateY(16px); filter: blur(3px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        /* ═══════ SEARCH ═══════ */
        .search-wrap {
            position: relative; z-index: 1;
            max-width: 460px; margin: 24px auto 0; padding: 0 24px;
            animation: fu 0.6s 0.24s cubic-bezier(0.16,1,0.3,1) both;
        }
        .search-box { position: relative; }
        .search-box i {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--text-3); font-size: 12px; pointer-events: none; transition: color 0.2s;
        }
        .search-box input {
            width: 100%; padding: 10px 14px 10px 38px;
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 10px; color: var(--text);
            font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none; transition: all 0.2s;
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        }
        .search-box input::placeholder { color: var(--text-3); }
        .search-box input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(16,185,129,0.06); }
        .search-box input:focus + i { color: var(--accent); }

        /* ═══════ GRID ═══════ */
        .grid-section {
            position: relative; z-index: 1;
            max-width: 1160px; margin: 20px auto 0;
            padding: 0 24px 80px;
        }
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 16px;
        }

        /* ═══════ CARD ═══════ */
        .p-card {
            background: var(--surface);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16,1,0.3,1);
            opacity: 0; transform: translateY(20px);
            display: flex; flex-direction: column;
        }
        .p-card.vis { opacity: 1; transform: translateY(0); }
        .p-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
            z-index: 2; opacity: 0; transition: opacity 0.3s; pointer-events: none;
        }
        .p-card { position: relative; }
        .p-card:hover {
            border-color: rgba(255,255,255,0.12);
            transform: translateY(-5px);
            box-shadow: 0 20px 56px rgba(0,0,0,0.35);
        }
        .p-card:hover::before { opacity: 1; }

        /* Media */
        .p-media {
            position: relative; width: 100%;
            aspect-ratio: 16 / 10; overflow: hidden;
            background: rgba(0,0,0,0.3);
        }
        .p-media img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.16,1,0.3,1);
        }
        .p-card:hover .p-media img { transform: scale(1.05); }
        .p-media video, .p-media iframe {
            width: 100%; height: 100%; border: none; display: block; background: #000;
        }

        /* Media type badge */
        .m-badge {
            position: absolute; top: 10px; left: 10px;
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px; border-radius: 6px;
            font-size: 10px; font-weight: 700; z-index: 2;
            text-transform: uppercase; letter-spacing: 0.4px;
            backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        }
        .m-badge.img { background: rgba(0,0,0,0.5); color: #fff; border: 1px solid rgba(255,255,255,0.1); }
        .m-badge.vid { background: rgba(244,63,94,0.3); color: var(--rose); border: 1px solid rgba(244,63,94,0.2); }
        .m-badge.emb { background: rgba(129,140,248,0.3); color: var(--indigo); border: 1px solid rgba(129,140,248,0.2); }

        /* No media placeholder */
        .no-media {
            position: absolute; inset: 0;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px; color: var(--text-3);
        }
        .no-media i { font-size: 26px; opacity: 0.25; }
        .no-media span { font-size: 10.5px; opacity: 0.4; }

        /* Body */
        .p-body { padding: 16px 18px 18px; flex: 1; display: flex; flex-direction: column; }
        .p-title {
            font-size: 15px; font-weight: 700; color: var(--text);
            line-height: 1.35; margin-bottom: 6px;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .p-desc {
            font-size: 12.5px; color: var(--text-2); line-height: 1.6;
            margin-bottom: 14px; flex: 1;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .p-foot {
            display: flex; align-items: center; justify-content: space-between;
            padding-top: 12px; border-top: 1px solid var(--border);
        }
        .p-meta {
            display: flex; align-items: center; gap: 5px;
            font-size: 11px; color: var(--text-3);
        }
        .p-meta i { font-size: 9px; }
        .p-link {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 13px; border-radius: 7px;
            font-size: 11.5px; font-weight: 600;
            color: var(--accent); text-decoration: none;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.1);
            transition: all 0.2s;
        }
        .p-link i { font-size: 9px; transition: transform 0.2s; }
        .p-link:hover {
            background: rgba(16,185,129,0.12);
            border-color: rgba(16,185,129,0.2);
            color: var(--accent-hover);
        }
        .p-link:hover i { transform: translateX(2px); }

        /* ═══════ EMPTY ═══════ */
        .empty-state {
            grid-column: 1 / -1; text-align: center; padding: 80px 24px;
        }
        .empty-icon {
            width: 68px; height: 68px; border-radius: 18px;
            background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.1);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 26px; color: var(--accent); opacity: 0.3; margin-bottom: 16px;
        }
        .empty-state h3 { font-size: 16px; font-weight: 700; color: var(--text-2); margin-bottom: 5px; }
        .empty-state p { font-size: 13px; color: var(--text-3); }

        .no-result {
            grid-column: 1 / -1; text-align: center; padding: 56px 24px; display: none;
        }
        .no-result.show { display: block; }
        .no-result i { font-size: 26px; color: var(--text-3); opacity: 0.2; display: block; margin-bottom: 8px; }
        .no-result p { font-size: 13px; color: var(--text-3); }

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
        .footer-links { display: flex; gap: 16px; }

        /* ═══════ RESPONSIVE ═══════ */
        @media (max-width: 768px) {
            .navbar { padding: 0 16px; }
            .nav-text { display: none; }
            .hero-head { padding: 44px 16px 0; }
            .search-wrap { padding: 0 16px; }
            .grid-section { padding: 0 16px 60px; }
            .portfolio-grid { grid-template-columns: 1fr; gap: 14px; }
            .footer { flex-direction: column; gap: 10px; text-align: center; padding: 20px 16px; }
        }
        @media (min-width: 769px) and (max-width: 960px) {
            .portfolio-grid { grid-template-columns: repeat(2, 1fr); }
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
</div>
<div class="grid-bg"></div>

<!-- ═══════ NAVBAR ═══════ -->
<nav class="navbar" id="navbar">
    <a href="{{ route('portfolio.index') }}" class="nav-brand">
        <div class="nav-logo"><i class="fas fa-rocket"></i></div>
        <span class="nav-text">Portfolio</span>
    </a>
    <div class="nav-right">
        <a href="{{ route('login') }}" class="nav-btn"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="{{ route('register') }}" class="nav-btn green"><i class="fas fa-user-plus"></i> Daftar</a>
    </div>
</nav>

<!-- ═══════ HEADER ═══════ -->
<div class="hero-head">
    <div class="hero-pill">
        <div class="hero-pill-dot"><i class="fas fa-sparkles"></i></div>
        Public Portfolio
    </div>
    <h1>Jelajahi Karya <span class="g">Terbaik</span></h1>
    <p>Kumpulan project dari para kreator. Temukan inspirasi atau tunjukkan karya Anda sendiri.</p>
</div>

<!-- ═══════ SEARCH ═══════ -->
<div class="search-wrap">
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari project..." autocomplete="off">
        <i class="fas fa-search"></i>
    </div>
</div>

<!-- ═══════ GRID ═══════ -->
<div class="grid-section">
    <div class="portfolio-grid" id="grid">

        @if($projects->count() > 0)
            @foreach($projects as $project)
            <div class="p-card" data-title="{{ strtolower($project->title) }}" data-delay="{{ $loop->index * 50 }}">

                <div class="p-media">
                    @if($project->media->count())
                        @php $m = $project->media->first(); @endphp

                        @if($m->file_type == 'image')
                            <span class="m-badge img"><i class="fas fa-image"></i> Image</span>
                            <img src="{{ asset('storage/'.$m->file_path) }}" alt="{{ $project->title }}" loading="lazy">

                        @elseif($m->file_type == 'video')
                            <span class="m-badge vid"><i class="fas fa-play"></i> Video</span>
                            <video controls preload="metadata">
                                <source src="{{ asset('storage/'.$m->file_path) }}">
                            </video>

                        @elseif($m->file_type == 'embed')
                            <span class="m-badge emb"><i class="fas fa-code"></i> Embed</span>
                            <iframe src="{{ $m->embed_url }}" allowfullscreen loading="lazy"></iframe>
                        @endif
                    @else
                        <div class="no-media">
                            <i class="fas fa-photo-film"></i>
                            <span>Tidak ada media</span>
                        </div>
                    @endif
                </div>

                <div class="p-body">
                    <div class="p-title">{{ $project->title }}</div>
                    <div class="p-desc">{{ $project->description }}</div>
                    <div class="p-foot">
                        <div class="p-meta">
                            <i class="fas fa-images"></i>
                            {{ $project->media->count() }} media
                        </div>
                        <a href="{{ route('portfolio.show', $project->id) }}" class="p-link">
                            Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-folder-open"></i></div>
                <h3>Belum Ada Project</h3>
                <p>Project yang dipublikasikan akan muncul di sini.</p>
            </div>
        @endif

        <div class="no-result" id="noResult">
            <i class="fas fa-search"></i>
            <p>Tidak ada project yang cocok.</p>
        </div>

    </div>
</div>

<!-- ═══════ FOOTER ═══════ -->
<footer class="footer">
    <span>&copy; {{ date('Y') }} Portfolio Media System</span>
    <div class="footer-links">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </div>
</footer>

<script>
/* ═══════ Scroll reveal ═══════ */
(function() {
    var cards = document.querySelectorAll('.p-card');
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) {
                var d = parseInt(e.target.dataset.delay) || 0;
                setTimeout(function() { e.target.classList.add('vis'); }, d);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.06, rootMargin: '0px 0px -16px 0px' });
    cards.forEach(function(c) { obs.observe(c); });
})();

/* ═══════ Navbar scroll ═══════ */
window.addEventListener('scroll', function() {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
});

/* ═══════ Search ═══════ */
document.getElementById('searchInput').addEventListener('input', function() {
    var q = this.value.toLowerCase().trim();
    var cards = document.querySelectorAll('.p-card');
    var empty = document.querySelector('.empty-state');
    var noRes = document.getElementById('noResult');
    var vis = 0;

    cards.forEach(function(c) {
        var t = c.dataset.title || '';
        var show = t.includes(q);
        c.style.display = show ? '' : 'none';
        if (show) vis++;
    });

    if (empty) {
        empty.style.display = cards.length === 0 ? '' : 'none';
        noRes.classList.toggle('show', vis === 0 && cards.length > 0);
    } else {
        noRes.classList.toggle('show', vis === 0);
    }
});
</script>

</body>
</html>