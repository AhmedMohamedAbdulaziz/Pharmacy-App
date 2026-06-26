<?php
namespace App\Modules\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        // Ignore the current record's own name when checking uniqueness
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $this->route('category')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'name.unique'   => 'A category with this name already exists.',
            'name.max'      => 'Category name may not exceed 255 characters.',
        ];
    }
}
