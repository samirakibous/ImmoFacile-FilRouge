@extends('layouts.app')

@section('title', 'Gestion de compte')

@section('content')
    <x-navbar />
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <x-profileSidebare />

            <!-- Content -->
            <div class="flex-1 max-w-3xl">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 md:p-8">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">Gestion de votre compte</h1>
                        <p class="text-gray-600 mb-8 border-b pb-4">Personnalisez vos informations et paramètres de compte.
                        </p>
                        <div class="mb-10">
                            <h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Votre compte
                            </h2>

                            <form method="POST" action="{{ route('account.update') }}" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                        Adresse e-mail
                                        <span class="text-gray-500 text-xs ml-1">(champ privé)</span>
                                    </label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm 
                                        focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="email@exemple.com">
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de
                                            passe</label>
                                        <button type="button" id="openPasswordModal"
                                            class="inline-flex items-center px-3 py-2 border border-indigo-300 text-sm
                                            leading-4 font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50
                                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Modifier
                                        </button>
                                    </div>
                                    <input type="password" name="password" id="password" value="••••••••" readonly
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm bg-gray-100
                                        focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm cursor-not-allowed">
                                </div>
                            </form>
                        </div>

                        <!-- Modal -->
                        <div id="passwordModal"
                            class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                                <h2 class="text-lg font-semibold mb-4">Changer le mot de passe</h2>

                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de
                                            passe actuel</label>
                                        <input type="password" name="current_password" id="current_password" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="mb-4">
                                        <label for="new_password" class="block text-sm font-medium text-gray-700">Nouveau
                                            mot de passe</label>
                                        <input type="password" name="new_password" id="new_password" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="mb-4">
                                        <label for="new_password_confirmation"
                                            class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de
                                            passe</label>
                                        <input type="password" name="new_password_confirmation"
                                            id="new_password_confirmation" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="flex justify-end gap-2">
                                        <button type="button" id="closePasswordModal"
                                            class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">Annuler</button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Valider</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="border-t pt-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Désactivation et suppression
                            </h2>

                            <div
                                class="bg-gray-50 p-4 rounded-lg mb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <h3 class="font-medium text-gray-900">Désactiver le compte</h3>
                                    <p class="text-sm text-gray-600 mt-1">Masquez temporairement votre profil, vos Épingles
                                        et vos tableaux</p>
                                </div>
                                <button type="button" id="openDeactivateModal"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 
                                    rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                    Désactiver
                                </button>
                            </div>

                            <div
                                class="bg-gray-50 p-4 rounded-lg flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <h3 class="font-medium text-gray-900">Supprimer vos données et votre compte</h3>
                                    <p class="text-sm text-gray-600 mt-1">Supprimer définitivement vos données et tout ce
                                        qui est associé à votre compte</p>
                                </div>
                                <button type="button" id="openDeleteModal"
                                    class="inline-flex items-center justify-center px-4 py-2 border border-red-300 
                                    rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                    Supprimer
                                </button>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4 border-t pt-6">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm
                                font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                                Annuler
                            </button>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm
                                font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Désactivation -->
    <div id="deactivateModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirmer la désactivation</h2>
            <p class="text-sm text-gray-600 mb-6">Êtes-vous sûr de vouloir désactiver votre compte ? Cette action est
                irréversible.</p>
                <form method="POST" action="{{ route('account.deactivate') }}">
                    @csrf
                    <div class="flex justify-end gap-2">
                        <button type="button" id="cancelDeactivate" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Confirmer
                        </button>
                    </div>
                </form>
                
        </div>
    </div>

     <!-- Modal Supréssion -->
     <div id="deleteModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirmer la suppression</h2>
            <p class="text-sm text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est
                irréversible.</p>
                <form method="POST" action="{{ route('account.delete') }}">
                    @csrf
                    <div class="flex justify-end gap-2">
                        <button type="button" id="cancelDelete" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Confirmer
                        </button>
                    </div>
                </form>
                
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('openPasswordModal');
            const closeBtn = document.getElementById('closePasswordModal');
            const modal = document.getElementById('passwordModal');

            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            closeBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

        });

        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('openDeactivateModal');
            const modal = document.getElementById('deactivateModal');
            const cancelBtn = document.getElementById('cancelDeactivate');

            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            cancelBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('openDeleteModal');
            const modal = document.getElementById('deleteModal');
            const cancelBtn = document.getElementById('cancelDelete');

            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            cancelBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });
    </script>
<x-footer />
@endsection
