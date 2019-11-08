<?php

namespace App\Http\Requests\Backend\Mailinglist;

use App\Http\Requests\Request;

/**
 * Class UpdateRequest.
 */
class UpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('mailinglists-management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

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

        ];
    }
}
