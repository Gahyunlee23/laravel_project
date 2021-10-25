<div class="{{$widthClass}} px-0 sm:px-2 py-2">
    <div class="bg-tm-c-ED rounded-sm">

        <div class="flex flex-wrap items-center">
            <div class="w-full sm:w-1/2 md:w-4/7 h-60 4xs:h-68 sm:h-64 md:h-72 lg:h-92 xl:h-100">
                <div class="relative w-full h-full">
                    {{$image_slide}}
                    <div class="absolute top-0 w-full h-full px-5 -mt-5">
                        <div class="w-full h-full bg-gray-200"></div>
                    </div>
                </div>
            </div>

            <div class="w-full sm:w-1/2 md:w-3/7 px-5 sm:px-6 md:px-8 lg:px-12 xl:px-20 py-4">
                @foreach ($list as $item)
                <div class="pb-2" x-cloak x-show="'{{$loop->index}}' === '{{$index}}'">
                    <div class="AppSdGothicNeoR font-bold text-tm-c-30373F text-base md:text-lg lg:text-xl text-left tracking-wide">
                        <a onclick="GA_event('카탈로그_호텔 바로가기',['{{$item->hotel->id}}'])"
                           href="{{route('hotel.view',['hotel'=>$item->hotel->id,'curator_page'=>$curator->user_page ?? null])}}">
                            @if($item->TitleExplode->count() >= 7)
                                <div class="space-y-1">
                                    <div>
                                        {{ $item->TitleExplode->splice(0,($item->TitleExplode->count()-3))->implode(' ') ?? ''}}
                                    </div>
                                    <div>
                                        {{ $item->TitleExplode->splice($item->TitleExplode->count()-3)->implode(' ') ?? ''}}
                                    </div>
                                </div>
                            @elseif($item->TitleExplode->count() >= 4)
                                <div class="hidden md:block space-y-1">
                                    <div>
                                        {{ $item->TitleExplode->splice(0,($item->TitleExplode->count()-2))->implode(' ') ?? ''}}
                                    </div>
                                    <div>
                                        {{ $item->TitleExplode->splice($item->TitleExplode->count()-2)->implode(' ') ?? ''}}
                                    </div>
                                </div>
                                <div class="block md:hidden space-y-1">
                                    <div>
                                        {{ $item->title ?? ''}}
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            @else
                                <div class="space-y-1">
                                    <div>
                                        {{ $item->title ?? ''}}
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            @endif
                        </a>
                    </div>

                    <div class="py-4">
                        <div class="AppSdGothicNeoR text-sm sm:text-base text-tm-c-30373F text-left">
                            {{$item->subway_station ?? $item->area}}
                        </div>
                    </div>
                    {{--                    <div class="py-4">--}}
                    {{--                        <div class="AppSdGothicNeoR text-sm text-tm-c-30373F text-left tracking-wide">--}}
                    {{--                            #홍대근처 #연남동 #연남동 #연남동 #연남동--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                <div class="h-px bg-tm-c-30373F" x-cloak x-show="'{{$loop->index}}' === '{{$index}}'">
                </div>

                <div x-cloak x-show="'{{$loop->index}}' === '{{$index}}'">
                    <div class="flex items-center" style="min-height: 90px;">
                        <div class="w-full">
                            <div class="AppSdGothicNeoR text-xs sm:text-sm text-tm-c-0D5E49 text-left float-left">
                                @if($item->hotel->LowPrice !== '0' || $item->hotel->MaximumPrice !== '0')
                                    <div class="flex flex-auto items-center">
                                        <div class="pr-2">
                                            <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">최저가</div>
                                            <div class="pt-2 AppSdGothicNeoR font-bold text-lg sm:text-xl text-tm-c-0D5E49">
                                                {{ number_format($item->hotel->LowPrice) }}
                                            </div>
                                        </div>
                                        <div class="w-6 sm:w-8 h-px block ml-2 pr-2">
                                            <div class="relative w-4 sm:w-6 h-px bg-tm-c-30373F"></div>
                                        </div>
                                        <div class="pl-2">
                                            <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">최고가</div>
                                            <div class="pt-2 AppSdGothicNeoR text-lg sm:text-xl text-tm-c-30373F">
                                                {{ number_format($item->hotel->MaximumPrice) }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex flex-auto items-center">
                                        <div>
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
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
