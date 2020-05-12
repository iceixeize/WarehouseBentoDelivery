<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Identity;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'string|email|max:255|unique:users',
                'password' => 'required|string|min:4|confirmed',
                'gender' => ['required', Rule::in(['male', 'female'])],
                'userRolesId' => 'required|exists:user_roles,user_roles_id',
                'idCard' => ['string', 'max:13', 'unique:users,id_card', new Identity],
                'birthday' => 'required|date_format:d-m-Y',
        ];
    }
}
