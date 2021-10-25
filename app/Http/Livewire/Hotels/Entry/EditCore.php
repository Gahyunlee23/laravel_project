<?php

namespace App\Http\Livewire\Hotels\Entry;

use App\AddHotelNeedToModify;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EditCore extends Component
{
    public $addHotel;

    public $process = 0;

    public $edit = false;

    protected $listeners =[
        'coreRoomTypesSave',
        'coreBenefitsEventSave',
        'coreItemsEditEvent',
        'coreAmenitiesFacilitiesEditEvent',
        'coreOtherEditEvent',
        'coreAndSubmit',
    ];

    public function mount(){
        if($this->addHotel){
            AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereStatus('확인')->update([
               'status'=>null
            ]);
        }
    }

    public function editChange()
    {
        $this->edit = !$this->edit;
        $this->render();
    }

    public function allSubmit()
    {
        $this->coreHotelImagesAndCheckPointsSave();
    }

    public function coreHotelImagesAndCheckPointsSave()
    {
        $this->emitTo('hotels.entry.hotel-images-and-check-points-edit', 'hotelImagesAndCheckPointsSave');
    }

    public function coreRoomTypesSave(){
        $this->process ++;
        $this->emitTo('hotels.entry.room-types-edit', 'roomTypesEventSave');
    }
    public function coreBenefitsEventSave(){
        $this->process ++;
        $this->emitTo('hotels.entry.benefits-edit', 'benefitsEventSave');
    }
    public function coreItemsEditEvent(){
        $this->process ++;
        $this->emitTo('hotels.entry.items-edit', 'itemsEditEvent');
    }
    public function coreAmenitiesFacilitiesEditEvent(){
        $this->process ++;
        $this->emitTo('hotels.entry.amenities-facilities-edit', 'amenitiesFacilitiesEditEvent');
    }
    public function coreOtherEditEvent(){
        $this->process ++;
        $this->emitTo('hotels.entry.other-edit', 'otherEditEvent');
    }
    public function coreAndSubmit(){
        $this->process ++;

        if($this->addHotel->enter_status === '수정 필요'){
            $this->addHotel->enter_status = '수정 확인';
            $this->addHotel->save();
            /* TM 관리자 메일 전송 */
            $admins = [
                [
                    'email'=>env('APPLY_MAIL_USERNAME') ?? 'hotelmanager@travelmakers.kr',
                    'name'=>env('APPLY_MAIL_NICKNAME') ?? '트래블메이커스'
                ]
            ];
            $data = [
                'subject'=>'[호텔에삶>입점신청>수정확인]'.($this->addHotel->name ?? '정보 없음').', 수정 확인 필요',
                'addHotel'=>$this->addHotel
            ];
            foreach ($admins as $index => $user){
                Mail::mailer('apply')->send('emails.enter.waiting-for-review', $data, function($message) use ($user,$data) {
                    $message->to($user['email'],$user['name'])->subject($data['subject']);
                    $message->from(env('APPLY_MAIL_USERNAME'),env('APPLY_MAIL_NICKNAME')); /*APPLY_MAIL_MAILER*/
                });
            }
        }
        session()->flash('message', '호텔 - '.$this->addHotel->name.' 입점 신청서 수정되었습니다.');
        AddHotelNeedToModify::whereAddHotelId($this->addHotel->id)->whereStatus('확인')->update([
            'status'=>'수정 확인'
        ]);
        return redirect()->route('hotel-manager.hotel-management');
    }

    public function notification(): void
    {
        $percent = number_format(($this->process/6)*100, 2);
        $this->dispatchBrowserEvent('notification', ['text'=>$percent.'% 저장 완료','time'=> 3000, 'type' => 'wbc-mtc-text-30373F-bg-d7d3cf']);
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotels.entry.edit-core');
	}
}
