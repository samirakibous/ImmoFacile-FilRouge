@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <!-- Navbar -->
    <x-navbar />
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h5 class="text-lg font-medium mb-4">My Profile</h5>
                        <ul class="space-y-2">
                            <li><a href="#" class="block py-2 text-gray-600 hover:text-blue-500">Security</a></li>
                            <li><a href="#" class="block py-2 text-gray-600 hover:text-blue-500">Teams</a></li>
                            <li><a href="#" class="block py-2 text-gray-600 hover:text-blue-500">Team Member</a></li>
                            <li><a href="#" class="block py-2 text-gray-600 hover:text-blue-500">Notifications</a></li>
                            <li><a href="#" class="block py-2 text-gray-600 hover:text-blue-500">Billing</a></li>
                            <li><a href="#" class="block py-2 text-gray-600 hover:text-blue-500">Data Export</a></li>
                            <li><a href="#" class="block py-2 text-red-500 hover:text-red-700">Delete Account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="w-full md:w-3/4">
                <!-- Profile Header -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold">My Profile</h2>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-center mb-6">
                            <div class="mr-6 mb-4 sm:mb-0 relative group">
                                <!-- Photo wrapper with click functionality -->
                                <label for="photo-upload" class="cursor-pointer block">
                                    <img src="{{ asset('images/' . (Auth::user()->photo ?? 'image.png')) }}" alt="Profile" class="rounded-full w-24 h-24 object-cover">
                                    
                                    <!-- Overlay that appears on hover -->
                                    <div class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <span class="text-white text-xs font-medium">Change Photo</span>
                                    </div>
                                </label>
                                
                                <!-- Hidden file input -->
                                <form id="profile-photo-form" action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" id="photo-upload" name="photo" accept="image/*" class="hidden" onchange="document.getElementById('profile-photo-form').submit()">
                                </form>
                            </div>
                            
                            <div class="text-center sm:text-left">
                                <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                                <p class="text-gray-500">{{ $user->address_city }} {{ $user->address_country }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-auto">
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Personal Information -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h5 class="text-lg font-medium">Personal Information</h5>
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Edit
                            </a>
                        </div>
                        
                        <!-- First row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">First Name</label>
                                <p class="mt-1">{{ $user->name }}</p>
                            </div>
                        </div>
                        
                        <!-- Second row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email Address</label>
                                <p class="mt-1">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Phone</label>
                                <p class="mt-1">{{ $user->phone ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        
                        <!-- Address section -->
                        <h5 class="text-lg font-medium mt-8 mb-6">Address</h5>
                        
                        <!-- Address first row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Country</label>
                                <p class="mt-1">{{ $user->address_country ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">City, State</label>
                                <p class="mt-1">{{ $user->address_city ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        
                        <!-- Address second row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Postal Code</label>
                                <p class="mt-1">{{ $user->postal_code ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">TAX ID</label>
                                <p class="mt-1">{{ $user->tax_id ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection