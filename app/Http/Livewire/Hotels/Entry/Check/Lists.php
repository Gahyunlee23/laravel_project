<?php

namespace App\Http\Livewire\Hotels\Entry\Check;

use App\AddHotelCheckList;
use App\AddHotelCheckListImage;
use App\CheckGroup;
use App\CheckList;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Lists extends Component
{
    use WithFileUploads;
    /* Request */
    public $addHotel;
    public $group;
    public $isAdmin = false;
    /* Data */
    public $check;
    public $groups = [];

    /* Alpine */
    public $submitButton;

    /* Input */
    public $images = [];
    public $image_count = 10;

    /* Rule */
    public $rules;
    public $message;

    protected $listeners = [
        'checkListImageRemoverEvent'
    ];


    /* 이미지 삭제 처리*/
    public function checkListImageRemoverEvent($target,$index): void
    {
        $this->{$target}[$index] = null;
    }

    public function mount(){
        if(auth()->check()){
            if($this->addHotel!==null && ($this->addHotel->manager->id === auth()->user()->id) || auth()->user()->hasAnyRole('개발', 'admin', 'super-admin')){
                $this->groups = CheckGroup::orderBy('order')->get();
                for ($i=1; $i<=$this->image_count;$i++){
                    $this->images[$i] = '';
                }
                $this->imagesLoad();
                $this->setRules();

            }
        }
    }

    public function imagesLoad()
    {
        $this->images[0] = '';

        foreach (AddHotelCheckListImage::whereAddHotelId($this->addHotel->id)->whereHotelManagerId(auth()->user()->id)->get() as $index=>$item) {
            $this->images[$index+1]=$item->image;
        }

    }

    public function imageCountAdd()
    {
        $count = collect($this->images)->count();

        if($count < 20){
            if(isset($this->images[$count-1])&&$this->images[$count-1]!==''&&$this->images[$count-1]!==null){
                $this->images[$count]='';
            }else{
                $this->setErrorBag(['imageCountAdd'=>($count-1).'번 이미지 추가 후 진행해주세요']);
            }
        }
    }

    public function setRules()
    {
        foreach (CheckList::all() as $index => $checkList){
            if($checkList->jsonRequest['input'][0]['type'] === 'text' && $checkList->jsonRequest['input'][0]['placeholder'] === 'Y/N'){
                $this->rules[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required','in:Y,N'];
                $this->message[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required'=>'필수 입력', 'in_array' => '필수 입력'];
            }else{
                $this->rules[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required'];
                $this->message[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required'=>'필수 입력'];
            }
        }

        foreach ($this->images as $i=>$item){
            if($i!==0){
                if($i<=10){
                    $this->rules['images.'.$i] = ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
                }else{
                    $this->rules['images.'.$i] = ['nullable', 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
                }
            }
        }
    }

    /* 파일 체크 > 업로드 처리 */
    public function fileBoolCheck($property): bool
    {
        if(is_string($property)){
            return false;
        }
        return true;
    }
    /* 파일 체크 하여 Rules 적용 */
    public function fileCheck($propertyName, $property, $rule='required'): void
    {
        if($property === null || !is_string($property)){
            $this->rules[$propertyName] = [$rule, 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
        }else{
            $this->rules[$propertyName] = [$rule];
        }
    }

    public function updated($propertyName): void
    {
        $this->rules = null;
        foreach ($this->images as $i=>$item){
            if($i!==0){
                if($i<=10){
                    $this->rules['images.'.$i] = ['required', 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
                }else{
                    $this->rules['images.'.$i] = ['nullable', 'image', 'max:1024', 'mimes:png,jpg,jpeg'];
                }
            }
        }
        $this->submitButton = false;
        $this->validateOnly($propertyName);
        $this->submitButton = true;
        if(Str::of($propertyName)->contains('.')) {
            $data = Str::of($propertyName)->explode('.');
            if(!is_string($this->{$data[0]}[$data[1]])){
                if(Str::of($propertyName)->contains(['img', 'Img', 'image', 'Image']) &&
                    preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $this->{$data[0]}[$data[1]]->getClientOriginalName())){
                    $image = $this->{$data[0]}[$data[1]]->store('entry/check-list/'.auth()->user()->id, 's3');
                    $this->{$data[0]}[$data[1]] = $image;
                }
            }
        }
        $this->resetErrorBag();
    }

    public function submit($form){

        foreach (CheckList::all() as $index => $checkList){
            if($checkList->jsonRequest['input'][0]['type'] === 'text' && $checkList->jsonRequest['input'][0]['placeholder'] === 'Y/N'){
                $this->rules[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required','in:Y,N'];
                $this->message[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required'=>'필수 입력', 'in_array' => '필수 입력'];
            }else{
                $this->rules[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required'];
                $this->message[$checkList->group_id.'-'.$checkList->id.'-0'] = ['required'=>'필수 입력'];
            }
        }
//        foreach (collect($this->images)->filter(function ($item){ return $item ?? null; })->sortKeys() as $index=>$sortKey) {
//            if($sortKey!==null){
//                $this->images[$index]=$sortKey;
//            }
//        }
//        ddd(collect($this->images)->filter(function ($item){ return $item ?? null; })->sortKeys(),$this->images);
//        $this->images[0]='';
        foreach ($this->images as $i=>$item){
            if($i!==0){
                if($i>10){
                    $this->fileCheck('images.'.$i, $item ?? null, 'nullable');
                }else{
                    $this->fileCheck('images.'.$i, $item ?? null);
                }
                $form['images'][$i] = $item;
            }
        }
        $this->resetErrorBag();
        $validate = Validator::make($form, $this->rules);

        if ($validate->fails()) {
            $this->setErrorBag($validate->getMessageBag());
            session()->flash('error', '상단의 미입력 체크리스트를 확인해주세요');
            return false;
        }
        foreach ($this->images as $index=>$item){
            if( $item !==null ){
                if($this->fileBoolCheck($item)) {
                    $form['images'][$index] = $item->store('entry/check-list/'.auth()->user()->id, 's3');
                }else {
                    $form['images'][$index] = $item;
                }
            }
        }
        foreach (collect($form)->forget('images') as $key=>$item){
            if($item!=="" && $item !== null){
                $object = Str::of($key)->explode('-');

                AddHotelCheckList::updateOrCreate([
                    'add_hotel_id' => $this->addHotel->id,
                    'hotel_manager_id' => auth()->user()->id,
                    'check_group_id'=>$object[0],
                    'check_list_id'=>$object[1],
                    'input'=>$object[2] ?? '0'
                ],[
                    'add_hotel_id' => $this->addHotel->id,
                    'hotel_manager_id' => auth()->user()->id,
                    'check_group_id'=>$object[0],
                    'check_list_id'=>$object[1],
                    'input'=>$object[2] ?? '0',
                    'answer'=>$item
                ]);
            }
        }
        if(collect($form['images'])->count()>=10){
            AddHotelCheckListImage::onlyTrashed()->whereAddHotelId($this->addHotel->id)->whereHotelManagerId(auth()->user()->id)->forceDelete();
            AddHotelCheckListImage::whereAddHotelId($this->addHotel->id)->whereHotelManagerId(auth()->user()->id)->delete();
            $i=1;
            foreach ($form['images'] as $index=>$image) {
                if($image!=='' && $image!==null && $index!==0){
                    AddHotelCheckListImage::create([
                        'add_hotel_id' => $this->addHotel->id,
                        'hotel_manager_id' => auth()->user()->id,
                        'order'=>$i,
                        'image'=>$image
                    ]);
                    $i++;
                }
            }
        }
        $this->resetErrorBag();
        session()->flash('message', '체크리스트 저장 완료되었습니다.');
        return redirect()->route('hotel-manager.hotel-management');
    }

    public function validateCheck($form){
        session()->flash('errors', ['test'=>'test1']);
        return false;
    }

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('livewire.hotels.entry.check.lists');
	}
}
