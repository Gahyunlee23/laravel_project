<div>
    <div class="space-y-5">
        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                호텔명
            </div>
            <div>
                <input type="text" name="hotel_name" wire:model="hotel_name"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="호텔명을 입력해주세요." maxlength="50"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>

        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                호텔 주소
            </div>
            <div>
                <input type="text" name="hotel_address" wire:model="hotel_address"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="호텔 주소를 입력해주세요." maxlength="50"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>

        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                호텔 웹사이트 주소
            </div>
            <div>
                <input type="url" name="hotel_web_address" wire:model="hotel_web_address"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="호텔 웹사이트 주소를 입력해주세요." maxlength="50"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>
    </div>
</div>
