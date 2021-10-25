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
        <div class="relative">
            <input type="text" wire:model="amenity" maxlength="30" readonly
                   wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelAmenity', 'amenity')"
                   class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('amenity')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                   placeholder="어메니티 입력 후 엔터 (ex: 생수, 미니 냉장고, 목욕 가운)"
            >
            @if(Str::of($amenity)->length()>=2)
                <div class="absolute top-0 right-0 h-full">
                    <div class="h-full flex items-center mr-2 sm:mr-3">
                        <div class="bg-tm-c-C1A485 rounded-sm py-2 px-4 cursor-pointer"
                             wire:click="amenityAdd">
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
            <div class="flex flex-wrap items-start content-evenly">
                @foreach(collect($this->amenities)->reverse() as $index => $amenity)
                    <div class="w-max-content mr-2 mb-2 flex justify-center items-center h-8 pl-3 pr-2 border border-solid border-tm-c-d7d3cf rounded-full space-x-1">
                        <div class="leading-normal AppSdGothicNeoR text-base text-tm-c-d7d3cf select-none">
                            {{$amenity}}
                        </div>
                        <div class="cursor-pointer">
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
    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('amenity')->get(['status','content']) as $item)
        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
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
        <div class="relative">
            <input type="text" wire:model="without_amenity" maxlength="30" readonly
                   wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelAmenity', 'without_amenity')"
                   class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('without_amenity')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                   placeholder="불포함 어메니티 입력 후 엔터"
            >
            @if(Str::of($without_amenity)->length()>=2)
                <div class="absolute top-0 right-0 h-full">
                    <div class="h-full flex items-center mr-2 sm:mr-3">
                        <div class="bg-tm-c-C1A485 rounded-sm py-2 px-4 cursor-pointer"
                             wire:click="withoutAmenityAdd">
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
            <div class="flex flex-wrap items-start content-evenly">
                @foreach(collect($this->without_amenities)->reverse() as $index => $without_amenity)
                    <div class="w-max-content mr-2 mb-2 flex justify-center items-center h-8 pl-3 pr-2 border border-solid border-tm-c-d7d3cf rounded-full space-x-1">
                        <div class="leading-normal AppSdGothicNeoR text-base text-tm-c-d7d3cf select-none">
                            {{$without_amenity}}
                        </div>
                        <div class="cursor-pointer">
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
    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelAmenity')->whereTarget('without_amenity')->get(['status','content']) as $item)
        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
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

    <div class="pt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3" wire:init="facilityInit">
        @for ($i = 0; $i < collect($facility)->count(); $i++)
            <div class="space-y-1">
                <div class="w-full flex-1">
                    <div class="relative">
                        <input type="text" wire:model="facility.{{$i}}.name" maxlength="30" readonly
                               wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelFacility', 'facility.{{$i}}.name')"
                               class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.name')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                               placeholder="부대시설 입력"
                        >
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.name')->get(['status','content']) as $item)
                        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                    @if($errors->has('facility.'.$i.'.name'))
                        <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                            부대시설 은(는) {{$errors->first('facility.'.$i.'.name') ?? ''}}
                        </div>
                    @endif
                </div>
                <div class="w-full flex-1">
                    <div class="relative">
                        <textarea wire:model="facility.{{$i}}.explanation" readonly
                                  wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelFacility', 'facility.{{$i}}.explanation')"
                                  rows="5" placeholder="시설 현황(출입 가능 여부나 이용 시간 등) 입력"
                                  class="w-full appearance-none resize-none py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.explanation')->whereNull('status')->count()) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white leading-normal focus:outline-none"
                                  maxlength="150"
                        ></textarea>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facility.'.$i.'.explanation')->get(['status','content']) as $item)
                        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                    @if($errors->has('facility.'.$i.'.explanation'))
                        <div class="mt-2 AppSdGothicNeoR text-tm-c-da5542">
                            상세 설명 은(는) {{$errors->first('facility.'.$i.'.explanation') ?? ''}}
                        </div>
                    @endif
                </div>

                <div>
                    <div class="w-full py-3 bg-tm-c-ff7777 rounded-sm @if($i===0) bg-opacity-50 cursor-default @else cursor-pointer @endif"
                         wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelFacility', 'facilityRemove.{{$i}}')">
                        <div class="h-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 @if($i===0) stroke-current text-tm-c-979b9f @else stroke-current text-white @endif" viewBox="0 0 20 20">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g transform="translate(-787 -882) translate(360 552) translate(295 99) translate(0 52) translate(0 166) translate(132 13)">
                                                            <rect width="20" height="1" y="2.5" rx=".5"/>
                                                            <path d="M2.239 3H17.761V19.5H2.239z"/>
                                                            <rect width="1" height="9.167" x="5.217" y="6.667" rx=".5"/>
                                                            <rect width="1" height="9.167" x="9.565" y="6.667" rx=".5"/>
                                                            <rect width="6.087" height="1" x="6.957" rx=".5"/>
                                                            <rect width="1" height="9.167" x="13.913" y="6.667" rx=".5"/>
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

                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityRemove.'.$i)->get(['status','content']) as $item)
                        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endfor

        @if(collect($facility)->count() < $facility_limit)
            <div>
                <div class="border border-dashed @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityCountAdd')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else border-white @endif cursor-pointer py-20"
                     wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelFacility', 'facilityCountAdd')">
                    <div class="w-full h-full flex items-center justify-center">
                        <div>
                            <div class="flex justify-center pb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#EDEDED">
                                            <g>
                                                <g>
                                                    <g transform="translate(-486 -726) translate(360 552) translate(0 99) translate(126 75)">
                                                        <circle cx="15" cy="15" r="14.5"/>
                                                        <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="AppSdGothicNeoR font-medium text-lg text-white">
                                부대시설 추가
                            </div>
                        </div>
                    </div>
                </div>
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelFacility')->whereTarget('facilityCountAdd')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
