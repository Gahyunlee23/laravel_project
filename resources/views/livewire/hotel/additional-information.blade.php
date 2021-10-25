<div class="bottomAdditionalInformation fixed left-0 bottom-0 w-full z-50" x-data="{ show : '{{$show}}'}">

    <div>
        @isset($room)
            @php
                $room_options = \Illuminate\Support\Str::of($room->room_option)->explode(',')->filter(function ($item){
                    return $item ?? null;
                });
                $room_upgrades = \Illuminate\Support\Str::of($room->room_upgrade)->explode(',')->filter(function ($item){
                    return $item ?? null;
                });
            @endphp
            @if($room_upgrades->isNotEmpty() || $room->coupon)
                <div x-show="show" x-cloak
                     x-transition:enter="transition ease-in duration-200"
                     x-transition:enter-start="transform opacity-50 translate-y-2"
                     x-transition:enter-end="transform translate-y-0"

                     x-transition:leave="transition ease-out duration-500"
                     x-transition:leave-start="transform opacity-50 translate-y-1"
                     x-transition:leave-end="transform opacity-0 translate-y-2">
                    <div class="w-full">
                        @if($room_upgrades->isNotEmpty())
                            <div class="w-full h-16"
                                 style="background-image: linear-gradient(to right, #EDEDED, #bfbcb9 100%);">
                                <div class="w-full h-full max-w-1200 mx-auto px-4 flex items-center">
                                    <div class="PtSerif italic text-lg sm:text-xl text-tm-c-30373F">Room Upgrade</div>
                                    <div class="ml-auto flex items-center space-x-1 sm:space-x-4">

                                        <div class="text-center relative px-3 py-px sm:py-1 bg-white rounded-full"
                                             data-index="{{$room_options}}">
                                            @foreach ($room_options as $room_option)
                                                {{--                                                @continue(empty($room_upgrades[$loop->index])||$room_upgrades[$loop->index] === 1)--}}
                                                @if($loop->index >= 1)
                                                    @continue(Str::of(\App\HotelRoomType::find($room_options[$loop->index-1])->name)->before(' ')==Str::of(\App\HotelRoomType::find($room_option)->name)->before(' '))
                                                @endif
                                                <span
                                                    class="AppSdGothicNeoR text-tm-c-30373F text-sm sm:text-base leading-tight whitespace-nowrap"
                                                    data-index="{{$room_option}}">
                                                    @if($loop->index >= 1)/@endif
                                                    {{ Str::of(\App\HotelRoomType::find($room_option)->name)->before(' ') }}
                                                </span>
                                            @endforeach
                                        </div>

                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 sm:w-7 h-3 sm:h-5"
                                                 viewBox="0 0 32 32">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <path stroke="#30373F" stroke-width="2"
                                                                      d="M3 9L16 23 29 9"
                                                                      transform="translate(-1294 -1263) translate(1 1207) rotate(-90 690.5 -602.5)"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>

                                        @php $orCount=0; @endphp
                                        <div
                                            class="flex flex-wrap md:flex-nowrap max-w-4xs 2xs:max-w-full justify-center items-center">
                                            @foreach ($room_upgrades as $room_upgrade)
                                                @continue(empty($room_upgrade))
                                                @php $orCount++; @endphp
                                                <div
                                                    class="flex-1 md:flex-0 @if($orCount > 1) pt-1 2xs:pt-0 2xs:pl-1 @endif">
                                                    <div
                                                        class="text-center relative px-3 py-px sm:py-1 bg-white rounded-full">
                                                       <span
                                                           class="AppSdGothicNeoR text-tm-c-30373F text-sm sm:text-base leading-tight whitespace-nowrap">
                                                            {{Str::of(\App\HotelRoomType::find($room_upgrade)->name)}}
                                                       </span>
                                                    </div>
                                                </div>
                                                @if ( ($room_upgrades->count() !== $orCount) &&!empty($room_upgrades[$loop->index+1]) && (!empty($room_upgrades[$loop->index+1]) || !empty($room_upgrades[$loop->index+2])))
                                                    <div class="PtSerif italic px-1 text-tm-c-ED text-xs sm:text-base">
                                                        or
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="w-full">
                        @if($room->coupon)
                            <div class="w-full h-16"
                                 style="background-image: linear-gradient(to right, #c1a485, #9b7956 100%);">
                                <div class="w-full h-full max-w-1200 mx-auto px-4 flex items-center">
                                    <div class="PtSerif italic text-lg sm:text-xl text-tm-c-30373F">Coupon</div>
                                    <div
                                        class="JeJuMyeongJo ml-auto text-sm sm:text-base text-white">{{$room->coupon}}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endisset

        {{-- 9~(16)=15 까지 설정--}}
        @if(isset($hotel->id) && $hotel->id !==null)
            <div class="w-full z-40">
                <div class="w-full py-1"
                     style="height: 80px; background-image: linear-gradient(to right, #0d5e49 0%, #073d2f 100%);">
                    <div class="w-full h-full max-w-1200 mx-auto px-4 flex items-center">
                        <div
                            class="AppSdGothicNeoR text-xs 2xs:text-base xs:text-lg sm:text-xl text-tm-c-d7d3cf font-normal leading-tight tracking-wide">
                                @php
                                    $ABTEST = 'A';
                                @endphp
                                <div>
                                    @if($hotel->advantages !== null)
                                        {{ Arr::random($hotel->advantages->toArray())}}
                                    @endif
                                </div>
{{--                            @if( Cookie::get('AB') === 'A' || $hotel->curator === 'Y' || now()->diffInDays($hotel->created_at) <= 14)--}}
{{--                            @elseif(Cookie::get('AB') === 'B')--}}
{{--                                @php--}}
{{--                                    $ABTEST = 'B';--}}
{{--                                    $percent=0;--}}
{{--                                    $checkRoomSoldOut = 0;--}}
{{--                                    $sale_possibility_count = false;--}}
{{--                                    foreach ($hotel->rooms()->where('disable', 'N')->where('visible', '1')->get() as $room){--}}
{{--                                        if($room->room_option === $room->room_sold_out){--}}
{{--                                            $checkRoomSoldOut++;--}}
{{--                                        }--}}
{{--                                    }--}}

