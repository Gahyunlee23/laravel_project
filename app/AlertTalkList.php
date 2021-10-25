<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AlertTalkList
 *
 * @property int $id
 * @property int|null $template_id 템플릿 id
 * @property int|null $reservation_id 주문 id
 * @property int|null $payment_id 결제 id
 * @property int|null $confirmation_id 확정 id
 * @property int|null $hotel_id 호텔 id
 * @property int|null $room_id 호텔 룸 id
 * @property string|null $situation 전송 상황
 * @property string|null $result 전송 처리
 * @property \Illuminate\Support\Carbon|null $send_at 전송 시간
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereConfirmationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereSituation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $template 템플릿 전송 내용
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereTemplate($value)
 * @property string|null $catalog 템플릿 카탈로그
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereCatalog($value)
 * @property string|null $hp 연락처
 * @property string|null $button_type 타입 WL
 * @property string|null $button_name 버튼 명들
 * @property string|null $button_url 버튼 모바일 URL
 * @property string|null $button_url2 버튼 웹 URL
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonUrl2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereHp($value)
 * @property string|null $read_at
 * @property-read \App\HotelReservation|null $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereReadAt($value)
 */
class AlertTalkList extends Model
{
    protected $table = 'alert_talk_lists';

    public $fillable = [
        'id',
        'template_id', 'reservation_id', 'payment_id', 'confirmation_id',
        'hotel_id', 'room_id',
        'situation','catalog','result','hp',
        'template',
        'send_at', 'read_at',
        'button_type','button_name','button_url','button_url2'
    ];
    /* @array $dates timestamp appends */
    protected $dates = ['send_at'];


    public function reservation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HotelReservation::class, 'reservation_id','id');
    }
}
