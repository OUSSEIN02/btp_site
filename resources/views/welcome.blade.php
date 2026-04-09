
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vision Optique – Votre Vision, Notre Expertise</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Nunito', sans-serif; }
    h1, h2, h3, .brand { font-family: 'Nunito', serif; }

    .nav-active { border-bottom: 2px solid #1e3a6e; padding-bottom: 2px; }

    .hero-gradient-desktop {
      background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.92) 45%, rgba(255,255,255,1) 100%);
    }
    .hero-gradient-mobile {
      background: linear-gradient(to bottom, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.85) 40%, rgba(255,255,255,1) 100%);
    }

    .collection-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .collection-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(30,58,110,0.18); }

    .service-card { transition: box-shadow 0.3s ease, transform 0.3s ease; }
    .service-card:hover { box-shadow: 0 8px 24px rgba(30,58,110,0.14); transform: translateY(-3px); }

    .btn-primary { background-color: #1e3a6e; transition: background-color 0.2s, transform 0.2s; }
    .btn-primary:hover { background-color: #163060; transform: scale(1.03); }

    .form-input {
      border: none;
      border-bottom: 1px solid rgba(255,255,255,0.5);
      background: transparent;
      color: white;
      outline: none;
      padding: 6px 0;
      width: 100%;
      font-size: 0.875rem;
    }
    .form-input::placeholder { color: rgba(255,255,255,0.6); }
    .form-input:focus { border-bottom-color: white; }
    textarea.form-input { resize: none; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp 0.7s ease forwards; }

    /* Burger */
    #mobile-menu { display: none; }
    #mobile-menu.open { display: block; }
    #burger span { transition: transform 0.25s ease, opacity 0.25s ease; display: block; }
    #burger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    #burger.open span:nth-child(2) { opacity: 0; }
    #burger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    
 
    /* Style pour le spinner de chargement */
    .loading-spinner-contact {
      display: inline-block;
      width: 16px;
      height: 16px;
      border: 2px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spinContact 0.6s linear infinite;
      margin-right: 8px;
    }
    @keyframes spinContact {
      to { transform: rotate(360deg); }
    }
  
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- ===== NAVBAR ===== -->
  <header class="sticky top-0 z-50 bg-white shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 flex items-center justify-between h-14 sm:h-16">

      <!-- Logo -->
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

      <!-- Desktop Nav -->
      <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-sm font-medium text-gray-700">
        <a href="{{ route('home')}}" class="nav-active text-[#1e3a6e] font-semibold">Accueil</a>
        <a href="{{ route('lunettes.index')}}" class="hover:text-[#1e3a6e] transition-colors">Nos Lunettes</a>
        <a href="{{ route('initiatives.index') }}" class="hover:text-[#1e3a6e] transition-colors">Nos Initiatives</a>
        <a href="{{ route('apropos.index') }}" class="hover:text-[#1e3a6e] transition-colors">À Propos</a>
        
      </nav>

      <!-- Right: CTA + Burger -->
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

    <!-- Mobile Nav Drawer -->
    <div id="mobile-menu" class="lg:hidden bg-white border-t border-gray-100 shadow-md">
      <nav class="flex flex-col px-4 py-4 gap-4 text-sm font-medium text-gray-700">
        <a href="{{ route('home')}}" class="text-[#1e3a6e] font-semibold" onclick="closeMobileMenu()">Accueil</a>
        <a href="{{ route('lunettes.index')}}" class="hover:text-[#1e3a6e]" onclick="closeMobileMenu()">Nos Lunettes</a>
        <a href="{{ route('initiatives.index') }}" class="hover:text-[#1e3a6e]" onclick="closeMobileMenu()">Nos Initiatives</a>
        <a href="{{ route('apropos.index') }}" class="hover:text-[#1e3a6e]" onclick="closeMobileMenu()">À Propos</a>
      </nav>
    </div>
  </header>

  <!-- ===== HERO ===== -->
  <section class="relative overflow-hidden bg-[#dce8f5]" style="min-height: clamp(300px, 50vw, 500px);">
    <div class="absolute inset-0">
      <img
        src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=1200&q=80"
        alt="Femme avec lunettes"
        class="w-full h-full object-cover object-top sm:object-center"
      />
      <!-- Mobile overlay -->
      <div class="hero-gradient-mobile absolute inset-0 lg:hidden"></div>
      <!-- Desktop overlay -->
      <div class="hero-gradient-desktop absolute inset-0 hidden lg:block"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 flex items-end lg:items-center pb-8 lg:pb-0 h-full" style="min-height: clamp(300px, 50vw, 500px);">
      <div class="w-full lg:ml-auto lg:max-w-lg text-center lg:text-right fade-up">
        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold text-[#1e3a6e] leading-tight mb-3">
          Votre Vision,<br/>
          <span class="text-[#4a90d9]">Notre Expertise</span>
        </h1>
        <p class="text-sm sm:text-base text-gray-700 mb-5">
          <strong>Vos lunettes parfaites</strong> pour une vue optimale.
        </p>
        <a href="#collections" class="btn-primary inline-block text-white px-5 sm:px-7 py-2.5 sm:py-3 rounded text-sm font-semibold">
          Découvrez Nos Collections
        </a>
      </div>
    </div>
  </section>

  <!-- ===== FEATURES STRIP ===== -->
  <section class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-4 sm:py-5">
      <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-300">

        <div class="flex sm:flex-col items-center gap-3 sm:gap-2 py-3 sm:py-0 sm:px-4 text-left sm:text-center">
          <svg width="38" height="22" viewBox="0 0 42 26" fill="none" class="flex-shrink-0">
            <rect x="1" y="5" width="16" height="15" rx="7.5" stroke="#1e3a6e" stroke-width="1.8"/>
            <rect x="25" y="5" width="16" height="15" rx="7.5" stroke="#1e3a6e" stroke-width="1.8"/>
            <line x1="17" y1="12.5" x2="25" y2="12.5" stroke="#1e3a6e" stroke-width="1.8"/>
          </svg>
          <span class="text-sm font-medium text-gray-700">Large Choix de Montures</span>
        </div>

        <div class="flex sm:flex-col items-center gap-3 sm:gap-2 py-3 sm:py-0 sm:px-4 text-left sm:text-center">
          <svg width="28" height="28" viewBox="0 0 32 32" fill="none" class="flex-shrink-0">
            <circle cx="16" cy="13" r="8" stroke="#1e3a6e" stroke-width="1.8"/>
            <line x1="16" y1="5" x2="16" y2="3" stroke="#1e3a6e" stroke-width="1.8"/>
            <line x1="16" y1="21" x2="16" y2="23" stroke="#1e3a6e" stroke-width="1.8"/>
            <line x1="8" y1="13" x2="6" y2="13" stroke="#1e3a6e" stroke-width="1.8"/>
            <line x1="24" y1="13" x2="26" y2="13" stroke="#1e3a6e" stroke-width="1.8"/>
            <line x1="16" y1="21" x2="13" y2="28" stroke="#1e3a6e" stroke-width="1.8" stroke-linecap="round"/>
            <line x1="16" y1="21" x2="19" y2="28" stroke="#1e3a6e" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
          <span class="text-sm font-medium text-gray-700">Examen de Vue Professionnel</span>
        </div>

        <div class="flex sm:flex-col items-center gap-3 sm:gap-2 py-3 sm:py-0 sm:px-4 text-left sm:text-center">
          <svg width="28" height="28" viewBox="0 0 32 32" fill="none" class="flex-shrink-0">
            <circle cx="16" cy="16" r="12" stroke="#1e3a6e" stroke-width="1.8"/>
            <text x="16" y="21" text-anchor="middle" font-size="13" fill="#1e3a6e" font-family="serif" font-weight="bold">?</text>
          </svg>
          <span class="text-sm font-medium text-gray-700">Conseils Personnalisés</span>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== COLLECTIONS ===== -->
  <section id="collections" class="py-10 sm:py-14 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <h2 class="text-xl sm:text-2xl font-bold text-center text-[#1e3a6e] mb-1">Nos Collections de Lunettes</h2>
      <p class="text-center text-gray-500 text-sm mb-8">Découvrez nos dernières tendances</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="collection-card rounded overflow-hidden shadow-md cursor-pointer">
          <div class="h-52 sm:h-44 overflow-hidden bg-gray-100">
            <img src="https://images.unsplash.com/photo-1574258495973-f010dfbb5371?w=600&q=80" alt="Lunettes de Vue" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
          </div>
          <div class="bg-[#1e3a6e] text-white text-center py-3 text-sm font-semibold tracking-wide">Lunettes de Vue</div>
        </div>

        <div class="collection-card rounded overflow-hidden shadow-md cursor-pointer">
          <div class="h-52 sm:h-44 overflow-hidden bg-gray-100">
            <img src="https://images.unsplash.com/photo-1508296695146-257a814070b4?w=600&q=80" alt="Lunettes de Soleil" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"/>
          </div>
          <div class="bg-[#1e3a6e] text-white text-center py-3 text-sm font-semibold tracking-wide">Lunettes de Soleil</div>
        </div>

        <!-- On sm: spans 2 cols to center nicely, on lg: normal -->
        <div class="collection-card rounded overflow-hidden shadow-md cursor-pointer sm:col-span-2 lg:col-span-1">
          <div class="h-52 sm:h-44 overflow-hidden bg-gray-100">
            <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=600&q=80" alt="Lunettes Enfant" class="w-full h-full object-cover object-top transition-transform duration-500 hover:scale-105"/>
          </div>
          <div class="bg-[#1e3a6e] text-white text-center py-3 text-sm font-semibold tracking-wide">Lunettes Enfant</div>
        </div>
      </div>

      <div class="text-center mt-8">
        <a href="#" class="btn-primary inline-block text-white px-8 py-3 rounded text-sm font-semibold">Voir Toutes les Collections</a>
      </div>
    </div>
  </section>

  <!-- ===== SERVICES ===== -->
  <section id="services" class="py-10 sm:py-14 bg-[#f0f5fb]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <h2 class="text-xl sm:text-2xl font-bold text-center text-[#1e3a6e] mb-1">Nos Services</h2>
      <p class="text-center text-gray-500 text-sm italic mb-8 sm:mb-10">Tout pour votre santé visuelle</p>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">

        <div class="service-card bg-white rounded-lg p-5 sm:p-6 shadow-sm flex sm:flex-col items-center gap-4 sm:gap-0 sm:text-center">
          <div class="flex-shrink-0 sm:flex sm:justify-center sm:mb-4">
            <svg width="44" height="44" viewBox="0 0 48 48" fill="none">
              <rect x="8" y="8" width="32" height="32" rx="4" stroke="#1e3a6e" stroke-width="1.8"/>
              <circle cx="24" cy="22" r="6" stroke="#1e3a6e" stroke-width="1.8"/>
              <line x1="24" y1="28" x2="24" y2="36" stroke="#1e3a6e" stroke-width="1.8"/>
              <line x1="20" y1="32" x2="28" y2="32" stroke="#1e3a6e" stroke-width="1.8"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-[#1e3a6e] text-base mb-1">Examen de Vue</h3>
            <p class="text-gray-500 text-sm">Bilan complet de votre vision</p>
          </div>
        </div>

        <div class="service-card bg-white rounded-lg p-5 sm:p-6 shadow-sm flex sm:flex-col items-center gap-4 sm:gap-0 sm:text-center">
          <div class="flex-shrink-0 sm:flex sm:justify-center sm:mb-4">
            <svg width="50" height="28" viewBox="0 0 56 32" fill="none">
              <rect x="2" y="8" width="22" height="16" rx="8" stroke="#1e3a6e" stroke-width="1.8"/>
              <rect x="32" y="8" width="22" height="16" rx="8" stroke="#1e3a6e" stroke-width="1.8"/>
              <line x1="24" y1="16" x2="32" y2="16" stroke="#1e3a6e" stroke-width="1.8"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-[#1e3a6e] text-base mb-1">Verres Correcteurs</h3>
            <p class="text-gray-500 text-sm">Verres de haute qualité adaptés à vos besoins</p>
          </div>
        </div>

        <div class="service-card bg-white rounded-lg p-5 sm:p-6 shadow-sm flex sm:flex-col items-center gap-4 sm:gap-0 sm:text-center">
          <div class="flex-shrink-0 sm:flex sm:justify-center sm:mb-4">
            <svg width="50" height="28" viewBox="0 0 56 32" fill="none">
              <ellipse cx="28" cy="16" rx="24" ry="10" stroke="#1e3a6e" stroke-width="1.8"/>
              <ellipse cx="28" cy="16" rx="12" ry="6" stroke="#1e3a6e" stroke-width="1.2"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-[#1e3a6e] text-base mb-1">Lentilles de Contact</h3>
            <p class="text-gray-500 text-sm">Lentilles de contact personnalisées</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===== ABOUT ===== -->
  <section id="about" class="py-10 sm:py-14 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-col md:flex-row items-center gap-8 md:gap-10">
      <div class="w-full md:w-2/5 flex-shrink-0 rounded overflow-hidden shadow-md">
        <img
          src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=700&q=80"
          alt="Opticien professionnel"
          class="w-full h-52 sm:h-64 object-cover object-center"
        />
      </div>
      <div class="text-center md:text-left">
        <h2 class="text-xl sm:text-2xl font-bold text-[#1e3a6e] mb-3">À Propos de Nous</h2>
        <p class="font-semibold text-gray-800 mb-2">Votre opticien de confiance</p>
        <p class="text-gray-500 text-sm mb-6">Expertise et conseils pour toute la famille.</p>
        <a href="#" class="btn-primary inline-block text-white px-7 py-3 rounded text-sm font-semibold">En Savoir Plus</a>
      </div>
    </div>
  </section>

  <!-- ===== CONTACT ===== -->
  <section id="contact" class="bg-[#2c4a7c] text-white py-10 sm:py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <h2 class="text-xl sm:text-2xl font-bold text-center mb-1">Contactez-Nous</h2>
      <p class="text-center text-sm italic text-blue-200 mb-8 sm:mb-10">Prenez rendez-vous dès aujourd'hui !</p>

      <!-- Message de succès -->
      <div id="contact-success-message" class="hidden bg-green-500 text-white p-3 rounded-lg mb-4 text-center">
        ✓ Message envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.
      </div>

      <!-- Message d'erreur -->
      <div id="contact-error-message" class="hidden bg-red-500 text-white p-3 rounded-lg mb-4 text-center">
        ⚠️ Une erreur est survenue. Veuillez réessayer.
      </div>

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
        <form id="contactForm" class="w-full md:flex-1 bg-[#1e3a6e] rounded-lg p-5 sm:p-6 space-y-4">
          @csrf
          <div>
            <label class="text-xs text-blue-200 block mb-1">Nom complet *</label>
            <input type="text" id="contact_name" name="name" placeholder="Votre nom et prénom" class="form-input" required/>
          </div>
          <div>
            <label class="text-xs text-blue-200 block mb-1">Email *</label>
            <input type="email" id="contact_email" name="email" placeholder="Votre email" class="form-input" required/>
          </div>
          <div>
            <label class="text-xs text-blue-200 block mb-1">Téléphone *</label>
            <input type="tel" id="contact_phone" name="phone" placeholder="Votre numéro de téléphone" class="form-input" required/>
          </div>
          <div>
            <label class="text-xs text-blue-200 block mb-1">Sujet</label>
            <select id="contact_subject" name="subject" class="form-input">
              <option value="general" class="text-gray-800">Question générale</option>
              <option value="rdv" class="text-gray-800">Prise de rendez-vous</option>
              <option value="devis" class="text-gray-800">Demande de devis</option>
              <option value="reclamation" class="text-gray-800">Réclamation</option>
            </select>
          </div>
          <div>
            <label class="text-xs text-blue-200 block mb-1">Votre Message *</label>
            <textarea id="contact_message" name="message" rows="3" placeholder="Votre message..." class="form-input" required></textarea>
          </div>
          <button
            type="button"
            onclick="submitContactForm(event)"
            id="contactSubmitBtn"
            class="w-full bg-[#4a90d9] hover:bg-[#3a7ac4] text-white text-sm font-semibold py-2.5 rounded transition-colors"
          >
            Envoyer
          </button>
        </form>

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

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        const href = a.getAttribute('href');
        if (href === '#') return;
        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth' });
          closeMobileMenu();
        }
      });
    });

    // Form feedback
    function handleSubmit(e) {
      const btn = e.currentTarget;
      btn.textContent = '✓ Message envoyé !';
      btn.style.backgroundColor = '#22c55e';
      setTimeout(() => {
        btn.textContent = 'Envoyer';
        btn.style.backgroundColor = '';
      }, 2500);
    }

    // Scroll fade-in with stagger
    const scrollObs = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          scrollObs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.08 });

    document.querySelectorAll('.collection-card, .service-card').forEach((el, i) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(22px)';
      el.style.transition = `opacity 0.5s ease ${i * 0.12}s, transform 0.5s ease ${i * 0.12}s, box-shadow 0.3s ease`;
      scrollObs.observe(el);
    });
  </script>


