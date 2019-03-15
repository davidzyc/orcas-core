<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Team;

class CheckMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $team = Team::find($this->route('team'));
        return $team->members()->where('user_id', $this->user()->id)->first();
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
