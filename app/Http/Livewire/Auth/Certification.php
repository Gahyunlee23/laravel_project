<?php

namespace App\Http\Livewire\Auth;

use App\AlertSms;
use Illuminate\Support\Str;
use Livewire\Component;

class Certification extends Component
{
    public $certification;
    public $cert=false;
    protected $certKey;

    public function mount()
    {
        $this->certification['tel']='';
        $this->certification['certValue']='';
    }
    public function hydrate()
    {
        $this->certKey = session()->get('certKey');
    }

    public function rules(): array
    {
        return [
            'certification.tel' => [
                'required',
                'phone:KR'
                ,'in:' . auth()->user()->tel
            ],
            'certification.certValue' => [
                'required',
                'max:4'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'certification.tel.required' => '인증 연락처 필수 사항입니다.',
            'certification.tel.phone' => '인증 연락처 국가 형식이 잘못되었습니다.',
            'certification.tel.in' => '결제 시 또는 회원가입 시 사용한 연락처를 입력해주세요.',
            'certification.certValue.required'=>'인증번호를 입력해주세요.',
            'certification.certValue.max'=>'인증번호는 4글자 입니다.'
        ];
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function completeCertification()
    {
        $formData = $this->validate($this->rules());
        if($formData['certification']['certValue']!=='' &&
            $formData['certification']['certValue']!==null &&
            $formData['certification']['certValue'] === session()->get('certKey')){
            return redirect()->route('my-page.auth.modify',['type'=>'password']);
        }
        $this->addError('result', '인증에 실패했습니다, 새로고침 또는 재인증 후 시도바랍니다.');
       // ddd($formData, phone($formData['certification']['tel']),$formData['certification']['certValue'],session()->get('certKey'));
//        auth()->user()->password = \Hash::make($formData['modify']['password']);
//        auth()->user()->password_tmp = $formData['modify']['password'];
//        auth()->user()->save();
        //return redirect()->route('/');
    }


    public function telCheck(): void
    {
        $validate = $this->validateOnly('certification.tel');
        $data['mb_tel'] = phone($validate['certification']['tel'], 'KR');

        try {
            $this->certKey = (string)random_int(1000, 9999);
            session(['certKey' => $this->certKey ]);
        } catch (\Exception $e) {
            $this->addError('authTelCheck', '인증번호 전송에 오류가 있습니다 새로고침 후 재시도바랍니다.');
            return;
        }
        $this->resetErrorBag('authTelCheck');

        if (phone($validate['certification']['tel'], 'KR')->getPhoneNumberInstance()->getCountryCode() === 82) {
            $data['subject'] = 'TravelMaker 인증 문자입니다.';
            $data['text'] = '트래블메이커스 호텔에삶 회원 인증을 위해 인증번호 '
                . Str::of($this->certKey)->length() . '자리[' . $this->certKey . ']를 입력해주세요.';
        } elseif (phone($validate['certification']['tel'], 'KR')->getPhoneNumberInstance()->getCountryCode() === 86) {
            /*중국어 작성 필요   조건 제목 : (최대 8자, 중문, 영문만 가능)*/
            $data['subject'] = '你好';
            $data['text'] = 'Yànzhèng mǎ kě gēnggǎi huìyuán mìmǎ. [' . $this->certKey . ']';
        } else { /* 중국 제외 국제 */
            /*영어 작성 필요*/
            $data['subject'] = 'Travelmaker';
            $data['text'] = '트래블메이커스 호텔에삶 회원 인증을 위해 인증번호 '
                . Str::of($this->certKey)->length() . '자리[' . $this->certKey . ']를 입력해주세요.';
        }

        $am = new AlertSms($data);
        $am->sendStart();
        $this->cert=true;
    }

    public function render()
    {
        return view('livewire.auth.certification');
    }

}
