@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Navbar -->
    <x-navbar />
    <div class="flex min-h-screen">
        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Categories</h2>
                    <div class="flex items-center space-x-2">
                        <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-sm font-medium">
                            {{ $categories->count() ?? 0 }} Categories au total
                        </span>
                        <button id="addCategoryBtn" class="bg-blue-600 text-white py-1 px-3 rounded text-sm font-medium hover:bg-blue-700">
                            Ajouter
                        </button>
                    </div>
                </div>

                <!-- Formulaire d'ajout -->
                <div id="addCategoryForm" class="px-6 py-4 bg-gray-50 border-b border-gray-200 hidden">
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom de la catégorie</label>
                            <input type="text" name="name" id="name" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" id="cancelAddBtn" class="bg-gray-200 text-gray-700 py-2 px-4 rounded mr-2 hover:bg-gray-300">
                                Annuler
                            </button>
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                                Sauvegarder
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Formulaire de modification-->
                <div id="editCategoryForm" class="px-6 py-4 bg-gray-50 border-b border-gray-200 hidden">
                    <form id="updateCategoryForm"  method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="edit_name" class="block text-sm font-medium text-gray-700">Modifier le nom</label>
                            <input type="text" name="name" id="edit_name" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" id="cancelEditBtn" class="bg-gray-200 text-gray-700 py-2 px-4 rounded mr-2 hover:bg-gray-300">
                                Annuler
                            </button>
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($categories ?? [] as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="edit-btn text-indigo-600 hover:text-indigo-900 mr-2" 
                                                data-id="{{ $category->id }}" 
                                                data-name="{{ $category->name }}"
                                                data-url="{{ route('admin.categories.update', $category->id) }}">
                                            Modifier
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Aucune catégorie trouvée
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination si nécessaire -->
                @if(isset($categories) && method_exists($categories, 'links'))
                    <div class="px-6 py-3">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript pour gérer les formulaires -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Boutons et formulaires
            const addCategoryBtn = document.getElementById('addCategoryBtn');
            const addCategoryForm = document.getElementById('addCategoryForm');
            const cancelAddBtn = document.getElementById('cancelAddBtn');
            const editCategoryForm = document.getElementById('editCategoryForm');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const updateCategoryForm = document.getElementById('updateCategoryForm');
            const editBtns = document.querySelectorAll('.edit-btn');
            
            // Afficher le formulaire d'ajout
            addCategoryBtn.addEventListener('click', function() {
                addCategoryForm.classList.remove('hidden');
                editCategoryForm.classList.add('hidden');
            });
            
            // Cacher le formulaire d'ajout
            cancelAddBtn.addEventListener('click', function() {
                addCategoryForm.classList.add('hidden');
            });
            
            // Cacher le formulaire de modification
            cancelEditBtn.addEventListener('click', function() {
                editCategoryForm.classList.add('hidden');
            });
            
            // Configurer le formulaire de modification pour chaque bouton d'édition
            editBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const url = this.getAttribute('data-url');
                    
                    document.getElementById('edit_name').value = name;
                    updateCategoryForm.action = url;
                    
                    addCategoryForm.classList.add('hidden');
                    editCategoryForm.classList.remove('hidden');
                });
            });
        });
    </script>
@endsection