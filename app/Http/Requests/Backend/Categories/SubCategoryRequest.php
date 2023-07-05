<?php

namespace App\Http\Requests\Backend\Categories;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
        if( request()->routeIs( 'backend_store_sub_category' ) ) {

            $nameRule = ['required','unique:sub_categories,name'];
            $slugRule = ['unique:sub_categories,slug'];

        } elseif( request()->routeIs( 'backend_update_sub_category' ) ) {

            $nameRule = ['required','unique:sub_categories,name,'.$this->update_id.'id'];
            $slugRule = ['unique:sub_categories,slug,'.$this->update_id.'id'];
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
            'name.required' => 'Sub Category Name is required.',
            'name.unique' => 'Sub Category Name already in use, please write different name.',
            'slug.unique' => 'Sub Category Slug is already in use, please select different.'
        ];
    }
}
