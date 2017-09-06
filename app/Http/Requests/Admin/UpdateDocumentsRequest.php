<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentsRequest extends FormRequest
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
            
            'nr' => 'required',
            'title' => 'required',
            'signed' => 'required|date_format:'.config('app.date_format'),
            'valid_from' => 'required|date_format:'.config('app.date_format'),
            'valid_till' => 'nullable|date_format:'.config('app.date_format'),
            'category_id' => 'required',
            'organisation_id' => 'required',
        ];
    }
}
