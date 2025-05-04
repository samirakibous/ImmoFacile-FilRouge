@extends('layouts.app')

@section('title', 'Gestion des Annonces')

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <x-sidebar />
            <!-- Content -->
            <div class="w-full md:w-3/4 bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Annonces</h1>
                    <div class="flex space-x-2">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher une annonce..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                            <option value="">Toutes les annonces</option>
                            <option value="disponible">Disponibles</option>
                            <option value="vendu">Vendues</option>
                            <option value="paid">Payées</option>
                            <option value="unpaid">Non payées</option>
                        </select>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg p-4 text-white shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Total Annonces</p>
                                <p class="text-2xl font-bold">{{ $properties->count() }}</p>
                            </div>
                            <div class="bg-white bg-opacity-30 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Annonces Payées</p>
                                <p class="text-2xl font-bold">{{ $properties->where('is_paid', true)->count() }}</p>
                            </div>
                            <div class="bg-white bg-opacity-30 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Disponibles</p>
                                <p class="text-2xl font-bold">{{ $properties->where('status', 'disponible')->count() }}</p>
                            </div>
                            <div class="bg-white bg-opacity-30 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-4 text-white shadow-md">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-white text-opacity-80 text-sm">Prix Moyen</p>
                                <p class="text-2xl font-bold">{{ number_format($properties->avg('price'), 2) }} €</p>
                            </div>
                            <div class="bg-white bg-opacity-30 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                @if($properties->count() > 0)
                    <div class="bg-white rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Propriété</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($properties as $property)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @php
                                                    $coverImage = $property->coverImage->image_url ?? null;
                                                @endphp
                                
                                                @if($coverImage)
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $coverImage) }}" alt="{{ $property->title }}">
                                                    </div>
                                                @else
                                                    <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $property->title }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        ID: {{ $property->id }} | {{ $property->ville }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ ucfirst($property->type_transaction) }}</div>
                                            <div class="text-sm text-gray-500">{{ $property->surface }} m² - {{ $property->pieces }} pièces</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($property->status == 'disponible')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Disponible
                                                </span>
                                            @elseif($property->status == 'vendu')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Vendu
                                                </span>
                                            @endif
                                            <div class="mt-1">
                                                @if($property->is_paid)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        Annonce payée
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Annonce non payée
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($property->created_at)->format('d/m/Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($property->created_at)->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            {{ number_format($property->price, 2) }} €
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('properties.show', $property->id) }}" class="text-gray-600 hover:text-gray-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <button onclick="deleteProperty({{ $property->id }})" class="text-red-600 hover:text-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            {{ $properties->links() }}
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 rounded-lg shadow bg-white border border-gray-200">
                        <img src="{{ asset('images/empty.png') }}" alt="Aucune annonce" class="w-64 mb-6">
                        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Aucune annonce disponible</h2>
                        <p class="text-gray-500 mb-6 text-center max-w-md">Il n'y a actuellement aucune annonce dans le système.</p>
                        <a href="{{ route('admin.properties.create') }}" class="bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-8 rounded-full transition duration-300 shadow-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Créer une annonce
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-auto mt-32">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Confirmer la suppression</h2>
            <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cette annonce ? Cette action est irréversible.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelDelete" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Annuler</button>
                <form  id="deleteForm" method="POST" action="{{ route('properties.destroy', $property->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteProperty(id) {
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const cancelDelete = document.getElementById('cancelDelete');
            
            // Update form action URL
            deleteForm.action = `/admin/properties/${id}`;
            
            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Cancel delete
            cancelDelete.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        }
    </script>
@endsection