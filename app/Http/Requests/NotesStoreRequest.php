<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NotesStoreRequest extends Request
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
            'txtNoteTitle' => 'required|max:255',
            'txtNoteText' => 'required',
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
            'txtNoteTitle.required' => 'Notes Title field is required.',
            'txtNoteTitle.max' => 'The Notes Title field may not have more than 255 characters.',
            'txtNoteText.required' => 'Notes Text field is required.',
        ];
    }
}
