<div>
    <div>
        <table style="table-layout:auto;width: 100%;background-color: #ffffff;border:1px solid #7d7d7d;text-align: center;">
            <thead>
            <tr>
                <th colspan="8">
                    결제 시도중 팝업 종료
                </th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th colspan="8">
                    알림톡 전송 처리 여부 -
                    @switch($ATCheck)
                        @case(true)
                            <span style="color: blue;">전송완료</span>
                            @break

                        @case(false)
                            <span style="color: red;">전송실패</span>
                            @break

                        @default
                            오류
                    @endswitch
                </th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th colspan="8">
                @switch($reservation->type)
                    @case('month')
                    호텔 결제자 정보
                    @break
                    @case('tour')
                    투어 신청자 정보
                    @break
                    @default
                    이외 신청 정보
                @endswitch
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">주문자 성명</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">주문자 연락처</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">주문자 이메일</th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">희망일자</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                   {{$reservation->order_name}}님
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->order_hp}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->order_email}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->order_desired_dt}}
                </td>
            </tr>
            </tbody>

            @if($reservation->type==='month')
            <thead>
            <tr>
                <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    결제 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    원가
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    결제예상금액
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    할인률
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    취소환불금액
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                   {{$reservation->order_price}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->order_sale_price}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->order_discount_rate}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->order_refund_amount}}
                </td>
            </tr>
            </tbody>
            @endif

            @isset($hotel)
            <thead>
            <tr>
                <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    호텔 정보
                </th>
            </tr>
            <tr>
                <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    호텔명
                </th>
                <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    지역명
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$hotel->options[0]->title}}
                </td>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$hotel->options[0]->area}}
                </td>
            </tr>
            </tbody>
            @endisset

            @isset($room)
            <thead>
            <tr>
                <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    호텔 룸 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    룸 옵션
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    원가
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    판매가
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    할인률
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    취소환불금액
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$room->title}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$room->price}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$room->sale_price}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$room->discount_rate}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$room->refund_amount}}
                </td>
            </tr>
            </tbody>
            @endisset

            @isset($curator)
            <thead>
            <tr>
                <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    판매 큐레이터 정보
                </th>
            </tr>
            <tr>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    큐레이터 ID
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    큐레이터 Page
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    큐레이터 성명
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    큐레이터 연락처
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    큐레이터 이메일
                </th>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    메모
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                   {{$curator->user_id}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$curator->user_page}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$curator->name}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$curator->tel}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$curator->email}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$curator->explanation}}
                </td>
            </tr>
            </tbody>
            @endisset

            @isset($payment)
            <thead>
            <tr>
                <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    실 결제 정보
                </th>
            </tr>
            <tr>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    결제 ID
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    결제 방식
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    결제 Type
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    Tax
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    상태메세지
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    결과
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    결제결과
                </th>
                <th style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    취소시
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                   {{$payment->order_id}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$payment->card_type}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$payment->pay_type}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$payment->goods_tax}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$payment->message}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$payment->result_message}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$payment->order_completed_at}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @if($payment->status==='0')
                    {{$payment->updated_at}} [{{$payment->uploaded_time}}]
                    @endif
                </td>
            </tr>
            </tbody>
            @endisset

        </table>
    </div>
</div>
