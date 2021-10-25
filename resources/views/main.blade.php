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
<script>
    kakaoPixel('7968131379699859784').pageView('메인');
</script>
<div class="mx-auto pt-6 sm:pt-12 select-none">
        <div>
            <div class="w-full" style="padding: 0;">
                <div>

                    <div class="space-y-4 2xs:space-y-6 sm:space-y-12 lg:space-y-16">
                        <div>
                            <div class="max-w-1200 mx-auto pl-6 pr-8 sm:pl-4 sm:pr-6">
                                <div
                                    class="absolute -mt-3 border-2 border-solid main_img_back_border sm:-mt-5 border-tm-c-C1A485 fade-up opacity-25 transition duration-700 ease-out"
                                    style="z-index: -200;">
                                </div>

                                {{--    슬라이드 Start  --}}
                                <div class="main-banner-swiper-container relative"
                                     onmouseover="mainBannerSwiper.autoplay.stop();"
                                     onmouseout="mainBannerSwiper.autoplay.start();">
                                    <div class="swiper-wrapper ml-3 sm:ml-4 overflow-hidden">
                                        <x-slide.banner :curator="$curator ?? false"></x-slide.banner>
                                    </div>
                                </div>
                                {{--    슬라이드 End  --}}
                            </div>

                            <div class="flex bottom-0 justify-center -mt-5 2xs:-mt-5 sm:-mt-4 md:-mt-7 lg:-mt-11 z-50">
                                <div
                                    class="z-30 fade-up opacity-0 transition duration-700 ease-out text-xl italic PTSerif 4xs:text-2xl xs:text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-tm-c-C1A485">
                                    Living in Hotel
                                </div>
                            </div>
                        </div>

                        {{-- early bird coupon starts --}}
                        <div class="pt-14">
                            <div class="w-full bg-tm-c-ED">
                                <livewire:banner.earlybird></livewire:banner.earlybird>
                            </div>
                        </div>
                        {{-- early bird coupon ends --}}


                        {{-- 지역 상품 리스트 --}}
                        <div class="pt-10 pb-10 sm:pb-20">
                            <div class="max-w-1200 mx-auto px-4">
                                <livewire:hotels.catalog tabSearch="seoul" :curator="$curator"></livewire:hotels.catalog>
                            </div>
                        </div>
                        {{-- 지역 상품 리스트 끝 --}}

                        {{-- 프로모션 띠 배너 시작 --}}
                        <div class="pb-24 sm:pb-36">
                            <livewire:banner.promo></livewire:banner.promo>
                        </div>
                        {{-- 프로모션 띠 배너 끝 --}}

                        {{-- 리뷰 --}}
                        <div>
                            <div class="py-20 sm:py-28 overflow-x-hidden" style="margin-top: -60px; z-index:-1;background-color: #d7d3cf;">
                                <div class="max-w-1200 px-4 mx-auto #pt-72 #relative">
                                    <div class="w-full #absolute #bottom-0 py-2 sm:p-2">
                                        <div class="PtSerif italic text-4xl text-tm-c-30373F">
                                            Review
                                        </div>

                                        @hasrole('super-admin')
                                        <div class="w-full sm:hidden mt-10 px-2" x-data="{show : false}">
                                            <div class="w-full relative flex-col sm:flex-row space-y-8 pb-4">
                                                <div>
                                                    <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                        name="ny0nkimm"
                                                                        content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                        hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                        link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                </div>
                                                <div>
                                                    <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                        name="ny0nkimm"
                                                                        content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                        hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                        link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                </div>
                                                <div>
                                                    <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                        name="ny0nkimm"
                                                                        content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                        hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                        link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                </div>
                                                <div class="absolute block left-0 bottom-0 w-screen h-56 -ml-4 bg-gradient-to-t from-tm-c-d7d3cf via-tm-c-d7d3cf to-transparent"
                                                     x-show="!show"></div>
                                            </div>
                                            <div @click="show=!show" x-show="!show"
                                                 class="absolute left-0 -mt-20 mx-auto w-full cursor-pointer underline AppSdGothicNeoR text-sm text-tm-c-30373F text-center z-10">
                                                더 많은 리뷰 보기
                                            </div>
                                        </div>
                                        <div class="hidden sm:block review-swiper-container mt-10 overflow-visible">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide" style="height: 100% !important;">
                                                    <div>
                                                        <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                            name="ny0nkimm"
                                                                            content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                            hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                            link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide" style="height: 100% !important;">
                                                    <div>
                                                        <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                            name="ny0nkimm"
                                                                            content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                            hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                            link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide" style="height: 100% !important;">
                                                    <div>
                                                        <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                            name="ny0nkimm"
                                                                            content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                            hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                            link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide" style="height: 100% !important;">
                                                    <div>
                                                        <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                            name="ny0nkimm"
                                                                            content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                            hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                            link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide" style="height: 100% !important;">
                                                    <div>
                                                        <x-form.main-review image="images/0/2021-05-12/owf1Dqdtf6r2hPouB5Gu2qLeWrqBwmFToPeNbEI1.jpg"
                                                                            name="ny0nkimm"
                                                                            content="맑은 청계산 공기를 마시며,<br>조용한 자연 속에서 오롯이<br>나에게 집중하는 시간을 가질 수 있었어요."
                                                                            hotel-name="서울 드래곤시티<br>- 이비스 스타일 앰배서더 서울 용산"
                                                                            link="https://www.livinginhotel.com/hotel/17"></x-form.main-review>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="review-swiper-container mt-10 overflow-visible">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide" style="height: 100% !important;">
                                                        <x-review.card profile="https://d2pyzcqibfhr70.cloudfront.net/resource/review/woman-40.png"
                                                                       name="전00" job="프리랜서 강사"
                                                                       explanation="새 집으로 이사 전, 인테리어 기간 동안 가족들과 단기간 거주하기에 좋았습니다.<br>특히 공유주방이 있어서 직접 요리를 해먹을 수 있는 점이 편리했습니다."></x-review.card>
                                                    </div>
                                                    <div class="swiper-slide" style="height: 100% !important;">
                                                        <x-review.card profile="https://d2pyzcqibfhr70.cloudfront.net/resource/review/man-30.png"
                                                                       name="김00" job="법률 전문가"
                                                                       explanation="입주 후에도 지속적으로 서비스 담당자님이 객실 및 품질 관리를 신경 써주셔서 좋았습니다.<br>언제든 문의사항을 신속히 처리해 주셔서 단순히 상품을 구매하는 것을 넘어 특별하게 케어 받는 기분이 들었습니다."></x-review.card>
                                                    </div>
                                                    <div class="swiper-slide" style="height: 100% !important;">
                                                        <x-review.card profile="https://d2pyzcqibfhr70.cloudfront.net/resource/review/woman-2616335-1920.png"
                                                                       name="박00" job="유튜브 크리에이터"
                                                                       explanation="기분 전환도 할 겸 새로운 작업 공간이 필요해서 안전하고 좋은 시설인 호텔을 선택했어요.<br>깔끔하고 편의시설이 잘 갖춰져서 친구들도 자주 불러서 호캉스를 즐겼습니다."></x-review.card>
                                                    </div>
                                                    <div class="swiper-slide" style="height: 100% !important;">
                                                        <x-review.card profile="https://d2pyzcqibfhr70.cloudfront.net/resource/review/people-2577465-1920.png"
                                                                       name="최00" job="대기업 마케터"
                                                                       explanation="깨끗한 객실에서 생활하니 삶의 질이 확실히 올라갔습니다. 보증금 없이 합리적인 가격에 살 수 있는 점도 좋았고요.<br>특히 호텔 루프탑에 와이파이가 있어서 분위기 있는 곳에서 재택근무도 할 수 있는 점이 좋았습니다."></x-review.card>
                                                    </div>
                                                    <div class="swiper-slide" style="height: 100% !important;">
                                                        <x-review.card profile="https://d2pyzcqibfhr70.cloudfront.net/resource/review/man-5653200-1920.png"
                                                                       name="정00" job="스타트업 CEO"
                                                                       explanation="야근이 잦아서 출퇴근이 힘들었는데 회사 근처 호텔에서 살면서 통근 시간이 많이 줄었습니다.<br>여유가 많이 생겼고 호텔 입주자들과 네트워킹하며 새로운 라이프 스타일을 즐길 수 있어 좋았습니다."></x-review.card>
                                                    </div>
                                                </div>
                                            </div>
                                        @endhasrole
                                        <div class="flex justify-center">
                                            <div class="pt-5 review-swiper-pagination space-x-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 리뷰 끝 --}}

                        {{-- 상품 --}}
                        <style>
                            .background-scale-110{
                                background-size: 120%,120% !important;
                                transition-property: background-size;
                                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                            }
                        </style>


                        <div class="pt-16 pb-16 overflow-x-hidden">
                            <div class="max-w-1200 mx-auto">
                                <div class="px-4 py-2">
                                    <div class="flex justify-center">
                                        <a class="flex justify-center items-center space-x-4"
                                           href="{{ route('hotels.collect',['tab'=>'Living%20in%20Hotel', 'depth'=>'전체', 'curator_page'=>$curator->user_page ?? null]) }}">
                                            <div class="PtSerif italic text-4xl sm:text-5xl text-white">
                                                See All Hotels
                                            </div>
                                            <div>
                                                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/arrow-path.png" class="w-3 sm:w-5" alt=">">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="pt-12 sm:pt-14 flex mx-auto" style="max-width: 1000px;">
                                        <div class="w-full">
                                            <div>
                                                <livewire:product.category :curator="$curator ?? false"></livewire:product.category>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-8 sm:pt-12 flex justify-center">
                                        <a class="w-max-content flex justify-center items-center space-x-2 py-3 border-b border-solid border-tm-c-979b9f"
                                           href="{{ route('hotels.collect',['tab'=>'Living%20in%20Hotel', 'depth'=>'전체', 'curator_page'=>$curator->user_page ?? null]) }}">
                                            <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white">
                                                더 많은 호텔 보러 가기
                                            </div>
                                            <div>
                                                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/Path.png" alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--상품 끝--}}

                    {{-- FAQ --}}
                    <div class="pt-16 pb-16 bg-tm-c-d7d3cf">
                        <div class="max-w-1200 px-4 mx-auto">

                            <div class="py-2">
                                <div class="PtSerif italic text-4xl text-tm-c-30373F">
                                    FAQ
                                </div>
                                <div class="pt-4">
                                    <div class="py-1">
                                        <x-faq.base now="false" question_title="Q1."
                                                    question="입주 가능 일자는 언제인가요?"
                                                    answer="→ 투어 및 입주 신청한 호텔에 공실이 있다면 희망 일자에 언제든지 가능합니다."></x-faq.base>
                                    </div>
                                    <div class="py-1">
                                        <x-faq.base now="false" question_title="Q2."
                                                    question="원룸, 오피스텔 자취하는 것과 무엇이 다른가요?"
                                                    answer="→ 연 단위 계약/보증금/관리비 없이 호텔 서비스를 누리며 프리미엄한 라이프 스타일을 즐길 수 있습니다."></x-faq.base>
                                    </div>
                                    <div class="py-1">
                                        <x-faq.base now="false" question_title="Q3."
                                                    question="일반 호텔 장기 투숙과 무엇이 다른가요?"
                                                    answer="→ 호텔에삶 멤버십 고객은 일반 장기 투숙보다 할인된 가격으로 호텔 입주가 가능합니다.<br><span class='block sm:hidden'><br></span>
