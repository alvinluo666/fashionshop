<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['product_id','user_id','email','address','fullname','phone','city','size','color','quantity','shipper','ship_info','status'];
    protected $casts=[
        'ship_info'=>'array'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
