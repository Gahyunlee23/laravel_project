<div>
    <div class="grid md:grid-cols-2">
        <div class="w-full flex-1 my-4 md:pr-2">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                담당자 성명
            </div>
            <div>
                <input type="text" name="manager_name" wire:model="manager_name"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="담당자 성명을 입력해주세요." maxlength="20"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>
        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                담당자 직급
            </div>
            <div>
                <input type="text" name="manager_rank" wire:model="manager_rank"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="담당자 직급을 입력해주세요." maxlength="20"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>
        <div class="w-full flex-1 my-4 md:pr-2">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                담당자 이메일
            </div>
            <div>
                <input type="email" name="manager_email" wire:model="manager_email"
                       class="w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="담당자 이메일을 입력해주세요." maxlength="100"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>
        <div class="w-full flex-1 my-4">
            <div class="py-3 AppSdGothicNeoR font-semibold text-tm-c-d7d3cf">
                담당자 얀락처
            </div>
            <div>
                <input type="tel" name="manager_hp" wire:model="manager_hp"
                       class="manager_hp w-full bg-tm-c-30373F placeholder-white-50 text-white px-5 py-4 border-2 border-solid border-tm-c-d7d3cf rounded-sm"
                       placeholder="담당자 연락처를 입력해주세요." maxlength="20"
                       autocomplete="off" style="z-index:-1;">
            </div>
        </div>
    </div>
</div>
