<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'user_id',
        'message',
        'rating'
    ];
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','user');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
