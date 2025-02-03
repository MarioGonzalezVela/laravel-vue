<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class ProductoService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL');
        $this->apiKey = env('API_KEY');
    }

    private function checkResponse($response)
    {
        if ($response->ok()) { // Código 200
            $producto = $response->json();
            // Manejar los datos del producto creado
            return $producto;
        } else {
            // Manejar errores
            abort($response->status(), $response->body());
        }
    }

    public function getProductos()
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ])
                ->get($this->baseUrl . '/products');

            return $this->checkResponse($response);
        } catch (RequestException $e) {
            Log::error('Error fetching API data', ['exception' => $e]);
            abort(500, ['error' => 'API request failed']);
        }
    }

    public function getProducto($id)
    {
        try {
            $response = Http::withoutVerifying()->withHeaders([

                'Authorization' => 'Bearer ' . env('API_KEY'),
            ])->get($this->baseUrl . '/products//' . $id);

            return $this->checkResponse($response);
        } catch (RequestException $e) {
            Log::error('Error fetching API data', ['exception' => $e]);
            abort(500, ['error' => 'API request failed']);
        }
    }

    public function postProducto($data)
    {
        try {
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->withToken(env('API_KEY'))
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($this->baseUrl . '/products', $data);

            return $this->checkResponse($response);
        } catch (RequestException $e) {
            Log::error('Error fetching API data', ['exception' => $e]);
            abort(500, ['error' => 'API request failed']);
        }
    }

    public function putProducto($id, $data)
    {
        try {
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->withToken(env('API_KEY'))
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->put($this->baseUrl . '/products//' . $id, $data);

            return $this->checkResponse($response);
        } catch (RequestException $e) {
            Log::error('Error fetching API data', ['exception' => $e]);
            abort(500, ['error' => 'API request failed']);
        }
    }

    public function deleteProducto($id)
    {
        try {
            $response = Http::withoutVerifying()
                ->acceptJson()
                ->withHeaders([
                    'Authorization' => 'Bearer' . $this->apiKey,
                ])
                ->delete($this->baseUrl . '/products//' . $id);

            return $this->checkResponse($response);
        } catch (RequestException $e) {
            Log::error('Error fetching API data', ['exception' => $e]);
            abort(500, ['error' => 'API request failed']);
        }
    }
}
