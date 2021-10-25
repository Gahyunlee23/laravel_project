<div x-data="{ show : false }">
    <div
        @click="show=!show"
        class="py-5 flex items-center justify-between border-b-2 border-solid border-white cursor-pointer">
        <div class="AppSdGothicNeoR text-base sm:text-xl text-white">
            {{$title}}
        </div>
        <div class="">
{{--            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                <path :class="{'hidden' : !show}" fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />--}}
{{--                --}}
{{--                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--            </svg>--}}

            <svg :class="{'hidden' : show}" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 24 24">
                <g fill="none" fill-rule="evenodd">
                    <g>
                        <path d="M0 0H1920V3291H0z" transform="translate(-1536.000000, -2941.000000)"/>
                        <g>
                            <g>
                                <g>
                                    <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1536.000000, -2941.000000) translate(360.000000, 2941.000000) translate(1188.000000, 12.000000) scale(1, -1) translate(-1188.000000, -12.000000) translate(1176.000000, 0.000000) translate(0.000000, -0.000000) translate(12.000000, 12.000000) scale(1, -1) translate(-12.000000, -12.000000)"/>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>

            <svg :class="{'hidden' : !show}" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 24 24">
                <g fill="none" fill-rule="evenodd">
                    <g>
                        <path d="M0 0H1920V4128H0z" transform="translate(-1536.000000, -3573.000000)"/>
                        <g>
                            <g>
                                <path stroke="#FFF" d="M2.25 6.75L12 17.25 21.75 6.75" transform="translate(-1536.000000, -3573.000000) translate(360.000000, 3573.000000) translate(1176.000000, 0.000000) translate(12.000000, 12.000000) scale(1, -1) translate(-12.000000, -12.000000)"/>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>

        </div>
    </div>

    <div class="overflow-hidden">
        <div
            class="mt-4"
            {{--.in.opacity.duration.600ms.out.opacity.duration.600ms--}}
            x-show="show"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 transform -translate-y-full"
            x-transition:enter-end="opacity-100 transform translate-y-0 duration-700"

            x-transition:leave="transition ease-in duration-700"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-full"
            x-cloak>
            {{$content}}
        </div>
    </div>
</div>
