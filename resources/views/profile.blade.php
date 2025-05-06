@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <x-navbar />
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row gap-6">
            <x-profileSidebare />
            <!-- Content -->
            <div class="w-full md:w-3/4">
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold">My Profile</h2>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center mb-6">
                            <div class="mr-6 mb-4 sm:mb-0 relative group">
                                <label for="photo-upload" class="cursor-pointer block">
                                    <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'image.png')) }}"
                                        alt="Profile" class="rounded-full w-24 h-24 object-cover">

                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <span class="text-white text-xs font-medium">Change Photo</span>
                                    </div>
                                </label>

                                <!--hidden file input-->
                                <form id="profile-photo-form" action="{{ route('profile.update.photo') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" id="photo-upload" name="profile_picture" accept="image/*"
                                        class="hidden" onchange="document.getElementById('profile-photo-form').submit()">
                                </form>
                            </div>

                            <div class="text-center sm:text-left">
                                <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                                <h3 class="text-lg font-semibold text-gray-500">{{ $user->last_name }}</h3>
                                <p class="text-gray-500">{{ $user->address_city }} {{ $user->address_country }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-auto">
                                <a href="{{ route('profile.edit') }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h5 class="text-lg font-medium">Personal Information</h5>
                        </div>

                        <!-- First row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">First Name</label>
                                <p class="mt-1">{{ $user->name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">LAst Name</label>
                                <p class="mt-1">{{ $user->last_name }}</p>
                            </div>
                        </div>

                        <!-- Second row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email Address</label>
                                <p class="mt-1">{{ $user->email }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <x-footer />
@endsection
