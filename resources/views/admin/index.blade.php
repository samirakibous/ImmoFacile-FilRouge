@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Navbar -->
    <x-navbar />
    <div class="flex min-h-screen">

        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-2xl font-bold mb-8 text-yellow-500">Dashboard</h1>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <!-- Total Orders Card -->
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-orange-100 mb-4"></div>
                    <h2 class="text-3xl font-semibold">75</h2>
                    <p class="text-gray-500 text-sm">Total Orders</p>
                    <p class="text-gray-400 text-xs mt-1">+12%</p>
                </div>

                <!-- Total Delivered Card -->
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-orange-100 mb-4"></div>
                    <h2 class="text-3xl font-semibold">357</h2>
                    <p class="text-gray-500 text-sm">Total Delivered</p>
                    <p class="text-gray-400 text-xs mt-1">+24%</p>
                </div>

                <!-- Total Cancelled Card -->
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-orange-100 mb-4"></div>
                    <h2 class="text-3xl font-semibold">65</h2>
                    <p class="text-gray-500 text-sm">Total Cancelled</p>
                    <p class="text-gray-400 text-xs mt-1">+9%</p>
                </div>

                <!-- Total users card -->
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-orange-100 mb-4"></div>
                    <h2 class="text-3xl font-semibold">{{ $totalUsers }}</h2>
                    <p class="text-gray-500 text-sm">Total users</p>
                    <p class="text-gray-400 text-xs mt-1">+9%</p>
                </div>
            </div>


        </div>
    </div>

    <!-- Include Alpine.js for interactivity if needed -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
