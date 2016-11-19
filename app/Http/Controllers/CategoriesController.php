<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use Carbon\Carbon;


class CategoriesController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function show(Request $request, $name)
    {
        $category = Category::where(['name' => $name])->with('products')->first();
        $products = $category->products()->where('due_date', '>', date('Y-m-d'))->orderBy('created_at', 'desc')->get();
        return view('products.index', ['products' => $products]);
    }
    
}
