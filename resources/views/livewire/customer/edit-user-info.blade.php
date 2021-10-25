<div x-data="{page:'{{$page}}'}">
    <div class="flex flex-wrap items-center">
        <div class="JeJuMyeongJo text-lg 2xs:text-xl xs:text-3xl text-white space-y-1 xs:space-y-2">
            <div>
                개인정보
            </div>
        </div>

        <div class="flex ml-auto">
            <div class="flex-col justify-center cursor-pointer mr-4"
                 @click="page='change-personal-information'">
                <div class="flex justify-center">
                    <div class="bg-tm-c-ED rounded-full">
                        <div class="px-2 py-2 AppSdGothicNeoR text-base sm:text-lg text-black leading-snug">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 15">
                                    <g fill="none" fill-rule="evenodd" stroke-linejoin="round">
                                        <g stroke="#30373F">
                                            <g>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path d="M10 3c0 1.656-1.344 3-3 3S4 4.656 4 3s1.344-3 3-3 3 1.344 3 3z" transform="translate(-1461 -270) translate(360 140) translate(1083 122.5) translate(11) translate(8 8)"/>
                                                            <path stroke-linecap="round" d="M14 14H0v-1.072C0 10.207 1.967 8 4.394 8h5.212C12.033 8 14 10.207 14 12.928V14z" transform="translate(-1461 -270) translate(360 140) translate(1083 122.5) translate(11) translate(8 8)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-2 text-sm text-white">개인정보</div>
            </div>

            <div class="flex-col justify-center cursor-pointer">
                <a class="cursor-pointer"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <div class="flex justify-center">
                    <div class="bg-tm-c-ED rounded-full">
                        <div class="px-2 py-2 AppSdGothicNeoR text-base sm:text-lg text-black leading-snug">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 15 17">
                                <g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                    <g stroke="#30373F">
                                        <g>
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M0 2.697L0 0 10.606 0 10.606 15.556 0 15.556 0 12.925" transform="translate(-1524 -269) translate(360 140) translate(1145 122.5) translate(11) translate(9 7) matrix(-1 0 0 1 10.606 0)"/>
                                                        <g>
                                                            <path d="M0 2.609L5.885 2.609M3.706 0L6.315 2.609 3.706 5.217" transform="translate(-1524 -269) translate(360 140) translate(1145 122.5) translate(11) translate(9 7) translate(6.843 4.95)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="pt-2 text-sm text-white">로그아웃</div>
                </a>
            </div>
        </div>
    </div>


    <div class="py-10">
        <livewire:auth.modify-password></livewire:auth.modify-password>
    </div>

</div>
<script src="//developers.kakao.com/sdk/js/kakao.min.js" defer></script>
<script>
    window.onload=function (){
        if('{{$tab}}' === 'alert-lists' || '{{$tab}}' === ''){
            Livewire.emit('viewAlertListsEvent');
        }else if('{{$tab}}' === 'tour-lists'){
            Livewire.emit('viewTourListsEvent');
        }else if('{{$tab}}'==='month-lists'){
            Livewire.emit('viewPaymentListsEvent');
        }
    }

    window.addEventListener('https-url-state-change', event => {
        windowHistoryStatePush(event.detail);
        //console.log(event.detail);
    })
    function windowHistoryStatePush(data){
        window.history.pushState (null, "호텔에삶 State change", "https://www.livinginhotel.com/my-page/"+data.tab);
    }

    function kakaoOnetoOne(){
        Kakao.init('1aaa3ea4fe5abbbce1c720570e59f3f3');
        Kakao.Channel.chat({
            channelPublicId: '{{env('KAKAO_CHAT_ID')}}' // 카카오톡 채널 홈 URL에 명시된 id로 설정합니다.
        });
        setTimeout(function () {
            Kakao.cleanup();
        },2000);
    }
</script>
