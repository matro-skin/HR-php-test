<?php

namespace App\Http\Requests;

use App\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'client_email' => [
            	'required',
	            'email'
            ],
	        'partner_id' => [
	        	'required',
		        'exists:partners,id'
	        ],
	        'status' => [
	        	'required',
		        function ($attribute, $value, $fail) {
			        if ( array_search($value, array_keys( Order::statuses() )) === false ) {
				        $fail( __('Неверно указан статус заказа') );
			        }
		        },
	        ],
        ];
    }

    public function messages() {
	    return [
	    	'client_email.required' => __('Не указан email клиента'),
	    	'client_email.email' => __('Укажите валидный email клиента'),
	    	'partner_id.required' => __('Не указан партнер'),
	    	'partner_id.exists' => __('Партнер не найден'),
	    	'status.required' => __('Не указан статус заказа'),
	    ];
    }

}
