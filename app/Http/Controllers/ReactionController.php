<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function index(){
       $post = ActionLog::select('action_logs.*', 'posts.*')
            ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
            ->paginate(5);

        return view('admin.trend.index',compact('post'));
    }
}
