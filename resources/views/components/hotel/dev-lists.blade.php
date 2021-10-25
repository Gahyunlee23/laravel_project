<style type="text/css">
    .placeholder-tm-c-979b9f::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.3);
        font-family: 'AppleSDGothicNeoR', 'NanumSquare', sans-serif;
    }

    .placeholder-tm-c-979b9f:-ms-input-placeholder {
        color: rgba(255, 255, 255, 0.3);
        font-family: 'AppleSDGothicNeoR', 'NanumSquare', sans-serif;
    }

    .placeholder-tm-c-979b9f::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.3);
        font-family: 'AppleSDGothicNeoR', 'NanumSquare', sans-serif;
    }

    .placeholder-tm-c-979b9f:-ms-input-placeholder {
        color: rgba(255, 255, 255, 0.3);
        font-family: 'AppleSDGothicNeoR', 'NanumSquare', sans-serif;
    }

</style>
@php
    $apple_mAgent = array("iPhone","iphone", "iPod", "ipad");
    $android_mAgent = array("Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony");
    $android_chkMobile = false;
    $apple_chkMobile = false;
    $mobile_chk = false;
    for ($i = 0,$iMax = sizeof($android_mAgent); $i < $iMax; $i++) {
        if (stripos($_SERVER['HTTP_USER_AGENT'], $android_mAgent[$i])) {
            $android_chkMobile = true;
            $mobile_chk = true;
            break;
        }
    }

    for ($i = 0,$iMax = sizeof($apple_mAgent); $i < $iMax; $i++) {
        if (stripos($_SERVER['HTTP_USER_AGENT'], $apple_mAgent[$i])) {
            $apple_chkMobile = true;
            $mobile_chk = true;
            break;
        }
    }
