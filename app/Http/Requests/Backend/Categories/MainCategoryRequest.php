<?php

namespace App\Http\Requests\Backend\Categories;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Make Rule by checking current mode
        if( request()->routeIs( 'backend_store_main_category' ) ) {

            $nameRule = ['required','unique:main_categories,name'];
            $slugRule = ['unique:main_categories,slug'];

        } elseif( request()->routeIs( 'backend_update_main_category' ) ) {

            $nameRule = ['required','unique:main_categories,name,'.$this->update_id.'id'];
            $slugRule = ['unique:main_categories,slug,'.$this->update_id.'id'];
        }

        return [
            //
            'name' => $nameRule,
            'slug' => $slugRule,
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Main Category Name is required.',
            'name.unique' => 'Main Category Name already in use, please write different name.',
            'slug.unique' => 'Main Category Slug is already in use, please select different.'
        ];
    }
}
