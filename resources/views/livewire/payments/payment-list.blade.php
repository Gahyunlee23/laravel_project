@inject('formatter', 'App\Formatter')
<div>
    <div class="w-full py-2 font-bold text-black text-xl">
        진행 결제 정보
    </div>
    <div class="overflow-x-scroll">
        <table class="table-auto w-full rounded-sm border border-solid border-tm-c-ED rounded-sm">
            <thead class="bg-gray-200">
                <tr class="divide-x divide-white">
                    <td class="text-center px-2 py-2 whitespace-pre">IDX</td>
                    <td class="text-center px-4 py-2 whitespace-pre">ID</td>
                    <td class="text-center px-4 py-2 whitespace-pre">상태</td>
                    <td class="text-center px-4 py-2 whitespace-pre">상품</td>
                    <td class="text-center px-4 py-2 whitespace-pre">옵션</td>
                    <td class="text-center px-4 py-2 whitespace-pre">처리결과</td>
                    <td class="text-center px-4 py-2 whitespace-pre">처리&결제금</td>
                    <td class="text-center px-4 py-2 whitespace-pre">추가결제금</td>
                    <td class="text-center px-4 py-2 whitespace-pre">취소환불</td>
                    <td class="text-center px-4 py-2 whitespace-pre">호텔환불</td>
                    <td class="text-center px-4 py-2 whitespace-pre">결제시간</td>
                    <td class="text-center px-4 py-2 whitespace-pre">메모</td>
                    <td class="text-center px-4 py-2 whitespace-pre">삭제</td>
                </tr>
            </thead>
            @foreach ($payments as $payment)
                @php
                    $check=null;
                    if($loop->index!==0){
                        $check = $payments->skip($loop->index-1)->first();
                    }
                @endphp
                <tbody class="bg-gray-100 hover:bg-gray-300">
                <tr class="divide-x divide-white">
                    <td class="text-center px-2 py-1">
                        {{$loop->index+1}}@if($loop->index+1 === $payments->count())-현재@endif
                    </td>
                    <td class="text-center px-2 py-1">
                        {{$payment->id}}
                    </td>
                    <td class="text-center px-2 py-1">
                        @switch($payment->status)
                            @case('0') 취소 @break
                            @case('2') 주문완료 @break
                            @case('3') 결제완료 @break
                            @case('8') 결제시도 @break
                            @case('9') 보류 @break
                            @case('10') 부분취소 @break
                            @default 오류
                        @endswitch
                    </td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->goods_name !== $payment->goods_name)text-red-500 @endif">{{$payment->goods_name ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->goods_option !== $payment->goods_option)text-red-500 @endif">{{$payment->goods_option ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{$payment->message ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{$payment->result_message ?? '정보없음'}}<div>@if(is_numeric($payment->total_price)){{number_format($payment->total_price ?? 0)}}@endif</div></td>
                    <td class="text-center px-2 py-1 whitespace-pre">@if(is_numeric($payment->add_price)){{number_format($payment->add_price ?? 0)}}@endif</td>
                    <td class="text-center px-2 py-1 whitespace-pre">@if(is_numeric($payment->cancel_price)){{number_format($payment->cancel_price ?? 0)}}@endif</td>
                    <td class="text-center px-2 py-1 whitespace-pre">@if(is_numeric($payment->hotel_refund)){{number_format($payment->hotel_refund ?? 0)}}@endif</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{$formatter->carbonFormat($payment->order_completed_at, 'Y년 m월 d일(요일) H시 i분')}}</td>
                    <td class="text-center px-2 py-1">{{$payment->memo ?? '없음'}}</td>
                    <td class="text-center px-2 py-1">
                        <div class="px-1 py-1 bg-red-500 rounded-md cursor-pointer text-white"
                             onclick="confirm('정말 삭제 하시겠습니까?\n임시 삭제 처리됩니다.') || event.stopImmediatePropagation()"
                             wire:click="paymentDelete({{$payment->id}})">
                            삭제
                        </div>
                    </td>
                </tr>
                </tbody>
            @endforeach

            @if($payments->count()===0)
                <tbody class="bg-gray-100 hover:bg-gray-300 text-center">
                <td colspan="100%">이전 결제 정보 없음</td>
                </tbody>
            @endif
        </table>
    </div>

    <div class="w-full py-2 font-bold text-black text-xl">
        삭제 결제 정보
    </div>
    <div class="overflow-x-scroll">
        <table class="table-auto w-full rounded-sm border border-solid border-tm-c-ED rounded-sm">
            <thead class="bg-gray-200">
            <tr class="divide-x divide-white">
                <td class="text-center px-2 py-2 whitespace-pre">IDX</td>
                <td class="text-center px-4 py-2 whitespace-pre">ID</td>
                <td class="text-center px-4 py-2 whitespace-pre">상태</td>
                <td class="text-center px-4 py-2 whitespace-pre">상품</td>
                <td class="text-center px-4 py-2 whitespace-pre">옵션</td>
                <td class="text-center px-4 py-2 whitespace-pre">처리결과</td>
                <td class="text-center px-4 py-2 whitespace-pre">처리&결제금</td>
                <td class="text-center px-4 py-2 whitespace-pre">추가결제금</td>
                <td class="text-center px-4 py-2 whitespace-pre">취소환불</td>
                <td class="text-center px-4 py-2 whitespace-pre">호텔환불</td>
                <td class="text-center px-4 py-2 whitespace-pre">결제시간</td>
                <td class="text-center px-4 py-2 whitespace-pre">메모</td>
                <td class="text-center px-4 py-2 whitespace-pre">기능</td>
                <td class="text-center px-4 py-2 whitespace-pre">완전</td>
            </tr>
            </thead>
            @foreach ($paymentsOnlyTrashd as $payment)
                @php
                    $check=null;
                    if($loop->index!==0){
                        $check = $paymentsOnlyTrashd->skip($loop->index-1)->first();
                    }
                @endphp
                <tbody class="bg-gray-100 hover:bg-gray-300">
                <tr class="divide-x divide-white">
                    <td class="text-center px-2 py-1">
                        {{$loop->index+1}}
                    </td>
                    <td class="text-center px-2 py-1">
                        {{$payment->id}}
                    </td>
                    <td class="text-center px-2 py-1">
                        @switch($payment->status)
                            @case('0') 취소 @break
                            @case('2') 주문완료 @break
                            @case('3') 결제완료 @break
                            @case('8') 결제시도 @break
                            @case('9') 보류 @break
                            @case('10') 부분취소 @break
                            @default 오류
                        @endswitch
                    </td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->goods_name !== $payment->goods_name)text-red-500 @endif">{{$payment->goods_name ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre @if($check!==null && $check->goods_option !== $payment->goods_option)text-red-500 @endif">{{$payment->goods_option ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{$payment->message ?? '정보없음'}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{$payment->result_message ?? '정보없음'}}<div>{{number_format($payment->total_price ?? 0)}}</div></td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{number_format($payment->add_price ?? 0)}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{number_format($payment->cancel_price ?? 0)}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{number_format($payment->hotel_refund ?? 0)}}</td>
                    <td class="text-center px-2 py-1 whitespace-pre">{{$formatter->carbonFormat($payment->order_completed_at, 'Y년 m월 d일(요일) H시 i분')}}</td>
                    <td class="text-center px-2 py-1">{{$payment->memo ?? '없음'}}</td>
                    <td class="text-center px-2 py-1">
                        <div class="px-1 py-1 bg-blue-500 rounded-md cursor-pointer text-white"
                             onclick="confirm('정말 삭제 취소 하시겠습니까?') || event.stopImmediatePropagation()"
                             wire:click="paymentRestore({{$payment->id}})">
                            삭제취소
                        </div>
                    </td>
                    <td class="text-center px-2 py-1">
                        <div class="px-1 py-1 bg-red-500 rounded-md cursor-pointer text-white"
                             onclick="confirm('정말 삭제 하시겠습니까?\n실제 데이터 완전 삭제 됩니다.') || event.stopImmediatePropagation()"
                             wire:click="paymentForceDelete({{$payment->id}})">
                            삭제
                        </div>
                    </td>
                </tr>
                </tbody>
            @endforeach
            @if($paymentsOnlyTrashd->count()===0)
                <tbody class="bg-gray-100 hover:bg-gray-300 text-center">
                <td colspan="100%">정보 없음</td>
                </tbody>
            @endif
        </table>
    </div>
    @if(session()->has('result'))
        <div class="mt-4 px-2 py-3 bg-green-400 rounded-md">
            <div class="text-white font-bold">
                {{ session()->pull('result') }}
            </div>
        </div>
    @endif
</div>
