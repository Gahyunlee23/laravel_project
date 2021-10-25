<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\HotelCancellation
 *
 * @property int $id
 * @property int $hotel_id
 * @property string $in_use_hotel_fault 호텔 귀책 이용 중 취소
 * @property string $in_use_customer_fault 고객 귀책 이용 중 취소
 * @property string $day 당일 (24시 내) 취소
 * @property string $days_1_6 1~6일 취소 취소
 * @property string $days_7_10 7~10일 취소 취소
 * @property string $days_11_20 11~20일 취소 취소
 * @property string $days_21_30 21~30일 취소 취소
 * @property string $weekday_cost 평일 원가
 * @property string $weekend_cost 주말 원가
 * @property string $visible 1=활성화
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|HotelCancellation newModelQuery()
 * @method static Builder|HotelCancellation newQuery()
 * @method static Builder|HotelCancellation query()
 * @method static Builder|HotelCancellation whereCreatedAt($value)
 * @method static Builder|HotelCancellation whereDay($value)
 * @method static Builder|HotelCancellation whereDays1120($value)
 * @method static Builder|HotelCancellation whereDays16($value)
 * @method static Builder|HotelCancellation whereDays2130($value)
 * @method static Builder|HotelCancellation whereDays710($value)
 * @method static Builder|HotelCancellation whereHotelId($value)
 * @method static Builder|HotelCancellation whereId($value)
 * @method static Builder|HotelCancellation whereInUseCustomerFault($value)
 * @method static Builder|HotelCancellation whereInUseHotelFault($value)
 * @method static Builder|HotelCancellation whereUpdatedAt($value)
 * @method static Builder|HotelCancellation whereVisible($value)
 * @method static Builder|HotelCancellation whereWeekdayCost($value)
 * @method static Builder|HotelCancellation whereWeekendCost($value)
 * @mixin \Eloquent
 * @property-read mixed $reverse_day
 * @property-read mixed $reverse_days1120
 * @property-read mixed $reverse_days16
 * @property-read mixed $reverse_days710
 * @property-read \Illuminate\Support\Collection $weekday_costs
 * @property-read \Illuminate\Support\Collection $weekend_costs
 * @property string $room_type 각 룸 타입
 * @property-read \Illuminate\Support\Collection $room_types
 * @method static Builder|HotelCancellation whereRoomType($value)
 * @property string $special_agreement
 * @method static Builder|HotelCancellation whereSpecialAgreement($value)
 * @property string $free_benefits_cost 무료 혜택 비용
 * @method static Builder|HotelCancellation whereFreeBenefitsCost($value)
 */
class HotelCancellation extends Model
{
    protected $table = 'cancellation_refund_policies';

    protected $fillable = [
        'id', 'hotel_id', 'created_at', 'updated_at', 'visible',
        'in_use_hotel_fault', 'in_use_customer_fault',
        'day', 'days_1_6', 'days_7_10', 'days_11_20', 'days_21_30',
        'room_type', 'weekday_cost', 'weekend_cost'
    ];

    /* @array $appends */
    public $appends = [''];

    public function getReverseDayAttribute()
    {
        return (100 - ($this->day));
    }
    public function getReverseDays16Attribute()
    {
        return (100 - ($this->days_1_6));
    }
    public function getReverseDays710Attribute()
    {
        return (100 - ($this->days_7_10));
    }
    public function getReverseDays1120Attribute()
    {
        return (100 - ($this->days_11_20));
    }
    public function getWeekdayCostsAttribute(): \Illuminate\Support\Collection
    {
        return Str::of($this->weekday_cost)->explode(',');
    }
    public function getWeekendCostsAttribute(): \Illuminate\Support\Collection
    {
        return Str::of($this->weekend_cost)->explode(',');
    }
    public function getRoomTypesAttribute(): \Illuminate\Support\Collection
    {
        return Str::of($this->room_type)->explode(',');
    }


}
