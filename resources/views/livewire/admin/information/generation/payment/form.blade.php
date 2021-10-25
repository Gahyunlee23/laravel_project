<div>

    <div class="py-2">
        <livewire:payments.payment-list :reservation="$reservation"></livewire:payments.payment-list>
    </div>

    @if(isset($payment['id']) && $payment['id'] !=='' && $payment['id'] !== null)
        <div class="py-2">
            <livewire:settlement.settlement-list :paymentId="$payment['id']" :reservation="$reservation"></livewire:settlement.settlement-list>
        </div>
    @endif
    <div id="payment_box">
        <div>
            <div class="flex flex-wrap gap-2 px-2 bg-gray-100 rounded-md">
                <div class="w-full py-2 font-bold text-black text-xl">
                    결제자 정보
                    <input type="hidden" name="order_id" wire:model="payment.order_id" readonly>
                </div>
                <div class="flex flex-wrap gap-2">
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        성명
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <!--카드 결제 방식 02=앱카드, 01=간편결제-->
                        <input type="text" name="name" wire:model="payment.name" @if(isset($reservation) && $payment['name'] === $reservation->order_name) readonly @endif
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('payment.name')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        결제 시 이메일
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <input type="text" name="email" wire:model="payment.email" @if(isset($reservation) && $payment['email'] === $reservation->order_email) readonly @endif
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('payment.email')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        연락처
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <input type="tel" name="hp" wire:model="payment.hp" @if(isset($reservation) && $payment['hp'] === $reservation->order_hp) readonly @endif
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('payment.hp')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        결제 상태
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <select name="status" id="status" wire:model="payment.status"
                                class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>결제 상태 선택</option>
                            <option value="2">결제시도</option>
                            <option value="3">결제완료 + 전송 처리</option>
<!--                            <option value="4">사용완료</option>
                            <option value="5">입주중 (확정가능) > 고객_확정알림톡 전달가능</option>
                            <option value="8">결제 중 이탈</option>-->
                            <option value="9">결제보류</option>
                            <option value="0">결제취소</option>
                        </select>
                    </div>
                    @error('payment.status')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        결제 방식
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <!--카드 결제 방식 02=앱카드, 01=간편결제-->
                        <select name="card_type" id="card_type" wire:model="payment.card_type"
                                class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>결제 방식 선택</option>
                            <option value="01">간편결제</option>
                            <option value="02">앱결제(사이트결제)</option>
                            <option value="계좌이체">계좌이체</option>
                            <option value="무통장입금">무통장입금</option>
                            <option value="링크결제">링크결제</option>
                        </select>
                    </div>
                    @error('payment.card_type')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        고객 결제 금액
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <input type="number" name="total_price" wire:model="payment.total_price"
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('payment.total_price')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        고객 추가(연장) 금액
                   </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <input type="number" name="add_price" wire:model="payment.add_price"
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('payment.add_price')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                @isset($payment['cancel_price'])
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        취소 완료 금액
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        {{$payment['cancel_price']}}
                    </div>
                </div>
                @endisset

                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        결제 상품 명(알림톡호텔명)
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <input type="text" name="goods_name" wire:model="payment.goods_name"
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('payment.goods_name')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        결제 상품 옵션(알림톡호텔옵션)
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <input type="text" name="goods_option" wire:model="payment.goods_option"
                               class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-green-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    @error('payment.goods_option')
                    <div class="w-full text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full flex-wrap justify-center items-center gap-2">
                    <div class="w-full NaNumSquare px-1 py-2 font-bold">
                        메모
                    </div>
                    <div class="w-full flex flex-wrap gap-1">
                        <textarea type="text" name="memo" wire:model="payment.memo"
                                  class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                    </div>
                </div>
                </div>

                <div class="py-2 w-full flex flex-wrap justify-center items-center">
                    <select
                        class="shadow border rounded py-2 px-3 text-gray-700 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @error('process')border border-red-500 @enderror"
                        name="process" wire:model="process" required>
                        <option value="none" selected>저장만</option>
                        @if(isset($reservation) && $reservation->type==='month' && isset($payment['status']) && $payment['status'] === '3'))
                            <option value="호텔_입주확정문의">입주확정문의 > 호텔_입주확정문의</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="py-2 flex items-center">
            <div class="flex-0 ml-auto">
                <button type="submit"
                        onclick="confirm('결제 정보 저장하시겠습니까? :)') || event.stopImmediatePropagation()"
                        wire:click="paymentSubmit"
                        class="inline-flex items-center justify-center py-1 px-2 border border-blue-500 rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-black active:bg-blue-700 transition duration-150 ease-in-out disabled:opacity-50">
                    <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text-base leading-6 font-medium text-white">결제 정보 저장 @if($process === '호텔_입주확정문의' && $payment['status']==='3') + 메일전송@endif</span>
                </button>
            </div>
        </div>

    </div>
</div>
<script>
    //$this->dispatchBrowserEvent('ga-analytics-conversions-ecommerce', [$formData['payment']]);
    /*window.addEventListener('ga-analytics-conversions-ecommerce', event => {
        var order_id = event.detail[0].order_id;
        var total_price = event.detail[0].total_price;
        var goods_name = event.detail[0].goods_name;
        var goods_option = event.detail[0].goods_option;
        var reservation_id = event.detail[0].reservation_id;

        gtag('event', 'purchase', {
            "transaction_id": order_id,
            "value": total_price,
            "currency": "KRW",
            "tax": 0,
            "shipping": 0,
            "items": [
                {
                    "id": reservation_id,
                    "name": goods_name,
                    "list_name": goods_name,
                    "brand": goods_name,
                    "category": goods_option,
                    "price":  total_price,
                }
            ]
        });

        gtag('event', 'conversion', {
            'send_to': 'AW-753064854/gbB0CNXi7OoBEJa3i-cC',
            'value':  total_price,
            'currency': 'KRW',
            'transaction_id': order_id
        });
    });*/
</script>
