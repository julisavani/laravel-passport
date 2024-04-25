<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id' , 'user_id' ,  'amount' , 'payment_id' , 'code' , 'status' , 'shipping_id' , 'billing_id' , 'same_as_shipping_address' ,'contact_information'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function shipping_id(){
        return $this->belongsTo(customerAddress::class, 'shipping_id', 'id');
    }
    public function billing_id(){
        return $this->belongsTo(customerAddress::class, 'billing_id', 'id');
    }
    public function payment_id(){
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
