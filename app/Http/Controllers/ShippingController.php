<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    protected $fillable=['destination','shipper','cost'];

    public function getShipping(){
        $shipping=Shipping::all();
        return response()->json($shipping,200);
    }
}
