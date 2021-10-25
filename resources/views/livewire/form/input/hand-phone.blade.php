<div x-data="{ sec : 0 }">
    <div class="space-y-6 sm:space-y-8">

        <div>
            <div class="relative flex">
                <div class="flex-0 pr-2">
                    <select name="country_code" wire:model="countryCode"
                            class="w-full h-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm appearance-none">
                        <option value="+82" selected>한국</option>
                        <option value="+1">미국</option>
                    </select>
                </div>

                <div class="flex-1">
                    <input type="tel" name="order_hp" wire:model="tel"
                           class="order_hp w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                           placeholder="010-0000-0000" maxlength="18"
                           autocomplete="off" style="height:51px;border-color:#d7d3cf;">
                </div>
                <div class="absolute top-0 right-0 h-full mr-4">
                    <div class="h-full flex items-center">
                        <div
                            x-show="sec===0"
                            @click="sec=15;$interval = setInterval(function(){ if(sec>=1){sec--;}else{clearInterval($interval);}},1000);"
                            wire:click="telCheck"
                            class="py-2 px-6 rounded-sm @if($tel !== '' && $tel !== null && !$errors->has('tel')) bg-tm-c-C1A485 hover:bg-tm-c-897763 @else bg-tm-c-979b9f @endif cursor-pointer leading-5">
                            <div class="text-white AppSdGothicNeoR">인증</div>
                        </div>
                        <div
                            x-show="sec!==0" x-cloak
                            class="py-2 px-2 rounded-sm bg-tm-c-d7d3cf cursor-default leading-5">
                            <div class="flex justify-center items-center AppSdGothicNeoR text-white text-base">
                                <div x-text="sec"></div>초 후 재시도
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @error('tel')
            <div class="mt-2">
                <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
            </div>
            @enderror
            @if($countryCode!=="+82")
            <div class="mt-2">
                <div class="text-sm text-tm-c-da5542">
                    해외 휴대전화 인증의 경우, 전송이 실패할 수 있습니다. 인증 진행 불가 시 고객센터(1599-4330)로 문의 바랍니다.
                </div>
            </div>
            @endif
        </div>

        <div>
            <div class="space-y-2 sm:space-y-3">
                <div class="text-white text-base sm:text-lg AppSdGothicNeoR font-normal">
                    인증 코드
                </div>
                <div class="relative block">
                    <input type="text" name="certifiedKey" wire:model="certifiedKey"
                           class="w-full bg-transparent focus:outline-none placeholder-tm-c-979b9f text-white px-5 py-4 border border-solid rounded-sm"
                           placeholder="휴대전화 인증 코드를 입력해주세요."
                           maxlength="10"
                           autocomplete="off" style="height:51px;z-index:-1;border-color:#d7d3cf;">

                    @if($certified_key_completed && !$errors->has('tel') &&  !$errors->has('certifiedKey') )
                        <div class="absolute top-0 right-0 mt-3 mr-5" style="height : calc( 100% - 22px );">
                            <div class="h-full flex items-center justify-center">
                                <div class="text-base text-tm-c-C1A485">인증완료</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @error('certifiedKey')
            <div class="mt-2">
                <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
            </div>
            @enderror
        </div>

    </div>

    @error('error')
    <div class="mt-2">
        <div class="text-sm text-tm-c-da5542">{{ $message ?? '오류'}}</div>
    </div>
    @enderror

    @if(session()->has('message'))
        <div class="mt-2">
            <div class="text-sm text-white">
                {{ session()->pull('message') ?? '오류' }}
            </div>
        </div>
    @endif

</div>
