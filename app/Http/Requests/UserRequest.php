<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;

class UserRequest extends APIRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'is_candidate'=> 'boolean',
            'party'=> [Rule::requiredIf(function(){
                return request()->is_candidate == true;
            }),Rule::in(User::validParties())]
        ];
    }

    public function m ()
    {

    }

    public function messages()
    {
        return [
            'party.in' => 'Party must be one of ' . implode(',', User::$parties)
        ];
    }
}
