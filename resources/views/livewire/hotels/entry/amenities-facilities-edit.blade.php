<div>
    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    어메니티
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 호텔에삶 고객에게 제공되는 서비스/물품을 모두 적어주시기 바랍니다.</p>
        </div>
    </div>

    <div class="pt-6" wire:init="amenityInit">
        <div class="relative" @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
            <input type="text" wire:model.lazy="amenity" id="amenity" maxlength="30" wire:keydown.enter="amenityAdd"
                   @if (!$edit) disabled @endif
                   class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('amenity')->whereNull('status')->count()) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                   placeholder="어메니티 입력 후 엔터 (ex: 생수, 미니 냉장고, 목욕 가운)"
            >
            @if(Str::of($amenity)->length()>=2)
                <div class="absolute top-0 right-0 h-full">
                    <div class="h-full flex items-center mr-2 sm:mr-3">
                        <div class="bg-tm-c-C1A485 rounded-sm py-2 px-4 cursor-pointer"
                            @if ($edit)
                            wire:click="amenityAdd"
                            @endif
                        >
                            <div class="AppSdGothicNeoR text-font text-sm sm:text-base text-white select-none leading-5 sm:leading-normal tracking-wider">
                                입력
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if($errors->has('amenity'))
            <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                어메니티 은(는) {{$errors->first('amenity') ?? ''}}
            </div>
        @endif
    </div>

    @if(!empty($this->amenities))
        <div class="pt-4">
            <div class="flex flex-wrap items-center content-evenly"  @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                @foreach(collect($this->amenities)->reverse() as $index => $amenity)
                    <div class="mr-2 mb-2 flex justify-center items-center h-8 pl-3 pr-2 border border-solid border-tm-c-d7d3cf rounded-full space-x-1">
                        <div class="leading-normal AppSdGothicNeoR text-base text-tm-c-d7d3cf select-none">
                            {{$amenity}}
                        </div>
                        <div class="cursor-pointer" @if($edit) wire:click="amenityRemove('{{$index}}')" wire:key="{{$index}}" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <path stroke="#D7D3CF" d="M4 15.843L15.843 4M4 4L15.843 15.843" transform="translate(-1380 -362) translate(360 228) translate(0 129) translate(954) translate(66 5)"/>
                                                        <path d="M0 0H20V20H0z" transform="translate(-1380 -362) translate(360 228) translate(0 129) translate(954) translate(66 5)"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('amenity')->whereNull('status')->get('content') as $index=>$item)
        <div class="mt-2 text-tm-c-da5542">
            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
        </div>
    @endforeach

    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    불포함 사항
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 일반 호텔고객 기준 호텔에삶 고객에게 제공되지 않는 서비스/물품을 입력해주시기 바랍니다.</p>
        </div>
    </div>
    <div class="pt-6" wire:init="withoutAmenityInit">
        <div class="relative" @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
            <input type="text" wire:model.lazy="without_amenity" id="without_amenity" maxlength="30" wire:keydown.enter="withoutAmenityAdd"
                   @if (!$edit) disabled @endif
                   class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('without_amenity')->whereNull('status')->count()) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                   placeholder="불포함 어메니티 입력 후 엔터"
            >
            @if(Str::of($without_amenity)->length()>=2)
                <div class="absolute top-0 right-0 h-full">
                    <div class="h-full flex items-center mr-2 sm:mr-3">
                        <div class="bg-tm-c-C1A485 rounded-sm py-2 px-4 cursor-pointer"
                             @if ($edit)
                             wire:click="withoutAmenityAdd"
                             @endif
                        >
                            <div class="AppSdGothicNeoR text-font text-sm sm:text-base text-white select-none leading-5 sm:leading-normal tracking-wider">
                                입력
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if($errors->has('without_amenity'))
            <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                불포함 어메니티 은(는) {{$errors->first('without_amenity') ?? ''}}
            </div>
        @endif
    </div>
    @if(!empty($this->without_amenities))
        <div class="pt-4">
            <div class="flex flex-wrap items-center content-evenly" @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
                @foreach(collect($this->without_amenities)->reverse() as $index => $without_amenity)
                    <div class="mr-2 mb-2 flex justify-center items-center h-8 pl-3 pr-2 border border-solid border-tm-c-d7d3cf rounded-full space-x-1">
                        <div class="leading-normal AppSdGothicNeoR text-base text-tm-c-d7d3cf select-none">
                            {{$without_amenity}}
                        </div>
                        <div class="cursor-pointer" @if ($edit) wire:click="withoutAmenityRemove('{{$index}}')" wire:key="without_{{$index}}" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <path stroke="#D7D3CF" d="M4 15.843L15.843 4M4 4L15.843 15.843" transform="translate(-1380 -362) translate(360 228) translate(0 129) translate(954) translate(66 5)"/>
                                                        <path d="M0 0H20V20H0z" transform="translate(-1380 -362) translate(360 228) translate(0 129) translate(954) translate(66 5)"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('without_amenity')->whereNull('status')->get('content') as $index=>$item)
        <div class="mt-2 text-tm-c-da5542">
            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
        </div>
    @endforeach


    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    부대시설
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 호텔 내 부대시설(피트니스 센터, 편의점 등)을 추가해주시기 바랍니다.</p>
        </div>
    </div>




