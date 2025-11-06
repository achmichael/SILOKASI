<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCriteriaComparisonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'comparisons' => 'required|array|min:1',
            'comparisons.*.criteria_id_1' => 'required|exists:criteria,id',
            'comparisons.*.criteria_id_2' => 'required|exists:criteria,id|different:comparisons.*.criteria_id_1',
            'comparisons.*.comparison_value' => 'required|numeric|min:0.111|max:9',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'comparisons.*.criteria_id_1.required' => 'First criteria ID is required',
            'comparisons.*.criteria_id_1.exists' => 'First criteria does not exist',
            'comparisons.*.criteria_id_2.required' => 'Second criteria ID is required',
            'comparisons.*.criteria_id_2.exists' => 'Second criteria does not exist',
            'comparisons.*.criteria_id_2.different' => 'Cannot compare a criteria with itself',
            'comparisons.*.comparison_value.required' => 'Comparison value is required',
            'comparisons.*.comparison_value.min' => 'Comparison value must be at least 1/9 (0.111)',
            'comparisons.*.comparison_value.max' => 'Comparison value must not exceed 9',
        ];
    }
}
