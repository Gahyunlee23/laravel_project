<div>
    @if($reservation->type === 'month')
        @switch($reservation->order_status)
            @case('3') @case('5')
            신청완료
            @break
            @case('0')
            취소
            @break
            @case('10')
            부분취소
            @break
            @case('11')
            중도퇴실
            @break
        @endswitch
    @elseif($reservation->type === 'tour')
        @switch($reservation->order_status)
            @case('2') @case('3') @case('5')
            신청완료
            @break
            @case('0')
            취소
            @break
            @default
        @endswitch
    @endif
</div>
