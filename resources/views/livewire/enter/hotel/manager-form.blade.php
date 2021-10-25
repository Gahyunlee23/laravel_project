<div
    x-data="{ formDisabled : @entangle('submitDisabled'), emailError : '{{$errors->has("email")}}', emailCertifiedTimer:0, email: @entangle('email') }"
    class="mx-auto sm:max-w-xl md:max-w-2xl">
    <div class="h-full space-y-8">
        <div class="space-y-3">
            <div class="AppSdGothicNeoR font-semibold text-lg text-tm-c-d7d3cf">
                가입 정보
            </div>
            <div class="space-y-4">
                <div>
                    <div class="relative">
                        <input type="email" wire:model="email" autocomplete="off"
                               class="w-full py-5 px-6 bg-transparent text-white border border-solid @error('email') border-tm-c-da5542 @else border-white @enderror rounded-sm focus:outline-none"
                               placeholder="이메일 아이디 입력"
                        >
                        <div class="absolute top-0 right-0 mt-3 mr-3" style="height : calc( 100% - 22px );">
                            <button
                                x-show="emailCertifiedTimer===0"
                                class="h-full flex items-center justify-center rounded-sm px-6 focus:outline-none"
                                :disabled="(email==='')"
                                :class="{
                                    'bg-tm-c-d7d3cf cursor-default' : ((email==='' && '{{$certified_process}}'!=='1') || '{{$errors->has("email")}}'==='1'),
                                    'bg-tm-c-C1A485' : (email!=='' || '{{$certified_process}}'==='1'),
                                }"
                                @if(!$errors->has('email') && $email !== '')
                                x-on:click="emailCertifiedTimer=15;$Interval = setInterval(function(){ emailCertifiedTimer--; if(emailCertifiedTimer===0){ clearInterval($Interval); } },1000);"
                                wire:click="emailCertified"
                                @endif
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

                <div>
                    <div class="relative">
                        <input type="text" maxlength="6" wire:model="certifiedKey"
                               @if(!$certified_process)
                               disabled="disabled"
                               @endif
                               class="w-full py-5 px-6 bg-transparent text-white border border-solid @error('certifiedKey') border-tm-c-da5542 @else border-white @enderror rounded-sm focus:outline-none"
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

                <div>
                    <div class="relative">
                        <input type="password" wire:model.lazy="password"
                               maxlength="20"
                               class="w-full py-5 px-6 bg-transparent text-white border border-solid @error('password') border-tm-c-da5542 @else border-white @enderror rounded-sm focus:outline-none"
                               placeholder="비밀번호 입력"
                        >
                    </div>
                    @error('password')
                    <div class="mt-2" role="alert">
                        <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                    </div>
                    @enderror
                </div>

                <div>
                    <div class="relative">
                        <input type="password" wire:model.lazy="password_confirmation"
                               maxlength="20"
                               class="w-full py-5 px-6 bg-transparent text-white border border-solid @error('password_confirmation') border-tm-c-da5542 @else border-white @enderror rounded-sm focus:outline-none"
                               placeholder="비밀번호 재입력"
                        >
                        @if(\Illuminate\Support\Str::of($password)->length()>=8 && $password && !$errors->has('password') &&  !$errors->has('password_confirmation') )
                            <div class="absolute top-0 right-0 mt-3 mr-5" style="height : calc( 100% - 22px );"
                                 :class="{'hidden' : '{{$password}}'!=='{{$password_confirmation}}'}">
                                <div class="h-full flex items-center justify-center">
                                    <div class="text-base text-tm-c-C1A485">비밀번호 일치</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('password_confirmation')
                    <div class="mt-2" role="alert">
                        <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                    </div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="space-y-3">
            <div class="AppSdGothicNeoR font-semibold text-lg text-tm-c-d7d3cf">
                동의 여부
            </div>
            <div>
                <div class="space-y-2 sm:space-y-3">
                    <div class="cursor-pointer" x-data="{ 'checked' : @entangle('check_all')}" wire:key="all">
                        <input type="checkbox" class="hidden" id="check_all" wire:model="check_all" value="1">
                        <div class="border border-solid rounded-sm border-tm-c-d7d3cf">
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

                    <div class="cursor-pointer" x-data="{ 'show' : false, 'checked' : @entangle('check_0')}" wire:key="0">
                        <input type="checkbox" class="hidden" id="check_0" wire:model="check_0" value="1">
                        <div class="border border-solid rounded-sm border-tm-c-d7d3cf">
                            <div class="px-2">
                                <div class="w-full inline-flex items-center text-sm">
                                    <div class="flex-1">
                                        <div class="flex items-center AppSdGothicNeoR text-lg text-white">
                                            <label for="check_0">
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
                                                입점사 이용약관 (필수)
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
                                <div>
                                    <div class="py-6 px-2">
                                        <span class="AppSdGothicNeoR text-white text-base leading-7">
                                            @livewire('conditions-of-store-company')
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('check_0'))
                        <div class="mt-2">
                            <div class=" text-sm text-tm-c-ff7777">{{$errors->first('check_0') ?? ''}}</div>
                        </div>
                    @endif

                    <div class="cursor-pointer" x-data="{ 'show' : false, 'checked' : @entangle('check_1')}" wire:key="1">
                        <input type="checkbox" class="hidden" id="check_1" wire:model="check_1" value="1">
                        <div class="border border-solid rounded-sm" style="border-color:#d7d3cf;">
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

                    <div class="cursor-pointer" x-data="{ 'show' : false, 'checked' : @entangle('check_2')}" wire:key="2">
                        <input type="checkbox" class="hidden" id="check_2" wire:model="check_2" value="1">
                        <div class="border border-solid rounded-sm" style="border-color:#d7d3cf;">
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
                                                개인정보 수집 및 활용 동의 (필수)
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
            </div>
        </div>

        @if($errors->has('error'))
            <div class="text-sm text-tm-c-ff7777">{{$errors->first('error') ?? ''}}</div>
        @endif
        @if (session()->has('status-error'))
            <div class="text-sm text-tm-c-ff7777">{{session('status-error') ?? ''}}</div>
        @endif
        @if (session()->has('status-success'))
            <div class="text-sm text-tm-c-white">{{session('status-success') ?? ''}}</div>
        @endif

        <div class="w-full left-0 pb-4 sm:px-0 sm:relative" >
            <button class="py-5 w-full rounded-sm cursor-pointer disabled:bg-tm-c-d7d3cf bg-tm-c-C1A485"
                    wire:loading.attr="disabled"
{{--                    :disabled="formDisabled"--}}
                    wire:click="FormSubmit">
                <div class="flex items-center justify-center">
                    <div class="flex flex-wrap items-center text-lg text-white leading-normal">
                        <svg wire:loading wire:target="FormSubmit"
                             class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        호텔 매니저 가입하기
                    </div>
                </div>
            </button>
            <div class="mt-4 text-white text-sm">
                ※ 기존 가입한 호텔 매니저는 우측 상단 로그인을 이용해주세요
            </div>
        </div>
    </div>
</div>