호텔 별 특별 혜택(조식 밀키트, F&B 할인, 룸 업그레이드, 무료 세탁 등)과 입주자들과의 네트워킹(프라이빗 파티, 운동 메이트, 독서/와인 모임 등) 기회를 제공합니다."></x-faq.base>
                                    </div>
                                    <div class="py-1">
                                        <x-faq.base now="false" question_title="Q4."
                                                    question="딱 한달살기만 가능한가요?"
                                                    answer="→ 호텔에 따라 일주일부터 3개월 이상 예약이 가능하며, 원하는 기간만큼 연장이 가능합니다."></x-faq.base>
                                    </div>
                                    <div class="py-1">
                                        <x-faq.base now="false" question_title="Q5."
                                                    question="1주 살기, 2주 살기, 3주 살기, 한달살기는 무엇이 다른가요?"
                                                    answer="→ 1주 살기는 6박 7일 상품입니다.<br>2주 살기는 1주 살기 2번에 1박이 추가된 13박 14일 상품입니다.<br>3주 살기는 1주 살기 3번에 2박이 추가된 20박 21일 상품이며,<br>한달살기는 1주 살기 4번에 5박이 추가된 29박 30일 상품입니다. 기간이 늘어날수록 숙박일과 별도 혜택이 추가됩니다. "></x-faq.base>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{--FAQ 끝--}}

                    {{-- footer --}}
                    <div class="pt-16 pb-28 bg-tm-c-ED">
                        <div class="max-w-1200 mx-auto px-4">
                            <x-footer.footer-01></x-footer.footer-01>
                        </div>
                    </div>
                    {{-- footer 끝 --}}
                </div>
            </div>
        </div>
    </div>

