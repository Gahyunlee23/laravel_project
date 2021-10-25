<div>
    <div class="space-y-2" x-data="{ open: @entangle('open') }">

        <div class="bg-tm-c-0D5E49 px-4 py-2 rounded-md">
            <div class="flex items-center">
                <div class="text-2xl text-white">
                    호텔 저장 현황
                </div>
                <div class="ml-auto text-white cursor-pointer" x-show="!open" @click="open=true">
                    SHOW
                </div>
                <div class="ml-auto text-white cursor-pointer" x-show="open" @click="open=false">
                    CLOSE
                </div>
            </div>
        </div>

        <div x-show="open" x-cloak>
            @if($open)
            <div>
                총 호텔 : {{ \App\Hotel::all()->count() }} / 오픈 호텔 : {{ \App\Hotel::where('status',2)->count() }} / 미오픈 호텔 : {{ \App\Hotel::where('status',1)->count() }} / 삭제 호텔 : {{ \App\Hotel::where('status',0)->count() }}
            </div>
            {{--{{ $images->first()->hotel->status }}--}}
            <div class="flex flex-col">
                @foreach(\App\HotelImage::whereDisable('N')->get() as $image)
                    @isset($image->hotel)
                        @if($image->hotel->status !== '0' && $image->disable ==='N')
                            <div class="p-2 space-y-1 w-full">
                                <div>
                                    @switch($image->hotel->status)
                                        @case(0)
                                        삭제]
                                        @break
                                        @case(1)
                                        미오픈]
                                        @break
                                        @case(2)
                                        오픈]
                                        @break
                                        @default
                                        이외]
                                    @endswitch
                                    {{$image->hotel->options[0]->title}}
                                </div>
                                <div class="flex flex-wrap gap-1">
                                    @foreach (\Illuminate\Support\Str::of($image->images)->explode('|') as $item)
                                        <div class="">
                                            <img src="https://d2pyzcqibfhr70.cloudfront.net/{{$item}}" class="float-left w-24 h-20 rounded-lg" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endisset
                @endforeach
            </div>
            @endif
        </div>

    </div>
</div>
