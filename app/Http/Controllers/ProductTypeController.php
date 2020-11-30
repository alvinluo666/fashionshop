<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\ProductCategory;

class ProductTypeController extends Controller
{
    public function index($category){

        $category = ProductCategory::where('title',$category)->get();
        $category_id=$category[0]->id;

        return response()->json(ProductType::with('products')->where('category',$category_id)->get(),200);
    }
}
