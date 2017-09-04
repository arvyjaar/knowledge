<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppealsRequest extends FormRequest
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
            'description' => 'required',
            'report' => 'required',
            'appellant' => 'required',
            'date' => 'required|date_format:'.config('app.date_format'),
            'tags.*' => 'exists:tags,id',
            'reason' => 'required',
            'reason.*' => 'exists:reasons,id',
        ];
    }
}
