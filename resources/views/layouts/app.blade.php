<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Application immobilière ImmoFacile">
    <title>@yield('title', 'ImmoFacile')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poly:ital@0;1&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen flex flex-col">
   

    <!-- Contenu principal -->
    <main class="flex-grow">
        @yield('content')
    </main>

    
    
    <!-- Scripts -->
    @stack('scripts')
</body>
</html>