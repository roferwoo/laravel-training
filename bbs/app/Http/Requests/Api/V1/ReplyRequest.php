<?php

namespace App\Http\Requests\Api\V1;



class ReplyRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|min:2',
        ];
    }
}
