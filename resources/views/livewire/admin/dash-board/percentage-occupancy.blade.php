<div class="w-full" xmlns:livewire="http://www.w3.org/1999/html">
    <div class="select-text w-full">
        @if(!$load)
            <div class="w-full rounded-md cursor-pointer bg-tm-c-30373F"
                 wire:click="$emitSelf('PercentageOccupancyCalculateLoadEvent')">
                <div class="flex w-full py-4 justify-center items-center">
                    <div class="text-white text-3xl">
                        <i class="fal fa-money-check-alt"></i>
                        입주율 보기
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-center items-center">
                <div class="py-4" wire:loading>
                    <livewire:form.loading
                        type="circle-spine"
                        borderTopColor="#c1a485"
                        loadingColorClass="text-tm-c-30373F"></livewire:form.loading>
                </div>
            </div>
        @elseif($load)
            <div wire:loading.remove>

                <div class="pt-4">
                    <div class="relative select-text">
                        <div class="flex flex-wrap gap-1">
                            <div>
                                <div>
                                    총 고객 수 : {{\App\User::all()->count()}}명
                                </div>
                                <div>
                                    총 결제 수 : {{\App\Payment::where('status', '=', '3')->get()->count()}}개
                                </div>
                            </div>
                            <div>
                                <div>
                                    총 금액 : {{ number_format(\App\Payment::where('status','=','3')->sum('total_price')) }}원
                                </div>
                                <div>
                                    총 평균 : {{ number_format(\App\Payment::where('status', '=', '3')->avg('total_price'))}}원
                                </div>
                            </div>
                        </div>
                        <div class="p-2" wire:poll>
                            @php
                                $hotels= \App\Hotel::where('status','=','2')->get();
                                $data = '';
                                $percent=0;
                                foreach ($hotels as $hotel) {
                                    $nowCount = \App\HotelReservation::where('hotel_id','=',$hotel->id)->where('type','=','month')->whereOrderStatus(5)->whereHas('confirmation', function ($query) {
                                            $query->where('start_dt', '<=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'));
                                            $query->where('end_dt', '>=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'));
                                    })->get()->count()+10;

                                    $prevCount = \App\HotelReservation::where('hotel_id','=',$hotel->id)->where('type','=','month')
                                        ->where(function ($query){
                                            $query->where('order_status','=',3)
                                                ->orWhere('order_status','=',4)
                                                ->orWhere('order_status','=',5);
                                        })->whereHas('confirmation', function ($query) {
                                            $query->where('start_dt', '>=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'));
                                    })->get()->count();
                                    if($nowCount!==0 &&$hotel->SalePossibilitySum!==0){
                                        $percent = number_format(($nowCount+$prevCount)/($hotel->SalePossibilitySum*1)*100);
                                    }
                                    $html='현재 호텔의 <span class="font-bold text-black">';
                                    if($percent <= 50){
                                        $html.= 50+($hotel->id % 10).'%';
                                    }elseif($percent >= 97){
                                        $html.= '97%';
                                    }else{
                                        $html.=$percent.'%';
                                    }
                                    $html.='</span> 입주 완료되었습니다!';
                                    $data .= '<div>'.$hotel->option->title;
                                    if($hotel->curator === 'Y'){
                                        $data .= ' [큐레이터]';
                                    }
                                    $data .='<div>- 가능수: '.$hotel->SalePossibilitySum.'/입주수: '.$nowCount.'/예정: '.$prevCount.' = '.$percent .'%</div>'
                                    .'<div>'.$html.'</div>'
                                    .'</div>';
                                }
                            @endphp
                            <div>
                                호텔별 입주율
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                {!! $data !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
