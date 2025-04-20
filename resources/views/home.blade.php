@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <!-- Navbar -->
    <x-navbar />
    <div class="relative w-full h-screen">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url({{ asset('images/background.jpg') }});">
        </div>
        <div class="absolute inset-0 bg-[#FD7924] bg-opacity-50"></div>

        <div class="relative flex flex-col items-center justify-center h-full text-white text-center">
            <h1 class="text-5xl font-poppins font-extrabold  text-[#F7E9CC]">ImmoFacile</h1>
            <p class="mt-4 text-lg w-3/4 text-[#F7E9CC] ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, quam?
            </p>
            @auth
                <p>Bienvenue, {{ Auth::user()->name }} !</p>
                <a href="{{ route('profile') }}">Voir votre profil</a>
            @else
                <a href="{{ route('login') }}">Se connecter</a>
            @endauth


            <!-- Barre de recherche -->
            <div class="mt-6">
                <input type="text" placeholder="Search"
                    class="px-4 py-2 rounded-full bg-[#F7E9CC] bg-opacity-80 text-gray-900 w-80">
            </div>
        </div>
    </div>

@endsection
