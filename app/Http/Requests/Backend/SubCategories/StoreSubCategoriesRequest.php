<?php

namespace App\Http\Requests\Backend\SubCategories;

use App\Http\Requests\Request;

/**
 * Class StoreSubCategoriesRequest.
 */
class StoreSubCategoriesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('subcategory-management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'subcategory' => 'required|max:191',
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
            'subcategory.category_id' => 'please select category.',
            'subcategory.required' => 'subcategory name must required',
            'subcategory.max' => 'subcategory may not be greater than 191 characters.',
        ];
    }
}
