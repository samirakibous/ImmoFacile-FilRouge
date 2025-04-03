<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WikimediaService;

class cityController extends Controller
{
    
    protected $wikimediaService;

    // Injecter le service dans le constructeur
    public function __construct(WikimediaService $wikimediaService)
    {
        $this->wikimediaService = $wikimediaService;
    }

    public function showCityImages($cityName)
    {
        // Utiliser le service pour obtenir les images de la ville
        $images = $this->wikimediaService->getCityImage($cityName);

        // Retourner la vue avec les images
        return view('city.images', compact('images'));
    }
}
