@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Entreprise BTP – Nos Réalisations | Construire avec confiance et expertise</title>
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

    .real-card {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }
    .real-card img { 
      transition: transform 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1); 
      width: 100%; 
      height: 100%; 
      object-fit: cover; 
    }
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
      background: rgba(26,58,143,0.85);
      display: flex; flex-direction: column; justify-content: center; align-items: center;
      opacity: 0; transition: opacity 0.3s; padding: 20px; text-align: center;
      color: white;
    }
    .real-card:hover .overlay-info { opacity: 1; }

    /* Page réalisation spécifique */
    .realisation-page {
      background: #f9fafb;
    }
    .realisation-hero {
      background: linear-gradient(135deg, #1a3a8f 0%, #122970 100%);
      position: relative;
      overflow: hidden;
    }
    .realisation-hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.1"><path fill="white" d="M10,10 L20,10 L20,20 L10,20 Z M30,30 L40,30 L40,40 L30,40 Z M50,50 L60,50 L60,60 L50,60 Z"/></svg>') repeat;
    }
    .realisation-content {
      max-width: 1200px;
      margin: 0 auto;
    }
    .back-btn {
      transition: all 0.3s ease;
    }
    .back-btn:hover {
      transform: translateX(-5px);
    }

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

    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
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
    .real-card, .footer-section, .stat-card, .testimonial-card, .gallery-item {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .real-card.visible, .footer-section.visible, .stat-card.visible, 
    .testimonial-card.visible, .gallery-item.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Hover animations */
    .real-card:hover svg { animation: iconFloat 0.5s ease-in-out; }
    footer a { transition: all 0.3s ease; position: relative; display: inline-block; }
    footer a:hover { transform: translateX(5px); color: white; }
    .logo-icon { transition: all 0.3s ease; cursor: pointer; }
    .logo-icon:hover { transform: rotate(5deg) scale(1.05); }
  
    nav ul li a { transition: all 0.3s ease; position: relative; }
    nav ul li a:not(.text-brand):hover { transform: translateY(-2px); color: #1a3a8f; }
    .cta-button { transition: all 0.3s ease; }
    .cta-button:hover { animation: pulse 0.5s ease-in-out; }
    .stat-card { transition: all 0.3s ease; cursor: pointer; }
    .stat-card:hover { transform: translateY(-5px) scale(1.02); background: white; }
    .section-sep { width: 60px; height: 3px; background: #1a3a8f; margin: 0 auto 18px; border-radius: 2px; transition: width 0.4s ease; }
    section:hover .section-sep { width: 100px; }

    /* Animation sur les images de galerie */
    .gallery-img {
      transition: all 0.3s ease;
    }
    .gallery-img:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* Animation sur le bouton de retour */
    .back-btn svg {
      transition: transform 0.3s ease;
    }
    .back-btn:hover svg {
      transform: translateX(-5px);
    }

    /* Animation sur le contenu texte */
    .prose-content {
      transition: all 0.3s ease;
    }
    .prose-content:hover {
      transform: translateY(-2px);
    }

    /* Section separator style */
    .section-sep {
      width: 60px;
      height: 3px;
      background: #1a3a8f;
      margin: 0 auto 18px;
      border-radius: 2px;
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- ======= NAVBAR ======= -->
  <nav class="w-full bg-white shadow-sm sticky top-0 z-50 animate-navbar">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
      <div class="flex items-center gap-2 select-none">
        <div class="w-9 h-9 bg-brand rounded-lg flex items-center justify-center shadow-md logo-icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M5 21V10l7-5 7 5v11M9 21V14h6v7" />
          </svg>
        </div>
        <div class="flex items-center">
          <span class="text-brand font-heading font-extrabold text-xl">BTP</span>
          <span class="text-gray-700 font-heading font-semibold text-xl tracking-widest ml-2">ENTREPRISE</span>
        </div>
      </div>
      <ul class="hidden md:flex items-center gap-8 text-sm font-heading font-semibold text-gray-700">
        <li><a href="/" class="hover:text-brand transition-colors">Accueil</a></li>
        <li><a href="{{ route('presentations') }}" class="hover:text-brand transition-colors">Présentation</a></li>
        <li><a href="{{ route('realisations')}}" class="text-brand border-b-2 border-brand pb-1">Realisations</a></li>
        <li><a href="{{ route('services')}}" class="hover:text-brand transition-colors">Services</a></li>
        <li><a href="{{ route('contact')}}" class="hover:text-brand transition-colors">Contact</a></li>
      </ul>
      <div class="hidden md:flex items-center gap-3">
        <a href="{{ route('login')}}" class="text-brand border border-brand px-4 py-2 rounded-lg text-sm font-heading font-semibold hover:bg-brand hover:text-white transition-colors">
          Connexion
        </a>
      </div>
      <button class="md:hidden text-brand" id="menuBtn">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t px-6 pb-4">
      <ul class="flex flex-col gap-3 pt-3 text-sm font-heading font-semibold text-gray-700">
        <li><a href="/">Accueil</a></li>
        <li><a href="{{ route('presentations')}}">Présentation</a></li>
        <li><a href="{{ route('realisations')}}" class="text-brand">Realisations</a></li>
        <li><a href="{{ route('services')}}">Services</a></li>
        <li><a href="{{ route('contact')}}">Contact</a></li>
        <li><a href="{{ route('login')}}" class="inline-block border border-brand text-brand px-5 py-2 rounded mt-1 text-center">Connexion</a></li>
      </ul>
    </div>
  </nav>

  <!-- ======= PAGE SPÉCIFIQUE DE RÉALISATION ======= -->
  @if(isset($selectedRealisation))
  <div class="realisation-page">
    <!-- Hero section -->
    <div class="realisation-hero relative py-20">
      <div class="max-w-6xl mx-auto px-6 relative z-10">
        <a href="{{ route('realisations') }}" class="back-btn inline-flex items-center text-white/80 hover:text-white mb-8 transition-colors">
          <svg class="w-5 h-5 mr-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Retour aux réalisations
        </a>
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div class="animate-fade-left">
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-sm px-4 py-2 rounded-full mb-4 animate-scale delay-200">
              {{ $selectedRealisation->category ?? 'Réalisation' }}
            </span>
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-white mb-4 animate-fade-up delay-300">
              {{ $selectedRealisation->title }}
            </h1>
            <div class="flex flex-wrap gap-4 text-white/90 text-sm mb-6">
              <span class="flex items-center animate-fade-up delay-400">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $selectedRealisation->created_at->format('d F Y') }}
              </span>
              <span class="flex items-center animate-fade-up delay-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ $selectedRealisation->location ?? 'France' }}
              </span>
            </div>
          </div>
          <div class="relative animate-fade-right">
            <div class="absolute inset-0 bg-gradient-to-r from-brand to-brand-light rounded-2xl blur-2xl opacity-30 animate-pulse"></div>
            <img src="{{ asset('storage/' . $selectedRealisation->image) }}" 
                 alt="{{ $selectedRealisation->title }}"
                 class="relative rounded-2xl shadow-2xl w-full object-cover max-h-96 transition-transform duration-500 hover:scale-105">
          </div>
        </div>
      </div>
    </div>

    <!-- Contenu principal -->
    <div class="max-w-6xl mx-auto px-6 py-16">
      <div class="grid lg:grid-cols-3 gap-12">
        <!-- Contenu texte -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-2xl shadow-sm p-8 mb-8 transition-all duration-300 hover:shadow-md">
            <h2 class="text-2xl font-heading font-bold text-brand-dark mb-6 animate-fade-up">À propos du projet</h2>
            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed prose-content animate-fade-up delay-200">
              {!! nl2br(e($selectedRealisation->content)) !!}
            </div>
          </div>

          <!-- Galerie supplémentaire (optionnelle) -->
          @if(isset($selectedRealisation->gallery) && count($selectedRealisation->gallery) > 0)
          <div class="bg-white rounded-2xl shadow-sm p-8">
            <h3 class="text-xl font-heading font-bold text-brand-dark mb-6 animate-fade-up">Galerie photos</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
              @foreach($selectedRealisation->gallery as $index => $image)
              <img src="{{ asset('storage/' . $image) }}" 
                   alt="Galerie {{ $selectedRealisation->title }}"
                   class="gallery-img rounded-lg w-full h-48 object-cover cursor-pointer hover:opacity-90 transition gallery-item"
                   style="transition-delay: {{ $index * 0.1 }}s">
              @endforeach
            </div>
          </div>
          @endif
        </div>

        <!-- Sidebar informations -->
        <div class="lg:col-span-1">
          <div class="bg-gradient-to-br from-brand to-brand-dark rounded-2xl shadow-sm p-6 text-white mb-6 animate-fade-right">
            <h3 class="text-xl font-heading font-bold mb-4">Informations clés</h3>
            <div class="space-y-4">
              <div class="animate-fade-up delay-100">
                <span class="text-white/70 text-sm">Statut</span>
                <p class="font-semibold">Terminé</p>
              </div>
              <div class="animate-fade-up delay-200">
                <span class="text-white/70 text-sm">Année</span>
                <p class="font-semibold">{{ $selectedRealisation->created_at->format('Y') }}</p>
              </div>
              <div class="animate-fade-up delay-300">
                <span class="text-white/70 text-sm">Catégorie</span>
                <p class="font-semibold">{{ $selectedRealisation->category ?? 'Construction' }}</p>
              </div>
            </div>
          </div>

          <!-- Call to action -->
          <div class="bg-white rounded-2xl shadow-sm p-6 text-center animate-fade-up delay-400">
            <h4 class="font-heading font-bold text-brand-dark mb-3">Projet similaire ?</h4>
            <p class="text-sm text-gray-600 mb-4">
              Contactez-nous pour concrétiser vos idées
            </p>
            <a href="{{ route('contact') }}" 
               class="inline-block bg-brand text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-dark transition-all duration-300 hover:scale-105 w-full">
              Demander un devis
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  @else
  <!-- ======= LISTE DES RÉALISATIONS ======= -->
  <section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-6">
      <div class="text-center mb-8">
        <div class="section-sep"></div>
        <h2 class="text-2xl font-heading font-bold text-brand animate-scale">
          Nos réalisations phares
        </h2>
        <p class="text-gray-500 text-sm max-w-xl mx-auto mt-2 animate-fade-up delay-200">
          Cliquez sur une réalisation pour voir les détails complets
        </p>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" >
        @forelse($realisations as $index => $realisation)
          <a href="{{ route('realisations.show', $realisation->id) }}" class="block no-underline">
            <div class="real-card group rounded-xl bg-white hover:shadow-xl transition-all duration-300" style="transition-delay: {{ $index * 0.1 }}s ; border:2px solid  #1a3a8f;">
              <div class="relative h-56 overflow-hidden rounded-t-xl">
                <img src="{{ asset('storage/' . $realisation->image) }}" 
                     alt="{{ $realisation->title }}" 
                     class="w-full h-full object-cover">
                <div class="overlay-info rounded-t-xl">
                  <svg class="w-12 h-12 mb-3 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                  <span class="text-white font-semibold text-base">Voir les détails</span>
                </div>
              </div>
              <div class="p-5">
                <h3 class="font-heading font-bold text-lg text-brand-dark mb-2">
                  {{ Str::limit($realisation->title, 45) }}
                </h3>
                <p class="text-xs text-gray-400 mb-3 flex items-center">
                  <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  {{ $realisation->created_at->format('d M Y') }}
                </p>
                <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">
                  {{ Str::limit($realisation->content, 80) }}
                </p>
                <div class="mt-4 flex items-center text-brand text-sm font-semibold group-hover:text-brand-dark transition">
                  Lire la suite
                  <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </div>
          </a>
        @empty
          <p class="text-center col-span-3 text-gray-500 text-sm py-12">
            Aucune réalisation disponible pour le moment.
          </p>
        @endforelse
      </div>

      @if($realisations->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $realisations->links('utils.simple-tailwind') }}
        </div>
      @endif


      <!-- Statistiques -->
      <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-5 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <div class="stat-card text-center cursor-pointer p-4 rounded-xl transition-all"><div class="text-brand text-3xl font-extrabold animate-scale">150+</div><div class="text-xs text-gray-500 uppercase">Projets réalisés</div></div>
        <div class="stat-card text-center cursor-pointer p-4 rounded-xl transition-all"><div class="text-brand text-3xl font-extrabold animate-scale delay-100">98%</div><div class="text-xs text-gray-500 uppercase">Clients satisfaits</div></div>
        <div class="stat-card text-center cursor-pointer p-4 rounded-xl transition-all"><div class="text-brand text-3xl font-extrabold animate-scale delay-200">12</div><div class="text-xs text-gray-500 uppercase">Années d'innovation</div></div>
        <div class="stat-card text-center cursor-pointer p-4 rounded-xl transition-all"><div class="text-brand text-3xl font-extrabold animate-scale delay-300">35</div><div class="text-xs text-gray-500 uppercase">Experts dédiés</div></div>
      </div>

      <!-- Témoignages + appel à l'action -->
      <div class="mt-16 bg-brand/5 rounded-2xl p-8 md:p-10 flex flex-col md:flex-row justify-between items-center gap-6 transition-all duration-300 hover:shadow-lg">
        <div class="animate-fade-left"><h3 class="text-xl font-heading font-bold text-brand-dark">Vous avez un projet similaire ?</h3><p class="text-gray-600 text-sm mt-1">Inspirez-vous de nos réalisations et contactez-nous pour concrétiser vos idées.</p></div>
        <a href="{{ route('contact') }}" class="bg-brand text-white px-6 py-3 rounded-lg font-heading font-semibold hover:bg-brand-dark transition-all duration-300 hover:scale-105 shadow-md cta-button">Demander un devis personnalisé →</a>
      </div>
    </div>
  </section>
  @endif

  <!-- ======= FOOTER ======= -->
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
    // Mobile menu
    document.getElementById('menuBtn')?.addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.toggle('hidden');
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
    document.querySelectorAll('.real-card, .footer-section, .stat-card, .gallery-item').forEach(el => {
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