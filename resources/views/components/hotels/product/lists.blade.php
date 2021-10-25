@php
    if($tab === 'main'){
	    $hotels = $hotels->where('curator', '=', 'N');
    }else{
	    $hotels = $hotels->where('curator', '=', 'Y');
    }
@endphp
<div class="grid grid grid-cols-1 lg:grid-cols-2">
    @foreach ($hotels as $index=>$hotel)
        @isset($hotel->images[0])
            @php
                if(Str::of($hotel->images[0]->position_y)->contains('|')){
                    $images_position=Str::of($hotel->images[0]->position_y)->explode('|');
                    $image_positions=Str::of($images_position)->explode(',');
                }else{
                    $image_positions=Str::of($hotel->images[0]->position_y)->explode(',');
                }
            @endphp
        @endisset
        <div class="w-full p-2 float-left cursor-pointer"
             x-data="{ scale : false }"
             @mouseover="scale=true" @mouseout="scale=false"
             onclick="GA_event('product_상품 바로가기 클릭',['{{$hotel->options[0]->title}}','{{$hotel->id}}']);
             @if(isset($curator) && $curator && (Route::currentRouteName()!=='curator.index')) location.href='{{route('admin.dev.hotel.view',['hotel'=>$hotel->id,'curator_page'=>$curator->user_page])}}'
             @else location.href='{{route('admin.dev.hotel.view',['hotel'=>$hotel->id,'curator_page'=>false])}}' @endif">
            <div class="h-full bg-gray-200 space-y-2 text-center rounded-sm rounded-t-md shadow-lg">
                <div class="">
                    @if(isset($hotel->images[0]))
                        <div class="lozad w-full h-56 rounded-t-sm" :class="{ 'background-scale-110' : scale }"
                             data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.Str::of($hotel->images[0]->images)->explode('|')->first())}}"
                             style="background-repeat: no-repeat;background-position: center center;
                             @if(isset($image_positions[0])) background-position-y:{{$image_positions[0]}}; @endif background-size:cover;border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;">
                            <div class="h-full" style="background: linear-gradient(to right, rgba(98, 76, 56, 0.5), rgba(68, 62, 56, 0));
                                                                        border-bottom-left-radius: 2rem;border-bottom-right-radius: 2rem;">
                                <div class="relative px-5 sm:px-8 py-5 sm:py-6 h-full">
                                    <div class="">
                                        <div class="AppSdGothicNeoR text-xs sm:text-sm text-white text-left">
                                            {!! $hotel->options[0]->subway_station ?? $hotel->options[0]->area !!}
                                        </div>
                                    </div>
                                    <div class="absolute bottom-0 pb-5 sm:pb-6">
                                        <div class="AppSdGothicNeoR mt-2 font-bold text-base sm:text-xl text-white text-left tracking-widest">
                                            {{$hotel->options[0]->title}}
                                        </div>
                                        <div class="AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-lg text-white text-left tracking-wide">
                                            {{$hotel->options[0]->title_en}}
                                        </div>
                                    </div>

                                    @if($hotel->grade!==null && $hotel->grade === 'event')
                                        <div class="absolute event_tag top-0 right-0 mt-5 -mr-2 leading-tight">
                                            <div class="relative pl-8 pr-10 pt-2 pb-3"
                                                 @if($hotel->grade === 'event')
                                                 style="background-image: linear-gradient(to right, #0D5E49, #08372B 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                                 @else
                                                 style="background-image: linear-gradient(to right, #C1A485, #9b7956 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                                @endif
                                            >
                                                <div class="absolute top-0 right-0 w-0 h-0 shadow-inner"
                                                     style="margin-top: -7px;@if($hotel->grade === 'event') border-bottom: 7px solid #08372B; @else border-bottom: 7px solid #74583a; @endif border-right: 7px solid transparent;"></div>
                                                <div class="flex items-center justify-start space-x-1">
                                                    @if($hotel->grade !== 'event')
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
                                                        {{ Str::of($hotel->grade)->studly() ?? ''}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="px-4 sm:px-7 py-4" style="min-height: 90px;">
                    <div class="flex w-full">
                        <div class="flex items-center AppSdGothicNeoR text-xs sm:text-sm text-tm-c-0D5E49 text-left sm:float-left">
                            @if($hotel->LowPrice !== '0' ||
                                $hotel->MaximumPrice !== '0')
                                <div class="flex flex-auto items-center">
                                    <div class="px-2">
                                        <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">최저가</div>
                                        <div class="pt-2 AppSdGothicNeoR font-bold text-lg sm:text-xl text-tm-c-0D5E49">
                                            {{number_format($hotel->LowPrice)}}
                                        </div>
                                    </div>
                                    <div class="w-6 sm:w-8 h-px block ml-2">
                                        <div class="relative w-4 sm:w-6 h-px bg-tm-c-30373F"></div>
                                    </div>
                                    <div class="px-2">
                                        <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">최고가</div>
                                        <div class="pt-2 AppSdGothicNeoR text-lg sm:text-xl text-tm-c-30373F">
                                            {{number_format($hotel->MaximumPrice)}}
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

                        <div class="ml-auto AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-lg text-tm-c-30373F text-left">
                            <div class="flex justify-end">
                                <a class="w-full sm:w-auto mt-3 sm:mt-0">
                                    <div class="bg-tm-c-C1A485 py-4 px-2 sm:px-6 md:px-8 flex justify-center items-center cursor-pointer inline-block AppSdGothicNeoR text-white text-base rounded-sm primary-inset-border"
                                         style="min-width: 130px;">
                                        <div>상품 바로가기</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
    @if (false && count($hotels)%2 !== 0)
        <div class="w-full p-2 float-left">
            <div class="h-full bg-gray-200 space-y-2 text-center rounded-sm rounded-t-md shadow-lg">
                <div class="">
                    <div class="relative w-full h-56 rounded-t-sm PtSerif italic font-bold text-3xl text-white flex justify-center items-center"
                         style="background-size:cover;border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;">
                        <div class="z-10 absolute w-full h-full"
                             style="background: url('https://d2pyzcqibfhr70.cloudfront.net/resource/product/productimg-midcity-main_02.png') no-repeat ;
                                                                     background-size: cover;
                                                                     border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;"></div>
                        <div class="z-20 absolute w-full h-full bg-tm-c-30373F bg-opacity-50 shadow-sm"
                             style="border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;"></div>
                        <div class="z-30 tracking-wide text-2xl">The Next Hotel Is...</div>
                    </div>
                </div>

                <div class="px-4 sm:px-7 py-4" style="min-height: 90px;">
                    <div class="mt-0 sm:mt-2">
                        <div class="sm:float-left">
                            <div class="AppSdGothicNeoR font-bold text-xl text-tm-c-30373F text-left">
                                다음 '호텔에삶'은?
                            </div>
                            <div class="pt-2 AppSdGothicNeoR text-xs sm:text-sm md:text-lg text-tm-c-30373F text-left">
                                What is the next ‘Living in hotel’?
                            </div>
                        </div>

                        <div class="mt-2 sm:mt-0 ml-auto flex justify-end">
                            <div class="w-full sm:w-auto mt-2 sm:mt-0 py-4 px-3 sm:px-6 md:px-8 flex justify-center items-center cursor-not-allowed inline-block AppSdGothicNeoR text-white text-base rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                 style="background-color:#d7d3cf;min-width: 130px;">
                                <div>상품 바로가기</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="w-full p-2 float-left @if (count($hotels)%2 === 0) lg:col-span-2 @endif">
        <div class="h-full bg-gray-200 space-y-2 text-center rounded-sm rounded-t-md shadow-lg">
            <div class="">
                <div class="relative w-full h-56 rounded-t-sm PtSerif italic font-bold text-3xl text-white flex justify-center items-center"
                     style="background-size:cover;border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;">
                    <div class="z-10 absolute w-full h-full"
                         style="background: url('https://d2pyzcqibfhr70.cloudfront.net/resource/product/livinginhotel_in_jeju.png') no-repeat ;
                                 background-size: cover;background-position-y: 100%;
                                 border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;"></div>
                    <div class="z-20 absolute w-full h-full bg-tm-c-30373F bg-opacity-50 shadow-sm"
                         style="border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;"></div>
                    <div class="z-30 space-y-1">
                        <div class="tracking-wide text-xl">Living in hotel, in Jeju</div>
                        <div class="tracking-wide text-lg">will be open soon</div>
                    </div>
                </div>
            </div>

            <div class="px-4 sm:px-7 py-4" style="min-height: 90px;">
                <div class="mt-0 sm:mt-2">
                    <div class="sm:float-left">
                        <div class="AppSdGothicNeoR font-bold text-xl text-tm-c-30373F text-left">
                            제주 호텔에삶을 기대해주세요.
                        </div>
                        <div class="pt-2 AppSdGothicNeoR text-xs sm:text-sm md:text-lg text-tm-c-30373F text-left">
                            Living in hotel, in jeju will be open soon
                        </div>
                    </div>

                    <div class="mt-2 sm:mt-0 ml-auto flex justify-end">
                        <div class="w-full sm:w-auto mt-2 sm:mt-0 py-4 px-3 sm:px-6 md:px-8 flex justify-center items-center cursor-not-allowed inline-block AppSdGothicNeoR text-white text-base rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                             style="background-color:#d7d3cf;min-width: 130px;">
                            <div>상품 바로가기</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
