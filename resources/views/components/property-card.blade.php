@props(['property']) 
<div class="relative max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
    <!-- Image de la propriété -->
    <img class="w-full h-80 object-cover" src="{{ asset('storage/' . ($property->coverImage?->image_url ?? 'image.png')) }}" alt="{{ $property->title }}">    
    <!-- Informations de la propriété -->
    <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-95 p-5 rounded-t-xl">
        <!-- Titre -->
        <h3 class="font-bold text-xl text-gray-900">{{ $property->title }}</h3>
        
        <!-- Adresse -->
        <div class="flex items-center text-gray-700 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-sm">{{ $property->address }}, {{ $property->postal_code }} {{ $property->city }}</span>
        </div>
        
        <!-- Prix et caractéristiques -->
        <div class="flex justify-between items-center mt-2">
            <span class="text-lg font-bold">{{ number_format($property->price, 0, ',', ' ') }} €</span>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                </svg>
                <span class="text-sm mr-3">{{ $property->surface }} m²</span>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-sm mr-3">{{ $property->rooms }}</span>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18v-6a9 9 0 0118 0v6" />
                </svg>
                <span class="text-sm">{{ $property->bedrooms }} ch.</span>
            </div>
        </div>
        
        <!-- Description -->
        <p class="text-gray-600 text-sm mt-3">
            {{ Str::limit($property->description, 100) }}
        </p>
        
        <!-- Bouton -->
        <div class="text-center mt-4">
            <a href="{{ route('properties.show', $property) }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-full transition duration-300">
                Voir les détails
            </a>
        </div>
    </div>
</div>