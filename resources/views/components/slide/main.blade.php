@php
    $slideViewCount = 0;
@endphp
@foreach ($title as $item)
@php
if($hotelId[$loop->index] === ''){
    $view_route='hotels.collect';
}else{
    if(Route::getCurrentRoute()->getName() === 'admin.dev.index'){
        $view_route='admin.dev.hotel.view';
    }else{
        $view_route='hotel.view';
    }
}
$url='';
if($hotelId[$loop->index] === ''){
    $url=route($view_route,['tab'=>$tab[$loop->index],'depth'=>$depth[$loop->index],'curator_page'=>$curator->user_page ?? false]);
}else{
    $url=route($view_route,['hotel'=>$hotelId[$loop->index],'curator_page'=>$curator->user_page ?? false]);
}
@endphp
@if($startDt[$loop->index] <= now()->format('Y-m-d H:i:s') && $endDt[$loop->index] >= now()->format('Y-m-d H:i:s'))
@php($slideViewCount++)
@break($slideViewCount>=6)
<div class="swiper-slide main_banner_slide relative">
    <div class="relative">
        <div class="w-full h-full absolute text-white">
            <div class="mt-2 4xs:mt-4 3xs:mt-8 sm:mt-8 md:mt-16 mx-3 4xs:mx-6 3xs:mx-8 sm:mx-12 md:mx-20">
                <div class="flex items-center">
                    <div class="JeJuMyeongJo float-left text-xl xs:text-2xl md:text-3xl lg:text-4xl leading">
                        <a class="cursor-pointer"
                           onclick="GA_event('메인_배너_클릭',['{{ ( $gaName[$loop->index] === '' ) ? $item : $gaName[$loop->index] }}', '{{$hotelId[$loop->index]}}']);
                           location.href='{{$url}}'">
                            {{$item}} {{$closing[$loop->index] ?? '오픈'}}
                        </a>
                    </div>
                    <div class="hidden sm:block ml-auto">
                        <a class="cursor-pointer"
                            onclick="GA_event('메인_배너_클릭',['{{ ( $gaName[$loop->index] === '' ) ? $item : $gaName[$loop->index] }}', '{{$hotelId[$loop->index]}}']);
                                location.href='{{$url}}'">
                            <div class="flex items-center justify-center px-1 4xs:px-2 2xs:px-3 sm:px-6 py-0 4xs:py-px xs:py-1 rounded-sm border border-solid border-white">
                                <div class="pb-1 JeJuMyeongJo text-sm xs:text-base 2xs:text-lg tracking-wide">see more</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="JeJuMyeongJo text-sm xs:text-base md:text-lg lg:text-xl text-tm-c-ED pt-0 sm:pt-3 leading-4 2xs:leading-6 xs:leading-7">
                    {{$marketingTitle[$loop->index]}}
                </div>

                <div class="mt-4 sm:mt-6 border-b border-solid border-white border-opacity-25">
                    <div class="flex items-end">
                        @if($event[$loop->index] !== '')
                        <div class="mb-2 py-1 px-2 bg-white bg-opacity-25">
                            <a class="cursor-pointer"
                               onclick="GA_event('메인_배너_클릭',['{{ ( $gaName[$loop->index] === '' ) ? $item : $gaName[$loop->index] }}', '{{$hotelId[$loop->index]}}']);
                                   location.href='{{$url}}'">
                                <div class="JeJuMyeongJo text-xs 2xs:text-sm sm:text-base text-white ">
                                    {{$event[$loop->index]}}
                                </div>
                            </a>
                        </div>
                        @endif
                        <div class="ml-auto">
                            <div class="py-3 pr-px">
                                <div class="main-banner-swiper-pagination px-px flex space-x-1 items-center justify-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 block sm:hidden">
                    <a class="cursor-pointer"
                       onclick="GA_event('메인_배너_클릭',['{{ ( $gaName[$loop->index] === '' ) ? $item : $gaName[$loop->index] }}', '{{$hotelId[$loop->index]}}']);
                           location.href='{{$url}}'">
                        <div class="w-max-content flex items-center justify-center px-1 4xs:px-2 2xs:px-3 sm:px-6 py-0 4xs:py-px xs:py-1 rounded-sm border border-solid border-white">
                            <div class="pb-1 JeJuMyeongJo text-sm xs:text-base 2xs:text-lg tracking-wide">see more</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @if($slideViewCount===1)
            <img class="main_img relative w-full h-full" style="z-index: -1;"
                 src="{{$mainImg[$loop->index]}}" alt="{{$item}}">
        @else
            <img class="lozad main_img relative w-full h-full" style="z-index: -1;"
                 data-src="{{$mainImg[$loop->index]}}" alt="{{$item}}">
        @endif
    </div>
</div>
@endif
@endforeach
