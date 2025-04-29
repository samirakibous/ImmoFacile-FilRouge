@extends('layouts.app')

@section('title', 'Profile Agent')

@section('content')
    <x-navbar />
    <div class=" container mx-auto px-4 py-8">

        <!-- Content -->
        <div class="relative w-full h-64 bg-gray-800">
            <!-- Background Image with Overlay -->
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('{{ asset('storage/' . ($user->profile_picture ?? 'image.png')) }}')">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>


            <!-- Content -->
            <div class="relative flex flex-col items-center justify-center h-full text-white">
                <h1 class="text-4xl font-bold mb-4">{{ $user->name }}</h1>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            <!-- Author Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex flex-col md:flex-row">
                    <!-- Profile Image and Name -->
                    <div class="flex items-center mb-6 md:mb-0 md:mr-8">
                        <div class="mr-6 mb-4 sm:mb-0 relative group">
                            <!-- Photo wrapper with click functionality -->
                            <label for="photo-upload" class="cursor-pointer block">
                                <img src="" alt="Profile"
                                    class="rounded-full w-24 h-24 object-cover">

                                <!-- Overlay that appears on hover -->
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <span class="text-white text-xs font-medium">Change Photo</span>
                                </div>
                            </label>

                            <!-- Hidden file input -->
                            <form id="profile-photo-form" action="{{ route('profile.update.photo') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" id="photo-upload" name="profile_picture" accept="image/*"
                                    class="hidden" onchange="document.getElementById('profile-photo-form').submit()">
                            </form>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                            <p class="text-gray-600">Member depuis {{ $user->created_at }}</p>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex flex-grow justify-end space-x-4">
                        <!-- Reviews -->
                        <div class="flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <div class="bg-orange-500 p-2 rounded-lg mr-3">
                                <i class="fas fa-star text-white"></i>
                            </div>
                            <div>
                                <p class="text-xl font-bold text-orange-500">4.4</p>
                                <p class="text-gray-600">18 Reviews</p>
                            </div>
                        </div>

                        <!-- Listings -->
                        <div class="flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                            <div class="bg-orange-500 p-2 rounded-lg mr-3">
                                <i class="fas fa-list text-white"></i>
                            </div>
                            <div>
                                <p class="text-xl font-bold text-orange-500">18</p>
                                <p class="text-gray-600">Listings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact and About Sections -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Contact Info -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Contact Info</h3>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-orange-500 mt-1 mr-3"></i>
                            <p>21 Monroe Ave, Rochester NY</p>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-phone text-orange-500 mt-1 mr-3"></i>
                            <p>888 666 111</p>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-envelope text-orange-500 mt-1 mr-3"></i>
                            <p>contact@example.com</p>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-globe text-orange-500 mt-1 mr-3"></i>
                            <p>http://example.com</p>
                        </div>

                        <!-- Social Media Links -->
                        <div class="flex space-x-2 mt-4">
                            <a href="#"
                                class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300">
                                <i class="fab fa-facebook-f text-gray-600"></i>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300">
                                <i class="fab fa-twitter text-gray-600"></i>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300">
                                <i class="fab fa-linkedin-in text-gray-600"></i>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300">
                                <i class="fas fa-link text-gray-600"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- About -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">About</h3>
                    <p class="text-gray-600">
                        Nullam quis ante tiam sit amet orci eget eros faucibus tincidunt. Donec quam felis ultrices nec
                        pellentesque eu pretium quis, sem.
                    </p>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="flex justify-between items-center mb-6">
                <!-- Category Pills -->
                <div class="flex space-x-2">
                    <button
                        class="category-button px-4 py-2 border border-gray-300 rounded-md flex items-center text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-building mr-2"></i>
                        Apartment
                    </button>
                    <button
                        class="category-button px-4 py-2 border border-orange-500 rounded-md flex items-center text-orange-500 bg-white hover:bg-orange-50">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        General
                    </button>
                    <button
                        class="category-button px-4 py-2 border border-gray-300 rounded-md flex items-center text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-home mr-2"></i>
                        Villa
                    </button>
                    @if (Auth::user()->id == $user->id)
                        <a href="{{ route('agent.AddAnnonce') }}"
                            class="category-button px-4 py-2 border border-gray-300 rounded-md flex items-center text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter une annonce
                </a>
                    @endif
                </div>

                <!-- Filter Dropdown -->
                <div class="relative">
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-md flex items-center text-gray-700 bg-white hover:bg-gray-50">
                        Filter By Category
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($properties as $property)
                    <x-property-card :property="$property" />
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Aucun bien immobilier disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryButtons = document.querySelectorAll('.category-button');

            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('border-orange-500', 'text-orange-500',
                            'hover:bg-orange-50');
                    });
                    button.classList.add('border-orange-500', 'text-orange-500',
                        'hover:bg-orange-50');
                });
            });
        });
    </script>
@endsection
