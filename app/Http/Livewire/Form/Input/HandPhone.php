<?php

namespace App\Http\Livewire\Form\Input;

use App\AlertSms;
use App\CertifiedKey;
use Illuminate\Support\Str;
use Livewire\Component;

class HandPhone extends Component
{
    /* Request */
    public $emitTo;

    /* Input */
    public $countryCode='+82';
    public $tel;
    public $certifiedKey;
    public $certified_key_completed=false;

    /* Data */
    public $user;
    public $user_id;

    public function rules(): array
    {
        if($this->countryCode === '+82'){
            return [
                'tel' => [
                    'required',
                    'phone:KR'
                ]
            ];
        }

        return [
            'tel' => [
                'required',
                'phone:US'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'tel.required' => '인증 연락처 필수 사항입니다.',
            'tel.phone' => '인증 연락처 국가 형식이 잘못되었습니다.',
        ];
    }

    public function mount()
    {
        if(auth()->check()){
            $this->user = auth()->user();
            $this->user_id=$this->user->id;
        }
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);

        if($propertyName === 'certifiedKey'){
            $this->updatedCertifiedKeyCheck();
        }
    }
    public function updatedCertifiedKeyCheck()
    {
        $this->certified_key_completed = false;
        if($this->tel !== '' && $this->tel !== null){
            $validate = $this->validateOnly('tel');

            $certified = CertifiedKey::wherePurpose('결제 전 인증')
                ->whereType('tel')
                ->whereTarget($this->tel)->latest()->first();

            if($certified->key !== $this->certifiedKey && Str::of($this->certifiedKey)->length() >= 6){
                $this->reset('certifiedKey');
                $this->addError('error', '인증번호 확인 후 입력 바랍니다.');
            }
            if($certified->key === $this->certifiedKey && Str::of($this->certifiedKey)->length() >= 6){
                $this->certified_key_completed = true;

                if($this->emitTo !== null){
                    $this->emitTo($this->emitTo, 'HandPhoneSendEmit', [
                        'certified_key_completed'=>$this->certified_key_completed,
                        'countryCode'=>$this->countryCode,
                        'tel'=>$this->tel
                    ]);
                }
            }
        }
    }

    public function telCheck(): void
    {
        $validate = $this->validateOnly('tel');
        $data['mb_tel'] = phone($this->tel, 'KR');
        try {
            $key = (string)random_int(100000, 999999);
        } catch (\Exception $e) {
            $this->addError('error', '인증번호 전송에 오류가 있습니다 새로고침 후 재시도 바랍니다.');
            return;
        }
        $this->resetErrorBag('error');
        $data['subject'] = 'TravelMaker 인증 문자입니다';
        $data['text'] = '트래블메이커스 호텔에삶 인증을 위해 인증번호 '
            . Str::of($key)->length() . '자리 [' . $key . ']를 입력해주세요.';

        if (phone($this->tel, 'KR')->getPhoneNumberInstance()->getCountryCode() === 82) {
            $data['subject'] = 'TravelMaker 인증 문자입니다';
        } elseif (phone($this->tel, 'KR')->getPhoneNumberInstance()->getCountryCode() === 86) {
            $data['subject'] = '你好';
        } else { /* 중국 제외 국제 */
            /*영어 작성 필요*/
            $data['subject'] = 'Travelmaker Athentication';
        }

        CertifiedKey::wherePurpose('결제 전 인증')
            ->whereType('tel')->whereTarget($this->tel)->delete();

        $count=CertifiedKey::withTrashed()->wherePurpose('결제 전 인증')
            ->whereType('tel')->whereTarget($this->tel)
            ->whereDate('send_dt', today()->toDateString())->count();
        if($count>=20){
            session()->flash('message', '하루 20번 초과 인증 불가능합니다, 내일 다시 시도해주세요.');
        }else{
            CertifiedKey::create([
                'user_id'=>$this->user_id ?? null,
                'key'=>$key,
                'purpose'=>'결제 전 인증',
                'type'=>'tel',
                'target'=>$this->tel,
                'send_dt'=>now(),
            ]);
            $am = new AlertSms($data);
            $am->sendStart();
            $this->reset('certifiedKey');
            session()->flash('message', '해당 번호로 인증 문자가 전송 되었습니다.');
        }
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.form.input.hand-phone');
	}
}
