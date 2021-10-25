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

        gtag('js', new Date());

        gtag('config', 'UA-181729384-1');
        gtag('config', 'G-5607WHPRZQ');
        gtag('config', 'AW-753064854');
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
    <script type="text/javascript" src="{{ secure_url('js/app.js') }}" defer></script>

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
    <link rel="manifest" type="application/json" href="{{secure_url('favicon/manifest.json')}}">
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
<div id="app" class="h-full">
    <main class="h-full">
        @yield('content')
    </main>
</div>

<script type="application/javascript"
        src="https://dofran75um95u.cloudfront.net/js/frontend/swiper/v6.3.4-swiper-bundle.min.js"></script>
<script>

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
</body>
</html>
