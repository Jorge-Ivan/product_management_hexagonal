<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Product\CreateProduct;
use App\Application\UseCases\Product\UpdateProduct;
use App\Application\UseCases\Product\GetProducts;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $createProduct;
    private $updateProduct;
    private $getProducts;

    public function __construct(CreateProduct $createProduct, UpdateProduct $updateProduct, GetProducts $getProducts)
    {
        $this->createProduct = $createProduct;
        $this->updateProduct = $updateProduct;
        $this->getProducts = $getProducts;
    }

    public function index(Request $request)
    {
        return response()->json($this->getProducts->execute($request->all()));
    }

    public function store(Request $request)
    {
        return response()->json($this->createProduct->execute($request->all()), 201);
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->updateProduct->execute($id, $request->all()));
    }
}
