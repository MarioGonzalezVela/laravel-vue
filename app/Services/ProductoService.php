<?php

namespace App\Services;

use App\Services\ApiService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class ProductoService extends ApiService
{


    public function __construct()
    {
        parent::__construct();
    }

    public function getProductos()
    {
        return parent::get('/products');
    }

    public function getProducto($id)
    {
        return parent::get('/products//' . $id);
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
