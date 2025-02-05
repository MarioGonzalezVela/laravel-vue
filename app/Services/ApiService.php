<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL');
        $this->apiKey = env('API_KEY');
    }

    protected function checkResponse($response)
    {
        if ($response->ok()) { // Código 200
            $items = $response->json();
            // Manejar los datos del producto creado
            return $items;
        } else {
            // Manejar errores
            abort($response->status(), $response->body());
        }
    }

    public function get($url)
    {
        try {
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ])
                ->get($this->baseUrl . $url);

            return $this->checkResponse($response);
        } catch (RequestException $e) {
            Log::error('Error fetching API data', ['exception' => $e]);
            abort(500, ['error' => 'API request failed']);
        }
    }
}
