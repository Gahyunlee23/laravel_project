@extends('layouts.app')
@section('meta-tag')
    @php
        $meta_title=env('APP_TITLE');
        $ogDescription='매일을 여행하듯 사는 호텔한달살기, 호텔장기투숙 플랫폼 호텔에삶에서 만나보세요..';
        $keywords ='호텔에삶, 호텔의삶, 한달살기, 호텔한달살기, 서울한달살기, 서울한달숙소, 서울장기투숙, 호텔장기투숙, 단기월세, 한달살이, 호텔장기투숙, 국내한달살기, 호캉스, 서울무보증원룸, 보증금없는월세, 서울호캉스추천, 월세단기, 무보증월세,트래블메이커스, 트래블메이커';
        $ogTitle=env('APP_TITLE');
        $ogUrl=secure_url('/');
        $ogImage='';
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
    <script>
        kakaoPixel('7968131379699859784').pageView('투어 신청');
        gtag('event', 'conversion', {'send_to': 'AW-753064854/OCvWCPjOxuEBEJa3i-cC'});
    </script>
    <div class="container mx-auto">
        <div class="flex justify-center items-center" style="height:75vh;">

            <div class="w-full max-w-4xl px-2">
                <div class="">
                    <div class="bg-tm-c-ED py-10" style="">
                        <div class="space-y-8 select-none">

                            <div class="flex justify-center">
                                <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg')}}"
                                     class="w-16" alt="">
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-center">
                                    <div class="PtSerif italic text-tm-c-30373F text-3xl sm:text-5xl tracking-wide">
                                        Thank you :)
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <div class="JeJuMyeongJo text-tm-c-30373F text-2xl sm:text-3xl tracking-wide">
                                        호텔 투어 신청이 완료되었습니다.
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="AppSdGothicNeoR text-tm-c-30373F text-lg text-center leading-7">
                                    투어 관련 자세한 내용은 <span class="sm:hidden"><br></span>입력하신 휴대번호 카카오톡으로 연락드립니다.
                                </div>
                            </div>

                            <div class="flex justify-center">
                                <div>
                                    <div class="">
                                        <div class="w-full select-none">
                                            <a href="{{route('/')}}">
                                                <div class="w-full max-w-4xl bg-tm-c-C1A485 cursor-pointer py-5 sm:py-7 px-4 sm:px-12 rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                                     style="min-width: 250px">
                                                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                                                        홈으로 돌아가기
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
