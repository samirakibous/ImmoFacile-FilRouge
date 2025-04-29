@props(['property', 'canEdit' => false])

<div class="relative max-w-md mx-auto bg-white rounded-xl overflow-hidden shadow-xl transition-all duration-300 hover:shadow-2xl group">
    <!-- Badge de statut (vente/location) -->
    @if($property->type)
        <div class="absolute top-4 left-4 z-10">
            <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                {{ $property->type }}
            </span>
        </div>
    @endif

    <!-- Image de la propriété avec overlay au survol -->
    <div class="relative">
        <img class="w-full h-80 object-cover transition-all duration-300 group-hover:brightness-95" 
             src="{{ asset('storage/' . ($property->coverImage?->image_url ?? 'image.png')) }}" 
             alt="{{ $property->title }}">
        
        <!-- Overlay avec boutons admin (visible uniquement au survol et si canEdit=true) -->
        @if($canEdit)
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <div class="flex space-x-3">
                    {{-- <a href="{{ route('admin.properties.edit', $property) }}"  --}}
                     <a href=""
                       class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <form action="{{ route('agent.properties.destroy', $property) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette propriété?')"
                                class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Informations de la propriété -->
    <div class="p-5">
        <!-- Badge premium si applicable -->
        <div class="flex justify-between items-center">
            <h3 class="font-bold text-xl text-gray-900 line-clamp-1">{{ $property->title }}</h3>
            @if($property->premium ?? false)
                <span class="bg-yellow-400 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">Premium</span>
            @endif
        </div>
        
        <!-- Adresse -->
        <div class="flex items-center text-gray-700 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-sm">{{ $property->adresse }}, {{ $property->code_postal }} {{ $property->ville }}</span>
        </div>
        
        <!-- Prix et caractéristiques -->
        <div class="flex justify-between items-center mt-3">
            <span class="text-lg font-bold text-orange-500">{{ number_format($property->price, 0, ',', ' ') }} €</span>
            <div class="flex items-center space-x-3">
                <div class="flex items-center" title="Surface">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                    </svg>
                    <span class="text-sm">{{ $property->surface }} m²</span>
                </div>
                
                <div class="flex items-center" title="Pièces">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-sm">{{ $property->rooms }}</span>
                </div>
                
                <div class="flex items-center" title="Chambres">
                   
                    <span class="text-sm">{{ $property->chambres }} ch.</span>
                </div>
            </div>
        </div>
        
        <!-- Description -->
        <p class="text-gray-600 text-sm mt-3 line-clamp-2 h-10">
            {{ Str::limit($property->description, 120) }}
        </p>
        
        <!-- Bouton -->
        <div class="text-center mt-4">
            <a href="{{ route('properties.show', $property) }}" 
               class="inline-block w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-full transition duration-300 text-center">
                Voir les détails
            </a>
        </div>
    </div>
</div>