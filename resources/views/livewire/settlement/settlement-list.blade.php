<div class="w-full py-2 px-2 bg-gray-400 rounded-md text-black">
    <div class="py-1 font-bold text-lg">
        호텔 정산
    </div>
    <div class="py-1">
        확정 처리 시 호텔에게 입금할 금액 = [호텔 입금가] 입력
    </div>
    @if(isset($paymentId)&&$paymentId!=='' && $paymentId!==null && \App\Settlement::where('payment_id', '=', $paymentId)->count() >= 1)
        <div class="w-full">
            <table class="w-full table-auto text-center">
                <tr class="py-1 bg-gray-200 bg-opacity-30">
                    <td>순서</td>
                    <td>누적 고객 결제금</td>
                    <td>고객 추가결제금</td>
                    <td>호텔 입금가</td>
                    <td>메모</td>
                    <td>저장시간</td>
                    <td>정산여부</td>
                    <td>메일전송체크</td>
                    <td>기능</td>
                </tr>
                @foreach (\App\Settlement::where('payment_id', '=', $paymentId)->orderBy('id', 'DESC')->get() as $settlement)
                    <tr class="border-b border-solid border-tm-c-ED">
                        <td>
                            @if($loop->index===0)
                                현재
                            @else
                                {{\App\Settlement::where('payment_id', '=', $paymentId)->orderBy('id', 'DESC')->count() - $loop->index}}
                            @endif
                        </td>
                        <td>
                            {{ number_format(($settlement->price+\App\Settlement::where('payment_id', '=', $paymentId)->where('id','<=',$settlement->id)->orderBy('id', 'DESC')->sum('add_price')) ?? 0) }}
                        </td>
                        <td>{{ number_format($settlement->add_price ?? 0) }}</td>
                        <td>{{ number_format($settlement->calculate ?? 0) }}</td>
                        <td>{{$settlement->memo ?? ''}}</td>
                        <td>{{$settlement->created_at ?? ''}}</td>
                        <td>
                            @if($settlement->calculate_yn==='N')
                                <div class="px-2 rounded-md bg-blue-500 hover:bg-blue-600 text-white cursor-pointer"
                                     onclick="confirm('전산 처리 하시겠습니까?') || event.stopImmediatePropagation()"
                                     wire:click="reservationFormSettlementCalculateChangeEvent('Y',{{$settlement->id}})">
                                    {{$settlement->calculate_yn ?? ''}}
                                </div>
                            @else
                                <div class="px-2 rounded-md bg-red-500 hover:bg-red-600 text-white cursor-pointer"
                                     onclick="confirm('정상 취소 하시겠습니까?') || event.stopImmediatePropagation()"
                                     wire:click="reservationFormSettlementCalculateChangeEvent('N',{{$settlement->id}})">
                                    {{$settlement->calculate_yn ?? ''}}
                                </div>
                            @endif
                            {{$settlement->calculate_dt ?? ''}}
                        </td>
                        <td>{{$settlement->mail_send_dt ?? '전송안됨'}}</td>
                        <td>
                            <div class="px-2 rounded-md bg-red-500 hover:bg-red-600 text-white cursor-pointer"
                                 onclick="confirm('삭제 하시겠습니까?\n삭제 시 메일 내용에 포함되지 않습니다.') || event.stopImmediatePropagation()"
                                 wire:click="reservationFormSettlementDeleteEvent({{$settlement->id}})">
                                삭제
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{--                        {{\App\Settlement::where('payment_id', '=', $paymentId)->latest()->first()->calculate}}--}}
    @endif
    <div class="w-full flex-wrap justify-center items-center gap-2">
        <div class="w-full NaNumSquare px-1 py-2 font-bold">
            호텔 입금가
        </div>
        <div class="w-full flex flex-wrap gap-1">
            <input type="number" name="settlement_calculate" wire:model="settlement.calculate"
                   class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
        </div>
    </div>
    <div class="w-full flex-wrap justify-center items-center gap-2">
        <div class="w-full NaNumSquare px-1 py-2 font-bold">
            정산 메모
        </div>
        <div class="w-full flex flex-wrap gap-1">
            <textarea type="text" name="settlement_memo" wire:model="settlement.memo"
                      class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
        </div>
    </div>
    <div class="flex justify-end pt-2">
        <div class="px-6 py-1 bg-blue-500 rounded-md cursor-pointer text-white"
             onclick="confirm('정산 추가 하시겠습니까?') || event.stopImmediatePropagation()"
             wire:click="settlementSubmit({{$payment->id}})">
            정산 추가
        </div>
    </div>
</div>
