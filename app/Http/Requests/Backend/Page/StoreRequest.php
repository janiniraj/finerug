<?php

namespace App\Http\Requests\Backend\Page;

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
        return access()->hasPermission('page-management');
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
            'slug' => 'required|max:191',
            'content' => 'required',
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
            'slug.required' => 'slug must required',
            'slug.max' => ' slug may not be greater than 191 characters.',
            'content.required' => 'content must required',
        ];
    }
}
