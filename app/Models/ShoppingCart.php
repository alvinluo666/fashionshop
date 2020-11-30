<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'quantity',
        'size',
        'color'
    ];
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
