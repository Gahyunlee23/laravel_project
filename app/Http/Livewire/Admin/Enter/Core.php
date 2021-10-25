<?php

namespace App\Http\Livewire\Admin\Enter;

use App\AddHotel;
use App\AddHotelNeedToModify;
use App\Reason;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Core extends Component
{
    /* Request Send */
    public $addHotel;

    /* Alpine */
    public $modal = false;
    public $modelDelete = false;

    /* Data */
    public $trashed;

    /* Input */
    public $model;
    public $target;
    public $status;
    public $severity = '확인필요';
    public $content;

    public $loading=true;

    public $reason;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    protected $listeners = ['CoreEventNeedToModify', 'CoreEventOnLoaded'];

    public function mount(){
        if($this->addHotel){
            $this->reason = $this->addHotel->reason->explanation ?? '';
        }
    }

    public function addHotelStatusChange($status)
    {
        $this->addHotel->enter_status = $status;
        $this->addHotel->save();
        $this->addHotel->reasons->each(function ($item, $key){
            $item->delete();
        });
    }

    public function CoreEventOnLoaded(){
        $this->loading = false;
    }

    public function CoreEventNeedToModify($model, $target)
    {
        //$model = app('App\\'.$model);
        $this->trashed = AddHotelNeedToModify::onlyTrashed()->whereAddHotelId($this->addHotel->id)
            ->whereModel($model)->whereTarget($target)->get();
        $data = AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)
            ->whereModel($model)->whereTarget($target)->latest()->first();
        if($data){
            $this->modelDelete = true;
            $this->model = $data->model;
            $this->target = $data->target;
            $this->status = $data->status;
            $this->content =$data->content;
            $this->severity =$data->severity;
        }else{
            $this->modelDelete = false;
            $this->model = $model;
            $this->target = $target;
            $this->status = '';
            $this->content ='';
            $this->severity ='확인필요';
        }
        $this->modal =true;
        usleep(500000);
        $this->CoreEventOnLoaded();
	}

    public function NeedToModifyDelete()
    {
        if($this->modelDelete){
            AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)
                ->whereModel($this->model)->whereTarget($this->target)->latest()->first()->delete();
        }
        $this->modelDelete= false;
        $this->modal = false;
    }
    public function NeedToModifySave()
    {
        $this->validate([
            'model'=> ['required','max:50'],
            'target'=> ['required','max:50'],
            'status'=> ['nullable','max:10'],
            'content'=> ['required','string'],
            'severity'=> ['required'],
        ]);
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)
            ->whereModel($this->model)->whereTarget($this->target)->delete();
        AddHotelNeedToModify::create([
            'admin_id'=>auth()->user()->id,
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->addHotel->manager->id,
            'model'=>$this->model,
            'target'=>$this->target,
            'status'=>$this->status === '' ? null : $this->status,
            'content'=>$this->content ?? null,
            'severity'=>$this->severity ?? null,
        ]);
        $this->modal = false;
	}

    public function reasonSave()
    {
        $this->validate([
            'reason'=> ['required','string'],
        ]);

        $this->addHotel->enter_status = '입점 미승인';
        $this->addHotel->save();

        Reason::updateOrCreate(
            [
                'add_hotel_id'=>$this->addHotel->id,
            ],[
            'admin_id'=>auth()->user()->id,
            'add_hotel_id'=>$this->addHotel->id,
            'hotel_manager_id'=>$this->addHotel->manager->id,
            'type'=>'입점 미승인',
            'explanation'=>$this->reason
        ]);
	}

	public function mailSend($type){
        if($this->addHotel && $this->addHotel->manager->email){
            $path = app('App\\AddHotelLog');
            $log = [
                'add_hotel_id' => $this->addHotel->id,
                'hotel_manager_id' => $this->addHotel->manager->id,
                'admin_id' => auth()->user()->id,
                'old_status' => $this->addHotel->enter_status,
                'status' => $type,
            ];

            $path->amuseLog($log);

            if($this->addHotel->method === '입금가') {
                $label = '프리미엄';
            } else {
                $label = '스탠다드';
            }
            switch ($type){
                case '입점 승인' :
                    Mail::mailer('apply')->send('emails.outer.enter.register-enter', ['addHotel'=>$this->addHotel], function($message) {
                        $message->to($this->addHotel->manager->email, '호텔 매니저님')->subject('[호텔에삶] 호텔 매니저 \'입점 승인\' 안내');
                        $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME')); /*APPLY_MAIL_MAILER*/
                    });
                break;

                case '입점 미승인' :
                    Mail::mailer('apply')->send('emails.outer.enter.deregister', ['addHotel'=>$this->addHotel], function($message) {
                        $message->to($this->addHotel->manager->email, '호텔 매니저님')->subject('[호텔에삶] 호텔 매니저 \'입점 미 승인\' 안내');
                        $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME')); /*APPLY_MAIL_MAILER*/
                    });
                break;

                case '수정 요청' :
                    Mail::mailer('apply')->send('emails.outer.enter.adjust-needed', ['addHotel'=>$this->addHotel], function($message) {
                        $message->to($this->addHotel->manager->email, '호텔 매니저님')->subject('[호텔에삶] 호텔 매니저 \'입점 신청서 수정 요청\'');
                        $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME')); /*APPLY_MAIL_MAILER*/
                    });
                break;

                case '고객 선호도 리스트' :
                    Mail::mailer('apply')->send('emails.outer.enter.customer_preference_list', ['addHotel'=>$this->addHotel], function($message) {
                        $message->to($this->addHotel->manager->email, '호텔 매니저님')->subject('[호텔에삶] 호텔 매니저 \'고객 선호도 리스트\' 안내');
                        $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME')); /*APPLY_MAIL_MAILER*/
                    });
                break;

                case '오픈 확정' : /*완료*/
                    Mail::mailer('apply')->send('emails.outer.enter.open-enter', ['addHotel'=>$this->addHotel], function($message) use($label) {
                        $message->to($this->addHotel->manager->email, '호텔 매니저님')->subject('[호텔에삶] 호텔 매니저 ' . $label . ' 호텔 오픈 확정 안내');
                        $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME')); /*APPLY_MAIL_MAILER*/
                    });
                break;

                case '판매 시작' :
                    Mail::mailer('apply')->send('emails.outer.enter.for-sale', ['addHotel'=>$this->addHotel], function($message) {
                        $message->to($this->addHotel->manager->email, '호텔 매니저님')->subject('[호텔에삶] 호텔 매니저 \'판매 시작\' 안내');
                        $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME')); /*APPLY_MAIL_MAILER*/
                    });
                break;



/*
지금 메일 템플릿 내용 전달 필요합니다

현재 메일 완성된건
호텔 > TM : 입점 신청, 수정 완료
TM > 호텔 : 오픈 승인
입니다~

추가 필요 메일이
입점 승인, 미승인, 오픈 최종 확정, 수정필요, 오픈 최종 확정
찜리스트 추가 */
            }


        }
    }

	public function render()
	{
		return view('livewire.admin.enter.core');
	}
}
