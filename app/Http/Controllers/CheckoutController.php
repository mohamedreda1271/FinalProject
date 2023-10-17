<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceived;
class CheckoutController extends Controller
{
     public function index()
    {
        // Get all items in
        $cartItems = \Cart::getContent();
        return view('checkout' , compact('cartItems'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validate = $request->validate([
            'firstname'=>'required|max:50',
            'lastname'=>'required|max:50',
            'phone'=>'required|numeric',
            'city'=>'required|max:100',
            'address'=>'required|max:100',
        ]);

        // Save customer into database
        $customer = Customer::create([
            'user_id'=>auth()->user()->id,
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'phone'=>$request->phone,
            'city'=>$request->city,
            'address'=>$request->address,
        ]);

        //Save order into orders table 
        $cartItems = \Cart::getContent();
        $length = 10;
        $order_no = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
        uniqid($order_no);
        $total = \Cart::getTotal();
        $payment = request('payment-option');

        $order = Order::create([
            'customer_id'=>$customer->id,
            'order_no'=>$order_no,
            'payment_type' => $payment,
            'total'=>$total,
        ]);

        //Save each order item in order_details table
        foreach ($cartItems as  $item) {
            OrderDetail::create([
                'order_id'=>$order->id, 
                'product_name'=>$item->name,
                'quantity'=>$item->quantity,
                'total'=>$item->price * $item->quantity,
            ]);
        }
        
        // Clear the Cart
        \Cart::clear();

        // Send order confirmation email
        Mail::to(auth()->user())->send(new OrderReceived($order));

        return to_route('confirmation');
    }
}
