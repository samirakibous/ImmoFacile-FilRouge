@extends('layouts.app')

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Image principale -->
        <img src="{{ asset($property->getFirstImageUrl()) }}" 
             alt="{{ $property->title }}"
             class="w-full h-96 object-cover">
        
        <div class="p-6">
            <h1 class="text-3xl font-bold">{{ $property->title }}</h1>
            
            <!-- Prix -->
            <div class="text-2xl my-4 text-indigo-600">
                {{ number_format($property->price, 0, ',', ' ') }} €
            </div>
            
            <!-- Détails -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
                <div class="flex items-center">
                    📏 {{ $property->surface }} m²
                </div>
                <div class="flex items-center">
                    🛏️ {{ $property->bedrooms }} chambres
                </div>
                <div class="flex items-center">
                    📍 {{ $property->address }}
                </div>
            </div>
            
            <!-- Description -->
            <div class="prose max-w-none mt-6">
                {!! nl2br(e($property->description)) !!}
            </div>
        </div>
    </div>
</div>
@endsection