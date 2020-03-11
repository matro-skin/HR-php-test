<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        	'price' => [
        		'required',
		        'integer',
		        'min:1',
	        ],
        ];
    }

    public function messages() {
	    return [
	    	'price.required' => __('Укажите стоимость'),
	    	'price.integer' => __('Укажите целое число'),
	    	'price.min' => __('Укажите значение больше 1'),
	    ];
    }

}
