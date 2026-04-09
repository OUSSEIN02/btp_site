<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1549742324-b463bc9dd374?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <div class="bg-white w-full max-w-md rounded-md shadow-md p-8">

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            🔐 Mot de passe oublié
        </h2>

        <p class="text-center text-gray-600 mb-4">
            Entrez votre adresse email pour recevoir un lien de réinitialisation.
        </p>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-center">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <input type="email" name="email" required
                class="w-full h-11 px-3 rounded border border-gray-300 
                       focus:ring-2 focus:ring-yellow-400 focus:outline-none mb-4"
                placeholder="Votre adresse email">

            <!-- Checkbox confirmation -->
            <div class="flex items-center mb-4">
                <input type="checkbox" id="confirmCheck"
                    class="w-5 h-5 text-yellow-500 rounded border-gray-300">
                <label for="confirmCheck" class="ml-2 text-gray-700">
                    Je confirme vouloir recevoir un lien de réinitialisation
                </label>
            </div>

            <!-- Button -->
            <button type="submit" id="submitBtn"
                disabled
                class="w-full py-2 bg-gray-400 text-white font-semibold rounded cursor-not-allowed transition">
                Envoyer le lien
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-blue-700 hover:underline">
                    Retour à la connexion
                </a>
            </div>
        </form>
    </div>

    <!-- Script activation button -->
    <script>
        const check = document.getElementById('confirmCheck');
        const submitBtn = document.getElementById('submitBtn');

        check.addEventListener('change', () => {
            if (check.checked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.add('bg-yellow-400', 'hover:bg-yellow-500');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                submitBtn.classList.remove('bg-yellow-400', 'hover:bg-yellow-500');
            }
        });
    </script>

</body>
</html>
