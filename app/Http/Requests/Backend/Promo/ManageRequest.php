<?php

namespace App\Http\Requests\Backend\Promo;

use App\Http\Requests\Request;

/**
 * Class ManageRequest.
 */
class ManageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('promos-management');
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
