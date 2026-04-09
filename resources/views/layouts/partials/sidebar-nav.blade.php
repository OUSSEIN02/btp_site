{{-- Logo --}}
<div style="display:flex; align-items:center; gap:12px; margin-bottom:40px; flex-shrink:0;">
    <div style="width:48px; height:48px; background:#1e3a6e; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
        <svg width="28" height="16" viewBox="0 0 32 18" fill="none">
            <rect x="1" y="4" width="12" height="10" rx="5" stroke="white" stroke-width="2"/>
            <rect x="19" y="4" width="12" height="10" rx="5" stroke="white" stroke-width="2"/>
            <line x1="13" y1="9" x2="19" y2="9" stroke="white" stroke-width="2"/>
        </svg>
    </div>
    <div>
        <div style="font-size:18px; font-weight:700;">
            <span style="font-weight:300; color:#374151;">Vision</span>
            <span style="color:#1e3a6e;"> Optique</span>
        </div>
        <div style="font-size:11px; color:#9ca3af;">Panel Admin</div>
    </div>
</div>

{{-- Navigation --}}
<nav style="flex:1; display:flex; flex-direction:column; gap:4px;">
    <a href="{{ route('admin.dashboard') }}"
       class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-chart-line" style="width:18px;"></i>
        <span>Tableau de bord</span>
    </a>
    <a href="{{ route('admin.rendezvous') }}"
       class="sidebar-link {{ request()->routeIs('admin.rendezvous*') ? 'active' : '' }}">
        <i class="fas fa-calendar-check" style="width:18px;"></i>
        <span>Rendez-vous</span>
    </a>
    <a href="{{ route('admin.messages') }}"
       class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
        <i class="fas fa-envelope" style="width:18px;"></i>
        <span>Messages</span>
    </a>
    <a href="{{ route('admin.glasses') }}"
       class="sidebar-link {{ request()->routeIs('admin.glasses*') ? 'active' : '' }}">
        <i class="fas fa-glasses" style="width:18px;"></i>
        <span>Collections</span>
    </a>
    <a href="#" class="sidebar-link">
        <i class="fas fa-cog" style="width:18px;"></i>
        <span>Paramètres</span>
    </a>
</nav>

{{-- Pied de sidebar --}}
<div style="padding-top:16px; margin-top:16px; border-top:1px solid #e5e7eb; flex-shrink:0;">
    <div style="padding:4px 16px 12px;">
        <div style="font-size:13px; font-weight:600; color:#111827;">{{ Auth::user()->nom ?? 'Utilisateur' }}</div>
        <div style="font-size:11px; color:#9ca3af;">{{ Auth::user()->email ?? 'user@visionoptique.fr' }}</div>
    </div>
    <button id="open-modal"
            style="width:100%; text-align:left; color:#dc2626; background:none; border:none;
                   display:flex; align-items:center; gap:10px; padding:8px 16px;
                   border-radius:8px; cursor:pointer; font-size:13px; transition:background 0.15s;"
            onmouseover="this.style.background='#fef2f2'"
            onmouseout="this.style.background='none'">
        <i class="fas fa-sign-out-alt"></i>
        <span>Déconnexion</span>
    </button>
</div>