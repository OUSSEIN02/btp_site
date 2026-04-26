<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Entreprise BTP – Contact & Devis | Construire avec confiance</title>
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

    .service-card:hover { box-shadow: 0 8px 32px rgba(26,58,143,0.13); transform: translateY(-3px); }
    .service-card { transition: all 0.25s; }

    .real-card { position: relative; overflow: hidden; border-radius: 12px; cursor: pointer; }
    .real-card img { transition: transform 0.5s; width: 100%; height: 100%; object-fit: cover; }
    .real-card:hover img { transform: scale(1.08); }
    .real-card .label {
      position: absolute; bottom: 0; left: 0; right: 0;
      background: linear-gradient(to top, rgba(10,30,80,0.9), transparent);
      color: #fff; padding: 28px 16px 14px;
      font-family: 'Montserrat', sans-serif; font-weight: 600; font-size: 14px;
    }

    /* PADDING CORRECT À L'INTÉRIEUR DES INPUTS */
    input, textarea, select {
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 10px  !important;
      font-family: 'Open Sans', sans-serif;
      font-size: 15px;
      width: 100%;
      outline: none;
      background: #fff;
      transition: all 0.3s ease;
      box-sizing: border-box;
    }
    
    /* Pour les textarea spécifiquement */
    textarea {
      padding: 14px 18px !important;
      resize: vertical;
    }
    
    input:focus, textarea:focus, select:focus { border-color: #1a3a8f; box-shadow: 0 0 0 3px rgba(26,58,143,0.1); transform: scale(1.02); }
    .nav-active { border-bottom: 2px solid #1a3a8f; color: #1a3a8f !important; }
    .section-sep { width: 60px; height: 3px; background: #1a3a8f; margin: 0 auto 18px; border-radius: 2px; transition: width 0.4s ease; }
    section:hover .section-sep { width: 100px; }
    html { scroll-behavior: smooth; }
    
    /* FAQ accordion styles */
    .faq-question { cursor: pointer; transition: all 0.2s; }
    .faq-question:hover { background-color: #f8fafc; }
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
    .faq-item.active .faq-answer { max-height: 300px; }
    .faq-item.active .faq-icon { transform: rotate(180deg); }
    .faq-icon { transition: transform 0.3s ease; }
    
    /* Office card hover */
    .office-card { transition: all 0.3s ease; }
    .office-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }

    /* MODALE STYLES */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      backdrop-filter: blur(4px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }
    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }
    .modal-content {
      background: white;
      border-radius: 24px;
      max-width: 450px;
      width: 90%;
      padding: 32px 28px;
      text-align: center;
      transform: scale(0.9);
      transition: transform 0.3s ease;
      box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
    }
    .modal-overlay.active .modal-content {
      transform: scale(1);
    }
    .modal-icon {
      width: 64px;
      height: 64px;
      background: #1a3a8f;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      transition: all 0.3s ease;
    }
    .modal-icon svg {
      width: 32px;
      height: 32px;
      color: white;
    }
    .modal-title {
      font-size: 24px;
      font-weight: 700;
      color: #1a3a8f;
      margin-bottom: 12px;
      font-family: 'Montserrat', sans-serif;
    }
    .modal-message {
      color: #4b5563;
      line-height: 1.6;
      margin-bottom: 24px;
    }
    .modal-btn {
      background: #1a3a8f;
      color: white;
      border: none;
      padding: 12px 28px;
      border-radius: 40px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: 'Montserrat', sans-serif;
    }
    .modal-btn:hover {
      background: #122970;
      transform: scale(1.05);
    }

    /* Spinner de chargement */
    .spinner {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 2px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spin 0.8s linear infinite;
      margin-right: 8px;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    .btn-loading {
      opacity: 0.7;
      cursor: not-allowed;
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

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    /* Animation classes */
    .animate-navbar { animation: slideDown 0.6s ease-out; }
    .animate-fade-up { opacity: 0; animation: fadeInUp 0.8s ease-out forwards; }
    .animate-fade-left { opacity: 0; animation: fadeInLeft 0.8s ease-out forwards; }
    .animate-fade-right { opacity: 0; animation: fadeInRight 0.8s ease-out forwards; }
    .animate-scale { opacity: 0; animation: scaleIn 0.6s ease-out forwards; }
    
    /* Delays */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }

    /* Scroll animations */
    .faq-item, .footer-section, .office-card {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .faq-item.visible, .footer-section.visible, .office-card.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Hover animations */
    footer a { transition: all 0.3s ease; position: relative; display: inline-block; }
    footer a:hover { transform: translateX(5px); color: white; }
    .logo-icon { transition: all 0.3s ease; cursor: pointer; }
    .logo-icon:hover { transform: rotate(5deg) scale(1.05); }

    nav ul li a { transition: all 0.3s ease; position: relative; }
    nav ul li a:not(.nav-active):hover { transform: translateY(-2px); color: #1a3a8f; }
    .cta-button { transition: all 0.3s ease; }
    .cta-button:hover { animation: pulse 0.5s ease-in-out; }
    
    /* Form field animation on focus */
    .form-field {
      transition: all 0.3s ease;
    }
    
    /* Button hover animation */
    #submitBtn {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    #submitBtn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(26,58,143,0.3);
    }
    #submitBtn:active {
      transform: translateY(0);
    }
    
    /* FAQ item hover */
    .faq-item {
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .faq-item:hover {
      transform: translateX(5px);
    }
    
    /* Animation pour le formulaire */
    .contact-form-container {
      animation: fadeInUp 0.8s ease-out;
    }
    
    /* Animation pour les icônes sociales */
    .social-icon {
      transition: all 0.3s ease;
    }
    .social-icon:hover {
      transform: translateY(-3px) scale(1.1);
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- ======= MODALE DE CONFIRMATION (reste ouverte jusqu'à fermeture manuelle) ======= -->
  <div id="confirmationModal" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>
      <div class="modal-title">Demande envoyée !</div>
      <div class="modal-message">
        Merci pour votre message.<br>
        Notre équipe vous répondra sous 24h.
      </div>
      <button class="modal-btn" id="closeModalBtn">Fermer</button>
    </div>
  </div>

  <!-- ======= MODALE D'ERREUR ======= -->
  <div id="errorModal" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-icon" style="background: #dc2626;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
      <div class="modal-title" style="color: #dc2626;">Erreur</div>
      <div class="modal-message" id="errorMessage">
        Une erreur est survenue. Veuillez réessayer.
      </div>
      <button class="modal-btn" id="closeErrorModalBtn" style="background: #dc2626;">Fermer</button>
    </div>
  </div>

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
        <li><a href="/" class="pb-1 text-brand">Accueil</a></li>
        <li><a href="{{ route('presentations')}}" class="hover:text-brand transition-colors">Présentation</a></li>
        <li><a href="{{ route('realisations') }}" class="hover:text-brand transition-colors">Realisations</a></li>
        <li><a href="{{ route('services')}}" class="hover:text-brand transition-colors">Services</a></li>
        <li><a href="{{ route('contact')}}" class="nav-active hover:text-brand transition-colors">Contact</a></li>
      </ul>
      <div class="hidden md:flex items-center gap-3">
        <a href="{{ route('login')}}" class="text-brand border border-brand px-4 py-2 rounded-lg text-sm font-heading font-semibold hover:bg-brand hover:text-white transition-colors">Connexion</a>
      </div>
      <button class="md:hidden text-brand" id="menuBtn">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t px-6 pb-4">
      <ul class="flex flex-col gap-3 pt-3 text-sm font-heading font-semibold text-gray-700">
        <li><a href="/" class="text-brand">Accueil</a></li>
        <li><a href="{{ route('presentations')}}">Présentation</a></li>
        <li><a href="{{ route('realisations')}}">Realisations</a></li>
        <li><a href="{{ route('services')}}">Services</a></li>
        <li><a href="{{ route('contact')}}">Contact</a></li>
        <li><a href="#contact" class="inline-block bg-brand text-white px-5 py-2 rounded mt-1 text-center">Demander un devis</a></li>
        <li><a href="{{ route('login')}}" class="inline-block border border-brand text-brand px-5 py-2 rounded mt-1 text-center">Connexion</a></li>
      </ul>
    </div>
  </nav>

  <!-- ======= HERO SECTION ======= -->
  <section id="accueil" class="relative min-h-[400px] flex items-center overflow-hidden" style="background:#1a3a8f;">
    <div class="absolute inset-0">
      <img src="https://images.unsplash.com/photo-1429497419816-9ca5cfb4571a?w=1600&q=80" alt="Contact BTP" class="w-full h-full object-cover object-center opacity-50" />
      <div class="hero-overlay absolute inset-0"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-16 w-full">
      <div class="max-w-xl">
        <h1 class="text-white text-3xl md:text-4xl font-extrabold leading-tight mb-4 animate-fade-left">Contactez-nous</h1>
        <p class="text-blue-100 text-base md:text-lg mb-6 font-body animate-fade-left delay-200">Un projet ? Une question ? Notre équipe est à votre écoute pour vous accompagner.</p>
        <div class="flex gap-3 text-white/80 text-sm animate-fade-up delay-300"><span>📞 {{ $company->phone ?? '' }}</span><span>✉️ {{ $company->email ?? '' }}</span></div>
      </div>
    </div>
  </section>

  <!-- ==================== CONTACT ==================== -->
  <section id="contact" class="py-6 bg-gradient-to-b from-gray-50 to-white scroll-mt-20">
    <div class="max-w-5xl mx-auto px-6">
      <div class="text-center mb-8">
        <div class="w-20 h-1 bg-brand mx-auto mb-4 rounded-full transition-all duration-300"></div>
        <h2 class="text-2xl font-heading font-bold text-brand mb-3 animate-scale">Parlons de votre projet</h2>
        <p class="text-gray-500 max-w-xl mx-auto animate-fade-up delay-200">Remplissez le formulaire ci-dessous, réponse sous 24h.</p>
      </div>

      <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-gray-100 contact-form-container">
        <form class="space-y-6" id="contactForm">
          @csrf

          <div class="grid md:grid-cols-2 gap-5">
            <div class="form-field">
              <label class="label block text-sm font-semibold text-gray-700 mb-2">Nom complet *</label>
              <input name="nom" type="text" placeholder="Dupont Jean" required class="w-full" id="nom">
            </div>
            <div class="form-field">
              <label class="label block text-sm font-semibold text-gray-700 mb-2">Email *</label>
              <input name="email" type="email" placeholder="jean@email.com" required class="w-full" id="email">
            </div>
          </div>

          <div class="grid md:grid-cols-2 gap-5">
            <div class="form-field">
              <label class="label block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
              <input name="telephone" type="tel" placeholder="01 23 45 67 89" class="w-full" id="telephone">
            </div>
            <div class="form-field">
              <label class="label block text-sm font-semibold text-gray-700 mb-2">Type de projet *</label>
              <select name="type_projet" required class="w-full" id="type_projet">
                <option value="">Sélectionnez</option>
                <option value="construction">Construction neuve</option>
                <option value="renovation">Rénovation</option>
                <option value="maitrise_oeuvre">Maîtrise d'œuvre</option>
                <option value="amenagement">Aménagement extérieur</option>
                <option value="energie">Performance énergétique</option>
              </select>
            </div>
          </div>

          <div class="form-field">
            <label class="label block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
            <input name="localisation" type="text" placeholder="Ville / Code postal" class="w-full" id="localisation">
          </div>

          <div class="form-field">
            <label class="label block text-sm font-semibold text-gray-700 mb-2">Budget prévisionnel</label>
            <input name="budget" type="text" placeholder="Min (€)" class="w-full" id="budget">
          </div>

          <div class="form-field">
            <label class="label block text-sm font-semibold text-gray-700 mb-2">Description du projet *</label>
            <textarea name="message" rows="5" required placeholder="Décrivez votre projet..." class="w-full" id="message"></textarea>
          </div>

          <div class="flex flex-col sm:flex-row items-center gap-4">
            <button type="submit" id="submitBtn" class="bg-brand text-white px-8 py-3 rounded-xl font-semibold hover:bg-brand-dark transition shadow-lg hover:shadow-xl w-full sm:w-auto flex items-center justify-center">
              Envoyer ma demande
            </button>
            <span class="text-xs text-gray-400">Réponse sous 24h ouvrées</span>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- ==================== FAQ ==================== -->
  <section class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6">
      <div class="text-center mb-8">
        <div class="w-16 h-1 bg-brand mx-auto mb-4 transition-all duration-300"></div>
        <h2 class="text-2xl font-heading font-bold text-brand animate-scale">Questions fréquentes</h2>
      </div>
      <div class="space-y-4">
        <div class="faq-item bg-white rounded-2xl border shadow-sm">
          <button class="faq-btn w-full text-left p-5 font-semibold flex justify-between items-center">
            Obtenir un devis ?
            <span class="faq-icon transition">+</span>
          </button>
          <div class="faq-content hidden px-5 pb-5 text-gray-600 text-sm">
            Remplissez le formulaire, nous vous répondons sous 24h avec une étude personnalisée.
          </div>
        </div>
        <div class="faq-item bg-white rounded-2xl border shadow-sm">
          <button class="faq-btn w-full text-left p-5 font-semibold flex justify-between items-center">
            Vos garanties ?
            <span class="faq-icon transition">+</span>
          </button>
          <div class="faq-content hidden px-5 pb-5 text-gray-600 text-sm">
            Garantie décennale, assurance chantier et suivi qualité complet.
          </div>
        </div>
        <div class="faq-item bg-white rounded-2xl border shadow-sm">
          <button class="faq-btn w-full text-left p-5 font-semibold flex justify-between items-center">
            Délais de livraison ?
            <span class="faq-icon transition">+</span>
          </button>
          <div class="faq-content hidden px-5 pb-5 text-gray-600 text-sm">
            Planning clair avec suivi hebdomadaire et respect des délais.
          </div>
        </div>
      </div>
    </div>
  </section>

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
        <div class="social-icon w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">f</div>
        <div class="social-icon w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">in</div>
        <div class="social-icon w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-all duration-300 hover:scale-110 cursor-pointer">ig</div>
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
    // FAQ Accordion
    document.querySelectorAll('.faq-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('.faq-icon');
        content.classList.toggle('hidden');
        icon.textContent = content.classList.contains('hidden') ? '+' : '−';
      });
    });

    // MODALES
    const successModal = document.getElementById('confirmationModal');
    const errorModal = document.getElementById('errorModal');
    const closeSuccessBtn = document.getElementById('closeModalBtn');
    const closeErrorBtn = document.getElementById('closeErrorModalBtn');

    function openSuccessModal() {
      successModal.classList.add('active');
    }

    function closeSuccessModal() {
      successModal.classList.remove('active');
    }

    function openErrorModal(message) {
      const errorMsg = document.getElementById('errorMessage');
      errorMsg.textContent = message || 'Une erreur est survenue. Veuillez réessayer.';
      errorModal.classList.add('active');
    }

    function closeErrorModal() {
      errorModal.classList.remove('active');
    }

    // Fermeture des modales
    closeSuccessBtn.addEventListener('click', closeSuccessModal);
    closeErrorBtn.addEventListener('click', closeErrorModal);

    // Fermer en cliquant sur l'overlay
    successModal.addEventListener('click', function(e) {
      if (e.target === successModal) closeSuccessModal();
    });
    errorModal.addEventListener('click', function(e) {
      if (e.target === errorModal) closeErrorModal();
    });

    // SOUMISSION DU FORMULAIRE AVEC AJAX (pas de rechargement)
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');

    contactForm.addEventListener('submit', async function(e) {
      e.preventDefault(); // Empêche le rechargement de la page

      // Récupération des valeurs
      const nom = document.getElementById('nom').value.trim();
      const email = document.getElementById('email').value.trim();
      const telephone = document.getElementById('telephone').value.trim();
      const type_projet = document.getElementById('type_projet').value;
      const localisation = document.getElementById('localisation').value.trim();
      const budget = document.getElementById('budget').value.trim();
      const message = document.getElementById('message').value.trim();

      // Validation
      if (!nom || !email || !message || !type_projet) {
        openErrorModal('Veuillez remplir tous les champs obligatoires');
        return;
      }

      // Email validation simple
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        openErrorModal('Veuillez entrer une adresse email valide');
        return;
      }

      // Désactiver le bouton et afficher le chargement
      submitBtn.disabled = true;
      const originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<span class="spinner"></span> Envoi en cours...';
      submitBtn.classList.add('btn-loading');

      try {
        // Envoi des données via fetch
        const formData = new FormData();
        formData.append('nom', nom);
        formData.append('email', email);
        formData.append('telephone', telephone);
        formData.append('type_projet', type_projet);
        formData.append('localisation', localisation);
        formData.append('budget', budget);
        formData.append('message', message);
        formData.append('_token', '{{ csrf_token() }}'); // Token Laravel

        const response = await fetch('{{ route('contact.store') }}', {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        const data = await response.json();

        if (response.ok && data.success) {
          // Succès : on ouvre la modale (qui restera ouverte)
          openSuccessModal();
          // Réinitialiser le formulaire
          contactForm.reset();
        } else {
          // Erreur du serveur
          openErrorModal(data.message || 'Une erreur est survenue. Veuillez réessayer.');
        }
      } catch (error) {
        console.error('Erreur:', error);
        openErrorModal('Erreur de connexion. Veuillez vérifier votre connexion internet.');
      } finally {
        // Réactiver le bouton
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        submitBtn.classList.remove('btn-loading');
      }
    });

    // Mobile menu
    document.getElementById('menuBtn').addEventListener('click', () => {
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
    document.querySelectorAll('.faq-item, .footer-section, .office-card').forEach(el => {
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