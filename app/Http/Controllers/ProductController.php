<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function productPage(){
        return view('pages.product');
    }
    public function allProduct(){
        $product= Product::all();
        return response()->json($product);
    }
    // public function createProduct(Request $request){
    //     try{
    //         Log::info($request->file('img')->getClientOriginalName());

    //         if($request->hasFile('img')){
    //          $file = $request->file('img');
    //          $path = $file->store('images', 'public');

    //             $createProduct= Product::create([
    //                 'category_id'=> 2,
    //                 'product_name' => $request->input('product_name'),
    //                 'product_image' => $path,
    //             ]);
    //             Log::info($createProduct);
    //             if($createProduct){
    //                 return response()->json([
    //                     'success' => 200,
    //                     'message' => 'Customer created successfully',
    //                 ]);

    //             }else{
    //                 return response()->json([
    //                     'status' => 'failed',
    //                     'message' => 'Something went wrong',
    //                 ]);
    //             }
    //         }


    //     }catch(Exception $e){
    //         return response()->json([
    //             'status' => 'failed',
    //             'message' => 'Something went wrong'.$e->getMessage(),
    //         ]);
    //     }
    // }

    public function createProduct(Request $request) {
        $img = $request->file('product_image');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$t}-{$file_name}";
        $img_url = "assets/images/product/{$img_name}";
    
        $img->move(public_path('assets/images/product'), $img_name);
        
        return Product::create([
            'product_name' => $request->input('product_name'),
            'category_id' => $request->input('category_id'),
            'product_image' => $img_url,
        ]);
    }
    
    
    // public function deleteProduct(Request $request){
    //     $product_id= $request->input('id');
    //     return Product::where('id',$product_id)->delete();
    // }
    function deleteProduct( Request $request ) {
        $product_id  = $request->input( 'id' );
        $imgUrl   = Product::where( 'id', $product_id )->first();
        $filePath = $imgUrl->product_image;
        File::delete( $filePath );
        return Product::where( 'id', $product_id )
            ->delete();
    }

    public function updateProduct(Request $request) {
        $product_id = $request->input('id');
        $img = $request->file('product_image');
    
        if ($img) {
            // Upload New File
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $img_url = "assets/images/product/{$img_name}";
            $img->move(public_path('assets/images/product'), $img_name);
    
            // Delete Old File
            $filePath = public_path($request->input('file_path'));
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
    
            // Update Product
            $updateResult = Product::where('id', $product_id)->update([
                'product_name' => $request->input('product_name'),
                'product_image' => $img_url,
            ]);
        } else {
            // Update Product without changing image
            $updateResult = Product::where('id', $product_id)->update([
                'product_name' => $request->input('product_name'),
            ]);
        }
    
        return response()->json($updateResult ? 1 : 0);
    }
    
    public function productById(Request $request) {
        $product_id = $request->input('id');
        $product = Product::where('id', $product_id)->first();
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(null, 404);
        }
    }








}
