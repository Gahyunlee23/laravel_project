<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\PeriodPrice
 *
 * @property int $id
 * @property int|null $hotel_id
 * @property int|null $scheduler_id
 * @property int|null $room_type_id 룸 Type ID
 * @property int|null $admin_id 관리자 ID
 * @property int|null $date 일 수 ~
 * @property int|null $price 해당 일수의 가격
 * @property string|null $memo 메모
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|PeriodPrice newModelQuery()
 * @method static Builder|PeriodPrice newQuery()
 * @method static Builder|PeriodPrice query()
 * @method static Builder|PeriodPrice whereAdminId($value)
 * @method static Builder|PeriodPrice whereCreatedAt($value)
 * @method static Builder|PeriodPrice whereDate($value)
 * @method static Builder|PeriodPrice whereDeletedAt($value)
 * @method static Builder|PeriodPrice whereHotelId($value)
 * @method static Builder|PeriodPrice whereId($value)
 * @method static Builder|PeriodPrice whereMemo($value)
 * @method static Builder|PeriodPrice wherePrice($value)
 * @method static Builder|PeriodPrice whereRoomTypeId($value)
 * @method static Builder|PeriodPrice whereSchedulerId($value)
 * @method static Builder|PeriodPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $range_d 기간 범위 일
 * @property-read \App\Scheduler|null $scheduler
 * @method static \Illuminate\Database\Query\Builder|PeriodPrice onlyTrashed()
 * @method static Builder|PeriodPrice whereRangeD($value)
 * @method static \Illuminate\Database\Query\Builder|PeriodPrice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PeriodPrice withoutTrashed()
 * @property string|null $room_type_name 룸 Tyle 없을 경우 대비
 * @property int|null $percent 할인률
 * @property int|null $sale_price 실 판매가
 * @property string|null $start_time 각 날자의 시작 시간
 * @property string|null $end_time 각 날자의 종료 시간
 * @property-read \App\HotelRoomType|null $roomType
 * @method static Builder|PeriodPrice whereEndTime($value)
 * @method static Builder|PeriodPrice wherePercent($value)
 * @method static Builder|PeriodPrice whereRoomTypeName($value)
 * @method static Builder|PeriodPrice whereSalePrice($value)
 * @method static Builder|PeriodPrice whereStartTime($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Option[] $options
 * @property-read int|null $options_count
 * @property int|null $discount 할인
 * @property int|null $return_price 일별 취소 환불 금
 * @method static Builder|PeriodPrice whereDiscount($value)
 * @method static Builder|PeriodPrice whereReturnPrice($value)
 * @property string|null $type 입주, 투어 분류
 * @property int|null $refund 일별 취소 환불 금
 * @property-read \App\Option|null $option
 * @method static Builder|PeriodPrice whereRefund($value)
 * @method static Builder|PeriodPrice whereType($value)
 * @property int|null $deposit 1박 입금가
 * @method static Builder|PeriodPrice whereDeposit($value)
 */
class PeriodPrice extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $table = 'period_prices';

    protected $guarded = [];
    protected $softCascade = ['options'];


    public function scheduler(): BelongsTo
    {
        return $this->belongsTo(Scheduler::class,'scheduler_id','id');
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(HotelRoomType::class,'room_type_id','id');
    }
    public function option() : hasOne
    {
        return $this->hasOne(Option::class,'period_price_id','id');
    }
    public function options(): HasMany
    {
        return $this->hasMany(Option::class,'period_price_id','id');
    }
}