@endphp
<div x-data="{ payment_method : 'credit-card' }">
    <div>
        <div  id="hotelListsContainer" class="hotelListsContainer hotel-lists-swiper-container mt-10 overflow-visible">
            <div class="swiper-wrapper">

                <div class="swiper-slide hidden" data-progress="1">
                    <div class="space-y-3 sm:space-y-5">
                        @foreach($hotels as $index=>$hotel)
                            @php
                                $mainImage=Str::of($hotel->images[0]->images)->explode('|')[0];
                            @endphp
                            <div class="hotel_items cursor-pointer rounded-sm @if($index===0) on @endif"
                                 data-index="{{$index}}" data-hotel-id="{{$hotel->id}}"
                                 @if($index===0) style="outline: 1px solid #ffffff;" @endif>
                                <div class="border-px border-solid shadow-lg rounded-sm"
                                     style="background: url('{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$mainImage)}}') no-repeat center center;
                                         background-size: cover;
                                         border-color:#d7d3cf;">
                                    <div
                                        style="background: linear-gradient(to right, rgba(63, 55, 48, 0.8), rgba(63, 55, 48, 0.1));">
                                        <div
                                            class="pt-4 pb-6 sm:pt-6 sm:pb-10 md:pt-10 md:pb-18 px-4 sm:px-6 md:px-10 hover:bg-tm-c-C1A485 hover:bg-opacity-40">
                                            <div class="flex"
                                                 onclick="$(this).children('img.ic_check').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg');">
                                                <div class="sm:pb-3 md:pb-5 space-y-2 sm:space-y-4">
                                                    <div class="JeJuMyeongJo text-white text-xl sm:text-2xl md:text-4xl">
                                                        {{$hotel->options[0]->title}}
                                                    </div>
                                                    <div class="PtSerif italic text-white text-xs md:text-xl lg:text-2xl">
                                                        {{$hotel->options[0]->title_en}}
                                                    </div>
                                                </div>

                                                <div class="ml-auto">
                                                    <img
                                                        @if($index===0)
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                        @else
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                        @endif
                                                        class="ic_check w-6 sm:w-8 md:w-10 @if($index===0) on @endif"
                                                        data-index="{{$index}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        <div class="hotel_items not">
                            <div class="py-5 sm:py-8 md:py-16 px-3 sm:px-8 border-px border-solid shadow-lg rounded-sm"
                                 style="
                 background-image: linear-gradient(to right, rgba(98, 76, 56, 0.7), rgba(68, 62, 56, 0));
                 background-color: #30373f;
                     background-size: cover;
                     border-color:#d7d3cf;">
                                <div class="sm:pb-3 md:pb-5 space-y-1 sm:space-y-2">
                                    <div class="PtSerif italic text-white text-xl sm:text-2xl md:text-4xl">
                                        Next hotel is…
                                    </div>
                                    <div class="PtSerif italic text-white text-base md:text-xl">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide hidden" data-progress="2">
                    <div class="my-4">
                        <div class="rooms_container lg:space-x-4 space-y-3 lg:space-y-0 lg:flex lg:justify-center">

                            <div class="hotel_month lg:w-1/2" style="outline: 4px solid #c1a485;">
                                <div class="p-2 pb-4 bg-tm-c-ED h-full">
                                    <div class="flex items-center py-3 sm:py-4 px-4">
                                        <div class="JeJuMyeongJo text-tm-c-30373F text-2xl sm:text-3xl py-3 sm:font-medium">
                                            호텔에서 한달살기
                                        </div>
                                        <div class="ml-auto">
                                            <img
                                                src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                class="room_ic_check sm:w-12 on" data-index="1" alt="">
                                        </div>
                                    </div>
                                    <div class="px-3">
                                        <div class="w-full h-px bg-tm-c-30373F"></div>
                                    </div>

                                    <div class="mt-4 sm:mt-8">
                                        <div class="AppSdGothicNeoR text-tm-c-0D5E49 whitespace-pre-line pb-12 pl-3">
                                            <span class="font-bold text-base sm:text-xl">꼭 읽어주세요!</span><br>
                                            <span class="leading-7 text-sm sm:text-base">{!! $hotel->options[0]->sub_explanation !!}</span>
                                        </div>

                                    </div>


                                    <div class="rooms_lists space-y-2 px-2"> </div>
                                </div>
                            </div>



                            <div class=" lg:w-1/2" x-bind:class="{
                                'relative' : '{{$hotel->lockHotelTour()}}',
                                'hotel_tour' : '{{!$hotel->lockHotelTour()}}'
                            }">
                                @if($hotel->lockHotelTour())
                                    <div class="z-30 w-full h-full absolute top-0 left-0 bg-black bg-opacity-40"></div>
                                @endif
                                <div class="relative p-2 bg-tm-c-ED h-full">
                                    <div class="flex items-center py-3 sm:py-4 px-4">
                                        <div class="JeJuMyeongJo text-tm-c-30373F text-2xl sm:text-3xl py-3 sm:font-medium">
                                            호텔 투어
                                        </div>
                                        <div class="ml-auto">
                                            <img
                                                src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                class="room_ic_check sm:w-12" data-index="0" alt="">
                                        </div>
                                    </div>
                                    <div class="px-3">
                                        <div class="w-full h-px bg-tm-c-30373F"></div>
                                    </div>
                                    <div class="px-2">
                                        <div class="mt-4 sm:mt-8">
                                            <div class="AppSdGothicNeoR text-tm-c-0D5E49 whitespace-pre-line pb-12 pl-3">
                                                <span class="font-bold text-base sm:text-xl">호텔 투어란?</span><br>
                                                <span class="leading-7 text-sm sm:text-base">호텔에 입주하기 전에 미리 호텔 객실과 편의시설,
                                                    위치 등의 사항을 20분 내외로 미리 살펴보는 제도입니다.

                                                    투어 후에 입주 결정을 천천히 해주시면 됩니다.
                                                    부담 없이 ‘호텔에삶’을 간접 체험해보세요.</span>
                                            </div>
                                        </div>
                                        {{--                                        <div class="AppSdGothicNeoR text-tm-c-0D5E49 text-sm sm:text-base whitespace-pre-line pb-10">--}}
                                        {{--                                        <span class="font-bold text-base sm:text-xl"></span><br>--}}
                                        {{--                                            <span class="leading-7">호텔에 입주하기 전에 미리 호텔 객실과 편의시설,--}}
                                        {{--                                            위치 등의 사항을 20분 내외로 미리 살펴보는 제도입니다.--}}

                                        {{--                                            투어 후에 입주 결정을 천천히 해주시면 됩니다.--}}
                                        {{--                                            부담 없이 ‘호텔에삶’을 간접 체험해보세요.</span>--}}
                                        {{--                                        </div>--}}
                                        <div class="pb-3 AppSdGothicNeoR text-left text-sm sm:text-base whitespace-pre-line" style="color: #7B7F84;">
                                            * 사전 투어 예약 없이 호텔 방문 시, 호텔 투어 진행이 어렵습니다.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="swiper-slide hidden px-2 xs:px-12 sm:px-20 md:px-28 lg:px-48" data-progress="3">
                    <div class="my-4">
                        <form name="orderForm" id="orderForm" action="" method="POST">
                            @csrf
                            @method('POST')
                            @if(isset($curatorId)&&$curatorId!==''&&$curatorId)
                                <input type="hidden" name="curator_id" value="{{$curatorId}}">
                            @endif

                            <div class="space-y-6 sm:space-y-8">
                                <div class="space-y-2 sm:space-y-3">
                                    <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                        이름
                                    </div>
                                    <div class="relative block">
                                        <input type="text" name="order_name" data-target="name-delete-incorrect"
                                               class="input_delete_incorrect order_name w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid rounded-sm"
                                               placeholder="이름을 입력해주세요." maxlength="50" @auth value="{{auth()->user()->name ?? ''}}" @endauth
                                               autocomplete="off" style="z-index:-1;border-color:#d7d3cf;">
                                        <div class="mt-2 text-white">실명으로 입력해 주셔야 호텔 입주 시 빠른 안내가 가능합니다.</div>
                                        <div
                                            class="name-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-5 mt-3"
                                            data-target="order_name">
                                            <img
                                                src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                                                class="cursor-pointer" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2 sm:space-y-3">
                                    <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                        휴대전화 번호
                                    </div>
                                    <livewire:form.input.hand-phone></livewire:form.input.hand-phone>
                                </div>

                                <div class="space-y-2 sm:space-y-3">
                                    <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                        이메일
                                    </div>
                                    <div class="relative block">
                                        <input type="email" name="order_email" data-target="email-delete-incorrect"
                                               class="input_delete_incorrect order_email w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid rounded-sm"
                                               placeholder="이메일을 입력해주세요."
                                               onkeydown="emailCheck(this)" maxlength="50" @auth
                                               value="{{auth()->user()->email ?? ''}}"
                                               @endauth
                                               autocomplete="off" style="z-index:-1;border-color:#d7d3cf;">
                                        <div
                                            class="email-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-5 mt-3"
                                            data-target="order_email">
                                            <img
                                                src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                                                class="cursor-pointer" alt="">
                                        </div>

                                    </div>
                                </div>

                                <div>
                                    @livewire('hotel.room-option-select')
                                </div>

                                <div class="desired_date_container space-y-2 sm:space-y-3">
                                    <div
                                        class="desired_date_title text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                        투어 희망 날짜
                                    </div>
                                    <div class="relative block">
                                        <input type="text" name="order_desired_dt" id="order_desired_dt_datepicker" data-target="desired-delete-incorrect" readonly
                                               class="input_delete_incorrect order_desired_dt w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid rounded-sm"
                                               placeholder="{{ \Carbon\Carbon::today()->addDays(2)->format('Y/m/d') }}"
                                               autocomplete="off" style="z-index:-1;border-color:#d7d3cf;">
                                        <div
                                            class="desired-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-5 mt-3"
                                            data-target="order_desired_dt">
                                            <img
                                                src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                                                class="cursor-pointer" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="desired_time_container space-y-2 sm:space-y-3">
                                    <div
                                        class="desired_time_title text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                        투어 희망 시간
                                    </div>
                                    @php
                                        $limitStartDate=Str::of(\App\Hotel::find($hotel->id)->tour_start)->explode(':');
                                        $limitEndDate=Str::of(\App\Hotel::find($hotel->id)->tour_end)->explode(':');
                                    @endphp
                                    <div class="relative block">
                                        <div class="flex flex-wrap space-x-2">
                                            <div class="flex-1">
                                                <div class="flex justify-center items-center bg-tm-c-30373F border-2 px-1 sm:px-2 border-solid rounded-sm">
                                                    <div class="w-10/12 py-2">
                                                        <select name="time_hour" id="time_hour" data-index="1"
                                                                onfocus="$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png');"
                                                                onmouseover="if($(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png')}"
                                                                onchange="timeChecker('{{$limitStartDate}}','{{$limitEndDate}}');$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png');$(this).blur();"
                                                                onmouseout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                                                onfocusout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                                                class="appearance-none relative focus:outline-none placeholder-tm-c-979b9f text-white px-3 sm:px-5 h-10 bg-tm-c-30373F"
                                                                style="width:calc( 100% + 28px );">
                                                            <option value="" disabled selected>시간 선택</option>
                                                            @for ($i = 0; $i <= 24 ; $i++)
                                                                @if($i >= $limitStartDate[0] && $i <= $limitEndDate[0])
                                                                    @if($i < 10)
                                                                        <option value="0{{$i}}">0{{$i}}</option>
                                                                    @else
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endif
                                                                @endif
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="pr-2 z-10 pointer-events-none">
                                                        <img class="time_select w-8 h-8" onclick="$('#time_hour[data-index='+$(this).data('index')+']').focus().trigger('click');" data-index="1"
                                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                                             alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex justify-center items-center bg-tm-c-30373F border-2 px-1 sm:px-2 border-solid rounded-sm">
                                                    <div class="w-10/12 py-2">
                                                        <select disabled name="time_minute" id="time_minute" data-index="2"
                                                                onfocus="$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png');"
                                                                onmouseover="if($(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png')}"
                                                                onchange="$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png');$(this).blur();"
                                                                onmouseout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                                                onfocusout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                                                class="appearance-none relative focus:outline-none placeholder-tm-c-979b9f text-white px-3 sm:px-5 h-10 bg-tm-c-30373F"
                                                                style="width:calc( 100% + 28px );">
                                                            <option value="" disabled selected>분 선택</option>
                                                            @for ($i = 0; $i <= 55 ; $i+=30)
                                                                @if($i < 10)
                                                                    <option value="0{{$i}}">0{{$i}}</option>
                                                                @else
                                                                    <option value="{{$i}}">{{$i}}</option>
                                                                @endif
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="pr-2 z-10 pointer-events-none">
                                                        <img class="time_select w-8 h-8" onclick="$('#time_minute[data-index='+$(this).data('index')+']').focus().trigger('select');" data-index="2"
                                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                                             alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div
                                                class="text-right pt-3 tracking-wide text-white text-sm AppSdGothicNeoR font-semibold">
                                                * 희망 날짜와 확정 날짜는 상이할 수 있습니다.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="purpose_contain space-y-2 sm:space-y-3">
                                    <div
                                        class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                        입주 목적
                                    </div>
                                    <div class="relative block">
                                        <input type="text" name="purpose" id="purpose" placeholder="ex. 인테리어, 여행, 이사, 출장 등"
                                               class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid rounded-sm"
                                               autocomplete="off" maxlength="200" style="z-index:-1;border-color:#d7d3cf;">
                                    </div>
                                </div>
                                <div class="visit_route_contain space-y-2 sm:space-y-3">
                                    <div
                                        class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                        방문 경로
                                    </div>
                                    <div class="relative block">
                                        <input type="text" name="visit_route" id="visit_route" placeholder="ex.네이버, SNS, 카카오톡, 커뮤니티/카페, 지인추천 등"
                                               class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid rounded-sm"
                                               autocomplete="off" maxlength="200" style="z-index:-1;border-color:#d7d3cf;">
                                    </div>
                                </div>

                                @if(auth()->check() && auth()->user()->hasAnyRole('개발'))

                                    {{--<div class="purpose_contain space-y-2 sm:space-y-3">
                                        <div
                                            class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                                            입주 목적
                                        </div>
                                        --}}{{--<div class="space-y-3" x-data="{ check : null }">
                                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                                <label>
                                                    <input type="radio" name="purpose" value="인테리어" class="hidden" x-on:click="check = '인테리어'">
                                                    <div class="w-full h-14 flex justify-between items-center border border-solid border-tm-c-ED rounded-full">
                                                        <div class="w-full AppSdGothicNeoR text-tm-c-ED text-base pl-4">
                                                            인테리어
                                                        </div>

                                                        <div class="w-10 h-10 mr-2 py-1">
                                                            <div class="w-8 h-8 flex items-center justify-center border border-solid rounded-full"
                                                                 x-bind:class="{
                                                                    'border-tm-c-C1A485' : check === '인테리어',
                                                                    'border-white' : check !== '인테리어'
                                                                }">
                                                                <div class="rounded-full transition duration-300"
                                                                     style="width: 18px;height: 18px;"
                                                                     x-bind:class="{
                                                                    'bg-tm-c-C1A485' : check === '인테리어',
                                                                    'bg-tm-c-979b9f' : check !== '인테리어'
                                                                }"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>

                                                <label>
                                                    <input type="radio" name="purpose" value="여행" class="hidden" x-on:click="check = '여행'">
                                                    <div class="w-full h-14 flex justify-between items-center border border-solid border-tm-c-ED rounded-full">
                                                        <div class="w-full AppSdGothicNeoR text-tm-c-ED text-base pl-4">
                                                            여행
                                                        </div>

                                                        <div class="w-10 h-10 mr-2 py-1">
                                                            <div class="w-8 h-8 flex items-center justify-center border border-solid rounded-full"
                                                                 x-bind:class="{
                                                            'border-tm-c-C1A485' : check === '여행',
                                                            'border-white' : check !== '여행'
                                                        }">
                                                                <div class="rounded-full transition duration-300"
                                                                     style="width: 18px;height: 18px;"
                                                                     x-bind:class="{
                                                                    'bg-tm-c-C1A485' : check === '여행',
                                                                    'bg-tm-c-979b9f' : check !== '여행'
                                                                }"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                                <label>
                                                    <input type="radio" name="purpose" value="이사" class="hidden" x-on:click="check = '이사'">
                                                    <div class="w-full h-14 flex justify-between items-center border border-solid border-tm-c-ED rounded-full">
                                                        <div class="w-full AppSdGothicNeoR text-tm-c-ED text-base pl-4">
                                                            이사
                                                        </div>

                                                        <div class="w-10 h-10 mr-2 py-1">
                                                            <div class="w-8 h-8 flex items-center justify-center border border-solid rounded-full"
                                                                 x-bind:class="{
                                                            'border-tm-c-C1A485' : check === '이사',
                                                            'border-white' : check !== '이사'
                                                        }">
                                                                <div class="rounded-full transition duration-300"
                                                                     style="width: 18px;height: 18px;"
                                                                     x-bind:class="{
                                                                    'bg-tm-c-C1A485' : check === '이사',
                                                                    'bg-tm-c-979b9f' : check !== '이사'
                                                                }"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                                <label>
                                                    <input type="radio" name="purpose" value="출장" class="hidden" x-on:click="check = '출장'">
                                                    <div class="w-full h-14 flex justify-between items-center border border-solid border-tm-c-ED rounded-full">
                                                        <div class="w-full AppSdGothicNeoR text-tm-c-ED text-base pl-4">
                                                            출장
                                                        </div>

                                                        <div class="w-10 h-10 mr-2 py-1">
                                                            <div class="w-8 h-8 flex items-center justify-center border border-solid rounded-full"
                                                                 x-bind:class="{
                                                            'border-tm-c-C1A485' : check === '출장',
                                                            'border-white' : check !== '출장'
                                                        }">
                                                                <div class="rounded-full transition duration-300"
                                                                     style="width: 18px;height: 18px;"
                                                                     x-bind:class="{
                                                                    'bg-tm-c-C1A485' : check === '출장',
                                                                    'bg-tm-c-979b9f' : check !== '출장'
                                                                }"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                                <label>
                                                    <input type="radio" name="purpose" value="기타" class="hidden" x-on:click="check = '기타'" x-bind:disabled="">
                                                    <div class="w-full h-14 flex justify-between items-center border border-solid border-tm-c-ED rounded-full">
                                                        <div class="w-full AppSdGothicNeoR text-tm-c-ED text-base pl-4">
                                                            기타
                                                        </div>

                                                        <div class="w-10 h-10 mr-2 py-1">
                                                            <div class="w-8 h-8 flex items-center justify-center border border-solid rounded-full"
                                                                 x-bind:class="{
                                                            'border-tm-c-C1A485' : check === '기타',
                                                            'border-white' : check !== '기타'
                                                        }">
                                                                <div class="rounded-full transition duration-300"
                                                                     style="width: 18px;height: 18px;"
                                                                     x-bind:class="{
                                                                    'bg-tm-c-C1A485' : check === '기타',
                                                                    'bg-tm-c-979b9f w-full h-full' : check !== '기타'
                                                                }"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="relative"
                                                 x-bind:class="{
                                                    'block' : check === '기타',
                                                    'hidden' : check !== '기타'
                                                }">
                                                <input type="text" name="purpose" id="purpose" placeholder="ex. 인테리어, 여행, 이사, 출장 등"
                                                       class="w-full bg-tm-c-30373F placeholder-tm-c-979b9f text-white px-5 py-4 border-2 border-solid rounded-sm"
                                                       autocomplete="off" maxlength="200" style="z-index:-1;border-color:#d7d3cf;"
                                                       x-bind:disabled="check !== '기타'"
                                                >
                                            </div>
                                        </div>--}}{{--

                                    </div>--}}

                                    <div class="flex flex-wrap xs:flex-nowrap space-y-3 xs:space-y-0 space-x-0 xs:space-x-3 sm:space-x-4">
                                        <div class="relative w-full xs:w-1/2 h-28 sm:h-32 md:h-40 border-2 border-solid rounded-sm flex justify-center items-center cursor-pointer"
                                             x-on:click="payment_method='credit-card';"
                                             x-bind:class="{
                                            'border-tm-c-C1A485 text-tm-c-C1A485' : payment_method === 'credit-card',
                                            'border-white text-white' : payment_method !== 'credit-card'
                                        }">
                                            <div class="AppSdGothicNeoR text-lg md:text-xl tracking-wider text-center space-y-1">
                                                <div>신용카드</div>
                                                <div class="text-lg">Credit card</div>
                                            </div>

                                            <div class="absolute top-0 right-0 mt-3 mr-3"
                                                 x-bind:class="{
                                                    'block' : payment_method === 'credit-card',
                                                    'hidden' : payment_method !== 'credit-card'
                                                 }">
                                                <div class="flex justify-center items-center">
                                                    <i class="fas fa-check text-base sm:text-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="relative w-full xs:w-1/2 h-28 sm:h-32 md:h-40 border-2 border-solid rounded-sm flex justify-center items-center cursor-pointer"
                                             x-on:click="payment_method='account-transfer';"
                                             x-bind:class="{
                                            'border-tm-c-C1A485 text-tm-c-C1A485' : payment_method === 'account-transfer',
                                            'border-white text-white' : payment_method !== 'account-transfer'
                                        }">
                                            <div class="AppSdGothicNeoR text-lg md:text-xl tracking-wider text-center space-y-1">
                                                <div>계좌이체</div>
                                                <div class="text-lg">Account transfer</div>
                                            </div>

                                            <div class="absolute top-0 right-0 mt-3 mr-3"
                                                 x-bind:class="{
                                                    'block' : payment_method === 'account-transfer',
                                                    'hidden' : payment_method !== 'account-transfer'
                                                 }">
                                                <div class="flex justify-center items-center">
                                                    <i class="fas fa-check text-base sm:text-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="space-y-2 sm:space-y-3">
                                    <div class="text-white text-lg sm:text-xl AppSdGothicNeoR font-normal">
                                        개인 정보 동의 여부
                                    </div>

                                    <div>
                                        <div class="border-2 border-solid rounded-sm h-full" style="min-height:49px; border-color:#d7d3cf;">
                                            <div class="adv_box px-2" style="z-index: -1;" data-index="0">
                                                <div class="w-full inline-flex items-center text-sm">
                                                    <div class="flex-1">
                                                        <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                            <div class="z-50">
                                                                <img
                                                                    src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                                    class="avg_ic mx-3 w-8 sm:w-9 cursor-pointer"
                                                                    data-index="0" alt="">
                                                            </div>
                                                            <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg"
                                                                 onclick="adv_box($('.adv_box[data-index=0]'));slideHeightControl($('.adv_box[data-index=0]'),$('.swiper-slide[data-progress=3]'));">
                                                                이용약관 및 취소환불 규정 동의 (필수)
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="float-left ml-auto mr-2 cursor-pointer"
                                                         onclick="adv_box($('.adv_box[data-index=0]'));slideHeightControl($('.adv_box[data-index=0]'),$('.swiper-slide[data-progress=3]'));">
                                                        <img class="avg_ic2 w-8 h-8" data-index="0"
                                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                                             alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="adv_box_content hidden h-42 overflow-y-scroll border-t-2 border-solid"
                                                style="border-color:#d7d3cf;" data-index="0">
                                                <div class="">
                                                    <div class="py-6 px-2">
                                                <span class="AppSdGothicNeoR text-white text-base leading-7">
                                                    @livewire('operating-terms')
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-2 border-solid rounded-sm h-full" style="min-height:49px; border-color:#d7d3cf;">
                                            <div class="adv_box px-2" style="z-index: -1;" data-index="1">
                                                <div class="w-full inline-flex items-center text-sm">
                                                    <div class="flex-1">
                                                        <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                            <div class="z-50">
                                                                <img
                                                                    src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                                    class="avg_ic mx-3 w-8 sm:w-9 cursor-pointer"
                                                                    data-index="1" alt="">
                                                            </div>
                                                            <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg"
                                                                 onclick="adv_box($('.adv_box[data-index=1]'));slideHeightControl($('.adv_box[data-index=1]'),$('.swiper-slide[data-progress=3]'));">
                                                                개인정보 수집 및 활용 동의 (필수)
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="float-left ml-auto mr-2 cursor-pointer"
                                                         onclick="adv_box($('.adv_box[data-index=1]'));slideHeightControl($('.adv_box[data-index=1]'),$('.swiper-slide[data-progress=3]'));">
                                                        <img class="avg_ic2 w-8 h-8" data-index="1"
                                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                                             alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="adv_box_content hidden h-42 overflow-y-scroll border-t-2 border-solid"
                                                style="border-color:#d7d3cf;"
                                                data-index="1" {{--v-show="open" @click.away="open = false"--}}>
                                                <div class="">
                                                    <div class="py-6 px-2">
                                                <span class="AppSdGothicNeoR text-white text-base leading-7">
                                                    @livewire('privacy')
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-2 border-solid rounded-sm h-full" style="min-height:49px; border-color:#d7d3cf;">
                                            <div class="adv_box px-2" style="z-index: -1;" data-index="2">
                                                <div class="w-full inline-flex items-center text-sm">
                                                    <div class="flex-1">
                                                        <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                            <div class="z-50">
                                                                <img
                                                                    src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                                    class="avg_ic mx-3 w-8 sm:w-9 cursor-pointer"
                                                                    data-index="2" alt="">
                                                            </div>
                                                            <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg"
                                                                 onclick="$('.avg_ic[data-index=2]').trigger('click');">
                                                                마케팅 수신 동의 (선택)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm text-white AppSdGothicNeoR">
                                        * 비회원 결제 시 알림톡으로 결제 내역 확인 가능한 정보를 전달드립니다.
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="pt-16 flex flex-wrap sm:justify-center space-y-1 sm:space-x-2">

        <div class="w-full sm:w-2/5 sm:max-w-md prevBtn hidden order-2 sm:order-1">
            <div class="w-full h-full cursor-pointer sm:flex sm:justify-center sm:items-center border-2 border-solid border-tm-c-C1A485
        hover:shadow-lg primary-inset-border active:border-tm-c-635749 text-tm-c-C1A485 active:text-tm-c-635749"
                 style="height: calc( 100% - 4px );margin-top: 5px;"
                 onclick="prevToSlide()">
                <div class="w-full py-5 sm:py-0 rounded-sm">
                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-center">
                        이전으로 돌아가기
                    </div>
                </div>
            </div>
        </div>

        <div class="hotelChoseBtn w-full sm:w-3/5 sm:max-w-md order-1 sm:order-2 hidden">
            <div class="w-full sm:flex sm:justify-center">
                <div class="w-full bg-tm-c-C1A485 cursor-pointer py-5 sm:py-7 rounded-sm
        hover:shadow-lg
        primary-inset-border active:bg-tm-c-897763"
                     onclick="choseHotel();dailyLifeContainerOffset();">
                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                        투어 신청하기 / 결제하기
                    </div>
                </div>
            </div>
        </div>

        {{--    <div class="optionChoseBtn w-full h-full sm:w-2/5 sm:max-w-md hidden order-1 sm:order-2 pb-1">--}}
        {{--        <div class="w-full sm:flex sm:justify-center">--}}
        {{--            <div class="w-full bg-tm-c-C1A485 py-5 sm:py-7 rounded-sm cursor-pointer--}}
        {{--        hover:shadow-lg--}}
        {{--        primary-inset-border active:bg-tm-c-897763"--}}
        {{--                 onclick="choseOption();dailyLifeContainerOffset();">--}}
        {{--                <div class="btnName AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">--}}
        {{--                    투어 신청하기--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        <div class="reservationsChoseBtn w-full sm:w-2/5 sm:max-w-md hidden order-1 sm:order-2">
            <div class="w-full sm:flex sm:justify-center">
                <div class="reservationsChoseBtnAction w-full bg-tm-c-C1A485 py-5 sm:py-7 rounded-sm cursor-pointer
        hover:shadow-lg
        primary-inset-border active:bg-tm-c-897763"
                     x-bind:data-payment-method="payment_method"
                     onclick="reservations();">
                    <div class="reservationsChoseBtnText AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                        투어 신청하기
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@livewire('hotel.additional-information',['hotel'=>$hotel])

@php
    $hotelTourTermDisabledDay = collect();
    $hotelLivingTermDisabledDay = collect();
        foreach ($hotel->terms->where('type','=','0') as $term){
            foreach ($term->between_date as $item){
                $hotelTourTermDisabledDay->push($item);
            }
        }
        foreach ($hotel->terms->where('type','=','1') as $term){
            foreach ($term->between_date as $item){
                $hotelLivingTermDisabledDay->push($item);
            }
        }
@endphp
<style>
    .ui-datepicker-header.ui-widget-header.ui-helper-clearfix.ui-corner-all{
        background: #dabc9b;
    }
    .ui-datepicker-next.ui-corner-all,.ui-datepicker-prev.ui-corner-all{
        top:6px !important;background: #897763;
    }
    .ui-datepicker-title{
        color: #ffffff;
    }
    .ui-datepicker-year,.ui-datepicker-month{
        color: #000000;
        appearance: none; border: 0px;border-radius: 4px; padding: 0.1rem 0.4rem;
    }
</style>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    let hotelListsSwiper = null;
    var hotel_id = '';
    var hotel_type = 'month';
    var order_id = '{{mt_rand(1000,9999)}}';
    var room_id = '';
    var room_type_id = '';
    var room_type_upgrade_id = '';
    var order_price = '';
    var order_sale_price = '';
    var order_discount_rate = '';
    var order_refund_amount = '';
    var order_sale_url = '';
    var reservation_id = '';

    var hotelListsContainerScrollCheck=true;

    window.addEventListener('room-type-select-id', event => {
        room_type_id = event.detail.roomTypeId;
        room_type_upgrade_id = event.detail.roomTypeUpgradeId;
    })
    $(document).ready(function () {
        $('.swiper-slide[data-progress=1]').removeClass('hidden');
        setTimeout(function () {
            $('.swiper-slide:not([data-progress=1])').removeClass('hidden');
            hotelListsSlider();
            setTimeout(function () {
                if ('{{$progress}}' === '2' && '{{$hotelId}}' !== '') {
                    choseHotel();
                }
            }, 50);
        }, 100);

        $(window).scroll( function(){
            hotelListContainerPathChecker();
        });
    });

    function hotelListContainerPathChecker(){
        if(hotelListsContainerScrollCheck){
            hotelListsContainerScrollCheck=false;
            setTimeout(function(){
                /*현재 신청폼 위치 체크 후 livewire event set additional 표기 체크*/
                var target = $('.hotelListsContainer');
                var window_position = $(window).scrollTop() + $(window).height();
                var object_position = target.offset().top;

                if( window_position >= object_position &&  window_position <= (object_position + (target.outerHeight()*2))){
                    //console.log('in1', window_position, object_position, object_bottom_position,(object_position + (target.outerHeight()*2)));
                    Livewire.emit('additionalInformationSendHotelListsContainerPathsEvent', true);
                }else{
                    Livewire.emit('additionalInformationSendHotelListsContainerPathsEvent', false);
                }
                hotelListsContainerScrollCheck=true;
            },100);
        }
    }

    function windowScrollMove(){
        var target = $('.hotelListsContainer');
        $('html, body').stop().animate( { scrollTop : target.offset().top - 20 } );
    }

    $("#order_desired_dt_datepicker").datepicker({
        dateFormat: 'yy/mm/dd',
        prevText: '이전 달',
        nextText: '이전 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        changeMonth: true,
        changeYear: true,
        yearSuffix: '년',
        minDate: "+1D",
        maxDate: "+1Y",
        beforeShowDay: disableDays
    });

    function disableDays(date) {
        var m = (date.getMonth()+1), d = date.getDate(), y = date.getFullYear();
        var disabledDays=null;
        if(hotel_type ==='tour'){
            disabledDays = @json($hotelTourTermDisabledDay);
        }else{
            disabledDays = @json($hotelLivingTermDisabledDay);
        }
        if(m < 10){
            m='0'+m;
        }
        if(d < 10){
            d='0'+d;
        }
        for (i = 0; i < disabledDays.length; i++) {
            if($.inArray(y + '-' +m + '-' + d,disabledDays) !== -1) {
                return [false];
            }
        }
        return [true];
    }

    function emailCheck(email_address) {
        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
        return email_regex.test(email_address);
    }

    var prevToSlide = function () {
        Livewire.emit('clear',0);
        hotelListsSwiper.slidePrev(1200);
    };

    /* 투어 희망 시간 설정 시간 분 처리 기능*/
    function timeChecker(start_arr,end_arr){
        var time_hour = document.getElementById('time_hour');
        var time_minute = document.getElementById('time_minute');
        var start = JSON.parse(start_arr);
        var end = JSON.parse(end_arr);
        for (var i =0; i<time_minute.options.length; i++) {
            time_minute.options[i].disabled = false;
        }

        if(time_hour.options[time_hour.selectedIndex].value === start[0]){
            for (var i =0; i<time_minute.options.length; i++){
                if(time_minute.options[i].value < start[1]){
                    time_minute.options[i].disabled=true;
                }else{
                    if(time_minute.options[0].value===''){
                        time_minute.options[0].disabled=true;
                        time_minute.options[0].selected=true;
                    }else{
                        time_minute.options[i].disabled=false;
                    }
                }
            }
        }
        if(time_hour.options[time_hour.selectedIndex].value === end[0]){
            for (var i =0; i<time_minute.options.length; i++){
                if(time_minute.options[i].value > end[1]){
                    time_minute.options[i].disabled=true;
                }else{
                    if(time_minute.options[0].value===''){
                        time_minute.options[0].disabled=true;
                        time_minute.options[0].selected=true;
                    }else{
                        time_minute.options[i].disabled=false;
                    }
                }
            }
        }
        time_minute.disabled=false;
        time_minute.options[0].innerHTML="분 선택";
    }

    $(".order_hp").on('keydown', function (e) {
        // 숫자만 입력받기
        var trans_num = $(this).val().replace(/-/gi, '');
        var k = e.keyCode;

        if (trans_num.length >= 11 && ((k >= 48 && k <= 126) || (k >= 12592 && k <= 12687 || k === 32 || k === 229 || (k >= 45032 && k <= 55203)))) {
            e.preventDefault();
        }
    }).on('blur', function () { // 포커스를 잃었을때 실행합니다.
        if ($(this).val() === '') return;

        // 기존 번호에서 - 를 삭제합니다.
        var trans_num = $(this).val().replace(/-/gi, '');

        // 입력값이 있을때만 실행합니다.
        if (trans_num != null && trans_num !== '') {
            // 총 핸드폰 자리수는 11글자이거나, 10자여야 합니다.
            if (trans_num.length === 11 || trans_num.length === 10) {
                // 유효성 체크
                //var regExp_ctn = /^(01[016789]{1}|02|1|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
                var regExp_ctn = /^([0-9]{3})([0-9]{3,4})([0-9]{4})$/;
                if (regExp_ctn.test(trans_num)) {
                    // 유효성 체크에 성공하면 하이픈을 넣고 값을 바꿔줍니다.
                    //trans_num = trans_num.replace(/^(01[016789]{1}|02|1|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
                    trans_num = trans_num.replace(/^([0-9]{3})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
                    $(this).val(trans_num);
                } else {
                    alert("유효하지 않은 전화번호 입니다.");
                    $(this).val("");
                    $(this).focus();
                }
            } else {
                alert("유효하지 않은 전화번호 입니다.");
                $(this).val("");
                $(this).focus();
            }
        }
    });

    $(".order_desired_dt").on('keydown', function (e) {
        // 숫자만 입력받기
        var trans_num = $(this).val().replace(/\//gi, '');
        var k = e.keyCode;
        if (trans_num.length >= 11 && ((k >= 48 && k <= 126) || (k >= 12592 && k <= 12687 || k === 32 || k === 229 || (k >= 45032 && k <= 55203)))) {
            e.preventDefault();
        }
    }).on('blur', function () { // 포커스를 잃었을때 실행합니다.
        if ($(this).val() === '') return;
        var $this = $(this);
        var date = $(this).val().split('/');
        // 기존 번호에서 - 를 삭제합니다.
        var trans_num = $(this).val().replace(/\//gi, '');

        // 입력값이 있을때만 실행합니다.
        if (trans_num != null && trans_num !== '') {
            if (trans_num.length === 8) {
                // 유효성 체크
                var regExp_ctn = /^((20)\d{2})(1[0-2]|[1-9]|0[1-9])(3[0-1]|2[0-9]|1[0-9]|0[1-9]|[1-9])$/;
                if (regExp_ctn.test(trans_num)) {

                    var min_temp= new Date();
                    var min_date = new Date(min_temp.getFullYear(),min_temp.getMonth(),min_temp.getDate()+1);

                    var check_date= new Date(date[0],date[1]-1,date[2]);
                    if(!((+min_date)<=(+check_date))){
                        alert('희망 날짜는 오늘 이후로 지정 가능합니다.');
                        $this.val(min_temp.getFullYear()+'/'+(min_temp.getMonth()+1)+'/'+(min_temp.getDate()+1)).focus();
                        return false;
                    }

                    trans_num = trans_num.replace(/(\d{4})(\d{2})(\d{2})/, '$1/$2/$3');
                    $this.val(trans_num);

                } else {
                    alert("유효하지 않은 희망 날짜 입니다.");
                    $this.val('{{\Carbon\Carbon::now()->addDays(1)->format('Y/m/d')}}').focus();

                    return false;
                }
            } else {
                alert("'{{\Carbon\Carbon::now()->addDays(1)->format('Y/m/d')}}' 형식으로 입력해주세요.");
                $this.val('{{\Carbon\Carbon::now()->addDays(1)->format('Y/m/d')}}').focus();

                return false;
            }
        }
    });

    var sold_out_timer = true;
    $(window).resize(function () {
        windowInnerWidth = window.innerWidth;
        //hotelListsSlider();
        if(sold_out_timer){
            sold_out_timer=false;
            setTimeout(function(){
                $('.sold_out_container').each(function (index, item){
                    var thisIndex=$(this).data('index');
                    $('.sold_out_container[data-index='+thisIndex+']').css({
                        'width':$('.room_items[data-index='+thisIndex+']').width() ?? $('.sold_out[data-index='+thisIndex+']').width()+'px',
                        'height':$('.room_items[data-index='+thisIndex+']').height() ?? $('.sold_out[data-index='+thisIndex+']').height()+'px',
                    });
                });
                sold_out_timer=true;
            },100);
        }
        if (hotelListsSwiper.realIndex === 1) {
            $('.hotel-lists-swiper-container').height($('.rooms_container').height());
            setTimeout(function () {
                $('.hotel-lists-swiper-container').height($('.rooms_container').height());
            },200);
        }else if (hotelListsSwiper.realIndex === 2) {
            slideHeightControl('', $('.swiper-slide[data-progress=3]'));
        }
    });

    const adv_box = function ($this) {
        if ($this.hasClass('adv_box')) {
            var index = $($this).data('index');
            if (index !== '' && index !== null) {
                $('.adv_box_content[data-index=' + index + ']').toggleClass('hidden');
            }
        }
    };

    const slideHeightControl = function ($this, $height) {
        setTimeout(function () {
            $('.hotel-lists-swiper-container').stop().css({
                height: $height.height()
            });
            $('.hotel-lists-swiper-container').closest('div').stop().css({
                height: $height.height()
            });
        }, 150);
        setTimeout(function () {
            $('.hotel-lists-swiper-container').stop().css({
                height: $height.height()
            });
            $('.hotel-lists-swiper-container').closest('div').stop().css({
                height: $height.height()
            });
        }, 200);
        setTimeout(function () {
            $('.hotel-lists-swiper-container').stop().css({
                height: $height.height()
            });
            $('.hotel-lists-swiper-container').closest('div').stop().css({
                height: $height.height()
            });
        }, 1000);

        if ($this !== '') {
            $($this).toggleClass('on');
            var ic2 = $('.avg_ic2[data-index=' + $($this).data('index') + ']');
            //console.log($($this).hasClass('on'));
            if (!$($this).hasClass('on')) {
                ic2.toggleClass('on').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png');
            } else {
                ic2.toggleClass('on').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png');
            }
        }
        hotelListContainerPathChecker();
    };

    $(document).on('click', '.delete_incorrect', function () {
        $('.' + $(this).data('target')).val('');
        $(this).addClass('hidden');
    });
    $(document).on('click keyup change', '.input_delete_incorrect', function () {
        deleteIncorrect(this, $(this).data('target'));
    });
    $(document).on('focusout', '.input_delete_incorrect', function () {
        var target = $(this).data('target');
        setTimeout(function () {
            $('.' + target).addClass('hidden');
        }, 100);
    });

    function deleteIncorrect($this, $target) {
        if ($($this).val() !== '' && $($this).val() !== null) {
            $('.' + $target).removeClass('hidden');
        } else {
            $('.' + $target).addClass('hidden');
        }
    }

    const hotelListsSlider = function () {
        hotelListsSwiper = new Swiper('.hotel-lists-swiper-container', {
            autoHeight: true,
            slidesPerView: 1,
            speed: 1200,
            spaceBetween: 3000,
            simulateTouch: false,
            updateOnWindowResize: true,
            touchRatio: 0,
            shortSwipes: false,
            longSwipes: false,
            on: {
                init: function () {
                    setTimeout(function () {
                        if (hotelListsSwiper.realIndex === 0 || hotelListsSwiper.realIndex === 1) {
                            $('.prevBtn').addClass('hidden');
                        }
                    }, 100);
                },
                slideChange: function () {
                    if (hotelListsSwiper.realIndex === 0) {
                        $('.optionChoseBtn').addClass('hidden');
                        $('.reservationsChoseBtn').addClass('hidden');

                        $('.hotel-lists-swiper-container').height('100%');
                        $('.prevBtn').addClass('hidden');
                    } else if (hotelListsSwiper.realIndex === 1) {
                        //hotelListsSwiper.autoHeight=false;
                        $('.optionChoseBtn').removeClass('hidden');
                        $('.reservationsChoseBtn').addClass('hidden');
                        $('.prevBtn').addClass('hidden');
                        slideHeightControl('', $('.rooms_container'));
                    } else if (hotelListsSwiper.realIndex === 2) {
                        $('.optionChoseBtn').addClass('hidden');
                        $('.reservationsChoseBtn').removeClass('hidden');
                        $('.prevBtn').removeClass('hidden');
                        slideHeightControl('', $('.swiper-slide[data-progress=3]'));
                    }else{
                        $('.prevBtn').addClass('hidden');
                    }
                }
            }
        });
    };

    function reservations() {
        //console.log(document.querySelector('.reservationsChoseBtnAction').getAttribute('data-payment-method'));
        /* credit-card account-transfer */
        var method = document.querySelector('.reservationsChoseBtnAction').getAttribute('data-payment-method');
        var form = document.getElementById("orderForm");
        var formData = new FormData($('form#orderForm')[0]);
        var use_terms = $('.avg_ic[data-index=0]').hasClass('on');/*필수 동의*/
        var order_privacy = $('.avg_ic[data-index=1]').hasClass('on');/*필수 동의*/
        var order_marketing = $('.avg_ic[data-index=2]').hasClass('on');/*선택동의*/
        // console.log(formData,form,form.order_name.value);

        console.log(form.purpose.value);
        Livewire.emit('clear',0);

        if (form.order_name.value.length === 0) {
            alert('이름을 입력해주세요.');
            form.order_name.focus();
            return false;
        }
        if (form.order_hp.value.length < 11) {
            alert('휴대전화 번호를 입력해주세요.\n번호 형식: 010-0000-0000');
            form.order_hp.focus();
            return false;
        }
        if (form.certifiedKey.value.length !== 6) {
            alert('휴대전화 문자를 확인 후 인증 문자를 입력해주세요.');
            form.certifiedKey.focus();
            return false;
        }
        if (form.order_email.value.length === 0 || !emailCheck(form.order_email.value)) {
            alert('이메일을 입력해주세요.\n이메일 형식: travelmakerkorea@example.com');
            form.order_email.focus();
            return false;
        }
        if(hotel_type ==='tour'){
            if(form.time_hour.value ==='' || form.time_hour.value===null){
                alert('투어 희망 시간, 분을 알려주세요.');
                return false;
            }
            if(form.time_minute.value ==='' || form.time_minute.value===null){
                alert('투어 희망 시간, 분을 알려주세요.');
                return false;
            }
        }
        if((hotel_type==='' || hotel_type===null)){
            alert('세션이 종료되었습니다.\n다시 주문 신청바랍니다. 감사합니다:)');
            location.reload();
        }
        if(form.order_desired_dt.value.length === 0
            || form.order_desired_dt.value === ''
            || form.order_desired_dt.value === null
            || form.order_desired_dt.value === '{{\Carbon\Carbon::today()->format('Y/m/d')}}' ){
            alert('희망 날짜를 선택해주세요.');
            return false;
        }
        if (form.purpose.value.length === 0) {
            alert('입주 목적을 입력해주세요.');
            form.purpose.focus();
            return false;
        }
        if (form.visit_route.value.length === 0) {
            alert('방문 경로을 입력해주세요.');
            form.visit_route.focus();
            return false;
        }

        if(!use_terms && !order_privacy){
            if(confirm('필수 항목 전체 동의 하시겠습니까?\n항목이 안보이는 경우 다른 기기에서 확인 부탁드립니다.\n필수 동의 항목 - 이용약관 및 취소환불 규정, 개인정보 수집 및 활용 동의')){
                if (!use_terms) {
                    use_terms=true;
                    $('.avg_ic[data-index=0]').addClass('on');
                }
                if (!order_privacy) {
                    order_privacy=true;
                    $('.avg_ic[data-index=1]').addClass('on');
                }
            }else{
                if (!use_terms) {
                    alert('이용약관 및 취소환불 규정 동의 확인 후 체크해주세요!');
                    return false;
                }
                if (!order_privacy) {
                    alert('개인정보 수집 및 활용 동의 확인 후 체크해주세요!');
                    return false;
                }
            }
        }
        $('.reservationsChoseBtnAction').attr('onclick','');

        if (form.certifiedKey.value.length !== 4) {
            formData.append('certifiedKey', form.certifiedKey.value);
        }
        formData.append('hotel_id', hotel_id);
        formData.append('id', reservation_id);
        formData.append('order_id', order_id);
        formData.append('room_id', room_id);
        formData.append('room_type_id', room_type_id);
        formData.append('room_type_upgrade_id', room_type_upgrade_id);
        formData.append('use_terms', use_terms ? 'Y' : 'N');
        formData.append('order_privacy', order_privacy ? 'Y' : 'N');
        formData.append('order_marketing', order_marketing ? 'Y' : 'N');
        formData.append('type', hotel_type);
        formData.append('order_price', order_price);
        formData.append('order_sale_price', order_sale_price);
        formData.append('order_discount_rate', order_discount_rate);
        formData.append('order_refund_amount', order_refund_amount);
        if (hotel_id !== null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ route('hotel.order.completed') }}',
                data: formData,
                dataType: 'json',
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status === 'success') {
                        GA_event('product_투어,예약 완료', [
                            data.reservation.type,
                            data.reservation.hotel_id
                        ]);

                        if (data.reservation.type === 'month') {
                            GA_event('product_호텔 주문 완료', [
                                data.reservation.type,
                                data.reservation.hotel_id
                            ]);

                            var url = '{{ route("payment.order", ['method'=>':method', 'reservation'=>":reservation"]) }}';
                            url = url.replace(':reservation', data.reservation.id).replace(':method', method);
                            //console.log(method);
                            location.href=url;
                        } else if (data.reservation.type === 'tour'){
                            GA_event('product_투어 신청 완료', [
                                data.reservation.type,
                                data.reservation.hotel_id
                            ]);
                            location.href = '{{route('reservations.completed')}}';
                        }
                    }else if (data.status === 'select-date-again') {
                        alert('해당 희망 날짜 현재 블록 상태로 선택이 불가능합니다.\n새로 고침 후 재 신청 부탁드립니다.');
                        location.reload();
                        //$('.reservationsChoseBtnAction').attr('onclick','reservations();');
                    }else{
                        alert('주문을 실패했습니다.\n재시도 부탁드립니다.\n이후 계속 주문 실패 시 관리자에게 연락바랍니다.');
                        location.reload();
                    }

                },
                error: function (data) {
                    alert('주문을 실패했습니다.\n재시도 부탁드립니다.\n이후 계속 주문 실패 시 관리자에게 연락바랍니다!');
                    //$('.reservationsChoseBtnAction').attr('onclick','reservations();');
                    location.reload();
                }
            });
        }
        setTimeout(function (){
            $('.reservationsChoseBtnAction').attr('onclick','reservations();');
        },10000);
    }

    function choseOption() {
        Livewire.emit('clear',0);
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

    function choseHotel() {
        var target = $('.hotel_items.on:not(.not)');
        if ('{{$progress}}' === '2' || (target.data('hotel-id') !== undefined && target.length !== 0)) {
            if ('{{$hotelId}}' !== '') {
                hotel_id = '{{$hotelId}}';
            } else {
                hotel_id = target.data('hotel-id');
            }
            hotelListsSwiper.slideTo(1);
            hotelListsSwiper.autoHeight = true;

            var formData = new FormData();
            formData.append('id', hotel_id);
            setTimeout(function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route('hotel.detail') }}',
                    data: formData,
                    dataType: 'json',
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {

                        if ('{{$hotelId}}' === '') {/*메인에서 실행O 상세에서 실행X*/
                            GA_event('product_호텔 주문 신청', [data.Chotel[0].options[0].title, hotel_id]);
                        }

                        var html = '';
                        for ($i = 0; $i < data.hotel[0].rooms.length; $i++) {
                            var upgrade='';
                            if( data.hotel[0].rooms[$i].room_upgrade !== null && data.hotel[0].rooms[$i].room_upgrade.split(',').filter(function(item){
                                return item !== null && item !== undefined && item !== '';
                            }).length >= 1){
                                if(data.hotel[0].rooms[$i].room_sold_out === null || (data.hotel[0].rooms[$i].room_sold_out !== data.hotel[0].rooms[$i].room_option) ){
                                    upgrade='<div class="float-left pt-1">' +
                                        '<img src="https://d2pyzcqibfhr70.cloudfront.net/resource/product/ic-roomupgrade2.svg" class="h-5 2xs:h-6 sm:h-8" alt="">'
                                        + '</div>';
                                }else{
                                    //console.log(data.hotel[0].rooms[$i].room_sold_out.replaceAll(',',''));
                                    upgrade='<div class="float-left pt-1">' +
                                        '<img src="https://d2pyzcqibfhr70.cloudfront.net/resource/product/ic-un-roomupgrade.svg" class="h-5 2xs:h-6 sm:h-8" alt="">'
                                        + '</div>';
                                }
                            }
                            var nightsDays ='';
                            if((data.hotel[0].rooms[$i].nights !== null && data.hotel[0].rooms[$i].nights !=='' && data.hotel[0].rooms[$i].nights !=='0' && data.hotel[0].rooms[$i].nights !==0)
                                && (data.hotel[0].rooms[$i].days !== null && data.hotel[0].rooms[$i].days !=='' && data.hotel[0].rooms[$i].days !=='0' && data.hotel[0].rooms[$i].days !==0) ){
                                nightsDays='<!--<div class="float-left h-full px-px xs:px-1 sm:px-2 flex justify-center items-center"><div class="w-3 h-px bg-tm-c-30373F"></div></div>-->' +
                                    '<span class="AppSdGothicNeoR font-bold text-base sm:text-lg text-tm-c-0D5E49">&nbsp;('+data.hotel[0].rooms[$i].nights + '박 </span>'+
                                    '<span class="AppSdGothicNeoR font-normal text-base sm:text-lg text-tm-c-30373F">'+data.hotel[0].rooms[$i].days + '일)</span>';
                            }
                            var coupon ='';
                            if((data.hotel[0].rooms[$i].coupon !==null && data.hotel[0].rooms[$i].coupon !=='')){
                                coupon='' +
                                    '<div class="float-left">' +
                                    '<img src="https://d2pyzcqibfhr70.cloudfront.net/resource/product/ic-coupon.svg" class="coupon_img '+$i+' h-5 2xs:h-6 sm:h-8" alt="">'+
                                    '<span class="coupon_content '+$i+' JeJuMyeongJo text-base text-tm-c-30373F py-1 leading-loose pl-1 hidden">'+data.hotel[0].rooms[$i].coupon + '</span>'+
                                    '</div>';
                            }
                            var heal = '';
                            var discount_rate='정상가';
                            if(data.hotel[0].rooms[$i].discount_rate !== null && data.hotel[0].rooms[$i].discount_rate !=''){
                                discount_rate=data.hotel[0].rooms[$i].discount_rate+'%';
                                heal = ' 약';
                            }
                            var sold_out='';
                            var sold_out_check='room_items';
                            if(data.hotel[0].rooms[$i].room_option !==null && data.hotel[0].rooms[$i].room_option === data.hotel[0].rooms[$i].room_sold_out){
                                sold_out = '<div class="sold_out_container absolute w-full h-full flex justify-center items-center"' +
                                    'data-index="'+$i+'" style="background-color: rgba(181, 177, 173,0.7)">' +
                                    '<div class="PtSerif italic text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white">Sold out</div>' +
                                    '</div>';
                                sold_out_check='sold_out';
                            }

                            var right_top_box = '';
                            var right_bottom_box = '';

                            if(data.hotel[0].rooms[$i].sale_price !== '0'){
                                if(data.hotel[0].options[0].title==='디어스 명동'){
                                    right_top_box = '<span class="AppSdGothicNeoR font-bold text-xs xs:text-sm sm:text-base text-tm-c-0D5E49">호텔에삶 단독 판매</span>';
                                }else{
                                    right_top_box = '<span class="AppSdGothicNeoR font-bold text-xs xs:text-sm sm:text-base text-tm-c-0D5E49">' +
                                        discount_rate+'</span>' +
                                        '<span class="AppSdGothicNeoR text-right text-2xs 2xs:text-xs xs:text-sm sm:text-base text-tm-c-30373F" style="word-break:keep-all;">'+
                                        heal+
                                        '<span class="pl-1 line-through">' + data.hotel[0].rooms[$i].price.replace(/(.)(?=(\d{3})+$)/g, '$1,') + '원</span></span>';
                                }
                            }else{
                                if(data.hotel[0].rooms[$i].sub_explanation === null){
                                    right_top_box= '<span class="AppSdGothicNeoR text-sm text-tm-c-30373F">' +
                                        '' +
                                        '</span>'
                                }else{
                                    right_top_box= '<span class="AppSdGothicNeoR text-sm text-tm-c-30373F">' +
                                        data.hotel[0].rooms[$i].sub_explanation +
                                        '</span>'
                                }
                            }
                            if(data.hotel[0].rooms[$i].sale_price !== '0'){
                                if(coupon !== ''){
                                    right_bottom_box=
                                        '<div class="AppSdGothicNeoR pb-1 md:pb-2 text-right text-tm-c-C1A485 text-xs 3xs:text-sm xs:text-base sm:text-lg">' +
                                        '쿠폰 적용가' +
                                        '</div>' +
                                        '<div class="AppSdGothicNeoR font-bold text-tm-c-C1A485 text-base 3xs:text-lg xs:text-xl sm:text-2xl text-right" style="word-break:keep-all;">' +
                                        data.hotel[0].rooms[$i].sale_price.replace(/(.)(?=(\d{3})+$)/g, '$1,') + '원' +
                                        '</div>';
                                }else{
                                    right_bottom_box='<div class="AppSdGothicNeoR font-bold text-tm-c-C1A485 text-base 3xs:text-lg xs:text-xl sm:text-2xl text-right" style="word-break:keep-all;">' +
                                        data.hotel[0].rooms[$i].sale_price.replace(/(.)(?=(\d{3})+$)/g, '$1,') +
                                        '원</div>';
                                }
                            }else{
                                right_bottom_box= '<div class="mt-1 flex items-center justify-end">' +
                                    '<div class="w-max-content AppSdGothicNeoR text-sm text-white px-5 py-2 bg-tm-c-C1A485 rounded-full cursor-pointer" onclick="kakaoOnetoOne()">' +
                                    '<div style="line-height:1.3;">' +
                                    '가격 문의하기' +
                                    '</div>'+
                                    '</div>'+
                                    '</div>'
                            }
                            if(data.hotel[0].rooms[$i].title !== ''){
                                data.hotel[0].rooms[$i].title=data.hotel[0].rooms[$i].title.replace(' EVENT] ', ' EVENT]<br>');
                                data.hotel[0].rooms[$i].title=data.hotel[0].rooms[$i].title.replace('[오픈 특가]', '[오픈 특가]<br>');
                            }

                            html +=
                                '<div class="'+sold_out_check+' bg-white relative"' +
                                'data-index="' + $i + '" ' +
                                'data-room_id="' + data.hotel[0].rooms[$i].id + '" ' +
                                'data-room_title="' + data.hotel[0].rooms[$i].title + '" ' +
                                'data-order_price="' + data.hotel[0].rooms[$i].price + '" ' +
                                'data-order_sale_price="' + data.hotel[0].rooms[$i].sale_price + '" ' +
                                'data-order_discount_rate="' + data.hotel[0].rooms[$i].discount_rate + '" ' +
                                'data-order_refund_amount="' + data.hotel[0].rooms[$i].refund_amount + '" ' +
                                'data-visible="' + data.hotel[0].rooms[$i].visible + '" ' +
                                'data-order_sale_url="' + data.hotel[0].rooms[$i].sale_url + '"' +
                                ' style="box-shadow: 4px 4px 10px 0 rgba(134, 130, 125, 0.2);">' +
                                sold_out +
                                '<div class="flex flex-wrap px-4 py-4 sm:py-5">'+
                                '<div class="flex flex-col space-y-2">' +
                                '<div class="flex items-end AppSdGothicNeoR font-bold text-tm-c-30373F">' +
                                '<div class="flex float-left text-base sm:text-lg">' +
                                '<div class="flex">' +
                                '<div class="leading-5 sm:leading-6">' +
                                data.hotel[0].rooms[$i].title +
                                nightsDays +
                                '</div>' +
                                '</div>' +
                                '</div>'+
                                '</div>'+
                                '<div class="AppSdGothicNeoR text-tm-c-30373F text-xs sm:text-base">'
                                + data.hotel[0].rooms[$i].main_explanation +
                                '</div>' +
                                '</div>' +
                                '<div class="ml-auto">' +
                                '<div>' +
                                right_top_box+
                                '</div>' +
                                '</div>'+
                                '<div class="absolute bottom-0 right-0 mr-4 mb-4">' +
                                '<div>' +
                                right_bottom_box+
                                '</div>' +
                                '</div>' +
                                '<div class="pt-2 sm:pt-3 w-full">' +
                                upgrade +
                                coupon +
                                '</div>'+
                                '</div>'+
                                '</div>';
                        }
                        $('.rooms_container .hotel_month .rooms_lists').html(html);
                        $('.sold_out_container').each(function (index, item){
                            var thisIndex=$(this).data('index');
                            $('.sold_out_container[data-index='+thisIndex+']').css({
                                'width':$('.room_items[data-index='+thisIndex+']').width() ?? $('.sold_out[data-index='+thisIndex+']').width()+'px',
                                'height':$('.room_items[data-index='+thisIndex+']').height() ?? $('.sold_out[data-index='+thisIndex+']').height()+'px',
                            });
                        });
                        slideHeightControl('', $('.rooms_container'));
                        $('.hotel_month').trigger('click');
                    },
                    error: function (data) {

                    }
                });
            },300);
        }
    }

    var dailyLifeContainerOffset = function () {
        var location = document.querySelector(".daily_life_container").offsetTop;
        window.scrollTo({top: location - 20, behavior: 'smooth'});
    };

    /* 호텔 progress 3  Start */
    $(document).on('click', '.avg_ic', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var index = $(this).data('index');
        var ic = $('.avg_ic[data-index=' + index + ']');

        if (ic.hasClass('on')) {
            ic.toggleClass('on').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg');
        } else {
            ic.toggleClass('on').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg');
        }
    });
    /* 호텔 progress 3 End */

    /* 호텔 progress 2 */
    $(document).on('click', '.room_items', function () {
        /*$('.coupon_img').removeClass('hidden');
        $('.coupon_content').addClass('hidden');
        $('.coupon_img.'+$(this).data('index')).addClass('hidden');
        $('.coupon_content.'+$(this).data('index')).removeClass('hidden');*/
        hotel_type = 'month';
        Livewire.emit('additionalInformationSetEvent','reservation_type',hotel_type);
        additionalInformationRerender();
        $('.desired_time_container').addClass('hidden');
        $('.reservationsChoseBtnText').text('한달살기 신청하기');
        $('.room_items').removeClass('on').css({
            'border': ''
        });

        $('.room_ic_check').removeClass('on');
        $('.room_ic_check[data-index=1]').addClass('on');

        $(this).addClass('on').css({
            'border': '2px solid #c1a485'
        });
        room_id = $(this).data('room_id');
        order_price = $(this).data('order_price');
        order_sale_price = $(this).data('order_sale_price');
        order_discount_rate = $(this).data('order_discount_rate');
        order_refund_amount = $(this).data('order_refund_amount');
        order_sale_url = $(this).data('order_sale_url');
    });

    $(document).on('mouseover', '.room_items', function () {
        $(this).addClass('on').css({
            'transform': 'scale(1.02)'
        });
    });
    $(document).on('mouseout', '.room_items', function () {
        $(this).addClass('on').css({
            'transform': 'scale(1)'
        });
    });

    $(document).on('click', '.hotel_tour', function () {
        hotel_type = 'tour';
        Livewire.emit('additionalInformationSetEvent','reservation_type',hotel_type);
        $('.optionChoseBtn .btnName').text('투어 신청하기');
        $('.reservationsChoseBtnText').text('투어 신청하기');
        $('.desired_date_title').text('투어 희망 날짜');
        $('.order_desired_dt').val('');
        $('.desired_time_container').removeClass('hidden');
        room_id = '';
        order_price = '';
        order_sale_price = '';
        order_discount_rate = '';
        order_refund_amount = '';
        order_sale_url = '';
        $(this).addClass('on');
        $('.hotel_month').css('outline', '').removeClass('on');
        $(this).css({
            'outline': '4px solid #c1a485'
        });
        $('.room_ic_check').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg').removeClass('on');
        $('.room_ic_check[data-index=0]').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg').addClass('on');

        $('.room_items').removeClass('on').css({
            'border': ''
        });
        additionalInformationRerender();
    });

    $(document).on('click', '.hotel_month', function () {

        $('.optionChoseBtn .btnName').text('결제하기');
        $('.reservationsChoseBtnText').text('결제하기');
        $('.desired_date_title').text('입주 희망 날짜');
        $('.order_desired_dt').val('');

        if (!$(this).hasClass('on')) {
            $('.room_items').removeClass('on').css({
                'border': ''
            });
            $('.room_items').eq(0).addClass('on').css({
                'border': '2px solid #c1a485'
            });
            hotel_type = 'month';
            Livewire.emit('additionalInformationSetEvent','reservation_type',hotel_type);
            $('.desired_time_container').addClass('hidden');
            room_id = $('.room_items').eq(0).data('room_id');
            order_price = $('.room_items').eq(0).data('order_price');
            order_sale_price = $('.room_items').eq(0).data('order_sale_price');
            order_discount_rate = $('.room_items').eq(0).data('order_discount_rate');
            order_refund_amount = $('.room_items').eq(0).data('order_refund_amount');
            order_sale_url = $('.room_items').eq(0).data('order_sale_url');
        }
        $(this).addClass('on');
        $('.hotel_tour').css('outline', '').removeClass('on');
        $(this).css({
            'outline': '4px solid #c1a485'
        });

        $('.room_ic_check').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg').removeClass('on');
        $('.room_ic_check[data-index=1]').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg').addClass('on');

        additionalInformationRerender();
    });

    $(document).on('click', '.swiper-slide-prev', function () {
        hotel_type = '';
        room_id = '';
        order_price = '';
        order_sale_price = '';
        order_discount_rate = '';
        order_refund_amount = '';
        order_sale_url = '';
        hotelListsSwiper.slidePrev();
    });
    /* 호텔 progress 2 END */

    /* 호텔 progress 1 */
    $(document).on('click', '.hotel_items:not(.not)', function () {
        var index = $(this).data('index');
        var target_ic = $('.ic_check[data-index=' + index + ']');
        var target_item = $('.hotel_items[data-index=' + index + ']');

        /* 이외 선택 취소 */
        $('.ic_check:not([data-index=' + index + '])').removeClass('on').attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg');
        $('.hotel_items:not([data-index=' + index + '])').removeClass('on');
        $('.hotel_items:not([data-index=' + index + '])').css('outline', '');

        if (target_ic.hasClass('on')) {
            $(this).css('outline', '');
            target_ic.toggleClass('on');
            target_item.toggleClass('on');
            target_ic.attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg');
        } else {
            $(this).css('outline', '1px solid #ffffff');
            target_ic.toggleClass('on');
            target_item.toggleClass('on');
            target_ic.attr('src', 'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg');
        }
    });
    /* 호텔 progress 1 END */

    function additionalInformationRerender(){
        if(hotel_type === 'month'){
            Livewire.emit('additionalInformationSetEvent','room_id',room_id);
        }else{
            Livewire.emit('clear',0);
        }
        Livewire.emit('additionalInformationSetEvent','hotel_id','{{$hotelId}}');
        Livewire.emit('additionalInformationFactoryEvent');
        Livewire.emit('bodyOffsetWidthEvent',document.body.offsetWidth);
    }

    function kakaoOnetoOne(){
        Kakao.init('1aaa3ea4fe5abbbce1c720570e59f3f3');
        Kakao.Channel.chat({
            channelPublicId: '_JzxcLK' // 카카오톡 채널 홈 URL에 명시된 id로 설정합니다.
        });
        setTimeout(function () {
            Kakao.cleanup();
            //location.href='https://pf.kakao.com/_IfBRj/chat';
        },2000);
    }
</script>
