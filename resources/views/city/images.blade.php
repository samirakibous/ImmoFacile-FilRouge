<!-- resources/views/city/images.blade.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Images de la Ville</title>
</head>

<body>
    <h1>Images de la Ville</h1>
    @foreach ($images as $image)
    <img src="https://upload.wikimedia.org/wikipedia/commons/{{ $image }}" alt="Image de la ville">
    @endforeach
</body>

</html>




