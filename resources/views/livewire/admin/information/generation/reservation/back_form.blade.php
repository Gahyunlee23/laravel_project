<div class="wire_information_creatingBox" data-id="reservation" @if(!$reservation_box) style="display: none;" @endif>
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="z-50 fixed top-0 right-0 mt-6 mr-6 cursor-pointer"
             onclick="wire_reservation_creatingBox_hide()">
            <div class="p-2 bg-white border-1 rounded-full">
                <img src="https://d2pyzcqibfhr70.cloudfront.net/resource/icons/pc-ic-close-black.svg" alt="">
            </div>
        </div>

        <div class="fixed top-0 justify-center items-center w-screen h-full bg-black bg-opacity-30"
             style="z-index:49;">
        </div>

        <div class="w-full flex justify-center items-center h-full">
            <div id="reservation_box" class="fixed pl-3 pr-1 divide-y-2 max-w-lg sm:max-w-xl bg-white border-2 rounded-md bg-opacity-60 z-50 shadow-lg"
                style="max-height: 60vh;overflow-y: scroll;">
                <div class="">
                    <form name="reservation_form" id="reservation_form" wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))">
                        @csrf
                        <div class="input_hidden_box hidden">
                            <input type="hidden" name="order_id" value="{{$order_id}}" wire:model="order_id" wire:change="reservation_true" readonly>
                            <input type="hidden" name="reservation_id" wire:model="reservation_id" readonly>
                        </div>

                        <div class="pt-2">
                            <div class="flex">
                                <div class="flex-1 NaNumSquare font-bold pb-2">
                                    주문 데이터
                                </div>
                            </div>
                            <div class="flex flex-wrap justify-center gap-1">

                                <div class="w-full flex justify-center items-center">
                                    <span class="flex-1 NaNumSquare px-1 font-bold">
                                        호텔정보
                                    </span>
                                    <select name="hotel_id" id="hotel_id" wire:change="hotel_select_change"
                                            wire:model="hotel_id" required
                                            class="w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="" selected>호텔 선택</option>
                                        @foreach(\App\Hotel::all() as $hotel)
                                            <option value="{{$hotel->id}}" >
                                                {{\App\HotelOption::whereHotelId($hotel->id)->whereDisable('N')->first()['title']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex flex-wrap justify-center gap-2">
                                    <div class="py-2 text-center font-bold">
                                        주문자 정보
                                    </div>
                                    <div class="w-full flex justify-center items-center">
                                        <span class="flex-1 NaNumSquare px-1 font-bold">
                                            성명
                                        </span>
                                        <input type="text" name="order_name" wire:model="order_name" autocomplete="off" required
                                               class="w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="w-full flex justify-center items-center">
                                        <span class="flex-1 NaNumSquare px-2 font-bold">
                                            이메일
                                        </span>
                                        <input type="email" name="order_email" wire:model="order_email" autocomplete="off" required
                                               class="w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="w-full flex justify-center items-center">
                                        <span class="flex-1 NaNumSquare px-2 font-bold">
                                            연락처
                                        </span>
                                        <input type="tel" name="order_hp" wire:model="order_hp" autocomplete="off" required
                                               class="order_hp w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>

                                    <div class="w-full flex justify-center items-center py-4">
                                        <label>
                                            <input type="checkbox" name="use_terms" wire:model="use_terms" checked required>
                                            <span class="NaNumSquare px-2 font-bold">
                                        이용약관
                                    </span>
                                        </label>
                                        <label>
                                            <input type="checkbox" name="order_privacy" wire:model="order_privacy" checked required>
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
                                    </div>
                                </div>

                                @isset($hotel_id)
                                <div
                                    class="w-full py-1 flex-auto flex justify-center items-center @if(!$reservation_box) hidden @endif">
                                    <label class="select-none px-1 NaNumSquare font-bold">
                                        <input type="radio" name="type" value="tour" checked wire:model="reservation_type" required>
                                        호텔투어
                                    </label>
                                    <label class="select-none px-1 NaNumSquare font-bold">
                                        <input type="radio" name="type" value="month" wire:model="reservation_type" wire:change="reservation_type_change" required>
                                        호텔입주
                                    </label>
                                </div>
                                @endisset

                                @isset($reservation_type)
                                <div class="py-1">
                                    <div
                                        class="w-full flex flex-wrap justify-center items-center gap-2 @if(!$reservation_box) hidden @endif">
                                        <div class="py-2 text-center font-bold">
                                        @if($reservation_type ==='tour')
                                            투어 정보
                                        @elseif($reservation_type ==='month')
                                            입주 정보
                                        @endif
                                        </div>

                                        @if($reservation_type ==='month')
                                        <div class="w-full flex flex-wrap justify-center items-center gap-1">
                                            <span class="flex-1 NaNumSquare px-2 font-bold">
                                                룸 정보
                                            </span>
                                            <select name="room_id" id="room_id" wire:model="room_id" wire:change="room_select_change"
                                                    class="w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="" selected>룸 선택</option>
                                                @isset($rooms)
                                                    @foreach($rooms as $room)
                                                        @isset($room)
                                                        <option
                                                            value="{{$room->id ?? ''}}">{{$room->name ?? ''}} {{$room->title ?? ''}} {{ number_format($room->sale_price ?? 0) }}
                                                        </option>
                                                        @endisset
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        @endif

                                        @if($reservation_type ==='tour')
                                        <div class="w-full flex flex-wrap justify-center items-center gap-1">
                                            <span class="flex-1 NaNumSquare px-2 font-bold">
                                                @if($order_desired_type==='now')
                                                투어 확정일
                                                @else
                                                투어 희망일
                                                @endif
                                            </span>
                                            <input type="date" name="order_desired_dt" wire:model="order_desired_dt" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}"
                                                   class="w-4/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="time" name="order_desired_time" wire:model="order_desired_time" value="10:00"
                                                   class="w-4/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        </div>
                                        @elseif($reservation_type ==='month')
                                        @isset($select_room)
{{--                                        <div class="w-full flex flex-wrap justify-center items-center gap-1">--}}
{{--                                            <span class="flex-1 NaNumSquare px-2 font-bold">--}}
{{--                                                룸 판매가--}}
{{--                                            </span>--}}
{{--                                            <input type="number" name="order_sale_price" value="{{$select_room->sale_price}}"--}}
{{--                                                   class="w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">--}}
{{--                                        </div>--}}
                                        <div class="w-full flex flex-wrap justify-center items-center gap-1">
                                            <span class="flex-1 NaNumSquare px-2 font-bold">
                                                룸 박수/일수
                                            </span>
                                                <input type="text" readonly disabled value="{{$select_room->nights}}"
                                                       class="w-2/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">박

                                                <input type="text" readonly disabled value="{{$select_room->days}}"
                                                       class="w-2/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">일

                                        </div>
                                        @endisset
                                        <div class="w-full flex flex-wrap justify-center items-center gap-1">
                                            <span class="flex-1 NaNumSquare px-2 font-bold">
                                                @if($order_desired_type==='now')
                                                입주 확정일
                                                @else
                                                입주 희망일
                                                @endif
                                            </span>
                                            <input type="date" name="start_dt1" wire:model="start_dt1" wire:change="start_dt_change"
                                                   class="w-4/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="time" name="start_dt2" wire:model="start_dt2"
                                                   class="w-4/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        </div>
                                        <div class="w-full flex flex-wrap justify-center items-center gap-1">
                                            <span class="flex-1 NaNumSquare px-2 font-bold">
                                                퇴실 예정일
                                            </span>

                                            <input type="date" name="end_dt1" wire:model="end_dt1"
                                                   class="w-4/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                            <input type="time" name="end_dt2" wire:model="end_dt2" value="11:00"
                                                   class="w-4/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endisset

                                <div class="w-full py-px flex justify-center items-center">
                                    <span class="flex-1 NaNumSquare px-1 font-bold">
                                        큐레이터 정보
                                    </span>
                                    <select name="curator_id" id="curator_id" wire:model="curator_id"
                                            class="w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="" selected>큐레이터 존재 시 선택</option>
                                        @foreach(\App\Curator::all() as $curator)
                                            <option value="{{$curator->id}}">
                                                {{ $curator->name }} {{ $curator->user_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full py-px flex flex-wrap justify-center items-center gap-1">
                                    <span class="flex-1 NaNumSquare px-2 font-bold">
                                        주문 상태
                                    </span>
                                    <select name="order_status" id="order_status" wire:model="order_status"
                                            class="w-8/12 shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="" selected>주문 상태 선택</option>
                                        <option value="1">진행중</option>
                                        <option value="2">주문완료 > 호텔 메일 전달가능</option>
                                        <option value="3">결제완료 > 호텔 메일 전달가능</option>
                                        <option value="4">사용완료</option>
                                        <option value="5">입주중 - 확정가능 > 고객 알림톡 전달가능</option>
                                        <option value="8">결제시도</option>
                                        <option value="9">보류</option>
                                        <option value="0">취소상태</option>
                                    </select>
                                </div>
                            </div>

                            @isset($reservation_type)
                            <div class="pt-2 w-full flex flex-wrap justify-center items-center">
                                @if($order_status === '2')
                                <label class="select-none px-1 NaNumSquare font-bold">
                                    <input type="radio" name="order_desired_type" value="hotel_send_tour" wire:model="order_desired_type" required>
                                    호텔 메일 전달(투어확정문의)
                                </label>
                                @endif
                                @if($order_status === '3')
                                <label class="select-none px-1 NaNumSquare font-bold">
                                    <input type="radio" name="order_desired_type" value="hotel_send_live" wire:model="order_desired_type" required>
                                    호텔 메일 전달(입주확정문의)
                                </label>
                                @endif
                                @if($order_status === '5')
                                <label class="select-none px-1 NaNumSquare font-bold">
                                    <input type="radio" name="order_desired_type" value="user_send" wire:model="order_desired_type" required>
                                    고객 알림톡 발송
                                </label>
                                @endif
                                <label class="select-none px-1 NaNumSquare font-bold">
                                    <input type="radio" name="order_desired_type" value="none_send" wire:model="order_desired_type" required checked>
                                    저장만
                                </label>
                            </div>
                            @endisset
                        </div>
                        <div class="py-2 flex">
                            <div class="ml-auto flex-0">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 border rounded-md hover:bg-blue-700 hover:border-blue-500">
                                    주문 정보 저장
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @isset($reservation_id)
                <livewire:admin.information.generation.payment.form></livewire:admin.information.generation.payment.form>
                @endisset


                @isset($reservation_id)
                <div class="py-2 flex payment_creatingBox">
                    <div class="flex-0 ml-auto">
                        <div onclick="wire_payment_creatingBox_show({{$reservation_id}})" class="bg-green-500 text-white px-4 py-2 border rounded-md hover:bg-green-700 hover:border-green-500 cursor-pointer">
                            @if(\App\Payment::whereReservationId($reservation_id)->count() >= 1)
                                결제 정보 확인
                            @else
                                결제 정보 추가
                            @endif
                        </div>
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>

<script>
/*
document.addEventListener ('livewire:load', () => {
    window.livewire.on('renderChange', () => {

    });
});
* */

$(".order_hp").on('keydown', function (e) {
    // 숫자만 입력받기
    var trans_num = $(this).val().replace(/-/gi, '');
    var k = e.keyCode;

    if (trans_num.length >= 11 && ((k >= 48 && k <= 126) || (k >= 12592 && k <= 12687 || k === 32 || k === 229 || (k >= 45032 && k <= 55203)))) {
        e.preventDefault();
    }
}).on('blur', function () { // 포커스를 잃었을때 실행합니다.
    if ($(this).val() === '') return;

    // 기존 번호에서 - 를 삭제합니다.
    var trans_num = $(this).val().replace(/-/gi, '');

    // 입력값이 있을때만 실행합니다.
    if (trans_num != null && trans_num !== '') {
        // 총 핸드폰 자리수는 11글자이거나, 10자여야 합니다.
        if (trans_num.length === 11 || trans_num.length === 10) {
            // 유효성 체크
            var regExp_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
            if (regExp_ctn.test(trans_num)) {
                // 유효성 체크에 성공하면 하이픈을 넣고 값을 바꿔줍니다.
                trans_num = trans_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
                $(this).val(trans_num);
            } else {
                alert("유효하지 않은 전화번호 입니다.");
                $(this).val("");
                $(this).focus();
            }
        } else {
            alert("유효하지 않은 전화번호 입니다.");
            $(this).val("");
            $(this).focus();
        }
    }
});

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
        target.hide();

        Livewire.emit('renderChangeEvent');
        return target;
    }

    function wire_reservation_creatingBox_show() {
        Livewire.emit('reset_form_event',Math.floor(Math.random()*9999)+1000);
        //$('input[name=reservation_id]').remove();

        target.show();
       // dragElement(document.getElementById("reservation_box_move"),document.getElementById("reservation_box"));
        return target;
    }

    function wire_reservation_creatingBox_show_target($order_id,$reservation_id) {
        //$('input[name=order_id]').val($order_id);
        //$('input[name=reservation_id]').val($reservation_id);
        Livewire.emit('reservation_get_event',$order_id,$reservation_id);
        target.show();
       // dragElement(document.getElementById("reservation_box_move"),document.getElementById("reservation_box"));
        return target;
    }

    function dragElement(elmnt,telmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        // 해당 기능 전체에서 사용할 변수를 초기화 합니다.
        elmnt.onmousedown = dragMouseDown;
        // 요소를 마우스로 눌렀을 경우 dragMouseDown()을 실행 시키게 됩니다
        function dragMouseDown(e) {
            e = e || window.event;// e값이 있는 경우 e 값을 그대로 사용하고 없는 경우 window.event값을 e 로 사용하겠다는 선언(Internet Explorer가 e가 없음)
            e.preventDefault(); // 일단 e의 기본 수행을 막습니다.
            pos3 = e.clientX; // 마우스 이벤트가 발생할 떄 마다 당시의 마우스 x좌표를 pos3에 저장합니다.
            pos4 = e.clientY; // 마우스 이벤트가 발생할 떄 마다 당시의 마우스 y좌표를 pos4에 저장합니다.
            document.onmouseup = closeDragElement; // 마우스 클릭을 해제 했을 떄 closeDragElement()을 호출합니다
            document.onmousemove = elementDrag; // 마우스를 움직일때 elementDrag()을 호출합니다.
        }
         function elementDrag(e) {
             e = e || window.event;
             e.preventDefault();
             pos1 = pos3 - e.clientX;
             pos2 = pos4 - e.clientY;
             pos3 = e.clientX;
             pos4 = e.clientY;

             telmnt.style.top = (telmnt.offsetTop - pos2) + "px";
             telmnt.style.left = (telmnt.offsetLeft - pos1) + "px";
         }
         function closeDragElement() {
             document.onmouseup = null; // onmouseup을 초기화 시킴니다
             document.onmousemove = null; // onmousemove을 초기화 시킴니다.
         }
    }


    /* PAYMENT FORM START */
    function wire_payment_creatingBox_show($reservation_id) {
        Livewire.emit('paymentFormShowEvent',$reservation_id);
        $('.payment_creatingBox').hide();
    }
    function paymentBoxHide() {
        Livewire.emit('paymentFormHideEvent');
        setTimeout(function (){
            $('.payment_creatingBox').show();
        },300);
    }
    /* PAYMENT FORM END */
</script>
