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
                        <div class="relative pb-3/4">
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
                                        x-on:click.away="deleteBox=false"
                                    >
                                        <input type="text" wire:model="room_type_image_1.{{$i}}" class="hidden">
                                        <input type="file" id="room_type_image_1.{{$i}}" wire:model="room_type_image_1.{{$i}}" class="hidden">
                                        @if (isset( $room_type_image_1[$i]) && $room_type_image_1[$i]!==null && $room_type_image_1[$i]!=='' && !$errors->has('room_type_image_1.'.$i))
                                            <div class="w-full h-full relative">
                                                <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                                                     :class="{
                                                'visible cursor-pointer' : deleteBox,
                                                'invisible' : !deleteBox
                                             }"
                                                     x-cloak
                                                     onclick="imageRemover('room_type_image_1','{{$i}}');"
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
                                                    x-on:click="deleteBox=true">
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
                                                    <div class="w-full AppSdGothicNeoR font-medium text-base xs:text-lg text-white space-y-1">
                                                        <div>
                                                            룸 이미지 등록
                                                        </div>
                                                        <div class="text-sm">
                                                            4:3 비율 권장
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 pt-3">
                            <div class="relative pb-3/4">
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
                                            x-on:click.away="deleteBox=false"
                                        >
                                            <input type="text" wire:model="room_type_image_2.{{$i}}" class="hidden">
                                            <input type="file" id="room_type_image_2.{{$i}}" wire:model="room_type_image_2.{{$i}}" class="hidden">
                                            @if (isset($room_type_image_2[$i]) && $room_type_image_2[$i]!==null && $room_type_image_2[$i]!=='' && !$errors->has('room_type_image_2.'.$i))
                                                <div class="w-full h-full relative">
                                                    <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                                                         :class="{
                                                'visible cursor-pointer' : deleteBox,
                                                'invisible' : !deleteBox
                                             }"
                                                         x-cloak
                                                         onclick="imageRemover('room_type_image_2','{{$i}}');"
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
                                                        x-on:click="deleteBox=true">
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
                            </div>
                            <div class="relative pb-3/4">
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
                                            x-on:click.away="deleteBox=false"
                                        >
                                            <input type="text" wire:model="room_type_image_3.{{$i}}" class="hidden">
                                            <input type="file" id="room_type_image_3.{{$i}}" wire:model="room_type_image_3.{{$i}}" class="hidden">
                                            @if (isset($room_type_image_3[$i]) && $room_type_image_3[$i]!==null && $room_type_image_3[$i]!=='' && !$errors->has('room_type_image_3'.$i))
                                                <div class="w-full h-full relative">
                                                    <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                                                         :class="{
                                                'visible cursor-pointer' : deleteBox,
                                                'invisible' : !deleteBox
                                             }"
                                                         x-cloak
                                                         onclick="imageRemover('room_type_image_3','{{$i}}');"
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
                                                        x-on:click="deleteBox=true">
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
                            </div>
                        </div>

                        <div class="pt-3">
                            <div class="space-y-3">
                                <input type="text" wire:model.lazy="room_type_name.{{$i}}" id="room_type_name.{{$i}}" maxlength="50"
                                       class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                       placeholder="룸 이름">
                                <input type="text" wire:model.lazy="room_type_main_explanation.{{$i}}" id="room_type_main_explanation.{{$i}}" maxlength="50"
                                       class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none" style="--tw-bg-opacity:0.1;"
                                       placeholder="침대 종류 + 개수 (ex: 싱글 침대 2개)">
                                <div class="relative">
                                    <input type="number" wire:model.lazy="room_type_sub_explanation.{{$i}}" id="room_type_sub_explanation.{{$i}}" maxlength="10" max="10000"
                                           class="w-full py-3 sm:py-4 px-2 sm:px-4 border border-solid border-white rounded-sm bg-tm-c-30373F placeholder-tm-c-979b9f text-white focus:outline-none"
                                           style="--tw-bg-opacity:0.1;"
                                           placeholder="룸 면적">
                                    <div class="absolute top-0 right-0 mt-4 sm:mt-5 mr-4">
                                        <div class="AppSdGothicNeoR font-bold text-base md:text-lg text-white">m²</div>
                                    </div>
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
                                 wire:click="roomTypeRemove('{{$i}}')" wire:key="roomTypeRemove_{{$i}}"
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
                         wire:click="countAdd" wire:key="countAdd_{{collect($room_type_image_1)->count()}}"
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
                    @if(session()->has('countAddMessage'))
                        <div class="mt-4">
                            <div class="text-tm-c-ff7777">
                                {{ session()->pull('countAddMessage') }}
                            </div>
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <div class="pt-4 sm:pt-10 md:pt-16 pb-10 md:pb-16">
            <div class="flex flex-wrap md:flex-nowrap justify-center md:space-x-4 lg:space-x-6">
                <div class="mt-2 sm:mt-4 md:mt-0 order-2 md:order-1 py-4 w-full md:max-w-xs rounded-sm shadow-lg border border-solid border-white cursor-pointer"
                     wire:click="backRedirect(1)">
                    <div class="AppSdGothicNeoR text-xl text-center text-white">
                        이전
                    </div>
                </div>

                <div class="order-1 md:order-2 py-4 w-full md:max-w-xs rounded-sm shadow-lg @if($errors->count() === 0) bg-tm-c-C1A485 cursor-pointer @else bg-tm-c-d7d3cf @endif"
                     @if($errors->count() === 0) wire:click="roomTypesSave" @endif>
                    <div class="flex justify-center space-x-1 sm:space-x-2">
                        <div wire:loading wire:target="roomTypesSave">
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

    </div>

    @if($errors->any())
        <div class="hidden" x-data="{error : '{{$errors->keys()[0]}}'}" x-init="fieldError = document.getElementById(error);if(fieldError){fieldError.focus({preventScroll:false});}"></div>
    @endif
