@extends('layouts.app')

@section('top-style')
    <style type="text/css">
        .swiper-slide{
            height: auto;
        }
        .review-swiper-pagination .swiper-pagination-bullet{
            border: 1px solid #30373f;
            background-color: rgba(0,0,0,0);
        }
        .review-swiper-pagination .swiper-pagination-bullet-active{
            background: #30373f !important;
            width: 15px;
            border-radius: 30%;
        }
    </style>
@endsection
@php
    $ogImagedata=secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/link-img-4-3.png');
@endphp
@if(isset($hotel->images[0]))
    @php
        if(Str::of($hotel->images[0]->position_y)->contains('|')){
            $images_position=Str::of($hotel->images[0]->position_y)->explode('|');
            $image_positions=Str::of($images_position)->explode(',');
        }else{
            $image_positions=Str::of($hotel->images[0]->position_y)->explode(',');
        }
        $images = Str::of($hotel->images[0]->images)->explode('|');
        $ogImagedata=$images[0];
    @endphp
@endif
@section('meta-tag')
    @php
        if(isset($hotel->options[0]->title)){
            $meta_title=env('APP_TITLE').' - '.$hotel->options[0]->title;
            $ogTitle=env('APP_TITLE').' - '.$hotel->options[0]->title;
            config(['app.name' => env('APP_TITLE').' - '.$hotel->options[0]->title]);
        }else{
            $meta_title=env('APP_TITLE');
            $ogTitle=env('APP_TITLE');
        }
        $ogDescription='매일을 여행하듯 사는 호텔한달살기, 호텔장기투숙 플랫폼 호텔에삶에서 만나보세요..';
        $keywords = ((isset($hotel->option) && $hotel->option->title!==null) ? $hotel->option->title.', ' : '' ).'호텔에삶, 호텔의삶, 한달살기, 호텔한달살기, 서울한달살기, 서울한달숙소, 서울장기투숙, 호텔장기투숙, 단기월세, 한달살이, 호텔장기투숙, 국내한달살기, 호캉스, 서울무보증원룸, 보증금없는월세, 서울호캉스추천, 월세단기, 무보증월세,트래블메이커스, 트래블메이커';
        $ogUrl='https://www.livinginhotel.com/';
        $ogImage=secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$ogImagedata);
    @endphp
    <meta name="copyright" property="copyright" content="&copy;트래블메이커::개인 맞춤형 여행 플랫폼">
    <meta name="content-language" content="kr">
    <meta name="build" content="">
    <meta name="keywords" property="keywords" content="{{$keywords}}">
    <meta name="title" property="title" content="{{$meta_title}}">
    <meta name="description" property="description" content="{{$ogDescription}}">

    <meta name="og:site_name" property="og:site_name" content="TravelMakers Korea"/>
    <meta name="og:url" property="og:url" content="{{$ogUrl}}">
    <meta name="og:title" property="og:title" content="{{$ogTitle}}">
    <meta name="og:description" property="og:description" content="{{$ogDescription}}">
    <meta name="og:image" property="og:image" content="{{$ogImage}}">

    <meta name="twitter:url" property="twitter:url" content="{{$ogUrl}}">
    <meta name="twitter:title" property="twitter:title" content="{{$ogTitle}}">
    <meta name="twitter:description" property="twitter:description" content="{{$ogDescription}}">
    <meta name="twitter:image" property="twitter:image" content="{{$ogImage}}">
@endsection