{{--    @if(auth()->check() && auth()->user()->hasAnyRole('개발'))--}}
    <div @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>
        @foreach($facility_categories as $tabIndex=>$facility_category)
            <div class="my-8" wire:init="initializeFacilities">
                <div>
                    <div class="text-white text-base mb-2">{{ $facility_category }} 시설</div>
                    <div class="flex space-x-2">
                        @foreach($detailed_categories[$tabIndex] as $depthIndex=>$detailed_category)
                            @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                            @endif
                            <div @if(isset($facility_name[$tabIndex][$depthIndex]) && $facility_name[$tabIndex][$depthIndex] === $detailed_category)
                                 x-data="{ clicked : true }"
                                 @else
                                 x-data="{ clicked : false }"
                                @endif
                            >
                                <button class="w-full border border-1 border-solid border-white p-2 px-4 rounded-full cursor-pointer outline-none"
                                     @if (!$edit) disabled @endif
                                     x-on:click="clicked = !clicked"
                                     x-bind:class="{ 'bg-white' : clicked }">
                                    <div class="flex items-center justify-between">
                                        <div class="AppSdGothicNeoR text-base"
                                             x-bind:class="{ 'text-tm-c-d7d3cf' : !clicked, 'text-tm-c-292f36' : clicked }">
                                            {{ $detailed_category }}
                                        </div>
                                        <div x-show="clicked" x-cloak>
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                                <g stroke="#30373F" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3.25 12.475 12.725 3M3.25 3l9.475 9.475"/>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </button>
                                <div class="mr-4 flex space-x-4 my-4" x-show="clicked" x-cloak>
                                    <div class="space-y-4 text-white">
                                        <div>
                                            <div class="w-5/12 pt-1 pb-2">위치</div>
                                            <textarea @if (!$edit) disabled @endif
                                                      placeholder="ex. 호텔 내부 2층"
                                                      wire:model="facility_infos.{{$tabIndex}}.{{$depthIndex}}.location"
                                                      class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                            </textarea>
                                        </div>
                                        <div>
                                            <div class="w-5/12 pt-1 pb-2">이용 시간</div>
                                            <textarea @if (!$edit) disabled @endif
                                                        placeholder="@if($detailed_category === '레스토랑')ex. - 조식 : 07:00 ~ 10:00 - 중식 : 12:00 ~ 14:30 - 석식 : 18:00 ~ 21:30 @else ex. - 월~금 : 07:00 ~ 19:00 - 토~일, 공휴일 : 09:00 ~ 16:00 - 24시간 운영 등 @endif"
                                                      wire:model="facility_infos.{{$tabIndex}}.{{$depthIndex}}.time"
                                                      class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                            </textarea>
                                        </div>
                                        <div>
                                            <div class="w-5/12 pt-1 pb-2">이용 금액</div>
                                            <textarea @if (!$edit) disabled @endif
                                                        placeholder="@if($detailed_category === '세탁실') ex. - 세탁기 1,000원 - 건조기 1,000원 - 세제 자판기 500원 - 섬유유연제 자판기 500원 @else ex. 무료 시설인 경우, 무료 시설로 작성. 유료 시설인 경우, 하단의 예시처럼 작성 - 일반 고객 이용 금액 10,000원 - 호텔에삶 고객 이용 금액 : 8,000원 @endif"
                                                      wire:model="facility_infos.{{$tabIndex}}.{{$depthIndex}}.cost"
                                                      class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                            </textarea>
                                        </div>
                                        <div>
                                            <div class="w-5/12 pt-1 pb-2">주의 사항</div>
                                            <textarea @if (!$edit) disabled @endif
                                                placeholder="@if($detailed_category === '라운지' || $detailed_category === '바' || $detailed_category === '피트니스 센터' || $detailed_category === '수영장' || $detailed_category === '사우나' || $detailed_category === '비즈니스 센터' || $detailed_category === '미팅룸')ex. 사전 예약제, 이용 시 프론트 문의, 입장 인원 제한 등 이용 주의사항 기재 @else정보 입력@endif"
                                                wire:model="facility_infos.{{$tabIndex}}.{{$depthIndex}}.caution"
                                                class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        @endforeach
        <div x-data="{ added : false }">
            <div class="text-white text-base mb-2">시설 추가</div>
            <button class="flex flex-0 bg-tm-c-C1A485 p-2 rounded-full cursor-pointer w-max-content text-white mb-2 outline-none" @if (!$edit) disabled @endif x-on:click="added = !added" >추가하기 +</button>
            <div x-show="added" x-cloak>
                <input type="text" class="mb-2 w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" wire:model.lazy="added_facility" wire:keydown.enter="addFacilities">
            </div>

            @if(!empty($added_facilities))
                <div class="flex space-x-4">
                    @foreach($added_facilities as $index=>$added_facility)
                        <div>
                            <div class="border border-1 border-solid border-white p-2 px-4 rounded-full cursor-pointer bg-white">
                                <div class="flex items-center justify-between ">
                                    <div class="AppSdGothicNeoR text-base">
                                        {{ $added_facility }}
                                    </div>
                                    <div wire:click="deleteFacility({{ $index }})">
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                            <g stroke="#30373F" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3.25 12.475 12.725 3M3.25 3l9.475 9.475"/>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-4 my-8">
                                <div class="text-white">
                                    <div class="border-b border-white mb-4 pb-2"> {{ $added_facility }} </div>
                                    <div>
                                        <div class="w-5/12 pt-1 pb-2">위치</div>
                                        <textarea   @if (!$edit) disabled @endif
                                                    placeholder="ex. 호텔 내부 2층"
                                                    wire:model="added_infos.{{$index}}.location"
                                                    class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                        </textarea>
                                    </div>
                                    <div>
                                        <div class="w-5/12 pt-1 pb-2">이용 시간</div>
                                        <textarea   @if (!$edit) disabled @endif
                                                    placeholder="ex. - 월~금 : 07:00 ~ 19:00 - 토~일, 공휴일 : 09:00 ~ 16:00 - 24시간 운영 등"
                                                    wire:model="added_infos.{{$index}}.time"
                                                    class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                        </textarea>
                                    </div>
                                    <div>
                                        <div class="w-5/12 pt-1 pb-2">이용 금액</div>
                                        <textarea   @if (!$edit) disabled @endif
                                                    placeholder="ex. 무료 시설인 경우, 무료 시설로 작성. 유료 시설인 경우, 하단의 예시처럼 작성 - 일반 고객 이용 금액 10,000원 - 호텔에삶 고객 이용 금액 : 8,000원"
                                                    wire:model="added_infos.{{$index}}.cost"
                                                    class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                        </textarea>
                                    </div>
                                    <div>
                                        <div class="w-5/12 pt-1 pb-2">주의 사항</div>
                                        <textarea @if (!$edit) disabled @endif
                                            placeholder="정보 입력"
                                            wire:model="added_infos.{{$index}}.caution"
                                            class="w-full appearance-none resize-none px-4 sm:pb-5 sm:pt-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
{{--    @endif--}}



