<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use App\Http\Requests\ToggleMemberRequest;
use App\Http\Requests\CheckMemberRequest;
use App\Team;

class TeamController extends Controller
{
    public function index()
    {
        //
        $team = Team::latest()->get();
        return response()->json($team);
    }

    public function store(TeamRequest $request)
    {
        //
        // dd('Hello');
        $team = Team::create($request->all());
        $team->owner()->associate(Auth::user());
        $team->save();
        return response()->json($team);
    }

    public function show($id)
    {
        //
        $team = Team::findOrFail($id);
        return response()->json($team);
    }

    public function update(TeamRequest $request, $id)
    {
        //
        $team = Team::findOrFail($id);
        $team->update($request->all());
        return response()->json($team);
    }

    public function destroy($id)
    {
        //
        Team::destroy($id);
        return response()->json(null);
    }

    public function getMyTeams(){
        $teams = Auth::user()->teams()->get();
        return response()->json($teams);
    }

    public function toggleMember(ToggleMemberRequest $request, $teamId, $userId){
        $team = Team::find($teamId);
        $team->members()->toggle($userId);
        return response()->json(['status' => 1]);
    }

    public function getMembers(CheckMemberRequest $request, $teamId){
        $members = Team::find($teamId)->members()->get();
        return response()->json($members);
    }

}
