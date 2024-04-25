<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['id' , 'product_id' , 'user_id' , 'qty' , 'amount'];
    public function product(){
        return $this->belongsTo(Products::class, 'product_id', 'id')->with('featuredImage');
    }
}
