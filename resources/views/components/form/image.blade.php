<div
    class="w-full h-full flex flex-wrap items-center justify-center"
    x-data="{ isUploading: false, progress: 0 ,  deleteBox: false }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">
    <input type="file" id="imageOne" wire:model="imageOne" class="hidden">
    @if ($imageOne)
        <div class="h-full relative">
            <div class="absolute top-0 left-0 w-full h-full bg-tm-c-30373F bg-opacity-75"
                 @mouseenter="deleteBox=true" @mouseout="deleteBox=false"
                 :class="{
                                                'visible cursor-pointer' : deleteBox,
                                                'invisible' : !deleteBox
                                             }"
                 x-cloak>
                <div class="h-full flex justify-center items-center"
                     @mouseenter="deleteBox=true">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-12 sm:w-16 cursor-pointer pointer-events-none" viewBox="0 0 86 86"
                    >
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
            <img src="{{ $imageOne->temporaryUrl() }}" class="w-full h-full" @mouseenter="deleteBox=true" @mouseout="deleteBox=false" @click="deleteBox=true" @click.away="deleteBox=false">
        </div>
    @else
        <div x-show="isUploading" x-cloak>
            <progress max="100" x-bind:value="progress"></progress>
        </div>
        <label for="imageOne" x-show="!isUploading">
            <div class="flex justify-center pb-4">
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
            <div class="AppSdGothicNeoR font-medium text-lg text-white">
                <span class="text-tm-c-C1A485">호텔 외관</span> 이미지 등록 (필수)
            </div>
        </label>
    @endif
</div>
