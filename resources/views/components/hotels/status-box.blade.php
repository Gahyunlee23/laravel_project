<div x-data="{optionShow : false}" @custom-event-page-change.window="optionShow=false">
    @if($reservation->status === '입주 확정 필요' || $reservation->status === '투어 확정 필요' || $reservation->status === '투어 완료')
        @if((isset($reservation->external) && $reservation->external->status === '0') || $reservation->status === '투어 완료')
            <div class="relative">
                <div class="flex justify-center items-center font-bold text-tm-c-30373F cursor-pointer space-x-1"
                     @click="optionShow = !optionShow;">
                    <div class="whitespace-pre">{{$reservation->status}}</div>
                    <div class="border-solid border-black"
                         :class="{'border-b-4 border-l-4 border-r-4 sm:border-b-6 sm:border-l-6 sm:border-r-6' : optionShow === true,
                          'border-t-4 border-l-4 border-r-4 sm:border-t-6 sm:border-l-6 sm:border-r-6' : optionShow === false}"
                         style="width: 0;height: 0;border-left-color: transparent;border-right-color: transparent;"></div>
                </div>
                <div class="mt-1 mx-auto bg-white max-w-4xs" x-show="optionShow===true" x-cloak>
                    @if($reservation->status !== '투어 완료')
                        <div
                            class="AppSdGothicNeoR py-1 text-sm text-tm-c-30373F border-t border-solid border-tm-c-30373F cursor-pointer"
                            @if($reservation->type === 'tour')
                            onclick="confirm('투어 확정 처리 시 고객에게 확정 알림톡 전송됩니다.') || event.stopImmediatePropagation()"
                            @elseif($reservation->type === 'month')
                            onclick="confirm('입주 확정 필요 시 호텔에삶 관리자가 입주 확정 진행합니다.') || event.stopImmediatePropagation()"
                            @endif
                            wire:click="reservationStatus({{$reservation->id}}, '확정')">확정
                        </div>
                        <div
                            class="AppSdGothicNeoR py-1 text-sm text-tm-c-30373F border-t border-solid border-tm-c-30373F cursor-pointer"
                            @if($reservation->type === 'tour')
                            onclick="confirm('투어 변경 필요 시 호텔에삶 관리자가 확인 후 변경 진행합니다.') || event.stopImmediatePropagation()"
                            @elseif($reservation->type === 'month')
                            onclick="confirm('입주 변경 필요 시 호텔에삶 관리자가 확인 후 변경 진행합니다.') || event.stopImmediatePropagation()"
                            @endif
                            wire:click="reservationStatus({{$reservation->id}}, '변경 필요')">변경 필요
                        </div>
                    @else
                        <div
                            class="AppSdGothicNeoR py-1 text-sm text-tm-c-da5542 border-t border-solid border-tm-c-30373F cursor-pointer"
                            onclick="confirm('확인 시 투어 노쇼 처리됩니다.') || event.stopImmediatePropagation()"
                            wire:click="reservationStatus({{$reservation->id}}, 'no-show')">no-show
                        </div>
                    @endif
                </div>
            </div>
        @else
            @if(!isset($reservation->external))
                <div class="whitespace-pre text-tm-c-979b9f font-bold">진행 취소</div>
            @else
                @if($reservation->status === '투어 확정 필요')
                    <div class="whitespace-pre text-tm-c-979b9f font-bold">변경 진행</div>
                @elseif($reservation->status === '입주 확정 필요')
                    <div class="whitespace-pre text-tm-c-979b9f font-bold">확정 진행 중</div>
                @else
                    <div class="whitespace-pre text-tm-c-979b9f font-bold">진행중-{{$reservation->status}}</div>
                @endif
            @endif
        @endif
    @else
        @if($reservation->status==='투어 노쇼')
            <div class="whitespace-pre text-tm-c-da5542">no-show</div>
        @else
            <div class="whitespace-pre text-tm-c-979b9f">{{$reservation->status}}</div>
        @endif
    @endif
</div>
