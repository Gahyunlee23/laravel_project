<div>
    @inject('formatter', 'App\Formatter')
    <div class="bg-tm-c-ED rounded-sm p-6">
        <div class="flex flex-wrap">
            <div class="flex-1">
                <div class="flex pb-2 space-x-2 items-center">
                    @if(!isset($list->read_at))
                        <div class=" flex items-center bg-tm-c-da5542 rounded-md">
                            <div class="py-px px-1 text-white text-sm leading-5">New</div>
                        </div>
                    @endif
                    <div class="AppSdGothicNeoR text-tm-c-979b9f text-sm">
                        {{ \Carbon\Carbon::parse($list->created_at)->format('Y. m. d H:i:s')}}
                    </div>
                </div>

                <div class="">
                    <div class="space-y-2">
                        <div class="AppSdGothicNeoR font-bold text-black text-xl flex items-center">
                            @if($list->order_status !== '0')
                                @if(isset($list->reservationCancel) && $list->reservationCancel->process !== '0')
                                    <x-switch.reservation-cancel.process process="{{$list->reservationCancel->process}}" default="관리자에게 문의 바랍니다."></x-switch.reservation-cancel.process>
                                @else
                                    @if(isset($list->confirmation))
                                        @if($list->confirmation->start_dt <= \Carbon\Carbon::now()
                                                && $list->confirmation->end_dt >= \Carbon\Carbon::now())
                                            입주 중
                                        @elseif($list->confirmation->start_dt <= \Carbon\Carbon::now()
                                            && $list->confirmation->end_dt <= \Carbon\Carbon::now())
                                            퇴실 완료
                                        @elseif($list->confirmation->start_dt >= \Carbon\Carbon::now())
                                            입주 예정
                                        @endif
                                    @else
                                        입주 확정 진행 중
                                    @endif
                                @endif
                            @else
                                취소 완료
                            @endif
                        </div>
                        <div class="AppSdGothicNeoR text-base text-black leading-tight px-1">
                            @if($list->order_status !== '0')
                                @if(isset($list->reservationCancel) && $list->reservationCancel->where('process','!=','0')->count() !== 0)
                                    @switch($list->reservationCancel->process)
                                        @case('1')
                                        {{-- 취소 신청 완료 --}}
                                        {{$list->hotel->option->title}} 호텔 예약 취소 신청이 완료되었습니다.<br>
                                        호텔에삶 팀이 신속히 확인 후, 안내해 드리겠습니다.<br>
                                        * 취소 및 환불 규정에 의거하여 수수료가 발생할 수 있습니다
                                        @break
                                        @case('2')
                                        {{-- 취소 확인 중 --}}
                                        호텔에삶 팀에서 취소 확인 중입니다.
                                        @break
                                        @case('3')
                                        {{-- 취소 승인 --}}
                                        {{$list->hotel->option->title}} 호텔 예약 취소 승인이 완료되었습니다.<br>
                                        카드사에 따라 환불 처리가 1~3일 소요될 수 있습니다.<br>
                                        (계좌이체는 취소 승인 당일 내 입금 예정입니다.)<br>
                                        더 좋은 서비스로 다시 뵙겠습니다.
                                        @break
                                        @case('4')
                                        {{-- 취소 반려 --}}
                                        {{$list->hotel->option->title}} 호텔 예약 취소가 반려되었습니다.<br>
                                        호텔에삶 팀에서 별도 연락 드리도록 하겠습니다.
                                        @break

                                        @default
                                        호텔에삶 고객센터로 문의 바랍니다.
                                    @endswitch
                                @else
                                    @if(isset($list->confirmation))
                                        {{-- 확정 --}}
                                        @if($list->confirmation->start_dt <= \Carbon\Carbon::now()
                                                && $list->confirmation->end_dt >= \Carbon\Carbon::now())
                                            {{-- 입주 중 --}}
                                            @if(\Carbon\Carbon::parse($list->confirmation->end_dt)->diffInMinutes(now())/60 <= 24 &&
                                                \Carbon\Carbon::parse($list->confirmation->end_dt)->diffInMinutes(now())>=1)
                                                {{-- 퇴실 : 당일 --}}
                                                {{$list->hotel->option->title}} 에서의 호텔에삶 마지막 날 입니다.<br>
                                                그동안 포근하고 특별한 시간이 되셨길 바랍니다.<br>
{{--                                                <br>--}}
{{--                                                더 좋은 서비스 제공을 위하여 호텔에삶 후기를 남겨 주시겠어요?<br>--}}
{{--                                                후기를 남겨 주신 고객님께는 추후 포인트가 적립됩니다.<br>--}}
                                                <br>
                                                전국으로 뻗어 나가는 호텔에삶, 기대해 주세요!<br>
                                            @elseif(\Carbon\Carbon::parse($list->confirmation->end_dt)->diffInMinutes(now())/60 > 24 &&
                                                \Carbon\Carbon::parse($list->confirmation->end_dt)->diffInMinutes(now())/60/24 < 2)
                                                {{-- 퇴실 : 1일 이상 ~ 2일 미만--}}
                                                {{$list->hotel->option->title}} 에서의 호텔에삶이 단 하루 밖에 남지 않았습니다.<br>
                                                연장을 원하시면 투숙 중이신 객실이 마감되기 전에 서둘러 주세요!<br>
                                                <br>
                                                * 호텔 예약 현황에 따라 체크아웃 당일에는 연장 신청이 어려울 수 있습니다.
                                            @elseif (\Carbon\Carbon::parse($list->confirmation->end_dt)->diffInMinutes(now())/60/24 >= 2 &&
                                                \Carbon\Carbon::parse($list->confirmation->end_dt)->diffInMinutes(now())/60/24 < 15)
                                                {{-- 퇴실 : 3일 이상 ~ 15일 미만--}}
                                                {{$list->hotel->option->title}} 에서의 호텔에삶이 벌써 {{number_format(\Carbon\Carbon::parse($list->confirmation->end_dt)->diffInMinutes(now())/60/24)}}일 밖에 남지 않았습니다.<br>
                                                연장을 원하시면 투숙 중이신 객실이 마감되기 전에 서둘러 주세요!<br>
                                                * 호텔 예약 현황에 따라 체크아웃 당일에는 연장 신청이 어려울 수 있습니다.
                                            @else
                                                호텔에삶을 이용해 주셔서 다시 한번 감사드립니다.<br>
                                                {{$list->hotel->option->title}} 호텔에서의 투숙은 편안하신가요?<br>
                                                <br>
                                                추가 요청사항 혹은 불편사항이 있으신 경우,<br>
                                                언제든 문의바랍니다.
                                            @endif
                                        @elseif($list->confirmation->start_dt <= \Carbon\Carbon::now()
                                            && $list->confirmation->end_dt <= \Carbon\Carbon::now())
                                            {{-- 퇴실 완료 --}}
                                            {{$list->hotel->option->title}} 호텔에서의 호텔에삶은 어떠셨나요?<br>
                                            다른 호텔에삶도 확인해보세요.
                                        @elseif($list->confirmation->start_dt >= \Carbon\Carbon::now())
                                            {{-- 입주 전 확정 완료 시 --}}
                                            {{$list->hotel->option->title}} 호텔 입주가 확정되었습니다.<br>
                                            기다려 주셔서 대단히 감사합니다.<br>
                                            <br>
                                            매일이 특별한 호텔에삶을 기대해 주세요!
                                        @endif
                                    @else
                                        {{-- 입주 확정 진행 중 --}}
                                        {{$list->hotel->option->title}} 호텔에삶을 이용해 주셔서 감사합니다.<br>
                                        현재 입주 예약이 진행 중입니다.<br>
                                        <br>
                                        입주 확정이 결제 후, 24시간 이내에 이루어 집니다.<br>
                                        조금만 기다려 주세요!
                                    @endif
                                @endif
                            @else
                                {{$list->hotel->option->title}} 호텔 예약 취소 되었습니다.
                            @endif
                        </div>
                    </div>

                    @if($list->order_status !== '0')
                        <div class="table text-tm-c-30373F pt-4 space-y-1">
                            @if(isset($list->confirmation))
                                @if($list->confirmation->start_dt !== null)
                                    <div class="AppSdGothicNeoR flex space-x-2 items-center px-1">
                                        <div class="text-sm">
                                            입주예정
                                        </div>
                                        <div>
                                            {{ $formatter->carbonFormat($list->confirmation->start_dt ?? null ,'Y년 m월 d일(요일) H시 i분') ?? '' }}
                                        </div>
                                    </div>
                                @endif
                                @if($list->confirmation->end_dt !== null)
                                    <div class="AppSdGothicNeoR flex space-x-2 items-center px-1">
                                        <div class="text-sm">
                                            퇴실예정
                                        </div>
                                        <div>
                                            {{ $formatter->carbonFormat($list->confirmation->end_dt ?? null ,'Y년 m월 d일(요일) H시 i분') ?? '' }}
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="AppSdGothicNeoR flex space-x-2 items-center px-1">
                                    <div class="text-sm">
                                        입주희망
                                    </div>
                                    <div>
                                        {{ $formatter->carbonFormat($list->order_desired_dt ?? null ,'Y년 m월 d일(요일) H시 i분') ?? '' }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>

            </div>

            <div class="ml-auto table text-black space-y-1">
                <div>
                    @if($list->read_at !== null)
                        <div class="AppSdGothicNeoR">
                            <div class="w-full w-max-content text-sm text-tm-c-979b9f cursor-pointer"
                                 wire:click="read('cancel',{{$list->id}})">
                                읽음
                            </div>
                        </div>
                    @else
                        <div class="AppSdGothicNeoR">
                            <div class="w-full w-max-content text-sm text-tm-c-30373F cursor-pointer underline"
                                 wire:click="read('read',{{$list->id}})">
                                읽음 표시
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="pt-2 flex">
            <div class="flex items-center ml-auto space-x-2">
                @if($list->order_status === '0' && isset($list->payment))
                    {{--카드 결제 방식 02=앱카드, 01=간편결제, 계좌이체,무통장입금--}}
                    <div class="pl-2 font-normal text-xs 2xs:text-sm text-tm-c-979b9f">
                    @switch($list->payment->card_type)
                        @case('02')
                        @case('01')
                            카드사 취소완료일로부터 + 5 ~ 7 영업일 소요될 수 있습니다.
                        @break
                        @case('계좌이체')
                            영업일 기준 취소 완료일로부터 + 1 ~ 3 영업일 소요될 수 있습니다.
                        @break
                        @case('무통장입금')
                            영업일 기준 취소 완료일로부터 + 1 ~ 3 영업일 소요될 수 있습니다.
                        @break
                        @default
                            영업일 기준 취소 완료일로부터 + 1 ~ 3 영업일 소요될 수 있습니다.
                    @endswitch
                    </div>
                @else
                    @isset($list->hotel->info_notion)
                        <a target="_blank" class=""
                           href="{{secure_url($list->hotel->info_notion)}}">
                            <div class="py-3 px-6 bg-tm-c-C1A485 rounded-sm text-white">
                                호텔 이용 가이드
                            </div>
                        </a>
                    @endisset
                    @hasrole('super-admin')
                        @if( $list->order_status !== '0' || (isset($list->reservationCancel) && $list->reservationCancel->where('process','!=','0')->count() === 0))
                            <div class="text-black">
                                <a onclick="event.preventDefault();document.getElementById('reservation-modify-form-{{$list->id}}').submit();"
                                   class="cursor-pointer">
                                    <div class="py-3 px-6 bg-tm-c-C1A485 rounded-sm text-white">
                                        예약 상세 바로가기
                                    </div>
                                </a>
                                <form id="reservation-modify-form-{{$list->id}}"
                                      action="{{ route('my-page.reservation.modify',['reservation'=>$list->id]) }}"
                                      method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endif
                    @endhasrole
                @endif

            </div>
        </div>

    </div>
</div>
