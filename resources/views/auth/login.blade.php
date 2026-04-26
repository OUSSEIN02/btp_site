<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion Admin</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #1a3a8f 0%, #2a52bf 100%);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <!-- Logo / Titre -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto shadow-lg">
                <i class="fas fa-user-shield text-2xl text-[#1a3a8f]"></i>
            </div>
            <h1 class="text-2xl font-bold text-white mt-4">
                Espace Administrateur
            </h1>
            <p class="text-white text-sm opacity-80">
                Connectez-vous pour accéder au dashboard
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">

            <!-- Erreurs -->
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm p-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm p-3 rounded-lg mb-4">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1a3a8f] focus:border-transparent"
                            placeholder="admin@exemple.com"
                        >
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            required
                            class="w-full border border-gray-300 rounded-lg pl-10 pr-10 py-3 focus:outline-none focus:ring-2 focus:ring-[#1a3a8f] focus:border-transparent"
                            placeholder="••••••••"
                        >
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <button type="button" onclick="togglePassword()" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a3a8f]">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Forgot -->
                <div class="flex justify-between items-center mb-6">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="mr-2">
                        Se souvenir de moi
                    </label>

                    <a href="{{ route('password.request') }}"
                        class="text-sm text-[#1a3a8f] hover:underline">
                        Mot de passe oublié ?
                    </a>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-[#1a3a8f] text-white font-semibold py-3 rounded-lg hover:bg-[#122970] transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Se connecter
                </button>

            </form>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>