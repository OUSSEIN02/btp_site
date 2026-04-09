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
      transition: all 0.3s ease;
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
    }
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
  </style>
</head>
<body class="bg-white text-gray-800">

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
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Retour aux réalisations
        </a>
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div>
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-sm px-4 py-2 rounded-full mb-4">
              {{ $selectedRealisation->category ?? 'Réalisation' }}
            </span>
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-white mb-4">
              {{ $selectedRealisation->title }}
            </h1>
            <div class="flex flex-wrap gap-4 text-white/90 text-sm mb-6">
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $selectedRealisation->created_at->format('d F Y') }}
              </span>
              <span class="flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ $selectedRealisation->location ?? 'France' }}
              </span>
            </div>
          </div>
          <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-brand to-brand-light rounded-2xl blur-2xl opacity-30"></div>
            <img src="{{ asset('storage/' . $selectedRealisation->image) }}" 
                 alt="{{ $selectedRealisation->title }}"
                 class="relative rounded-2xl shadow-2xl w-full object-cover max-h-96">
          </div>
        </div>
      </div>
    </div>

    <!-- Contenu principal -->
    <div class="max-w-6xl mx-auto px-6 py-16">
      <div class="grid lg:grid-cols-3 gap-12">
        <!-- Contenu texte -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-2xl shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-heading font-bold text-brand-dark mb-6">À propos du projet</h2>
            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
              {!! nl2br(e($selectedRealisation->content)) !!}
            </div>
          </div>

          <!-- Galerie supplémentaire (optionnelle) -->
          @if(isset($selectedRealisation->gallery) && count($selectedRealisation->gallery) > 0)
          <div class="bg-white rounded-2xl shadow-sm p-8">
            <h3 class="text-xl font-heading font-bold text-brand-dark mb-6">Galerie photos</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
              @foreach($selectedRealisation->gallery as $image)
              <img src="{{ asset('storage/' . $image) }}" 
                   alt="Galerie {{ $selectedRealisation->title }}"
                   class="rounded-lg w-full h-48 object-cover cursor-pointer hover:opacity-90 transition">
              @endforeach
            </div>
          </div>
          @endif
        </div>

        <!-- Sidebar informations -->
        <div class="lg:col-span-1">
          <div class="bg-gradient-to-br from-brand to-brand-dark rounded-2xl shadow-sm p-6 text-white mb-6">
            <h3 class="text-xl font-heading font-bold mb-4">Informations clés</h3>
            <div class="space-y-4">
              <div>
                <span class="text-white/70 text-sm">Statut</span>
                <p class="font-semibold">Terminé</p>
              </div>
              <div>
                <span class="text-white/70 text-sm">Année</span>
                <p class="font-semibold">{{ $selectedRealisation->created_at->format('Y') }}</p>
              </div>
              <div>
                <span class="text-white/70 text-sm">Catégorie</span>
                <p class="font-semibold">{{ $selectedRealisation->category ?? 'Construction' }}</p>
              </div>
            </div>
          </div>

          <!-- Call to action -->
          <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
            <h4 class="font-heading font-bold text-brand-dark mb-3">Projet similaire ?</h4>
            <p class="text-sm text-gray-600 mb-4">
              Contactez-nous pour concrétiser vos idées
            </p>
            <a href="{{ route('contact') }}" 
               class="inline-block bg-brand text-white px-6 py-3 rounded-lg font-semibold hover:bg-brand-dark transition w-full">
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
        <h2 class="text-2xl font-heading font-bold text-brand">
          Nos réalisations phares
        </h2>
        <p class="text-gray-500 text-sm max-w-xl mx-auto mt-2">
          Cliquez sur une réalisation pour voir les détails complets
        </p>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($realisations as $realisation)
          <a href="{{ route('realisations.show', $realisation->id) }}" class="block no-underline">
            <div class="real-card group rounded-xl bg-white hover:shadow-xl transition-all duration-300">
              <div class="relative h-56 overflow-hidden rounded-t-xl">
                <img src="{{ asset('storage/' . $realisation->image) }}" 
                     alt="{{ $realisation->title }}" 
                     class="w-full h-full object-cover">
                <div class="overlay-info rounded-t-xl">
                  <svg class="w-12 h-12 mb-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                  <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

      <!-- Statistiques -->
      <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-5 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <div class="text-center"><div class="text-brand text-3xl font-extrabold">150+</div><div class="text-xs text-gray-500 uppercase">Projets réalisés</div></div>
        <div class="text-center"><div class="text-brand text-3xl font-extrabold">98%</div><div class="text-xs text-gray-500 uppercase">Clients satisfaits</div></div>
        <div class="text-center"><div class="text-brand text-3xl font-extrabold">12</div><div class="text-xs text-gray-500 uppercase">Années d'innovation</div></div>
        <div class="text-center"><div class="text-brand text-3xl font-extrabold">35</div><div class="text-xs text-gray-500 uppercase">Experts dédiés</div></div>
      </div>

      <!-- Témoignages + appel à l'action -->
      <div class="mt-16 bg-brand/5 rounded-2xl p-8 md:p-10 flex flex-col md:flex-row justify-between items-center gap-6">
        <div><h3 class="text-xl font-heading font-bold text-brand-dark">Vous avez un projet similaire ?</h3><p class="text-gray-600 text-sm mt-1">Inspirez-vous de nos réalisations et contactez-nous pour concrétiser vos idées.</p></div>
        <a href="{{ route('contact') }}" class="bg-brand text-white px-6 py-3 rounded-lg font-heading font-semibold hover:bg-brand-dark transition shadow-md">Demander un devis personnalisé →</a>
      </div>
    </div>
  </section>
  @endif

  <!-- ======= FOOTER ======= -->
  <footer class="bg-brand-dark text-white pt-20 pb-10">
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
  </script>
</body>
</html>