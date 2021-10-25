<?php

namespace App\Http\Livewire\Enter;

use App\Formatter;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class Recommendation extends Component
{
    protected $listeners = [
        'recommendationTagCreatingEvent',
        'recommendationTagRemoveEvent',
        'recommendationStore',
    ];

    public $dataCount;
    public $recommendation, $val,$val2, $type;
    public $tel;
    public $privacy, $open1, $marketing;
    public $allChecker;

    public function rules(): array
    {
        return [
            'val' => ['required', 'min:1', 'max:100'],
            'val2' => [],
            'tel' => ['phone:KR'],
            'privacy' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'val.required' => '지역명 입력해주세요',
            'val.min' => '1글자 이상 입력해주세요',
            'val.max' => '100글자 미만 입력해주세요',
            'tel.phone' => '전화번호 유형이 아닙니다.',
            'privacy.accepted' => '개인정보 수집 및 활용 동의 확인바랍니다',
        ];
    }

    public function updated($propertyName): void
    {
        switch ($propertyName){
            case 'privacy' :
                if(!$this->privacy){
                    $this->allChecker = false;
                }else if($this->marketing){
                    $this->allChecker = true;
                 }
                break;
            case 'marketing' :
                if(!$this->marketing){
                    $this->allChecker = false;
                }else if($this->privacy){
                    $this->allChecker = true;
                }
                break;
            case 'allChecker' :
                if($this->privacy && $this->marketing){
                    $this->privacy = false;
                    $this->marketing = false;
                    $this->allChecker = false;
                }else{
                    $this->privacy = true;
                    $this->marketing = true;
                    $this->allChecker = true;
                }
                break;
        }
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.enter.recommendation');
    }

    public function mount()
    {
        $this->recommendation = collect();
    }

    public function recommendationCountCheck(): void
    {
        $this->dataCount = $this->recommendation->count();
    }

    public function recommendationTagCreatingEvent(): void
    {
        $this->val = Str::of(htmlspecialchars($this->val))->ltrim()->rtrim();
        $this->val2 = Str::of(htmlspecialchars($this->val2))->ltrim()->rtrim();
        $this->validateOnly('val');
        if (($this->val !== null && $this->val !== '')) {
            $val=$this->val;
            if($this->val2!=="" && $this->val2!==null&& strlen($this->val2) >= 1){
                $val =$this->val.'-'.$this->val2;
            }
            if(!$this->recommendation->contains($val)){
                $this->recommendation->push(htmlspecialchars($val));
                $this->recommendationCountCheck();
            }
        }
        $this->val = '';
        $this->val2 = '';
    }

    public function recommendationTagRemoveEvent($index): void
    {
        $this->recommendation->forget($index);
        $this->recommendation = $this->recommendation->filter()->values();
        $this->recommendationCountCheck();
    }

    public function recommendationStore()
    {

        $validator = Validator::make([
            'tel' => $this->tel,
            'privacy' => $this->privacy,
            'marketing' => $this->marketing,
        ], [
            'tel' => ['required', 'phone:KR'],
            'privacy' => ['accepted'],
            '*' => [],
        ])->validate();

        $validator=array_merge($validator,['recommendation'=>$this->recommendation->filter()->implode('ㆍ')]);

        $recommendation = \App\Recommendation::create($validator);
//        $data = [
//            'subject' => '[호텔에삶/호텔오픈요청]추천 '.$this->recommendation->filter()->count().'개 신청 내역입니다.',
//            'recommendation' => $recommendation,
//            'formatter'=> new Formatter()
//        ];
//        $admin = [
//            [
//                'email'=>'travelmakerkorea_k@naver.com',
//                'name'=>'김병주'
//            ]
//        ];
//        foreach ($admin as $index => $user) {
//            Mail::send('emails.admin.recommendation', $data, function ($message) use ($user, $data) {
//                $message->to($user['email'], $user['name'])->subject($data['subject']);
//                $message->from(env('MAIL_USERNAME'), env('MAIL_NICKNAME'));
//            });
//        }
        //$this->dispatchBrowserEvent('alert', ['type' => 'room_page','message'=>'호텔 추천을 수렴하여.']);
        $this->dispatchBrowserEvent('notice', ['type' => 'success','text' => '호텔 추천 완료했습니다!']);

        return back();
    }


}
