 <div class="{{$widthClass}} px-0 sm:px-2 py-2">
    <div class="bg-tm-c-ED rounded-sm">
        <div class="flex flex-wrap @if(isset($item->hotel->id) && $item->hotel->id === 9999) items-start @else items-center @endif">
            <div class="w-full sm:w-1/2 md:w-4/7 h-60 4xs:h-68 sm:h-64 md:h-72 lg:h-92 xl:h-100 transform-all">
                <div class="relative w-full h-full">
                    <div class="absolute w-full h-full @if(isset($item->hotel->id) && $item->hotel->id === 9999) px-5 sm:pr-0 sm:pl-5 @else px-5 @endif -mt-5 z-10">
                        <a onclick="GA_event('카탈로그_호텔 바로가기',['{{$item->hotel->id}}'])"
                           href="{{route('hotel.view',['hotel'=>$item->hotel->id,'curator_page'=>$curator->user_page ?? null])}}">
                            <div class="lozad w-full h-full"
                                 data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$item->hotel->ImageFirstOne)}}"
                                 style="background-repeat: no-repeat;background-position: center center;
                                 @if($index===0 && isset($item->hotel->ImageFirstOnePositionY)) background-position-y:{{$item->hotel->ImageFirstOnePositionY}}; @endif
                                     background-size:cover;">
                            </div>
                        </a>
                    </div>
                    <div class="absolute top-0 w-full h-full px-5">
                        <div class="w-full h-full bg-tm-c-ED"></div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full sm:w-1/2 h-full text-sm @if(isset($item->hotel->id) && $item->hotel->id === 9999) mx-5 sm:m-0 @endif">
                @if(isset($item->hotel->id) && $item->hotel->id === 9999 && \Carbon\Carbon::now()->timestamp < \Carbon\Carbon::parse('2021-10-12 23:59:59')->timestamp)
                    <div class="flex items-center py-2 px-4 space-x-2" style="background-color: #03936e;">
                        <div>
                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(1 .5)" fill="none" fill-rule="evenodd">
                                    <circle stroke="#FFF" cx="8" cy="9" r="6.5"/>
                                    <path d="M5.657 2.621c-1.172-1.171-2.913-1.33-3.89-.353-.976.976-.817 2.717.354 3.889M10 2.621c1.172-1.171 2.913-1.33 3.89-.353.975.976.817 2.717-.354 3.889" stroke="#FFF"/>
                                    <rect fill="#FFF" x="7.5" y="4.5" width="1" height="5" rx=".5"/>
                                    <rect fill="#FFF" transform="rotate(125 9.425 10.057)" x="8.925" y="8.057" width="1" height="4" rx=".5"/>
                                    <rect fill="#FFF" transform="rotate(160 12.423 15.222)" x="11.923" y="14.222" width="1" height="2" rx=".5"/>
                                    <rect fill="#FFF" transform="scale(1 -1) rotate(-20 -82.561 0)" x="3.265" y="14.222" width="1" height="2" rx=".5"/>
                                </g>
                            </svg>
                        </div>
                        <div class="w-full text-white flex justify-between pt-1">
                            <div class="AppSdGothicNeoR text-sm tracking-wide flex items-center leading-4">
                                <div class="font-bold">타임세일&nbsp;</div>
                                <div>마감까지</div>
                            </div>
                            <div class="AppSdGothicNeoR font-bold leading-4 tracking-tight">
                                <livewire:banner.saletime diff-time="2021-10-12 23:59:59"></livewire:banner.saletime>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="@if(isset($item->hotel->id) && $item->hotel->id === 9999) px-0 @else px-5 @endif pt-4 sm:px-6 md:px-8 md:mt-8 lg:px-12 xl:px-20 py-0 sm:py-4 divide-y divide-tm-c-30373F">
                    <div>
                        <div class="pb-2">
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
                                        <div class="hidden md:block space-y-2">
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
                                            <div class="hidden md:block">&nbsp;</div>
                                        </div>
                                    @else
                                        <div class="space-y-1">
                                            <div>
                                                {{ $item->title ?? ''}}
                                            </div>
                                        </div>
                                    @endif
                                </a>
                            </div>

                            <div class="pt-2 md:pt-3 pb-4">
                                <div class="AppSdGothicNeoR text-sm sm:text-base text-tm-c-30373F text-left tracking-tight">
                                    {{$item->subway_station ?? $item->area}}
                                </div>
                            </div>
                            @if($item->hotel->hashtags->count() >= 1)
                                <div class="flex space-x-2 sm:space-x-3 AppSdGothicNeoR text-xs text-tm-c-30373F pt-2 pb-2 sm:pb-1">
                                    @foreach ($item->hotel->hashtags as $tag)
                                        <div>{{$tag}}</div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2 w-full bg-tm-c-30373F" style="height: 1px;"></div>
                </div>

                <div>
                    <div class="flex items-center @if(isset($item->hotel->id) && $item->hotel->id === 9999) px-0 @else px-5 @endif pt-6 pb-10 sm:pt-2 sm:px-6 md:px-8 lg:px-12 xl:px-20 py-0" style="min-height: 70px;">
                        <div class="w-full">
                            <div class="AppSdGothicNeoR text-xs sm:text-sm text-tm-c-0D5E49 text-left float-left">
                                @if($item->hotel->LowPrice !== '0' ||
                                    $item->hotel->MaximumPrice !== '0')
                                    <div class="flex flex-auto items-center">
                                        <div class="pr-2">
                                            <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">최저가</div>
                                            <div class="pt-1 AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-30373F tracking-wide">
                                                {{number_format($item->hotel->LowPrice)}}원 ~
                                            </div>
                                        </div>
                                        {{--<div class="w-14 sm:w-16 h-px block ml-2 pr-2">
                                            <div class="relative px-2 w-full h-px bg-tm-c-30373F"></div>
                                        </div>
                                        <div class="pl-2">
                                            <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">최고가</div>
                                            <div class="pt-2 AppSdGothicNeoR text-lg sm:text-xl text-tm-c-30373F">
                                                {{ number_format($item->hotel->MaximumPrice) }}
                                            </div>
                                        </div>--}}
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
            </div>

        </div>
    </div>
</div>

