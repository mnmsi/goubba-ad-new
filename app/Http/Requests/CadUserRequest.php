<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadUserRequest extends FormRequest
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
            'business_name'       => 'required|string|max:255',
            'email'               => "required|string|max:255|regex:/(.+)@(.+)\\.(.+)/i||unique:cad_users,email,{$this->id}",
            'website'             => 'required|max:255',
            'phone'               => 'required|max:50',
            'address'             => 'required|max:255',
            'bank_details'        => 'required|max:255',
            'key_contact_name'    => 'required|max:255',
            'key_contact_address' => 'required|max:255',
            'key_contact_phone'   => 'required|max:50',
            // 'role_id' => 'sometimes|nullable|integer|exists:cad_user_role,id',
            'is_approved'         => 'sometimes|required|in:0,1',
            'is_active'           => 'sometimes|required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'business_name' => 'Please enter your brand name.',
        ];
    }
}
