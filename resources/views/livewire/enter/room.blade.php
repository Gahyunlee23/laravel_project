<div x-data="{ index : '{{$current_i}}' }">
    @foreach($inputs as $key => $value)
    <div class="grid md:grid-cols-2" x-show="index === '{{$key}}'">
        <div class="w-full flex-1 my-4 md:pr-2">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                객실 타입 {{$key+1}}
            </div>
            <div>
                <input type="text" name="type[]" wire:model="type.{{ $key }}"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="객실 타입(ex. 스탠다드 더블)을 입력해주세요." maxlength="50"
                       autocomplete="off" style="z-index:-1;">
                @error('type.'.$key) <span class="text-white mt-2 block">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                한 달 살기 공급가
            </div>
            <div>
                <input type="number" name="supply_price_month[]" wire:model="supply_price_month.{{ $key }}"
                       class="w-full appearance-none bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="29박 30일 기준(부가세 포함)으로 입력해주세요." maxlength="11"
                       autocomplete="off" style="z-index:-1;">
                @error('supply_price_month.'.$key) <span class="text-white mt-2 block">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full flex-1 my-4 md:pr-2">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                3주 살기 공급가
            </div>
            <div>
                <input type="number" name="supply_price_3_weeks[]" wire:model="supply_price_3_weeks.{{ $key }}"
                       class="w-full appearance-none bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="20박 21일 기준(부가세 포함)으로 입력해주세요." maxlength="11"
                       autocomplete="off" style="z-index:-1;">
                @error('supply_price_3_weeks.'.$key) <span class="text-white mt-2 block">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                2주 살기 공급가
            </div>
            <div>
                <input type="number" name="supply_price_2_weeks[]" wire:model="supply_price_2_weeks.{{ $key }}"
                       class="w-full appearance-none bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="13박 14일 기준(부가세 포함)으로 입력해주세요." maxlength="11"
                       autocomplete="off" style="z-index:-1;">
                @error('supply_price_2_weeks.'.$key) <span class="text-white mt-2 block">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full flex-1 my-4 md:pr-2">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                1주 살기 공급가
            </div>
            <div>
                <input type="number" name="supply_price_1_weeks[]" wire:model="supply_price_1_weeks.{{ $key }}"
                       class="w-full appearance-none bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="6박 7일 기준(부가세 포함)으로 입력해주세요." maxlength="11"
                       autocomplete="off" style="z-index:-1;">
                @error('supply_price_1_weeks.'.$key) <span class="text-white mt-2 block">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                단기 거주 공급가
            </div>
            <div>
                <input type="number" name="supply_price_short_day[]" wire:model="supply_price_short_day.{{ $key }}"
                       class="w-full appearance-none bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="6박 7일 미만 기준(부가세 포함)으로 입력해주세요." maxlength="11"
                       autocomplete="off" style="z-index:-1;">
                @error('supply_price_short_day.'.$key) <span class="text-white mt-2 block">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
    @endforeach

    <div class="flex justify-center py-4">
        @foreach($inputs as $key => $value)
            <div wire:click="room_page({{$key}})"
                 :class="{ 'bg-tm-c-C1A485' : index === '{{$key}}' }"
                 class="p-px w-2 h-2 mr-1 border border-tm-c-C1A485 rounded-full"></div>
        @endforeach
    </div>

    <div class="space-y-8">
        <div class="text-tm-c-C1A485">
            <div class="hidden md:block text-base">
                * 호텔에삶 기존 입점 호텔의 판매가를 참고하셔서 ‘호텔에삶’에만 제공 가능한 경쟁력 있는 가격으로 제시 바랍니다.
            </div>
            <div class="flex flex-wrap block md:hidden space-y-2 text-xs sm:text-base">
                <div class="w-full">* 호텔에삶 기존 입점 호텔의 판매가를 참고하셔서</div>
                <div class="pl-2 md:pl-0">‘호텔에삶’에만 제공 가능한 경쟁력 있는 가격으로 제시 바랍니다.</div>
            </div>
        </div>
        <div>
            <div class="flex justify-center items-center bg-tm-c-C1A485 text-white rounded-sm cursor-pointer"
                 onclick="room_append()">
                <div class="py-4 md:py-4 flex items-center">
                    <div class="pr-1 md:pr-2">
                        <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/ic-more-2.svg" class="w-6 md:w-7" alt="">
                    </div>
                    <div class="md:text-lg">
                        객실 추가 입력하기
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
