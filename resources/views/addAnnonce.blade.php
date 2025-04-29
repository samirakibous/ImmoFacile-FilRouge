@extends('layouts.app')

@section('title', 'Profile Agent - Ajouter une Annonce')

@section('content')
    <x-navbar />
    <div class="bg-white rounded-lg p-4 sm:p-6 w-full max-w-xl mx-auto my-4 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg sm:text-xl font-bold">Ajouter une Annonce</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Progress Bar -->
        <div class="mb-6">
            <div class="flex justify-between text-xs text-gray-500 mb-1">
                <span id="step-indicator-1" class="font-medium text-blue-600">Informations générales</span>
                <span id="step-indicator-2" class="font-medium">Caractéristiques</span>
                <span id="step-indicator-3" class="font-medium">Localisation</span>
                <span id="step-indicator-4" class="font-medium">Description</span>
                <span id="step-indicator-5" class="font-medium">Photos</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div id="progress-bar" class="bg-blue-600 h-2.5 rounded-full" style="width: 20%"></div>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="" enctype="multipart/form-data" id="property-form" class="p-2 sm:p-6">
            @csrf

            <div id="step-1" class="form-step">
                <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                    Informations générales</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="title"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Titre de l'annonce
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                    </div>
                    <div>
                        <label for="property_type"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Type de bien
                        </label>
                        <select id="property_type" name="property_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                            <option value="">Sélectionnez un type</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('property_type') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="transaction_type"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Type de transaction
                        </label>
                        <select id="transaction_type" name="transaction_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                            <option value="">Sélectionnez une option</option>
                            <option value="vendre" {{ old('transaction_type') == 'vendre' ? 'selected' : '' }}>Vente
                            </option>
                            <option value="location" {{ old('transaction_type') == 'location' ? 'selected' : '' }}>Location
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="price"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Prix
                        </label>
                        <div class="relative">
                            <input type="number" id="price" name="price" value="{{ old('price') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-8 text-base"
                                required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="nextStep(1)"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Suivant
                    </button>
                </div>
            </div>

            <div id="step-2" class="form-step hidden">
                <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                    Caractéristiques du bien</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                    <div>
                        <label for="surface"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Surface (m²)
                        </label>
                        <input type="number" id="surface" name="surface" value="{{ old('surface') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                    </div>
                    <div>
                        <label for="rooms" class="block mb-1 text-sm font-medium text-gray-700">Pièces</label>
                        <input type="number" id="rooms" name="rooms" value="{{ old('rooms') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
                    </div>
                    <div>
                        <label for="bedrooms" class="block mb-1 text-sm font-medium text-gray-700">Chambres</label>
                        <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
                    </div>
                    <div>
                        <label for="bathrooms" class="block mb-1 text-sm font-medium text-gray-700">Salles de
                            bain</label>
                        <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
                    </div>
                    <div>
                        <label for="year_built" class="block mb-1 text-sm font-medium text-gray-700">Année</label>
                        <input type="number" id="year_built" name="year_built" value="{{ old('year_built') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
                    </div>
                    <div>
                        <label for="floor" class="block mb-1 text-sm font-medium text-gray-700">Étage</label>
                        <input type="number" id="floor" name="floor" value="{{ old('floor') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Équipements</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @php
                                // Préparer les équipements sélectionnés (old() ou ceux existants si modification)
                                $selectedFeatures = old(
                                    'features',
                                    isset($property)
                                        ? (is_array($property->equipement)
                                            ? $property->equipement
                                            : json_decode($property->equipement, true))
                                        : [],
                                );
                            @endphp

                            @foreach ([
            'elevator' => 'Ascenseur',
            'parking' => 'Parking',
            'garage' => 'Garage',
            'balcony' => 'Balcon',
            'terrace' => 'Terrasse',
            'garden' => 'Jardin',
            'pool' => 'Piscine',
            'air_conditioning' => 'Climatisation',
        ] as $key => $option)
                                <div class="flex items-center">
                                    <input type="checkbox" id="{{ $key }}" name="features[]"
                                        value="{{ $key }}"
                                        class="h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                        {{ in_array($key, $selectedFeatures) ? 'checked' : '' }}>
                                    <label for="{{ $key }}"
                                        class="ml-2 text-sm text-gray-700">{{ $option }}</label>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevStep(2)"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Précédent
                    </button>
                    <button type="button" onclick="nextStep(2)"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Suivant
                    </button>
                </div>
            </div>

            <div id="step-3" class="form-step hidden">
                <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                    Localisation</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label for="address"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Adresse
                        </label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                    </div>
                    <div>
                        <label for="city"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Ville
                        </label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                    </div>
                    <div>
                        <label for="postal_code"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Code postal
                        </label>
                        <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                    </div>
                    <div>
                        <label for="country"
                            class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                            Pays
                        </label>
                        <input type="text" id="country" name="country" value="{{ old('country', 'France') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                            required>
                    </div>
                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevStep(3)"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Précédent
                    </button>
                    <button type="button" onclick="nextStep(3)"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Suivant
                    </button>
                </div>
            </div>

            <div id="step-4" class="form-step hidden">
                <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                    Description</h3>
                <div>
                    <label for="description"
                        class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Description détaillée
                    </label>
                    <textarea id="description" name="description" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="condition" class="block text-sm font-medium text-gray-700">Condition</label>
                    <select name="condition" id="condition" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Sélectionner la condition --</option>
                        <option value="neuf" {{ old('condition') == 'neuf' ? 'selected' : '' }}>Neuf</option>
                        <option value="occasion" {{ old('condition') == 'occasion' ? 'selected' : '' }}>Occasion</option>
                        <option value="bon_etat" {{ old('condition') == 'bon_etat' ? 'selected' : '' }}>Bon état</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Sélectionner le statut --</option>
                        <option value="disponible" {{ old('status') == 'disponible' ? 'selected' : '' }}>Disponible
                        </option>
                        <option value="non_disponible" {{ old('status') == 'non_disponible' ? 'selected' : '' }}>Non
                            disponible</option>
                    </select>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevStep(4)"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Précédent
                    </button>
                    <button type="button" onclick="nextStep(4)"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Suivant
                    </button>
                </div>
            </div>

            <!-- Step 5: Photos & Publication -->
            <div id="step-5" class="form-step hidden">
                <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                    Photos & Publication
                </h3>

                <div class="mb-4">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Photos du bien
                    </label>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label
                            class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-2 sm:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Ajouter des photos</span>
                            <input type="file" id="photos" name="photos[]" multiple accept="image/*"
                                class="hidden" onchange="handleFileSelect(event)">
                        </label>
                        <span class="sm:ml-3 text-sm text-gray-500">Formats JPG, PNG (max 5MB par photo)</span>
                    </div>
                    <div id="photos-error" class="mt-2 text-sm text-red-600 hidden"></div>
                    <div id="preview-container" class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-2">
                        <!-- Preview images will be displayed here -->
                    </div>
                </div>

                <div class="mb-4">
                    <label for="cover_photo" class="block mb-1 text-sm font-medium text-gray-700">Photo
                        principale</label>
                    <select id="cover_photo" name="cover_photo"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
                        <option value="">Sélectionnez une photo principale</option>
                        <!-- Options will be added dynamically with JavaScript -->
                    </select>
                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="prevStep(5)"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Précédent
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Enregistrer l'annonce
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Update the form tag attributes to prevent default submission
        document.getElementById('property-form').setAttribute('action', '/addAnnace');
        document.getElementById('property-form').setAttribute('onsubmit', 'return submitFormWithAjax(event)');

        function submitFormWithAjax(event) {
            event.preventDefault();

            if (!validateStep(5)) {
                return false;
            }

            const form = document.getElementById('property-form');
            const formData = new FormData(form);

            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML =
                '<svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Envoi en cours...';

            // Send AJAX request
            fetch("add-annonce", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log(response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showMessage('Annonce ajoutée avec succès!', 'success');

                        if (data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 1500);
                        } else {
                            form.reset();
                            currentStep = 1;
                            updateProgressBar();
                            updateStepIndicators();
                            for (let i = 1; i <= totalSteps; i++) {
                                const stepElement = document.getElementById(`step-${i}`);
                                if (i === 1) {
                                    stepElement.classList.remove('hidden');
                                } else {
                                    stepElement.classList.add('hidden');
                                }
                            }
                            document.getElementById('preview-container').innerHTML = '';
                            document.getElementById('cover_photo').innerHTML =
                                '<option value="">Sélectionnez une photo principale</option>';
                        }
                    } else {
                        showMessage(data.message || 'Une erreur est survenue', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('Une erreur est survenue lors de l\'envoi du formulaire', 'error');

                    // Vérification si l'erreur est liée à une réponse du serveur avec un code 500
                    if (error.response && error.response.status === 500) {
                        // Affichage des détails de l'erreur dans la console et via une autre fonction showMessage
                        console.error('Détails de l\'erreur:', error.response.data);
                        showMessage('Erreur interne du serveur. Détails : ' + (error.response.data ||
                            'Aucun détail disponible'), 'error');
                    }
                })

                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                });

            return false;
        }

        function showMessage(message, type) {
            let messageElement = document.getElementById('form-message');
            if (!messageElement) {
                messageElement = document.createElement('div');
                messageElement.id = 'form-message';
                messageElement.className = 'mt-4 p-4 rounded text-center';

                document.getElementById('property-form').parentNode.insertBefore(
                    messageElement,
                    document.getElementById('property-form')
                );
            }

            if (type === 'success') {
                messageElement.className =
                    'mt-4 p-4 rounded text-center bg-green-100 border border-green-400 text-green-700';
            } else {
                messageElement.className = 'mt-4 p-4 rounded text-center bg-red-100 border border-red-400 text-red-700';
            }
            messageElement.textContent = message;

            setTimeout(() => {
                messageElement.style.display = 'none';
            }, 5000);
        }

        function validateStep(step) {
            let isValid = true;

            if (step === 1) {
                const requiredFields = ['title', 'property_type', 'transaction_type', 'price'];
                requiredFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        input.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });
            } else if (step === 2) {
                const surfaceField = document.getElementById('surface');
                if (!surfaceField.value.trim()) {
                    surfaceField.classList.add('border-red-500');
                    isValid = false;
                } else {
                    surfaceField.classList.remove('border-red-500');
                }
            } else if (step === 3) {
                const requiredFields = ['address', 'city', 'postal_code', 'country'];
                requiredFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        input.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });
            } else if (step === 4) {
                const descriptionField = document.getElementById('description');
                if (!descriptionField.value.trim()) {
                    descriptionField.classList.add('border-red-500');
                    isValid = false;
                } else {
                    descriptionField.classList.remove('border-red-500');
                }
            } else if (step === 5) {
                const photosInput = document.getElementById('photos');
                if (photosInput.files.length === 0) {
                    document.getElementById('photos-error').textContent = "Veuillez ajouter au moins une photo";
                    document.getElementById('photos-error').classList.remove('hidden');
                    isValid = false;
                } else {
                    document.getElementById('photos-error').classList.add('hidden');
                }
            }

            return isValid;
        }

        let currentStep = 1;
        const totalSteps = 5;

        function nextStep(step) {
            if (validateStep(step)) {
                document.getElementById(`step-${step}`).classList.add('hidden');
                document.getElementById(`step-${step+1}`).classList.remove('hidden');
                currentStep = step + 1;
                updateProgressBar();
                updateStepIndicators();
            }
        }

        function prevStep(step) {
            document.getElementById(`step-${step}`).classList.add('hidden');
            document.getElementById(`step-${step-1}`).classList.remove('hidden');
            currentStep = step - 1;
            updateProgressBar();
            updateStepIndicators();
        }

        function updateProgressBar() {
            const progressPercentage = (currentStep / totalSteps) * 100;
            document.getElementById('progress-bar').style.width = `${progressPercentage}%`;
        }

        function updateStepIndicators() {
            for (let i = 1; i <= totalSteps; i++) {
                const indicator = document.getElementById(`step-indicator-${i}`);
                if (i === currentStep) {
                    indicator.classList.add('text-blue-600');
                    indicator.classList.add('font-medium');
                } else {
                    indicator.classList.remove('text-blue-600');
                    indicator.classList.remove('font-medium');
                }
            }
        }

        function validateStep(step) {
            let isValid = true;

            if (step === 1) {
                const requiredFields = ['title', 'property_type', 'transaction_type', 'price'];
                requiredFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        input.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });
            } else if (step === 2) {
                const surfaceField = document.getElementById('surface');
                if (!surfaceField.value.trim()) {
                    surfaceField.classList.add('border-red-500');
                    isValid = false;
                } else {
                    surfaceField.classList.remove('border-red-500');
                }
            } else if (step === 3) {
                const requiredFields = ['address', 'city', 'postal_code', 'country'];
                requiredFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        input.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });
            } else if (step === 4) {
                const descriptionField = document.getElementById('description');
                if (!descriptionField.value.trim()) {
                    descriptionField.classList.add('border-red-500');
                    isValid = false;
                } else {
                    descriptionField.classList.remove('border-red-500');
                }
            }

            return isValid;
        }

        function handleFileSelect(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            const coverPhotoSelect = document.getElementById('cover_photo');
            const photosError = document.getElementById('photos-error');

            const maxSize = 5 * 1024 * 1024;
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            let hasError = false;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!validTypes.includes(file.type)) {
                    photosError.textContent = "Format de fichier non supporté. Utilisez JPG ou PNG.";
                    photosError.classList.remove('hidden');
                    hasError = true;
                    break;
                }

                if (file.size > maxSize) {
                    photosError.textContent = "Taille de fichier dépassée. Maximum 5MB par image.";
                    photosError.classList.remove('hidden');
                    hasError = true;
                    break;
                }
            }

            if (hasError) {
                event.target.value = '';
                return;
            }

            photosError.classList.add('hidden');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgId = `photo-${Date.now()}-${i}`;

                    const previewWrapper = document.createElement('div');
                    previewWrapper.className = 'relative';
                    previewWrapper.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="w-full h-24 object-cover rounded">
                    <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600" onclick="removeImage(this.parentNode)">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                    previewContainer.appendChild(previewWrapper);

                    const option = document.createElement('option');
                    option.value = imgId;
                    option.textContent = `Photo ${i + 1}`;
                    coverPhotoSelect.appendChild(option);
                };

                reader.readAsDataURL(file);
            }
        }

        //     function removeImage(element) {
        //         element.remove();
        //     }

        function closeModal() {
            window.location.href = '';
        }

        //  //handle steps for submitting the form with ajax
        //     document.getElementById('property-form').addEventListener('submit', function(event) {
        //         event.preventDefault();
        //         const formData = new FormData(this);
        //         fetch('/agent/AddAnnonce', {
        //             method: 'POST',
        //             body: formData,
        //             headers: {
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             }
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.success) {
        //                 alert('Annonce ajoutée avec succès !');
        //                 window.location.href = '';
        //             } else {
        //                 alert('Erreur lors de l\'ajout de l\'annonce. Veuillez réessayer.');
        //             }
        //         })
        //         .catch(error => console.error('Error:', error));
        //     })
    </script>
@endsection
