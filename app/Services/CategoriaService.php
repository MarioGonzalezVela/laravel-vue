<?php

namespace App\Services;

use App\Services\ApiService;

class CategoriaService extends ApiService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategorias()
    {
        return parent::get('/products/categories');
    }

    public function getCategoria($id)
    {
        return parent::get('/products/categories//' . $id);
    }
}
