@switch($process)
    @case('1')
    예약 취소 신청 완료
    @break
    @case('2')
    예약 취소 처리 중
    @break
    @case('3')
    예약 취소 승인 완료
    @break
    @case('4')
    예약 취소 반려
    @break
    @case('0')
    예약 취소 신청 취소
    @break

    @default
    {{ $default ?? '정보없음' }}
@endswitch
