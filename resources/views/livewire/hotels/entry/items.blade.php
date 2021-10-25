
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
        <div>
            <div class="py-4 AppSdGothicNeoR text-lg text-white">
                입점 방식 선택 (택 1 필수)
            </div>
            <div class="border-t-2 border-b-2 border-solid border-white">
                <div class="flex items-center border-b border-solid border-tm-c-979b9f border-opacity-50">

                    <div class="flex-0 px-4 h-full">
                        <label for="method.1" class="select-none">
                            <input type="radio" id="method.1" wire:model="method" value="입금가" class="hidden">
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
                            <input type="radio" id="method.0" wire:model="method" value="수수료" class="hidden">
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
        </div>
    </div>

    <div class="pt-3">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>※ 가격은 해당 기간에 맞는 1박 기준으로 입력하세요.</p>
        </div>
    </div>

    <div class="pt-6" x-data="{editing : @entangle('editing') }" wire:init="itemLoad">
        <div class="pb-4">
            <div class="flex items-start pt-6">
                <div class="grid @if($editing) grid-flow-row grid-cols-3 grid-row-2 @endif gap-3 flex-0 text-center pb-2">
                    <div class="h-10 @if($editing) col-span-3 @endif">&nbsp;</div>
                    <div class="@if($editing) col-span-3 @endif h-10 sm:h-12">
                        @if($period_count>=8)
                        <div class="flex items-center justify-center h-full border border-dashed border-tm-c-da5542 cursor-pointer"
                             wire:click="editingChange" wire:key="1">
                            <div class="AppSdGothicNeoR text-base md:text-lg text-tm-c-ff7777 select-none">
                                @if($editing)
                                    편집 적용하기
                                @else
                                    편집하기
                                @endif
                            </div>
                        </div>
                        @else
                            <div class="flex items-center justify-center h-full">
                                &nbsp;
                            </div>
                        @endif
                    </div>
                    @foreach($periods_value as $index=>$period)

                        <div class="flex items-center justify-center px-2 h-14 sm:h-16 bg-tm-c-ff7777 rounded-sm @if($index >= 7) cursor-pointer @else bg-opacity-50 @endif"
                             @if($index >= 7)
                             onclick="confirm('해당 기간을 삭제하시겠습니까?̊̈') || event.stopImmediatePropagation()"
                             wire:click="periodRemove('{{$index}}')" wire:key="{{$index}}"
                             @endif
                             x-show="editing" x-cloak
                             x-transition:enter="transition ease-out duration-75"
                             x-transition:enter-start="opacity-50 transform -translate-x-full"
                             x-transition:enter-end="opacity-100 transform translate-x-0"
                        >
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-8 stroke-current @if($index >= 7) text-white @else text-tm-c-979b9f @endif" viewBox="0 0 23 24">
                                    <g fill="none" fill-rule="evenodd" opacity=".3">
                                        <g>
                                            <g>
                                                <g>
                                                    <g transform="translate(-378 -720) translate(360 608) translate(0 95) translate(18 17)">
                                                        <rect width="23" height="1" y="3" rx=".5"/>
                                                        <path d="M2.5 3.5H20.5V23.5H2.5z"/>
                                                        <rect width="1" height="11" x="6" y="8" rx=".5"/>
                                                        <rect width="1" height="11" x="11" y="8" rx=".5"/>
                                                        <rect width="7" height="1" x="8" rx=".5"/>
                                                        <rect width="1" height="11" x="16" y="8" rx=".5"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="@if($editing) col-span-2  @endif flex items-center justify-center h-14 sm:h-16 @if($errors->has('periods_value.'.$index))ring-2 ring-tm-c-ff7777 @endif">
                            <div class="relative w-full AppSdGothicNeoR font-bold text-tm-c-30373F text-base sm:text-lg bg-white">
                                    <input type="text" wire:model.lazy="periods_value.{{$index}}" id="periods_value.{{$index}}" maxlength="15" @if($index <= 6) readonly @endif
                                            @if($editing) disabled @endif
                                           class="appearance-none font-bold px-6 w-full h-14 sm:h-16 text-tm-c-30373F placeholder-tm-c-979b9f text-center rounded-sm focus:outline-none"
                                           placeholder="기간 입력"
                                    >
                                @if($index === 0)
                                <div class="w-full absolute bottom-0 py-0">
                                    <div class="relative mt-4 pb-1">
                                        <div class="flex justify-center text-sm font-normal">
                                            ※ 연장 시에만 제공
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
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
                                                <p class="whitespace-pre">입금가</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($method === '수수료')
                                    <div class="w-full h-10 sm:h-12 bg-white"
                                         style="--tw-bg-opacity:0.1;">
                                        <div class="h-full flex justify-around items-center AppSdGothicNeoR">
                                            <div class="text-tm-c-C1A485 w-40 md:w-48 text-center">
                                                <p class="whitespace-pre">판매가</p>
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
                                            <div class="w-full bg-white rounded-sm">
                                                <div class="h-full flex AppSdGothicNeoR @if($errors->has('prices.'.$index.'.'.$i))ring-2 ring-tm-c-ff7777 rounded-sm @endif text-tm-c-30373F">
                                                    <div class="#px-3 px-32">
                                                        <input type="text" wire:model.lazy="prices.{{$index}}.{{$i}}" id="prices.{{$index}}.{{$i}}"
                                                               wire:change="formatNumber('prices',{{$index}},{{$i}})"
                                                               @if($editing) disabled @endif
                                                               maxlength="12"
                                                               placeholder="1박 기준 입금가 입력"
                                                               class="w-48 md:w-56 px-4 h-14 sm:h-16 appearance-none placeholder-tm-c-ff7777 text-base md:text-lg text-center focus:outline-none @if($editing) bg-tm-c-30373F bg-opacity-25 @endif">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($method === '수수료')
                                            <div class="w-full bg-white rounded-sm">
                                                <div class="h-full flex AppSdGothicNeoR @if($errors->has('sale_prices.'.$index.'.'.$i)|| $errors->has('fees.'.$index.'.'.$i)|| $errors->has('prices.'.$index.'.'.$i))ring-2 ring-tm-c-ff7777 rounded-sm @endif text-tm-c-30373F">
                                                    <div class="#px-3">
                                                        <input type="text" wire:model.lazy="sale_prices.{{$index}}.{{$i}}" id="sale_prices.{{$index}}.{{$i}}"
                                                               wire:change="formatNumber('sale_prices',{{$index}},{{$i}})"
                                                               @if($editing) disabled @endif
                                                               maxlength="12"
                                                               placeholder="1박 기준 입금가 입력"
                                                               class="w-40 md:w-48 px-4 h-14 sm:h-16 appearance-none placeholder-tm-c-ff7777 text-base md:text-lg text-center focus:outline-none @if($editing) bg-tm-c-30373F bg-opacity-25 @endif">
                                                    </div>
                                                    <div class="#px-3 pl-10">
                                                        <input type="number" wire:model.lazy="fees.{{$index}}.{{$i}}" id="fees.{{$index}}.{{$i}}"
                                                               wire:change="formatNumber('fees',{{$index}},{{$i}})"
                                                               @if($editing) disabled @endif
                                                               max="100" min="15" :max="100" :min="15"
                                                               placeholder="최소 15% 입력"
                                                               class="w-40 md:w-48 pl-6 h-14 sm:h-16 placeholder-tm-c-979b9f text-base md:text-lg text-center focus:outline-none @if($editing) bg-tm-c-30373F bg-opacity-25 @endif">
                                                    </div>
                                                    <div class="#px-3">
                                                        <input type="text" wire:model.lazy="prices.{{$index}}.{{$i}}" id="prices.{{$index}}.{{$i}}"
                                                               wire:change="formatNumber('prices',{{$index}},{{$i}})"
                                                               @if($editing) disabled @endif
                                                               maxlength="12" readonly
                                                               placeholder="= 1박 기준 수수료 제외 정산액"
                                                               class="w-48 md:w-64 h-14 sm:h-16 placeholder-tm-c-979b9f text-base md:text-lg text-center focus:outline-none @if($editing) bg-tm-c-30373F bg-opacity-25 @endif">
                                                    </div>
                                                </div>
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

        @if($period_count <8)
            <div class="">
                <div class="h-full">
                    <div class="h-full border border-dashed border-white flex flex-wrap items-center justify-center cursor-pointer"
                         wire:click="periodCount('add')"
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
                    - 판매가 은(는)&nbsp;{{$errors->first('sale_prices.*.*')?? ''}}
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

    <div class="pt-4 sm:pt-10 md:pt-16 pb-10 md:pb-16">
        <div class="flex flex-wrap md:flex-nowrap justify-center md:space-x-4 lg:space-x-6">
            <div class="mt-2 sm:mt-4 md:mt-0 order-2 md:order-1 py-4 w-full md:max-w-xs rounded-sm shadow-lg border border-solid border-white cursor-pointer"
                 wire:click="backRedirect(3)">
                <div class="AppSdGothicNeoR text-xl text-center text-white">
                    이전
                </div>
            </div>

            <div class="order-1 md:order-2 py-4 w-full md:max-w-xs rounded-sm shadow-lg @if($errors->count()=== 0)bg-tm-c-C1A485 cursor-pointer @else bg-tm-c-d7d3cf @endif"
                 @if($errors->count()=== 0)wire:click="submit" @endif>
                <div class="flex justify-center space-x-1 sm:space-x-2">
                    <div wire:loading wire:target="submit">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div class="AppSdGothicNeoR text-xl text-center text-white">
                        다음
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="hidden" x-data="{error : '{{$errors->keys()[0]}}'}" x-init="fieldError = document.getElementById(error);if(fieldError){fieldError.focus({preventScroll:false});}"></div>
    @endif
</div>
