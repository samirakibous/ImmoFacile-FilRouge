<!-- navbar.blade.php -->
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
            <li><a href="#" class="hover:text-orange-400">Home</a></li>
            <li><a href="{{ route('article') }}" class="hover:text-orange-400">Services</a></li>
            <li><a href="#" class="hover:text-orange-400">Contact</a></li>
            <li><a href="#" class="hover:text-orange-400">About</a></li>
            <li id="auth-links" class="hidden">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hover:text-orange-400">Logout</button>
                </form>
            </li>
        </ul>

      
      

        <li id="guest-links">
            <a href="{{ route('login') }}" class="hover:text-orange-400">Login</a>
            <a href="{{ route('register') }}" class="hover:text-orange-400">Sign Up</a>
        </li>
        <a href="{{ route('login') }}" class="hidden md:block bg-orange-500 px-4 py-2 rounded-full text-white">Login</a>
    </div>

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

            <a href="#" class="text-2xl hover:text-orange-400">Home</a>
            <a href="#" class="text-2xl hover:text-orange-400">Services</a>
            <a href="#" class="text-2xl hover:text-orange-400">Contact</a>
            <a href="#" class="text-2xl hover:text-orange-400">About</a>

            <a href="{{ route('login') }}" class="bg-orange-500 px-6 py-3 rounded-full text-white text-xl">Login</a>
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

    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('token'); // Vérifie si un token est stocké dans le localStorage

        if (token) {
            // Utilisateur authentifié
            document.getElementById('auth-links').classList.remove('hidden');
            document.getElementById('guest-links').classList.add('hidden');
        } else {
            // Utilisateur non authentifié
            document.getElementById('auth-links').classList.add('hidden');
            document.getElementById('guest-links').classList.remove('hidden');
        }
    });

    fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            // Traiter la réponse
            console.log(data);
        })
        .catch(error => console.error('Error:', error));
</script>
