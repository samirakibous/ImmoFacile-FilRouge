<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="h-screen flex items-center justify-center bg-gray-900">
    <div class="relative w-full h-full">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url({{ asset('images/background.jpg') }});"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Contenu -->
        <div class="relative flex flex-col items-center justify-center h-full">
            <div class="bg-white bg-opacity-20 backdrop-blur-md p-8 rounded-2xl shadow-lg w-96">
                <h2 class="text-white text-2xl font-semibold text-center mb-6">Create your account</h2>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Full Name Input -->
                    <input type="text" name="name" placeholder="Full Name" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                    <!-- Email Input -->
                    <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                    <!-- Password Input -->
                    <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                    <!-- Confirm Password Input -->
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>

                    <!-- Role Selection -->
                    <select name="role_id" class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="2">Agent</option>
                        <option value="3">User</option>
                    </select>

                    <p class="text-white text-center">Or</p>

                    <!-- Google Sign Up Button -->
                    <a href="{{ url('login/google') }}" class="btn btn-primary">
                        Se connecter avec Google
                    </a>
                    <button type="submit" class="w-full bg-blue-500 text-white font-medium px-4 py-2 rounded-full shadow">Sign Up</button>
                </form>

                <p class="text-white text-center mt-4">Already have an account? <a href="{{ route('login') }}" class="underline">login</a></p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
     $(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();  // Empêche l'envoi classique du formulaire

        let formData = {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val(),
            password_confirmation: $('input[name="password_confirmation"]').val(),
            role_id: $('select[name="role_id"]').val(),
        };

        $.ajax({
            url: 'http://127.0.0.1:8000/api/signup',  //url de la route api
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ajout du token CSRF dans les en-têtes
            },
            success: function(response) {
                console.log(response); 
                if (response.success) {
                    localStorage.setItem('token', response.token);
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        alert('Erreur : L\'URL de redirection est manquante.');
                    }
                } else {
                    alert('Erreur : ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Erreur de requête : ' + error);
            }
        });
    });
});


    </script>
        
</body>

</html>
