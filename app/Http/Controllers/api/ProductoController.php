<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\ProductoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductoController extends Controller
{
    protected $apiService;
    public function __construct(ProductoService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->apiService->getProductos();
        return response()->json($result, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->apiService->postProducto($request->all());
        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $result = $this->apiService->getProducto($id);

        if (isset($result)) {
            return response()->json($result, 200);
        } else {
            return response()->json('No existe el producto', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = $this->apiService->putProducto($id, $request->all());

        if (isset($result)) {
            return response()->json($result, 200);
        } else {
            return response()->json('No existe el producto', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->apiService->deleteProducto($id);

        if (isset($result)) {
            return response()->json($result, 200);
        } else {
            return response()->json('No existe el producto', 404);
        }
    }
}
