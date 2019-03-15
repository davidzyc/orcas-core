<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateReplyRequest;
use App\Reply;
use App\Todo;

class ReplyController extends Controller
{

    public function create(CreateReplyRequest $request, $todoId){
        $reply = Reply::create($request->all());
        $reply->user()->associate(Auth::user());
        $reply->save();
        $reply->todo()->associate(Todo::find($todoId));
        $reply->save();
        return response()->json($reply, 201);
    }


}
