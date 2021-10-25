@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center items-center" style="height:75vh;">

            <div class="w-full max-w-4xl px-0 sm:px-2">
                <div class="">
                    <div class="bg-tm-c-ED py-10" style="">
                        <div class="space-y-8 select-none">

                            <div class="flex justify-center">
                                @switch($status)
                                    @case('success')
                                    <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-selected.svg')}}"
                                         class="w-16" alt="">
                                    @break

                                    @case('fail')
                                    <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-check-normal.svg')}}"
                                         class="w-16" alt="">
                                    @break

                                    @default
                                    <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-delete-incorrect.svg')}}"
                                         class="w-16" alt="">
                                @endswitch
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-center">
                                    <div class="PtSerif italic text-tm-c-30373F text-3xl sm:text-5xl tracking-wide">
                                        @switch($status)
                                            @case('success')
                                            Success
                                            @break

                                            @case('fail')
                                            Fail
                                            @break

                                            @default
                                            Not Found
                                        @endswitch
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <div class="JeJuMyeongJo text-tm-c-30373F text-xs 4xs:text-base 3xs:text-lg 2xs:text-xl sm:text-2xl tracking-wide text-center leading-6 xs:leading-8 sm:leading-10">
                                        @switch($status)
                                            @case('success')
                                            {{$reservation->order_name}} 고객님 호텔
                                            @if($type ==='change')
                                                @if($reservation->type==='tour')
                                                    투어 일정 변경 신청
                                                @elseif ($reservation->type==='month')
                                                    입주 일정 변경 신청
                                                @endif
                                                @else
                                                @if($reservation->type==='tour')
                                                    투어 확정
                                                @elseif ($reservation->type==='month')
                                                    입주 신청
                                                @endif
                                            @endif
                                            완료되었습니다<br>호텔에삶 매니저에게 전달했습니다.
                                            @break

                                            @case('fail')
                                            {{--@isset($reservation->order_name)
                                                {{$reservation->order_name}}
                                            @endisset--}}
                                            이미 처리 되었습니다,<br>이외 문의는 하단의 메일/연락처로 부탁드립니다.
                                            @break

                                            @default
                                            해당 페이지는 주문정보가 없습니다.
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                            @switch($status)
                            @case('success') @case('fail')
                            <div class="flex justify-center">
                                <div class="AppSdGothicNeoR text-tm-c-30373F  text-xs 4xs:text-base sm:text-lg md:text-xl lg:text-2xl text-center leading-7">
                                    @isset($reservation->type)
                                    @if($reservation->type==='tour')
                                        @if($type ==='ok')
                                        고객님에게 알림톡 전송했습니다.
                                        @elseif($type ==='change')
                                        아래의 연락처로 호텔 투어 가능한 일정/시간 전달해주세요.
                                        @endif
                                    @elseif ($reservation->type==='month')
                                        @if($type ==='ok')
                                        호텔에삶 매니저가 확인 후<br>고객님의 입주 확정을 진행합니다.
                                        @elseif($type ==='change')
                                            아래의 연락처로 호텔 입주 가능한 일정을 전달해주세요.
                                        @endif
                                    @endif
                                    @endisset
                                </div>
                            </div>
                            @break
                            @endswitch

                            <div class="flex justify-center">
                                <div>
                                    <div class="space-y-2 xl:space-y-0 xl:space-x-2 xl:flex select-auto">
                                        <div class="w-full">
                                            <a href="tel:1599-4330">
                                                <div class="text-center p-2 select-none">
                                                    <span class="JeJuMyeongJo font-bold text-base sm:text-lg">담당자 연락처</span>
                                                </div>
                                                <div class="w-full max-w-4xl bg-tm-c-C1A485 cursor-pointer py-4 sm:py-5 px-4 sm:px-12 rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                                     style="min-width: 250px">
                                                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                                                        1599-4330
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="w-full">
                                            <a href="mailto:{{env('MAIL_USERNAME')}}">
                                                <div class="text-center p-2 select-none">
                                                    <span class="JeJuMyeongJo font-bold text-base sm:text-lg">담당자 이메일</span>
                                                </div>
                                                <div class="w-full max-w-4xl bg-tm-c-C1A485 cursor-pointer py-4 sm:py-5 px-4 sm:px-12 rounded-sm hover:shadow-lg primary-inset-border active:bg-tm-c-897763"
                                                     style="min-width: 250px">
                                                    <div class="AppSdGothicNeoR text-xl sm:text-2xl text-white text-center">
                                                        {{env('MAIL_USERNAME')}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('bottom-script')

@endsection
