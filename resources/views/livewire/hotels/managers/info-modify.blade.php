<div x-data="{ type : @entangle('type'), show : false }" x-init="show=true">
    <div class="flex flex-wrap" x-cloak x-show="show"
         :class="{
                'space-y-3' : type === null,
                '' : type !== null
             }"
        >
        <div :class="{
                'w-full' : type === null,
                'w-1/2 pr-2' : type !== null
             }">
            <div class="w-full py-2 sm:py-4 leading-normal border border-solid border-white rounded-sm cursor-pointer shadow-lg"
                 wire:click="typeChange('email')"
                 :class="{
                    'hover:bg-tm-c-292f36' : type !== 'email',
                    'bg-tm-c-292f36 font-bold' : type === 'email'
                 }"
            >
                <div class="text-white AppSdGothicNeoR text-lg text-center">
                    이메일 정보 수정
                </div>
            </div>
        </div>
        <div
            :class="{
                'w-full' : type === null,
                'w-1/2 pl-2' : type !== null
             }">
            <div class="w-full py-2 sm:py-4 leading-normal border border-solid border-white rounded-sm cursor-pointer shadow-lg hover:bg-tm-c-292f36"
                 wire:click="typeChange('password')"
                 :class="{
                    'hover:bg-tm-c-292f36' : type !== 'password',
                    'bg-tm-c-292f36 font-bold' : type === 'password'
                 }"
            >
                <div class="text-white AppSdGothicNeoR text-lg text-center">
                    비밀번호 정보 수정
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div>
            <div x-cloak x-show="type==='email'">
                <livewire:auth.modify-email button-text-size="text-xl"></livewire:auth.modify-email>
            </div>
            <div x-cloak x-show="type==='password'">
                <livewire:auth.modify-password button-text-size="text-xl"></livewire:auth.modify-password>
            </div>
        </div>
    </div>

    <div class="py-3 sm:py-4 leading-normal border border-solid border-white rounded-sm cursor-pointer shadow-lg hover:bg-tm-c-292f36" onclick="location.href='{{route('hotel-manager.index')}}'">
        <div class="text-xl text-white text-center">
            돌아가기
        </div>
    </div>
</div>
