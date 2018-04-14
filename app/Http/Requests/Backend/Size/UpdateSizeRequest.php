<?php

namespace App\Http\Requests\Backend\Size;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update size');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'     =>  'required|unique:sizes,id,'.$this->type,
            'name'     =>  'required'
        ];
    }
}
