<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
 
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #1a3a8f 0%, #2a52bf 100%);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">

        <!-- Titre -->
        <div class="text-center mb-6">
            <div class="w-14 h-14 bg-[#1a3a8f] rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-white text-xl">🔐</span>
            </div>

            <h2 class="text-2xl font-bold text-gray-800">
                Mot de passe oublié
            </h2>

            <p class="text-gray-500 text-sm mt-2">
                Entrez votre adresse email pour recevoir un lien de réinitialisation.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-lg text-center text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-center text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <label class="block mb-2 font-semibold text-gray-700">
                Email
            </label>

            <input 
                type="email" 
                name="email" 
                required
                class="w-full h-12 px-4 rounded-lg border border-gray-300 
                       focus:ring-2 focus:ring-[#1a3a8f] focus:outline-none mb-4"
                placeholder="Votre adresse email">

            <!-- Checkbox confirmation -->
            <div class="flex items-start mb-5">
                <input type="checkbox" id="confirmCheck"
                    class="mt-1 w-4 h-4 text-[#1a3a8f] rounded border-gray-300">
                <label for="confirmCheck" class="ml-2 text-sm text-gray-600 leading-tight">
                    Je confirme vouloir recevoir un lien de réinitialisation
                </label>
            </div>

            <!-- Button -->
            <button type="submit" id="submitBtn"
                disabled
                class="w-full py-3 bg-gray-400 text-white font-semibold rounded-lg 
                       cursor-not-allowed transition-all duration-200">
                Envoyer le lien
            </button>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}" 
                   class="text-sm text-[#1a3a8f] hover:underline">
                    ← Retour à la connexion
                </a>
            </div>
        </form>
    </div>

    <!-- Script original conservé -->
    <script>
        const check = document.getElementById('confirmCheck');
        const submitBtn = document.getElementById('submitBtn');

        check.addEventListener('change', () => {
            if (check.checked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.add('bg-[#1a3a8f]', 'hover:bg-[#122970]');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.remove('bg-[#1a3a8f]', 'hover:bg-[#122970]');
            }
        });
    </script>

</body>
</html>