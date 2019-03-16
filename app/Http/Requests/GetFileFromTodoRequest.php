<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetFileFromTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $todo = $this->user()->todos()->find($this->route('todo'));
        $file = $todo->replies()->where('file_id', $this->route('file'))->first();
        return $todo && $file;
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
