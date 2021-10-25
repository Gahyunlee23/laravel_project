<?php

namespace App\Http\Livewire\Auth;

use App\AlertSms;
use App\CertifiedKey;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class FindPassword extends Component
{
    use AuthenticatesUsers;
    public $findPasswordPage = 'name-tel-find';

    public $find;
    public $authRandomKey;
    public $authTel;

    public $certified;
    public $certified_process;
    public $certified_key_completed;

    public function mount(): void
    {
        $this->find['password']['name'] = '';
        $this->find['password']['email'] = '';
        $this->find['password']['tel'] = '';
        $this->find['password']['authentication_number'] = '';
    }

    public function rules(): array
    {
        if ($this->findPasswordPage === 'name-tel-find') {
            return [
                'find.password.name' => ['required'],
                'find.password.tel' => ['required', 'phone:KR','exists:App\User,tel'],
                'find.password.authentication_number' => ['required'],
            ];
        }

        if($this->findPasswordPage === 'email-tel-find') {
            return [
                'find.password.email' => ['required','email'],
                'find.password.tel' => ['required', 'phone:KR','exists:App\User,tel'],
                'find.password.authentication_number' => ['required'],
            ];
        }
    }

    public function messages(): array
    {
        return [
            'find.password.name.required' => '필수 사항입니다.',
            'find.password.email.required' => '필수 사항입니다.',
            'find.password.email.email' => '이메일 유형이 아닙니다.',
            'find.password.tel.required' => '필수 사항입니다.',
            'find.password.tel.phone' => '전화번호 유형이 아닙니다.',
            'find.password.tel.exists' => '등록되지 않은 전화번호입니다.',
            'find.password.authentication_number.required' => '전화번호 인증을 진행해주세요.',
//            'register.authentication_number.in' => '인증번호를 확인해주세요.',
        ];
    }
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.auth.find-password');
    }

    public function findPasswordSubmit()
    {
        $formData = $this->validate($this->rules());
        if($this->authTel !== $formData['find']['password']['tel']){
            session()->flash('message', '인증 진행중 전화번호가 변경되었습니다.');
            return false;
        }
        if($this->authRandomKey !== $formData['find']['password']['authentication_number']){
            session()->flash('message', '인증이 실패했습니다.');
            return false;
        }
        $user = null;
        if($this->findPasswordPage === 'name-tel-find'){
            $user = User::whereNotNull('tel')->where('tel','=',$formData['find']['password']['tel'])
                ->whereNotNull('name')->where('name', '=', $formData['find']['password']['name'])
                ->first();
        }
        if($this->findPasswordPage === 'email-tel-find'){
            $user = User::whereNotNull('tel')->where('tel','=',$formData['find']['password']['tel'])
                ->whereNotNull('email')->where('email', '=', $formData['find']['password']['email'])
                ->first();
        }

        if($user === null){
            session()->flash('message', '일치하는 회원 정보가 없습니다.');
            return false;
        }

        $this->guard()->login($user, false);
        return redirect()->route('my-page.auth.modify',['type'=>'password']);
    }

    public function AuthRandomKeyChecked(): void
    {
        if($this->find['password']['tel']!=='' && $this->find['password']['tel'] !== null){
            $certified = CertifiedKey::wherePurpose('회원 비밀번호 변경 전 인증')->whereTarget($this->find['password']['tel'])->latest()->first();
            if($certified){
                if($certified->key === $this->find['password']['authentication_number']){
                    $this->certified_key_completed = true;
                }else{
                    $this->certified_key_completed = false;
                }
            }
        }
    }
    public function telCheck(): void
    {
        $validate = $this->validateOnly('find.password.tel');
        $data['mb_tel'] = phone($validate['find']['password']['tel'], 'KR');
        $this->authTel=phone($validate['find']['password']['tel'], 'KR')->getRawNumber();
        try {
            $this->authRandomKey = (string)random_int(1000, 9999);
        } catch (\Exception $e) {
            session()->flash('message', '하루 20번 초과 인증 불가능합니다, 내일 다시 시도해주세요.');
            return;
        }

        if (phone($validate['find']['password']['tel'], 'KR')->getPhoneNumberInstance()->getCountryCode() === 82) {
            $data['subject'] = 'TravelMaker 인증 문자입니다.';
            $data['text'] = '트래블메이커스 호텔에삶 회원 비밀번호 변경을 위해 인증번호 '
                . Str::of($this->authRandomKey)->length() . '자리[' . $this->authRandomKey . ']를 입력해주세요.';
        } elseif (phone($validate['find']['password']['tel'], 'KR')->getPhoneNumberInstance()->getCountryCode() === 86) {
            /*중국어 작성 필요   조건 제목 : (최대 8자, 중문, 영문만 가능)*/
            $data['subject'] = '你好';
            $data['text'] = 'Yànzhèng mǎ kě gēnggǎi huìyuán mìmǎ. [' . $this->authRandomKey . ']';
        } else { /* 중국 제외 국제 */
            /*영어 작성 필요*/
            $data['subject'] = 'Travelmaker';
            $data['text'] = '트래블메이커스 호텔에삶 회원가입을 위해 인증번호 ' . Str::of($this->authRandomKey)->length() . '자리[' . $this->authRandomKey . ']를 입력해주세요.';
        }
        $am = new AlertSms($data);
        $am->sendStart();

        CertifiedKey::wherePurpose('회원 비밀번호 변경 전 인증')
            ->whereType('tel')->whereTarget($this->find['password']['tel'])->delete();

        $this->certified = CertifiedKey::create([
            'key'=> $this->authRandomKey,
            'purpose'=> '회원 비밀번호 변경 전 인증',
            'type'=> 'tel',
            'target'=>$this->find['password']['tel'],
            'send_dt'=>now(),
        ]);
        $this->certified_process=true;
        $this->updatedCertifiedKey();
    }
}
