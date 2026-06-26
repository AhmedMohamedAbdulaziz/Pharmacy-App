<?php
namespace App\Modules\Medicine\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'numeric', 'min:0'],
            'quantity'    => ['required', 'integer', 'min:0'],
            'expire_date' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Medicine name is required.',
            'price.required'       => 'Price is required.',
            'price.numeric'        => 'Price must be a valid number.',
            'quantity.required'    => 'Quantity is required.',
            'quantity.integer'     => 'Quantity must be a whole number.',
            'expire_date.required' => 'Expiry date is required.',
            'category_id.required' => 'Please select a category.',
            'supplier_id.required' => 'Please select a supplier.',
        ];
    }
}
