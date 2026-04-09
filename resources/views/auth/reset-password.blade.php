<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation Administrateur</title>

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
            🛡️ Réinitialisation du mot de passe (Admin)
        </h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Email + token -->
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="token" value="{{ $token }}">

            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <input type="email" value="{{ $email }}" disabled
                class="w-full h-11 px-3 rounded border border-gray-300 bg-gray-100 mb-4">

            <label class="block mb-1 font-semibold text-gray-700">Nouveau mot de passe</label>
            <input type="password" name="password" required
                class="w-full h-11 px-3 rounded border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:outline-none mb-4"
                placeholder="Votre mot de passe">

            <label class="block mb-1 font-semibold text-gray-700">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required
                class="w-full h-11 px-3 rounded border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:outline-none mb-6"
                placeholder="Confirmer">

            <button type="submit"
                class="w-full py-2 bg-green-600 hover:bg-green-700 transition text-white font-semibold rounded">
                Réinitialiser
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-blue-700 hover:underline">
                    Retour à la connexion
                </a>
            </div>
        </form>

    </div>

</body>
</html>
