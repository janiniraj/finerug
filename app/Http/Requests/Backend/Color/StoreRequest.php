<?php

namespace App\Http\Requests\Backend\Color;

use App\Http\Requests\Request;

/**
 * Class StoreRequest.
 */
class StoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('color-management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'name must required',
            'name.max' => ' name may not be greater than 191 characters.',
        ];
    }
}
