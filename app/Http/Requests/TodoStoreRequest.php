<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TodoStoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // notes
            'txtTodoTitle' => 'required|max:255',
            'txtTodoText' => 'required',
        ];
    }

    /**
     * Custom validation message
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages()
    {
        return [
            // notes
            'txtTodoTitle.required' => 'Todo Title field is required.',
            'txtTodoTitle.max' => 'The Todo Title field may not have more than 255 characters.',
            'txtTodoText.required' => 'Todo Text field is required.',
        ];
    }
}
