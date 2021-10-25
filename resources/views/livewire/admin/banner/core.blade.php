<div>
    <div class="my-4 sm:mt-12 sm:my-12 md:mt-16 flex justify-around px-4 sm:px-16 md:px-12 lg:px-32">
        <a class="flex flex-wrap items-end w-1/2 h-full border border-solid border-white rounded-md shadow-2xl py-10 sm:py-16 cursor-pointer hover:bg-tm-c-292f36 focus:bg-tm-c-292f36" href="{{route('admin.banner')}}">
        <div class="w-full text-center text-lg">
            배너 리스트
        </div>
        </a>
        <div class="w-full"></div>
        <a class="flex flex-wrap items-end w-1/2 h-full border border-solid border-white rounded-md shadow-2xl py-10 sm:py-16 cursor-pointer hover:bg-tm-c-292f36 focus:bg-tm-c-292f36" href="{{route('admin.banner', ['type'=>'form'])}}">
            <div class="w-full text-center text-lg">
                배너 등록
            </div>
        </a>
    </div>

    @if($type === 'list')
        <livewire:admin.banner.lists></livewire:admin.banner.lists>
    @else
        <livewire:admin.banner.form :banner-id="$banner"></livewire:admin.banner.form>
    @endif

</div>