{{-- 팝업 Start --}}
<div class="popup-20210114 hidden fixed w-full top-0 left-0 select-none" style="z-index:1000001;background-color:rgba(0,0,0,0.5)">
    <div class="z-50 flex justify-center items-center h-screen">
        <div class="w-auto px-2 xs:w-auto xs:px-0">
            <div class="flex justify-center">
                <div class="absolute -mt-12">
                    <img data-src="https://d2pyzcqibfhr70.cloudfront.net/resource/logos/logo_typetop.png"
                         class="lozad w-24" alt="">
                </div>
            </div>

            <div class="px-1 py-1 bg-tm-c-ED rounded-sm">
                <div class="px-px py-px border">
                    <div class="px-1 py-1 border-2 border-tm-c-30373F">
                        <div class="border border-tm-c-30373F" style="padding: .5rem .74rem;">
                            <div class="flex justify-end">
                                <img data-src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-close-black.svg"
                                     class="lozad w-10 cursor-pointer" alt="" onclick="popupClose();">
                            </div>
                            <div class="px-6 pt-10 pb-4">
                                <div class="pb-6 text-center">
                                    <div class="PtSerif italic text-4xl xs:text-5xl text-tm-c-30373F">
                                        Open Event
                                    </div>
                                    <div class="pt-4 JeJuMyeongJo font-italic text-base xs:text-lg text-tm-c-30373F leading-6">
                                        페어필드 바이 메리어트 서울<br>
                                        한 달 살기 오픈 기념 할인 이벤트
                                    </div>
                                </div>
                                <div class="px-2 w-full h-px">
                                    <div class="w-full h-px bg-tm-c-30373F"></div>
                                </div>
                                <div class="pt-6 sm:pt-8 text-center">
                                    <span class="JeJuMyeongJo font-bold tracking-wide leading-relaxed text-base 3xs:text-lg text-tm-c-0D5E49">
                                        선착순 10객실 한정 10만원 할인
                                    </span><br>
                                    <span class="pt-2 JeJuMyeongJo text-tm-c-30373F text-xs 2xs:text-base leading-6">
                                        여유와 즐거움, 삶의 균형을 맞춰주는<br>
                                        ‘호텔에삶’을 살아보세요.
                                    </span>
                                </div>
                                <div class="text-center mt-4 sm:mt-6">
                                    <span
                                        onclick="popupCookieClose('20210114');"
                                        class="JeJuMyeongJo font-italic text-xs 3xs:text-base text-tm-c-30373F underline cursor-pointer">
                                        오늘은 그만 보기
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-black bg-opacity-20 rounded-b-sm">
                <a href="{{route('hotel.view',['hotel'=>19])}}" onclick="GA_event('popup_redirect',[19]);">
                    <div class="py-6 text-left px-6"
                         style="background: url('https://d2pyzcqibfhr70.cloudfront.net/resource/popup/20210114_banner.png') no-repeat center center;
                        background-size: cover;">
                        <div class="pt-3 JeJuMyeongJo text-xs 3xs:text-base text-tm-c-C1A485 leading-snug">
                            페어필드 바이 메리어트 서울
                        </div>
                        <div class="pb-3 mt-1 JeJuMyeongJo text-white text-lg">
                            지금 바로 할인받기 >
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
{{-- 팝업 End --}}

