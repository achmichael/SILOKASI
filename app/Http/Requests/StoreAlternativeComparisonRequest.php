<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlternativeComparisonRequest extends FormRequest
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
            'criteria_id' => 'required|exists:criteria,id',
            'comparisons' => 'required|array|min:1',
            'comparisons.*.alternative_id_1' => 'required|exists:alternatives,id',
            'comparisons.*.alternative_id_2' => 'required|exists:alternatives,id|different:comparisons.*.alternative_id_1',
            'comparisons.*.comparison_value' => 'required|numeric|min:0.111|max:9',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'criteria_id.required' => 'Criteria ID is required',
            'criteria_id.exists' => 'Criteria does not exist',
            'comparisons.*.alternative_id_1.required' => 'First alternative ID is required',
            'comparisons.*.alternative_id_1.exists' => 'First alternative does not exist',
            'comparisons.*.alternative_id_2.required' => 'Second alternative ID is required',
            'comparisons.*.alternative_id_2.exists' => 'Second alternative does not exist',
            'comparisons.*.alternative_id_2.different' => 'Cannot compare an alternative with itself',
            'comparisons.*.comparison_value.required' => 'Comparison value is required',
            'comparisons.*.comparison_value.min' => 'Comparison value must be at least 1/9 (0.111)',
            'comparisons.*.comparison_value.max' => 'Comparison value must not exceed 9',
        ];
    }
}
