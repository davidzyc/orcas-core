<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Team;

class GetFileFromTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $team = Team::find($this->route('team'));
        if((!$team) || !$team->members()->find($this->user()->id)){
            return false;
        }
        $file = $team->files()->find($this->route('file'));
        return $file;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
