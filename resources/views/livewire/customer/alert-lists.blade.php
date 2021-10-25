<div x-data="{ show : 'all' }">
    @inject('formatter', 'App\Formatter')
    <div>
        <div class="flex space-x-2">
            <div class="AppSdGothicNeoR text-lg text-white"
                 @click="show='all'" wire:click="$set('type','all')"
                 :class="{'font-bold': show === 'all', 'text-opacity-50' : show !== 'all'}">전체</div>
            <div class="AppSdGothicNeoR text-lg text-white"
                 @click="show='unread'" wire:click="$set('type','unread')"
                 :class="{'font-bold': show === 'unread', 'text-opacity-50' : show !== 'unread'}">읽지않음</div>
        </div>
    </div>
    <div class="py-4 space-y-2">
        @if($readyToLoad)
            @foreach ($notices->where('read_dt','=',null) as $list)
                <x-list.notice :list="$list"></x-list.notice>
            @endforeach
        @endif
        @isset($lists)
            @foreach ($lists as $list)
                <x-list.alert :list="$list"></x-list.alert>
            @endforeach
        @endisset
        <div class="space-y-2" x-show=" show==='all' " x-cloak>
            @if($readyToLoad)
                @foreach ($notices->where('read_dt','!=',null) as $list)
                    <x-list.notice :list="$list" ></x-list.notice>
                @endforeach
            @endif
        </div>
    </div>
    @if(empty($lists))
        <div class="py-4 space-y-2">
            <div class="bg-tm-c-ED rounded-sm p-6">
                <div class="h-104 flex items-center justify-center">
                    <livewire:form.loading
                        type="circle-spine"
                        borderTopColor="#c1a485"
                        loadingColorClass="text-tm-c-30373F"></livewire:form.loading>
                </div>
            </div>
        </div>
    @endif
        @if((isset($lists) && ($lists->count() === 0)))
{{--             ($type==='all' && $notices->where('read_dt','!=',null)->count()+$lists->count()===0)
        || ($type==='unread' && $notices->where('read_dt','=',null)->count()+$lists->count()===0)--}}
        <div class="py-4 space-y-2">
            <div class="bg-tm-c-ED rounded-sm p-6">
                <div class="h-104 flex items-center justify-center">
                    <livewire:form.loading
                        type="not-lists"
                        iconColorClass="text-tm-c-30373F"
                        loadingText="정보 없음"
                        loadingColorClass="text-tm-c-30373F"
                    ></livewire:form.loading>
                </div>
            </div>
        </div>
    @endif

</div>
