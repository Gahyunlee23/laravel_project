<div class="w-full flex flex-wrap justify-center"
     x-data="{ payment_method : 'credit-card' }">
    <div class="w-full py-4">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33">
                <g fill="none" fill-rule="evenodd">
                    <g>
                        <path fill="#30373F" d="M0 0H1920V1990H0z" transform="translate(-360.000000, -114.000000)"/>
                        <g>
                            <g>
                                <path stroke="#FFF" stroke-width="2" d="M3 16L16 30 29 16" transform="translate(-360.000000, -114.000000) translate(360.000000, 114.000000) translate(16.000000, 16.500000) rotate(-270.000000) translate(-16.000000, -16.500000) translate(0.000000, 0.500000)"/>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <div class="py-4">
            <div class="JeJuMyeongJo text-4xl text-white">
                결제 정보 입력
            </div>
        </div>
    </div>
    <div class="w-full sm:w-10/12">
        <div>
            <div class="space-y-2 sm:space-y-3">
                <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                    성명
                </div>
                <div class="relative block">
                    <input type="text" name="order_name" wire:model.lazy="order_name" data-target="name-delete-incorrect"
                           class="input_delete_incorrect order_name w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                           placeholder="이름을 입력해주세요." maxlength="50" @auth value="{{auth()->user()->name ?? ''}}" @endauth
                           autocomplete="off" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                    <div class="mt-2 text-white">실명으로 입력해 주셔야 호텔 입주 시 빠른 안내가 가능합니다.</div>
                    <div
                        class="name-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-5 mt-3"
                        data-target="order_name">
                        <img
                            src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                            class="cursor-pointer" alt="">
                    </div>
                </div>
                @error('order_name')
                <div class="mt-2">
                    <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                </div>
                @enderror
            </div>

            <div class="mt-8 space-y-2 sm:space-y-3">
                <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                    휴대전화 번호
                </div>
                <livewire:form.input.hand-phone emit-to="order.input-form" :tel="$order_hp ?? null"></livewire:form.input.hand-phone>
                @error('tel')
                <div class="mt-2">
                    <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                </div>
                @enderror
            </div>

            <div class="mt-8 space-y-2 sm:space-y-3">
                <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                    이메일
                </div>
                <div class="relative block">
                    <input type="email" name="order_email" wire:model.lazy="order_email" data-target="email-delete-incorrect"
                           class="input_delete_incorrect order_email w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                           placeholder="이메일을 입력해주세요." maxlength="50" @auth
                           value="{{auth()->user()->email ?? ''}}"
                           @endauth
                           autocomplete="off" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                    <div
                        class="email-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-5 mt-3"
                        data-target="order_email">
                        <img
                            src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                            class="cursor-pointer" alt="">
                    </div>
                </div>
                @error('order_email')
                <div class="mt-2">
                    <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                </div>
                @enderror
            </div>

            @if($reservation->type === 'month')
                <div class="mt-10 desired_date_container space-y-2 sm:space-y-3">
                    <div
                        class="desired_date_title text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                        입주 희망 날짜
                    </div>
                    <div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <input type="date" wire:model.lazy="start_date" wire:key="start_date.1.{{now()}}" readonly
                                       class="start_date w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                                       placeholder="입주 시작일" maxlength="50"
                                       autocomplete="off" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                            </div>
                            <div>
                                <input type="date" wire:model.lazy="end_date" wire:key="end_date.1.{{now()}}" readonly
                                       class="end_date w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                                       placeholder="입주 시작일" maxlength="50"
                                       autocomplete="off" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                            </div>
                        </div>
                    </div>
                </div>

                @error('start_date')
                <div class="mt-2">
                    <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                </div>
                @enderror
                @error('end_date')
                <div class="mt-2">
                    <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                </div>
                @enderror
                <div>
                    <div>
                        <livewire:order.calendar :hotel="$hotel" :period-prices="$period_prices" :type="$reservation->type"></livewire:order.calendar>
                    </div>
                    <div class="mt-8">
                        <div class="flex">
                            <div class="w-1 bg-tm-c-da5542"></div>
                            <div class="flex-1 bg-tm-c-ED">
                                <div class="py-3 px-5 space-y-2">
                                    <div class="AppSdGothicNeoR text-base text-tm-c-30373F leading-5">* 선택하시는 입주 - 퇴실 예정일에 따라 선택 가능한 룸이 상이합니다. </div>
                                    <div class="AppSdGothicNeoR text-base text-tm-c-30373F leading-5">* 투어는 주중에만 가능합니다.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    @if($start_date !== null && $end_date !== null)
                        @php
                            $roomList = \App\PeriodPrice::where('hotel_id', '=', $hotel->id)
                                ->where('type', '=', 'price')
                                ->where('date', '<=', collect($periodCarbonDateArr)->count())
                                ->whereIn('range_d', $periodCarbonDateArr)
                                ->orderBy('room_type_id')
                                ->groupBy('room_type_name');

                            $roomCheck = \App\PeriodPrice::where('hotel_id', '=', $hotel->id)
                                ->where('type', '=', 'price')
                                ->where('date', '<=', collect($periodCarbonDateArr)->count())
                                ->whereBetween('range_d', [$start_date, $end_date])->groupBy('range_d','room_type_name')->get();
                        @endphp
                        <div class="py-4">
                            <div class="AppSdGothicNeoR font-semibold text-lg text-tm-c-d7d3cf">
                                룸 타입 선택
                            </div>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6"
                             x-data="{
                                selectRoom : '{{$roomList->get()->first()->room_type_name ?? ''}}'
                            }">
                            @php
                                $possibleCount = 0;
                            @endphp
                            @forelse ($hotel->roomTypes as $roomType)
                                <label>
                                    <input type="radio" wire:model="selectRoom" class="hidden" wire:change="possibleRoomType" value="{{$roomType->name}}"
                                           x-bind::checked="selectRoom === '{{$roomType->name}}'"
                                    @if( collect($periodCarbonDateArr)->count() > 0 && $roomCheck->where('room_type_name', '=', $roomType->name)->count() !== collect($periodCarbonDateArr)->count())
                                        disabled
                                    @endif>
                                @if( !(collect($periodCarbonDateArr)->count() > 0 && $roomCheck->where('room_type_name', '=', $roomType->name)->count() !== collect($periodCarbonDateArr)->count()) )
                                    @php
                                        $possibleCount++
                                    @endphp
                                @endif
                                <div class="relative w-full"
                                     @if( !(collect($periodCarbonDateArr)->count() > 0 && $roomCheck->where('room_type_name', '=', $roomType->name)->count() !== collect($periodCarbonDateArr)->count()) )
                                     x-on:click="selectRoom = '{{$roomType->name}}'"
                                     @endif
                                     @if(($possibleCount > 0))
                                     x-bind:class="{
                                        'border-2 border-solid border-tm-c-C1A485' :selectRoom === '{{$roomType->name}}'
                                    }"
                                    @endif>
                                    <div class="relative w-full h-full select-none pb-3/4"
                                         @if( collect($periodCarbonDateArr)->count() > 0 && $roomCheck->where('room_type_name', '=', $roomType->name)->count() !== collect($periodCarbonDateArr)->count())
                                         x-bind:class="'bg-tm-c-30373F bg-opacity-70'"
                                        @endif
                                    >
                                        @if( collect($periodCarbonDateArr)->count() > 0 && $roomCheck->where('room_type_name', '=', $roomType->name)->count() !== collect($periodCarbonDateArr)->count())
                                            @php
                                                $maxDate = \App\PeriodPrice::where('hotel_id', '=', $hotel->id)
                                                    ->where('type', '=', 'price')
                                                    ->where('room_type_name', '=', $roomType->name)
                                                    ->whereBetween('range_d', [$start_date, $end_date])
                                                    ->groupBy('range_d','room_type_name')->max('date');
                                            @endphp
                                            <div class="absolute w-full top-0 left-0" style="height: calc( 100% - 29px );">
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <div class="AppSdGothicNeoR text-base text-white text-center leading-5">
                                                        <div>
                                                            @if(\App\PeriodPrice::where('hotel_id', '=', $hotel->id)
                                                                ->where('type', '=', 'price')
                                                                ->where('room_type_name', '=', $roomType->name)
                                                                ->where('date', '=', $maxDate)
                                                                ->groupBy('range_d','room_type_name')->count()>=1)
                                                                @php
                                                                    $ranges = \App\PeriodPrice::where('hotel_id', '=', $hotel->id)
                                                                    ->where('type', '=', 'price')
                                                                    ->where('room_type_name', '=', $roomType->name)
                                                                    ->where('date', '=', $maxDate)
                                                                    ->groupBy('range_d','room_type_name')->pluck('range_d');
                                                                @endphp
                                                                <div>해당 룸은 선택 기간 중</div>
                                                                <div>
                                                                    {{\Carbon\Carbon::parse($ranges->first() ?? '')->format('Y.m.d')}}
                                                                    &nbsp;~&nbsp;
                                                                    {{\Carbon\Carbon::parse($ranges->last() ?? '')->format('Y.m.d')}}
                                                                </div>
                                                                <div>{{$maxDate}}일 입주 가능합니다.</div>
                                                            @else
                                                                @php
                                                                    $ranges = \App\PeriodPrice::where('hotel_id', '=', $hotel->id)
                                                                    ->where('type', '=', 'price')
                                                                    ->where('room_type_name', '=', $roomType->name)
                                                                    ->groupBy('range_d','room_type_name');
                                                                @endphp
                                                                @if($ranges->count()>0)
                                                                    <div>해당 룸은 선택 기간 외</div>
                                                                    <div>
                                                                        {{\Carbon\Carbon::parse($ranges->pluck('range_d')->first() ?? '')->format('Y.m.d')}}
                                                                        &nbsp;~&nbsp;
                                                                        {{\Carbon\Carbon::parse($ranges->pluck('range_d')->last() ?? '')->format('Y.m.d')}}
                                                                    </div>
                                                                    <div>{{$ranges->max('date')}}일 입주 가능합니다.</div>
                                                                @else
                                                                    <div>현재 입주 불가능합니다.</div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="absolute w-full top-0 left-0" style="height: calc( 100% - 29px );">
                                                <div class="w-full h-full">
                                                    <div class="ml-3 mt-2">
                                                        <div x-show="selectRoom === '{{$roomType->name}}'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <g>
                                                                                    <g transform="translate(-558.000000, -1283.000000) translate(546.000000, 244.000000) translate(0.000000, 995.000000) translate(0.000000, 32.000000) translate(12.000000, 12.000000)">
                                                                                        <circle cx="15" cy="15" r="15" fill="#C1A485"/>
                                                                                        <path stroke="#FFF" stroke-width="2" d="M9.256 13.55L13.376 18.781 21.256 10.781"/>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <div x-show="selectRoom !== '{{$roomType->name}}'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <g>
                                                                                    <g transform="translate(-842.000000, -1283.000000) translate(546.000000, 244.000000) translate(0.000000, 995.000000) translate(284.000000, 32.000000) translate(12.000000, 12.000000)">
                                                                                        <circle cx="15" cy="15" r="15" fill="#D7D3CF"/>
                                                                                        <path stroke="#FFF" stroke-width="2" d="M9.256 13.55L13.376 18.781 21.256 10.781"/>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="absolute w-full bottom-0 left-0">
                                            <div class="flex justify-center items-center relative px-3 py-2 rounded-b-sm bg-white bg-opacity-70">
                                                <span class="AppSdGothicNeoR text-tm-c-30373F text-sm sm:text-lg">
                                                    {{$roomType->name}}
                                                </span>
                                            </div>
                                        </div>
                                        <div
                                            style="background:url({{'https://d2pyzcqibfhr70.cloudfront.net/'.$roomType->image}});background-size:cover;z-index:-1;-webkit-user-drag: none;  -khtml-user-drag: none;  -moz-user-drag: none;  -o-user-drag: none;  user-drag: none;"
                                            class="room_image absolute pb-3/4 top-0 w-full h-full select-none" alt="Room Image">
                                        </div>
                                    </div>
                                </div>
                                </label>
                            @empty
                                <div class="bg-white rounded-sm p-4 col-span-2 sm:col-span-3 lg:col-span-4">
                                    <div class="font-bold text-sm sm:text-base text-tm-c-30373F">
                                        선택 가능한 룸 타입이 없습니다.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        @if($roomList->count()>=1 && ($possibleCount ?? 0) >= 1)
                            <div class="py-6 AppSdGothicNeoR tracking-wide">
                                <div>
                                    <div class="border-b border-solid border-tm-c-979b9f py-2 space-y-1">
                                        <div class="flex justify-between">
                                            <div class="font-bold text-tm-c-d7d3cf text-base">{{$selectRoom ?? '정보 오류'}}</div>
                                            <div class="font-bold text-tm-c-979b9f text-base">판매 원가</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="font-bold text-tm-c-d7d3cf text-lg">
                                                {{collect($periodCarbonDateArr)->count()-1}}박 {{collect($periodCarbonDateArr)->count()}}일
                                            </div>
                                            <div class="font-bold text-tm-c-979b9f text-lg line-through">
                                                @if($periodPrices!==null)
                                                    {{number_format($periodPrices->sortKeys()->sum('0.price') ?? 0) . '원'}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 border-b border-solid border-tm-c-979b9f py-2 space-y-1">
                                        <div class="flex justify-end">
                                            <div class="font-bold text-white text-base">최종 결제 금액</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="font-medium text-tm-c-C1A485 text-lg">
                                                호텔에삶 할인가 적용
                                            </div>
                                            <div class="text-white font-bold text-xl">
                                                @if($periodPrices!==null)
                                                    {{number_format($periodPrices->sortKeys()->sum('0.sale_price') ?? 0) . '원'}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    @error('real_sale_price')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror
                </div>

            @elseif($reservation->type === 'tour')
                <div class="mt-10 desired_date_container space-y-2 sm:space-y-3">
                    <div
                        class="desired_date_title text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                        투어 희망 날짜
                    </div>
                    {{--<div class="relative block">
                        <input type="text" wire:model.lazy="order_desired_dt" name="order_desired_dt" id="order_desired_dt_datepicker" data-target="desired-delete-incorrect" readonly
                               class="input_delete_incorrect order_desired_dt w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                               placeholder="{{ \Carbon\Carbon::today()->addDays(2)->format('Y/m/d') }}"
                               autocomplete="off" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                        <div
                            class="desired-delete-incorrect delete_incorrect z-50 hidden absolute right-0 top-0 mr-5 mt-3"
                            data-target="order_desired_dt">
                            <img
                                src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg"
                                class="cursor-pointer" alt="">
                        </div>
                    </div>--}}

                    <div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <input type="date" wire:model.lazy="start_date" wire:key="start_date.2.{{now()}}" readonly
                                       class="start_date w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                                       placeholder="투어 희망 날짜" maxlength="50"
                                       autocomplete="off" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                            </div>
                        </div>
                    </div>
                </div>

                @error('start_date')
                <div class="mt-2">
                    <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                </div>
                @enderror
                <div>
                    <div>
                        <livewire:order.calendar :hotel="$hotel" :period-prices="$period_prices" :type="$reservation->type"></livewire:order.calendar>
                    </div>
                    <div class="mt-8">
                        <div class="flex">
                            <div class="w-1 bg-tm-c-da5542"></div>
                            <div class="flex-1 bg-tm-c-ED">
                                <div class="py-3 px-5 space-y-2">
                                    <div class="AppSdGothicNeoR text-base text-tm-c-30373F leading-5">* 선택하시는 입주 - 퇴실 예정일에 따라 선택 가능한 룸이 상이합니다. </div>
                                    <div class="AppSdGothicNeoR text-base text-tm-c-30373F leading-5">* 투어는 주중에만 가능합니다.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @endif


            @if($reservation->type === 'tour' && $start_date !== null)
            <div class="mt-8 desired_time_container space-y-2 sm:space-y-3">
                <div
                    class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                    투어 희망 시간
                </div>
                @php
                    $periodDate = \App\PeriodPrice::where('hotel_id', '=', $hotel->id)
                        ->where('type', '=', 'tour')
                        ->where('range_d', '=', $start_date)->get();
                    if($periodDate->count()>0){
                        $limitStartDate=Str::of($periodDate->first()->start_time)->explode(':');
                        $limitEndDate=Str::of($periodDate->first()->end_time)->explode(':');
                    }
                @endphp
                @if($periodDate->count()>0)
                <div class="relative block">
                    <div class="flex flex-wrap space-x-2">
                        <div class="flex-1">
                            <div class="flex justify-center items-center bg-transparent focus:outline-none px-1 sm:px-2 border border-solid rounded-sm">
                                <div class="w-full py-2">
                                    <select name="time_hour" id="time_hour" wire:model.defer="time_hour" data-index="1"
                                            onfocus="$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png');"
                                            onmouseover="if($(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png')}"
                                            onchange="timeChecker('{{$limitStartDate}}','{{$limitEndDate}}');$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png');$(this).blur();"
                                            onmouseout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                            onfocusout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                            class="appearance-none relative focus:outline-none placeholder-tm-c-979b9f text-white px-3 sm:px-5 h-10 bg-transparent focus:outline-none"
                                            style="width:calc( 100% + 28px );">
                                        <option class="text-tm-c-30373F disabled:bg-tm-c-979b9f" value="" disabled selected>시간 선택</option>
                                        @for ($i = 0; $i <= 24 ; $i++)
                                            @if($i >= $limitStartDate[0] && $i <= $limitEndDate[0])
                                                @if($i < 10)
                                                    <option class="text-tm-c-30373F disabled:bg-tm-c-979b9f" value="0{{$i}}">0{{$i}}</option>
                                                @else
                                                    <option class="text-tm-c-30373F disabled:bg-tm-c-979b9f" value="{{$i}}">{{$i}}</option>
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
                        @error('time_hour')
                        <div class="mt-2">
                            <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                        </div>
                        @enderror
                        <div class="flex-1">
                            <div class="flex justify-center items-center bg-transparent focus:outline-none px-1 sm:px-2 border border-solid rounded-sm">
                                <div class="w-full py-2">
                                    <select name="time_minute" id="time_minute" wire:model.defer="time_minute" data-index="2"
                                            onfocus="$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png');"
                                            onmouseover="if($(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png')}"
                                            onchange="$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png');$(this).blur();"
                                            onmouseout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                            onfocusout="if(!$(this).is(':focus')){$('img.time_select[data-index='+$(this).data('index')+']').attr('src','https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png')}"
                                            class="appearance-none relative focus:outline-none placeholder-tm-c-979b9f text-white px-3 sm:px-5 h-10 bg-transparent focus:outline-none"
                                            style="width:calc( 100% + 28px );">
                                        <option class="text-tm-c-30373F disabled:bg-tm-c-979b9f" value="" disabled selected>분 선택</option>
                                        @for ($i = 0; $i <= 55 ; $i+=30)
                                            @if($i < 10)
                                                <option class="text-tm-c-30373F disabled:bg-tm-c-979b9f" value="0{{$i}}">0{{$i}}</option>
                                            @else
                                                <option class="text-tm-c-30373F disabled:bg-tm-c-979b9f" value="{{$i}}">{{$i}}</option>
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
                    @error('time_minute')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror
                    <div>
                        <div
                            class="text-right pt-3 tracking-wide text-white text-sm AppSdGothicNeoR font-semibold">
                            * 희망 날짜와 확정 날짜는 상이할 수 있습니다.
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif

            @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                <div>
                    <div class="mt-10 purpose_contain space-y-2 sm:space-y-3">
                        <div
                            class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                            입주 목적
                        </div>
                        <div class="space-y-3" x-data="{ check : null }">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($purposes as $item)
                                    <label>
                                        <input type="radio" name="purpose" wire:model.lazy="purpose" wire:key="purpose.1.{{now()}}" value="{{$item}}" class="hidden" x-on:click="check = '{{$item}}'">
                                        <div class="w-full h-14 flex justify-between items-center border border-solid rounded-full cursor-pointer"
                                             x-bind:class="{
                                            'border-tm-c-C1A485' : check === '{{$item}}',
                                            'border--white' : check !== '{{$item}}'
                                            }">
                                            <div class="w-full AppSdGothicNeoR text-tm-c-ED text-base pl-4"
                                                 x-bind:class="{
                                            'text-tm-c-C1A485' : check === '{{$item}}',
                                            'text-white' : check !== '{{$item}}'
                                            }">
                                                {{$item ?? '오류'}}
                                            </div>

                                            <div class="w-10 h-10 mr-2 py-1">
                                                <div class="w-8 h-8 flex items-center justify-center border border-solid rounded-full"
                                                     x-bind:class="{
                                                'border-tm-c-C1A485' : check === '{{$item}}',
                                                'border-white' : check !== '{{$item}}'
                                            }">
                                                    <div class="rounded-full transition duration-300"
                                                         style="width: 18px;height: 18px;"
                                                         x-bind:class="{
                                                'bg-tm-c-C1A485' : check === '{{$item}}',
                                                'bg-tm-c-979b9f' : check !== '{{$item}}'
                                            }"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <div class="relative"
                                 x-bind:class="{
                                'block' : check === '기타',
                                'hidden' : check !== '기타'
                            }">
                                <input type="text" name="purpose_value" id="purpose_value" wire:model.lazy="purpose_value" placeholder="ex. 인테리어, 여행, 이사, 출장 등"
                                       class="w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                                       autocomplete="off" maxlength="200" style="z-index:-1;border-color:#d7d3cf;"
                                       x-bind:disabled="check !== '기타'"
                                >
                            </div>
                        </div>
                    </div>
                    @error('purpose')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror

                    <div class="mt-10 purpose_contain space-y-2 sm:space-y-3">
                        <div
                            class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                            방문 경로
                        </div>
                        <div class="space-y-3" x-data="{ check : null }">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($visit_routes as $item)
                                    <label>
                                        <input type="radio" name="visit_route" id="visit_route" wire:model.lazy="visit_route" wire:key="visit_route.1"  value="{{$item}}" class="hidden" x-on:click="check = '{{$item}}'">
                                        <div class="w-full h-14 flex justify-between items-center border border-solid rounded-full cursor-pointer"
                                             x-bind:class="{
                                            'border-tm-c-C1A485' : check === '{{$item}}',
                                            'border--white' : check !== '{{$item}}'
                                            }">
                                            <div class="w-full AppSdGothicNeoR text-tm-c-ED text-base pl-4"
                                                 x-bind:class="{
                                            'text-tm-c-C1A485' : check === '{{$item}}',
                                            'text-white' : check !== '{{$item}}'
                                            }">
                                                {{$item ?? '오류'}}
                                            </div>

                                            <div class="w-10 h-10 mr-2 py-1">
                                                <div class="w-8 h-8 flex items-center justify-center border border-solid rounded-full"
                                                     x-bind:class="{
                                                'border-tm-c-C1A485' : check === '{{$item}}',
                                                'border-white' : check !== '{{$item}}'
                                            }">
                                                    <div class="rounded-full transition duration-300"
                                                         style="width: 18px;height: 18px;"
                                                         x-bind:class="{
                                                'bg-tm-c-C1A485' : check === '{{$item}}',
                                                'bg-tm-c-979b9f' : check !== '{{$item}}'
                                            }"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <div class="relative"
                                 x-bind:class="{
                                'block' : check === '기타',
                                'hidden' : check !== '기타'
                            }">
                                <input type="text" name="visit_route_value" id="visit_route_value" wire:model.lazy="visit_route_value" placeholder="ex.네이버, SNS, 카카오톡, 커뮤니티/카페, 지인추천 등"
                                       class="w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                                       autocomplete="off" maxlength="200" style="z-index:-1;border-color:#d7d3cf;"
                                       x-bind:disabled="check !== '기타'"
                                >
                            </div>
                        </div>
                    </div>
                    @error('visit_route')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror
                </div>

                @if($reservation->type === 'month')
                    <div class="mt-10 flex flex-wrap xs:flex-nowrap space-y-3 xs:space-y-0 space-x-0 xs:space-x-3 sm:space-x-4">
                        <div class="relative w-full xs:w-1/2 h-28 sm:h-32 md:h-40 border border-solid rounded-sm flex justify-center items-center cursor-pointer"
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
                        <div class="relative w-full xs:w-1/2 h-28 sm:h-32 md:h-40 border border-solid rounded-sm flex justify-center items-center cursor-pointer"
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
            @else
                <div>
                    <div class="mt-10 purpose_contain space-y-2 sm:space-y-3">
                        <div
                            class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                            입주 목적
                        </div>
                        <div class="relative block">
                            <input type="text" name="purpose" id="purpose" wire:model.lazy="purpose" wire:key="purpose.2.{{now()}}" placeholder="ex. 인테리어, 여행, 이사, 출장 등"
                                   class="w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                                   autocomplete="off" maxlength="200" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                        </div>
                    </div>
                    @error('purpose')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror
                </div>
                <div>
                    <div class="mt-10 visit_route_contain space-y-2 sm:space-y-3">
                        <div
                            class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                            방문 경로
                        </div>
                        <div class="relative block">
                            <input type="text" name="visit_route" id="visit_route" wire:model.lazy="visit_route" wire:key="visit_route.2" placeholder="ex.네이버, SNS, 카카오톡, 커뮤니티/카페, 지인추천 등"
                                   class="w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                                   autocomplete="off" maxlength="200" style="height:51px;z-index:-1;border-color:#d7d3cf;">
                        </div>
                    </div>
                    @error('visit_route')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror
                </div>
            @endif

            <div class="mt-10 space-y-2 sm:space-y-3">
                <div class="text-white text-lg sm:text-xl AppSdGothicNeoR font-normal">
                    개인 정보 동의 여부
                </div>

                <div x-data="{ check : @entangle('all_check') }">
                    <label>
                        <input type="checkbox" wire:model="all_check" wire:click="checkBoxObserver('all_check')" class="hidden">
                        <div class="border border-solid rounded-sm h-full" style="min-height:49px; border-color:#d7d3cf;">
                            <div class="px-2" style="z-index: -1;">
                                <div class="w-full inline-flex items-center text-sm">
                                    <div class="flex-1">
                                        <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                            <div class="z-50">
                                                <img
                                                    x-show="!check"
                                                    src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                    class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                                <img
                                                    x-show="check" x-cloak
                                                    src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                    class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                            </div>
                                            <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg" x-on:click="check = !check">
                                                전체 동의
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>

                <div x-data="{ show : false, check : @entangle('operating_terms') }">
                    <div>
                        <div class="border border-solid rounded-sm h-full" style="min-height:49px; border-color:#d7d3cf;">
                            <div class="px-2" style="z-index: -1;">
                                <div class="w-full inline-flex items-center text-sm">
                                    <label>
                                        <input type="checkbox" wire:model="operating_terms" wire:change="checkBoxObserver('operating_terms')" class="hidden">
                                        <div class="flex-1">
                                            <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                <div class="z-50">
                                                    <img
                                                        x-show="!check"
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                        class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                                    <img
                                                        x-show="check" x-cloak
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                        class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                                </div>
                                                <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg" x-on:click="show = !show; check = !check">
                                                    이용약관 및 취소환불 규정 동의 (필수)
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <div class="float-left ml-auto mr-2 cursor-pointer" x-on:click="show = !show">
                                        <img class="w-8 h-8"
                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                             x-show="!show"
                                             alt="">
                                        <img class="w-8 h-8"
                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png"
                                             x-show="show" x-cloak
                                             alt="">
                                    </div>
                                </div>
                            </div>

                            <div x-show="show" x-cloak
                                 class="h-42 overflow-y-scroll border-t-2 border-solid"
                                 style="border-color:#d7d3cf;">
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
                    @error('operating_terms')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror
                </div>

                <div x-data="{ show : false, check : @entangle('privacy') }">
                    <div>
                        <div class="border border-solid rounded-sm h-full" style="min-height:49px; border-color:#d7d3cf;">
                            <div class="px-2" style="z-index: -1;">
                                <div class="w-full inline-flex items-center text-sm">
                                    <div class="flex-1">
                                        <label>
                                            <input type="checkbox" wire:model="privacy" wire:change="checkBoxObserver('privacy')" class="hidden">
                                            <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                <div class="z-50">
                                                    <img
                                                        x-show="!check"
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                        class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                                    <img
                                                        x-show="check" x-cloak
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                        class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                                </div>
                                                <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg" x-on:click="show = !show;check = !check">
                                                    개인정보 수집 및 활용 동의 (필수)
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="float-left ml-auto mr-2 cursor-pointer" x-on:click="show = !show">
                                        <img class="w-8 h-8"
                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                             x-show="!show"
                                             alt="">
                                        <img class="w-8 h-8"
                                             src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropup.png"
                                             x-show="show" x-cloak
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div x-show="show" x-cloak
                                 class="h-42 overflow-y-scroll border-t-2 border-solid"
                                 style="border-color:#d7d3cf;">
                                <div>
                                    <div class="py-6 px-2">
                                    <span class="AppSdGothicNeoR text-white text-base leading-7">
                                        @livewire('privacy')
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('privacy')
                    <div class="mt-2">
                        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
                    </div>
                    @enderror
                </div>

                <div x-data="{ show : false, check : @entangle('marketing') }">
                    <div class="border border-solid rounded-sm h-full" style="min-height:49px; border-color:#d7d3cf;">
                        <div class="px-2" style="z-index: -1;">
                            <div class="w-full inline-flex items-center text-sm">
                                <div class="flex-1">
                                    <label>
                                        <input type="checkbox" wire:model="marketing" wire:change="checkBoxObserver('marketing')" class="hidden">

                                        <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                            <div class="z-50">
                                                <img
                                                    x-show="!check"
                                                    src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg"
                                                    class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                                <img
                                                    x-show="check" x-cloak
                                                    src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg"
                                                    class="mx-3 w-8 sm:w-9 cursor-pointer" alt="" x-on:click="check = !check">
                                            </div>
                                            <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg" x-on:click="check = !check">
                                                마케팅 수신 동의 (선택)
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-sm text-white AppSdGothicNeoR">
                    * 비회원 결제 시 알림톡으로 결제 내역 확인 가능한 정보를 전달드립니다.
                </div>
            </div>
            <div class="mt-10 pb-6">
                <button wire:click="submit" class="w-full text-white py-4 bg-tm-c-C1A485 hover:bg-tm-c-897763 focus:outline-none disabled:bg-tm-c-d7d3cf"
                        wire:loading.attr="disabled"
                        wire:click="submit">
                    <svg wire:loading wire:target="submit"
                         class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    @if($reservation->type === 'month')
                        결제하기
                    @elseif($reservation->type==='tour')
                        신청하기
                    @endif
                </button>
            </div>
            @error('price_error')
            <div class="mt-2">
                <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
            </div>
            @enderror

        </div>
    </div>

<script>
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
        //time_minute.disabled=false;
        time_minute.options[0].innerHTML="분 선택";
    }
</script>
