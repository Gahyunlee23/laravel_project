<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
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
        })(window, document, 'script', 'dataLayer', 'GTM-W6LBJBB');</script>
    <!-- End Google Tag Manager -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5607WHPRZQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-181729384-1');
        gtag('config', 'G-5607WHPRZQ');
        gtag('config', 'AW-753064854');

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
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=5394940997284438&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    <script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/adfit/static/kp.js"></script>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0, user-scalable=no">
@yield('meta-tag')
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    {{--<script src="https://d1z6ohcw3epa2e.cloudfront.net/resources/js/app.js" defer></script>--}}
    <script type="text/javascript" src="{{ secure_url('js/app.js') }}" defer></script>

    {{--<script src="{{ secure_url('js/eventListener.polyfill.js') }}"></script>--}}

    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

    {{-- ie polyfill--}}
    <script type="application/javascript"
            src="https://dofran75um95u.cloudfront.net/js/production/javascript/v6.26.0-polyfill.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/353dc7ebaf.js" crossorigin="anonymous"></script>

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

<body class="bg-tm-c-30373F" style="font-family: NanumSquare, 'Noto Sans',sans-serif !important">
<div id="app">
    <nav class="max-w-1200 mx-auto px-4 pt-8 pb-3">
        <div class="max-w-1200 mx-auto flex items-center">

            <div class="flex-1 float-left">
                <div>
                    <div class="flex items-center space-x-2">
                        <a class="navbar-brand" href="{{ secure_url('/') }}">
                            <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/logo_04.png"
                                 class="w-16 sm:w-18" alt="">
                        </a>
                        @if(isset($curator) && $curator && ( Route::currentRouteName() === 'hotel.view' || Route::currentRouteName() === '/'))
                            <div class="pl-2">
                                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-x.svg" alt="">
                            </div>
                            <a class="navbar-brand" href="{{ route('/',['curator_page'=>$curator->user_page]) }}">
                                <div class="pt-4 pb-3 px-2">
                                    <div class="AppSdGothicNeoR text-white font-bold text-base sm:text-lg tracking-wide text-center">
                                        <div>{{$curator->user_id}}</div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @hasrole('super-admin|admin')
            <div class="px-6 sm:px-12 ml-auto">
                <div class="grid grid-cols-2 gap-1">
                    <div class="text-center space-y-1 bg-gray-200 py-1 px-1 rounded-md">
                        <div class="AppSdGothicNeoR text-sm text-black">
                            투어
                        </div>
                        <div class="bg-white rounded-md py-1 px-3" x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                            <i class="fad fa-alarm-exclamation text-red-600"></i> {{\App\HotelReservation::whereType('tour')->where('order_desired_dt','>=',\Carbon\Carbon::today()->subDays(3))->where('order_status','!=',1)->doesntHave('confirmation')->count()}}
                            <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                <div class="absolute w-max-content top-0 z-10 p-2 -mt-6 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-orange-400 bg-opacity-50 rounded-lg shadow-lg">
                                    투어 희망일 3일이내 미확정 내역<br>
                                    오늘 ~ {{\Carbon\Carbon::today()->addDays(3)}}
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-md py-1 px-3" x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                            <i class="fas fa-check-double text-green-600"></i> {{\App\HotelReservation::whereType('tour')->where(function($query){ $query->where('order_status','=','2')->orWhere('order_status','=','5'); })->where('created_at','>=',\Carbon\Carbon::today()->format('Y-m-d').' 00:00:00')->count()}}
                            <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                <div class="absolute w-max-content top-0 z-10 p-2 -mt-6 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-orange-400 bg-opacity-50 rounded-lg shadow-lg">
                                    오늘 투어 신청 내역
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center space-y-1 bg-gray-200 py-1 px-1 rounded-md">
                        <div class="AppSdGothicNeoR text-sm text-black">
                            입주
                        </div>
                        <div class="bg-white rounded-md py-1 px-3" x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                            <i class="fad fa-alarm-exclamation text-red-600"></i>
                            {{\App\HotelReservation::whereType('month')->where('order_desired_dt','>=',\Carbon\Carbon::today()->subDays(5))
                                ->where(function ($query){$query->where('order_status','=',3); })->doesntHave('confirmation')->count()}}
                            <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                <div class="absolute w-max-content top-0 z-10 p-2 -mt-6 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-orange-400 bg-opacity-50 rounded-lg shadow-lg">
                                    입주 희망일 5일이내 미확정 내역<br>
                                    오늘~{{\Carbon\Carbon::today()->addDays(5)}}
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-md py-1 px-3" x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                            <i class="fas fa-check-double text-green-600"></i>
                            {{\App\HotelReservation::whereType('month')->where(function($query){ $query->where('order_status','=','3')->orWhere('order_status','=','5'); })->where('created_at','>=',\Carbon\Carbon::today()->format('Y-m-d').' 00:00:00')->count()}}
                            <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                <div class="absolute w-max-content top-0 z-10 p-2 -mt-6 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-orange-400 bg-opacity-50 rounded-lg shadow-lg">
                                    오늘 결제완료 내역
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole
        <!-- Right Side Of Navbar -->
            <div class="float-left ml-auto relative">
                @auth
                    <div class="text-white" x-data="{ open: false }">
                        @hasrole('super-admin|admin')
                        <button class="px-6 py-2 bg-tm-c-C1A485 rounded-lg hover:bg-tm-c-635749 hover:border border-gray-600" @click="open = true">
                            {{ Auth::user()->getRoleNames()->first() }}
                            <br>{{ Auth::user()->name }} <span class="caret"></span>
                        </button>
                        @endhasrole

                        <ul class="z-50 w-full space-y-px leading-loose absolute mt-2 bg-tm-c-C1A485 divide-y-2 text-center"
                            x-show.transition.origin.top="open" @click.away="open = false" x-cloak>
                            <li class="px-2 hover:bg-tm-c-635749">
                                <a class="" href="{{ route('admin') }}">
                                    {{ __('관리자') }}
                                </a>
                            </li>
                            <li class="px-2 hover:bg-tm-c-635749">
                                <a class="dropdown-item" href="{{ route('admin.dev.index') }}">
                                    {{ __('DEV') }}
                                </a>
                            </li>
                            <li class="px-2 hover:bg-tm-c-635749">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('로그아웃') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
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

<!-- 잠시만 기달려주세요 alert -->
<livewire:alert.wait />


<script type="application/javascript"
        src="https://dofran75um95u.cloudfront.net/js/frontend/swiper/v6.3.4-swiper-bundle.min.js"></script>
<script>
    var agent = navigator.userAgent.toLowerCase();
    $(document).ready(function () {
        if ((navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) {
            $('.IEAGENT').removeClass('hidden');
        }
    });

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
@yield('bottom-script')

@livewireScripts
</body>
</html>
