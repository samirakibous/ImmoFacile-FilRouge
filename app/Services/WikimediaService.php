<?php
// app/Services/WikimediaService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikimediaService
{
    public function getCityImage(string $cityName)
    {
        // Appel à l'API Wikimedia
        $response = Http::get("https://commons.wikimedia.org/w/api.php", [
            'action' => 'query',
            'format' => 'json',
            'titles' => $cityName,
            'prop' => 'images'
        ]);

        // Vérifie si la réponse est correcte et contient des images
        if ($response->successful()) {
            $data = $response->json();
            
            // Vérifie la structure de la réponse
            if (isset($data['query']['pages'])) {
                $pages = $data['query']['pages'];
                $imageTitles = [];
                foreach ($pages as $page) {
                    if (isset($page['images'])) {
                        foreach ($page['images'] as $image) {
                            $imageTitles[] = $image['title'];
                        }
                    }
                }
                return $imageTitles;
            } else {
                // Si la clé "pages" n'existe pas, retourne un tableau vide
                return [];
            }
        }

        return [];
    }
}
