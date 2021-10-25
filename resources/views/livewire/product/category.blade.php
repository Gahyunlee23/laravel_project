<div class="space-y-12 sm:space-y-20">
    @foreach ($product_categories as $index=>$product_category)
        @if( ((isset($curator) && $curator && $product_category->curator_hotel_count > 0) || (!$curator && $product_category->hotel_count > 0)) && isset($product_category->Products))
            <div class="space-y-5">
                @foreach ($product_category->Products as $product)
                    <div class="flex flex-wrap justify-center pb-4">
                        <div class="relative w-max-content">
                            <div class="JeJuMyeongJo text-xl sm:text-2xl text-white z-10">
                                {{$product->title}}
                            </div>
                            <div class="absolute -mt-3 sm:-mt-4 bg-tm-c-0D5E49 h-full"
                                 style="width : calc( 100% + 10% );margin-left:-5%;z-index: -1;"></div>
                        </div>
                    </div>
                    <div class="category-swiper-container-{{$index}} swiper-container" data-index="{{$index}}">
                        <div class="swiper-wrapper">
                            @foreach ($product->CategoryHotels as $hotel_index=>$items)
                                @php
                                    if(isset($curator) && $curator){
                                        $hotel_options = $items->hotels->where('hotel.curator', '=', 'Y')
                                            ->whereIn('hotel.id', $curator->curatorHotels->pluck('hotel_id'));
                                    }else{
                                        $hotel_options = $items->hotels->where('hotel.curator', '=', 'N');
                                    }
                                @endphp

                                @if(auth()->check() && auth()->user()->hasAnyRole('개발'))
                                    @if($hotel_options->count() > 0)
                                        <div class="swiper-slide h-40"
                                             x-data="{ scale : false }"
                                             @mouseover="scale=true" @mouseout="scale=false">
                                            @foreach ($hotel_options as $hotel_option)
                                                @isset($hotel_option->hotel->images[0])
                                                    @php
                                                        if(Str::of($hotel_option->hotel->images[0]->position_y)->contains('|')){
                                                            $images_position=Str::of($hotel_option->hotel->images[0]->position_y)->explode('|');
                                                            $image_positions=Str::of($images_position)->explode(',');
                                                        }else{
                                                            $image_positions=Str::of($hotel_option->hotel->images[0]->position_y)->explode(',');
                                                        }
                                                    @endphp
                                                @endisset
                                                <a @if(isset($curator) && $curator && (Route::currentRouteName()!=='curator.index')) href="{{route('hotel.view',['hotel'=>$hotel_option->hotel->id, 'curator_page'=>$curator->user_page])}}"
                                                   @else href="{{route('hotel.view',['hotel'=>$hotel_option->hotel->id, 'curator_page'=>false])}}"@endif
                                                   onclick="GA_event('product category 상품 바로가기 클릭',['{{$hotel_option->hotel->options[0]->title}}','{{$hotel_option->hotel->id}}','{{$product->title}}','{{$hotel_index}}']);">
                                                    <div class="w-full">
                                                        <div class="h-full bg-gray-200 text-center shadow-lg" style="border-radius:1.4rem;">
                                                            <div>
                                                                @if(isset($hotel_option->hotel->images[0]))
                                                                    <div class="lozad w-full h-56" :class="{ 'background-scale-110' : scale }"
                                                                         data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.Str::of($hotel_option->hotel->images[0]->images)->explode('|')->first())}}"
                                                                         style="background-repeat: no-repeat;background-position: center center;background-size:cover;border-top-left-radius:1.25rem;border-top-right-radius:1.25rem;
                                                                         @if(isset($image_positions[0])) background-position-y:{{$image_positions[0]}}; @endif">
                                                                        <div class="h-full" style="background: linear-gradient(to right, rgba(98, 76, 56, 0.5), rgba(68, 62, 56, 0));border-top-left-radius:1.25rem;border-top-right-radius:1.25rem;">
                                                                            <div class="relative px-5 sm:px-8 py-5 sm:py-6 h-full">
                                                                                <div>
                                                                                    <div class="AppSdGothicNeoR text-xs sm:text-sm text-white text-left">
                                                                                        {!! $hotel_option->hotel->options[0]->subway_station ?? $hotel_option->hotel->options[0]->area !!}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="absolute bottom-0 pb-5 sm:pb-6 leading-tight">
                                                                                    @if($hotel_option->hotel->star >= 1)
                                                                                        <div class="pb-2">
                                                                                            <div class="flex w-max-content px-2 py-1 rounded-full space-x-px bg-white bg-opacity-30">
                                                                                                <x-hotel.star star="{{$hotel_option->hotel->star}}">
                                                                                                    <x-slot name="star_slot">
                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 14 13">
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
                                                                                    <div class="AppSdGothicNeoR font-bold text-base sm:text-xl text-white text-left tracking-widest">
                                                                                        {{$hotel_option->hotel->options[0]->title}}
                                                                                    </div>
                                                                                    <div class="AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-base text-white text-left tracking-wide">
                                                                                        {{$hotel_option->hotel->options[0]->area}}
                                                                                    </div>
                                                                                </div>
                                                                                @if($hotel_option->hotel->grade!==null && $hotel_option->hotel->grade === 'event')
                                                                                    <div class="absolute event_tag top-0 right-0 mt-5 -mr-2 leading-tight">
                                                                                        <div class="relative pl-8 pr-10 pt-2 pb-3"
                                                                                             @if($hotel_option->hotel->grade === 'event')
                                                                                             style="background-image: linear-gradient(to right, #0D5E49, #08372B 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                                                                             @else
                                                                                             style="background-image: linear-gradient(to right, #C1A485, #9b7956 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                                                                            @endif
                                                                                        >
                                                                                            <div class="absolute top-0 right-0 w-0 h-0 shadow-inner"
                                                                                                 style="margin-top: -7px;@if($hotel_option->hotel->grade === 'event') border-bottom: 7px solid #08372B; @else border-bottom: 7px solid #74583a; @endif border-right: 7px solid transparent;"></div>
                                                                                            <div class="flex items-center justify-start space-x-1">
                                                                                                @if($hotel_option->hotel->grade !== 'event')
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
                                                                                                    {{ Str::of($hotel_option->hotel->grade)->studly() ?? ''}}
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
                                                            <div class="flex items-center px-4 sm:px-7 py-4" style="min-height: 90px;">
                                                                <div class="flex flex-wrap w-full">
                                                                    <div class="flex items-center py-2 AppSdGothicNeoR text-xs sm:text-sm text-tm-c-0D5E49 text-left sm:float-left">
                                                                        @if($hotel_option->hotel->LowPrice !== '0' || $hotel_option->hotel->MaximumPrice !== '0')
                                                                            <div class="flex flex-auto items-center">
                                                                                <div class="px-2">
                                                                                    <div class="flex AppSdGothicNeoR text-xs sm:text-sm text-tm-c-30373F space-x-2">
                                                                                        <div>1박 당 가격</div>
                                                                                        <div class="line-through text-tm-c-979b9f ">
                                                                                            {{number_format($hotel_option->hotel->LowPrice)}}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="flex space-x-1 pt-1 AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-30373F tracking-wide">
                                                                                        <div class="text-tm-c-da5542 font-bold">
                                                                                            99<span class="font-normal">%</span>
                                                                                        </div>
                                                                                        <div class="font-bold">
                                                                                            {{number_format($hotel_option->hotel->LowPrice)}}<span class="font-normal">원 ~</span>
                                                                                        </div>
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

                                                                    <div class="w-full md:w-auto ml-auto AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-lg text-tm-c-30373F text-left">
                                                                        <div class="flex justify-end">
                                                                            <div class="w-full md:w-auto bg-tm-c-C1A485 py-3 px-4 sm:px-8 md:px-10 flex justify-center items-center cursor-pointer inline-block AppSdGothicNeoR text-white text-base active:bg-tm-c-897763 active:border-tm-c-635749 border-2 border-solid"
                                                                                 style="border-radius: 1rem;min-width: 130px;">
                                                                                <div>상품 바로가기</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    @if($hotel_options->count() > 0)
                                        <div class="swiper-slide h-40"
                                             x-data="{ scale : false }"
                                             @mouseover="scale=true" @mouseout="scale=false"
                                        >
                                            @foreach ($hotel_options as $hotel_option_index=>$hotel_option)
                                                @isset($hotel_option->hotel->images[0])
                                                    @php
                                                        if(Str::of($hotel_option->hotel->images[0]->position_y)->contains('|')){
                                                            $images_position=Str::of($hotel_option->hotel->images[0]->position_y)->explode('|');
                                                            $image_positions=Str::of($images_position)->explode(',');
                                                        }else{
                                                            $image_positions=Str::of($hotel_option->hotel->images[0]->position_y)->explode(',');
                                                        }
                                                    @endphp
                                                @endisset
                                                <a @if(isset($curator) && $curator && (Route::currentRouteName()!=='curator.index')) href="{{route('hotel.view',['hotel'=>$hotel_option->hotel->id, 'curator_page'=>$curator->user_page])}}"
                                                   @else href="{{route('hotel.view',['hotel'=>$hotel_option->hotel->id, 'curator_page'=>false])}}" @endif
                                                   onclick="GA_event('product category 상품 바로가기 클릭',['{{$hotel_option->hotel->options[0]->title}}','{{$hotel_option->hotel->id}}','{{$product->title}}','{{$hotel_index}}']);"
                                                >
                                                    <div class="w-full">
                                                        <div class="h-full bg-gray-200 text-center rounded-sm rounded-t-md shadow-lg">
                                                            <div>
                                                                @if(isset($hotel_option->hotel->images[0]))
                                                                    <div class="lozad w-full h-56 rounded-t-sm" :class="{ 'background-scale-110' : scale }"
                                                                         data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.Str::of($hotel_option->hotel->images[0]->images)->explode('|')->first())}}"
                                                                         style="background-repeat: no-repeat;background-position: center center;
                                                                         @if(isset($image_positions[0])) background-position-y:{{$image_positions[0]}}; @endif background-size:cover;border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;">
                                                                        <div class="h-full" style="background: linear-gradient(to right, rgba(98, 76, 56, 0.5), rgba(68, 62, 56, 0));
                                                                        border-bottom-left-radius: 2rem;border-bottom-right-radius: 2rem;">
                                                                            <div class="relative px-5 sm:px-8 py-5 sm:py-6 h-full">
                                                                                <div class="">
                                                                                    <div class="AppSdGothicNeoR text-xs sm:text-sm text-white text-left">
                                                                                        {!! $hotel_option->hotel->options[0]->subway_station ?? $hotel_option->hotel->options[0]->area !!}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="absolute bottom-0 pb-5 sm:pb-6 leading-tight">
                                                                                    @if($hotel_option->hotel->star >=1)
                                                                                        <div class="pb-3">
                                                                                            <div class="flex w-max-content px-2 py-1 rounded-full space-x-px bg-white bg-opacity-30">
                                                                                                <x-hotel.star star="{{$hotel_option->hotel->star}}">
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
                                                                                    <div class="AppSdGothicNeoR font-bold text-base sm:text-xl text-white text-left tracking-widest">
                                                                                        {{$hotel_option->hotel->options[0]->title}}
                                                                                    </div>
                                                                                    <div class="AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-lg text-white text-left tracking-wide">
                                                                                        {{$hotel_option->hotel->options[0]->title_en}}
                                                                                    </div>
                                                                                </div>
                                                                                @if($hotel_option->hotel->grade!==null && $hotel_option->hotel->grade === 'event')
                                                                                    <div class="absolute event_tag top-0 right-0 mt-5 -mr-2 leading-tight">
                                                                                        <div class="relative pl-8 pr-10 pt-2 pb-3"
                                                                                             @if($hotel_option->hotel->grade === 'event')
                                                                                             style="background-image: linear-gradient(to right, #0D5E49, #08372B 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                                                                             @else
                                                                                             style="background-image: linear-gradient(to right, #C1A485, #9b7956 100%);box-shadow: 0 2px 6px 0 rgba(48, 55, 63, 0.6);"
                                                                                            @endif
                                                                                        >
                                                                                            <div class="absolute top-0 right-0 w-0 h-0 shadow-inner"
                                                                                                 style="margin-top: -7px;@if($hotel_option->hotel->grade === 'event') border-bottom: 7px solid #08372B; @else border-bottom: 7px solid #74583a; @endif border-right: 7px solid transparent;"></div>
                                                                                            <div class="flex items-center justify-start space-x-1">
                                                                                                @if($hotel_option->hotel->grade !== 'event')
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
                                                                                                    {{ Str::of($hotel_option->hotel->grade)->studly() ?? ''}}
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
                                                            <div class="flex items-center px-4 sm:px-7 py-4" style="min-height: 90px;">
                                                                <div class="flex flex-wrap items-center w-full">
                                                                    <div class="flex items-center py-2 AppSdGothicNeoR text-xs sm:text-sm text-tm-c-0D5E49 text-left sm:float-left">
                                                                        @if($hotel_option->hotel->LowPrice !== '0' || $hotel_option->hotel->MaximumPrice !== '0')
                                                                            <div class="flex flex-auto items-center">
                                                                                <div class="px-2">
                                                                                    <div class="AppSdGothicNeoR text-xs sm:text-sm text-tm-c-30373F">최저가</div>
                                                                                    <div class="pt-1 AppSdGothicNeoR font-bold text-xl sm:text-2xl text-tm-c-30373F tracking-wide">
                                                                                        {{number_format($hotel_option->hotel->LowPrice)}}원 ~
                                                                                    </div>
                                                                                </div>
                                                                                {{--<div class="w-6 sm:w-8 h-px block ml-2">
                                                                                    <div class="relative w-4 sm:w-6 h-px bg-tm-c-30373F"></div>
                                                                                </div>
                                                                                <div class="px-2">
                                                                                    <div class="AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">최고가</div>
                                                                                    <div class="pt-2 AppSdGothicNeoR text-lg sm:text-xl text-tm-c-30373F">
                                                                                        {{number_format($hotel_option->hotel->MaximumPrice)}}
                                                                                    </div>
                                                                                </div>--}}
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

                                                                    <div class="w-full md:w-auto ml-auto AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-lg text-tm-c-30373F text-left">
                                                                        <div class="flex justify-end">
                                                                            <div class="w-full md:w-auto bg-tm-c-C1A485 py-4 px-2 sm:px-6 md:px-8 flex justify-center items-center cursor-pointer inline-block AppSdGothicNeoR text-white text-base rounded-sm active:bg-tm-c-897763 active:border-tm-c-635749 border-2 border-solid"
                                                                                 style="min-width: 130px;">
                                                                                <div>상품 바로가기</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            <div class="swiper-slide w-full" style="visibility: hidden">
                                <div class="h-full bg-gray-200 text-center rounded-sm rounded-t-md shadow-lg">
                                    <div>
                                        <div class="relative w-full h-56 rounded-t-sm PtSerif italic font-bold text-3xl text-white flex justify-center items-center"
                                             style="background-size:cover;border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;">
                                            <div class="z-20 absolute w-full h-full bg-tm-c-979b9f bg-opacity-40 shadow-sm"
                                                 style="border-bottom-left-radius:2rem;border-bottom-right-radius:2rem;"></div>
                                            <div class="z-30">
                                                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/logo-normal-navy.png" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-4 sm:px-7 py-4" style="min-height: 90px;">
                                        <div class="mt-0 md:mt-1">
                                            <div class="md:float-left">
                                                <div class="AppSdGothicNeoR text-sm sm:text-base text-tm-c-30373F text-left">
                                                    다음 호텔에삶 준비중
                                                </div>
                                                <div class="pt-2 AppSdGothicNeoR font-bold text-lg sm:text-xl text-tm-c-979b9f text-left">
                                                    Next livinginhotel will be open soon
                                                </div>
                                            </div>

                                            <div class="mt-4 md:mt-3 lg:mt-0 ml-auto flex justify-end">
                                                <div class="w-full md:w-auto mp-px py-4 px-3 sm:px-6 md:px-8 flex justify-center items-center cursor-not-allowed inline-block AppSdGothicNeoR text-white text-base rounded-sm primary-inset-border"
                                                     style="background-color:#d7d3cf;min-width: 130px;">
                                                    <div>상품 바로가기</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="swiper-button-prev-{{$index}}"  id="swiper-button-prev-{{$index}}">
                            <svg id="swiper-svg-prev-{{$index}}" class="stroke-current text-white ocus:outline-none" width="40" height="41" xmlns="http://www.w3.org/2000/svg">
                                <g {{--stroke="#FFF" fill="none"--}} fill="none" fill-rule="evenodd">
                                    <rect transform="rotate(-180 20 20.5)" x=".5" y=".5" width="39" height="40" rx="19.5"/>
                                    <path d="M21.657 15.375 16 21.173l5.657 5.799"/>
                                </g>
                            </svg>
                        </div>
                        <div class="px-4">
                            <div class="py-3 pr-px #hidden #sm:block">
                                <div class="category-swiper-pagination w-12 sm:w-18 AppSdGothicNeoR flex space-x-1 items-center justify-center font-semibold text-xl space-x-2"
                                     style="color: #fffcf4;"
                                     id="category-swiper-pagination-{{$index}}">
                                    <div id="category-swiper-pagination-currentIndex-{{$index}}">1</div>
                                    <div>/</div>
                                    <div id="category-swiper-pagination-endIndex-{{$index}}">1</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next-{{$index}}" id="swiper-button-next-{{$index}}">
                            <svg id="swiper-svg-next-{{$index}}" class="stroke-current text-white ocus:outline-none" width="40" height="41" xmlns="http://www.w3.org/2000/svg">
                                <g {{--stroke="#FFF"--}} fill="none" fill-rule="evenodd">
                                    <rect x=".5" y=".5" width="39" height="40" rx="19.5"/>
                                    <path d="m17.657 14.35 5.657 5.798-5.657 5.799"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>
