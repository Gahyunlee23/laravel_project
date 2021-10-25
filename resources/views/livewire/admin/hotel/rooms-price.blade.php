<div>
    @php
        $option_count=0;
        if($rooms){
            foreach ($rooms as $list_room){
                $list_room->room_option ?? $option_count++;
            }
        }else{
            foreach ($item->rooms as $list_room){
                $list_room->room_option ?? $option_count++;
            }
        }
    @endphp
    <div class="border hover:border-2 border-solid border-black">
        <div
            class="flow-root px-4 py-2 bg-gray-400 cursor-pointer hover:bg-gray-500 hover:text-white"
            wire:click="dataLoad"
        >
            <div class="float-left font-bold text-black">룸(가격) 정보
                @if($option_count)<span class="text-red-600">{{$option_count}}개의 룸 옵션 설정이 안됬습니다.</span>@endif
            </div>
            <div class="float-right">🧮📊💰</div>
        </div>

        <div wire:loading wire:target="dataLoad" class="w-full bg-gray-200 border-gray-700">
            <div class="px-4 py-3 text-2xl">
                데이터 가져오는 중..
            </div>
        </div>

        @if($show)
        <div>
            <form action="{{ route('hotel.room.option',['hotel'=>$item->id]) }}"
                  method="POST">
                @csrf
                <table
                    class="table-auto w-full bg-gray-200 border-gray-700 text-left">
                    @foreach($rooms as $index=>$room)
                        <thead>
                        <tr>
                            <th colspan="8" class="border px-4 py-2 bg-gray-300">
                                룸 {{$index+1}}</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="border px-4 py-2">룸 명칭</th>
                            <td colspan="2"
                                class="border px-4 py-2">{{$room->title ?? '정보없음'}}</td>
                            <th colspan="2" class="border px-4 py-2">하단설명</th>
                            <td colspan="2"
                                class="border px-4 py-2">{{$room->main_explanation ?? '정보없음'}}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="border px-4 py-2">침대종류</th>
                            <td colspan="2"
                                class="border px-4 py-2">{{$room->explanation ?? '정보없음'}}</td>
                            <th colspan="2" class="border px-4 py-2">사이즈</th>
                            <td colspan="2"
                                class="border px-4 py-2">{{$room->sub_explanation ?? '정보없음'}}</td>
                        </tr>
                        <tr class="border-t-2 border-gray-300">
                            <th class="border px-4 py-2">원가</th>
                            <td class="border px-4 py-2">{{$room->price ?? '정보없음'}}</td>
                            <th class="border px-4 py-2">할인률</th>
                            <td class="border px-4 py-2">{{$room->discount_rate ?? '정보없음'}}</td>
                            <th class="border px-4 py-2">환불금액</th>
                            <td class="border px-4 py-2">{{$room->refund_amount ?? '정보없음'}}</td>
                            <th class="border px-4 py-2">판매가</th>
                            <td class="border px-4 py-2">{{$room->sale_price ?? '정보없음'}}</td>
                        </tr>

                        <tr class="border-t-2 border-gray-300">
                            <th class="border px-4 py-2" colspan="3">룸 옵션</th>
                            <th class="border px-4 py-2" colspan="1">객실판매가능수</th>
                            <th class="border px-4 py-2" colspan="1">옵션 연결</th>
                            <th class="border px-4 py-2" colspan="1">Sold Out</th>
                            <th class="border px-4 py-2" colspan="2">업그레이드</th>
                        </tr>
                        @foreach($item->room_types()->where(function($query){ $query->where('visible','=','1'); })->get() as $room_type)
                            @php
                                $room_type_index= $loop->index;
                                $room_upgrades = \Illuminate\Support\Str::of($room->room_upgrade)->explode(',');
                            @endphp
                            <tr class="border-t-2 border-gray-300">
                                <td class="text-center" colspan="3">
                                    {{$room_type->name}}
                                </td>
                                <td class="text-center" colspan="1">
                                    <div class="py-1">
                                        {{$room_type->sale_possibility_count}}
                                    </div>
                                </td>
                                <td class="text-center" colspan="1">
                                    <div class="py-1">
                                        <input type="checkbox"
                                               name="room_option[{{$index}}][]"
                                               @if( in_array($room_type->id,\Illuminate\Support\Str::of($room->room_option)->explode(',')->toArray())) checked
                                               @endif
                                               value="{{$room_type->id}}">
                                    </div>
                                </td>
                                <td class="text-center" colspan="1">
                                    <div class="py-1">
                                        <input type="checkbox"
                                               name="room_sold_out[{{$index}}][]"
                                               @if( in_array($room_type->id,\Illuminate\Support\Str::of($room->room_sold_out)->explode(',')->toArray())) checked
                                               @endif
                                               value="{{$room_type->id}}">
                                    </div>
                                </td>
                                <td class="text-center" colspan="2">
                                    <select name="room_upgrade[{{$index}}][]"
                                            id="room_upgrade">
                                        <option value="" selected>업그레이드 안함</option>
                                        @foreach($item->room_types()->where(function($query){ $query->where('visible','=','1')->orWhere('upgrade', '=', 'Y'); })->get() as $type)
                                            @continue($room_type->name === $type->name)
                                            <option
                                                @if( isset($room_upgrades[$room_type_index]) && $room_upgrades[$room_type_index] == $type->id) selected
                                                @endif
                                                value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                        </thead>
                    @endforeach
                </table>
                <div
                    class="w-full bg-gray-200 flex justify-center py-2 border-t border-solid border-gray-200">
                    <button
                        class="px-5 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">
                        룸 옵션 저장
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
