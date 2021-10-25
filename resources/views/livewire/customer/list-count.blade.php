<div x-data="{
    type : '{{$type}}',
    count : '{{$count}}'
}">
    <div x-show="count!=='0'" class="text-sm" x-bind:class="{
        'flex items-center justify-center px-1 bg-tm-c-da5542 rounded-full w-full text-center AppSdGothicNeoR font-bold leading-5 tracking-wide' : type !== 'all_lists',
        'flex items-center justify-center px-1 bg-tm-c-da5542 rounded-full text-white AppSdGothicNeoR shadow-sm leading-5 tracking-wide' : type === 'all_lists'
        }">
        @if($link !== null)
            <a class="mx-px" href="{{$link}}">
                {{$count}}
            </a>
        @else
            <p class="mx-px">
                {{$count}}
            </p>
        @endif
    </div>
</div>
