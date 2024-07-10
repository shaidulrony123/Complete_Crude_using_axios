<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryPage(){
        return view('pages.category');
    }
    public function allCategory(){
        $category= Category::all();
        return response()->json($category);
    }
    public function createCategory(Request $request){
        try{
            $createCategory= Category::create([
                'name' => $request->input('name'),

            ]);
            if($createCategory){
                return response()->json([
                    'success' => true,
                    'message' => 'Customer created successfully',
                ]);

            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Something went wrong',
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage(),
            ]);
        }
    }
    public function deleteCategory(Request $request){
        try{
            $categpry_id= $request->input('id');
            return Category::where('id',$categpry_id)->delete();
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage(),
            ]);
        }

    }
    public function categoryById(Request $request){
        $categpry_id= $request->input('id');
        return Category::where('id',$categpry_id)->first();
    }
    public function updateCategory(Request $request){
        $categpry_id= $request->input('id');
        return Category::where('id',$categpry_id)->update([
            'name' => $request->input('name'),
        ]);
    }





}
