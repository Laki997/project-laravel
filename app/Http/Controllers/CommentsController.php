<?php

namespace App\Http\Controllers;
use App\Models\Gallery;

use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(CreateCommentRequest $request){

        
        info($request);

        $user = auth('api')->user();

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->gallery_id = $request->input('gallery_id');
        $comment->body = $request->input('body');

        $comment->save();

        return $comment;

        // return Gallery::find($request->input('gallery_id'));
     
    }


    public function index($id){

        return Comment::with('user')->where('gallery_id',$id)->get();
    }
}
        
      