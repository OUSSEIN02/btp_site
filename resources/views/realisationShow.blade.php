@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $selectedRealisation->title }} | Entreprise BTP - Réalisation</title>
  <meta name="description" content="{{ Str::limit(strip_tags($selectedRealisation->content), 160) }}">
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

    /* ========== ANIMATIONS ========== */
    
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

    @keyframes zoomIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    /* Animation classes */
    .animate-navbar { animation: slideDown 0.6s ease-out; }
    .animate-fade-up { opacity: 0; animation: fadeInUp 0.8s ease-out forwards; }
    .animate-fade-left { opacity: 0; animation: fadeInLeft 0.8s ease-out forwards; }
    .animate-fade-right { opacity: 0; animation: fadeInRight 0.8s ease-out forwards; }
    .animate-scale { opacity: 0; animation: scaleIn 0.6s ease-out forwards; }
    .animate-zoom { animation: zoomIn 0.5s ease-out; }
    
    /* Delays */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }

    /* Scroll animations */
    .info-card, .gallery-img, .back-btn, .hero-content, .hero-image,
    .description-content, .features-content, .sidebar-card, .partner-card,
    .cta-card, .project-nav {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .info-card.visible, .gallery-img.visible, .back-btn.visible,
    .hero-content.visible, .hero-image.visible, .description-content.visible,
    .features-content.visible, .sidebar-card.visible, .partner-card.visible,
    .cta-card.visible, .project-nav.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Hover animations */
    .back-btn:hover svg { animation: iconFloat 0.5s ease-in-out; }
    .info-card:hover { transform: translateY(-5px) !important; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.02); }
    .gallery-img:hover { transform: scale(1.05); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2); }
    .gallery-img { transition: all 0.3s ease; cursor: pointer; }
    
    .project-nav a:hover svg { animation: iconFloat 0.5s ease-in-out; }
    .cta-button:hover { animation: pulse 0.5s ease-in-out; }
    
    .sidebar-card .border-b { transition: all 0.3s ease; }
    .sidebar-card:hover .border-b { border-color: rgba(255,255,255,0.4); padding-left: 5px; }

    /* Lightbox styles */
    .lightbox {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.95);
      cursor: pointer;
    }
    
    .lightbox.active {
      display: flex !important;
      align-items: center;
      justify-content: center;
    }
    
    .lightbox-img {
      max-width: 90%;
      max-height: 90%;
      object-fit: contain;
      animation: fadeIn 0.3s ease;
      transition: opacity 0.2s ease;
    }
    
    .close-lightbox {
      position: absolute;
      top: 20px;
      right: 40px;
      color: white;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
      cursor: pointer;
      z-index: 10000;
    }
    
    .close-lightbox:hover {
      color: #f0a500;
      transform: scale(1.2);
    }
    
    .lightbox-prev, .lightbox-next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.2);
      color: white;
      padding: 16px;
      cursor: pointer;
      border-radius: 50%;
      transition: all 0.3s ease;
      font-size: 24px;
      font-weight: bold;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10000;
    }
    
    .lightbox-prev:hover, .lightbox-next:hover {
      background: rgba(255, 255, 255, 0.4);
      transform: translateY(-50%) scale(1.1);
    }
    
    .lightbox-prev { left: 20px; }
    .lightbox-next { right: 20px; }
    
    .image-counter {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      background: rgba(0, 0, 0, 0.7);
      color: white;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 14px;
      font-family: 'Montserrat', sans-serif;
      z-index: 10000;
    }

    /* Section separator animation */
    .section-sep {
      width: 60px;
      height: 3px;
      background: #1a3a8f;
      margin: 0 auto 18px;
      border-radius: 2px;
      transition: width 0.4s ease;
    }
    
    section:hover .section-sep { width: 100px; }

    /* Hero background */
    .realisation-hero {
      background: linear-gradient(135deg, #1a3a8f 0%, #0f1f5e 100%);
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
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      background-repeat: repeat;
    }

    html { scroll-behavior: smooth; }

    /* Logo animation */
    .logo-icon { transition: all 0.3s ease; cursor: pointer; }
    .logo-icon:hover { transform: rotate(5deg) scale(1.05); }

    /* Nav link animations */
    nav ul li a { transition: all 0.3s ease; position: relative; }
    nav ul li a:not(.nav-active):hover { transform: translateY(-2px); color: #1a3a8f; }
    .nav-active { border-bottom: 2px solid #1a3a8f; color: #1a3a8f !important; }

    /* Footer link animations */
    footer a { transition: all 0.3s ease; position: relative; display: inline-block; }
    footer a:hover { transform: translateX(5px); color: white; }
  </style>
</head>
<body class="bg-gray-50">

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
        <li><a href="{{ route('realisations')}}" class="text-brand border-b-2 border-brand pb-1">Réalisations</a></li>
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
        <li><a href="{{ route('realisations')}}" class="text-brand">Réalisations</a></li>
        <li><a href="{{ route('services')}}">Services</a></li>
        <li><a href="{{ route('contact')}}">Contact</a></li>
        <li><a href="{{ route('login')}}" class="inline-block border border-brand text-brand px-5 py-2 rounded mt-1 text-center">Connexion</a></li>
      </ul>
    </div>
  </nav>

  <!-- ======= PAGE SPÉCIFIQUE DE LA RÉALISATION ======= -->
  
  <!-- Hero Section -->
  <div class="realisation-hero relative py-16 md:py-24">
    <div class="max-w-6xl mx-auto px-6 relative z-10">
      <a href="{{ route('realisations') }}" class="back-btn text-white/80 hover:text-white mb-8 inline-flex items-center gap-2 text-sm font-medium">
        <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Retour à toutes nos réalisations
      </a>
      
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="hero-content">
          <div class="flex flex-wrap gap-2 mb-4 animate-fade-up delay-100">
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
              {{ $selectedRealisation->category ?? 'Réalisation' }}
            </span>
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
              {{ $selectedRealisation->status ?? 'Projet terminé' }}
            </span>
          </div>
          <h1 class="text-2xl md:text-2xl lg:text-3xl font-heading font-bold text-white leading-tight mb-4 animate-fade-up delay-200">
            {{ $selectedRealisation->title }}
          </h1>
          <div class="flex flex-wrap gap-4 text-white/80 text-sm mb-6 animate-fade-up delay-300">
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              {{ $selectedRealisation->created_at->format('d F Y') }}
            </span>
            @if(isset($selectedRealisation->location))
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              {{ $selectedRealisation->location }}
            </span>
            @endif
            @if(isset($selectedRealisation->client))
            <span class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
              {{ $selectedRealisation->client }}
            </span>
            @endif
          </div>
        </div>
        <div class="relative hero-image">
          <div class="absolute -inset-4 bg-gradient-to-r from-brand-light to-brand rounded-2xl blur-2xl opacity-30 animate-pulse"></div>
          <img src="{{ asset('storage/' . $selectedRealisation->image) }}" 
               alt="{{ $selectedRealisation->title }}"
               class="relative rounded-2xl shadow-2xl w-full object-cover max-h-[400px] transition-transform duration-500 hover:scale-105">
        </div>
      </div>
    </div>
  </div>

  <!-- Contenu principal -->
  <div class="max-w-6xl mx-auto px-6 py-16">
    <div class="grid lg:grid-cols-3 gap-8">
      
      <!-- Colonne de gauche -->
      <div class="lg:col-span-2 space-y-8">
        <!-- Description -->
        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 description-content">
          <h2 class="text-2xl font-heading font-bold text-brand-dark mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-brand animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            À propos du projet
          </h2>
          <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
            {!! nl2br(e($selectedRealisation->content)) !!}
          </div>
        </div>

        <!-- Caractéristiques techniques -->
        @if(isset($selectedRealisation->features) && count($selectedRealisation->features) > 0)
        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 features-content">
          <h3 class="text-xl font-heading font-bold text-brand-dark mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand animate-spin" style="animation-duration: 3s;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Caractéristiques techniques
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($selectedRealisation->features as $index => $feature)
            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg transition-all duration-300 hover:translate-x-1 hover:bg-gray-100" style="animation: fadeInUp 0.5s ease-out {{ $index * 0.1 }}s both">
              <svg class="w-5 h-5 text-brand mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span class="text-gray-700 text-sm">{{ $feature }}</span>
            </div>
            @endforeach
          </div>
        </div>
        @endif

        <!-- Galerie d'images -->
        @php
            $additionalImages = is_string($selectedRealisation->additional_images) 
                ? json_decode($selectedRealisation->additional_images, true) 
                : $selectedRealisation->additional_images;
            
            $validImages = [];
            if(!empty($additionalImages) && is_array($additionalImages)) {
                foreach($additionalImages as $image) {
                    if($image && Illuminate\Support\Facades\Storage::disk('public')->exists($image)) {
                        $validImages[] = asset('storage/' . $image);
                    }
                }
            }
        @endphp

        @if(!empty($validImages) && count($validImages) > 0)
        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8">
          <h3 class="text-xl font-heading font-bold text-brand-dark mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Galerie photos
            <span class="text-sm text-gray-500 font-normal ml-2">
              ({{ count($validImages) }} photo(s))
            </span>
          </h3>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="galleryContainer">
            @foreach($validImages as $index => $imageUrl)
                <div class="relative group cursor-pointer" style="--index: {{ $index }}" onclick="openLightbox({{ $index }})">
                  <img src="{{ $imageUrl }}" 
                       alt="Image {{ $index + 1 }} de {{ $selectedRealisation->title }}"
                       class="gallery-img rounded-lg w-full h-40 object-cover shadow-md">
                  <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                    </svg>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8">
          <h3 class="text-xl font-heading font-bold text-brand-dark mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Galerie photos
          </h3>
          <div class="text-center py-8 text-gray-500">
            <svg class="w-16 h-16 mx-auto mb-3 text-gray-300 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p>Aucune image supplémentaire pour ce projet</p>
          </div>
        </div>
        @endif
      </div>

      <!-- Colonne de droite - Sidebar -->
      <div class="lg:col-span-1 space-y-6">
        <!-- Carte des infos clés -->
        <div class="bg-gradient-to-br from-brand to-brand-dark rounded-2xl shadow-lg p-6 text-white sidebar-card">
          <h3 class="text-xl font-heading font-bold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 animate-spin" style="animation-duration: 3s;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Informations clés
          </h3>
          <div class="space-y-4">
            <div class="border-b border-white/20 pb-3 transition-all duration-300 hover:border-white/40 hover:pl-2">
              <span class="text-white/70 text-sm block mb-1">📅 Année de réalisation</span>
              <p class="font-semibold">{{ $selectedRealisation->created_at->format('Y') }}</p>
            </div>
            @if(isset($selectedRealisation->surface))
            <div class="border-b border-white/20 pb-3 transition-all duration-300 hover:border-white/40 hover:pl-2">
              <span class="text-white/70 text-sm block mb-1">📐 Surface</span>
              <p class="font-semibold">{{ $selectedRealisation->surface }} m²</p>
            </div>
            @endif
            @if(isset($selectedRealisation->duration))
            <div class="border-b border-white/20 pb-3 transition-all duration-300 hover:border-white/40 hover:pl-2">
              <span class="text-white/70 text-sm block mb-1">⏱️ Durée du chantier</span>
              <p class="font-semibold">{{ $selectedRealisation->duration }}</p>
            </div>
            @endif
            @if(isset($selectedRealisation->budget))
            <div class="border-b border-white/20 pb-3 transition-all duration-300 hover:border-white/40 hover:pl-2">
              <span class="text-white/70 text-sm block mb-1">💰 Budget</span>
              <p class="font-semibold">{{ $selectedRealisation->budget }}</p>
            </div>
            @endif
            <div class="transition-all duration-300 hover:pl-2">
              <span class="text-white/70 text-sm block mb-1">🏷️ Catégorie</span>
              <p class="font-semibold">{{ $selectedRealisation->category ?? 'Construction' }}</p>
            </div>
          </div>
        </div>

        <!-- Carte des partenaires -->
        @if(isset($selectedRealisation->partners) && count($selectedRealisation->partners) > 0)
        <div class="bg-white rounded-2xl shadow-sm p-6 partner-card">
          <h4 class="font-heading font-bold text-brand-dark mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Partenaires
          </h4>
          <div class="flex flex-wrap gap-2">
            @foreach($selectedRealisation->partners as $partner)
            <span class="bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full transition-all duration-300 hover:bg-brand hover:text-white hover:scale-105 cursor-default">{{ $partner }}</span>
            @endforeach
          </div>
        </div>
        @endif

        <!-- Call to action -->
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center border-2 border-brand/20 cta-card transition-all duration-300 hover:shadow-xl">
          <div class="w-16 h-16 bg-brand/10 rounded-full flex items-center justify-center mx-auto mb-4 transition-all duration-300 group-hover:scale-110">
            <svg class="w-8 h-8 text-brand animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h4 class="font-heading font-bold text-brand-dark mb-2">Vous avez un projet similaire ?</h4>
          <p class="text-sm text-gray-600 mb-4">
            Contactez-nous pour discuter de votre projet et obtenir un devis personnalisé.
          </p>
          <a href="{{ route('contact') }}" 
             class="inline-block bg-brand text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-dark transition-all duration-300 w-full cta-button">
            Demander un devis
          </a>
        </div>
      </div>
    </div>

    <!-- Navigation entre projets -->
    <div class="mt-12 pt-8 border-t border-gray-200 project-nav">
      <div class="flex justify-between items-center">
        @if($previousRealisation)
        <a href="{{ route('realisations.show', $previousRealisation->id) }}" 
           class="flex items-center gap-2 text-brand hover:text-brand-dark transition-all duration-300 group hover:translate-x-[-5px]">
          <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          <span class="text-sm font-medium">Projet précédent</span>
        </a>
        @else
        <div></div>
        @endif
        
        <a href="{{ route('realisations') }}" class="text-gray-500 hover:text-brand transition-all duration-300 hover:translate-x-1 text-sm font-medium">
          Voir tous les projets
        </a>
        
        @if($nextRealisation)
        <a href="{{ route('realisations.show', $nextRealisation->id) }}" 
           class="flex items-center gap-2 text-brand hover:text-brand-dark transition-all duration-300 group hover:translate-x-[5px]">
          <span class="text-sm font-medium">Projet suivant</span>
          <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
        @else
        <div></div>
        @endif
      </div>
    </div>
  </div>

  <!-- Lightbox pour la galerie avec navigation -->
  <div id="lightbox" class="lightbox" onclick="closeLightboxOnBackground(event)">
    <span class="close-lightbox" onclick="closeLightbox()">&times;</span>
    <div class="lightbox-prev" onclick="previousImage(event)">&#10094;</div>
    <div class="lightbox-next" onclick="nextImage(event)">&#10095;</div>
    <img id="lightbox-img" class="lightbox-img" src="" alt="Agrandissement">
    <div id="image-counter" class="image-counter"></div>
  </div>

  <!-- ======= FOOTER ======= -->
  <footer class="bg-brand-dark text-white pt-16 pb-6">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-10">
      <div class="footer-section">
        <h3 class="text-xl font-heading font-bold mb-4">Entreprise BTP</h3>
        <p class="text-blue-300 text-sm leading-relaxed mb-5">
          Spécialistes en construction et rénovation,
          nous réalisons vos projets avec exigence et savoir-faire.
        </p>
        <div class="flex gap-3">
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">f</div>
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">in</div>
          <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">ig</div>
        </div>
      </div>

      <div class="footer-section">
        <h4 class="font-heading font-semibold mb-4">Navigation</h4>
        <ul class="space-y-2 text-blue-300 text-sm">
          <li><a href="{{ route('presentations') }}" class="hover:text-white transition">Présentation</a></li>
          <li><a href="{{ route('realisations')}}" class="hover:text-white transition">Réalisations</a></li>
          <li><a href="{{ route('services')}}" class="hover:text-white transition">Services</a></li>
          <li><a href="{{ route('contact')}}" class="hover:text-white transition">Contact</a></li>
        </ul>
      </div>

      <div class="footer-section">
        <h4 class="font-heading font-semibold mb-4">Contact</h4>
        <ul class="space-y-2 text-blue-300 text-sm">
          <li>📞 {{ $company->phone ?? '' }}</li>
          <li>✉️ {{ $company->email ?? '' }}</li>
          <li>📍 {{ $company->address ?? '' }}</li>
        </ul>
      </div>

      <div class="footer-section">
        <h4 class="font-heading font-semibold mb-4">Un projet ?</h4>
        <p class="text-blue-300 text-sm mb-4">
          Obtenez un devis gratuit rapidement.
        </p>
        <a href="{{ route('contact') }}"
           class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm px-5 py-2 rounded-md transition-all duration-300 cta-button hover:scale-105">
          Demander un devis
        </a>
      </div>
    </div>

    <div class="border-t border-white/10 mt-10 pt-5">
      <div class="max-w-5xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-3 text-blue-400 text-sm text-center">
        <span>© 2026 Entreprise BTP — Tous droits réservés</span>
        <div class="flex items-center gap-4">
          <a href="#" class="hover:text-white transition-all duration-300 hover:translate-x-1">Mentions légales</a>
          <span class="hidden md:inline">|</span>
          <a href="#" class="hover:text-white transition-all duration-300 hover:translate-x-1">Confidentialité</a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Variables globales pour la lightbox
    let galleryImages = [];
    let currentImageIndex = 0;
    
    // Initialisation des images de la galerie
    @if(!empty($validImages) && count($validImages) > 0)
        galleryImages = @json($validImages);
        console.log('Images chargées:', galleryImages.length);
    @endif
    
    // Mobile menu
    document.getElementById('menuBtn')?.addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.toggle('hidden');
    });

    // Lightbox functions
    function openLightbox(index) {
        console.log('Ouverture lightbox, index:', index);
        
        if(!galleryImages || galleryImages.length === 0) {
            console.error('Aucune image disponible dans la galerie');
            alert('Erreur : Aucune image disponible');
            return;
        }
        
        if(index < 0 || index >= galleryImages.length) {
            console.error('Index invalide:', index);
            return;
        }
        
        currentImageIndex = index;
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const counter = document.getElementById('image-counter');
        
        if(!lightbox || !lightboxImg) {
            console.error('Éléments lightbox non trouvés');
            return;
        }
        
        // Afficher la lightbox
        lightbox.classList.add('active');
        lightboxImg.src = galleryImages[currentImageIndex];
        
        // Mettre à jour le compteur
        if(counter) {
            counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
        }
        
        // Désactiver le scroll de la page
        document.body.style.overflow = 'hidden';
        
        // Ajouter les événements clavier
        document.addEventListener('keydown', handleKeyPress);
    }
    
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        if(lightbox) {
            lightbox.classList.remove('active');
        }
        document.body.style.overflow = '';
        document.removeEventListener('keydown', handleKeyPress);
    }
    
    function closeLightboxOnBackground(event) {
        if(event.target === document.getElementById('lightbox')) {
            closeLightbox();
        }
    }
    
    function nextImage(event) {
        if(event) {
            event.stopPropagation();
        }
        
        if(!galleryImages || galleryImages.length === 0) return;
        
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        const lightboxImg = document.getElementById('lightbox-img');
        const counter = document.getElementById('image-counter');
        
        if(lightboxImg) {
            lightboxImg.style.opacity = '0';
            setTimeout(() => {
                lightboxImg.src = galleryImages[currentImageIndex];
                lightboxImg.style.opacity = '1';
                if(counter) {
                    counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
                }
            }, 200);
        }
    }
    
    function previousImage(event) {
        if(event) {
            event.stopPropagation();
        }
        
        if(!galleryImages || galleryImages.length === 0) return;
        
        currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        const lightboxImg = document.getElementById('lightbox-img');
        const counter = document.getElementById('image-counter');
        
        if(lightboxImg) {
            lightboxImg.style.opacity = '0';
            setTimeout(() => {
                lightboxImg.src = galleryImages[currentImageIndex];
                lightboxImg.style.opacity = '1';
                if(counter) {
                    counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
                }
            }, 200);
        }
    }
    
    function handleKeyPress(event) {
        switch(event.key) {
            case 'ArrowLeft':
                previousImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
            case 'Escape':
                closeLightbox();
                break;
        }
    }
    
    // ========== ANIMATION AU SCROLL ==========
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
    document.querySelectorAll('.info-card, .gallery-img, .back-btn, .hero-content, .hero-image, .description-content, .features-content, .sidebar-card, .partner-card, .cta-card, .project-nav').forEach(el => {
        observer.observe(el);
    });
    
    // Vérification que la lightbox est bien initialisée
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Page chargée, nombre d\'images dans la galerie:', galleryImages.length);
        if(galleryImages.length === 0) {
            console.warn('Aucune image trouvée dans la galerie');
        }
    });
  </script>
</body>
</html>