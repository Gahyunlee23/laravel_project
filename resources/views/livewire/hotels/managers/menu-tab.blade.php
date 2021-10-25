<div class="flex">
    @foreach ($menus as $menu)
        <div class="flex-1">
            <div
                class="py-4 pl-1"
                wire:click="menuTabChange('{{$loop->index}}')">
                <div
                    class="text-lg sm:text-xl AppSdGothicNeoR tracking-wide"
                    :class = "{
                 'text-white font-bold cursor-default' : '{{$index}}' === '{{$loop->index}}',
                 'text-tm-c-979b9f cursor-pointer' : '{{$index}}' !== '{{$loop->index}}'
                }">
                    {{$menu ?? ''}}
                </div>
            </div>
            <div class="h-2 flex items-center">
                <div class="w-full bg-white"
                     :class = "{
                     'h-1' : '{{$index}}' === '{{$loop->index}}',
                     'h-px' : '{{$index}}' !== '{{$loop->index}}'
                }"></div>
            </div>
        </div>
    @endforeach
</div>
