<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Categories;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::with('categories')->get();
        // return $products;
        return  view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();

        return  View('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // return $request;
        // dd($request->input());

        try {


            $blog = Products::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'category_id' => $request->resoureceName,

            ]);


            // endforeach

            return back()->with('success', 'The Blog has inserted successfully');
        } catch (Exception $e) {

            return back()->withErrors(['error' => 'something happend']);
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Products::with('categories')->findOrFail($id);
        // return $product;

        $categories = Categories::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(EditProductRequest $request, Products $product)
    {
        $product->title = $request->title;
        $product->content = $request->content;
        $product->category_id = $request->resoureceName;

        if ($request->image != null) {
            $product->image = $request->image;
        }
        $product->save();






        return back()->with('success', 'The product has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Products::findOrFail($id);
        $blog->delete();
        return back()->with('danger', 'The Blog has deleted successfully');
    }
}
