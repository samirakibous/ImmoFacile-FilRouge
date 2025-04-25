<nav class="bg-[#262626] text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <a href="{{ route('home') }}" class="text-2xl font-poly tracking-[.50em]">ImmoFacile</a>

        <!-- Bouton Hamburger (visible sur mobile) -->
        <button id="mobile-menu-toggle" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Menu pour desktop -->
        <ul class="hidden md:flex space-x-6">
            {{-- <li><a href="{{ route('home') }}" class="hover:text-orange-400">Home</a></li> --}}
            {{-- <li><a href="" class="hover:text-orange-400">Services</a></li>
            <li><a href="" class="hover:text-orange-400">Contact</a></li>
            <li><a href="" class="hover:text-orange-400">About</a></li> --}}

            @auth
                <li><a href="{{ route('home') }}" class="hover:text-orange-400">Home</a></li>
                <li><a href="#" class="hover:text-orange-400">Vendre</a></li>
                <li><a href="#" class="hover:text-orange-400">Location</a></li>
                <li><a href="#" class="hover:text-orange-400">Estimation</a></li>
                <li><a href="{{ route('agentsList') }}" class="hover:text-orange-400">Agent Immobilier</a></li>

                <!-- Menu profil avec dropdown -->
                @if (Auth::user()->role->name != 'admin')
                    <li class="relative group">
                        <button class="focus:outline-none">
                            <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'image.png')) }}"
                                alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-orange-400">
                        </button>

                        <!-- Dropdown menu -->
                        <ul
                            class="absolute right-0 bg-white text-black border border-gray-200 rounded shadow-md w-40 hidden group-hover:block z-50">
                            <li>
                                @if (Auth::user()->role->name === 'agent')
                                <a href="{{ route('profile.agent',Auth::user()->id) }}"
                                    class="block px-4 py-2 hover:bg-orange-100">Profil</a>
                                @else
                                <a href="{{ route('profile.index') }}"
                                    class="block px-4 py-2 hover:bg-orange-100">Profil</a>
                                @endif
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-orange-100">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif

            @endauth

        </ul>

        @guest
            <div class="flex gap-4">
                <a href="{{ route('login') }}"
                    class="hidden md:block bg-orange-500 px-4 py-2 rounded-full text-white">Login</a>
                <a href="{{ route('signup') }}" class="hidden md:block bg-orange-500 px-4 py-2 rounded-full text-white">Sign
                    Up</a>
            </div>
        @endguest

        <!-- Menu mobile -->
        <div id="mobile-menu" class="md:hidden fixed inset-0 bg-[#262626] opacity-80 z-50 hidden">
            <div class="flex flex-col items-center justify-center h-full space-y-6">
                <button id="mobile-menu-close" class="absolute top-4 right-4 text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="text-2xl hover:text-orange-400">Home</a>
                <a href="" class="text-2xl hover:text-orange-400">Services</a>
                <a href="" class="text-2xl hover:text-orange-400">Contact</a>
                <a href="" class="text-2xl hover:text-orange-400">About</a>

                @guest
                    <a href="{{ route('login') }}" class="bg-orange-500 px-6 py-3 rounded-full text-white text-xl">Login</a>
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
        });

        mobileMenuClose.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
</script>
