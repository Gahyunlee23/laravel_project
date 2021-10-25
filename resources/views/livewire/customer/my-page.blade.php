<div x-data="{page:'{{$page}}'}">
    <div class="flex flex-wrap items-center">
        <div class="JeJuMyeongJo text-lg 2xs:text-xl xs:text-3xl text-white space-y-1 xs:space-y-2">
            <div>
                {{ auth()->user()->name ?? '고객' }}님의
            </div>
            <div>
                마이페이지입니다.
            </div>
        </div>

        <div class="flex ml-auto">
            <a href="{{route('my-page.edit')}}">
                <div class="flex-col justify-center cursor-pointer mr-4">
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
            </a>
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

{{--    <div class="pt-4 flex">--}}
{{--        <div class="border border-solid border-white border-opacity-75 rounded-full">--}}
{{--            <div class="px-2 xs:px-4 py-2 xs:py-3 flex space-x-2 sm:space-x-4 sm:space-x-6 md:space-x-8 lg:space-x-12">--}}
{{--                <div class="flex items-center px-2 xs:px-4 py-1 space-x-2 xs:space-x-3">--}}
{{--                    <div class="AppleSDGothicNeo text-base xs:text-xl text-white font-bold">--}}
{{--                        보유 포인트--}}
{{--                    </div>--}}
{{--                    <div class="AppleSDGothicNeo text-base xs:text-xl text-tm-c-C1A485 hover:text-tm-c-897763">--}}
{{--                        {{number_format(12345)}}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="flex items-center px-2 xs:px-4 py-1 space-x-2 xs:space-x-3 border-l-2 border-white">--}}
{{--                    <div class="AppleSDGothicNeo text-base xs:text-xl text-white font-bold ">--}}
{{--                        보유 쿠폰--}}
{{--                    </div>--}}
{{--                    <div class="AppleSDGothicNeo text-base xs:text-xl text-tm-c-C1A485 hover:text-tm-c-897763">--}}
{{--                        2장--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="flex items-center py-1">--}}
{{--                    <div>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">--}}
{{--                            <g fill="none" fill-rule="evenodd">--}}
{{--                                <g>--}}
{{--                                    <path fill="#30373F" d="M0 0H1920V1471H0z" transform="translate(-819 -279)"/>--}}
{{--                                    <g>--}}
{{--                                        <g transform="translate(-819 -279) translate(360 140) translate(0 125.5)">--}}
{{--                                            <rect width="499" height="51" x=".5" y=".5" stroke="#FFF" opacity=".8" rx="25.5"/>--}}
{{--                                            <g>--}}
{{--                                                <path stroke="#FFF" stroke-width="2" d="M2.25 6.75L12 17.25 21.75 6.75" transform="rotate(-90 249 -211)"/>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                </g>--}}
{{--                            </g>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="py-10">
        <div x-show="page==='main'">
            <div x-data="{ tab : '{{$tab ?? "alert-lists"}}' }">
                <div class="flex pb-2">
                    <div class="flex-1 border-solid border-white cursor-pointer" @click="tab='alert-lists'"
                         wire:click="$emit('viewAlertListsEvent');"
                         :class="{ 'border-b-4' : tab === 'alert-lists', 'border-b' : tab !== 'alert-lists' }">
                        <div class="flex items-center text-white pb-3 space-x-2">
                            <div class="flex text-base 2xs:text-lg sm:text-xl">알림톡</div>
                            <div>
                                <livewire:customer.list-count type="alert_lists"></livewire:customer.list-count>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 border-solid border-white cursor-pointer" @click="tab='month-lists'"
                         wire:click=$emit('viewPaymentListsEvent')"
                         :class="{ 'border-b-4' : tab === 'month-lists', 'border-b' : tab !== 'month-lists' }">
                        <div class="flex items-center text-white pb-3 space-x-2">
                            <div class="flex text-base 2xs:text-lg sm:text-xl">결제 상품 현황</div>
                            <div>
                                <livewire:customer.list-count type="month_lists"></livewire:customer.list-count>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 border-solid border-white cursor-pointer" @click="tab='tour-lists'"
                         wire:click="$emit('viewTourListsEvent');"
                         :class="{ 'border-b-4' : tab === 'tour-lists', 'border-b' : tab !== 'tour-lists' }">
                        <div class="flex items-center text-white pb-3 space-x-2">
                            <div class="flex text-base 2xs:text-lg sm:text-xl">투어 신청 현황</div>
                            <div>
                                <livewire:customer.list-count type="tour_lists"></livewire:customer.list-count>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 메뉴 탭 Start--}}
                <div class="pt-2 sm:pt-4">
                    <div x-show="tab==='alert-lists'">
                        <div>
                            <livewire:customer.alert-lists></livewire:customer.alert-lists>
                        </div>
                    </div>
                    <div x-show="tab==='month-lists'" x-cloak>
                        <div>
                            <livewire:customer.month-lists></livewire:customer.month-lists>
                        </div>
                    </div>
                    <div x-show="tab==='tour-lists'" x-cloak>
                        <div>
                            <livewire:customer.tour-lists></livewire:customer.tour-lists>
                        </div>
                    </div>
                </div>
                {{-- 메뉴 탭 End--}}
            </div>
        </div>

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
