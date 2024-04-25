<?php

namespace App\Http\Controllers;

use App\Models\BillingAddress;
use App\Models\Cart;
use App\Models\customerAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    public function addToCart(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'qty' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, "error" => $this->validationMessage($validator->errors()->toArray())], 422);
        }
        $cart = Cart::where(['product_id' =>  $request->product_id , "user_id" => Auth::guard('api')->user()->id  ])->first();
        $qty = $cart->qty ?? 1;
        if($cart){
            $cart->update([ 'qty' => $qty + 1]);
        }else{
            $product = Products::find( $request->product_id);
            Cart::create([ 'product_id' => $request->product_id , 'amount' => $product->product_price ,'qty' => $qty , 'user_id' =>  Auth::guard('api')->user()->id ]); 
        }
        return response()->json(['success' => true, 'message' => 'Add to cart successfully'], 200);
    }
    public function increaseProduct(Cart $cart){
        $cart->update(['qty' => $cart->qty + 1]);
        return response()->json(['success' => true, 'message' => 'Increase Product successfully'], 200);
    }
    public function decreaseProduct(Cart $cart){
        if($cart->qty == 1) $cart->delete();
        else  $cart->update(['qty' => $cart->qty - 1]);
        return response()->json(['success' => true, 'message' => 'Dicrease Product successfully'], 200);
    }
    public function removeToCart(Cart $cart){
        $cart->delete();
        return response()->json(['success' => true, 'message' => 'Remove to cart'], 200);
    }
    public function payment(Request $request){
        try {
            // $payment = $api->payment->fetch($input['razorpay_payment_id']);
            $validator = Validator::make($request->all(), [
                'same_as_shipping_address' => 'required',
                'billing_id' => 'required_if:same_as_shipping_address,=,0',
                'shipping_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, "error" => $this->validationMessage($validator->errors()->toArray())], 422);
            }
            
            $data = $request->all();
            $data['user_id'] = Auth::guard('api')->user()->id;
            $cartData = Cart::where('user_id' , $data['user_id'])->get();
            $amount = 0;
            foreach($cartData as $cart){
                $amount = $amount + ( $cart->amount *  $cart->qty );
            }
            // $payload = 'same_as_shipping_address='.$request->same_as_shipping_address.'&user_id='.Auth::guard('api')->user()->id.'&billing_id='.$request->billing_id.'&shipping_id='.$request->shipping_id.'&contact_information='.$request->contact_information;
            // dd($payload);
            //place order 
            $latestOrder = Order::orderBy('created_at','DESC')->first();
            $data['code'] = '#'.str_pad(($latestOrder) ? $latestOrder->id : 1 + 1, 8, "0", STR_PAD_LEFT); //= Str::random(20)
            $order_id = Order::insertGetId(['user_id' => $data['user_id'] , 'code' =>  $data['code'] , 'status' => 4 , 'shipping_id' => $data['shipping_id'] ,  'billing_id' => $data['billing_id'] , 'same_as_shipping_address' => $data['same_as_shipping_address'] , 'contact_information' => Auth::guard('api')->user()->email]);
            $cartData = Cart::where('user_id' , $data['user_id'])->get();
            $amount = 0;
            foreach($cartData as $cart){
                $order['order_id'] = $order_id;
                $order['product_id'] = $cart->product_id;
                $order['user_id'] = $cart->product_id;
                $order['amount'] = ( $cart->amount *  $cart->qty );
                $order['qty'] = $cart->qty;
                $amount = $amount + ( $cart->amount *  $cart->qty );
                OrderDetail::create($order);
            }
            Order::find($order_id)->update(['amount' => $amount ]);
            //end
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $response =  $api->paymentLink->create(array('amount'=> $amount * 100, 'currency'=>'INR', 'accept_partial'=>false,
            'first_min_partial_amount'=>100, 'description' => '', 'notify'=>array('sms'=>true, 'email'=>true),
<<<<<<< HEAD
            'reminder_enable'=>true ,'notes'=> '' ,'callback_url' => "http://localhost:3000/order-placed?order_id=".$order_id,
=======
            'reminder_enable'=>true ,'notes'=> '' ,'callback_url' => "https://andor.sixty13.com/order-placed?order_id=".$order_id,
>>>>>>> d67556b4d5bc661467c460b37048fb3a60849368
            'callback_method'=>'get'));
            
            return response()->json(['success' => true, 'response' => [ 'url' =>  $response['short_url'] , 'order_id' => $order_id]] , 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'response' =>  $e->getMessage() ], 500);
        }
    }
    public function placeOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'razorpay_payment_id' => 'required',
            'razorpay_payment_link_id' => 'required',
            'order_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, "error" => $this->validationMessage($validator->errors()->toArray())], 422);
        }
        $data = $request->all();
        $order = Order::find($data['order_id']);
        // dd($order);
        $payment = Payment::insertGetId(['status' => 1 , 'amount' => $order->amount ,'user_id' => $order->user_id, 'payment_id' => $data['razorpay_payment_id'] , 'razorpay_payment_link_id' => $data['razorpay_payment_link_id']]);
        Order::find($data['order_id'])->update(['payment_id' =>  $payment , 'status' => 1 ]);
        Cart::where('user_id' ,  $order->user_id)->delete();
        return response()->json(['success' => true, 'message' => 'Order Place successfully successfully'], 200);
    }
    public function getAddress(Request $request){
        $address = customerAddress::where('customer_id' ,Auth::guard('api')->user()->id )->with('country', 'state')->get();
        return response()->json(['success' => true, 'data' => $address ], 200);
    }
    public function storeAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state_id' => 'required',
            'postal_code' => 'required',
            'country_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, "error" => $this->validationMessage($validator->errors()->toArray())], 422);
        }
        $data = $request->all();
        $data['customer_id'] = Auth::guard('api')->user()->id;
        $data['address2'] = $data['address2'];
       $address = customerAddress::create($data);
        return response()->json(['success' => true, 'data' => $address , 'message' => 'address store successfully'], 200);
    }
    public function cartDetail(Request $request){
        $cart = Cart::with('product')->where('user_id' ,  Auth::guard('api')->user()->id)->get();
        return response()->json(['success' => true, 'data' => $cart], 200);
    }
    public function myOrder(){
        $order = Order::where('user_id' , Auth::guard('api')->user()->id)->with('shipping_id' ,'billing_id')->get()->map(function($param){
            $param['products'] = OrderDetail::where('order_id' , $param->id)->with('product')->get();
            return $param;
        });
        return response()->json(['success' => true, 'data' => $order], 200);
    }
}
