<div>
    @if(isset($rooms) )
        <div class="py-2">
            <div class="py-2 flex text-lg bg-gray-300" x-data="{type : '{{$disable_type}}'}">
                <div class="flex-1 text-center cursor-pointer"
                     :class="{
            'text-black font-bold' :type === 'all'
}">
                    <div wire:click="disableType('all')">전체보기{{$all_count ?? 0}}개</div>
                </div>
                <div class="flex-1 text-center cursor-pointer"
                     :class="{
        'text-black font-bold' :type === 'Y'
}">
                    <div wire:click="disableType('Y')">판매 중 상품만 보기{{$visible_count ?? 0}}개</div>
                </div>
            </div>
        </div>
        <div class="overflow-x-scroll py-2">
            <table class="table-auto w-full">
                <thead class="bg-gray-300">
                <tr>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">정렬</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">ID</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">옵션명</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">해당 룸타입</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">박</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">일</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">쿠폰</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">원가</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">판매가</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">할인률</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">취소환불금액</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">룸 하단 설명</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">설명</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">서브 설명</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">연결 룸타입</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">솔드아웃 룸타입</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">업그레이드 룸타입</td>
                    <td class="px-4 py-1 text-center font-bold whitespace-pre">메모</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">판매</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">상태</td>
                    <td class="px-2 py-1 text-center font-bold whitespace-pre">수정</td>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $index=>$room)
                    <tr class="bg-gray-200 hover:bg-gray-400">
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->order}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->id}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->title}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->name}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->nights}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->days}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->coupon}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{number_format($room->price ?? 0).'원'}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{number_format($room->sale_price ?? 0).'원'}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->discount_rate}}%</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{number_format($room->refund_amount ?? 0).'원'}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->main_explanation}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->explanation}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->sub_explanation}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->room_option}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->room_sold_out}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->room_upgrade}}</td>
                        <td class="px-2 py-1 text-center whitespace-pre">{{$room->memo}}</td>
                        @if($room->visible)
                            <td class="px-2 py-1 text-center whitespace-pre"
                            ><div class="px-2 py-1 rounded-md">판매 On</div></td>
                        @else
                            <td class="px-2 py-1 text-center whitespace-pre">판매 Off</td>
                        @endif
                        @if($room->disable === 'Y')
                            <td class="px-2 py-1 text-center whitespace-pre"
                                onclick="confirm('Disable 취소 처리 하시겠습니까?')|| event.stopImmediatePropagation()"
                                wire:click="roomDisableById('{{$room->id}}','N');" wire:key="{{$index}}"
                            ><div class="px-2 py-1 bg-red-500 hover:bg-red-600 cursor-pointer rounded-md text-white">비활성화 중</div></td>
                        @else
                            <td class="px-2 py-1 text-center whitespace-pre"
                                onclick="confirm('Disable 처리 하시겠습니까?')|| event.stopImmediatePropagation()"
                                wire:click="roomDisableById('{{$room->id}}','Y')" wire:key="{{$index}}"
                            ><div class="px-2 py-1 bg-green-500 hover:bg-green-600 cursor-pointer rounded-md text-white">활성화 중</div></td>
                        @endif
                        <td class="px-2 py-1 text-center whitespace-pre"
                            onclick="confirm('수정 하시겠습니까?')|| event.stopImmediatePropagation()"
                            wire:click="roomUpdate({{$room->id}})" wire:key="{{$index}}"
                        ><div class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 cursor-pointer rounded-md text-white">수정</div></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    {{-- 상품 옵션 = 룸 --}}
    <div class="mt-3" x-data="{show : '{{$form_show}}'}">
        <div class="font-bold text-2xl text-center"
             @click="show = !show"
        >
            <div class="px-2 py-2 text-white bg-red-500 hover:bg-red-600 cursor-pointer rounded-sm"
                 x-show="show" x-cloak wire:click="formReset">
                @if($roomFind !== null)
                    호텔 상품 수정 닫기
                @else
                    호텔 상품 닫기
                @endif
            </div>
            <div class="px-2 py-2 text-white bg-green-500 hover:bg-green-600 cursor-pointer rounded-sm"
                 x-show="!show" x-cloak>
                호텔 상품 추가 하기 (이후 자동화)
            </div>
        </div>
        <div x-show="show" x-cloak>
            <table class="table-auto w-full bg-gray-200 rounded-lg">
                <tbody class="@error('order')bg-red-400 @enderror">
                <tr class="">
                    <td class="text-center text-black font-bold">출력순</td>
                    <td class="py-3 px-2">
                        <input type="text" name="order" id="order" wire:model="order" class="form-input w-full">
                    </td>
                </tr>
                @error('order')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>
                <tbody class="@error('title')bg-red-400 @enderror">
                <tr class="">
                    <td class="text-center text-black font-bold">옵션명</td>
                    <td class="py-3 px-2">
                        <input type="text" name="title" id="title" wire:model="title" class="form-input w-full">
                    </td>
                </tr>
                @error('title')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('name')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">해당 룸타입</td>
                    <td class="py-3 px-2">
                        <input type="text" name="name" id="name" wire:model="name" class="form-input w-full">
                    </td>
                </tr>
                @error('name')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('price')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">원가</td>
                    <td class="py-3 px-2">
                        <input type="text" name="price" id="price" wire:model="price" class="form-input w-full">
                    </td>
                </tr>
                @error('price')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('sale_price')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">판매가</td>
                    <td class="py-3 px-2">
                        <input type="text" name="sale_price" id="sale_price" wire:model="sale_price" class="form-input w-full">
                    </td>
                </tr>
                @error('sale_price')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>
                <tbody class="@error('discount_rate')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">할인률</td>
                    <td class="py-3 px-2">
                        <input type="text" name="discount_rate" id="discount_rate" wire:model="discount_rate" class="form-input w-full">
                    </td>
                </tr>
                @error('discount_rate')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('coupon')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">쿠폰</td>
                    <td class="py-3 px-2">
                        <input type="text" name="coupon" id="coupon" wire:model="coupon" class="form-input w-full">
                    </td>
                </tr>
                @error('coupon')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('main_explanation')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">메인 설명</td>
                    <td class="py-3 px-2">
                        <input type="text" name="main_explanation" id="main_explanation" wire:model="main_explanation" class="form-input w-full">
                    </td>
                </tr>
                @error('main_explanation')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('nights')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">박/일</td>
                    <td class="py-3 px-2 grid grid-cols-2 gap-2">
                        <div>
                            <input type="text" name="nights" id="nights" wire:model="nights" class="form-input w-full">
                        </div>
                        <div>
                            <input type="text" name="days" id="days" wire:model="days" class="form-input w-full">
                        </div>
                    </td>
                </tr>
                @error('nights')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                @error('days')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>

                <tbody class="@error('memo')bg-red-400 @enderror">
                <tr>
                    <td class="text-center text-black font-bold">메모</td>
                    <td class="py-3 px-2">
                        <textarea type="text" name="memo" id="memo" wire:model="memo" class="form-input w-full"></textarea>
                    </td>
                </tr>
                @error('memo')
                <tr>
                    <td class="py-2 pl-2 text-red-500 font-bold" colspan="2">
                        {{$message ?? '오류 에러'}}
                    </td>
                </tr>
                @enderror
                </tbody>
            </table>
            <div class="py-1">
                @if($roomFind === null)
                    <div wire:click="RoomSubmit"
                         class="py-2 bg-blue-400 hover:bg-blue-500 rounded-sm text-white text-center text-xl font-bold cursor-pointer">
                        추가
                    </div>
                @else
                    <div wire:click="RoomUpdateSubmit"
                         class="py-2 bg-blue-400 hover:bg-blue-500 rounded-sm text-white text-center text-xl font-bold cursor-pointer">
                        수정
                    </div>
                @endif
            </div>
        </div>
        @if(session()->has('message'))
            <div class="py-1">
                <div class="px-2 py-2 bg-green-600 text-white rounded-md text-right">
                    {{session()->pull('message') }}
                </div>
            </div>
        @endif
    </div>

    <div class="px-2 bg-tm-c-ED border-t border-solid border-tm-c-979b9f rounded-b-sm">
        @if(isset($rooms)&& $rooms->count()===0)
            <div class="w-full text-xl text-center">
                <div class="py-2">
                    데이터 없음
                </div>
            </div>
        @elseif(isset($rooms)&& $rooms->count()>=1)
            <div class="w-full">
                <div class="py-2">
                    {{$rooms->links('vendor.livewire.tailwind.center-paginate')}}
                </div>
            </div>
        @endif
    </div>
</div>
