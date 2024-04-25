<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryState extends Model
{
    use HasFactory;
    protected $table = "country_states";
    protected $fillable = ['id' , 'country_id', 'name' , 'code' , 'status'];
}
