<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel1'=> ['required', 'numeric', 'digits_between:1,5'],
            'tel2' => ['required', 'numeric', 'digits_between:1,5'],
            'tel3' => ['required', 'numeric', 'digits_between:1,5'],
            'address' => ['required'],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();

            if (
                    $errors->has('tel1.required') ||
                    $errors->has('tel2.required') ||
                    $errors->has('tel3.required')
                ) {
                    $errors->add('tel', '電話番号を入力してください');
                    return;
                }

            if (
                $errors->has('tel1.numeric') ||
                $errors->has('tel2.numeric') ||
                $errors->has('tel3.numeric')
            ) {
                $errors->add('tel', '電話番号は半角数字で入力してください');
                return;
            }

            if (
                $errors->has('tel1.digits_between') ||
                $errors->has('tel2.digits_between') ||
                $errors->has('tel3.digits_between')
            ) {
                $errors->add('tel', '電話番号は5桁まで数字で入力してください');
            }
        });
    }
}
