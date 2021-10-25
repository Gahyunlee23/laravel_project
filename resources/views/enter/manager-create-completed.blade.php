@extends('layouts.app')
@section('meta-tag')
    @php
        $meta_title=env('APP_TITLE', '호텔에삶 호텔 매니저');
        $ogDescription='매일을 여행하듯 사는 호텔한달살기, 호텔장기투숙 플랫폼 호텔에삶에서 만나보세요..';
        $keywords ='호텔에삶, 호텔의삶, 한달살기, 호텔한달살기, 서울한달살기, 서울한달숙소, 서울장기투숙, 호텔장기투숙, 단기월세, 한달살이, 호텔장기투숙, 국내한달살기, 호캉스, 서울무보증원룸, 보증금없는월세, 서울호캉스추천, 월세단기, 무보증월세,트래블메이커스, 트래블메이커';
        $ogTitle=env('APP_TITLE', '호텔에삶 호텔 매니저');
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
@endsection

@section('content')
    <div>
        <div class="absolute top-0 left-0 w-full" style="top: 40%;">
            <div class="flex justify-center items-center w-full h-full max-w-1200 mx-auto px-4">
                <div>
                    <div class="text-center space-y-5 sm:space-y-4">
                        <div class="JeJuMyeongJo text-white text-xl 2xs:text-2xl md:text-3xl">
                            호텔 매니저 가입을 축하드립니다!
                        </div>
                        <div class="AppSdGothicNeoR text-base 2xs:text-lg md:text-xl text-white leading-normal">
                            <div class="hidden sm:block">우측 상단 호텔 매니저를 클릭하시면 입점 신청이 가능합니다.</div>
                            <div class="block sm:hidden">
                                <p>우측 상단 호텔 매니저를 클릭하시면</p>
                                <p>입점 신청이 가능합니다.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <a href="{{route('hotel-manager.index')}}">
                            <div class="flex justify-center items-center py-4 px-4 max-w-xs sm:max-w-sm sm:w-full bg-tm-c-C1A485 rounded-sm mx-auto text-center">
                                <div class="w-max-content AppSdGothicNeoR text-xl sm:text-2xl text-white">호텔 입점 신청하기</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>

    </style>
@endpush

@push('scripts')
    <script>
        @unlessrole('super-admin|admin')
        kakaoPixel('7968131379699859784').pageView('호텔 매니저 가입 완료 페이지');
        @endunlessrole
    </script>
@endpush
