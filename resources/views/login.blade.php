<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="h-screen flex items-center justify-center bg-gray-900">
    <div class="relative w-full h-full">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/background.jpg') }}');"></div>
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Contenu -->
        <div class="relative flex flex-col items-center justify-center h-full">
            <div class="bg-white bg-opacity-20 backdrop-blur-md p-8 rounded-2xl shadow-lg w-96">
                <h2 class="text-white text-2xl font-semibold text-center mb-6">Sign in to your account</h2>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <input type="email" id="email" name="email" placeholder="Email"
                        class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md">
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="w-full px-4 py-2 bg-white bg-opacity-70 text-gray-900 rounded-md">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-medium px-4 py-2 rounded-full shadow">Sign In</button>

                    <p class="text-white text-center">Or</p>

                    <button
                        class="w-full flex items-center justify-center bg-white text-gray-900 font-medium px-4 py-2 rounded-full shadow">
                        <img src="{{ asset('images/google.png') }}" class="w-5 h-5 mr-2">
                        Sign in with Google
                    </button>
                </form>
                @if ($errors->any())
                    <div class="text-red-500 text-sm text-center">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div id="login-error" style="color: red;" class="mt-2 text-sm text-center"></div>

                <p class="text-white text-center mt-4">Don’t have an account?
                    <a href="{{ route('signup') }}" class="underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>
{{-- 
    <script>
        $('#login-form').on('submit', function(e) {
            e.preventDefault();

            const email = $('#email').val();
            const password = $('#password').val();

            $.ajax({
                url: '/api/login',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    email,
                    password
                }),
                success: function(response) {
                    console.log('Connexion réussie', response);
                    if (response.user.redirect) {
                        window.location.href = response.user.redirect;
                    } else {
                        $('#login-error').text('Redirection non trouvée.');
                    }
                },
                error: function(xhr) {
                    console.error('Erreur de connexion', xhr.responseJSON);
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        $('#login-error').text(xhr.responseJSON.error);
                    } else {
                        $('#login-error').text("Erreur inconnue");
                    }
                }
            });
        });
    </script> --}}
</body>

</html>