</div>

<script>
    //var roomTypeListsSwiper;
    function imageRemover($target, $index = 0){
        Livewire.emit('RoomImagesRemoverEvent', $target, $index);
    }

    $(document).ready(function () {
        //roomTypeListsSlider();
    });

    /*const roomTypeListsSlider = function () {
        roomTypeListsSwiper = new Swiper('.room-types-swiper-container', {
            //autoHeight: true,
            slidesPerView: 1,
            speed: 1200,
            spaceBetween: 10,
            // simulateTouch: false,
            //updateOnWindowResize: true,
            //touchRatio: 0,
            //shortSwipes: false,
            //longSwipes: false,

            breakpoints: {
                // when window width is >= 320px
                0: {
                    slidesPerView: 1
                },
                480: {
                    slidesPerView: 2
                },
                840: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            },
            on: {
                init: function () {
                    setTimeout(function () {
                        if (hotelListsSwiper.realIndex === 0) {
                            $('.prevBtn').addClass('hidden');
                        }
                        if (hotelListsSwiper.realIndex === 1) {
                            $('.prevBtn').addClass('hidden');
                        }
                    }, 300);
                },
                slideChange: function () {
                    if (hotelListsSwiper.realIndex === 0) {
                        $('.hotelChoseBtn').removeClass('hidden');
                        $('.optionChoseBtn').addClass('hidden');
                        $('.reservationsChoseBtn').addClass('hidden');

                        $('.hotel-lists-swiper-container').height('100%');
                        $('.prevBtn').addClass('hidden');
                    } else if (hotelListsSwiper.realIndex === 1) {
                        $('.hotelChoseBtn').addClass('hidden');
                        $('.optionChoseBtn').removeClass('hidden');
                        $('.reservationsChoseBtn').addClass('hidden');
                        $('.prevBtn').addClass('hidden');
                        slideHeightControl('', $('.rooms_container'));
                    } else if (hotelListsSwiper.realIndex === 2) {
                        $('.hotelChoseBtn').addClass('hidden');
                        $('.optionChoseBtn').addClass('hidden');
                        $('.reservationsChoseBtn').removeClass('hidden');
                        $('.prevBtn').removeClass('hidden');
                        slideHeightControl('', $('.swiper-slide[data-progress=3]'));
                    }
                }
            }
        });
    };

    function sliderData() {
        return {
            title: 'IAX',
            slideIndex: 0,
            slides: [],
            mySwiper: {},
            init() {

                // get slides and parse the description field
                fetch(this.url)
                    .then(response => response.json())
                    .then(response => {
                        let slides = collect(response.values)

                        let headers = collect(slides.first());

                        slides.shift(); //remove headers

                        slides = slides.map((item) => {
                            return headers.combine(item).all();
                        })
                            .map((item) => {
                                item.slug = slugify(item.artist, {lower:true, strict:true});
                                item.bandcamp_player = 'https://bandcamp.com/EmbeddedPlayer/album=' + item.bc_album + '/size=small/bgcol=ffffff/linkcol=802125/artwork=none/track=' + item.bc_track + '/transparent=true/';
                                return item
                            });

                        console.log(headers,slides.all());

                        this.slides = slides.all();
                        this.initSwiper();

                    });
            },
            initSwiper() {

                //let hash = window.location.hash.substr(1);
                let hash = document.location.hash.replace('#', '');

                this.mySwiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    init: false,
                    //direction: 'vertical',
                    loop: false,
                    hashNavigation: true,

                    //observer: true,

                    preloadImages: false,
                    // Enable lazy loading
                    lazy: {
                        loadPrevNextAmount: 3,
                        loadOnTransitionStart: true
                    },

                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        renderBullet: function (index, className) {
                            return '<span class="' + className + '">' + (index + 1) + '</span>';
                        },
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });


                // reset the scroll position of last slide
                this.mySwiper.on('slideChangeTransitionEnd', () => {
                    let idx = this.mySwiper.previousIndex;
                    let slide = this.mySwiper.slides[idx];
                    slide.scrollTop = 0;

                    let iframe = slide.getElementsByTagName('iframe')[0];

                    // remove the src to top the player
                    if (iframe && iframe.src && iframe.dataset && iframe.dataset.src) {
                        iframe.removeAttribute('src');
                    }

                });

                // load
                this.mySwiper.on('slideChangeTransitionStart init', () => {
                    let idx = this.mySwiper.realIndex;
                    let slide = this.mySwiper.slides[idx];
                    let iframe = slide.getElementsByTagName('iframe')[0];

                    if (iframe && !iframe.src && iframe.dataset && iframe.dataset.src) {
                        iframe.src = iframe.dataset.src;
                    }

                    this.slideIndex = this.mySwiper.realIndex;
                });


                // wait for alpine finishing the DOM manipulation
                this.$nextTick(() => {
                    this.mySwiper.init();
                    // slides are ready, rerender the slider
                    this.mySwiper.update()
                    // grab the slides and try to find the index of the active slide from hash
                    let slideIdx = collect(this.mySwiper.slides).search((item) => item.id === hash)
                    if(slideIdx > 0){
                        this.mySwiper.slideTo(slideIdx);
                    }
                });
            },

            slideToHash(hash) {
                let slideIdx = collect(this.mySwiper.slides).search((item) => item.id === hash)
                if(slideIdx > 0){
                    this.mySwiper.slideTo(slideIdx);
                }
            }

        };
    }*/
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
