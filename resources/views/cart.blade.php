@extends('layouts.main')
@section('title' , 'Manful - Cart')
@section('content')
@if (Cart::isEmpty())
<section class="h-full flex flex-col items-center space-y-5">
    <div class="h-32 w-32 rounded-full mt-5">
        <img src="https://img.icons8.com/office/344/shopping-cart.png" alt="" class="h-full w-full object-cover">
    </div>
    <h4 class="text-5xl">Cart is Empty</h4>
    <p>Browse for the best deals and offers</p>
    <a href="{{route('shop')}}" class="px-10 py-2 bg-yellow-900 text-white">Start Shopping</a>
</section>
@else
    
<section class="flex flex-col lg:flex-row justify-between h-fit mb-14">
 <div>
 <h2 class="ml-6 my-4 text-5xl">My Cart</h2>
 <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
      @if(session('success'))
      <p class="bg-green-400 text-white font-bold p-2 mx-4 w-1/2 mb-3 rounded-lg">{{session('success')}}</p>
      @endif
     </div>
<table class="md:w-[800px] h-20 mx-4 border-separate border-spacing-4 border border-slate-500">
 <thead class=" text-justify md:text-xl">
  <tr>
   <th>Product</th>
   <th>Quantity</th>
   <th>Total</th>
   <th>
    <form action="{{route('cart.clear')}}" method="POST" onsubmit="return confirm('Clear everything in cart?')">
        @csrf
        <button type="submit"><i class="text-xl text-red-600 fa-solid fa-trash"></i></button>
    </form>
    </th>
  </tr>
 </thead>
 <tbody>
  @foreach($cartItems as $item)
  <tr>
   <td class="flex">
    <div class="ml-2 h-24 w-24 md:h-28 md:w-28 bg-black">
     <img src="{{Storage::url($item->attributes->image)}}" alt="" class="h-full w-full object-cover">
    </div>
    <div class="pl-5 pt-3 space-y-2">
     <p class="text-sm md:text-xl">{{$item->name}}</p>
     <p class="font-semibold">{{$item->price}}KES</p>
    </div>
   </td>
   <td>
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="number" min="1" max="40" name="quantity" id="" class="w-16 text-xl block" value="{{$item->quantity}}">
        <button type="submit" class="text-sm text-blue-600 ">Change</button>
    </form>
   </td>
   <td class="font-semibold">{{$item->price * $item->quantity}}KES</td>
   <td>
    <form action="{{route('cart.remove')}}" method="POST"  onsubmit="return confirm('Remove cart item?')">
     @csrf
     <input type="hidden" value="{{ $item->id }}" name="id">
     <button type="submit" class="text-red-400"><i class="text-lg fa-solid fa-trash"></i></button>
    </form>
   </td>
  </tr>
  @endforeach
 </tbody>
</table>
</div>
<div class="w-96 h-[250px] bg-gray-100 mr-10 mt-8 ml-6 pl-4 pt-5 space-y-5">
<h3 class="text-2xl">Cart Total</h3>
<div class="flex justify-between">
    <p>Subtotal</p>
    <p class="mr-3">{{Cart::getSubTotal()}}KES</p>
</div>
<div class="flex justify-between">
    <p>Total</p>
    <p class="mr-3">{{Cart::getTotal()}}KES</p>
</div>
<div class="flex justify-between">
        <a href="{{route('checkout')}}" class="py-1 w-48 h-8 bg-black text-white text-center">Proceed To Checkout</a>
        <a href="{{route('shop')}}" class="py-1 mr-2 w-40 h-8 border border-black text-center">Continue Shopping</a>
</div>
</div>
</section>
@endif
@endsection