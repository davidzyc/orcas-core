<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Team;

class ToggleMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->request);
        $team = Team::find($this->route('team'));
        $member = User::find($this->route('user'));
        // dd($team && $member && $team->user_id == $this->user()->id);
        return $team && $member && $team->user_id == $this->user()->id;
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
