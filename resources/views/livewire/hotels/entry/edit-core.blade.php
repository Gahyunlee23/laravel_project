<div>
    <div class=" pb-10 md:pb-16">
        @if(!$this->edit)
            <livewire:hotels.entry.hotel-images-and-check-points-edit :add-hotel="$addHotel" :edit="false"></livewire:hotels.entry.hotel-images-and-check-points-edit>
            <livewire:hotels.entry.room-types-edit :add-hotel="$addHotel" :edit="false"></livewire:hotels.entry.room-types-edit>
            <livewire:hotels.entry.benefits-edit :add-hotel="$addHotel" :edit="false"></livewire:hotels.entry.benefits-edit>
            <livewire:hotels.entry.items-edit :add-hotel="$addHotel" :edit="false"></livewire:hotels.entry.items-edit>
            <livewire:hotels.entry.amenities-facilities-edit :add-hotel="$addHotel" :edit="false"></livewire:hotels.entry.amenities-facilities-edit>
            <livewire:hotels.entry.other-edit :add-hotel="$addHotel" :edit="false"></livewire:hotels.entry.other-edit>
        @else
            <livewire:hotels.entry.hotel-images-and-check-points-edit :add-hotel="$addHotel" :edit="true"></livewire:hotels.entry.hotel-images-and-check-points-edit>
            <livewire:hotels.entry.room-types-edit :add-hotel="$addHotel" :edit="true"></livewire:hotels.entry.room-types-edit>
            <livewire:hotels.entry.benefits-edit :add-hotel="$addHotel" :edit="true"></livewire:hotels.entry.benefits-edit>
            <livewire:hotels.entry.items-edit :add-hotel="$addHotel" :edit="true"></livewire:hotels.entry.items-edit>
            <livewire:hotels.entry.amenities-facilities-edit :add-hotel="$addHotel" :edit="true"></livewire:hotels.entry.amenities-facilities-edit>
            <livewire:hotels.entry.other-edit :add-hotel="$addHotel" :edit="true"></livewire:hotels.entry.other-edit>
        @endif

        @if($this->edit)
        <div class="pt-4 sm:pt-10 md:pt-16">
            <div class="flex justify-center">
                <div class="py-4 w-full md:max-w-md rounded-sm shadow-lg @if($errors->count() === 0) bg-tm-c-C1A485 cursor-pointer @else bg-tm-c-d7d3cf @endif"
                     @if($errors->count() === 0) wire:click="allSubmit" @endif>
                    <div class="flex justify-center space-x-1 sm:space-x-2">
                        <div wire:loading wire:target="HotelImagesAndCheckPointsSave">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <div class="AppSdGothicNeoR text-xl text-center text-white">
                            수정 저장
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @if(!$this->edit)
    <div class="flex w-full w-max-content fixed right-0 bottom-0">
        <div class="w-full my-auto flex items-center justify-end 2xl:justify-end 6xl:justify-center">
            <div class="mr-5 mb-5 sm:mb-20">
                <div class="select-none cursor-pointer flex items-center justify-center pl-5 pr-px bg-white bg-opacity-40 shadow-lg rounded-full"
                     style="height:60px"
                    wire:click="editChange">
                    <p class="whitespace-pre text-white AppSdGothicNeoR text-lg md:text-xl tracking-wide pr-2">수정하기</p>
                    <div class="flex items-center justify-center mr-px rounded-full" style="width:56px;height: 56px;background-color: #3d454e">
                        <svg class="w-8 h-8" viewBox="0 0 34 34" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="상품-등록-페이지" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Addhotel_seeall_PC" transform="translate(-1791.000000, -911.000000)" stroke="#FFFFFF" stroke-width="2">
                                    <g id="btn_flaoting_ask" transform="translate(1680.000000, 896.000000)">
                                        <g transform="translate(102.000000, 4.000000)" id="ic/edit">
                                            <g transform="translate(10.000000, 12.000000)">
                                                <g id="Group" transform="translate(16.000000, 15.833333) rotate(45.000000) translate(-16.000000, -15.833333) translate(10.666667, 0.000000)">
                                                    <path d="M2,0 L8.66666667,0 C9.77123617,7.78148667e-16 10.6666667,0.8954305 10.6666667,2 L10.6666667,24.4324338 L10.6666667,24.4324338 L5.33333333,31.6666667 L0,24.4324338 L0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 Z" id="Rectangle"></path>
                                                    <line x1="0.789245348" y1="23.739831" x2="10.0208145" y2="23.739831" id="Path"></line>
                                                    <line x1="0.789245348" y1="5.40649763" x2="10.0208145" y2="5.40649763" id="Path-Copy"></line>
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
    </div>
    @endif

    <livewire:alert.toggle.notification></livewire:alert.toggle.notification>
</div>

<style>
    ::-webkit-scrollbar-track {
        background-color: rgba(141, 138, 135, 0.5);
    }
    ::-webkit-scrollbar-thumb {
        background-color: rgb(255,255,255);
    }
     ::-webkit-calendar-picker-indicator {
         background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 24 24"><path fill="%23bbbbbb" d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/></svg>');
     }
    ::-webkit-calendar-picker-indicator {
        /*padding-left: 50%;*/
    }
</style>
