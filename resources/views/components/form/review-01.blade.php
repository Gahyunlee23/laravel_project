<div class="flex max-w-full h-full bg-white m-4 shadow-lg rounded-sm">
    <div class="flex-1 table w-56 h-full square">
        <div class="relative w-full h-full">
            <div class="absolute -ml-4 -mt-4 w-full h-full flex-none bg-cover overflow-hidden shadow-lg rounded-sm"
                 style="background-image: url('https://d2pyzcqibfhr70.cloudfront.net{{$review->image_explode->first()}}');"
                 title="Review image">
            </div>
        </div>
    </div>
    <div class="rounded-b lg:rounded-b-none lg:rounded-r pt-4 pr-4 pb-4 pl-0 flex flex-col justify-center">
        <div class="flex">
            <div class="leading-normal space-y-2">
                <div class="JeJuMyeongJo text-tm-c-30373F tracking-wide text-4xs 3xs:text-3xs 2xs:text-xs xs:text-base p-0 3xs:p-1 xs:p-3">
                    {{$review->content ?? ''}}
                </div>
                <div class="bg-white">
                    <a href="{{$review->link ?? ''}}">
                        <div class="flex-1 flex items-center space-x-px 4xs:space-x-1 2xs:space-x-2 xs:space-x-3">
                            <div>
                                @if(isset($review->link) && $review->link!=='' && $review->link!==null)
                                    @if(Str::of($review->link)->contains('instagram.com'))
                                        <img class="w-6 3xs:w-8 xs:w-10" src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/review/ic-instagram@2x.png')}}" alt="">
                                    @elseif(Str::of($review->link)->contains('naver.com'))
                                        <img class="w-6 3xs:w-8 xs:w-10" src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/review/ic-naver@2x.png')}}" alt="">
                                    @elseif(Str::of($review->link)->contains('brunch.co.kr'))
                                        <img class="w-6 3xs:w-8 xs:w-10" src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/resource/review/ic-brunch@2x.png')}}" alt="">
                                    @endif
                                @endif
                            </div>
                            <div class="leading-tight">
                                <div class="AppSdGothicNeoR text-tm-c-30373F text-4xs 4xs:text-3xs 2xs:text-2xs xs:text-sm">{{$review->name ?? '고객'}}님의 후기</div>
                                <div class="AppSdGothicNeoR text-tm-c-979b9f text-4xs 4xs:text-3xs 2xs:text-2xs xs:text-sm">자세히 보러가기</div>
                            </div>
                            <div class="flex-1 flex justify-end bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 3xs:w-3 xs:w-4" viewBox="0 0 8 16">
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
