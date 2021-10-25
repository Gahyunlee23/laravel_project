<div class="relative" x-data="{ tab : '{{$tab}}', HotelTabShow : false }">

    <div>
        <div class="cursor-pointer w-max-content flex items-center space-x-1 sm:space-x-2"
             @click="HotelTabShow=!HotelTabShow;" @click.away="HotelTabShow=false;">
            <div class="JeJuMyeongJo text-sm 4xs:text-base 3xs:text-lg 2xs:text-xl xs:text-2xl sm:text-3xl md:text-4xl text-white leading-normal">
                {{ auth()->user()->HotelManagers->get($tab)->hotel->option->title }}
            </div>
            <div
                class="border-solid border-white"
                :class="{
                    'border-b-6 border-l-6 border-r-6 sm:border-b-8 sm:border-l-8 sm:border-r-8' : HotelTabShow,
                    'border-t-6 border-l-6 border-r-6 sm:border-t-8 sm:border-l-8 sm:border-r-8' : !HotelTabShow,
                }"
                style="width: 0;height: 0;border-left-color: transparent;border-right-color: transparent;"></div>
        </div>
    </div>

    <div class="absolute z-40 mt-4">
        <div class="hotel-tab bg-tm-c-30373F border border-solid border-white rounded-sm divide-y divide-white overflow-y-auto"
             style="max-height: 11rem;"
             x-show="HotelTabShow" x-cloak>
            @foreach (auth()->user()->HotelManagers as $manager)
                <div class="mr-1 hover:bg-tm-c-ED hover:bg-opacity-25"
                     :class="{'bg-tm-c-C1A485 bg-opacity-25' : tab === '{{$loop->index}}'}">
                    <div class="py-5 cursor-pointer select-none flex items-center"
                         wire:click="managerHotelTab({{$loop->index}})">
                        <div class="px-3 text-tm-c-ED text-base xs:text-lg">
                            {{$manager->hotel->option->title}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
