<div>
    <div class="bg-tm-c-ED rounded-sm">
        <div class="flex p-6">
            <div>
                <div class="flex pb-2 space-x-2 items-center">
                    @if(!isset($list->read_at))
                        <div class="flex items-center bg-tm-c-da5542 rounded-md">
                            <div class="py-px px-1 text-white text-sm leading-5">New</div>
                        </div>
                    @endif
                    <div class="AppSdGothicNeoR text-tm-c-979b9f text-sm">
                        @isset($list->created_at)
                            {{ \Carbon\Carbon::parse($list->created_at)->format('Y. m. d H:i:s')}}
                        @endisset
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="AppSdGothicNeoR text-black text-lg font-bold flex items-center">
                        @switch($list->catalog)
                            @case('입주 전')
                            @case('입주 1일 후')
                            @case('퇴실 전')
                            @case('퇴실 후')
                            @case('투어 후')
                            {{$list->catalog}} 안내
                            @break
                            @case('투어 재확인')
                            투어 하루 전
                            @break
                            @case('투어 재재확인')
                            곧 투어 시작
                            @break
                            @case('주문 취소, 변경')
                            @if(Str::of($list->template)->contains('취소되었습니다.'))
                                예약 취소
                            @elseif(Str::of($list->template)->contains('변경되었습니다.'))
                                예약 변경
                            @else
                                취소 또는 변경
                            @endif
                            @break
                            @default
                            {{$list->catalog}}
                        @endswitch
                    </div>
                    <div class="AppSdGothicNeoR text-base text-black whitespace-pre-line leading-tight px-1"
                    >{{ $list->template }}</div>
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
    </div>
</div>
