<?php

namespace Softce\Hotline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotlineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_category' => 'required|array|min:1',
            //'product_war' => 'required',
            //'product_qty' => 'required'
        ];
    }

    public function messages(){
        return [
            'required' => 'Поле обязательно к заполнению',
            'array' => 'Поле должно быть массивом',
            'min' => 'Должно быть выбрано минимум :min зачение'
        ];
    }
}
