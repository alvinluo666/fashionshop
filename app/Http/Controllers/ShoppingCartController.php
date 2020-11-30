<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request){
     
        if($request['user_id']==Auth::user()->id){
            ShoppingCart::create($request->all()); 
            return response()->json([],200);
        }
    }
    public function cart(){
        
        if(Auth::check()){
            $products=ShoppingCart::with('product')->where('user_id',Auth::user()->id)->get();
            if($products)
                return response()->json($products,200);
            else
                return response()->json([],200);
        }else{
            return response()->json([],200);
        }
    }   
    public function removeCart($id){
        if(Auth::check()){
            $product=ShoppingCart::find($id);
            $d=$product->delete();
            return response()->json($id,200);
        }
    }
    public function updateQuantity($id,$quantity){
        $product=ShoppingCart::find($id);
        $product->quantity=$quantity;
        $product->save();
        return response()->json($product,200);
    }
}
