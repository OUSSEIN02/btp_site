<header class="bg-white border-b border-gray-200 shadow-sm px-4 sm:px-6 py-3.5 flex items-center justify-between sticky top-0 z-30">

    <div class="flex items-center gap-4">

        {{-- Bouton menu mobile --}}
        <button class="md:hidden text-gray-500 hover:text-blue-600 transition text-2xl"
                        @click="sidebarOpen = true" aria-label="Ouvrir le menu">
            <i class="fa-solid fa-bars"></i>
        </button>
        
     
    </div>

    <div class="hidden sm:block">
        {{-- Emplacement central vide --}}
    </div>


    <div class="flex items-center gap-3 sm:gap-4">
        
        {{-- Notifications Dropdown - CENTRÉ TOTALEMENT SUR MOBILE (x-cloak inclus) --}}
        <div x-data="{ open: false }" class="relative" x-cloak>

            <button @click="open = !open" 
                    class="relative p-2 rounded-full text-gray-500 hover:bg-gray-100 hover:text-blue-600 transition focus:outline-none"
                    aria-label="Notifications" :aria-expanded="open">
                <i class="fa-regular fa-bell text-xl"></i>

                @if($unreadMessagesCount > 0)
                    <span class="absolute top-0.5 right-0.5 bg-red-600 text-white text-xs rounded-full px-1.5 py-0.5 font-semibold leading-none shadow">
                        {{ $unreadMessagesCount }}
                    </span>
                @endif
            </button>

            {{-- DROPDOWN Content (Centré sur Mobile, Dropdown sur Desktop) --}}
            <div x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                
                {{-- CLASSES DE POSITIONNEMENT --}}
                class="bg-white shadow-2xl rounded-xl border border-gray-100 overflow-hidden z-50 origin-top-right
                       
                       {{-- COMPORTEMENT MOBILE (par défaut) --}}
                       fixed inset-0 m-auto max-h-[80vh] w-[90%] max-w-sm flex flex-col
                       
                       {{-- COMPORTEMENT PC (sm:) --}}
                       sm:absolute sm:mt-3 sm:w-80 sm:right-0 sm:inset-auto sm:m-0 sm:max-h-64 sm:flex-none" 
                style="height: fit-content;"
            >
                
                {{-- En-tête --}}
                <div class="px-4 py-2 font-bold text-gray-800 border-b text-sm sm:text-base flex-shrink-0">
                    Messages non lus ({{ $unreadMessagesCount }})
                </div>

                {{-- Corps des messages --}}
                <div class="flex-1 max-h-64 overflow-y-auto divide-y divide-gray-100">

                    @forelse($lastUnreadMessages as $msg)
                        <a href="{{ route('messages.show', $msg->id) }}"
                        class="block px-4 py-2.5 hover:bg-yellow-50 transition">
                            <p class="font-semibold text-gray-800 text-sm leading-tight">{{ $msg->email }}</p>
                            <p class="text-gray-600 text-xs mt-0.5 line-clamp-1">
                                <i class="fa-solid fa-comment-dots mr-1"></i> {{ Str::limit($msg->message, 30) }}
                            </p>
                        </a>
                    @empty
                        <p class="px-4 py-4 text-center text-gray-500 text-sm">
                            <i class="fa-solid fa-check-circle mr-1"></i> Aucun message non lu
                        </p>
                    @endforelse

                </div>

                {{-- Footer --}}
                <div class="border-t px-4 py-2 text-center bg-gray-50 flex-shrink-0">
                    <a href="{{ route('messages.index') }}"
                    class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                        Voir tous les messages ({{ $unreadMessagesCount }} non lus)
                    </a>
                </div>
            </div>
        </div>


        {{-- Profil Dropdown - DROPDOWN CLASSIQUE (x-cloak ajouté) --}}
        <div x-data="{ open: false }" class="relative" x-cloak>

            <button @click="open = !open"
                class="flex items-center gap-2 p-1.5 rounded-full hover:bg-gray-100 transition focus:outline-none"
                aria-label="Menu utilisateur" :aria-expanded="open">

                <div class="w-9 h-9 rounded-full bg-[#1a3a8f] flex items-center justify-center font-bold text-white text-sm shadow">
                    {{ auth()->user()->name[0] ?? 'A' }}
                </div>

                <span class="hidden lg:block font-medium text-gray-700 text-sm">
                    {{ auth()->user()->name ?? 'Administrateur' }}
                </span>

                <i :class="{'rotate-180': open, 'rotate-0': !open}" 
                   class="fa-solid fa-chevron-down text-xs text-gray-500 transition-transform hidden sm:block"></i>
            </button>

            {{-- Dropdown Content --}}
            <div x-show="open"
                 @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50 divide-y divide-gray-100 origin-top-right">

                <div class="px-4 py-3">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->name ?? 'Administrateur' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'admin@site.com' }}</p>
                </div>
                
             

                <button onclick="document.getElementById('open-modal').click()"
                        class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                    <i class="fa-solid fa-right-from-bracket w-4"></i> Déconnexion
                </button>
            </div>

        </div>
    </div>
</header>