<?php

namespace App\Http\Requests\auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            try {
                $user = User::where('email', $this->email)->first();
                if($user){
                    if (! auth()->attempt($this->all())) {
                        $validator->errors()->add('password', 'Senha Incorreta!');
                    }
                } else {
                    $validator->errors()->add('email', 'O usuário não existe!');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('server', 'Erro interno no servidor: '. $e->getMessage());
            }
        });
    }
}
