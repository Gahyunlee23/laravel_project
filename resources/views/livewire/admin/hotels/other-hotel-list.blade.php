<div wire:init="orderListGet" class="px-2 py-2 border border-solid border-white">
    <div class="px-4 py-3">

        @isset($otherHotelLists)
        <div class="p-2 border border-solid border-white rounded-md">
            <div class="py-2 text-white">
                선택 된 호텔 리스트
            </div>
            <div class="flex flex-wrap">
                @foreach($otherHotelLists as $index=>$item)
                    <div class="mr-2 mb-1 py-1 px-3 bg-tm-c-C1A485 rounded-full cursor-pointer"
                         wire:click="hotelListRemove('{{$index}}')" wire:key="hotelRemove_{{$index}}">
                        <div>
                            <div class="text-white">
                                {{$item}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endisset

        <div class="pt-5 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-4">
            @foreach(\App\Hotel::where('curator','=',$hotel->curator)->where('id', '!=', $hotel->id)->get() as $item)
                <div class="text-white">
                    <label>
                        <input type="checkbox" value="{{$item->id}}" wire:click="otherHotelAdd({{$item->id}})" @if(collect($otherHotelLists)->search($item->id)!==false) checked disabled @endif>
                        {{$item->id}}:{{$item->option->title}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-2">
        <button wire:click="otherHotelListSubmit"
            class="w-full py-2 px-2 bg-blue-500 hover:bg-blue-600 text-white">
            등록
        </button>
    </div>

    <div class="py-6">
        <div class="pb-2 text-lg text-white">
            적용 된 호텔 리스트
        </div>
        <div class="text-white">
            @unless($hotel->other_hotels[0])
                설정 없음
            @endisset
            @foreach($hotel->other_hotels as $index=>$other_hotel)
                @php
                    $item = \App\Hotel::find($other_hotel);
                @endphp
                @isset($item->options[0])
                    <div>
                        {{$index+1}}.{{$item->id ?? ''}}.{{$item->option->title}}&nbsp;&nbsp;
                    </div>
                @endisset
            @endforeach
        </div>
    </div>
</div>
