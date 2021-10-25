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
    kakaoPixel('7968131379699859784').pageView('호텔 입점 페이지');
</script>
    <div class="mx-auto pt-6 sm:pt-12 select-none" style="">

        <div class="max-w-1200 mx-auto px-4 md:pb-16 space-y-6 md:space-y-16">
            <div class="JeJuMyeongJo text-3xl md:text-4xl text-white tracking-wide fade-up opacity-0 delay-150 transition duration-1000 ease-out">
                호텔에삶 입점
            </div>
            <div class="relative JeJuMyeongJo text-base md:text-lg lg:text-xl text-white tracking-wide fade-up opacity-0 delay-150 transition duration-1000 ease-out">
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
        </div>

        <div class="px-4 bg-tm-c-d7d3cf mt-16 md:mt-24">
            <div class="max-w-1200 mx-auto">
                <div class="w-full md:w-2/3 flex relative">
                    <div class="flex-1 p-4 -mt-12 md:-mt-20 fade-up opacity-0 mt-20 delay-300 transition-all duration-1000 ease-out">
                        <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/marketing.png" alt="marketing">
                    </div>
                    <div class="flex-1 p-4 -mt-12 md:-mt-20 fade-up opacity-0 mt-20 delay-300 transition-all duration-1000 ease-out">
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


        <div class="px-4 mt-16 md:mt-24">
            <div class="max-w-1200 mx-auto">

                <div class="grid grid-cols-1 md:grid-cols-2 p-4 pb-16 space-y-6 md:space-y-0">

                    <div class="order-1 w-full flex relative">
                        <div class="flex-1 p-2 -mt-32 md:-mt-48 z-10">
                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/enter/customer.png" class="fade-up opacity-0 mt-20 delay-500 transition-all duration-1000 ease-out" alt="marketing">
                        </div>
                        <div class="flex-1 p-2 md:-mt-2 md:-ml-32">
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
        @livewire('enter.enter')
    </div>


@endsection
@section('bottom-script')
<script type="text/javascript">
    let windowInnerWidth = window.innerWidth;

    function enter_checker(){
        Livewire.emit('enter_checker');
    }

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

    function room_append(){
        Livewire.emit('room_append',1);
    }

    function store(){
        Livewire.emit('store');
    }


    window.addEventListener('enter_end', event => {
        if(event.detail.data){
            alert('호텔 입점 신청완료했습니다.\n빠른 시일 내에 입점 담당자가 개별 회신드리겠습니다.\n감사합니다.');

            setTimeout(function (){
                location.href="{{route('enter.hotel')}}";
            },500);
        }
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
@endsection