@section('content')
    @unlessrole('super-admin|admin')
    <script type="text/javascript">
        kakaoPixel('7968131379699859784').pageView('상세');
        kakaoPixel('7968131379699859784').viewContent({
            id: '1',
            tag: '{{$hotel->id}}'
        });
    </script>
    @endunlessrole
    <div class="mx-auto py-6 select-none overflow-hidden" style="">
        <div class="">
            <div class="w-full" style="padding: 0;">
                <div class="">
                    <div class="">

                        <div class="">
                            <div class="max-w-1200 mx-auto px-4">
                                {{-- 상품 --}}
                                <div class="space-y-2 sm:space-y-3">
                                    <div class="text-left space-y-2 sm:space-y-3">
                                        <div class="JeJuMyeongJo text-3xl sm:text-5xl text-white leading-tight">
                                            {{$hotel->options[0]->title}}
                                        </div>
                                        <div class="JeJuMyeongJo text-base sm:text-xl text-tm-c-C1A485">
                                            {{$hotel->options[0]->area}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 sm:mt-12 lg:mt-16">
                            <div class="max-w-1200 mx-auto px-4">
                                <div class="">
                                    @if(isset($hotel->images[0]))
                                        <div>
                                            <div class="relative">
                                                <div class="flex cursor-pointer" onclick="allImagesSlider();GA_event('호텔_상세_사진더보기_클릭',['{{$hotel->id}}']);">
                                                    <div class="flex-1">
                                                        <div class="lozad rounded-sm w-full object-cover bg-clip-border"
                                                             data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$images[0])}}"
                                                             style="background-repeat:no-repeat;background-position:center center;
                                                             @if(isset($image_positions[1])) background-position-y:{{$image_positions[1]}}; @endif max-height: 564px;background-size: cover;" >
                                                            <img data-src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$images[0])}}" class="lozad invisible" alt="">
                                                        </div>
                                                    </div>
                                                    @if(count($images)>4)
                                                        <div class="w-20 4xs:w-24 2xs:w-26 xs:w-32 sm:w-48 md:w-68 lg:w-full pl-2" style="min-width:75px;max-width:200px;max-height: 564px;">
                                                            <div class="flex flex-col items-center h-full space-y-2">
                                                                <div class="w-full h-full max-w-sm" style="max-height: 33%;">
                                                                    <div class="lozad rounded-sm w-full h-full object-cover"
                                                                         data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$images[1])}}"
                                                                         style="background-repeat:no-repeat;background-position:center center;max-height: 564px;background-size: cover;"></div>
                                                                </div>
                                                                <div class="w-full h-full">
                                                                    <div class="lozad rounded-sm w-full h-full object-cover"
                                                                         data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$images[2])}}"
                                                                         style="background-repeat:no-repeat;background-position:center center;max-height: 564px;background-size: cover;"></div>
                                                                </div>
                                                                <div class="w-full h-full">
                                                                    <div class="lozad relative rounded-sm w-full h-full object-cover"
                                                                         data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$images[3])}}"
                                                                         style="background-repeat:no-repeat;background-position:center center;max-height: 564px;background-size: cover;" >
                                                                        <div class="absolute top-0 left-0 w-full h-full cursor-pointer bg-tm-c-6e6b67 bg-opacity-60">
                                                                            <div class="flex flex-wrap w-full h-full justify-center items-center">
                                                                                <div>
                                                                                    <div class="flex justify-center">
                                                                                        <img data-src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-more-2.svg')}}"
                                                                                             class="lozad w-4 3xs:w-5 2xs:w-6 xs:w-8 sm:w-12" alt="">
                                                                                    </div>
                                                                                    <div class="mt-1 sm:mt-2 text-xs 3xs:text-sm xs:text-base sm:text-xl text-white">더보기</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="slide_container hidden fixed w-full h-full top-0 left-0 bg-black bg-opacity-75" style="z-index: 100;">
                                            <div class="mt-8 px-4 sm:px-0 pb-2 z-50 mx-auto" style="max-width: 840px;">
                                                <div class="flex">
                                                    <div class="flex items-end">
                                                        <span class="slide-page AppSdGothicNeoR text-white text-lg sm:text-xl"></span>
                                                    </div>
                                                    <div class="ml-auto z-20">
                                                        <div class="slide-close flex justify-center items-center border border-solid border-tm-c-C1A485 rounded-sm py-1 bg-tm-c-30373F bg-opacity-75 cursor-pointer">
                                                            <div class="pl-3 pr-1 text-tm-c-C1A485">닫기</div>
                                                            <div class="pr-2">
                                                                <img data-src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-close.svg" class="lozad" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-center items-center overflow-hidden h-full">
                                                <div class="view-images-swiper-container w-full">
                                                    <div class="swiper-wrapper mx-auto">
                                                        {{--swiper-slide--}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (isset($hotel->checkPoints[0]))
                            <div class="mt-10 sm:mt-12 lg:mt-16">
                                <div class="max-w-1200 mx-auto px-4">
                                    <div class="space-y-3 sm:space-y-4">
                                        <div class="flex justify-start">
                                            <div class="PtSerif italic text-tm-c-C1A485 text-4xl md:text-5xl">
                                                Check Point
                                            </div>
                                        </div>

                                        <div class="relative flex flex-wrap">
                                            <div class="flex flex-1 md:hidden justify-center py-4" style="height: min-content;max-height:250px;">
                                                <div class="flex-1">
                                                    <img data-src="https://d2pyzcqibfhr70.cloudfront.net/{{$hotel->checkPoints[0]->image1}}"
                                                         class="lozad px-2 rounded-sm object-contain" alt="">
                                                </div>
                                                <div class="flex-1">
                                                    <img data-src="https://d2pyzcqibfhr70.cloudfront.net/{{$hotel->checkPoints[0]->image2}}"
                                                         class="lozad px-2 rounded-sm object-contain" alt="">
                                                </div>
                                                <div class="flex-1">
                                                    <img data-src="https://d2pyzcqibfhr70.cloudfront.net/{{$hotel->checkPoints[0]->image3}}"
                                                         class="lozad px-2 rounded-sm object-contain" alt="">
                                                </div>
                                            </div>
                                            <x-hotel.check-point image="https://d2pyzcqibfhr70.cloudfront.net/{{$hotel->checkPoints[0]->image1}}"
                                                                 point="Check Point 1:"
                                                                 title="{!! $hotel->checkPoints[0]->title1 !!}"
                                                                 explanation="{!!$hotel->checkPoints[0]->explanation1!!}"
                                                                 container_class=""
                                                                 container_style=""
                                            ></x-hotel.check-point>

                                            <x-hotel.check-point image="https://d2pyzcqibfhr70.cloudfront.net/{{$hotel->checkPoints[0]->image2}}"
                                                                 point="Check Point 2:"
                                                                 title="{!! $hotel->checkPoints[0]->title2 !!}"
                                                                 explanation="{!! $hotel->checkPoints[0]->explanation2 !!}"
                                                                 container_class="md:mt-40"
                                                                 container_style=""
                                            ></x-hotel.check-point>

                                            <x-hotel.check-point image="https://d2pyzcqibfhr70.cloudfront.net/{{$hotel->checkPoints[0]->image3}}"
                                                                 point="Check Point 3:"
                                                                 title="{!! $hotel->checkPoints[0]->title3 !!}"
                                                                 explanation="{!! $hotel->checkPoints[0]->explanation3 !!}"
                                                                 container_class="md:mt-0"
                                                                 container_style=""
                                            ></x-hotel.check-point>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if (isset($hotel->room_types[0]) || isset($hotel->options[0]->facilities) || isset($hotel->options[0]->amenities))
                            {{-- 룸 및 옵션--}}
                            <div class="py-12 sm:py-20 mt-10 sm:mt-12 lg:mt-16" style="background-color: #d7d3cf;">
                                <div class="max-w-1200 mx-auto px-4">
                                    @if (isset($hotel->room_types[0]))
                                        <div class="space-y-6 sm:space-y-8">
                                            <div class="flex justify-start">
                                                <div class="PtSerif italic text-tm-c-0D5E49 text-4xl sm:text-5xl tracking-wider">
                                                    Room Type
                                                </div>
                                            </div>
                                            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 mx-auto md:mx-0 px-6 sm:px-0">
                                                @foreach ($hotel->room_types()->where('visible','=','1')->where('upgrade','!=','Y')->orderBy('order')->get() as $room_type)
                                                    <div class="w-full max-w-md text-center mx-auto cursor-pointer"
                                                         onclick="appendBody('{{Str::of($room_type->name)->replace(' 룸','')}}','{{secure_asset('https://d2pyzcqibfhr70.cloudfront.net/'.$room_type->image)}}')">
                                                        <div class="text-center rounded-sm shadow-lg">
                                                            <div class="relative">
                                                                <div class="absolute w-full z-20 bottom-0 p-4 space-y-1 flex items-center" style="background-color: rgba(237,237,237,0.8);">
                                                                    <div class="AppSdGothicNeoR font-bold text-tm-c-30373F text-xl">
                                                                        {!! Str::of($room_type->name)->replace(' 룸','') !!}
                                                                    </div>
                                                                    <div class="ml-auto space-y-2">
                                                                        <div class="AppSdGothicNeoR text-tm-c-30373F text-right">
                                                                            {!! $room_type->main_explanation !!}
                                                                        </div>
                                                                        <div class="AppSdGothicNeoR text-sm text-tm-c-30373F text-right">
                                                                            {!! $room_type->sub_explanation ?? '사이즈 별도 문의' !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @isset($room_type->image)
                                                                    <div class="relative flex justify-center">
                                                                        <img data-src="{{secure_asset('https://d2pyzcqibfhr70.cloudfront.net/'.$room_type->image)}}" class="lozad w-full h-60 sm:h-52 md:h-56 lg:h-68" alt="Room Image">
                                                                    </div>
                                                                @endisset
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($hotel->options[0]->benefit))
                                        <div class="pt-12 sm:pt-24 space-y-6 sm:space-y-8">
                                            <div class="flex justify-start">
                                                <div class="PtSerif italic text-tm-c-0D5E49 text-4xl sm:text-5xl tracking-wider">
                                                    Benefit
                                                </div>
                                            </div>

                                            <div>
                                                <div class="AppSdGothicNeoR text-sm sm:text-base md:test-lg text-tm-c-30373F leading-normal">
                                                    ※ 호텔에서 제공하는 공통 혜택 및 호텔에삶 Only 혜택은 정부 지침 및 호텔 운영 지침/시설 문제에 따라 입주 후에도 일부 혜택이 변동될 수 있습니다.
                                                </div>
                                            </div>

                                            <div class="px-2 sm:px-0 w-full space-y-1">
                                                @php
                                                    $benefits_only = Str::of($hotel->options[0]->benefit_only)->explode('|');
                                                    $benefits_type = Str::of($hotel->options[0]->benefit_type)->explode('|');
                                                    $benefits_benefit = Str::of($benefits_type)->explode('|');
                                                    $temp_index1=0;
                                                    $temp_index2=0;
                                                @endphp
                                                @foreach (Str::of($hotel->options[0]->benefit)->explode('|') as $index => $item)
                                                    @if($benefits_type[$index]==='0')
                                                        @php $temp_index1++; @endphp
                                                    @else
                                                        @php $temp_index2++; @endphp
                                                    @endif
                                                    @if($index===0)
                                                        <div class="AppSdGothicNeoR font-bold text-xl text-tm-c-30373F pb-4">
                                                            — 공통 혜택
{{--                                                            요청자 : 임승빈 (사유: 기간이 많이 지나서 삭제 조치, 21.08.09 이가현 주석 처리)--}}
{{--                                                            @if($hotel->id===23 || $hotel->id===46)--}}
{{--                                                                (7월 1일 결제 기준)--}}
{{--                                                            @endif--}}
                                                        </div>
                                                    @elseif($index===array_search('1',$benefits_type->toArray()))
                                                        <div class="AppSdGothicNeoR font-bold text-xl text-tm-c-30373F pt-6 pb-4">
                                                            {{-- 21.08.13 프로덕트팀 은영님 요청으로 더위크앤 리조트도 추가 - lgh --}}
                                                            @if($hotel->id===39 || $hotel->id === 13 || $hotel->id===23 || $hotel->id===46 || $hotel->id === 63 || $hotel->id === 64 || $hotel->id === 86)
                                                                — 상품별 혜택
                                                            @else
                                                                — 기간별 혜택
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <div class="flow-root">
                                                        <div class="flex">
                                                            <div class="float-left PtSerif italic font-bold text-tm-c-30373F text-xl pt-1 pb-1 pr-1 text-right" style="min-width: 22px;">
                                                                @if($benefits_type[$index]==='0')
                                                                    {{$temp_index1}}.
                                                                @else
                                                                    {{$temp_index2}}.
                                                                @endif
                                                            </div>
                                                            <div class="float-left inline-block" style="line-height: 1.8;width: calc( 100% - 30px )">
                                                            <span class="AppSdGothicNeoR text-lg text-center align-middle
                                                                @if($benefits_only[$index]) pt-1 pb-1 px-1 bg-tm-c-C1A485 text-white @else text-tm-c-30373F @endif" style="word-break: keep-all;">
                                                                {!! $item !!}</span>

                                                                @if($benefits_only[$index])
                                                                    <div class="pl-1 leading-relaxed" style="display:inline-block;min-width: 90px;">
                                                                        <span class="flex-initial JeJuMyeongJo text-base text-tm-c-C1A485" style="word-break: keep-all;">호텔에삶 <p class="PtSerif italic text-tm-c-C1A485" style="display:inline-block;word-break: keep-all;">only</p></span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                        @if (isset($hotel->options[0]->facilities))

                                            @php
                                                $facilities = collect(Str::of($hotel->options[0]->facilities)->explode('|'));
                                            @endphp

                                            <div class="pt-12 sm:pt-24 space-y-6 sm:space-y-8">

                                                <div class="flex justify-start">
                                                    <div class="PtSerif italic text-tm-c-0D5E49 text-4xl sm:text-5xl tracking-wider">
                                                        Facilities
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="pt-6 sm:pt-8 space-y-4 sm:space-y-4">
                                                <div class="px-2 sm:px-0 flex flex-wrap w-full">
                                                    @foreach ( $facilities->filter(function ($v) {
                                                        if(!\Illuminate\Support\Str::of($v)->contains('★')){
                                                            return $v;
                                                        }else{
                                                            return null;
                                                        }
                                                    }) as $item)
                                                        <div class="pr-3 pb-2">
                                                            <div class="px-4 py-2 rounded-full border border-solid border-tm-c-30373F">
                                                                <span class="AppSdGothicNeoR text-tm-c-30373F text-lg sm:text-base text-center">{{ $item }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            @if($facilities->filter(function ($v) {
                                                if(\Illuminate\Support\Str::of($v)->contains('★')){
                                                    return $v;
                                                }else{
                                                    return null;
                                                }
                                            })->count() >=1)
                                                <div class="pt-7 sm:pt-12 space-y-4 sm:space-y-4">
                                                    <div class="flex flex-wrap justify-start space-y-3">
                                                        <div class="flex items-center w-full AppSdGothicNeoR text-xl font-bold text-tm-c-0D5E49">
                                                            — 유료 시설
                                                        </div>
                                                        <div class="w-full JeJuMyeongJo text-tm-c-30373F text-xs xs:text-base tracking-wider leading-5 xs:leading-normal">
                                                            @if($hotel->option->getTargetDetailDescriptionAttribute('이용료 발생 시설') !== null)
                                                                {!! $hotel->option->getTargetDetailDescriptionAttribute('이용료 발생 시설') !!}
                                                            @else
                                                                ※ 별도의 추가 이용료가 발생하는 부대시설 입니다.
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="px-2 sm:px-0 flex flex-wrap w-full">
                                                        @foreach ( $facilities->filter(function ($v) {
                                                            if(\Illuminate\Support\Str::of($v)->contains('★')){
                                                                return $v;
                                                            }else{
                                                                return null;
                                                            }
                                                        }) as $item)
                                                            <div class="pr-3 pb-2">
                                                                <div class="px-4 py-2 rounded-full border border-solid border-tm-c-30373F @if(Str::of($item)->contains('★')) border-tm-c-0D5E49 @endif">
                                                                    <span class="AppSdGothicNeoR text-tm-c-30373F text-lg sm:text-base text-center @if(Str::of($item)->contains('★')) text-tm-c-0D5E49 @endif">{{ Str::of($item)->replace('★','')}}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endif



                                        @if (isset($hotel->options[0]->amenities))
                                            @php
                                                $amenities = collect(Str::of($hotel->options[0]->amenities)->explode('|'));
                                            @endphp
                                            <div class="pt-12 sm:pt-24 space-y-6 sm:space-y-8">
                                                <div class="flex justify-start">
                                                    <div class="PtSerif italic text-tm-c-0D5E49 text-4xl sm:text-5xl tracking-wider">
                                                        Amenities
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-6 sm:pt-8 space-y-4 sm:space-y-4">
                                                @if($amenities->filter(function ($v) {
                                                    if(\Illuminate\Support\Str::of($v)->contains('★')){
                                                        return $v;
                                                    }else{
                                                        return null;
                                                    }
                                                })->count() >=1)
                                                    <div class="flex flex-wrap justify-start space-y-2">
                                                        <div class="w-full AppSdGothicNeoR font-bold text-xl text-tm-c-30373F">
                                                            — 포함 사항
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="px-2 sm:px-0 flex flex-wrap w-full">
                                                    @foreach ( $amenities->filter(function ($v) {
                                                        if(!\Illuminate\Support\Str::of($v)->contains('★')){
                                                            return $v;
                                                        }else{
                                                            return null;
                                                        }
                                                    }) as $item)
                                                        <div class="pr-3 pb-2">
                                                            <div class="px-4 py-2 rounded-full border border-solid border-tm-c-30373F">
                                                                <span class="AppSdGothicNeoR text-tm-c-30373F text-lg sm:text-base text-center">{{ Str::of($item)->replace('★','')}}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            @if($amenities->filter(function ($v) {
                                                if(\Illuminate\Support\Str::of($v)->contains('★')){
                                                    return $v;
                                                }else{
                                                    return null;
                                                }
                                            })->count() >=1)
                                                <div class="pt-7 sm:pt-12 space-y-4 sm:space-y-4">
                                                    <div class="flex flex-wrap justify-start space-y-3">
                                                        <div class="flex items-center w-full AppSdGothicNeoR text-xl font-bold text-tm-c-0D5E49">
                                                            — 불포함 사항
                                                        </div>
                                                        <div class="w-full JeJuMyeongJo text-tm-c-30373F text-xs xs:text-base tracking-wider leading-5 xs:leading-normal">
                                                            @if($hotel->option->getTargetDetailDescriptionAttribute('불포함 사항 설명') !== null)
                                                                {!! $hotel->option->getTargetDetailDescriptionAttribute('불포함 사항 설명') !!}
                                                            @else
                                                                ※ 합리적인 가격으로 서비스를 제공하기 위해 해당 품목을 제공하지 않으며,<br>
                                                                <span class="pl-4 sm:pl-6">필요시 개인 지참하셔야 합니다.</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="px-2 sm:px-0 flex flex-wrap w-full">
                                                        @foreach ( $amenities->filter(function ($v) {
                                                                if(\Illuminate\Support\Str::of($v)->contains('★')){
                                                                    return $v;
                                                                }else{
                                                                    return null;
                                                                }
                                                            }) as $item)
                                                            <div class="pr-3 pb-2">
                                                                <div class="px-4 py-2 rounded-full border border-solid border-tm-c-30373F @if(Str::of($item)->contains('★')) border-tm-c-0D5E49 @endif">
                                                                    <span class="AppSdGothicNeoR text-tm-c-30373F text-lg sm:text-base text-center @if(Str::of($item)->contains('★')) text-tm-c-0D5E49 @endif">{{ Str::of($item)->replace('★','')}}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                    @if(isset($hotel->reviews) && $hotel->reviews->count() >= 1)
                                        <div class="pt-16 pb-12 bg-tm-c-d7d3cf">
                                            <div class="max-w-1200 mx-auto">
                                                <div class="py-2">
                                                    <div class="PtSerif italic text-4xl sm:text-5xl text-tm-c-0D5E49">
                                                        Review
                                                    </div>
                                                    <div class="w-full sm:hidden mt-10 px-2" x-data="{show : false}">
                                                        <div class="w-full relative flex-col sm:flex-row space-y-8 pb-4">
                                                            @foreach ($hotel->reviews as $review)
                                                                <div
                                                                    @if( $loop->index >= 3)
                                                                    x-show="show"
                                                                    @endif
                                                                    x-cloak
                                                                >
                                                                    <x-form.review :review="$review"></x-form.review>
                                                                </div>
                                                            @endforeach
                                                            @if($hotel->reviews->count() >= 4)
                                                                <span class="absolute block left-0 bottom-0 w-screen h-56 -ml-4 bg-gradient-to-t lg:bg-gradient-to-r from-tm-c-d7d3cf via-tm-c-d7d3cf to-transparent"
                                                                      x-show="!show"
                                                                ></span>
                                                            @endif
                                                        </div>

                                                        @if($hotel->reviews->count() >= 4)
                                                            <div @click="show=!show" x-show="!show"
                                                                 class="absolute left-0 -mt-20 mx-auto w-full cursor-pointer underline AppSdGothicNeoR text-sm text-tm-c-30373F text-center z-10">
                                                                더 많은 리뷰 보기
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="hidden sm:block review-swiper-container mt-10 px-2 overflow-hidden sm:overflow-visible">
                                                        <div class="swiper-wrapper flex-col sm:flex-row">
                                                            @foreach ($hotel->reviews as $review)
                                                                <div class="swiper-slide" style="height: auto !important;">
                                                                    <x-form.review :review="$review"></x-form.review>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="hidden sm:flex justify-center pt-10">
                                                        <div class="pt-5 review-swiper-pagination space-x-2"></div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    @endif

                                    @if($hotel->faqs->count() >= 1 || isset($hotel->cancellationPolicy))
                                        <div class="pt-16 pb-12" style="background-color: #d7d3cf;">
                                            <div class="max-w-1200 mx-auto">
                                                <div class="py-2" @if($hotel->faqs->count() >= 1)x-data="{ type: 'faq' }"@else x-data="{ type: 'cancel' }"@endif>
                                                    <div class="PtSerif italic text-4xl sm:text-5xl text-tm-c-0D5E49">
                                                        FAQ
                                                    </div>

                                                    <div class="flex pt-6 pb-4 space-x-4">
                                                        @if($hotel->faqs->count() >= 1)
                                                            <div class="JeJuMyeongJo text-xl text-tm-c-30373F cursor-pointer"
                                                                 :class="{ 'text-tm-c-0D5E49 border-b-4 border-solid border-tm-c-0D5E49' : type === 'faq'}"
                                                                 @click="type='faq'">
                                                                <div class="px-px py-2">질문과 답변</div>
                                                            </div>
                                                        @endif
                                                        @isset($hotel->cancellationPolicy)
                                                            <div class="JeJuMyeongJo text-xl text-tm-c-30373F cursor-pointer"
                                                                 :class="{ 'text-tm-c-0D5E49 border-b-4 border-solid border-tm-c-0D5E49' : type === 'cancel'}"
                                                                 @click="type='cancel'">
                                                                <div class="px-px py-2">취소/환불 규정</div>
                                                            </div>
                                                        @endisset
                                                    </div>

                                                    @if($hotel->faqs->count() >= 1)
                                                        <div class="pt-4" x-show="type==='faq'" x-cloak>
                                                            @foreach ($hotel->faqs as $faq)
                                                                <div class="py-1">
                                                                    <x-faq.base now="false" question_title="Q{{$loop->index+1}}."
                                                                                question="{{$faq->question}}"
                                                                                answer="→ {!! $faq->answer !!}" hotel_id="{{$hotel->id}}"></x-faq.base>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    @isset($hotel->cancellationPolicy)
                                                        <div class="pt-4" x-show="type==='cancel'" x-cloak>
                                                            <div>
                                                                <div class="border-t-2 border-b-2 border-solid border-tm-c-30373F AppSdGothicNeoR">
                                                                    <div>
                                                                        <table class="w-full text-tm-c-30373F">
                                                                            <tr class="border-b border-tm-c-30373F">
                                                                                <td class="w-auto sm:w-80 py-2 sm:py-3 px-4 sm:px-5 border-r border-solid border-tm-c-30373F leading-6">
                                                                                    <div class="hidden sm:block">
                                                                                        체크인 예정 일자 <b>21일</b> 전까지 통보
                                                                                    </div>
                                                                                    <div class="block sm:hidden w-max-content">
                                                                                        체크인 예정 일자<br>
                                                                                        <b>21일</b> 전까지 통보
                                                                                    </div>
                                                                                </td>
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 leading-5">
                                                                                    @if($hotel->cancellationPolicy->days_21_30 === 100)전액@else{{$hotel->cancellationPolicy->days_21_30}}% @endif 환불
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-b border-tm-c-30373F">
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 border-r border-solid border-tm-c-30373F leading-6">
                                                                                    <div class="hidden sm:block">
                                                                                        체크인 예정 일자 <b>14-20일</b> 전까지 통보
                                                                                    </div>
                                                                                    <div class="block sm:hidden">
                                                                                        체크인 예정 일자<br>
                                                                                        <b>14-20일</b> 전까지 통보
                                                                                    </div>
                                                                                </td>
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 leading-5">
                                                                                    {{$hotel->cancellationPolicy->days_11_20}}% 환불
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-b border-tm-c-30373F">
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 border-r border-solid border-tm-c-30373F leading-6">
                                                                                    <div class="hidden sm:block">
                                                                                        체크인 예정 일자 <b>7-13일</b> 전까지 통보
                                                                                    </div>
                                                                                    <div class="block sm:hidden">
                                                                                        체크인 예정 일자<br>
                                                                                        <b>7-13일</b> 전까지 통보
                                                                                    </div>
                                                                                </td>
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 leading-5">
                                                                                    {{$hotel->cancellationPolicy->days_7_10}}% 환불
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-b border-tm-c-30373F">
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 border-r border-solid border-tm-c-30373F leading-6">
                                                                                    <div class="hidden sm:block">
                                                                                        체크인 예정 일자 <b>1-6일</b> 전까지 통보
                                                                                    </div>
                                                                                    <div class="block sm:hidden">
                                                                                        체크인 예정 일자<br>
                                                                                        <b>1-6일</b> 전까지 통보
                                                                                    </div>
                                                                                </td>
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 leading-5">
                                                                                    {{$hotel->cancellationPolicy->days_1_6}}% 환불
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="border-b border-tm-c-30373F">
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 border-r border-solid border-tm-c-30373F leading-6">
                                                                                    <div class="hidden sm:block">
                                                                                        체크인 예정 <b>24시간</b> 전까지 통보<br>(체크인 시간 기준)
                                                                                    </div>
                                                                                    <div class="block sm:hidden">
                                                                                        체크인 예정<br>
                                                                                        <b>24시간</b> 전까지 통보<br>
                                                                                        (체크인 시간 기준)
                                                                                    </div>
                                                                                </td>
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 leading-5">
                                                                                    {{$hotel->cancellationPolicy->day}}% 환불
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td rowspan="2" class="py-2 sm:py-3 px-4 sm:px-5 border-r border-solid border-tm-c-30373F leading-6">
                                                                                    이용권 이용 도중 통보
                                                                                </td>
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 border-b border-tm-c-30373F leading-5">
                                                                                    호텔 귀책사유 시 : {!! $hotel->cancellationPolicy->in_use_hotel_fault !!}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="py-2 sm:py-3 px-4 sm:px-5 leading-5">
                                                                                    고객 단순 변심 시 : {!! $hotel->cancellationPolicy->in_use_customer_fault !!}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div>
                                                                        <div class="AppSdGothicNeoR text-lg sm:text-xl font-bold text-tm-c-30373F py-8">
                                                                            Q. 예약 취소 시 왜 일부 금액만 환불이 되나요?
                                                                        </div>
                                                                        <div class="grid lg:grid-cols-2 mx-2 divide-y-2 lg:divide-x-2 lg:divide-y-0 divide-opacity-20 divide-tm-c-30373F">
                                                                            <div class="flex items-start lg:items-center py-4">
                                                                                <div class="w-full max-w-sm flex flex-wrap justify-center items-center text-center space-y-1">
                                                                                    <div class="w-full AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">기존 호텔 예약 플랫폼</div>
                                                                                    <div class="w-full AppSdGothicNeoR text-sm sm:text-lg font-bold text-tm-c-30373F">단기투숙 예약 시</div>
                                                                                    <div class="pt-2 space-y-1">
                                                                                        <div class="flex p-px">
                                                                                            <div class="h-2">
                                                                                                <div class="mt-1"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="AppSdGothicNeoR text-tm-c-30373F text-sm lg:text-base font-semibold flex p-px bg-tm-c-C1A485 bg-opacity-50 rounded-full">
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6 bg-tm-c-ED rounded-full">
                                                                                                <div class="mt-1">5</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">6</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6 bg-tm-c-ED rounded-full">
                                                                                                <div class="mt-1">7</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="flex p-px">
                                                                                            <div class="h-6">
                                                                                                <div class="mt-1"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="w-full AppSdGothicNeoR text-base text-left text-tm-c-30373F leading-7">
                                                                                    해당 기간(단기간)동안<br>
                                                                                    다른 고객이 해당 객실 예약 불가,<br>
                                                                                    예약 취소 시 즉각적으로 새로운 고객<br>
                                                                                    입주 가능하며 영업 손실이 크지 않음
                                                                                </div>
                                                                            </div>

                                                                            <div class="flex items-center pb-4 pt-5">
                                                                                <div class="w-full max-w-sm flex flex-wrap justify-center items-center text-center space-y-1">
                                                                                    <div class="w-full AppSdGothicNeoR text-xs sm:text-base text-tm-c-30373F">호텔에삶</div>
                                                                                    <div class="w-full AppSdGothicNeoR text-sm sm:text-lg font-bold text-tm-c-30373F">장기투숙 예약 시</div>
                                                                                    <div class="pt-2 space-y-1 text-tm-c-30373F text-sm lg:text-base">
                                                                                        <div class="AppSdGothicNeoR font-semibold flex p-px bg-tm-c-C1A485 bg-opacity-50 rounded-full">
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6 bg-tm-c-ED rounded-full">
                                                                                                <div class="mt-1">5</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">6</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">7</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">8</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">9</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">10</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">11</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="AppSdGothicNeoR font-semibold flex p-px bg-tm-c-C1A485 bg-opacity-50 rounded-full">
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">12</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">13</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">14</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">15</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">16</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">17</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">18</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="AppSdGothicNeoR font-semibold flex-0 flex p-px bg-tm-c-C1A485 bg-opacity-50 rounded-full" style="width: min-content;">
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">19</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">20</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6">
                                                                                                <div class="mt-1">21</div>
                                                                                            </div>
                                                                                            <div class="flex items-center justify-center w-5 h-5 lg:w-6 lg:h-6 bg-tm-c-ED rounded-full">
                                                                                                <div class="mt-1">22</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="w-full AppSdGothicNeoR text-base text-left text-tm-c-30373F leading-7">
                                                                                    해당 기간(장기간)동안<br>
                                                                                    다른 고객이 해당 객실 예약 불가,<br>
                                                                                    예약 취소 시 장기간 공실 발생함으로써<br>
                                                                                    호텔측 대규모 영업 손실 발생.<br>
                                                                                    이를 최소화 하기 위해 수수료 발생<br>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="mt-6 sm:mt-8">
                                                                    <div class="text-tm-c-30373F border border-solid border-tm-c-30373F divide-y divide-tm-c-30373F rounded-sm" x-data="{ open : false}">
                                                                        <div class="flex items-center w-full px-5 py-5 AppSdGothicNeoR" @click="open=true">
                                                                            <div class="text-lg sm:text-xl font-bold cursor-pointer">
                                                                                이용자의 취소 환불 규정 전문 확인
                                                                            </div>
                                                                            <div class="ml-auto cursor-pointer" x-show="!open">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                                    <g fill="none" fill-rule="evenodd">
                                                                                        <g>
                                                                                            <g>
                                                                                                <g>
                                                                                                    <g>
                                                                                                        <g>
                                                                                                            <path stroke="#30373F" stroke-width="2" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-304 -606) translate(16 40) translate(0 332) translate(0 224) translate(288 10)"/>
                                                                                                        </g>
                                                                                                    </g>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </svg>
                                                                            </div>
                                                                            <div class="ml-auto cursor-pointer" x-show="open">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                                    <g fill="none" fill-rule="evenodd">
                                                                                        <g>
                                                                                            <g>
                                                                                                <g>
                                                                                                    <g>
                                                                                                        <g>
                                                                                                            <path stroke="#30373F" stroke-width="2" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-304 -606) translate(16 40) translate(0 332) translate(0 224) rotate(-180 156 17)"/>
                                                                                                        </g>
                                                                                                    </g>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                        <style>
                                                                            ::-webkit-scrollbar-thumb{
                                                                                background-color: rgb(133, 134, 138);
                                                                            }
                                                                        </style>
                                                                        <div class="AppSdGothicNeoR space-y-3 px-6 py-4 h-40 overflow-y-scroll" x-show="open" @click.away="open = false" x-cloak>
                                                                            <div class="text-sm leading-5">
                                                                                <span>1. "회사"가 "호텔에삶 회원가입 및 일반 운영약관"에 따라 이용 요금 결제가 이루어진 후 "이용권"이용 이전 및 이용 이후에 이용권 결제를 취소(철회)하는 경우, 취소(철회) 통보 시점에 관한 다음 각 호의 기준에 따라 "이용자"가 추가 요금을 부담합니다.<br></span>
                                                                                <span class="pl-1">가. 체크인 예정 일자 21일 전까지 통보 시 : 이용권 요금 @if($hotel->cancellationPolicy->days_21_30 === 100)전액@else{{$hotel->cancellationPolicy->days_21_30}}% @endif을 "이용자"에게 환불<br></span>
                                                                                <span class="pl-1">나. 체크인 예정 일자 14-20일 전까지 통보 시 : 이용권 요금에서 "호텔" 블락 요금(이용권 예정일 타인 예약을 받지 않아 발생하는 비용을 의미함, 이하 같음) {{ $hotel->cancellationPolicy->reverse_days_11_20 }}% 를 제외한 {{$hotel->cancellationPolicy->days_11_20}}% 금액을 "이용자"에게 환불<br></span>
                                                                                <span class="pl-1">다. 체크인 예정 일자 7-13일 전까지 통보 시 : 이용권 요금에서 "호텔" 블락 요금(이용권 예정일 타인 예약을 받지 않아 발생하는 비용을 의미함, 이하 같음) {{ $hotel->cancellationPolicy->reverse_days_7_10 }}% 를 제외한 {{$hotel->cancellationPolicy->days_7_10}}% 금액을 "이용자"에게 환불<br></span>
                                                                                <span class="pl-1">라. 체크인 예정 일자 1일 전까지 (1~6) 통보 시 : 이용권 요금에서 "호텔"블락 요금(이용권 예정일 타인 예약을 받지 않아 발생하는 비용을 의미함, 이하 같음) {{ $hotel->cancellationPolicy->reverse_days_1_6 }}% 를 제외한 {{$hotel->cancellationPolicy->days_1_6}}% 금액을 "이용자"에게 환불.<br></span>
                                                                                @if($hotel->id === 7 || $hotel->id === 36)
                                                                                    <span class="pl-1">마. 체크인 예정 일자 시간 기준 24시간 이내 통보 시 : 이용권 요금에서 “호텔” 블락 요금(이용권 예정일 타인 예약을 받지 않아 발생하는 비용을 의미함, 이하 같음) 30%를 제외한 70%금액을 “이용자”에게 환불. 다만 일부 호텔 환불 불가.<br></span>
                                                                                    <div class="p-px">
                                                                                        <br>&lt;호텔 특약&gt;<br>
                                                                                        * 위 약관에도 불구하고 이비스 스타일 앰배서더 명동은 체크인(14:00) 24시간 이내 취소 및 환불 불가. 24시간 이전 취소 및 환불 가능(약관에 따른 패널티 부여)<br><br>
                                                                                    </div>
                                                                                @else
                                                                                    <span class="pl-1">마. 체크인 예정 일자 기준 24시간 이내 통보 시 : 이용권 요금에서 "호텔"블락 요금(이용권 예정일 타인 예약을 받지 않아 발생하는 비용을 의미함, 이하 같음) {{ $hotel->cancellationPolicy->reverse_day }}% 를 제외한 {{$hotel->cancellationPolicy->day}}% 금액을 "이용자"에게 환불<br></span>
                                                                                @endif
                                                                                <span class="pl-1">바. 이용권 이용 도중 통보 시 : "호텔" 귀책사유(시설 문제, 기존 협의된 혜택 내용 변동)로 인한 환불 요청 시, 고객이 지불한 이용권 전체 금액 중 (실제 이용박 수 X 이용권 데일리 환산 가격)을 제외한 나머지 금액을 "이용자"에게 환불<br></span>
                                                                                <span class="pl-1">사. 이용권 이용 도중 통보 시 : 고객 단순 변심으로 인해 이용권 이용 중 환불을 요청하는 경우 [이용권 비용 - (고객이 이용한 박 수 X 해당 기간 해당, 호텔별 정찰가)]를 "이용자"에게 환불. 다만 해당 환불 금액이 24시간 이내 취소 환불 요금인 "이용권 비용의 30% 금액"보다 낮은 경우, "이용권 비용의 30% 금액"을 패널티로 적용한다.
                                                                                    호텔별 정찰가는 고객 이용설명서 환불 규정을 준용. 일부 호텔 환불 불가. 이외 이용권에 포함되어 있는 "무료 혜택 비용" 또한 함께 제외되어 "이용자"에게 환불.
                                                                                    <div>(개정일자 : 2021.07.28)</div>
                                                                                    {{--다만 일부 호텔 환불 불가. 이외 이용권에 포함되어 있는 "무료 혜택 비용" 또한 함께 제외되어 "이용자"에게 환불.--}}
                                                                                </span>
                                                                            </div>
                                                                            <div class="relative text-sm text-tm-c-30373F">
                                                                                <div class="space-y-1 p-px">
                                                                                    <div>&lt;호텔별 DAY 정찰가&gt;
                                                                                        @if(isset($hotel->cancellationPolicy->room_types[0])&&$hotel->cancellationPolicy->room_types[0]!=='')
                                                                                            {{$hotel->options->first()->title}}
                                                                                        @endif
                                                                                    </div>
                                                                                    <div>
                                                                                        @foreach ($hotel->cancellationPolicy->weekday_costs as $weekday_cost)
                                                                                            <div class="leading-5">
                                                                                                @if(isset($hotel->cancellationPolicy->room_types[$loop->index])&&$hotel->cancellationPolicy->room_types[$loop->index]!=='')
                                                                                                    <b>ㆍ</b>{{$hotel->cancellationPolicy->room_types[$loop->index]}} :
                                                                                                @else
                                                                                                    @if($loop->index === 0)
                                                                                                        <b>ㆍ</b>{{$hotel->options->first()->title}} :
                                                                                                    @else
                                                                                                        <b>ㆍ</b>룸업그레이드받은 경우 :
                                                                                                    @endif
                                                                                                @endif
                                                                                                @if($weekday_cost === '0' && $hotel->cancellationPolicy->weekend_costs[$loop->index] === '0')
                                                                                                    <span class="text-tm-c-0D5E49">환불 불가</span>
                                                                                                @else
                                                                                                    평일 {{number_format($weekday_cost)}}원 / 주말 {{number_format($hotel->cancellationPolicy->weekend_costs[$loop->index])}}원
                                                                                                @endif
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                    @if($hotel->cancellationPolicy->free_benefits_cost !== null && $hotel->cancellationPolicy->free_benefits_cost !== '')
                                                                                        <div>
                                                                                            <b>ㆍ</b>무료 혜택 비용 : {{$hotel->cancellationPolicy->free_benefits_cost ?? '정보없음'}}
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <!--                                                                    <div class="absolute top-0 left-0 w-full h-full" style="background: rgba(3, 223, 166,0.3);"></div>-->
                                                                            </div>
                                                                            <div class="AppSdGothicNeoR text-sm leading-5">
                                                                                <span class="pl-1">2. “이용자”가 이용권 요금을 결제(지급)한 때로부터 24시간 이내에 이용권을 취소(철회)하는 경우는 입주 예정일로부터 3일 이상이 남은 경우에 한해, 결제 취소(철회) 기간 적용 없이 이용권 요금을 전액 환불합니다. 다만 입주 예정일이 3일 미만 남은 경우는 결제 취소(철회) 기간이 동일하게 적용됩니다.<br></span>
                                                                                <span class="pl-1" style="text-indent: -.6em;margin-left: .6em;">
                                                                                    <p>3. 제1항의 취소(철회) 통보 시점은, ‘취소 요청서가 “회사” 플랫폼에 접수된 시간’ 또는 “회사” 공식 카카오 상담센터를 통하여 취소(철회) 통보한 내용이 기록된 시간’을 기준으로 합니다. 다만 최초 입주 일자를 연기 한후 취소 및 환불 요청 시에는 최초 입주 예정 날짜를 기준 패널티를 적용 합니다.</p>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-6 sm:mt-8">
                                                                    <div class="text-tm-c-30373F border border-solid border-tm-c-30373F divide-y divide-tm-c-30373F rounded-sm" x-data="{ open : false}">
                                                                        <div class="flex items-center w-full px-5 py-5 AppSdGothicNeoR" @click="open=true">
                                                                            <div class="text-lg sm:text-xl font-bold cursor-pointer">
                                                                                이용자의 즉시퇴실 규정에 대한 전문 확인
                                                                            </div>
                                                                            <div class="ml-auto cursor-pointer" x-show="!open">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                                    <g fill="none" fill-rule="evenodd">
                                                                                        <g>
                                                                                            <g>
                                                                                                <g>
                                                                                                    <g>
                                                                                                        <g>
                                                                                                            <path stroke="#30373F" stroke-width="2" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-304 -606) translate(16 40) translate(0 332) translate(0 224) translate(288 10)"/>
                                                                                                        </g>
                                                                                                    </g>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </svg>
                                                                            </div>
                                                                            <div class="ml-auto cursor-pointer" x-show="open">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                                    <g fill="none" fill-rule="evenodd">
                                                                                        <g>
                                                                                            <g>
                                                                                                <g>
                                                                                                    <g>
                                                                                                        <g>
                                                                                                            <path stroke="#30373F" stroke-width="2" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-304 -606) translate(16 40) translate(0 332) translate(0 224) rotate(-180 156 17)"/>
                                                                                                        </g>
                                                                                                    </g>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </svg>
                                                                            </div>
                                                                        </div>
                                                                        <style>
                                                                            ::-webkit-scrollbar-thumb{
                                                                                background-color: rgb(133, 134, 138);
                                                                            }
                                                                        </style>
                                                                        <div class="AppSdGothicNeoR space-y-3 px-6 py-4 h-40 overflow-y-scroll" x-show="open" @click.away="open = false" x-cloak>
                                                                            <div class="text-sm leading-5">
                                                                                <span>1. "호텔에삶 회원가입 및 일반운영약관"에 따라 이용 요금 결제가 이루어진 후 "이용권"은 타인에게 양도 불가하며 적발 시, 사전 안내 없이 즉시 퇴실 조치됩니다. 이때 "호텔에삶 회원가입 및 일반운영약관" 내 "이용자의 취소 환불 규정"의 제 1항 "사"목에 따라 환불 규정이 적용되며 이와 별도로 패널티가 부여될 수 있습니다. 다만, 특수한 상황으로 "이용권" 결제자와 "이용자"가 다른 경우, 체크인 이전 호텔에삶 고객센터로 별도 연락을 주셔야하며 호텔별 내부 규정에 따라 신원확인 후 양도가 허가 될 수 있습니다.</span>
                                                                            </div>

                                                                            <div class="AppSdGothicNeoR text-sm leading-5">
                                                                                <span>2. "호텔에삶 회원가입 및 일반운영약관"에 따라 이용 요금 결제가 이루어진 후 "이용권"을 이용 중인 "이용자" 중 하단의 사유에 해당되는 자는 사전 안내 없이 즉시 퇴실 조치됩니다.<br></span>
                                                                                <span class="pl-1">가. 호텔과 플랫폼측에 무리한 요구를 하는 경우 경고 1회 이후 퇴실 조치<br></span>
                                                                                <span class="pl-1">나. 미풍양속을 저해하는 행위 시 경고 1회 이후 퇴실 조치<br></span>
                                                                                <span class="pl-1">다. 미성년자 단독 투숙 시<br></span>
                                                                                <span class="pl-1">라. 기타 호텔과 플랫폼 운영에 피해를 준다고 판단되는 행위</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        {{-- 룸 끝 --}}

                        @if (isset($hotel->id))
                            {{-- Daily Life --}}
                            <div class="pt-16 mt-10 sm:mt-12 lg:mt-16 overflow-x-hidden overflow-y-hidden h-full">

                                <div class="daily_life_container max-w-1200 mx-auto">
                                    <div class="px-4 px-2">
                                        <div class="PtSerif italic text-4xl sm:text-5xl text-tm-c-C1A485 space-y-4">
                                            <div>Change your</div>
                                            <div>Daily Life</div>
                                        </div>

                                        <div class="flex justify-start mt-6 sm:mt-8 ml-10 sm:ml-14 md:ml-16 lg:ml-20">
                                            <div class="JeJuMyeongJo">
                                                <div class="z-10 text-white text-lg sm:text-xl md:text-2xl lg:text-3xl">당신의 ‘호텔에삶’을 살아보세요.</div>
                                                <div class="relative -ml-1 -mt-2 h-4 bg-tm-c-0D5E49" style="z-index:-1;width:calc( 100% + 50px );"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 px-2">
                                        <div class="">
                                            @if(isset($curator) && $curator)
                                                <x-hotel.dev-lists hotel_id="{{$hotel->id}}" curator_id="{{$curator->id}}"></x-hotel.dev-lists>
                                            @else
                                                <x-hotel.dev-lists hotel_id="{{$hotel->id}}" ></x-hotel.dev-lists>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{--Daily Life 끝--}}
                        @endif

                        {{-- 리뷰 --}}
                        {{--<div class="px-4">
                            <div class="max-w-1200 mx-auto">
                                @foreach ($hotel->faqs as $faq)

                                    <div class="w-1/3 p-2 text-center">
                                        <div class="bg-gray-200 py-4 space-y-2">
                                            <div>{{$faq->answer_name}}▢▢</div>
                                            <div>{{$faq->answer_job}}</div>
                                            <div>{{$faq->answer}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>--}}
                        {{-- 리뷰 끝 --}}

                        @if (isset($hotel->options[0]->area) && isset($hotel->options[0]->lat) && isset($hotel->options[0]->lng))
                            {{-- Map --}}
                            <div class="map_container py-8 sm:py-12 mt-10 sm:mt-12 lg:mt-16">
                                <div class="max-w-1200 mx-auto px-4">
                                    <div>
                                        <div class="space-y-4 sm:space-y-5">
                                            <div>
                                                <div id="map" class="select-none h-60 sm:h-96" style="width:100%;max-height: 400px;"></div>
                                            </div>
                                            <div class="JeJuMyeongJo text-base text-white leading-normal">
                                                {{$hotel->options[0]->area}} {{$hotel->options[0]->title}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Map 끝 --}}
                        @endif
                        @if($hotel->other_hotels[0]!==null && $hotel->other_hotels[0]!=='' && isset($hotel->other_hotels[0]))
                            <div class="mt-10 sm:mt-12 lg:mt-16">
                                <div class="overflow-x-hidden overflow-y-hidden h-full">
                                    <div class="other_hotels_container max-w-1200 mx-auto px-4">
                                        <div class="px-2">
                                            <div class="JeJuMyeongJo text-lg sm:text-2xl text-tm-c-C1A485 space-y-4">
                                                <div>다른 호텔 살펴보기</div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="">
                                                @livewire('other-hotel-lists',['curator_id'=>$curator->id ?? null, 'hotel'=>$hotel])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="pb-26 px-2">
                            @livewire('enter.recommendation')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:hotel.additional-information :hotel="$hotel" :dev="true"></livewire:hotel.additional-information>
