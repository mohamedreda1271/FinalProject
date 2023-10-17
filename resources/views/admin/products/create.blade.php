<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="my-2 text-blue-600">
            <a href="{{route('admin.products.index')}}">
            <i class="fa-solid fa-arrow-left-long"></i> <span class="pl-2 text-lg font-bold">Home</span>
            </a>
        </div>
<form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
 @csrf
 <div class="mb-6">
  <label for="name" class="block mb-2 text-lg text-gray-600 font-bold">Product Name</label>
  <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-black focus:border focus:border-black  block w-1/2 p-2.5" name="name">
 </div>
 
 <div class="mb-6">
  <label for="description" class="block mb-2 text-lg text-gray-600 font-bold">Description</label>
  <textarea name="description" id="" cols="30" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-gray-400  focus:border-gray-400  block w-1/2"></textarea>
 </div>


 <label class="block mb-2 text-lg  text-gray-600 font-bold" for="image">Upload image</label>
 <input class="block w-1/2 p-2 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer" type="file" name="image">

 <div class="mb-6">
 <label for="price" class="block mb-2 text-lg text-gray-600 font-bold">Price</label>
 <input type="number" name="price" min="0" max="10000" class="block w-1/2 p-2 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-400  focus:border-gray-400 ">
</div>
<div class="mb-6">
 <label for="category" class="block mb-2 text-lg text-gray-600 font-bold">Category</label>
 <select class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-gray-400  focus:border-gray-400 w-1/2 form-multiselect" name="category_id" >
  <option selected disabled>Select Category</option>
  @foreach($categories as $category)
  <option value="{{$category->id}}">{{$category->name}}</option>
  {{-- <input type="hidden" name="category_id" value="{{$category->id}}"> --}}
  @endforeach
 </select>
</div>
 <button type="submit" class="my-8 w-44 h-10 bg-emerald-400 hover:bg-emerald-500 rounded-md text-lg text-white">Create Product</button>
</form>

        </div>
    </div>
</x-admin-layout>



