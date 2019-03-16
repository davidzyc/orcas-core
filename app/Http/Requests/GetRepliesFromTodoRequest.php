<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetRepliesFromTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $todo = $this->user()->todos()->find($this->route('todo'));
        return $todo;
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
