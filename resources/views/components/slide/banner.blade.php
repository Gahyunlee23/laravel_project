@foreach (\App\Banner::where(function($query) use($curator){
	if($curator && $curator->id !== null){
		if($curator->banners->count() >= 1 || $curator->curatorHotels->count() >= 1){
	        $query->where('curator_id', '=', $curator->id)->orWhere('view', '=', 'all')->orWhere('view', '=', 'curator');
		}else{
	        $query->whereNull('curator_id')->where('view', '!=', 'curator');
		}
	}else{
	    $query->whereNull('curator_id')->where('view', '!=', 'curator');
	}
})->where('view', '!=', 'promotion')->get() as $banner)
    @if($loop->index === 6)
        @break
    @endif
    @php
        $script='';
        $href='';
        $view_route='';
        if($banner->type === 'product-event-move'){
         $script ="vimeoPlayLoad();
            var target = $('#vimeo_video_01 iframe');
             var vimeoInterval = setInterval(function(){
                 target = $('#vimeo_video_01 iframe');
                 if(target.length){
                    window.scrollTo({top:( window.pageYOffset + document.querySelector('.event_tag').getBoundingClientRect().top )-100, behavior:'smooth'});
                    clearInterval(vimeoInterval);
                    return true;
                 }
        },150);";
        }else{
            if($banner->route === 'hotel.view'){
               if(Route::getCurrentRoute()->getName() === 'admin.dev.index'){
                    $view_route='admin.dev.hotel.view';
                }else{
                    $view_route='hotel.view';
                }
                $script="GA_event('메인_배너_클릭',['".($banner->hotel->option->title ?? '') ."', '".$banner->hotel_id."']);";
                $href=route($view_route,['hotel'=>$banner->hotel_id,'curator_page'=>$curator->user_page ?? false]);
            }
            if($banner->route === 'hotels.collect'){
                $view_route=$banner->route;
                $script="GA_event('메인_배너_클릭',['".($banner->title ?? '') ."', '']);";
                $href=route($view_route,['tab'=>$banner->tab,'depth'=>$banner->depth,'curator_page'=>$curator->user_page ?? false]);
            }
            if($banner->route === 'other'){
                $view_route=$banner->route;
                $script="GA_event('메인_배너_클릭',['".($banner->title ?? '') ."', '']);";
                $href=$banner->url;
            }
        }
    @endphp
    @if(($banner->start_dt === null && $banner->end_dt === null) ||
	    ($banner->start_dt <= now()->format('Y-m-d H:i:s') && $banner->end_dt === null) ||
        ($banner->start_dt === null && $banner->end_dt >= now()->format('Y-m-d H:i:s')) ||
	    ($banner->start_dt <= now()->format('Y-m-d H:i:s') && $banner->end_dt >= now()->format('Y-m-d H:i:s')))
        <div class="swiper-slide main_banner_slide relative">
                <a class="w-full h-full cursor-pointer" href="{{$href}}" onclick="{{$script}}">
                    <div>
                        <div class="w-full h-full absolute text-white">
                            <div class="mt-3 4xs:mt-4 3xs:mt-6 sm:mt-8 md:mt-16 mx-3 4xs:mx-4 3xs:mx-6 xs:mx-8 sm:mx-12 md:mx-20">
                                <div class="flex items-center">
                                    <div class="JeJuMyeongJo float-left text-lg xs:text-2xl md:text-3xl lg:text-4xl leading">
                                        {{$banner->title}}
                                    </div>
                                    @if($script)
                                        <div class="hidden sm:block ml-auto">
                                            <div class="w-full"{{-- class="cursor-pointer" href="{{$href}}" onclick="{{$script}}"--}}>
                                                <div class="flex items-center justify-center px-1 4xs:px-2 2xs:px-3 sm:px-6 py-0 4xs:py-px xs:py-1 rounded-sm border border-solid border-white">
                                                    <div class="pb-1 JeJuMyeongJo text-sm xs:text-base 2xs:text-lg tracking-wide whitespace-pre">see more</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="h-auto 3xs:h-8 xs:h-12 sm:h-16 JeJuMyeongJo text-sm xs:text-base md:text-lg lg:text-xl text-tm-c-ED pt-2 sm:pt-3 leading-4 2xs:leading-6 xs:leading-7">
                                    {!! $banner->explanation !!}
                                </div>
                                <div class="mt-4 sm:mt-6 border-b border-solid border-white border-opacity-25">
                                    <div class="flex items-end">
                                        @if($banner->event !== '' && $banner->event !== null)
                                            <div class="mb-2 mr-2 py-1 px-2 bg-white backdrop-filter backdrop-blur bg-opacity-50">
                                                <div class="JeJuMyeongJo text-xs 2xs:text-sm sm:text-base text-tm-c-30373F">
                                                    {{$banner->event}}
                                                </div>
                                            </div>
                                        @endif
                                        <div class="ml-auto">
                                            <div class="py-3 pr-px hidden sm:block">
                                                <div class="main-banner-swiper-pagination px-px flex space-x-1 items-center justify-center"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <div class="py-3 pr-px block sm:hidden">
                                        <div class="main-banner-swiper-pagination px-px flex space-x-1 items-center justify-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($loop->index === 0)
                            <img class="main_img relative w-full h-full" style="z-index: -1;"
                                 src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$banner->ImageExplode->get(0))}}" alt="{{$banner->hotel->option->title ?? $banner->title}}">
                        @else
                            <img class="lozad main_img relative w-full h-full" style="z-index: -1;"
                                 data-src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$banner->ImageExplode->get(0))}}" alt="{{$banner->hotel->option->title ?? $banner->title}}">
                        @endif
                    </div>
                </a>
            </div>
    @endif
@endforeach

