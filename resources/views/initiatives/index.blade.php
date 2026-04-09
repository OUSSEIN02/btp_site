<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nos Initiatives – Vision Optique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --navy:       #1e3a6e;
      --navy-dark:  #163060;
      --blue-mid:   #2c4a7c;
      --blue-light: #4a90d9;
      --teal:       #0d9488;
      --teal-light: #14b8a6;
      --amber:      #d97706;
      --rose:       #e11d48;
      --bg-soft:    #f0f5fb;
      --bg-page:    #f7f9fc;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Nunito', sans-serif; background: var(--bg-page); color: #1f2937; }
    h1,h2,h3,h4,.brand { font-family: 'Nunito', serif; }

    /* ── Nav ── */
    .nav-active { border-bottom: 2px solid var(--navy); padding-bottom: 2px; }
    .btn-primary { background: var(--navy); transition: background .2s, transform .2s; }
    .btn-primary:hover { background: var(--navy-dark); transform: scale(1.03); }

    /* ── Burger ── */
    #mobile-menu { display:none; }
    #mobile-menu.open { display:block; }
    #burger span { transition: transform .25s, opacity .25s; display:block; }
    #burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    #burger.open span:nth-child(2) { opacity:0; }
    #burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* ── Hero ── */
    .hero-initiatives {
      background: linear-gradient(135deg, #0f2440 0%, var(--navy) 40%, #1a5276 80%, var(--teal) 100%);
      position: relative; overflow: hidden;
      min-height: clamp(360px, 50vw, 520px);
    }
    .hero-initiatives::before {
      content: '';
      position: absolute; inset: 0;
      background:
        radial-gradient(ellipse at 20% 50%, rgba(13,148,136,0.18) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(74,144,217,0.15) 0%, transparent 50%);
    }
    /* Animated circles */
    .hero-circle {
      position: absolute; border-radius: 50%;
      border: 1px solid rgba(255,255,255,0.08);
      animation: pulse-ring 6s ease-in-out infinite;
    }
    .hero-circle:nth-child(1) { width:300px;height:300px; right:-80px; top:-80px; animation-delay:0s; }
    .hero-circle:nth-child(2) { width:200px;height:200px; right:30px; top:30px; animation-delay:1.5s; }
    .hero-circle:nth-child(3) { width:500px;height:500px; left:-200px; bottom:-200px; animation-delay:3s; }
    @keyframes pulse-ring {
      0%,100% { opacity:.4; transform:scale(1); }
      50%      { opacity:.8; transform:scale(1.05); }
    }

    /* ── Counter strip ── */
    .counter-strip {
      background: white;
      box-shadow: 0 4px 24px rgba(30,58,110,0.1);
    }
    .counter-item { text-align:center; }
    .counter-num {
      font-size: clamp(1.8rem, 4vw, 2.8rem);
      font-weight: 700; color: var(--navy);
      line-height: 1.1;
    }
    .counter-label { font-size:.8rem; color:#6b7280; margin-top:4px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; }
    .counter-accent { width:32px; height:3px; border-radius:2px; margin:8px auto 0; }

    /* ── Section headers ── */
    .section-eyebrow {
      font-size:.72rem; font-weight:700;
      text-transform:uppercase; letter-spacing:.1em;
      margin-bottom:8px;
    }

    /* ── Initiative cards ── */
    .init-card {
      background: white;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 2px 16px rgba(30,58,110,0.08);
      transition: transform .35s ease, box-shadow .35s ease;
      cursor: pointer;
    }
    .init-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 48px rgba(30,58,110,0.15);
    }
    .init-card .card-img {
      height: 200px; overflow: hidden;
      position: relative;
    }
    .init-card .card-img img {
      width:100%; height:100%; object-fit:cover;
      transition: transform .6s ease;
    }
    .init-card:hover .card-img img { transform: scale(1.07); }
    .init-card .card-img .overlay {
      position:absolute; inset:0;
      background: linear-gradient(to top, rgba(15,36,64,.6) 0%, transparent 60%);
    }
    .init-card .card-img .cat-pill {
      position:absolute; top:14px; left:14px;
      padding:4px 12px; border-radius:50px;
      font-size:.68rem; font-weight:700;
      text-transform:uppercase; letter-spacing:.06em;
      color:white; backdrop-filter:blur(8px);
      background: rgba(255,255,255,0.2);
      border: 1px solid rgba(255,255,255,0.3);
    }
    .init-card .card-body { padding:22px 22px 24px; }
    .init-card .card-icon {
      width:42px; height:42px; border-radius:12px;
      display:flex; align-items:center; justify-content:center;
      font-size:20px; margin-bottom:14px;
    }
    .init-card h3 { font-size:1.05rem; font-weight:700; color:#1f2937; margin-bottom:8px; line-height:1.35; }
    .init-card p { font-size:.85rem; color:#6b7280; line-height:1.65; margin-bottom:14px; }
    .init-card .card-meta {
      display:flex; gap:12px; flex-wrap:wrap;
      font-size:.72rem; font-weight:700;
      text-transform:uppercase; letter-spacing:.04em; color:#9ca3af;
    }
    .init-card .card-meta span { display:flex; align-items:center; gap:4px; }
    .init-card .card-progress { margin-top:16px; }
    .init-card .progress-bar { height:5px; background:#e5e7eb; border-radius:3px; overflow:hidden; margin-top:6px; }
    .init-card .progress-fill { height:100%; border-radius:3px; transition: width 1s ease; }
    .init-card .progress-label { font-size:.72rem; color:#6b7280; display:flex; justify-content:space-between; }

    /* ── Partner logos ── */
    .partner-logo {
      background: white;
      border-radius: 14px;
      padding: 20px 24px;
      display:flex; align-items:center; justify-content:center;
      box-shadow: 0 2px 12px rgba(30,58,110,0.07);
      transition: box-shadow .25s, transform .25s;
      min-height: 90px;
    }
    .partner-logo:hover {
      box-shadow: 0 8px 24px rgba(30,58,110,0.14);
      transform: translateY(-3px);
    }
    .partner-logo .logo-inner {
      font-weight:700; font-size:1rem;
      color: var(--navy); text-align:center; line-height:1.3;
    }
    .partner-logo .logo-type { font-size:.68rem; font-weight:400; color:#9ca3af; font-family:'Lato',sans-serif; }

    /* ── Timeline ── */
    .timeline-line {
      position:absolute; left:18px; top:0; bottom:0;
      width:2px; background: linear-gradient(to bottom, var(--teal), var(--blue-light), var(--navy));
    }
    @media(min-width:640px) { .timeline-line { left:50%; transform:translateX(-50%); } }
    .timeline-dot {
      width:38px; height:38px; border-radius:50%;
      display:flex; align-items:center; justify-content:center;
      font-size:16px; flex-shrink:0;
      box-shadow: 0 0 0 4px white, 0 0 0 6px currentColor;
      z-index:2; position:relative;
    }

    /* ── Testimonial ── */
    .testimonial-card {
      background: linear-gradient(135deg, var(--navy) 0%, var(--blue-mid) 100%);
      border-radius: 20px; padding:32px;
      color: white; position:relative; overflow:hidden;
    }
    .testimonial-card::before {
      content: '"';
      position:absolute; top:-10px; left:20px;
      font-size:120px; color:rgba(255,255,255,0.08);
      line-height:1; pointer-events:none;
    }

    /* ── CTA band ── */
    .cta-band {
      background: linear-gradient(135deg, var(--teal) 0%, #0d7a6e 100%);
      position: relative; overflow:hidden;
    }
    .cta-band::after {
      content:'';
      position:absolute; right:-40px; top:-40px;
      width:220px; height:220px; border-radius:50%;
      background: rgba(255,255,255,0.07);
    }

    /* ── Scroll animations ── */
    @keyframes slideUp {
      from { opacity:0; transform:translateY(28px); }
      to   { opacity:1; transform:translateY(0); }
    }
    .reveal { opacity:0; transform:translateY(28px); transition: opacity .6s ease, transform .6s ease; }
    .reveal.visible { opacity:1; transform:translateY(0); }

    /* ── Counter animation ── */
    .count-up { display:inline-block; }

    /* Divider wave */
    .wave-divider { line-height:0; }
    .wave-divider svg { display:block; }
  </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<header class="sticky top-0 z-50 bg-white shadow-sm">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 flex items-center justify-between h-14 sm:h-16">
    <a href="#" class="flex items-center gap-2 flex-shrink-0">
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
      <a href="{{ route('initiatives.index') }}" class="nav-active text-[#1e3a6e] font-semibold">Nos Initiatives</a>
      <a href="{{ route('apropos.index') }}" class="hover:text-[#1e3a6e] transition-colors">À Propos</a>
      
    </nav>
    <div class="flex items-center gap-2 sm:gap-3">
      <a href="{{ route('rdv.index')}}" class="btn-primary text-white text-xs sm:text-sm font-semibold px-3 sm:px-5 py-2 rounded">
        <span class="hidden sm:inline">Prise de rendez-vous</span>
        <span class="sm:hidden">RDV</span>
      </a>
      <button id="burger" class="lg:hidden flex flex-col justify-center gap-[5px] w-9 h-9 p-1.5" aria-label="Menu">
        <span class="h-0.5 w-full bg-[#1e3a6e] rounded"></span>
        <span class="h-0.5 w-full bg-[#1e3a6e] rounded"></span>
        <span class="h-0.5 w-full bg-[#1e3a6e] rounded"></span>
      </button>
    </div>
  </div>
  <div id="mobile-menu" class="lg:hidden bg-white border-t border-gray-100 shadow-md">
    <nav class="flex flex-col px-4 py-4 gap-4 text-sm font-medium text-gray-700">
      <a href="{{ route('home')}}">Accueil</a>
      <a href="{{ route('lunettes.index')}}">Nos Lunettes</a>
      <a href="{{ route('initiatives.index') }}" class="text-[#1e3a6e] font-semibold">Nos Initiatives</a>
    </nav>
  </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero-initiatives flex items-center">
  <div class="hero-circle"></div>
  <div class="hero-circle"></div>
  <div class="hero-circle"></div>

  <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 w-full py-16 sm:py-20">
    <!-- Breadcrumb -->
    <p class="text-teal-300 text-sm mb-6 opacity-80">
      <a href="{{ route('home')}}" class="hover:text-white transition-colors">Accueil</a>
      <span class="mx-2 opacity-50">/</span>
      <span class="text-white font-semibold">Nos Initiatives</span>
    </p>

    <div class="max-w-2xl">
      <p class="section-eyebrow text-teal-300 mb-4">Engagés pour un monde qui voit mieux</p>
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-5">
        Voir, c'est un droit.<br/>
        <span class="italic font-normal text-teal-300">Pas un privilège.</span>
      </h1>
      <p class="text-blue-100 text-sm sm:text-base leading-relaxed mb-8 max-w-lg">
        Depuis 2008, Vision Optique agit au-delà de la boutique. Projets humanitaires, partenariats solidaires, 
        actions environnementales — chaque paire achetée contribue à notre mission.
      </p>
      <div class="flex flex-wrap gap-3">
        <a href="#projets" class="inline-block bg-white text-[#1e3a6e] px-6 py-3 rounded-lg text-sm font-bold transition hover:bg-blue-50">
          Découvrir nos projets
        </a>
        <a href="#partenaires" class="inline-block border border-white/40 text-white px-6 py-3 rounded-lg text-sm font-semibold hover:bg-white/10 transition">
          Nos partenaires
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ===== WAVE ===== -->
<div class="wave-divider bg-[#0f2440]">
  <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
    <path d="M0,0 C360,60 1080,60 1440,0 L1440,60 L0,60 Z" fill="#f7f9fc"/>
  </svg>
</div>

<!-- ===== COUNTER STRIP ===== -->
<section class="counter-strip py-8 sm:py-10">
  <div class="max-w-5xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
      <div class="counter-item reveal">
        <p class="counter-num"><span class="count-up" data-target="4200">0</span>+</p>
        <div class="counter-accent bg-[#0d9488]"></div>
        <p class="counter-label">Paires offertes</p>
      </div>
      <div class="counter-item reveal" style="transition-delay:.1s">
        <p class="counter-num"><span class="count-up" data-target="18">0</span></p>
        <div class="counter-accent bg-[#4a90d9]"></div>
        <p class="counter-label">Pays touchés</p>
      </div>
      <div class="counter-item reveal" style="transition-delay:.2s">
        <p class="counter-num"><span class="count-up" data-target="12">0</span></p>
        <div class="counter-accent bg-[#d97706]"></div>
        <p class="counter-label">Partenaires actifs</p>
      </div>
      <div class="counter-item reveal" style="transition-delay:.3s">
        <p class="counter-num"><span class="count-up" data-target="97">0</span>%</p>
        <div class="counter-accent bg-[#e11d48]"></div>
        <p class="counter-label">Emballages recyclés</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== PROJETS HUMANITAIRES ===== -->
<section id="projets" class="py-14 sm:py-20 px-4 sm:px-6">
  <div class="max-w-6xl mx-auto">

    <div class="text-center mb-12 reveal">
      <p class="section-eyebrow text-[#0d9488]">Projets humanitaires</p>
      <h2 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e] mb-3">Nos Actions sur le Terrain</h2>
      <p class="text-gray-500 text-sm sm:text-base max-w-xl mx-auto">
        Des missions concrètes, portées par des équipes passionnées, pour rendre la vision accessible à tous.
      </p>
    </div>

    <!-- Featured project -->
    <div class="init-card mb-6 lg:flex reveal">
      <div class="lg:w-2/5 flex-shrink-0">
        <div class="card-img h-64 lg:h-full">
          <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?w=800&q=80" alt="Mission Afrique"/>
          <div class="overlay"></div>
          <span class="cat-pill">🌍 Mission phare</span>
        </div>
      </div>
      <div class="card-body lg:flex lg:flex-col lg:justify-between">
        <div>
          <div class="card-icon bg-teal-50 text-2xl">🌿</div>
          <h3 class="text-xl mb-3">Vision pour l'Afrique subsaharienne</h3>
          <p class="mb-4">
            En partenariat avec des ONG locales, nous organisons chaque année des camps de dépistage 
            visuel gratuits au Sénégal, au Mali et au Cameroun. Des opticiens volontaires examinent 
            des centaines de patients et distribuent des montures adaptées sur place.
          </p>
          <div class="card-meta mb-4">
            <span>📍 3 pays</span>
            <span>👁️ +800 patients/an</span>
            <span>🗓️ Depuis 2012</span>
          </div>
        </div>
        <div class="card-progress">
          <div class="progress-label">
            <span class="font-semibold text-[#1e3a6e] text-sm">Objectif 2025 : 1 200 patients</span>
            <span class="text-[#0d9488] font-bold">74%</span>
          </div>
          <div class="progress-bar mt-2">
            <div class="progress-fill bg-[#0d9488]" style="width:74%"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- 3-col grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

      <div class="init-card reveal" style="transition-delay:.05s">
        <div class="card-img">
          <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=600&q=80" alt="Enfants"/>
          <div class="overlay"></div>
          <span class="cat-pill">👶 Pédiatrie</span>
        </div>
        <div class="card-body">
          <div class="card-icon bg-blue-50">🏫</div>
          <h3>Vision à l'École</h3>
          <p>Dépistages gratuits dans les écoles primaires défavorisées d'Île-de-France. 
            Chaque enfant détecté se voit offrir une paire de lunettes adaptée à sa correction.</p>
          <div class="card-meta">
            <span>🏫 42 écoles</span>
            <span>👧 +630 enfants</span>
          </div>
          <div class="card-progress mt-3">
            <div class="progress-label"><span class="text-sm font-semibold text-[#1e3a6e]">Objectif 80 écoles</span><span class="text-[#4a90d9] font-bold">52%</span></div>
            <div class="progress-bar mt-1"><div class="progress-fill bg-[#4a90d9]" style="width:52%"></div></div>
          </div>
        </div>
      </div>

      <div class="init-card reveal" style="transition-delay:.1s">
        <div class="card-img">
          <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=600&q=80" alt="Seniors"/>
          <div class="overlay"></div>
          <span class="cat-pill">🤝 Solidarité</span>
        </div>
        <div class="card-body">
          <div class="card-icon bg-amber-50">🏠</div>
          <h3>Opticien à Domicile</h3>
          <p>Des opticiens bénévoles se déplacent dans les EHPAD et résidences seniors pour 
            des examens de vue gratuits et la remise de lunettes adaptées aux personnes à mobilité réduite.</p>
          <div class="card-meta">
            <span>🏠 28 établissements</span>
            <span>👴 +350 seniors</span>
          </div>
          <div class="card-progress mt-3">
            <div class="progress-label"><span class="text-sm font-semibold text-[#1e3a6e]">Objectif 50 établissements</span><span class="text-amber-500 font-bold">56%</span></div>
            <div class="progress-bar mt-1"><div class="progress-fill bg-amber-400" style="width:56%"></div></div>
          </div>
        </div>
      </div>

      <div class="init-card reveal" style="transition-delay:.15s">
        <div class="card-img">
          <img src="https://images.unsplash.com/photo-1512291313931-d4291048e7b6?w=600&q=80" alt="Recyclage"/>
          <div class="overlay"></div>
          <span class="cat-pill">♻️ Environnement</span>
        </div>
        <div class="card-body">
          <div class="card-icon bg-green-50">♻️</div>
          <h3>Seconde Vie des Montures</h3>
          <p>Déposez vos anciennes lunettes en boutique. Nous les restaurons, reconditionnnons 
            et les redistribuons via notre réseau solidaire ou les recyclons intégralement.</p>
          <div class="card-meta">
            <span>♻️ 2 100 paires</span>
            <span>🌱 6,3 t CO₂ évitées</span>
          </div>
          <div class="card-progress mt-3">
            <div class="progress-label"><span class="text-sm font-semibold text-[#1e3a6e]">Objectif 3 000 paires</span><span class="text-green-500 font-bold">70%</span></div>
            <div class="progress-bar mt-1"><div class="progress-fill bg-green-500" style="width:70%"></div></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== TIMELINE ===== -->
<section class="py-14 sm:py-20 bg-white px-4 sm:px-6">
  <div class="max-w-4xl mx-auto">

    <div class="text-center mb-12 reveal">
      <p class="section-eyebrow text-[#4a90d9]">Notre histoire</p>
      <h2 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e] mb-3">15 ans d'Engagement</h2>
      <p class="text-gray-500 text-sm">Chaque année a apporté son lot de nouvelles initiatives.</p>
    </div>

    <div class="relative pl-12 sm:pl-0">
      <div class="timeline-line"></div>
      <div class="space-y-10 sm:space-y-0">

        <!-- Item -->
        <div class="reveal sm:flex sm:gap-8 sm:items-center sm:even:flex-row-reverse">
          <div class="hidden sm:flex sm:w-1/2 sm:justify-end sm:pr-8 sm:even:justify-start sm:even:pl-8 sm:even:pr-0">
            <div class="bg-[#f0f5fb] rounded-2xl p-5 max-w-xs w-full">
              <p class="font-bold text-[#1e3a6e] mb-1">2008 – Fondation</p>
              <p class="text-sm text-gray-500">Création de Vision Optique avec une promesse : reverser 1% des bénéfices à des actions sociales.</p>
            </div>
          </div>
          <div class="absolute sm:relative left-0 sm:left-auto sm:flex sm:justify-center sm:w-0">
            <div class="timeline-dot bg-[#1e3a6e] text-white">🏪</div>
          </div>
          <div class="sm:hidden pl-4">
            <p class="font-bold text-[#1e3a6e] mb-1">2008 – Fondation</p>
            <p class="text-sm text-gray-500">Création avec promesse de reverser 1% des bénéfices.</p>
          </div>
          <div class="hidden sm:block sm:w-1/2"></div>
        </div>

        <div class="reveal sm:flex sm:gap-8 sm:items-center" style="transition-delay:.08s">
          <div class="hidden sm:block sm:w-1/2"></div>
          <div class="absolute sm:relative left-0 sm:left-auto sm:flex sm:justify-center sm:w-0">
            <div class="timeline-dot bg-[#0d9488] text-white">🌍</div>
          </div>
          <div class="sm:hidden pl-4">
            <p class="font-bold text-[#1e3a6e] mb-1">2012 – Mission Afrique</p>
            <p class="text-sm text-gray-500">Premier camp de dépistage au Sénégal. 112 patients examinés.</p>
          </div>
          <div class="hidden sm:flex sm:w-1/2 sm:pl-8">
            <div class="bg-[#f0fdf9] rounded-2xl p-5 max-w-xs w-full">
              <p class="font-bold text-[#1e3a6e] mb-1">2012 – Mission Afrique</p>
              <p class="text-sm text-gray-500">Premier camp de dépistage au Sénégal. 112 patients examinés lors de cette mission fondatrice.</p>
            </div>
          </div>
        </div>

        <div class="reveal sm:flex sm:gap-8 sm:items-center" style="transition-delay:.16s">
          <div class="hidden sm:flex sm:w-1/2 sm:justify-end sm:pr-8">
            <div class="bg-[#eff6ff] rounded-2xl p-5 max-w-xs w-full">
              <p class="font-bold text-[#1e3a6e] mb-1">2016 – Vision à l'École</p>
              <p class="text-sm text-gray-500">Lancement du programme national dans les écoles primaires d'Île-de-France.</p>
            </div>
          </div>
          <div class="absolute sm:relative left-0 sm:left-auto sm:flex sm:justify-center sm:w-0">
            <div class="timeline-dot bg-[#4a90d9] text-white">🏫</div>
          </div>
          <div class="sm:hidden pl-4">
            <p class="font-bold text-[#1e3a6e] mb-1">2016 – Vision à l'École</p>
            <p class="text-sm text-gray-500">Lancement du programme dans les écoles primaires.</p>
          </div>
          <div class="hidden sm:block sm:w-1/2"></div>
        </div>

        <div class="reveal sm:flex sm:gap-8 sm:items-center" style="transition-delay:.24s">
          <div class="hidden sm:block sm:w-1/2"></div>
          <div class="absolute sm:relative left-0 sm:left-auto sm:flex sm:justify-center sm:w-0">
            <div class="timeline-dot bg-amber-500 text-white">♻️</div>
          </div>
          <div class="sm:hidden pl-4">
            <p class="font-bold text-[#1e3a6e] mb-1">2020 – Programme Recyclage</p>
            <p class="text-sm text-gray-500">Déploiement des collecteurs de montures usagées dans toutes nos boutiques.</p>
          </div>
          <div class="hidden sm:flex sm:w-1/2 sm:pl-8">
            <div class="bg-[#fffbeb] rounded-2xl p-5 max-w-xs w-full">
              <p class="font-bold text-[#1e3a6e] mb-1">2020 – Programme Recyclage</p>
              <p class="text-sm text-gray-500">Déploiement des collecteurs de montures usagées dans toutes nos boutiques.</p>
            </div>
          </div>
        </div>

        <div class="reveal sm:flex sm:gap-8 sm:items-center" style="transition-delay:.32s">
          <div class="hidden sm:flex sm:w-1/2 sm:justify-end sm:pr-8">
            <div class="bg-[#fdf2f8] rounded-2xl p-5 max-w-xs w-full">
              <p class="font-bold text-[#1e3a6e] mb-1">2023 – Opticien à Domicile</p>
              <p class="text-sm text-gray-500">Extension du programme aux EHPAD. 350 seniors pris en charge dès la première année.</p>
            </div>
          </div>
          <div class="absolute sm:relative left-0 sm:left-auto sm:flex sm:justify-center sm:w-0">
            <div class="timeline-dot bg-[#e11d48] text-white">🏠</div>
          </div>
          <div class="sm:hidden pl-4">
            <p class="font-bold text-[#1e3a6e] mb-1">2023 – Opticien à Domicile</p>
            <p class="text-sm text-gray-500">Extension aux EHPAD. 350 seniors pris en charge.</p>
          </div>
          <div class="hidden sm:block sm:w-1/2"></div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- ===== PARTENAIRES ===== -->
<section id="partenaires" class="py-14 sm:py-20 bg-[#f0f5fb] px-4 sm:px-6">
  <div class="max-w-6xl mx-auto">

    <div class="text-center mb-12 reveal">
      <p class="section-eyebrow text-[#4a90d9]">Ils nous font confiance</p>
      <h2 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e] mb-3">Nos Partenaires</h2>
      <p class="text-gray-500 text-sm sm:text-base max-w-xl mx-auto">
        Des organisations partageant nos valeurs, avec qui nous construisons un impact durable.
      </p>
    </div>

    <!-- Partner categories -->
    <div class="space-y-10">

      <!-- ONG -->
      <div class="reveal">
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 flex items-center gap-3">
          <span class="flex-1 h-px bg-gray-200"></span>
          🤝 ONG &amp; Fondations
          <span class="flex-1 h-px bg-gray-200"></span>
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
          <div class="partner-logo">
            <div class="logo-inner">
              Vision<br/>mondiale
              <br/><span class="logo-type">ONG internationale</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              Œil &amp;<br/>Solidarité
              <br/><span class="logo-type">Fondation nationale</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              Lumière<br/>d'Afrique
              <br/><span class="logo-type">ONG terrain</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              Enfance<br/>Claire
              <br/><span class="logo-type">Association pédiatrique</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Institutionnels -->
      <div class="reveal">
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 flex items-center gap-3">
          <span class="flex-1 h-px bg-gray-200"></span>
          🏛️ Institutionnels &amp; Collectivités
          <span class="flex-1 h-px bg-gray-200"></span>
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
          <div class="partner-logo">
            <div class="logo-inner">
              Ministère<br/>de la Santé
              <br/><span class="logo-type">Partenariat officiel</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              Ville<br/>de Paris
              <br/><span class="logo-type">Collectivité locale</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              CPAM<br/>Île-de-France
              <br/><span class="logo-type">Sécurité sociale</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              ARS<br/>National
              <br/><span class="logo-type">Agence régionale</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Entreprises -->
      <div class="reveal">
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 flex items-center gap-3">
          <span class="flex-1 h-px bg-gray-200"></span>
          🏢 Partenaires entreprises
          <span class="flex-1 h-px bg-gray-200"></span>
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
          <div class="partner-logo">
            <div class="logo-inner">
              Essilor<br/>Luxottica
              <br/><span class="logo-type">Fournisseur officiel</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              Veolia<br/>Recyclage
              <br/><span class="logo-type">Partenaire éco-responsable</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              La Poste<br/>Pro
              <br/><span class="logo-type">Logistique solidaire</span>
            </div>
          </div>
          <div class="partner-logo">
            <div class="logo-inner">
              BNP<br/>Fondation
              <br/><span class="logo-type">Mécénat</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Devenir partenaire CTA -->
    <div class="mt-10 text-center reveal">
      <p class="text-sm text-gray-500 mb-3">Vous souhaitez rejoindre notre réseau de partenaires ?</p>
      <a href="vision-optique.html#contact" class="inline-block btn-primary text-white px-8 py-3 rounded-lg text-sm font-semibold">
        Nous contacter
      </a>
    </div>

  </div>
</section>

<!-- ===== TÉMOIGNAGE ===== -->
<section class="py-14 sm:py-20 px-4 sm:px-6">
  <div class="max-w-4xl mx-auto">
    <div class="text-center mb-10 reveal">
      <p class="section-eyebrow text-[#0d9488]">Témoignages</p>
      <h2 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e]">La Parole à Ceux qui Vivent le Changement</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="testimonial-card reveal">
        <div class="relative z-10">
          <p class="text-blue-100 text-sm leading-relaxed mb-6 italic">
            "Grâce aux opticiens de Vision Optique, j'ai pu voir le tableau de l'école pour la première fois. 
            Maintenant je peux suivre les cours comme les autres enfants."
          </p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-teal-400/30 flex items-center justify-center text-lg">👧</div>
            <div>
              <p class="font-bold text-white text-sm">Aminata, 9 ans</p>
              <p class="text-blue-300 text-xs">Bénéficiaire — Programme Vision à l'École</p>
            </div>
          </div>
        </div>
      </div>

      <div class="testimonial-card reveal" style="transition-delay:.1s">
        <div class="relative z-10">
          <p class="text-blue-100 text-sm leading-relaxed mb-6 italic">
            "À 78 ans, je ne pouvais plus lire ni regarder la télévision. L'opticien est venu jusqu'à moi. 
            C'est un geste d'une grande humanité que je n'oublierai jamais."
          </p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-amber-400/30 flex items-center justify-center text-lg">👴</div>
            <div>
              <p class="font-bold text-white text-sm">Marcel, 78 ans</p>
              <p class="text-blue-300 text-xs">Bénéficiaire — Programme Opticien à Domicile</p>
            </div>
          </div>
        </div>
      </div>

      <div class="testimonial-card reveal" style="transition-delay:.15s">
        <div class="relative z-10">
          <p class="text-blue-100 text-sm leading-relaxed mb-6 italic">
            "Travailler avec Vision Optique, c'est s'associer à une entreprise qui comprend que le business 
            et l'impact social ne sont pas opposés. Un modèle à suivre."
          </p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-400/30 flex items-center justify-center text-lg">🤝</div>
            <div>
              <p class="font-bold text-white text-sm">Dr. Fatou Diallo</p>
              <p class="text-blue-300 text-xs">Directrice — Lumière d'Afrique ONG</p>
            </div>
          </div>
        </div>
      </div>

      <div class="testimonial-card reveal" style="transition-delay:.2s">
        <div class="relative z-10">
          <p class="text-blue-100 text-sm leading-relaxed mb-6 italic">
            "En déposant mes vieilles lunettes, je ne m'attendais pas à tant. Savoir qu'elles servent 
            à quelqu'un dans le besoin donne du sens à un geste si simple."
          </p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-400/30 flex items-center justify-center text-lg">🌱</div>
            <div>
              <p class="font-bold text-white text-sm">Claire, 44 ans</p>
              <p class="text-blue-300 text-xs">Cliente — Programme Seconde Vie</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA BAND ===== -->
<section class="cta-band py-12 sm:py-14 px-4 sm:px-6 text-white text-center">
  <div class="max-w-2xl mx-auto relative z-10">
    <p class="text-teal-100 text-sm font-semibold uppercase tracking-widest mb-3">Agir ensemble</p>
    <h2 class="text-2xl sm:text-3xl font-bold mb-4">Chaque achat est un geste solidaire</h2>
    <p class="text-teal-100 text-sm sm:text-base mb-8 max-w-lg mx-auto">
      En choisissant Vision Optique, vous participez directement à nos projets. 
      Pour chaque paire vendue, 2€ sont reversés à nos programmes humanitaires.
    </p>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
      <a href="nos-lunettes.html" class="inline-block bg-white text-[#0d9488] font-bold px-7 py-3 rounded-lg text-sm hover:bg-teal-50 transition">
        Voir nos collections
      </a>
      <a href="vision-optique.html#contact" class="inline-block border-2 border-white/60 text-white font-semibold px-7 py-3 rounded-lg text-sm hover:bg-white/10 transition">
        Nous rejoindre comme bénévole
      </a>
    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="bg-[#1e3a6e] text-blue-200 text-xs py-4">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-6 text-center">
    <a href="#" class="hover:text-white transition-colors">Mentions Légales</a>
    <span class="hidden sm:inline">|</span>
    <a href="#" class="hover:text-white transition-colors">Politique de Confidentialité</a>
  </div>
</footer>

<script>
  // ── Burger ──
  document.getElementById('burger').addEventListener('click', function() {
    this.classList.toggle('open');
    document.getElementById('mobile-menu').classList.toggle('open');
  });

  // ── Scroll reveal ──
  const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); } });
  }, { threshold: 0.1 });
  document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

  // ── Counter animation ──
  function animateCount(el, target, duration = 1800) {
    let start = 0;
    const step = target / (duration / 16);
    const timer = setInterval(() => {
      start += step;
      if (start >= target) { start = target; clearInterval(timer); }
      el.textContent = Math.round(start).toLocaleString('fr-FR');
    }, 16);
  }

  const counterObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const target = parseInt(e.target.dataset.target, 10);
        animateCount(e.target, target);
        counterObs.unobserve(e.target);
      }
    });
  }, { threshold: 0.5 });
  document.querySelectorAll('.count-up').forEach(el => counterObs.observe(el));

  // ── Progress bars animate on scroll ──
  const barObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const fills = e.target.querySelectorAll('.progress-fill');
        fills.forEach(f => { const w = f.style.width; f.style.width = '0'; setTimeout(() => { f.style.width = w; }, 100); });
        barObs.unobserve(e.target);
      }
    });
  }, { threshold: 0.2 });
  document.querySelectorAll('.init-card').forEach(el => barObs.observe(el));
</script>
</body>
</html>