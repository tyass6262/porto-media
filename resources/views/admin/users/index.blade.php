<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
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
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--card-border);
            height: 56px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px;
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 13px; border-radius: 7px;
            font-size: 12px; font-weight: 500;
            color: var(--text-muted); text-decoration: none;
            background: transparent;
            border: 1px solid var(--card-border);
            cursor: pointer; transition: all 0.18s;
            font-family: 'Plus Jakarta Sans', sans-serif;
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
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: #fff;
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
            max-width: 1060px;
            margin: 0 auto;
            padding: 28px 32px 60px;
        }

        /* Page Header */
        .page-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 22px; gap: 16px; flex-wrap: wrap;
        }
        .page-header h1 {
            font-size: 22px; font-weight: 800; color: var(--text-primary);
            letter-spacing: -0.03em; margin-bottom: 2px;
        }
        .page-header p { font-size: 13px; color: var(--text-muted); }
        .count-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.15);
            color: var(--accent); font-size: 12px; font-weight: 600;
            padding: 3px 11px; border-radius: 20px; margin-top: 6px;
        }

        .btn-add {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 10px;
            background: var(--accent); color: #fff; border: none;
            font-size: 13px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none;
            box-shadow: 0 3px 14px var(--accent-glow);
        }
        .btn-add:hover {
            background: var(--accent-hover);
            box-shadow: 0 5px 22px rgba(16,185,129,0.35);
            transform: translateY(-1px);
            color: #fff;
        }
        .btn-add i { font-size: 12px; }

        /* Session alerts */
        .session-alert { margin-bottom: 18px; }
        .alert-ok {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 18px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.14);
            border-radius: 12px;
            color: var(--accent-hover); font-size: 13px; font-weight: 500;
            animation: sld 0.3s ease;
        }
        .alert-ok i { font-size: 14px; }
        .alert-err {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 18px;
            background: var(--danger-bg);
            border: 1px solid rgba(239,68,68,0.18);
            border-radius: 12px;
            color: #fca5a5; font-size: 13px; font-weight: 500;
            animation: sld 0.3s ease;
        }
        .alert-err i { font-size: 14px; color: var(--danger); }
        @keyframes sld { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }

        /* Toolbar */
        .toolbar {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 18px; flex-wrap: wrap;
        }
        .search-box { flex: 1; min-width: 200px; position: relative; }
        .search-box i {
            position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 12px; pointer-events: none;
        }
        .search-box input {
            width: 100%; padding: 9px 14px 9px 38px;
            background: var(--input-bg); border: 1px solid var(--input-border);
            border-radius: 9px; color: var(--text-primary);
            font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none; transition: all 0.2s;
        }
        .search-box input::placeholder { color: var(--text-muted); }
        .search-box input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(16,185,129,0.06);
        }

        .filter-tabs {
            display: flex; gap: 3px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--card-border);
            border-radius: 9px; padding: 3px;
        }
        .ftab {
            padding: 7px 16px; border-radius: 7px;
            font-size: 12px; font-weight: 500;
            color: var(--text-muted); background: transparent;
            border: none; cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.15s;
        }
        .ftab:hover { color: var(--text-secondary); }
        .ftab.on { background: rgba(255,255,255,0.08); color: var(--text-primary); font-weight: 600; }

        /* Table */
        .table-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px; overflow: hidden;
            animation: fu 0.4s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fu {
            from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); }
        }
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: rgba(255,255,255,0.02); }
        th {
            padding: 13px 20px; text-align: left;
            font-size: 11px; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.8px;
            border-bottom: 1px solid var(--card-border);
            white-space: nowrap;
        }
        td {
            padding: 14px 20px; font-size: 13px;
            border-bottom: 1px solid var(--card-border);
            color: var(--text-secondary); vertical-align: middle;
        }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(255,255,255,0.02); }
        tbody tr:last-child td { border-bottom: none; }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: 14px; }
        .user-av {
            width: 38px; height: 38px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
            text-transform: uppercase;
        }
        .av-0 { background: linear-gradient(135deg, #10b981, #059669); }
        .av-1 { background: linear-gradient(135deg, #06b6d4, #0891b2); }
        .av-2 { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .av-3 { background: linear-gradient(135deg, #818cf8, #6366f1); }
        .av-4 { background: linear-gradient(135deg, #f43f5e, #e11d48); }
        .user-name { font-weight: 600; color: var(--text-primary); }
        .user-email { font-size: 12px; color: var(--text-muted); margin-top: 1px; }

        /* Role badge */
        .role-pill {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 11px; border-radius: 20px;
            font-size: 11px; font-weight: 600;
        }
        .role-pill .dot { width: 5px; height: 5px; border-radius: 50%; }
        .rl-admin { background: var(--indigo-subtle); border: 1px solid rgba(129,140,248,0.12); color: var(--indigo); }
        .rl-admin .dot { background: var(--indigo); box-shadow: 0 0 6px var(--indigo); }
        .rl-user { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.12); color: var(--accent); }
        .rl-user .dot { background: var(--accent); box-shadow: 0 0 6px var(--accent); }
        .rl-editor { background: var(--amber-subtle); border: 1px solid rgba(245,158,11,0.12); color: var(--amber); }
        .rl-editor .dot { background: var(--amber); box-shadow: 0 0 6px var(--amber); }
        .rl-def { background: rgba(255,255,255,0.03); border: 1px solid var(--input-border); color: var(--text-muted); }
        .rl-def .dot { background: var(--text-muted); }

        .date-text { font-size: 12px; color: var(--text-muted); white-space: nowrap; }

        /* Action buttons */
        .action-btns { display: flex; gap: 5px; justify-content: flex-end; }
        .btn-ic {
            width: 32px; height: 32px; border-radius: 7px;
            background: rgba(255,255,255,0.03); border: 1px solid var(--card-border);
            color: var(--text-muted); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; transition: all 0.15s;
            text-decoration: none; padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-ic:hover { background: rgba(255,255,255,0.06); color: var(--text-primary); }
        .btn-ic.del:hover { background: var(--danger-bg); color: var(--danger); border-color: rgba(239,68,68,0.18); }

        /* Empty */
        .empty { text-align: center; padding: 60px 20px; }
        .empty-icon {
            width: 64px; height: 64px; border-radius: 18px;
            background: var(--accent-subtle);
            border: 1px solid rgba(16,185,129,0.12);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 26px; color: var(--accent); opacity: 0.4; margin-bottom: 16px;
        }
        .empty h3 { font-size: 16px; font-weight: 700; color: var(--text-secondary); margin-bottom: 4px; }
        .empty p { font-size: 13px; color: var(--text-muted); }

        .no-res { text-align: center; padding: 48px 20px; }
        .no-res i { font-size: 24px; color: var(--text-muted); opacity: 0.3; margin-bottom: 8px; display: block; }
        .no-res p { font-size: 13px; color: var(--text-muted); }

        /* Modal */
        .modal-o {
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,0.65);
            backdrop-filter: blur(6px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: all 0.2s;
            padding: 24px;
        }
        .modal-o.open { opacity: 1; visibility: visible; }
        .modal-b {
            background: rgba(17,24,39,0.97);
            border: 1px solid var(--card-border);
            border-radius: 16px; padding: 28px;
            max-width: 400px; width: 100%;
            transform: scale(0.95) translateY(16px);
            transition: transform 0.25s cubic-bezier(0.16,1,0.3,1);
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
        }
        .modal-o.open .modal-b { transform: scale(1) translateY(0); }
        .modal-ic {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--danger-bg);
            border: 1px solid rgba(239,68,68,0.18);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: var(--danger); margin-bottom: 18px;
        }
        .modal-b h3 { font-size: 16px; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
        .modal-b p { font-size: 13px; color: var(--text-muted); line-height: 1.6; margin-bottom: 24px; }
        .modal-b p strong { color: var(--text-secondary); }
        .modal-acts { display: flex; gap: 8px; }
        .mbtn {
            flex: 1; padding: 10px; border-radius: 9px;
            font-size: 13px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.2s; border: none;
        }
        .mbtn.c { background: rgba(255,255,255,0.06); color: var(--text-secondary); }
        .mbtn.c:hover { background: rgba(255,255,255,0.1); color: var(--text-primary); }
        .mbtn.d { background: var(--danger); color: #fff; }
        .mbtn.d:hover { background: #dc2626; box-shadow: 0 4px 14px rgba(239,68,68,0.3); }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 640px) {
            .topbar { padding: 0 16px; }
            .page { padding: 20px 16px 50px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .hide-m { display: none; }
            .user-pill .up-name { display: none; }
        }
    </style>
</head>
<body>

<!-- ═══ TOPBAR ═══ -->
<header class="topbar">
    <div class="topbar-left">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Dashboard
        </a>
        <div class="topbar-sep"></div>
        <div class="topbar-brand">
            <div class="topbar-brand-icon"><i class="fas fa-users"></i></div>
            <span>Kelola Pengguna</span>
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-chip"><i class="fas fa-shield-check"></i> Admin</div>
        <div class="user-pill">
            <div class="up-av">{{ substr(optional(auth()->user())->name ?? 'A', 0, 1) }}</div>
            <span class="up-name">{{ optional(auth()->user())->name ?? 'Admin' }}</span>
        </div>
    </div>
</header>

<!-- ═══ PAGE ═══ -->
<main class="page">

    @if(session('success'))
        <div class="session-alert">
            <div class="alert-ok"><i class="fas fa-circle-check"></i><span>{{ session('success') }}</span></div>
        </div>
    @endif

    @if(session('error'))
        <div class="session-alert">
            <div class="alert-err"><i class="fas fa-circle-exclamation"></i><span>{{ session('error') }}</span></div>
        </div>
    @endif

    <div class="page-header">
        <div>
            <h1>Kelola Pengguna</h1>
            <p>Kelola akun pengguna, atur peran, dan pantau aktivitas</p>
            <div class="count-badge"><i class="fas fa-users"></i> {{ $users->count() }} pengguna</div>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Pengguna
        </a>
    </div>

    <div class="toolbar">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari nama atau email..." autocomplete="off">
            <i class="fas fa-search"></i>
        </div>
        <div class="filter-tabs">
            <button class="ftab on" data-f="all" onclick="setFilter('all',this)">Semua</button>
            <button class="ftab" data-f="admin" onclick="setFilter('admin',this)">Admin</button>
            <button class="ftab" data-f="user" onclick="setFilter('user',this)">User</button>
        </div>
    </div>

    <div class="table-card">
        @if($users->count() > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width:28%">Pengguna</th>
                            <th class="hide-m" style="width:24%">Email</th>
                            <th style="width:14%">Peran</th>
                            <th class="hide-m" style="width:14%">Bergabung</th>
                            <th style="width:14%; text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach($users as $user)
                            @php
                                $roleSlug = strtolower($user->role->slug ?? '');
                                $roleClass = 'rl-def';
                                $roleLabel = ucfirst($roleSlug) ?: '-';
                                if ($roleSlug === 'admin') { $roleClass = 'rl-admin'; $roleLabel = 'Admin'; }
                                elseif ($roleSlug === 'user') { $roleClass = 'rl-user'; $roleLabel = 'User'; }
                                elseif ($roleSlug === 'editor') { $roleClass = 'rl-editor'; $roleLabel = 'Editor'; }
                            @endphp
                            <tr data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" data-role="{{ $roleSlug }}">
                                <td>
                                    <div class="user-cell">
                                        <div class="user-av av-{{ $loop->index % 5 }}">{{ substr($user->name, 0, 2) }}</div>
                                        <div>
                                            <div class="user-name">{{ $user->name }}</div>
                                            <div class="user-email hide-m">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="hide-m">
                                    <span style="font-size:13px">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="role-pill {{ $roleClass }}">
                                        <span class="dot"></span>
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td class="hide-m">
                                    <span class="date-text">{{ $user->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-ic" title="Edit">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn-ic del" title="Hapus"
                                            onclick="confirmDel('{{ $user->name }}', '{{ route('admin.users.destroy', $user->id) }}')">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty">
                <div class="empty-icon"><i class="fas fa-users"></i></div>
                <h3>Belum ada pengguna</h3>
                <p>Mulai tambahkan pengguna pertama menggunakan tombol di atas.</p>
            </div>
        @endif
    </div>

</main>

<!-- ═══ MODAL ═══ -->
<div class="modal-o" id="delModal">
    <div class="modal-b">
        <div class="modal-ic"><i class="fas fa-trash-can"></i></div>
        <h3>Hapus Pengguna</h3>
        <p>Apakah kamu yakin ingin menghapus pengguna <strong id="delName"></strong>? Semua data terkait pengguna ini akan ikut terhapus.</p>
        <form id="delForm" method="POST" class="modal-acts">
            @csrf
            @method('DELETE')
            <button type="button" class="mbtn c" onclick="closeDel()">Batal</button>
            <button type="submit" class="mbtn d">Ya, Hapus</button>
        </form>
    </div>
</div>

<script>
    var curFilter = 'all';

    document.getElementById('searchInput').addEventListener('input', applyFilters);

    function setFilter(f, btn) {
        curFilter = f;
        document.querySelectorAll('.ftab').forEach(function(t) { t.classList.remove('on'); });
        btn.classList.add('on');
        applyFilters();
    }

    function applyFilters() {
        var q = document.getElementById('searchInput').value.toLowerCase().trim();
        var rows = document.querySelectorAll('#tbody tr');
        var vis = 0;

        rows.forEach(function(r) {
            var n = r.dataset.name || '';
            var e = r.dataset.email || '';
            var role = r.dataset.role || '';
            var show = (n.includes(q) || e.includes(q)) && (curFilter === 'all' || role === curFilter);
            r.style.display = show ? '' : 'none';
            if (show) vis++;
        });

        var nr = document.getElementById('noRes');
        if (vis === 0 && rows.length > 0) {
            if (!nr) {
                nr = document.createElement('tr');
                nr.id = 'noRes';
                nr.innerHTML = '<td colspan="5"><div class="no-res"><i class="fas fa-search"></i><p>Tidak ada pengguna yang cocok.</p></div></td>';
                document.getElementById('tbody').appendChild(nr);
            }
            nr.style.display = '';
        } else if (nr) {
            nr.style.display = 'none';
        }
    }

    function confirmDel(name, url) {
        document.getElementById('delName').textContent = name;
        document.getElementById('delForm').action = url;
        document.getElementById('delModal').classList.add('open');
    }

    function closeDel() {
        document.getElementById('delModal').classList.remove('open');
    }

    document.getElementById('delModal').addEventListener('click', function(e) {
        if (e.target === this) closeDel();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDel();
    });

    setTimeout(function() {
        document.querySelectorAll('.session-alert').forEach(function(el) {
            el.style.transition = 'all 0.4s ease';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-8px)';
            setTimeout(function() { el.remove(); }, 400);
        });
    }, 5000);
</script>

</body>
</html>