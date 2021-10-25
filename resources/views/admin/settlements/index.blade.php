@extends('layouts.app')
@section('content')
<div class="max-w-1200 mx-auto px-2 pb-10">
    <div class="overflow-auto ">
        <table class="min-w-full table-auto bg-gray-100">
            <thead class="justify-between">
                <tr class="border-t border-b border-solid border-gray-300">
                    <td class="px-2 py-2 text-center whitespace-pre">IDX</td>
                    <td class="px-2 py-2 text-center whitespace-pre">작성관리자</td>
                    <td class="px-2 py-2 text-center whitespace-pre">가격</td>
                    <td class="px-2 py-2 text-center whitespace-pre">추가 결재금</td>
                    <td class="px-2 py-2 text-center whitespace-pre">호텔 입금가</td>
                    <td class="px-12 py-2 text-center whitespace-pre">메모</td>
                    <td class="px-2 py-2 text-center whitespace-pre">정산 완료 여부</td>
                    <td class="px-2 py-2 text-center whitespace-pre">메일 전송 시간</td>
                    <td class="px-2 py-2 text-center whitespace-pre">저장일</td>
                    <td class="px-2 py-2 text-center whitespace-pre">수정일</td>
                    <td class="px-5 py-2 text-center whitespace-pre">정산기능</td>
                    <td class="px-6 py-2 text-center whitespace-pre">기능</td>
                </tr>
            </thead>

            <tbody>
            @foreach ($settlements as $settlement)
            <tr class="divide-x divide-y divide-tm-c-ED
                @if($settlement->calculate_yn === 'Y')
                    bg-blue-400 hover:bg-blue-600
                @else
                    bg-red-400 hover:bg-red-600
                @endif">
                <td class="px-2 py-2 text-center">
                    {{ $settlement->id }}
                </td>
                <td class="px-2 py-2 text-center space-y-1">
                    <div>
                        {{$settlement->admin->name ?? '정보없음'}}
                    </div>
                    <div class="bg-gray-300 rounded-md px-1 py-1">
                    @foreach ($settlement->admin->roles as $role)
                        <div>
                            {{$role->name ?? '정보없음'}}
                        </div>
                    @endforeach
                    </div>
                </td>
                <td class="px-2 py-2 text-center">
                    {{number_format($settlement->price ?? 0)}}
                </td>
                <td class="px-2 py-2 text-center">
                    {{number_format($settlement->add_price ?? 0)}}
                </td>
                <td class="px-2 py-2 text-center">
                    {{number_format($settlement->calculate ?? 0)}}
                </td>
                <td class="px-2 py-2 text-center">
                    {{$settlement->memo ?? '정보없음'}}
                </td>
                <td class="px-2 py-2 text-center">
                    <div>
                        <div>
                            @if($settlement->calculate_yn === 'N')
                                <div class="text-red-600 font-bold">
                                    정산 X
                                </div>
                            @elseif($settlement->calculate_yn === 'Y')
                                <div class="text-blue-600 font-bold">
                                    정산 완료
                                </div>
                                <div>
                                    {{$settlement->calculate_dt ?? '정보없음'}}
                                </div>
                                <div>
                                    {{$settlement->calculate_time ?? '정보없음'}}
                                </div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-2 py-2 text-center">
                    <div>
                        {{$settlement->mail_send_dt ?? '정보없음'}}
                    </div>
                    <div>
                        {{$settlement->mail_send_time ?? ''}}
                    </div>
                </td>
                <td class="px-2 py-2 text-center">
                    {{$settlement->created_at ?? '정보없음'}}
                </td>
                <td class="px-2 py-2 text-center">
                    {{$settlement->updated_at ?? '정보없음'}}
                </td>
                <td class="px-2 py-2 text-center">
                    @if($settlement->calculate_yn === 'N')
                            <x-form.buttons.button-01
                                name="정산" width_class="w-full" height_class="h-8" text_color="text-white" bg_class="bg-green-500 hover:bg-green-600 rounded-md"
                                onclick="event.preventDefault();if(confirm('정산 완료 처리 하시겠습니까 ?')){
                                    document.getElementById('settlementOnUpdateBy{{$settlement->id}}').submit();
                                }"
                            ></x-form.buttons.button-01>
                        <form id="settlementOnUpdateBy{{$settlement->id}}" action="{{route('admin.settlements.update', ['settlement'=>$settlement->id])}}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="Y">
                        </form>
                    @else
                        <x-form.buttons.button-01
                                name="정산취소" width_class="w-full" height_class="h-8" text_color="text-white" bg_class="bg-red-500 hover:bg-red-600 rounded-md"
                            onclick="event.preventDefault();if(confirm('정산 취소 처리 하시겠습니까 ?')){
                                document.getElementById('settlementOffUpdateBy{{$settlement->id}}').submit();
                             }"
                        ></x-form.buttons.button-01>

                        <form id="settlementOffUpdateBy{{$settlement->id}}" action="{{route('admin.settlements.update', ['settlement'=>$settlement->id])}}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="N">
                        </form>
                    @endif
                </td>
                <td class="px-2 py-2 text-center">
                    @if($settlement->trashed())
                        <x-form.buttons.button-01
                            name="삭제취소" width_class="w-full" height_class="h-8" text_color="text-black font-bold" bg_class="bg-red-500 hover:bg-red-600 rounded-md"
                            onclick="event.preventDefault();if(confirm('삭제 취소 하시겠습니까 ?')){
                                document.getElementById('settlementRestoreBy{{$settlement->id}}').submit();
                                }"
                        ></x-form.buttons.button-01>
                        <form id="settlementRestoreBy{{$settlement->id}}" action="{{route('admin.settlements.restore', ['settlement'=>$settlement->id])}}" method="post">
                            @csrf
                            @method('post')
                        </form>
                        {{$settlement->deleted_at ?? '정보없음'}}
                    @else
                        <x-form.buttons.button-01
                            name="삭제" width_class="w-full" height_class="h-8" text_color="text-black font-bold" bg_class="bg-red-500 hover:bg-red-600 rounded-md"
                            onclick="event.preventDefault();if(confirm('삭제하시겠습니까 ?')){
                                document.getElementById('settlementDestroyBy{{$settlement->id}}').submit();
                                }"
                        ></x-form.buttons.button-01>
                        <form id="settlementDestroyBy{{$settlement->id}}" action="{{route('admin.settlements.destroy', ['settlement'=>$settlement->id])}}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
