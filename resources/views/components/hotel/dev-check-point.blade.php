<div class="w-full md:w-1/3 p-2 md:p-6 md:p-8 lg:p-14 xl:p-16 {{$containerClass}}" style="{{$containerStyle}}">
    <div class="sm:space-y-6 flex flex-wrap sm:block">
        <div class="w-full hidden md:block">
            <img src="{{$image}}"
                 class="rounded-sm" alt="">
        </div>
        <div class="w-full px-0 table md:flex">
            <div class="float-none md:float-left py-px md:py-0 bg-tm-c-C1A485 overflow-hidden md:overflow-visible">
                <div class="">
                    <div class="float-none md:float-left bg-tm-c-C1A485" style="width: calc( 100% + 20px );">
                        <div class="PtSerif italic text-lg xs:text-2xl py-1 xs:py-2 md:py-px text-white">
                            {!! $point !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full space-y-2 md:space-y-3 md:hidden pt-1 4xs:pt-3 3xs:pt-4 2xs:pt-5 xs:pt-6">
                <div class="JeJuMyeongJo text-lg 2xs:text-xl xs:text-2xl text-tm-c-C1A485">
                    {{$title}}
                </div>
                <div class="AppSdGothicNeoR text-2xs 2xs:text-sm xs:text-base text-white leading-5 3xs:leading-6 2xs:leading-7 xs:leading-8 xs:pt-2">
                    {!! $explanation !!}
                </div>
            </div>
        </div>

        <div class="hidden md:block w-full px-0 space-y-3">
            <div class="JeJuMyeongJo text-xl sm:text-2xl text-tm-c-C1A485 leading-8">
                {{$title}}
            </div>
            <div class="AppSdGothicNeoR text-sm sm:text-base text-white leading-5 sm:leading-7">
                {!! $explanation !!}
            </div>
        </div>
    </div>
</div>
