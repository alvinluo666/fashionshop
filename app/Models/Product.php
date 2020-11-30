<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','price','promotePrice','category','type','color','size','image','description'];
    protected $casts=[
        'color'=>'array',
        'size'=>'array',
        'image'=>'array'
    ];

    public function type(){
        return $this->hasOne('App\Models\ProductType','id','type');
    }

    public function category(){
        return $this->hasOne('App\Models\ProductCategory','id','category');
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review','product_id','id')->with('user')->orderBy('created_at');
    }

    // public function user(){
    //     return $this->hasManyThrough('App\Models\User','App\Models\Review','product_id','id','id','id');
    // }
}
