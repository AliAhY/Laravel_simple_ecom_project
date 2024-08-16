<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        // $prod_categories = Products::with('categories')->latest()->take(2)->get();
        $main_category = Categories::with('products')->get();
        $categories = Categories::get();
 
        return view('site.layouts.index', compact('main_category', 'categories'));
    }


    public function details(string $id)
    {
    

        $product = Products::where('id', $id)->with('categories')->get();
        $categories = Categories::get();
        // return $product;
        return view('site.layouts.details', compact('product', 'categories'));
    }

   
}
