<?php

namespace App\Http\Livewire\Enter\Hotel;

use App\CertifiedKey;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ManagerForm extends Component
{
    /* DATA */

    /* Model */
    public $certified;

    /* 인증, Input 체크 */
    public $email;
    public $certifiedKey;
    public $password;
    public $password_confirmation;
    public $check_all;
    public $check_0;
    public $check_1;
    public $check_2;

    /* Alpine */
    public $submitDisabled=true;
    public $certified_process=false;
    public $certified_key_completed=false;

    public function rules(): array
    {
        return [
            'email' => ['required','email','unique:users,email'],
            'certifiedKey' => ['required'],
            'password' => ['required', 'between:8,16','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/','confirmed'],
            'check_0'=>['accepted'],
            'check_1'=>['accepted'],
            'check_2'=>['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => '이메일 필수 사항입니다.',
            'email.email' => '이메일 형식이 아닙니다.',
            'email.unique' => '이미 가입된 이메일 입니다.',
            'certifiedKey.required' => '이메일 인증을 진행해주세요.',
            'password.required' => '비밀번호 필수 사항입니다.',
            'password.between' => '비밀번호는 (:min~:max)자 입력해야됩니다.',
            'password.regex' => '비밀번호는 문자, 숫자 포함 8~16자로 입력해주세요.',
            'password.confirmed' => '재입력과 일치하지 않습니다.',
            'check_0.accepted' => '필수 동의사항 확인해주세요.',
            'check_1.accepted' => '필수 동의사항 확인해주세요.',
            'check_2.accepted' => '필수 동의사항 확인해주세요.',
//            'register.authentication_number.in' => '인증번호를 확인해주세요.',
        ];
    }

//    public function updated($propertyName): void
//    {
//        $check=true;
//        $this->submitDisabled = true;
//        $this->validateOnly($propertyName);
//        if($propertyName === 'email'){
//            $this->updatedEmailCheck();
//            $check=false;
//        }
//        if($propertyName === 'certifiedKey'){
//            $this->updatedCertifiedKey();
//        }
//        if($check){
//            $this->validate();
//            $this->submitDisabled = false;
//        }
//    }

    public function updatedEmail(): void
    {
        $this->validateOnly('email');
    }
    public function updatedCheckAll()
    {
        if($this->check_all){
            $this->check_0 = true;
            $this->check_1 = true;
            $this->check_2 = true;
        }else{
            $this->check_0 = false;
            $this->check_1 = false;
            $this->check_2 = false;
        }
    }

    public function updateCheck()
    {
        if($this->check_0 && $this->check_1 && $this->check_2){
            $this->check_all =true;
        }else{
            $this->check_all =false;
        }
    }

    public function updatedCheck0()
    {
        $this->updateCheck();
    }
    public function updatedCheck1()
    {
        $this->updateCheck();
    }
    public function updatedCheck2()
    {
        $this->updateCheck();
    }

    public function updatedEmailCheck(): void
    {
        $this->reset('certifiedKey');
    }
    public function updatedCertifiedKey(): void
    {
        if(!is_null($this->certifiedKey) && $this->certifiedKey !==''){
            $certified = CertifiedKey::wherePurpose('Hotel Manager 가입 이메일 인증')->whereTarget($this->email)->latest()->first();
            if($certified){
                if($certified->key === $this->certifiedKey){
                    $this->certified_key_completed = true;
                }else{
                    $this->certified_key_completed = false;
                }
            }
        }
    }

    public function emailCertified()
    {
        try {
            $key = random_int(100000, 999999);
        } catch (\Exception $e) {
            $this->addError('error', '인증 키 생성 오류');
            return false;
        }

        if(is_null($this->email)){
            $this->addError('error', '이메일 정보가 없습니다');
            return false;
        }

        $validatedData = $this->validateOnly('email');
        CertifiedKey::wherePurpose('Hotel Manager 가입 이메일 인증')
            ->whereType('email')->whereTarget($this->email)->delete();
        $count=CertifiedKey::withTrashed()->wherePurpose('Hotel Manager 가입 이메일 인증')
            ->whereType('email')->whereTarget($this->email)
            ->whereDate('send_dt', today()->toDateString())->count();
        if($count>=10){
            session()->flash('message', '하루 10번 이상 인증시도 불가합니다, 내일 다시 시도해주세요.');
        }else{
            $this->certified = CertifiedKey::create([
                'key'=> $key,
                'purpose'=> 'Hotel Manager 가입 이메일 인증',
                'type'=> 'email',
                'target'=>$this->email,
                'send_dt'=>now(),
            ]);
            $this->certified_process=true;
            $this->updatedCertifiedKey();
            $this->sendMail();

            session()->flash('message', '해당 이메일로 인증 코드를 전송했습니다.');
        }
    }


    public function sendMail()
    {
        Mail::mailer('apply')->send('emails.outer.certified-mail', ['certified'=>$this->certified], function($message) {
            $message->to($this->email, '호텔 매니저님')->subject('[호텔에삶] 호텔 매니저 가입 인증 코드가 도착했습니다.');
            $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME'));
        });
    }

    public function FormSubmit()
    {
        $validatedData = $this->validate($this->rules());
        if($this->certified_key_completed){
            $validatedData['name']='호텔 매니저';
            $validatedData['password_tmp']= $validatedData['password'];
            $user = User::create([
                'email'=>$validatedData['email'],
                'name'=>$validatedData['name'],
                'password'=>$validatedData['password'],
                'password_tmp'=>$validatedData['password_tmp'],
                'email_verified_at' => now(),
            ]);
            if($user){
                $certified = CertifiedKey::whereTarget($this->email)
                    ->where('key','=', $validatedData['certifiedKey'])
                    ->where('purpose', '=', 'Hotel Manager 가입 이메일 인증')
                    ->where('type', '=', 'email')
                    ->latest()->first();
                if($certified){
                    CertifiedKey::find($certified->id)->update([
                        'user_id'=>$user->id,
                        'authentication_dt'=>now()
                    ]);
                }
                $user->assignRole('hotel');
                sleep(1);
                if(Auth::check()){
                    Auth::logout();
                }
                Auth::login($user);

                return redirect()->route('enter.hotel-manager.create-completed');
            }
            session()->flash('status-error', '호텔 매니저 생성에 실패했습니다, 재시도 후 고객센터로 문의해주세요.');
            $this->reset(['certifiedKey', 'email', 'password', 'password_confirmation']);
        }else{
            session()->flash('status-error', '메일 인증 코드가 일치 하지 않습니다.');
            $this->reset('certifiedKey');
        }
    }

    /**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.enter.hotel.manager-form');
	}
}
