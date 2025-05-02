@extends('layouts.app')

@section('title', 'ImmoFacile - Votre partenaire immobilier de confiance')

@section('content')
    <!-- Navbar -->
    <x-navbar />

    <!-- Hero Section avec Parallax -->
    <div class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center transform scale-110 transition-transform duration-3000" 
             style="background-image: url({{ asset('images/background.jpg') }}); transform-origin: center center;" 
             id="parallax-bg"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-orange-500/40"></div>

        <div class="relative flex flex-col items-center justify-center h-full text-white text-center px-4">
            <h1 class="text-4xl md:text-6xl font-poppins font-extrabold tracking-wide text-white mb-6 animate-fadeIn">
                <span class="text-white">Trouvez votre</span> <span class="text-orange-400">chez-vous</span> <span class="text-white">idéal</span>
            </h1>
            
            <p class="mt-4 text-xl md:text-2xl w-full md:w-3/4 lg:w-1/2 font-light text-gray-100 leading-relaxed mb-8 animate-fadeInUp">
                Votre partenaire de confiance pour tous vos projets immobiliers.
                Des solutions simples pour des décisions importantes.
            </p>
            
            <!-- Barre de recherche avancée -->
            <div class="w-full max-w-4xl bg-white/90 backdrop-blur-md rounded-xl shadow-2xl p-4 md:p-6 animate-fadeInUp transition-all duration-300 hover:shadow-orange-300/20">
                <form action="{{ route('properties.search') }}" method="GET" class="flex flex-col md:flex-row gap-3 md:gap-4">
                    <div class="flex-1">
                        <label class="block text-gray-700 text-sm font-medium mb-1 text-left">Type de bien</label>
                        <select name="property_type" class="w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
                            <option value="">Tous les types</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('property_type') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex-1">
                        <label class="block text-gray-700 text-sm font-medium mb-1 text-left">Localisation</label>
                        <input name="city" type="text" placeholder="Ville, quartier..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>
                    
                    <div class="flex-1">
                        <label class="block text-gray-700 text-sm font-medium mb-1 text-left">Budget max</label>
                        <select name="max_price" class="w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
                            <option value="">Tous les prix</option>
                            <option value="100000">100 000 €</option>
                            <option value="200000">200 000 €</option>
                            <option value="300000">300 000 €</option>
                            <option value="500000">500 000 €</option>
                            <option value="1000000">1 000 000 €</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full md:w-auto bg-orange-500 hover:bg-orange-600 text-white py-3 px-6 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Message de bienvenue personnalisé -->
            @auth
                <div class="mt-8 animate-fadeInUp bg-white/20 backdrop-blur-sm rounded-xl p-4 shadow-lg transition-all duration-300 hover:bg-white/30">
                    <p class="text-xl font-medium">Bienvenue, <span class="font-semibold text-orange-300">{{ Auth::user()->name }}</span> !</p>
                    <div class="mt-3 flex gap-4 justify-center">
                        @if (Auth::user()->role->name === 'agent')
                            <a href="{{ route('profile.agent', Auth::user()->id) }}" class="text-white bg-orange-500/80 hover:bg-orange-500 px-4 py-2 rounded-lg transition-all duration-300 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mon profil
                            </a>
                        @else
                            <a href="{{ route('profile.index') }}" class="text-white bg-orange-500/80 hover:bg-orange-500 px-4 py-2 rounded-lg transition-all duration-300 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mon profil
                            </a>
                        @endif
                        <a href="#featured-properties" class="text-white bg-gray-700/80 hover:bg-gray-700 px-4 py-2 rounded-lg transition-all duration-300 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            Explorer les biens
                        </a>
                    </div>
                </div>
            @else
                <div class="mt-8 animate-fadeInUp">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('login') }}" class="bg-white text-orange-500 hover:bg-gray-100 px-6 py-3 rounded-full shadow-lg transition-all duration-300 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Se connecter
                        </a>
                        <a href="{{ route('signup') }}" class="bg-orange-500 text-white hover:bg-orange-600 px-6 py-3 rounded-full shadow-lg transition-all duration-300 font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Créer un compte
                        </a>
                    </div>
                </div>
            @endauth
            
            <!-- Scroll down indicator -->
            <div class="absolute bottom-8 animate-bounce">
                <a href="#featured-properties" class="text-white hover:text-orange-300 focus:outline-none transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Nos services section -->
    <section id="featured-properties" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nos services immobiliers</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Découvrez comment ImmoFacile peut vous aider à réaliser vos projets immobiliers en toute simplicité.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                    <div class="p-1 bg-gradient-to-r from-orange-500 to-red-500"></div>
                    <div class="p-6">
                        <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Achat immobilier</h3>
                        <p class="text-gray-600 mb-4">Trouvez la propriété de vos rêves avec l'aide de nos agents experts</p>
                        <a href="#" class="text-orange-500 font-medium inline-flex items-center">
                            Découvrir
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                    <div class="p-1 bg-gradient-to-r from-orange-500 to-red-500"></div>
                    <div class="p-6">
                        <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Location saisonnière</h3>
                        <p class="text-gray-600 mb-4">Des locations courte ou longue durée adaptées à vos besoins</p>
                        <a href="{{ route('louer') }}" class="text-orange-500 font-medium inline-flex items-center">
                            Découvrir
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="featured-properties" class="py-16 bg-gray-50">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($properties as $property)
                <x-property-card :property="$property" />
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Aucun bien immobilier disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- Call to action section -->
    {{-- <section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Prêt à trouver votre bien immobilier idéal?</h2>
                <p class="text-xl text-gray-300 mb-8">Nos experts sont disponibles pour vous accompagner dans toutes vos démarches.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-lg shadow-lg transition-all duration-300 font-medium inline-flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Contacter un agent
                    </a>
                    <a href="#" class="bg-white hover:bg-gray-100 text-gray-800 px-8 py-4 rounded-lg shadow-lg transition-all duration-300 font-medium inline-flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Demander une estimation
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
    <x-footer />
@endsection
    
   