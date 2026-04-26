<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Entreprise BTP – Services & Expertise | Construire avec confiance</title>
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

    .hero-overlay {
      background: linear-gradient(to right, rgba(10,30,90,0.72) 0%, rgba(10,30,90,0.30) 60%, transparent 100%);
    }

    .check-icon {
      width: 20px; height: 20px; min-width: 20px;
      background: #1a3a8f;
      border-radius: 50%;
      display: inline-flex; align-items: center; justify-content: center;
      transition: all 0.3s ease;
    }
    .check-icon:hover {
      transform: scale(1.2);
      background: #f0a500;
    }
    .check-icon::after {
      content: '';
      display: block;
      width: 10px; height: 6px;
      border-left: 2px solid #fff; border-bottom: 2px solid #fff;
      transform: rotate(-45deg) translate(1px, -1px);
    }

    .service-card:hover { box-shadow: 0 8px 32px rgba(26,58,143,0.13); transform: translateY(-5px); }
    .service-card { transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); }

    .real-card { position: relative; overflow: hidden; border-radius: 12px; cursor: pointer; }
    .real-card img { transition: transform 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1); width: 100%; height: 100%; object-fit: cover; }
    .real-card:hover img { transform: scale(1.08); }
    .real-card .label {
      position: absolute; bottom: 0; left: 0; right: 0;
      background: linear-gradient(to top, rgba(10,30,80,0.9), transparent);
      color: #fff; padding: 28px 16px 14px;
      font-family: 'Montserrat', sans-serif; font-weight: 600; font-size: 14px;
      transform: translateY(100%);
      transition: transform 0.4s ease;
    }
    .real-card:hover .label { transform: translateY(0); }
    .real-card .overlay-info {
      position: absolute; inset: 0;
      background: rgba(26,58,143,0.75);
      display: flex; flex-direction: column; justify-content: center; align-items: center;
      opacity: 0; transition: opacity 0.3s; padding: 20px; text-align: center;
      color: white; backdrop-filter: blur(3px);
    }
    .real-card:hover .overlay-info { opacity: 1; }
    .filter-btn.active { background-color: #1a3a8f; color: white; border-color: #1a3a8f; }
    .filter-btn { transition: all 0.2s; }
    .stat-badge { background: rgba(26,58,143,0.1); border-radius: 40px; padding: 4px 12px; font-size: 12px; font-weight: 600; color: #1a3a8f; }
    input, textarea, select {
      border: 1px solid #d1d5db; border-radius: 8px; padding: 10px 14px;
      font-family: 'Open Sans', sans-serif; font-size: 14px; width: 100%; outline: none;
      background: #fff; transition: all 0.3s ease;
    }
    input:focus, textarea:focus, select:focus { border-color: #1a3a8f; box-shadow: 0 0 0 2px rgba(26,58,143,0.1); transform: scale(1.02); }
    .nav-active { border-bottom: 2px solid #1a3a8f; color: #1a3a8f !important; }
    .section-sep { width: 60px; height: 3px; background: #1a3a8f; margin: 0 auto 18px; border-radius: 2px; transition: width 0.4s ease; }
    section:hover .section-sep { width: 100px; }
    html { scroll-behavior: smooth; }
    .modal-transition { transition: opacity 0.25s ease, visibility 0.25s; }
    .process-step { position: relative; transition: all 0.3s ease; }
    .process-step:hover { transform: translateY(-5px); }
    .process-step:not(:last-child):after {
      content: ''; position: absolute; top: 40px; right: -30px; width: 60px; height: 2px;
      background: linear-gradient(90deg, #1a3a8f, #cbd5e1); display: none;
    }
    @media (min-width: 1024px) { .process-step:not(:last-child):after { display: block; } }
    .pricing-card { transition: all 0.3s ease; }
    .pricing-card:hover { transform: translateY(-5px); box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1); }

    /* ========== NOUVELLES ANIMATIONS ========== */
    
    /* Keyframes */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes fadeInRight {
      from { opacity: 0; transform: translateX(50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-100%); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes iconFloat {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    @keyframes rotateIn {
      from { opacity: 0; transform: rotate(-10deg) scale(0.9); }
      to { opacity: 1; transform: rotate(0) scale(1); }
    }

    /* Animation classes */
    .animate-navbar { animation: slideDown 0.6s ease-out; }
    .animate-fade-up { opacity: 0; animation: fadeInUp 0.8s ease-out forwards; }
    .animate-fade-left { opacity: 0; animation: fadeInLeft 0.8s ease-out forwards; }
    .animate-fade-right { opacity: 0; animation: fadeInRight 0.8s ease-out forwards; }
    .animate-scale { opacity: 0; animation: scaleIn 0.6s ease-out forwards; }
    .animate-rotate { opacity: 0; animation: rotateIn 0.6s ease-out forwards; }
    
    /* Delays */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
    .delay-600 { animation-delay: 0.6s; }

    /* Scroll animations */
    .service-card, .real-card, .footer-section, .process-step, .pricing-card, .engagement-item {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .service-card.visible, .real-card.visible, .footer-section.visible, 
    .process-step.visible, .pricing-card.visible, .engagement-item.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Hover animations */
    .service-card:hover svg { animation: iconFloat 0.5s ease-in-out; }
    footer a { transition: all 0.3s ease; position: relative; display: inline-block; }
    footer a:hover { transform: translateX(5px); color: white; }
    .logo-icon { transition: all 0.3s ease; cursor: pointer; }
    .logo-icon:hover { transform: rotate(5deg) scale(1.05); }
    
    nav ul li a { transition: all 0.3s ease; position: relative; }
    nav ul li a:not(.nav-active):hover { transform: translateY(-2px); color: #1a3a8f; }
    .cta-button { transition: all 0.3s ease; }
    .cta-button:hover { animation: pulse 0.5s ease-in-out; }
    
    /* Process step circle animation */
    .process-step .w-12.h-12 {
      transition: all 0.3s ease;
    }
    .process-step:hover .w-12.h-12 {
      transform: scale(1.1);
      background: #f0a500;
    }
    
    /* Engagement items */
    .engagement-item {
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .engagement-item:hover {
      transform: translateX(5px);
    }
    .engagement-item:hover svg {
      transform: scale(1.1);
    }
    .engagement-item svg {
      transition: transform 0.3s ease;
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
        <div class="w-9 h-9 bg-brand rounded-lg flex items-center justify-center shadow-md logo-icon">
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
        <li><a href="/" class="pb-1 text-brand">Accueil</a></li>
        <li><a href="{{ route('presentations')}}" class="hover:text-brand transition-colors">Présentation</a></li>
        <li><a href="{{ route('realisations')}}" class="hover:text-brand transition-colors">Realisations</a></li>
        <li><a href="{{ route('services')}}" class="nav-active hover:text-brand transition-colors">Services</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-brand transition-colors">Contact</a></li>
      </ul>
  <!-- CTA + Login -->
<div class="hidden md:flex items-center gap-3">
  
 

  <!-- Devis -->


   <!-- Connexion -->
   <a href="{{ route('login')}}"
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
        <li><a href="{{ route('services') }}">Services</a></li>
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

  <!-- ======= HERO SECTION (Services) ======= -->
  <section id="accueil" class="relative min-h-[450px] flex items-center overflow-hidden" style="background:#1a3a8f;">
    <div class="absolute inset-0">
      <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&q=80" alt="Service BTP" class="w-full h-full object-cover object-center opacity-50" />
      <div class="hero-overlay absolute inset-0"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 w-full">
      <div class="max-w-xl">
        <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight mb-4 animate-fade-left">Nos services & expertises</h1>
        <p class="text-blue-100 text-base md:text-lg mb-8 font-body animate-fade-left delay-200">Des prestations sur mesure, de l'étude initiale à la livraison clé en main. Excellence technique et innovation durable.</p>
        <a href="{{ route('presentations')}}" class="bg-brand text-white font-heading font-semibold text-sm px-6 py-3 rounded transition-colors inline-block ">Découvrir nos prestations</a>
      </div>
    </div>
  </section>

 

  <!-- ==================== SERVICES DÉVELOPPÉS COMPLETS ==================== -->
  <section id="services-detail" class="py-16 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="section-sep"></div>
        <h2 class="text-3xl font-heading font-bold text-brand animate-scale">Nos prestations complètes</h2>
        <p class="text-gray-500 max-w-2xl mx-auto mt-3 animate-fade-up delay-200">Des solutions intégrées pour tous vos besoins en construction, rénovation et pilotage de projets.</p>
      </div>

      <!-- Grille des services détaillés (6 services avec icônes et descriptions approfondies) -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">

@foreach($services as $index => $service)
<div class="service-card bg-white rounded-2xl border border-gray-200 p-7 hover:shadow-xl" style="transition-delay: {{ $index * 0.1 }}s">

    {{-- ICON --}}
    <div class="mb-5">

        @if($index == 0)
        <svg class="w-12 h-12 text-brand transition-all duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21V7a2 2 0 012-2h4V3h6v2h4a2 2 0 012 2v14M9 21V11h6v10M3 21h18"/>
        </svg>

        @elseif($index == 1)
        <svg class="w-12 h-12 text-brand transition-all duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.82m5.84-2.56a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.63 8.41"/>
        </svg>

        @elseif($index == 2)
        <svg class="w-12 h-12 text-brand transition-all duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
        </svg>

        @elseif($index == 3)
        <svg class="w-12 h-12 text-brand transition-all duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8h16M4 16h16M8 4v16M16 4v16"/>
        </svg>

        @elseif($index == 4)
        <svg class="w-12 h-12 text-brand transition-all duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2 7-7 7 7"/>
        </svg>

        @else
        <svg class="w-12 h-12 text-brand transition-all duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        @endif

    </div>

    {{-- TITLE --}}
    <h3 class="text-xl font-heading font-bold text-brand-dark mb-2">
        {{ $service->title }}
    </h3>

    {{-- DESCRIPTION --}}
    <p class="text-gray-500 text-sm mb-4">
        {{ $service->description }}
    </p>

    {{-- LISTE (optionnel si tu n'as pas encore en DB) --}}
    @if(!empty($service->features))
    <ul class="space-y-2 text-sm text-gray-600">
        @foreach($service->features as $feature)
        <li class="flex gap-2">
            <span class="check-icon mt-0.5"></span> {{ $feature }}
        </li>
        @endforeach
    </ul>
    @endif

    {{-- BADGE OPTIONNEL --}}
    @if(!empty($service->badge))
    <div class="mt-5">
        <span class="text-brand font-semibold text-xs bg-brand/10 px-3 py-1 rounded-full transition-all duration-300 hover:bg-brand hover:text-white">
            {{ $service->badge }}
        </span>
    </div>
    @endif

</div>
@endforeach

</div>

      <!-- Processus d'accompagnement (étapes) -->
      <div class="bg-white rounded-2xl shadow-md p-8 mb-16">
        <h3 class="text-2xl font-heading font-bold text-center text-brand-dark mb-10 animate-fade-up">Notre méthodologie : un accompagnement transparent</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
          <div class="process-step text-center"><div class="w-12 h-12 bg-brand text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3 transition-all duration-300">1</div><h4 class="font-heading font-bold">1. Diagnostic & étude</h4><p class="text-xs text-gray-500 mt-1">Analyse technique, chiffrage préliminaire, planning prévisionnel</p></div>
          <div class="process-step text-center"><div class="w-12 h-12 bg-brand text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3 transition-all duration-300">2</div><h4 class="font-heading font-bold">2. Conception & permis</h4><p class="text-xs text-gray-500 mt-1">Dépôt des autorisations, plans détaillés, choix des matériaux</p></div>
          <div class="process-step text-center"><div class="w-12 h-12 bg-brand text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3 transition-all duration-300">3</div><h4 class="font-heading font-bold">3. Réalisation & suivi</h4><p class="text-xs text-gray-500 mt-1">Chantier piloté, reporting hebdomadaire, contrôle qualité</p></div>
          <div class="process-step text-center"><div class="w-12 h-12 bg-brand text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-3 transition-all duration-300">4</div><h4 class="font-heading font-bold">4. Livraison & SAV</h4><p class="text-xs text-gray-500 mt-1">Réception des travaux, garantie décennale, service après-vente</p></div>
        </div>
      </div>


      <!-- Engagements qualité -->
      <div class="bg-brand-dark/5 rounded-2xl p-8 flex flex-wrap justify-between items-center gap-4">
        <div class="engagement-item flex items-center gap-4"><svg class="w-8 h-8 text-brand transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg><div><p class="font-bold">Garantie décennale & assurance RCB</p><p class="text-xs text-gray-500">Protection totale pour vos ouvrages</p></div></div>
        <div class="engagement-item flex items-center gap-4"><svg class="w-8 h-8 text-brand transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><div><p class="font-bold">Respect des délais contractuels</p><p class="text-xs text-gray-500">+98% de livraisons dans les temps</p></div></div>
        <div class="engagement-item flex items-center gap-4"><svg class="w-8 h-8 text-brand transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg><div><p class="font-bold">Matériaux certifiés & éco-responsables</p><p class="text-xs text-gray-500">Engagement RSE & label BREEAM possible</p></div></div>
      </div>
    </div>
  </section>

  <!-- ==================== RÉALISATIONS (Aperçu) ==================== -->
  <section id="realisations" class="py-16 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10">
            <div class="section-sep"></div>
            <h2 class="text-2xl font-heading font-bold text-brand animate-scale">
                Nos réalisations récentes
            </h2>
            <p class="text-gray-500 animate-fade-up delay-200">
                Des projets qui illustrent notre expertise.
            </p>
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

        <div class="text-center mt-8">
            <a href="{{ route('realisations')}}" 
               class="text-brand font-semibold hover:underline transition-all duration-300 hover:translate-x-1 inline-block">
               Voir toutes nos réalisations →
            </a>
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
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">f</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">in</div>
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">ig</div>
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
    document.getElementById('menuBtn')?.addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.toggle('hidden');
    });

    function submitContact() {
      const name = document.getElementById('contactName')?.value;
      if(!name) { alert('Veuillez indiquer votre nom'); return; }
      const successDiv = document.getElementById('contactSuccess');
      successDiv.classList.remove('hidden');
      setTimeout(() => successDiv.classList.add('hidden'), 4000);
      document.getElementById('contactName').value = '';
      document.getElementById('contactEmail').value = '';
      document.getElementById('contactPhone').value = '';
      document.getElementById('serviceSelect').value = '';
      document.getElementById('contactMsg').value = '';
    }
    window.submitContact = submitContact;

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a[href^="#"]');
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(s => { if(window.scrollY >= s.offsetTop - 100) current = s.id; });
      navLinks.forEach(a => { a.classList.remove('nav-active'); if(a.getAttribute('href') === '#' + current) a.classList.add('nav-active'); });
    });

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

    // Observer les éléments à animer
    document.querySelectorAll('.service-card, .real-card, .footer-section, .process-step, .pricing-card, .engagement-item').forEach(el => {
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