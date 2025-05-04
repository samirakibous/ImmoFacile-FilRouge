
@extends('layouts.app')

@section('title', 'Facture #' . $numero_facture)

@section('content')
    <x-navbar />
    <div class="bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <!-- En-tête de la facture -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <div>
                    <div class="text-lg text-gray-700 font-medium">Votre Logo</div>
                    <div class="text-sm text-gray-500">votresite.com</div>
                </div>
                <div class="text-right">
                    <h1 class="text-2xl font-bold text-gray-800">FACTURE</h1>
                    <div class="text-sm text-gray-600">#{{ $numero_facture }}</div>
                </div>
            </div>

            <!-- Détails de facturation -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Facturé à</h2>
                    <div class="text-gray-700">
                        <div class="font-medium">{{ $user->name }}</div>
                        <div>{{ $user->email }}</div>
                        @if($user->address)
                            <div>{{ $user->address }}</div>
                        @endif
                        <div class="mt-2 text-sm text-gray-500">Client ID: {{ $user->id }}</div>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Détails de la facture</h2>
                    <div class="grid grid-cols-2 gap-2 text-gray-700">
                        <div class="text-gray-500">Date de facturation:</div>
                        <div>{{ $date_facture }}</div>
                        
                        <div class="text-gray-500">Statut du paiement:</div>
                        <div>
                            @if($paiement->status == 'succeeded')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Payé
                                </span>
                            @elseif($paiement->status == 'pending')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    En attente
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Échec
                                </span>
                            @endif
                        </div>
                        
                        <div class="text-gray-500">Méthode de paiement:</div>
                        <div>Carte bancaire</div>
                        
                        <div class="text-gray-500">ID de transaction:</div>
                        <div class="font-mono text-sm">{{ $paiement->id }}</div>
                    </div>
                </div>
            </div>

            <!-- Tableau des achats -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Détails de l'achat</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Prix unitaire</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($annonce->image)
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded object-cover" src="{{ asset('storage/'.$annonce->image) }}" alt="{{ $annonce->title }}">
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $annonce->title }}</div>
                                            <div class="text-sm text-gray-500">{{ $annonce->category->name ?? 'Non catégorisé' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                    {{ number_format($paiement->amount / 100, 2) }} {{ strtoupper($paiement->currency) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                    1
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                    {{ number_format($paiement->amount / 100, 2) }} {{ strtoupper($paiement->currency) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Résumé des totaux -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-end">
                    <div class="w-full md:w-64">
                        <div class="flex justify-between py-2 text-gray-600">
                            <div>Sous-total</div>
                            <div>{{ number_format($paiement->amount / 100, 2) }} {{ strtoupper($paiement->currency) }}</div>
                        </div>
                        <div class="flex justify-between py-2 text-gray-600">
                            <div>TVA (20%)</div>
                            <div>{{ number_format(($paiement->amount / 100) * 0.2, 2) }} {{ strtoupper($paiement->currency) }}</div>
                        </div>
                        <div class="flex justify-between py-2 font-bold text-gray-800 border-t border-gray-200">
                            <div>Total</div>
                            <div>{{ number_format($paiement->amount / 100, 2) }} {{ strtoupper($paiement->currency) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Remarques et conditions -->
            <div class="p-6 text-sm text-gray-500">
                <h3 class="font-semibold text-gray-700 mb-2">Remarques</h3>
                <p class="mb-4">
                    Merci pour votre achat. Pour toute question concernant cette facture, veuillez nous contacter à 
                    <a href="mailto:support@votresite.com" class="text-blue-600 hover:underline">support@votresite.com</a>
                </p>
                <p class="text-xs">
                    Les conditions générales de vente sont disponibles sur notre site web. Le paiement est dû dans les 30 jours suivant la réception de la facture.
                </p>
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center p-6 bg-gray-50">
                <a href="{{ route('achats.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour aux achats
                </a>

                <div class="flex space-x-3">
                    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Imprimer
                    </button>
                    
                    <a href="{{ route('factures.download', $paiement->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Télécharger PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Styles pour l'impression -->
        <style type="text/css" media="print">
            @page {
                size: A4;
                margin: 0;
            }
            body {
                margin: 1.6cm;
            }
            .no-print, .no-print * {
                display: none !important;
            }
        </style>
    </div>
@endsection