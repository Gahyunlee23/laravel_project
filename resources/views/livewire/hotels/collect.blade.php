<div
    x-data="{tab : '{{$tab}}'}">
    <div class="flex justify-center select-none">

        <div class="w-full py-2 px-4 space-y-2">
            <div>
                <div class="flex">
                    @foreach ($tabs as $in_tab)
                        <div class="flex-1"
                            onclick="GA_event('호텔모아보기_탭 전환',['{{$in_tab}}'])"
                            wire:click="$emitSelf('tabChange','{{$in_tab}}');">
                            <div class="py-3 AppSdGothicNeoR text-lg sm:text-xl px-2 cursor-pointer"
                                 :class="{
                                'text-white font-bold' : tab === '{{$in_tab}}',
                                'text-tm-c-979b9f font-normal' : tab !== '{{$in_tab}}'
                            }">
                                {{$in_tab}}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center">
                    @foreach ($tabs as $in_tab)
                        <div class="flex-1 bg-white"
                             :class="{
                                'h-1' : tab === '{{$in_tab}}',
                                'h-px' : tab !== '{{$in_tab}}'
                            }">
                        </div>
                    @endforeach
                </div>
            </div>

            @isset($depths)
            <div>
                <div class="flex flex-wrap">
                    @foreach ($depths as $item)
                        <div class="w-1/2 4xs:w-1/3 sm:w-1/4 lg:flex-1 px-1 my-1">
                            <div class="w-full px-2 py-3 rounded-sm AppSdGothicNeoR font-medium text-center border border-solid"
                                 onclick="GA_event('호텔모아보기_뎁스 전환',['{{$item}}'])"
                                 wire:click="$emitSelf('depthChange','{{$item}}');"
                                :class="{
                                    'text-tm-c-30373F border-white bg-white' : '{{$item}}'==='{{$depth}}',
                                    'text-white border-tm-c-979b9f cursor-pointer' : '{{$item}}'!=='{{$depth}}',
                                }">
                                {{$item}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endisset

            @isset($tabImage)
            <div
                 style="@if($tab==='서울') background-image: linear-gradient(95deg, #615f5d 5%, #5d646d 97%);
                 @elseif($tab==='부산') background-image: linear-gradient(95deg, #394653 5%, #8198af 97%);
                 @else background-image: linear-gradient(95deg, #575757 5%, #786862 97%);@endif">
                <div class="py-4 md:py-12"
                     style="background-image: url('{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource'.$tabImage)}}');
                         background-size: 50% 100%;background-repeat: no-repeat;background-position-x: 100%; @if($tab==='경기ㆍ인천') --tw-backdrop-opacity: opacity(0.9); @endif">
                    <div class="pl-8 md:pl-14 space-y-3 md:space-y-4">
                        <div class="JeJuMyeongJo text-2xl md:text-3xl text-white">
                            {{$tab !== '전체' ? $tab : null }} {{ Str::of($titleEN[$tabIndex])->ucfirst() }}
                        </div>
                        <div class="JeJuMyeongJo text-base md:text-lg text-white">
                            {{$explanation[$tabIndex] ?? ''}}
                        </div>
                    </div>
                </div>
            </div>
            @endisset
        <!-- 전체보기 탭일 경우, 검색바 -->
            @if($tab === '전체')
            <div class="pt-4" x-data="{
                searchBar : @entangle('searchBar'),
                clearButton : false
            }">
                <div class="border border-solid rounded-full flex relative">

                    <div class="h-full pr-4 absolute top-0 right-0 cursor-pointer" wire:click="$set('searchBar','')"
                        x-show="clearButton" x-cloak
                         x-bind:class="{
                            'hidden' : !clearButton,
                            'hidden' :  searchBar===''
                        }">
                        <div class="h-full flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <g>
                                            <g transform="translate(-1514.000000, -473.000000) translate(360.000000, 458.000000) translate(1154.000000, 15.000000)">
                                                <circle cx="15" cy="15" r="15" fill="#C1A485"/>
                                                <path stroke="#FFF" stroke-width="2" d="M10 10L19.475 19.475M10 19.475L19.475 10"/>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24">
                            <g fill="none" fill-rule="evenodd">
                                <g>
                                    <g>
                                        <g transform="translate(-384.000000, -476.000000) translate(360.000000, 458.000000) translate(24.000000, 18.000000)">
                                            <circle cx="10" cy="10" r="8" stroke="#C1A485" stroke-width="2"/>
                                            <path fill="#C1A485" d="M18.389 13.889H20.389V23.889H18.389z" transform="translate(19.389087, 18.889087) rotate(-45.000000) translate(-19.389087, -18.889087)"/>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="pl-2 w-full">
                        <input type="text" wire:model.lazy="searchBar" x-on:keyup="if($(this).length>=1){ clearButton=true;}else{clearButton=false;}"
                               class="w-3/4 h-full py-4 sm:py-5 bg-tm-c-30373F border-none border-0 focus:outline-none text-white placeholder-tm-c-979b9f" placeholder="호텔명을 검색해주세요">
                    </div>
                </div>
            </div>


            @endif
            @if(isset($list) && $list->count() >= 1)
            <div class="py-4" wire:loading.remove>
                <div class="flex flex-wrap">
                    @foreach ($list as $item)
                        <x-hotels.collect.lists widthClass="w-full md:w-1/2" :item="$item" :curator="$curator" :loop-index="$loop"></x-hotels.collect.lists>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="w-full py-4" wire:loading>
                <div class="py-20 sm:py-32 flex justify-center">
                    <livewire:form.loading
                        type="dots-loading"></livewire:form.loading>
                </div>
            </div>
            @if($list->count()===0)
                <div class="w-full py-4">
                    <div class="py-20 sm:py-32 flex justify-center">
                        <livewire:form.loading
                            type="not-lists"
                            iconColorClass="text-white"
                            loadingText="호텔 없음"
                            loadingColorClass="text-white"
                        ></livewire:form.loading>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

<script type="application/javascript" src="https://dofran75um95u.cloudfront.net/js/frontend/swiper/v6.3.4-swiper-bundle.min.js"></script>
<script type="text/javascript">
    window.addEventListener('collect-swiper-re-init', event => {
        observer.observe();
    });
    window.addEventListener('https-url-state-change', event => {
        windowHistoryStatePush(event.detail);
    });
    window.addEventListener('imagesLoad', event => {
        observer.observe();
    });

    function windowHistoryStatePush(data){
        if(data.depth===undefined){
            if(data.curator !== null){
                window.history.pushState (null, "호텔에삶 State change", "https://www.livinginhotel.com/hotels/collect/"+data.tab+"/"+data.curator);
            }else{
                window.history.pushState (null, "호텔에삶 State change", "https://www.livinginhotel.com/hotels/collect/"+data.tab);
            }
        }else{
            if(data.curator !== null){
                window.history.pushState (null, "호텔에삶 State change", "https://www.livinginhotel.com/hotels/collect/"+data.tab+"/"+data.depth+"/"+data.curator);
            }else{
                window.history.pushState (null, "호텔에삶 State change", "https://www.livinginhotel.com/hotels/collect/"+data.tab+"/"+data.depth);
            }
        }
    }

    function GA_event_up(id,index){
        if($('.swiper-container').length === 1){
            GA_event('호텔모아보기_호텔 바로가기',[id, imagesSwiper.realIndex]);
        }else{
            GA_event('호텔모아보기_호텔 바로가기',[id, imagesSwiper[index].realIndex]);
        }
    }

</script>
