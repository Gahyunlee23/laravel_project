<div x-data="{ show : false , count : 0}">
    <div>
        <div
            class="cursor-pointer rounded-md text-white py-1"
            :class="{
                'bg-green-500 hover:bg-green-600' : count >= 1,
                 ' bg-blue-500 hover:bg-blue-600' : count === 0
             }"
            @click="count++;show=true;$('body').css('overflow','hidden');"
             wire:click="$emitSelf('curatorHotelImport')">
            호텔 확인
        </div>
    </div>

    <div x-show="show" x-cloak
         class="w-full h-full fixed top-0 left-0">
        <div class="absolute w-full h-full top-0 left-0 bg-black bg-opacity-75" @click="show=false;$('body').css('overflow','visible');"></div>
        <div class="w-full h-full flex justify-center items-center">
            <div class="z-10 w-full max-w-4xl rounded-md bg-gray-400 border-2 border-solid border-tm-c-d7d3cf shadow">
                <div @click="show=false;$('body').css('overflow','visible');"
                     class="ml-auto mt-1 mr-1 w-max-content px-2 py-2 bg-gray-200 rounded-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <g fill="none" fill-rule="evenodd">
                            <g>
                                <g>
                                    <g>
                                        <path stroke="#D7D3CF" d="M4 15.843L15.843 4M4 4L15.843 15.843" transform="translate(-310 -217) translate(202 212) translate(108 5)"/>
                                        <path d="M0 0H20V20H0z" transform="translate(-310 -217) translate(202 212) translate(108 5)"/>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="flex flex-wrap px-2">
                    <div class="text-left font-bold text-black space-y-2">
                        <div class="text-xl">
                            큐레이터
                        </div>
                        <div class="text-lg">
                            {{$curator->name ?? '큐레이터'}}님
                        </div>
                    </div>
                </div>
                <div class="px-4 py-4">
                    <table class="table w-full">
                        <thead class="py-3 bg-white">
                        <tr>
                            <td class="px-2">
                                ID
                            </td>
                            <td class="px-2">
                                호텔 명칭
                            </td>
                            <td class="px-2">
                                적용
                            </td>
                        </tr>
                        </thead>
                        @foreach ($hotels as $hotel)
                            <tbody class="py-1 bg-gray-200 hover:bg-gray-300">
                                <tr >
                                    <td class="px-2">
                                        {{$hotel->id}}
                                    </td>
                                    <td class="px-2">
                                        {{$hotel->option->title}}
                                    </td>
                                    <td>
                                        {{$check_hotel[$loop->index]['id']}}-
                                        <input type="checkbox"
                                               wire:model="check_hotel.{{$loop->index}}.bool"
                                               wire:change="checkboxCheckedChange({{$loop->index}},{{$check_hotel[$loop->index]['id']}})">
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
