<div>
    @if($reservation->type ==='month')
        @if($reservation->confirmations->count()>=1)
            @switch($reservation->confirmation->status)
                @case('0')
                <span class="bg-red-600 text-white">취소</span>
                @break
                @case('1')
                <span class="bg-blue-600 text-white">확정</span>
                @break
                @case('2')
                <span class="bg-red-600 text-white">중도 퇴실</span>
                @break
            @endswitch
        @elseif($reservation->payment->status === '3')
            <span class="bg-orange-600 text-white">확정 필요1</span>
        @else
            <span class="bg-red-600 text-white">취소</span>
        @endif
    @elseif($reservation->type ==='tour')
        @if($reservation->confirmations->count()>=1 && $reservation->confirmation->status === '1')
            <span class="bg-blue-600 text-white">확정</span>
        @else
            @if($reservation->order_status!=='0')
                <span class="bg-orange-600 text-white">확정 필요2</span>
            @else
                <span class="bg-red-600 text-white">취소</span>
            @endif
        @endif
    @else
        ㆍ
    @endif
</div>
