@extends('layouts.app')

@section('title', 'signup')

@section('content')

    <body class="h-screen flex items-center justify-center bg-gray-900">
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
                        <a href="{{ url('login/google') }}" class="btn btn-primary">
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
    </body>
@endsection