{{--                                    foreach ($hotel->roomTypes()->where('visible', '1')->get() as $roomType){--}}
{{--                                        if($roomType->sale_possibility_count > 0){--}}
{{--                                            $sale_possibility_count= true;--}}
{{--                                        }--}}
{{--                                    }--}}

{{--                                    if($checkRoomSoldOut === $hotel->rooms()->where('disable', 'N')->where('visible', '1')->count()){--}}
{{--                                    	$percent = 100;--}}
{{--                                    }else{--}}
{{--                                        $nowCount = \App\HotelReservation::where('hotel_id','=',$hotel->id)->where('type','=','month')->whereOrderStatus(5)->whereHas('confirmation', function ($query) {--}}
{{--                                                $query->where('start_dt', '<=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'));--}}
{{--                                                $query->where('end_dt', '>=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'));--}}
{{--                                        })->get()->count()+10;--}}
{{--                                        $prevCount = \App\HotelReservation::where('hotel_id','=',$hotel->id)->where('type','=','month')--}}
{{--                                            ->where(function ($query){--}}
{{--                                                $query->where('order_status','=',3)--}}
{{--                                                    ->orWhere('order_status','=',4)--}}
{{--                                                    ->orWhere('order_status','=',5);--}}
{{--                                            })->whereHas('confirmation', function ($query) {--}}
{{--                                                $query->where('start_dt', '>=', \Carbon\Carbon::now()->format('Y-m-d H:i:s'));--}}
{{--                                        })->get()->count();--}}
{{--                                        if($nowCount!==0 &&$hotel->SalePossibilitySum!==0){--}}
{{--                                            $percent = number_format(($nowCount+$prevCount)/($hotel->SalePossibilitySum*1)*100);--}}
{{--                                        }--}}
{{--                                    }--}}

