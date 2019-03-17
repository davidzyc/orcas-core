<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\Todo;
use App\Http\Requests\CheckMemberRequest;
use App\Http\Requests\CheckOwnerRequest;
use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\EditTodoRequest;

class TodoController extends Controller
{

    public function getTodosFromTeam(CheckMemberRequest $request, $teamId){
        $todos = Team::find($teamId)->todos()->get();
        return response()->json($todos);
    }

    public function getRepliesFromTodo(CheckOwnerRequest $request, $teamId, $todoId){
        $replies = Todo::find($todoId)->replies()->get();
        return response()->json($replies, 200);
    }

    public function init(){
        // dd(Auth::user()->with(['teams', 'todos'])->get());
        $todos = Auth::user()->teams()->with(['todos'])->get();
        return response()->json($todos);
    }

    public function create(CreateTodoRequest $request, $teamId){
        $todo = Todo::create($request->all());
        $todo->user()->associate(Auth::user());
        $todo->save();
        $todo->team()->associate(Team::find($teamId));
        $todo->save();
        return response()->json($todo);
    }

    public function editTodo(EditTodoRequest $request,$teamId){
        // dd($teamId);
        $todo = Todo::findOrFail($request->id);
        $todo->update($request->all());
        return response()->json($todo);
    }

}
