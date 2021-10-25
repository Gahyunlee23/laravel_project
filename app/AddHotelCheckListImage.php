<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelCheckListImage
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $image 이미지 path
 * @property string|null $order 출력 순
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckListImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckListImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckListImage withoutTrashed()
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereDeletedAt($value)
 */
class AddHotelCheckListImage extends Model
{
    use SoftDeletes;
    protected $table ='add_hotel_check_list_images';
    protected $guarded = [];
}
