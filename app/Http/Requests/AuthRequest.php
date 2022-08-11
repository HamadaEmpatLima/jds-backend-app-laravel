<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            case 'POST':
                return [
                    'email' => 'nullable|string|email',
                    'nik' => 'required|string|min:16|max:16',
                    'password' => 'required|string',
                    'remember_me' => 'nullable|boolean'
                ];
                break;
        }
    }
}
