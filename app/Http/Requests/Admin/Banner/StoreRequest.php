<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'middle' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
