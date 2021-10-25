<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\RoomTypeImage
 *
 * @property int $id
 * @property int|null $hotel_id 연관 호텔 id
 * @property int|null $room_type_id 연관 룸 타입 id
 * @property int|null $admin_id 입력 관리자 id
 * @property string|null $path 이미지 Path
 * @property string|null $name 이미지 명칭
 * @property string|null $explanation 이미지 설명
 * @property string|null $order 출력 순서
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage newQuery()
 * @method static \Illuminate\Database\Query\Builder|RoomTypeImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTypeImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|RoomTypeImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|RoomTypeImage withoutTrashed()
 * @mixin \Eloquent
 */
class RoomTypeImage extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $table = 'room_type_images';
    protected $guarded = [];
}
