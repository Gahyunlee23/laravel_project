<div class="h-full border-b-6 border-solid border-tm-c-C1A485 shadow-xl rounded-sm">
    <div class="h-full bg-tm-c-ED py-6 sm:py-7 px-6 sm:px-8 space-y-2">
        <div class="flex items-center">
            <div>
                <div class="w-max-content text-left text-tm-c-30373F AppSdGothicNeoR font-bold text-xl tracking-wider">
                    <div><p>{!! $name !!}<span class="pl-1 text-base">님</span></p></div>
                </div>
                <div class="AppSdGothicNeoR pt-2 text-left text-tm-c-0D5E49 text-base">
                    {{$date}}
                </div>
            </div>
            <div class="AppSdGothicNeoR ml-auto text-tm-c-0D5E49 text-base">
                {{$option}}
            </div>
        </div>
        <div class="h-px bg-white"></div>
        <div class="py-2 text-left AppSdGothicNeoR leading-6 text-tm-c-30373F min-h-full"
             style="min-height: 45px;">
            {!! $content !!}
        </div>
    </div>
</div>
