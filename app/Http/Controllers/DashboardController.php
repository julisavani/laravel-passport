<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(){
        return view('admin.dashboard');
    }
    public function login()
    {
        if(auth()->guard('web')->user()){    
            return redirect()->route('admin.dashboard');
        } else {
            return view('admin.login');
        }
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);
        
        if(auth()->guard('web')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }else{
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
    }
    public function orders(){
        $order =  Order::with('user')->get()->toArray();
        // dd($order);
        return view('admin.order' , compact('order'));
    }
    public function paymentHistory(Request $request){
         $payment = Payment::all();
         return view('admin.payment-history' , compact('payment'));
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('admin/login');
        // return response()->json(['success' => true, 'data' => ['message' => 'Log out successfully.']], 200);
    }
}
