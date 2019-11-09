<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddress extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:255'],
            'user_id' => ['required'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['nullable'],
            'street' => ['nullable', 'min:2', 'max:255'],
            'house' => ['nullable', 'max:12'],
            'information' => ['nullable', 'min:2', 'max:500']
        ];
    }
}
