<div class="divide-y-2 divide-gray-400">
@if($reservation->type === 'month')
    <div>
        @switch($reservation->order_status)
            @case('3') @case('5')
            주문 완료
            @break
            @case('0')
            주문  취소
            @break
            @case('10')
            주문 부분취소
            @break
            @case('11')
            중도퇴실
            @break
        @endswitch
    </div>
    @if($reservation->payments->count()>=1)
        @if($reservation->payment->status === '3')
            <div>
                결제 완료
            </div>
        @else
            <div>
                결제 취소
            </div>
        @endif
    @endif
    @if($reservation->confirmations->count()>=1)
        @if($reservation->confirmation->status === '1')
            <div>
                확정 완료
            </div>
        @elseif($reservation->confirmation->status === '0')
            <div>
                확정 취소
            </div>
        @endif
    @else
        <div>
            확정 진행 필요
        </div>
    @endif

@elseif($reservation->type === 'tour')

    <div>
        @switch($reservation->order_status)
            @case('2') @case('3') @case('5')
            주문 완료
            @break
            @case('0')
            주문 취소
            @break
            @default
            주문 오류
        @endswitch
    </div>
    @if($reservation->confirmations->count()>=1)
        @if($reservation->confirmation->status === '1')
            <div>
                확정 완료
            </div>
        @elseif($reservation->confirmation->status === '0')
            <div>
                확정 취소
            </div>
        @endif
    @else
        <div>
            확정 진행 필요
        </div>
    @endif

@else
    <div>
        오류
    </div>
@endif

</div>
