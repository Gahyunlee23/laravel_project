<div class="pt-8 flex flex-wrap space-y-5">
    @foreach($other_hotels as $other_hotel)
    @php
        $o_hotel = \App\Hotel::whereId($other_hotel)->whereStatus(2)->first();
        if(isset($o_hotel->images[0])){
            if(Str::of($o_hotel->images[0]->position_y)->contains('|')){
                $images_position=Str::of($o_hotel->images[0]->position_y)->explode('|');
                $image_positions=Str::of($images_position)->explode(',');
            }else{
                $image_positions=Str::of($o_hotel->images[0]->position_y)->explode(',');
            }
        }
    @endphp
    @isset($o_hotel->images[0])
    <div class="lozad w-full rounded-sm"
         data-background-image="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.Str::of($o_hotel->images[0]->images)->explode('|')[0])}}"
         style="background-repeat:no-repeat;background-position: center center;
    @if(isset($image_positions[0])) background-position-y:{{$image_positions[0]}}; @endif background-size:cover;">
        <a href="{{route('hotel.view',['hotel'=>$o_hotel->id,'curator_page'=>$curator->user_page ?? null])}}"
           onclick="GA_event('other_hotel_click',['{{$hotel->option->title}}','{{$o_hotel->option->title}}']);" class="cursor-pointer">
        <div class="h-28 sm:h-34 md:h-40 lg:h-44" style="box-shadow: 4px 4px 10px 0 rgba(0, 0, 0, 0.2);
        background-image: linear-gradient(to right, rgba(63, 55, 48, 0.8) 10%, rgba(63, 55, 48, 0.1) 99%);">
            <div class="h-full flex items-center">
                <div class="relative px-3 sm:px-6">
                    <div class="bottom-0 pb-2 sm:pb-4">
                        <div class="JeJuMyeongJo mt-2 text-lg sm:text-xl md:text-2xl lg:text-3xl text-white text-left tracking-wide leading-tight">
                            {{$o_hotel->options[0]->title}}
                        </div>
                        <div class="PtSerif italic pt-1 md:pt-2 text-xs sm:text-sm md:text-lg text-white text-left tracking-wide">
                            {{$o_hotel->options[0]->title_en}}
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-evenly items-center ml-auto h-full rounded-sm w-30 xs:w-32 sm:w-36 md:w-44 lg:w-56" style="min-width: 120px;background-color: rgba(193, 164, 133, 0.8);">
                    @if($o_hotel->LowPrice !== '0' || $o_hotel->MaximumPrice !== '0')
                        <div class="space-y-2">
                            <div class="AppSdGothicNeoR text-base text-tm-c-ED text-center">
                                최저가
                            </div>
                            <div class="w-full AppSdGothicNeoR text-base sm:text-xl md:text-2xl text-center text-white tracking-wide">
                                {{number_format($o_hotel->LowPrice)}}원 ~
                            </div>
                        </div>
{{--                        <div class="w-full flex justify-center">--}}
{{--                            <div class="w-px h-4 sm:h-5 bg-white"></div>--}}
{{--                        </div>--}}
{{--                        <div class="w-full AppSdGothicNeoR text-base sm:text-xl text-center text-white pb-6 sm:pb-7 md:pb-8 tracking-wide">--}}
{{--                            {{number_format($o_hotel->MaximumPrice)}}--}}
{{--                        </div>--}}
                    @else
                        <div class="w-full AppSdGothicNeoR text-base sm:text-lg text-center text-white tracking-wide leading-normal">
                            상세페이지<br>
                            확인
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </a>
    </div>
    @endisset
    @endforeach
</div>
