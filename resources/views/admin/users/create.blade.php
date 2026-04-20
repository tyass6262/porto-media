<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
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
            --indigo: #818cf8;
            --indigo-subtle: rgba(129, 140, 248, 0.08);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

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

        .breadcrumb-bar {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: var(--text-muted);
        }
        .breadcrumb-bar a { color: var(--text-muted); text-decoration: none; transition: color 0.15s; }
        .breadcrumb-bar a:hover { color: var(--accent); }
        .breadcrumb-bar .sep { opacity: 0.4; font-size: 10px; }
        .breadcrumb-bar .current { color: var(--text-secondary); font-weight: 500; }

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
            max-width: 680px;
            margin: 0 auto;
            padding: 28px 32px 60px;
        }

        .page-header { margin-bottom: 24px; }
        .page-header h1 {
            font-size: 22px; font-weight: 800; color: var(--text-primary);
            letter-spacing: -0.03em; margin-bottom: 2px;
        }
        .page-header p { font-size: 13px; color: var(--text-muted); }

        /* Session alert */
        .session-alert { margin-bottom: 18px; }
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

        /* Validation errors */
        .val-errors {
            background: var(--danger-bg);
            border: 1px solid rgba(239,68,68,0.18);
            border-radius: 12px; padding: 16px 20px;
            margin-bottom: 20px;
            animation: shk 0.4s ease;
        }
        @keyframes shk {
            0%{opacity:0;transform:translateX(-8px)} 25%{transform:translateX(5px)} 50%{transform:translateX(-3px)} 100%{opacity:1;transform:translateX(0)}
        }
        .val-errors .ve-title {
            font-size: 13px; font-weight: 700; color: #fca5a5;
            margin-bottom: 8px;
            display: flex; align-items: center; gap: 8px;
        }
        .val-errors .ve-title i { font-size: 14px; }
        .val-errors ul { list-style: none; }
        .val-errors li {
            font-size: 13px; color: #fca5a5; padding-left: 18px;
            position: relative; margin-bottom: 3px;
        }
        .val-errors li::before {
            content: ''; position: absolute; left: 4px; top: 50%;
            width: 5px; height: 5px; border-radius: 50%;
            background: var(--danger); transform: translateY(-50%);
        }

        /* Form card */
        .form-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 32px;
            animation: fu 0.4s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fu { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .form-card-head {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 26px;
        }
        .form-card-head i {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }
        .ic-green { background: var(--accent-subtle); border: 1px solid rgba(16,185,129,0.15); color: var(--accent); }
        .form-card-head span { font-size: 15px; font-weight: 700; color: var(--text-primary); }

        /* Fields */
        .fg { margin-bottom: 22px; }
        .fg:last-of-type { margin-bottom: 0; }
        .fg label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-secondary); margin-bottom: 8px;
        }
        .fg label .req { color: var(--danger); margin-left: 2px; }

        .iw { position: relative; display: flex; align-items: center; }
        .iw .iw-icon {
            position: absolute; left: 15px; font-size: 14px;
            color: var(--text-muted); transition: color 0.2s; pointer-events: none; z-index: 2;
        }

        .fi {
            width: 100%; padding: 12px 16px 12px 44px;
            background: var(--input-bg); border: 1px solid var(--input-border);
            border-radius: 10px; color: var(--text-primary);
            font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
            outline: none; transition: all 0.2s;
        }
        .fi::placeholder { color: var(--text-muted); font-size: 13px; }
        .fi:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(16,185,129,0.06);
            background: rgba(15,23,42,1);
        }
        .fi:focus + .iw-icon { color: var(--accent); }
        .fi.err { border-color: var(--danger); box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }

        .fe {
            font-size: 12px; color: #fca5a5; margin-top: 6px;
            display: flex; align-items: center; gap: 5px;
        }
        .fe i { font-size: 11px; }

        .toggle-pw {
            position: absolute; right: 12px; background: none; border: none;
            color: var(--text-muted); cursor: pointer; font-size: 14px;
            padding: 4px; transition: color 0.15s; z-index: 2;
        }
        .toggle-pw:hover { color: var(--text-secondary); }

        /* Strength bar */
        .str-wrap { display: flex; gap: 4px; margin-top: 8px; }
        .str-seg {
            flex: 1; height: 3px; border-radius: 2px;
            background: rgba(255,255,255,0.06); transition: background 0.25s;
        }
        .str-label {
            font-size: 11px; margin-top: 5px; color: var(--text-muted);
            transition: color 0.25s; min-height: 15px;
        }

        /* Actions */
        .form-actions {
            display: flex; justify-content: flex-end; gap: 10px;
            margin-top: 30px; padding-top: 22px;
            border-top: 1px solid var(--card-border);
        }
        .btn-cancel {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 11px 22px; border-radius: 10px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--input-border);
            color: var(--text-secondary);
            font-size: 13px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
        }
        .btn-cancel:hover {
            background: rgba(255,255,255,0.07);
            color: var(--text-primary);
        }
        .btn-submit {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 11px 26px; border-radius: 10px;
            background: var(--accent); color: #fff; border: none;
            font-size: 13px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-submit:hover {
            background: var(--accent-hover);
            box-shadow: 0 4px 18px var(--accent-glow);
            transform: translateY(-1px);
        }
        .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; box-shadow: none; }

        /* ═══ RESPONSIVE ═══ */
        @media (max-width: 640px) {
            .topbar { padding: 0 16px; }
            .page { padding: 20px 16px 50px; }
            .form-card { padding: 22px 18px; }
            .page-header h1 { font-size: 20px; }
            .form-actions { flex-direction: column; }
            .btn-cancel, .btn-submit { width: 100%; justify-content: center; }
            .user-pill .up-name { display: none; }
            .breadcrumb-bar .bc-mid { display: none; }
        }
    </style>
