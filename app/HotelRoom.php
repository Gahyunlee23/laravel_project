<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\HotelRoom
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string|null $title 룸 명칭
 * @property string|null $name 룸 타입명
 * @property string|null $sale_url 판매링크
 * @property string|null $price 원가격
 * @property string|null $sale_price 판매가
 * @property string|null $discount_rate 할인률
 * @property string|null $refund_amount 취소환불금액
 * @property string|null $main_explanation 룸 하단 설명 ex] 0박 0일 / 룸 택 1
 * @property string|null $explanation 설명
 * @property string|null $sub_explanation 서브 설명
 * @property string|null $disable 비활성화
 * @property string|null $visible 상품 리스트 내 출력
 * @property string|null $order 룸 순서
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereSaleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereVisible($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelReservation[] $reservations
 * @property-read int|null $reservations_count
 * @property string|null $upgrade 룸 업그레이드 여부
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereUpgrade($value)
 * @property string|null $nights 몇박
 * @property string|null $days 몇일
 * @property string|null $coupon 쿠폰명
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereNights($value)
 * @property string|null $room_option 룸 옵션
 * @property string|null $room_sold_out 룸 옵션 판매처리
 * @property string|null $room_upgrade 룸 옵션 업그레이드
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRoomOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRoomSoldOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRoomUpgrade($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|HotelRoom onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|HotelRoom withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelRoom withoutTrashed()
 * @property string|null $memo
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereMemo($value)
 */
class HotelRoom extends Model
{
    use SoftDeletes;
    protected $table = 'rooms';

    public $fillable = [
        'hotel_id','user_id',
        'title','nights', 'days', 'name', 'sale_url','coupon',
        'price', 'sale_price', 'discount_rate', 'refund_amount', 'main_explanation','explanation', 'sub_explanation',
        'created_at', 'updated_at','visible','order','upgrade',
        'room_option','room_sold_out','room_upgrade','memo'
    ];

    /* @array $appends */
    public $appends = ['uploaded_time'];

    public function getUploadedTimeAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }

    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
    public function reservations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HotelReservation::class);
    }
}
