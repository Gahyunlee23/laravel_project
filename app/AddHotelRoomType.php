<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelRoomType
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 룸 배드 명칭
 * @property string|null $main_explanation 룸 배드 개수
 * @property string|null $sub_explanation 룸 타입 하단 추가 설명
 * @property string|null $upgrade 업그레이드 용 0 1
 * @property string|null $sold_out 판매 완료=1, 판매중=0
 * @property int|null $sale_possibility_count 판매 가능 총 개수
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereSalePossibilityCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereSoldOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereUpgrade($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomType onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomType withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelRoomTypeImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelItem[] $items
 * @property-read int|null $items_count
 */
class AddHotelRoomType extends Model
{
    use SoftDeletes;
    
    protected $table = 'add_hotel_room_types';
    protected $guarded = [];

    public function images(): HasMany
    {
        return $this->hasMany(AddHotelRoomTypeImage::class,'add_hotel_room_type_id','id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(AddHotelItem::class,'room_type_id','id');
    }
}
