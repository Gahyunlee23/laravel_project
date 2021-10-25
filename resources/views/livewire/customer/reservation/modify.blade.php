<div>
    @inject('formatter', 'App\Formatter')
    <div class="space-y-4">
        <div class="flex">
            <a
                @if($reservation->isMonth())
                href="{{route('my-page.main', ['tab'=>'month-lists'])}}"
                @elseif($reservation->isTour())
                href="{{route('my-page.main', ['tab'=>'tour-lists'])}}"
                @endif
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33">
                    <g fill="none" fill-rule="evenodd">
                        <g>
                            <path fill="#30373F" d="M0 0H1920V1104H0z" transform="translate(-360 -114)"/>
                            <g>
                                <g>
                                    <path stroke="#FFF" stroke-width="2" d="M3 16L16 30 29 16"
                                          transform="translate(-360 -114) translate(360 114) rotate(90 15.75 16.25)"/>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
        <div>
            <div class="JeJuMyeongJo text-4xl text-white">
                예약 상세 내역
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="bg-tm-c-ED">
            <div class="py-4 3xs:py-6 2xs:py-8 sm:py-14 px-6 3xs:px-8 2xs:px-12 sm:px-18">

                <div class="space-y-2 sm:space-y-4">
                    <div class="flex AppSdGothicNeoR">
                        <div class="font-bold text-tm-c-30373F text-lg 2xs:text-xl sm:text-3xl">
                            {{$reservation->hotel->option->title}}
                        </div>
                        <div class="flex items-center ml-auto">
                            @if(\App\ReservationCancel::where('user_id','=',auth()->user()->id)->where('reservation_id','=',$reservation->id)->where('process','!=','0')->count()>=1)
                                <div class="AppSdGothicNeoR text-xs 2xs:text-base sm:text-lg text-tm-c-da5542">
                                    취소 진행 중
                                </div>
                            @else
                                @if($reservation->isMonth())
                                    @if(isset($reservation->payment) && $reservation->payment->status !== '0')
                                        @if(isset($reservation->confirmation))
                                            <div
                                                class="AppSdGothicNeoR font-bold text-tm-c-0D5E49 text-xs 2xs:text-base sm:text-lg">
                                                @if($reservation->confirmation->start_dt <= \Carbon\Carbon::now()
                                                    && \Carbon\Carbon::now()->diffInHours($reservation->confirmation->end_dt) > 72)
                                                    입주 중
                                                @elseif($reservation->confirmation->start_dt >= \Carbon\Carbon::now())
                                                    @if(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt) <= 24)
                                                        @if(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt) <= 1)
                                                            {{\Carbon\Carbon::now()->diffInMinutes($reservation->confirmation->start_dt)}}
                                                            분 후
                                                        @else
                                                            {{\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt)}}
                                                            시간 후
                                                        @endif
                                                    @else
                                                        {{ number_format(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt)/24)}}
                                                        일 후
                                                    @endif
                                                    입주 예정
                                                @elseif($reservation->confirmation->start_dt <= \Carbon\Carbon::now()
                                                    && \Carbon\Carbon::now()->diffInHours($reservation->confirmation->end_dt) <= 72)
                                                    @if(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->end_dt) <= 24)
                                                        @if(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->end_dt) <= 1)
                                                            {{\Carbon\Carbon::now()->diffInMinutes($reservation->confirmation->end_dt)}}
                                                            분 후
                                                        @else
                                                            {{\Carbon\Carbon::now()->diffInHours($reservation->confirmation->end_dt)}}
                                                            시간 후
                                                        @endif
                                                    @else
                                                        {{ number_format(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->end_dt)/24)}}
                                                        일 후
                                                    @endif
                                                    퇴실 예정
                                                @endif
                                            </div>
                                        @else
                                            <div class="AppSdGothicNeoR">
                                                예약 확정 진행중
                                            </div>
                                        @endif
                                    @else
                                        <div class="AppSdGothicNeoR">
                                            취소 처리
                                        </div>
                                    @endif
                                @elseif($reservation->isTour())
                                    @if(isset($reservation) && $reservation->order_status !== '0')
                                        @if(isset($reservation->confirmation))
                                            <div
                                                class="AppSdGothicNeoR font-bold text-tm-c-0D5E49 text-xs 2xs:text-base sm:text-lg">
                                                @if($reservation->confirmation->start_dt <= \Carbon\Carbon::now())
                                                    투어 완료
                                                @elseif($reservation->confirmation->start_dt >= \Carbon\Carbon::now())
                                                    @if(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt) <= 24)
                                                        @if(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt) <= 1)
                                                            {{\Carbon\Carbon::now()->diffInMinutes($reservation->confirmation->start_dt)}}
                                                            분 후
                                                        @else
                                                            {{\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt)}}
                                                            시간 후
                                                        @endif
                                                    @else
                                                        {{ number_format(\Carbon\Carbon::now()->diffInHours($reservation->confirmation->start_dt)/24)}}
                                                        일 후
                                                    @endif
                                                    투어 예정
                                                @endif
                                            </div>
                                        @else
                                            <div class="AppSdGothicNeoR">
                                                예약 확정 진행중
                                            </div>
                                        @endif
                                    @elseif(isset($reservation) && $reservation->order_status === '0')
                                        <div class="AppSdGothicNeoR">
                                            취소 처리
                                        </div>
                                    @else
                                        <div class="AppSdGothicNeoR">
                                            오류 문의 필요
                                        </div>
                                    @endif
                                @endif

                            @endif

                        </div>
                    </div>
                    <div class="flex AppSdGothicNeoR text-tm-c-30373F">
                        <div class="text-base 2xs:text-lg sm:text-xl">
                            {{$reservation->hotel->option->area}}
                        </div>
                        <div class="ml-auto text-xs 2xs:text-base sm:text-lg">
                            @if(isset($reservation->payment))
                                {{ \Carbon\Carbon::parse($reservation->payment->order_completed_at)->format('Y. m. d') }}
                                @if($reservation->payment->status==='3')
                                    결제완료
                                @endif
                            @else
                                {{ $reservation->created_at }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="py-6 sm:py-10">
                    <div>
                        <table
                            class="min-w-max w-full table-auto border-t-2 border-b-2 border-solid border-tm-c-30373F divide-y divide-tm-c-979b9f">
                            <thead>
                            <tr class="h-8 AppSdGothicNeoR text-tm-c-30373F divide-x divide-tm-c-979b9f">
                                <td class="font-bold px-3 sm:px-5">
                                    이름
                                </td>
                                <td class="px-3 sm:px-5">
                                    {{ $reservation->order_name }}
                                </td>
                                <td class="font-bold px-3 sm:px-5">
                                    주문번호
                                </td>
                                <td class="px-3 sm:px-5">
                                    {{ $reservation->order_id }}
                                </td>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-tm-c-979b9f">
                            <tr class="h-8 AppSdGothicNeoR text-tm-c-30373F divide-x divide-tm-c-979b9f">
                                <td class="font-bold px-3 sm:px-5">
                                    전화번호
                                </td>
                                <td class="px-3 sm:px-5">
                                    {{ phone($reservation->order_hp ?? '0', 'KR')->formatInternational() }}
                                </td>
                                <td class="font-bold px-3 sm:px-5">
                                    @if($reservation->isMonth())
                                        상품명
                                    @else
                                        투어 호텔
                                    @endif
                                </td>
                                <td class="px-3 sm:px-5">
                                    @if($reservation->isMonth())
                                        {{ $reservation->room->title ?? '정보없음'}}
                                    @else
                                        {{ $reservation->hotel->option->title ?? '정보없음'}}
                                    @endif
                                </td>
                            </tr>

                            @if($reservation->isMonth())
                                <tr class="h-8 AppSdGothicNeoR text-tm-c-30373F divide-x divide-tm-c-979b9f">
                                    <td class="font-bold px-3 sm:px-5">
                                        룸타입
                                    </td>
                                    <td class="px-3 sm:px-5">
                                        <div class="flex flex-wrap">
                                            <div
                                                class="pr-1 @if(isset($reservation->roomTypeUpgrade)) line-through @endif">
                                                {{ $reservation->roomType->name ?? '정보없음'}}
                                            </div>
                                            @isset($reservation->roomTypeUpgrade)
                                                <div class="relative">
                                                    {{ $reservation->roomTypeUpgrade->name }}
                                                    <div class="absolute top-0 right-0  -mr-3 rounded-full">
                                                        <div class="flex items-center justify-center">
                                                            <i class="fal fa-chevron-double-up text-xs text-tm-c-C1A485"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endisset
                                        </div>
                                    </td>
                                    <td class="font-bold px-3 sm:px-5">
                                        쿠폰/포인트
                                    </td>
                                    <td class="px-3 sm:px-5">
                                        준비중
                                    </td>
                                </tr>
                            @endif
                            @isset($reservation->payment)
                                <tr class="h-8 AppSdGothicNeoR text-tm-c-30373F divide-x divide-tm-c-979b9f">
                                    <td class="font-bold px-3 sm:px-5">
                                        지불방법
                                    </td>
                                    <td class="px-3 sm:px-5">
                                        {{--                                        카드 결제 방식 02=앱카드, 01=간편결제, 계좌이체,무통장입금--}}
                                        @switch($reservation->payment->card_type)
                                            @case('01')
                                            간편결제
                                            @break
                                            @case('02')
                                            사이트 결제
                                            @break
                                            @default
                                            {{$reservation->payment->card_type}}
                                        @endswitch
                                    </td>
                                    <td class="font-bold px-3 sm:px-5">
                                        결제금액
                                    </td>
                                    <td class="px-3 sm:px-5">
                                        {{ number_format($reservation->payment->total_price) }}
                                    </td>
                                </tr>
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>

                <style>
                    .fc .fc-prev-button.fc-button.fc-button-primary,
                    .fc .fc-next-button.fc-button.fc-button-primary {
                        background: #0d5e49;
                    }

                    .fc *,
                    .fc-theme-standard td, .fc-theme-standard th,
                    .fc-scrollgrid.fc-scrollgrid-liquid,
                    .fc-scrollgrid {
                        border: 0 !important;
                    }

                    .fc-scrollgrid-section.fc-scrollgrid-section-header.fc-scrollgrid-section-sticky > td {
                        background: none;
                    }
                </style>
                <div>
                    <div class="">
                        <div class="mx-auto max-w-6xl md:max-w-5xl w-full space-y-4">
                            <div class="flex items-center">
                                <div
                                    class="space-y-2 @if($calendarDisable==='0') text-white z-20 @else text-tm-c-30373F @endif">
                                    <div class="flex items-center AppSdGothicNeoR space-x-2">
                                        <div class="AppSdGothicNeoR font-bold">
                                            @if($reservation->isMonth())
                                                입주
                                            @else
                                                투어
                                            @endif
                                            @isset($reservation->confirmation)
                                                확정
                                            @endisset
                                            @empty($reservation->confirmation)
                                                희망
                                            @endempty
                                            날짜
                                        </div>
                                        <div class="flex items-center AppSdGothicNeoR space-x-2">
                                            @isset($reservation->confirmation)
                                                @if($reservation->type === 'month')
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('Y. m. d') }}
                                                    </div>
                                                    <div>
                                                        -
                                                    </div>
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->confirmation->end_dt ?? null)->format('Y. m. d') }}
                                                    </div>
                                                @else
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('Y년 m월 d일(요일) H시 i분') }}
                                                    </div>
                                                @endif
                                            @else
                                                @if($reservation->type === 'month')
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('Y. m. d') }}
                                                    </div>
                                                    <div>
                                                        -
                                                    </div>
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->addDays($reservation->room->nights)->format('Y. m. d') }}
                                                    </div>
                                                @else
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('Y년 m월 d일(요일) H시 i분') }}
                                                    </div>
                                                @endif
                                            @endisset
                                        </div>
                                    </div>
                                    @isset($reservation->reservationModify)
                                        <div class="flex items-center AppSdGothicNeoR space-x-2">
                                            <div class="AppSdGothicNeoR font-bold">
                                                @if($reservation->isMonth())
                                                    입주
                                                @else
                                                    투어
                                                @endif
                                                변경 희망
                                            </div>
                                            <div class="flex items-center AppSdGothicNeoR space-x-2">
                                                @if($reservation->isMonth())
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('Y. m. d') }}
                                                    </div>
                                                    <div>
                                                        -
                                                    </div>
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->reservationModify->end_dt ?? null)->format('Y. m. d') }}
                                                    </div>
                                                @endif
                                                @if($reservation->isTour())
                                                    <div>
                                                        {{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('Y년 m월 d일(요일) H시 i분') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                                {{--                                     취소신청내역 없고, 확정되었고, 입주 3일 전일 경우 가능--}}
                                @if( \App\ReservationModify::where('user_id','=',auth()->user()->id)->where('reservation_id','=',$reservation->id)->count()===0
                                    && \App\ReservationCancel::where('user_id','=',auth()->user()->id)->where('reservation_id','=',$reservation->id)->where('process','!=','0')->count()===0
                                    && ( (isset($reservation->confirmation) && $reservation->confirmation->status !=='0' && \Carbon\Carbon::now()->format('Ymd') < \Carbon\Carbon::parse($reservation->confirmation->start_dt)->format('Ymd') && \Carbon\Carbon::now()->diffInMinutes($reservation->confirmation->start_dt)>=4320)
                                    || (  /* 입주는 확정 안됬을경우 3일 전 까지 변경*/
                                        $reservation->isMonth() && (
                                            (empty($reservation->confirmation) && \Carbon\Carbon::now()->format('Ymd') < \Carbon\Carbon::parse($reservation->order_desired_dt)->format('Ymd') && \Carbon\Carbon::now()->diffInMinutes($reservation->order_desired_dt)>=4320)
                                        )
                                        )
                                    || ( /* 투어는 확정됬을경우 & 미확정인경우 도 1일 전이면 변경 가능 */
                                        $reservation->isTour() && (
                                        (empty($reservation->confirmation) && \Carbon\Carbon::now()->format('Ymd') < \Carbon\Carbon::parse($reservation->order_desired_dt)->format('Ymd') && \Carbon\Carbon::now()->diffInMinutes($reservation->order_desired_dt)>=1440)
                                        || (isset($reservation->confirmation) && \Carbon\Carbon::now()->format('Ymd') < \Carbon\Carbon::parse($reservation->confirmation->start_dt)->format('Ymd') && \Carbon\Carbon::now()->diffInMinutes($reservation->confirmation->start_dt)>=1440)
                                        )
                                        )
                                      ))
                                    <div
                                        class="ml-auto @if($calendarDisable==='0') text-white z-20 @else text-tm-c-0D5E49 @endif">
                                        <div class="AppSdGothicNeoR font-medium text-sm underline cursor-pointer"
                                             wire:click="calendarChangeStat('{{$calendarDisable}}')">
                                            @if($calendarDisable!=='1')
                                                취소하기
                                            @else
                                                변경 신청하기
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="py-4">
                                <div class="block md:flex md:flex-wrap space-y-2 md:space-y-0 space-x-0 md:space-x-4">
                                    @if($reservation->type === 'month')
                                        <div class="w-full flex-1 @if($calendarDisable==='0') z-20 @endif">
                                            <div class="bg-white rounded-sm shadow-2xl h-full">

                                                <div class="max-h-full h-full p-2">
                                                    @if( \App\ReservationModify::where('user_id','=',auth()->user()->id)->where('reservation_id','=',$reservation->id)->count()>=1)
                                                        <livewire:calendar.reservation.modify type="start"
                                                                                              :reservation="$reservation"
                                                                                              startYear="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('Y')}}"
                                                                                              startMonth="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('m')}}"
                                                                                              startDate="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('d')}}"
                                                                                              endYear="{{ \Carbon\Carbon::parse($reservation->reservationModify->end_dt ?? null)->format('Y')}}"
                                                                                              endMonth="{{ \Carbon\Carbon::parse($reservation->reservationModify->end_dt ?? null)->format('m')}}"
                                                                                              endDate="{{ \Carbon\Carbon::parse($reservation->reservationModify->end_dt ?? null)->format('d')}}"
                                                        ></livewire:calendar.reservation.modify>
                                                    @elseif($reservation->confirmations->count() >= 1)
                                                        <livewire:calendar.reservation.modify type="start"
                                                                                              :reservation="$reservation"
                                                                                              startYear="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('Y')}}"
                                                                                              startMonth="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('m')}}"
                                                                                              startDate="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('d')}}"
                                                                                              endYear="{{ \Carbon\Carbon::parse($reservation->confirmation->end_dt ?? null)->format('Y')}}"
                                                                                              endMonth="{{ \Carbon\Carbon::parse($reservation->confirmation->end_dt ?? null)->format('m')}}"
                                                                                              endDate="{{ \Carbon\Carbon::parse($reservation->confirmation->end_dt ?? null)->format('d')}}"
                                                        ></livewire:calendar.reservation.modify>
                                                    @elseif($reservation->confirmations->count() === 0)
                                                        <livewire:calendar.reservation.modify type="start"
                                                                                              :reservation="$reservation"
                                                                                              startYear="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('Y')}}"
                                                                                              startMonth="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('m')}}"
                                                                                              startDate="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('d')}}"
                                                                                              endYear="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->addDays($reservation->room->nights)->format('Y')}}"
                                                                                              endMonth="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->addDays($reservation->room->nights)->format('m')}}"
                                                                                              endDate="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->addDays($reservation->room->nights)->format('d')}}"
                                                        ></livewire:calendar.reservation.modify>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full flex-1 @if($calendarDisable==='0') z-20 @endif">
                                            <div class="bg-white rounded-sm shadow-2xl h-full">
                                                <div class="max-h-full h-full p-2">
                                                    @if( \App\ReservationModify::where('user_id','=',auth()->user()->id)->where('reservation_id','=',$reservation->id)->count()===1)
                                                        <livewire:calendar.reservation.modify type="end"
                                                                                              :reservation="$reservation"
                                                                                              startYear="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('Y')}}"
                                                                                              startMonth="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('m')}}"
                                                                                              startDate="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('d')}}"
                                                                                              endYear="{{ \Carbon\Carbon::parse($reservation->reservationModify->end_dt ?? null)->format('Y')}}"
                                                                                              endMonth="{{ \Carbon\Carbon::parse($reservation->reservationModify->end_dt ?? null)->format('m')}}"
                                                                                              endDate="{{ \Carbon\Carbon::parse($reservation->reservationModify->end_dt ?? null)->format('d')}}"
                                                        ></livewire:calendar.reservation.modify>
                                                    @elseif($reservation->confirmations->count()>=1)
                                                        <livewire:calendar.reservation.modify type="end"
                                                                                              :reservation="$reservation"
                                                                                              startYear="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('Y')}}"
                                                                                              startMonth="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('m')}}"
                                                                                              startDate="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('d')}}"
                                                                                              endYear="{{ \Carbon\Carbon::parse($reservation->confirmation->end_dt ?? null)->format('Y')}}"
                                                                                              endMonth="{{ \Carbon\Carbon::parse($reservation->confirmation->end_dt ?? null)->format('m')}}"
                                                                                              endDate="{{ \Carbon\Carbon::parse($reservation->confirmation->end_dt ?? null)->format('d')}}"
                                                        ></livewire:calendar.reservation.modify>
                                                    @elseif($reservation->confirmations->count() === 0)
                                                        <livewire:calendar.reservation.modify type="end"
                                                                                              :reservation="$reservation"
                                                                                              startYear="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('Y')}}"
                                                                                              startMonth="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('m')}}"
                                                                                              startDate="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('d')}}"
                                                                                              endYear="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->addDays($reservation->room->nights)->format('Y')}}"
                                                                                              endMonth="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->addDays($reservation->room->nights)->format('m')}}"
                                                                                              endDate="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->addDays($reservation->room->nights)->format('d')}}"
                                                        ></livewire:calendar.reservation.modify>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else {{-- 투어 변경 calendar --}}
                                    <div class="w-full flex-1 @if($calendarDisable==='0') z-20 @endif">
                                        <div class="bg-white rounded-sm shadow-2xl h-full">
                                            <div class="max-h-full h-full p-2">
                                                @if( \App\ReservationModify::where('user_id','=',auth()->user()->id)->where('reservation_id','=',$reservation->id)->count()===1)
                                                    <livewire:calendar.reservation.modify type="start"
                                                                                          :reservation="$reservation"
                                                                                          startYear="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('Y')}}"
                                                                                          startMonth="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('m')}}"
                                                                                          startDate="{{ \Carbon\Carbon::parse($reservation->reservationModify->start_dt ?? null)->format('d')}}"
                                                    ></livewire:calendar.reservation.modify>
                                                @elseif($reservation->confirmations->count()>=1)
                                                    <livewire:calendar.reservation.modify type="start"
                                                                                          :reservation="$reservation"
                                                                                          startYear="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('Y')}}"
                                                                                          startMonth="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('m')}}"
                                                                                          startDate="{{ \Carbon\Carbon::parse($reservation->confirmation->start_dt ?? null)->format('d')}}"
                                                    ></livewire:calendar.reservation.modify>
                                                @elseif(empty($reservation->confirmation))
                                                    <livewire:calendar.reservation.modify type="start"
                                                                                          :reservation="$reservation"
                                                                                          startYear="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('Y')}}"
                                                                                          startMonth="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('m')}}"
                                                                                          startDate="{{ \Carbon\Carbon::parse($reservation->order_desired_dt ?? null)->format('d')}}"
                                                    ></livewire:calendar.reservation.modify>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="flex">
        <div class="text-tm-c-C1A485 text-base font-medium leading-normal">
            * 예약 확정 후 결제 취소/날짜 변경을 원할 시 고객센터로 문의 바랍니다.
        </div>

        <div class="ml-auto flex space-x-2">
            {{--            <div class="w-full w-max-content py-4 px-6 md:px-10 border border-solid border-tm-c-C1A485 cursor-pointer">--}}
            {{--                <div class="AppSdGothicNeoR text-lg text-tm-c-C1A485">연장 신청</div>--}}
            {{--            </div>--}}
            {{--
            @if($reservation->confirmation->start_dt <= \Carbon\Carbon::now())
                                                      투어 완료
                                                  @elseif($reservation->confirmation->start_dt >= \Carbon\Carbon::now())
                                                  --}}
            @if($reservation->order_status !== '0'
              && \App\ReservationCancel::where('user_id', '=', auth()->user()->id)->where('reservation_id', '=', $reservation->id)->where('process','!=','0')->count()===0
              && ( (isset($reservation->confirmation) && $reservation->confirmation->start_dt >= \Carbon\Carbon::now()) || empty($reservation->confirmation) ))
                <div
                    class="w-full w-max-content py-4 px-6 md:px-10 border border-solid border-tm-c-C1A485 rounded-sm cursor-pointer"
                    onclick="confirm('@isset($reservation->payment)결제@else주문@endisset 취소 신청하시겠습니까?\n취소 신청 후 호텔에삶 매니저가 취소를 도와드립니다 :)\n※ 취소 신청 기간에 따라 환불금 발생할 수 있습니다.')
                        || event.stopImmediatePropagation()"
                    wire:click="reservationCancel('{{$reservation->id}}')">
                    <div class="AppSdGothicNeoR text-lg text-tm-c-C1A485">
                        @if($reservation->isMonth()) 입주 @endif
                        @if($reservation->isTour()) 투어 @endif
                        취소 신청
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div x-data="{show : '{{$calendarDisable}}'}" x-show="show==='0'" x-cloak
         class="popup_background absolute top-0 left-0 w-full h-full bg-black bg-opacity-75"></div>
</div>
<script>
    var timer = true;
    $(window).resize(function () {
        documentHeightCheck();
    });
    $(window).scroll(function () {
        documentHeightCheck();
    });
    window.onload = function () {
        documentHeightCheck();
    };
    window.addEventListener('documentHeightCheck', event => {
        $('.popup_background').height($(document).height());
    });

    function documentHeightCheck() {
        if (timer) {
            timer = false;
            setTimeout(function () {
                $('.popup_background').height($(document).height());
                timer = true;
            }, 500);
        }
    }
</script>
