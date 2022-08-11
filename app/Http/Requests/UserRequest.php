<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();
        switch($method) {
            case 'GET': return [
                'nik' => 'required|string|min:16|max:16',
                'role' => 'required|string'
            ];
            case 'POST':
                return [
                    'name' => 'required|string',
                    'email' => 'required|string|email|unique:users,email',
                    'password' => 'required|string',
                    'nik' => 'required|string|min:16|max:16|unique:users,nik',
                    'role' => 'nullable|string',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|string',
                    'email' => 'required|string|email|unique:users,email,except,id',
                    'password' => 'nullable|string',
                    'nik' => 'required|string|min:16|max:16|unique:users,nik,except,id',
                    'role' => 'nullable|string',
                ];
                break;
            case 'DELETE':
                return [
                    'id' => 'required|integer',
                ];
                break;
            default:
                break;
        }
    }
}
