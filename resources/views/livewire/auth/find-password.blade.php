<div x-data="{ findPasswordPage : @entangle('findPasswordPage') }">
    <div class="space-y-8">
        <div>
            <div class="grid grid-cols-2 select-none">
                <div class="flex justify-start p-2 cursor-pointer border-solid border-white"
                     @click="findPasswordPage = 'name-tel-find'" wire:click="$set('findPasswordPage', 'name-tel-find')"
                     :class="{ 'border-b-4' : findPasswordPage === 'name-tel-find',
                            'border-b' : findPasswordPage !== 'name-tel-find' }">
                    <div class="text-xs 6xs:text-base"
                         :class="{ 'text-white' : findPasswordPage === 'name-tel-find',
                            'text-tm-c-d7d3cf' : findPasswordPage !== 'name-tel-find' }">
                        이름ㆍ연락처로 찾기
                    </div>
                </div>
                <div class="flex justify-start p-2 cursor-pointer border-solid border-white"
                     @click="findPasswordPage = 'email-tel-find'" wire:click="$set('findPasswordPage', 'email-tel-find')"
                     :class="{ 'border-b-4' : findPasswordPage === 'email-tel-find',
                            'border-b' : findPasswordPage !== 'email-tel-find' }">
                    <div class="text-xs 6xs:text-base"
                         :class="{ 'text-white' : findPasswordPage === 'email-tel-find',
                            'text-tm-c-d7d3cf' : findPasswordPage !== 'email-tel-find' }">
                        이메일ㆍ연락처로 찾기
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-3" x-show="findPasswordPage" x-cloak>
            <div x-show="findPasswordPage==='name-tel-find'">
                <div>
                    <input name="name" id="name" type="text" wire:model.lazy="find.password.name"
                           class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('find.password.name') border-tm-c-ff7777 @enderror"
                           required autocomplete="off" placeholder="이름 입력">
                    @error('find.password.name')
                    <div class="mt-1" role="alert">
                        <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                    </div>
                    @enderror
                </div>
            </div>
            <div x-show="findPasswordPage==='email-tel-find'">
                <div>
                    <input name="email" id="email" type="email" wire:model.lazy="find.password.email"
                           class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('find.password.email') border-tm-c-ff7777 @enderror"
                           required autocomplete="off" placeholder="이메일 아이디 입력">
                    @error('find.password.email')
                    <div class="mt-1" role="alert">
                        <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <div class="relative" x-data="{sec : 0}">
                    <input name="tel" id="tel" type="tel" wire:model="find.password.tel"
                           class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('find.password.tel') border-red-500 @enderror"
                           required autocomplete="off" maxlength="12" placeholder="전화번호 입력">
                    @if($authTel !== $find['password']['tel'] || (!$certified_key_completed))
                        <div class="absolute top-0 right-0 h-full mr-1 cursor-pointer" x-show="sec===0"
                             wire:click="telCheck" @click="sec=15;$interval = setInterval(function(){ if(sec>=1){sec--;}else{clearInterval($interval);}},1000);" >
                            <div class="mr-1 h-full flex items-center z-30">
                                <div class="AppSdGothicNeoR w-full px-5 py-2 flex justify-center items-center text-white rounded-sm
                                 @if( ( ($findPasswordPage === 'name-tel-find' && !$errors->has('find.password.name')) || ($findPasswordPage === 'email-tel-find' && !$errors->has('find.password.email')) ) && !$errors->has('find.password.tel') && $find['password']['tel'] !== '') bg-tm-c-C1A485 @else bg-tm-c-d7d3cf hover:bg-tm-c-979b9f @endif"
                                >
                                    @if($certified_process)
                                        재인증
                                    @else
                                        인증
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 h-full mr-1 cursor-pointer" x-show="sec!==0">
                            <div class="mr-1 h-full flex items-center z-30">
                                <div class="w-full px-5 py-2 flex justify-center items-center text-white bg-gray-400 hover:bg-tm-c-979b9f">
                                    <span x-text="sec"></span>초 후 재시도
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @error('find.password.tel')
                <div class="mt-1" role="alert">
                    <div class="text-sm text-tm-c-ff7777">{!! $message !!}</div>
                </div>
                @enderror
            </div>
            @if($authRandomKey !== null)
                <div>
                    <div class="relative">
                        <input name="authentication_number" id="authentication_number" type="number" wire:model="find.password.authentication_number" wire:keyup="AuthRandomKeyChecked"
                               class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm"
                               required autocomplete="off" placeholder="인증번호 입력" maxlength="4">

                        @if($certified_key_completed)
                            <div class="absolute top-0 right-0 h-full">
                                <div class="h-full flex items-center mr-5">
                                    <div class="AppSdGothicNeoR text-tm-c-C1A485 text-base leading-normal">인증완료</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('find.password.authentication_number')
                    <div class="mt-2" role="alert">
                        <div class="text-sm text-tm-c-ff7777">{!! $message !!}</div>
                    </div>
                    @enderror
                </div>
            @endif

            @if(session()->has('message'))
                <div class="mt-1">
                    <div class="text-sm text-tm-c-ff7777">{{session()->pull('message')}}</div>
                </div>
            @endif
            <div class="w-full"  wire:click="findPasswordSubmit" wire:key="findPasswordSubmit">
                <div class="AppSdGothicNeoR flex justify-center items-center py-4 h-14 px-3 xs:px-6 rounded-sm select-none
                    @if($certified_key_completed) bg-tm-c-C1A485 text-white cursor-pointer @else bg-tm-c-d7d3cf text-tm-c-979b9f @endif"
                >
                    비밀번호 변경
                </div>
            </div>

        </div>

    </div>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</div>
