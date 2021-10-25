<div class="absolute top-0 left-0 z-50" x-data="{ infoShow : false }">

    <div class="fixed w-full h-full bg-gray-700 bg-opacity-50">
        <div class="flex h-full items-center justify-center px-4">
            <div class="w-full max-w-md bg-tm-c-ED bg-opacity-90 rounded-md">
                <div class="relative">
                    <div class="px-6 sm:px-8 py-5 sm:py-6">
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="space-y-2">
                                    <div class="AppSdGothicNeoR font-bold text-xl text-tm-c-30373F leading-7 tracking-wider">
{{--                                        <div>--}}
{{--                                            휴대전화 번호 인증을 하시면--}}
{{--                                        </div>--}}
{{--                                        <div>--}}
{{--                                            다양한 혜택을 드립니다 :)--}}
{{--                                        </div>--}}
                                        <div>
                                            {{--입주 시 본인 확인을 위해--}}
                                            마이페이지 이용은<br>회원가입 처리 동의 후 가능합니다.
                                        </div>
                                        {{--<div>
                                            휴대전화 번호 인증을 해주시기 바랍니다.
                                        </div>--}}
                                    </div>
{{--                                    <div class="AppSdGothicNeoR text-sm text-tm-c-30373F leading-7">--}}
{{--                                        인증을 완료 하신 회원님께 드리는 혜택!--}}
{{--                                    </div>--}}
                                </div>
                                <div class="ml-auto">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="cursor-pointer"
                                       onclick="event.preventDefault();
                                       if(confirm('`호텔에삶` 인증 후 마이페이지 이용 가능합니다 :)\n취소 후 인증 진행해주세요.')){
                                            document.getElementById('logout-form').submit();
                                       }">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                            <g fill="none" fill-rule="evenodd">
                                                <g stroke="#C1A485" stroke-width="2">
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <path d="M7 24.949L25.949 6M7 6L25.949 24.949" transform="translate(-1336 -172) translate(938 148) translate(397 24) translate(.5)"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
{{--                            <div class="flex justify-center items-center space-x-2 pt-2">--}}
{{--                                <div class="flex-1 text-center leading-5 rounded-sm shadow-lg">--}}
{{--                                    <div>--}}
{{--                                        <div class="bg-tm-c-d7d3cf AppSdGothicNeoR font-bold text-sm text-white pt-2 pb-1">--}}
{{--                                            혜택 1--}}
{{--                                        </div>--}}
{{--                                        <div class="AppSdGothicNeoR text-sm text-tm-c-30373F bg-white pt-2 pb-1">--}}
{{--                                            <div class="">--}}
{{--                                                결제 시 회원 등급--}}
{{--                                            </div>--}}
{{--                                            <div>--}}
{{--                                                구분 없이 적립금 지급--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="flex-1 text-center leading-5 rounded-sm shadow-lg">--}}
{{--                                    <div>--}}
{{--                                        <div class="bg-tm-c-d7d3cf AppSdGothicNeoR font-bold text-sm text-white pt-2 pb-1">--}}
{{--                                            혜택 2--}}
{{--                                        </div>--}}
{{--                                        <div class="AppSdGothicNeoR text-sm text-tm-c-30373F bg-white pt-2 pb-1">--}}
{{--                                            <div>--}}
{{--                                                결제 시 회원 등급--}}
{{--                                            </div>--}}
{{--                                            <div>구분 없이 적립금 지급</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="AppSdGothicNeoR space-y-1 pt-5">
                                <div class="flex items-center justify-center bg-tm-c-C1A485 hover:bg-tm-c-897763 rounded-sm">
                                    <a class="w-full h-full py-4 cursor-pointer" onclick="event.preventDefault();document.getElementById('auth-form').submit();">
                                        <div class="text-center text-white">
                                            마이페이지 보러가기
                                        </div>
                                        <form id="auth-form" action="{{ route('customer.auth-form') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
{{--                                <div class="flex items-center justify-center border border-solid border-tm-c-C1A485 rounded-sm">--}}
{{--                                    <a class="w-full h-full py-4 cursor-pointer"--}}
{{--                                       onclick="if(confirm('혜택 받지 않기 선택시, 로그아웃 됩니다.')){--}}
{{--                                       event.preventDefault();document.getElementById('logout-form').submit();--}}
{{--                                   }">--}}
{{--                                        <div class="flex flex-wrap justify-center text-tm-c-30373F">--}}
{{--                                            혜택 받지 않기--}}
{{--                                        </div>--}}
{{--                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                            @csrf--}}
{{--                                        </form>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
