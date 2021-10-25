<div>
    <div class="bg-tm-c-ED rounded-sm p-6">
        <div class="flex">
            <div>
                <div class="flex pb-2 space-x-2 items-center">
                    @if(!isset($list->read_dt))
                        <div class="flex items-center bg-tm-c-da5542 rounded-md">
                            <div class="py-px px-1 text-white text-sm leading-5">New</div>
                        </div>
                    @endif
                    <div class="AppSdGothicNeoR text-tm-c-979b9f text-sm">
                        @isset($list->created_at)
                            {{ \Carbon\Carbon::parse($list->created_at)->format('Y. m. d H:i:s')}}
                        @endisset
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="AppSdGothicNeoR text-black text-lg font-bold flex items-center">
                        {{ $list->type ?? '' }}
                    </div>
                    <div class="AppSdGothicNeoR text-base text-black whitespace-pre leading-tight px-1"
                    >{{ $list->content }}</div>
                </div>
            </div>

            <div class="ml-auto table text-black space-y-1">
                <div>
                    @if($list->read_dt !== null)
                        <div class="AppSdGothicNeoR">
                            <div class="w-full w-max-content text-sm text-tm-c-979b9f cursor-pointer"
                                 wire:click="read('cancel',{{$list->id}},'notices')">
                                읽음
                            </div>
                        </div>
                    @else
                        <div class="AppSdGothicNeoR">
                            <div class="w-full w-max-content text-sm text-tm-c-30373F cursor-pointer underline"
                                 wire:click="read('read',{{$list->id}},'notices')">
                                읽음 표시
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex">
            @isset($list->link)
                @php
                    $links = Str::of($list->link)->explode('||');
                    $names = Str::of($list->link_name)->explode('||')->filter(function($item){
                    	return $item ?? null;
                    });
                @endphp
                <div class="ml-auto flex space-x-1">
                    @foreach ($links as $item)
                        <a target="_blank" class="text-white"
                           href="{{secure_url($item)}}">
                            <div class="py-2 px-6 bg-tm-c-C1A485 rounded-sm">
                                {{ $names[$loop->index] ?? '자세히 보기' }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endisset
        </div>
    </div>
</div>
