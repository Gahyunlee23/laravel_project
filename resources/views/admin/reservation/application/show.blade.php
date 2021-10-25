@extends('layouts.app')
@push('styles')
    <style>
        ::-webkit-scrollbar-track {
            background-color: rgba(255, 255, 255, 0.9);
        }
        ::-webkit-scrollbar-thumb {
            background-color: rgba(141, 138, 135, 0.3);
        }
    </style>
@endpush
@inject('formatter', 'App\Formatter')
@section('content')
    <div class="max-w-1200 mx-auto px-2 pb-10">
        <div class="flex justify-center py-6 AppSdGothicNeoR">
            <div class="w-full space-y-2">

                @isset($reservation->user)
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 overflow-x-scroll overflow-y-hidden space-y-2">
                            <div class="flex w-max-content space-x-2 px-2">
                                <div class="text-4xl text-tm-c-30373F font-bold">
                                    회원 정보 <span class="text-xl">{{$reservation->user->id}}</span>
                                </div>
                            </div>
                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        회원 ID
                                    </div>
                                    <div class="">
                                        @if($reservation->user->IsSocial)
                                            {{$reservation->user->IsSocial}}
                                        @else
                                            {{$reservation->user->tel ?? '정보없음'}}
                                        @endif
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        성명
                                    </div>
                                    <div class="">
                                        {{$reservation->user->name}}
                                    </div>
                                </div>

                                @if($reservation->user->IsSocial === 'kakao')
                                    <div class="space-y-1">
                                        <div class="text-tm-c-30373F text-xl">
                                            카카오 명
                                        </div>
                                        <div class="">
                                            {{$reservation->user->nick_name}}
                                        </div>
                                    </div>
                                @endif
                                @isset($reservation->user->phone)
                                    <div class="space-y-1">
                                        <div class="text-tm-c-30373F text-xl">
                                            연락처
                                        </div>
                                        <div class="">
                                            {{ phone($reservation->user->phone ,'KR')->formatInternational() }}
                                        </div>
                                    </div>
                                @endisset
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        이메일
                                    </div>
                                    <div class="">
                                        {{ $reservation->user->email }}
                                    </div>
                                </div>
                                @if( $reservation->user->tel !== null && $reservation->user->tel === $reservation->user->password_tmp)
                                    <div class="space-y-1">
                                        <div class="text-tm-c-30373F text-xl">
                                            비밀번호 변경필요
                                        </div>
                                        <div class="">
                                            {{ $reservation->user->password_tmp }}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        총 결제금
                                    </div>
                                    <div class="">
                                        @if(is_numeric($reservation->user->PaymentsTotalPrice))
                                            {{ number_format($reservation->user->PaymentsTotalPrice ?? '0') }}
                                        @endif
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        총 결제완료수
                                    </div>
                                    <div class="">
                                        @if($reservation->user->PaymentsCount)
                                            {{$reservation->user->PaymentsCount}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 flex justify-center items-center text-tm-c-30373F text-xl">
                            회원 정보 없음
                        </div>
                    </div>
                @endisset

                <div class="bg-white rounded-sm">
                    <div class="px-2 py-6 overflow-x-scroll overflow-y-scroll space-y-2">
                        <div class="flex w-full space-x-2 px-2">
                            <div class="text-4xl text-tm-c-30373F font-bold">
                                주문 정보 <span class="text-xl">{{$reservation->id}}</span>
                            </div>
                        </div>

                        <div class="flex w-max-content space-x-4 px-2 text-lg">
                            <div class="space-y-1">
                                <div class="text-tm-c-30373F text-xl">
                                    주문자 성명
                                </div>
                                <div class="">
                                    {{$reservation->order_name ?? '정보없음'}}
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="text-tm-c-30373F text-xl">
                                    연락처
                                </div>
                                <div class="">
                                    {{$reservation->order_hp ?? '정보없음'}}
                                </div>
                            </div>
                        </div>

                        <div class="flex w-max-content space-x-4 px-2 text-lg">
                            <div class="space-y-1">
                                <div class="text-tm-c-30373F text-xl">
                                    원가
                                </div>
                                <div class="">
                                    {{$reservation->order_price}}
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="text-tm-c-30373F text-xl">
                                    판매가
                                </div>
                                <div class="">
                                    {{$reservation->order_sale_price}}
                                </div>
                            </div>
                        </div>

                        <div class="flex w-max-content space-x-4 px-2 text-lg">
                            <div class="space-y-1">
                                <div class="text-tm-c-30373F text-xl">
                                    희망일
                                </div>
                                <div class="">
                                    {{$reservation->order_desired_dt}}
                                </div>
                            </div>
                            @isset($reservation->room)
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        선택 옵션명
                                    </div>
                                    <div class="">
                                        {{$reservation->room->title}}
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        숙박일수
                                    </div>
                                    <div class="">
                                        {{$reservation->room->nights}}박
                                        {{$reservation->room->days}}일
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        쿠폰
                                    </div>
                                    <div class="">
                                        {{$reservation->room->coupon ?? '쿠폰 없음'}}
                                    </div>
                                </div>
                            @endisset


                            @isset($reservation->roomType)
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        룸 명칭
                                    </div>
                                    <div class="">
                                        <div class="@isset($reservation->roomTypeUpgrade) line-through @endisset">
                                            {{$reservation->roomType->name ?? '없음'}}
                                        </div>
                                        @isset($reservation->roomTypeUpgrade)
                                            <div>
                                                > {{$reservation->roomTypeUpgrade->name ?? '없음'}}
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>

                @isset($reservation->payment)
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 overflow-x-scroll overflow-y-hidden space-y-2">
                            <div class="flex w-max-content space-x-2 px-2">
                                <div class="text-4xl text-tm-c-30373F font-bold">
                                    결제 정보 <span class="text-xl">{{$reservation->payment->id}}</span>
                                </div>
                            </div>

                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        결제 상태
                                    </div>
                                    <div class="">
                                        <!--                            결제 상태 1=진행중, 2=주문완료, 3=결제완료, 4=사용완료, 8=결제시도, 9=보류, 0=취소상태, 10=부분취소    -->
                                        @switch($reservation->payment->status)
                                            @case('1')
                                            진행중
                                            @break
                                            @case('2')
                                            주문완료
                                            @break
                                            @case('3')
                                            결제완료
                                            @break
                                            @case('4')
                                            사용완료
                                            @break
                                            @case('8')
                                            결제시도
                                            @break
                                            @case('9')
                                            보류
                                            @break
                                            @case('10')
                                            부분취소
                                            @break
                                            @case('0')
                                            취소
                                            @break
                                            @default
                                            {{$reservation->payment->status}}
                                        @endswitch
                                        ㆍ{{$reservation->payment->message ?? ''}}
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        주문 번호
                                    </div>
                                    <div class="">
                                        {{$reservation->payment->order_id}}
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        결제 방식
                                    </div>
                                    <div class="">
                                        @switch($reservation->payment->card_type)
                                            @case('02')
                                            사이트 결제
                                            @break

                                            @case('01')
                                            간편결제
                                            @break

                                            @default
                                            {{$reservation->payment->card_type}}
                                        @endswitch
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        결제
                                    </div>
                                    <div class="">
                                        {{$reservation->payment->pay_type}}
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        결제상품명+옵션
                                    </div>
                                    <div class="">
                                        {{$reservation->payment->goods_name ?? '정보없음'}}ㆍ
                                        {{$reservation->payment->goods_option ?? '정보없음'}}
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        실 결제금
                                    </div>
                                    <div class="">
                                        @if(is_numeric($reservation->payment->total_price))
                                            {{ number_format($reservation->payment->total_price) ?? '정보없음'}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 flex justify-center items-center text-tm-c-30373F text-xl">
                            결제 정보 없음
                        </div>
                    </div>
                @endisset

                @isset($reservation->confirmation)
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 overflow-x-scroll overflow-y-hidden space-y-2">
                            <div class="flex w-max-content space-x-2 px-2">
                                <div class="text-4xl text-tm-c-30373F font-bold">
                                    확정 정보 <span class="text-xl">{{$reservation->confirmation->id}}</span>
                                </div>
                            </div>
                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        확정 Type
                                    </div>
                                    <div class="">
                                        @switch($reservation->confirmation->type)
                                            @case('HotelTour')
                                            투어
                                            @break

                                            @case('HotelMonth')
                                            입주
                                            @break

                                            @default
                                            {{$reservation->confirmation->type}}
                                        @endswitch
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        상태
                                    </div>
                                    <div class="">
                                        @switch($reservation->confirmation->status)
                                            @case('0')
                                            취소
                                            @break
                                            @case('1')
                                            OK
                                            @break
                                            @case('2')
                                            중도퇴실
                                            @break
                                            @case('3')
                                            확정처리대기
                                            @break
                                            @default
                                            {{ $reservation->confirmation->status }}
                                        @endswitch
                                    </div>
                                </div>
                            </div>

                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        확정 입주
                                    </div>
                                    <div class="">
                                        @if($reservation->confirmation->start_dt)
                                            {{$formatter->carbonFormat($reservation->confirmation->start_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        @endif
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        확정 퇴실
                                    </div>
                                    <div class="">
                                        @if($reservation->confirmation->end_dt)
                                            {{$formatter->carbonFormat($reservation->confirmation->end_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        입주 상태
                                    </div>
                                    <div class="">
                                        @if(isset($list->confirmation))
                                            @if($list->confirmation->start_dt !== null)
                                                입주예정
                                            @endif
                                            @if($list->confirmation->end_dt !== null)
                                                퇴실예정
                                            @endif
                                        @else
                                            입주희망
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 flex justify-center items-center text-tm-c-30373F text-xl">
                            확정 정보 없음
                        </div>
                    </div>
                @endisset

                @isset($reservation->reservationModify)
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 overflow-x-scroll overflow-y-hidden space-y-2">
                            <div class="flex w-max-content space-x-2 px-2">
                                <div class="text-4xl text-tm-c-30373F font-bold">
                                    변경 신청 정보 <span class="text-xl">{{$reservation->reservationModify->id}}</span>
                                </div>
                            </div>

                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        진행 상태
                                    </div>
                                    <div class="">
                                        변경 <x-switch.reservation-modify.process process="{{$reservation->reservationModify->process}}" default="관리자에게 문의 바랍니다."></x-switch.reservation-modify.process>
                                    </div>
                                    <div>
                                        <x-form.buttons.reservation-modify.process-change
                                            process="{{$reservation->reservationModify->process}}"
                                            reservation-modify-id="{{$reservation->reservationModify->id}}"
                                        ></x-form.buttons.reservation-modify.process-change>
                                    </div>
                                    @isset($reservation->reservationModify->process_dt)
                                        <div class="space-y-1">
                                            <div class="text-tm-c-30373F text-xl">
                                                최근 처리 시간
                                            </div>
                                            <div class="">
                                                {{$formatter->carbonFormat($reservation->reservationModify->process_dt,'Y년 m월 d일(요일) H시 i분')}}
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            @isset($reservation->reservationModify->send_dt)
                                <div class="flex w-max-content space-x-4 px-2 text-lg">
                                    <div class="space-y-1">
                                        <div class="text-tm-c-30373F text-xl">
                                            신청 시간
                                        </div>
                                        <div class="">
                                            {{$formatter->carbonFormat($reservation->reservationModify->send_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        </div>
                                    </div>
                                </div>
                            @endisset
                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        이전 입주 ㆍ 퇴실
                                    </div>
                                    <div class="">
                                        @isset($reservation->reservationModify->before_start_dt)
                                            {{$formatter->carbonFormat($reservation->reservationModify->before_start_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        @endisset
                                        ~
                                        @isset($reservation->reservationModify->before_end_dt)
                                            {{$formatter->carbonFormat($reservation->reservationModify->before_end_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        @endisset
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        변경 신청 입주 ㆍ 퇴실
                                    </div>
                                    <div class="">
                                        @isset($reservation->reservationModify->start_dt)
                                            {{$formatter->carbonFormat($reservation->reservationModify->start_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        @endisset
                                        ~
                                        @isset($reservation->reservationModify->end_dt)
                                            {{$formatter->carbonFormat($reservation->reservationModify->end_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        @endisset
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        변동일
                                    </div>
                                    <div class="">
                                        {{$reservation->reservationModify->diff_day}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 flex justify-center items-center text-tm-c-30373F text-xl">
                            변경 신청 정보 없음
                        </div>
                    </div>
                @endisset

                @isset($reservation->reservationCancel)
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 overflow-x-scroll overflow-y-hidden space-y-2">
                            <div class="flex w-max-content space-x-2 px-2">
                                <div class="text-4xl text-tm-c-30373F font-bold">
                                    취소 신청 정보 <span class="text-xl">{{$reservation->reservationCancel->id}}</span>
                                </div>
                            </div>

                            <div class="flex w-max-content space-x-4 px-2 text-lg">
                                <div class="space-y-1">
                                    <div class="text-tm-c-30373F text-xl">
                                        진행 상태
                                    </div>
                                    <div class="">
                                        취소 <x-switch.reservation-cancel.process process="{{$reservation->reservationCancel->process}}" default="관리자에게 문의 바랍니다."></x-switch.reservation-cancel.process>
                                    </div>
                                    <div>
                                        <x-form.buttons.reservation-cancel.process-change
                                            process="{{$reservation->reservationCancel->process}}"
                                            reservation-cancel-id="{{$reservation->reservationCancel->id}}"
                                        ></x-form.buttons.reservation-cancel.process-change>
                                    </div>
                                    @isset($reservation->reservationCancel->process_dt)
                                        <div class="space-y-1">
                                            <div class="text-tm-c-30373F text-xl">
                                                최근 처리 시간
                                            </div>
                                            <div class="">
                                                {{$formatter->carbonFormat($reservation->reservationCancel->process_dt,'Y년 m월 d일(요일) H시 i분')}}
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                            @isset($reservation->reservationCancel->send_dt)
                                <div class="flex w-max-content space-x-4 px-2 text-lg">
                                    <div class="space-y-1">
                                        <div class="text-tm-c-30373F text-xl">
                                            신청 시간
                                        </div>
                                        <div class="">
                                            {{$formatter->carbonFormat($reservation->reservationCancel->send_dt,'Y년 m월 d일(요일) H시 i분')}}
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-sm">
                        <div class="px-2 py-6 flex justify-center items-center text-tm-c-30373F text-xl">
                            취소 신청 정보 없음
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    </div>
@endsection
