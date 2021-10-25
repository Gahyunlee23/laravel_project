@extends('layouts.payment')
@section('meta-tag')
    @php
        $meta_title=env('APP_TITLE');
        $ogDescription='매일을 여행하듯 사는 호텔한달살기, 호텔장기투숙 플랫폼 호텔에삶에서 만나보세요..';
        $keywords ='호텔에삶, 호텔의삶, 한달살기, 호텔한달살기, 서울한달살기, 서울한달숙소, 서울장기투숙, 호텔장기투숙, 단기월세, 한달살이, 호텔장기투숙, 국내한달살기, 호캉스, 서울무보증원룸, 보증금없는월세, 서울호캉스추천, 월세단기, 무보증월세,트래블메이커스, 트래블메이커';
        $ogTitle=env('APP_TITLE');
        $ogUrl=secure_url('/');
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
    <!-- payple js 호출. 테스트/운영 선택 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cpay.payple.kr/js/cpay.payple.1.0.1.js"></script>
@endsection

@section('top-style')
    <style type="text/css">
        .spinner {
            -webkit-animation: spin 2000ms linear infinite;
            -moz-animation: spin 2000ms linear infinite;
            -ms-animation: spin 2000ms linear infinite;
            animation: spin 2000ms linear infinite;
        }
        @keyframes spin{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}
    </style>
