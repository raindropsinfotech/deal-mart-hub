<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if( request()->routeIs('backend_store_user') ) {
            $returns = [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6'],
                'cpassword' => ['required_with:password', 'same:password', 'min:6'],
                // 'profile_img' => 'required|mimes:jpg,jpeg,png,webp|max:1000000'
                'role' => ['required']
            ];
        } elseif ( request()->routeIs('backend_update_user_account') ) {
            $returns = [
                'name' => ['required','max:255'],
                'email' => ['required', 'email', 'unique:users,email,'.$this->update_id.'id'],
                'role' => ['required']
            ];
        } elseif ( request()->routeIs('backend_update_user_security') ) {
            $returns = [
                'password' => ['nullable','same:cpassword','min:6'],
                'cpassword' => ['nullable', 'required_with:password', 'same:password', 'min:6'],
            ];
        } elseif ( request()->routeIs('backend_update_user_billings_plans') ) {
            $page = 'billings-palns';
        } elseif ( request()->routeIs('backend_update_user_preferences') ) {
            $returns = [
                'birthday' => ['required', 'date_format:Y-m-d'],
                'age_group' => ['required'],
                'gender_identity' => ['required'],
            ];
        }

        return $returns;
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
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter valid email.',
            'email.unique' => 'Enterd email is already in use please try with another email.',
            'password.required' => 'Please enter password.',
            'role.required' => 'Please select role.',
            'birthday.required' => 'Please enter birthdate.',
            'birthday.date_format' => 'Please enter birthdate in d-m-Y formate.',
            'age_group.required' => 'Please select age group.',
            'gender_identity.required' => 'Please select gender.',
        ];
    }
}
