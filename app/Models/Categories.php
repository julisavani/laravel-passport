<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'slug' , 'parent_id' , 'is_filterable' , 'created_by' , 'status' ];
    public function parent(){
        return $this->hasOne(Categories::class, 'parent_id', 'id');
    }
}
