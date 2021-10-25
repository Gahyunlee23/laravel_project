<div>
    @if($hotel_type === 'month')
    @isset($room_options)
    <div class="space-y-2 sm:space-y-3">
        <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
            룸 타입
        </div>
        <div>
            <div class="flex flex-wrap">
            @foreach ($room_options as $room_option)
                <div class="mr-5 my-2 select-none shadow @if(!in_array($room_option,$room_sold_outs->toArray())) cursor-pointer @endif" @if(!in_array($room_option,$room_sold_outs->toArray()))
                    @if(isset($room_option_upgrades[$loop->index])) wire:click="roomSelect({{$room_option}},{{$room_option_upgrades[$loop->index]}})"
                    @else wire:click="roomSelect({{$room_option}})" @endif
                    @endif>
                    <div>
                        <div class="relative">
                            <div class="absolute top-0 left-0 ml-2 sm:ml-2 mt-2 sm:mt-2 z-30">
                                @if((string)$room_option_select === (string)$room_option)
                                    <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg" class="w-7 sm:w-9 cursor-pointer" data-index="0" alt="">
                                @else
                                    <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg" class="w-7 sm:w-9 @if(!in_array($room_option,$room_sold_outs->toArray())) cursor-pointer @endif" data-index="0" alt="">
                                @endif
                            </div>
                        </div>

                        <div class="relative w-36 sm:w-48 h-24 sm:h-32">
                            @if(isset($room_option_upgrades[$loop->index]))
                                @if(in_array($room_option,$room_sold_outs->toArray()))
                                    <div class="relative w-full h-full select-none" style="background-color: rgba(181, 177, 173,0.7);">
                                        <div class="absolute w-full bottom-0 left-0">
                                            <div class="flex justify-center items-center relative px-3 py-1 rounded-b-sm" style="background-color: rgba(215,211,207,0.9)">
                                                <span class="AppSdGothicNeoR text-tm-c-30373F text-sm sm:text-lg">
                                                    {{Str::of(\App\HotelRoomType::find($room_option_upgrades[$loop->index])->name)}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex justify-center items-center h-full">
                                            <div class="PtSerif italic text-base sm:text-lg text-white">Sold out</div>
                                        </div>
                                        <img src="{{secure_asset('https://d2pyzcqibfhr70.cloudfront.net/'.\App\HotelRoomType::find($room_option_upgrades[$loop->index])->image)}}"
                                             style="z-index:-1;-webkit-user-drag: none;  -khtml-user-drag: none;  -moz-user-drag: none;  -o-user-drag: none;  user-drag: none;"
                                             class="room_image absolute top-0 w-full h-full select-none" alt="Room Image">

                                    </div>
                                @else
                                    <div class="relative w-full h-full select-none" style="#background-color: rgba(181, 177, 173,0.7);">
                                        <div class="absolute w-full bottom-0 left-0">
                                            <div class="flex justify-center items-center relative px-3 py-1 rounded-b-sm" style="background-color: rgba(215,211,207,0.9)">
                                                <span class="AppSdGothicNeoR text-tm-c-30373F text-sm sm:text-lg">
                                                    {{Str::of(\App\HotelRoomType::find($room_option_upgrades[$loop->index])->name)}}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex justify-end items-start h-full rounded-sm">
                                            <div class="mt-2 -mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="20" viewBox="0 0 64 20">
                                                    <g fill="none" fill-rule="evenodd">
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <path fill="#0D5E49" d="M0 0L84 0 83.977 9.05 74.73 18 0 18z" transform="translate(-62 -321) translate(12 -370) translate(0 416) translate(1 226) translate(30 49) translate(0 1)"/>
                                                                                <text fill="#FFF" font-family="PTSerif-Italic, PT Serif" font-size="13" font-style="italic" transform="translate(-64 -319) translate(13 -370) translate(0 416) translate(16 226) translate(30 49) translate(0 1)">
                                                                                    <tspan x="11.05" y="11.05">Upgrade</tspan>
                                                                                </text>
                                                                                <path fill="#073D2F" d="M74.977 9.05L83.977 9.05 74.977 18.05z" transform="translate(-62 -321) translate(12 -370) translate(0 416) translate(1 226) translate(30 49) translate(0 1)"/>
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
                                        <img src="{{secure_asset('https://d2pyzcqibfhr70.cloudfront.net/'.\App\HotelRoomType::find($room_option_upgrades[$loop->index])->image)}}"
                                             style="z-index:-1;-webkit-user-drag: none;  -khtml-user-drag: none;  -moz-user-drag: none;  -o-user-drag: none;  user-drag: none;"
                                             class="room_image absolute top-0 w-full h-full select-none  rounded-t-sm @if((string)$room_option_select === (string)$room_option) border-3 border-solid border-tm-c-C1A485 @endif" alt="Room Image">
                                    </div>
                                @endif
                            @else
                            @if(in_array($room_option,$room_sold_outs->toArray()))
                                <div class="relative w-full h-full select-none" style="background-color: rgba(181, 177, 173,0.7);">
                                    <div class="absolute w-full bottom-0 left-0">
                                        <div class="flex justify-center items-center relative px-3 py-1 rounded-b-sm" style="background-color: rgba(215,211,207,0.9)">
                                        <span class="AppSdGothicNeoR text-tm-c-30373F text-sm sm:text-lg">
                                            {{Str::of(\App\HotelRoomType::find($room_option)->name)}}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center h-full">
                                        <div class="PtSerif italic text-base sm:text-lg text-white">Sold out</div>
                                    </div>
                                    <img src="{{secure_asset('https://d2pyzcqibfhr70.cloudfront.net/'.\App\HotelRoomType::find($room_option)->image)}}"
                                         style="z-index:-1;-webkit-user-drag: none;  -khtml-user-drag: none;  -moz-user-drag: none;  -o-user-drag: none;  user-drag: none;"
                                         class="room_image absolute top-0 w-full h-full select-none" alt="Room Image">
                                </div>
                            @else
                                <div class="absolute w-full bottom-0 left-0">
                                    <div class="flex justify-center items-center relative px-3 py-1 rounded-b-sm" style="background-color: rgba(215,211,207,0.9)">
                                        <span class="AppSdGothicNeoR text-tm-c-30373F text-sm sm:text-lg">
                                            {{Str::of(\App\HotelRoomType::find($room_option)->name)}}
                                        </span>
                                    </div>
                                </div>
                                <img src="{{secure_asset('https://d2pyzcqibfhr70.cloudfront.net/'.\App\HotelRoomType::find($room_option)->image)}}"
                                     style="-webkit-user-drag: none;  -khtml-user-drag: none;  -moz-user-drag: none;  -o-user-drag: none;  user-drag: none;"
                                     class="room_image w-full h-full select-none @if((string)$room_option_select === (string)$room_option) border-3 border-solid border-tm-c-C1A485 @endif" alt="Room Image">

                            @endif
                        @endif
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    @endisset
    @endif
</div>
