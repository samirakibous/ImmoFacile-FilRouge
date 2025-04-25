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
                    <label for="title" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Titre de l'annonce
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>
                </div>
                <div>
                    <label for="property_type" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Type de bien
                    </label>
                    <select id="property_type" name="property_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>
                        <option value="">Sélectionnez un type</option>
                        <option value="apartment" {{ old('property_type') == 'apartment' ? 'selected' : '' }}>
                            Appartement</option>
                        <option value="house" {{ old('property_type') == 'house' ? 'selected' : '' }}>Maison
                        </option>
                        <option value="villa" {{ old('property_type') == 'villa' ? 'selected' : '' }}>Villa
                        </option>
                        <option value="land" {{ old('property_type') == 'land' ? 'selected' : '' }}>Terrain
                        </option>
                        <option value="commercial" {{ old('property_type') == 'commercial' ? 'selected' : '' }}>
                            Local commercial</option>
                        <option value="office" {{ old('property_type') == 'office' ? 'selected' : '' }}>Bureau
                        </option>
                    </select>
                </div>
                <div>
                    <label for="transaction_type" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Type de transaction
                    </label>
                    <select id="transaction_type" name="transaction_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>
                        <option value="">Sélectionnez une option</option>
                        <option value="sale" {{ old('transaction_type') == 'sale' ? 'selected' : '' }}>Vente
                        </option>
                        <option value="rent" {{ old('transaction_type') == 'rent' ? 'selected' : '' }}>Location
                        </option>
                    </select>
                </div>
                <div>
                    <label for="price" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
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
                <button type="button" onclick="nextStep(1)" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Suivant
                </button>
            </div>
        </div>

        <div id="step-2" class="form-step hidden">
            <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                Caractéristiques du bien</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                <div>
                    <label for="surface" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
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
                        @foreach (['elevator' => 'Ascenseur', 'parking' => 'Parking', 'garage' => 'Garage', 'balcony' => 'Balcon', 'terrace' => 'Terrasse', 'garden' => 'Jardin', 'pool' => 'Piscine', 'air_conditioning' => 'Climatisation'] as $key => $option)
                            <div class="flex items-center">
                                <input type="checkbox" id="{{ $key }}" name="features[]"
                                    value="{{ $key }}"
                                    class="h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                    {{ in_array($key, old('features', [])) ? 'checked' : '' }}>
                                <label for="{{ $key }}"
                                    class="ml-2 text-sm text-gray-700">{{ $option }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label for="energy_class" class="block mb-2 text-sm font-medium text-gray-700">Classe
                        énergétique</label>
                    <select id="energy_class" name="energy_class"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
                        <option value="">Sélectionnez une option</option>
                        @foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G'] as $class)
                            <option value="{{ $class }}"
                                {{ old('energy_class') == $class ? 'selected' : '' }}>{{ $class }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <button type="button" onclick="prevStep(2)" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Précédent
                </button>
                <button type="button" onclick="nextStep(2)" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Suivant
                </button>
            </div>
        </div>

        <div id="step-3" class="form-step hidden">
            <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                Localisation</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label for="address" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Adresse
                    </label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>
                </div>
                <div>
                    <label for="city" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Ville
                    </label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>
                </div>
                <div>
                    <label for="postal_code" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Code postal
                    </label>
                    <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>
                </div>
                <div>
                    <label for="country" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                        Pays
                    </label>
                    <input type="text" id="country" name="country" value="{{ old('country', 'France') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                        required>
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <button type="button" onclick="prevStep(3)" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Précédent
                </button>
                <button type="button" onclick="nextStep(3)" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Suivant
                </button>
            </div>
        </div>

        <div id="step-4" class="form-step hidden">
            <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                Description</h3>
            <div>
                <label for="description" class="block mb-1 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                    Description détaillée
                </label>
                <textarea id="description" name="description" rows="6"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base"
                    required>{{ old('description') }}</textarea>
            </div>
            <div class="mt-6 flex justify-between">
                <button type="button" onclick="prevStep(4)" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Précédent
                </button>
                <button type="button" onclick="nextStep(4)" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Suivant
                </button>
            </div>
        </div>

        <div id="step-5" class="form-step hidden">
            <h3 class="text-base sm:text-lg font-medium text-gray-800 mb-3 pb-2 border-b border-gray-200">
                Photos & Publication
            </h3>
            
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">
                    Photos du bien
                </label>
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <label class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-2 sm:mb-0">
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

            <div class="mb-4 mt-6">
                <h4 class="text-base font-medium text-gray-800 mb-2">Publication</h4>
                <div class="flex items-center">
                    <input type="checkbox" id="is_published" name="is_published" value="1"
                        class="h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                        {{ old('is_published') ? 'checked' : '' }}>
                    <label for="is_published" class="ml-2 text-sm text-gray-700">Publier immédiatement</label>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" onclick="prevStep(5)" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Précédent
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Enregistrer l'annonce
                </button>
            </div>
        </div>
    </form>
</div>

<script>
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
    
    function removeImage(element) {
        element.remove();
    }
    
    function closeModal() {
        window.location.href = '';
    }
</script>
@endsection