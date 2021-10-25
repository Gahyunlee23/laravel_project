<div class="wire_information_creatingBox" data-id="reservation">
    <div class="w-full justify-center items-center h-full">
        <div id="reservation_box" class="pl-3 pr-1 divide-y-2 bg-white border-2 rounded-md z-50 shadow-lg"
             style="#max-height: 70vh;overflow-y: scroll;">
            <div class="py-2">
                <!--   wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))"             -->
                <form name="reservation_form" id="reservation_form" wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))">
                    @csrf
                    <div class="input_hidden_box hidden">
                        <input type="hidden" name="order_id" value="{{$order_id}}" wire:model="order_id" readonly>
                        <input type="hidden" name="reservation_id" wire:model="reservation_id" readonly>
                    </div>

                    <div class="">
                        <div class="flex">
                            <div class="flex-1 font-bold text-black text-xl py-2">
                                주문 데이터
                            </div>
                        </div>
                        <div class="flex flex-wrap justify-center gap-1">

                            <div class="w-full rounded-md px-2 bg-gray-100">
                                <div class="w-full justify-center items-center">
                                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                                        호텔정보
                                    </div>
                                    <div class="w-full flex gap-1">
                                        <select name="hotel_id" id="hotel_id" wire:change="hotel_select_change"
                                                wire:model="hotel_id"
                                                class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @error('hotel_id')border border-red-500 @enderror">
                                            <option value="" selected>호텔 선택</option>
                                            @foreach(\App\Hotel::all() as $hotel)
                                                <option value="{{$hotel->id}}" >
                                                    {{\App\HotelOption::whereHotelId($hotel->id)->whereDisable('N')->first()['title']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('hotel_id')
                                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-full flex flex-wrap justify-center gap-2">
                                <div class="w-full  py-2 font-bold text-black text-xl">
                                    입주자 정보
                                </div>
                                <div class="w-full rounded-md px-2 bg-gray-100">
                                    <div class="w-full justify-center items-center">
                                        <div class="w-full NaNumSquare px-1 py-2 font-bold">
                                            성명
                                        </div>
                                        <div class="w-full flex gap-1">
                                            <input type="text" name="order_name" wire:model="order_name" autocomplete="off"
                                                   placeholder="성명을 입력해주세요."
                                                   class="flex-1 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @error('order_name')border border-red-500 @enderror">
                                        </div>
                                        @error('order_name')
                                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full justify-center items-center">
                                        <div class="w-full NaNumSquare px-1 py-2 font-bold">
                                            이메일 ex]모를경우 [a+핸드폰번호(-)제외한]@naver.com 으로 통일 입력해주세요.<br>
                                            이메일 명칭으로 자동 회원가입 처리됩니다.
                                        </div>
                                        <div class="w-full flex gap-1">
                                            <input type="email" name="order_email" wire:model="order_email" autocomplete="off"
                                                   placeholder="이메일을 입력해주세요."
                                                   class="flex-1 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @error('order_email')border border-red-500 @enderror">
                                        </div>
                                        @error('order_email')
                                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full justify-center items-center">
                                        <div class="w-full sm:w-auto NaNumSquare px-1 py-2 font-bold">
                                            연락처
                                        </div>
                                        <div class="w-full flex gap-1">
                                            <input type="tel" name="order_hp" wire:model="order_hp" autocomplete="off"
                                                   placeholder="연락처를 입력해주세요.예] 01091031608"
                                                   class="order_hp flex-1 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @error('order_hp')border border-red-500 @enderror">
                                        </div>
                                        @error('order_hp')
                                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full justify-center items-center">
                                        <div class="w-full sm:w-auto NaNumSquare px-1 py-2 font-bold">
                                            입주 목적
                                        </div>
                                        <div class="w-full flex gap-1">
                                            <input type="text" name="purpose" wire:model="purpose" autocomplete="off"
                                                   class="purpose flex-1 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @error('purpose')border border-red-500 @enderror">
                                        </div>
                                        @error('purpose')
                                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="w-full justify-center items-center">
                                        <div class="w-full sm:w-auto NaNumSquare px-1 py-2 font-bold">
                                            방문 경로
                                        </div>
                                        <div class="w-full flex gap-1">
                                            <input type="text" name="visit_route" wire:model="visit_route" autocomplete="off"
                                                   class="purpose flex-1 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @error('visit_route')border border-red-500 @enderror">
                                        </div>
                                        @error('visit_route')
                                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div x-show="hotel_id"
                                         class="w-full py-4 flex-auto flex justify-center items-center @if(!$reservation_box) hidden @endif">
                                        <label class="select-none px-1 NaNumSquare font-bold">
                                            <input type="radio" name="type" value="tour" checked wire:model="reservation_type" wire:change="reservation_type_change" onchange="reservation_type()">
                                            호텔투어
                                        </label>
                                        <label class="select-none px-1 NaNumSquare font-bold">
                                            <input type="radio" name="type" value="month" wire:model="reservation_type" wire:change="reservation_type_change" onchange="reservation_type()">
                                            호텔입주
                                        </label>
                                        @error('reservation_type')
                                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full py-1" v-show="reservation_type">
                                <div
                                    class="w-full flex flex-wrap justify-center items-center gap-2 px-2 bg-gray-100 rounded-md @if(!$reservation_box) hidden @endif">
                                    <div class="flex-1 py-2 font-bold text-black text-xl">
                                        @if($reservation_type ==='tour')
                                            투어 희망 정보
                                        @elseif($reservation_type ==='month')
                                            입주 희망 정보
                                        @endif
                                    </div>

                                    @if($reservation_type ==='month')
                                        <div class="w-full" x-data="{show : 'a'}">
                                            <div>
                                                <div class="flex space-x-2 text-lg">
                                                    <div class="hover:text-black hover:font-bold px-1 rounded-md bg-gray-400"
                                                         @click="show='a'" wire:click="$set('roomUpdate',false);">
                                                        이전 희망 정보
                                                    </div>
                                                    <div class="hover:text-black hover:font-bold px-1 rounded-md bg-gray-400"
                                                         @click="show='b'" wire:click="$set('roomUpdate',true);">
                                                        희망 정보 변경
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="show === 'a'">
                                                @if($hotel_reservation)
                                                <div>
                                                    옵션 : {{ \App\HotelRoom::find($hotel_reservation->room_id)->name ?? '옵션선택 없음' }}
                                                </div>
                                                <div>
                                                    룸 타입 : {{ \App\HotelRoomType::find($hotel_reservation->room_type_id)->name ?? '룸 선택 없음' }}
                                                </div>
                                                <div>
                                                    룸 업그레이드 타입 : {{ \App\HotelRoomType::find($hotel_reservation->room_type_upgrade_id)->name ?? '없음'}}
                                                </div>
                                                @else
                                                    <div class="pt-1">
                                                        희망 정보 변경으로 진행
                                                    </div>
                                                @endif
                                            </div>
                                            <div x-show="show === 'b'" x-cloak>
                                                <div
                                                    class="w-full flex-wrap justify-center items-center gap-1">
                                                    <div class="sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                                                        상품 옵션 정보
                                                    </div>
                                                    <div class="w-full flex gap-1">
                                                        <select name="room_id" id="room_id" wire:model="room_id" wire:change="room_select_change"
                                                                class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                            <option value="" selected>룸 선택</option>
                                                            @isset($rooms)
                                                                @foreach($rooms as $room)
                                                                    @isset($room)
                                                                        <option
                                                                            value="{{$room->id ?? ''}}">{{$room->title ?? ''}}ㆍ{{$room->main_explanation ?? ''}} {{ number_format($room->sale_price ?? 0) }}
                                                                        </option>
                                                                    @endisset
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                    </div>
                                                </div>
                                                @if(isset($select_room) && $room_id !== '' )
                                                    <div class="w-full flex-wrap justify-center items-center gap-1">
                                                        <div class="w-full NaNumSquare px-1 py-2 font-bold">
                                                            고객 희망 객실 정보
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-2">
                                                            <select name="room_type_id" id="room_type_id"
                                                                    class="room_type_id shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                                    wire:model="room_type_id" wire:change="room_select_check">
                                                                <option value="">선택해주세요.</option>
                                                                @isset($room_options)
                                                                    @foreach ($room_options as $item)
                                                                        <option value="{{$item}}">
                                                                            {{ \App\HotelRoomType::where('id','=',$item)->first()->name}}
                                                                        </option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @if(isset($room_type_id) && $room_type_id !=='' && $room_upgrades->count()>=1)
                                                                <select name="room_type_upgrade_id" id="room_type_upgrade_id"
                                                                        class="shadow border rounded py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                                                        wire:model="room_type_upgrade_id">
                                                                    <option value="">선택해주세요.</option>
                                                                    @foreach ($room_upgrades as $item)
                                                                        <option value="{{$item}}" class="disabled:bg-gray-300" >
                                                                            Upgrade : {{ \App\HotelRoomType::where('id','=',$item)->first()->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    @endif

                                    @if($reservation_type ==='tour')
                                        <div class="w-full flex-wrap justify-center items-center gap-1">
                                            <div class="w-full NaNumSquare px-1 py-2 font-bold">
                                                @if($order_desired_type==='user_send')
                                                    투어 확정일
                                                @else
                                                    투어 희망일
                                                @endif
                                            </div>
                                            <div class="w-full flex gap-1">
                                                <input type="date" name="order_desired_dt" wire:model="order_desired_dt"
                                                       class="flex-1 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <input type="time" name="order_desired_time" wire:model="order_desired_time" value="10:00"
                                                       class="flex-1 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            </div>
                                        </div>
                                    @elseif($reservation_type ==='month')
                                        <div class="w-full justify-center items-center gap-1" x-show="select_room">
                                            <div class="sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                                                룸 박수/일수
                                            </div>
                                            <div class="w-full flex flex-wrap items-center gap-1">
                                                <input type="text" @if(isset($select_room->nights) && $select_room->nights === 0 ) readonly disabled @endif value="{{$select_room->nights ?? '0'}}"
                                                       class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">박
                                                <input type="text" @if(isset($select_room->days) && $select_room->days === 0) readonly disabled @endif value="{{$select_room->days ?? '0'}}"
                                                       class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">일
                                            </div>
                                        </div>
                                        <div class="w-full justify-center items-center gap-1">
                                            <div class="sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                                                @if($order_desired_type==='user_send')
                                                    입주 확정일
                                                @else
                                                    입주 희망일
                                                @endif
                                            </div>
                                            <div class="w-full flex flex-wrap gap-1">
                                                <input type="date" name="start_dt1" wire:model="start_dt1" wire:change="start_dt_change"
                                                       class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <input type="time" name="start_dt2" wire:model="start_dt2"
                                                       class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            </div>
                                        </div>
                                        <div class="w-full flex-wrap justify-center items-center gap-1">
                                            <div class="sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                                                퇴실 예정일
                                            </div>
                                            <div class="w-full flex flex-wrap gap-1">
                                                <input type="date" name="end_dt1" wire:model="end_dt1"
                                                       class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <input type="time" name="end_dt2" wire:model="end_dt2" value="11:00"
                                                       class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="w-full py-1">
                                <div class="flex">
                                    <div class="flex-1 font-bold text-black text-xl py-2">
                                        이외 설정
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 px-2 bg-gray-100 rounded-md">

                                    <div class="w-full justify-center items-center">
                                        <div class="sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                                            큐레이터 정보
                                        </div>
                                        <div class="w-full flex flex-wrap gap-1">
                                            <select name="curator_id" id="curator_id" wire:model="curator_id"
                                                    class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="" selected>큐레이터 존재 시 선택</option>
                                                @foreach(\App\Curator::all() as $curator)
                                                    <option value="{{$curator->id}}">
                                                        {{ $curator->name }} {{ $curator->user_id }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if($reservation_type)
                                        <div class="w-full flex-wrap justify-center items-center gap-1">
                                            <div class="sm:flex-1 NaNumSquare px-1 py-2 font-bold">
                                                주문 상태
                                            </div>
                                            <div class="w-full flex flex-wrap gap-1">

                                                <select name="order_status" id="order_status" wire:model="order_status"
                                                        class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                    @if($reservation_type ==='tour')
                                                        <option value="" @if($order_status === null) selected @endif>투어 상태 선택</option>
                                                        <option value="2" @if($order_status === 2) selected @endif>투어신청완료 (호텔관리자_메일 전달가능)</option>
                                                        <option value="3" @if($order_status === 3) selected @endif disabled class="text-gray-300">결제완료</option>
                                                        <option value="4" @if($order_status === 4) selected @endif>사용완료</option>
                                                        <option value="5" @if($order_status === 5) selected @endif>투어 확정 (고객 알림톡 전달가능)</option>
                                                        <option value="8" @if($order_status === 8) selected @endif disabled class="text-gray-300">결제시도</option>
                                                        <option value="9" @if($order_status === 9) selected @endif>보류</option>
                                                        <option value="0" @if($order_status === 0) selected @endif>취소상태</option>
                                                    @elseif($reservation_type ==='month')
                                                        <option value="" @if($order_status === null) selected @endif>입주/결제 상태 선택</option>
                                                        <option value="2" @if($order_status === 2) selected @endif>주문완료 (미결제)</option>
                                                        <option value="3" @if($order_status === 3) selected @endif>결제완료</option>
                                                        <option value="4" @if($order_status === 4) selected @endif>사용완료</option>
                                                        <option value="5" @if($order_status === 5) selected @endif>입주 확정 (고객 알림톡 전달가능)</option>
                                                        <option value="8" @if($order_status === 8) selected @endif>결제시도+실패</option>
                                                        <option value="9" @if($order_status === 9) selected @endif>보류</option>
                                                        <option value="0" @if($order_status === 0) selected @endif>취소상태</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="py-2 w-full flex flex-wrap justify-center items-center" v-show="reservation_type">
                            <select class="form-select" name="order_desired_type" id="order_desired_type" wire:model="order_desired_type">
                                <option value="none_send">저장만</option>
                                @if($reservation_type==='tour')
                                    @if($order_status === '2')
                                        @if(isset($reservation_id))
                                            <option value="hotel_send_tour2">투어 변경 문의 + (호텔관리자_메일전송)</option>
                                        @else
                                            <option value="hotel_send_tour">투어 확정 문의 + (호텔관리자_메일전송)</option>
                                        @endif
                                    @endif
                                    @if($order_status === '5' || $order_status === '3')
                                        <option value="user_send">투어 확정 + (고객 알림톡 전달) + (호텔관리자_메일전송)</option>
                                    @endif
                                @endif
                                @if($order_status === '0')
                                    <option value="cancel_user_hotel_send">{{ $reservation_type==='tour' ? '투어' : '입주' }} 취소처리 + (고객 알림톡 전달) + (호텔관리자_메일전송)</option>
                                    <option value="cancel_user_send">{{ $reservation_type==='tour' ? '투어' : '입주' }} 취소처리 + (고객 알림톡 전달)</option>
                                    <option value="cancel_hotel_send">{{ $reservation_type==='tour' ? '투어' : '입주' }} 취소처리 + (호텔관리자_메일전송)</option>
                                @endif
                            </select>
                        </div>
                        @if($order_status === '0')
                            <div class="flex-row justify-center space-y-px">
                                @if($reservation_type==='tour')
                                    <div class="text-center">
                                        투어 취소 처리시 [호텔관리자]확정메일 비활성화, 확정 정보(존재시) 취소 처리
                                    </div>
                                @elseif($reservation_type==='month')
                                    <div class="text-left p-4 bg-red-500 rounded-md text-white">
                                        입주 취소 진행 순서<br>
                                        1.마스터 테이블 내 결제상태 (결제완료) 하단 취소 버튼으로 진행해주세요.<br>
                                        2.취소 처리 및 페이플 취소도 처리됩니다.<br>
                                        3.이후 현 페이지에서 [주문상태] 취소상태 + 취소 처리 진행 취소 처리<br>
                                        4.[호텔관리자]확정메일 비활성화 및 확정 정보(존재시) 취소 처리가 됩니다.
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="w-full flex justify-center items-center py-4">
                        <label>
                            <input type="checkbox" name="use_terms" wire:model="use_terms" checked>
                            <span class="NaNumSquare px-2 font-bold">
                                이용약관
                            </span>
                        </label>
                        <label>
                            <input type="checkbox" name="order_privacy" wire:model="order_privacy" checked>
                            <span class="NaNumSquare px-2 font-bold">
                                개인정보활용
                            </span>
                        </label>
                        <label>
                            <input type="checkbox" name="order_marketing" wire:model="order_marketing">
                            <span class="NaNumSquare px-2 font-bold">
                                마케팅
                            </span>
                        </label>
                        @error('use_terms')
                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                        @error('order_privacy')
                        <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex">
                        <div class="ml-auto flex-0">
                            <div class="">
                                <span class="inline-flex rounded-md shadow-sm">
                                    <button type="submit"
                                            class="inline-flex items-center justify-center py-1 px-2 border border-blue-500 rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-black active:bg-blue-700 transition duration-150 ease-in-out disabled:opacity-50">
                                        <svg wire:loading wire:target="submitForm" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <span class="text-base leading-6 font-medium text-white">주문 정보 저장 @if($order_desired_type ==='hotel_send_tour') + 호텔 메일 @elseif( $order_desired_type==='user_send') + 고객 알림톡 @endif</span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if($reservation_type === 'month')
                <div>
                    <div class="py-2" v-show="reservation_id">
                        @if($payment_id || $paymentFormView)
                            @livewire('admin.information.generation.payment.form', ['paymentFormView'=>$paymentFormView, 'reservation_id'=>$reservation_id])
                        @endif
                        @if(isset($reservation_id) && !$paymentFormView && \App\Payment::whereReservationId($reservation_id)->count() === 0)
                            <div class="py-2 flex payment_creatingBox">
                                <div class="flex-0 ml-auto">
                                    <div onclick="wire_payment_creatingBox_show()" class="bg-green-500 text-white px-4 py-2 border rounded-md hover:bg-green-700 hover:border-green-500 cursor-pointer">
                                        결제 정보 추가
                                    </div>
                                </div>
                            </div>
                        @else
                            @if(isset($reservation_id) && !$paymentFormView && \App\Payment::whereReservationId($reservation_id)->count() === 0)
                                <div class="py-2 flex items-center">
                                    <div class="flex-0 ml-auto" onclick="paymentBoxHide()">
                                        <div class="bg-red-400 text-white px-4 py-2 border rounded-md hover:bg-red-600 cursor-pointer">
                                            결제 닫기
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
            @if((isset($payment_id) && $reservation_type==='month' && ($order_status === '3' || $order_status === '5') ))
                <div>
                    <div class="py-2">
                        @livewire('admin.information.generation.confirmation.form', ['confirmationFormView'=>$confirmationFormView, 'reservation_id'=>$reservation_id, 'reservation_type'=>$reservation_type])
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if( Session::has('submit'))
        <div class="fixed bottom-0 mb-10 cursor-pointer"
             x-on:click="show=false" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="p-4 rounded-md bg-gradient-to-r from-black-200 to-black-600
            @if(Session::get('submit')['result']==='success') bg-gradient-to-r from-green-400 to-green-600 @endif
            @if(Session::get('submit')['result']==='fall') bg-gradient-to-r from-red-400 to-red-600 @endif
            @if(Session::get('submit')['result']==='save') bg-gradient-to-r from-orange-400 to-orange-600 @endif">
                <div class="flex items-center AppSdGothicNeoR font-bold gap-4">
                    @if(Session::has('submit.result'))
                        <div class="text-gray-700">
                            {{ Session::get('submit')['result'] }}
                        </div>
                    @endif
                    @if(Session::has('submit.outerSendResult'))
                        <div class="ml-auto text-xl text-black">
                            {{ Session::get('submit')['outerSendResult'] }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @php
            Session::flash('submit', null);
        @endphp
    @endif
    <div class="button_container py-4">
        <div class="flex">
            <div wire:click="backRedirect"
                 class="bg-gray-500 text-white px-4 py-2 border rounded-md hover:border-gray-700 cursor-pointer">
                돌아가기
            </div>
        </div>
    </div>
</div>
<style>
    ::-webkit-scrollbar-thumb{
        background-color: rgb(133, 134, 138);
    }
</style>
<script type="text/javascript">
    /*
    document.addEventListener ('livewire:load', () => {
        window.livewire.on('renderChange', () => {
        });
    });
    * */

    $(document).ready(function () {
        $("input:radio[name=reservation_type]").on('change', function () {
            if ($(this).val() === 'tour') {
                $('.room_data').addClass('hidden');
            } else if ($(this).val() === 'month') {
                $('.room_data').removeClass('hidden');
            }
        });
    });

    const target = $('.wire_information_creatingBox[data-id=reservation]');

    function wire_reservation_creatingBox_hide() {
        Livewire.emit('renderChangeEvent');
        target.hide();
        return target;
    }

    function wire_reservation_creatingBox_show() {
        Livewire.emit('reset_form_event',Math.floor(Math.random()*9999)+1000);
        target.show();
        return target;
    }

    function wire_reservation_creatingBox_show_target($order_id,$reservation_id) {
        Livewire.emit('reservation_get_event',$order_id,$reservation_id);
        target.show();
        return target;
    }

    /* Payment Form Start */
    function wire_payment_creatingBox_show() {
        Livewire.emit('paymentFormShowEvent');
        $('.payment_creatingBox').hide();
    }
    function paymentBoxHide() {
        Livewire.emit('paymentFormHideEvent');
        setTimeout(function (){
            $('.payment_creatingBox').show();
        },300);
    }
    /* Payment Form END */

    /* Confirmation Form Start*/
    function reservation_type(){
        Livewire.emit('reservationTypeChangeEvent',$('input:radio[name=type]:checked').val());
    }
    /* Confirmation Form End */
</script>