</head>
<body>

<!-- ═══ TOPBAR ═══ -->
<header class="topbar">
    <div class="topbar-left">
        <a href="{{ route('admin.users.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Pengguna
        </a>
        <div class="topbar-sep"></div>
        <div class="breadcrumb-bar">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <a href="{{ route('admin.users.index') }}" class="bc-mid">Pengguna</a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <span class="current">Tambah</span>
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-chip"><i class="fas fa-user-plus"></i> Tambah</div>
        <div class="user-pill">
            <div class="up-av">{{ substr(optional(auth()->user())->name ?? 'A', 0, 1) }}</div>
            <span class="up-name">{{ optional(auth()->user())->name ?? 'Admin' }}</span>
        </div>
    </div>
</header>

<!-- ═══ PAGE ═══ -->
<main class="page">

    @if(session('error'))
        <div class="session-alert">
            <div class="alert-err"><i class="fas fa-circle-exclamation"></i><span>{{ session('error') }}</span></div>
        </div>
    @endif

    <div class="page-header">
        <h1>Tambah Pengguna Baru</h1>
        <p>Isi data berikut untuk membuat akun pengguna baru</p>
    </div>

    @if($errors->any())
        <div class="val-errors">
            <div class="ve-title">
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

    <div class="form-card">
        <div class="form-card-head">
            <i class="ic-green"><i class="fas fa-user-plus"></i></i>
            <span>Data Akun</span>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" id="userForm">
            @csrf

            <div class="fg">
                <label for="name">Nama Lengkap <span class="req">*</span></label>
                <div class="iw">
                    <i class="fas fa-user iw-icon"></i>
                    <input type="text" id="name" name="name"
                        class="fi {{ $errors->has('name') ? 'err' : '' }}"
                        placeholder="Contoh: Budi Santoso"
                        value="{{ old('name') }}"
                        required maxlength="100" autocomplete="name">
                </div>
                @if($errors->has('name'))
                    <div class="fe"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="fg">
                <label for="email">Email <span class="req">*</span></label>
                <div class="iw">
                    <i class="fas fa-envelope iw-icon"></i>
                    <input type="email" id="email" name="email"
                        class="fi {{ $errors->has('email') ? 'err' : '' }}"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}"
                        required maxlength="150" autocomplete="email">
                </div>
                @if($errors->has('email'))
                    <div class="fe"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="fg">
                <label for="password">Password <span class="req">*</span></label>
                <div class="iw">
                    <i class="fas fa-key iw-icon"></i>
                    <input type="password" id="password" name="password"
                        class="fi {{ $errors->has('password') ? 'err' : '' }}"
                        placeholder="Minimal 8 karakter"
                        required minlength="8" autocomplete="new-password">
                    <button type="button" class="toggle-pw" onclick="togglePw('password','eye1')">
                        <i class="fas fa-eye" id="eye1"></i>
                    </button>
                </div>
                <div class="str-wrap">
                    <div class="str-seg" id="s1"></div>
                    <div class="str-seg" id="s2"></div>
                    <div class="str-seg" id="s3"></div>
                    <div class="str-seg" id="s4"></div>
                </div>
                <div class="str-label" id="strLabel"></div>
                @if($errors->has('password'))
                    <div class="fe"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="fg">
                <label for="password_confirmation">Konfirmasi Password <span class="req">*</span></label>
                <div class="iw">
                    <i class="fas fa-lock iw-icon"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="fi {{ $errors->has('password_confirmation') ? 'err' : '' }}"
                        placeholder="Ulangi password"
                        required autocomplete="new-password">
                    <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation','eye2')">
                        <i class="fas fa-eye" id="eye2"></i>
                    </button>
                </div>
                <div class="str-label" id="matchLabel"></div>
                @if($errors->has('password_confirmation'))
                    <div class="fe"><i class="fas fa-circle-exclamation"></i>{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn-submit" id="btnSub">
                    <i class="fas fa-check"></i>
                    <span id="btnTxt">Simpan Pengguna</span>
                </button>
            </div>
        </form>
    </div>

</main>

<script>
    function togglePw(id, iconId) {
        var inp = document.getElementById(id);
        var ic = document.getElementById(iconId);
        if (inp.type === 'password') {
            inp.type = 'text';
            ic.classList.replace('fa-eye','fa-eye-slash');
        } else {
            inp.type = 'password';
            ic.classList.replace('fa-eye-slash','fa-eye');
        }
    }

    var pwIn = document.getElementById('password');
    var segs = [
        document.getElementById('s1'), document.getElementById('s2'),
        document.getElementById('s3'), document.getElementById('s4')
    ];
    var strLabel = document.getElementById('strLabel');
    var strLevels = [
        {l:'',c:''},
        {l:'Lemah',c:'#ef4444'},
        {l:'Cukup',c:'#f59e0b'},
        {l:'Kuat',c:'#10b981'},
        {l:'Sangat Kuat',c:'#06b6d4'}
    ];

    function getScore(p) {
        var s = 0;
        if (p.length >= 8) s++;
        if (/[a-z]/.test(p) && /[A-Z]/.test(p)) s++;
        if (/\d/.test(p)) s++;
        if (/[^a-zA-Z0-9]/.test(p)) s++;
        return s;
    }

    pwIn.addEventListener('input', function() {
        var v = this.value;
        var sc = v.length === 0 ? 0 : getScore(v);
        segs.forEach(function(s,i) { s.style.background = i < sc ? strLevels[sc].c : 'rgba(255,255,255,0.06)'; });
        strLabel.textContent = strLevels[sc].l;
        strLabel.style.color = strLevels[sc].c || 'var(--text-muted)';
        checkMatch();
    });

    var confIn = document.getElementById('password_confirmation');
    var matchLabel = document.getElementById('matchLabel');

    function checkMatch() {
        var p = pwIn.value, c = confIn.value;
        if (!c.length) {
            matchLabel.textContent = '';
            confIn.classList.remove('err');
            return;
        }
        if (p === c) {
            matchLabel.textContent = 'Password cocok';
            matchLabel.style.color = 'var(--accent)';
            confIn.classList.remove('err');
        } else {
            matchLabel.textContent = 'Password tidak cocok';
            matchLabel.style.color = 'var(--danger)';
            confIn.classList.add('err');
        }
    }
    confIn.addEventListener('input', checkMatch);

    document.getElementById('userForm').addEventListener('submit', function(e) {
        if (pwIn.value !== confIn.value) {
            e.preventDefault();
            matchLabel.textContent = 'Password tidak cocok';
            matchLabel.style.color = 'var(--danger)';
            confIn.classList.add('err');
            confIn.focus();
            return;
        }
        if (getScore(pwIn.value) < 2) {
            e.preventDefault();
            strLabel.textContent = 'Password terlalu lemah';
            strLabel.style.color = 'var(--danger)';
            pwIn.focus();
            return;
        }
        var btn = document.getElementById('btnSub');
        var txt = document.getElementById('btnTxt');
        btn.disabled = true;
        txt.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:6px"></i>Menyimpan...';
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