<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categorie', 'brand', 'product_images')->get();
        $categories = Categorie::get();
        $brands = Brand::get();
        return Inertia::render('Admin/Product/Index', ['products' => $products, 'categories' => $categories, 'brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->categorie_id = $request->categorie_id;
        $product->brand_id = $request->brand_id;
        $product->save();

        // check for images
        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');
            foreach ($productImages as $image) {
                if ($image->isValid()) {
                    $path = $image->store('Images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => "/storage/" . $path
                    ]);
                }
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->categorie_id = $request->categorie_id;
        $product->brand_id = $request->brand_id;
        // check if image uload

        if ($request->hasFile('product_images')) {
            // $productImage = $request->file('product_images');
            // foreach ($productImage as $image) {
            //     $uniqueName = time() . '-'  . Str::random(10) . '.' . $image->getClientOriginalExtension();
            //     //store the image in the public folder
            //     $image->move('product_images', $uniqueName);
            //     //create a new product image
            //     ProductImage::create([
            //         'product_id' => $product->id,
            //         'image' => 'product_images/' . $uniqueName,
            //     ]);
            // }
            $productImages = $request->file('product_images');
            foreach ($productImages as $image) {
                if ($image->isValid()) {
                    $path = $image->store('Images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => "/storage/" . $path
                    ]);
                }
            }
        }
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteImage($id)
    {
        $image = ProductImage::where('id', $id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Image deleted successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->back('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
