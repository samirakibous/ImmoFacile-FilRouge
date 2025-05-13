@extends('layouts.app')

@section('title', 'signup')

@section('content')

<div class="h-screen flex items-center justify-center bg-gray-900">
        <div class="relative w-full h-full">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url({{ asset('images/background.jpg') }});"></div>
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <!-- Contenu -->
            <div class="relative flex flex-col items-center justify-center h-full">
                <div class="bg-white bg-opacity-20 backdrop-blur-md p-8 rounded-2xl shadow-lg w-96">
                    <h2 class="text-white text-2xl font-semibold text-center mb-6">Create your account</h2>

                    <form action="{{ route('signup') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Full Name Input -->
                        <input type="text" name="name" placeholder="prenom"
                            class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                        <input type="text" name="last_name" placeholder="nom"
                            class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>
                        <!-- Email Input -->
                        <input type="email" name="email" placeholder="Email"
                            class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                        <!-- Password Input -->
                        <input type="password" name="password" placeholder="Password"
                            class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                        <!-- Confirm Password Input -->
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                            class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                        <!-- Role Selection -->
                        <select name="role_id" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md"
                            required>
                            <option value="" disabled selected>Select your role</option>
                            <option value="2">Agent</option>
                            <option value="3">User</option>
                        </select>

                        <p class="text-white text-center">Or</p>

                        <!-- Google Sign Up Button -->
                        <a href="{{ url('login/google') }}" class="flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg shadow-md transition duration-200">
                            <svg class="w-5 h-5" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#4285F4" d="M533.5 278.4c0-17.8-1.6-35-4.6-51.4H272v97.2h146.9c-6.3 34.3-25.4 63.4-54 83v68.7h87.3c51.1-47.1 81.3-116.4 81.3-197.5z"/>
                                <path fill="#34A853" d="M272 544.3c73.2 0 134.6-24.3 179.5-65.9l-87.3-68.7c-24.2 16.2-55.2 25.7-92.2 25.7-70.9 0-131-47.9-152.5-112.1H30.9v70.6c44.6 88 136.1 150.4 241.1 150.4z"/>
                                <path fill="#FBBC04" d="M119.5 323.3c-10.3-30.8-10.3-63.7 0-94.5V158.2H30.9c-34.1 67.9-34.1 146.4 0 214.3l88.6-49.2z"/>
                                <path fill="#EA4335" d="M272 107.6c38.6 0 73.3 13.3 100.7 39.3l75.4-75.4C406.5 24.3 345.2 0 272 0 166.9 0 75.4 62.4 30.9 150.4l88.6 70.6c21.5-64.2 81.6-112.1 152.5-112.1z"/>
                            </svg>
                            Se connecter avec Google
                        </a>
                        
                        <button type="submit"
                            class="w-full bg-blue-500 text-white font-medium px-4 py-2 rounded-full shadow">Sign Up</button>
                    </form>

                    <p class="text-white text-center mt-4">Already have an account? <a href="{{ route('login') }}"
                            class="underline">login</a></p>
                </div>
            </div>
        </div>
</div>
@endsection
