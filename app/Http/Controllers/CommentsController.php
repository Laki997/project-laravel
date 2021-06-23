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
}
        
        // $gallery = Gallery::find($gallery_id);
        // info($gallery);

        // $data = $request->validated();

        

        // $user = auth('api')->user();

        // $user->comments()->create(['gallery_id' => intval($data['gallery_id']), 'body' => $data['body']]);


    //    return Comment::create($data['body'], $user->id,$gallery_id);

        

    //    $gallery = Gallery::find($gallery_id);

    //     $comment = new Comment();

    //     $comment->user_id = $user->id;
    //     $comment->gallery_id = $gallery_id;
    //     $comment->body = $data['body'];

    //     $comment->save();

    //     $comment->user = $user;
    //     $comment->gallery = $gallery;

    //     return $comment->with('user');

