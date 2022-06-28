<?php

namespace App\Http\Controllers;

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
}
