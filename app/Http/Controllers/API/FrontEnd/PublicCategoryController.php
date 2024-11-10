<?php

namespace App\Http\Controllers\API\FrontEnd;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicCategoryController extends Controller
{
    public function category(){
        $categories = Category::where('status','0')->get();
        if($categories){
            return response()->json([
                'status' => 200,
                'categories' => $categories
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No categories Found'
            ]);
        }
    }
}
