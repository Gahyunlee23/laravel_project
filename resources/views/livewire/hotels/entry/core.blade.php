<div class="max-w-1200 mx-auto" x-data="{ tab : @entangle('tab'), tabList:6}">

    <div class="px-4">
        <div>
            <div class="flex py-2 md:py-4">
                <a
                    onclick="if(confirm('확인 클릭 시 호텔 관리 페이지로 넘어갑니다.\n※ 현재 입력 페이지는 저장되지 않습니다.')){
                        location.href='{{route('hotel-manager.hotel-management')}}'
                    }else{ event.stopImmediatePropagation();}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-8" viewBox="0 0 32 33">
                        <g fill="none" fill-rule="evenodd">
                            <g>
                                <path fill="#30373F" d="M0 0H1920V1024H0z" transform="translate(-360 -114)"/>
                                <g>
                                    <g>
                                        <path stroke="#FFF" stroke-width="2" d="M3 16L16 30 29 16" transform="translate(-360 -114) translate(360 114) rotate(90 15.75 16.25)"/>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
        @isset($tab)
            <div class="flex justify-between">
                <div class="JeJuMyeongJo text-2xl md:text-3xl lg:text-4xl text-white">
                    입점 신청하기
                </div>
                <div class="ml-auto flex text-xl">
                    <div class="text-white h-2 px-1">{{$tab ?? 1}}</div>
                    <div class="text-white h-2 px-1">/</div>
                    <div class="text-white h-2 px-1">6</div>
{{--                    <template x-for="(item, index) in tabList" :key="index">--}}
{{--                        <div class="w-1/6 h-2 px-1">--}}
{{--                            <div class="h-full"--}}
{{--                                 x-text="item"--}}
{{--                                 x-on:click="locationHref(item,'{{$addHotel->id}}')"--}}
{{--                                 :class="{--}}
{{--                                'text-white' : (item*1) === (tab*1),--}}
{{--                                'text-tm-c-979b9f' : (item*1) !== (tab*1),--}}
{{--                            }"></div>--}}
{{--                        </div>--}}
{{--                    </template>--}}
                </div>
            </div>
            @switch($tab)
                    @case(1)
                        <livewire:hotels.entry.hotel-images-and-check-points :add-hotel="$addHotel"></livewire:hotels.entry.hotel-images-and-check-points>
                    @break
                    @case(2)
                        <livewire:hotels.entry.room-types :add-hotel="$addHotel"></livewire:hotels.entry.room-types>
                    @break
                    @case(3)
                        <livewire:hotels.entry.benefits :add-hotel="$addHotel"></livewire:hotels.entry.benefits>
                    @break
                    @case(4)
                        <livewire:hotels.entry.items :add-hotel="$addHotel"></livewire:hotels.entry.items>
                    @break
                    @case(5)
                        <livewire:hotels.entry.amenities-facilities :add-hotel="$addHotel"></livewire:hotels.entry.amenities-facilities>
                    @break
                    @case(6)
                        <livewire:hotels.entry.other :add-hotel="$addHotel"></livewire:hotels.entry.other>
                    @break

            @endswitch
        @endisset
    </div>


    <div class="max-w-1200 w-full fixed bottom-0 mx-auto px-4">
        <div class="flex">
            <template x-for="(item, index) in tabList" :key="index">
                <div class="w-1/6 h-2 px-1">
                    <div class="h-full bg-white"
                         x-bind:data="item"
                         :class="{
                            'opacity-20' : (item*1) > (tab*1)
                        }"></div>
                </div>
            </template>
        </div>
    </div>
</div>
<script>
    window.addEventListener('https-url-state-change', event => {
        windowHistoryStatePush(event.detail);
    })
    function windowHistoryStatePush(data){
        window.history.pushState (null, "호텔에삶 State change", "https://www.livinginhotel.com/hotel-entry/"+data.tab);
    }
    function locationHref(tab,hotel){
        var href = '{{route('hotel-entry.hotel')}}/'+hotel;
        if(tab!=='' && tab!==null){
            href+='/'+tab;
        }
        location.href=href;
    }
</script>

<style>
    ::-webkit-scrollbar-track {
        background-color: rgba(141, 138, 135, 0.5);
    }
    ::-webkit-scrollbar-thumb {
        background-color: rgb(255,255,255);
    }
    ::-webkit-calendar-picker-indicator {
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 24 24"><path fill="%23bbbbbb" d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/></svg>');
    }
    ::-webkit-calendar-picker-indicator {
        /*padding-left: 50%;*/
    }
</style>
