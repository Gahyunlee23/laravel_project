<div>
    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    공통 베네핏
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 모든 룸타입 상품에 제공할 수 있는 혜택을 추가해주세요. </p>
            <p>* 베네핏 추가로 상품의 매력도를 상승 시킬 수 있습니다.</p>
            <p>* 베네핏 설명 텍스트는 호텔에삶이 임의로 기입해둔 것으로, 수정이 가능합니다.</p>
        </div>
    </div>

    <div>
        {{--ㄱㆍㄴㆍㄷㆍㄹ--}}
        <div class="pt-8">
            <div class="overflow-hidden" x-data="{ show : true }">
                <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                    <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                        ㄱㆍㄴㆍㄷㆍㄹ
                    </div>
                    <div class="absolute top-0 right-0">
                        <div class="transform transition duration-300" :class="{
                            'rotate-180' : show
                        }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                        </g>
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
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                     x-transition:enter="transition ease-in duration-200"
                     x-transition:enter-start="transform opacity-0 -translate-y-4"
                     x-transition:enter-end="transform opacity-100 translate-y-0"

                     x-transition:leave="transition ease-out duration-200"
                     x-transition:leave-start="transform opacity-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 -translate-y-4">
                    @foreach (\App\Icon::whereBetween('name', ['가','깋'])->orWhereBetween('name', ['나','닣'])->orWhereBetween('name', ['다','딯'])->orWhereBetween('name', ['라','맇'])->get() as $item)
                        <label @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                            <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                    <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                        {!! $item->content !!}
                                    </svg>
                                </div>
                                <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                    {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                </div>
                                <div class="pr-4">
                                    <input type="checkbox" wire:model="benefit.{{$item->id}}" wire:change="needToModifyCheck('공통ㆍㄱㆍㄴㆍㄷㆍㄹ')"
                                           @if(!$edit)
                                           disabled
                                           @endif value="{{$item->id}}" class="hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        @if(isset($benefit[$item->id]) && $benefit[$item->id] > 0 && $benefit[$item->id] !== false)
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
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
                                                            <g>
                                                                <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('공통ㆍㄱㆍㄴㆍㄷㆍㄹ')->whereNull('status')->get('content') as $item)
                    <div class="mt-2 text-tm-c-da5542">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        {{--ㅁㆍㅂㆍㅅㆍㅇ--}}
        <div class="pt-5 md:pt-8">
            <div class="overflow-hidden" x-data="{ show : true }">
                <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                    <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                        ㅁㆍㅂㆍㅅㆍㅇ
                    </div>
                    <div class="absolute top-0 right-0">
                        <div class="transform transition duration-300" :class="{
                            'rotate-180' : show
                        }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                        </g>
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
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                     x-transition:enter="transition ease-in duration-200"
                     x-transition:enter-start="transform opacity-0 -translate-y-4"
                     x-transition:enter-end="transform opacity-100 translate-y-0"

                     x-transition:leave="transition ease-out duration-200"
                     x-transition:leave-start="transform opacity-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 -translate-y-4">
                    @foreach (\App\Icon::whereBetween('name', ['마','밓'])->orWhereBetween('name', ['바','빟'])->orWhereBetween('name', ['사','싷'])->orWhereBetween('name', ['아','잏'])->get() as $item)
                        <label @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                            <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                    <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                        {!! $item->content !!}
                                    </svg>
                                </div>
                                <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                    {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                </div>
                                <div class="pr-4">
                                    <input type="checkbox" wire:model="benefit.{{$item->id}}" wire:change="needToModifyCheck('공통ㆍㅁㆍㅂㆍㅅㆍㅇ')"
                                           @if(!$edit)
                                           disabled
                                           @endif value="{{$item->id}}" class="hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        @if(isset($benefit[$item->id]) && $benefit[$item->id] > 0 && $benefit[$item->id] !== false)
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
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
                                                            <g>
                                                                <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('공통ㆍㅁㆍㅂㆍㅅㆍㅇ')->whereNull('status')->get('content') as $item)
                    <div class="mt-2 text-tm-c-da5542">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        {{--ㅈㆍㅊㆍㅋㆍㅌ--}}
        <div class="pt-5 md:pt-8">
            <div class="overflow-hidden" x-data="{ show : true }">
                <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                    <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                        ㅈㆍㅊㆍㅋㆍㅌ
                    </div>
                    <div class="absolute top-0 right-0">
                        <div class="transform transition duration-300" :class="{
                            'rotate-180' : show
                        }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                        </g>
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
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                     x-transition:enter="transition ease-in duration-200"
                     x-transition:enter-start="transform opacity-0 -translate-y-4"
                     x-transition:enter-end="transform opacity-100 translate-y-0"

                     x-transition:leave="transition ease-out duration-200"
                     x-transition:leave-start="transform opacity-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 -translate-y-4">
                    @foreach (\App\Icon::whereBetween('name', ['자','짛'])->orWhereBetween('name', ['차','칳'])->orWhereBetween('name', ['카','킿'])->orWhereBetween('name', ['타','팋'])->get() as $item)
                        <label  @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                            <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                    <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                        {!! $item->content !!}
                                    </svg>
                                </div>
                                <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                    {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                </div>
                                <div class="pr-4">
                                    <input type="checkbox" wire:model="benefit.{{$item->id}}" wire:change="needToModifyCheck('공통ㆍㅈㆍㅊㆍㅋㆍㅌ')"
                                           @if(!$edit)
                                           disabled
                                           @endif value="{{$item->id}}" class="hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        @if(isset($benefit[$item->id]) && $benefit[$item->id] > 0 && $benefit[$item->id] !== false)
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
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
                                                            <g>
                                                                <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('공통ㆍㅈㆍㅊㆍㅋㆍㅌ')->whereNull('status')->get('content') as $item)
                    <div class="mt-2 text-tm-c-da5542">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        {{--ㅍㆍㅎ--}}
        <div class="pt-5 md:pt-8">
            <div class="overflow-hidden" x-data="{ show : true }">
                <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                    <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                        ㅍㆍㅎ
                    </div>
                    <div class="absolute top-0 right-0">
                        <div class="transform transition duration-300" :class="{
                            'rotate-180' : show
                        }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                        </g>
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
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                     x-transition:enter="transition ease-in duration-200"
                     x-transition:enter-start="transform opacity-0 -translate-y-4"
                     x-transition:enter-end="transform opacity-100 translate-y-0"

                     x-transition:leave="transition ease-out duration-200"
                     x-transition:leave-start="transform opacity-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 -translate-y-4">
                    @foreach (\App\Icon::whereBetween('name', ['파','핗'])->orWhereBetween('name', ['하','힣'])->get() as $item)
                        <label @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                            <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                    <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                        {!! $item->content !!}
                                    </svg>
                                </div>
                                <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                    {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                </div>
                                <div class="pr-4">
                                    <input type="checkbox" wire:model="benefit.{{$item->id}}" value="{{$item->id}}" wire:change="needToModifyCheck('공통ㆍㅍㆍㅎ')"
                                           @if(!$edit)
                                           disabled
                                           @endif class="hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        @if(isset($benefit[$item->id]) && $benefit[$item->id] > 0 && $benefit[$item->id] !== false)
                                            <g fill="none" fill-rule="evenodd">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
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
                                                            <g>
                                                                <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                    <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                    <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('공통ㆍㅍㆍㅎ')->whereNull('status')->get('content') as $item)
                    <div class="mt-2 text-tm-c-da5542">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        {{--추가 베네핏--}}
        <div class="pt-6">
            <div @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                <input type="text" wire:model.lazy="benefit_names" maxlength="30"
                       @if(!$edit)
                       disabled
                       @endif
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelItem')->whereTarget('benefit_names')->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="베네핏 추가 입력 (ex: 웰컴드링크, 목욕 가운 등)"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('benefit_names')->whereNull('status')->get('content') as $item)
                    <div class="mt-2 text-tm-c-da5542">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @if($errors->has('benefit_names'))
                    <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                        {{$errors->first('benefit_names') ?? ''}}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="pt-16 md:pt-20">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    기간 베네핏
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 상품 기간별로 제공할 수 있는 혜택을 추가해주세요.</p>
            <p>* 기간은 수정이 가능합니다.</p>
        </div>
    </div>

    <div class="space-y-8 divide-y-2 divide-dotted divide-tm-c-ED">
        @for($i=0;$i<$period_count;$i++)
            <div>
                <div class="pt-8">
                    <div @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                        <input type="text" wire:model.lazy="period.{{$i}}" id="period.{{$i}}" maxlength="50"
                               @if(!$edit)
                               disabled
                               @endif
                               class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('period.'.$i)->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                               placeholder="기간 입력 예시 - 1주 이상, 3주 이상, 한달 상품"
                        >
                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('period.'.$i)->whereNull('status')->get('content') as $item)
                            <div class="mt-2 text-tm-c-da5542">
                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                            </div>
                        @endforeach
                        @if($errors->has('period.'.$i))
                            <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                {{$errors->first('period.'.$i) ?? ''}}
                            </div>
                        @endif
                    </div>
                </div>
                {{--ㄱㆍㄴㆍㄷㆍㄹ--}}
                <div class="pt-5 md:pt-8">
                    <div class="overflow-hidden" x-data="{ show : false }">
                        <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                            <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                                ㄱㆍㄴㆍㄷㆍㄹ
                            </div>
                            <div class="absolute top-0 right-0">
                                <div class="transform transition duration-300" :class="{
                                    'rotate-180' : show
                                }">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                                </g>
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
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                             x-transition:enter="transition ease-in duration-200"
                             x-transition:enter-start="transform opacity-0 -translate-y-4"
                             x-transition:enter-end="transform opacity-100 translate-y-0"

                             x-transition:leave="transition ease-out duration-200"
                             x-transition:leave-start="transform opacity-100 translate-y-0"
                             x-transition:leave-end="transform opacity-0 -translate-y-4">
                            @foreach (\App\Icon::whereBetween('name', ['가','깋'])->orWhereBetween('name', ['나','닣'])->orWhereBetween('name', ['다','딯'])->orWhereBetween('name', ['라','맇'])->get() as $item)
                                <label  @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                                    <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                        <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                            <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                                {!! $item->content !!}
                                            </svg>
                                        </div>
                                        <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                            {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                        </div>
                                        <div class="pr-4">
                                            <input type="checkbox" wire:model="period_benefit.{{$i}}.{{$item->id}}" wire:change="needToModifyCheck('기간ㆍㄱㆍㄴㆍㄷㆍㄹ.{{$i}}')"
                                                   @if(!$edit)
                                                   disabled
                                                   @endif value="{{$item->id}}" class="hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                @if(isset($period_benefit[$i][$item->id]) && $period_benefit[$i][$item->id] > 0 && $period_benefit[$i][$item->id] !== false)
                                                    <g fill="none" fill-rule="evenodd">
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
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
                                                                    <g>
                                                                        <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                @endif
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('기간ㆍㄱㆍㄴㆍㄷㆍㄹ.'.$i)->whereNull('status')->get('content') as $item)
                            <div class="mt-2 text-tm-c-da5542">
                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--ㅁㆍㅂㆍㅅㆍㅇ--}}
                <div class="pt-5 md:pt-8">
                    <div class="overflow-hidden" x-data="{ show : false }">
                        <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                            <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                                ㅁㆍㅂㆍㅅㆍㅇ
                            </div>
                            <div class="absolute top-0 right-0">
                                <div class="transform transition duration-300" :class="{
                                    'rotate-180' : show
                                }">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                                </g>
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
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                             x-transition:enter="transition ease-in duration-200"
                             x-transition:enter-start="transform opacity-0 -translate-y-4"
                             x-transition:enter-end="transform opacity-100 translate-y-0"

                             x-transition:leave="transition ease-out duration-200"
                             x-transition:leave-start="transform opacity-100 translate-y-0"
                             x-transition:leave-end="transform opacity-0 -translate-y-4">
                            @foreach (\App\Icon::whereBetween('name', ['마','밓'])->orWhereBetween('name', ['바','빟'])->orWhereBetween('name', ['사','싷'])->orWhereBetween('name', ['아','잏'])->get() as $item)
                                <label  @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                                    <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                        <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                            <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                                {!! $item->content !!}
                                            </svg>
                                        </div>
                                        <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                            {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                        </div>
                                        <div class="pr-4">
                                            <input type="checkbox" wire:model="period_benefit.{{$i}}.{{$item->id}}" wire:change="needToModifyCheck('기간ㆍㅁㆍㅂㆍㅅㆍㅇ.{{$i}}')"
                                                   @if(!$edit)
                                                   disabled
                                                   @endif value="{{$item->id}}" class="hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                @if(isset($period_benefit[$i][$item->id]) && $period_benefit[$i][$item->id] > 0 && $period_benefit[$i][$item->id] !== false)
                                                    <g fill="none" fill-rule="evenodd">
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
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
                                                                    <g>
                                                                        <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                @endif
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('기간ㆍㅁㆍㅂㆍㅅㆍㅇ.'.$i)->whereNull('status')->get('content') as $item)
                            <div class="mt-2 text-tm-c-da5542">
                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--ㅈㆍㅊㆍㅋㆍㅌ--}}
                <div class="pt-5 md:pt-8">
                    <div class="overflow-hidden" x-data="{ show : false }">
                        <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                            <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                                ㅈㆍㅊㆍㅋㆍㅌ
                            </div>
                            <div class="absolute top-0 right-0">
                                <div class="transform transition duration-300" :class="{
                                    'rotate-180' : show
                                }">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                                </g>
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
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                             x-transition:enter="transition ease-in duration-200"
                             x-transition:enter-start="transform opacity-0 -translate-y-4"
                             x-transition:enter-end="transform opacity-100 translate-y-0"

                             x-transition:leave="transition ease-out duration-200"
                             x-transition:leave-start="transform opacity-100 translate-y-0"
                             x-transition:leave-end="transform opacity-0 -translate-y-4">
                            @foreach (\App\Icon::whereBetween('name', ['자','짛'])->orWhereBetween('name', ['차','칳'])->orWhereBetween('name', ['카','킿'])->orWhereBetween('name', ['타','팋'])->get() as $item)
                                <label  @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                                    <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                        <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                            <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                                {!! $item->content !!}
                                            </svg>
                                        </div>
                                        <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                            {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                        </div>
                                        <div class="pr-4">
                                            <input type="checkbox" wire:model="period_benefit.{{$i}}.{{$item->id}}" wire:change="needToModifyCheck('기간ㆍㅈㆍㅊㆍㅋㆍㅌ.{{$i}}')"
                                                   @if(!$edit)
                                                   disabled
                                                   @endif value="{{$item->id}}" class="hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                @if(isset($period_benefit[$i][$item->id]) && $period_benefit[$i][$item->id] > 0 && $period_benefit[$i][$item->id] !== false)
                                                    <g fill="none" fill-rule="evenodd">
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
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
                                                                    <g>
                                                                        <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                @endif
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('기간ㆍㅈㆍㅊㆍㅋㆍㅌ.'.$i)->whereNull('status')->get('content') as $item)
                            <div class="mt-2 text-tm-c-da5542">
                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--ㅍㆍㅎ--}}
                <div class="pt-5 md:pt-8">
                    <div class="overflow-hidden" x-data="{ show : false }">
                        <div class="py-3 relative border-b border-solid border-white" x-on:click="show=!show">
                            <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">
                                ㅍㆍㅎ
                            </div>
                            <div class="absolute top-0 right-0">
                                <div class="transform transition duration-300" :class="{
                                    'rotate-180' : show
                                }">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <path fill="#30373F" d="M0 0H1920V2930H0z" transform="translate(-1510 -2196)"/>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1510 -2196) translate(334 1612) translate(0 487) translate(0 97) matrix(1 0 0 -1 1176 24) matrix(1 0 0 -1 0 24)"/>
                                                                </g>
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
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40" x-show="show" x-cloak
                             x-transition:enter="transition ease-in duration-200"
                             x-transition:enter-start="transform opacity-0 -translate-y-4"
                             x-transition:enter-end="transform opacity-100 translate-y-0"

                             x-transition:leave="transition ease-out duration-200"
                             x-transition:leave-start="transform opacity-100 translate-y-0"
                             x-transition:leave-end="transform opacity-0 -translate-y-4">
                            @foreach (\App\Icon::whereBetween('name', ['파','핗'])->orWhereBetween('name', ['하','힣'])->get() as $item)
                                <label  @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                                    <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                                        <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                                            <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                                {!! $item->content !!}
                                            </svg>
                                        </div>
                                        <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                                            {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                                        </div>
                                        <div class="pr-4">
                                            <input type="checkbox" wire:model="period_benefit.{{$i}}.{{$item->id}}" wire:change="needToModifyCheck('기간ㆍㅍㆍㅎ.{{$i}}')"
                                                   @if(!$edit)
                                                   disabled
                                                   @endif value="{{$item->id}}" class="hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                @if(isset($period_benefit[$i][$item->id]) && $period_benefit[$i][$item->id] > 0 && $period_benefit[$i][$item->id] !== false)
                                                    <g fill="none" fill-rule="evenodd">
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
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
                                                                    <g>
                                                                        <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                                            <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                @endif
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('기간ㆍㅍㆍㅎ.'.$i)->whereNull('status')->get('content') as $item)
                            <div class="mt-2 text-tm-c-da5542">
                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--기간 별 추가 베네핏--}}
                <div class="pt-6">
                    <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
                        <p>* 베네핏 설명 텍스트는 호텔에삶이 임의로 기입해둔 것으로, 수정이 가능합니다.</p>
                    </div>
                </div>
                <div class="pt-6">
                    <div @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                        <input type="text" wire:model.lazy="period_benefit_names.{{$i}}" maxlength="50"
                               @if(!$edit)
                               disabled
                               @endif
                               class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('period_benefit_names.'.$i)->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                               placeholder="베네핏 추가 입력 (ex: 웰컴드링크, 목욕 가운 등)"
                        >
                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('period_benefit_names.'.$i)->whereNull('status')->get('content') as $item)
                            <div class="mt-2 text-tm-c-da5542">
                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                            </div>
                        @endforeach
                        @if($errors->has('period_benefit_names.'.$i))
                            <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                                {{$errors->first('period_benefit_names.'.$i) ?? ''}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endfor
    </div>
    @if($period_count>1)
        <div class="pt-6">
            <div class="py-3 sm:py-4 bg-tm-c-ff7777 rounded-sm flex items-center justify-center space-x-2 cursor-pointer"
                 wire:click="periodCount('sub')">
                <div class="AppSdGothicNeoR font-medium text-lg text-white leading-5">삭제</div>
            </div>
        </div>
    @endif

    <div class="pt-6">
        <div class="py-3 sm:py-4 border border-dashed @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('periodCountAdd')->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif flex items-center justify-center space-x-2 cursor-pointer"
             @if($edit)
             wire:click="periodCount('add')"
             @else
             x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
            @endif
        >
            <div>
                <svg viewBox="0 0 30 30" version="1.1" class="w-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="상품-등록-페이지" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Addhotel_3-2_PC" transform="translate(-883.000000, -1762.000000)" stroke="#EDEDED">
                            <g id="02_benfit_term" transform="translate(334.000000, 1612.000000)">
                                <g id="btn_addterm" transform="translate(0.000000, 135.000000)">
                                    <g id="ic_more" transform="translate(549.000000, 15.000000)">
                                        <circle id="Oval" transform="translate(15.000000, 15.000000) rotate(-360.000000) translate(-15.000000, -15.000000) " cx="15" cy="15" r="14.5"></circle>
                                        <line x1="8.03774418" y1="14.7373046" x2="21.436865" y2="14.7373046" id="Path-2" transform="translate(14.737305, 14.737305) rotate(-360.000000) translate(-14.737305, -14.737305) "></line>
                                        <line x1="14.7373046" y1="21.436865" x2="14.7373046" y2="8.03774418" id="Path-2-Copy" transform="translate(14.737305, 14.737305) rotate(-360.000000) translate(-14.737305, -14.737305) "></line>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="AppSdGothicNeoR font-medium text-lg text-white leading-5">기간 추가</div>
        </div>
        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('periodCountAdd')->whereNull('status')->get('content') as $item)
            <div class="mt-2 text-tm-c-da5542">
                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
            </div>
        @endforeach
    </div>

    <div class="pt-16 md:pt-20">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    호텔에삶 Only 베네핏
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>

    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 선택한 공통/기간별 베네핏 중에서 호텔에삶 고객에게만 제공되는 “호텔에삶 Only” 베네핏을 선택해주세요.</p>
            <p>* "호텔에삶 Only" 베네핏이 없을 시 다음 버튼을 클릭하시면 됩니다.</p>
        </div>
    </div>

    <div class="pt-5 md:pt-8">
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:pr-32 lg:pr-40">
            @foreach (\App\Icon::whereIn('id', collect($this->period_benefit)->collapse()->merge(collect($this->benefit)) ?? [])->get() as $item)
                <label  @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                    <div class="py-3 lg:py-4 flex items-center justify-between bg-white rounded-sm">
                        <div class="pl-3 pr-4 border-r border-solid border-tm-c-30373F">
                            <svg class="py-px" width="42" height="42" viewBox="0 0 42 42">
                                {!! $item->content !!}
                            </svg>
                        </div>
                        <div class="flex-1 pl-4 sm:pl-2 md:pl-3 AppSdGothicNeoR text-tm-c-30373F text-sm">
                            {{$item->name }}{{$item->explanation !== null ? ' '.$item->explanation :''}}
                        </div>
                        <div class="pr-4">
                            <input type="checkbox" wire:model="only_benefit.{{$item->id}}"
                                   @if(!$edit)
                                   disabled
                                   @endif
                                   value="{{$item->id}}" class="hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                @if(isset($only_benefit[$item->id]) && $only_benefit[$item->id] > 0 && $only_benefit[$item->id] !== false)
                                    <g fill="none" fill-rule="evenodd">
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g transform="translate(-1042 -754) translate(360 228) translate(0 460) translate(371 45) translate(311 21)">
                                                            <circle cx="12" cy="12" r="12" fill="#C1A485"/>
                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                        </g>
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
                                                    <g>
                                                        <g transform="translate(-671 -461) translate(360 228) translate(0 167) translate(0 45) translate(311 21)">
                                                            <circle cx="12" cy="12" r="12" fill="#D7D3CF"/>
                                                            <path stroke="#FFF" stroke-width="2" d="M7.405 10.84L10.701 15.025 17.005 8.625"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                @endif
                            </svg>
                        </div>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('only_benefit.'.$item->id)->whereNull('status')->get('content') as $item)
                        <div class="mt-2 text-tm-c-da5542">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                </label>
            @endforeach
        </div>
    </div>

    {{--추가 Only 베네핏--}}
    <div class="pt-6">
        <div @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
            <input type="text" wire:model.lazy="only_benefit_names" maxlength="50"
                   @if(!$edit)
                   disabled
                   @endif
                   class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('only_benefit_names')->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                   placeholder="호텔에삶 Only 베네핏 추가 입력 (ex: 웰컴드링크, 목욕 가운 등)"
            >
            @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelBenefit')->whereTarget('only_benefit_names')->whereNull('status')->get('content') as $item)
                <div class="mt-2 text-tm-c-da5542">
                    <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                </div>
            @endforeach
            @if($errors->has('only_benefit_names'))
                <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                    {{$errors->first('only_benefit_names') ?? ''}}
                </div>
            @endif
        </div>
    </div>
    @if($errors->any())
        <div class="hidden" x-data="{error : '{{$errors->keys()[0]}}'}" x-init="fieldError = document.getElementById(error);if(fieldError){fieldError.focus({preventScroll:false});}"></div>
    @endif

</div>