<script>
    var categoryHotelListsSwiper0;
    var categoryHotelListsSwiper1;
    var categoryHotelListsSwiper2;

    $(document).ready(function () {
        categoryHotelListsSwiper0 = new Swiper('.category-swiper-container-0', {
            slidesPerView: 2,
            autoHeight: true,
            loop:false,
            speed: 1000,
            spaceBetween: 10,
            dots: false,
            updateOnWindowResize:true,
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                640: {
                    slidesPerView: 1.4
                },
                840: {
                    slidesPerView: 1.8
                },
                1080: {
                    slidesPerView: 2
                },
            },
            on: {
                init () {
                    document.getElementById('category-swiper-pagination-endIndex-0').innerHTML = this.slides.length-1;
                    if(this.realIndex+1 === 1){
                        document.querySelector('svg#swiper-svg-prev-0').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                    }
                },
                slideChange (){
                    if(this.realIndex+1 > this.slides.length-1){
                        this.slideTo(this.slides.length-2);
                    }else{
                        document.getElementById('category-swiper-pagination-currentIndex-0').innerHTML = (this.realIndex+1);
                        if(this.realIndex+1 === 1){
                            document.querySelector('svg#swiper-svg-prev-0').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                        }else{
                            document.querySelector('svg#swiper-svg-prev-0').setAttribute('class', 'stroke-current text-white focus:outline-none');
                        }
                        if(this.realIndex+1 === this.slides.length-1){
                            document.querySelector('svg#swiper-svg-next-0').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                        }else{
                            document.querySelector('svg#swiper-svg-next-0').setAttribute('class', 'stroke-current text-white focus:outline-none');
                        }
                    }

                }
            },
            navigation: {
                nextEl: '.swiper-button-next-0',
                prevEl: '.swiper-button-prev-0'
            }
        });
        categoryHotelListsSwiper1 = new Swiper('.category-swiper-container-1', {
            slidesPerView: 2,
            autoHeight: true,
            loop:false,
            speed: 1000,
            spaceBetween: 10,
            dots: false,
            updateOnWindowResize:true,
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                640: {
                    slidesPerView: 1.4
                },
                840: {
                    slidesPerView: 1.8
                },
                1080: {
                    slidesPerView: 2
                },
            },
            on: {
                init () {
                    document.getElementById('category-swiper-pagination-endIndex-1').innerHTML = this.slides.length-1;
                    if(this.realIndex+1 === 1){
                        document.querySelector('svg#swiper-svg-prev-1').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                    }
                },
                slideChange (){
                    if(this.realIndex+1 > this.slides.length-1){
                        this.slideTo(this.slides.length-2);
                    }else{
                        document.getElementById('category-swiper-pagination-currentIndex-1').innerHTML = (this.realIndex+1);
                        if(this.realIndex+1 === 1){
                            document.querySelector('svg#swiper-svg-prev-1').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                        }else{
                            document.querySelector('svg#swiper-svg-prev-1').setAttribute('class', 'stroke-current text-white focus:outline-none');
                        }
                        if(this.realIndex+1 === this.slides.length-1){
                            document.querySelector('svg#swiper-svg-next-1').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                        }else{
                            document.querySelector('svg#swiper-svg-next-1').setAttribute('class', 'stroke-current text-white focus:outline-none');
                        }
                    }
                }
            },
            navigation: {
                nextEl: '.swiper-button-next-1',
                prevEl: '.swiper-button-prev-1'
            }
        });
        categoryHotelListsSwiper2 = new Swiper('.category-swiper-container-2', {
            slidesPerView: 2,
            autoHeight: true,
            loop:false,
            speed: 1000,
            spaceBetween: 10,
            dots: false,
            updateOnWindowResize:true,
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                640: {
                    slidesPerView: 1.4
                },
                840: {
                    slidesPerView: 1.8
                },
                1080: {
                    slidesPerView: 2
                },
            },
            on: {
                init () {
                    document.getElementById('category-swiper-pagination-endIndex-2').innerHTML = this.slides.length-1;
                    if(this.realIndex+1 === 1){
                        document.querySelector('svg#swiper-svg-prev-2').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                    }
                },
                slideChange (){
                    if(this.realIndex+1 > this.slides.length-1){
                        this.slideTo(this.slides.length-2);
                    }else{
                        document.getElementById('category-swiper-pagination-currentIndex-2').innerHTML = (this.realIndex+1);
                        if(this.realIndex+1 === 1){
                            document.querySelector('svg#swiper-svg-prev-2').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                        }else{
                            document.querySelector('svg#swiper-svg-prev-2').setAttribute('class', 'stroke-current text-white focus:outline-none');
                        }
                        if(this.realIndex+1 === this.slides.length-1){
                            document.querySelector('svg#swiper-svg-next-2').setAttribute('class', 'cursor-default stroke-current text-white focus:outline-none text-opacity-50');
                        }else{
                            document.querySelector('svg#swiper-svg-next-2').setAttribute('class', 'stroke-current text-white focus:outline-none');
                        }
                    }
                }
            },
            navigation: {
                nextEl: '.swiper-button-next-2',
                prevEl: '.swiper-button-prev-2'
            }
        });
    });
</script>
