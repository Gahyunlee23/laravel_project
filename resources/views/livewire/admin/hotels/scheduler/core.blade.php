<div>
    <livewire:calendar.fullcalendar :hotel="$hotel"></livewire:calendar.fullcalendar>

    <div x-data="{ modal : @entangle('modal') }">
        <div x-show="modal" x-cloak
             class="z-40 bg-black bg-opacity-50 absolute inset-0 flex items-center justify-center h-full w-full px-4 overflow-hidden">
            <div class="relative w-full w-max-content">
                <livewire:admin.hotels.scheduler.form-modal :hotel="$hotel"></livewire:admin.hotels.scheduler.form-modal>
            </div>
        </div>
    </div>

</div>
