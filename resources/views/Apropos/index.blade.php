<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>À Propos – Vision Optique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Nunito', sans-serif; }
    h1, h2, h3, .brand { font-family: 'Nunito', serif; }

    /* Navbar */
    .nav-active { border-bottom: 2px solid #1e3a6e; padding-bottom: 2px; }
    .btn-primary { background-color: #1e3a6e; transition: background-color 0.2s, transform 0.2s; }
    .btn-primary:hover { background-color: #163060; transform: scale(1.03); }

    /* Hero about */
    .about-hero {
      background: linear-gradient(135deg, #1e3a6e 0%, #2c4a7c 50%, #4a90d9 100%);
      position: relative;
      overflow: hidden;
    }
    .about-hero::before {
      content: '';
      position: absolute;
      top: -60px; right: -60px;
      width: 320px; height: 320px;
      border-radius: 50%;
      background: rgba(74,144,217,0.15);
    }
    .about-hero::after {
      content: '';
      position: absolute;
      bottom: -80px; left: -40px;
      width: 240px; height: 240px;
      border-radius: 50%;
      background: rgba(255,255,255,0.06);
    }

    /* Stats */
    .stat-card {
      position: relative;
      overflow: hidden;
    }
    .stat-card::before {
      content: '';
      position: absolute;
      bottom: 0; left: 0;
      width: 100%; height: 3px;
      background: linear-gradient(90deg, #1e3a6e, #4a90d9);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }
    .stat-card:hover::before { transform: scaleX(1); }

    /* Team card */
    .team-card { transition: transform 0.35s ease, box-shadow 0.35s ease; }
    .team-card:hover { transform: translateY(-8px); box-shadow: 0 20px 48px rgba(30,58,110,0.18); }
    .team-img-wrap { overflow: hidden; border-radius: 8px 8px 0 0; }
    .team-img-wrap img { transition: transform 0.5s ease; }
    .team-card:hover .team-img-wrap img { transform: scale(1.06); }

    /* Values icon */
    .value-icon-wrap {
      width: 56px; height: 56px;
      border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      background: #dce8f5;
      flex-shrink: 0;
      transition: background 0.3s;
    }
    .value-item:hover .value-icon-wrap { background: #1e3a6e; }
    .value-item:hover .value-icon-wrap svg { stroke: white; }
    .value-icon-wrap svg { transition: stroke 0.3s; stroke: #1e3a6e; }

    /* Timeline */
    .timeline-line {
      position: absolute;
      left: 50%;
      top: 0; bottom: 0;
      width: 2px;
      background: linear-gradient(to bottom, #dce8f5, #1e3a6e, #dce8f5);
      transform: translateX(-50%);
    }
    .timeline-dot {
      width: 14px; height: 14px;
      border-radius: 50%;
      background: #1e3a6e;
      border: 3px solid #dce8f5;
      flex-shrink: 0;
    }

    /* Scroll reveal */
    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.65s ease, transform 0.65s ease;
    }
    .reveal.visible { opacity: 1; transform: none; }

    /* Burger */
    #mobile-menu { display: none; }
    #mobile-menu.open { display: block; }
    #burger span { transition: transform 0.25s ease, opacity 0.25s ease; display: block; }
    #burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    #burger.open span:nth-child(2) { opacity: 0; }
    #burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* Quote */
    .quote-mark {
      font-size: 5rem;
      line-height: 1;
      color: #dce8f5;
      position: absolute;
      top: -10px; left: 10px;
      pointer-events: none;
    }
  </style>
</head>
<body class="bg-white text-gray-800">

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
        <a href="{{ route('initiatives.index') }}" class="hover:text-[#1e3a6e] transition-colors">Nos Initiatives</a>
        <a href="{{ route('apropos.index') }}" class="nav-active text-[#1e3a6e] font-semibold">À Propos</a>
        
      </nav>

      <div class="flex items-center gap-2 sm:gap-3">
        <a href="{{ route('rdv.index')}}" class="btn-primary text-white text-xs sm:text-sm font-semibold px-3 sm:px-5 py-2 rounded leading-tight text-center">
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
        <a href="{{ route('home')}}" class="hover:text-[#1e3a6e]" onclick="closeMobileMenu()">Accueil</a>
        <a href="{{ route('lunettes.index')}}" class="hover:text-[#1e3a6e]" onclick="closeMobileMenu()">Nos Lunettes</a>
        <a href="{{ route('initiatives.index') }}" class="hover:text-[#1e3a6e]" onclick="closeMobileMenu()">Nos Initiatives</a>
        <a href="{{ route('apropos.index') }}" class="text-[#1e3a6e] font-semibold" onclick="closeMobileMenu()">À Propos</a>
      </nav>
    </div>
  </header>

  <!-- ===== HERO À PROPOS ===== -->
  <section class="about-hero py-16 sm:py-24 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10">
      <div class="max-w-2xl">
        <p class="text-blue-300 text-xs font-semibold uppercase tracking-widest mb-3">Notre histoire</p>
        <h1 class="text-3xl sm:text-5xl font-bold leading-tight mb-5">
          Depuis 1998, au service<br/>
          <span class="italic font-normal text-[#a8c8f0]">de votre vision</span>
        </h1>
        <p class="text-blue-100 text-sm sm:text-base leading-relaxed max-w-xl">
          Fondé par des passionnés d'optique, Vision Optique s'est imposé comme la référence en matière de santé visuelle et de style. Chaque paire de lunettes que nous proposons est le fruit d'une expertise de plus de 25 ans.
        </p>
      </div>
    </div>
    <!-- Decorative glasses SVG -->
    <div class="absolute right-8 bottom-8 opacity-10 hidden lg:block">
      <svg width="180" height="100" viewBox="0 0 200 110" fill="none">
        <rect x="2" y="20" width="80" height="60" rx="30" stroke="white" stroke-width="5"/>
        <rect x="118" y="20" width="80" height="60" rx="30" stroke="white" stroke-width="5"/>
        <line x1="82" y1="50" x2="118" y2="50" stroke="white" stroke-width="5"/>
        <line x1="2" y1="40" x2="0" y2="15" stroke="white" stroke-width="4" stroke-linecap="round"/>
        <line x1="198" y1="40" x2="200" y2="15" stroke="white" stroke-width="4" stroke-linecap="round"/>
      </svg>
    </div>
  </section>

  <!-- ===== STATS ===== -->
  <section class="bg-white border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200">
        <div class="stat-card py-8 px-4 text-center">
          <p class="text-3xl sm:text-4xl font-bold text-[#1e3a6e]">+25</p>
          <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Ans d'expérience</p>
        </div>
        <div class="stat-card py-8 px-4 text-center">
          <p class="text-3xl sm:text-4xl font-bold text-[#1e3a6e]">8 000</p>
          <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Clients satisfaits</p>
        </div>
        <div class="stat-card py-8 px-4 text-center">
          <p class="text-3xl sm:text-4xl font-bold text-[#1e3a6e]">500+</p>
          <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Montures en stock</p>
        </div>
        <div class="stat-card py-8 px-4 text-center">
          <p class="text-3xl sm:text-4xl font-bold text-[#1e3a6e]">3</p>
          <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Opticiens experts</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== NOTRE HISTOIRE ===== -->
  <section class="py-14 sm:py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <div class="flex flex-col md:flex-row gap-10 md:gap-16 items-center">
        <div class="w-full md:w-1/2 reveal">
          <div class="relative">
            <img
              src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=700&q=80"
              alt="Notre boutique"
              class="w-full h-72 object-cover rounded-xl shadow-xl"
            />
            <!-- Badge flottant -->
            <div class="absolute -bottom-5 -right-5 bg-[#1e3a6e] text-white rounded-xl px-5 py-4 shadow-lg hidden sm:block">
              <p class="text-2xl font-bold">1998</p>
              <p class="text-xs text-blue-200">Fondation</p>
            </div>
          </div>
        </div>
        <div class="w-full md:w-1/2 reveal" style="transition-delay:0.15s">
          <p class="text-[#4a90d9] text-xs font-semibold uppercase tracking-widest mb-2">Notre ADN</p>
          <h2 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e] mb-4">Une passion transmise<br/><span class="italic font-normal">de génération en génération</span></h2>
          <p class="text-gray-500 text-sm leading-relaxed mb-4">
            Tout a commencé dans un petit atelier parisien, porté par une conviction simple : chaque regard mérite le meilleur. Aujourd'hui, Vision Optique est bien plus qu'une opticienne — c'est un lieu de confiance où expertise médicale et sens du style se rencontrent.
          </p>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Nous travaillons avec les meilleurs laboratoires verriers d'Europe pour vous offrir des solutions optiques sur-mesure, alliant confort, performance et esthétique.
          </p>
          <div class="relative bg-[#f0f5fb] rounded-lg p-5 pl-8">
            <span class="quote-mark">"</span>
            <p class="font-semibold text-[#1e3a6e] text-sm italic leading-relaxed relative z-10">
              Voir clairement, c'est vivre pleinement. C'est cette philosophie qui guide chacun de nos gestes depuis 25 ans.
            </p>
            <p class="text-xs text-gray-400 mt-2">— Marie Dupont, Fondatrice</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== NOS VALEURS ===== -->
  <section class="py-14 sm:py-20 bg-[#f0f5fb]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-10 reveal">
        <p class="text-[#4a90d9] text-xs font-semibold uppercase tracking-widest mb-2">Ce qui nous définit</p>
        <h2 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e]">Nos Valeurs</h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        <div class="value-item bg-white rounded-xl p-6 flex items-start gap-4 shadow-sm reveal">
          <div class="value-icon-wrap">
            <svg width="26" height="26" viewBox="0 0 32 32" fill="none" stroke="#1e3a6e" stroke-width="1.8" stroke-linecap="round">
              <path d="M16 4C10 4 5 9 5 15c0 4.5 2.5 8.4 6.2 10.4L10 28h12l-1.2-2.6A11 11 0 0 0 27 15c0-6-5-11-11-11z"/>
              <line x1="16" y1="11" x2="16" y2="19"/>
              <line x1="12" y1="15" x2="20" y2="15"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-[#1e3a6e] text-base mb-1">Expertise</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Nos opticiens diplômés se forment continuellement aux dernières innovations en optique médicale et aux nouvelles technologies de correction visuelle.</p>
          </div>
        </div>

        <div class="value-item bg-white rounded-xl p-6 flex items-start gap-4 shadow-sm reveal" style="transition-delay:0.1s">
          <div class="value-icon-wrap">
            <svg width="26" height="26" viewBox="0 0 32 32" fill="none" stroke="#1e3a6e" stroke-width="1.8" stroke-linecap="round">
              <circle cx="16" cy="10" r="5"/>
              <path d="M6 28c0-5.5 4.5-10 10-10s10 4.5 10 10"/>
              <path d="M22 16l2 2 4-4"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-[#1e3a6e] text-base mb-1">Écoute & Conseil</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Chaque patient est unique. Nous prenons le temps de comprendre votre mode de vie, vos habitudes et vos attentes pour vous proposer la solution la plus adaptée.</p>
          </div>
        </div>

        <div class="value-item bg-white rounded-xl p-6 flex items-start gap-4 shadow-sm reveal" style="transition-delay:0.2s">
          <div class="value-icon-wrap">
            <svg width="26" height="26" viewBox="0 0 32 32" fill="none" stroke="#1e3a6e" stroke-width="1.8" stroke-linecap="round">
              <path d="M16 4l3 6 7 1-5 5 1.2 7L16 20l-6.2 3.2L11 16 6 11l7-1z"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-[#1e3a6e] text-base mb-1">Qualité</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Nous sélectionnons rigoureusement nos fournisseurs et nos montures pour vous garantir des produits durables, confortables et esthétiquement raffinés.</p>
          </div>
        </div>

        <div class="value-item bg-white rounded-xl p-6 flex items-start gap-4 shadow-sm reveal" style="transition-delay:0.3s">
          <div class="value-icon-wrap">
            <svg width="26" height="26" viewBox="0 0 32 32" fill="none" stroke="#1e3a6e" stroke-width="1.8" stroke-linecap="round">
              <circle cx="16" cy="16" r="12"/>
              <path d="M12 16l3 3 5-5"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-[#1e3a6e] text-base mb-1">Confiance</h3>
            <p class="text-gray-500 text-sm leading-relaxed">La transparence est au cœur de notre relation avec nos patients : tarifs clairs, conseils honnêtes, et suivi personnalisé dans la durée.</p>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ===== ÉQUIPE ===== -->
  <section class="py-14 sm:py-20 bg-[#f0f5fb]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-10 reveal">
        <p class="text-[#4a90d9] text-xs font-semibold uppercase tracking-widest mb-2">Les visages de Vision Optique</p>
        <h2 class="text-2xl sm:text-3xl font-bold text-[#1e3a6e]">Notre Équipe</h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        <div class="team-card bg-white rounded-xl shadow-sm overflow-hidden reveal">
          <div class="team-img-wrap h-56">
            <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&q=80" alt="Marie Dupont" class="w-full h-full object-cover"/>
          </div>
          <div class="p-5">
            <h3 class="font-bold text-[#1e3a6e] text-base">Marie Dupont</h3>
            <p class="text-[#4a90d9] text-xs font-semibold uppercase tracking-wide mb-2">Fondatrice & Opticienne</p>
            <p class="text-gray-500 text-xs leading-relaxed">Diplômée de l'École d'Optique de Paris, Marie apporte 25 ans d'expertise et une passion indéfectible pour la santé visuelle.</p>
          </div>
        </div>

        <div class="team-card bg-white rounded-xl shadow-sm overflow-hidden reveal" style="transition-delay:0.12s">
          <div class="team-img-wrap h-56">
            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&q=80" alt="Thomas Renard" class="w-full h-full object-cover object-top"/>
          </div>
          <div class="p-5">
            <h3 class="font-bold text-[#1e3a6e] text-base">Thomas Renard</h3>
            <p class="text-[#4a90d9] text-xs font-semibold uppercase tracking-wide mb-2">Opticien – Spécialiste Lentilles</p>
            <p class="text-gray-500 text-xs leading-relaxed">Expert en adaptation de lentilles de contact, Thomas accompagne avec précision et patience chaque nouveau porteur.</p>
          </div>
        </div>

        <div class="team-card bg-white rounded-xl shadow-sm overflow-hidden reveal" style="transition-delay:0.24s">
          <div class="team-img-wrap h-56">
            <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&q=80" alt="Sophie Laurent" class="w-full h-full object-cover"/>
          </div>
          <div class="p-5">
            <h3 class="font-bold text-[#1e3a6e] text-base">Sophie Laurent</h3>
            <p class="text-[#4a90d9] text-xs font-semibold uppercase tracking-wide mb-2">Opticienne – Conseil Style</p>
            <p class="text-gray-500 text-xs leading-relaxed">Avec un œil affûté pour le style et la morphologie, Sophie vous aide à trouver la monture qui vous correspond parfaitement.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== CTA ===== -->
  <section class="bg-[#1e3a6e] py-12 sm:py-16 text-white text-center">
    <div class="max-w-xl mx-auto px-4 sm:px-6 reveal">
      <h2 class="text-xl sm:text-2xl font-bold mb-3">Prenez rendez-vous avec nos experts</h2>
      <p class="text-blue-200 text-sm mb-7">Un examen de vue, un conseil personnalisé, ou simplement l'envie de découvrir nos collections — nous sommes là pour vous.</p>
      <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="index.html#contact" class="inline-block bg-[#4a90d9] hover:bg-[#3a7ac4] text-white px-8 py-3 rounded text-sm font-semibold transition-colors">
          Prendre rendez-vous
        </a>
        <a href="tel:0123456789" class="inline-block border border-white text-white hover:bg-white hover:text-[#1e3a6e] px-8 py-3 rounded text-sm font-semibold transition-colors">
          📞 01 23 45 67 89
        </a>
      </div>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  <footer class="bg-[#163060] text-blue-200 text-xs py-4">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-6 text-center">
      <a href="#" class="hover:text-white transition-colors">Mentions Légales</a>
      <span class="hidden sm:inline">|</span>
      <a href="#" class="hover:text-white transition-colors">Politique de Confidentialité</a>
    </div>
  </footer>

  <script>
    // Burger toggle
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobile-menu');
    burger.addEventListener('click', () => {
      burger.classList.toggle('open');
      mobileMenu.classList.toggle('open');
    });
    function closeMobileMenu() {
      burger.classList.remove('open');
      mobileMenu.classList.remove('open');
    }

    // Scroll reveal
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.08 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
</body>
</html>