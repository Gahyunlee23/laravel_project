@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection

@section('meta-tag')
    @php
        $keywords ='';
        $meta_title=env('APP_NAME');
        $ogDescription='';
        $ogUrl=secure_url('/');
        $ogTitle=env('APP_NAME');
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
    @php
        function get_S3_resource($url){
            $response='error';
            if (function_exists('curl_init')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
                $response = curl_exec($ch);
                curl_close($ch);
            }else if ($fp = fopen($url, 'r')) {
                while ($line = fgets($fp, 1024)) {
                    $response .= $line;
                }
            }
            return $response;
        }

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
    <div class="max-w-1200 mx-auto">
        <div class="flex justify-center">
            <div class="w-full">

                <div class="w-full card-body p-3 mb-16 space-y-4">
                    <form name="options_form" id="options_form" method="get">
                        @csrf
                        @method('get')
                        <div class="flex flex-wrap border border-solid border-tm-c-C1A485">

                            <div class="space-y-1 p-2">
                                <div class="AppSdGothicNeoR text-white">
                                    결제 상품 Type
                                </div>
                                <div>
                                    <select name="order_type" onchange="$('form#options_form').submit();" id="">
                                        <option value="">전체 Type</option>
                                        <option value="month" @if($now_type === 'month') selected @endif>호텔에삶</option>
                                        <option value="tour" @if($now_type === 'tour') selected @endif>투어신청</option>
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-1 p-2">
                                <div class="AppSdGothicNeoR text-white">
                                    이름,이메일,연락처 검색
                                </div>
                                <div>
                                    <input type="text" name="user_data" value="{{$user_data}}"
                                           onchange="$('form#options_form').submit();">
                                </div>
                            </div>
                            <div class="space-y-1 p-2">
                                <div class="AppSdGothicNeoR text-white">
                                    출력 개수
                                </div>
                                <div>
                                    <select name="pageant" onchange="$('form#options_form').submit();">
                                        <option value="10" @if($pagenat === '10') selected @endif>10 개씩</option>
                                        <option value="20" @if($pagenat === '20') selected @endif>20 개씩</option>
                                        <option value="30" @if($pagenat === '30') selected @endif>30 개씩</option>
                                        <option value="40" @if($pagenat === '40') selected @endif>40 개씩</option>
                                        <option value="50" @if($pagenat === '50') selected @endif>50 개씩</option>
                                        <option value="100" @if($pagenat === '100') selected @endif>100 개씩</option>
                                        <option value="200" @if($pagenat === '200') selected @endif>200 개씩</option>
                                        <option value="500" @if($pagenat === '500') selected @endif>500 개씩</option>
                                        <option value="1000" @if($pagenat === '1000') selected @endif>1000 개씩</option>
                                        <option value="99999" @if($pagenat === '99999') selected @endif>ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-1 p-2">
                                <div class="AppSdGothicNeoR text-white">
                                    주문 상태 확인
                                </div>
                                <div>
                                    <select name="order_status" onchange="$('form#options_form').submit();" id="">
                                        <option value="">전체 리스트</option>
                                        <option value="0" @if($now_status === '0') selected @endif>취소 내역 {{\App\HotelReservation::whereOrderStatus('0')->count()}}개</option>
                                        {{--<option value="1" @if($now_status === '1') selected @endif>진행중 내역 {{\App\HotelReservation::whereOrderStatus('1')->count()}}개</option>--}}
                                        <option value="2" @if($now_status === '2') selected @endif>주문 완료 내역 {{\App\HotelReservation::whereOrderStatus('2')->count()}}개</option>
                                        <option value="3" @if($now_status === '3') selected @endif>결제 완료 내역 {{\App\HotelReservation::whereOrderStatus('3')->count()}}개</option>
                                        <option value="4" @if($now_status === '4') selected @endif>사용 완료 내역 {{\App\HotelReservation::whereOrderStatus('4')->count()}}개</option>
                                        <option value="5" @if($now_status === '5') selected @endif>입주 중 내역 {{\App\HotelReservation::whereOrderStatus('5')->count()}}개</option>
                                        <option value="8" @if($now_status === '8') selected @endif>결제 실패 내역 {{\App\HotelReservation::whereOrderStatus('8')->count()}}개</option>
                                        <option value="9" @if($now_status === '9') selected @endif>진행 보류 내역 {{\App\HotelReservation::whereOrderStatus('9')->count()}}개</option>
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-1 p-2">
                                <div class="AppSdGothicNeoR text-white">
                                    실 결제 상태 확인
                                </div>
                                <div>
                                    @php $payment_messages = \App\Payment::groupBy('message')->get() @endphp
                                    <select name="payment_status" onchange="$('form#options_form').submit();" id="">
                                        <option value="">전체 리스트</option>
                                        @foreach ($payment_messages as $payment)
                                            <option value="{{$payment->message}}" @if($payment_status === $payment->message) selected @endif>{{$payment->message}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-1 p-2">
                                <div class="AppSdGothicNeoR text-white">
                                    큐레이터 판매 주문
                                </div>
                                <div>
                                    <select name="curator_visible" onchange="$('form#options_form').submit();" id="">
                                        <option value="">전체 리스트</option>
                                        <option value="0" @if($curator_visible === '0') selected @endif>큐레이터 판매 내역
                                        </option>
                                        <option value="1" @if($curator_visible === '1') selected @endif>큐레이터 제외 판매 내역
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-1 p-2">
                                <div class="AppSdGothicNeoR text-white">
                                    큐레이터 검색
                                </div>
                                <div>
                                    <select name="curator_data" id="curator_data"
                                            onchange="$('form#options_form').submit();">
                                        <option value="">---큐레이터 리스트---</option>
                                        @foreach(\App\Curator::all() as $curator)
                                            <option value="{{$curator->name}}"
                                                    @if($curator->name===$curator_data) selected @endif>
                                                {{$curator->name}}/{{$curator->user_id}}
                                                결제수: {{\App\HotelReservation::whereCuratorId($curator->id)->count()}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                    @if(count($reservations)===0)
                        <div class="py-12 text-4xl text-white font-bold text-center">
                            해당되는 주문 정보 없음
                        </div>
                    @endif


                    @foreach($reservations as $reservation_index=>$reservation)

                        @php
                            $payment=\App\Payment::whereReservationId($reservation->id)->first();
                            $room=\App\HotelRoom::whereId($reservation->room_id)->first();
                        @endphp
                        {{--{{$list}}--}}
                        <div class="w-full">
                            <div
                                class="inline-block w-full p-4 bg-white border-2 border-solid border-gray-200 rounded-md divide-y divide-gray-400">

                                <div class="mt-1">
                                    @if ($reservation->type === 'month')
                                        <div class="float-left p-2 text-2xl font-bold text-blue-600">호텔살기 {{$reservation->id}}</div>
                                    @else
                                        <div class="float-left p-2 text-2xl font-bold text-red-600">투어신청 {{$reservation->id}}</div>
                                    @endif

                                    @if(isset($reservation->curator))
                                        <div
                                            class="ml-auto max-w-sm mr-2 mb-3 text-center text-lg bg-red-500 text-white font-bold py-2 px-4 rounded-lg">
                                            큐레이터 판매
                                        </div>
                                    @endif

                                    {{-- 1=예약진행중, 2=주문완료, 3=결제완료, 4=완료, 9=보류, 0=취소상태 --}}
                                    <div class="float-right cursor-pointer mt-1 ml-1" data-target="status_box"
                                         data-index="{{$reservation_index}}"
                                         onclick="$('.'+$(this).data('target')+'[data-index='+$(this).data('index')+']').stop().toggleClass('hidden');">
                                        @switch($reservation->order_status)
                                            @case(0)
                                            <div
                                                class="max-w-sm mb-1 text-center text-lg bg-red-400 active:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 취소처리됨
                                            </div>
                                            @break
                                            @case(1)
                                            <div
                                                class="max-w-sm mb-1 text-center text-lg bg-yellow-500 active:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 진행중
                                            </div>
                                            @break
                                            @case(2)
                                            @if ($reservation->type === 'month')
                                                <div
                                                    class="max-w-sm mb-1 text-center text-lg bg-green-500 active:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                                    현 - 결제 전(정보입력)
                                                </div>
                                            @else
                                                <div
                                                    class="max-w-sm mb-1 text-center text-lg bg-green-500 active:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                                    현 - 투어신청완료
                                                </div>
                                            @endif
                                            @break
                                            @case(3)
                                            <div
                                                class="max-w-sm mb-1 text-center text-lg bg-blue-500 active:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 결제완료됨
                                            </div>
                                            @break
                                            @case(4)
                                            <div
                                                class="max-w-sm mb-1 text-center text-lg bg-blue-300 active:bg-blue-500 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 사용완료됨
                                            </div>
                                            @break
                                            @case(5)
                                            <div
                                                class="max-w-sm mb-1 text-center border text-lg bg-blue-400 active:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 입주 중
                                            </div>
                                            @break
                                            @case(8)
                                            <div
                                                class="max-w-sm mb-1 text-center text-lg bg-gray-500 active:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 결제실패
                                            </div>
                                            @break
                                            @case(9)
                                            <div
                                                class="max-w-sm mb-1 text-center text-lg bg-orange-400 active:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 보류중
                                            </div>
                                            @break
                                            @case(11)
                                            <div
                                                class="max-w-sm mb-1 text-center text-lg bg-red-400 active:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                                                현 - 중도퇴실
                                            </div>
                                            @break
                                            @default
                                            <div>
                                                {{$reservation->order_status}}
                                            </div>
                                        @endswitch
                                    </div>

                                    <div class="status_box pl-2 ml-auto float-right overflow-hidden hidden"
                                         data-index="{{$reservation_index}}">
                                        <div class="space-y-1 inline">
                                            <button
                                                class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg"
                                                style="min-width: 98px;"
                                                onclick="event.preventDefault();
                                                    if(confirm('취소로 변경하시겠습니까?')){
                                                    document.getElementById('order-status-form-{{$reservation->id}}').action='{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>0])}}'
                                                    document.getElementById('order-status-form-{{$reservation->id}}').submit();}">
                                                취소 처리
                                            </button>
                                            <button
                                                class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg"
                                                style="min-width: 112px;"
                                                onclick="event.preventDefault();
                                                    if(confirm('예약 진행중으로 변경하시겠습니까?')){
                                                    document.getElementById('order-status-form-{{$reservation->id}}').action='{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>1])}}'
                                                    document.getElementById('order-status-form-{{$reservation->id}}').submit();}">
                                                예약 진행중
                                            </button>
                                            <button
                                                class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg"
                                                style="min-width: 98px;"
                                                onclick="event.preventDefault();
                                                    if(confirm('주문완료로 변경하시겠습니까?')){
                                                    document.getElementById('order-status-form-{{$reservation->id}}').action='{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>2])}}'
                                                    document.getElementById('order-status-form-{{$reservation->id}}').submit();}">
                                                주문완료
                                            </button>
                                            <button
                                                class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                                                style="min-width: 98px;"
                                                onclick="event.preventDefault();
                                                    if(confirm('결제완료로 변경하시겠습니까?')){
                                                    document.getElementById('order-status-form-{{$reservation->id}}').action='{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>3])}}'
                                                    document.getElementById('order-status-form-{{$reservation->id}}').submit();}">
                                                결제완료
                                            </button>
                                            <button
                                                class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg"
                                                style="min-width: 98px;"
                                                onclick="event.preventDefault();
                                                    if(confirm('사용완료로 변경하시겠습니까?')){
                                                    document.getElementById('order-status-form-{{$reservation->id}}').action='{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>4])}}'
                                                    document.getElementById('order-status-form-{{$reservation->id}}').submit();}">
                                                사용완료
                                            </button>
                                            <button
                                                class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-orange-400 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg"
                                                style="min-width: 88px;"
                                                onclick="event.preventDefault();
                                                    if(confirm('보류로 변경하시겠습니까?')){
                                                    document.getElementById('order-status-form-{{$reservation->id}}').action='{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>9])}}'
                                                    document.getElementById('order-status-form-{{$reservation->id}}').submit();}">
                                                보류
                                            </button>
                                            <button
                                                class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg"
                                                style="min-width: 88px;"
                                                onclick="event.preventDefault();
                                                    if(confirm('중도퇴실로 변경하시겠습니까?')){
                                                    document.getElementById('order-status-form-{{$reservation->id}}').action='{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>11])}}'
                                                    document.getElementById('order-status-form-{{$reservation->id}}').submit();}">
                                                중도퇴실
                                            </button>
                                        </div>
                                    </div>
                                    {{--1=진행중, 2=주문완료, 3=결제완료, 0=취소상태--}}
                                    <form id="order-status-form-{{$reservation->id}}"
                                          action="{{route('hotel.reservation.order-status', ['reservation'=>$reservation->id,'type'=>1])}}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('POST')
                                    </form>
                                </div>

                                <div class="">
                                    <table class="table-auto w-full bg-gray-200 border-gray-700 text-left">
                                        <thead>
                                        <tr>
                                            <th colspan="3" class="border px-4 py-2">처리 시간</th>
                                        </tr>
                                        <tr>
                                            <th class="border px-4 py-2">신청&주문</th>
                                            <th class="border px-4 py-2">결제접근</th>
                                            <th class="border px-4 py-2">취소처리</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="border px-4 py-2">
                                                {{$reservation->created_at}}
                                            </td>
                                            <td class="border px-4 py-2">
                                                @isset($payment)
                                                    {{$payment->order_completed_at ?? $payment->updated_at}}
                                                    [{{$payment->order_completed_time ?? $payment->uploaded_time}}]
                                                @endisset
                                            </td>
                                            <td class="border px-4 py-2">
                                                @if(isset($payment)&&$payment->status === '0')
                                                    {{$payment->updated_at}} [{{$payment->uploaded_time}}]
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                @if(isset($reservation->order_name)||isset($reservation->order_price))
                                    <div class="">
                                        <table class="table-auto w-full bg-gray-200 border-gray-700 text-left">

                                            <thead>
                                            <tr>
                                                <th colspan="3" class="border px-4 py-2">주문 정보</th>
                                            </tr>
                                            </thead>
                                            @isset($reservation->order_name)
                                                <thead>
                                                <tr>
                                                    <th class="border px-4 py-2">주문자명</th>
                                                    <th class="border px-4 py-2">주문자 연락처</th>
                                                    <th class="border px-4 py-2">주문자 이메일</th>
                                                    <th class="border px-4 py-2">구매자 이용약관(필수)</th>
                                                    <th class="border px-4 py-2">개인정보활용(필수)</th>
                                                    <th class="border px-4 py-2">마케팅 수신(선택)</th>
                                                    <th class="border px-4 py-2">희망날짜</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->order_name}}
                                                    </td>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->order_hp}}
                                                    </td>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->order_email}}
                                                    </td>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->use_terms}}
                                                    </td>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->order_privacy}}
                                                    </td>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->order_marketing}}
                                                    </td>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->order_desired_dt}}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @endisset
                                            @isset($reservation->order_price)
                                                <thead>
                                                <tr>
                                                    <th colspan="2" class="border px-4 py-2">원가</th>
                                                    <th colspan="2" class="border px-4 py-2">판매가</th>
                                                    <th colspan="2" class="border px-4 py-2">할인률</th>
                                                    <th class="border px-4 py-2">취소환불액</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td colspan="2" class="border px-4 py-2">
                                                        {{$reservation->order_price}}원
                                                    </td>
                                                    <td colspan="2" class="border px-4 py-2">
                                                        {{$reservation->order_sale_price}}원
                                                    </td>
                                                    <td colspan="2" class="border px-4 py-2">
                                                        {{$reservation->order_discount_rate}}%
                                                    </td>
                                                    <td class="border px-4 py-2">
                                                        {{$reservation->order_refund_amount}}원
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @endisset
                                        </table>
                                    </div>
                                @endif

                                @if(isset($payment))
                                    <div class="">
                                        <table class="table-auto w-full bg-gray-200 border-gray-700 text-left">
                                            <thead>
                                            <tr>
                                                <th colspan="7" class="border px-4 py-2">결제 정보</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="border px-4 py-2 font-bold text-xl text-red-600 bg-gray-400">결제자명</th>
                                                <th colspan="2" class="border px-4 py-2">결제자 이메일</th>
                                                <th colspan="3" class="border px-4 py-2">결제자 연락처</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$payment->name}}
                                                </td>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$payment->hp}}
                                                </td>
                                                <td colspan="3" class="border px-4 py-2">
                                                    {{$payment->email==='undefined' ? '정보없음' : $payment->email }}
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <th colspan="1" class="border px-4 py-2">
                                                    결제 처리 메모
                                                </th>
                                                <td colspan="6" class="border px-4 py-2">
                                                    {!! $payment->memo ===null ? '메모 없음' : nl2br(Str::of($payment->memo)->replace('\n','<br>')) !!}
                                                </td>
                                            </tr>
                                            </tbody>
                                            <thead>
                                            <tr>
                                                <th colspan="7" class="border px-4 py-2">호텔 정보</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="border px-4 py-2">원가</th>
                                                <th colspan="2" class="border px-4 py-2">판매가</th>
                                                <th class="border px-4 py-2">할인률</th>
                                                <th colspan="2" class="border px-4 py-2">취소환불액</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$reservation->order_price}}원
                                                </td>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$reservation->order_sale_price}}원
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->order_discount_rate}}%
                                                </td>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$reservation->order_refund_amount}}원
                                                </td>
                                            </tr>
                                            </tbody>
                                            <thead>
                                            <tr>
                                                <th colspan="7" class="border px-4 py-2">결제 상품 정보</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2" class="border px-4 py-2 font-bold text-xl text-red-600 bg-gray-400">상품명</th>
                                                <th colspan="2" class="border px-4 py-2 font-bold text-xl text-red-600 bg-gray-400">상품옵션</th>
                                                <th colspan="3" class="border px-4 py-2 font-bold text-xl text-red-600 bg-gray-400">실결제금액</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$payment->goods_name}}
                                                </td>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$payment->goods_option}}
                                                </td>
                                                <td colspan="3" class="border px-4 py-2">
                                                    {{$payment->total_price}}
                                                </td>
                                            </tr>
                                            </tbody>
                                            <thead>
                                            <tr>
                                                <th colspan="6" class="border px-4 py-2">결제 정보</th>
                                            </tr>
                                            <tr>
                                                <th class="border px-4 py-2 font-bold text-xl text-red-600 bg-gray-400">결제OID</th>
                                                <th class="border px-4 py-2 font-bold text-xl text-red-600 bg-gray-400">결제금액</th>
                                                <th class="border px-4 py-2">결제상품명</th>
                                                <th class="border px-4 py-2">결제상품옵션</th>
                                                <th class="border px-4 py-2">객실 타입</th>
                                                <th class="border px-4 py-2">결제 타입</th>
                                                <th class="border px-4 py-2">Tax포함</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border px-4 py-2">
                                                    {{$payment->order_id}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$payment->total_price}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$payment->goods_name}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$payment->goods_option}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{\App\HotelRoom::find(\App\HotelReservation::find($payment->reservation_id)->room_id)->main_explanation ?? '투어=룸선택X'}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$payment->pay_type}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$payment->goods_tax}}
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <th class="border px-4 py-2">메세지</th>
                                                <td class="border px-4 py-2 text-xl">
                                                    @switch($payment->message)
                                                        @case('결제를 종료하였습니다.')
                                                            <span class="text-red-600">
                                                                {{$payment->message}}
                                                            </span>
                                                            @break
                                                        @case('카드승인요청등록완료')
                                                        <span class="text-gray-600">
                                                                {{$payment->message}}
                                                            </span>
                                                        @break

                                                        @case('카드승인완료')
                                                            <span class="text-green-600">
                                                                {{$payment->message}}
                                                            </span>
                                                            @break

                                                        @default
                                                        {{$payment->message}}

                                                    @endswitch
                                                </td>
                                                <th class="border px-4 py-2">결과</th>
                                                <td class="border px-4 py-2 font-bold text-xl text-red-600 bg-gray-400">
                                                    {{$payment->result_message}}
                                                </td>
                                                <th class="border px-4 py-2">이전페이지</th>
                                                <td colspan="2" class="border px-4 py-2">
                                                    {{$payment->referer_url}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if(isset($reservation->curator))
                                    <div class="">
                                        <table class="table-auto w-full bg-gray-400 border-gray-700 text-left">
                                            <thead>
                                            <tr>
                                                <th colspan="3" class="border px-4 py-2">큐레이터 정보</th>
                                            </tr>
                                            </thead>
                                            <thead>
                                            <tr>
                                                <th class="border px-4 py-2">IDX</th>
                                                <th class="border px-4 py-2">ID</th>
                                                <th class="border px-4 py-2">큐레이터 성명</th>
                                                <th class="border px-4 py-2">큐레이터 Page</th>
                                                <th class="border px-4 py-2">큐레이터 연락처</th>
                                                <th class="border px-4 py-2">큐레이터 이메일</th>
                                                <th class="border px-4 py-2">큐레이터 활성화</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->curator->id}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->curator->user_id}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->curator->name}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->curator->user_page}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->curator->tel}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->curator->email}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    @if($reservation->curator->visible)
                                                        <div class="px-2 py-2 bg-gray-200 rounded-lg">활성화 큐레이터</div>
                                                    @else
                                                        <div>비활성화 큐레이터</div>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @isset($reservation->confirmation)
                                    <div class="">
                                        <table class="table-auto w-full bg-gray-400 border-gray-700 text-left">
                                            <thead>
                                            <tr>
                                                <th colspan="6" class="border px-4 py-2">입주 정보</th>
                                            </tr>
                                            </thead>
                                            <thead>
                                            <tr>
                                                <th class="border px-4 py-2">확정 객실 타입</th>
                                                <th class="border px-4 py-2">입주일</th>
                                                <th class="border px-4 py-2">퇴실일</th>
                                                <th class="border px-4 py-2">남은일수</th>
                                                <th class="border px-4 py-2">추가일</th>
                                                <th class="border px-4 py-2">상태</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->room_type}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->start_dt}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->end_dt}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->start_end_diff_date ?? 0}}일
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->add_days ?? 0}}일
                                                </td>
                                                <td class="border px-4 py-2">
                                                    @switch($reservation->confirmation->status)
                                                        @case(0)
                                                            X
                                                            @break
                                                        @case(1)
                                                            O
                                                            @break
                                                        @default
                                                        이외
                                                    @endswitch
                                                </td>
                                            </tr>
                                            </tbody>
                                            <thead>
                                            <tr>
                                                <th class="border px-4 py-2">입실3일전</th>
                                                <th class="border px-4 py-2">입실1일전</th>
                                                <th class="border px-4 py-2">퇴실3일전</th>
                                                <th class="border px-4 py-2">퇴실1일전</th>
                                                <th class="border px-4 py-2">퇴실 후 1일</th>
                                                <th class="border px-4 py-2">퇴실 후 3일</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->before_3day ?? '알림톡미전송'}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->before_1day ?? '알림톡미전송'}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->last_3day ?? '알림톡미전송'}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->last_1day ?? '알림톡미전송'}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->after_1day ?? '알림톡미전송'}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->confirmation->after_3day ?? '알림톡미전송'}}
                                                </td>
                                            </tr>
                                            </tbody>
                                            <thead>
                                            <tr>
                                                <th colspan="6" class="border px-4 py-2">입주-메모</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="6" class="border px-4 py-2">
                                                    {{$reservation->confirmation->memo ?? '메모없음'}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endisset
                                @if($reservation->type === 'tour')
                                    <div class="">
                                        <table class="table-auto w-full bg-gray-300 border-gray-700 text-left">
                                            <thead>
                                            <tr>
                                                <th colspan="3" class="border px-4 py-2">호텔 투어 정보</th>
                                            </tr>
                                            </thead>

                                            @if(isset($reservation->hotel->options[0]))
                                            <thead>
                                            <tr>
                                                <th class="border px-4 py-2">호텔명</th>
                                                <th class="border px-4 py-2">판매링크</th>
                                                <th class="border px-4 py-2">원가</th>
                                                <th class="border px-4 py-2">판매가</th>
                                                <th class="border px-4 py-2">할인률</th>
                                                <th class="border px-4 py-2">취소환불액</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->hotel->options[0]->title}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->hotel->options[0]->sale_url}}
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->hotel->options[0]->price}}원
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->hotel->options[0]->sale_price}}원
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->hotel->options[0]->discount_rate}}%
                                                </td>
                                                <td class="border px-4 py-2">
                                                    {{$reservation->hotel->options[0]->refund_amount}}원
                                                </td>
                                            </tr>
                                            </tbody>
                                            @else
                                                <thead>
                                                <tr>
                                                    <th colspan="7" class="border px-4 py-2">호텔 정보가 삭제되었습니다.</th>
                                                </tr>
                                                </thead>
                                            @endif

                                        </table>
                                    </div>
{{--                                    @if($reservation->order_status ==='2' || $reservation->order_status==='8')--}}
{{--                                    <div class="w-full">--}}
{{--                                        <div class="h-10 flex justify-end items-center">--}}
{{--                                            <div>--}}
{{--                                                <button--}}
{{--                                                    class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg"--}}
{{--                                                    style="min-width: 98px;"--}}
{{--                                                    onclick="event.preventDefault();open_reservation_popup('{{$reservation->id}}');">--}}
{{--                                                    투어 > 결제 처리--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @endif--}}

                                    @else
                                    <div class="">
                                        <table class="table-auto w-full bg-gray-300 border-gray-700 text-left">
                                            <thead>
                                            <tr>
                                                <th colspan="3" class="border px-4 py-2">호텔 정보</th>
                                            </tr>
                                            </thead>

                                            @if(isset($reservation->hotel->options[0]))
                                                <thead>
                                                <tr>
                                                    <th colspan="7" class="border px-4 py-2">호텔명</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td colspan="7" class="border px-4 py-2">
                                                        {{$reservation->hotel->options[0]->title}}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @else
                                                <thead>
                                                <tr>
                                                    <th colspan="7" class="border px-4 py-2">호텔 정보가 삭제되었습니다.</th>
                                                </tr>
                                                </thead>
                                            @endif
                                        </table>
                                    </div>
                                @endif

{{--                                @if($reservation->order_status === '3')--}}
{{--                                    <div class="w-full">--}}
{{--                                        <div class="h-10 flex justify-end items-center">--}}
{{--                                            <div>--}}
{{--                                                <button--}}
{{--                                                    class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg"--}}
{{--                                                    style="min-width: 98px;"--}}
{{--                                                    onclick="event.preventDefault();location.href='{{route('payment.cancel',['reservation'=>$reservation->id])}}'">--}}
{{--                                                    결제 취소 진행--}}
{{--                                                </button>--}}
{{--<!--                                                <button--}}
{{--                                                    class="submit-btn inline-block whitespace-nowrap mx-auto text-center text-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"--}}
{{--                                                    style="min-width: 98px;"--}}
{{--                                                    onclick="event.preventDefault();confirmation_reservation_popup('{{ \App\HotelReservation::find($reservation->id ?? null) }}','{{ collect(\App\Payment::find($payment->id ?? null))->only('id','name') }}','{{$room}}');">--}}
{{--                                                    호텔 > 입주 확정--}}
{{--                                                </button>-->--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    @endforeach

                    @if(count($reservations)!==0)
                        <div class="flex justify-center">
                            <div class="flex flex-wrap">
                               <div class="paginate_container">
                                   {{$reservations->setPageName('page')}}
                               </div>
                            </div>
                            <div class="bg-gray-100 p-2 rounded-lg">
                                총:{{$reservations->total()}}개
                            </div>
                        </div>
                        <style>
                            .paginate_container ul li {list-style-type: none; float:left;}
                            .paginate_container li {padding: 5px;}
                            .paginate_container li.active {color: white;}
                        </style>
                    @endif

                </div>

            </div>

        </div>
    </div>

@endsection
@section('bottom-script')
<script>

    /* 입주 확정 popup close */
    function close_confirmation_popup(){
        if ($('.confirmation_popup').length) {
            $('.confirmation_popup').remove();
        }
        $('body,html').css({
            'overflow': 'visible'
        });
    }
    function getFormatDate(date){
        var year = date.getFullYear();
        var month = (1 + date.getMonth());
        month = month >= 10 ? month : '0' + month;
        var day = date.getDate();
        day = day >= 10 ? day : '0' + day;
        return year + '/' + month + '/' + day;
    }

    /* 입주 확정 popup */
    function confirmation_reservation_popup($reservation,$payment,$room) {
        console.log($reservation,$payment,$room);
        var reservation = JSON.parse($reservation);
        var payment = JSON.parse($payment);
        var room = JSON.parse($room);
        var reservation_desired_temp ='';
        if(reservation.order_desired_dt.length > 10){
            var data_format = new Date(reservation.order_desired_dt);
            reservation_desired_temp=getFormatDate(data_format).split('/')
        }else{
            reservation_desired_temp=reservation.order_desired_dt.split('/');
        }

        var reservation_order_desired_dt = (reservation_desired_temp[0] ?? '2020')
            +'-'+(reservation_desired_temp[1].length===1 ? '0'+reservation_desired_temp[1] : reservation_desired_temp[1])
            +'-'+(reservation_desired_temp[2].length===1 ? '0'+reservation_desired_temp[2] : reservation_desired_temp[2]);
        var exit_date_temp=new Date(reservation_desired_temp[0],(reservation_desired_temp[1]-1),(reservation_desired_temp[2]));
        exit_date_temp.setDate(exit_date_temp.getDate()+(room.nights*1));

        var exitMonth = exit_date_temp.getMonth()+1;

        var exitDate = exit_date_temp.getDate();

        var exit_desired_temp=exit_date_temp.getFullYear()+'-'+(exitMonth < 10 ? '0'+exitMonth : exitMonth )+'-'+(exitDate < 10 ? '0'+exitDate : exitDate );

        if ($('.confirmation_popup').length) {
            $('.confirmation_popup').remove();
        }
        if(reservation.order_name !== payment.name){
            alert('주문자와 결제자 명이 다릅니다.'+'\n주문자명:'+reservation.order_name+'\n결제자명:'+payment.name);
        }
        var select_room_type='';
        if(reservation.room_type_name!==null){
            select_room_type = reservation.room_type_name;
            if(reservation.room_type_upgrade_name !== null){
                select_room_type += '> <span class="font-bold">'+reservation.room_type_upgrade_name+'(업그레이드 적용)</span>';
            }
        }
        var html = '<div class="confirmation_popup">' +
            '<div class="absolute top-0 right-0 pt-6 pr-6">' +
            '<div class="flex justify-center items-center">' +
            '<div onclick="close_confirmation_popup()"' +
            ' class="py-3 px-4 object-cover relative text-2xl text-black-50 bg-white rounded-full z-40 cursor-pointer shadow-lg border font-bold hover:text-white hover:bg-gray-700">⨉</div>' +
            '</div>' +
            '</div>' +
            '<div class="absolute top-0 left-0 w-full h-full flex justify-center items-center bg-gray-700 bg-opacity-75">' +
            '<div class="bg-white bg-opacity-75 p-4 rounded-lg space-y-4">' +
            '<div class="text-xl font-bold">결제완료 > 입주 확정 처리 + 알림톡</div>' +
            '<div class="text-lg">해당 정보로 알림톡 전송됩니다,<br>입력 데이터 확인 후 확정 처리해주세요~!</div>' +

            '<div class="text-lg font-normal">' +
            '<div>' +
            '<form name="confirmation_form" id="confirmation_form" method="POST">@csrf @method('POST')' +
            '<table class="table-auto">' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">주문OID<span class="text-sm">(고정)</span></td>' +
            '<td><input type="text" name="reservation_id" autocomplete="off" required readonly value="'+reservation.id+'" class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">결제OID<span class="text-sm">(고정)</span></td>' +
            '<td><input type="text" name="payment_id" autocomplete="off" required readonly value="'+payment.id+'" class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">입주 시작</td>' +
            '<td>' +
            '<input type="date" name="start_dt1" value="'+reservation_order_desired_dt+'" autocomplete="off" required class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
            '<input type="time" name="start_dt2" autocomplete="off" value="14:00:00" required class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
            '</td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">퇴실 기한</td>' +
            '<td>' +
            '<input type="date" name="end_dt1" autocomplete="off" value="'+exit_desired_temp+'" required class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
            '<input type="time" name="end_dt2" autocomplete="off" value="11:00:00" required class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
            '</td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">결제자 성명</td>' +
            '<td><input type="text" name="name" autocomplete="off" value="'+reservation.order_name+'" placeholder="결제자 성명" required class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">고객 선택 룸 옵션</td>' +
            '<td>'+select_room_type+'</td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">입주 룸 타입(수정확인필수)</td>' +
            '<td><input type="text" name="room_type" autocomplete="off" value="'+room.main_explanation+'" placeholder="룸 타입" required class="check_input w-full shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">결제자 이메일</td>' +
            '<td><input type="email" name="email" autocomplete="off" value="'+reservation.order_email+'" placeholder="결제자 email" class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">결제자 연락처</td>' +
            '<td><input type="tel" name="hp" autocomplete="off" value="'+reservation.order_hp+'" placeholder="결제자 연락처" class="check_input shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
            '</tr>' +
            '</tbody>' +
            '<tbody>' +
            '<tr>' +
            '<td class="px-2 py-2">메모</td>' +
            '<td>' +
            '<textarea name="memo" id="memo" class="w-full shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500" rows="3"></textarea>' +
            '</td>' +
            '</tr>' +
            '</tbody>' +
            '</table>' +
            '<div class="pt-2">' +
            '<button class="submit-btn mx-auto w-full max-w-2xl text-center text-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg"' +
            'onclick="event.preventDefault();if(confirm(\'입주 확정하시겠습니까??\\n!!결제자 정보 및 상품 정보가 알림톡 내용에 포함되어\\n확인 시 [알림톡 전송, 입주 확정처리] 진행됩니다!!\')){confirmation_form_check('+reservation.id+','+payment.id+');}">' +
            '입주 확정' +
            '</button>' +
            '</div>' +
            '</form>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('body,html').css({
            'overflow': 'hidden'
        });
        $('body').append(html);
    }

    /* 입주 확정 처리 */
    function confirmation_form_check($reservation_id,$payment_id) {
        const form = document.getElementById("confirmation_form");
        var formData = new FormData();

        formData.append('reservation_id', $reservation_id);
        formData.append('payment_id', $payment_id);
        formData.append('user_id', '{{\Illuminate\Support\Facades\Auth::id()}}');

        formData.append('start_dt', form.start_dt1.value+' '+form.start_dt2.value);
        formData.append('end_dt', form.end_dt1.value+' '+form.end_dt2.value);

        formData.append('room_type', form.room_type.value);

        formData.append('name', form.name.value);
        formData.append('email', form.email.value);
        formData.append('hp', form.hp.value);

        formData.append('memo', form.memo.value);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('confirmation.livinginhotel') }}',
            data: formData,
            dataType: 'json',
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.status === 'success') {
                    alert('입주 확정 처리 완료되었습니다.');
                    location.reload();
                }else{
                    alert(data.status+'로 실패했습니다.');
                }
            },
            error: function (data) {
                console.log('error', data);
                alert('error로 실패했습니다.');
            }
        });

    }

    /* 결제 popup close*/
    function close_reservation_popup(){
        if ($('.reservation_popup').length) {
            $('.reservation_popup').remove();
        }
        $('body,html').css({
            'overflow': 'visible'
        });
    }
    /* 결제 popup */
    function open_reservation_popup($reservation_id) {
        var data=new Date();
        var order_id =data.getFullYear()+''+(data.getMonth()+1)+''+data.getDate()+''+data.getHours()+''+data.getMinutes()+data.getSeconds()+'-'+Math.floor(Math.random() * 8999+1000);
        if ($('.reservation_popup').length) {
            $('.reservation_popup').remove();
        }

        var html = '<div class="reservation_popup">' +
            '<div class="absolute top-0 right-0 pt-6 pr-6">' +
                '<div class="flex justify-center items-center">' +
                    '<div onclick="close_reservation_popup()"' +
                        ' class="py-3 px-4 object-cover relative text-2xl text-black-50 bg-white rounded-full z-40 cursor-pointer shadow-lg border font-bold hover:text-white hover:bg-gray-700">⨉</div>' +
                '</div>' +
            '</div>' +
            '<div class="absolute top-0 left-0 w-full h-full flex justify-center items-center bg-gray-700 bg-opacity-75">' +
                '<div class="bg-white bg-opacity-75 p-4 rounded-lg space-y-4">' +
                    '<div class="text-xl font-bold">투어신청 > 결제 전환(결제완료)처리 + 알림톡</div>' +

                    '<div class="text-lg font-normal">' +
                        '<div>' +
                            '<form name="reservation_form" id="reservation_form" method="post">@csrf @method('post')' +
                            '<table class="table-auto">' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">주문ID (자동)</td>' +
                                    '<td><input type="text" name="order_id" autocomplete="off" required value="'+order_id+'" class="shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결제 방식</td>' +
                                    '<td>' +
                                        '<select name="card_type" id="card_type" required class="shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
                                            '<option value="02">앱결제</option>' +
                                        '</select>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결제 방식</td>' +
                                    '<td>' +
                                        '<select name="pay_type" id="pay_type" required class="shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
                                            '<option value="card">카드결제</option>' +
                                        '</select>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결제자 성명</td>' +
                                    '<td><input type="text" name="name" autocomplete="off" placeholder="결제자 성명" required class="shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결제자 이메일</td>' +
                                    '<td><input type="email" name="email" autocomplete="off" placeholder="결제자 email" class="shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결제자 연락처</td>' +
                                    '<td><input type="tel" name="hp" autocomplete="off" placeholder="결제자 연락처" class="shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">Tax</td>' +
                                    '<td>' +
                                        '<select name="goods_tax" id="goods_tax" required class="shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
                                        '<option value="Y">포함</option>' +
                                        '<option value="N">미포함</option>' +
                                        '</select>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">상품명</td>' +
                                    '<td><input type="text" name="goods_name" placeholder="호텔명" autocomplete="off" required class="shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">상품 옵션</td>' +
                                    '<td><input type="text" name="goods_option" placeholder="#주 살기" autocomplete="off" class="shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결제금액</td>' +
                                    '<td><input type="number" name="total_price" autocomplete="off" placeholder="결제금 숫자로만 입력" required class="shadow appearance-none border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결과</td>' +
                                    '<td>' +
                                        '<select name="message" id="message" required class="shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
                                            '<option value="카드승인완료">카드승인완료</option>' +
                                            '<option value="결제를 종료하였습니다.">결제를 종료하였습니다.</option>' +
                                            '<option value="카드승인요청등록완료">카드승인요청등록완료</option>' +
                                        '</select>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">결과 상태</td>' +
                                    '<td>' +
                                        '<select name="result_message" id="result_message" required class="shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">' +
                                            '<option value="success">success</option>' +
                                            '<option value="close">close</option>' +
                                        '</select>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td class="px-2 py-2">메모</td>' +
                                    '<td>' +
                                        '<textarea name="memo" id="memo" class="w-full shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500" rows="3"></textarea>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                            '</table>' +
                            '<div class="pt-2">' +
                                '<button class="submit-btn mx-auto w-full max-w-2xl text-center text-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg"' +
                                    'onclick="event.preventDefault();if(confirm(\'신청완료 > 결제처리 하시겠습니까?\\n!!결제자 정보 및 상품 정보가 알림톡 내용에 포함되어\\n확인 시 [알림톡 전송,결제처리]진행됩니다!!\')){reservation_form_check('+$reservation_id+');}">' +
                                    '결제처리' +
                                '</button>' +
                            '</div>' +
                            '</form>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '</div>';
        $('body,html').css({
            'overflow': 'hidden'
        });
        $('body').append(html);
    }
    /* 결제 처리 */
    function reservation_form_check($reservation_id) {
        const form = document.getElementById("reservation_form");
        //form.submit();

        var formData = new FormData();//$('form#reservation_form');

        formData.append('reservation_id', $reservation_id);
        formData.append('order_id', form.order_id.value);
        formData.append('card_type', form.card_type.value);
        formData.append('pay_type', form.pay_type.value);

        formData.append('name', form.name.value);
        formData.append('email', form.email.value);
        formData.append('hp', form.hp.value);

        formData.append('goods_tax', form.goods_tax.value);
        formData.append('goods_name', form.goods_name.value);
        formData.append('goods_option', form.goods_option.value);
        formData.append('total_price', form.total_price.value);

        formData.append('status', '3');
        formData.append('message', form.message.value);
        formData.append('result_message', form.result_message.value);
        formData.append('memo', form.memo.value);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('hotel.reservation.payments') }}',
            data: formData,
            dataType: 'json',
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status === 'success') {
                    alert('결제 처리 완료되었습니다.');
                    location.reload();
                }else{
                    alert(data.status+'로 실패했습니다.');
                }
            },
            error: function (data) {
                console.log('error', data);
                alert('error로 실패했습니다.');
            }
        });

    }
</script>
@endsection
