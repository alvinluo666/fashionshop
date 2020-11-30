<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
class ProductController extends Controller
{
    public function suggestedProducts(){
        $suggestedProducts=Product::inRandomOrder()->limit(8)->get();
        //apply recommender engine in future
        return response()->json($suggestedProducts,200);
    }
    public function productToday(){
        $productToday=Product::limit(8)->orderBy('created_at')->get();
        return response()->json($productToday,200);
    }
    public function color($category){
        $category = ProductCategory::where('title',$category)->get();
        $category_id=$category[0]->id;

        $colors=Product::where('category',$category_id)->get()->pluck('color');
        return response()->json($colors,200);
    }
    public function getProducts(Request $request,$category){

        $category = ProductCategory::where('title',$category)->get();
        $category_id=$category[0]->id;
        $products= Product::where('category',$category_id)->paginate(8);

        return response()->json($products,200);
    }

    public function getSingleProduct($category,$id){
        $product=Product::with('reviews')->find($id);
        if($product){
            return response()->json($product,200);
        }
        return response()->json(['Message'=>'Product Not Found'],200);
    }

    //
    public function search(Request $request){
        $key=htmlspecialchars($request['key']);
        $products = Product::where('name','LIKE','%'.$key.'%')->paginate(12);
        // return response()->json($products,200);
        // dd($products->data);
        return view('searchresult',['products'=>$products]);
    }
}
