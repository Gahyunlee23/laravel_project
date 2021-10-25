<div>
    <div class="space-y-5">
        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                어메니티
            </div>
            <div>
                <input type="text" name="amenities" wire:model="amenities"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="호텔에삶 입주 고객에게 제공 가능한 어메니티를 입력해주세요."
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>

        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                부대시설
            </div>
            <div>
                <input type="text" name="facilities" wire:model="facilities"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="부대시설을 입력해주세요."
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>

        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                호텔에삶 Only 혜택
            </div>
            <div>
                <input type="text" name="benefit" wire:model="benefit"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="ex. 밀키트 제공, 룸 업그레이드, 공용 주방 설치 등"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>
    </div>
</div>
