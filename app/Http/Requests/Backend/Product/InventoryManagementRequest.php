<?php

namespace App\Http\Requests\Backend\Product;

use App\Http\Requests\Request;

/**
 * Class ManageRequest.
 */
class InventoryManagementRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('inventory-management');
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
