<div>
    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    기간 별 가격 설정
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 앞서 입력하신 모든 룸 타입에 대한 가격을 기입해주시기 바랍니다.</p>
            <p>* 기존 OTA보다 경쟁력 있는 가격을 기입해주시기 바랍니다. 다만, 호텔 공식 홈페이지 가격이 타 판매 채널 및 OTA 대비 경쟁력 있는 상황인 경우, 공식 홈페이지와 동일한 판매가로 기입하시기 바랍니다.</p>
            <p>* 부가세 포함 금액으로 입력해주시기 바랍니다.</p>
        </div>
    </div>

    <div class="pt-6">
        <div
            wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelItem', 'method')">
            <div class="py-4 AppSdGothicNeoR text-lg text-white">
                입점 방식 선택 (택 1 필수)
            </div>
            <div class="border-t-2 border-b-2 border-solid border-white">
                <div class="flex items-center border-b border-solid border-tm-c-979b9f border-opacity-50">

                    <div class="flex-0 px-4 h-full">
                        <label for="method.1" class="select-none">
                            <div class="flex items-center space-x-2 AppSdGothicNeoR font-bold text-sm text-white">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24">
                                        @if($method === '입금가')
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g transform="translate(-366 -522) translate(360 399) translate(0 36) translate(6 87)">
                                                                <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @else
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g transform="translate(-366 -457) translate(360 399) translate(0 36) translate(6 22)">
                                                                <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @endif
                                    </svg>
                                </div>
                                <div class="pt-px">입금가 호텔</div>
                            </div>
                        </label>
                    </div>
                    <div class="flex-1 px-4 py-4 leading-normal border-l border-solid border-tm-c-979b9f">
                        <div class="AppSdGothicNeoR text-sm text-white">
                            입금가 호텔이란 호텔에삶 서비스를 이용하기 위해 약관에 따라 회사와 이용 계약을 체결하고, 고객이 롱스테이 서비스를 이용할 수 있도록 플랫폼에 등록할 시, 자사가 제안한 입금가 방식을 채택해 경쟁력 있는 가격을 제공해준 대가로 자사의 마케팅 지원 및 다양한 지원을 받는 호텔을 의미합니다.
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-0 px-4 h-full">
                        <label for="method.0" class="select-none">
                            <div class="flex items-center space-x-2 AppSdGothicNeoR font-bold text-sm text-white">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24">
                                        @if($method === '수수료')
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g transform="translate(-366 -522) translate(360 399) translate(0 36) translate(6 87)">
                                                                <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @else
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g transform="translate(-366 -457) translate(360 399) translate(0 36) translate(6 22)">
                                                                <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @endif
                                    </svg>
                                </div>
                                <div class="pt-px">수수료 호텔</div>
                            </div>
                        </label>
                    </div>
                    <div class="flex-1 px-4 py-4 leading-normal border-l border-solid border-tm-c-979b9f">
                        <div class="AppSdGothicNeoR text-sm text-white">
                            수수료 호텔이란 호텔에삶 서비스를 이용하기 위해 약관에 따라 회사와 이용 계약을 체결하고, 고객이 롱스테이 서비스를 이용할 수 있도록 플랫폼에 등록할 시, 자사가 제안한 입금가 방식이 아닌 수수료 방식을 채택한 호텔을 의미합니다.
                        </div>
                    </div>
                </div>
            </div>

            @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')->whereTarget('method')->get(['status','content']) as $item)
                <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                    <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pt-3">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>※ 가격은 해당 기간에 맞는 1박 기준으로 입력하세요.</p>
        </div>
    </div>

    <div class="pt-6" x-data="{editing : @entangle('editing') }" wire:init="itemLoad" wire:key="itemLoad_editing">
        <div class="pb-4">
            <div class="flex items-start pt-6">
                <div class="grid gap-3 flex-0 text-center pb-2">
                    <div class="h-10">&nbsp;</div>
                    <div class="h-10 sm:h-12">
                        <div class="flex items-center justify-center h-full">
                            &nbsp;
                        </div>
                    </div>
                    @foreach($periods_value as $index=>$period)

                        <div class="flex-0 @if($editing) grid grid-cols-3 @endif">
                            <div class="@if($editing) col-span-1 @else hidden @endif flex items-center justify-center pr-2 sm:pr-3 h-14 sm:h-16 rounded-sm @if($index >= 4) cursor-pointer @endif"
                                 x-transition:enter="transition ease-out duration-75"
                                 x-transition:enter-start="opacity-50 transform -translate-x-full"
                                 x-transition:enter-end="opacity-100 transform translate-x-0"
                            >
                                <div class="w-full h-full bg-tm-c-ff7777 rounded-sm flex items-center justify-center @if($index < 4) bg-opacity-50 @endif"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-7" viewBox="0 0 23 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g transform="translate(-378 -1008) translate(360 608) translate(0 383) translate(18 17)">
                                                            <rect width="23" height="1" y="3" fill="#FFF" rx=".5"/>
                                                            <path stroke="#FFF" d="M2.5 3.5H20.5V23.5H2.5z"/>
                                                            <rect width="1" height="11" x="6" y="8" fill="#FFF" rx=".5"/>
                                                            <rect width="1" height="11" x="11" y="8" fill="#FFF" rx=".5"/>
                                                            <rect width="7" height="1" x="8" fill="#FFF" rx=".5"/>
                                                            <rect width="1" height="11" x="16" y="8" fill="#FFF" rx=".5"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="@if($editing) col-span-2 @endif flex items-center justify-center h-14 sm:h-16 @if($errors->has('periods_value.'.$index))ring-2 ring-tm-c-ff7777 @endif">
                                <div class="w-full AppSdGothicNeoR font-bold text-tm-c-30373F text-xs 2xs:text-base sm:text-lg">
                                    <input type="text" wire:model="periods_value.{{$index}}" maxlength="30" readonly
                                           class="appearance-none font-bold px-2 h-14 sm:h-16 text-tm-c-30373F placeholder-tm-c-979b9f text-center rounded-sm focus:outline-none bg-white"
                                           placeholder="기간 입력"
                                    >
                                </div>
                            </div>

                            @for ($i = 0; $i < collect($this->count[$index] ?? 0)->max(); $i++)
                                <div class="mt-2 select-none col-span-3">
                                    <p class="whitespace-pre-line leading-2 text-sm">&nbsp;</p>
                                </div>
                            @endfor
                        </div>
                    @endforeach
                </div>

                <div class="ml-3 px-1 pb-2 flex-1 flex overflow-hidden overflow-x-scroll scrolling-touch space-x-2">
                    @foreach($addHotel->roomTypes as $index => $room_type)
                        <div class="grid gap-3">

                            <div class="h-10 text-center flex items-center justify-start sm:justify-center">
                                <div class="sticky left-0">
                                    <div class="text-white AppSdGothicNeoR font-bold">
                                        <p class="whitespace-pre">{{$room_type->name}}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                @if($method === '입금가')
                                    <div class="w-full h-10 sm:h-12 bg-white"
                                         style="--tw-bg-opacity:0.1;">
                                        <div class="h-full flex justify-around items-center AppSdGothicNeoR">
                                            <div class="text-tm-c-C1A485 px-8">
                                                <p class="whitespace-pre">입금가 (1박 기준)</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($method === '수수료')
                                    <div class="w-full h-10 sm:h-12 bg-white"
                                         style="--tw-bg-opacity:0.1;">
                                        <div class="h-full flex justify-around items-center AppSdGothicNeoR">
                                            <div class="text-tm-c-C1A485 w-40 md:w-48 text-center">
                                                <p class="whitespace-pre">사이트 판매가 (1박 기준)</p>
                                            </div>
                                            <div class="text-tm-c-C1A485 w-40 md:w-48 text-center">
                                                <p class="whitespace-pre">수수료</p>
                                            </div>
                                            <div class="text-tm-c-C1A485 w-40 md:w-48 text-center">
                                                <p class="whitespace-pre">수수료 제외 정산액</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="grid gap-3 pb-1">
                                @for($i = 0; $i < $period_count; $i++)
                                    <div>
                                        @if($method === '입금가')
                                            <div>
                                                <div class="w-full bg-white rounded-sm">
                                                    <div class="h-full flex AppSdGothicNeoR @if($errors->has('prices.'.$index.'.'.$i))ring-2 ring-tm-c-ff7777 rounded-sm @endif text-tm-c-30373F">
                                                        <div class="#px-3"
                                                             wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelItem', 'prices.{{$index}}.{{$i}}')">
                                                            <input type="text" wire:model="prices.{{$index}}.{{$i}}"
                                                                   wire:change="formatNumber('prices',{{$index}},{{$i}})"
                                                                   readonly
                                                                   @if($editing) disabled @endif
                                                                   maxlength="10"
                                                                   placeholder="입금가 입력"
                                                                   class="w-48 md:w-56 px-4 h-14 sm:h-16 appearance-none placeholder-tm-c-979b9f text-base md:text-lg text-center focus:outline-none disabled:bg-tm-c-30373F">
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')->whereTarget('prices.'.$index.'.'.$i)->get(['status','content']) as $item)
                                                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                        <p class="whitespace-pre-line AppSdGothicNeoR leading-2 text-sm">{!! $item->content !!}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @elseif($method === '수수료')
                                            <div>
                                                <div class="w-full bg-white rounded-sm">
                                                    <div class="h-full flex AppSdGothicNeoR text-tm-c-30373F @if($errors->has('sale_prices.'.$index.'.'.$i) || $errors->has('fees.'.$index.'.'.$i) || $errors->has('prices.'.$index.'.'.$i))ring-2 ring-tm-c-ff7777 rounded-sm @endif @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')->whereIn('target',['sale_prices.'.$index.'.'.$i,'fees.'.$index.'.'.$i,'prices.'.$index.'.'.$i])->whereNull('status')->count()>=1)ring-2 ring-tm-c-ff7777 rounded-sm @endif">
                                                        <div class="#px-3"
                                                             wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelItem', 'sale_prices.{{$index}}.{{$i}}')">
                                                            <input type="text" wire:model="sale_prices.{{$index}}.{{$i}}"
                                                                   wire:change="formatNumber('sale_prices',{{$index}},{{$i}})"
                                                                   wire:keyup="formatNumber('sale_prices',{{$index}},{{$i}})"
                                                                   readonly
                                                                   @if($editing) disabled @endif
                                                                   maxlength="10"
                                                                   placeholder="사이트 판매가 입력"
                                                                   class="w-40 md:w-48 px-4 h-14 sm:h-16 appearance-none placeholder-tm-c-979b9f text-base md:text-lg text-center focus:outline-none @if($editing) bg-tm-c-30373F bg-opacity-25 @endif">
                                                        </div>
                                                        <div class="#px-3"
                                                             wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelItem', 'fees.{{$index}}.{{$i}}')">
                                                            <input type="number" wire:model="fees.{{$index}}.{{$i}}"
                                                                   wire:change="formatNumber('fees',{{$index}},{{$i}})"
                                                                   wire:keyup="formatNumber('fees',{{$index}},{{$i}})"
                                                                   readonly
                                                                   @if($editing) disabled @endif
                                                                   max="100" min="15" :max="100" :min="15"
                                                                   placeholder="최소 15% 입력"
                                                                   class="w-40 md:w-48 px-4 h-14 sm:h-16 appearance-none placeholder-tm-c-979b9f text-base md:text-lg text-center focus:outline-none @if($editing) bg-tm-c-30373F bg-opacity-25 @else  @endif">
                                                        </div>
                                                        <div class="#px-3">
                                                            <input type="text" wire:model="prices.{{$index}}.{{$i}}"
                                                                   wire:change="formatNumber('prices',{{$index}},{{$i}})"
                                                                   @if($editing) disabled @endif
                                                                   maxlength="10" readonly
                                                                   placeholder="= 수수료 제외 정산액"
                                                                   class="w-40 md:w-48 px-4 h-14 sm:h-16 appearance-none placeholder-tm-c-979b9f text-base md:text-lg text-center focus:outline-none @if($editing) bg-tm-c-30373F bg-opacity-25 @endif">
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')->whereIn('target',['sale_prices.'.$index.'.'.$i,'fees.'.$index.'.'.$i,'prices.'.$index.'.'.$i])->get(['status','content']) as $item)
                                                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                        <p class="whitespace-pre-line AppSdGothicNeoR leading-2 text-sm">{!! $item->content !!}</p>
                                                    </div>
                                                @endforeach
                                                @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')
                                                        ->whereIn('target',['sale_prices.'.$index.'.'.$i,'fees.'.$index.'.'.$i,'prices.'.$index.'.'.$i])->count()
                                                        !== collect($this->count[$i] ?? 0)->max())
                                                    @for ($f = 0; $f < (collect($this->count[$i] - \App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')
                                                        ->whereIn('target',['sale_prices.'.$index.'.'.$i,'fees.'.$index.'.'.$i,'prices.'.$index.'.'.$i])->count()) ?? 0)->max(); $f++)
                                                        <div class="mt-2 select-none">
                                                            <p class="whitespace-pre-line text-sm leading-2">&nbsp;</p>
                                                        </div>
                                                    @endfor
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($period_count < 8)
            <div class="">
                <div class="h-full">
                    <div class="h-full border border-dashed @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')->whereTarget('periodCount')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else border-white @endif flex flex-wrap items-center justify-center cursor-pointer"
                         wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelItem', 'periodCount')"
                         style="#min-height: 300px;">
                        <div class="py-4 flex items-center space-x-2">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-8 mx-auto" viewBox="0 0 30 30">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#EDEDED">
                                            <g>
                                                <g>
                                                    <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                        <circle cx="15" cy="15" r="14.5"></circle>
                                                        <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="AppSdGothicNeoR text-base md:text-lg text-white pt-px">
                                기간 추가
                            </div>
                        </div>
                    </div>
                </div>

                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')->whereTarget('periodCount')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if($errors->any())
        <div class="mt-6 AppSdGothicNeoR text-tm-c-ff7777 space-y-1 px-4 py-4 ring-2 ring-tm-c-ff7777 rounded-sm">
            @if($errors->has('method'))
                <div>
                    - 입점 방식 은(는)&nbsp;{{$errors->first('method')?? ''}}
                </div>
            @endif
            @if($errors->has('periods_value.*'))
                <div>
                    - 기간 입력 은(는)&nbsp;{{$errors->first('periods_value.*')?? ''}}
                </div>
            @endif
            @if($errors->has('sale_prices.*.*'))
                <div>
                    - 사이트 판매가 은(는)&nbsp;{{$errors->first('sale_prices.*.*')?? ''}}
                </div>
            @endif
            @if($errors->has('fees.*.*'))
                <div>
                    - 수수료 은(는)&nbsp;{{$errors->first('fees.*.*')?? ''}}
                </div>
            @endif
            @if($errors->has('sale_prices.*.*')|| $errors->has('fees.*.*')|| $errors->has('prices.*.*'))
                <div>
                    - 기간별 상품 가격 입력 리스트 필수 정보 미입력 되었습니다
                </div>
            @endif
        </div>
    @endif

</div>
