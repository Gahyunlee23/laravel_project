@extends('layouts.app')

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
@endsection

@section('content')

        <div class="max-w-1200 mx-auto px-4 mt-8">


        <div class="cursor-pointer" onclick="location.href='{{ route('my-page.main') }}'">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 32 33">
                <g fill="none" fill-rule="evenodd">
                    <g>
                        <path fill="#30373F" d="M0 0H1920V1333H0z" transform="translate(-360 -114)"/>
                        <g>
                            <g>
                                <path stroke="#FFF" stroke-width="2" d="M3 16L16 30 29 16" transform="translate(-360 -114) translate(360 114) rotate(90 15.75 16.25)"/>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </div>


        <div class="JeJuMyeongJo text-lg 2xs:text-xl xs:text-3xl text-white space-y-1 xs:space-y-2 mt-4">
            <div>개인정보</div>
        </div>
        </div>

        <div class="flex w-full justify-center">
            <div class="w-full max-w-6xl px-4 sm:px-0">
                <livewire:auth.modify-password></livewire:auth.modify-password>
            </div>
        </div>
@endsection
