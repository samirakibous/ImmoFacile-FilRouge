@extends('layouts.app')

@section('title', 'Favoris')

@section('content')
    <x-navbar />
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row gap-6">
            <x-profileSidebare />
            <!-- Content -->
            <div class="w-full md:w-3/4">
                    <div class="flex flex-col items-center justify-center py-12 rounded-lg shadow">
                        <img src="{{ asset('images/empty.png') }}" alt="Aucun favori" class="w-64 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Vous n'avez aucun favori</h2>
                        <p class="text-gray-500 mb-6 text-center">Parcourez notre catalogue et ajoutez des produits à vos favoris pour les retrouver ici.</p>
                        <a href={{ route('home') }} class="bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-8 rounded-full transition duration-300 shadow-md">
                            ajouter une favorie
                        </a>
                    </div>
                
            </div>
        </div>
    </div>
    <x-footer />
@endsection