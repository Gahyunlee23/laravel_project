<div>
    <a href="{{ $banners->last()->url }}" target="_blank"
       onclick="GA_event('프로모션띠배너',['{{request()->route()->getName() ?? ''}}']);">
        <div class="w-full px-0 sm:px-6 md:px-4 lg:px-0" style="background-color: {{ $banners->last()->bg_color }};">
            <div class="max-w-screen-lg" style="margin: 0 auto;">
                <div class="flex justify-between mx-8 sm:mx-0">
                    @foreach($banners as $banner)
                        <div class="flex text-white">
                            <div class="py-8 space-y-4 sm:space-y-8">
                                <div>
                                    <div class="JeJuMyeongJo text-base sm:text-3xl pb-2">{!! $banner->title !!}</div>
                                    <div class="py-1 px-2 mb-2 sm:mb-20 bg-white bg-opacity-20 w-max-content">
                                        <div class="AppleSDGothicNeo text-xs sm:text-base">{{ $banner->event }}</div>
                                    </div>
                                </div>
                                <div class="text-xs opacity-40">{{ $banner->explanation }}</div>
                            </div>
                        </div>

                        <div class="relative w-1/3">
                            <div class="absolute bottom-0">
                                <img src="https://d2pyzcqibfhr70.cloudfront.net/{{ $banner->images }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </a>
</div>
