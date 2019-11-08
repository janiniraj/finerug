<?php

namespace App\Http\Requests\Backend\Email;

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
        return access()->hasPermission('emails-management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|max:191',
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
            'subject.required' => 'Subject must required',
            'subject.max' => ' Subject may not be greater than 191 characters.',
            'content.required' => 'Content must required'
        ];
    }
}
