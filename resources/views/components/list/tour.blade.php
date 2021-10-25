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
                <div class="space-y-2">
                    @if(isset($list->confirmation))

                        @if($list->order_status !== '0')
                            {{-- 확정 후 --}}
                            @if($list->confirmation->start_dt <= \Carbon\Carbon::now())
                                {{-- 투어 시작 시간이 지난 경우 --}}
                                <div class="AppSdGothicNeoR text-black text-lg font-bold flex items-center">
                                    투어 완료
                                    @if(isset($list->confirmation->start_dt) && $list->confirmation->start_dt!==null)
                                        <span class="font-normal text-sm ml-1">{{$formatter->carbonFormat($list->confirmation->start_dt,'Y년 m월 d일(요일) H시 i분')}}</span>
                                    @endif
                                </div>
                                <div class="AppSdGothicNeoR text-base text-black leading-tight px-1">
                                    {{$list->hotel->option->title}} 투어가 종료되었습니다.<br>
                                    투어는 어떠셨나요?<br>
                                    <br>
                                    투어 후, 입주를 원하실 시 하단의 링크를 통해 신청이 가능합니다.
                                </div>
                            @elseif($list->confirmation->start_dt >= \Carbon\Carbon::now())
                                @if (\Carbon\Carbon::parse($list->confirmation->start_dt)->diffInMinutes(now())/60/24 <= 3 &&
                                                \Carbon\Carbon::parse($list->confirmation->start_dt)->diffInMinutes(now())>=1)
                                    {{-- 투어 당일 --}}
                                    <div class="AppSdGothicNeoR text-black text-lg font-bold flex items-center">
                                        투어 진행 예정
                                        @if(isset($list->confirmation->start_dt) && $list->confirmation->start_dt!==null)
                                            <span class="font-normal text-sm ml-1">{{$formatter->carbonFormat($list->confirmation->start_dt,'Y년 m월 d일(요일) H시 i분')}}</span>
                                        @endif
                                    </div>
                                    <div class="AppSdGothicNeoR text-base text-black leading-tight px-1">
                                         드디어 {{$list->hotel->option->title}} 투어가 시작 {{number_format(\Carbon\Carbon::parse($list->confirmation->start_dt)->diffInMinutes(now())/60)}}시간 전 입니다!<br>
                                        <br>
                                        즐거운 투어 되시기 바라며,<br>
                                        부득이하게 투어 진행이 불가할 경우 호텔에삶 고객센터에 전달해 주세요.
                                    </div>
                                @elseif (\Carbon\Carbon::parse($list->confirmation->start_dt)->diffInMinutes(now())/60/24 > 3)
                                    {{-- 투어 시작 시간이 아직 안 지난 경우 --}}
                                    <div class="AppSdGothicNeoR text-black text-lg font-bold flex items-center">
                                        투어 예정
                                        @if(isset($list->confirmation->start_dt) && $list->confirmation->start_dt!==null)
                                            <span class="font-normal text-sm ml-1">{{$formatter->carbonFormat($list->confirmation->start_dt,'Y년 m월 d일(요일) H시 i분')}}</span>
                                        @endif
                                    </div>
                                    <div class="AppSdGothicNeoR text-base text-black leading-tight px-1">
                                        {{$list->hotel->option->title}} 호텔 투어를 신청해 주셔서 감사합니다.<br>
                                        고객님께서 신청하신 호텔 투어가 곧 시작됩니다!<br>
                                        호텔 투어는 총 20분 내외로 진행됩니다.<br>
                                        해당 시간 담당자께서 대기 중이므로, 부득이하게 신청 일자에 방문이 불가한 경우 문의 부탁드립니다.
                                    </div>
                                @endif

                            @endif
                        @else
                            {{-- 확정 후 > 취소 --}}
                            <div class="AppSdGothicNeoR text-black text-lg font-bold flex items-center">
                                투어 취소
                                @if(isset($list->confirmation->start_dt) && $list->confirmation->start_dt!==null)
                                    <span class="font-normal text-sm ml-1">{{$formatter->carbonFormat($list->confirmation->start_dt,'Y년 m월 d일(요일) H시 i분')}}</span>
                                @endif
                            </div>
                            <div class="AppSdGothicNeoR text-base text-black leading-tight px-1">
                                {{$list->hotel->option->title}} 투어 취소 신청이 완료되었습니다.<br>
                                <br>
                                더 좋은 서비스로 다시 만나요!
                            </div>
                        @endif

                    @else
                        {{-- 투어 미확정 중 --}}
                        <div class="AppSdGothicNeoR text-black text-lg font-bold flex items-center">
                            투어 미확정
                            @if(isset($list->order_desired_dt) && $list->order_desired_dt!==null)
                                <span class="font-normal text-sm ml-1">{{$formatter->carbonFormat($list->order_desired_dt,'Y년 m월 d일(요일) H시 i분')}}</span>
                            @endif
                        </div>
                        <div class="AppSdGothicNeoR text-base text-black leading-tight px-1">
                            {{$list->hotel->option->title}} 호텔 투어를 신청해 주셔서 감사합니다.<br>
                            현재 호텔에서 투어 가능 여부를 확인 중입니다.<br>
                            <br>
                            투어 확정 여부가 24시간 이내로 전달될 예정입니다.<br>
                            조금만 기다려 주세요!
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


            <div class="pt-3 flex">
                <div class="flex items-center ml-auto space-x-2">
                    @if($list->order_status !== '0')
                        <div class="text-black">
                            <a onclick="kakaoOnetoOne();"
                               class="cursor-pointer">
                                <div class="py-3 px-6 bg-tm-c-C1A485 rounded-sm text-white leading-4 text-sm">
                                    @if(isset($list->confirmation))
                                            {{-- 확정 후 --}}
                                        @if($list->confirmation->start_dt <= \Carbon\Carbon::now())
                                            {{-- 투어 시작 시간이 지난 경우 --}}
                                            입주 문의 하기
                                        @elseif($list->confirmation->start_dt >= \Carbon\Carbon::now())
                                            @if (\Carbon\Carbon::parse($list->confirmation->start_dt)->diffInMinutes(now())/60/24 <= 3 &&
                                                            \Carbon\Carbon::parse($list->confirmation->start_dt)->diffInMinutes(now())>=1)
                                                {{-- 투어 당일 --}}
                                                투어 불가 문의
                                            @elseif (\Carbon\Carbon::parse($list->confirmation->start_dt)->diffInMinutes(now())/60/24 > 3)
                                                {{-- 투어 시작 시간이 아직 안 지난 경우 --}}
                                                투어 취소 문의
                                            @endif
                                        @endif
                                    @else
                                        {{-- 투어 미확정 중 --}}
                                        고객센터 문의하기
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endif
                    @hasrole('super-admin')
                        @if( $list->order_status !== '0' || (isset($list->reservationCancel) && $list->reservationCancel->where('process','!=','0')->count() === 0))
                        <div class="text-black">
                            <a onclick="event.preventDefault();document.getElementById('reservation-modify-form-{{$list->id}}').submit();"
                               class="cursor-pointer">
                                <div class="py-3 px-6 bg-tm-c-C1A485 rounded-sm text-white leading-4 text-sm">
                                    투어 상세 바로가기
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
                </div>
            </div>

    </div>
</div>
