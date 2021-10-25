<div>
    <div wire:click="calculation()" class="cursor-pointer">
        <div class="font-bold text-black">필터-결제금 계산</div>
    </div>
    <div wire:loading.remove wire:target="calculation">
        @if($sum > 0 || $addSum > 0)
            <div>
                결제:{{number_format($sum)}}원
                추가결제:{{number_format($addSum)}}원
                취소금액:{{number_format($cancelSum)}}원
            </div>
        @endif
    </div>
    <div class="" wire:loading wire:target="calculation">
        계산중
    </div>
</div>
