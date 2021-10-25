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
        $apple_mAgent = array("iPhone","iphone", "iPod", "ipad");
        $android_mAgent = array("Android", "Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony");
        $android_chkMobile = false;
        $apple_chkMobile = false;
        $mobile_chk = 'false';
        for ($i = 0,$iMax = sizeof($android_mAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $android_mAgent[$i])) {
                $android_chkMobile = true;
                $mobile_chk = 'true';
                break;
            }
        }

        for ($i = 0,$iMax = sizeof($apple_mAgent); $i < $iMax; $i++) {
            if (stripos($_SERVER['HTTP_USER_AGENT'], $apple_mAgent[$i])) {
                $apple_chkMobile = true;
                $mobile_chk = 'true';
                break;
            }
        }
    @endphp
<script>
    @unlessrole('super-admin|admin')
    kakaoPixel('7968131379699859784').pageView('호텔 입점 페이지');
    @endunlessrole
</script>
    <div class="mx-auto pt-6 sm:pt-12 select-none">

        <div class="flex sm:block flex-wrap sm:flex-nowrap items-center sm:items-baseline max-w-1200 mx-auto px-8 md:pb-16">
            <div class="order-1 JeJuMyeongJo text-3xl md:text-4xl text-white tracking-wide fade-up opacity-0 delay-150 transition duration-1000 ease-out h-auto">
                호텔에삶 입점
            </div>

            <div class="mt-6 sm:mt-12 md:mt-16 order-3 sm:order-2 relative JeJuMyeongJo text-base md:text-lg lg:text-xl text-white tracking-wide fade-up opacity-0 delay-150 transition duration-1000 ease-out">
                <div class="block md:hidden leading-6">
                    줄어든 외국인 관광객.<br>해외여행도 사실상 불가능한 요즘,<br>호텔에도 발빠른 변화가 필요합니다.<br><br>
                    호텔에삶은 한 발 앞서 나아가<br>호텔에 가장 필요한 방향을 제시하고,<br>기존과 차별된 호텔 플랫폼을 제공합니다.<br><br>
                    호텔에삶 입점 호텔이 누릴 수 있는 스페셜한 혜택을 확인해 보세요.
                </div>
                <div class="hidden md:block leading-8">
                    줄어든 외국인 관광객. 해외여행도 사실상 불가능한 요즘, 호텔에도 발빠른 변화가 필요합니다.<br>
                    호텔에삶은 한 발 앞서 나아가 호텔에 가장 필요한 방향을 제시하고, 기존과 차별된 호텔 플랫폼을 제공합니다.<br>
                    호텔에삶 입점 호텔이 누릴 수 있는 스페셜한 혜택을 확인해 보세요.
                </div>
            </div>

            <div class="order-2 mt-0 sm:mt-6 md:mt-16 ml-auto sm:ml-0 sm:order-3 h-auto">
                <button onclick="location.href='{{route('enter.hotel-manager')}}'" class="px-6 sm:px-32 md:px-40 py-2 sm:py-4 md:py-5 bg-tm-c-C1A485 rounded-sm w-max-content">
                    <div class="AppSdGothicNeoR text-lg sm:text-xl md:text-2xl text-white">
                        입점 신청하기
                    </div>
                </button>
            </div>
        </div>

        <div class="px-8 bg-tm-c-d7d3cf mt-16 md:mt-24">
            <div class="max-w-1200 mx-auto">
                <div class="w-full md:w-2/3 flex relative">
                    <div class="flex-1 p-2 pl-0 -mt-12 md:-mt-20 fade-up opacity-0 mt-20 delay-300 transition-all duration-1000 ease-out">
                        <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/marketing.png" alt="marketing">
                    </div>
                    <div class="flex-1 p-2 pr-0 -mt-12 md:-mt-20 fade-up opacity-0 mt-20 delay-300 transition-all duration-1000 ease-out">
                        <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/additional-income.png" alt="additional-income">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 p-4 pb-32 space-y-10 md:space-y-0">

                    <div class="order-1 flex flex-wrap h-20 md:h-36 lg:h-44 PtSerif italic text-tm-c-30373F text-2xl md:text-4xl lg:text-5xl fade-up opacity-0 delay-500 transition-all duration-1000 ease-out">
                        <div class="w-full text-center md:text-left">Marketing</div>
                        <div class="w-full text-center md:text-left">&</div>
                        <div class="w-full text-center md:text-left">Additional Income</div>
                    </div>

                    <div class="order-2 space-y-2 md:px-2 lg:px-0 fade-up opacity-0 delay-500 transition-all duration-1000 ease-out">
                        <div class="space-y-3">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#30373F">
                                            <g>
                                                <g>
                                                    <g transform="translate(-772 -884) translate(360 454) translate(412 430) translate(5 11)">
                                                        <path d="M0 0L0 54 61 54"/>
                                                        <path d="M9 24L22.166 11.616 34.286 24 51 7"/>
                                                        <path d="M40.668 13.426L48.414 5.68 56.115 13.381" transform="rotate(45 48.391 9.553)"/>
                                                        <path d="M10 38H20V54H10zM26 33H36V54H26zM41 43H51V54H41z"/>
                                                        <circle cx="22.5" cy="12.5" r="2" fill="#D7D3CF"/>
                                                        <circle cx="33.5" cy="23.5" r="2" fill="#D7D3CF"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-0D5E49 text-center md:text-left leading-6 sm:leading-7">
                                효과적이고 전문적인 마케팅을<br>
                                대신 해드립니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-tm-c-30373F text-center md:text-left leading-5 sm:leading-6">
                                호텔에삶은 전문 마케터가 데이터 기반 퍼포먼스<br>
                                마케팅을 실행하여, 기존에 발생하던<br>
                                마케팅 비용과 시간을 현저히 줄여줍니다.
                            </div>
                        </div>
                    </div>

                    <div class="order-4 md:order-5 space-y-2 md:pt-10 md:px-2 lg:px-0 fade-up opacity-0 delay-700 transition-all duration-1000 ease-out">
                        <div class="space-y-3">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#30373F">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g transform="translate(-772 -1134) translate(360 454) translate(410 680) translate(2) translate(5 6)">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M44.504 37.257c-1.65-1.657-1.645-4.339.012-5.99.394-.392.862-.703 1.376-.915 2.169-.893 4.65.141 5.543 2.31.21.512.32 1.061.32 1.616v-.092c0-.551.109-1.097.322-1.605.887-2.118 3.322-3.116 5.44-2.229.495.207.946.506 1.329.881 1.673 1.639 1.701 4.323.063 5.996h0l-7.155 7.307-7.25-7.28z"/>
                                                            <path d="M15.508 16.038V4.085C15.508 1.829 17.36 0 19.644 0h24.814c2.284 0 4.135 1.829 4.135 4.085v25.753m0 11.182v12.895c0 2.256-1.851 4.085-4.135 4.085H19.644c-2.284 0-4.136-1.829-4.136-4.085V35.09"/>
                                                            <ellipse cx="32.568" cy="52.304" rx="2.085" ry="2.089"/>
                                                            <rect width="8.305" height="2.107" x="28.415" y="3.607" rx="1.054"/>
                                                            <path d="M30.517 16.036v19.077l-17.74-.001-2.115 4.175-2.116-4.175H.5V16.037h30.017z" transform="matrix(-1 0 0 1 31.017 0)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-0D5E49 text-center md:text-left leading-6 sm:leading-7">
                                바이럴 마케팅 효과를 제공합니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-tm-c-30373F text-center md:text-left leading-5 sm:leading-6">
                                호텔에삶이 유치하는 주 고객층인 2535세대를 통해<br>
                                자연스러운 바이럴 마케팅 효과를 얻을 수 있습니다.
                            </div>
                        </div>
                    </div>

                    <div class="order-4">
                    </div>

                    <div class="order-3 space-y-2 md:px-2 lg:px-0 fade-up opacity-0 delay-500 transition-all duration-1000 ease-out">
                        <div class="space-y-3">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <g stroke="#30373F">
                                                            <g transform="translate(-1180 -884) translate(360 454) translate(820 430) translate(0 11.667) translate(46 .333)">
                                                                <circle cx="12" cy="12" r="11.5"/>
                                                            </g>
                                                            <path d="M7.355 12L17.032 12M12.194 7.161L12.194 16.839" transform="translate(-1180 -884) translate(360 454) translate(820 430) translate(0 11.667) translate(46 .333)"/>
                                                        </g>
                                                        <g>
                                                            <path stroke="#30373F" d="M62.611 15.445L62.611 35.816 3.5 35.816 3.5 0 47.745 0" transform="translate(-1180 -884) translate(360 454) translate(820 430) translate(0 11.667) translate(0 7.333)"/>
                                                            <path stroke="#30373F" d="M59.5 35.816L59.5 39 0.389 39 0.389 3.184 3.5 3.184" transform="translate(-1180 -884) translate(360 454) translate(820 430) translate(0 11.667) translate(0 7.333)"/>
                                                            <path stroke="#30373F" d="M59.5 16.316L59.5 32.633 6.611 32.633 6.611 3.184 46.676 3.184" transform="translate(-1180 -884) translate(360 454) translate(820 430) translate(0 11.667) translate(0 7.333)"/>
                                                            <path fill="#30373F" fill-rule="nonzero" d="M29.404 26.483l2.5-8.75h3.05l2.475 8.75h1.625l2.175-8.75h2.7v-1.325h-2.35l1.675-6.7h-1.5l-1.65 6.7H36.08l-1.9-6.7h-1.35l-1.95 6.7h-4.05l-1.65-6.7h-1.625l1.675 6.7h-2.45v1.325h2.775l2.25 8.75h1.6zm5.175-10.075h-2.3l1.15-3.925h.05l1.1 3.925zm-5.875 7.5h-.05l-1.525-6.175h3.375l-1.8 6.175zm9.575 0h-.05l-1.75-6.175h3.3l-1.5 6.175z" transform="translate(-1180 -884) translate(360 454) translate(820 430) translate(0 11.667) translate(0 7.333)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-0D5E49 text-center md:text-left leading-6 sm:leading-7">
                                숙박 비용 이외의<br>
                                부가적인 수익 창출이 가능합니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-tm-c-30373F text-center md:text-left leading-5 sm:leading-6">
                                호텔에 머무는 장기 투숙객으로 인해<br>
                                조식, 부대시설 이용료 등의 부가적인<br>
                                수익이 발생하게 됩니다.
                            </div>
                        </div>
                    </div>

                    <div class="order-5 md:order-6 space-y-2 md:pt-10 md:px-2 lg:px-0 fade-up opacity-0 delay-700 transition-all duration-1000 ease-out">
                        <div class="space-y-3">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g>
                                            <g>
                                                <g>
                                                    <g transform="translate(-1180 -1134) translate(360 454) translate(820 680) translate(5 10)">
                                                        <rect width="41" height="5" x="9.5" y="20.5" stroke="#30373F" rx="2.5"/>
                                                        <rect width="41" height="5" x="9.5" y="28.5" stroke="#30373F" rx="2.5"/>
                                                        <rect width="17" height="5" x="9.5" y="35.5" stroke="#30373F" rx="2.5"/>
                                                        <circle cx="12" cy="23" r="2.5" stroke="#30373F"/>
                                                        <circle cx="24" cy="38" r="2.5" stroke="#30373F"/>
                                                        <path stroke="#30373F" d="M0.5 3.5H59.5V49.5H0.5z"/>
                                                        <path stroke="#30373F" d="M0.5 3.5H59.5V11.5H0.5z"/>
                                                        <path fill="#30373F" d="M10 0H11V7H10zM20 0H21V7H20zM30 0H31V7H30zM40 0H41V7H40zM50 0H51V7H50z"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-0D5E49 text-center md:text-left leading-6 sm:leading-7">
                                롱 스테이 고객을 유치해드립니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-tm-c-30373F text-center md:text-left leading-5 sm:leading-6">
                                최소 월 단위, 최대 연 단위의 장기 투숙객을<br>
                                유치하여 객실 점유율을 높여드립니다.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="px-8 mt-16 md:mt-24">
            <div class="max-w-1200 mx-auto">

                <div class="grid grid-cols-1 md:grid-cols-2 pb-16 space-y-6 md:space-y-0">

                    <div class="order-1 w-full flex relative">
                        <div class="flex-1 p-2 pl-0 -mt-32 md:-mt-48 z-10">
                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/customer.png" class="fade-up opacity-0 mt-20 delay-500 transition-all duration-1000 ease-out" alt="marketing">
                        </div>
                        <div class="flex-1 p-2 pr-0 md:-mt-2 md:-ml-32">
                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/make-differences.png" class="fade-up opacity-0 mt-20 delay-700 transition-all duration-1000 ease-out" alt="additional-income">
                        </div>
                    </div>

                    <div class="order-2 flex flex-wrap px-2 md:px-4 h-20 md:h-36 lg:h-44 PtSerif italic text-white text-2xl sm:text-3xl md:text-4xl lg:text-5xl fade-up opacity-0 delay-1000 transition-all duration-1000 ease-out">
                        <div class="w-full text-center md:text-left">Customer</div>
                        <div class="w-full text-center md:text-left">&</div>
                        <div class="w-full text-center md:text-left">Make Differences</div>
                    </div>

                    <div class="order-3 pt-6 md:pt-10 md:flex md:justify-end md:px-4 lg:px-2 fade-up opacity-0 delay-500 transition-all duration-1000 ease-out">
                        <div class="space-y-3 md:space-y-5 md:w-100">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#D7D3CF">
                                            <g>
                                                <g>
                                                    <g transform="translate(-565 -2014) translate(0 538) translate(565 1476) translate(5 4)">
                                                        <circle cx="8" cy="26" r="4.5"/>
                                                        <circle cx="28" cy="19" r="6.5"/>
                                                        <path d="M2 30h3.5c4.142 0 7.5 3.358 7.5 7.5 0 4.142-3.358 7.5-7.5 7.5H2h0" transform="rotate(-90 7.5 37.5)"/>
                                                        <path d="M20 25h5.5C31.299 25 36 29.701 36 35.5S31.299 46 25.5 46H20h0" transform="rotate(-90 28 35.5)"/>
                                                        <circle cx="50" cy="26" r="4.5"/>
                                                        <path d="M44 30h3.5c4.142 0 7.5 3.358 7.5 7.5 0 4.142-3.358 7.5-7.5 7.5H44h0" transform="rotate(-90 49.5 37.5)"/>
                                                        <path d="M49 12L53 12 53 8M8 50L4 50 4 54"/>
                                                        <path d="M53 11.729C47.1 4.914 38.125 0 28.652 0 18.765 0 9.917 4.66 4 12"/>
                                                        <path d="M53 61.729C47.1 54.914 38.125 50 28.652 50 18.765 50 9.917 54.66 4 62" transform="rotate(-180 28.5 56)"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-C1A485 text-center md:text-left leading-6 sm:leading-7">
                                호텔 체질 개선에 대한<br>
                                컨설팅을 제공합니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-white text-center md:text-left leading-5 sm:leading-6">
                                장기투숙에 최적화된 호텔로 거듭날 수 있도록<br>
                                지속적인 컨설팅과 피드백을 제공합니다.
                            </div>
                        </div>
                    </div>

                    <div class="order-4 pt-6 md:pt-10 fade-up opacity-0 delay-700 transition-all duration-1000 ease-out">
                        <div class="space-y-3 md:space-y-5 md:w-100">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#D7D3CF">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g transform="translate(-976 -2014) translate(0 538) translate(975 1476) translate(1) translate(5 1) translate(.5 36)">
                                                                <ellipse cx="11.13" cy="7.225" rx="6.741" ry="6.725"/>
                                                                <path d="M3.055 13.426h5.816c6.116 0 11.074 4.958 11.074 11.074S14.987 35.574 8.87 35.574H3.055h0" transform="rotate(-90 11.5 24.5)"/>
                                                                <path d="M13.63 16L12.778 18.975 10.222 18.975 9.443 16M12.74 19.05l.8 10.365-1.957 2.029-2.122-2.04.798-10.354h2.482z"/>
                                                            </g>
                                                            <g transform="translate(-976 -2014) translate(0 538) translate(975 1476) translate(1) translate(5 1) translate(24.5 36)">
                                                                <ellipse cx="11.13" cy="7.225" rx="6.741" ry="6.725"/>
                                                                <path d="M3.055 13.426h5.816c6.116 0 11.074 4.958 11.074 11.074S14.987 35.574 8.87 35.574H3.055h0" transform="rotate(-90 11.5 24.5)"/>
                                                                <path d="M13.63 16L12.778 18.975 10.222 18.975 9.443 16M12.74 19.05l.8 10.365-1.957 2.029-2.122-2.04.798-10.354h2.482z"/>
                                                            </g>
                                                            <path d="M25 7.5H34V15.5H25zM25 18.5H34V26.5H25zM38 7.5H47V15.5H38zM38 18.5H47V26.5H38z" transform="translate(-976 -2014) translate(0 538) translate(975 1476) translate(1) translate(5 1)"/>
                                                            <path d="M14.5 34L14.5 0 59.5 0 59.5 69" transform="translate(-976 -2014) translate(0 538) translate(975 1476) translate(1) translate(5 1)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-C1A485 text-center md:text-left leading-6 sm:leading-7">
                                B2B 판매를 통해<br>
                                대규모의 투숙객 유치가 가능합니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-white text-center md:text-left leading-5 sm:leading-6">
                                개인 뿐만 아닌, 회사와의 B2B 계약을 통해<br>
                                대량의 투숙객을 장기간 유치 할 수 있습니다.
                            </div>
                        </div>
                    </div>

                    <div class="order-5 pt-6 md:pt-10 md:flex md:justify-end md:px-4 lg:px-2 fade-up opacity-0 delay-700 transition-all duration-1000 ease-out">
                        <div class="space-y-3 md:space-y-5 md:w-100">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#D7D3CF">
                                            <g>
                                                <g transform="translate(-565 -2274) translate(0 538) translate(565 1736)">
                                                    <g>
                                                        <path d="M28.5.5c3.314 0 6.314 1.343 8.485 3.515C39.157 6.186 40.5 9.186 40.5 12.5c0 3.314-1.343 6.314-3.515 8.485-2.171 2.172-5.171 3.515-8.485 3.515h0-14.117l-2.74 2.398-.001-2.428c-3.204-.226-6.061-1.711-8.08-3.962C1.658 18.384.5 15.578.5 12.5c0-3.314 1.343-6.314 3.515-8.485C6.186 1.843 9.186.5 12.5.5h0zM9.01 7.188L32.01 7.188M9.01 12.188L32.01 12.188M9.01 17.188L26.01 17.188" transform="translate(29)"/>
                                                    </g>
                                                    <path d="M17.5 7.5c1.933 0 3.683.784 4.95 2.05 1.266 1.267 2.05 3.017 2.05 4.95 0 1.933-.784 3.683-2.05 4.95-1.267 1.266-3.017 2.05-4.95 2.05h0-.925L13.5 23.96V21.5h-6c-1.933 0-3.683-.784-4.95-2.05C1.284 18.183.5 16.433.5 14.5c0-1.933.784-3.683 2.05-4.95C3.817 8.284 5.567 7.5 7.5 7.5h0z" transform="matrix(-1 0 0 1 25 0)"/>
                                                    <circle cx="36.5" cy="36.5" r="8"/>
                                                    <circle cx="16.5" cy="36.5" r="8"/>
                                                    <path d="M27.065 44.935h6.87c7.18 0 13 5.82 13 13s-5.82 13-13 13h-6.87 0" transform="rotate(-90 37 57.935)"/>
                                                    <path d="M4 67.87v-6.826C4 54.05 9.512 48.298 16.5 48c0 0 0 0 0 0 3.6 0 6.57.966 8.906 2.898"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-C1A485 text-center md:text-left leading-6 sm:leading-7">
                                기존과 차별화된<br>
                                특별한 호텔로 만들어드립니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-white text-center md:text-left leading-5 sm:leading-6">
                                호텔에삶에서 진행하는 프리미엄 콘텐츠와 네트워킹 프로그램으로<br>
                                기존의 호텔들과 다른, 더욱 특별한 호텔로 거듭날 수 있습니다.
                            </div>
                        </div>
                    </div>

                    <div class="order-6 pt-6 md:pt-10 fade-up opacity-0 delay-1000 transition-all duration-1000 ease-out">
                        <div class="space-y-3 md:space-y-5 md:w-100">
                            <div class="flex justify-center md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 md:w-20" viewBox="0 0 70 70">
                                    <g fill="none" fill-rule="evenodd">
                                        <g stroke="#D7D3CF">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <path d="M24 48c3.156 0 5.714 2.558 5.714 5.714V64h0-11.428V53.714C18.286 50.558 20.844 48 24 48z" transform="translate(-976 -2274) translate(0 538) translate(975 1736) translate(1) translate(6 2) translate(0 3)"/>
                                                                <path d="M48 24.353L48 64 0 64 0 0 46.364 0" transform="translate(-976 -2274) translate(0 538) translate(975 1736) translate(1) translate(6 2) translate(0 3)"/>
                                                                <path d="M39 16L29 16 29 10 39 10zM29 16L19 16 19 10 26.578 10 29 10zM29 28L19 28 19 22 26.578 22 29 22zM29 40L19 40 19 34 26.578 34 29 34zM39 28L29 28 29 22 36.578 22 39 22zM39 40L29 40 29 34 36.578 34 39 34zM19 16L9 16 9 10 16.578 10 19 10zM19 28L9 28 9 22 16.578 22 19 22zM19 40L9 40 9 34 16.578 34 19 34z" transform="translate(-976 -2274) translate(0 538) translate(975 1736) translate(1) translate(6 2) translate(0 3)"/>
                                                            </g>
                                                            <g transform="translate(-976 -2274) translate(0 538) translate(975 1736) translate(1) translate(6 2) translate(40)">
                                                                <path d="M13.692.954l1.88 2.128 2.782.564.564 2.782 2.128 1.88L20.143 11l.903 2.692-2.128 1.88-.564 2.782-2.782.564-1.88 2.128L11 20.143l-2.692.903-1.88-2.128-2.782-.564-.564-2.782-2.128-1.88L1.857 11 .954 8.308l2.128-1.88.564-2.782 2.782-.564L8.308.954 11 1.857l2.692-.903z"/>
                                                                <path d="M17 19L17 29 11.058 25.401 5 29 5 19"/>
                                                                <circle cx="11" cy="11" r="6.5"/>
                                                                <path d="M8 10.253L10.443 13 14 9"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="JeJuMyeongJo text-lg md:text-xl text-tm-c-C1A485 text-center md:text-left leading-6 sm:leading-7">
                                프리미엄하고 트렌디한<br>
                                브랜딩이 가능합니다.
                            </div>
                            <div class="AppSdGothicNeoR text-base text-white text-center md:text-left leading-5 sm:leading-6">
                                호텔에삶에 입점한 호텔은 전문 CX팀의 지속적인 품질관리로<br>
                                고객들에게 검증된 호텔이라는 인식을 심어줍니다.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

