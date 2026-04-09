<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nos Lunettes – Vision Optique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --navy: #1e3a6e;
      --navy-dark: #163060;
      --blue-mid: #2c4a7c;
      --blue-light: #4a90d9;
      --bg-soft: #f0f5fb;
      --text-muted: #6b7280;
    }

    * { box-sizing: border-box; }
    body { font-family: 'Nunito', sans-serif; background: #f7f9fc; }
    h1,h2,h3,.brand { font-family: 'Nunito', serif; }

    /* ── Navbar ── */
    .nav-active { border-bottom: 2px solid var(--navy); padding-bottom: 2px; }
    .btn-primary { background-color: var(--navy); transition: background-color 0.2s, transform 0.2s; }
    .btn-primary:hover { background-color: var(--navy-dark); transform: scale(1.03); }

    /* ── Hero banner ── */
    .page-hero {
      background: linear-gradient(135deg, var(--navy) 0%, var(--blue-mid) 60%, #3a6ea8 100%);
      position: relative;
      overflow: hidden;
    }
    .page-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .page-hero::after {
      content: '';
      position: absolute;
      right: -60px; bottom: -60px;
      width: 320px; height: 320px;
      border-radius: 50%;
      border: 40px solid rgba(255,255,255,0.05);
    }

    /* ── Search ── */
    .search-wrap { position: relative; }
    .search-wrap input {
      width: 100%;
      padding: 12px 44px 12px 16px;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      font-size: 0.9rem;
      font-family: 'Lato', sans-serif;
      background: white;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }
    .search-wrap input:focus {
      border-color: var(--blue-light);
      box-shadow: 0 0 0 3px rgba(74,144,217,0.15);
    }
    .search-wrap .search-icon {
      position: absolute; right: 14px; top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted);
      pointer-events: none;
    }
    .search-wrap .clear-btn {
      position: absolute; right: 40px; top: 50%;
      transform: translateY(-50%);
      background: #e5e7eb; border: none;
      border-radius: 50%; width: 20px; height: 20px;
      cursor: pointer; font-size: 11px; display: none;
      align-items: center; justify-content: center;
      color: #374151; transition: background 0.2s;
    }
    .search-wrap .clear-btn:hover { background: #d1d5db; }
    .search-wrap.has-value .clear-btn { display: flex; }
    .search-wrap.has-value input { padding-right: 68px; }

    /* ── Category tabs ── */
    .cat-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
    .cat-tab {
      padding: 8px 18px;
      border-radius: 50px;
      border: 2px solid #e5e7eb;
      background: white;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text-muted);
      cursor: pointer;
      transition: all 0.2s;
      white-space: nowrap;
      font-family: 'Lato', sans-serif;
    }
    .cat-tab:hover { border-color: var(--blue-light); color: var(--blue-light); }
    .cat-tab.active {
      background: var(--navy);
      border-color: var(--navy);
      color: white;
      box-shadow: 0 4px 12px rgba(30,58,110,0.25);
    }

    /* ── Product grid ── */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 20px;
    }

    /* ── Product card ── */
    .product-card {
      background: white;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(30,58,110,0.08);
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
    }
    .product-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 36px rgba(30,58,110,0.16);
    }
    .product-card .badge {
      position: absolute; top: 12px; left: 12px;
      padding: 3px 10px; border-radius: 50px;
      font-size: 0.7rem; font-weight: 700;
      letter-spacing: 0.05em; text-transform: uppercase;
      z-index: 2;
    }
    .badge-new { background: var(--blue-light); color: white; }
    .badge-promo { background: #ef4444; color: white; }
    .badge-bestseller { background: #f59e0b; color: white; }

    .product-card .img-wrap {
      height: 180px;
      background: var(--bg-soft);
      overflow: hidden;
      display: flex; align-items: center; justify-content: center;
    }
    .product-card .img-wrap img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform 0.5s ease;
    }
    .product-card:hover .img-wrap img { transform: scale(1.07); }

    .product-card .info { padding: 14px 16px 16px; }
    .product-card .brand-tag {
      font-size: 0.7rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.08em;
      color: var(--blue-light); margin-bottom: 4px;
    }
    .product-card h3 {
      font-size: 0.95rem; font-weight: 700;
      color: #1f2937; margin-bottom: 4px; line-height: 1.3;
    }
    .product-card .meta {
      font-size: 0.78rem; color: var(--text-muted); margin-bottom: 10px;
    }
    .product-card .price-row {
      display: flex; align-items: center; justify-content: space-between;
    }
    .product-card .price {
      font-size: 1.05rem; font-weight: 700; color: var(--navy);
    }
    .product-card .price-old {
      font-size: 0.82rem; color: #9ca3af;
      text-decoration: line-through; margin-left: 6px;
    }
    .product-card .quick-view {
      font-size: 0.75rem; font-weight: 600;
      color: var(--blue-light); border: 1.5px solid var(--blue-light);
      padding: 5px 12px; border-radius: 6px;
      transition: all 0.2s;
    }
    .product-card .quick-view:hover {
      background: var(--blue-light); color: white;
    }

    /* ── No results ── */
    .no-results {
      grid-column: 1/-1;
      text-align: center;
      padding: 60px 20px;
      color: var(--text-muted);
    }

    /* ── Modal ── */
    .modal-overlay {
      position: fixed; inset: 0; z-index: 100;
      background: rgba(15,30,60,0.55);
      backdrop-filter: blur(4px);
      display: flex; align-items: center; justify-content: center;
      padding: 16px;
      opacity: 0; pointer-events: none;
      transition: opacity 0.3s ease;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }

    .modal-box {
      background: white;
      border-radius: 20px;
      width: 100%; max-width: 820px;
      max-height: 90vh;
      overflow-y: auto;
      transform: translateY(30px) scale(0.97);
      transition: transform 0.3s ease;
      box-shadow: 0 30px 80px rgba(15,30,60,0.3);
    }
    .modal-overlay.open .modal-box { transform: translateY(0) scale(1); }

    .modal-img {
      width: 100%;
      height: 280px;
      object-fit: cover;
      border-radius: 20px 20px 0 0;
    }
    @media(min-width:640px) {
      .modal-inner { display: grid; grid-template-columns: 1fr 1fr; }
      .modal-img { height: 100%; max-height: 420px; border-radius: 20px 0 0 20px; }
    }

    .modal-body { padding: 28px 24px; }
    .modal-close {
      position: absolute; top: 14px; right: 14px;
      width: 36px; height: 36px; border-radius: 50%;
      background: rgba(255,255,255,0.9);
      border: none; cursor: pointer; font-size: 18px;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      transition: background 0.2s;
      z-index: 10;
    }
    .modal-close:hover { background: white; }

    .modal-tag {
      display: inline-block;
      padding: 4px 12px; border-radius: 50px;
      font-size: 0.72rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: 0.06em;
      background: var(--bg-soft); color: var(--navy);
      margin-bottom: 10px;
    }
    .modal-title { font-size: 1.4rem; color: #1f2937; margin-bottom: 6px; }
    .modal-brand { font-size: 0.8rem; color: var(--blue-light); font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; }

    .modal-price { font-size: 1.6rem; font-weight: 700; color: var(--navy); margin: 14px 0 6px; }
    .modal-price-old { font-size: 0.9rem; color: #9ca3af; text-decoration: line-through; margin-left: 8px; font-weight: 400; }

    .modal-desc { font-size: 0.88rem; color: #4b5563; line-height: 1.65; margin-bottom: 18px; }

    .modal-specs { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px; }
    .spec-item { background: var(--bg-soft); border-radius: 8px; padding: 10px 12px; }
    .spec-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; color: var(--text-muted); margin-bottom: 2px; }
    .spec-val { font-size: 0.88rem; font-weight: 700; color: var(--navy); }

    .color-dots { display: flex; gap: 8px; margin-bottom: 20px; }
    .color-dot {
      width: 22px; height: 22px; border-radius: 50%;
      cursor: pointer; border: 2px solid transparent;
      transition: transform 0.2s, border-color 0.2s;
    }
    .color-dot:hover, .color-dot.active { transform: scale(1.2); border-color: var(--navy); }

    .modal-cta {
      display: flex; gap: 10px;
    }
    .modal-cta .btn-rdv {
      flex: 1;
      background: var(--navy);
      color: white; border: none;
      padding: 12px 20px; border-radius: 10px;
      font-family: 'Lato', sans-serif;
      font-size: 0.88rem; font-weight: 700;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
    }
    .modal-cta .btn-rdv:hover { background: var(--navy-dark); transform: scale(1.02); }
    .modal-cta .btn-fav {
      width: 46px; height: 46px; border-radius: 10px;
      border: 2px solid #e5e7eb;
      background: white; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px;
      transition: border-color 0.2s, background 0.2s;
    }
    .modal-cta .btn-fav:hover, .modal-cta .btn-fav.active { border-color: #ef4444; background: #fef2f2; }

    /* ── Burger ── */
    #mobile-menu { display: none; }
    #mobile-menu.open { display: block; }
    #burger span { transition: transform 0.25s, opacity 0.25s; display: block; }
    #burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    #burger.open span:nth-child(2) { opacity: 0; }
    #burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* ── Animations ── */
    @keyframes fadeIn { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
    .card-enter { animation: fadeIn 0.4s ease forwards; }

    /* Scrollbar modal */
    .modal-box::-webkit-scrollbar { width: 6px; }
    .modal-box::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }

    /* count badge */
    .count-badge {
      display: inline-block;
      background: var(--blue-light);
      color: white;
      font-size: 0.7rem;
      font-weight: 700;
      padding: 1px 7px;
      border-radius: 50px;
      margin-left: 6px;
    }
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
        <a href="{{ route('home') }}" class="hover:text-[#1e3a6e] transition-colors">Accueil</a>
        <a href="{{ route('lunettes.index')}}" class="nav-active text-[#1e3a6e] font-semibold">Nos Lunettes</a>
        <a href="{{ route('initiatives.index') }}" class="hover:text-[#1e3a6e] transition-colors">Nos Initiatives</a>
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
        <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('initiatives.index') }}" class="text-[#1e3a6e] font-semibold">Nos Lunettes</a>
        <a href="{{ route('initiatives.index') }}">Nos Initiatives</a>
        <a href="{{ route('apropos.index') }}">À Propos</a>
        
      </nav>
    </div>
  </header>

  <!-- ===== HERO BANNER ===== -->
  <section class="page-hero text-white py-12 sm:py-16 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto relative z-10">
      <!-- Breadcrumb -->
      <p class="text-blue-200 text-sm mb-4">
        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a>
        <span class="mx-2 opacity-50">/</span>
        <span class="text-white font-semibold">Nos Lunettes</span>
      </p>
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 leading-tight">
        Nos Lunettes
      </h1>
      <p class="text-blue-200 text-sm sm:text-base max-w-xl">
        Découvrez notre sélection de montures pour toute la famille — vue, soleil et enfant.
      </p>
    </div>
  </section>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-10">

    <!-- Search + Filters bar -->
    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between mb-6">

      <!-- Search -->
      <div class="search-wrap w-full sm:max-w-xs" id="searchWrap">
        <input
          type="text"
          id="searchInput"
          placeholder="Rechercher une monture, marque..."
          oninput="handleSearch(this)"
        />
        <button class="clear-btn" onclick="clearSearch()" title="Effacer">✕</button>
        <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </div>

      <!-- Result count -->
      <p class="text-sm text-gray-500 flex-shrink-0">
        <span id="resultCount" class="font-bold text-[#1e3a6e]">0</span> modèle(s) trouvé(s)
      </p>
    </div>

    <!-- Category tabs -->
    <div class="cat-tabs mb-8" id="catTabs">
      <button class="cat-tab active" data-cat="tous" onclick="selectCat(this)">
        Tous <span class="count-badge" id="countTous">0</span>
      </button>
      <button class="cat-tab" data-cat="vue" onclick="selectCat(this)">
        Lunettes de Vue <span class="count-badge" id="countVue">0</span>
      </button>
      <button class="cat-tab" data-cat="soleil" onclick="selectCat(this)">
        Lunettes de Soleil <span class="count-badge" id="countSoleil">0</span>
      </button>
      <button class="cat-tab" data-cat="enfant" onclick="selectCat(this)">
        Lunettes Enfant <span class="count-badge" id="countEnfant">0</span>
      </button>
    </div>

    <!-- Product grid -->
    <div class="product-grid" id="productGrid"></div>

  </main>

  <!-- ===== MODAL ===== -->
  <div class="modal-overlay" id="modalOverlay" onclick="closeModalOnOverlay(event)">
    <div class="modal-box" id="modalBox">
      <div class="modal-inner relative" id="modalInner">
        <!-- injected by JS -->
      </div>
    </div>
  </div>
 <!-- ===== CONTACT ===== -->
 <section id="contact" class="bg-[#2c4a7c] text-white py-10 sm:py-14">
  <div class="max-w-5xl mx-auto px-4 sm:px-6">
    <h2 class="text-xl sm:text-2xl font-bold text-center mb-1">Contactez-Nous</h2>
    <p class="text-center text-sm italic text-blue-200 mb-8 sm:mb-10">Prenez rendez-vous dès aujourd'hui !</p>

    <div class="flex flex-col md:flex-row gap-8 md:gap-10 items-start">

      <!-- Infos -->
      <div class="w-full md:flex-1 space-y-5 text-sm">
        <div class="flex items-start gap-3">
          <svg class="mt-0.5 flex-shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
          <span>123 Rue de l'Optique, 75000 Paris</span>
        </div>
        <div class="flex items-center gap-3">
          <svg class="flex-shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
          <span>info@visionoptique.fr</span>
        </div>
        <div class="flex items-center gap-3">
          <svg class="flex-shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.7 11.93a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.64 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.44a16 16 0 0 0 5.46 5.46l.8-.8a2 2 0 0 1 2.11-.45c.908.339 1.85.573 2.81.7A2 2 0 0 1 21 16.92z"/>
          </svg>
          <a href="tel:0123456789" class="hover:underline">01 23 45 67 89</a>
        </div>

        <!-- CTA mobile extra -->
        <a href="tel:0123456789" class="md:hidden inline-block mt-2 btn-primary text-white text-sm font-semibold px-5 py-2.5 rounded w-full text-center">
          📞 Appelez-nous
        </a>
      </div>

      <!-- Form -->
      <div class="w-full md:flex-1 bg-[#1e3a6e] rounded-lg p-5 sm:p-6 space-y-4">
        <div>
          <label class="text-xs text-blue-200 block mb-1">Nom</label>
          <input type="text" placeholder="Votre nom" class="form-input"/>
        </div>
        <div>
          <label class="text-xs text-blue-200 block mb-1">Email</label>
          <input type="email" placeholder="Votre email" class="form-input"/>
        </div>
        <div>
          <label class="text-xs text-blue-200 block mb-1">Votre Message</label>
          <textarea rows="3" placeholder="Votre message..." class="form-input"></textarea>
        </div>
        <button
          onclick="handleSubmit(event)"
          class="w-full bg-[#4a90d9] hover:bg-[#3a7ac4] text-white text-sm font-semibold py-2.5 rounded transition-colors"
        >
          Envoyer
        </button>
      </div>

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
// ── DATA ──────────────────────────────────────────────────
const PRODUCTS = [
  // LUNETTES DE VUE
  {
    id: 1, cat: 'vue', brand: 'Ray-Ban', name: 'Aviator Classic',
    shape: 'Aviateur', genre: 'Mixte', matiere: 'Métal',
    price: 159, priceOld: null,
    badge: 'bestseller',
    colors: ['#c9a87c','#1a1a2e','#b87333'],
    img: 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=700&q=80',
    desc: 'Un classique intemporel. La monture Aviator en métal léger s\'adapte à tous les visages. Verres correcteurs disponibles en différents indices.',
  },
  {
    id: 2, cat: 'vue', brand: 'Silhouette', name: 'Momentum Full Rim',
    shape: 'Rectangulaire', genre: 'Femme', matiere: 'Titane',
    price: 249, priceOld: null,
    badge: 'new',
    colors: ['#8b7355','#2d2d2d','#c0392b'],
    img: 'https://images.unsplash.com/photo-1508296695146-257a814070b4?w=700&q=80',
    desc: 'Monture ultra-légère en titane pur. Confort exceptionnel pour un port toute la journée. Design épuré et élégant, fabriqué en Autriche.',
  },
  {
    id: 3, cat: 'vue', brand: 'Tom Ford', name: 'FT5634',
    shape: 'Ronde', genre: 'Homme', matiere: 'Acétate',
    price: 319, priceOld: 369,
    badge: 'promo',
    colors: ['#2c1810','#1a3a2a','#4a4a6e'],
    img: 'https://images.unsplash.com/photo-1587800090255-bf6df13e24e1?w=700&q=80',
    desc: 'Monture ronde en acétate premium avec charnières à ressort. Un style sophistiqué inspiré des archives de la maison Tom Ford.',
  },
  {
    id: 4, cat: 'vue', brand: 'Lindberg', name: 'Air Titanium',
    shape: 'Papillon', genre: 'Femme', matiere: 'Titane',
    price: 389, priceOld: null,
    badge: null,
    colors: ['#d4af8c','#c0c0c0','#1c1c2e'],
    img: 'https://images.unsplash.com/photo-1581093196277-9f608bb3b511?w=700&q=80',
    desc: 'La légèreté absolue. Cette monture en titane pur sans vis ni soudures pèse à peine 2 grammes. Design danois iconique.',
  },
  {
    id: 5, cat: 'vue', brand: 'Prada', name: 'Conceptual',
    shape: 'Hexagonale', genre: 'Mixte', matiere: 'Acétate',
    price: 285, priceOld: null,
    badge: 'new',
    colors: ['#1a1a2e','#8b4513','#2d4a3e'],
    img: 'https://images.unsplash.com/photo-1589642380614-4a8c2776b19c?w=700&q=80',
    desc: 'Géométrie audacieuse et caractère affirmé. La Conceptual de Prada revisite les codes de la maison avec une forme hexagonale exclusive.',
  },

  // LUNETTES DE SOLEIL
  {
    id: 6, cat: 'soleil', brand: 'Ray-Ban', name: 'Wayfarer New Classic',
    shape: 'Trapèze', genre: 'Mixte', matiere: 'Acétate',
    price: 179, priceOld: null,
    badge: 'bestseller',
    colors: ['#1a1a1a','#8b4513','#2c5282'],
    img: 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=700&q=80',
    desc: 'L\'icône absolue. Le Wayfarer en acétate avec verres polarisés G-15 protège vos yeux tout en affirmant votre style.',
  },
  {
    id: 7, cat: 'soleil', brand: 'Oakley', name: 'Holbrook XL',
    shape: 'Rectangulaire', genre: 'Homme', matiere: 'Métal',
    price: 195, priceOld: 220,
    badge: 'promo',
    colors: ['#1a1a2e','#8b7355','#2d6a4f'],
    img: 'https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=700&q=80',
    desc: 'Technologie Prizm pour une vision optimale en extérieur. Monture robuste et légère avec verres Plutonite® résistants aux impacts.',
  },
  {
    id: 8, cat: 'soleil', brand: 'Gucci', name: 'GG1084S',
    shape: 'Papillon', genre: 'Femme', matiere: 'Acétate',
    price: 340, priceOld: null,
    badge: 'new',
    colors: ['#c9a87c','#1a0a0a','#8b6914'],
    img: 'https://images.unsplash.com/photo-1508296695146-257a814070b4?w=700&q=80',
    desc: 'Glamour absolu. Le papillon surdimensionné de Gucci en acétate avec le détail chaîne dorée emblématique de la maison florentine.',
  },
  {
    id: 9, cat: 'soleil', brand: 'Maui Jim', name: 'Peahi',
    shape: 'Enveloppante', genre: 'Mixte', matiere: 'Métal',
    price: 259, priceOld: null,
    badge: null,
    colors: ['#1a1a2e','#2d6a4f','#8b4513'],
    img: 'https://images.unsplash.com/photo-1561988407-c021dc985e9b?w=700&q=80',
    desc: 'Protection maximale et clarté PolarizedPlus2®. Née sur les plages de Maui, cette monture sportive élimine les reflets avec une efficacité incomparable.',
  },
  {
    id: 10, cat: 'soleil', brand: 'Persol', name: '714 Steve McQueen',
    shape: 'Aviateur', genre: 'Homme', matiere: 'Acétate',
    price: 299, priceOld: null,
    badge: null,
    colors: ['#2c1810','#c9a87c','#1c2c4a'],
    img: 'https://images.unsplash.com/photo-1589642380614-4a8c2776b19c?w=700&q=80',
    desc: 'La lunette pliante la plus célèbre du monde. Portée par Steve McQueen dans "Le Mans", elle allie savoir-faire italien et style légendaire.',
  },

  // LUNETTES ENFANT
  {
    id: 11, cat: 'enfant', brand: 'Nano Vista', name: 'Arcade',
    shape: 'Rectangulaire', genre: 'Garçon', matiere: 'Flex',
    price: 89, priceOld: null,
    badge: 'new',
    colors: ['#2563eb','#16a34a','#dc2626'],
    img: 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=700&q=80',
    desc: 'Conçue pour les petits aventuriers. Monture ultra-flexible en matériau mémoire de forme, résistante aux chocs et aux torsions. Parfaite pour 4-8 ans.',
  },
  {
    id: 12, cat: 'enfant', brand: 'Tomato Glasses', name: 'TKAC',
    shape: 'Ronde', genre: 'Fille', matiere: 'Silicone',
    price: 99, priceOld: 115,
    badge: 'promo',
    colors: ['#ec4899','#a855f7','#f59e0b'],
    img: 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=700&q=80',
    desc: 'Sécurité avant tout. Monture en silicone souple avec système de fixation breveté, sans parties saillantes. Idéale pour les 2-6 ans.',
  },
  {
    id: 13, cat: 'enfant', brand: 'Miraflex', name: 'Baby',
    shape: 'Ovale', genre: 'Mixte', matiere: 'Silicone',
    price: 79, priceOld: null,
    badge: null,
    colors: ['#2563eb','#ec4899','#16a34a','#f59e0b'],
    img: 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=700&q=80',
    desc: 'La référence pédiatrique depuis 30 ans. Monture en plastique flexible, légère et incassable, adaptée dès 6 mois. Sans fils, ni charnières.',
  },
  {
    id: 14, cat: 'enfant', brand: 'Ray-Ban Junior', name: 'RJ9077S',
    shape: 'Aviateur', genre: 'Mixte', matiere: 'Métal',
    price: 119, priceOld: null,
    badge: 'bestseller',
    colors: ['#c9a87c','#1a1a2e','#b87333'],
    img: 'https://images.unsplash.com/photo-1587800090255-bf6df13e24e1?w=700&q=80',
    desc: 'Le style iconique Ray-Ban en version junior. Monture métal légère avec protection UV400 intégrale. Pour les 8-12 ans.',
  },
];

// ── STATE ──────────────────────────────────────────────────
let currentCat = 'tous';
let searchQuery = '';
let favorites = new Set();

// ── INIT ───────────────────────────────────────────────────
function init() {
  updateCounts();
  renderProducts();
}

// ── COUNTS ─────────────────────────────────────────────────
function updateCounts() {
  const all = PRODUCTS.length;
  const vue = PRODUCTS.filter(p => p.cat === 'vue').length;
  const soleil = PRODUCTS.filter(p => p.cat === 'soleil').length;
  const enfant = PRODUCTS.filter(p => p.cat === 'enfant').length;
  document.getElementById('countTous').textContent = all;
  document.getElementById('countVue').textContent = vue;
  document.getElementById('countSoleil').textContent = soleil;
  document.getElementById('countEnfant').textContent = enfant;
}

// ── FILTER ─────────────────────────────────────────────────
function getFiltered() {
  let list = PRODUCTS;
  if (currentCat !== 'tous') list = list.filter(p => p.cat === currentCat);
  if (searchQuery) {
    const q = searchQuery.toLowerCase();
    list = list.filter(p =>
      p.name.toLowerCase().includes(q) ||
      p.brand.toLowerCase().includes(q) ||
      p.shape.toLowerCase().includes(q) ||
      p.matiere.toLowerCase().includes(q)
    );
  }
  return list;
}

// ── RENDER ─────────────────────────────────────────────────
function renderProducts() {
  const grid = document.getElementById('productGrid');
  const filtered = getFiltered();
  document.getElementById('resultCount').textContent = filtered.length;

  if (filtered.length === 0) {
    grid.innerHTML = `
      <div class="no-results">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <p class="font-semibold text-gray-400 text-lg mb-1">Aucun résultat</p>
        <p class="text-sm text-gray-400">Essayez d'autres termes ou <button onclick="clearSearch()" class="text-[#4a90d9] underline">effacez la recherche</button>.</p>
      </div>`;
    return;
  }

  grid.innerHTML = filtered.map((p, i) => `
    <div class="product-card card-enter" style="animation-delay:${i * 0.06}s" onclick="openModal(${p.id})">
      ${p.badge ? `<span class="badge badge-${p.badge}">${badgeLabel(p.badge)}</span>` : ''}
      <div class="img-wrap">
        <img src="${p.img}" alt="${p.name}" loading="lazy"/>
      </div>
      <div class="info">
        <p class="brand-tag">${p.brand}</p>
        <h3>${p.name}</h3>
        <p class="meta">${p.shape} · ${p.genre} · ${p.matiere}</p>
        <div class="price-row">
          <div>
            <span class="price">${p.price} €</span>
            ${p.priceOld ? `<span class="price-old">${p.priceOld} €</span>` : ''}
          </div>
          <span class="quick-view">Voir</span>
        </div>
      </div>
    </div>
  `).join('');
}

function badgeLabel(b) {
  return { new: 'Nouveau', promo: 'Promo', bestseller: 'Best-seller' }[b] || b;
}

// ── SEARCH ─────────────────────────────────────────────────
function handleSearch(input) {
  searchQuery = input.value.trim();
  const wrap = document.getElementById('searchWrap');
  searchQuery ? wrap.classList.add('has-value') : wrap.classList.remove('has-value');
  renderProducts();
}

function clearSearch() {
  const input = document.getElementById('searchInput');
  input.value = '';
  searchQuery = '';
  document.getElementById('searchWrap').classList.remove('has-value');
  renderProducts();
}

// ── CATEGORY ───────────────────────────────────────────────
function selectCat(btn) {
  document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');
  currentCat = btn.dataset.cat;
  renderProducts();
}

// ── MODAL ──────────────────────────────────────────────────
function openModal(id) {
  const p = PRODUCTS.find(x => x.id === id);
  if (!p) return;
  const isFav = favorites.has(id);

  document.getElementById('modalInner').innerHTML = `
    <button class="modal-close" onclick="closeModal()">✕</button>
    <img src="${p.img}" alt="${p.name}" class="modal-img"/>
    <div class="modal-body">
      <span class="modal-tag">${catLabel(p.cat)}</span>
      <p class="modal-brand">${p.brand}</p>
      <h2 class="modal-title">${p.name}</h2>

      <div class="modal-price">
        ${p.price} €
        ${p.priceOld ? `<span class="modal-price-old">${p.priceOld} €</span>` : ''}
      </div>

      <p class="modal-desc">${p.desc}</p>

      <div class="modal-specs">
        <div class="spec-item"><p class="spec-label">Forme</p><p class="spec-val">${p.shape}</p></div>
        <div class="spec-item"><p class="spec-label">Genre</p><p class="spec-val">${p.genre}</p></div>
        <div class="spec-item"><p class="spec-label">Matière</p><p class="spec-val">${p.matiere}</p></div>
        <div class="spec-item"><p class="spec-label">Protection</p><p class="spec-val">UV400</p></div>
      </div>

      <p style="font-size:0.75rem;color:#6b7280;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.05em;font-weight:700;">Coloris disponibles</p>
      <div class="color-dots" id="colorDots">
        ${p.colors.map((c, i) => `
          <span class="color-dot ${i===0?'active':''}" style="background:${c}"
            onclick="selectColor(this)" title="${c}"></span>
        `).join('')}
      </div>

      <div class="modal-cta">
        <button class="btn-rdv" onclick="bookRdv('${p.name}')">
          Essayer en boutique
        </button>
        <button class="btn-fav ${isFav ? 'active' : ''}" id="favBtn" onclick="toggleFav(${id})" title="Favoris">
          ${isFav ? '❤️' : '🤍'}
        </button>
      </div>
      <p style="font-size:0.72rem;color:#9ca3af;margin-top:10px;text-align:center;">
        ✓ Essai gratuit en boutique &nbsp;·&nbsp; Montage express 1h &nbsp;·&nbsp; Garantie 2 ans
      </p>
    </div>
  `;

  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

function closeModalOnOverlay(e) {
  if (e.target === document.getElementById('modalOverlay')) closeModal();
}

function catLabel(cat) {
  return { vue: 'Lunettes de Vue', soleil: 'Lunettes de Soleil', enfant: 'Lunettes Enfant' }[cat] || cat;
}

function selectColor(dot) {
  document.querySelectorAll('.color-dot').forEach(d => d.classList.remove('active'));
  dot.classList.add('active');
}

function toggleFav(id) {
  const btn = document.getElementById('favBtn');
  if (favorites.has(id)) {
    favorites.delete(id);
    btn.textContent = '🤍';
    btn.classList.remove('active');
  } else {
    favorites.add(id);
    btn.textContent = '❤️';
    btn.classList.add('active');
  }
}

function bookRdv(name) {
  closeModal();
  alert(`Rendez-vous pour essayer "${name}" !\nRedirection vers le formulaire de contact...`);
}

// ── KEYBOARD ───────────────────────────────────────────────
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeModal();
});

// ── BURGER ─────────────────────────────────────────────────
document.getElementById('burger').addEventListener('click', function() {
  this.classList.toggle('open');
  document.getElementById('mobile-menu').classList.toggle('open');
});

// ── START ──────────────────────────────────────────────────
init();
</script>
</body>
</html>