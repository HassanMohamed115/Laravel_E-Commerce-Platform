<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
class ProductsController extends Controller
{

    public function index(){
        $products = Product::all();
        if($products){
            return response()->json([
                'status' => 200,
                'products' => $products
            ]);
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'slug' => 'required|max:191',
            'name' => 'required|max:191',
            'meta_title' => 'required|max:191',
            //'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'product_errors' => $validator->messages()
            ]);

        }else{

        $product = new Product;
        $product->category_id = (int)($request->input('category_id'));
        $product->meta_title = $request->input('meta_title');
        $product->meta_keyword = $request->input('meta_keyword');
        $product->meta_description = $request->input('meta_description');
        $product->slug = $request->input('slug');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->selling_price = $request->input('selling_price');
        $product->original_price = $request->input('original_price');
        $product->quantity = $request->input('quantity');
        $product->brand = $request->input('brand');
        $product->status = $request->input('status') == true ? '1' : '0';
        $product->featured = $request->input('featured') == true ? '1' : '0';
        $product->popular = $request->input('popular') == true ? '1' : '0';

        if($request->hasFile('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/product/',$filename);
            $product->image = 'uploads/product/'.$filename;

        }

        $product->save();

        return response()->json([
            'status' => 200,
            'message' => 'Product Added successfully'
        ]);

    }



}

public function edit($id){
    $product = Product::find($id);
    if($product){
        return response()->json([
            'status' => 200,
            'product' => $product
        ]);
    }else{
        return response()->json([
            'status' => 400,
            'message' => "Invalid Product Id"
        ]);
    }
}


public function update(Request $request,$id){

    $validator = Validator::make($request->all(),[
        'slug' => 'required|max:191',
        'name' => 'required|max:191',
        'meta_title' => 'required|max:191',
        //'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if($validator->fails()){
        return response()->json([
            'status' => 422,
            'product_errors' => $validator->messages()
        ]);

    }else{

    $product = Product::find($id);
    if($product){
    $product->category_id = (int)($request->input('category_id'));
    $product->meta_title = $request->input('meta_title');
    $product->meta_keyword = $request->input('meta_keyword');
    $product->meta_description = $request->input('meta_description');
    $product->slug = $request->input('slug');
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->selling_price = $request->input('selling_price');
    $product->original_price = $request->input('original_price');
    $product->quantity = $request->input('quantity');
    $product->brand = $request->input('brand');
    $product->status = $request->input('status');
    $product->featured = $request->input('featured');
    $product->popular = $request->input('popular');

    if($request->hasFile('image')){
        $path = $product->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('uploads/product/',$filename);
        $product->image = 'uploads/product/'.$filename;

    }

        $product->update();

        return response()->json([
            'status' => 200,
            'message' => 'Product Updated successfully'
        ]);
    }else{
        return response()->json([
            'status' => 404,
            'message' => 'Product Not Found'
        ]);
}

}



}



public function add(Request $request){

    if($request->hasFile('image')){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('uploads/product/',$filename);

        return response()->json([
            'status' => 200,
            'message' => 'Product Added successfully'
        ]);

    }else{
        return response()->json([
            'status' => 400,
            'message' => 'No File'
        ]);
    }
}

}