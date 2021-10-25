@if($process !== '1')
    <button class="text-white px-2 pt-px rounded-sm bg-green-500 hover:bg-green-600"
            style="outline: none;"
            onclick="event.preventDefault();
                document.getElementById('cancel-form-{{$reservationCancelId}}').action='{{route('admin.reservation.cancel.process')}}';
                if(confirm('취소 - 신청 처리 하시겠습니까?')){
                document.getElementById('cancelProcess').value=1;
                document.getElementById('cancel-form-{{$reservationCancelId}}').submit();
                }">신청</button>
@endif
@if($process !== '2')
    <button class="text-white px-2 pt-px rounded-sm bg-yellow-500 hover:bg-yellow-600"
            style="outline: none;"
            onclick="event.preventDefault();
                document.getElementById('cancel-form-{{$reservationCancelId}}').action='{{route('admin.reservation.cancel.process')}}';
                if(confirm('취소 - 진행 중 처리 하시겠습니까?')){
                document.getElementById('cancelProcess').value=2;
                document.getElementById('cancel-form-{{$reservationCancelId}}').submit();
                }">진행 중</button>
@endif
@if($process !== '3')
    <button class="text-white px-2 pt-px rounded-sm bg-blue-500 hover:bg-blue-600"
            style="outline: none;"
            onclick="event.preventDefault();
                document.getElementById('cancel-form-{{$reservationCancelId}}').action='{{route('admin.reservation.cancel.process')}}';
                if(confirm('취소 - 승인 처리 하시겠습니까?')){
                document.getElementById('cancelProcess').value=3;
                document.getElementById('cancel-form-{{$reservationCancelId}}').submit();
                }">승인</button>
@endif
@if($process !== '4')
    <button class="text-white px-2 pt-px rounded-sm bg-red-500 hover:bg-red-600"
            style="outline: none;"
            onclick="event.preventDefault();
                document.getElementById('cancel-form-{{$reservationCancelId}}').action='{{route('admin.reservation.cancel.process')}}';
                if(confirm('취소 - 미승인 처리 하시겠습니까?')){
                document.getElementById('cancelProcess').value=4;
                document.getElementById('cancel-form-{{$reservationCancelId}}').submit();
                }">미승인</button>
@endif
@if($process !== '0')
    <button class="text-white px-2 pt-px rounded-sm bg-gray-500 hover:bg-gray-600"
            style="outline: none;"
            onclick="event.preventDefault();
                document.getElementById('cancel-form-{{$reservationCancelId}}').action='{{route('admin.reservation.cancel.process')}}';
                if(confirm('취소 - Cancel 처리 하시겠습니까?')){
                document.getElementById('cancelProcess').value=0;
                document.getElementById('cancel-form-{{$reservationCancelId}}').submit();
                }">Cancel</button>
@endif


<form method="POST" name="cancel-form-{{$reservationCancelId}}" id="cancel-form-{{$reservationCancelId}}"
      action="">
    @csrf
    @method('POST')
    <input type="hidden" name="reservationCancelId" id="reservationCancelId" value="{{$reservationCancelId}}">
    <input type="hidden" name="cancelProcess" id="cancelProcess">
</form>
