<div>
    <div>
        <table style="table-layout:auto;width: 100%;background-color: #ffffff;border:1px solid #7d7d7d;text-align: center;">
            <thead>
            <tr>
                <th colspan="8" style="font-size: 24px;">
                    주문 취소 신청
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
            @isset($reservation->reservationCancel)
                <thead>
                <tr>
                    <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        취소 신청 정보
                    </th>
                </tr>
                <tr>
                    <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        취소 신청일
                    </th>
                    <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        바로가기
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        <div>
                            {{$reservation->reservationCancel->send_dt ?? '정보없음' }}
                        </div>
                    </td>
                    <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                        <div>
                            <a href="{{route('admin.reservation.application.show',['reservation'=>$reservation->id])}}">
                                {{$reservation->id}} 주문 확인
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            @endisset

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

            @isset($reservation->hotel)
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
                    {{$reservation->hotel->options[0]->title}}
                </td>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->hotel->options[0]->area}}
                </td>
            </tr>
            </tbody>
            @endisset

            @isset($reservation->room)
            <thead>
            <tr>
                <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    호텔 상품 정보
                </th>
            </tr>
            <tr>
                <th colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    상품옵션명
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
                    {{$reservation->room->title}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->room->price}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->room->sale_price}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->room->discount_rate}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->room->refund_amount}}
                </td>
            </tr>
            </tbody>
            @endisset
            @isset($reservation->roomType)
            <thead>
            <tr>
                <th colspan="8" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    룸 옵션 선택 정보
                </th>
            </tr>
            <tr>
                <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    기본 룸 옵션
                </th>
                <th colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    업그레이드 룸 옵션
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->roomType->name}}
                </td>
                <td colspan="4" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @isset($reservation->roomTypeUpgrade)
                        {{ $reservation->roomTypeUpgrade->name }}
                    @endisset
                </td>
            </tr>
            </tbody>
            @endisset

            @isset($reservation->curator)
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
                   {{$reservation->curator->user_id}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->curator->user_page}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->curator->name}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->curator->tel}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->curator->email}}
                </td>
                <td colspan="2" style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->curator->explanation}}
                </td>
            </tr>
            </tbody>
            @endisset

            @isset($reservation->payment)
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
                   {{$reservation->payment->order_id}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->payment->card_type}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->payment->pay_type}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->payment->goods_tax}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->payment->message}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->payment->result_message}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    {{$reservation->payment->order_completed_at}}
                </td>
                <td style="border:1px solid #ededed;padding: 1rem 0.5rem;">
                    @if($reservation->payment->status==='0')
                    {{$reservation->payment->updated_at}} [{{$reservation->payment->uploaded_time}}]
                    @endif
                </td>
            </tr>
            </tbody>
            @endisset

        </table>
    </div>
</div>
