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
                        <button id="showFormButton"
                            class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow transition duration-300 flex items-center"
                            onclick="toggleForm()">
                            <i class="fas fa-plus mr-2"></i>Ajouter un utilisateur
                        </button>
                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm font-medium shadow">
                            {{ $totalUsers }} utilisateurs au total
                        </span>
                    </div>
                </div>
                <!-- Formulaire d'ajout utilisateur, caché par défaut -->
                <div id="addUserForm" class="space-y-4 bg-white p-6 rounded-xl shadow-md mb-6 hidden">
                    <h2 class="text-xl font-semibold mb-4">Ajouter un utilisateur</h2>

                    @if ($errors->any())
                        <div class="mb-4 text-red-500">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div>
                            <label class="block mb-1 font-medium">Nom</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Email</label>
                            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Mot de passe</label>
                            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Rôle</label>
                            <select name="role_id" class="w-full border rounded px-3 py-2" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Statut</label>
                            <select name="status" class="w-full border rounded px-3 py-2">
                                <option value="active">Actif</option>
                                <option value="suspended">Suspendu</option>
                            </select>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <!-- Search and filter bar -->
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <form action="" method="GET" class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-grow">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Rechercher par nom ou email..."
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                <button type="submit"
                                    class="absolute right-0 top-0 mt-2 mr-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <button type="submit"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg shadow-sm transition duration-300">
                                Filtrer
                            </button>
                        </form>
                    </div>

                    @if ($users->count() > 0)
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
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date d'inscription
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        <tr class="hover:bg-gray-50 transition-colors duration-200"
                                            id="user-row-{{ $user->id }}">
                                            <!-- Affichage classique -->
                                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->id }}</td>

                                            <td class="px-6 py-4">
                                                <span id="name-display-{{ $user->id }}">{{ $user->name }}</span>
                                                <input type="text" id="name-input-{{ $user->id }}"
                                                    value="{{ $user->name }}"
                                                    class="hidden border rounded px-2 py-1 text-sm w-full" />
                                            </td>

                                            <td class="px-6 py-4">
                                                <span id="email-display-{{ $user->id }}">{{ $user->email }}</span>
                                                <input type="email" id="email-input-{{ $user->id }}"
                                                    value="{{ $user->email }}"
                                                    class="hidden border rounded px-2 py-1 text-sm w-full" />
                                            </td>

                                            <td class="px-6 py-4">
                                                <span id="role-display-{{ $user->id }}">{{ $user->role->name }}</span>
                                                <select id="role-input-{{ $user->id }}"
                                                    class="hidden border rounded px-2 py-1 text-sm">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $user->role_id === $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $user->created_at->format('d/m/Y') }}</td>

                                            <td class="px-6 py-4">
                                                <span id="status-display-{{ $user->id }}">{{ $user->status }}</span>
                                                <select id="status-input-{{ $user->id }}"
                                                    class="hidden border rounded px-2 py-1 text-sm">
                                                    <option value="active"
                                                        {{ $user->status === 'active' ? 'selected' : '' }}>Actif</option>
                                                    <option value="suspended"
                                                        {{ $user->status === 'suspended' ? 'selected' : '' }}>Suspendu
                                                    </option>
                                                </select>
                                            </td>

                                            <td class="px-6 py-4">
                                                <div class="flex space-x-2">
                                                    <button onclick="editUser({{ $user->id }})"
                                                        id="edit-btn-{{ $user->id }}"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md">
                                                        Modifier
                                                    </button>
                                                    <button type="button" onclick="confirmDelete({{ $user->id }})"
                                                        id="delete-btn-{{ $user->id }}"
                                                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md transition duration-300 flex items-center">
                                                        <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                                    </button>
                                                    <button onclick="saveUser({{ $user->id }})"
                                                        id="save-btn-{{ $user->id }}"
                                                        class="hidden bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded-md">
                                                        Valider
                                                    </button>

                                                    <button onclick="cancelEdit({{ $user->id }})"
                                                        id="cancel-btn-{{ $user->id }}"
                                                        class="hidden bg-gray-400 hover:bg-gray-500 text-white py-1 px-3 rounded-md">
                                                        Annuler
                                                    </button>
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
                    @if ($users->count() > 0)
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
            <p class="text-gray-500 mb-5">Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est
                irréversible.</p>
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

            document.querySelectorAll('.editable-cell').forEach(input => {
                input.addEventListener('blur', function() {
                    const userId = this.dataset.id;
                    const field = this.dataset.field;
                    const value = this.value;

                    fetch(`/admin/users/${userId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                [field]: value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.classList.remove('border-red-500');
                                this.classList.add('border-green-500');
                            } else {
                                this.classList.add('border-red-500');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            this.classList.add('border-red-500');
                        });
                });
            });

            function editUser(id) {
                // Cacher les affichages
                document.getElementById(`name-display-${id}`).style.display = 'none';
                document.getElementById(`email-display-${id}`).style.display = 'none';
                document.getElementById(`role-display-${id}`).style.display = 'none';
                document.getElementById(`status-display-${id}`).style.display = 'none';

                // Montrer les inputs
                document.getElementById(`name-input-${id}`).classList.remove('hidden');
                document.getElementById(`email-input-${id}`).classList.remove('hidden');
                document.getElementById(`role-input-${id}`).classList.remove('hidden');
                document.getElementById(`status-input-${id}`).classList.remove('hidden');

                // Afficher boutons valider / annuler
                document.getElementById(`edit-btn-${id}`).classList.add('hidden');
                document.getElementById(`delete-btn-${id}`).classList.add('hidden');
                document.getElementById(`save-btn-${id}`).classList.remove('hidden');
                document.getElementById(`cancel-btn-${id}`).classList.remove('hidden');
            }

            function cancelEdit(id) {
                // Réafficher les valeurs
                document.getElementById(`name-display-${id}`).style.display = '';
                document.getElementById(`email-display-${id}`).style.display = '';
                document.getElementById(`role-display-${id}`).style.display = '';
                document.getElementById(`status-display-${id}`).style.display = '';

                // Cacher les inputs
                document.getElementById(`name-input-${id}`).classList.add('hidden');
                document.getElementById(`email-input-${id}`).classList.add('hidden');
                document.getElementById(`role-input-${id}`).classList.add('hidden');
                document.getElementById(`status-input-${id}`).classList.add('hidden');

                // Boutons
                document.getElementById(`edit-btn-${id}`).classList.remove('hidden');
                document.getElementById(`save-btn-${id}`).classList.add('hidden');
                document.getElementById(`cancel-btn-${id}`).classList.add('hidden');
            }

            function saveUser(id) {
                const name = document.getElementById(`name-input-${id}`).value;
                const email = document.getElementById(`email-input-${id}`).value;
                const role = document.getElementById(`role-input-${id}`).value;
                const status = document.getElementById(`status-input-${id}`).value;

                fetch(`/admin/users/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            name,
                            email,
                            role_id: role,
                            status,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mettre à jour l'affichage
                            document.getElementById(`name-display-${id}`).innerText = name;
                            document.getElementById(`email-display-${id}`).innerText = email;
                            document.getElementById(`role-display-${id}`).innerText = document.querySelector(
                                `#role-input-${id} option:checked`).textContent;
                            document.getElementById(`status-display-${id}`).innerText = status;

                            cancelEdit(id); // revenir en mode affichage
                        } else {
                            alert('Erreur lors de la mise à jour');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Une erreur est survenue');
                    });
            }

            function toggleForm() {
                const form = document.getElementById('addUserForm');
                const button = document.getElementById('showFormButton');

                // Toggle l'affichage du formulaire
                form.classList.toggle('hidden');

                // Changer le texte du bouton selon l'état du formulaire
                if (form.classList.contains('hidden')) {
                    button.innerText = 'Ajouter un utilisateur';
                } else {
                    button.innerText = 'Fermer le formulaire';
                }
            }
        </script>
    @endpush
@endsection