{{--                                @endphp--}}
{{--                                @if($checkRoomSoldOut === $hotel->rooms()->where('disable', 'N')->where('visible', '1')->count() || !$sale_possibility_count)--}}
{{--                                    <div>현재 호텔의 <span class="font-bold text-white">100%</span> 입주 완료되었습니다!</div>--}}
{{--                                @else--}}
{{--                                    <div>현재 호텔의 <span class="font-bold text-white">@if($percent <= 50){{ 50 + ($hotel->id % 10) }}%@elseif($percent >= 97)97%@else{{$percent}}%@endif</span> 입주 완료되었습니다!</div>--}}
{{--                                @endif--}}
{{--                            @endif--}}
                        </div>
                        <div
                            class="w-8/12 2xs:w-full max-w-3xs sm:max-w-2xs sm:max-w-xs ml-auto flex items-center pl-4">
                            @if($dev)
                                <div x-show="!show" x-cloak
                                     class="flex justify-center items-center w-full h-12 sm:h-16 px-0 sm:px-2 md:px-6 bg-tm-c-ED hover:bg-tm-c-d7d3cf shadow-sm rounded-sm cursor-pointer"
                                     onclick="GA_event('호텔_상세_결제폼_바로가기_클릭',[{{$hotel->id}},'{{$ABTEST ?? ''}}']);windowScrollMove();">
                                    <a
                                        class="w-max-content AppSdGothicNeoR text-base 3xs:text-lg xs:text-xl text-tm-c-30373F font-medium break-words">
                                        호텔에삶 입주하기
                                    </a>
                                </div>
                                <div x-show="show" x-cloak
                                     class="flex justify-center items-center w-full h-12 sm:h-16 px-1 3xs:px-3 2xs:px-4 xs:px-6 sm:px-12 bg-tm-c-C1A485 hover:bg-tm-c-897763 shadow-sm rounded-sm cursor-pointer">
                                    <form method="POST" class="w-full" action="{{ route('hotel.reservation.order',['hotel'=>$hotel->id]) }}">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="type" value="{{$reservation_type}}">
                                        <input type="hidden" name="room">
                                        <button
                                            class="flex justify-center items-center w-full h-12 sm:h-16 px-1 3xs:px-3 2xs:px-4 xs:px-6 sm:px-12 shadow-sm rounded-sm cursor-pointer focus:outline-none">
                                            <div
                                                class="w-max-content AppSdGothicNeoR text-base 3xs:text-lg xs:text-xl text-white font-medium">
                                                @if($reservation_type === 'tour')
                                                    투어 신청하기
                                                @elseif($reservation_type === 'month')
                                                    결제하기
                                                @endif
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <button x-show="!show" x-cloak
                                     class="flex justify-center items-center w-full h-12 sm:h-16 px-0 sm:px-2 md:px-6 bg-tm-c-ED shadow-sm rounded-sm cursor-pointer focus:outline-none"
                                     onclick="GA_event('호텔_상세_결제폼_바로가기_클릭',[{{$hotel->id}},'{{$ABTEST ?? ''}}']);windowScrollMove();">
                                    <div
                                        class="w-max-content AppSdGothicNeoR text-base 3xs:text-lg xs:text-xl text-tm-c-30373F font-medium break-words">
                                        {{--@if($hotel_id == 92 || $hotel_id == 93 || $hotel_id == 100)
                                            쿠폰 적용하기
                                        @else
                                            호텔에삶 입주하기
                                        @endif--}}
                                        호텔에삶 입주하기
                                    </div>
                                </button>
                                <button x-show="show" x-cloak
                                     class="flex justify-center items-center w-full h-12 sm:h-16 px-1 3xs:px-3 2xs:px-4 xs:px-6 sm:px-12 bg-tm-c-C1A485 shadow-sm rounded-sm cursor-pointer focus:outline-none"
                                     onclick="GA_event('호텔_상세_주문시작_클릭',[{{$hotel->id}},'{{$reservation_type ?? ''}}','{{$ABTEST ?? ''}}']);choseOption();dailyLifeContainerOffset();">
                                    <div
                                        class="w-max-content AppSdGothicNeoR text-base 3xs:text-lg xs:text-xl text-white font-medium">
                                        @if($reservation_type === 'tour')
                                            투어 신청하기
                                        @elseif($reservation_type === 'month')
                                            결제하기
                                        @endif
                                    </div>
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
{{--
<div class="flex justify-start ml-6 sm:ml-0 sm:justify-center">
    <div class="bottomAdditionalInformationClose flex justify-center items-center px-8 sm:px-10 pb-2 pt-3 sm:py-3 space-x-2"
        @if($width>=640)
            @if($room_upgrades->isNotEmpty() && $room->coupon)
                onclick="$('.bottomAdditionalInformation').stop().slideUp('slow');$('.room_image').animate({'opacity':'0'},1000);"
            @else
                onclick="$('.bottomAdditionalInformation').stop().slideUp('slow');$('.room_image').animate({'opacity':'0'},1000);"
            @endif
        @else
            @if($room_upgrades->isNotEmpty() && $room->coupon)
                onclick="$('.bottomAdditionalInformation').stop().slideUp('slow');$('.room_image').animate({'opacity':'0'},1000);"
            @else
                onclick="$('.bottomAdditionalInformation').stop().slideUp('slow');$('.room_image').animate({'opacity':'0'},1000);"
            @endif
        @endif
         style="border-top-left-radius: 10px;border-top-right-radius: 10px;
         @if($room_upgrades->isNotEmpty()) @if($width>=640) background-image: linear-gradient(to right, #0a4e3c, #0a4a3a); @else background-image: linear-gradient(to right, #0c5945, #0c5744); @endif
         @else @if($width>=640) background-image: linear-gradient(to right, #af8f6e, #aa8a69);@else background-image: linear-gradient(to right, #bc9e7f, #ba9c7c);@endif @endif">

        <div class="AppSdGothicNeoR text-base sm:text-lg text-white">닫기</div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12">
                <g fill="none" fill-rule="evenodd">
                    <g stroke="#EDEDED" stroke-width="2">
                        <g>
                            <path d="M968 17.366L976.813 26 986 17" transform="translate(-968 -1223) translate(1 1207)"/>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>
--}}
<script>
    var timer = true;
    $(window).resize(function () {
        if (timer) {
            timer = false;
            setTimeout(function () {
                Livewire.emit('bodyOffsetWidthEvent', document.body.offsetWidth);
                timer = true;
            }, 300);
        }
    });


    @if($dev)
    function choseOption() {
        var formData = new FormData();
        if( hotel_type === 'month' && (room_id ==='' || room_id ===undefined)){
            alert('룸 선택 정보가 없거나,\n모든 룸 옵션 Sold Out 입니다.\n문의는 고객센터(1599-4330)로 연락주세요.');
            return false;
        }
        if( hotel_type === 'month' && order_sale_price === 0){
            alert('별도 문의가 필요한 옵션입니다.\n\'가격 문의하기\' 버튼을 통해 문의사항을 남겨주시면,\n호텔에삶 담당 매니저와 연결됩니다.');
            return false;
        }

        Livewire.emit('roomOptionSelectSetHotelEvent',hotel_id);
        Livewire.emit('roomOptionSelectSetHotelRoomEvent',room_id);
        Livewire.emit('roomOptionSelectSetDataEvent','hotel_type',hotel_type);

        formData.append('hotel_id', hotel_id);
        formData.append('order_id', order_id);
        formData.append('room_id', room_id);
        formData.append('type', hotel_type);
        formData.append('order_price', order_price);
        formData.append('order_sale_price', order_sale_price);
        formData.append('order_discount_rate', order_discount_rate);
        formData.append('order_refund_amount', order_refund_amount);
        formData.append('order_sale_url', order_sale_url);

        setTimeout(function(){
            if (hotel_id !== null) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route('hotel.order') }}',
                    data: formData,
                    dataType: 'json',
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        //console.log(data);
                        if (data.status === 'success') {
                            Livewire.emit('clear',0);
                            GA_event('product_호텔 주문 진행중', [
                                hotel_type,
                                hotel_id
                            ]);
                            reservation_id = data.reservation.id;
                            hotelListsSwiper.slideTo(2);
                            $('.optionChoseBtn').addClass('hidden');
                            $('.reservation').html('<div>' + data.reservation.order_sale_url + '</div>');
                            //console.log(reservation_id,data.reservation);
                        }
                    },
                    error: function (data) {

                    }
                });
            }
        },500);
    }
    @endif
</script>
