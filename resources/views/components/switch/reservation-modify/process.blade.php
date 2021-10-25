@switch($process)
    @case('1')
    신청
    @break
    @case('2')
    진행 중
    @break
    @case('3')
    승인
    @break
    @case('4')
    미승인
    @break
    @case('0')
    Cancel
    @break

    @default
    {{ $default ?? '정보없음' }}
@endswitch