@endsection
@section('content')
    <div class="w-full h-full flex justify-center items-center pb-20"
         style="min-width: 280px;">
        <div class="mx-auto w-full pt-6 sm:pt-12 select-none">
            <div class="mx-4 sm:mx-0">
                <div class="flex flex-col space-y-8 bg-tm-c-ED py-6 mx-auto max-w-xl shadow-lg rounded-sm">
                    <div class="flex justify-center pt-6">
                        <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/img-loading.svg"
                             class="w-16 sm:w-18 spinner" alt="">
                    </div>

                    <div class="flex justify-center">
                        <div class="text-white">
                            @if($reservation->order_status === "3")
                                <div class="AppSdGothicNeoR text-tm-c-30373F text-xl response_text text-center leading-relaxed">
                                    결제가 완료되었습니다.<br>
                                    5초 후 자동 종료됩니다.<br>
                                    궁금하신점은 카카오톡으로 문의 바랍니다.
                                </div>
                            @else
                                <div class="AppSdGothicNeoR text-tm-c-30373F text-xl response_text text-center leading-relaxed">
                                    결제가 진행 중입니다.<br>
                                    결제창 표시가 안될 때<br>결제 진행하기를 눌러주세요.
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-gray-600 space-y-4 text-left">
                            <div class="text-base sm:text-lg">
                                상품명 ㆍ {{$hotel_option->first()->title}}
                            </div>
                            <div class="text-base sm:text-lg">
                                옵션명 ㆍ {{$reservation->room->title}}{{--{{$reservation->room->name}}--}}{{--<span class="text-sm">ㆍ{{$reservation->room->title}}</span>--}}
                            </div>
                            <div>
                                최종결제금액 ㆍ {{number_format($reservation->order_sale_price)}}원
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-6">
                        <div onclick="window.close();"
                             class="flex justify-center items-center order-2 sm:order-1 mx-auto sm:mx-0 w-full h-14 sm:h-18 sm:w-5/12 max-w-sm text-center border-2 border-solid border-tm-c-C1A485 cursor-pointer rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763">
                            <div class="text-tm-c-C1A485">닫기</div>
                        </div>
                        @if($reservation->order_status !== "3")
                            <div id="payAction"
                                 class="flex justify-center items-center order-1 sm:order-2 mb-2 sm:mb-0 mx-auto sm:mx-0 w-full h-14 sm:h-18 sm:w-5/12 max-w-sm  bg-tm-c-C1A485 cursor-pointer rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763">
                                <div class="text-center text-white">
                                    결제 진행하기
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom-script')
    <script>
        //document.cookie = "name=PHPSESSID; SameSite=None; Secure";
        window.onload = function () {
            @if($reservation->order_status === "3")
            /*결제 완료후 자동 종료*/
            @if($reservation->payment->total_price > 1000)
            gtag('event', 'purchase', {
                "transaction_id": '{{$reservation->payment->order_id}}',
                "value": '{{$reservation->payment->total_price}}',
                "currency": "KRW",
                "tax": 0,
                "shipping": 0,
                "items": [
                    {
                        "id": '{{$reservation->id}}',
                        "name": '{{$reservation->payment->goods_name}}',
                        "list_name": '{{$reservation->payment->goods_name}}',
                        "brand": '{{$reservation->payment->goods_name}}',
                        "category": '{{$reservation->payment->goods_option}}',
                        "price":  '{{$reservation->payment->total_price}}',
                    }
                ]
            });

            gtag('event', 'conversion', {
                'send_to': 'AW-753064854/gbB0CNXi7OoBEJa3i-cC',
                'value':  '{{$reservation->payment->total_price}}',
                'currency': 'KRW',
                'transaction_id': '{{$reservation->payment->order_id}}'
            });
            @endif
            setTimeout(function () {
                if(window.opener){
                    window.opener.location.reload();
                    window.close();
                }else{
                    @if(isset($reservation->hotel_id))
                        location.href='{{route('hotel.view',['hotel'=>$reservation->hotel_id])}}';
                    @else
                        location.href='/';
                    @endif
                }
            },5000);
            @elseif($reservation->order_status ==="8")
            $('.response_text').html('결제에 실패했습니다.<br>결제 진행하기 버튼을 눌러 재시도 해주세요.');
            @elseif($reservation->order_status !=="3" && $reservation->order_status !=="8")
            setTimeout(function () {
                $('#payAction').trigger('click');
            },500);
            @endif
        };

        $(document).ready(function () {
            $('#payAction').on('click', function (event) {
                var obj = {};
                obj.PCD_CPAY_VER = "1.0.1";

                obj.PCD_PAY_WORK = "PAY";
                @if($method ==='account-transfer')
                    obj.PCD_PAYER_AUTHTYPE = 'pwd';
                obj.PCD_PAY_TYPE = "transfer";
                @else
                    obj.PCD_PAY_TYPE = "card";
                obj.PCD_CARD_VER = "02";
                @endif
                    obj.PCD_PAY_OID = '{{date('YmdHis')}}-{{ mt_rand(1000,9999) }}';

                obj.payple_auth_file = '{{route('payple.auth')}}';

                obj.PCD_PAYER_NO = "{{$reservation->id}}";
                obj.PCD_PAYER_NAME = "{{$reservation->order_name}}";
                obj.PCD_PAYER_HP = "{{$reservation->order_hp}}";
                obj.PCD_PAYER_EMAIL = "{{$reservation->order_email}}";
                obj.PCD_PAY_GOODS = "{{$hotel_option->first()->title}}ㆍ{{$reservation->room->title}}";

                obj.PCD_PAY_TOTAL = '{{$reservation->order_sale_price}}';
                @hasrole('super-admin')
                    obj.PCD_PAY_TOTAL = '1000';
                @endhasrole
                    obj.PCD_PAY_ISTAX = "Y";
                // obj.PCD_PAY_TAXTOTAL = 10;
                @if ($androidMobile||$appleMobile)
                    obj.PCD_RST_URL = '{{route('payment.store.rest.process')}}';{{-- mobile android / ios  https://www.livinginhotel.com/payment/store/rest/process--}}
                    @else
                    obj.PCD_RST_URL = '/payment/store/rest/process'; {{-- PC window mac /payment/store/rest/process--}}
                @endif
                PaypleCpayAuthCheck(obj);
                event.preventDefault();
            });
        });
    </script>
@endsection
