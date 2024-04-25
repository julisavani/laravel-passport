<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Categorywiseproduct extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['category_id' , 'product_id'];
    public function product(){
        return $this->belongsTo(Products::class, 'product_id', 'id')->with('featuredImage');
    }
}
