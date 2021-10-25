@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection

@section('meta-tag')
    @php
        $meta_title=env('APP_TITLE');
        $ogDescription='매일을 여행하듯 사는 호텔한달살기, 호텔장기투숙 플랫폼 호텔에삶에서 만나보세요..';
        $keywords ='호텔에삶, 호텔의삶, 한달살기, 호텔한달살기, 서울한달살기, 서울한달숙소, 서울장기투숙, 호텔장기투숙, 단기월세, 한달살이, 호텔장기투숙, 국내한달살기, 호캉스, 서울무보증원룸, 보증금없는월세, 서울호캉스추천, 월세단기, 무보증월세,트래블메이커스, 트래블메이커';
        $ogTitle=env('APP_TITLE');
        $ogUrl='https://www.livinginhotel.com/';
        $ogImage=secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/link-img-4-3.png');
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
    <link rel="canonical" href="{{$ogUrl}}">
<!--    <link rel="canonical" href="{{$ogUrl}}">
<span itemscope="" itemtype="http://schema.org/Organization">
 <link itemprop="url" href="https://www.livinginhotel.com">
 <a itemprop="sameAs" href="https://www.instagram.com/travelmakerkorea"></a>
 <a itemprop="sameAs" href="https://www.facebook.com/travelmakerkorea"></a>
 <a itemprop="sameAs" href="https://blog.naver.com/travelmakerkorea"></a>
 <a itemprop="sameAs" href="https://www.youtube.com/channel/UC34tS60zWZdFByDBQcK93SQ"></a>
</span>-->

@endsection

@section('top-style')

@endsection
@section('content')
@php
    $userAgent = $_SERVER["HTTP_USER_AGENT"];

    $appleMobileAgent = ["iPhone","iphone", "iPod", "ipad"];
    $androidMobileAgent = ["Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony"];
    $device = '';
    $mobile_chk = false;

    for ($i = 0,$iMax = sizeof($appleMobileAgent); $i < $iMax; $i++) {
        if (stripos($userAgent, $appleMobileAgent[$i])) {
            $device = $appleMobileAgent[$i];
            $mobile_chk = true;
            break;
        }
    }

    for ($i = 0,$iMax = sizeof($androidMobileAgent); $i < $iMax; $i++) {
        if (stripos($userAgent, $androidMobileAgent[$i])) {
            $device = $androidMobileAgent[$i];
            $mobile_chk = true;
            break;
        }
    }

    if(preg_match('/MSIE/i',$userAgent) || preg_match('/Trident/i',$userAgent)){
        $browser = 'Explorer';
    }
    else if(preg_match('/Edg/i',$userAgent)){
        $browser = 'Edge';
    }
    else if(preg_match('/Whale/i',$userAgent)){
        $browser = 'Whale';
        if(preg_match('/1.0.0.0/i',$userAgent)){
            $browser = 'Naver';
        }
    }
    else if(preg_match('/SamsungBrowser/i',$userAgent)){
        $browser = 'SamsungBrowser';
    }
    else if(preg_match('/Firefox/i',$userAgent)){
        $browser = 'Firefox';
    }
    else if (preg_match('/Chrome/i',$userAgent)){
        $browser = 'Chrome';
    }
    else if(preg_match('/Safari/i',$userAgent)){
        $browser = 'Safari';
    }
    elseif(preg_match('/Opera/i',$userAgent)){
        $browser = 'Opera';
    }
    elseif(preg_match('/Netscape/i',$userAgent)){
        $browser = 'Netscape';
    }
    else{
        $browser = "Other";
    }

    if (preg_match('/linux/i', $userAgent)){
        $os = 'linux';}
    elseif(preg_match('/macintosh|mac os x/i', $userAgent)){
        $os = 'mac';}
    elseif (preg_match('/windows|win32/i', $userAgent)){
        $os = 'windows';}
    else {
        $os = 'Other';
    }
@endphp
    <div class="mx-auto pt-6 sm:pt-12 select-none" style="">
        <div>
            <div class="max-w-1200 mx-auto w-full py-6">
                <div class="mx-auto flex justify-start" style="max-width: 1000px;">
                    <div class="mx-2 lg:mx-0 leading-7 sm:leading-9">
                        @auth
                        <div class="JeJuMyeongJo text-lg sm:text-xl md:text-3xl text-white">
                            {{ auth()->user()->name }}님의
                        </div>
                        @endauth
                        <div class="JeJuMyeongJo text-lg sm:text-xl md:text-3xl text-white">
                            호텔에삶 회원가입을 축하드립니다!
                        </div>
                        <div class="AppSdGothicNeoR text-xs sm:text-base md:text-lg text-white">
                            이런 상품은 어떠세요?
                        </div>
                    </div>
                </div>

                <div class="pt-4 mx-auto" style="max-width: 1000px;">
                    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
                        @foreach ($hotels as $hotel)
                            <div class="w-full p-2 float-left cursor-pointer"
                                 x-data="{ scale : false }"
                                 @mouseover="scale=true" @mouseout="scale=false"
                                 onclick="GA_event('product_상품 바로가기 클릭',['{{$hotel->options[0]->title}}','{{$hotel->id}}']);
                                 @if(isset($curator) && $curator && (Route::currentRouteName()!=='curator.index')) location.href='{{route('hotel.view',['hotel'=>$hotel->id,'curator_page'=>$curator->user_page])}}'
                                 @else location.href='{{route('hotel.view',['hotel'=>$hotel->id,'curator_page'=>false])}}' @endif">
                                <div class="h-full bg-gray-200 space-y-2 text-center rounded-sm rounded-t-md shadow-lg">
                                    <div>
                                        @if(isset($hotel->images[0]))
                                            <div class="lozad w-full h-56 rounded-t-sm" :class="{ 'background-scale-110' : scale }"
                                                 data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$hotel->image_first_explode->first())}}"
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
                                                        <div class="absolute bottom-0 mb-5 sm:mb-6 leading-tight">
                                                            <div class="AppSdGothicNeoR font-bold text-base sm:text-xl text-white text-left tracking-widest">
                                                                {{$hotel->options[0]->title}}
                                                            </div>
                                                            <div class="AppSdGothicNeoR text-xs sm:text-sm md:text-lg text-white text-left tracking-wide">
                                                                {{$hotel->options[0]->title_en}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="px-4 sm:px-7 py-4" style="min-height: 90px;">
                                        <div class="">
                                            <div class="AppSdGothicNeoR text-xs sm:text-sm text-tm-c-0D5E49 text-left sm:float-left">
                                                @if($hotel->LowPrice !== '0' || $hotel->MaximumPrice !== '0')
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
                                            <div class="AppSdGothicNeoR mt-1 text-xs sm:text-sm md:text-lg text-tm-c-30373F text-left">
                                                <div class="mt-2 ml-auto flex justify-end">
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
                    </div>
                </div>

                <div class="pt-4 flex justify-center">
                    <div class="text-white underline">
                        <div class="py-1">
                            <a href="{{route('/')}}">
                                더 많은 상품 보러가기 >
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('bottom-script')
<script type="text/javascript">

</script>
@endsection
