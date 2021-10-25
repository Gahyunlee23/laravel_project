<div class="rounded-sm shadow-lg bg-white w-full h-full flex flex-row flex-wrap antialiased">
    <div class="relative w-5/12">
        <img class="w-full h-full -ml-2 md:-ml-3 -mt-2 md:-mt-3 rounded-sm shadow-lg antialiased lozad bg-black bg-opacity-60"
             data-src="https://d2pyzcqibfhr70.cloudfront.net/{{$review->image_explode->first() }}"
        >
    </div>
    <div class="w-7/12 sm:mt-1 md:mt-2 lg:mt-3 pl-4 pr-3 lg:pr-4 pt-4 md:pt-3 pb-3 md:pb-2 lg:pb-4 flex flex-row flex-wrap">
        <div class="flex flex-wrap w-full h-full text-left text-gray-700 relative md:pt-0 justify-around content-between">
            <div class="flex-auto">
                <div class="pr-2 JeJuMyeongJo text-tm-c-30373F tracking-wide text-3xs 3xs:text-xs 2xs:text-sm xs:text-base sm:text-lg leading-snug h-26 md:h-28">
                    {{$review->content ?? '리뷰 내용 없음'}}
                </div>
            </div>
            <div class="w-full text-sm text-gray-300 hover:text-gray-400 pt-3 bottom-0 right-0">
                <div class="pr-2">
                    @if($review->link !== null && $review->link !=='')
                        <a href="{{$review->link ?? ''}}">
                            <div class="flex-1 flex items-center space-x-px 4xs:space-x-1 2xs:space-x-2">
                                <div>
                                    @if(isset($review->link) && $review->link!=='' && $review->link!==null)
                                        <img class="w-6 2xs:w-8"
                                             @if(Str::of($review->link)->contains('instagram.com'))
                                             src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/review/ic-instagram@2x.png')}}"
                                             @elseif(Str::of($review->link)->contains('naver.com'))
                                             src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/review/ic-naver@2x.png')}}"
                                             @elseif(Str::of($review->link)->contains('brunch.co.kr'))
                                             src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/review/ic-brunch@2x.png')}}"
                                             @endif
                                             alt="SNS logo">
                                    @endif
                                </div>
                                <div class="leading-tight pt-1">
                                    <div class="AppSdGothicNeoR text-tm-c-30373F text-4xs 4xs:text-3xs 2xs:text-2xs sm:text-sm">{{$review->name ?? '고객'}}님의 후기</div>
                                    <div class="AppSdGothicNeoR text-tm-c-979b9f text-4xs 4xs:text-3xs 2xs:text-2xs sm:text-sm">자세히 보러가기</div>
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
                    @else
                        <div class="flex-1 flex items-center space-x-px 4xs:space-x-1 2xs:space-x-2">
                            <div class="leading-tight pt-1">
                                <div class="AppSdGothicNeoR text-tm-c-0D5E49 text-4xs 4xs:text-3xs 2xs:text-2xs sm:text-sm">{{$review->name ?? '고객'}}님의 후기</div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
