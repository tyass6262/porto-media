<!DOCTYPE html>
<html>
<head>
    <title>Moderasi Project</title>
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
            --indigo: #818cf8;
            --indigo-subtle: rgba(129, 140, 248, 0.08);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.5;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 3px; }

        /* ═══ TOPBAR ═══ */
        .topbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(10, 15, 26, 0.82);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--card-border);
            padding: 0 32px; height: 56px;
            display: flex; align-items: center; justify-content: space-between;
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

        .topbar-chip {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 7px;
            font-size: 11px; font-weight: 600;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.12);
            color: var(--accent);
        }
        .topbar-chip i { font-size: 10px; }

        .user-chip {
            display: flex; align-items: center; gap: 8px;
            padding: 5px 12px 5px 5px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--card-border);
            border-radius: 100px;
        }
        .user-chip .av {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff;
        }
        .user-chip .un { font-size: 12px; font-weight: 500; color: var(--text-secondary); }

        /* ═══ PAGE ═══ */
        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px 32px 60px;
        }

        .pg-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 18px; flex-wrap: wrap; gap: 12px;
        }
        .pg-header h1 {
            font-size: 20px; font-weight: 800;
            color: var(--text-primary); letter-spacing: -0.03em;
        }
        .pg-header p { font-size: 12px; color: var(--text-muted); margin-top: 1px; }

        .pg-stats { display: flex; gap: 8px; }
        .sp {
            padding: 6px 14px; border-radius: 8px;
            font-size: 12px; font-weight: 500;
            border: 1px solid var(--card-border);
            display: flex; align-items: center; gap: 6px;
        }
        .sp .n { font-weight: 700; font-size: 14px; }
        .sp.g { background: var(--accent-subtle); color: var(--accent); }
        .sp.a { background: var(--amber-subtle); color: var(--amber); }
        .sp.c { background: rgba(6,182,212,0.08); color: var(--cyan); }

        .alert-ok {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 16px; margin-bottom: 16px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.14);
            border-radius: 10px;
            color: var(--accent-hover);
            font-size: 13px; font-weight: 500;
            animation: sdown 0.3s ease;
        }
        .alert-ok i { font-size: 14px; }
        @keyframes sdown { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }

        .search-wrap { position: relative; margin-bottom: 18px; }
        .search-wrap i {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            font-size: 12px; color: var(--text-muted); pointer-events: none;
        }
        .search-wrap input {
            width: 100%; max-width: 340px;
            padding: 9px 14px 9px 36px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 9px;
            color: var(--text-primary);
            font-size: 13px; font-family: 'Inter', sans-serif;
            outline: none; transition: all 0.2s;
        }
        .search-wrap input::placeholder { color: var(--text-muted); }
        .search-wrap input:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(16,185,129,0.06);
        }

        /* ═══ GRID ═══ */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        /* ═══ CARD ═══ */
        .pcard {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.25s;
            display: flex; flex-direction: column;
        }
        .pcard:hover {
            border-color: rgba(255,255,255,0.12);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .pcard-thumb {
            position: relative;
            aspect-ratio: 16/9;
            background: rgba(5,8,15,0.7);
            overflow: hidden; flex-shrink: 0;
        }
        .pcard-thumb img {
            width: 100%; height: 100%; object-fit: cover; display: block;
            transition: transform 0.3s;
        }
        .pcard:hover .pcard-thumb img { transform: scale(1.04); }
        .pcard-thumb video { width: 100%; height: 100%; object-fit: cover; }

        .thumb-empty {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted); font-size: 11px; gap: 6px;
        }
        .thumb-empty i { font-size: 18px; opacity: 0.4; }

        .thumb-badge {
            position: absolute; top: 7px; left: 7px;
            padding: 2px 8px; border-radius: 5px;
            font-size: 10px; font-weight: 600;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            color: var(--text-secondary);
            display: flex; align-items: center; gap: 4px;
        }
        .thumb-badge i { font-size: 9px; color: var(--accent); }

        .thumb-status {
            position: absolute; top: 7px; right: 7px;
            padding: 2px 8px; border-radius: 5px;
            font-size: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.03em;
        }
        .thumb-status.published { background: var(--accent-subtle); color: var(--accent); }
        .thumb-status.draft { background: var(--amber-subtle); color: var(--amber); }

        .pcard-body { padding: 14px 14px 0; flex: 1; }

        .pcard-title {
            font-size: 14px; font-weight: 700;
            color: var(--text-primary); letter-spacing: -0.01em;
            margin-bottom: 4px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        .pcard-desc {
            font-size: 12px; color: var(--text-muted);
            line-height: 1.55;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
            margin-bottom: 10px;
        }

        .pcard-tags { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 10px; }
        .ptag {
            padding: 2px 8px; border-radius: 5px;
            font-size: 10px; font-weight: 600;
            background: var(--indigo-subtle);
            border: 1px solid rgba(129,140,248,0.1);
            color: var(--indigo);
        }

        .pcard-meta {
            display: flex; align-items: center; gap: 12px;
            font-size: 11px; color: var(--text-muted);
        }
        .pcard-meta span { display: inline-flex; align-items: center; gap: 4px; }
        .pcard-meta i { font-size: 10px; }
        .pcard-meta .uname { color: var(--cyan); font-weight: 600; }

        .pcard-foot {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 14px;
            border-top: 1px solid var(--card-border);
            margin-top: 12px;
        }

        .media-mini {
            display: flex; align-items: center; gap: 5px;
            font-size: 11px; color: var(--text-muted);
        }
        .media-mini i { font-size: 10px; color: var(--cyan); }

        .pcard-actions { display: flex; gap: 4px; }

        .btn-icon {
            width: 30px; height: 30px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 7px; font-size: 11px;
            cursor: pointer; transition: all 0.15s;
            border: 1px solid transparent;
            padding: 0; font-family: 'Inter', sans-serif;
            text-decoration: none;
        }
        .btn-icon.view {
            background: rgba(255,255,255,0.05);
            border-color: var(--card-border);
            color: var(--text-secondary);
        }
        .btn-icon.view:hover { background: rgba(255,255,255,0.08); color: var(--text-primary); }
        .btn-icon.del {
            background: transparent;
            border-color: rgba(255,255,255,0.04);
            color: var(--text-muted);
        }
        .btn-icon.del:hover {
            background: var(--danger-bg);
            border-color: rgba(239,68,68,0.18);
            color: var(--danger);
        }

        .empty {
            grid-column: 1 / -1;
            text-align: center; padding: 60px 20px;
        }
        .empty-icon {
            width: 60px; height: 60px; border-radius: 16px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.08);
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }
        .empty-icon i { font-size: 24px; color: var(--accent); opacity: 0.4; }
        .empty h3 { font-size: 15px; font-weight: 700; color: var(--text-secondary); margin-bottom: 4px; }
        .empty p { font-size: 13px; color: var(--text-muted); }

        .modal-o {
            display: none; position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,0.65);
            backdrop-filter: blur(8px);
            align-items: center; justify-content: center;
        }
        .modal-o.show { display: flex; animation: fi 0.15s ease; }
        .modal-b {
            background: rgba(17,24,39,0.97);
            border: 1px solid var(--card-border);
            border-radius: 14px;
            padding: 24px; width: 380px; max-width: 90vw;
            text-align: center;
            animation: si 0.2s ease;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        }
        @keyframes si { from { opacity:0; transform:scale(0.95); } to { opacity:1; transform:scale(1); } }
        @keyframes fi { from { opacity:0; } to { opacity:1; } }

        .modal-ic {
            width: 48px; height: 48px; border-radius: 50%;
            background: var(--danger-bg);
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }
        .modal-ic i { font-size: 20px; color: var(--danger); }
        .modal-b h3 { font-size: 15px; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
        .modal-b p { font-size: 13px; color: var(--text-secondary); margin-bottom: 20px; line-height: 1.6; }
        .modal-acts { display: flex; gap: 8px; justify-content: center; }
        .mbtn {
            padding: 8px 20px; border-radius: 8px;
            font-size: 13px; font-weight: 600; border: none;
            cursor: pointer; font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }
        .mbtn.c { background: rgba(255,255,255,0.06); color: var(--text-secondary); }
        .mbtn.c:hover { background: rgba(255,255,255,0.1); color: var(--text-primary); }
        .mbtn.d { background: var(--danger); color: #fff; }
        .mbtn.d:hover { background: #dc2626; box-shadow: 0 4px 14px rgba(239,68,68,0.3); }

        .lb {
            display: none; position: fixed; inset: 0; z-index: 10000;
            background: rgba(0,0,0,0.9);
            backdrop-filter: blur(20px);
            align-items: center; justify-content: center;
            cursor: zoom-out;
        }
        .lb.show { display: flex; animation: fi 0.2s ease; }
        .lb img {
            max-width: 90vw; max-height: 85vh;
            border-radius: 10px;
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

        @media (max-width: 1100px) { .grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .page { padding: 18px 16px 50px; }
            .topbar { padding: 0 16px; }
            .topbar-brand span { display: none; }
            .grid { grid-template-columns: 1fr; }
            .pg-stats { flex-wrap: wrap; }
            .user-chip .un { display: none; }
        }
    </style>
</head>
<body>

<header class="topbar">
    <div class="topbar-left">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Dashboard
        </a>
        <div class="topbar-sep"></div>
        <div class="topbar-brand">
            <div class="topbar-brand-icon"><i class="fas fa-shield-halved"></i></div>
            <span>Moderasi Project</span>
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-chip"><i class="fas fa-shield-check"></i> Moderator</div>
        <div class="user-chip">
            <div class="av">{{ Auth::user()->name[0] ?? 'A' }}</div>
            <span class="un">{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>
    </div>
</header>

<main class="page">

    <div class="pg-header">
        <div>
            <h1>Semua Project User</h1>
            <p>Kelola dan moderasi project yang dikirim user</p>
        </div>
        <div class="pg-stats">
            <div class="sp g"><span class="n">{{ $projects->where('status','published')->count() }}</span>Published</div>
            <div class="sp a"><span class="n">{{ $projects->where('status','draft')->count() }}</span>Draft</div>
            <div class="sp c"><span class="n">{{ $projects->count() }}</span>Total</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-ok"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="search-wrap">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Cari project atau user..." id="searchInput" oninput="doFilter()">
    </div>

    <div class="grid" id="grid">

        @forelse($projects as $project)
        <div class="pcard"
             data-title="{{ strtolower($project->title) }}"
             data-user="{{ strtolower($project->user->name ?? '') }}">

            <div class="pcard-thumb">
                @if($project->media->count())
                    @php $m = $project->media->first(); @endphp
                    @if($m->file_type == 'image')
                        <img src="{{ asset('storage/'.$m->file_path) }}"
                             loading="lazy"
                             onclick="openLb('{{ asset('storage/'.$m->file_path) }}')"
                             style="cursor:zoom-in;">
                        <span class="thumb-badge"><i class="fas fa-image"></i> {{ $project->media->count() }} media</span>
                    @elseif($m->file_type == 'video')
                        <video muted preload="metadata"><source src="{{ asset('storage/'.$m->file_path) }}"></video>
                        <span class="thumb-badge"><i class="fas fa-video"></i> {{ $project->media->count() }} media</span>
                    @else
                        <div class="thumb-empty"><i class="fas fa-file"></i> {{ $project->media->count() }} file</div>
                        <span class="thumb-badge"><i class="fas fa-file"></i> {{ $project->media->count() }} media</span>
                    @endif
                @else
                    <div class="thumb-empty"><i class="fas fa-photo-film"></i> No media</div>
                @endif

                <span class="thumb-status {{ $project->status == 'published' ? 'published' : 'draft' }}">
                    {{ $project->status }}
                </span>
            </div>

            <div class="pcard-body">
                <div class="pcard-title" title="{{ $project->title }}">{{ $project->title }}</div>
                <div class="pcard-desc">{{ $project->description }}</div>

                @if($project->categories->count())
                    <div class="pcard-tags">
                        @foreach($project->categories as $cat)
                            <span class="ptag">{{ $cat->name }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="pcard-meta">
                    <span><i class="far fa-user"></i> <span class="uname">{{ $project->user->name ?? '-' }}</span></span>
                    <span><i class="far fa-calendar"></i> {{ $project->created_at->format('d M Y') }}</span>
                </div>
            </div>

            <div class="pcard-foot">
                <div class="media-mini">
                    <i class="fas fa-photo-film"></i>
                    {{ $project->media->count() }} media
                </div>
                <div class="pcard-actions">
                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn-icon view" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button type="button" class="btn-icon del" title="Hapus Project"
                            onclick="confirmDel('{{ $project->id }}','{{ $project->title }}')">
                        <i class="fas fa-trash-can"></i>
                    </button>
                </div>
            </div>

        </div>
        @empty
        <div class="empty">
            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
            <h3>Belum ada project</h3>
            <p>Project yang dikirim user akan muncul di sini</p>
        </div>
        @endforelse

    </div>
</main>

<div class="modal-o" id="modal">
    <div class="modal-b">
        <div class="modal-ic"><i class="fas fa-trash-can"></i></div>
        <h3>Hapus Project?</h3>
        <p id="modalText">Project ini akan dihapus permanen.</p>
        <div class="modal-acts">
            <button class="mbtn c" onclick="closeModal()">Batal</button>
            <form id="delForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="mbtn d">Hapus</button>
            </form>
        </div>
    </div>
</div>

<div class="lb" id="lb" onclick="closeLb()">
    <button class="lb-x" onclick="closeLb()"><i class="fas fa-xmark"></i></button>
    <img id="lbImg" src="" alt="Preview">
</div>

<script>
    function doFilter() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#grid .pcard').forEach(c => {
            const t = c.dataset.title || '';
            const u = c.dataset.user || '';
            c.style.display = (t.includes(q) || u.includes(q)) ? '' : 'none';
        });
    }

    function confirmDel(id, title) {
        document.getElementById('modalText').textContent =
            `"${title}" beserta semua media-nya akan dihapus permanen.`;
        document.getElementById('delForm').action = '/admin/projects/' + id;
        document.getElementById('modal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modal').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.getElementById('modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

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
        if (e.key === 'Escape') { closeModal(); closeLb(); }
    });
</script>

</body>
</html>