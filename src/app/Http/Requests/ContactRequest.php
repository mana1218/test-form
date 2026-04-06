<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:8'],
            'last_name' => ['required', 'string', 'max:8'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel1' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'tel2' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'tel3' => ['required', 'regex:/^[0-9]+$/', 'max:5'],
            'address' => ['required'],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120']
        ];
    }

    public function messages()
    {
        return[
            'first_name.required' => '性を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.regex' => '電話番号は半角英数字で入力してください',
            'tel1.max' => '電話番号は5桁まで入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.regex' => '電話番号は半角英数字で入力してください',
            'tel2.max' => '電話番号は5桁まで入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.regex' => '電話番号は半角英数字で入力してください',
            'tel3.max' => '電話番号は5桁まで入力してください',
            'address.required' => '住所を入力してください',
            'content.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->tel1 || !$this->tel2 || !$this->tel3) {
            $validator->errors()->add('tel', '電話番号を入力してください');
            return;
            }

            if (
            !preg_match('/^[0-9]+$/', $this->tel1) ||!preg_match('/^[0-9]+$/', $this->tel2) ||!preg_match('/^[0-9]+$/', $this->tel3)) {
            $validator->errors()->add('tel', '電話番号は半角数字で入力してください');
            return;
            }

            if (
            strlen($this->tel1) > 5 ||strlen($this->tel2) > 5 ||strlen($this->tel3) > 5) {
            $validator->errors()->add('tel', '電話番号は5桁以内で入力してください');
            }
        });
    }
}
