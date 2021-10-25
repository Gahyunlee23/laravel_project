<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelRoomTypeImage
 *
 * @property int $id
 * @property int|null $add_hotel_room_type_id Room Type ID
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 명칭
 * @property string|null $main_explanation 이미지 상세 설명
 * @property string|null $sub_explanation 이미지 서브 설명
 * @property string|null $image 이미지 링크
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereAddHotelRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomTypeImage onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomTypeImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomTypeImage withoutTrashed()
 */
class AddHotelRoomTypeImage extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_room_type_images';
    protected $guarded = [];
}
