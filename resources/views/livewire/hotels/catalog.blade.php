<div
    x-data="{tab : '{{$tab}}'}" wire:init="catalogLoad">
    @if($load)
    <div class="flex justify-center select-none">
        <div class="relative w-full pt-2 pb-8 sm:pb-8 px-2 md:px-4 space-y-2">
            <div class="flex justify-center pb-4 sm:pb-2 md:pb-8">
                <div class="flex">
                    @foreach ($tabs as $tabName)
                        <div class="flex flex-wrap justify-center pb-10 sm:pb-14"
                             wire:click="$emitSelf('tabChange','{{$tabName}}');">
                            <div class="inline-block px-3 sm:px-4 py-2 sm:py-4 PtSerif italic text-lg sm:text-3xl cursor-pointer tracking-normal"
                                 :class="{
                                     'text-white font-bold border-b-2 sm:border-b-4 border-solid border-white' : tab === '{{$tabName}}',
                                     'text-tm-c-979b9f font-normal' : tab !== '{{$tabName}}'
                                     }">
                                {{ Str::of($titleEN[$loop->index])->studly() }}
                            </div>
                            <div class="absolute left-0 w-full pt-4 mt-10 sm:mt-20"
                                 :class="{
                                 'hidden' : tab !== '{{$tabName}}'
                                 }">
                                <div class="flex justify-center">
                                    <div class="JeJuMyeongJo text-sm sm:text-lg text-white">
                                        {{$explanation[$loop->index]}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if(isset($list) && $list->count() >= 1)
                <div class="pt-4">
                    <div class="flex flex-wrap">
                        <x-hotels.catalog.lists widthClass="w-full" :item="$list[$itemIndex]" :index="$itemIndex" :curator="$curator"></x-hotels.catalog.lists>
                    </div>
                </div>
            @endif

            {{-- 지역 카테고리 페이지네이션 대신 <> 적용하는 부분 --}}
            <div class="w-max-1080 w-full flex justify-center cursor-pointer">
                @if(isset($list) && $list->count() >= 1)
                    @if($itemIndex < 1)
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42">
                                <g fill="none" fill-rule="evenodd" opacity=".5">
                                    <g stroke="#FFF">
                                        <g transform="translate(-389.000000, -492.000000) translate(390.000000, 492.000000)">
                                            <rect width="40" height="40" y=".783" rx="20" transform="translate(20.000000, 20.783333) rotate(-180.000000) translate(-20.000000, -20.783333)"/>
                                            <path d="M17.657 16.657L25.657 16.657 25.657 24.657" transform="translate(21.656854, 20.656854) scale(-1, 1) rotate(-315.000000) translate(-21.656854, -20.656854)"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    @else
                        <div wire:click="itemChange('{{($itemIndex - 1)}}');" wire:key="itemDownCount">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42">
                                <g fill="none" fill-rule="evenodd">
                                    <g stroke="#FFF">
                                        <g transform="translate(-389.000000, -492.000000) translate(390.000000, 492.000000)">
                                            <rect width="40" height="40" y=".783" rx="20" transform="translate(20.000000, 20.783333) rotate(-180.000000) translate(-20.000000, -20.783333)"/>
                                            <path d="M17.657 16.657L25.657 16.657 25.657 24.657" transform="translate(21.656854, 20.656854) scale(-1, 1) rotate(-315.000000) translate(-21.656854, -20.656854)"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    @endif
                    <div class="AppleSDGothicNeo text-lg flex pt-4 px-4" style="color: #fffcf4;">
                        <div>{{ $itemIndex + 1 }}</div>
                        <div class="px-2">/</div>
                        <div>{{ $list->count() }}</div>
                    </div>

                    @if($list->count() === $itemIndex + 1)
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42">
                                <g fill="none" fill-rule="evenodd" opacity=".5">
                                    <g stroke="#FFF">
                                        <g transform="translate(-1489.000000, -492.000000) translate(1490.000000, 492.000000)">
                                            <rect width="40" height="40" y=".783" rx="20"/>
                                            <path d="M13.657 16.657L21.657 16.657 21.657 24.657" transform="translate(17.656854, 20.656854) rotate(-315.000000) translate(-17.656854, -20.656854)"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    @else
                        <div wire:click="itemChange('{{($itemIndex + 1)}}');" wire:key="itemUpCount">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42">
                                <g fill="none" fill-rule="evenodd">
                                    <g stroke="#FFF">
                                        <g transform="translate(-1489.000000, -492.000000) translate(1490.000000, 492.000000)">
                                            <rect width="40" height="40" y=".783" rx="20"/>
                                            <path d="M13.657 16.657L21.657 16.657 21.657 24.657" transform="translate(17.656854, 20.656854) rotate(-315.000000) translate(-17.656854, -20.656854)"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    @endif
                @endif
            </div>
            {{-- <> 적용하는 부분 끝 --}}

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
    @endif
</div>

<script type="text/javascript">
    window.addEventListener('catalog-swiper-re-init', event => {
        observer.observe();
    });
</script>
