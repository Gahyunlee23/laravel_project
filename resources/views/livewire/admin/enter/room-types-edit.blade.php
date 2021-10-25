<div>
    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    룸 타입
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5" style="text-indent: -.6em;margin-left: .6em;">
            * 등록하는 이미지는 호텔 오픈 시, 호텔에삶이 임의로 수정/교체할 수 있습니다.
        </div>
    </div>

    {{-- 이미지 레이아웃 부분 --}}
    <div class="pt-8 md:pt-12 pb-20">
        <div class="#room-types-swiper-container #swiper-container #overflow-visible">

            <div class="#swiper-wrapper grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($room_type as $i=>$item)
                    @continue($i===0)
                    @continue($item===null)
                    <div class="#swiper-slide">
                        <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelRoomTypeImage', 'room_type_image_1.{{$i}}')">
                            <div class="absolute w-full h-full box-border
                                @error('room_type_image_1.'.$i) border border-solid border-white rounded-sm bg-white @enderror
                            @if (empty($room_type_image_1[$i])) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                <div class="w-full h-full select-none">
                                    <div class="w-full h-full flex flex-wrap items-center justify-center">
                                        @if (isset( $room_type_image_1[$i]) && $room_type_image_1[$i]!==null && $room_type_image_1[$i]!=='' && !$errors->has('room_type_image_1.'.$i))
                                            <div class="w-full h-full relative">
                                                <img
                                                    @if( $room_type_image_1[$i]!==null && $room_type_image_1[$i]!=='')
                                                    @if(!is_string($room_type_image_1[$i]))
                                                    @if($room_type_image_1[$i]->temporaryUrl()!==null)
                                                    src="{{ $room_type_image_1[$i]->temporaryUrl() }}"
                                                    @else
                                                    src="https://d2pyzcqibfhr70.cloudfront.net/{{ $room_type_image_1[$i] }}"
                                                    @endif
                                                    @elseif(is_string($room_type_image_1[$i]))
                                                    src="https://d2pyzcqibfhr70.cloudfront.net/{{ $room_type_image_1[$i] }}"
                                                    @endif
                                                    @endif
                                                    class="w-full h-full">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_image_1.'.$i)->get(['status','content']) as $item)
                                <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                                    <div class="h-full flex items-center justify-center">
                                        <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-2 gap-3 pt-3">
                            <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelRoomTypeImage', 'room_type_image_2.{{$i}}')">
                                <div class="absolute w-full h-full box-border
                                    @error('room_type_image_2.'.$i) border border-solid border-white rounded-sm bg-white @enderror
                                @if(empty($room_type_image_2[$i])) border border-solid border-white rounded-sm bg-white @endif"
                                     style="--tw-bg-opacity:0.1;">
                                    <div class="w-full h-full select-none">
                                        <div class="w-full h-full flex flex-wrap items-center justify-center">
                                            @if (isset($room_type_image_2[$i]) && $room_type_image_2[$i]!==null && $room_type_image_2[$i]!=='' && !$errors->has('room_type_image_2.'.$i))
                                                <div class="w-full h-full relative">
                                                    <img
                                                        @if( $room_type_image_2[$i]!==null && $room_type_image_2[$i]!=='')
                                                        @if(!is_string($room_type_image_2[$i]) && $room_type_image_2[$i]->temporaryUrl()!==null)
                                                        src="{{ $room_type_image_2[$i]->temporaryUrl() }}"
                                                        @elseif(is_string($room_type_image_2[$i]))
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/{{ $room_type_image_2[$i] }}"
                                                        @endif
                                                        @endif
                                                        class="w-full h-full">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_image_2.'.$i)->get(['status','content']) as $item)
                                    <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                                        <div class="h-full flex items-center justify-center">
                                            <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelRoomTypeImage', 'room_type_image_3.{{$i}}')">
                                <div class="absolute w-full h-full box-border
                                @error('room_type_image_3.'.$i) border border-solid border-white rounded-sm bg-white @enderror
                                @if (empty($room_type_image_3[$i])) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                    <div class="w-full h-full select-none">
                                        <div class="w-full h-full flex flex-wrap items-center justify-center">
                                            @if (isset($room_type_image_3[$i]) && $room_type_image_3[$i]!==null && $room_type_image_3[$i]!=='' && !$errors->has('room_type_image_3'.$i))
                                                <div class="w-full h-full relative">
                                                    <img
                                                        @if( $room_type_image_3[$i]!==null && $room_type_image_3[$i]!=='')
                                                        @if(!is_string($room_type_image_3[$i]) && $room_type_image_3[$i]->temporaryUrl()!==null)
                                                        src="{{ $room_type_image_3[$i]->temporaryUrl() }}"
                                                        @elseif(is_string($room_type_image_3[$i]))
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/{{ $room_type_image_3[$i] }}"
                                                        @endif
                                                        @endif
                                                        class="w-full h-full">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_image_3.'.$i)->get(['status','content']) as $item)
                                    <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                                        <div class="h-full flex items-center justify-center">
                                            <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-3">
                            <div class="space-y-3">
                                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelRoomTypeImage', 'room_type_name.{{$i}}')">
                                    <input type="text" wire:model="room_type_name.{{$i}}" readonly
                                           class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_name.'.$i)->whereNull('status')->count()>=1) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                           placeholder="룸 이름">
                                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_name.'.$i)->get(['status','content']) as $item)
                                        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelRoomTypeImage', 'room_type_main_explanation.{{$i}}')">
                                    <input type="text" wire:model="room_type_main_explanation.{{$i}}" readonly
                                           class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_main_explanation.'.$i)->whereNull('status')->count()>=1) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                           placeholder="침대 종류 + 개수 (ex: 싱글 침대 2개)">
                                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_main_explanation.'.$i)->get(['status','content']) as $item)
                                        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="relative" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelRoomTypeImage', 'room_type_sub_explanation.{{$i}}')">
                                    <input type="text" wire:model="room_type_sub_explanation.{{$i}}" readonly
                                           class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_sub_explanation.'.$i)->whereNull('status')->count()>=1) border-tm-c-ff7777 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                           placeholder="룸 면적">
                                    <div class="absolute top-0 right-0 mt-4 sm:mt-5 mr-4">
                                        <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">m²</div>
                                    </div>
                                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_sub_explanation.'.$i)->get(['status','content']) as $item)
                                        <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @error('room_type_image_1.'.$i) <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
                        @error('room_type_image_2.'.$i) <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
                        @error('room_type_image_3.'.$i) <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
                        @error('room_type_name.'.$i) <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
                        @error('room_type_main_explanation.'.$i) <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
                        @error('room_type_sub_explanation.'.$i) <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
                    </div>
                @endforeach

                @if(collect($room_type)->count() <= 8)
                    <div class="h-full relative"
                         wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelRoomTypeImage', 'countAdd')">
                        <div class="w-full h-full border border-dashed border-white flex flex-wrap items-center justify-center cursor-pointer">
                            <div class="py-20">
                                <div class="pb-4">
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
                                <div class="AppSdGothicNeoR text-base md:text-lg text-white">
                                    룸 타입 추가 등록
                                </div>
                            </div>
                        </div>

                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('countAdd')->get(['status','content']) as $item)
                            <div class="absolute top-0 w-full h-full bg-tm-c-da5542 bg-opacity-50">
                                <div class="h-full flex items-center justify-center">
                                    <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
