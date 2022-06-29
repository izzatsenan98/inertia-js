<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products =  ProductResource::collection(Product::all());

        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/Create');
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect(route('products.index'))
            ->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'Product Added Succesfully',
                ]
            ]);
    }
}
