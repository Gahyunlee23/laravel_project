<div class="h-full">
    <div class="absolute -mt-6 ml-8">
        <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/review/invalid-name.svg" alt="">
    </div>
    <div class="h-full bg-tm-c-ED pt-8 pb-6 space-y-2 shadow-lg rounded-sm">
        <div class="grid grid-rows-2 grid-flow-col gap-4">
            <div class="col-span-3 text-left pl-4 text-tm-c-0D5E49 AppSdGothicNeoR font-bold text-xl tracking-widest">{{$name}}<span class="text-base"> 님</span></div>
            <div class="col-span-3 text-left pl-4 text-tm-c-30373F text-xs">{{$job}}</div>
            <div class="col-span-1 row-span-2 flex justify-end">
                <img src="{{$profile}}"
                     class="rounded-full w-12 h-12 mr-4" alt="">
            </div>
        </div>
        <div class="h-px bg-white mx-4 mt-3"></div>
        <div class="pt-px px-4 text-left AppSdGothicNeoR leading-6 text-tm-c-30373F min-h-full"
             style="min-height: 85px;">
            {!! $explanation !!}
        </div>
    </div>
</div>
