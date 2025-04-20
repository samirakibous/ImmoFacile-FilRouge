@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs')

@section('content')
 <!-- Navbar -->
 <x-navbar />
<div class="flex min-h-screen bg-gray-100">
    <x-sidebar />
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
                <h1 class="text-2xl font-bold text-gray-900 mb-2 md:mb-0">
                    <i class="fas fa-users mr-2"></i>Gestion des Utilisateurs
                </h1>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow transition duration-300 flex items-center">
                        <i class="fas fa-plus mr-2"></i>Ajouter un utilisateur
                    </a>
                    <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm font-medium shadow">
                        {{ $totalUsers }} utilisateurs au total
                    </span>
                </div>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                <!-- Search and filter bar -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <form action="" method="GET" class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-grow">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par nom ou email..." 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <button type="submit" class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg shadow-sm transition duration-300">
                            Filtrer
                        </button>
                    </form>
                </div>

                @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                            
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date d'inscription
                                    </th>
                                    
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 mr-3">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->email }}
                                </td >
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->role->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md transition duration-300 flex items-center">
                                            <i class="fas fa-edit mr-1"></i> Modifier
                                        </a>
                                        
                                        <button type="button" 
                                            onclick="confirmDelete({{ $user->id }})" 
                                            class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md transition duration-300 flex items-center">
                                            <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                        </button>
                                        
                                        <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-8 text-center">
                    <div class="inline-flex rounded-full bg-gray-100 p-4 mb-4">
                        <i class="fas fa-users text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-500 text-lg">Aucun utilisateur trouvé</p>
                    <p class="text-gray-400 mt-1">Les utilisateurs que vous ajoutez apparaîtront ici</p>
                </div>
                @endif

                <!-- Pagination fixes -->
                @if($users->count() > 0)
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Confirmation modal pour la suppression -->
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmer la suppression</h3>
        <p class="text-gray-500 mb-5">Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg">
                Annuler
            </button>
            <button id="confirmDeleteBtn" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">
                Supprimer
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(userId) {
        const modal = document.getElementById('confirmationModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        
        modal.classList.remove('hidden');
        
        confirmBtn.onclick = function() {
            document.getElementById('delete-form-' + userId).submit();
        }
    }
    
    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }
</script>
@endpush
@endsection