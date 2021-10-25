<div class="AppSdGothicNeoR px-4 sm:px-6 lg:px-4 pt-10 pb-16"
     x-data="{
      'tab' : '{{$hotelTab}}',
      'list' : '{{$list}}' ,
      'menu' : '{{$menu}}'
    }">

    <div>
        <livewire:hotels.managers.hotel-tab :tab="$hotelTab"></livewire:hotels.managers.hotel-tab>
    </div>
    <div class="pt-5">
        <livewire:hotels.managers.menu-tab :menus="$menus" :tab="$hotelTab" :index="$menuIndex"></livewire:hotels.managers.menu-tab>
    </div>
    <div x-show="menu === '{{$menus[0]}}'" x-cloak>
        <div class="py-7 flex">
            <div wire:click="listChange('all-list')" @click="pushState('/'+tab+'/'+list);">
                <div class="px-2 text-lg"
                     :class="{ 'text-white' : list === 'all-list' }">전체
                </div>
            </div>
            <div wire:click="listChange('month-list')" @click="pushState('/'+tab+'/'+list);">
                <div class="px-2 text-lg"
                     :class="{ 'text-white' : list === 'month-list' }">입주
                </div>
            </div>
            <div wire:click="listChange('tour-list')" @click="list='tour-list';pushState('/'+tab+'/'+list);">
                <div class="px-2 text-lg"
                     :class="{ 'text-white' : list === 'tour-list' }">투어
                </div>
            </div>
        </div>

        <div>
            <div>
                <livewire:hotels.managers.all-list :hotel-tab="$hotelTab" :list="$list" :menu-index="$menuIndex"
                                                   :wire:key="'all-list-'.$hotelTab"></livewire:hotels.managers.all-list>
            </div>
        </div>
    </div>

    <div x-show="menu === '{{$menus[1]}}'" x-cloak>
        <div>
            <div>
                <div>
                    <livewire:hotels.managers.settlements :hotel-tab="$hotelTab"></livewire:hotels.managers.settlements>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // window.addEventListener('menuTabClickEvent', event => {
    //     Livewire.emit('managerHotelTab',event.detail.menu_index);
    // })
    window.addEventListener('https-url-state-change', event => {
        var tab = '';
        var list = '';
        console.log(event, tab);
        if (event.detail.tab !== undefined) {
            tab = '/' + event.detail.tab;
        }
        if (event.detail.list !== undefined) {
            list = '/' + event.detail.list;
        }
        pushState(tab + list);
    });

    function pushState(url) {
        window.history.pushState(null, "호텔에삶 State change", "{{ route('hotel-manager.dash-board') }}" + url);
    }
</script>
