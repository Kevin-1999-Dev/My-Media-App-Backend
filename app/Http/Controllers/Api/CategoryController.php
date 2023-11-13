<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show(){
       $category = Category::get();
        return response()->json([
            'category' => $category
        ]);
    }
    public function search(Request $request){
       $result = Post::where('category_id', 'LIKE', '%' . $request->key . '%')->get();
        return response()->json([
            'post' => $result
        ]);
    }
}