{{-- 문의하기 버튼--}}
<div class="kakaoOnetoOne fixed mx-auto z-50 mb-5 mr-1 sm:mb-12 sm:mr-5 md:mr-8 lg:mr-12 rounded-full" style="bottom: 0;right:0;">
    <div>
        <svg width="96px" height="96px"
             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             class="channelTalk-button rounded-full cursor-pointer">
            <defs>
                <filter x="-37.1%" y="-37.1%" width="174.2%" height="174.2%" filterUnits="objectBoundingBox" id="filter-1">
                    <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                    <feGaussianBlur stdDeviation="5" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                    <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.2 0" type="matrix" in="shadowBlurOuter1" result="shadowMatrixOuter1"></feColorMatrix>
                    <feMerge>
                        <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                        <feMergeNode in="SourceGraphic"></feMergeNode>
                    </feMerge>
                </filter>
            </defs>
            <g id="메인(랜딩)페이지" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
               style="box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.2);">
                <g id="Landingpage_PC" transform="translate(-1761.000000, -2942.000000)">
                    <g id="btn_flaoting_ask" filter="url(#filter-1)" transform="translate(1778.000000, 2959.000000)">
                        <g>
                            <circle id="Oval" fill="#FFFFFF" cx="31" cy="31" r="31"></circle>
                            <g id="ic_ask" transform="translate(31.000000, 34.000000) scale(-1, 1) translate(-31.000000, -34.000000) translate(15.000000, 19.000000)" fill="#C1A485">
                                <path d="M30,0 C31.1045695,-2.16501571e-15 32,0.8954305 32,2 L32,21.061979 C32,22.1665485 31.1045695,23.061979 30,23.061979 L19.001,23.061 L10.6257199,29.7794562 C10.4837375,29.8933482 10.3140802,29.9657824 10.1354054,29.9902004 L10,29.9994084 C9.48716416,29.9994084 9.06449284,29.6133682 9.00672773,29.1160295 L9,28.9994084 L9,23.061 L2,23.061979 C0.8954305,23.061979 1.3527075e-16,22.1665485 0,21.061979 L0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 L30,0 Z M8,9 C6.8954305,9 6,9.8954305 6,11 C6,12.1045695 6.8954305,13 8,13 C9.1045695,13 10,12.1045695 10,11 C10,9.8954305 9.1045695,9 8,9 Z M16,9 C14.8954305,9 14,9.8954305 14,11 C14,12.1045695 14.8954305,13 16,13 C17.1045695,13 18,12.1045695 18,11 C18,9.8954305 17.1045695,9 16,9 Z M24,9 C22.8954305,9 22,9.8954305 22,11 C22,12.1045695 22.8954305,13 24,13 C25.1045695,13 26,12.1045695 26,11 C26,9.8954305 25.1045695,9 24,9 Z" id="Combined-Shape"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </svg>
    </div>
