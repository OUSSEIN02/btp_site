<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Administration ')</title>

   

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
          <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;600&family=Satisfy&display=swap" rel="stylesheet">
   
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
           
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
        .satisfy {
            font-family: 'Satisfy', cursive;
        }

        @keyframes fade {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex overflow-hidden"
      x-data="{ sidebarOpen: false }">

    <!-- ================= SIDEBAR ================= -->
    <aside
        class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-[#1a3a8f] px-6 py-8 flex flex-col
               transform transition-transform duration-300
               md:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-10">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow">
                <i class="fa-solid fa-helmet-safety text-[#1a3a8f] text-xl"></i>
            </div>
            <h2 class="text-2xl font-extrabold  satisfy text-[#FFF]">
                BTP
            </h2>
        </div>

        <!-- NAV -->
        <nav class="space-y-2 flex-1">
        <a href="{{ route('realisations.index') }}"
        @click="sidebarOpen = false"
        class="flex items-center gap-3 py-2 px-3 rounded-md font-medium text-[#FFF]
        {{ request()->routeIs('realisations.index') ? 'bg-white/40' : 'hover:bg-white/40' }}">
            <i class="fa-solid fa-list-check"></i> Nos réalisations
        </a>

        <a href="{{ route('realisations.create') }}"
        @click="sidebarOpen = false"
        class="flex items-center gap-3 py-2 px-3 rounded-md font-medium text-[#FFF]
        {{ request()->routeIs('realisations.create') ? 'bg-white/40' : 'hover:bg-white/40' }}">
            <i class="fa-solid fa-plus-circle"></i> Ajouter une réalisation
        </a>

        <a href="{{ route('messages.index') }}"
            @click="sidebarOpen = false"
            class="flex items-center gap-3 py-2 px-3 rounded-md font-medium text-[#FFF]
            {{ request()->routeIs('messages.*') ? 'bg-white/40' : 'hover:bg-white/40' }}">
                <i class="fa-solid fa-envelope"></i> Messages
        </a>

        <a href="{{ route('settings.index') }}"
            @click="sidebarOpen = false"
            class="flex items-center gap-3 py-2 px-3 rounded-md font-medium text-[#FFF] 
            {{ request()->routeIs('settings.*') ? 'bg-white/40' : 'hover:bg-white/40' }}">
            <i class="fa-solid fa-gear"></i> Paramètres
        </a>
        <button id="open-modal"
            class="text-white flex items-center gap-2 px-3 py-2 hover:bg-white/20 rounded">
            <i class="fa-solid fa-right-from-bracket"></i>
            Déconnexion
        </button>
        <!-- LOGOUT -->
        
    </aside>

    <!-- OVERLAY MOBILE -->
    <div
        class="fixed inset-0 bg-black/40 z-30 md:hidden"
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false">
    </div>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">

        @include('layouts.partials.topbar')
        <!-- CONTENT -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-100">
            @yield('content')
        </main>
    </div>

    <!-- ================= MODALE LOGOUT ================= -->
    <div id="logout-modal"
         class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">

        <div id="modal-box"
             class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6
                    scale-90 opacity-0 transition-all duration-200">

            <h2 class="text-xl font-bold mb-3">Déconnexion</h2>

            <p class="text-gray-600 mb-6">
                Es-tu sûr de vouloir te déconnecter ?
            </p>

            <div class="flex justify-end gap-3">
                <button id="close-modal"
                        class="px-4 py-2 border rounded-lg">
                    Annuler
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 rounded-lg bg-red-600 text-white">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- TOAST -->
    @if (session('success') || session('error') || $errors->any())
        @php
            if ($errors->any()) {
                $toastMessage = implode('<br>', $errors->all());
                $toastColor = 'bg-[#1a3a8f]';
            } elseif (session('error')) {
                $toastMessage = session('error');
                $toastColor = 'bg-[#1a3a8f]';
            } else {
                $toastMessage = session('success');
                $toastColor = 'bg-[#1a3a8f]';
            }
        @endphp

        <div id="notif"
            class="fixed top-5 right-5 px-5 py-4 rounded-lg shadow-lg text-white {{ $toastColor }}
            opacity-0 translate-x-10 transition-all duration-500 z-50 max-w-xs">
            {!! $toastMessage !!}
        </div>

        <script>
            const notif = document.getElementById('notif');
            if (notif) {
               // Apparition
                setTimeout(() => {
                    notif.classList.remove('opacity-0', 'translate-x-10', 'hidden');
                }, 200);

                // Disparition
                setTimeout(() => {
                    notif.classList.add('opacity-0', 'translate-x-10');

                    // On attend la fin de la transition (300ms par défaut)
                    setTimeout(() => {
                        notif.classList.add('hidden');
                    }, 300);

                }, 4000);

            }
        </script>
    @endif

    <!-- ================= JS MODALE ================= -->
    <script>
        const openModalBtn = document.getElementById('open-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const modal = document.getElementById('logout-modal');
        const modalBox = document.getElementById('modal-box');

        openModalBtn?.addEventListener('click', () => {
            modal.classList.remove('hidden');
            setTimeout(() => modalBox.classList.remove('opacity-0','scale-90'), 10);
        });

        closeModalBtn?.addEventListener('click', () => {
            modalBox.classList.add('opacity-0','scale-90');
            setTimeout(() => modal.classList.add('hidden'), 150);
        });
    </script>

</body>
</html>
