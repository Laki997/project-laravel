<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id){

        $user = User::find($id);

       return Gallery::where('user_id', $user->id)->with('photos')->with('user')->get();
    }
}
