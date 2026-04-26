<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Entreprise BTP – Construire avec confiance et expertise</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: '#1a3a8f',
            'brand-dark': '#122970',
            'brand-light': '#2a52bf',
            accent: '#f0a500',
          },
          fontFamily: {
            heading: ['Montserrat', 'sans-serif'],
            body: ['Open Sans', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Open Sans', sans-serif; }
    h1,h2,h3,h4,nav,button { font-family: 'Montserrat', sans-serif; }

    /* Hero background gradient overlay */
    .hero-overlay {
      background: linear-gradient(to right, rgba(10,30,90,0.72) 0%, rgba(10,30,90,0.30) 60%, transparent 100%);
    }

    /* Checkmark icon */
    .check-icon {
      width: 20px; height: 20px; min-width: 20px;
      background: #1a3a8f;
      border-radius: 50%;
      display: inline-flex; align-items: center; justify-content: center;
    }
    .check-icon::after {
      content: '';
      display: block;
      width: 10px; height: 6px;
      border-left: 2px solid #fff; border-bottom: 2px solid #fff;
      transform: rotate(-45deg) translate(1px, -1px);
    }

    /* Service card hover */
    .service-card:hover { box-shadow: 0 8px 32px rgba(26,58,143,0.13); transform: translateY(-3px); }
    .service-card { transition: all 0.25s; }

    /* Realisation card */
    .real-card { position: relative; overflow: hidden; border-radius: 6px; }
    .real-card img { transition: transform 0.4s; }
    .real-card:hover img { transform: scale(1.06); }
    .real-card .label {
      position: absolute; bottom: 0; left: 0; right: 0;
      background: linear-gradient(to top, rgba(10,30,80,0.85), transparent);
      color: #fff; padding: 24px 14px 12px;
      font-family: 'Montserrat', sans-serif; font-weight: 600; font-size: 13px;
    }

    /* Input style */
    input, textarea {
      border: 1px solid #d1d5db;
      border-radius: 4px;
      padding: 10px 14px;
      font-family: 'Open Sans', sans-serif;
      font-size: 14px;
      width: 100%;
      outline: none;
      background: #fff;
    }
    input:focus, textarea:focus { border-color: #1a3a8f; }

    /* Nav underline active */
    .nav-active { border-bottom: 2px solid #1a3a8f; }

    /* Section separator */
    .section-sep { width: 60px; height: 3px; background: #1a3a8f; margin: 0 auto 18px; border-radius: 2px; }

    /* Smooth scroll */
    html { scroll-behavior: smooth; }

    /* ========== NOUVELLES ANIMATIONS ========== */
    
    /* Animation fade-in-up */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Animation fade-in-left */
    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Animation fade-in-right */
    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Animation scale-in */
    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    /* Animation pour la navbar */
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-100%);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Animation pour les icônes de services */
    @keyframes iconFloat {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    /* Classes d'animation */
    .animate-navbar {
      animation: slideDown 0.6s ease-out;
    }

    .animate-hero {
      animation: scaleIn 0.8s ease-out;
    }

    .animate-fade-up {
      opacity: 0;
      animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fade-left {
      opacity: 0;
      animation: fadeInLeft 0.8s ease-out forwards;
    }

    .animate-fade-right {
      opacity: 0;
      animation: fadeInRight 0.8s ease-out forwards;
    }

    .animate-scale {
      opacity: 0;
      animation: scaleIn 0.6s ease-out forwards;
    }

    /* Delays */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }

    /* Animation sur les cartes au scroll */
    .service-card, .real-card, .footer-section {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .service-card.visible, .real-card.visible, .footer-section.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Animation sur les icônes de services au hover */
    .service-card:hover svg {
      animation: iconFloat 0.5s ease-in-out;
    }

    /* Animation sur les liens du footer */
    footer a {
      transition: all 0.3s ease;
      position: relative;
      display: inline-block;
    }

    footer a:hover {
      transform: translateX(5px);
      color: white;
    }

    /* Animation sur le séparateur */
    .section-sep {
      transition: width 0.4s ease;
    }

    section:hover .section-sep {
      width: 100px;
    }

    /* Animation sur les check icons */
    .check-icon {
      transition: all 0.3s ease;
    }

    .check-icon:hover {
      transform: scale(1.2);
      background: #f0a500;
    }

    /* Animation sur les liens de navigation */
    nav ul li a {
      transition: all 0.3s ease;
      position: relative;
    }

    nav ul li a:not(.nav-active):hover {
      transform: translateY(-2px);
      color: #1a3a8f;
    }

    /* Animation sur le logo */
    .logo-icon {
      transition: all 0.3s ease;
    }

    .logo-icon:hover {
      transform: rotate(5deg) scale(1.05);
    }

   

    /* Animation sur les cartes de réalisation */
    .real-card .label {
      transform: translateY(100%);
      transition: transform 0.4s ease;
    }

    .real-card:hover .label {
      transform: translateY(0);
    }

    /* Animation sur les images de la section présentation */
    .presentation-image {
      transition: all 0.5s ease;
    }

    .presentation-image:hover {
      transform: scale(1.02);
      box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    /* Animation de pulse sur le CTA */
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .cta-button {
      transition: all 0.3s ease;
    }

    .cta-button:hover {
      animation: pulse 0.5s ease-in-out;
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- ======= NAVBAR ======= -->
  <nav class="w-full bg-white shadow-sm sticky top-0 z-50 animate-navbar">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
      <!-- Logo -->
      <div class="flex items-center gap-2 select-none">

<!-- ICON -->
      <div class="w-9 h-9 bg-brand rounded-lg flex items-center justify-center shadow-md logo-icon cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="w-5 h-5 text-white" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 21h18M5 21V10l7-5 7 5v11M9 21V14h6v7" />
        </svg>
      </div>

      <!-- TEXT -->
      <div class="flex items-center">
        <span class="text-brand font-heading font-extrabold text-xl">BTP</span>
        <span class="text-gray-700 font-heading font-semibold text-xl tracking-widest ml-2">ENTREPRISE</span>
      </div>

      </div>
      <!-- Links -->
      <ul class="hidden md:flex items-center gap-8 text-sm font-heading font-semibold text-gray-700">
        <li><a href="/" class="nav-active pb-1 text-brand">Accueil</a></li>
        <li><a href="{{ route('presentations')}}" class="hover:text-brand transition-colors">Présentation</a></li>
        <li><a href="{{ route('realisations')}}" class="hover:text-brand transition-colors">Realisations</a></li>
        <li><a href="{{route('services')}}" class="hover:text-brand transition-colors">Services</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-brand transition-colors">Contact</a></li>
      </ul>
  <!-- CTA + Login -->
<div class="hidden md:flex items-center gap-3">
  
 

  <!-- Devis -->
 

   <!-- Connexion -->
   <a href="{{ route('login') }}"
     class="text-brand border border-brand px-4 py-2 rounded-lg text-sm font-heading font-semibold hover:bg-brand hover:text-white transition-colors">
    Connexion
  </a>
</div>
      
      <!-- Mobile hamburger -->
      <button class="md:hidden text-brand" id="menuBtn">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t px-6 pb-4">
      <ul class="flex flex-col gap-3 pt-3 text-sm font-heading font-semibold text-gray-700">
        <li><a href="/" class="text-brand">Accueil</a></li>
        <li><a href="{{ route('presentations')}}">Présentation</a></li>
        <li><a href="{{ route('realisations') }}">Realisations</a></li>
        <li><a href="{{route('services')}}">Services</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>

        <li>
            <a href="#contact"
                class="inline-block bg-brand text-white px-5 py-2 rounded mt-1 text-center">
                Demander un devis
            </a>
        </li>

        <li>
            <a href="{{ route('login')}}"
                class="inline-block border border-brand text-brand px-5 py-2 rounded mt-1 text-center">
                Connexion
            </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- ======= HERO ======= -->
  <section id="accueil" class="relative min-h-[520px] flex items-center overflow-hidden" style="background:#1a3a8f;">
    <!-- Background image -->
    <div class="absolute inset-0">
      <img
        src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=80"
        alt="Chantier de construction"
        class="w-full h-full object-cover object-center opacity-60"
      />
      <div class="hero-overlay absolute inset-0"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 w-full animate-hero">
      <div class="max-w-xl">
        <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight mb-4 animate-fade-left">
          Construire avec<br>confiance et expertise
        </h1>
        <p class="text-blue-100 text-base md:text-lg mb-8 font-body animate-fade-left delay-200">
          Votre partenaire BTP pour des projets durables.
        </p>
        <div class="flex flex-wrap gap-4 animate-fade-up delay-300">
         
          <a href="{{ route('realisations')}}" class="border-2 border-white text-white font-heading font-semibold text-sm px-6 py-3 rounded hover:bg-white hover:text-brand transition-colors cta-button">
            Nos réalisations
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ======= QUI SOMMES-NOUS ======= -->
  <section id="presentation" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
      <!-- Text -->
      <div class="animate-fade-left">
        <h2 class="text-2xl font-heading font-bold text-brand mb-5">Qui sommes-nous ?</h2>
        <p class="text-gray-600 text-sm leading-relaxed mb-6">
          Une entreprise BTP avec plus de <strong class="text-brand">10 ans d'expérience</strong> dans le secteur.
          Nous réalisons vos projets avec rigueur et expertise.
        </p>
        <ul class="space-y-3">
          <li class="flex items-center gap-3 text-sm text-gray-700 font-semibold animate-fade-up delay-100">
            <span class="check-icon"></span>
            10+ ans d'expérience
          </li>
          <li class="flex items-center gap-3 text-sm text-gray-700 font-semibold animate-fade-up delay-200">
            <span class="check-icon"></span>
            Projets clés en main
          </li>
          <li class="flex items-center gap-3 text-sm text-gray-700 font-semibold animate-fade-up delay-300">
            <span class="check-icon"></span>
            Respect des délais
          </li>
        </ul>
      </div>
      <!-- Image -->
      <div class="rounded-lg overflow-hidden shadow-md presentation-image animate-fade-right">
        <img
          src="https://images.unsplash.com/photo-1531834685032-c34bf0d84c77?w=800&q=80"
          alt="Équipe BTP"
          class="w-full h-64 md:h-72 object-cover"
        />
      </div>
    </div>
  </section>

  <!-- ======= NOS SERVICES ======= -->
  <section id="services" class="py-16 bg-gray-50 border-t border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-10">
        <div class="section-sep"></div>
        <h2 class="text-2xl font-heading font-bold text-brand animate-scale">Nos Services</h2>
      </div>
      <div class="grid md:grid-cols-3 gap-6">

        <!-- Construction -->
        <div class="service-card bg-white rounded-lg border border-gray-200 p-8 flex flex-col items-center text-center cursor-pointer">
          <div class="mb-4">
            <!-- Building icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 21V7a2 2 0 012-2h4V3h6v2h4a2 2 0 012 2v14M9 21V11h6v10M3 21h18"/>
            </svg>
          </div>
          <h3 class="text-brand font-heading font-bold text-base mb-1">Construction</h3>
          <p class="text-gray-500 text-sm">Bâtiments & Infrastructures</p>
        </div>

        <!-- Rénovation -->
        <div class="service-card bg-white rounded-lg border border-gray-200 p-8 flex flex-col items-center text-center cursor-pointer">
          <div class="mb-4">
            <!-- Hammer icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.82m5.84-2.56a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.63 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.82m2.56-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
            </svg>
          </div>
          <h3 class="text-brand font-heading font-bold text-base mb-1">Rénovation</h3>
          <p class="text-gray-500 text-sm">Travaux de Rénovation</p>
        </div>

        <!-- Gestion de Projet -->
        <div class="service-card bg-white rounded-lg border border-gray-200 p-8 flex flex-col items-center text-center cursor-pointer">
          <div class="mb-4">
            <!-- Clipboard icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
          </div>
          <h3 class="text-brand font-heading font-bold text-base mb-1">Gestion de Projet</h3>
          <p class="text-gray-500 text-sm">Suivi & Coordination</p>
        </div>

      </div>
    </div>
  </section>

  <!-- ======= NOS RÉALISATIONS ======= -->

  <section id="realisations" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10">
            <div class="section-sep"></div>
            <h2 class="text-2xl font-heading font-bold text-brand animate-scale">
                Nos Réalisations
            </h2>
        </div>

        @php use Illuminate\Support\Str; @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            @forelse($realisations as $index => $realisation)
                <a href="{{ route('realisations.show', $realisation->id) }}" class="block">
                    <div class="real-card aspect-[4/3] rounded-xl overflow-hidden" style="transition-delay: {{ $index * 0.1 }}s">

                        <img src="{{ asset('storage/' . $realisation->image) }}"
                            alt="{{ $realisation->title }}"
                            class="w-full h-full object-cover"/>

                        <div class="label">
                            {{ Str::limit($realisation->title, 40) }}
                        </div>

                    </div>
                </a>
            @empty
                <p class="col-span-4 text-center text-gray-500">
                    Aucune réalisation disponible.
                </p>
            @endforelse

        </div>
    </div>
</section>

<!-- ======= FOOTER PREMIUM ======= -->
<footer class="bg-brand-dark text-white pt-16 pb-6">

  <!-- TOP FOOTER -->
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-10">

    <!-- BRAND -->
    <div class="footer-section">
      <h3 class="text-xl font-heading font-bold mb-4">
        Entreprise BTP
      </h3>

      <p class="text-blue-300 text-sm leading-relaxed mb-5">
        Spécialistes en construction et rénovation,
        nous réalisons vos projets avec exigence et savoir-faire.
      </p>

      <!-- Social -->
      <div class="flex gap-3">
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer">f</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer">in</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer">ig</div>
      </div>
    </div>

    <!-- NAVIGATION -->
    <div class="footer-section">
      <h4 class="font-heading font-semibold mb-4">Navigation</h4>
      <ul class="space-y-2 text-blue-300 text-sm">
        <li><a href="{{ route('presentations') }}" class="hover:text-white transition">Présentation</a></li>
        <li><a href="{{ route('realisations')}}" class="hover:text-white transition">Réalisations</a></li>
        <li><a href="{{ route('services')}}" class="hover:text-white transition">Services</a></li>
        <li><a href="{{ route('contact')}}" class="hover:text-white transition">Contact</a></li>
      </ul>
    </div>

    <!-- CONTACT -->
    <div class="footer-section">
      <h4 class="font-heading font-semibold mb-4">Contact</h4>
      <ul class="space-y-2 text-blue-300 text-sm">
        <li>📞 {{ $company->phone ?? '' }}</li>
        <li>✉️ {{ $company->email ?? '' }}</li>
        <li>📍 {{ $company->address ?? '' }}</li>
      </ul>
    </div>

   

    <!-- CTA -->
    <div class="footer-section">
      <h4 class="font-heading font-semibold mb-4">Un projet ?</h4>
      <p class="text-blue-300 text-sm mb-4">
        Obtenez un devis gratuit rapidement.
      </p>

      <a href="{{ route('contact') }}"
         class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm px-5 py-2 rounded-md transition cta-button">
        Demander un devis
      </a>
    </div>

  </div>

  <!-- BOTTOM FOOTER -->
  <div class="border-t border-white/10 mt-10 pt-5">
    <div class="max-w-5xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-3 text-blue-400 text-sm text-center">

      <span>© 2026 Entreprise BTP — Tous droits réservés</span>

      <div class="flex items-center gap-4">
        <a href="#" class="hover:text-white transition">Mentions légales</a>
        <span class="hidden md:inline">|</span>
        <a href="#" class="hover:text-white transition">Confidentialité</a>
      </div>

    </div>
  </div>

</footer>

<script>
    // Mobile menu toggle
    document.getElementById('menuBtn').addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.toggle('hidden');
    });

    // Send button handler
    function handleSend() {
      const msg = document.getElementById('successMsg');
      msg.classList.remove('hidden');
      setTimeout(() => msg.classList.add('hidden'), 4000);
    }

    // ========== NOUVEAU: Animation au scroll ==========
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observer les cartes de services
    document.querySelectorAll('.service-card, .real-card, .footer-section').forEach(el => {
      observer.observe(el);
    });

    // Animation supplémentaire pour les titres de section
    const titleObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          titleObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    document.querySelectorAll('h2').forEach(el => {
      if (el.classList.contains('animate-scale')) {
        titleObserver.observe(el);
      }
    });
  </script>
</body>
</html>