</div>

<style type="text/css">
    .review-swiper-pagination .swiper-pagination-bullet{
        border: 1px solid #30373f;
        background-color: rgba(0,0,0,0);
    }
    .review-swiper-pagination .swiper-pagination-bullet-active{
        background: #30373f !important;
    }
    .product-swiper-pagination .swiper-pagination-bullet{
        border: 1px solid #d7d3cf;
        background-color: rgba(0,0,0,0);
    }
    .product-swiper-pagination .swiper-pagination-bullet-active{
        background: #d7d3cf !important;
    }
</style>
@endsection
@section('bottom-script')
<script src="//developers.kakao.com/sdk/js/kakao.min.js" defer></script>
<script type="text/javascript">
    @if($device === 'ipad' || $os ==='mac')
        var options = {
            id: 499933405,
            width: 1200,
            loop: true,
            controls: true,
            responsive:true,
            title:false,
            byline:false,
            portrait:false
        };
    @else
        var options = {
            id: 499933405,
            width: 1200,
            loop: true,
            controls: true,
            responsive:true,
            title:false,
            byline:false,
            portrait:false,
            autoplay:false
        };
    @endif

    let reviewSwiper = null;
    let mainBannerSwiper = null;
    let windowInnerWidth = window.innerWidth;

    let reviewInterval = true;
    let mainBannerSizeInterval = true;

    $(document).ready(function(){
        reviewSlider();
        mainBannerSlider();

        setTimeout(function (){
            $('.fade-up.opacity-0').each( function(i){
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                var bottom_of_object = $(this).offset().top + ($(this).outerHeight()/2);
                if( bottom_of_window > bottom_of_object ){
                    $(this).removeClass('opacity-0 mt-20 ml-20');
                }
            });
            $('.fade-up.opacity-25').each( function(i){
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                var bottom_of_object = $(this).offset().top + ($(this).outerHeight()/2);
                if( bottom_of_window > bottom_of_object ){
                    $(this).removeClass('opacity-25 mt-20 ml-20');
                }
            });
            /*$(window).scroll( function(){
                if(player === null){
                    vimeoPlayLoad();
                }
            });*/
        },500);
    });
    function kakaoOnetoOneFixed(){
        if(windowInnerWidth >=1200){
            console.log((windowInnerWidth - 1200 ));
            $('.kakaoOnetoOne').css({'right':(windowInnerWidth - 1200 )/2});
        }else{
            $('.kakaoOnetoOne').css({'left':(windowInnerWidth-$('.kakaoOnetoOne').width()-15)});
        }
    }
    $(window).resize(function() {
        windowInnerWidth = window.innerWidth;
        if(mainBannerSizeInterval){
            mainBannerSize(50);
        }
    });

    window.onload = function() {
        mainBannerSize(10);
    };

    /*function windowScrollMoveCheck(){
        $('.fade-up.opacity-0').each(function(i){
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            var bottom_of_object = $(this).offset().top + ($(this).outerHeight()/2);
            if( bottom_of_window > bottom_of_object ){
                $(this).removeClass('opacity-0 mt-20 ml-20');
            }
        });
        $('.fade-up.opacity-25').each(function(i){
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            var bottom_of_object = $(this).offset().top + ($(this).outerHeight()/2);
            if( bottom_of_window > bottom_of_object ){
                $(this).removeClass('opacity-25 mt-20 ml-20');
            }
        });
        setTimeout(function () {
            if(playerStopCheck){
                /!* 타겟 위치가 화면 에 중간이상 나올시 출력*!/
                var target = $('div#vimeo_video_01');
                var window_position = $(window).scrollTop() + $(window).height();
                var object_position = target.offset().top + (target.outerHeight()/2);
                if( window_position >= object_position && window_position <= (object_position + (target.outerHeight()*2))){

                    player.play();
                }else{
                    if(player !== null){
                        player.pause();
                    }
                    setTimeout(function(){
                        playerStopCheck=true;
                    },100);
                }
            }
        },100);
    }

    function vimeoPlayLoad(){
        if(player === null){
            player = new Vimeo.Player('vimeo_video_01', options);

            player.setVolume(0.5);
            player.on('pause', function(){
                playerStopCheck = false;
            });
        }
    }*/

    function popupClose(){
        $('.popup-20210114').addClass('hidden');
    }

    function popupCookieClose($name){
        setCookie($name, 'off', '1');
        popupClose();
    }
    function setCookie(cookie_name, value, days) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + days);
        // 설정 일수만큼 현재시간에 만료값으로 지정

        var cookie_value = escape(value) + ((days == null) ? '' : '; expires=' + exdate.toUTCString());
        document.cookie = cookie_name + '=' + cookie_value;
    }

    function getCookie(cookie_name) {
        var x, y;
        var val = document.cookie.split(';');

        for (var i = 0; i < val.length; i++) {
            x = val[i].substr(0, val[i].indexOf('='));
            y = val[i].substr(val[i].indexOf('=') + 1);
            x = x.replace(/^\s+|\s+$/g, ''); // 앞과 뒤의 공백 제거하기
            if (x == cookie_name) {
                return unescape(y); // unescape로 디코딩 후 값 리턴
            }
        }
    }

    const mainBannerSlider = function (){
        mainBannerSwiper = new Swiper('.main-banner-swiper-container', {
            // direction: 'vertical',
            slidesPerView: 1,
            speed: 1000,
            spaceBetween: 0,
            dots: false,
            updateOnWindowResize:true,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 3000,
            },
            pagination: {
                el: '.main-banner-swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<div class="hidden init_pagination w-2 h-2 z-40 rounded-md cursor-pointer bg-white bg-opacity-25"' +
                        'onclick="mainBannerSwiper.slideTo('+index+')" data-index="'+index+'"></div>';
                },
            },
            on: {
                init: function () {
                    setTimeout(function () {
                        $(".init_pagination").removeClass('hidden');
                        $(".init_pagination[data-index=0]").removeClass('w-2 bg-opacity-25').addClass('w-5');
                    },500);
                },
                slideChange: function () {
                    $(".init_pagination").removeClass('w-5').addClass('w-2 bg-opacity-25');
                    $(".init_pagination[data-index="+mainBannerSwiper.realIndex+"]").removeClass('w-2 bg-opacity-25').addClass('w-5');
                }
            }
        });
    }

    const mainBannerSize = function ($time){
        mainBannerSizeInterval=false;
        setTimeout(function () {
            $('.main_img_back_border').stop().css({
                'width': $('.main_img').width(),
                'height': $('.main_img').height(),
            });
            $('.main-banner-swiper-container .swiper-wrapper').stop().css({
                'height': $('.main_img').height(),
            });
            mainBannerSizeInterval=true;
        },$time);
    };

    const reviewSlider = function (){
        if($('.review-swiper-container').hasClass('swiper-container-initialized')){
            reviewSwiper.destroy();
        }
        reviewSwiper = new Swiper('.review-swiper-container', {
             autoHeight: true,
             slidesPerView: 1.1,
             speed: 400,
             spaceBetween: 20,
             dots: true,
             pagination: {
                 el: '.review-swiper-pagination',
                 type: 'bullets',
             },
             breakpoints: {
                 700: {
                     slidesPerView: 1.2
                 },
                 760:{
                     slidesPerView: 1.4
                 },
                 820:{
                     slidesPerView: 1.6
                 },
                 900: {
                     slidesPerView: 1.8
                 },
                 960: {
                     slidesPerView: 1.9
                 },
                 1200: {
                     slidesPerView: 2.1
                 },
                 1400: {
                     slidesPerView: 2.3
                 }
             },
        });
    };
    const mainImgBorder = function (){
        $('.main_img_back_border').stop().css({
            'width': $('.main_img').width(),
            'height': $('.main_img').height(),
        });
    };

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

    function kakaoOnetoOne(){
        Kakao.init('1aaa3ea4fe5abbbce1c720570e59f3f3');
        Kakao.Channel.chat({
            channelPublicId: '{{env('KAKAO_CHAT_ID')}}' // 카카오톡 채널 홈 URL에 명시된 id로 설정합니다.
        });
        setTimeout(function () {
            Kakao.cleanup();
        },2000);
    }
</script>
@endsection