@endsection
@section('bottom-script')
    <script type="text/javascript" src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=7ecc88f4a16173c33025206c3fb0dc08"></script>
    <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type="text/javascript">
        function appendBody($roomName, $img){
            $('body').css({
                'overflow':'hidden'
            }).append(
                '<div class="roomZoomImage w-screen h-screen fixed top-0 left-0 bg-black bg-opacity-75 z-50 cursor-pointer"' +
                'x-data="{ show : false }" x-init="show=true" @click="show=false"' +
                'x-show="show"' +
                ' x-transition:leave="transition-all ease-out duration-500"' +
                ' x-transition:leave-start="transform opacity-100"' +
                ' x-transition:leave-end="transform opacity-0">' +
                '<div class="h-full flex flex-wrap items-center justify-center">' +
                '<div class="w-10/12 max-w-5xl">' +
                '<div class="AppSdGothicNeoR pb-3 text-lg sm:text-xl w-full text-left text-white">'+$roomName+'</div>' +
                '<div><img src="'+$img+'" alt="Room Zoom Image"></div>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
        }

        $(document).on('click', '.roomZoomImage', function (){
            $('body').css({
                'overflow':'visible'
            })
        });

        var viewImagesSwiper =null;
        let windowInnerWidth = window.innerWidth;

        let reviewSwiper = null;
        let reviewInterval = true;

        $(document).ready(function(){
            reviewSlider();
        });

        $(window).resize(function() {
            windowInnerWidth = window.innerWidth;
        });

        const reviewSlider = function (){
            if($('.review-swiper-container').hasClass('swiper-container-initialized')){
                reviewSwiper.destroy();
            }
            reviewSwiper = new Swiper('.review-swiper-container', {
                autoHeight: true,
                slidesPerView: 1.4,
                speed: 400,
                spaceBetween: 20,
                dots: true,
                pagination: {
                    el: '.review-swiper-pagination',
                    type: 'bullets',
                },
                breakpoints: {
                    // when window width is >= 320px
                    500: {
                        slidesPerView: 1.2
                    },
                    600: {
                        slidesPerView: 1.4
                    },
                    700: {
                        slidesPerView: 1.6
                    },
                    800: {
                        slidesPerView: 1.8
                    },
                    900: {
                        slidesPerView: 1.9
                    },
                    1024: {
                        slidesPerView: 2.0
                    },
                    1124: {
                        slidesPerView: 2.1
                    },
                    1224: {
                        slidesPerView: 2.2
                    },
                    1424: {
                        slidesPerView: 2.3
                    },
                    1624: {
                        slidesPerView: 2.4
                    },
                    1824: {
                        slidesPerView: 2.5
                    },
                    1924: {
                        slidesPerView: 2.6
                    },
                    2024: {
                        slidesPerView: 2.7
                    },
                },
            });
        };

        function allImagesSlider() {
            @php
                $mainImages = \Illuminate\Support\Str::of($hotel->images[0]->images)->explode('|');
            @endphp
            var images = <?=$mainImages?>;
            var html = images.map(function(element){
                return '<div class="swiper-slide px-4 w-full" ><img src="https://d2pyzcqibfhr70.cloudfront.net/'+element+'" class="w-full mx-auto" style="max-width: 840px;" alt=""></div>';
            });

            $('.view-images-swiper-container .swiper-wrapper').html('').append(html);
            $('body').css({
                'overflow':'hidden'
            });
            $('div.slide_container.hidden').removeClass('hidden');

            viewImagesSwiper = new Swiper('.view-images-swiper-container', {
                direction: 'vertical',
                autoHeight: true,
                slidesPerView: 'auto',
                loop:false,
                speed: 400,
                spaceBetween: 60,
                updateOnWindowResize:true,
                mousewheel: true,
                breakpoints: {
                    10: {
                        spaceBetween: 10
                    },
                    320: {
                        spaceBetween: 20
                    },
                    480: {
                        spaceBetween: 30
                    },
                    640: {
                        spaceBetween: 40
                    }
                },
                pagination: {
                    el: '.slide-page',
                    type: 'custom',
                    renderCustom: function (swiper, current, total) {
                        return current + ' /' + html.length;
                    }
                },
                on: {
                    init: function () {
                        $('.view-images-swiper-container .swiper-wrapper').addClass('mb-60');
                        setTimeout(function () {
                            viewImagesSwiper.update();
                        }, 300);
                    }
                }
            });

        };

        $(document).on('click','.slide-close',function(){
            viewImagesSwiper.destroy();
            $('div.slide_container').addClass('hidden');
            $('body').css({
                'overflow':'visible'
            });
        });

        const KakaoTitle = '트래블메이커스 호텔에삶';
        const KakaoDescription = '';
        const KakaoImageUrl = '';
        const KakaoButtonsTitle = '호텔에삶 보러가기';
        var map=null;

        window.onload = function () {
            $(function(){
                if('{{$hotel->options[0]->lat}}' !== '' && '{{$hotel->options[0]->lng}}' !== ''){
                    const container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
                    const options = { //지도를 생성할 때 필요한 기본 옵션
                        center: new kakao.maps.LatLng('{{$hotel->options[0]->lat}}', '{{$hotel->options[0]->lng}}'), //지도의 중심좌표.
                        level: 4, //지도의 레벨(확대, 축소 정도)
                        draggable: true,
                        scrollWheel: false,
                        disableDoubleClick: false,
                        disableDoubleClickZoom: false,
                    };
                    map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴
                    const marker = new kakao.maps.Marker({
                        map: map,
                        position: new kakao.maps.LatLng('{{$hotel->options[0]->lat}}', '{{$hotel->options[0]->lng}}')
                    });
                    const markerImage = new kakao.maps.MarkerImage(
                        'https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-mapmarker-02.svg',
                        new kakao.maps.Size(31, 35), new kakao.maps.Point(13, 34));
                    marker.setImage(markerImage);
                }
            });
        };

        var interval=null;
        $(window).resize(function() {
            clearTimeout(interval);
            interval=setTimeout(function(){
                if('{{$hotel->options[0]->lat}}' !== '' && '{{$hotel->options[0]->lng}}' !== ''){
                    map.setCenter(new kakao.maps.LatLng('{{$hotel->options[0]->lat}}','{{$hotel->options[0]->lng}}'));
                }
            },200);
        });

        /*카톡 공유*/
        function shareKakaoLink(){
            Kakao.init('7ecc88f4a16173c33025206c3fb0dc08');
            Kakao.Link.sendDefault({
                objectType: "feed",
                content: {
                    title: KakaoTitle,   // 콘텐츠의 타이틀
                    description: KakaoDescription,   // 콘텐츠 상세설명
                    imageUrl: KakaoImageUrl,  // 썸네일 이미지
                    link: {
                        mobileWebUrl: window.location.href,   // 모바일 카카오톡에서 사용하는 웹 링크 URL
                        webUrl: window.location.href // PC버전 카카오톡에서 사용하는 웹 링크 URL
                    }
                },
                social: {
                    likeCount: 0,       // LIKE 개수
                    commentCount: 0,    // 댓글 개수
                    sharedCount: 0,     // 공유 회수
                },
                buttons: [
                    {
                        title: KakaoButtonsTitle,    // 버튼 제목
                        link: {
                            mobileWebUrl: window.location.href,   // 모바일 카카오톡에서 사용하는 웹 링크 URL
                            webUrl: window.location.href // PC버전 카카오톡에서 사용하는 웹 링크 URL
                        }
                    }
                ],
                fail : function () {
                    alert('카카오톡이 설치된 기기에서만 이용 가능합니다.');
                }
            });
            setTimeout(function () {
                Kakao.cleanup();
            },2000);
        }

        function shareFaceBook() {
            var linkUrl = window.location.href;
            window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(linkUrl));
        }

        function shareTwitter() {
            window.open('https://twitter.com/intent/tweet'
                + '?via=TravelMakers'
                + '&text=' + encodeURIComponent($('title').text()) // Title in this html document
                + '&url=' + encodeURIComponent(window.location.href)
            );
        }

        function shareLine() {
            window.open('https://social-plugins.line.me/lineit/share?url=' + encodeURIComponent(window.location.href));
        }

        const CopyUrlToClipboard = function () {
            var obShareUrl = document.getElementById("ShareUrl");
            obShareUrl.value = window.document.location.href;  // 현재 URL 을 세팅해 줍니다
            obShareUrl.select();  // 해당 값이 선택되도록 select() 합니다
            document.execCommand("copy"); // 클립보드에 복사합니다.
            obShareUrl.blur(); // 선택된 것을 다시 선택안된것으로 바꿈니다.
            alert('링크가 복사되었습니다');
        };

        function agree_box(){
            $(".information-text").toggle();
            if ($(".information-text").css("display") === "none") {
                $('span.information-agree').text('(약관 확인하기)');
            }else{
                $('span.information-agree').text('(닫기)');
            }
        }
    </script>
@endsection
