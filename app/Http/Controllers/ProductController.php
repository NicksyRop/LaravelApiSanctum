<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request){

        $request->validate([

            'name' => 'required|max:70',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required|min:10',
        ]);


        Product::create([

            'name' => $request->name,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price


        ]);

        return response()->json(['message' =>'Product Added Successfully'],200);

    }


    public function index(){

        $products = Product::all();

        return response()->json(['products'=> $products],200);
    }

    public function show(Request $request,$id){

    $product = Product::find($id);

    if($product){
        return response()->json(['product',$product],200);

    }else{

        return response()->json(['message','No Product Found'],404);
    }


    }




    public function update(Request $request ,$id){


        $request->validate([

            'name' => 'required|max:70',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'description' => 'required|min:10',
        ]);

        $product = Product::find($id);

        if($product){

            $product->name = $request->name;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->description = $request->description;


            $product->update();

            return response()->json(['message' => 'Product Updated Successfully'],200);

        }else{
            return response()->json(['message' => 'No Product Found'],404);

        }





    }


    public function destroy($id){

        $product = Product::find($id);

        if($product){

            $product->delete();

            return response()->json(['message' => 'Product Deleted'],200);
        }else{

            return response()->json(['message' => 'Product Not Found'],200);
        }


    }
}
