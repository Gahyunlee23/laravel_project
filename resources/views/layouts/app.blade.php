<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W6LBJBB');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5607WHPRZQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        @unlessrole('super-admin|admin')
        {{-- Not Admin --}}
        gtag('js', new Date());

        gtag('config', 'UA-181729384-1');
        gtag('config', 'G-5607WHPRZQ');
        gtag('config', 'AW-753064854');
        @endunlessrole

        <!-- Event snippet for 상품 바로가기 클릭 conversion page -->
        window.addEventListener('load', function(event) {
            if (document.querySelector('.mt-2.ml-auto.flex.justify-end')) {
                document.querySelectorAll('.mt-2.ml-auto.flex.justify-end').forEach(function(i) {
                    i.addEventListener('click', function() {
                        gtag('event', 'conversion', {'send_to': 'AW-753064854/A0HCCIvNxuEBEJa3i-cC'});
                    });
                });
            };
        });
    </script>
    <!--  네이버 애널리틱스  -->
    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "9e957afcd499d0";
        if(window.wcs) {
            wcs_do();
        }
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '5394940997284438');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=5394940997284438&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    <script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/adfit/static/kp.js"></script>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no">
    @if(isset($curator) || (auth()->check() && auth()->user()->hasAnyRole('hotel','admin','super-admin')) )
        <meta name="robots" content="noindex,nofollow">
    @endif
<!-- Channel Plugin Scripts -->
<script>
    (function() {
        var w = window;
        if (w.ChannelIO) {
            return (window.console.error || window.console.log || function(){})('ChannelIO script included twice.');
        }
        var ch = function() {
            ch.c(arguments);
        };
        ch.q = [];
        ch.c = function(args) {
            ch.q.push(args);
        };
        w.ChannelIO = ch;
        function l() {
            if (w.ChannelIOInitialized) {
                return;
            }
            w.ChannelIOInitialized = true;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
            s.charset = 'UTF-8';
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        }
        if (document.readyState === 'complete') {
            l();
        } else if (window.attachEvent) {
            window.attachEvent('onload', l);
        } else {
            window.addEventListener('DOMContentLoaded', l, false);
            window.addEventListener('load', l, false);
        }
    })();
    ChannelIO('boot', {
        "pluginKey": "d430a517-e82a-4c2d-a382-edc0dc164185", //please fill with your plugin key
        "customLauncherSelector": ".channelTalk-button",
        "hideChannelButtonOnBoot": true,
        @if(auth()->check())
        "memberId": '{{auth()->user()->id ?? '정보 없음'}}', //fill with user id
        "profile": {
            "name": "{{auth()->user()->name ?? '정보 없음'}}", //fill with user name
            "mobileNumber": "{{auth()->user()->tel ?? '정보 없음'}}", //fill with user phone number

            "EMAIL": "{{auth()->user()->email ?? '정보 없음'}}", //any other custom meta data

            "MARKETING": "{{ auth()->user()->marketing==='0' ? '거부' : (auth()->user()->marketing === '1' ? '동의' : '정보없음') }}"
        }
        @endif
    });
