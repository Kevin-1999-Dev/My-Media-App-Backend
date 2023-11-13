<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::get();
        return view('admin.category.index',compact('category'));
    }
    public function store(Request $request){

        $this->validationCheck($request);
        $data = $this->getData($request);
        Category::create($data);
        return back();
    }
    public function searchCategory(Request $request){
       $category = Category::where('title','LIKE','%'.$request->searchKey.'%')->get();
       return view('admin.category.index',compact('category'));
    }
    public function destroy($id){
        Category::where('category_id', $id)->delete();
        return redirect()->route('admin#category');
    }
    public function editPage($id){
       $data = Category::where('category_id', $id)->first();
        $category = Category::get();
        return view('admin.category.edit', compact('data','category'));
    }
    public function edit(Request $request,$id){
        $this->validationCheck($request);
        $data = $this->getData($request);
        Category::where('category_id', $id)->update($data);
        return back();
    }
    private function validationCheck($request){
        return Validator::make($request->all(),[
            'categoryTitle' => ['required'],
            'categoryDescription' => ['required']
        ])->validate();
    }
    private function getData($request){
        return [
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription,
        ];
    }
}
