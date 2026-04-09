<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Prise de rendez-vous – Vision Optique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Nunito', sans-serif; background: #f0f5fb; }
    h1, h2, h3, .brand { font-family: 'Nunito', serif; }

    /* Navbar */
    .btn-primary { background-color: #1e3a6e; transition: background-color 0.2s, transform 0.2s; }
    .btn-primary:hover { background-color: #163060; transform: scale(1.02); }
    #mobile-menu { display: none; }
    #mobile-menu.open { display: block; }
    #burger span { transition: transform 0.25s ease, opacity 0.25s ease; display: block; }
    #burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    #burger.open span:nth-child(2) { opacity: 0; }
    #burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* Stepper */
    .step-circle {
      width: 32px; height: 32px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.8rem; font-weight: 700;
      transition: background 0.3s, color 0.3s, border-color 0.3s;
      border: 2px solid #c8d9ee;
      color: #a0b4cc;
      flex-shrink: 0;
    }
    .step-circle.done   { background: #1e3a6e; border-color: #1e3a6e; color: white; }
    .step-circle.active { background: #4a90d9; border-color: #4a90d9; color: white; }
    .step-line { flex: 1; height: 2px; background: #c8d9ee; transition: background 0.3s; }
    .step-line.done { background: #1e3a6e; }

    /* Panels */
    .panel { display: none; }
    .panel.active { display: block; animation: fadeUp 0.35s ease; }
    @keyframes fadeUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:none; } }

    /* Soin cards */
    .soin-card {
      border: 2px solid #e2eaf4;
      border-radius: 14px;
      padding: 18px 14px;
      cursor: pointer;
      text-align: center;
      transition: border-color 0.2s, background 0.2s, transform 0.2s;
    }
    .soin-card:hover { border-color: #4a90d9; transform: translateY(-2px); }
    .soin-card.selected { border-color: #1e3a6e; background: #f0f5fb; }
    .soin-card.selected .soin-dot { background: #1e3a6e; }
    .soin-dot {
      width: 8px; height: 8px; border-radius: 50%;
      background: #c8d9ee; margin: 8px auto 0;
      transition: background 0.2s;
    }

    /* Calendrier */
    .cal-day {
      aspect-ratio: 1;
      display: flex; align-items: center; justify-content: center;
      border-radius: 8px;
      font-size: 0.82rem;
      cursor: pointer;
      transition: background 0.15s, color 0.15s;
      font-weight: 500;
    }
    .cal-day:hover:not(.disabled):not(.empty) { background: #dce8f5; color: #1e3a6e; }
    .cal-day.selected { background: #1e3a6e !important; color: white !important; border-radius: 8px; }
    .cal-day.today { color: #4a90d9; font-weight: 700; }
    .cal-day.disabled { color: #d1d9e4; cursor: not-allowed; }
    .cal-day.empty { cursor: default; }

    /* Créneaux */
    .creneau {
      border: 2px solid #e2eaf4;
      border-radius: 8px;
      padding: 9px 12px;
      font-size: 0.8rem;
      cursor: pointer;
      text-align: center;
      font-weight: 600;
      color: #5a7a9a;
      transition: all 0.15s;
    }
    .creneau:hover:not(.taken) { border-color: #4a90d9; color: #1e3a6e; }
    .creneau.selected { background: #1e3a6e; border-color: #1e3a6e; color: white; }
    .creneau.taken { background: #f5f7fa; color: #c8d9ee; cursor: not-allowed; text-decoration: line-through; }

    /* Champs */
    .field-group { position: relative; margin-bottom: 4px; }
    .field-label { font-size: 0.72rem; font-weight: 700; color: #8ba4c4; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; display: block; }
    .field-input {
      width: 100%; border: 2px solid #e2eaf4; border-radius: 10px;
      padding: 10px 14px; font-size: 0.88rem; color: #1e3a6e;
      outline: none; transition: border-color 0.2s;
      font-family: 'Lato', sans-serif; background: white;
    }
    .field-input:focus { border-color: #4a90d9; }
    .field-input.error { border-color: #ef4444; }
    select.field-input { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none' stroke='%231e3a6e' stroke-width='2'%3E%3Cpath d='M1 1l5 5 5-5'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px; }

    /* Résumé */
    .recap-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #eaf0f9; font-size: 0.85rem; }
    .recap-row:last-child { border-bottom: none; }
    .recap-label { color: #8ba4c4; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.04em; }

    /* Succès */
    #success-screen { display: none; }
    #success-screen.show { display: block; animation: fadeUp 0.5s ease; }
    .check-circle {
      width: 72px; height: 72px; border-radius: 50%;
      background: #dcfce7; display: flex; align-items: center; justify-content: center;
      margin: 0 auto 20px;
      animation: popIn 0.4s ease;
    }
    @keyframes popIn { from { transform:scale(0.4); opacity:0; } to { transform:scale(1); opacity:1; } }

    /* Nav active */
    .nav-active { border-bottom: 2px solid #1e3a6e; padding-bottom: 2px; }
    
    /* Loading spinner */
    .loading-spinner {
      display: inline-block;
      width: 16px;
      height: 16px;
      border: 2px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spin 0.6s linear infinite;
      margin-right: 8px;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body class="bg-[#f0f5fb] text-gray-800">

  <!-- NAVBAR -->
  <header class="sticky top-0 z-50 bg-white shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 flex items-center justify-between h-14 sm:h-16">
      <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
        <svg width="28" height="16" viewBox="0 0 32 18" fill="none">
          <rect x="1" y="4" width="12" height="10" rx="5" stroke="#1e3a6e" stroke-width="2"/>
          <rect x="19" y="4" width="12" height="10" rx="5" stroke="#1e3a6e" stroke-width="2"/>
          <line x1="13" y1="9" x2="19" y2="9" stroke="#1e3a6e" stroke-width="2"/>
        </svg>
        <span class="brand text-lg sm:text-xl font-bold">
          <span class="font-light text-gray-700">Vision</span>
          <span class="text-[#1e3a6e]"> Optique</span>
        </span>
      </a>
      <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-sm font-medium text-gray-700">
        <a href="{{ route('home')}}" class="hover:text-[#1e3a6e] transition-colors">Accueil</a>
        <a href="{{ route('lunettes.index')}}" class="hover:text-[#1e3a6e] transition-colors">Nos Lunettes</a>
        <a href="{{ route('initiatives.index') }}" class="hover:text-[#1e3a6e] transition-colors">Nos Initiatives</a>
        <a href="{{ route('apropos.index') }}" class="hover:text-[#1e3a6e] transition-colors">À Propos</a>
      </nav>
      <div class="flex items-center gap-2 sm:gap-3">
        <a href="{{ route('rdv.index')}}" class="btn-primary text-white text-xs sm:text-sm font-semibold px-3 sm:px-5 py-2 rounded nav-active">
          <span class="hidden sm:inline">Prise de rendez-vous</span>
          <span class="sm:hidden">RDV</span>
        </a>
        <button id="burger" class="lg:hidden flex flex-col justify-center gap-[5px] w-9 h-9 p-1.5">
          <span class="h-0.5 w-full bg-[#1e3a6e] rounded"></span>
          <span class="h-0.5 w-full bg-[#1e3a6e] rounded"></span>
          <span class="h-0.5 w-full bg-[#1e3a6e] rounded"></span>
        </button>
      </div>
    </div>
    <div id="mobile-menu" class="lg:hidden bg-white border-t border-gray-100 shadow-md">
      <nav class="flex flex-col px-4 py-4 gap-4 text-sm font-medium text-gray-700">
        <a href="{{ route('home')}}" onclick="closeMobileMenu()">Accueil</a>
        <a href="{{ route('lunettes.index')}}" onclick="closeMobileMenu()">Nos Lunettes</a>
        <a href="{{ route('initiatives.index') }}" onclick="closeMobileMenu()">Nos Initiatives</a>
        <a href="{{ route('apropos.index') }}" onclick="closeMobileMenu()">À Propos</a>
      </nav>
    </div>
  </header>

  <!-- PAGE -->
  <main class="max-w-2xl mx-auto px-4 py-10 sm:py-14">

    <!-- Titre -->
    <div class="text-center mb-8">
      <p class="text-[#4a90d9] text-xs font-semibold uppercase tracking-widest mb-2">Vision Optique</p>
      <h1 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e] mb-1">Prendre rendez-vous</h1>
      <p class="text-gray-400 text-sm">Réservez en quelques clics, nous confirmons sous 24h.</p>
    </div>

    <!-- Message d'erreur -->
    <div id="error-message" class="hidden bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6"></div>

    <!-- Stepper -->
    <div class="flex items-center gap-0 mb-8 px-2">
      <div class="flex flex-col items-center gap-1">
        <div class="step-circle active" id="sc1">1</div>
        <span class="text-xs text-gray-400 hidden sm:block">Soin</span>
      </div>
      <div class="step-line" id="sl1"></div>
      <div class="flex flex-col items-center gap-1">
        <div class="step-circle" id="sc2">2</div>
        <span class="text-xs text-gray-400 hidden sm:block">Date</span>
      </div>
      <div class="step-line" id="sl2"></div>
      <div class="flex flex-col items-center gap-1">
        <div class="step-circle" id="sc3">3</div>
        <span class="text-xs text-gray-400 hidden sm:block">Vos infos</span>
      </div>
      <div class="step-line" id="sl3"></div>
      <div class="flex flex-col items-center gap-1">
        <div class="step-circle" id="sc4">4</div>
        <span class="text-xs text-gray-400 hidden sm:block">Confirmation</span>
      </div>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8" id="main-card">

      <!-- ÉTAPE 1 : Soin -->
      <div class="panel active" id="panel-1">
        <h2 class="text-lg font-bold text-[#1e3a6e] mb-1">Quel type de consultation ?</h2>
        <p class="text-xs text-gray-400 mb-6">Sélectionnez une option pour continuer.</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="soin-grid">
          <div class="soin-card" data-soin="Examen de vue" onclick="selectSoin(this)">
            <svg class="mx-auto" width="32" height="32" viewBox="0 0 36 36" fill="none" stroke="#1e3a6e" stroke-width="1.6" stroke-linecap="round">
              <circle cx="18" cy="15" r="8"/>
              <line x1="18" y1="7" x2="18" y2="5"/>
              <line x1="18" y1="23" x2="18" y2="25"/>
              <line x1="10" y1="15" x2="8" y2="15"/>
              <line x1="26" y1="15" x2="28" y2="15"/>
              <line x1="18" y1="23" x2="15" y2="30"/>
              <line x1="18" y1="23" x2="21" y2="30"/>
            </svg>
            <p class="text-xs font-semibold text-[#1e3a6e] mt-2">Examen de vue</p>
            <p class="text-[10px] text-gray-400 mt-0.5">~30 min</p>
            <div class="soin-dot"></div>
          </div>
          <div class="soin-card" data-soin="Adaptation lentilles" onclick="selectSoin(this)">
            <svg class="mx-auto" width="32" height="32" viewBox="0 0 36 36" fill="none" stroke="#1e3a6e" stroke-width="1.6" stroke-linecap="round">
              <ellipse cx="18" cy="18" rx="14" ry="10"/>
              <ellipse cx="18" cy="18" rx="6" ry="5"/>
            </svg>
            <p class="text-xs font-semibold text-[#1e3a6e] mt-2">Lentilles</p>
            <p class="text-[10px] text-gray-400 mt-0.5">~45 min</p>
            <div class="soin-dot"></div>
          </div>
          <div class="soin-card" data-soin="Conseil montures" onclick="selectSoin(this)">
            <svg class="mx-auto" width="36" height="22" viewBox="0 0 40 22" fill="none" stroke="#1e3a6e" stroke-width="1.6" stroke-linecap="round">
              <rect x="1" y="4" width="15" height="14" rx="7"/>
              <rect x="24" y="4" width="15" height="14" rx="7"/>
              <line x1="16" y1="11" x2="24" y2="11"/>
            </svg>
            <p class="text-xs font-semibold text-[#1e3a6e] mt-2">Conseil montures</p>
            <p class="text-[10px] text-gray-400 mt-0.5">~20 min</p>
            <div class="soin-dot"></div>
          </div>
          <div class="soin-card" data-soin="Réparation / ajustement" onclick="selectSoin(this)">
            <svg class="mx-auto" width="32" height="32" viewBox="0 0 36 36" fill="none" stroke="#1e3a6e" stroke-width="1.6" stroke-linecap="round">
              <path d="M28 8l-4 4-3-3 4-4a6 6 0 0 0-8 8l-9 9a2 2 0 0 0 3 3l9-9a6 6 0 0 0 8-8z"/>
            </svg>
            <p class="text-xs font-semibold text-[#1e3a6e] mt-2">Réparation</p>
            <p class="text-[10px] text-gray-400 mt-0.5">~15 min</p>
            <div class="soin-dot"></div>
          </div>
          <div class="soin-card" data-soin="Bilan enfant" onclick="selectSoin(this)">
            <svg class="mx-auto" width="32" height="32" viewBox="0 0 36 36" fill="none" stroke="#1e3a6e" stroke-width="1.6" stroke-linecap="round">
              <circle cx="18" cy="10" r="5"/>
              <path d="M8 30c0-5.5 4.5-10 10-10s10 4.5 10 10"/>
            </svg>
            <p class="text-xs font-semibold text-[#1e3a6e] mt-2">Bilan enfant</p>
            <p class="text-[10px] text-gray-400 mt-0.5">~30 min</p>
            <div class="soin-dot"></div>
          </div>
          <div class="soin-card" data-soin="Autre demande" onclick="selectSoin(this)">
            <svg class="mx-auto" width="32" height="32" viewBox="0 0 36 36" fill="none" stroke="#1e3a6e" stroke-width="1.6" stroke-linecap="round">
              <circle cx="18" cy="18" r="14"/>
              <text x="18" y="24" text-anchor="middle" font-size="16" fill="#1e3a6e" font-family="serif" font-weight="bold" stroke="none">?</text>
            </svg>
            <p class="text-xs font-semibold text-[#1e3a6e] mt-2">Autre</p>
            <p class="text-[10px] text-gray-400 mt-0.5">À préciser</p>
            <div class="soin-dot"></div>
          </div>
        </div>
        <p class="text-xs text-red-400 mt-3 hidden" id="err-soin">Veuillez sélectionner un type de consultation.</p>
      </div>

      <!-- ÉTAPE 2 : Date & créneau -->
      <div class="panel" id="panel-2">
        <h2 class="text-lg font-bold text-[#1e3a6e] mb-1">Choisissez une date</h2>
        <p class="text-xs text-gray-400 mb-6">Sélectionnez un jour puis un créneau disponible.</p>

        <div class="mb-6">
          <div class="flex items-center justify-between mb-3">
            <button type="button" onclick="prevMonth()" class="w-8 h-8 rounded-full hover:bg-[#dce8f5] flex items-center justify-center text-[#1e3a6e] transition-colors">
              <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="#1e3a6e" stroke-width="2"><path d="M10 3L5 8l5 5"/></svg>
            </button>
            <p class="text-sm font-bold text-[#1e3a6e]" id="cal-month-label"></p>
            <button type="button" onclick="nextMonth()" class="w-8 h-8 rounded-full hover:bg-[#dce8f5] flex items-center justify-center text-[#1e3a6e] transition-colors">
              <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="#1e3a6e" stroke-width="2"><path d="M6 3l5 5-5 5"/></svg>
            </button>
          </div>
          <div class="grid grid-cols-7 gap-1 mb-1">
            <div class="text-center text-[10px] font-bold text-gray-400 py-1">L</div>
            <div class="text-center text-[10px] font-bold text-gray-400 py-1">M</div>
            <div class="text-center text-[10px] font-bold text-gray-400 py-1">M</div>
            <div class="text-center text-[10px] font-bold text-gray-400 py-1">J</div>
            <div class="text-center text-[10px] font-bold text-gray-400 py-1">V</div>
            <div class="text-center text-[10px] font-bold text-[#4a90d9] py-1">S</div>
            <div class="text-center text-[10px] font-bold text-red-300 py-1">D</div>
          </div>
          <div class="grid grid-cols-7 gap-1" id="cal-grid"></div>
        </div>

        <div id="creneau-section" class="hidden">
          <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Créneaux disponibles – <span id="creneau-date-label"></span></p>
          <div class="mb-2">
            <p class="text-[10px] text-gray-400 mb-2 uppercase tracking-wide">Matin</p>
            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2" id="creneaux-matin"></div>
          </div>
          <div class="mt-4">
            <p class="text-[10px] text-gray-400 mb-2 uppercase tracking-wide">Après-midi</p>
            <div class="grid grid-cols-4 sm:grid-cols-5 gap-2" id="creneaux-apm"></div>
          </div>
          <p class="text-xs text-red-400 mt-3 hidden" id="err-creneau">Veuillez choisir un créneau.</p>
        </div>
        <p class="text-xs text-red-400 mt-3 hidden" id="err-date">Veuillez sélectionner une date.</p>
      </div>

      <!-- ÉTAPE 3 : Infos patient -->
      <div class="panel" id="panel-3">
        <h2 class="text-lg font-bold text-[#1e3a6e] mb-1">Vos coordonnées</h2>
        <p class="text-xs text-gray-400 mb-6">Ces informations nous permettent de confirmer votre rendez-vous.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
          <div class="field-group">
            <label class="field-label" for="f-prenom">Prénom *</label>
            <input id="f-prenom" type="text" class="field-input" placeholder="Jean" autocomplete="given-name"/>
          </div>
          <div class="field-group">
            <label class="field-label" for="f-nom">Nom *</label>
            <input id="f-nom" type="text" class="field-input" placeholder="Dupont" autocomplete="family-name"/>
          </div>
          <div class="field-group">
            <label class="field-label" for="f-email">Email *</label>
            <input id="f-email" type="email" class="field-input" placeholder="jean@email.com" autocomplete="email"/>
          </div>
          <div class="field-group">
            <label class="field-label" for="f-tel">Téléphone *</label>
            <input id="f-tel" type="tel" class="field-input" placeholder="06 12 34 56 78" autocomplete="tel"/>
          </div>
        </div>

        <div class="field-group mb-4">
          <label class="field-label" for="f-patient">Vous êtes *</label>
          <select id="f-patient" class="field-input">
            <option value="">Sélectionnez…</option>
            <option value="nouveau">Nouveau patient</option>
            <option value="existant">Patient existant</option>
          </select>
        </div>

        <div class="field-group mb-2">
          <label class="field-label" for="f-note">Note (optionnel)</label>
          <textarea id="f-note" rows="3" class="field-input" placeholder="Précisions sur votre demande, numéro de mutuelle…" style="resize:none;"></textarea>
        </div>

        <p class="text-xs text-red-400 mt-2 hidden" id="err-infos">Veuillez remplir tous les champs obligatoires.</p>
      </div>

      <!-- ÉTAPE 4 : Récapitulatif -->
      <div class="panel" id="panel-4">
        <h2 class="text-lg font-bold text-[#1e3a6e] mb-1">Récapitulatif</h2>
        <p class="text-xs text-gray-400 mb-6">Vérifiez vos informations avant de confirmer.</p>

        <div class="bg-[#f0f5fb] rounded-xl p-5 mb-6">
          <div class="recap-row"><span class="recap-label">Consultation</span><span class="font-semibold text-[#1e3a6e]" id="recap-soin">—</span></div>
          <div class="recap-row"><span class="recap-label">Date</span><span class="font-semibold text-[#1e3a6e]" id="recap-date">—</span></div>
          <div class="recap-row"><span class="recap-label">Créneau</span><span class="font-semibold text-[#1e3a6e]" id="recap-creneau">—</span></div>
          <div class="recap-row"><span class="recap-label">Patient</span><span class="font-semibold text-[#1e3a6e]" id="recap-nom">—</span></div>
          <div class="recap-row"><span class="recap-label">Email</span><span class="font-semibold text-[#1e3a6e]" id="recap-email">—</span></div>
          <div class="recap-row"><span class="recap-label">Téléphone</span><span class="font-semibold text-[#1e3a6e]" id="recap-tel">—</span></div>
        </div>

        <label class="flex items-start gap-3 cursor-pointer mb-2">
          <div class="relative mt-0.5">
            <input type="checkbox" id="rgpd" class="sr-only peer"/>
            <div class="w-4 h-4 border-2 border-[#c8d9ee] rounded peer-checked:bg-[#1e3a6e] peer-checked:border-[#1e3a6e] transition-all"></div>
            <svg class="absolute top-0.5 left-0.5 w-3 h-3 opacity-0 peer-checked:opacity-100 pointer-events-none" viewBox="0 0 12 12" fill="none" stroke="white" stroke-width="2"><polyline points="2,6 5,9 10,3"/></svg>
          </div>
          <span class="text-xs text-gray-400 leading-relaxed">J'accepte que mes données soient utilisées pour la gestion de mon rendez-vous.</span>
        </label>
        <p class="text-xs text-red-400 hidden" id="err-rgpd">Veuillez accepter les conditions.</p>
      </div>

      <!-- Navigation -->
      <div class="flex justify-between items-center mt-8 pt-5 border-t border-gray-100">
        <button type="button" id="btn-prev" onclick="prevStep()" class="text-sm text-[#8ba4c4] hover:text-[#1e3a6e] font-semibold transition-colors hidden">
          ← Retour
        </button>
        <div class="flex-1"></div>
        <button type="button" id="btn-next" onclick="nextStep()" class="btn-primary text-white text-sm font-semibold px-7 py-2.5 rounded-lg">
          Continuer →
        </button>
      </div>
    </div>

    <!-- SUCCESS -->
    <div id="success-screen">
      <div class="bg-white rounded-2xl shadow-sm p-8 sm:p-12 text-center">
        <div class="check-circle">
          <svg width="34" height="34" viewBox="0 0 48 48" fill="none" stroke="#16a34a" stroke-width="3.5" stroke-linecap="round"><polyline points="10,24 20,34 38,16"/></svg>
        </div>
        <h2 class="text-2xl font-bold text-[#1e3a6e] mb-2">Rendez-vous confirmé !</h2>
        <p class="text-gray-400 text-sm mb-1">Un email de confirmation a été envoyé à</p>
        <p class="font-semibold text-[#1e3a6e] text-sm mb-6" id="success-email">—</p>

        <div class="bg-[#f0f5fb] rounded-xl p-5 text-left mb-8 max-w-xs mx-auto">
          <div class="recap-row"><span class="recap-label">Consultation</span><span class="font-semibold text-[#1e3a6e] text-sm" id="s-soin">—</span></div>
          <div class="recap-row"><span class="recap-label">Date & heure</span><span class="font-semibold text-[#1e3a6e] text-sm" id="s-date">—</span></div>
          <div class="recap-row"><span class="recap-label">Adresse</span><span class="font-semibold text-[#1e3a6e] text-sm">123 Rue de l'Optique, 75006</span></div>
        </div>

        <p class="text-xs text-gray-400 mb-6">Nous vous contacterons pour confirmer votre créneau dans les 24h.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
          <a href="{{ route('home')}}" class="btn-primary inline-block text-white px-6 py-2.5 rounded-lg text-sm font-semibold">Retour à l'accueil</a>
          <button type="button" onclick="resetForm()" class="border-2 border-[#e2eaf4] text-[#1e3a6e] px-6 py-2.5 rounded-lg text-sm font-semibold hover:border-[#4a90d9] transition-colors">Nouveau rendez-vous</button>
        </div>
      </div>
    </div>

  </main>

  <!-- FOOTER -->
  <footer class="bg-[#1e3a6e] text-blue-200 text-xs py-4 mt-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 flex items-center justify-center gap-6 text-center">
      <a href="#" class="hover:text-white transition-colors">Mentions Légales</a>
      <span>|</span>
      <a href="#" class="hover:text-white transition-colors">Politique de Confidentialité</a>
    </div>
  </footer>

  <script>
    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    // ---- State ----
    let currentStep = 1;
    let selectedSoin = '';
    let selectedDate = null;
    let selectedCreneau = '';
    let calYear, calMonth;

    const today = new Date();
    calYear = today.getFullYear();
    calMonth = today.getMonth();

    // ---- Burger ----
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobile-menu');
    burger.addEventListener('click', () => { burger.classList.toggle('open'); mobileMenu.classList.toggle('open'); });
    function closeMobileMenu() { burger.classList.remove('open'); mobileMenu.classList.remove('open'); }

    // ---- Soin ----
    function selectSoin(el) {
      document.querySelectorAll('.soin-card').forEach(c => c.classList.remove('selected'));
      el.classList.add('selected');
      selectedSoin = el.dataset.soin;
      document.getElementById('err-soin').classList.add('hidden');
    }

    // ---- Calendrier ----
    const MONTHS_FR = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    const DAYS_FR = ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];

    function renderCalendar() {
      const label = document.getElementById('cal-month-label');
      label.textContent = MONTHS_FR[calMonth] + ' ' + calYear;
      const grid = document.getElementById('cal-grid');
      grid.innerHTML = '';

      const firstDay = new Date(calYear, calMonth, 1);
      let startDow = (firstDay.getDay() + 6) % 7;
      const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();

      for (let i = 0; i < startDow; i++) {
        const empty = document.createElement('div');
        empty.className = 'cal-day empty';
        grid.appendChild(empty);
      }

      for (let d = 1; d <= daysInMonth; d++) {
        const date = new Date(calYear, calMonth, d);
        const dow = date.getDay();
        const isPast = date < new Date(today.getFullYear(), today.getMonth(), today.getDate());
        const isSunday = dow === 0;

        const el = document.createElement('div');
        el.className = 'cal-day';
        el.textContent = d;

        if (isPast || isSunday) {
          el.classList.add('disabled');
        } else {
          const isToday = date.toDateString() === today.toDateString();
          if (isToday) el.classList.add('today');
          if (selectedDate && date.toDateString() === selectedDate.toDateString()) el.classList.add('selected');
          el.addEventListener('click', () => selectDay(date, el));
        }
        grid.appendChild(el);
      }
    }

    function prevMonth() {
      calMonth--;
      if (calMonth < 0) { calMonth = 11; calYear--; }
      renderCalendar();
    }
    function nextMonth() {
      calMonth++;
      if (calMonth > 11) { calMonth = 0; calYear++; }
      renderCalendar();
    }

    function selectDay(date, el) {
      selectedDate = date;
      selectedCreneau = '';
      document.querySelectorAll('.cal-day').forEach(d => d.classList.remove('selected'));
      el.classList.add('selected');
      document.getElementById('err-date').classList.add('hidden');
      renderCreneaux(date);
    }

    // ---- Créneaux ----
    function renderCreneaux(date) {
      const section = document.getElementById('creneau-section');
      section.classList.remove('hidden');

      const dayName = ['dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi'][date.getDay()];
      const dateStr = `${dayName} ${date.getDate()} ${MONTHS_FR[date.getMonth()]}`;
      document.getElementById('creneau-date-label').textContent = dateStr;

      const matin  = ['09:00','09:30','10:00','10:30','11:00','11:30'];
      const apm    = ['14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30'];
      const isSat = date.getDay() === 6;
      const satApm = ['14:00','14:30','15:00','15:30','16:00','16:30'];

      buildCreneaux('creneaux-matin', matin);
      buildCreneaux('creneaux-apm', isSat ? satApm : apm);
    }

    function buildCreneaux(containerId, slots) {
      const container = document.getElementById(containerId);
      container.innerHTML = '';
      slots.forEach(slot => {
        const el = document.createElement('div');
        el.className = 'creneau';
        el.textContent = slot;
        el.addEventListener('click', () => {
          document.querySelectorAll('.creneau').forEach(c => c.classList.remove('selected'));
          el.classList.add('selected');
          selectedCreneau = slot;
          document.getElementById('err-creneau').classList.add('hidden');
        });
        container.appendChild(el);
      });
    }

    // ---- Stepper ----
    function updateStepper() {
      for (let i = 1; i <= 4; i++) {
        const sc = document.getElementById('sc' + i);
        sc.classList.remove('active','done');
        if (i < currentStep) sc.classList.add('done');
        else if (i === currentStep) sc.classList.add('active');
      }
      for (let i = 1; i <= 3; i++) {
        const sl = document.getElementById('sl' + i);
        sl.classList.toggle('done', i < currentStep);
      }
      document.getElementById('btn-prev').classList.toggle('hidden', currentStep === 1);
      const btn = document.getElementById('btn-next');
      btn.textContent = currentStep === 4 ? 'Confirmer le rendez-vous ✓' : 'Continuer →';
    }

    function showPanel(n) {
      document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
      document.getElementById('panel-' + n).classList.add('active');
    }

    function nextStep() {
      if (currentStep === 1) {
        if (!selectedSoin) { document.getElementById('err-soin').classList.remove('hidden'); return; }
      }
      if (currentStep === 2) {
        if (!selectedDate) { document.getElementById('err-date').classList.remove('hidden'); return; }
        if (!selectedCreneau) { document.getElementById('err-creneau').classList.remove('hidden'); return; }
      }
      if (currentStep === 3) {
        const prenom = document.getElementById('f-prenom').value.trim();
        const nom    = document.getElementById('f-nom').value.trim();
        const email  = document.getElementById('f-email').value.trim();
        const tel    = document.getElementById('f-tel').value.trim();
        const pat    = document.getElementById('f-patient').value;
        if (!prenom || !nom || !email || !tel || !pat) {
          document.getElementById('err-infos').classList.remove('hidden');
          ['f-prenom','f-nom','f-email','f-tel','f-patient'].forEach(id => {
            const el = document.getElementById(id);
            el.classList.toggle('error', !el.value.trim());
          });
          return;
        }
        const dayName = DAYS_FR[(selectedDate.getDay() + 6) % 7];
        const dateStr = `${dayName.charAt(0).toUpperCase()+dayName.slice(1)} ${selectedDate.getDate()} ${MONTHS_FR[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;
        document.getElementById('recap-soin').textContent = selectedSoin;
        document.getElementById('recap-date').textContent = dateStr;
        document.getElementById('recap-creneau').textContent = selectedCreneau;
        document.getElementById('recap-nom').textContent = prenom + ' ' + nom;
        document.getElementById('recap-email').textContent = email;
        document.getElementById('recap-tel').textContent = tel;
      }
      if (currentStep === 4) {
        if (!document.getElementById('rgpd').checked) {
          document.getElementById('err-rgpd').classList.remove('hidden'); 
          return;
        }
        submitForm(); 
        return;
      }
      currentStep++;
      showPanel(currentStep);
      updateStepper();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function prevStep() {
      if (currentStep <= 1) return;
      currentStep--;
      showPanel(currentStep);
      updateStepper();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    async function submitForm() {
      const btn = document.getElementById('btn-next');
      const originalText = btn.innerHTML;
      btn.innerHTML = '<span class="loading-spinner"></span> Envoi en cours...';
      btn.disabled = true;

      const formData = {
        first_name: document.getElementById('f-prenom').value.trim(),
        last_name: document.getElementById('f-nom').value.trim(),
        email: document.getElementById('f-email').value.trim(),
        phone: document.getElementById('f-tel').value.trim(),
        service: selectedSoin,
        appointment_date: selectedDate.toISOString().split('T')[0],
        appointment_time: selectedCreneau,
        patient_type: document.getElementById('f-patient').value,
        message: document.getElementById('f-note').value.trim(),
        _token: csrfToken
      };

      try {
        const response = await fetch('{{ route("appointment.store") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (response.ok && data.success) {
          // Afficher l'écran de succès
          document.getElementById('main-card').style.display = 'none';
          document.getElementById('btn-prev').classList.add('hidden');
          document.getElementById('btn-next').parentElement.parentElement.style.display = 'none';

          const email = formData.email;
          const dayName = DAYS_FR[(selectedDate.getDay() + 6) % 7];
          const dateStr = `${dayName.charAt(0).toUpperCase()+dayName.slice(1)} ${selectedDate.getDate()} ${MONTHS_FR[selectedDate.getMonth()]} ${selectedDate.getFullYear()} à ${selectedCreneau}`;

          document.getElementById('success-email').textContent = email;
          document.getElementById('s-soin').textContent = selectedSoin;
          document.getElementById('s-date').textContent = dateStr;

          const screen = document.getElementById('success-screen');
          screen.classList.add('show');
          window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
          const errorDiv = document.getElementById('error-message');
          errorDiv.textContent = data.message || 'Une erreur est survenue. Veuillez réessayer.';
          errorDiv.classList.remove('hidden');
          btn.innerHTML = originalText;
          btn.disabled = false;
          setTimeout(() => errorDiv.classList.add('hidden'), 5000);
        }
      } catch (error) {
        console.error('Erreur:', error);
        const errorDiv = document.getElementById('error-message');
        errorDiv.textContent = 'Erreur de connexion. Veuillez réessayer.';
        errorDiv.classList.remove('hidden');
        btn.innerHTML = originalText;
        btn.disabled = false;
        setTimeout(() => errorDiv.classList.add('hidden'), 5000);
      }
    }

    function resetForm() {
      currentStep = 1;
      selectedSoin = ''; selectedDate = null; selectedCreneau = '';
      calYear = today.getFullYear(); calMonth = today.getMonth();
      document.getElementById('success-screen').classList.remove('show');
      document.getElementById('error-message').classList.add('hidden');
      document.getElementById('main-card').style.display = '';
      document.getElementById('btn-next').parentElement.parentElement.style.display = '';
      document.getElementById('btn-next').innerHTML = 'Continuer →';
      document.getElementById('btn-next').disabled = false;
      document.getElementById('rgpd').checked = false;
      document.querySelectorAll('.soin-card').forEach(c => c.classList.remove('selected'));
      document.getElementById('creneau-section').classList.add('hidden');
      document.getElementById('f-prenom').value = '';
      document.getElementById('f-nom').value = '';
      document.getElementById('f-email').value = '';
      document.getElementById('f-tel').value = '';
      document.getElementById('f-note').value = '';
      document.getElementById('f-patient').value = '';
      showPanel(1);
      updateStepper();
      renderCalendar();
    }

    // ---- Init ----
    renderCalendar();
    updateStepper();
  </script>
</body>
</html>