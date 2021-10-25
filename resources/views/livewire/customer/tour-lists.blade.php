<div>
    @inject('formatter', 'App\Formatter')
    <div x-data="{ show : 'all' }">
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
        @foreach ($tour_lists as $list)
            <x-list.tour :list="$list"></x-list.tour>
        @endforeach
    </div>
    @if(empty($tour_lists))
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
    @elseif( isset($tour_lists) && $tour_lists->count()===0 )
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
