<?php

namespace App\Http\Requests\Backend\Categories;

use App\Http\Requests\Request;

/**
 * Class StoreCategoriesRequest.
 */
class StoreCategoriesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasPermission('category-management');;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required|max:191',
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
            'category.required' => 'category name must required',
            'category.max' => ' category may not be greater than 191 characters.',
        ];
    }
}