{{--    <div class="pt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3" wire:init="facilityInit">--}}
{{--        @for ($i = 0; $i < collect($facility)->count(); $i++)--}}
{{--            <div class="space-y-1">--}}
{{--                <div class="w-full flex-1">--}}
{{--                    <div class="relative" @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>--}}
{{--                        <input type="text" wire:model.lazy="facility.{{$i}}.name" id="facility.{{$i}}.name" maxlength="30"--}}
{{--                               @if (!$edit)--}}
{{--                               disabled--}}
{{--                               @endif--}}
{{--                               class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.name')->whereNull('status')->count()) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"--}}
{{--                               placeholder="부대시설 입력"--}}
{{--                        >--}}
{{--                    </div>--}}
{{--                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.name')->whereNull('status')->get('content') as $index=>$item)--}}
{{--                        <div class="mt-2 text-tm-c-da5542">--}}
{{--                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    @if($errors->has('facility.'.$i.'.name'))--}}
{{--                        <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">--}}
{{--                            부대시설 은(는) {{$errors->first('facility.'.$i.'.name') ?? ''}}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="w-full flex-1">--}}
{{--                    <div class="relative" @if(!$edit) x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})" @endif>--}}
{{--                        <textarea wire:model.lazy="facility.{{$i}}.explanation" id="facility.{{$i}}.explanation"--}}
{{--                                  @if (!$edit)--}}
{{--                                      disabled--}}
{{--                                  @endif--}}
{{--                                  rows="5" placeholder="시설 현황(출입 가능 여부나 이용 시간 등) 입력"--}}
{{--                                  class="w-full appearance-none resize-none py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.explanation')->whereNull('status')->count()) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none"--}}
{{--                                  maxlength="150"--}}
{{--                        ></textarea>--}}
{{--                    </div>--}}
{{--                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.explanation')->whereNull('status')->get('content') as $index=>$item)--}}
{{--                        <div class="mt-2 text-tm-c-da5542">--}}
{{--                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    @if($errors->has('facility.'.$i.'.explanation'))--}}
{{--                        <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">--}}
{{--                            상세 설명 은(는) {{$errors->first('facility.'.$i.'.explanation') ?? ''}}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

{{--                <div class="w-full py-3 bg-tm-c-ff7777 rounded-sm @if($i===0) bg-opacity-50 cursor-default @else cursor-pointer @endif"--}}
{{--                     @if($i!==0)--}}
{{--                     @if ($edit)--}}
{{--                     wire:click="facilityRemove('{{$i}}')" wire:key="facilityRemove_{{$i}}"--}}
{{--                     @else--}}
{{--                     x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"--}}
{{--                     @endif--}}
{{--                    @endif>--}}
{{--                    <div class="h-full flex items-center justify-center">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 20 20">--}}
{{--                            <g fill="none" fill-rule="evenodd">--}}
{{--                                <g>--}}
{{--                                    <g>--}}
{{--                                        <g>--}}
{{--                                            <g>--}}
{{--                                                <g>--}}
{{--                                                    <g transform="translate(-950 -981) translate(360 228) translate(0 99) translate(0 584) translate(410 58) translate(180 12)">--}}
{{--                                                        <rect width="20" height="1" y="2.5" fill="#FFF" rx=".5"/>--}}
{{--                                                        <path stroke="#FFF" d="M2.239 3H17.761V19.5H2.239z"/>--}}
{{--                                                        <rect width="1" height="9.167" x="5.217" y="6.667" fill="#FFF" rx=".5"/>--}}
{{--                                                        <rect width="1" height="9.167" x="9.565" y="6.667" fill="#FFF" rx=".5"/>--}}
{{--                                                        <rect width="6.087" height="1" x="6.957" fill="#FFF" rx=".5"/>--}}
{{--                                                        <rect width="1" height="9.167" x="13.913" y="6.667" fill="#FFF" rx=".5"/>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                </g>--}}
{{--                            </g>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityRemove.'.$i)->whereNull('status')->get('content') as $index=>$item)--}}
{{--                    <div class="mt-2 text-tm-c-da5542">--}}
{{--                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endfor--}}

{{--        @if(collect($facility)->count() < $facility_limit)--}}
{{--            <div>--}}
{{--                <div class="border border-dashed @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityCountAdd')->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif cursor-pointer py-20"--}}
{{--                     @if ($edit)--}}
{{--                     wire:click="facilityCountAdd"--}}
{{--                     @else--}}
{{--                     x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"--}}
{{--                     @endif--}}
{{--                     wire:key="facilityCountAdd">--}}
{{--                    <div class="w-full h-full flex items-center justify-center">--}}
{{--                        <div>--}}
{{--                            <div class="flex justify-center pb-2">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">--}}
{{--                                    <g fill="none" fill-rule="evenodd">--}}
{{--                                        <g stroke="#EDEDED">--}}
{{--                                            <g>--}}
{{--                                                <g>--}}
{{--                                                    <g transform="translate(-486 -726) translate(360 552) translate(0 99) translate(126 75)">--}}
{{--                                                        <circle cx="15" cy="15" r="14.5"/>--}}
{{--                                                        <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                            <div class="AppSdGothicNeoR font-medium text-lg text-white">--}}
{{--                                부대시설 추가--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityCountAdd')->whereNull('status')->get('content') as $index=>$item)--}}
{{--                    <div class="mt-2 text-tm-c-da5542">--}}
{{--                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}

    @if($errors->any())
        <div class="hidden" x-data="{error : '{{$errors->keys()[0]}}'}" x-init="fieldError = document.getElementById(error);if(fieldError){fieldError.focus({preventScroll:false});}"></div>
    @endif
</div>
