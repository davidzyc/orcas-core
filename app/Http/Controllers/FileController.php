<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\GetFileFromTeamRequest;
use App\Http\Requests\GetFileFromTodoRequest;
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\GetMyFileRequest;
use App\Http\Requests\ShareFileWithTeamRequest;
use App\Http\Requests\AttachFileToReplyRequest;
use App\File;
use App\Team;
use App\Reply;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function getMyFiles() {
        // dd('Hello');
        $files = Auth::user()->files()->latest()->get();
        return response()->json($files);
    }

    public function getMySpecificFile(GetMyFileRequest $request, $fileId){
        $file = File::find($fileId);
        return response()->download(storage_path('app/'.$file->file_path), $file->file_name);
    }

    public function getFileFromTeam(GetFileFromTeamRequest $request, $teamId, $fileId){
        $file = File::find($fileId);
        return response()->download(storage_path('app/'.$file->file_path), $file->file_name);
    }

    public function getFileFromTodo(GetFileFromTodoRequest $request, $todoId, $fileId) {
        $file = File::find($fileId);
        return response()->download(storage_path('app/'.$file->file_path), $file->file_name);
    }

    public function toggleFileToReply(AttachFileToReplyRequest $request, $replyId, $fileId){
        $file = File::find($fileId);
        $reply = Reply::find($replyId)->file()->associate($file);
        $reply->save();
        return response()->json(['status' => 1]);
    }

    public function create(UploadFileRequest $request) {
        if($request->file('file')->isValid()){
            try{
                $path = $request->file->store('files');
            } catch (Exception $e) {
                return response()->json(['status' => 0, 'msg' => 'Error.']);
            }
            // dd("")
            $file = new File;
            $file->file_name = $request->file->getClientOriginalName();
            $file->file_ext = $request->file->getClientOriginalExtension();
            $file->file_mime = $request->file->getClientMimeType();
            $file->file_size = $request->file->getClientSize();
            $file->file_path = $path;
            $file->save();
            $file->user()->associate(Auth::user());
            $file->save();
            return response()->json($file);
        }
        return response()->json(['status' => 0, 'msg' => 'Not Valid.']);
    }

    public function toggleShareFileWithTeam(ShareFileWithTeamRequest $request, $teamId, $fileId){
        $team = Team::find($teamId);
        $team->files()->toggle($fileId);
        return response()->json(['status' => 1]);
    }

}
