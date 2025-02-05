<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected $apiService;
    public function __construct(CategoriaService $apiService)
    {
        $this->apiService = $apiService;
    }
    public function index()
    {
        $result = $this->apiService->getCategorias();
        return response()->json($result, 200);
    }

    public function show(string $id)
    {

        $result = $this->apiService->getCategoria($id);

        if (isset($result)) {
            return response()->json($result, 200);
        } else {
            return response()->json('No existe el producto', 404);
        }
    }
}
