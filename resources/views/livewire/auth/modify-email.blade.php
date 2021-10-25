<div x-data="{ formDisabled : @entangle('submitDisabled'), emailError : '{{$errors->has("email")}}', emailCertifiedTimer:0 }">
    <div class="flex space-x-2">
        <div class="w-full space-y-2">
            <div class="form-group row">
                <div class="relative">
                    <input name="email" id="email" type="email" wire:model="email"
                           class="AppSdGothicNeoR appearance-none w-full py-5 px-1 text-white border-b border-solid border-white outline-none bg-tm-c-30373F"
                           autofocus required autocomplete="off" placeholder="이메일 아이디 입력">
                    <div class="absolute top-0 right-0 mt-3 mr-3" style="height : calc( 100% - 22px );">
                        <button
                            x-show="emailCertifiedTimer===0"
                            class="h-full flex items-center justify-center rounded-sm px-6"
                            :disabled="('{{$email}}'==='')"
                            :class="{
                            'bg-tm-c-d7d3cf cursor-default' : (('{{$email}}'==='' && '{{$certified_process}}'!=='1') || '{{$errors->has("email")}}'==='1'),
                            'bg-tm-c-C1A485' : ('{{$email}}'!=='' || '{{$certified_process}}'==='1'),
                        }"
                            @click="emailCertifiedTimer=10;$Interval = setInterval(function(){ emailCertifiedTimer--; if(emailCertifiedTimer===0){ clearInterval($Interval); } },1000);"
                            wire:click="emailCertified"
                        >
                            <div class="text-white text-lg">
                                @if($certified_process)
                                    재인증
                                @else
                                    인증
                                @endif
                            </div>
                        </button>
                        <div
                            x-show="emailCertifiedTimer!==0" x-cloak
                            class="h-full flex items-center justify-center rounded-sm px-6 bg-tm-c-d7d3cf cursor-default">
                            <div class="flex text-white text-base">
                                <div x-text="emailCertifiedTimer"></div>초 후 시도
                            </div>
                        </div>
                    </div>
                </div>

                @error('email')
                <div class="mt-2" role="alert">
                    <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                </div>
                @enderror
                @if (session()->has('message'))
                    <div class="mt-2" role="alert">
                        <div class="text-sm text-white">{{ session('message') }}</div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div>
        <div class="relative">
            <input type="text" maxlength="6" wire:model="certifiedKey" name="certifiedKey" id="certifiedKey"
                   @if(!$certified_process)
                   disabled="disabled"
                   @endif
                   class="AppSdGothicNeoR appearance-none w-full py-5 px-1 text-white border-b border-solid border-white outline-none bg-tm-c-30373F"
                   placeholder="인증 코드 입력"
            >
            @if($certified_key_completed && !$errors->has('email') &&  !$errors->has('certifiedKey') )
                <div class="absolute top-0 right-0 mt-3 mr-5" style="height : calc( 100% - 22px );">
                    <div class="h-full flex items-center justify-center">
                        <div class="text-base text-tm-c-C1A485">인증완료</div>
                    </div>
                </div>
            @endif
        </div>
        @error('certifiedKey')
        <div class="mt-2" role="alert">
            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
        </div>
        @enderror
    </div>

    @if (session()->has('result-message'))
    <div class="mt-2">
        <div class="text-sm text-white">{{session('result-message')}}</div>
    </div>
    @endif
    @if (session()->has('error-message'))
    <div class="mt-2">
        <div class="text-sm text-tm-c-da5542">{{session('error-message')}}</div>
    </div>
    @endif


    <div class="py-3 bottom-0">
        <div class="w-full cursor-pointer select-none">
            <button class="w-full rounded-sm disabled:bg-tm-c-d7d3cf bg-tm-c-C1A485"
                    wire:loading.attr="disabled"
                    :disabled="formDisabled"
                    wire:click="emailModify">
                <div class="flex flex-wrap justify-center items-center AppSdGothicNeoR py-4 h-14 px-3 xs:px-6 text-white {{$buttonTextSize}}">
                    <svg wire:loading wire:target="FormSubmit"
                         class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    이메일 변경
                </div>
            </button>
        </div>
    </div>
</div>
