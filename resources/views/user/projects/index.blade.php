<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Saya</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg: #0a0f1a;
            --card: rgba(17, 24, 39, 0.6);
            --card-hover: rgba(17, 24, 39, 0.8);
            --border: rgba(255, 255, 255, 0.07);
            --border-hover: rgba(255, 255, 255, 0.13);
            --accent: #10b981;
            --accent-hover: #34d399;
            --accent-glow: rgba(16, 185, 129, 0.25);
            --accent-subtle: rgba(16, 185, 129, 0.08);
            --cyan: #06b6d4;
            --cyan-subtle: rgba(6, 182, 212, 0.08);
            --text-1: #f1f5f9;
            --text-2: #94a3b8;
            --text-3: #64748b;
            --input-bg: rgba(15, 23, 42, 0.8);
            --input-border: rgba(255, 255, 255, 0.08);
            --amber: #f59e0b;
            --amber-subtle: rgba(245, 158, 11, 0.08);
            --indigo: #818cf8;
            --indigo-subtle: rgba(129, 140, 248, 0.08);
            --rose: #f43f5e;
            --rose-subtle: rgba(244, 63, 94, 0.08);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-1);
            min-height: 100vh;
            line-height: 1.5;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 3px; }

        /* ═══ NAV ═══ */
        .topnav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10, 15, 26, 0.82);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
            height: 58px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px;
        }

        .topnav-left {
            display: flex; align-items: center; gap: 12px;
        }

        .topnav-logo {
            width: 32px; height: 32px; border-radius: 9px;
            background: linear-gradient(135deg, var(--accent), #059669);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; color: #fff;
            box-shadow: 0 3px 12px var(--accent-glow);
        }

        .topnav-title {
            font-size: 15px; font-weight: 700; color: var(--text-1);
            letter-spacing: -0.02em;
        }

        .topnav-right {
            display: flex; align-items: center; gap: 10px;
        }

        .user-pill {
            display: flex; align-items: center; gap: 8px;
            padding: 5px 14px 5px 5px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 100px;
        }
        .user-pill .up-av {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff;
        }
        .user-pill .up-name {
            font-size: 13px; font-weight: 500; color: var(--text-2);
        }

        .btn-logout {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 6px 14px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            color: var(--rose); text-decoration: none;
            background: var(--rose-subtle);
            border: 1px solid rgba(244, 63, 94, 0.12);
            cursor: pointer; transition: all 0.18s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-logout:hover {
            background: rgba(244, 63, 94, 0.14);
            border-color: rgba(244, 63, 94, 0.22);
        }
        .btn-logout i { font-size: 10px; }

        /* ═══ PAGE ═══ */
        .page {
            max-width: 1060px;
            margin: 0 auto;
            padding: 28px 32px 60px;
        }

        /* ── Header ── */
        .pg-header {
            margin-bottom: 22px;
        }
        .pg-header h1 {
            font-size: 22px; font-weight: 800;
            color: var(--text-1); letter-spacing: -0.03em;
        }
        .pg-header p {
            font-size: 13px; color: var(--text-3); margin-top: 2px;
        }

        /* ── Toolbar ── */
        .toolbar {
            display: flex; flex-wrap: wrap; align-items: center; gap: 10px;
            margin-bottom: 20px;
        }

        .btn-create {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 20px; border-radius: 9px;
            font-size: 13px; font-weight: 600; color: #fff;
            background: var(--accent); text-decoration: none;
            border: none; cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-shadow: 0 3px 14px var(--accent-glow);
            transition: all 0.2s;
        }
        .btn-create:hover {
            background: var(--accent-hover);
            box-shadow: 0 5px 22px rgba(16,185,129,0.35);
            transform: translateY(-1px);
            color: #fff;
        }
        .btn-create i { font-size: 12px; }

        .search-box {
            flex: 1; min-width: 200px; max-width: 320px;
            position: relative;
        }
        .search-box i {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            font-size: 12px; color: var(--text-3); pointer-events: none;
        }
        .search-box input {
            width: 100%; padding: 9px 14px 9px 36px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 9px; color: var(--text-1);
            font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none; transition: all 0.2s;
        }
        .search-box input::placeholder { color: var(--text-3); }
        .search-box input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(16,185,129,0.06);
        }

        .filter-tabs {
            display: flex; gap: 3px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 9px; padding: 3px;
        }
        .ftab {
            padding: 6px 14px; border-radius: 7px;
            font-size: 12px; font-weight: 500;
            color: var(--text-3); background: transparent;
            border: none; cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.15s;
        }
        .ftab:hover { color: var(--text-2); }
        .ftab.on { background: rgba(255,255,255,0.08); color: var(--text-1); font-weight: 600; }

        .count-label {
            margin-left: auto;
            font-size: 12px; color: var(--text-3);
        }
        .count-label b { color: var(--text-2); font-weight: 700; }

        /* ── Alert ── */
        .alert-ok {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 16px; margin-bottom: 18px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.14);
            border-radius: 10px;
            color: var(--accent-hover);
            font-size: 13px; font-weight: 500;
            animation: sld 0.3s ease;
        }
        .alert-ok i { font-size: 14px; }
        @keyframes sld { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }

        /* ═══ GRID ═══ */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        /* ═══ CARD ═══ */
        .pcard {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.28s ease;
            display: flex; flex-direction: column;
        }
        .pcard:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(0,0,0,0.25);
            background: var(--card-hover);
        }

        .pcard-thumb {
            position: relative;
            aspect-ratio: 16/10;
            background: rgba(5,8,15,0.7);
            overflow: hidden; flex-shrink: 0;
        }
        .pcard-thumb img {
            width: 100%; height: 100%; object-fit: cover; display: block;
            transition: transform 0.35s ease;
        }
        .pcard:hover .pcard-thumb img { transform: scale(1.05); }
        .pcard-thumb video { width: 100%; height: 100%; object-fit: cover; }
        .pcard-thumb iframe { width: 100%; height: 100%; border: none; }

        .thumb-empty {
            width: 100%; height: 100%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 6px; color: var(--text-3); font-size: 12px;
        }
        .thumb-empty i { font-size: 22px; opacity: 0.3; }

        .thumb-type {
            position: absolute; top: 8px; left: 8px;
            padding: 2px 8px; border-radius: 5px;
            font-size: 10px; font-weight: 600;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            color: var(--text-2);
            display: flex; align-items: center; gap: 4px;
        }
        .thumb-type i { font-size: 9px; color: var(--accent); }

        .thumb-status {
            position: absolute; top: 8px; right: 8px;
            padding: 2px 9px; border-radius: 5px;
            font-size: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.03em;
        }
        .thumb-status.published { background: var(--accent-subtle); color: var(--accent); }
        .thumb-status.draft { background: var(--amber-subtle); color: var(--amber); }

        .pcard-body { padding: 16px 16px 0; flex: 1; }

        .pcard-title {
            font-size: 15px; font-weight: 700;
            color: var(--text-1); letter-spacing: -0.01em;
            margin-bottom: 5px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        .pcard-desc {
            font-size: 12px; color: var(--text-3);
            line-height: 1.6;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
            margin-bottom: 12px;
        }

        .pcard-tags { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 12px; }
        .ptag {
            padding: 2px 9px; border-radius: 5px;
            font-size: 10px; font-weight: 600;
            background: var(--indigo-subtle);
            border: 1px solid rgba(129,140,248,0.1);
            color: var(--indigo);
        }

        .pcard-meta {
            display: flex; align-items: center; gap: 14px;
            font-size: 11px; color: var(--text-3);
        }
        .pcard-meta span { display: inline-flex; align-items: center; gap: 4px; }
        .pcard-meta i { font-size: 10px; }

        .pcard-foot {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 16px;
            border-top: 1px solid var(--border);
            margin-top: 14px;
        }

        .pcard-date { font-size: 12px; color: var(--text-3); }

        .btn-detail {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 16px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            color: var(--text-2); text-decoration: none;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            transition: all 0.18s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-detail:hover {
            background: rgba(255,255,255,0.09);
            border-color: var(--border-hover);
            color: var(--text-1);
        }
        .btn-detail i { font-size: 10px; transition: transform 0.18s; }
        .btn-detail:hover i { transform: translateX(2px); }

        .empty {
            grid-column: 1 / -1;
            text-align: center; padding: 70px 20px;
        }
        .empty-icon {
            width: 64px; height: 64px; border-radius: 18px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.08);
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }
        .empty-icon i { font-size: 26px; color: var(--accent); opacity: 0.35; }
        .empty h3 { font-size: 16px; font-weight: 700; color: var(--text-2); margin-bottom: 4px; }
        .empty p { font-size: 13px; color: var(--text-3); margin-bottom: 20px; }

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

        @media (max-width: 1060px) { .grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 680px) {
            .topnav { padding: 0 16px; }
            .page { padding: 20px 16px 50px; }
            .grid { grid-template-columns: 1fr; }
            .toolbar { flex-direction: column; align-items: stretch; }
            .search-box { max-width: 100%; }
            .filter-tabs { justify-content: center; }
            .count-label { margin-left: 0; }
            .user-pill .up-name { display: none; }
        }
    </style>
</head>
<body>

<nav class="topnav">
    <div class="topnav-left">
        <div class="topnav-logo"><i class="fas fa-cube"></i></div>
        <span class="topnav-title">Project Saya</span>
    </div>
    <div class="topnav-right">
        <div class="user-pill">
            <div class="up-av">{{ substr(auth()->user()->name, 0, 1) }}</div>
            <span class="up-name">{{ auth()->user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-right-from-bracket"></i>
                Keluar
            </button>
        </form>
    </div>
</nav>

<main class="page">

    <div class="pg-header">
        <h1>Project Saya</h1>
        <p>Kelola semua project yang telah kamu buat</p>
    </div>

    @if(session('success'))
        <div class="alert-ok">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="toolbar">
        <a href="{{ route('user.projects.create') }}" class="btn-create">
            <i class="fas fa-plus"></i>
            Buat Project
        </a>

        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari project..." id="searchInput" oninput="applyFilters()">
        </div>

        <div class="filter-tabs">
            <button class="ftab on" data-f="all" onclick="setFilter(this)">Semua</button>
            <button class="ftab" data-f="published" onclick="setFilter(this)">Published</button>
            <button class="ftab" data-f="draft" onclick="setFilter(this)">Draft</button>
        </div>

        <span class="count-label"><b id="countNum">{{ $projects->count() }}</b> project</span>
    </div>

    <div class="grid" id="grid">

        @forelse($projects as $project)

            @php $firstMedia = $project->media->first(); @endphp

            <div class="pcard"
                 data-title="{{ strtolower($project->title) }}"
                 data-status="{{ $project->status }}">

                <div class="pcard-thumb">
                    @if($firstMedia && $firstMedia->file_type == 'image')
                        <img src="{{ asset('storage/'.$firstMedia->file_path) }}"
                             loading="lazy"
                             onclick="openLb('{{ asset('storage/'.$firstMedia->file_path) }}')"
                             style="cursor:zoom-in;">
                        <span class="thumb-type"><i class="fas fa-image"></i> Image</span>

                    @elseif($firstMedia && $firstMedia->file_type == 'video')
                        <video muted preload="metadata">
                            <source src="{{ asset('storage/'.$firstMedia->file_path) }}">
                        </video>
                        <span class="thumb-type"><i class="fas fa-play"></i> Video</span>

                    @elseif($firstMedia && $firstMedia->file_type == 'embed')
                        <iframe src="{{ $firstMedia->embed_url }}" loading="lazy" allowfullscreen></iframe>
                        <span class="thumb-type"><i class="fas fa-code"></i> Embed</span>

                    @else
                        <div class="thumb-empty">
                            <i class="fas fa-photo-film"></i>
                            <span>No Media</span>
                        </div>
                    @endif

                    <span class="thumb-status {{ $project->status == 'published' ? 'published' : 'draft' }}">
                        {{ $project->status }}
                    </span>
                </div>

                <div class="pcard-body">
                    <div class="pcard-title" title="{{ $project->title }}">{{ $project->title }}</div>

                    @if($project->description)
                        <div class="pcard-desc">{{ $project->description }}</div>
                    @else
                        <div class="pcard-desc" style="opacity:0.4">Tidak ada deskripsi</div>
                    @endif

                    @if($project->categories->count())
                        <div class="pcard-tags">
                            @foreach($project->categories as $cat)
                                <span class="ptag">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="pcard-meta">
                        <span><i class="fas fa-photo-film"></i> {{ $project->media->count() }} media</span>
                    </div>
                </div>

                <div class="pcard-foot">
                    <span class="pcard-date">
                        <i class="far fa-calendar" style="margin-right:4px;font-size:10px"></i>
                        {{ $project->created_at->format('d M Y') }}
                    </span>
                    <a href="{{ route('user.projects.show', $project->id) }}" class="btn-detail">
                        Lihat Detail
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

            </div>

        @empty

            <div class="empty">
                <div class="empty-icon"><i class="fas fa-folder-open"></i></div>
                <h3>Belum ada project</h3>
                <p>Mulai buat project pertamamu sekarang</p>
                <a href="{{ route('user.projects.create') }}" class="btn-create">
                    <i class="fas fa-plus"></i>
                    Buat Project
                </a>
            </div>

        @endforelse

    </div>
</main>

<div class="lb" id="lb" onclick="closeLb()">
    <button class="lb-x" onclick="closeLb()"><i class="fas fa-xmark"></i></button>
    <img id="lbImg" src="" alt="Preview">
</div>

<script>
    let currentFilter = 'all';

    function setFilter(el) {
        document.querySelectorAll('.ftab').forEach(t => t.classList.remove('on'));
        el.classList.add('on');
        currentFilter = el.dataset.f;
        applyFilters();
    }

    function applyFilters() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('#grid .pcard');
        let visible = 0;

        cards.forEach(c => {
            const title = c.dataset.title || '';
            const status = c.dataset.status || '';
            const matchQ = title.includes(q);
            const matchF = currentFilter === 'all' || status === currentFilter;

            if (matchQ && matchF) {
                c.style.display = '';
                visible++;
            } else {
                c.style.display = 'none';
            }
        });

        document.getElementById('countNum').textContent = visible;
    }

    function openLb(src) {
        document.getElementById('lbImg').src = src;
        document.getElementById('lb').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeLb() {
        document.getElementById('lb').classList.remove('show');
        document.body.style.overflow = '';
        setTimeout(() => { document.getElementById('lbImg').src = ''; }, 200);
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLb();
    });
</script>

</body>
</html>