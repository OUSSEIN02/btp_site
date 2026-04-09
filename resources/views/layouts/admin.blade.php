<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Vision Optique - Administration')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        :root {
            --sidebar-bg:       #0f2544;
            --sidebar-hover:    #1a3a6b;
            --sidebar-active:   #1e4080;
            --sidebar-accent:   #f0a500;
            --sidebar-text:     #b8cce8;
            --sidebar-text-dim: #6b8ab0;
            --sidebar-border:   #1c3558;
            --topbar-bg:        #ffffff;
            --page-bg:          #f0f4f9;
            --card-bg:          #ffffff;
            --brand:            #1e3a6e;
            --accent:           #f0a500;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--page-bg);
            min-height: 100vh;
        }

        /* ══════════════ SIDEBAR ══════════════ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 260px;
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 40;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        /* Décoration géométrique subtile en haut du sidebar */
        .sidebar::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 180px; height: 180px;
            border: 40px solid rgba(240,165,0,0.06);
            border-radius: 50%;
            pointer-events: none;
        }
        .sidebar::after {
            content: '';
            position: absolute;
            bottom: 80px; left: -50px;
            width: 140px; height: 140px;
            border: 30px solid rgba(30,64,128,0.3);
            border-radius: 50%;
            pointer-events: none;
        }

        /* ── Logo ── */
        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--sidebar-border);
            flex-shrink: 0;
        }
        .logo-badge {
            width: 42px; height: 42px;
            background: var(--sidebar-accent);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(240,165,0,0.35);
        }
        .logo-text-main {
            font-family: 'Sora', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.3px;
            line-height: 1;
        }
        .logo-text-sub {
            font-size: 0.7rem;
            color: var(--sidebar-text-dim);
            font-weight: 500;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* ── Navigation ── */
        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }
        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--sidebar-text-dim);
            padding: 8px 12px 6px;
            margin-top: 8px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            color: var(--sidebar-text);
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.18s ease;
            margin-bottom: 2px;
            position: relative;
            overflow: hidden;
        }
        .nav-link:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }
        .nav-link.active {
            background: var(--sidebar-active);
            color: #ffffff;
        }
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--sidebar-accent);
            border-radius: 0 3px 3px 0;
        }
        .nav-link .nav-icon {
            width: 34px; height: 34px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 0.8rem;
            background: rgba(255,255,255,0.05);
            transition: background 0.18s;
        }
        .nav-link.active .nav-icon {
            background: rgba(240,165,0,0.2);
            color: var(--sidebar-accent);
        }
        .nav-link:hover .nav-icon {
            background: rgba(255,255,255,0.1);
        }
        .nav-badge {
            margin-left: auto;
            background: var(--sidebar-accent);
            color: #0f2544;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 20px;
        }

        /* ── User footer ── */
        .sidebar-footer {
            padding: 14px 16px;
            border-top: 1px solid var(--sidebar-border);
            flex-shrink: 0;
            background: rgba(0,0,0,0.15);
        }
        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #f0a500, #e06f00);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 0.85rem;
            color: #0f2544;
            flex-shrink: 0;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            color: #ef4444;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            transition: background 0.15s;
            margin-top: 10px;
        }
        .logout-btn:hover { background: rgba(239,68,68,0.1); }

        /* ══════════════ TOPBAR ══════════════ */
        .topbar {
            background: var(--topbar-bg);
            border-bottom: 1px solid #e8edf5;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .topbar-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f2544;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .notif-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: #f0f4f9;
            border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            position: relative;
            transition: background 0.15s;
        }
        .notif-btn:hover { background: #e2e8f0; }
        .notif-dot {
            position: absolute;
            top: 7px; right: 7px;
            width: 8px; height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
        }
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 12px;
            background: #f0f4f9;
            cursor: pointer;
            transition: background 0.15s;
        }
        .topbar-user:hover { background: #e2e8f0; }
        .topbar-avatar {
            width: 30px; height: 30px;
            border-radius: 8px;
            background: linear-gradient(135deg, #1e3a6e, #2a52bf);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 800; color: white;
        }
        .topbar-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: #1e293b;
        }

        /* ══════════════ LAYOUT WRAPPER ══════════════ */
        .layout-wrap {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
            padding: 24px;
        }

        /* ══════════════ HAMBURGER ══════════════ */
        .hamburger {
            display: none;
            width: 38px; height: 38px;
            border: none;
            border-radius: 10px;
            background: #f0f4f9;
            cursor: pointer;
            align-items: center; justify-content: center;
            flex-direction: column;
            gap: 5px;
        }
        .hamburger span {
            display: block;
            width: 18px; height: 2px;
            background: #0f2544;
            border-radius: 2px;
            transition: all 0.3s;
        }

        /* ══════════════ OVERLAY ══════════════ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 35;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.open { display: block; }

        /* ══════════════ STAT CARDS ══════════════ */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #e8edf5;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(30,58,110,0.1);
        }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }
        .stat-value {
            font-family: 'Sora', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #0f2544;
            line-height: 1;
            margin-top: 12px;
        }
        .stat-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #94a3b8;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-trend {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .trend-up { background: #dcfce7; color: #16a34a; }
        .trend-down { background: #fee2e2; color: #dc2626; }

        /* ══════════════ STATUS BADGES ══════════════ */
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            display: inline-block;
        }
        .badge-pending  { background: #fef3c7; color: #b45309; }
        .badge-confirm  { background: #d1fae5; color: #065f46; }
        .badge-cancel   { background: #fee2e2; color: #991b1b; }

        /* ══════════════ TABLE ══════════════ */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }
        .data-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #94a3b8;
            background: #f8fafc;
            border-bottom: 1px solid #e8edf5;
        }
        .data-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-weight: 500;
        }
        .data-table tr:hover td { background: #f8fafc; }
        .data-table tr:last-child td { border-bottom: none; }

        /* ══════════════ RESPONSIVE ══════════════ */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
                box-shadow: 8px 0 32px rgba(0,0,0,0.3);
            }
            .layout-wrap {
                margin-left: 0;
            }
            .hamburger {
                display: flex;
            }
            .topbar {
                padding: 0 16px;
            }
            .main-content {
                padding: 16px;
            }
            .stats-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 12px !important;
            }
            .topbar-name { display: none; }
            .greeting-text { font-size: 1.2rem !important; }
        }
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr !important;
            }
        }

        /* ══════════════ MISC ══════════════ */
        .section-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid #e8edf5;
            overflow: hidden;
        }
        .section-header {
            padding: 18px 20px 14px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .section-title {
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f2544;
        }
        .btn-sm {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1.5px solid #1e3a6e;
            color: #1e3a6e;
            background: transparent;
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
        }
        .btn-sm:hover { background: #1e3a6e; color: white; }

        /* Chart container */
        .chart-wrap { padding: 16px 20px 20px; }

        <style>
.user-dropdown {
    position: absolute;
    top: 110%;
    right: 0;
    background: white;
    width: 180px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    padding: 10px 0;
    display: none;
    z-index: 100;
}

.user-dropdown a {
    display: block;
    padding: 10px 15px;
    font-size: 14px;
    color: #334155;
    text-decoration: none;
    transition: background 0.2s;
}

.user-dropdown a:hover {
    background: #f1f5f9;
}

.user-dropdown hr {
    border: none;
    border-top: 1px solid #e2e8f0;
    margin: 8px 0;
}

.logout-btn {
    width: 100%;
    background: none;
    border: none;
    padding: 10px 15px;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
    color: #ef4444;
}

.logout-btn:hover {
    background: #fef2f2;
}
</style>
    </style>

    @stack('styles')
</head>

<body>

<!-- ══════════════ SIDEBAR ══════════════ -->
<aside class="sidebar" id="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <div style="display:flex; align-items:center; gap:12px;">
            <div class="logo-badge">
                <svg width="22" height="13" viewBox="0 0 32 18" fill="none">
                    <rect x="1" y="4" width="12" height="10" rx="5" stroke="#0f2544" stroke-width="2.5"/>
                    <rect x="19" y="4" width="12" height="10" rx="5" stroke="#0f2544" stroke-width="2.5"/>
                    <line x1="13" y1="9" x2="19" y2="9" stroke="#0f2544" stroke-width="2.5"/>
                </svg>
            </div>
            <div>
                <div class="logo-text-main">Vision Optique</div>
                <div class="logo-text-sub">Administration</div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <div class="nav-section-label">Principal</div>

        <a href="{{ route('admin.dashboard') }}"
           onclick="closeSidebar()"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-chart-line" style="width:16px;height:16px;font-size:14px;"></i></span>
            Tableau de bord
        </a>

        <a href="{{ route('admin.rendezvous') }}"
           onclick="closeSidebar()"
           class="nav-link {{ request()->routeIs('admin.rendezvous*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-calendar-check" style="width:16px;height:16px;font-size:14px;"></i></span>
            Rendez-vous
            <span class="nav-badge">3</span>
        </a>

        <a href="{{ route('admin.messages.dashboard') }}"
           onclick="closeSidebar()"
           class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-envelope" style="width:16px;height:16px;font-size:14px;"></i></span>
            Messages
            <span class="nav-badge">7</span>
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Catalogue</div>

        <a href="{{ route('admin.glasses') }}"
           onclick="closeSidebar()"
           class="nav-link {{ request()->routeIs('admin.glasses*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-glasses" style="width:16px;height:16px;font-size:14px;"></i></span>
            Collections
        </a>

        <div class="nav-section-label" style="margin-top:12px;">Système</div>

        <a href="{{ route('admin.settings') }}"
           onclick="closeSidebar()"
           class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-cog" style="width:16px;height:16px;font-size:14px;"></i></span>
            Paramètres
        </a>
    </nav>

</aside>

<!-- Overlay mobile -->
<div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>

<!-- ══════════════ LAYOUT PRINCIPAL ══════════════ -->
<div class="layout-wrap">

    <!-- Topbar -->
    <header class="topbar">
        <div style="display:flex; align-items:center; gap:12px;">
            <button class="hamburger" id="hamburger-btn" onclick="openSidebar()" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
            <h1 class="topbar-title">@yield('header', 'Tableau de bord')</h1>
        </div>

        <div class="topbar-right">
           

            <!-- Notifications -->
            <button class="notif-btn">
                <i class="fas fa-bell" style="font-size:14px;"></i>
                <span class="notif-dot"></span>
            </button>

          <!-- User pill -->
            <!-- User pill -->
<div x-data="{ open: false }" class="relative">

<div @click="open = !open"
     class="topbar-user flex items-center gap-2 cursor-pointer select-none">

    <div class="topbar-avatar">
        {{ strtoupper(substr(Auth::user()->nom ?? 'A', 0, 1)) }}
    </div>

    <span class="topbar-name">
        {{ Auth::user()->name ?? 'Admin' }}
    </span>

    <i class="fas fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200"
       :class="open ? 'rotate-180' : ''">
    </i>
</div>

<!-- Dropdown -->
<div x-show="open"
     @click.outside="open = false"
     x-transition
     class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">

   

    <div class="border-t my-2"></div>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" id="logout-btn"
                class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50">
            Se déconnecter
        </button>
    </form>

</div>

</div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="main-content">
        @yield('content')
    </main>
</div>


<!-- ══════════════ MODALE LOGOUT ══════════════ -->
<div id="logout-modal"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:60; align-items:center; justify-content:center; padding:16px;">
    <div style="background:white; border-radius:20px; max-width:400px; width:100%; padding:32px; text-align:center;">

        <div style="width:56px; height:56px; background:#fee2e2; border-radius:16px; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <i class="fas fa-sign-out-alt" style="font-size:1.3rem; color:#ef4444;"></i>
        </div>

        <div style="font-family:'Sora',sans-serif; font-size:1.1rem; font-weight:700; color:#0f2544; margin-bottom:8px;">
            Déconnexion
        </div>
        <p style="font-size:0.875rem; color:#64748b; margin-bottom:24px;">
            Êtes-vous sûr de vouloir vous déconnecter ?
        </p>

        <div style="display:flex; gap:12px;">
            <button id="close-modal"
                    style="flex:1; padding:11px; border:1.5px solid #e2e8f0; border-radius:12px; font-family:'Nunito',sans-serif; font-weight:700; font-size:0.875rem; color:#64748b; background:white; cursor:pointer; transition:background 0.15s;"
                    onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                Annuler
            </button>
            <form method="POST" action="{{ route('admin.logout') }}" style="flex:1;">
                @csrf
                <button type="submit"
                        style="width:100%; padding:11px; border:none; border-radius:12px; background:#ef4444; color:white; font-family:'Nunito',sans-serif; font-weight:700; font-size:0.875rem; cursor:pointer; transition:background 0.15s;"
                        onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    // ── Sidebar mobile ──
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('sidebar-overlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('open');
        document.body.style.overflow = '';
    }

    // ── Modale logout ──
    const modal = document.getElementById('logout-modal');
    document.querySelectorAll('#logout-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            modal.style.display = 'flex';
            closeSidebar();
        });
    });
  
    document.getElementById('close-modal').addEventListener('click', () => {
        modal.style.display = 'none';
    });
    modal.addEventListener('click', e => {
        if (e.target === modal) modal.style.display = 'none';
    });

    // ── ESC pour fermer ──
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeSidebar();
            modal.style.display = 'none';
        }
    });




function toggleDropdown() {
    const dropdown = document.getElementById("userDropdown");
    dropdown.style.display = 
        dropdown.style.display === "block" ? "none" : "block";
}

// Fermer si on clique ailleurs
window.onclick = function(e) {
    if (!e.target.closest('.topbar-user')) {
        document.getElementById("userDropdown").style.display = "none";
    }
}

</script>

@stack('scripts')
</body>
</html>