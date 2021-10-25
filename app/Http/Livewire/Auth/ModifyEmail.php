<?php

namespace App\Http\Livewire\Auth;

use App\CertifiedKey;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ModifyEmail extends Component
{
    public $email;
    public $certifiedKey;

    public $buttonTextSize = 'text-base';

    /* Model */
    public $certified;

    /* 인증, Input 체크 */
    public $submitDisabled=true;
    public $certified_process=false;
    public $certified_key_completed=false;


    public function mount()
    {
        $this->email='';
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'not_in:' . auth()->user()->email,
                'unique:users,email'
            ],
            'certifiedKey' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => '이메일 필수 사항입니다.',
            'email.email' => '이메일 형식이 아닙니다.',
            'email.not_in' => '이전 메일 주소와 다르게 변경해주세요.',
            'email.unique' => '이미 사용중인 이메일 주소입니다.',
            'certifiedKey.required' => '이메일 인증을 진행해주세요.',
        ];
    }

    public function updated($propertyName): void
    {
        $check=true;
        $this->submitDisabled = true;
        $this->validateOnly($propertyName);

        if($propertyName === 'email'){
            $this->updatedEmailCheck();
            $check=false;
        }
        if($propertyName === 'certifiedKey'){
            $this->updatedCertifiedKeyCheck();
        }
        if($check){
            $this->validate();
            $this->submitDisabled = false;
        }
    }

    public function updatedEmailCheck(): void
    {
        $this->reset('certifiedKey');
    }
    public function updatedCertifiedKeyCheck(): void
    {
        if(!is_null($this->certifiedKey) && $this->certifiedKey !==''){
            $certified = CertifiedKey::wherePurpose('호텔 매니저 정보 변경')->whereTarget($this->email)->latest()->first();
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
        $key = null;

        try {
            $key = random_int(10000, 99999);
        } catch (\Exception $e) {
            $this->addError('error', '인증 키 생성 오류');
            return false;
        }

        if(is_null($this->email)){
            $this->addError('error', '이메일 정보가 없습니다');
            return false;
        }

        $validatedData = $this->validateOnly('email');
        CertifiedKey::wherePurpose('호텔 매니저 정보 변경')
            ->whereType('email')->whereTarget($this->email)->delete();
        $count=CertifiedKey::withTrashed()->wherePurpose('호텔 매니저 정보 변경')
            ->whereType('email')->whereTarget($this->email)
            ->whereDate('send_dt', today()->toDateString())->count();
        if($count>=10){
            session()->flash('message', '하루 10번 이상 인증은 불가능합니다, 내일 다시 시도해주세요.');
        }else{
            $this->certified = CertifiedKey::create([
                'key'=> $key,
                'purpose'=> '호텔 매니저 정보 변경',
                'type'=> 'email',
                'target'=>$this->email,
                'send_dt'=>now(),
            ]);
            $this->certified_process=true;
            $this->updatedCertifiedKeyCheck();
            $this->sendMail();

            session()->flash('message', '해당 이메일로 인증 코드를 전송했습니다.');
        }
    }

    public function sendMail()
    {
        Mail::send('emails.outer.certified-mail', ['certified'=>$this->certified], function($message) {
            $message->to($this->email, '호텔 매니저님께')->subject('트래블메이커스 호텔에삶 호텔 매니저 인증 메일');
            $message->from(env('MAIL_USERNAME'),env('MAIL_NICKNAME'));
        });
    }


    public function render()
    {
        return view('livewire.auth.modify-email');
    }

    public function emailModify()
    {
        $validatedData = $this->validate($this->rules());
        if($this->certified_key_completed){
            $certified = CertifiedKey::whereTarget($this->email)
                ->where('key','=', $validatedData['certifiedKey'])
                ->where('purpose', '=', '호텔 매니저 정보 변경')
                ->where('type', '=', 'email')
                ->latest()->first();
            if($certified){
                CertifiedKey::find($certified->id)->update([
                    'user_id'=>auth()->user()->id,
                    'authentication_dt'=>now()
                ]);
            }

            auth()->user()->email =  $validatedData['email'];
            auth()->user()->save();

            session()->flash('result-message', '호텔 매니저 정보 변경이 성공했습니다.');
            $this->reset('certifiedKey');
        }else{
            session()->flash('error-message', '호텔 매니저 정보 변경이 실패했습니다.');
            $this->reset('certifiedKey');
        }
    }
}
