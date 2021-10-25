<div x-data="{curator : '{{$curator}}'}">
    <div class="flex py-4">
        <div class="flex-1">
            <div wire:click="curatorShow(false)"
                 class="text-xl py-2 cursor-pointer"
                 :class="{
                    'text-white font-bold' : !curator
                }">호텔에삶</div>
            <div :class="{'h-px bg-white' : !curator}"></div>
        </div>
        <div class="flex-1">
            <div wire:click="curatorShow(true)"
                 class="text-xl py-2 cursor-pointer"
                 :class="{
                    'text-white font-bold' : curator
                }">큐레이터</div>
            <div :class="{'h-px bg-white' : curator}"></div>
        </div>
    </div>
    <div class="space-y-6">
        @foreach ($hotels as $hotel)
            <div class="flex h-auto">
                <div class="w-48 flex-0 flex relative">
                    <img src="{{secure_url('https://d2pyzcqibfhr70.cloudfront.net/'.$hotel->ImageFirstOne)}}"
                         class="w-full h-full max-w-full absolute top-0 left-0"
                         alt="{{$hotel->option->title}}">
                </div>
                <div class="flex-1 flex flex-wrap w-full px-2">
                    <div class="pt-2 w-full flex">
                        <div>
                            <a href="{{route('admin.schedulers.hotel-detail', ['hotel'=>$hotel->id])}}"
                               class="text-white text-base sm:text-xl font-bold hover:text-gray-300">
                                {{$hotel->option->title}}
                            </a>
                        </div>
                        <div class="ml-auto text-white font-bold">
                            @if($hotel->CuratorCheck)
                                Curator
                            @endif
                            {{$hotel->id}}
                        </div>
                    </div>

                    <div class="pt-2 w-full flex">
                        <div class="text-white">
                            총 : {{$hotel->ReservationCount}} / 투어 : {{$hotel->ReservationTourCount}} / 입주 : {{$hotel->ReservationMonthCount}}
                        </div>
                    </div>
                    <div class="pt-2 w-full h-20 flex">
                        <div class="text-gray-300">
                            스케쥴 : {{$hotel->schedulers->count()}} / 상품 옵션 : {{$hotel->period_prices->count()}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
