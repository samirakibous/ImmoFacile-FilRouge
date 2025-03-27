<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-900">
    <div class="relative w-full h-full">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url({{ asset('images/background.jpg') }});"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Contenu -->
        <div class="relative flex flex-col items-center justify-center h-full">
            <div class="bg-white bg-opacity-20 backdrop-blur-md p-8 rounded-2xl shadow-lg w-96">
                <h2 class="text-white text-2xl font-semibold text-center mb-6">Create your account</h2>

                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" placeholder="Full Name" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md">
                    <input type="email" placeholder="Email" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md">
                    <input type="password" placeholder="Password" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md">
                    <input type="password" placeholder="Confirm Password" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md">

                    <p class="text-white text-center">Or</p>

                    <button class="w-full flex items-center justify-center bg-white text-gray-900 font-medium px-4 py-2 rounded-full shadow">
                        <img src="{{ asset('images/google.png') }}" class="w-5 h-5 mr-2">
                        Sign up with Google
                    </button>
                </form>

                <p class="text-white text-center mt-4">Already have an account? <a href="login" class="underline">login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
