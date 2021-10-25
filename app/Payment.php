<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Payment
 *
 * @property int $id
 * @property int $reservation_id 주문 ID
 * @property string $order_id 결제 주문 리턴: OID [년월일시분초-랜덤숫자1000~9999]
 * @property string|null $card_type 카드 결제 방식 02=앱카드, 01=간편결제
 * @property string|null $pay_type 결제 방식
 * @property string|null $pay_url 결제 처리 url
 * @property string|null $name 구매자 명
 * @property string|null $email 구매자 이메일
 * @property string|null $hp 구매자 연락처
 * @property string|null $goods_tax 택스 방식
 * @property string|null $goods_name 상품명
 * @property string|null $goods_option 상품 옵션
 * @property string|null $total_price 총 결제 가격
 * @property string|null $status 결제 상태 1=진행중, 2=주문완료, 3=결제완료, 4=사용완료, 9=보류, 0=취소상태
 * @property string|null $message 상태 메세지
 * @property string|null $result_message 결과 메세지
 * @property string|null $referer_url 결제 접근 URL
 * @property \Illuminate\Support\Carbon|null $order_completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $order_completed_time
 * @property-read string $uploaded_time
 * @property-read \App\HotelReservation $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGoodsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGoodsOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGoodsTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereOrderCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereRefererUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $memo 메모용
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMemo($value)
 * @property string|null $cancel_price 취소금액=고객 전달 환불금
 * @property string|null $hotel_refund 호텔 전달 환불금
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCancelPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereHotelRefund($value)
 * @property-read \App\Hotel|null $hotel
 * @property string|null $ga_check 구글 GA 적용체크
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGaCheck($value)
 * @property string|null $add_price 추가(연장) 금액
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAddPrice($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Settlement[] $settlement
 * @property-read int|null $settlement_count
 * @method static \Illuminate\Database\Query\Builder|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Payment withoutTrashed()
 */
class Payment extends Model
{
    use SoftDeletes;
    /* @string @table DB 테이블 명칭 */
    protected $table = 'payments';

    /* @array $fillable 허용 리스트 */
    public $fillable = [
        'id','reservation_id','order_id',
        'card_type', 'pay_type', 'pay_url',
        'name', 'email', 'hp',
        'goods_tax', 'goods_name', 'goods_option',
        'total_price', 'add_price', 'cancel_price', 'hotel_refund',
        'status', 'message', 'result_message','memo',
        'created_at', 'updated_at', 'order_completed_at','ga_check'
    ];
    /* @array $dates timestamp appends */
    protected $dates = ['order_completed_at'];

    /* @array $appends */
    public $appends = ['uploaded_time', 'order_completed_time'];

    public function getUploadedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        return $this->updated_at->diffForHumans();
    }
    public function getOrderCompletedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        if($this->order_completed_at!==null){
            return $this->order_completed_at->diffForHumans();
        }
        return '';
    }

    public function hotel(): HasOne
    {
        return $this->hasOne(Hotel::class,'hotel_id','id')->whereStatus('2');
    }
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(HotelReservation::class,'reservation_id','id');
    }

    public function settlement(): HasMany
    {
        return $this->hasMany(Settlement::class,'payment_id','id');
    }
}
