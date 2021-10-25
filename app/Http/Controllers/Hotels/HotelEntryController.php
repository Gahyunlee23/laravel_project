<?php

namespace App\Http\Controllers\Hotels;

use App\AddHotel;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Integer;

class HotelEntryController extends Controller
{
	public function entryHotel(AddHotel $hotel = null,$tab = null)
	{
	    if($hotel){
            if($hotel->enter_status !== '작성 중'/* && $hotel->enter_status !== '심사 대기' && $hotel->enter_status !== '수정 필요' && $hotel->enter_status !== '수정 확인'*/){
                //session()->flash('error', '호텔 - '.$hotel->name.' 은(는) 현재 수정 불가 상태 입니다.');
                //return redirect()->route('hotel-manager.hotel-management');
            }
            $tabCheck=1;
            if(isset($hotel->images) && $hotel->images->count()>=1){
                $tabCheck++;
            }
            if(isset($hotel->roomTypes) && $hotel->roomTypes->count()>=1){
                $tabCheck++;
            }
            if(isset($hotel->benefits) && $hotel->benefits->count()>=1){
                $tabCheck++;
            }
            if(isset($hotel->items) && $hotel->items->count()>=1){
                $tabCheck++;
            }
            if(isset($hotel->amenities) && $hotel->amenities->count()>=1){
                $tabCheck++;
            }
            if($tabCheck < $tab){
                $tab = $tabCheck;
            }
        }
        return view('hotel-entry.index',[
            'tab'=>$tab ?? $tabCheck ?? 1,
            'hotel'=>$hotel
        ]);
	}

    public function updateFormHotel(AddHotel $addHotel)
    {
        if($addHotel->enter_status === '심사 대기' || $addHotel->enter_status === '수정 필요' || $addHotel->enter_status === '수정 확인' || $addHotel->enter_status === '수정 요청'){
            return view('hotel-entry.update-form',[
                'addHotel'=>$addHotel
            ]);
        }
        session()->flash('error', '호텔 - '.$addHotel->name.' 은(는) 현재 수정 불가 상태 입니다.');
        return redirect()->route('hotel-manager.hotel-management');
	}

    public function checkList(AddHotel $addHotel)
    {
        if($addHotel->enter_status === '승인 완료' || $addHotel->enter_status === '입점 승인'){
            return view('hotel-entry.check-list',[
                'addHotel'=>$addHotel
            ]);
        }

        session()->flash('error', '호텔 - '.$addHotel->name.' 은(는) 현재 수정 불가 상태 입니다.');
        return redirect()->route('hotel-manager.hotel-management');
	}
}
