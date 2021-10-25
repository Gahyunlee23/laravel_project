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
                        <div class="relative pb-3/4" x-data="{ show : true }" x-on:click.away="show=true"
                                 @if(!$edit) x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                                @endif>
                            <div class="absolute w-full h-full box-border
                                @error('room_type_image_1.'.$i) border border-solid border-white rounded-sm bg-white @enderror
                            @if (empty($room_type_image_1[$i])) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                <div class="w-full h-full select-none">
                                    <div
                                        class="w-full h-full flex flex-wrap items-center justify-center"
                                        x-data="{ isUploading: false, progress: 0 , deleteBox: false }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                                        @if($edit)
                                        x-on:click.away="deleteBox=false"
                                        @endif
                                    >
                                        @if($edit)
                                        <input type="text" wire:model.lazy="room_type_image_1.{{$i}}" class="hidden">
                                        <input type="file" id="room_type_image_1.{{$i}}" wire:model.lazy="room_type_image_1.{{$i}}" class="hidden">
                                        @endif
                                        @if (isset( $room_type_image_1[$i]) && $room_type_image_1[$i]!==null && $room_type_image_1[$i]!=='' && !$errors->has('room_type_image_1.'.$i))
                                            <div class="w-full h-full relative">
                                                <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                                                     :class="{
                                                'visible cursor-pointer' : deleteBox,
                                                'invisible' : !deleteBox
                                             }"
                                                     x-cloak
                                                     @if($edit)
                                                     onclick="imageRemover('room_type_image_1','{{$i}}');"
                                                     @endif
                                                >
                                                    <div class="h-full flex justify-center items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 sm:w-12" viewBox="0 0 86 86" >
                                                            <g fill="none" fill-rule="evenodd">
                                                                <g stroke="#EDEDED">
                                                                    <g>
                                                                        <g>
                                                                            <g transform="translate(-507 -434) translate(360 228) translate(0 99) rotate(45 -34.853 283.137)">
                                                                                <circle cx="30" cy="30" r="29.5"/>
                                                                                <path d="M16.075 29.475L42.874 29.475M29.475 42.874L29.475 16.075"/>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
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
                                                    class="w-full h-full"
                                                    :class="{
                                                        'cursor-pointer' : deleteBox
                                                     }"
                                                    @if($edit)
                                                    x-on:click="deleteBox=true"
                                                    @endif
                                                >
                                            </div>
                                        @else
                                            <div class="w-full py-2" x-show="isUploading" x-cloak>
                                                <div class="w-full flex flex-wrap items-center justify-center px-4 space-y-2">
                                                    <div class="w-full overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                        <div :style="`width: ${progress}%`" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                                    </div>
                                                    <div class="text-white text-sm">
                                                        이미지 업로드 중
                                                    </div>
                                                </div>
                                            </div>
                                            <label for="room_type_image_1.{{$i}}" class="w-full h-full flex flex-wrap items-center justify-center cursor-pointer" x-show="!isUploading">
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
                                                        룸 이미지 등록
                                                    </div>
                                                </div>
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_image_1.'.$i)->whereNull('status')->get(['status', 'content']) as $item)
                                <div class="absolute w-full h-full l @if($item->status ==='확인') bg-tm-c-617A97 text-white line-through @else bg-tm-c-da5542 @endif bg-opacity-70"
                                     @if($edit) x-show="show" x-on:click="show=false" @endif>
                                    <div class="h-full flex items-center justify-center">
                                        <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-2 gap-3 pt-3">
                            <div class="relative pb-3/4" x-data="{ show : true }" x-on:click.away="show=true"
                                 @if(!$edit) x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                                @endif>
                                <div class="absolute w-full h-full box-border
                                    @error('room_type_image_2.'.$i) border border-solid border-white rounded-sm bg-white @enderror
                                @if(empty($room_type_image_2[$i])) border border-solid border-white rounded-sm bg-white @endif"
                                     style="--tw-bg-opacity:0.1;">
                                    <div class="w-full h-full select-none">
                                        <div
                                            class="w-full h-full flex flex-wrap items-center justify-center"
                                            x-data="{ isUploading: false, progress: 0 , deleteBox: false }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                            @if($edit)
                                            x-on:click.away="deleteBox=false"
                                            @endif
                                        >
                                            @if($edit)
                                            <input type="text" wire:model.lazy="room_type_image_2.{{$i}}" class="hidden">
                                            <input type="file" id="room_type_image_2.{{$i}}" wire:model.lazy="room_type_image_2.{{$i}}" class="hidden">
                                            @endif
                                        @if (isset($room_type_image_2[$i]) && $room_type_image_2[$i]!==null && $room_type_image_2[$i]!=='' && !$errors->has('room_type_image_2.'.$i))
                                                <div class="w-full h-full relative">
                                                    <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                                                         :class="{
                                                'visible cursor-pointer' : deleteBox,
                                                'invisible' : !deleteBox
                                             }"
                                                         x-cloak
                                                         @if($edit)
                                                         onclick="imageRemover('room_type_image_2','{{$i}}');"
                                                        @endif
                                                    >
                                                        <div class="h-full flex justify-center items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 sm:w-12" viewBox="0 0 86 86" >
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <g stroke="#EDEDED">
                                                                        <g>
                                                                            <g>
                                                                                <g transform="translate(-507 -434) translate(360 228) translate(0 99) rotate(45 -34.853 283.137)">
                                                                                    <circle cx="30" cy="30" r="29.5"/>
                                                                                    <path d="M16.075 29.475L42.874 29.475M29.475 42.874L29.475 16.075"/>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <img
                                                        @if( $room_type_image_2[$i]!==null && $room_type_image_2[$i]!=='')
                                                        @if(!is_string($room_type_image_2[$i]) && $room_type_image_2[$i]->temporaryUrl()!==null)
                                                        src="{{ $room_type_image_2[$i]->temporaryUrl() }}"
                                                        @elseif(is_string($room_type_image_2[$i]))
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/{{ $room_type_image_2[$i] }}"
                                                        @endif
                                                        @endif
                                                        class="w-full h-full"
                                                        :class="{
                                                            'cursor-pointer' : deleteBox
                                                         }"
                                                        @if($edit)
                                                        x-on:click="deleteBox=true"
                                                        @endif
                                                    >
                                                </div>
                                            @else
                                                <div class="w-full py-2" x-show="isUploading" x-cloak>
                                                    <div class="w-full flex flex-wrap items-center justify-center px-4 space-y-2">
                                                        <div class="w-full overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                            <div :style="`width: ${progress}%`" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                                        </div>
                                                        <div class="text-white text-sm">
                                                            이미지 업로드 중
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="room_type_image_2.{{$i}}" class="w-full h-full flex flex-wrap items-center justify-center cursor-pointer" x-show="!isUploading">
                                                    <div class="w-full text-center">
                                                        <div class="w-full flex justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 30 30">
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
                                                    </div>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_image_2.'.$i)->whereNull('status')->get(['status', 'content']) as $item)
                                <div class="absolute w-full h-full l @if($item->status ==='확인') bg-tm-c-617A97 text-white line-through @else bg-tm-c-da5542 @endif bg-opacity-70"
                                     @if($edit) x-show="show" x-on:click="show=false" @endif>
                                        <div class="h-full flex items-center justify-center">
                                            <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="relative pb-3/4" x-data="{ show : true }" x-on:click.away="show=true"
                                 @if(!$edit) x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                                @endif>
                                <div class="absolute w-full h-full box-border
                                @error('room_type_image_3.'.$i) border border-solid border-white rounded-sm bg-white @enderror
                                @if (empty($room_type_image_3[$i])) border border-solid border-white rounded-sm bg-white @endif" style="--tw-bg-opacity:0.1;">
                                    <div class="w-full h-full select-none">
                                        <div
                                            class="w-full h-full flex flex-wrap items-center justify-center"
                                            x-data="{ isUploading: false, progress: 0 , deleteBox: false }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                                            @if($edit)
                                            x-on:click.away="deleteBox=false"
                                            @endif
                                        >
                                            @if($edit)
                                            <input type="text" wire:model.lazy="room_type_image_3.{{$i}}" class="hidden">
                                            <input type="file" id="room_type_image_3.{{$i}}" wire:model.lazy="room_type_image_3.{{$i}}" class="hidden">
                                            @endif
                                        @if (isset($room_type_image_3[$i]) && $room_type_image_3[$i]!==null && $room_type_image_3[$i]!=='' && !$errors->has('room_type_image_3'.$i))
                                                <div class="w-full h-full relative">
                                                    <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                                                         :class="{
                                                            'visible cursor-pointer' : deleteBox,
                                                            'invisible' : !deleteBox
                                                         }"
                                                         x-cloak
                                                         @if($edit)
                                                         onclick="imageRemover('room_type_image_3','{{$i}}');"
                                                        @endif
                                                    >
                                                        <div class="h-full flex justify-center items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 sm:w-12" viewBox="0 0 86 86" >
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <g stroke="#EDEDED">
                                                                        <g>
                                                                            <g>
                                                                                <g transform="translate(-507 -434) translate(360 228) translate(0 99) rotate(45 -34.853 283.137)">
                                                                                    <circle cx="30" cy="30" r="29.5"/>
                                                                                    <path d="M16.075 29.475L42.874 29.475M29.475 42.874L29.475 16.075"/>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <img
                                                        @if( $room_type_image_3[$i]!==null && $room_type_image_3[$i]!=='')
                                                        @if(!is_string($room_type_image_3[$i]) && $room_type_image_3[$i]->temporaryUrl()!==null)
                                                        src="{{ $room_type_image_3[$i]->temporaryUrl() }}"
                                                        @elseif(is_string($room_type_image_3[$i]))
                                                        src="https://d2pyzcqibfhr70.cloudfront.net/{{ $room_type_image_3[$i] }}"
                                                        @endif
                                                        @endif
                                                        class="w-full h-full"
                                                        :class="{
                                                            'cursor-pointer' : deleteBox
                                                         }"
                                                        @if($edit)
                                                        x-on:click="deleteBox=true"
                                                        @endif
                                                    >
                                                </div>
                                            @else
                                                <div class="w-full py-2" x-show="isUploading" x-cloak>
                                                    <div class="w-full flex flex-wrap items-center justify-center px-4 space-y-2">
                                                        <div class="w-full overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                            <div :style="`width: ${progress}%`" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                                        </div>
                                                        <div class="text-white text-sm">
                                                            이미지 업로드 중
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="room_type_image_3.{{$i}}" class="w-full h-full flex flex-wrap items-center justify-center cursor-pointer" x-show="!isUploading">
                                                    <div class="w-full text-center">
                                                        <div class="w-full flex justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 30 30">
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
                                                    </div>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_image_3.'.$i)->whereNull('status')->get(['status', 'content']) as $item)
                                <div class="absolute w-full h-full l @if($item->status ==='확인') bg-tm-c-617A97 text-white line-through @else bg-tm-c-da5542 @endif bg-opacity-70"
                                     @if($edit) x-show="show" x-on:click="show=false" @endif>
                                        <div class="h-full flex items-center justify-center">
                                            <p class="whitespace-pre-line px-3 text-white AppSdGothicNeoR leading-normal text-sm sm:text-base md:text-lg">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-3">
                            <div class="space-y-3">
                                <div @if(!$edit)
                                     x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                                    @endif>
                                    <input type="text" wire:model.lazy="room_type_name.{{$i}}" id="room_type_name.{{$i}}"
                                           @if(!$edit)
                                           disabled
                                           @endif maxlength="50"
                                           class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_name.'.$i)->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                           placeholder="룸 이름">
                                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_name.'.$i)->whereNull('status')->get('content') as $item)
                                        <div class="mt-2 text-tm-c-ff7777">
                                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div @if(!$edit)
                                     x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                                    @endif>
                                    <input type="text" wire:model.lazy="room_type_main_explanation.{{$i}}" id="room_type_main_explanation.{{$i}}"
                                           @if(!$edit)
                                           disabled
                                           @endif maxlength="50"
                                           class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_main_explanation.'.$i)->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                           placeholder="침대 종류 + 개수 (ex: 싱글 침대 2개)">
                                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_main_explanation.'.$i)->whereNull('status')->get('content') as $item)
                                        <div class="mt-2 text-tm-c-ff7777">
                                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="relative" @if(!$edit)
                                x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                                    @endif>
                                    <input type="number" wire:model.lazy="room_type_sub_explanation.{{$i}}" id="room_type_sub_explanation.{{$i}}"
                                           @if(!$edit)
                                           disabled
                                           @endif maxlength="10" max="10000"
                                           class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid @if(\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_sub_explanation.'.$i)->whereNull('status')->count()>=1) border-tm-c-da5542 @else border-white @endif rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                           placeholder="룸 면적">
                                    <div class="absolute top-0 right-0 mt-4 sm:mt-5 mr-4">
                                        <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">m²</div>
                                    </div>
                                    @foreach (\App\AddHotelNeedToModify::whereAddHotelId($addHotel->id)->whereModel('AddHotelRoomTypeImage')->whereTarget('room_type_sub_explanation.'.$i)->whereNull('status')->get('content') as $item)
                                        <div class="mt-2 text-tm-c-ff7777">
                                            <p class="whitespace-pre-line AppSdGothicNeoR leading-normal text-sm break-all">{!! $item->content !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @error('room_type_image_1.'.$i) <div class="mt-2 text-tm-c-ff7777">{{ $message }}</div>@enderror
                        @error('room_type_image_2.'.$i) <div class="mt-2 text-tm-c-ff7777">{{ $message }}</div>@enderror
                        @error('room_type_image_3.'.$i) <div class="mt-2 text-tm-c-ff7777">{{ $message }}</div>@enderror
                        @error('room_type_name.'.$i) <div class="mt-2 text-tm-c-ff7777">{{ $message }}</div>@enderror
                        @error('room_type_main_explanation.'.$i) <div class="mt-2 text-tm-c-ff7777">{{ $message }}</div>@enderror
                        @error('room_type_sub_explanation.'.$i) <div class="mt-2 text-tm-c-ff7777">{{ $message }}</div>@enderror
                        <div class="mt-2">
                            <div class="w-full py-3 rounded-sm @if($i===1) bg-tm-c-d7d3cf cursor-default @else bg-tm-c-ff7777 cursor-pointer @endif"
                                 @if($i!==1)
                                 @if($edit)
                                 wire:click="roomTypeRemove('{{$i}}')" wire:key="roomTypeRemove_{{$i}}"
                                @endif
                                 @if(!$edit)
                                 x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                                @endif
                                @endif>
                                <div class="h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 20 20">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g transform="translate(-950 -981) translate(360 228) translate(0 99) translate(0 584) translate(410 58) translate(180 12)">
                                                                    <rect width="20" height="1" y="2.5" fill="#FFF" rx=".5"/>
                                                                    <path stroke="#FFF" d="M2.239 3H17.761V19.5H2.239z"/>
                                                                    <rect width="1" height="9.167" x="5.217" y="6.667" fill="#FFF" rx=".5"/>
                                                                    <rect width="1" height="9.167" x="9.565" y="6.667" fill="#FFF" rx=".5"/>
                                                                    <rect width="6.087" height="1" x="6.957" fill="#FFF" rx=".5"/>
                                                                    <rect width="1" height="9.167" x="13.913" y="6.667" fill="#FFF" rx=".5"/>
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
                    </div>
                @endforeach
                @if(collect($room_type)->filter(function($item,$index){ return $item !== null; })->count() < 8)
                    <div class="#swiper-slide h-full">
                        <div class="h-full border border-dashed border-white flex flex-wrap items-center justify-center cursor-pointer"
                             @if($edit)
                             wire:click="countAdd" wire:key="countAdd_{{collect($room_type_image_1)->count()}}"
                             @endif
                             @if(!$edit)
                             x-data x-on:click="$dispatch('notification', {text: '수정하기 버튼을 누른 후에 수정이 가능합니다.', time : '4000', type : 'wbc-mtc-text-30373F-bg-d7d3cf'})"
                             @endif
                             style="#min-height: 300px;">
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
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="hidden" x-data="{error : '{{$errors->keys()[0]}}'}" x-init="fieldError = document.getElementById(error);if(fieldError){fieldError.focus({preventScroll:false});}"></div>
    @endif
</div>

<script>
    function imageRemover($target, $index = 0){
        Livewire.emit('RoomImagesRemoverEvent', $target, $index);
    }
</script>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }
    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }
</style>

