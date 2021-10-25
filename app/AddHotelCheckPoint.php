<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelCheckPoint
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $title 타이틀 20자 이하
 * @property string|null $explanation 설명 180자 이하
 * @property string|null $image 이미지
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckPoint onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckPoint withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckPoint withoutTrashed()
 */
class AddHotelCheckPoint extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_check_points';

    protected $guarded = [];
}
