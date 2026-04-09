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
    
    .back-btn {
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
    }
    
    .back-btn:hover {
      transform: translateX(-5px);
    }
    
    .info-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
    }
    
    .gallery-img {
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .gallery-img:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
    }
    
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
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .lightbox-img {
      max-width: 90%;
      max-height: 90%;
      object-fit: contain;
      animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    
    .close-lightbox {
      position: absolute;
      top: 20px;
      right: 40px;
      color: white;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }
    
    .close-lightbox:hover {
      color: #f0a500;
      transform: scale(1.2);
    }
    
    .nav-active {
      border-bottom: 2px solid #1a3a8f;
      color: #1a3a8f !important;
    }
    
    .section-sep {
      width: 60px;
      height: 3px;
      background: #1a3a8f;
      margin: 0 auto 18px;
      border-radius: 2px;
    }
    
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="bg-gray-50">

  <!-- ======= NAVBAR ======= -->
  <nav class="w-full bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
      <div class="flex items-center gap-2 select-none">
        <div class="w-9 h-9 bg-brand rounded-lg flex items-center justify-center shadow-md">
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
  
  <!-- Hero Section avec l'image principale -->
  <div class="realisation-hero relative py-16 md:py-24">
    <div class="max-w-6xl mx-auto px-6 relative z-10">
      <a href="{{ route('realisations') }}" class="back-btn text-white/80 hover:text-white mb-8 inline-flex items-center gap-2 text-sm font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Retour à toutes nos réalisations
      </a>
      
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
          <div class="flex flex-wrap gap-2 mb-4">
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
              {{ $selectedRealisation->category ?? 'Réalisation' }}
            </span>
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1 rounded-full">
              {{ $selectedRealisation->status ?? 'Projet terminé' }}
            </span>
          </div>
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-white leading-tight mb-4">
            {{ $selectedRealisation->title }}
          </h1>
          <div class="flex flex-wrap gap-4 text-white/80 text-sm mb-6">
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
        <div class="relative">
          <div class="absolute -inset-4 bg-gradient-to-r from-brand-light to-brand rounded-2xl blur-2xl opacity-30"></div>
          <img src="{{ asset('storage/' . $selectedRealisation->image) }}" 
               alt="{{ $selectedRealisation->title }}"
               class="relative rounded-2xl shadow-2xl w-full object-cover max-h-[400px]">
        </div>
      </div>
    </div>
  </div>

  <!-- Contenu principal -->
  <div class="max-w-6xl mx-auto px-6 py-16">
    <div class="grid lg:grid-cols-3 gap-8">
      
      <!-- Colonne de gauche - Contenu principal -->
      <div class="lg:col-span-2 space-y-8">
        <!-- Description détaillée -->
        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8">
          <h2 class="text-2xl font-heading font-bold text-brand-dark mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8">
          <h3 class="text-xl font-heading font-bold text-brand-dark mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Caractéristiques techniques
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($selectedRealisation->features as $feature)
            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
              <div class="check-icon mt-0.5"></div>
              <span class="text-gray-700 text-sm">{{ $feature }}</span>
            </div>
            @endforeach
          </div>
        </div>
        @endif

        <!-- Galerie d'images -->
        @if(isset($selectedRealisation->gallery) && count($selectedRealisation->gallery) > 0)
        <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8">
          <h3 class="text-xl font-heading font-bold text-brand-dark mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Galerie photos
          </h3>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($selectedRealisation->gallery as $image)
            <img src="{{ asset('storage/' . $image) }}" 
                 alt="Galerie {{ $selectedRealisation->title }}"
                 class="gallery-img rounded-lg w-full h-40 object-cover shadow-md"
                 onclick="openLightbox('{{ asset('storage/' . $image) }}')">
            @endforeach
          </div>
        </div>
        @endif
      </div>

      <!-- Colonne de droite - Sidebar -->
      <div class="lg:col-span-1 space-y-6">
        <!-- Carte des infos clés -->
        <div class="bg-gradient-to-br from-brand to-brand-dark rounded-2xl shadow-lg p-6 text-white info-card">
          <h3 class="text-xl font-heading font-bold mb-4 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Informations clés
          </h3>
          <div class="space-y-4">
            <div class="border-b border-white/20 pb-3">
              <span class="text-white/70 text-sm block mb-1">📅 Année de réalisation</span>
              <p class="font-semibold">{{ $selectedRealisation->created_at->format('Y') }}</p>
            </div>
            @if(isset($selectedRealisation->surface))
            <div class="border-b border-white/20 pb-3">
              <span class="text-white/70 text-sm block mb-1">📐 Surface</span>
              <p class="font-semibold">{{ $selectedRealisation->surface }} m²</p>
            </div>
            @endif
            @if(isset($selectedRealisation->duration))
            <div class="border-b border-white/20 pb-3">
              <span class="text-white/70 text-sm block mb-1">⏱️ Durée du chantier</span>
              <p class="font-semibold">{{ $selectedRealisation->duration }}</p>
            </div>
            @endif
            @if(isset($selectedRealisation->budget))
            <div class="border-b border-white/20 pb-3">
              <span class="text-white/70 text-sm block mb-1">💰 Budget</span>
              <p class="font-semibold">{{ $selectedRealisation->budget }}</p>
            </div>
            @endif
            <div>
              <span class="text-white/70 text-sm block mb-1">🏷️ Catégorie</span>
              <p class="font-semibold">{{ $selectedRealisation->category ?? 'Construction' }}</p>
            </div>
          </div>
        </div>

        <!-- Carte des partenaires -->
        @if(isset($selectedRealisation->partners) && count($selectedRealisation->partners) > 0)
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h4 class="font-heading font-bold text-brand-dark mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Partenaires
          </h4>
          <div class="flex flex-wrap gap-2">
            @foreach($selectedRealisation->partners as $partner)
            <span class="bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full">{{ $partner }}</span>
            @endforeach
          </div>
        </div>
        @endif

        <!-- Call to action -->
        <div class="bg-white rounded-2xl shadow-sm p-6 text-center border-2 border-brand/20">
          <div class="w-16 h-16 bg-brand/10 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h4 class="font-heading font-bold text-brand-dark mb-2">Vous avez un projet similaire ?</h4>
          <p class="text-sm text-gray-600 mb-4">
            Contactez-nous pour discuter de votre projet et obtenir un devis personnalisé.
          </p>
          <a href="{{ route('contact') }}" 
             class="inline-block bg-brand text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-dark transition w-full">
            Demander un devis
          </a>
        </div>

       
      </div>
    </div>

    <!-- Navigation entre projets -->
    <div class="mt-12 pt-8 border-t border-gray-200">
      <div class="flex justify-between items-center">
        @if($previousRealisation)
        <a href="{{ route('realisations.show', $previousRealisation->id) }}" 
           class="flex items-center gap-2 text-brand hover:text-brand-dark transition group">
          <svg class="w-5 h-5 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          <span class="text-sm font-medium">Projet précédent</span>
        </a>
        @else
        <div></div>
        @endif
        
        <a href="{{ route('realisations') }}" class="text-gray-500 hover:text-brand transition text-sm font-medium">
          Voir tous les projets
        </a>
        
        @if($nextRealisation)
        <a href="{{ route('realisations.show', $nextRealisation->id) }}" 
           class="flex items-center gap-2 text-brand hover:text-brand-dark transition group">
          <span class="text-sm font-medium">Projet suivant</span>
          <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
        @else
        <div></div>
        @endif
      </div>
    </div>
  </div>

  <!-- Lightbox pour la galerie -->
  <div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <span class="close-lightbox">&times;</span>
    <img id="lightbox-img" class="lightbox-img" src="" alt="Agrandissement">
  </div>

  <!-- ======= FOOTER ======= -->
  <footer class="bg-brand-dark text-white pt-20 pb-10 mt-16">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12">
      <div>
        <h3 class="text-2xl font-heading font-bold mb-4">Entreprise BTP</h3>
        <p class="text-blue-300 text-sm leading-relaxed mb-6">
          Spécialistes en construction et rénovation, nous réalisons vos projets
          avec exigence, qualité et savoir-faire.
        </p>
        <div class="flex gap-4">
          <div class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer">f</div>
          <div class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer">in</div>
          <div class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer">ig</div>
        </div>
      </div>
      <div>
        <h4 class="font-heading font-semibold mb-5">Navigation</h4>
        <ul class="space-y-3 text-blue-300 text-sm">
          <li><a href="/" class="hover:text-white transition">Accueil</a></li>
          <li><a href="{{ route('presentations')}}" class="hover:text-white transition">Présentation</a></li>
          <li><a href="{{ route('realisations')}}" class="hover:text-white transition">Réalisations</a></li>
          <li><a href="{{ route('services')}}" class="hover:text-white transition">Services</a></li>
          <li><a href="{{ route('contact')}}" class="hover:text-white transition">Contact</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-heading font-semibold mb-5">Contact</h4>
        <ul class="space-y-3 text-blue-300 text-sm">
          <li>📞 01 23 45 67 89</li>
          <li>✉️ info@entreprisebtp.com</li>
          <li>📍 Paris, France</li>
        </ul>
      </div>
      <div>
        <h4 class="font-heading font-semibold mb-5">Un projet ?</h4>
        <p class="text-blue-300 text-sm mb-6">Obtenez un devis gratuit rapidement.</p>
        <a href="{{ route('contact')}}" class="inline-block bg-white text-brand px-6 py-3 rounded-lg font-semibold hover:bg-blue-100 transition shadow-md hover:shadow-lg">
          Demander un devis
        </a>
      </div>
    </div>
    <div class="border-t border-blue-700 mt-14 pt-6 flex flex-col md:flex-row justify-between items-center text-blue-400 text-sm gap-4">
      <span>© 2026 Entreprise BTP — Tous droits réservés</span>
      <div class="flex gap-6">
        <a href="#" class="hover:text-white transition">Mentions légales</a>
        <a href="#" class="hover:text-white transition">Confidentialité</a>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu
    document.getElementById('menuBtn')?.addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.toggle('hidden');
    });

    // Lightbox functions
    function openLightbox(imageSrc) {
      const lightbox = document.getElementById('lightbox');
      const lightboxImg = document.getElementById('lightbox-img');
      lightbox.classList.add('active');
      lightboxImg.src = imageSrc;
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      const lightbox = document.getElementById('lightbox');
      lightbox.classList.remove('active');
      document.body.style.overflow = '';
    }

    // Share functions
    function shareProject(platform) {
      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent("{{ $selectedRealisation->title }}");
      let shareUrl = '';
      
      switch(platform) {
        case 'facebook':
          shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
          break;
        case 'linkedin':
          shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
          break;
        case 'twitter':
          shareUrl = `https://twitter.com/intent/tweet?text=${title}&url=${url}`;
          break;
      }
      
      if(shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
      }
    }

    function copyLink() {
      navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Lien copié dans le presse-papier !');
      });
    }

    // Close lightbox with Escape key
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape') {
        closeLightbox();
      }
    });
  </script>
</body>
</html>