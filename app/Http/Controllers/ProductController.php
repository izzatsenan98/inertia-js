<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = ProductResource::collection(Product::productsQuery()->paginate(10));
        $products = Product::productsQuery()->paginate(10);

        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return Inertia::render('Products/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect(route('products.index'))
            ->with('item_id', $product->id)
            ->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'Product Added Succesfully',
                ]
            ]);
    }

    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id');

        return Inertia::render('Products/Edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect(route('products.index'))
            ->with('item_id', $product->id)
            ->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'Product Updated Succesfully',
                ]
            ]);
    }

    public function show(Product $product)
    {
        // dd($product->category->name);
        return Inertia::render('Products/Show', [
            'product' => $product,
            'productAlt' => [
                'created_at' => $product->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $product->updated_at->format('Y-m-d H:i:s'),
            ],
            'category' => $product->category->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
