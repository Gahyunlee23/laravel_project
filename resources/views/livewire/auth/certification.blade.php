<div class="mt-4">
    <div class="flex space-x-2">
        <div class="w-full space-y-2">
            <div class="form-group row">
                <div class="relative" x-data="{sec : 0}">
                    <input name="tel" id="tel" type="tel" wire:model="certification.tel"
                           class="AppSdGothicNeoR appearance-none w-full h-12 px-1 text-white border-b border-solid border-white outline-none bg-tm-c-30373F"
                           autofocus required autocomplete="off" placeholder="인증 연락처 입력">

                        <div class="absolute top-0 right-0 h-full mt-2 mr-1 cursor-pointer" style="height: calc(100% - 6px);"
                             x-show="sec===0"
                             wire:click="telCheck" @click="sec=5;$interval = setInterval(function(){ if(sec>=1){sec--;}else{clearInterval($interval);}},1000);" >
                            <div class="mr-1 flex items-center z-30">
                                <div class="AppSdGothicNeoR w-full px-5 py-2 flex justify-center items-center text-white bg-tm-c-d7d3cf hover:bg-tm-c-979b9f rounded-sm">
                                    @if($cert)
                                        재인증
                                    @else
                                        인증
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 h-full mt-2 mr-1 cursor-pointer" style="height: calc(100% - 6px);"
                             x-show="sec!==0" x-cloak>
                            <div class="mr-1 flex items-center z-30">
                                <div class="w-full px-5 py-2 flex justify-center items-center text-white bg-gray-400 hover:bg-tm-c-979b9f">
                                    <span x-text="sec"></span>초 후 재시도
                                </div>
                            </div>
                        </div>
                    @error('certification.tel')
                    <div class="mt-1" role="alert">
                        <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @if($cert)
        <div class="flex space-x-2">
            <div class="w-full space-y-2">
                <div class="form-group row">
                    <div class="">
                        <input name="certValue" id="certValue" type="number" wire:model="certification.certValue"
                               class="AppSdGothicNeoR appearance-none w-full h-12 px-1 text-white border-b border-solid border-white outline-none bg-tm-c-30373F"
                               autofocus required autocomplete="off" placeholder="인증번호 입력">
                        @error('certification.certValue')
                        <div class="mt-1" role="alert">
                            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="pt-4 bottom-0">
        <div class="w-full cursor-pointer select-none">
            <a wire:click="completeCertification">
                <div class="AppSdGothicNeoR flex justify-center items-center py-2 h-10 md:h-12 px-3 xs:px-6 rounded-sm bg-tm-c-C1A485 text-white">
                    인증 완료하기
                </div>
            </a>
        </div>
    </div>
    @error('authTelCheck')
    <div class="mt-1" role="alert">
        <div class="text-sm text-tm-c-ff7777">{{$message}}</div>
    </div>
    @enderror
    @error('authTelError')
    <div class="mt-1" role="alert">
        <div class="text-sm text-tm-c-ff7777">{{$message}}</div>
    </div>
    @enderror
    @error('authentication_numberError')
    <div class="mt-1" role="alert">
        <div class="text-sm text-tm-c-ff7777">{{$message}}</div>
    </div>
    @enderror
    @error('result')
    <div class="mt-1" role="alert">
        <div class="text-sm text-tm-c-ff7777">{{$message}}</div>
    </div>
    @enderror
</div>
