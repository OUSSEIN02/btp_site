
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin </title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Satisfy&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        body {
            background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            
        }
        
        .satisfy {
            font-family: 'Satisfy', cursive;
        }
        
        /* Animation pour le formulaire */
        .login-form {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Effet de survol pour le bouton */
        .btn-login {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 196, 57, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        /* Style des inputs */
        .input-field {
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            transform: scale(1.02);
        }
        
        /* Message d'erreur animé */
        .error-message {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        /* Overlay pour meilleure lisibilité */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }
        
        /* Contenu au-dessus de l'overlay */
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body class="flex items-center justify-center p-4 content-wrapper">

    <div class="relative w-full max-w-[900px] h-auto md:h-[470px] bg-transparent mt-8 login-form">

        <!-- BLOC JAUNE (version responsive) -->
        <div class="md:absolute inset-0 bg-[#1a3a8f] rounded-md p-6 md:p-0 flex items-center md:block justify-center shadow-xl">
            <h1 class="text-white text-3xl md:text-[2.2rem] font-semibold satisfy md:absolute md:top-1/2 md:left-12 md:-translate-y-1/2 text-center md:text-left drop-shadow-lg">
                <i class="fas fa-wifi mr-2 text-white"></i>
                Espace administrateur
            </h1>
        </div>

        <!-- FORMULAIRE -->
        <form method="POST" action="{{ route('login.post') }}" class="
            bg-white w-full md:w-[480px] h-auto md:h-[470px] mx-auto
            md:absolute md:right-0 md:top-1/2 md:-translate-y-1/2
            rounded-md md:rounded-r-md md:rounded-tl-[210px] md:rounded-bl-[210px]
            p-6 md:p-10 flex flex-col justify-center shadow-2xl
        ">

            @csrf

            <!-- Logo -->
            <div class="text-center mb-4 md:hidden">
                <div class="w-16 h-16 bg-[#1a3a8f] rounded-full flex items-center justify-center mx-auto">
                    <i class="fas fa-user-shield text-2xl text-white"></i>
                </div>
                <h2 class="text-xl font-bold text-[#1a3a8f] mt-2">Connexion Admin</h2>
            </div>

            <!-- Email -->
            <label for="email" class="mb-2 text-[#1a3a8f] font-semibold flex items-center">
                <i class="fas fa-envelope mr-2"></i> Email
            </label>
            <input type="email" 
                id="email" 
                name="email" 
                placeholder="admin@exemple.com" 
                required
                value="{{ old('email') }}"
                class="mb-4 h-[45px] px-4 bg-[#f9f9f9] border-2 border-[#1a3a8f] rounded-full w-full
                        focus:outline-none focus:ring-2 focus:ring-[#1a3a8f] focus:border-transparent">

            @error('email')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <!-- Password -->
            <label for="password" class="mb-2 text-[#1a3a8f] font-semibold flex items-center">
                <i class="fas fa-lock mr-2"></i> Mot de passe
            </label>

            <div class="relative mb-4">
                <input type="password" 
                    id="password" 
                    name="password" 
                    placeholder="••••••••" 
                    required
                    class="h-[45px] px-4 bg-[#f9f9f9] border-2 border-[#1a3a8f] rounded-full w-full
                            focus:outline-none focus:ring-2 focus:ring-[#1a3a8f] pr-10">

                <button type="button" 
                        onclick="togglePassword()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#1a3a8f]">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>

            @error('password')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <!-- Forgot -->
            <div class="text-right mb-4">
            <a href="{{ route('password.request') }}"
            class="text-sm text-blue-600 hover:text-blue-800 hover:underline transition">
                Mot de passe oublié ?
            </a>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full md:w-[250px] mx-auto py-3 bg-[#1a3a8f] rounded-md 
                    text-white font-semibold text-lg hover:opacity-90 transition flex items-center justify-center gap-2">
                <i class="fas fa-sign-in-alt"></i>
                Se connecter
            </button>

            <!-- Success -->
            @if(session('success'))
                <div class="mt-4 text-green-600 text-center bg-green-50 p-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

        </form>
    </div>

    <!-- Script pour afficher/masquer le mot de passe -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Animation supplémentaire pour les inputs
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement?.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement?.classList.remove('focused');
            });
        });

        // Empêcher la soumission du formulaire si les champs sont vides
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs');
            }
        });
    </script>

</body>
</html>