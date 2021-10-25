@extends('layouts.payment')
@section('meta-tag')
    @php
        $meta_title=env('APP_TITLE');
        $ogDescription='매일을 여행하듯 사는 호텔한달살기, 호텔장기투숙 플랫폼 호텔에삶에서 만나보세요..';
        $keywords ='트래블메이커, 트레블메이커, travelmaker, 호텔에삶, livinginhotel, 호텔한달살기, 호텔에서한달살기, 한달살기, 서울한달살기, 서울한달숙소, 한달단기임대, 서울단기원룸, 서울단기임대, 서울한달단기임대, 서울무보증원룸, 보증금없는월세, 서울호캉스, 서울호텔, 호캉스추천, 서울호텔추천';
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
    {{--<script src="https://testcpay.payple.kr/js/cpay.payple.1.0.1.js"></script>--}} <!-- 테스트 -->
    <script src="https://cpay.payple.kr/js/cpay.payple.1.0.1.js"></script> <!-- 운영 -->
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
                            @if($progress === "3")
                                <div class="AppSdGothicNeoR text-tm-c-30373F text-xl response_text text-center leading-relaxed">
                                    이미 결제가 완료되었습니다.<br>
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
                        @if($progress !== "3")
                        <div id="payAction"
                             class="flex justify-center items-center order-1 sm:order-2 mb-2 sm:mb-0 mx-auto sm:mx-0 w-full h-14 sm:h-18 sm:w-5/12 max-w-sm  bg-tm-c-C1A485 cursor-pointer rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763">
                            <div class="text-center text-white">결제 진행하기</div>
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

        window.onload = function () {
            @if($progress === "3")
                setTimeout(function () {
                    window.opener.location.reload();
                    window.close();
                },5000)
                @else
                $('#payAction').trigger('click');
            @endif
        };

        $(document).ready(function () {
            $('#payAction').on('click', function (event) {
                var obj = {};
                obj.PCD_CPAY_VER = "1.0.1";
                obj.PCD_PAY_TYPE = "card";
                obj.PCD_PAY_WORK = "PAY";

                /* 02 : 앱카드결제 */
                obj.PCD_CARD_VER = "02";
                obj.PCD_PAY_OID = '{{date('YmdHis')}}-{{ mt_rand(1000,9999) }}';

                /* 가맹점 인증요청  */
                obj.payple_auth_file = '{{route('payple.auth')}}';

                /* 주문자 정보*/
                /* id, 사용자명, 연락처, 이메일*/
                obj.PCD_PAYER_NO = "{{$reservation->id}}";
                obj.PCD_PAYER_NAME = "{{$reservation->order_name}}";
                obj.PCD_PAYER_HP = "{{$reservation->order_hp}}";
                obj.PCD_PAYER_EMAIL = "{{$reservation->order_email}}";

                /* 상품 정보*/
                /* 상품명, 결제금, 과세설정, 통합과세 */
                obj.PCD_PAY_GOODS = "DEV{{$hotel_option->first()->title}}ㆍ{{$reservation->room->title}}";
                obj.PCD_PAY_TOTAL = '1000';
                obj.PCD_PAY_ISTAX = "Y";
                //obj.PCD_PAY_TAXTOTAL = 10;

                /* 결과를 콜백 함수로 받고자 하는 경우 함수 설정 추가 */
                obj.callbackFunction = getResult;  // getResult : 콜백 함수명

                /*
                결과를 콜백 함수가 아닌 URL로 받고자 하는 경우
                (모바일에서 팝업방식은 상대경로, 다이렉트 방식은 절대경로로 설정)
                */
                // obj.PCD_RST_URL = '/admin/payment/show';
                PaypleCpayAuthCheck(obj);
                event.preventDefault();
            });

        });

        var getResult = function ($response) {
            //console.log('result', $response);
            var formData = new FormData();
            formData.append('reservation_id',$response.PCD_PAYER_NO);
            formData.append('order_id',$response.PCD_PAY_OID);
            formData.append('card_type',$response.PCD_CARD_VER);
            formData.append('pay_type',$response.PCD_PAY_TYPE);
            formData.append('pay_url',$response.PCD_PAY_URL);
            formData.append('name',$response.PCD_PAYER_NAME);
            formData.append('email',$response.PCD_PAYER_EMAIL);
            formData.append('hp',$response.PCD_PAYER_HP);
            formData.append('goods_tax',$response.PCD_PAY_ISTAX);
            formData.append('goods_name',$response.PCD_PAY_GOODS);
            formData.append('total_price',$response.PCD_PAY_TOTAL);
            formData.append('result_message',$response.PCD_PAY_RST);
            formData.append('message',$response.PCD_PAY_MSG);
            formData.append('referer_url',$response.PCD_HTTP_REFERER);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ route('payment.store') }}',
                data: formData,
                dataType: 'json',
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data.status ==='success'){
                       // console.log(data.payment);

                        if($response.PCD_PAY_RST === 'success'){
                            $('.response_text').html('결제 승인요청되었습니다.<br>3~5초후 자동으로 결제창을 종료합니다.');

                            setTimeout(function (){
                                window.opener.location.href='{{route('reservations.order_completed')}}';
                                window.close();
                             },3000);
                        }else{
                            $('.response_text').html('결제에 실패했습니다.<br>결제 진행하기 버튼을 눌러 재시도 해주세요.');
                        }
                    }else{
                        $('.response_text').html('결제에 실패했습니다.<br>결제 진행하기 버튼을 눌러 재시도 해주세요.');
                    }

                },
                error: function (data) {
                    $('.response_text').html('결제에 실패했습니다.<br>결제 진행하기 버튼을 눌러 재시도 해주세요.<br>실패 반복시 카카오톡 문의바랍니다.');

                    console.log('error',data);
                }
            });

        }


    </script>
    {{--gtag('event', 'purchase', {
        "transaction_id": "24.031608523954162",
        "affiliation": "livinginhotel store",
        "value": '{{$reservation->order_sela_price}}',
        "currency": "KRW",
        "tax": 0,
        "shipping": 0,
        "items": [
            {
                "id": "{{$reservation->id}}",
                "name": "{{$reservation->room->title}} {{$reservation->room->name}}",
                "list_name": "주문",
                "brand": "Google",
                "category": "호텔에삶/한달살기",
                "variant": "{{$reservation->room->title}}",
                "list_position": 1,
                "quantity": 2,
                "price": '{{$reservation->order_sela_price}}'
            }
        ]
    });--}}
@endsection
