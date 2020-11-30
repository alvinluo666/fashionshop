<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request){
        $order=Order::create($request->all());
        if($order){
            return response()->json(['message'=>'success'],200);
        }else{
            return response()->json(['message'=>'fail'],500);
        }
    }
    public function allOrder(){
        if(Auth::check()){
            $orders=Order::with('product')->where('user_id',Auth::user()->id)->where('status','active')->get();
            if($orders){
                return view('vieworder',['orders'=>$orders]);
            }else{
                return 'Invalid';
            }
        }
    }
    public function changeStatus($id){
        if(Auth::check()){
            $order=Order::where('id',$id)->where('user_id',Auth::user()->id);
            if($order){
                $order->update(['status'=>'complete']);
                return response()->json(Order::with('product')->where('user_id',Auth::user()->id)->where('status','active')->get());
            }else{
                return 'Invalid';
            }
            // dd($order);
        }
    }
}
