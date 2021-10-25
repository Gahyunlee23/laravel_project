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
    {{--<script src="https://testcpay.payple.kr/js/cpay.payple.1.0.1.js"></script>--}} <!-- 테스트 -->
    <script src="https://cpay.payple.kr/js/cpay.payple.1.0.1.js"></script> <!-- 운영 -->
@endsection

@section('top-style')
@endsection
@section('content')

    <div class="w-full h-full flex justify-center items-center px-2"
         style="min-width: 280px;">
        <div class="mx-auto px-2 sm:px-4 py-4 sm:py-6 select-none bg-gray-700 rounded-lg">

            <div>
                <div class="text-white leading-relaxed">
                    !설명! 환불(승인취소)요청 진행시 회원 결제 취소처리 됩니다.<br>
                    페이플에서 취소처리와 같음(실제취소처리)<br>
                    이미 취소된 결제는 취소 처리안됩니다.
                </div>
            </div>

            <div class="py-2">
                <form id="refundForm" name="refundForm" class="space-y-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <div class="">
                                <label class="text-white" for="PCD_PAY_OID">주문번호(고정)</label>
                            </div>
                            <div class="">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="PCD_PAY_OID" id="PCD_PAY_OID" readonly value="{{$payment->order_id}}">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <label class="text-white" for="PCD_PAY_DATE">결제일자(고정)</label>
                            </div>
                            <div class="">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500" type="number" name="PCD_PAY_DATE" id="PCD_PAY_DATE" readonly value="{{\Carbon\Carbon::parse($payment->order_completed_at)->format('Ymd')}}">
                            </div>
                        </div>
                        <div class="text-white">
                            <div>
                                <div>
                                    결제 금액
                                </div>
                                <div>
                                    {{ number_format($payment->total_price)}}원
                                </div>
                            </div>
                            @isset($payment->reservation->confirmation)
                            <div>
                                <div>
                                    입주 확정 정보
                                </div>
                                <div>
                                    입실 : {{ \Carbon\Carbon::parse($payment->reservation->confirmation->start_dt)->format('Y-m-d H:i:s')}}
                                </div>
                                <div>
                                    퇴실 : {{ \Carbon\Carbon::parse($payment->reservation->confirmation->end_dt)->format('Y-m-d H:i:s')}}
                                </div>
                                <div>
                                    추가일수 : {{ $payment->reservation->confirmation->add_days}}일
                                </div>
                                <div>
                                    사용 : 만{{ \Carbon\Carbon::now()->diffInDays($payment->reservation->confirmation->start_dt)}}일
                                    ({{ \Carbon\Carbon::now()->diffInHours($payment->reservation->confirmation->start_dt)}}시간)

                                </div>
                            </div>
                            @endisset
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <label class="text-white" for="PCD_REFUND_TOTAL">환불(승인취소)금액</label>
                            </div>
                            <div>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                       type="number" onchange="refundCheck(this)" name="PCD_REFUND_TOTAL" id="PCD_REFUND_TOTAL" value="{{$payment->total_price}}">
                            </div>
                            <div>ex] 2만원의 결제 취소를 천원 승인취소하면 부분 취소 처리됩니다.</div>
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <label class="text-white" for="PCD_REFUND_TAXTOTAL">환불(승인취소)부가세</label>
                            </div>
                            <div class="">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500" type="number" name="PCD_REFUND_TAXTOTAL" id="PCD_REFUND_TAXTOTAL" value="0">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <label class="text-white" for="PCD_PAYER_EMAIL">결제자 이메일</label>
                            </div>
                            <div class="">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                       type="email" name="PCD_PAYER_EMAIL" id="PCD_PAYER_EMAIL" value="{{$reservation->order_email ?? ''}}">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="text-xl text-white">
                            관리자 확인용 내용
                        </div>
                        <div class="space-y-2">
                            <div>
                                <label class="text-lg text-white" for="memo">메모</label>
                            </div>
                            <div>
<textarea name="memo" id="memo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500" cols="30" rows="10"
>취소 처리 진행 시간 : {{\Carbon\Carbon::now()->format('Ymd H:i:s')}}
결제자:{{$payment->name}}
결제일자:{{\Carbon\Carbon::parse($payment->order_completed_at)->format('Ymd')}}
취소예정금액:{{$payment->total_price}}원
----------- 추가 메모 -----------

@isset($payment->memo)
#@@@ 이전 메모 Start @@@
{{$payment->memo}}
@@@ 이전 메모 END @@@#@endisset
</textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="space-y-1">
                <button id="PayRefundAction" class="mx-auto w-full max-w-2xl text-center text-lg bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                    환불(승인취소)요청
                </button>
                <button onclick="location.href='{{url()->previous()}}'"
                        class="mx-auto w-full max-w-2xl text-center text-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                    주문관리로 돌아가기
                </button>
            </div>

            <div id='PayRefundResult'></div>
        </div>
    </div>

@endsection
@section('bottom-script')
<script>
    function refundCheck($this){
        if(parseInt('{{$payment->total_price}}') < $($this).val()){
            alert('결제금({{$payment->total_price}})보다 취소금액('+$($this).val()+')이 클 수 없습니다.');
            $($this).val('{{$payment->total_price}}');
        }
    }

    $(document).ready(function () {
        // payReqSend
        $('#PayRefundAction').on('click', function (e) {

            // set default
            e.preventDefault();

            var con = " 환불(승인취소)요청을 전송합니다. \n 진행하시겠습니까? ";

            if (confirm(con) == true) {

                var formData = new FormData($('#refundForm')[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : 'POST',
                    cache : false,
                    processData : false,
                    contentType : false,
                    async : false,
                    url : '{{route('payple.cancel-auth')}}',
                    dataType : 'json',
                    data : formData,
                    success : function (data) {

                        //console.log(data);

                        var $_table = $("<table></table>");
                        var table_data = "";

                        $.each(data, function (key, value) {
                            table_data += '<tr><td>'+key+'</td><td>: '+value+'</td><tr>';
                        });

                        $_table.append(table_data);

                        $_table.appendTo('#PayRefundResult');
                        alert('환불신청 완료되었습니다');
                        if(confirm('주문관리로 돌아가시겠습니까?')){
                            location.href='{{route('hotel.reservations')}}';
                        }
                    },
                    error : function (jqxhr, status, error) {
                        console.log(jqxhr);

                        alert(jqxhr.statusText + ",  " + status + ",   " + error);
                        alert(jqxhr.status);
                        alert(jqxhr.responseText);
                        alert('환불신청 실패했습니다.');
                        if(confirm('주문관리로 돌아가시겠습니까?')){
                            location.href='{{route('hotel.reservations')}}';
                        }
                    }
                });


            } else {

                return false;

            }


        });

    });
</script>
@endsection
