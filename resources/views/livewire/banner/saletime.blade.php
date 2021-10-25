<div>
    {{-- wire.poll의 경우에 1s 뒤에 붙은 시간마다 계속 통신해서 값을 바꿔주므로 새로운 라이브 와이어를 생성해서 처리함 --}}
    <div wire:poll.1s="time">
        {{-- 0일 표시, 0일 일 경우에는 표시하지 않음 --}}
        @if(floor($time / 60 / 60 / 24) <= 0)
        @else
            {{ floor($time / 60 / 60 / 24) }}일
        @endif

        {{-- 00시 표시, 1~9까지 한자리 숫자의 시간일 경우에는 앞에 0을 더해줌 --}}
        @if(Str::of(floor($time / 60 / 60 % 24))->length() === 1)
            {{ Str::of(floor($time / 60 / 60 % 24))->prepend('0') }}시간
        @else
            {{ floor($time / 60 / 60 % 24) }}시간
        @endif

        {{-- 00분 표시, 1~9까지 한자리 숫자의 분일 경우에는 앞에 0을 더해줌 --}}
        @if(Str::of($time/60%60)->length() === 1)
            {{ Str::of($time/60%60)->prepend('0') }}분
        @else
            {{ $time / 60 % 60 }}분
        @endif

        {{-- 00초 표시, 시간&분 처리 로직과 같음 --}}
        @if(Str::of($time%60)->length() === 1 )
            {{Str::of($time%60)->prepend('0')}}초
        @else
            {{ $time%60 }}초
        @endif
    </div>
</div>
