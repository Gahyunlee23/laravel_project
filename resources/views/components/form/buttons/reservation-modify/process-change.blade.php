@if($process !== '1')
    <button class="text-white px-2 pt-px rounded-sm bg-green-500 hover:bg-green-600"
            style="outline: none;"
    onclick="event.preventDefault();
    document.getElementById('modify-form-{{$reservationModifyId}}').action='{{route('admin.reservation.modify.process')}}';
    if(confirm('변경 - 신청 처리 하시겠습니까?')){
        document.getElementById('modifyProcess').value=1;
        document.getElementById('modify-form-{{$reservationModifyId}}').submit();
    }">신청</button>
@endif
@if($process !== '2')
    <button class="text-white px-2 pt-px rounded-sm bg-yellow-500 hover:bg-yellow-600"
            style="outline: none;"
    onclick="event.preventDefault();
        document.getElementById('modify-form-{{$reservationModifyId}}').action='{{route('admin.reservation.modify.process')}}';
        if(confirm('변경 - 진행 중 처리 하시겠습니까?')){
        document.getElementById('modifyProcess').value=2;
        document.getElementById('modify-form-{{$reservationModifyId}}').submit();
        }">진행 중</button>
@endif
@if($process !== '3')
    <button class="text-white px-2 pt-px rounded-sm bg-blue-500 hover:bg-blue-600"
            style="outline: none;"
    onclick="event.preventDefault();
        document.getElementById('modify-form-{{$reservationModifyId}}').action='{{route('admin.reservation.modify.process')}}';
        if(confirm('변경 - 승인 처리 하시겠습니까?')){
        document.getElementById('modifyProcess').value=3;
        document.getElementById('modify-form-{{$reservationModifyId}}').submit();
        }">승인</button>
@endif
@if($process !== '4')
    <button class="text-white px-2 pt-px rounded-sm bg-red-500 hover:bg-red-600"
            style="outline: none;"
    onclick="event.preventDefault();
        document.getElementById('modify-form-{{$reservationModifyId}}').action='{{route('admin.reservation.modify.process')}}';
        if(confirm('변경 - 미승인 처리 하시겠습니까?')){
        document.getElementById('modifyProcess').value=4;
        document.getElementById('modify-form-{{$reservationModifyId}}').submit();
        }">미승인</button>
@endif
@if($process !== '0')
    <button class="text-white px-2 pt-px rounded-sm bg-gray-500 hover:bg-gray-600"
            style="outline: none;"
    onclick="event.preventDefault();
        document.getElementById('modify-form-{{$reservationModifyId}}').action='{{route('admin.reservation.modify.process')}}';
        if(confirm('변경 - Cancel 처리 하시겠습니까?')){
        document.getElementById('modifyProcess').value=0;
        document.getElementById('modify-form-{{$reservationModifyId}}').submit();
        }">Cancel</button>
@endif


<form method="POST" name="modify-form-{{$reservationModifyId}}" id="modify-form-{{$reservationModifyId}}"
      action="">
    @csrf
    @method('POST')
    <input type="hidden" name="reservationModifyId" id="reservationModifyId" value="{{$reservationModifyId}}">
    <input type="hidden" name="modifyProcess" id="modifyProcess">
</form>
