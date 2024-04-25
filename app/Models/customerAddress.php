<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerAddress extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name' , 'customer_id', 'address1', 'address2', 'city', 'state_id', 'postal_code', 'status' , 'country_id'];
    public function user(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function state(){
        return $this->belongsTo(CountryState::class, 'state_id', 'id');
    }
    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
