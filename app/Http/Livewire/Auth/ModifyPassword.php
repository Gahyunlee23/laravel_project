<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class ModifyPassword extends Component
{
    public $modify;

    public $buttonTextSize = 'text-base';

    public function mount()
    {
        // auto-complete 방지
        $this->modify['password']='';
        $this->modify['name'] = auth()->user()->name;
    }

    public function nameModify() {
        $rule = null;
        $rule['modify.name'] = ['required', 'between:1,20'];
        $message['modify.name.required'] = '이름 필수 사항입니다.';


        $this->validate($rule, $message);
        auth()->user()->name = $this->modify['name'];
        auth()->user()->save();
        return redirect()->route('my-page.edit');
    }

    public function rules(): array
    {
        return [
            'modify.password' => [
                'required', 'between:6,20','confirmed'
                ,'not_in:' . auth()->user()->password_tmp
                ,'not_in:' . auth()->user()->tel
            ],
            'modify.name' => [
                'required', 'between: 1, 20'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'modify.password.required' => '비밀번호 필수 사항입니다.',
            'modify.password.between' => '비밀번호는 (:min~:max)자 입력해야됩니다.',
            'modify.password.confirmed' => '재입력과 일치하지 않습니다.',
            'modify.password.not_in' => '연락처, 이전 비밀번호와 다르게 변경해주세요.',
            'modify.name.required' => '이름은 필수 입력 사항입니다'
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.auth.modify-password');
    }

    public function passwordModify()
    {
        $rule = null;
        $rule['modify.password'] = [
                'required', 'between:6,20','confirmed'
                ,'not_in:' . auth()->user()->password_tmp
                ,'not_in:' . auth()->user()->tel
        ];

        $message['modify.password.messages'] = [
                'modify.password.required' => '비밀번호 필수 사항입니다.',
                'modify.password.between' => '비밀번호는 (:min~:max)자 입력해야됩니다.',
                'modify.password.confirmed' => '재입력과 일치하지 않습니다.',
                'modify.password.not_in' => '연락처, 이전 비밀번호와 다르게 변경해주세요.',
        ];

        $formData = $this->validate($rule, $message);
        auth()->user()->password = \Hash::make($formData['modify']['password']);
        auth()->user()->password_tmp = $formData['modify']['password'];
        auth()->user()->save();
        return redirect()->route('/');
    }
}
