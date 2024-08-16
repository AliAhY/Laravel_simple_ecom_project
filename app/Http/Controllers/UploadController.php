<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    


    public function upload_image_product(Request $request)
    {
        //upload image
        if (!File::exists(storage_path('app/public/media/products'))) {
            File::makeDirectory(storage_path('app/public/media/products'));
        }

        $file = $request->image;
        $name = $file->hashName();
        $filename = time() . '.' . $name;
        $file->storeAs('public/media/products', $filename);

        return $filename;
    }

    public function upload_image_category(Request $request)
    {
        //upload image
        if (!File::exists(storage_path('app/public/media/categories'))) {
            File::makeDirectory(storage_path('app/public/media/categories'));
        }

        $file = $request->image;
        $name = $file->hashName();
        $filename = time() . '.' . $name;
        $file->storeAs('public/media/categories', $filename);

        return $filename;
    }
}
