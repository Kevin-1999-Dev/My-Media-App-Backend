<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function index(){
        $posts = Post::get();
       $category = Category::get();
        return view('admin.post.index',compact('category','posts'));
    }
    public function store(Request $request){
        $this->validationCheck($request);
        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            $file->move(public_path() . '/postImage' , $fileName);
            $data = $this->getPostData($request, $fileName);
        }else{
            $data = $this->getPostData($request, NULL);
        }
        Post::create($data);
        return back();
    }
    public function destroy($id){
       $post = Post::where('post_id', $id)->first();
        if (File::exists(public_path() . '/postImage/'.$post->image)){
            File::delete(public_path() . '/postImage/'. $post->image);
        }
        Post::where('post_id', $id)->delete();
        return redirect()->route('admin#post');

    }
    public function editPage($id){
        $posts = Post::get();
        $category = Category::get();
       $postDetail = Post::where('post_id', $id)->first();
        return view('admin.post.edit',compact('postDetail','category','posts'));
    }
    public function edit(Request $request,$id){
        $this->validationCheck($request);
        $data = $this->updatePostData($request);
        $post = Post::where('post_id', $id)->first();
        if(isset($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            if (File::exists(public_path() . '/postImage/'.$post->image)){
                File::delete(public_path() . '/postImage/'. $post->image);
                $file->move(public_path() . '/postImage' , $fileName);
                $data['image'] = $fileName;
            }
        }
        Post::where('post_id', $id)->update($data);
        return back();
    }
    private function validationCheck($request){
        return Validator::make($request->all(),[
            'postTitle' => ['required'],
            'postDescription' => ['required'],
            'postCategory' => ['required'],
        ])->validate();
    }
    private function updatePostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
        ];
    }
    private function getPostData($request,$fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'image' => $fileName,
        ];
    }

}
