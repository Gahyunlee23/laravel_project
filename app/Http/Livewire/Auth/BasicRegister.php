<?php

namespace App\Http\Livewire\Auth;

use App\AlertSms;
use App\CertifiedKey;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class BasicRegister extends Component
{
    use AuthenticatesUsers;

    public $register;
    public $authTel;
    public $authRandomKey;

    public $check_all;
    public $check_1;
    public $check_2;
    public $check_3;

    public function mount()
    {
        $this->register['email'] = '';
        $this->register['name'] = '';
        $this->register['tel'] = '';
        $this->register['password'] = '';
        $this->register['authentication_number'] = '';
    }

    public function rules(): array
    {
        return [
            'register.email' => ['required','email','unique:users,email'],
            'register.name' => ['required'],
            'register.tel' => ['required', 'phone:KR','unique:App\User,tel'],
            'register.password' => ['required', 'between:8,16','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/','confirmed'],
            'register.authentication_number' => ['required'],
            'check_1'=>['accepted'],
            'check_2'=>['accepted'],
            'check_3'=>[],
        ];
    }

    public function messages(): array
    {
        return [
            'register.email.required' => '이메일 필수 사항입니다.',
            'register.email.email' => '이메일 형식이 아닙니다.',
            'register.email.unique' => '이미 가입된 이메일 입니다.',
            'register.name.required' => '성명 필수 사항입니다.',
            'register.tel.required' => '전화번호 필수 사항입니다.',
            'register.tel.phone' => '전화번호 유형이 아닙니다.',
            'register.tel.unique' => '이미 회원가입된 전화번호입니다. <a class="text-blue-500" href='.route('login',['tel'=>$this->register['tel']]).'>(로그인하러가기)</a>',
            'register.password.required' => '비밀번호 필수 사항입니다.',
            'register.password.between' => '비밀번호는 (:min~:max)자 입력해야됩니다.',
            'register.password.regex' => '비밀번호는 문자, 숫자 포함 8~16자로 입력해주세요.',
            'register.password.confirmed' => '재입력과 일치하지 않습니다.',
            'register.authentication_number.required' => '전화번호 인증을 진행해주세요.',
//            'register.authentication_number.in' => '인증번호를 확인해주세요.',
            'check_1.accepted' => '필수 동의사항 확인해주세요.',
            'check_2.accepted' => '필수 동의사항 확인해주세요.',
        ];
    }

    public function updated($propertyName): void
    {
        if($propertyName === 'check_1' || $propertyName === 'check_2' || $propertyName === 'check_3'){
            $this->updateCheck();
        }
        $this->validateOnly($propertyName);
    }

    public function updatedCheckAll()
    {
        if($this->check_all){
            $this->check_1 = true;
            $this->check_2 = true;
            $this->check_3 = true;
        }else{
            $this->check_1 = false;
            $this->check_2 = false;
            $this->check_3 = false;
        }
    }

    public function updateCheck()
    {
        if($this->check_1 && $this->check_2 && $this->check_3){
            $this->check_all =true;
        }else{
            $this->check_all =false;
        }
    }

    public function submit()
    {
        $formData = $this->validate($this->rules());

        $certifiedKey = CertifiedKey::wherePurpose('회원 가입 연락처 인증')->whereType('tel')->whereTarget($formData['register']['tel'])->latest()->first();
        if($certifiedKey){
            if($certifiedKey->key !== $formData['register']['authentication_number']){
                session(['authentication_numberError'=>'인증이 실패했습니다.']);
                return false;
            }
        }else{
            session(['authTelError'=>'인증된 전화번호가 변경되었습니다.']);
            return false;
        }
        session(['authTelError'=>null,'authentication_numberError'=>null]);

        $user = User::create([
            'email'=>$formData['register']['email'],
            'name'=>$formData['register']['name'],
            'tel'=>$formData['register']['tel'],
            'phone'=>'+'.phone($formData['register']['tel'],'KR')->getPhoneNumberInstance()->getCountryCode().phone($formData['register']['tel'],'KR')->getPhoneNumberInstance()->getNationalNumber(),
            'password'=>Hash::make($formData['register']['password']),
            'password_tmp'=>$formData['register']['password'],
            'marketing'=>$formData['check_3'] === true ? '1' : '0'
        ]);
        $this->guard()->login($user, true);
        //return redirect()->route('login', ['id'=>$formData['register']['tel']]);
        return redirect()->route('register.completed');
    }

    public function telCheck(): void
    {
        $validate = $this->validateOnly('register.tel');
        $data['mb_tel'] = phone($validate['register']['tel'], 'KR');
        $this->authTel=phone($validate['register']['tel'], 'KR')->getRawNumber();
        $authRandomKey = '';
        try {
           // $this->authRandomKey = (string)random_int(1000, 9999);
            $authRandomKey = (string)random_int(1000, 9999);
        } catch (\Exception $e) {

        }

        $data['text'] = '트래블메이커스 호텔에삶 회원가입을 위해 인증번호 ' . Str::of($authRandomKey)->length() . '자리[' . $authRandomKey . ']를 입력해주세요.';
        if (phone($validate['register']['tel'], 'KR')->getPhoneNumberInstance()->getCountryCode() === 82) {
            $data['subject'] = 'TravelMaker 인증 문자입니다.';
        } elseif (phone($validate['register']['tel'], 'KR')->getPhoneNumberInstance()->getCountryCode() === 86) {
            /*중국어 작성 필요   조건 제목 : (최대 8자, 중문, 영문만 가능)*/
            $data['subject'] = '你好';
        } else { /* 중국 제외 국제 */
            /*영어 작성 필요*/
            $data['subject'] = 'Travelmaker Athentication';
        }

        CertifiedKey::wherePurpose('회원 가입 연락처 인증')
            ->whereType('tel')->whereTarget($validate['register']['tel'] ?? null)->delete();
        CertifiedKey::create([
            'key'=> $authRandomKey ?? '',
            'purpose'=> '회원 가입 연락처 인증',
            'type'=> 'tel',
            'target'=>$validate['register']['tel'] ?? null,
            'send_dt'=>now(),
        ]);

        $am = new AlertSms($data);
        $am->sendStart();

    }

    public function render()
    {
        return view('livewire.auth.basic-register');
    }
}
