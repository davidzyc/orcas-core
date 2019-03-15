<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Team;
use App\Todo;

class CreateReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        $team = Team::find($this->route('team'));
        $todo = Todo::find($this->route('todo'));
        return $team && $todo && $team->members()->where('user_id', $this->user()->id)->first();
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