{{--        <div class="pt-12">--}}
{{--            <div class="flex items-center w-full px-4 max-w-xl mx-auto">--}}
{{--                <a class="w-full" href="https://www.notion.so/dc8b34c9efa74149929d6e73067fb3ba" target="_blank">--}}
{{--                    <div class="w-full px-4 py-5 sm:py-6 border border-solid border-tm-c-C1A485 rounded-sm">--}}
{{--                        <div class="flex items-center justify-center text-tm-c-C1A485 AppSdGothicNeoR text-xl space-x-2 cursor-pointer">--}}
{{--                            <div>입점 이용약관, 파트너사 이용 가이드라인 보러 가기</div>--}}
{{--                            <div>--}}
{{--                                <svg width="22px" height="17px" viewBox="0 0 22 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">--}}
{{--                                    <title>PC_ic/download</title>--}}
{{--                                    <g id="호텔입점페이지" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                        <g id="호텔입점페이지_02_new_PC" transform="translate(-1044.000000, -3491.000000)" fill="#C1A485">--}}
{{--                                            <g id="btn_정책서다운" transform="translate(854.000000, 3488.000000)">--}}
{{--                                                <g id="Group" transform="translate(189.000000, 0.000000)">--}}
{{--                                                    <g id="ic_download" transform="translate(1.600000, 3.200000)">--}}
{{--                                                        <g id="Group" transform="translate(10.400000, 11.200000) scale(1, -1) translate(-10.400000, -11.200000) translate(4.800000, 8.000000)">--}}
{{--                                                            <polygon id="Path" points="0.6965301 5.60120978 5.6 0.697739875 10.5034699 5.60120978 9.93778448 6.1668952 5.6 1.8288 1.26221552 6.1668952"></polygon>--}}
{{--                                                        </g>--}}
{{--                                                        <rect id="Rectangle-Copy-3" x="0" y="11.2" width="1" height="5.6"></rect>--}}
{{--                                                        <rect id="Rectangle-Copy-7" x="10" y="0" width="1" height="12.8"></rect>--}}
{{--                                                        <rect id="Rectangle-Copy-4" x="20" y="11.2" width="1" height="5.6"></rect>--}}
{{--                                                        <rect id="Rectangle-Copy-2" x="0" y="16" width="20.8" height="1"></rect>--}}
{{--                                                    </g>--}}
{{--                                                </g>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="px-8 pt-16 pb-20">
            <div class="max-w-1200 mx-auto">
                <div class="pb-4">
                    <div class="AppSdGothicNeoR text-xl text-white">파트너사 분류</div>
                </div>
                <div>
                    <div class="border-t-2 border-b-2 border-solid border-white AppSdGothicNeoR text-white divide-y divide-tm-c-979b9f">
                        <div class="flex items-center divide-x divide-tm-c-979b9f">
                            <div class="flex-0 px-4 py-3 sm:py-6 text-sm font-bold">
                                입금가 호텔
                            </div>
                            <div class="flex-1 px-4 py-3 sm:py-6 leading-normal text-sm">
                                입금가 호텔이란 호텔에삶 서비스를 이용하기 위해 약관에 따라 회사와 이용 계약을 체결하고, 고객이 롱스테이 서비스를 이용할 수 있도록 플랫폼에 등록할 시, 자사가 제안한 입금가 방식을 채택해 경쟁력 있는 가격을 제공해준 대가로 자사의 마케팅 지원 및 다양한 지원을 받는 호텔을 의미합니다.
                            </div>
                        </div>
                        <div class="flex items-center divide-x divide-tm-c-979b9f">
                            <div class="flex-0 px-4 py-3 sm:py-6 text-sm font-bold">
                                수수료 호텔
                            </div>
                            <div class="flex-1 px-4 py-3 sm:py-6 leading-normal text-sm">
                                수수료 호텔이란 호텔에삶 서비스를 이용하기 위해 약관에 따라 회사와 이용 계약을 체결하고, 고객이 롱스테이 서비스를 이용할 수 있도록 플랫폼에 등록할 시, 자사가 제안한 입금가 방식이 아닌 수수료 방식을 채택한 호텔을 의미합니다.
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <div class="flex">
                            <div class="AppSdGothicNeoR leading-normal text-tm-c-ff7777">
                                <div class="whitespace-pre">* 입점 불가 호텔<span class="text-white">&nbsp;:&nbsp;</span></div>
                            </div>
                            <div>
                                <p class="AppSdGothicNeoR leading-normal text-white">아래의 경우 호텔에삶 입점이 불가하며, 입점 불가 사유 및 불가 통보를 이메일로 전달드립니다.</p>
                                <p class="AppSdGothicNeoR leading-normal text-white">1. 자사와 톤앤매너가 맞지 않다고 판단되는 경우</p>
                                <p class="AppSdGothicNeoR leading-normal text-white">2. 롱스테이가 어렵다고 판단되는 시설적 낙후</p>
                                <p class="AppSdGothicNeoR leading-normal text-white">3. 후기 및 현장 실사(미스터리 쇼퍼)</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-2">
                        <x-box.drop-down title="파트너사 등급 조건">
                            <x-slot name="content">
                                <div class="md:flex space-y-4 md:space-y-0 md:space-x-16 text-white">

                                    <div class="flex-1 w-full">
                                        <div class="py-3 border-b border-solid border-tm-c-979b9f">
                                            <div class="PtSerif font-bold italic text-lg sm:text-2xl text-white leading-tight bg-gradient-to-r from-tm-c-C1A485">Signature</div>
                                        </div>
                                        <div class="py-3">
                                            <div class="AppSdGothicNeoR text-sm sm:text-base leading-normal" style="text-indent: -.6em;margin-left: .6em;">
                                                <p><span class="text-tm-c-C1A485">- 프리미엄 호텔 중,</span> 자사 주/월간 전팀원 회의를 통한 선별<br>(실적, 호텔 협조도, 호텔에삶 ONLY 혜택 등 전반적 사항 고려)</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <div class="py-3 border-b border-solid border-tm-c-979b9f">
                                            <div class="PtSerif font-bold italic text-lg sm:text-2xl text-white leading-tight">Premium</div>
                                        </div>
                                        <div class="py-3">
                                            <div class="AppSdGothicNeoR text-sm sm:text-base leading-normal" style="text-indent: -.6em;margin-left: .6em;">
                                                <p>- 자사 제안 입금가 입점 선택한 호텔</p>
                                                <p>- 수수료 입점 선택한 호텔(스탠다드 등급)이 자사와 협의 후, 호텔에삶 단독 상품 제공한 경우 전환 가능</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <div class="py-3 border-b border-solid border-tm-c-979b9f">
                                            <div class="PtSerif font-bold italic text-lg sm:text-2xl text-white leading-tight">Standard</div>
                                        </div>
                                        <div class="py-3">
                                            <div class="AppSdGothicNeoR text-sm sm:text-base leading-normal" style="text-indent: -.6em;margin-left: .6em;">
                                                <p>
                                                    - 수수료 입점 선택한 호텔로 아래 (1), (2) 조건 제공 필수
                                                    <p style="text-indent: -.6em;margin-left: .6em;">(1) 타 판매채널 및 OTA 대비 경쟁력 있는 가격 보장. 호텔 자체 공홈 가격이 타 판매채널 및 OTA 대비 경쟁력 있다면 공홈과 동일한 판매가 제공</p>
                                                    <p style="text-indent: -.6em;margin-left: .6em;">(2) 호텔에삶 단독 혜택 제공</p>
                                                </p>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </x-slot>
                        </x-box.drop-down>

                        <x-box.drop-down title="파트너사 등급 별 리워드">
                            <x-slot name="content">
                                <div class="md:flex space-y-4 md:space-y-0 md:space-x-16 text-white">

                                    <div class="flex-1 w-full">
                                        <div class="py-3 border-b border-solid border-tm-c-979b9f">
                                            <div class="PtSerif font-bold italic text-lg sm:text-2xl text-white leading-tight bg-gradient-to-r from-tm-c-C1A485">Signature</div>
                                        </div>
                                        <div class="py-3">
                                            <div class="AppSdGothicNeoR text-sm sm:text-base leading-normal" style="text-indent: -.6em;margin-left: .6em;">
                                                <p>- 프리미엄 리워드 모두 포함</p>
                                                <p>- 월 혹은 분기별 그간 성과 및 데이터, 고객 피드백 기반<br><span class="text-tm-c-C1A485">1대1 사후 관리</span> (주요 타켓층, 유료 전환율 가장 높은 채널 등)</p>
                                                <p>- 홈페이지 내 <span class="text-tm-c-C1A485">라벨링</span> 제공<br>(고객 노출 화면에 다른 호텔과 다른 호텔이라는 표식)</p>
                                                <p>- 홈페이지 내, <span class="text-tm-c-C1A485">가장 유입률 높은 카테고리 노출</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <div class="py-3 border-b border-solid border-tm-c-979b9f">
                                            <div class="PtSerif font-bold italic text-lg sm:text-2xl text-white leading-tight">Premium</div>
                                        </div>
                                        <div class="py-3">
                                            <div class="AppSdGothicNeoR text-sm sm:text-base leading-normal" style="text-indent: -.6em;margin-left: .6em;">
                                                <p>- 오픈 대기 리스트 업로드 없이, 최우선 오픈 지원<br>(다만, 프리미엄 호텔 오픈 대기 중인 호텔 중에서 선착순 오픈)</p>
                                                <p>- 인플루언서 마케팅 지원</p>
                                                <p>- 호텔 1대1 담당 팀원 배치</p>
                                                <p>- 퍼포먼스 마케팅 지원</p>
                                                <p>- 상품 상세 에디팅 지원</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <div class="py-3 border-b border-solid border-tm-c-979b9f">
                                            <div class="PtSerif font-bold italic text-lg sm:text-2xl text-white leading-tight">Standard</div>
                                        </div>
                                        <div class="py-3">
                                            <div class="AppSdGothicNeoR text-sm sm:text-base leading-normal" style="text-indent: -.6em;margin-left: .6em;">
                                                <p>- 오픈 대기 리스트 업로드 후, 주차별 고객 선호도에 따라 오픈 여부 결정</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </x-slot>
                        </x-box.drop-down>
                        <x-box.drop-down title="프리미엄 / 스탠다드 호텔 오픈 절차">
                            <x-slot name="content">
                                <div class="mt-6 grid sm:gap-8 lg:gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 text-white">
                                    <div class="flex-1 w-full">
                                        <div class="flex items-center justify-center h-32">
                                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/pic-01.png" alt="pic-01">
                                        </div>
                                        <div class="pt-4 pb-8 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <span class="text-tm-c-C1A485">Premium,</span>&nbsp;Standard
                                        </div>
                                        <div class="flex items-center justify-center AppSdGothicNeoR text-sm text-center font-normal leading-5">
                                            수수료 호텔 입점 신청
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <div class="flex items-center justify-center h-32">
                                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/pic-02.png" alt="pic-02">
                                        </div>
                                        <div class="pt-4 pb-8 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <span class="text-tm-c-C1A485">Premium,</span>&nbsp;Standard
                                        </div>
                                        <div class="flex items-center justify-center AppSdGothicNeoR font-normal text-sm text-center leading-5">
                                            입점 승인 불가 호텔 여부 확인
                                        </div>
                                    </div>
                                    <div class="flex-1 w-full">
                                        <div class="flex items-center justify-center h-32">
                                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/pic-03.png" alt="pic-03">
                                        </div>
                                        <div class="pt-2 pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-tm-c-C1A485 font-bold">
                                                Premium
                                            </div>
                                        </div>
                                        <div class="pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-sm text-tm-c-C1A485 font-normal AppSdGothicNeoR text-center leading-5">
                                                <div>입점 승인 이후,</div>
                                                <div>오픈 리스트에 업로드</div>
                                            </div>
                                        </div>
                                        <div class="pt-3 pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="font-bold">
                                                Standard
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-sm font-normal AppSdGothicNeoR text-center leading-5">
                                                <div>입점 승인 이후,</div>
                                                <div>오픈 리스트에서 대기</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <div class="flex items-center justify-center h-32">
                                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/pic-04.png" alt="pic-04">
                                        </div>
                                        <div class="pt-2 pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-tm-c-C1A485 font-bold">
                                                Premium
                                            </div>
                                        </div>
                                        <div class="pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-sm text-tm-c-C1A485 font-normal text-center leading-5">
                                                <div>고객 반응 상관 없이</div>
                                                <div>입점 신청 순서대로 오픈</div>
                                            </div>
                                        </div>
                                        <div class="pt-3 pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="font-bold">
                                                Standard
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center font-bold text-base tracking-widest">
                                            <div class="text-sm font-normal text-center AppSdGothicNeoR leading-5">
                                                <div>대기 리스트 내</div>
                                                <div>고객 선호도 확인</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <div class="flex items-center justify-center h-32">
                                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/pic-05.png" alt="pic-05">
                                        </div>
                                        <div class="pt-2 pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-tm-c-C1A485 font-bold">
                                                Premium
                                            </div>
                                        </div>
                                        <div class="pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-sm text-tm-c-C1A485 font-normal text-center leading-5">
                                                <div>상품 매력도 상승 작업과</div>
                                                <div>각종 마케팅 준비</div>
                                            </div>
                                        </div>
                                        <div class="pt-3 pb-2 flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="font-bold">
                                                Standard
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center AppSdGothicNeoR font-bold text-base tracking-widest">
                                            <div class="text-sm font-normal text-center leading-5">
                                                <div>고객 반응 순으로</div>
                                                <div>우선 오픈</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </x-slot>
                        </x-box.drop-down>


                        <div class="pt-10 flex justify-center">
                            <button onclick="location.href='{{route('enter.hotel-manager')}}'" class="w-full sm:w-auto sm:w-max-content px-16 sm:px-32 md:px-40 py-6 sm:py-4 md:py-5 bg-tm-c-C1A485 rounded-sm">
                                <div class="AppSdGothicNeoR text-lg sm:text-xl md:text-2xl text-white">
                                    입점 신청하기
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script type="text/javascript">
    let windowInnerWidth = window.innerWidth;

    var hotel = false;
    var room = false;
    var option= false;
    var manager= false;

    window.addEventListener('alert', event => {
        alert(event.detail.message);
    })

    $(document).ready(function(){
        setTimeout(function (){
            $('.fade-up.opacity-0').each( function(i){
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                var bottom_of_object = $(this).offset().top + ($(this).outerHeight()/2);
                if( bottom_of_window > bottom_of_object ){
                    $(this).removeClass('opacity-0 mt-20 ml-20');
                }
            });
            $(window).scroll( function(){
                $('.fade-up.opacity-0').each( function(i){
                    var bottom_of_window = $(window).scrollTop() + $(window).height();
                    var bottom_of_object = $(this).offset().top + ($(this).outerHeight()/2);
                    if( bottom_of_window > bottom_of_object ){
                        $(this).removeClass('opacity-0 mt-20 ml-20');
                    }
                });
            });
        },500);
    });
    window.onload = function() {

    };

    $(window).resize(function() {
        windowInnerWidth = window.innerWidth;
    });

    function emailCheck(email_address) {
        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
        return email_regex.test(email_address);
    }

    $(".manager_hp").on('keydown', function (e) {
        // 숫자만 입력받기
        var trans_num = $(this).val().replace(/-/gi, '');
        var k = e.keyCode;

        if (trans_num.length >= 11 && ((k >= 48 && k <= 126) || (k >= 12592 && k <= 12687 || k === 32 || k === 229 || (k >= 45032 && k <= 55203)))) {
            e.preventDefault();
        }
    }).on('blur', function () { // 포커스를 잃었을때 실행합니다.
        if ($(this).val() === '') return;

        // 기존 번호에서 - 를 삭제합니다.
        var trans_num = $(this).val().replace(/-/gi, '');

        // 입력값이 있을때만 실행합니다.
        if (trans_num != null && trans_num !== '') {
            // 총 핸드폰 자리수는 11글자이거나, 10자여야 합니다.
            if (trans_num.length === 11 || trans_num.length === 10) {
                // 유효성 체크
                var regExp_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
                if (regExp_ctn.test(trans_num)) {
                    // 유효성 체크에 성공하면 하이픈을 넣고 값을 바꿔줍니다.
                    trans_num = trans_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
                    $(this).val(trans_num);
                } else {
                    alert("유효하지 않은 전화번호 입니다.");
                    $(this).val("");
                    $(this).focus();
                }
            } else {
                alert("유효하지 않은 전화번호 입니다.");
                $(this).val("");
                $(this).focus();
            }
        }
    });
</script>
@endpush
