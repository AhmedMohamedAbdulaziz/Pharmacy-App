<?php
namespace App\Modules\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyMedicineRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'medicine_id' => ['required', 'exists:medicines,id'],
            'quantity'    => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'medicine_id.required' => 'Please select a medicine.',
            'medicine_id.exists'   => 'The selected medicine does not exist.',
            'quantity.required'    => 'Quantity is required.',
            'quantity.min'         => 'Quantity must be at least 1.',
        ];
    }
}
