<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

class CategoriesController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function show(Request $request, $name)
    {
        $category = Category::where(['name' => $name])->first();
        $products = $category->products;
        return view('products.index', ['products' => $products]);
    }
    
}
