<div>
    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    호텔 정보
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 이미지는 최대 6장까지 등록 가능하며, 룸 이미지는 제외하고 등록해주시기 바랍니다.</p>
            <p>* 4:3 비율의 이미지를 업로드 바랍니다.</p>
        </div>
    </div>
    {{-- 이미지 레이아웃 부분 --}}
    <div class="pt-8 md:pt-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelImage', 'hotelImage1')">
                    <div class="absolute w-full h-full box-border @if(!$hotelImage1 || $errors->has('hotelImage1')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                        <div class="w-full h-full select-none">
                            <div class="w-full h-full flex flex-wrap items-center justify-center">
                                @if ($hotelImage1 && !$errors->has('hotelImage1'))
                                    <div class="w-full h-full relative">
                                        <img
                                            @if( !is_string($hotelImage1) && $hotelImage1->temporaryUrl()!==null)
                                            src="{{ $hotelImage1->temporaryUrl() }}"
                                            @else
                                            src="https://d2pyzcqibfhr70.cloudfront.net/{{ $hotelImage1 }}"
                                            @endif
                                            class="w-full h-full">
                                    </div>
                                @else
                                    <div class="w-full text-center">
                                        <div class="w-full flex justify-center pb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g stroke="#EDEDED">
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                    <circle cx="15" cy="15" r="14.5"/>
                                                                    <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="w-full AppSdGothicNeoR font-medium text-base xs:text-lg text-white">
                                            <span class="text-tm-c-C1A485">호텔 외관</span> 이미지 등록 (필수)
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelImage')->whereTarget('hotelImage1')->get(['status','content']) as $item)
                        <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                            <div class="h-full flex items-center justify-center">
                                <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('hotelImage1') <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>

            <div>
                <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelImage', 'hotelImage2')">
                    <div class="absolute w-full h-full box-border @if (!$hotelImage2 || $errors->has('hotelImage2')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                        <div class="w-full h-full select-none">
                            <div class="w-full h-full flex flex-wrap items-center justify-center">
                                @if ($hotelImage2 && !$errors->has('hotelImage2'))
                                    <div class="w-full h-full relative">
                                        <img
                                            @if( !is_string($hotelImage2) && $hotelImage2->temporaryUrl()!==null)
                                            src="{{ $hotelImage2->temporaryUrl() }}"
                                            @else
                                            src="https://d2pyzcqibfhr70.cloudfront.net/{{ $hotelImage2 }}"
                                            @endif
                                            class="w-full h-full">
                                    </div>
                                @else
                                    <div class="w-full text-center">
                                        <div class="w-full flex justify-center pb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g stroke="#EDEDED">
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                    <circle cx="15" cy="15" r="14.5"/>
                                                                    <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="w-full AppSdGothicNeoR font-medium text-base xs:text-lg text-white">
                                            <span class="text-tm-c-C1A485">로비</span> 이미지 등록 (필수)
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelImage')->whereTarget('hotelImage2')->get(['status','content']) as $item)
                        <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                            <div class="h-full flex items-center justify-center">
                                <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('hotelImage2') <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>

            <div>
                <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelImage', 'hotelImage3')">
                    <div class="absolute w-full h-full box-border @if (!$hotelImage3 || $errors->has('hotelImage3')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                        <div class="w-full h-full select-none">
                            <div class="w-full h-full flex flex-wrap items-center justify-center">
                                @if ($hotelImage3 && !$errors->has('hotelImage3'))
                                    <div class="w-full h-full relative">
                                        <img
                                            @if( !is_string($hotelImage3) && $hotelImage3->temporaryUrl()!==null)
                                            src="{{ $hotelImage3->temporaryUrl() }}"
                                            @else
                                            src="https://d2pyzcqibfhr70.cloudfront.net/{{ $hotelImage3 }}"
                                            @endif
                                            class="w-full h-full">
                                    </div>
                                @else
                                    <div class="w-full text-center">
                                        <div class="w-full flex justify-center pb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g stroke="#EDEDED">
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                    <circle cx="15" cy="15" r="14.5"/>
                                                                    <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="w-full AppSdGothicNeoR font-medium text-base xs:text-lg text-white">
                                            <span class="text-tm-c-C1A485">리셉션</span> 이미지 등록 (필수)
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelImage')->whereTarget('hotelImage3')->get(['status','content']) as $item)
                        <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                            <div class="h-full flex items-center justify-center">
                                <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('hotelImage3') <div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>

        </div>
    </div>

    <div class="pt-4">
        <div class="grid grid-cols-3 gap-4">
            {{-- 1 --}}
            <div>
                <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelImage', 'hotelImageOptional1')">
                    <div class="absolute w-full h-full box-border @if(!$hotelImageOptional1 || $errors->has('hotelImageOptional1')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                        <div class="w-full h-full select-none">
                            <div class="w-full h-full flex flex-wrap items-center justify-center">
                                @if ($hotelImageOptional1 && !$errors->has('hotelImageOptional1'))
                                    <div class="w-full h-full relative">
                                        <img
                                            @if( !is_string($hotelImageOptional1) && $hotelImageOptional1->temporaryUrl()!==null)
                                            src="{{ $hotelImageOptional1->temporaryUrl() }}"
                                            @else
                                            src="https://d2pyzcqibfhr70.cloudfront.net/{{ $hotelImageOptional1 }}"
                                            @endif
                                            class="w-full h-full">
                                    </div>
                                @else
                                    <div class="w-full text-center">
                                        <div class="w-full flex justify-center pb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g stroke="#EDEDED">
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                    <circle cx="15" cy="15" r="14.5"/>
                                                                    <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="w-full AppSdGothicNeoR font-medium text-sm xs:text-base sm:text-lg text-white">
                                            <span class="text-tm-c-C1A485">추가</span> 이미지 등록 (선택)
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelImage')->whereTarget('hotelImageOptional1')->get(['status','content']) as $item)
                        <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                            <div class="h-full flex items-center justify-center">
                                <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('hotelImageOptional1')<div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>

            {{-- 2 --}}
            <div>
                <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelImage', 'hotelImageOptional2')">
                    <div class="absolute w-full h-full box-border @if(!$hotelImageOptional2 || $errors->has('hotelImageOptional2')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                        <div class="w-full h-full select-none">
                            <div class="w-full h-full flex flex-wrap items-center justify-center">
                                @if ($hotelImageOptional2 && !$errors->has('hotelImageOptional2'))
                                    <div class="w-full h-full relative">
                                        <img
                                            @if( !is_string($hotelImageOptional2) && $hotelImageOptional2->temporaryUrl()!==null)
                                            src="{{ $hotelImageOptional2->temporaryUrl() }}"
                                            @else
                                            src="https://d2pyzcqibfhr70.cloudfront.net/{{ $hotelImageOptional2 }}"
                                            @endif
                                            class="w-full h-full">
                                    </div>
                                @else
                                    <div class="w-full text-center">
                                        <div class="w-full flex justify-center pb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g stroke="#EDEDED">
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                    <circle cx="15" cy="15" r="14.5"/>
                                                                    <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="w-full AppSdGothicNeoR font-medium text-sm xs:text-base sm:text-lg text-white">
                                            <span class="text-tm-c-C1A485">추가</span> 이미지 등록 (선택)
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelImage')->whereTarget('hotelImageOptional2')->get(['status','content']) as $item)
                        <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                            <div class="h-full flex items-center justify-center">
                                <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('hotelImageOptional2')<div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>

            {{-- 3 --}}
            <div>
                <div class="relative pb-3/4" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelImage', 'hotelImageOptional3')">
                    <div class="absolute w-full h-full box-border @if(!$hotelImageOptional3 || $errors->has('hotelImageOptional3')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                        <div class="w-full h-full select-none">
                            <div class="w-full h-full flex flex-wrap items-center justify-center">
                                @if ($hotelImageOptional3 && !$errors->has('hotelImageOptional3'))
                                    <div class="w-full h-full relative">
                                        <img
                                            @if( !is_string($hotelImageOptional3) && $hotelImageOptional3->temporaryUrl()!==null)
                                            src="{{ $hotelImageOptional3->temporaryUrl() }}"
                                            @else
                                            src="https://d2pyzcqibfhr70.cloudfront.net/{{ $hotelImageOptional3 }}"
                                            @endif
                                            class="w-full h-full">
                                    </div>
                                @else
                                    <div class="w-full text-center">
                                        <div class="w-full flex justify-center pb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g stroke="#EDEDED">
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                    <circle cx="15" cy="15" r="14.5"/>
                                                                    <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="w-full AppSdGothicNeoR font-medium text-sm xs:text-base sm:text-lg text-white">
                                            <span class="text-tm-c-C1A485">추가</span> 이미지 등록 (선택)
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelImage')->whereTarget('hotelImageOptional3')->get(['status','content']) as $item)
                        <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                            <div class="h-full flex items-center justify-center">
                                <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('hotelImageOptional3')<div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="pt-6">
        <div class="space-y-4">
            <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotel', 'name')">
                <input type="text" wire:model="name" maxlength="30" readonly
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotel')->whereTarget('name')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else text-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="호텔명 입력"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotel')->whereTarget('name')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @error('name')<div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>
            <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotel', 'area')">
                <input type="text" wire:model="area" maxlength="50" readonly
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotel')->whereTarget('area')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else text-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="도로명 주소 입력"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotel')->whereTarget('area')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @error('area')<div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>
            <div wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotel', 'subwayStation')">
                <input type="text" wire:model="subwayStation" maxlength="50" readonly
                       class="w-full py-4 sm:py-5 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotel')->whereTarget('subwayStation')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else text-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                       placeholder="가까운 지하철역과 도보 시간 입력"
                >
                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotel')->whereTarget('subwayStation')->get(['status','content']) as $item)
                    <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                        <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                    </div>
                @endforeach
                @error('subwayStation')<div class="mt-2 text-tm-c-da5542">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="pt-6 md:pt-10">
        <div class="flex items-center">
            <div class="pr-3 sm:pr-4">
                <div class="AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-C1A485">
                    체크포인트
                </div>
            </div>
            <div class="flex-1 border-t border-dashed border-tm-c-C1A485"></div>
        </div>
    </div>
    <div class="pt-6">
        <div class="AppSdGothicNeoR tracking-wide text-base sm:text-lg text-tm-c-C1A485 leading-5 lg:leading-7 space-y-2" style="text-indent: -.6em;margin-left: .6em;">
            <p>* 등록하는 이미지는 호텔 오픈 시, 호텔에삶이 임의로 수정/교체할 수 있습니다.</p>
            <p>* 위치성에 대한 체크포인트는 필수로 포함하여 등록하여 주시기 바랍니다.</p>
            <p>* 호텔에삶 기존 입점 파트너사 페이지의 체크포인트를 참고하여 작성해주시기 바랍니다.</p>
            <p>* 4:3 비율의 이미지를 업로드 바랍니다.</p>
        </div>
    </div>
    <div class="pt-6">
        <div class="flex">
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-4">

                    <div>
                        <div class="flex flex-wrap">
                            <div class="relative w-full md:pb-full">
                                <div class="md:absolute">
                                    <img src="https://d2pyzcqibfhr70.cloudfront.net/checkpoint/61/2021-05-18/1/u9xRVpC6t5t3GblrNVteRSnAsmlTUuO21q1cBQ8V.jpg"
                                         class="object-center object-cover" alt="예시">
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="AppSdGothicNeoR text-white">
                                    <div class="AppSdGothicNeoR text-lg sm:text-xl font-bold pt-4 sm:pt-5">
                                        위치성 (예시)
                                    </div>
                                    <div class="AppSdGothicNeoR text-sm xs:text-base sm:text-lg md:text-base leading-5 2xs:leading-6 md:leading-5 lg:leading-6 pt-3 sm:pt-4">
                                        홍대입구역에서 도보 1분 거리로 교통이 매우 편리
                                        합니다. 또한 홍대 거리, 연남동 등의 핫플레이스
                                        와 인접하고, AK&Plaza와 무신사 테라스 가든이
                                        호텔 내에 위치하여 지인들과 함께 즐거운 주말을
                                        보낼 수도 있습니다.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="h-full">
                            <div class="relative w-full pb-full" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointImage1')">
                                <div class="absolute w-full h-full box-border @if(!$checkpointImage1 || $errors->has('checkpointImage1')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                    <div class="w-full h-full select-none">
                                        <div class="w-full h-full flex flex-wrap items-center justify-center">
                                            @if ($checkpointImage1 && !$errors->has('checkpointImage1'))
                                                <div class="w-full h-full relative">
                                                    <img
                                                        @if( !is_string($checkpointImage1) && $checkpointImage1->temporaryUrl()!==null)
                                                        src="{{ $checkpointImage1->temporaryUrl() }}"
                                                        @else
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/{{ $checkpointImage1 }}"
                                                        @endif
                                                        class="w-full h-full">
                                                </div>
                                            @else
                                                <div class="w-full text-center">
                                                    <div class="w-full flex justify-center pb-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <g stroke="#EDEDED">
                                                                    <g>
                                                                        <g>
                                                                            <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                                <circle cx="15" cy="15" r="14.5"/>
                                                                                <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="w-full AppSdGothicNeoR font-medium text-sm xs:text-base sm:text-lg text-white">
                                                        이미지 등록 (필수)
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointImage1')->get(['status','content']) as $item)
                        <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                                        <div class="h-full flex items-center justify-center">
                                            <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w-full">
                                <div class="h-full AppSdGothicNeoR text-white">
                                    <div class="AppSdGothicNeoR text-lg sm:text-xl font-bold pt-2">
                                        <input type="text" wire:model="checkpointTitle1" placeholder="체크포인트 1 (20자 이내)" maxlength="20" readonly wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointTitle1')"
                                               class="AppSdGothicNeoR font-bold text-sm xs:text-base sm:text-lg md:text-base leading-5 2xs:leading-6 md:leading-5 lg:leading-6 w-full h-full px-2 py-2 bg-transparent border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointTitle1')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else text-white @endif text-white placeholder-tm-c-979b9f focus:outline-none">
                                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointTitle1')->get(['status','content']) as $item)
                                            <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="pt-1">
                                        <textarea wire:model="checkpointExplanation1" rows="4" placeholder="체크포인트 설명 (180자 이내)" maxlength="180" readonly wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointExplanation1')"
                                                  class="AppSdGothicNeoR text-sm xs:text-base sm:text-lg md:text-base leading-5 2xs:leading-6 md:leading-5 lg:leading-6 w-full h-full px-2 py-2 bg-transparent border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointExplanation1')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else text-white @endif text-white placeholder-tm-c-979b9f resize-none focus:outline-none"></textarea>
                                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointExplanation1')->get(['status','content']) as $item)
                                            <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if($errors->hasAny(['checkpointImage1','checkpointTitle1','checkpointExplanation1']))
                                <div class="mt-1 text-tm-c-da5542 leading-tight">
                                    @error('checkpointImage1')<p>{{ $message }}</p>@enderror
                                    @error('checkpointTitle1')<p>{{ $message }}</p>@enderror
                                    @error('checkpointExplanation1')<p>{{ $message }}</p>@enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <div class="h-full">
                            <div class="relative w-full pb-full" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointImage2')">
                                <div class="absolute w-full h-full box-border @if(!$checkpointImage2 || $errors->has('checkpointImage2')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                    <div class="w-full h-full select-none">
                                        <div class="w-full h-full flex flex-wrap items-center justify-center">
                                            @if ($checkpointImage2 && !$errors->has('checkpointImage2'))
                                                <div class="w-full h-full relative">
                                                    <img
                                                        @if( !is_string($checkpointImage2) && $checkpointImage2->temporaryUrl()!==null)
                                                        src="{{ $checkpointImage2->temporaryUrl() }}"
                                                        @else
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/{{ $checkpointImage2 }}"
                                                        @endif
                                                        class="w-full h-full">
                                                </div>
                                            @else
                                                <div class="w-full text-center">
                                                    <div class="w-full flex justify-center pb-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <g stroke="#EDEDED">
                                                                    <g>
                                                                        <g>
                                                                            <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                                <circle cx="15" cy="15" r="14.5"/>
                                                                                <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="w-full AppSdGothicNeoR font-medium text-sm xs:text-base sm:text-lg text-white">
                                                        이미지 등록 (필수)
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointImage2')->get(['status','content']) as $item)
                                    <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                                        <div class="h-full flex items-center justify-center">
                                            <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w-full">
                                <div class="h-full AppSdGothicNeoR text-white">
                                    <div class="AppSdGothicNeoR text-lg sm:text-xl font-bold pt-2">
                                        <input type="text" wire:model="checkpointTitle2" placeholder="체크포인트 2 (20자 이내)" readonly maxlength="20" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointTitle2')"
                                               class="AppSdGothicNeoR font-bold text-sm xs:text-base sm:text-lg md:text-base leading-5 2xs:leading-6 md:leading-5 lg:leading-6 w-full h-full px-2 py-2 bg-transparent border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointTitle2')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else text-white @endif placeholder-tm-c-979b9f focus:outline-none">
                                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointTitle2')->get(['status','content']) as $item)
                                            <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="pt-1">
                                        <textarea wire:model="checkpointExplanation2" rows="4" placeholder="체크포인트 설명 (180자 이내)" readonly maxlength="180" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointExplanation2')"
                                                  class="AppSdGothicNeoR text-sm xs:text-base sm:text-lg md:text-base leading-5 2xs:leading-6 md:leading-5 lg:leading-6 w-full h-full px-2 py-2 bg-transparent border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointExplanation2')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else text-white @endif placeholder-tm-c-979b9f resize-none focus:outline-none"></textarea>
                                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointExplanation2')->get(['status','content']) as $item)
                                            <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if($errors->hasAny(['checkpointImage2','checkpointTitle1','checkpointExplanation2']))
                                <div class="mt-1 text-tm-c-da5542 leading-tight">
                                    @error('checkpointImage2')<p>{{ $message }}</p>@enderror
                                    @error('checkpointTitle2')<p>{{ $message }}</p>@enderror
                                    @error('checkpointExplanation2')<p>{{ $message }}</p>@enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <div class="h-full">
                            <div class="relative w-full pb-full" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointImage3')">
                                <div class="absolute w-full h-full box-border @if(!$checkpointImage3 || $errors->has('checkpointImage3')) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                    <div class="w-full h-full select-none">
                                        <div class="w-full h-full flex flex-wrap items-center justify-center">
                                            @if ($checkpointImage3 && !$errors->has('checkpointImage3'))
                                                <div class="w-full h-full relative">
                                                    <img
                                                        @if( !is_string($checkpointImage3) && $checkpointImage3->temporaryUrl()!==null)
                                                        src="{{ $checkpointImage3->temporaryUrl() }}"
                                                        @else
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/{{ $checkpointImage3 }}"
                                                        @endif
                                                        class="w-full h-full">
                                                </div>
                                            @else
                                                <div class="w-full text-center">
                                                    <div class="w-full flex justify-center pb-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <g stroke="#EDEDED">
                                                                    <g>
                                                                        <g>
                                                                            <g transform="translate(-945 -446) translate(360 228) translate(410 99) translate(175 119)">
                                                                                <circle cx="15" cy="15" r="14.5"/>
                                                                                <path d="M8.038 14.737L21.437 14.737M14.737 21.437L14.737 8.038"/>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="w-full AppSdGothicNeoR font-medium text-sm xs:text-base sm:text-lg text-white">
                                                        이미지 등록 (필수)
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointImage3')->get(['status','content']) as $item)
                                    <div class="absolute w-full h-full @if($item->status === '확인') bg-orange-400 @elseif($item->status === '수정 확인') bg-tm-c-77b1ff @else bg-tm-c-da5542 @endif bg-opacity-75">
                                        <div class="h-full flex items-center justify-center">
                                            <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w-full">
                                <div class="h-full AppSdGothicNeoR text-white">
                                    <div class="AppSdGothicNeoR text-lg sm:text-xl font-bold pt-2">
                                        <input type="text" wire:model="checkpointTitle3" placeholder="체크포인트 3 (20자 이내)" readonly maxlength="20" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointTitle3')"
                                               class="AppSdGothicNeoR font-bold text-sm xs:text-base sm:text-lg md:text-base leading-5 2xs:leading-6 md:leading-5 lg:leading-6 w-full h-full px-2 py-2 bg-transparent border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointTitle3')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else border-white @endif text-white placeholder-tm-c-979b9f focus:outline-none">
                                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointTitle3')->get(['status','content']) as $item)
                                            <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="pt-1">
                                        <textarea wire:model="checkpointExplanation3" rows="4" placeholder="체크포인트 설명 (180자 이내)" readonly maxlength="180" wire:click="$emitUp('CoreEventNeedToModify' , 'AddHotelCheckPoint', 'checkpointExplanation3')"
                                                  class="AppSdGothicNeoR text-sm xs:text-base sm:text-lg md:text-base leading-5 2xs:leading-6 md:leading-5 lg:leading-6 w-full h-full px-2 py-2 bg-transparent border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointExplanation3')->whereNull('status')->count()>=1) border-tm-c-ff7777 @else border-white @endif text-white placeholder-tm-c-979b9f resize-none focus:outline-none"></textarea>
                                        @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelCheckPoint')->whereTarget('checkpointExplanation3')->get(['status','content']) as $item)
                                            <div class="mt-2 @if($item->status === '확인') text-orange-400 @elseif($item->status === '수정 확인') text-tm-c-77b1ff @else text-tm-c-da5542 @endif">
                                                <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if($errors->hasAny(['checkpointImage3','checkpointTitle3','checkpointExplanation3']))
                                <div class="mt-1 text-tm-c-da5542 leading-tight">
                                    @error('checkpointImage3')<p>{{ $message }}</p>@enderror
                                    @error('checkpointTitle3')<p>{{ $message }}</p>@enderror
                                    @error('checkpointExplanation3')<p>{{ $message }}</p>@enderror
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
