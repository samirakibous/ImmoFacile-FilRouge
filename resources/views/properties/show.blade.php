@extends('layouts.app')

@section('content')
<x-navbar />

<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-xl overflow-hidden">
        <!-- Header avec image principale et infos clés superposées -->
        <div class="relative">
            <img src="{{ asset($property->getFirstImageUrl()) }}"
                 alt="{{ $property->title }}"
                 class="w-full h-[500px] object-cover">
            
            <!-- Overlay gradient au bas de l'image -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            
            <!-- Prix et titre superposés sur l'image -->
            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                <h1 class="text-4xl font-bold mb-2">{{ $property->title }}</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-3xl font-bold">{{ number_format($property->price, 0, ',', ' ') }} €</span>
                    <span class="bg-indigo-600 px-3 py-1 rounded-full text-sm">{{ ucfirst($property->type_transaction) }}</span>
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- Menu rapide de navigation -->
            <div class="flex flex-wrap gap-4 mb-8 text-sm font-medium">
                <a href="#infos" class="text-indigo-600 hover:text-indigo-800">Informations</a>
                <a href="#features" class="text-indigo-600 hover:text-indigo-800">Équipements</a>
                <a href="#description" class="text-indigo-600 hover:text-indigo-800">Description</a>
                <a href="#gallery" class="text-indigo-600 hover:text-indigo-800">Galerie</a>
            </div>

            <!-- Bouton d'achat / contact -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-4">
                    <form action="{{ route('checkout.session', $property->id) }}" method="POST">
                        @csrf
                    <button  type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition transform hover:scale-105">
                        Acheter cette propriété
                    </button>
                </form>
                </div>

                <div class="flex gap-2">
                    {{-- <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button> --}}
                     @if (auth()->id() === $property->user_id)
                     <form  id="deleteForm" method="POST" action="{{ route('properties.destroy', $property->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Supprimer</button>
                    </form>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Caractéristiques principales avec icônes -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-3 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Surface</p>
                        <p class="font-bold">{{ $property->surface }} m²</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-3 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Chambres</p>
                        <p class="font-bold">{{ $property->chambres }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-3 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Construction</p>
                        <p class="font-bold">{{ $property->age }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-3 rounded-lg mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">SDB</p>
                        <p class="font-bold">{{ $property->salle_de_bain }}</p>
                    </div>
                </div>
            </div>

            <!-- Infos détaillées -->
            <div id="infos" class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Informations</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex items-start">
                        <div class="text-indigo-600 mr-2">📍</div>
                        <div>
                            <p class="text-gray-500 text-sm">Adresse</p>
                            <p>{{ $property->adresse }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="text-indigo-600 mr-2">🏙️</div>
                        <div>
                            <p class="text-gray-500 text-sm">Ville</p>
                            <p>{{ $property->ville }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="text-indigo-600 mr-2">📮</div>
                        <div>
                            <p class="text-gray-500 text-sm">Code Postal</p>
                            <p>{{ $property->code_postal }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="text-indigo-600 mr-2">🌍</div>
                        <div>
                            <p class="text-gray-500 text-sm">Pays</p>
                            <p>{{ $property->pays }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="text-indigo-600 mr-2">🏢</div>
                        <div>
                            <p class="text-gray-500 text-sm">Étages</p>
                            <p>{{ $property->etages }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="text-indigo-600 mr-2">🛠️</div>
                        <div>
                            <p class="text-gray-500 text-sm">Condition</p>
                            <p>{{ ucfirst(str_replace('_', ' ', $property->condition)) }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="text-indigo-600 mr-2">🏷️</div>
                        <div>
                            <p class="text-gray-500 text-sm">Catégorie</p>
                            <p>{{ $property->category->name ?? 'Non définie' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Équipements avec style de badges -->
            @php
                $features = json_decode($property->equipement, true);
            @endphp
            
            @if(!empty($features))
                <div id="features" class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Équipements</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($features as $feature)
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                {{ ucfirst(str_replace('_', ' ', $feature)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div id="description" class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Description</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($property->description)) !!}
                </div>
            </div>

            <!-- Galerie d'images -->
            @if ($property->images && $property->images->count() > 1)
                <div id="gallery" class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Galerie photos</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($property->images as $image)
                            <div class="overflow-hidden rounded-lg shadow-sm hover:shadow-md transition duration-300">
                                <img src="{{ asset('storage/' . $image->image_url) }}"
                                     alt="Image de la propriété"
                                     class="w-full h-56 object-cover transform hover:scale-105 transition duration-500 cursor-pointer">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection