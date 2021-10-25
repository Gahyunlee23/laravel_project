@inject('formatter', 'App\Formatter')
<div>
    <div class="datatable px-2" x-data="datatables()">
        <div class="flex flex-wrap items-center gap-2 py-2">

            <div class="flex items-center">
                <select name="detailStatus" id="detailStatus" wire:model.lazy="searchData.detailStatus"
                        wire:input="searchDataSave"
                        class="w-40 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="all">상세 상태 전체</option>
                    <optgroup label="[투어]">
                        <option value="투어">투어</option>
                        <option value="신청완료">신청완료</option>
                        <option value="미확정">미확정</option>
                        <option value="확정">확정</option>
                        <option value="투어종료">투어종료</option>
                        <option value="투어취소">투어취소</option>
                    </optgroup>
                    <optgroup label="[입주]">
                        <option value="입주">입주</option>
                        <option value="주문완료">주문완료</option>
                        <option value="결제완료">결제완료</option>
                        <option value="미확정,결제완료">미확정</option>
                        <option value="확정,결제완료">입주예정</option>
                        <option value="입주중">입주중</option>
                        <option value="퇴실완료">퇴실</option>
                        <option value="중도퇴실">중도퇴실</option>
                        <option value="입주취소">입주취소</option>
                    </optgroup>
                </select>
            </div>

            <div class="flex items-center">
                <select name="hotelId" id="hotelId" wire:model.lazy="searchData.hotelId"
                        wire:input="searchDataSave"
                        class="w-32 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">호텔 전체</option>
                    @foreach (\App\Hotel::whereStatus(2)->get() as $hotel)
                        <option value="{{$hotel->id}}">{{$hotel->option->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center">
                <input id="userData" name="userData" type="text" wire:model='searchData.userData'
                       wire:input="searchDataSave"
                       placeholder="고객 정보" autocomplete="off"
                       class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
            </div>

            <div class="flex items-center">
                <input id="reservationOrder" name="reservationOrder" type="text"
                       wire:model='searchData.reservationOrder'
                       wire:input="searchDataSave"
                       placeholder="주문자 정보" autocomplete="off"
                       class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
            </div>

            <div class="ml-auto flex items-center mr-2 space-x-2">
                <div class="">
                    <div class="shadow rounded-lg flex">
                        <div class="relative">
                            <button @click.prevent="open = !open"
                                    class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-600 font-semibold py-2 px-2 md:px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <path
                                        d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5"/>
                                </svg>
                                <span class="hidden md:block">필터</span>
                            </button>
                            <div x-show="open" x-cloak @click.away="open = false"
                                 class="z-40 absolute top-0 right-0 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-2 px-2 space-y-2 overflow-hidden">

                                <div class="flex flex-wrap items-center">
                                    <div class="w-max-content px-2">출력수</div>
                                    <select name="reservationPagination" id="reservationPagination"
                                            wire:model="searchData.reservationPagination"
                                            wire:input="searchDataSave"
                                            class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class=" flex items-center">
                                    <select name="reservationStatus" id="reservationStatus"
                                            wire:model="searchData.reservationStatus"
                                            wire:input="searchDataSave"
                                            class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="">주문상태 전체</option>
                                        <option value="2">주문완료</option>
                                        <option value="3">결제완료</option>
                                        <option value="4">사용완료</option>
                                        <option value="5">입주중</option>
                                        <option value="8">결제실패</option>
                                        <option value="9">보류</option>
                                        <option value="0">취소상태</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <select name="paymentStatus" id="paymentStatus"
                                            wire:model="searchData.paymentStatus"
                                            wire:input="searchDataSave"
                                            class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="">결제 상태 전체</option>
                                        <option value="2">주문완료</option>
                                        <option value="3">결제완료</option>
                                        <option value="4">사용완료</option>
                                        <option value="5">입주중</option>
                                        <option value="8">결제실패</option>
                                        <option value="9">보류</option>
                                        <option value="0">취소상태</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-max-content px-2">주문</div>
                                    <input id="orderDt1" name="orderDt1" type="date" wire:model='searchData.orderDt1'
                                           wire:input="searchDataClearSave('orderDt1')"
                                           placeholder="시작" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    &bsim;
                                    <input id="orderDt2" name="orderDt2" type="date" wire:model='searchData.orderDt2'
                                           wire:input="searchDataClearSave('orderDt2')"
                                           placeholder="끝" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                                <div class="flex items-center">
                                    <div class="w-max-content px-2">결제</div>
                                    <input id="paymentDt1" name="paymentDt1" type="date"
                                           wire:model='searchData.paymentDt1'
                                           wire:input="searchDataClearSave('paymentDt1')"
                                           placeholder="시작" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    &bsim;
                                    <input id="paymentDt2" name="paymentDt2" type="date"
                                           wire:model='searchData.paymentDt2'
                                           wire:input="searchDataClearSave('paymentDt2')"
                                           placeholder="끝" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                                <div class="flex items-center">
                                    <div class="w-max-content px-2">입주</div>
                                    <input id="startDt1" name="startDt1" type="date" wire:model='searchData.startDt1'
                                           wire:input="searchDataClearSave('startDt1')"
                                           placeholder="시작" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    &bsim;
                                    <input id="startDt2" name="startDt2" type="date" wire:model='searchData.startDt2'
                                           wire:input="searchDataClearSave('startDt2')"
                                           placeholder="끝" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                                <div class="flex items-center">
                                    <div class="w-max-content px-2">퇴실</div>
                                    <input id="endDt1" name="endDt1" type="date" wire:model='searchData.endDt1'
                                           wire:input="searchDataClearSave('endDt1')"
                                           placeholder="시작" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    &bsim;
                                    <input id="endDt2" name="endDt2" type="date" wire:model='searchData.endDt2'
                                           wire:input="searchDataClearSave('endDt2')"
                                           placeholder="끝" autocomplete="off"
                                           class="w-auto shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div wire:click="searchDataClear" class="text-xs px-2">
                        검색초기화
                    </div>
                </div>
                <div>
                    <img class="cursor-pointer w-6 h-6 animate-spin" wire:click="renderChange"
                         src="https://img.icons8.com/android/26/000000/recurring-appointment.png"/>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-auto px-2">
        @isset($users)
            <table class="min-w-full table-auto" wire:loading.remove>
                <thead class="justify-between">
                <tr class="bg-gray-700">
                    <th class="order_name py-2 px-4">
                        <div class="text-gray-300 whitespace-pre" wire:click="sortBy('order_name')">주문자성명 @include('includes._sort-icon', ['field' => 'order_name'])</div>
                    </th>
                    <th class="order_email py-2">
                        <div class="text-gray-300 whitespace-pre" wire:click="sortBy('order_email')">주문자메일 @include('includes._sort-icon', ['field' => 'order_email'])</div>
                    </th>
                    <th class="hotel_data py-2 px-16">
                        <div class="text-gray-300 whitespace-pre" wire:click="sortBy('hotel_id')">호텔정보 @include('includes._sort-icon', ['field' => 'hotel_id'])</div>
                    </th>
                    <th class="py-2 px-26">
                        <div class="text-gray-300 whitespace-pre">희망/확정</div>
                    </th>
                    <th class="py-2 px-12">
                        <div class="text-gray-300 whitespace-pre">룸옵션</div>
                    </th>
                    <th class="py-2 px-12">
                        <div class="text-gray-300 whitespace-pre">연장일수</div>
                    </th>
                    <th class="py-2 px-6">
                        <div class="text-gray-300 whitespace-pre">결제금액</div>
                    </th>
                    <th class="py-2 px-6">
                        <div class="text-gray-300 whitespace-pre" wire:click="sortBy('visit_route')">방문경로 @include('includes._sort-icon', ['field' => 'visit_route'])</div>
                    </th>
                    <th class="py-2 px-6">
                        <div class="text-gray-300 whitespace-pre" wire:click="sortBy('purpose')">입주목적 @include('includes._sort-icon', ['field' => 'purpose'])</div>
                    </th>
                    <th class="py-2 px-6">
                        <div class="text-gray-300 whitespace-pre">주문시간</div>
                    </th>
                    <th class="py-2 px-6">
                        <div class="text-gray-300 whitespace-pre">결제수단</div>
                    </th>
                    <th class="py-2 px-6">
                        <div class="text-gray-300 whitespace-pre">결제시간</div>
                    </th>
                    <th class="payment_data py-2 px-4">
                        <div class="text-gray-300 whitespace-pre">결제상태</div>
                    </th>
                    <th class="confirmations_data py-2">
                        <div class="text-gray-300 whitespace-pre">알림톡</div>
                    </th>
                    <th class="py-2 w-max-content px-4 mx-auto">
                        <div class="text-gray-300 whitespace-pre flex justify-center">
                            <i class="fad fa-ufo"></i>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-gray-100">
                @foreach ($users as $user)
                    <tr class="bg-gray-200 py-2 text-center">
                        <td class="py-2">
                            <div class="flex justify-center items-center space-x-2">
                                @isset($user->profile_image)
                                    <div>
                                        <img src="{{$user->profile_image}}"
                                             class="float-left w-5 h-5 rounded-full hover:scale-150 transform"
                                             alt="프로필">
                                    </div>
                                @endisset
                                <div>{{$user->name}}</div>
                            </div>
                            @isset($user->kakao_social_id)
                                <div
                                    class="mt-1 mx-auto w-max-content py-1 px-2 bg-yellow-500 rounded-md text-black select-none">
                                    카카오톡
                                </div>
                            @endisset
                        </td>
                        <td class="order_email py-2 px-8">
                            {{$user->email ?? '정보없음'}}
                        </td>
                        <td class="py-2 px-8">
                            {{$user->phone ?? '정보없음'}}
                        </td>
                        @if($user->payments_count >=1)
                            <td class="py-2">
                                총 결제 : {{ number_format($user->payments_total_price)}}원
                            </td>
                            <td class="py-2">
                                결제수 : {{ number_format($user->payments_count)}}개
                            </td>
                            <td class="py-2">
                                결제평균 : {{ number_format(($user->payments_total_price/$user->payments_count)) }}원
                            </td>
                            <td colspan="9"></td>
                        @else
                            <td colspan="12"></td>
                        @endif
                    </tr>
                    @foreach ($user->reservations as $reservation)
                        <tr class="py-1 border border-t-2 border-b-2 border-gray-200 text-center">
                            <td class="py-2 px-2 text-center">
                                @switch($reservation->type)
                                    @case('tour')
                                    <div>투어</div>
                                    <div class="bg-gray-200 rounded-md py-1">
                                        @if($reservation->order_status === '2' && !isset($reservation->confirmation))
                                            미확정
                                        @elseif($reservation->order_status === '5' && isset($reservation->confirmation)
                                            && ($reservation->confirmation->start_dt <= \Carbon\Carbon::now()))
                                            투어 종료
                                        @elseif($reservation->order_status === '5' && isset($reservation->confirmation)
                                            && ( $reservation->confirmation->start_dt > \Carbon\Carbon::now()))
                                            확정
                                        @elseif($reservation->order_status === '0')
                                            취소
                                        @elseif($reservation->order_status === '2')
                                            신청완료
                                        @endif
                                    </div>
                                    @break

                                    @case('month')
                                    <div>입주</div>
                                    <div class="bg-gray-200 rounded-md py-1">
                                        @if($reservation->order_status === '2')
                                            미결제
                                        @elseif($reservation->order_status === '5' && isset($reservation->confirmation)
                                                && isset($reservation->confirmation->end_dt)
                                                && ($reservation->confirmation->end_dt <= \Carbon\Carbon::now()))
                                            퇴실완료
                                        @elseif($reservation->order_status === '5' && isset($reservation->confirmation)
                                                && isset($reservation->confirmation->start_dt) && isset($reservation->confirmation->end_dt)
                                                && ($reservation->confirmation->start_dt <= \Carbon\Carbon::now())
                                                && ($reservation->confirmation->end_dt >= \Carbon\Carbon::now()))
                                            입주중
                                        @elseif($reservation->order_status === '11')
                                            중도퇴실
                                        @elseif($reservation->order_status === '0')
                                            입주취소
                                        @elseif(isset($reservation->confirmation))
                                            입주예정
                                        @elseif(!isset($reservation->confirmation))
                                            미확정
                                        @elseif($reservation->order_status === '3')
                                            결제완료
                                        @endif
                                    </div>
                                    @break

                                    @default
                                    <div>정보없음</div>
                                @endswitch
                                @isset($reservation->curator)
                                    <div>
                                        큐레이터:{{$reservation->curator->name}}
                                    </div>
                                @endisset
                            </td>
                            <td class="hotel_data py-2 px-2 text-right" colspan="2">
                                {{ \App\HotelOption::whereHotelId($reservation->hotel['id'] ?? null)->whereDisable('N')->first()->title ?? '호텔옵션없음' }}
                                @isset($reservation->room)
                                    <br>{{$reservation->room->title ?? ''}}
                                @endisset
                            </td>
                            <td class="py-2 w-max-content">
                                <div>
                                    <div>
                                        {{$reservation->order_desired_dt !== null ? $formatter->carbonFormat($reservation->order_desired_dt,'Y년 m월 d일(요일) H시 i분') : ''}}
                                    </div>
                                    @if($reservation->type === 'month')
                                        <div>
                                            {{ \App\Confirmation::whereReservationId($reservation->id)->first() ?
                                                '입주 : '.$formatter->carbonFormat(\App\Confirmation::whereReservationId($reservation->id)->first()['start_dt'],'Y년 m월 d일(요일) H시 i분') : '' }}
                                        </div>
                                        <div>
                                            {{ \App\Confirmation::whereReservationId($reservation->id)->first() ?
                                                '퇴실 : '.$formatter->carbonFormat(\App\Confirmation::whereReservationId($reservation->id)->first()['end_dt'],'Y년 m월 d일(요일) H시 i분') : '' }}
                                        </div>
                                    @elseif($reservation->type==='tour')
                                        @isset($reservation->confirmation->start_dt)
                                            <div>
                                                투어
                                                : {{ $formatter->carbonFormat($reservation->confirmation->start_dt ?? null ,'Y년 m월 d일(요일) H시 i분') ?? '' }}
                                            </div>
                                        @endisset
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="pl-2 text-left space-y-1 w-max-content">
                                    @if($reservation->type === 'month')
                                        <div class="bg-gray-200">
                                            확정룸
                                            : {!! \App\Confirmation::whereReservationId($reservation->id)->first()['room_type'] ?? '<span class="text-gray-400">정보없음</span>' !!}
                                        </div>
                                        @if(isset($reservation->roomTypeUpgrade->name))
                                            <span
                                                class="font-bold text-yellow-500">[업]</span>{{$reservation->roomTypeUpgrade->name}}
                                        @elseif(isset($reservation->roomType->name))
                                            {{$reservation->roomType->name}}
                                        @endif
                                    @else
                                        <div class="text-center">ㆍ</div>
                                    @endif
                                </div>
                            </td>

                            <td class="py-2">
                                @isset($reservation->confirmation->add_days)
                                    {{ $reservation->confirmation->add_days }}일
                                @endisset
                            </td>
                            <td class="py-2 text-center">
                                @isset($reservation->payment->total_price)
                                    {{ number_format($reservation->payment->total_price) }}원
                                @endisset
                            </td>
                            <td class="py-2 text-center">
                                {{ $reservation->visit_route ?? '' }}
                            </td>
                            <td class="py-2 text-center">
                                {{ $reservation->purpose ?? '' }}
                            </td>
                            {{--                        <td class="py-2 text-center">--}}
                            {{--                            <div class="px-2 w-max-content">--}}
                            {{--                                {{$reservation->created_at !== null ? $formatter->carbonFormat($reservation->created_at, 'Y년 m월 d일(요일) H시 i분') : ''}}--}}
                            {{--                            </div>--}}
                            {{--                        </td>--}}
                            <td class="py-2">
                                <div class="px-2 w-max-content">
                                    {{$reservation->updated_at !== null ? $formatter->carbonFormat($reservation->updated_at, 'Y년 m월 d일(요일) H시 i분') : ''}}
                                </div>
                            </td>
                            <td class="py-2">
                                <div class="px-2 w-max-content">
                                    @isset($reservation->payment->card_type)
                                        @if($reservation->payment->card_type === '01')
                                            간편결제
                                        @elseif($reservation->payment->card_type === '02')
                                            앱카드(사이트결제)
                                        @else
                                            {{ $reservation->payment->card_type ?? '' }}
                                        @endif
                                    @endisset
                                </div>
                            </td>
                            <td class="py-2">
                                <div class="px-2 w-max-content">
                                    @if($reservation->type ==='month')
                                        @if(isset($reservation->payment->order_completed_at) && $reservation->payment->order_completed_at !==null)
                                            {{$reservation->payment->order_completed_at ? $formatter->carbonFormat($reservation->payment->order_completed_at, 'Y년 m월 d일(요일) H시 i분') : ''}}
                                        @else
                                            {{$formatter->carbonFormat($reservation->payment->updated_at ?? '', 'Y년 m월 d일(요일) H시 i분')}}
                                        @endif
                                    @else
                                        ㆍ
                                    @endif
                                </div>
                            </td>
                            <td class="payment_data py-2 text-center">
                                @isset(\App\Payment::whereReservationId($reservation->id)->first()['status'])
                                    @switch(\App\Payment::whereReservationId($reservation->id)->first()['status'])
                                        @case('0')
                                        <span class="text-red-400">취소상태</span>
                                        @break
                                        @case('1')
                                        <span class="text-yellow-500">진행중</span>
                                        @break
                                        @case('2')
                                        <span class="text-green-500">주문완료</span>
                                        @break
                                        @case('3')
                                        <span class="text-blue-500">결제완료</span>
                                        <div
                                            class="w-max-content px-4 mx-auto mt-1 text-white cursor-pointer py-1 bg-red-500 rounded-md hover:text-block hover:bg-red-600"
                                            onclick="event.preventDefault();location.href='{{route('payment.cancel',['reservation'=>$reservation->id])}}'">
                                            취소
                                        </div>
                                        @break
                                        @case('4')
                                        <span class="text-gray-300">사용완료</span>
                                        @break
                                        @case('8')
                                        <span class="text-red-500">결제실패</span>
                                        @break
                                        @case('9')
                                        <span class="text-orange-400">보류</span>
                                        @break
                                        @default
                                        <span class="text-gray-300">정보없음</span>
                                    @endswitch
                                @endisset
                                @if($reservation->order_status === '11')
                                    <div class="mt-1">
                                        <span class="text-red-600">중도퇴실</span>
                                    </div>
                                @endif
                            </td>
                            <td class="confirmations_data">
                                @if(\App\AlertTalkList::whereReservationId($reservation->id ?? null)->wherePaymentId(($reservation->payment->id ?? null))->get()->count()>=1)
                                    <a class="cursor-pointer w-max-content px-4 mx-auto block bg-green-500 text-white px-1 py-2 border rounded-md hover:bg-green-700"
                                       href="{{route('information.alertTalkList',['reservation_id'=>$reservation->id ?? null])}}">
                                        <i class="fad fa-comments"></i> {{ \App\AlertTalkList::whereReservationId($reservation->id ?? null)->wherePaymentId(($reservation->payment->id ?? null))->get()->count() }}
                                        개
                                    </a>
                                @else
                                    ㆍ
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center space-x">
                                    <div class="w-max-content">
                                        <a href="{{route('information.reservation.form',['order_id'=>$reservation->order_id,'reservation_id'=>$reservation->id])}}"
                                           class="w-max-content px-3 mx-auto bg-blue-500 text-white px-1 py-2 border rounded-md hover:bg-blue-700">
                                            <i class="fad fa-pencil"></i>
                                        </a>
                                    </div>
                                    @unless($reservation_id)
                                        <div
                                            class="w-max-content px-3 mx-auto bg-yellow-500 text-white px-1 py-2 border rounded-md hover:bg-yellow-700"
                                            wire:click="$emit('masterTableReservationIdSetEvent', '{{$reservation->id}}');">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        @endisset
    </div>

    <div class="wire_loading" wire:loading>
        <div class="max-w-md bg-white bg-opacity-30 rounded-md">
            <div class="flex justify-center items-center">
                <div class="NaNumSquare font-bold text-2xl text-tm-c-30373F pr-2">
                    잠시만 기달려주세요!
                </div>
                <div class="pt-1">
                    <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" width="40px" height="40px" viewBox="0 0 40 40"
                         enable-background="new 0 0 40 40" xml:space="preserve">
                                <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                                    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                                    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                        <path fill="#000"
                              d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0C22.32,8.481,24.301,9.057,26.013,10.047z">
                            <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20"
                                              to="360 20 20" dur="0.5s" repeatCount="indefinite"/>
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="px-2">
        @isset($reservation_id)
            <div x-data="{ open : '{{$reservation_id}}' }" x-show="open">
                @livewire('admin.customer-experiences')
            </div>
        @else
            @if(count($users)<1)
                <div class="w-full text-xl text-center">
                    <div class="py-2">
                        데이터 없음
                    </div>
                </div>
            @endif
            @if(count($users)>1)
                <div class="w-full">
                    <div class="py-2">
                        {{$users->links('vendor.livewire.tailwind')}}
                    </div>
                </div>
            @endif
        @endisset
    </div>
</div>
<style>
    /* 스크롤 디자인 */
    ::-webkit-scrollbar {
        width: 9px;
        height: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background-color: rgba(195, 192, 189, 0.7)
    }

    /* 스크롤 디자인 */
</style>
<script>
    /*document.addEventListener ('livewire:load', () => {
        window.livewire.on('alert_hide', () => {

        });
    });*/
    function datatables() {
        return {
            headings: [
                {
                    'key': 'reservation_type',
                    'value': '주문 타입',
                    'visible': true
                },
                {
                    'key': 'order_name',
                    'value': '주문자 성명',
                    'visible': true
                },
                {
                    'key': 'order_email',
                    'value': '주문자 이메일',
                    'visible': true
                },
                {
                    'key': 'hotel_data',
                    'value': '호텔정보',
                    'visible': true
                },
                {
                    'key': 'payment_data',
                    'value': '결제상태',
                    'visible': true
                },
                {
                    'key': 'confirmations_data',
                    'value': '확정상태',
                    'visible': true
                },
            ],

            open: false,

            toggleColumn(key) {
                $.each(this.headings, function (index, item) {
                    if (item.key === key) {
                        item.visible = false;
                    }
                });

                //global_headings=this.headings;
                $('.' + key).toggleClass('hidden');
            }

        };
    }
</script>
