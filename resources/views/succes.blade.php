@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- En-tête avec cercle de succès -->
        <div class="bg-green-500 py-6 px-4 sm:px-6 text-center">
            <div class="mx-auto rounded-full bg-white h-16 w-16 flex items-center justify-center mb-4">
                <svg class="h-10 w-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">Paiement réussi !</h1>
        </div>

        <!-- Corps du message -->
        <div class="py-8 px-4 sm:px-6 text-center">
            <div class="mb-6">
                <p class="text-gray-700 text-lg mb-4">Votre paiement pour l'annonce a été effectué avec succès.</p>
                <p class="text-gray-500 text-sm">Un email de confirmation a été envoyé à votre adresse email.</p>
            </div>

            <!-- Détails du paiement (optionnel, peut être ajouté selon vos besoins) -->
            <div class="border-t border-b border-gray-200 py-4 mb-6">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500">Numéro de transaction</span>
                    <span class="text-gray-700 font-medium">{{ $transaction->id ?? 'TRX-'.rand(100000, 999999) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Date</span>
                    <span class="text-gray-700 font-medium">{{ now()->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="w-full flex items-center justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Retour à l'accueil
                </a>
                {{-- <a href="{{ route('annonces.show', $annonce->id ?? 1) }}" class="w-full flex items-center justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Voir mon annonce
                </a> --}}
            </div>
        </div>
    </div>
</div>
@endsection