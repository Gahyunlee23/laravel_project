<div class="w-full max-w-xl lg:max-w-6xl">
    <form method="POST" id="register-form">
        @csrf
        @method('POST')
        <input type="hidden" name="telCheck" wire:model="register.telCheck">
        <div class="space-y-8">
            <div class="space-y-4">
                <div class="AppSdGothicNeoR font-semibold text-lg text-tm-c-d7d3cf">
                    회원 정보
                </div>
                <div class="form-group row">
                    <div class="">
                        <input name="email" id="email" type="email" wire:model="register.email"
                               class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('register.name') border-tm-c-ff7777 @enderror"
                               required autocomplete="off" placeholder="이메일 아이디 입력">
                        @error('register.email')
                        <div class="mt-1" role="alert">
                            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="">
                        <input name="name" id="name" type="text" wire:model="register.name"
                               class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('register.name') border-tm-c-ff7777 @enderror"
                               required autocomplete="off" placeholder="이름 입력">
                        @error('register.name')
                        <div class="mt-1" role="alert">
                            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" x-data="{sec : 0}">
                    <div class="">
                        <div class="relative">
                            <input name="tel" id="tel" type="tel" wire:model.lazy="register.tel"
                                   class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('register.tel') border-red-500 @enderror"
                                   required autocomplete="off" maxlength="12" placeholder="전화번호 입력">
                            @if($authTel !== $register['tel'] || ($authRandomKey !== $register['authentication_number']))
                                <div class="absolute top-0 right-0 h-full mr-2 cursor-pointer" x-show="sec===0">
                                    <div class="h-full flex items-center z-30">
                                        <div class="AppSdGothicNeoR w-full px-5 py-2 flex justify-center items-center text-white rounded-sm
                                    @if($register['tel'] !=='' && !$errors->has('register.tel')) bg-tm-c-C1A485 hover:bg-tm-c-897763 @else bg-tm-c-d7d3cf hover:bg-tm-c-979b9f @endif"
                                             x-on:click="sec=15;$interval = setInterval(function(){ if(sec>=1){sec--;}else{clearInterval($interval);}},1000);" wire:click="telCheck"
                                        >
                                            @if(\App\CertifiedKey::wherePurpose('회원 가입 연락처 인증')->whereType('tel')->whereTarget($register['tel'])->latest()->first())
                                                재인증
                                            @else
                                                인증
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute top-0 right-0 h-full mr-2 cursor-pointer" x-show="sec!==0">
                                    <div class="h-full flex items-center z-30">
                                        <div class="w-full px-5 py-2 flex justify-center items-center text-white bg-gray-400 hover:bg-tm-c-979b9f">
                                            <span x-text="sec"></span>초 후 재시도
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @error('register.tel')
                        <div class="mt-1" role="alert">
                            <div class="text-sm text-tm-c-ff7777">{!! $message !!}</div>
                        </div>
                        @enderror

                        @if(\App\CertifiedKey::wherePurpose('회원 가입 연락처 인증')->whereType('tel')->whereTarget($register['tel'])->latest()->first() === null)
                            @error('register.authentication_number')
                            <div class="mt-1" role="alert">
                                <div class="text-sm text-tm-c-ff7777">{!! $message !!}</div>
                            </div>
                            @enderror
                        @endif
                    </div>
                </div>

                @if(\App\CertifiedKey::wherePurpose('회원 가입 연락처 인증')->whereType('tel')->whereTarget($register['tel'])->latest()->first())
                    <div class="form-group row">
                        <div class="">
                            <div class="relative">
                                <input name="authentication_number" id="authentication_number" type="number" wire:model="register.authentication_number"
                                       class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('register.authentication_number') border-tm-c-ff7777 @enderror"
                                       required autocomplete="off" placeholder="인증번호 입력" maxlength="4">
                                @if( \App\CertifiedKey::wherePurpose('회원 가입 연락처 인증')->whereType('tel')->whereTarget($register['tel'])->latest()->first()->key === $register['authentication_number'])
                                    <div class="absolute top-0 right-0 h-full">
                                        <div class="h-full flex items-center mr-5">
                                            <div class="AppSdGothicNeoR text-tm-c-C1A485 text-base leading-normal">인증완료</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @error('register.authentication_number')
                            <div class="mt-1" role="alert">
                                <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <div class="">
                        <input name="password" id="password" type="password" wire:model.lazy="register.password"
                               class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('register.password') border-tm-c-ff7777 @enderror"
                               required autocomplete="off" placeholder="비밀번호 입력">
                        @error('register.password')
                        <div class="mt-1" role="alert">
                            <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="relative">
                        <input name="password_confirmation" id="password_confirmation" type="password" wire:model.lazy="register.password_confirmation"
                               class="AppSdGothicNeoR appearance-none w-full h-14 px-4 text-white border-2 border-solid outline-none bg-tm-c-30373F rounded-sm @error('register.password_confirmation') border-tm-c-ff7777 @enderror"
                               required autocomplete="off" placeholder="비밀번호 재입력">

                        {{--                        @if(\Illuminate\Support\Str::of($register['password'])->length()>=8 && $register['password'] && !$errors->has('password') && !$errors->has('password_confirmation') && isset($register['password_confirmation']))--}}
                        {{--                            <div class="absolute top-0 right-0 mt-3 mr-5" style="height : calc( 100% - 22px );"--}}
                        {{--                                 x-bind:class="{'hidden' : '{{$register['password']}}'!=='{{$register['password_confirmation']}}'}">--}}
                        {{--                                <div class="h-full flex items-center justify-center">--}}
                        {{--                                    <div class="text-base text-tm-c-C1A485">비밀번호 일치</div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
                    </div>
                </div>

                <div class="text-red-500">
                    @if(session()->has('authTelError'))
                        {{session()->pull('authTelError')}}
                    @endif
                    @if(session()->has('authentication_numberError'))
                        {{session()->pull('authentication_numberError')}}
                    @endif
                </div>
            </div>

            <div class="space-y-3">
                <div class="AppSdGothicNeoR font-semibold text-lg text-tm-c-d7d3cf">
                    동의 여부
                </div>
                <div>
                    <div class="space-y-2 sm:space-y-3">
                        <div class="cursor-pointer" x-data="{ 'checked' : @entangle('check_all')}" wire:key="check_all">
                            <input type="checkbox" class="hidden" id="check_all" wire:model="check_all" value="1">
                            <div  class="border-2 border-solid rounded-sm border-tm-c-d7d3cf">
                                <div class="px-2">
                                    <div class="w-full inline-flex items-center text-sm">
                                        <div class="flex-1">
                                            <label for="check_all">
                                                <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                    <div class="z-50 cursor-pointer" x-on:click="checked = !checked;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-3 w-8 h-8 rounded-full"
                                                             x-bind:class="{
                                                             'bg-tm-c-d7d3cf': !checked,
                                                             'bg-tm-c-C1A485': checked
                                                             }" viewBox="0 0 30 30">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <g>
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <g transform="translate(-454.000000, -716.000000) translate(430.000000, 309.000000) translate(0.000000, 360.000000) translate(0.000000, 32.000000) translate(24.000000, 15.000000)">
                                                                                    <circle cx="15" cy="15" r="15"{{-- fill="#D7D3CF"--}}/>
                                                                                    <path stroke="#FFF" stroke-width="2" d="M9.256 13.55L13.376 18.781 21.256 10.781"/>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg leading-normal">
                                                        전체 동의
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="cursor-pointer" x-data="{ 'show' : false, 'checked' : @entangle('check_1')}" wire:key="check_1">
                                <input type="checkbox" class="hidden" id="check_1" wire:model="check_1" value="1">
                                <div class="border-2 border-solid rounded-sm" style="border-color:#d7d3cf;">
                                    <div class="px-2">
                                        <div class="w-full inline-flex items-center text-sm">
                                            <div class="flex-1">
                                                <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                    <label for="check_1">
                                                        <div class="z-50 cursor-pointer" x-on:click="checked = !checked;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-3 w-6 h-6 rounded-full"
                                                                 x-bind:class="{
                                                         'bg-tm-c-d7d3cf': !checked,
                                                         'bg-tm-c-C1A485': checked
                                                         }" viewBox="0 0 30 30">
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <g>
                                                                                    <g transform="translate(-454.000000, -716.000000) translate(430.000000, 309.000000) translate(0.000000, 360.000000) translate(0.000000, 32.000000) translate(24.000000, 15.000000)">
                                                                                        <circle cx="15" cy="15" r="15"{{-- fill="#D7D3CF"--}}/>
                                                                                        <path stroke="#FFF" stroke-width="2" d="M9.256 13.55L13.376 18.781 21.256 10.781"/>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg leading-normal" x-on:click="show = !show;">
                                                        회원가입 및 이용약관 규정 동의 (필수)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-left ml-auto mr-2 cursor-pointer" x-on:click="show = !show;">
                                                <img class="w-8 h-8 transform duration-150"
                                                     x-bind:class="{'rotate-180': show}"
                                                     src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                                     alt="icon">
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="h-42 overflow-y-scroll border-t-2 border-solid"
                                        x-show="show" x-cloak
                                        style="border-color:#d7d3cf;">
                                        <div class="">
                                            <div class="py-6 px-2">
                                        <span class="AppSdGothicNeoR text-white text-base leading-7">
                                            @livewire('operating-terms')
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('check_1'))
                                <div class="mt-2">
                                    <div class=" text-sm text-tm-c-ff7777">{{$errors->first('check_1') ?? ''}}</div>
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="cursor-pointer" x-data="{ 'show' : false, 'checked' : @entangle('check_2')}" wire:key="check_2">
                                <input type="checkbox" class="hidden" id="check_2" wire:model="check_2" value="1">
                                <div class="border-2 border-solid rounded-sm" style="border-color:#d7d3cf;">
                                    <div class="px-2">
                                        <div class="w-full inline-flex items-center text-sm">
                                            <div class="flex-1">
                                                <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                    <label for="check_2">
                                                        <div class="z-50 cursor-pointer" x-on:click="checked = !checked;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-3 w-6 h-6 rounded-full"
                                                                 x-bind:class="{
                                                         'bg-tm-c-d7d3cf': !checked,
                                                         'bg-tm-c-C1A485': checked
                                                         }" viewBox="0 0 30 30">
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <g>
                                                                                    <g transform="translate(-454.000000, -716.000000) translate(430.000000, 309.000000) translate(0.000000, 360.000000) translate(0.000000, 32.000000) translate(24.000000, 15.000000)">
                                                                                        <circle cx="15" cy="15" r="15"{{-- fill="#D7D3CF"--}}/>
                                                                                        <path stroke="#FFF" stroke-width="2" d="M9.256 13.55L13.376 18.781 21.256 10.781"/>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </label>
                                                    <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg leading-normal" x-on:click="show = !show;">
                                                        개인 정보 수집 및 활용 동의 (필수)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-left ml-auto mr-2 cursor-pointer" x-on:click="show = !show;">
                                                <img class="w-8 h-8 transform duration-150"
                                                     x-bind:class="{'rotate-180': show}"
                                                     src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                                     alt="icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="h-42 overflow-y-scroll border-t-2 border-solid"
                                        style="border-color:#d7d3cf;"
                                        x-show="show" x-cloak>
                                        <div class="">
                                            <div class="py-6 px-2">
                                        <span class="AppSdGothicNeoR text-white text-base leading-7">
                                            @livewire('privacy')
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('check_2'))
                                <div class="mt-2">
                                    <div class=" text-sm text-tm-c-ff7777">{{$errors->first('check_2') ?? ''}}</div>
                                </div>
                            @endif
                        </div>

                        <div class="cursor-pointer" x-data="{ 'show' : false, 'checked' : @entangle('check_3')}" wire:key="check_3">
                            <input type="checkbox" class="hidden" id="check_3" wire:model="check_3" value="1">
                            <div class="border-2 border-solid rounded-sm" style="border-color:#d7d3cf;">
                                <div class="px-2">
                                    <div class="w-full inline-flex items-center text-sm">
                                        <div class="flex-1">
                                            <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                                <label for="check_3">
                                                    <div class="z-50 cursor-pointer" x-on:click="checked = !checked;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-3 w-6 h-6 rounded-full"
                                                             x-bind:class="{
                                                         'bg-tm-c-d7d3cf': !checked,
                                                         'bg-tm-c-C1A485': checked
                                                         }" viewBox="0 0 30 30">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <g>
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <g transform="translate(-454.000000, -716.000000) translate(430.000000, 309.000000) translate(0.000000, 360.000000) translate(0.000000, 32.000000) translate(24.000000, 15.000000)">
                                                                                    <circle cx="15" cy="15" r="15"{{-- fill="#D7D3CF"--}}/>
                                                                                    <path stroke="#FFF" stroke-width="2" d="M9.256 13.55L13.376 18.781 21.256 10.781"/>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </label>
                                                <div class="flex-1 py-5 cursor-pointer text-base sm:text-lg leading-normal" x-on:click="show = !show;">
                                                    마케팅 수신 동의 (선택)
                                                </div>
                                            </div>
                                        </div>

                                        <div class="float-left ml-auto mr-2 cursor-pointer" x-on:click="show = !show;">
                                            <img class="w-8 h-8 transform duration-150"
                                                 x-bind:class="{'rotate-180': show}"
                                                 src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-dropdown.png"
                                                 alt="icon">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="h-42 overflow-y-scroll border-t-2 border-solid"
                                    style="border-color:#d7d3cf;"
                                    x-show="show" x-cloak>
                                    <div class="">
                                        <div class="py-6 px-2">
                                        <span class="AppSdGothicNeoR text-white text-base leading-7">
                                            @livewire('marketing-agreement')
                                        </span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label for="register_button">
                    <a wire:click="submit" id="register_button">
                        <div class="flex justify-center items-center py-4 h-14 px-3 xs:px-6 text-white form-group row mb-0 bg-tm-c-C1A485 rounded-sm cursor-pointer">
                            {{ __('호텔에삶 가입하기') }}
                        </div>
                    </a>
                </label>
            </div>
        </div>
    </form>
</div>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<script>
    function registerFormCheck(){
        var form = document.getElementById('register-form');
        if(form.name.value === ''){
            alert('성명을 입력해주세요');
            form.name.focus();
            return false;
        }
        if(form.tel.value === '' || form.tel.value.length < 10){
            alert('전화번호를 입력해주세요');
            form.tel.focus();
            return false;
        }
        if(form.password.value === '' || form.password.value.length < 6){
            alert('비밀번호를 입력해주세요');
            form.password.focus();
            return false;
        }
    }
</script>
