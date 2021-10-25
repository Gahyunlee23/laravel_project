<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelItem
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property int|null $room_type_id 룸 타입 id
 * @property string|null $period 기간
 * @property int|null $sale_price 호텔 판매 가격
 * @property int|null $fee 수수료
 * @property int|null $price 최종 가격?
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelItem withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $order 순서
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereOrder($value)
 * @property int|null $period_id
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem wherePeriodId($value)
 * @property-read \App\AddHotelRoomType|null $roomType
 */
class AddHotelItem extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_items';
    protected $guarded = [];


    public function roomType(): HasOne
    {
        return $this->hasOne(AddHotelRoomType::class,'room_type_id','id');
    }
}
