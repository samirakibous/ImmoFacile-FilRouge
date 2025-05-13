@extends('layouts.app')

@section('title', 'Agents List')

@section('content')
    <x-navbar />
    <!-- Banner Section -->
    <div class="relative w-full h-64 bg-gray-800">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/building.jpg') }}')">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <!-- Content -->
        <div class="relative flex flex-col items-center justify-center h-full text-white">
            <h1 class="text-4xl font-bold mb-4">Nos Agents Immobiliers</h1>

            <!-- Breadcrumb -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('home') }}" class="hover:text-gray-300">Accueil</a>
                <span>/</span>
                <span class="text-orange-400">Agents</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <!-- Search and Filters -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- Search Form -->
                <form action="" method="GET" class="w-full md:w-1/2">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Rechercher un agent..."
                            value="{{ request('search') }}"
                            class="w-full py-3 px-4 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <button type="submit" class="absolute right-0 top-0 h-full px-4 flex items-center text-gray-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Filters -->
                <div class="flex gap-4 w-full md:w-auto">
                    <select name="specialty"
                        class="border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Spécialité</option>
                        <option value="residential">Résidentiel</option>
                        <option value="commercial">Commercial</option>
                        <option value="luxury">Luxe</option>
                    </select>

                    <select name="sort"
                        class="border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="newest">Plus récents</option>
                        <option value="rating">Meilleure note</option>
                        <option value="listings">Plus d'annonces</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Agents Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($agents as $agent)
                <div class="bg- rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Header avec photo et statut premium -->
                    <div class="relative h-40 bg-gray-100">
                        <!-- Image de couverture avec overlay -->
                        <div class="h-full">
                            <img src="{{ $agent->profile_picture ? asset('storage/' . $agent->profile_picture) : asset('images/cover-default.jpg') }}"
                                alt="Cover for {{ $agent->name }}" class="w-full h-full object-cover">
                            <!-- Overlay subtil -->
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                        </div>

                        <!-- Badge premium -->
                        @if ($agent->is_featured)
                            <div
                                class="absolute top-3 right-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-semibold px-2 py-1 rounded shadow-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                                Premium
                            </div>
                        @endif

                        <!-- Photo de profil et nom en position absolue -->
                        <div class="absolute bottom-0 left-0 w-full px-4 pb-2 flex items-end">
                            <div class="flex items-center">
                                <div class="mr-3 w-16 h-16 rounded-full border-2 border-white overflow-hidden shadow-md">
                                    <img src="{{ $agent->profile_picture ? asset('storage/' . $agent->profile_picture) : asset('images/avatar-default.jpg') }}"
                                        alt="{{ $agent->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="text-white">
                                    <h3 class="text-lg font-bold leading-tight drop-shadow-sm">
                                        {{ $agent->name }}
                                    </h3>
                                    <div class="flex items-center text-sm">
                                        <span
                                            class="bg-blue-500/80 px-2 py-0.5 rounded text-xs">{{ $agent->specialty }}</span>
                                        <div class="flex items-center ml-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-amber-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span
                                                class="ml-1 text-sm font-medium">{{ number_format($agent->average_rating, 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Corps de la carte avec infos de contact -->
                    <div class="p-4">
                        <!-- Grid pour les informations de contact -->
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center mr-2 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <span class="text-gray-600 truncate">{{ $agent->agentProfile->adresse }}</span>
                            </div>

                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-2 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <span class="text-gray-600 truncate">{{ $agent->agentProfile->phone }}</span>
                            </div>

                            <div class="flex items-center col-span-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-2 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-gray-600 truncate">{{ $agent->email }}</span>
                            </div>
                        </div>

                        <!-- Stats d'agent -->
                        <div class="flex justify-between mt-4 pt-3 border-t border-gray-100 text-xs font-medium">
                            <div class="text-center">
                                <span
                                    class="block text-orange-500 font-bold text-base">{{ $agent->listings_count }}</span>
                                <span class="text-gray-500">Propriétés</span>
                            </div>

                            <div class="text-center">
                                <span class="block text-orange-500 font-bold text-base">{{ $agent->reviews_count }}</span>
                                <span class="text-gray-500">Avis</span>
                            </div>

                            <div class="text-center">
                                <span
                                    class="block text-orange-500 font-bold text-base">{{ $agent->created_at->diffForHumans(null, true) }}</span>
                                <span class="text-gray-500">Expérience</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions footer -->
                    <div class="flex border-t border-gray-100">
                        <a href="{{ route('profile.agent', $agent->id) }}"
                            class="flex-1 py-2.5 text-center text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Voir profil
                         </a>
                         
                        <a href="mailto:{{ $agent->email }}"
                            class="flex-1 py-2.5 text-center border-l border-gray-100 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Contact
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                    <i class="fas fa-user-slash text-5xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun agent trouvé</h3>
                    <p class="text-gray-500">Aucun agent ne correspond à vos critères de recherche.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
        </div>
    </div>
    <x-footer />
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
