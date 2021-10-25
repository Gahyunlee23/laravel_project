<div class="{{$widthClass}} px-0 sm:px-2 py-2">
    <div class="bg-tm-c-ED rounded-sm">
        <a onclick="GA_event_up({{$item->hotel->id}},{{$loopIndex->index}});"
           href="{{route('hotel.view',['hotel'=>$item->hotel->id,'curator_page'=>$curator->user_page ?? null])}}">
            <div class="relative h-56 md:h-60 lg:h-64 rounded-t-sm">
                <div class="w-full h-full">
                    <div class="swiper-container w-full h-full">
                        <div class="swiper-wrapper h-full">
                            @foreach ($item->hotel->ImageFirstExplode as $image)
                                <div class="lozad swiper-slide w-full h-full"
                                     data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$image)}}"
                                     style="
                                         background-repeat: no-repeat;background-position: center center;
                                     @if($loop->index===0 && isset($item->hotel->ImageFirstOnePositionY)) background-position-y:{{$item->hotel->ImageFirstOnePositionY}}; @endif
                                         background-size:cover;border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;">
                                    <div class="relative h-full" style="background: linear-gradient(to right, rgba(98, 76, 56, 0.5), rgba(68, 62, 56, 0));border-bottom-left-radius: 2rem;border-bottom-right-radius: 2rem;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="z-10 absolute px-4 sm:px-7 py-5 sm:py-6 top-0 w-full h-full cursor-pointer">
                    <div>
                        <div class="AppSdGothicNeoR text-xs sm:text-sm text-white text-left">
                            {{$item->subway_station ?? $item->area}}
                        </div>
                    </div>

                    @if($item->hotel->grade!==null && $item->hotel->grade === 'event')
                        <div class="absolute top-0 right-0 mt-5 -mr-2 leading-tight">
                            <div class="relative pl-8 pr-10 pt-2 pb-3"
                                 @if($item->hotel->grade === 'event')
                                 style="background-image: linear-gradient(to right, #0D5E49, #08372B 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                 @else
                                 style="background-image: linear-gradient(to right, #C1A485, #9b7956 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                @endif
                            >
                                <div class="absolute top-0 right-0 w-0 h-0 shadow-inner"
                                     style="margin-top: -7px;@if($item->hotel->grade === 'event') border-bottom: 7px solid #08372B; @else border-bottom: 7px solid #74583a; @endif border-right: 7px solid transparent;"></div>
                                <div class="flex items-center justify-start space-x-1">
                                    @if($item->hotel->grade !== 'event')
                                        <div>
                                            <x-hotel.star star="1">
                                                <x-slot name="star_slot">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <g fill="#FFF">
                                                                <g>
                                                                    <g>
                                                                        <path d="M61 14.702L56.886 16.663 57.479 12.144 54.343 8.837 58.824 8.005 61 4 63.176 8.005 67.657 8.837 64.521 12.144 65.114 16.663z" transform="translate(-447 -725) translate(361 522) translate(32 199)"/>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </x-slot>
                                            </x-hotel.star>
                                        </div>
                                    @endif
                                    <div class="PtSerif italic text-base text-white leading-none tracking-wider">
                                        {{ Str::of($item->hotel->grade)->studly() ?? ''}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="absolute bottom-0 mb-5 sm:mb-6 leading-tight">
                        @if($item->hotel->star >= 1 )
                            <div class="pb-3">
                                <div class="flex w-max-content px-2 py-1 rounded-full space-x-px bg-white bg-opacity-30">
                                    <x-hotel.star star="{{$item->hotel->star}}">
                                        <x-slot name="star_slot">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13">
                                                <g fill="none" fill-rule="evenodd">
                                                    <g fill="#FFF">
                                                        <g>
                                                            <g>
                                                                <path d="M61 14.702L56.886 16.663 57.479 12.144 54.343 8.837 58.824 8.005 61 4 63.176 8.005 67.657 8.837 64.521 12.144 65.114 16.663z" transform="translate(-447 -725) translate(361 522) translate(32 199)"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </x-slot>
                                    </x-hotel.star>
                                </div>
                            </div>
                        @endif
                        <div class="AppSdGothicNeoR font-bold text-base sm:text-xl md:text-lg text-white text-left tracking-widest">
                            {{$item->title}}
                        </div>
                        <div class="AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-lg md:text-base text-white text-left tracking-wide">
                            {{$item->title_en}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 sm:px-7 py-4 flex items-center" style="min-height: 90px;">
                <div class="w-full">
                    <div class="AppSdGothicNeoR text-xs sm:text-sm text-tm-c-0D5E49 text-left float-left">
                        @if($item->hotel->LowPrice !== '0' || $item->hotel->MaximumPrice !== '0')
                            <div class="flex flex-auto items-center">
                                <div class="px-2">
                                    <div class="AppSdGothicNeoR text-xs sm:text-sm text-tm-c-30373F">최저가</div>
                                    <div class="pt-1 AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-30373F tracking-wide">
                                        {{number_format($item->hotel->LowPrice)}}원 ~
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-auto items-center">
                                <div class="px-2">
                                    <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">상품 가격</div>
                                    <div class="pt-2 AppSdGothicNeoR font-bold text-base text-tm-c-30373F">
                                        상품 상세 페이지에서 확인
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
