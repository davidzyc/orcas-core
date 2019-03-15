<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\Todo;
use App\Http\Requests\CheckMemberRequest;
use App\Http\Requests\CreateTodoRequest;

class TodoController extends Controller
{
    public function getTodosFromTeam(CheckMemberRequest $request, $teamId){
        $todos = Team::find($teamId)->todos()->get();
        return response()->json($todos, 200);
    }

    public function init(){
        // dd(Auth::user()->with(['teams', 'todos'])->get());
        $todos = Auth::user()->with(['teams', 'todos'])->get();
        return response()->json($todos, 200);
    }

    public function create(CreateTodoRequest $request, $teamId){
        $todo = Todo::create($request->all());
        $todo->user()->associate(Auth::user());
        $todo->save();
        $todo->team()->associate(Team::find($teamId));
        $todo->save();
        return response()->json($todo, 201);
    }
}
