<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Connexion - Vision Optique Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Nunito', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    h1, h2, h3 { font-family: 'Nunito', serif; }
    
    .login-card {
      animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .input-group {
      position: relative;
      margin-bottom: 30px;
    }
    
    .input-group input {
      width: 100%;
      padding: 12px 0 12px 40px;
      border: none;
      border-bottom: 2px solid #e2e8f0;
      background: transparent;
      outline: none;
      font-size: 16px;
      transition: all 0.3s ease;
    }
    
    .input-group input:focus {
      border-bottom-color: #667eea;
    }
    
    .input-group i {
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      color: #a0aec0;
      transition: color 0.3s ease;
    }
    
    .input-group input:focus + i {
      color: #667eea;
    }
    
    .btn-login {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
    }
    
    .btn-login:active {
      transform: translateY(0);
    }
    
    .error-message {
      animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-10px); }
      75% { transform: translateX(10px); }
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }

    /* Loading spinner */
    .loading-spinner {
      display: inline-block;
      width: 16px;
      height: 16px;
      border: 2px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spin 0.6s linear infinite;
      margin-right: 8px;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* Toast notification */
    .toast {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: white;
      border-radius: 8px;
      padding: 12px 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      z-index: 1000;
      animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
      from {
        transform: translateX(100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
  
  <!-- Background decoration -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-white rounded-full opacity-10 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white rounded-full opacity-10 blur-3xl"></div>
  </div>

  <!-- Login Card -->
  <div class="login-card w-full max-w-md">
    <!-- Logo & Brand -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-white mb-2">Vision Optique</h1>
      <p class="text-white text-opacity-90 text-sm">Espace Administrateur</p>
    </div>

    <!-- Login Form -->
    <div class="glass-effect rounded-2xl shadow-2xl p-8">
      <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Connexion</h2>
        <p class="text-gray-500 text-sm mt-1">Accédez à votre dashboard</p>
      </div>

      <!-- Affichage des erreurs de session Laravel -->
      @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">
          <i class="fas fa-exclamation-circle mr-2"></i>
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">
          <i class="fas fa-exclamation-circle mr-2"></i>
          @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
        @csrf
        
        <!-- Email Field -->
        <div class="input-group">
          <input 
            type="email" 
            id="email" 
            name="email" 
            value="{{ old('email') }}"
            required 
            placeholder="Email professionnel"
            autocomplete="email"
          >
          <i class="fas fa-envelope"></i>
        </div>

        <!-- Password Field -->
        <div class="input-group">
          <input 
            type="password" 
            id="password" 
            name="password" 
            required 
            placeholder="Mot de passe"
            autocomplete="current-password"
          >
          <i class="fas fa-lock"></i>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex justify-between items-center mb-6">
          <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-[#667eea] rounded border-gray-300 focus:ring-[#667eea]">
            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
          </label>
          <a href="#" onclick="showForgotPassword(event)" class="text-sm text-[#667eea] hover:text-[#764ba2] transition-colors">
            Mot de passe oublié ?
          </a>
        </div>

        <!-- Login Button -->
        <button 
          type="submit" 
          id="loginBtn"
          class="btn-login w-full text-white font-semibold py-3 rounded-xl transition-all"
        >
          <i class="fas fa-sign-in-alt mr-2"></i>
          Se connecter
        </button>
      </form>
    </div>
  </div>

  <!-- Forgot Password Modal -->
  <div id="forgotModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" onclick="closeForgotModal(event)">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 transform transition-all" onclick="event.stopPropagation()">
      <div class="text-center mb-4">
        <i class="fas fa-key text-4xl text-[#667eea] mb-2"></i>
        <h3 class="text-xl font-bold text-gray-800">Mot de passe oublié</h3>
        <p class="text-gray-500 text-sm mt-1">Entrez votre email pour réinitialiser</p>
      </div>
      <form id="forgotForm" method="POST" action="#">
        @csrf
        <input type="email" name="email" id="resetEmail" placeholder="votre@email.com" class="w-full border border-gray-300 rounded-lg p-3 mb-4 focus:outline-none focus:border-[#667eea]" required>
        <button type="submit" class="w-full bg-[#667eea] text-white py-2 rounded-lg hover:bg-[#764ba2] transition-colors">
          Envoyer le lien
        </button>
        <button type="button" onclick="closeForgotModal()" class="w-full mt-2 text-gray-500 text-sm py-2">
          Annuler
        </button>
      </form>
    </div>
  </div>

  <script>
    // Gestionnaire de soumission du formulaire avec feedback
    document.getElementById('loginForm')?.addEventListener('submit', function(e) {
      const btn = document.getElementById('loginBtn');
      const originalHTML = btn.innerHTML;
      
      // Désactiver le bouton et montrer le chargement
      btn.disabled = true;
      btn.innerHTML = '<span class="loading-spinner"></span> Connexion en cours...';
      
      // Réactiver le bouton en cas d'erreur après timeout
      setTimeout(() => {
        if (btn.disabled) {
          btn.disabled = false;
          btn.innerHTML = originalHTML;
        }
      }, 10000);
    });

    // Gestionnaire pour le formulaire de mot de passe oublié
    document.getElementById('forgotForm')?.addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="loading-spinner"></span> Envoi...';
      
      setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      }, 5000);
    });

    function showForgotPassword(event) {
      event.preventDefault();
      document.getElementById('forgotModal').classList.add('flex');
      document.getElementById('forgotModal').classList.remove('hidden');
    }

    function closeForgotModal(event) {
      if (event && event.target !== event.currentTarget && event.target.tagName !== 'BUTTON') return;
      document.getElementById('forgotModal').classList.remove('flex');
      document.getElementById('forgotModal').classList.add('hidden');
    }

    // Afficher une notification toast
    function showToast(message, type = 'success') {
      const toast = document.createElement('div');
      toast.className = 'toast';
      toast.innerHTML = `
        <div class="flex items-center gap-2">
          <i class="fas ${type === 'success' ? 'fa-check-circle text-green-500' : 'fa-exclamation-circle text-red-500'}"></i>
          <span class="text-sm">${message}</span>
        </div>
      `;
      document.body.appendChild(toast);
      setTimeout(() => toast.remove(), 3000);
    }

    // Vérifier les paramètres d'URL pour les messages de succès/erreur
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('reset') === 'sent') {
      showToast('Un lien de réinitialisation a été envoyé à votre email', 'success');
      // Nettoyer l'URL
      window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Add some interactive effects
    document.querySelectorAll('.input-group input').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'translateX(5px)';
      });
      input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateX(0)';
      });
    });
  </script>
</body>
</html>