<!-- Responsive Sidebar -->
<div class="relative">
    <!-- Mobile menu button -->
    <div class="lg:hidden fixed top-0 left-0 z-40 w-full bg-white shadow-sm p-4 flex justify-between items-center">
        <div class="flex items-center">
            <button id="mobile-menu-button" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <span class="ml-4 font-semibold text-gray-800">Admin Panel</span>
        </div>
        
        <!-- Mobile logout button -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </form>
    </div>

    <!-- Sidebar container -->
    <div id="sidebar" class="fixed inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition duration-300 ease-in-out lg:relative lg:inset-0">
        <div class="h-full w-64 bg-white shadow-sm p-5 overflow-y-auto">
            <div class="pt-5 lg:pt-0">
                <h2 class="text-xl font-bold text-gray-800 mb-6 hidden lg:block">Admin Dashboard</h2>
            </div>
            
            <div class="space-y-1">
                <a href="{{ route('admin.index') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
                     {{ request()->routeIs('admin.index') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <rect x="3" y="3" width="7" height="9" />
                        <rect x="14" y="3" width="7" height="5" />
                        <rect x="14" y="12" width="7" height="9" />
                        <rect x="3" y="16" width="7" height="5" />
                    </svg>
                    Dashboard
                </a>
                <a href="#" 
                    class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Annonces
                </a>
                <a href="{{ route('admin.demandes') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
                     {{ request()->routeIs('admin.demandes') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Demandes
                </a>
                <a href="{{ route('admin.users') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
                    {{ request()->routeIs('admin.users') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
                {{-- <a href="{{ route('admin.statistics') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
                    {{ request()->routeIs('admin.statistics') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Statistiques
                </a> --}}
                <a href="{{ route('admin.categories') }}" 
                    class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
                    {{ request()->routeIs('admin.categories') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Categories
                </a>
                <div class="hidden lg:block pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center px-4 py-3 text-sm rounded-lg w-full text-gray-600 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out lg:hidden"></div>
</div>

<!-- JavaScript for mobile sidebar toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        function toggleSidebar() {
            const isOpen = sidebar.classList.contains('translate-x-0');
            
            if (isOpen) {
                // Close sidebar
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-50');
                overlay.classList.add('opacity-0');
                overlay.classList.add('pointer-events-none');
            } else {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('opacity-0');
                overlay.classList.remove('pointer-events-none');
                overlay.classList.add('opacity-50');
            }
        }
        
        // Toggle sidebar when mobile menu button is clicked
        mobileMenuButton.addEventListener('click', toggleSidebar);
        
        // Close sidebar when overlay is clicked
        overlay.addEventListener('click', toggleSidebar);
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) { // lg breakpoint
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('opacity-50');
                overlay.classList.add('opacity-0');
                overlay.classList.add('pointer-events-none');
            } else {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
        });
    });
</script>