<script>
    // Fonction pour soumettre le formulaire de contact
    async function submitContactForm(event) {
      const btn = document.getElementById('contactSubmitBtn');
      const originalText = btn.innerHTML;
      
      // Récupérer les valeurs
      const name = document.getElementById('contact_name').value.trim();
      const email = document.getElementById('contact_email').value.trim();
      const phone = document.getElementById('contact_phone').value.trim();
      const subject = document.getElementById('contact_subject').value;
      const message = document.getElementById('contact_message').value.trim();
      
      // Validation simple
      if (!name || !email || !phone || !message) {
        const errorDiv = document.getElementById('contact-error-message');
        errorDiv.textContent = '⚠️ Veuillez remplir tous les champs obligatoires.';
        errorDiv.classList.remove('hidden');
        setTimeout(() => errorDiv.classList.add('hidden'), 3000);
        return;
      }
      
      // Validation email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        const errorDiv = document.getElementById('contact-error-message');
        errorDiv.textContent = '⚠️ Veuillez entrer une adresse email valide.';
        errorDiv.classList.remove('hidden');
        setTimeout(() => errorDiv.classList.add('hidden'), 3000);
        return;
      }
      
      // Validation téléphone (10 chiffres minimum)
      const phoneRegex = /^[0-9\s\+\(\)]{10,}$/;
      if (!phoneRegex.test(phone)) {
        const errorDiv = document.getElementById('contact-error-message');
        errorDiv.textContent = '⚠️ Veuillez entrer un numéro de téléphone valide.';
        errorDiv.classList.remove('hidden');
        setTimeout(() => errorDiv.classList.add('hidden'), 3000);
        return;
      }
      
      // Désactiver le bouton et montrer le chargement
      btn.disabled = true;
      btn.innerHTML = '<span class="loading-spinner-contact"></span> Envoi en cours...';
      
      // Masquer les messages précédents
      document.getElementById('contact-success-message').classList.add('hidden');
      document.getElementById('contact-error-message').classList.add('hidden');
      
      const formData = {
        name: name,
        email: email,
        phone: phone,
        subject: subject,
        message: message,
        _token: document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
      };
      
      try {
        const response = await fetch('{{ route("contact.store") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
          // Afficher le message de succès
          const successDiv = document.getElementById('contact-success-message');
          successDiv.classList.remove('hidden');
          
          // Réinitialiser le formulaire
          document.getElementById('contactForm').reset();
          
          // Re-masquer le message après 5 secondes
          setTimeout(() => {
            successDiv.classList.add('hidden');
          }, 5000);
        } else {
          // Afficher l'erreur
          const errorDiv = document.getElementById('contact-error-message');
          errorDiv.textContent = data.message || '⚠️ Une erreur est survenue. Veuillez réessayer.';
          errorDiv.classList.remove('hidden');
          setTimeout(() => errorDiv.classList.add('hidden'), 5000);
        }
      } catch (error) {
        console.error('Erreur:', error);
        const errorDiv = document.getElementById('contact-error-message');
        errorDiv.textContent = '⚠️ Erreur de connexion. Veuillez réessayer.';
        errorDiv.classList.remove('hidden');
        setTimeout(() => errorDiv.classList.add('hidden'), 5000);
      } finally {
        // Réactiver le bouton
        btn.disabled = false;
        btn.innerHTML = originalText;
      }
    }
  </script>
</body>
</html>
