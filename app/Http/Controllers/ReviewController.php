<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Order;

class ReviewController extends Controller
{
    public function store(Request $request){
        //check if order exist
        $order=Order::where('id',$request->order_id)->where('product_id',$request->product_id)->where('user_id',$request->user_id)->where('status','active')->get();
        if(count($order)>0){
            $review=Review::create($request->only('product_id','user_id','message','rating'));
            return response()->json(['message'=>'succes'],200);
        }else{
            dd('request fail');
        }
    }
}
