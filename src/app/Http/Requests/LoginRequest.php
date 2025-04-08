<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
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
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください。',
        ];
    }

    public function authenticate()
    {
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => ['ログイン情報が正しく設定されていません。']
            ]);
        }
    }
}
