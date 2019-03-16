<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachFileToReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $reply = $this->user()->replies()->find($this->route('reply'));
        $file = $this->user()->files()->find($this->route('file'));
        return $reply && $file;
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
