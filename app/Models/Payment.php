<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['id' , 'user_id' ,'status' , 'amount' , 'payment_id' , 'razorpay_payment_link_id'];
}
