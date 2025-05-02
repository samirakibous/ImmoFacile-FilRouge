<nav class="bg-gradient-to-r from-gray-900 to-gray-800 text-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <!-- Logo avec effet amélioré -->
        <a href="{{ route('home') }}" class="text-2xl font-poly tracking-wider text-white hover:text-orange-400 transition duration-300 flex items-center">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </span>
            <span class="font-bold">Immo<span class="text-orange-500">Facile</span></span>
        </a>

        <!-- Bouton Hamburger (visible sur mobile) -->
        <button id="mobile-menu-toggle" class="md:hidden focus:outline-none hover:text-orange-400 transition duration-300">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Menu pour desktop -->
        <div class="hidden md:flex items-center space-x-1">
            <ul class="flex space-x-2">
                @auth
                    <li><a href="{{ route('home') }}" class="px-3 py-2 rounded-md hover:bg-gray-700 hover:text-orange-400 transition duration-300">Accueil</a></li>
                    <li><a href="{{ route('vendre') }}" class="px-3 py-2 rounded-md hover:bg-gray-700 hover:text-orange-400 transition duration-300">Vendre</a></li>
                    <li><a href="{{ route('louer') }}" class="px-3 py-2 rounded-md hover:bg-gray-700 hover:text-orange-400 transition duration-300">Location</a></li>
                    <li><a href="#" class="px-3 py-2 rounded-md hover:bg-gray-700 hover:text-orange-400 transition duration-300">Estimation</a></li>
                    <li><a href="{{ route('agentsList') }}" class="px-3 py-2 rounded-md hover:bg-gray-700 hover:text-orange-400 transition duration-300">Agents</a></li>

                    <!-- Menu profil avec dropdown amélioré -->
                    @if (Auth::user()->role->name != 'admin')
                        <li class="relative group ml-4">
                            <button class="focus:outline-none flex items-center space-x-1">
                                <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'image.png')) }}" 
                                     alt="Profile" 
                                     class="w-10 h-10 rounded-full object-cover border-2 border-orange-500 hover:border-orange-400 transition duration-300 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <ul class="absolute right-0  bg-gray-800 text-white border border-gray-700 rounded-lg shadow-xl w-48 hidden group-hover:block z-50 transform origin-top scale-95 group-hover:scale-100 transition duration-200">
                                <li class="border-b border-gray-700">
                                    @if (Auth::user()->role->name === 'agent')
                                        <a href="{{ route('profile.agent', Auth::user()->id) }}" class="block px-4 py-3 hover:bg-gray-700 hover:text-orange-400 transition duration-300 rounded-t-lg flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Profil
                                        </a>
                                    @else
                                        <a href="{{ route('profile.index') }}" class="block px-4 py-3 hover:bg-gray-700 hover:text-orange-400 transition duration-300 rounded-t-lg flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Profil
                                        </a>
                                    @endif
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-3 hover:bg-gray-700 hover:text-orange-400 transition duration-300 rounded-b-lg flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            @guest
                <div class="flex gap-3 ml-4">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-full bg-gray-700 hover:bg-gray-600 text-white hover:text-orange-400 transition duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Connexion
                    </a>
                    <a href="{{ route('signup') }}" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white transition duration-300 shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Inscription
                    </a>
                </div>
            @endguest
        </div>

        <!-- Menu mobile modernisé -->
        <div id="mobile-menu" class="md:hidden fixed inset-0 bg-black bg-opacity-90 z-50 hidden transform transition-all duration-300">
            <div class="flex flex-col items-center justify-center h-full space-y-6">
                <button id="mobile-menu-close" class="absolute top-6 right-6 text-white hover:text-orange-400 transition duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                @auth
                    <a href="{{ route('home') }}" class="text-xl hover:text-orange-400 transition duration-300 py-2">Accueil</a>
                    <a href="{{ route('vendre') }}" class="text-xl hover:text-orange-400 transition duration-300 py-2">Vendre</a>
                    <a href="{{ route('louer') }}" class="text-xl hover:text-orange-400 transition duration-300 py-2">Location</a>
                    <a href="#" class="text-xl hover:text-orange-400 transition duration-300 py-2">Estimation</a>
                    <a href="{{ route('agentsList') }}" class="text-xl hover:text-orange-400 transition duration-300 py-2">Agents</a>
                    
                    @if (Auth::user()->role->name != 'admin')
                        <div class="flex flex-col items-center mt-4">
                            <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'image.png')) }}" 
                                alt="Profile" 
                                class="w-16 h-16 rounded-full object-cover border-2 border-orange-500 shadow-lg mb-2">
                            
                            @if (Auth::user()->role->name === 'agent')
                                <a href="{{ route('profile.agent', Auth::user()->id) }}" class="text-xl hover:text-orange-400 transition duration-300 py-2">Mon Profil</a>
                            @else
                                <a href="{{ route('profile.index') }}" class="text-xl hover:text-orange-400 transition duration-300 py-2">Mon Profil</a>
                            @endif
                            
                            <form action="{{ route('logout') }}" method="POST" class="m-0 mt-4">
                                @csrf
                                <button type="submit" class="bg-orange-500 hover:bg-orange-600 px-6 py-2 rounded-full text-white transition duration-300">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth

                @guest
                    <div class="flex flex-col space-y-4 w-3/4 max-w-xs">
                        <a href="{{ route('login') }}" class="bg-gray-700 hover:bg-gray-600 px-6 py-3 rounded-full text-white text-center text-lg transition duration-300 shadow-md hover:shadow-lg">Connexion</a>
                        <a href="{{ route('signup') }}" class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded-full text-white text-center text-lg transition duration-300 shadow-md hover:shadow-lg">Inscription</a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            // Animation d'entrée
            setTimeout(() => {
                mobileMenu.classList.add('opacity-100');
            }, 50);
        });

        mobileMenuClose.addEventListener('click', () => {
            // Animation de sortie
            mobileMenu.classList.remove('opacity-100');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        });
    });
</script>