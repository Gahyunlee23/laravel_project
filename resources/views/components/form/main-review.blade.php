<div class="rounded-sm shadow-lg bg-white w-full h-full flex flex-row flex-wrap antialiased">
    <div class="relative w-2/5">
        <img class="w-full h-full -ml-3 -mt-3 rounded-sm shadow-lg antialiased lozad bg-black bg-opacity-60"
             data-src="https://d2pyzcqibfhr70.cloudfront.net/{{$image ?? ''}}" alt="리뷰"
        >
    </div>
    <div class="w-3/5 sm:mt-1 md:mt-2 lg:mt-3 pl-2 pr-3 sm:pr-4 l g:pr-5 pt-4 md:pt-3 pb-3 md:pb-2 lg:pb-4 flex flex-row flex-wrap">
        <div class="flex flex-wrap w-full h-full text-left text-gray-700 relative md:pt-0 justify-around content-between">
            <div class="flex-auto">
                <div class="pb-1 sm:pb-3 AppSdGothicNeoR leading-normal text-sm sm:text-base text-tm-c-979b9f tracking-wider">
                    {{ $name }}님의 후기
                </div>
                <div class="JeJuMyeongJo text-tm-c-30373F tracking-wide font-normal text-base sm:text-lg leading-snug xs:h-24 sm:h-26">
                    {!! $content ?? '리뷰 내용 없음' !!}
                </div>
            </div>
            <div class="w-full text-sm text-gray-300 hover:text-gray-400 cursor-pointer pt-3 bottom-0 right-0">
                <div class="pr-2">
                    <a href="{{$link ?? ''}}">
                        <div class="flex-1 flex items-center space-x-px 4xs:space-x-1 2xs:space-x-2">
                            <div class="leading-tight pt-1">
                                <div class="AppSdGothicNeoR text-tm-c-0D5E49 text-3xs 2xs:text-2xs sm:text-sm">
                                    {!! $hotelName !!}
                                </div>
                            </div>
                            <div class="flex-1 flex justify-end bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 3xs:w-3" width="10" height="16" viewBox="0 0 8 16">
                                    <g fill="none" fill-rule="evenodd" stroke-linejoin="round">
                                        <g stroke="#30373F">
                                            <g>
                                                <g>
                                                    <path d="M-3 3L4 11 11 3" transform="translate(-320 -2533) translate(16 2416) translate(304 118) rotate(-90 4 7)"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
