<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(10);
        return view('product', compact('products'));
    }
    public function store(Request $request)
    {
        $this->authorize('manage products');
        $request->validate(
            [
                'name'=>'required',
                'sku'=>'required|unique:products',
                'price'=>'required',
            ],
            [
                'name.required'=>'Name is Required',
                'sku.required'=>'SKU is Required',
                'sku.unique'=>'SKU Already Exists',
                'price.required'=>'Price is Required',
            ]
        );
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->category_id = 1;
        $product->save();
        
        return response()->json([
            'status'=>'success',
        ]);
    }
    public function update(Request $request)
    {
        $this->authorize('manage products');
        $request->validate(
            [
                'up_name'=>'required',
                'up_sku'=>'required|unique:products,name,'.$request->up_id,
                'up_price'=>'required',
            ],
            [
                'up_name.required'=>'Name is Required',
                'up_sku.required'=>'SKU is Required',
                'up_sku.unique'=>'SKU Already Exists',
                'up_price.required'=>'Price is Required',
            ]
        );
        $product = Product::where('id',$request->up_id)->first();
        $product->name = $request->up_name;
        $product->sku = $request->up_sku;
        $product->price = $request->up_price;
        $product->category_id = 2;
        $product->update();
        
        return response()->json([
            'status'=>'success',
        ]);
    }
    public function destroy(Request $request)
    {
        $this->authorize('manage products');
        Product::find($request->product_id)->delete();
      
        return response()->json([
            'status'=>'success'
        ]);
    }
    public function pagination(Request $request)
    {
        $products = Product::latest()->paginate(10);
        return view('pagination_products', compact('products'))->render();
    }
    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%'.$request->search_string.'%')
        ->orWhere('sku', 'like', '%'.$request->search_string.'%')
        ->orWhere('price', 'like', '%'.$request->search_string.'%')
        ->orderBy('id', 'DESC')
        ->paginate(5);
        if($products->count() >= 1){
            return view('pagination_products', compact('products'))->render();
        }else{
            return response()->json(['status'=>'nothing_found']);
        }
    }
}
