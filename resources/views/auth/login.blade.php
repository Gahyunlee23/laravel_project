@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-4 px-2"
     x-data="{ process : 'login' }">
    @php
        if('https://'.request()->getHost().'/'.request()->route()->getName() !== url()->previous()){
            session(['redirect'=>url()->previous()]);
        }
    @endphp
    <div class="row justify-content-center max-w-1200 mx-auto">
        <div>
            <div class="mb-3 text-white text-xl">
                <div x-show="process==='login'">
                    <a href="{{route('/')}}">
                        <i class="fas fa-home-lg-alt cursor-pointer hover:text-tm-c-0D5E49"></i>
                    </a>
                </div>
                <div x-show="process!=='login'" x-cloak>
                    <i class="fas fa-chevron-left cursor-pointer hover:text-tm-c-0D5E49" @click="process = 'login'"></i>
                </div>
            </div>
            <div>
                <div class="JeJuMyeongJo text-4xl text-white select-none">
                    <span x-show="process==='login'">
                        {{ __('로그인') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="w-full sm:max-w-xl md:max-w-2xl mx-auto">
            <div>
                <div class="mt-4 px-8 py-6">
                    <div class="" x-show="process==='login'">
                        <form method="POST" class="space-y-4" action="{{ route('login') }}">
                            @method('post')
                            @csrf
                            <div class="flex space-x-2">
                                <div class="w-full space-y-2">
                                    <div class="form-group row">
                                        <div class="">
                                            <input name="email" id="email" type="email"
                                                   class="AppSdGothicNeoR appearance-none w-full h-14 px-1 text-white border-b border-solid border-white outline-none bg-transparent"
                                                   value="{{ request('email') ?? old('email') }}" placeholder="이메일 아이디 입력" required autocomplete="off" autofocus>
                                            @error('email')
                                            <div class="mt-1" role="alert">
                                                <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="">
                                            <input name="password" id="password" type="password"
                                                   class="AppSdGothicNeoR appearance-none w-full h-14 px-1 text-white border-b border-solid border-white outline-none bg-transparent"
                                                   required autocomplete="current-password" placeholder="비밀번호 입력">
                                            @error('password')
                                            <div class="mt-1" role="alert">
                                                <div class="text-sm text-tm-c-ff7777">{{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2 flex justify-center">
                                <a href="{{route('user.password-search')}}">
                                    <div class="AppSdGothicNeoR text-tm-c-979b9f underline text-xs sm:text-sm text-center cursor-pointer">
                                        비밀번호 찾기
                                    </div>
                                </a>
                            </div>

                            <div class="w-full" style="min-width: 70px;">
                                <label for="login_button">
                                    <div class="flex justify-center items-center form-group row mb-0 bg-tm-c-C1A485 rounded-sm cursor-pointer">
                                        <button type="submit" id="login_button" class="w-full h-14 form-control text-white">
                                            {{ __('로그인') }}
                                        </button>
                                    </div>
                                </label>
                            </div>

                            <div class="py-4">
                                <div class="flex items-center justify-center text-center">
                                    <div class="w-2/5 h-px bg-white"></div>
                                    <div class="w-1/5 PTSerif italic font-bold text-white">
                                        or
                                    </div>
                                    <div class="w-2/5 h-px bg-white"></div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <a href="{{route('login_social',['type'=>'kakao', 'route'=>'register.completed', 'redirect'=>url()->previous()])}}">
                                    <div class="flex justify-center items-center py-4 bg-tm-c-30373F rounded-sm border-2 border-solid border-tm-c-C1A485">
                                        <div class="pr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16">
                                            <g fill="none" fill-rule="evenodd">
                                                <g fill="#C1A485">
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <g>
                                                                    <path d="M9 0c4.97 0 9 3.129 9 6.989s-4.03 6.988-9 6.988c-.95 0-1.864-.114-2.723-.325-2.1 1.71-3.192 2.485-3.277 2.322-.086-.165.127-1.289.64-3.37C1.43 11.328 0 9.288 0 6.988 0 3.129 4.03 0 9 0z" transform="translate(-895 -634) translate(710 341) translate(0 152) translate(0 124) translate(185 17)"/>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        </div>
                                        <div class="AppSdGothicNeoR text-tm-c-C1A485 text-lg font-medium">
                                            카카오톡 로그인
                                        </div>
                                    </div>
                                </a>
                                <div>
                                    <a href="{{route('user.register')}}">
                                        <div class="AppSdGothicNeoR flex justify-center py-4 bg-tm-c-30373F rounded-sm border-2 border-solid border-tm-c-C1A485 cursor-pointer">
                                            <div class="AppSdGothicNeoR text-tm-c-C1A485 text-lg font-medium">
                                                호텔에삶 회원가입
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div x-show="process==='register'" x-cloak>
                        <livewire:auth.basic-register></livewire:auth.basic-register>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@push('scripts')
<script>
    function displayMessage(message,catalog) {
        toastr.success(message, catalog);
    }
    // $(document).ready(function(){
    //     $(document).bind('keydown',function(e){
    //         if ( e.keyCode === 123  ||
    //             ((e.ctrlKey && e.shiftKey && e.keyCode === 73) ||
    //                 (e.ctrlKey && e.shiftKey && e.keyCode === 74) ||
    //                 (e.ctrlKey && e.shiftKey && e.keyCode === 67))) {
    //             e.preventDefault();
    //             e.returnValue = false;
    //             alert('개발자 도구(F12) 접근이 불가능합니다');
    //         }
    //     });
    // });
    //
    // !function() {
    //     function detectDevTool(allow) {
    //         if(isNaN(+allow)) allow = 100;
    //         var start = +new Date();
    //         debugger;
    //         var end = +new Date();
    //         if(isNaN(start) || isNaN(end) || end - start > allow) {
    //             alert('개발자 도구 접근으로 모든 작업 종료됩니다.');
    //             location.reload();
    //         }
    //     }
    //
    //     if(window.attachEvent) {
    //         if (document.readyState === "complete" || document.readyState === "interactive") {
    //             detectDevTool();
    //             window.attachEvent('onresize', detectDevTool);
    //             window.attachEvent('onmousemove', detectDevTool);
    //             window.attachEvent('onfocus', detectDevTool);
    //             window.attachEvent('onblur', detectDevTool);
    //         } else {
    //             setTimeout(argument.callee, 0);
    //         }
    //     } else {
    //         window.addEventListener('load', detectDevTool);
    //         window.addEventListener('resize', detectDevTool);
    //         window.addEventListener('mousemove', detectDevTool);
    //         window.addEventListener('focus', detectDevTool);
    //         window.addEventListener('blur', detectDevTool);
    //     }
    // }();
</script>
@endpush
