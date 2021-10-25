<div>
    @if($reservation->type ==='month')
        @if($reservation->payments->count()>=1)
            @switch($reservation->payment->status)
                @case('0')
                    <span class="bg-red-600 text-white">취소</span>
                @break
                @case('3')
                    <span class="bg-blue-600 text-white">완료</span>
                @break
                @case('10')
                    <span class="bg-red-600 text-white">부분 취소</span>
                @break
            @endswitch
        @else
            ㆍ
        @endif
    @elseif($reservation->type ==='tour')
        @if($reservation->payments->count()>=1 && $reservation->payment->status === '3')
            결제 전환 고객
        @else
            ㆍ
        @endif
    @else
        ㆍ
    @endif
</div>