</script>
<!-- End Channel Plugin -->
@yield('meta-tag')
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- facebook 메타 테그 인증--}}
    <meta name="facebook-domain-verification" content="jqejg3w8f2hsgn237c4zeulq0rvwod"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    {{--<script src="https://d1z6ohcw3epa2e.cloudfront.net/resources/js/app.js" defer></script>--}}
    <script type="text/javascript" src="{{ secure_url('js/app.js') }}" defer></script>

    {{--<script src="{{ secure_url('js/eventListener.polyfill.js') }}"></script>--}}

    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js" defer></script>

    {{-- ie polyfill--}}
    <script type="application/javascript"
            src="https://dofran75um95u.cloudfront.net/js/production/javascript/v6.26.0-polyfill.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- fontawesome --}}
    <script defer src="https://kit.fontawesome.com/353dc7ebaf.js" crossorigin="anonymous"></script>

    @auth
{{--        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/locales/ko.js"></script>--}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.css">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.js"></script>
    @endauth
    <link rel="stylesheet" type="text/css"
          href="https://dofran75um95u.cloudfront.net/js/frontend/swiper/v6.3.4-swiper-bundle.min.css">
    <!-- Styles -->{{--<link href="https://d1z6ohcw3epa2e.cloudfront.net/resources/css/app.css" rel="stylesheet">--}}

    <link href="{{ secure_url('css/app.css') }}" type="text/css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="57x57" href="{{secure_url('/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{secure_url('/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{secure_url('/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{secure_url('/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{secure_url('/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{secure_url('/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{secure_url('/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{secure_url('/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{secure_url('/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{secure_url('/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{secure_url('/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{secure_url('/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{secure_url('/favicon/favicon-16x16.png')}}">
    <link rel="manifest" type="application/json" href="{{secure_url('/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage"
          content="https://d1z6ohcw3epa2e.cloudfront.net/resources/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    @yield('head-css')

</head>
<style type="text/css">
    .PTSerif{
        font-family: 'PT Serif', serif;
    }
    .NotoSerif{
        font-family: 'Noto Serif', serif;
    }
    html, body {
        font-family: 'Spoqa Han Sans', 'Spoqa Han Sans JP', NanumSquareWeb, 'Noto Sans KR', sans-serif !important;
        font-size: 14px;
        color: #777;
        line-height: 1;
        letter-spacing: -0.5px;
        word-spacing: -0.5px;
        height: 100%;
    }

    a:link {
        text-decoration: none;
    }

    a:visited {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }
    [x-cloak] { display: none; }
</style>
@yield('top-style')
@stack('styles')
<body class="bg-tm-c-30373F" style="font-family: NanumSquare, 'Noto Sans',sans-serif !important">
<div id="app">
    <nav class="max-w-1200 mx-auto px-4 pt-8 pb-3">
        <div class="max-w-1200 mx-auto flex items-center">

            <div class="flex-1 float-left">
                <div>
                    <div class="flex items-center space-x-2">
                        @if(isset($curator) && $curator && ( Route::currentRouteName() === 'hotel.view' || Route::currentRouteName() === '/' || \Illuminate\Support\Str::of(Route::currentRouteName())->contains('hotels.collect') ))
                            <a class="navbar-brand" href="{{ route('/',['curator_page'=>$curator->user_page]) }}">
                                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/logos/livinginhotel_logo_01.png"
                                     class="w-20 sm:w-32" alt="">
                            </a>
                            <div class="pl-2">
                                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-x.svg" alt="">
                            </div>
                            <a class="navbar-brand" href="{{ route('/',['curator_page'=>$curator->user_page]) }}">
                                @if($curator->logo_image !== null && $curator->logo_image !== '')
                                    <div class="px-2">
                                        <img src="https://d2pyzcqibfhr70.cloudfront.net/{{$curator->logo_image}}"
                                             class="w-24" alt="{{$curator->user_id}}">
                                    </div>
                                @else
                                    <div class="pt-4 pb-3 px-2">
                                        <div class="AppSdGothicNeoR text-white font-bold text-base sm:text-lg tracking-wide text-center">
                                            <div>{{$curator->user_id}}</div>
                                        </div>
                                    </div>
                                @endif
                            </a>
                        @else
                            <a class="navbar-brand" href="{{ secure_url('/') }}">
                                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/logos/livinginhotel_logo_01.png"
                                     class="w-20 sm:w-32" style="min-width: 70px;" alt="">
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="ml-auto flex space-x-3 sm:space-x-4">
                <div class="flex items-center">
                    <a href="{{ route('hotels.collect',['tab'=>'Living%20in%20Hotel', 'depth'=>'전체', 'curator_page'=>$curator->user_page ?? null]) }}"
                       onclick="GA_event('호텔 모아보기',['{{request()->route()->getName() ?? ''}}']);"
                       class="JeJuMyeongJo text-base 2xs:text-lg md:text-xl @if(request()->route()->getName() === 'hotels.collect') text-tm-c-C1A485 @else text-white hover:text-tm-c-C1A485 @endif">
                        호텔 모아보기{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <g>
                                                                <g>
                                                                    <g transform="translate(-1486.000000, -38.000000) translate(1486.000000, 38.000000) translate(2.000000, 2.000000)">
                                                                        <circle cx="7.5" cy="7.5" r="7" stroke="#FFF"/>
                                                                        <path fill="#FFF" d="M12 12.727L12.727 12 20 19.273 19.273 20z"/>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>--}}
                    </a>
                </div>

                @auth
                    @if(auth()->user()->hasAnyRole('hotel'))
                        <div class="flex items-center">
                            <a href="{{ route('hotel-manager.index') }}"
                               onclick="GA_event('호텔 매니저',['{{request()->route()->getName() ?? ''}}']);"
                               class="JeJuMyeongJo text-base 2xs:text-lg md:text-xl @if(Str::of(request()->route()->getName())->contains(['hotel-manager','hotel-entry'])) text-tm-c-C1A485 @else text-white hover:text-tm-c-C1A485 @endif">
                                호텔 매니저
                            </a>
                        </div>
                    @endif
                    @if(!auth()->user()->hasAnyRole('hotel') /*&& !auth()->user()->hasAnyRole('admin') && !auth()->user()->hasAnyRole('user-admin')*/)
                        <div class="relative">
                            <div class="absolute top-0 right-0 text-xs -mt-3 -mr-2 select-none">
                                <div>
                                    <livewire:customer.list-count type="all_lists"></livewire:customer.list-count>
                                </div>
                            </div>
                            <a href="{{ route('my-page.main') }}"
                               onclick="GA_event('마이페이지',['{{request()->route()->getName() ?? ''}}']);"
                               class="JeJuMyeongJo text-base 2xs:text-lg md:text-xl @if(Str::of(request()->route()->getName())->contains('my-page')) text-tm-c-C1A485 @else text-white hover:text-tm-c-C1A485 @endif">
                                <div class="px-1">
                                    마이페이지
                                    {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <g>
                                                <g transform="translate(-1526.000000, -38.000000) translate(1526.000000, 38.000000)">
                                                    <circle cx="12" cy="6.083" r="4.239" stroke="#FFF"/>
                                                    <path stroke="#FFF" d="M3.523 21.622v-1.834c0-3.546 2.874-6.42 6.42-6.42h4.114c3.546 0 6.42 2.874 6.42 6.42h0v2.057"/>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>--}}
                                </div>
                            </a>
                        </div>
                    @endif
                @endauth
                @guest
                    <div>
                        <a href="{{ route('login') }}"
                           onclick="GA_event('로그인',['{{request()->route()->getName() ?? ''}}']);"
                           class="JeJuMyeongJo text-base 2xs:text-lg md:text-xl @if(Str::of(request()->route()->getName())->contains(['login'])) text-tm-c-C1A485 @else text-white hover:text-tm-c-C1A485 @endif">
                            로그인
                            {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <g transform="translate(-1526.000000, -38.000000) translate(1526.000000, 38.000000)">
                                            <circle cx="12" cy="6.083" r="4.239" stroke="#FFF"/>
                                            <path stroke="#FFF" d="M3.523 21.622v-1.834c0-3.546 2.874-6.42 6.42-6.42h4.114c3.546 0 6.42 2.874 6.42 6.42h0v2.057"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>--}}
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <div class="IEAGENT w-full fixed top-0 mt-4 select-none hidden" onclick="$(this).addClass('hidden');">
        <div class="flex justify-center">
            <div class="p-4 bg-tm-c-ED bg-opacity-50 rounded-md text-xs 3xs:text-sm 2xs:text-lg xs:text-xl sm:text-2xl text-gray-700">
                해당 사이트는 크롬 브라우저에 최적화 되어있습니다.
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
<script type="application/javascript" defer
        src="https://dofran75um95u.cloudfront.net/js/frontend/swiper/v6.3.4-swiper-bundle.min.js"></script>

{{-- initial setting for slick slider --}}
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>

    document.addEventListener ('livewire:load', () => {
        window.livewire.onError(statusCode => {
            console.log(statusCode);
            if (statusCode === 419) {
                alert('로그인 세션이 종료되었습니다,\n새로고침 후 재로그인 부탁드립니다.');
                setTimeout(function(){
                    location.reload();
                },100);
                return false
            }
        });
    });

    var agent = navigator.userAgent.toLowerCase();
    $(document).ready(function () {
        if ((navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) {
            $('.IEAGENT').removeClass('hidden');
        }
    });
    const observer = lozad();
    observer.observe();

    var GA_event = function (type, target) {
        var event = 'track';
        var viewType = 'ViewContent';
        var contentCategory = '';
        var contentAction = '';
        var content = '';
        var content_ids = '';
        var product_catalog_id = '';
        @if(isset($curator) && $curator && (Route::currentRouteName()!=='curator.index'))

            switch (type) {
            case 'product_상품 바로가기 클릭' :
                viewType = '상품 디테일 보기';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '상품 바로가기 클릭';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product category 상품 바로가기 클릭' :
                viewType = '상품 디테일 보기';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '상품 바로가기 클릭';
                content = target[0]+' '+target[2]+'_'+target[3]+'번째';
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'FAQ_click' :
                viewType = 'FAQ';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = target[2]+' 호텔 FAQ 클릭';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_호텔 주문 신청' :
                viewType = '호텔 주문 신청';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '1. 주문 신청(투어 신청, 상품 예약)';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_호텔 주문 진행중' :
                viewType = '호텔 주문 진행중';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '2. 주문 진행중';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_호텔 주문 완료' :
                viewType = '호텔 주문 완료';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '3. 주문 완료-예약 완료';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_투어 신청 완료' :
                viewType = '호텔 주문 완료';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '3. 주문 완료-투어 신청';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_투어,예약 완료' :
                viewType = '';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '3. 주문 완료-투어+예약';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case '페이지 전환' :
                viewType = '페이지 전환';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '새창 전환';
                content = target[0];
                break;
            case '카카오톡 문의하기' :
                viewType = 'Contact';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '카카오톡 문의하기';
                content = target[0];
                break;
            case 'product_slide_change' :
                viewType = '상품 슬라이드 이동';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '슬라이드 변경';
                content = target[0]+'->'+target[1];
                break;
            case 'popup_redirect' :
                viewType = '팝업 > 해당페이지 바로가기';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '해당페이지 바로가기';
                content = target[0];
                break;
            case 'other_hotel_click' :
                viewType = '상품추천 > 다른호텔페이지 바로가기';
                contentCategory = '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}';
                contentAction = '다른호텔페이지 바로가기';
                content = target[0]+'->'+target[1];
                break;

            case '메인_배너_클릭' :
                viewType = '메인 배너 클릭';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_메인 배너 클릭';
                contentAction = '호텔 상세 이동';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = content_ids;
                break;
            case '입점_문의_접근' :
                viewType = '입점 문의 접근';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_입점 문의 접근';
                contentAction = '입점 문의 페이지 이동';
                content = target[0];
                break;
            case '호텔_상세_사진더보기_클릭' :
                viewType = '호텔 상세 사진더보기';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_호텔 상세 사진더보기';
                contentAction = target[0]+' 호텔 더보기 클릭';
                content = target[0];
                break;
            case '호텔_상세_결제폼_바로가기_클릭' :
                viewType = '호텔 상세 결제폼 바로가기';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_호텔 상세 결제폼 바로가기';
                contentAction = target[1]+' Type: '+target[0]+' 결제폼 바로가기 클릭';
                content = target[0];
                break;

            case '호텔_상세_주문시작_클릭' :
                viewType = '호텔 상세';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_주문시작';
                contentAction = target[2]+' Type: '+target[0]+'/'+target[1]+' 주문시작 클릭';
                content = target[0];
                break;

            case '카탈로그_호텔 바로가기' :
                viewType = '카탈로그 > 호텔 바로가기';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_카탈로그';
                contentAction = '호텔 '+target[0]+' 로 바로가기';
                content = target[0];
                break;
            case '호텔모아보기_탭 전환' :
                viewType = '호텔모아보기 > 탭 전환';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_호텔모아보기';
                contentAction = '탭 '+target[0]+' 전환';
                content = target[0];
                break;
            case '호텔모아보기_뎁스 전환' :
                viewType = '호텔모아보기 > 뎁스 전환';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_호텔모아보기';
                contentAction = '뎁스 '+target[0]+' 전환';
                content = target[0];
                break;
            case '호텔모아보기_호텔 바로가기' :
                viewType = '호텔모아보기 > 호텔 바로가기';
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_호텔모아보기';
                contentAction = '호텔 '+target[0]+' 로 바로가기 (이미지 : '+target[1]+' )';
                content = target[0];
                break;
            case '로그인' :
            case '마이페이지' :
            case '호텔 매니저' :
            case '호텔 모아보기' :
            case '얼리버드띠배너' :
            case '프로모션띠배너' :
                viewType = type;
                contentCategory =  '{{$curator->id}}_{{$curator->name}}_{{$curator->user_id}}_'+type;
                contentAction = target[0]+'에서 '+type+' 페이지 이동';
                content = target[0];
            break;
        }
        @else

            switch (type) {
            case 'product_상품 바로가기 클릭' :
                viewType = '상품 디테일 보기';
                contentCategory = 'product';
                contentAction = '상품 바로가기 클릭';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;

            case 'product category 상품 바로가기 클릭' :
                viewType = '상품 디테일 보기';
                contentCategory = 'product';
                contentAction = '상품 바로가기 클릭';
                content = target[0]+' '+target[2]+'_'+target[3]+'번째';
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'FAQ_click' :
                viewType = 'FAQ';
                contentCategory = 'FAQ';
                contentAction = target[2]+' 호텔 FAQ 클릭';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_호텔 주문 신청' :
                viewType = '호텔 주문 신청';
                contentCategory = 'product';
                contentAction = '1. 주문 신청(투어 신청, 상품 예약)';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_호텔 주문 진행중' :
                viewType = '호텔 주문 진행중';
                contentCategory = 'product';
                contentAction = '2. 주문 진행중';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_호텔 주문 완료' :
                viewType = '호텔 주문 완료';
                contentCategory = 'product';
                contentAction = '3. 주문 완료-예약 완료';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_투어 신청 완료' :
                viewType = '호텔 주문 완료';
                contentCategory = 'product';
                contentAction = '3. 주문 완료-투어 신청';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case 'product_투어,예약 완료' :
                viewType = '';
                contentCategory = 'product';
                contentAction = '3. 주문 완료-투어+예약';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;
            case '페이지 전환' :
                viewType = '페이지 전환';
                contentCategory = '페이지 전환';
                contentAction = '새창 전환';
                content = target[0];
                break;
            case '카카오톡 문의하기' :
                viewType = 'Contact';
                contentCategory = '문의하기';
                contentAction = '카카오톡 문의하기';
                content = target[0];
                break;
            case 'product_slide_change' :
                viewType = '상품 슬라이드 이동';
                contentCategory = '상품 리스트';
                contentAction = '슬라이드 변경';
                content = target[0]+'->'+target[1];
                break;
            case 'popup_redirect' :
                viewType = '팝업 > 해당페이지 바로가기';
                contentCategory = '팝업';
                contentAction = '해당페이지 바로가기';
                content = target[0];
                break;
            case 'other_hotel_click' :
                viewType = '상품추천 > 다른호텔페이지 바로가기';
                contentCategory = '다른 상품 추천 리스트';
                contentAction = '다른호텔페이지 바로가기';
                content = target[0]+'->'+target[1];
                break;

            case '메인_배너_클릭' :
                viewType = '메인 배너 클릭';
                contentCategory = '메인 배너 클릭';
                contentAction = '호텔 상세 이동';
                content = target[0];
                content_ids = target[1];
                product_catalog_id = contentCategory;
                break;

            case '입점_문의_접근' :
                viewType = '입점 문의 접근';
                contentCategory =  '입점 문의 접근';
                contentAction = '입점 문의 페이지 이동';
                content = target[0];
                break;
            case '호텔_상세_사진더보기_클릭' :
                viewType = '호텔 상세 사진더보기';
                contentCategory =  '호텔 상세 사진더보기';
                contentAction = target[0]+' 호텔 더보기 클릭';
                content = target[0];
                break;

            case '호텔_상세_결제폼_바로가기_클릭' :
                viewType = '호텔 상세 결제폼 바로가기';
                contentCategory =  '호텔 상세 결제폼 바로가기';
                contentAction = target[1]+' Type: '+target[0]+' 결제폼 바로가기 클릭';
                content = target[0];
                break;

            case '호텔_상세_주문시작_클릭' :
                viewType = '호텔 상세';
                contentCategory =  '주문시작';
                contentAction = target[2]+' Type: '+target[0]+'/'+target[1]+' 주문시작 클릭';
                content = target[0];
                break;

            case '카탈로그_호텔 바로가기' :
                viewType = '카탈로그 > 호텔 바로가기';
                contentCategory = '카탈로그';
                contentAction = '호텔 '+target[0]+' 로 바로가기';
                content = target[0];
                break;
            case '호텔모아보기_탭 전환' :
                viewType = '호텔모아보기 > 탭 전환';
                contentCategory = '호텔모아보기';
                contentAction = '탭 '+target[0]+' 전환';
                content = target[0];
                break;
            case '호텔모아보기_뎁스 전환' :
                viewType = '호텔모아보기 > 뎁스 전환';
                contentCategory = '호텔모아보기';
                contentAction = '뎁스 '+target[0]+' 전환';
                content = target[0];
                break;
            case '호텔모아보기_호텔 바로가기' :
                viewType = '호텔모아보기 > 호텔 바로가기';
                contentCategory = '호텔모아보기';
                contentAction = '호텔 '+target[0]+' 로 바로가기 (이미지 : '+target[1]+' )';
                content = target[0];
                break;

            case '로그인' :
            case '마이페이지' :
            case '호텔 매니저' :
            case '호텔 모아보기' :
            case '얼리버드띠배너' :
            case '프로모션띠배너' :
                viewType = type;
                contentCategory = type;
                contentAction = target[0]+'에서 '+type+' 페이지 이동';
                content = target[0];
            break;
        }
        @endif

        @unlessrole('super-admin|admin')
        {{-- Not Admin --}}
            /*kakaoPixel('7968131379699859784').viewContent({
                id: contentAction,
                tag: content
            });*/
            gtag('event', contentAction, {'event_category': contentCategory, 'event_label': content});
            if(viewType !== ''){
                fbq(event, viewType, {
                    content_type: contentAction,
                    content_category: contentCategory,
                    content_name: content,
                    content_ids: content_ids,
                    product_catalog_id: product_catalog_id
                });
            }
        @endunlessrole
    };
</script>

{{-- 뷰저블 시작 --}}
@unlessrole('super-admin|admin')
<script type="text/javascript">
    (function(w, d, a){
        w.__beusablerumclient__ = {
            load : function(src){
                var b = d.createElement("script");
                b.src = src; b.async=true; b.type = "text/javascript";
                d.getElementsByTagName("head")[0].appendChild(b);
            }
        };w.__beusablerumclient__.load(a);
    })(window, document, "//rum.beusable.net/script/b210121e103342u272/619266ea7c");
</script>
@endunlessrole
{{-- 뷰저블 끝 --}}
@stack('scripts')
@yield('bottom-script')
@livewireScripts
{{--@if(auth()->check() && auth()->user()->hasAnyRole('개발'))--}}
    {{-- 공통 적용 스크립트 , 모든 페이지에 노출되도록 설치. 단 전환페이지 설정값보다 항상 하단에 위치해야함 --}}
<script type="text/javascript">
    if (!wcs_add) var wcs_add={};
    wcs_add["wa"] = "s_4f46309cd722";
    if (!_nasa) var _nasa={};
    if(window.wcs){
        wcs.inflow('livinginhotel.com');
        wcs_do(_nasa);
    }
</script>
{{--@endif--}}
</body>
</html>
