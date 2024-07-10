<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function productPage(){
        return view('pages.product');
    }
    public function allProduct(){
        $product= Product::all();
        return response()->json($product);
    }
    public function createProduct(Request $request){
        try{
            Log::info($request->file('img')->getClientOriginalName());

            if($request->hasFile('img')){
            //  $imgName =$request->file('img')->getClientOriginalName();
             $file = $request->file('img');
             $path = $file->store('images', 'public');
            // $path = $file->store('public/images');

                $createProduct= Product::create([
                    'category_id'=> 2,
                    'product_name' => $request->input('product_name'),
                    'product_image' => $path,
                ]);
                Log::info($createProduct);
                if($createProduct){
                    return response()->json([
                        'success' => 200,
                        'message' => 'Customer created successfully',
                    ]);

                }else{
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Something went wrong',
                    ]);
                }
            }


        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage(),
            ]);
        }
    }
    public function deleteProduct(Request $request){
        $product_id= $request->input('id');
        return Product::where('id',$product_id)->delete();
    }
    public function productById(Request $request){
        $product_id= $request->input('id');
        return Product::where('id',$product_id)->first();
    }
}
