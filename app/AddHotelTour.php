<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelTour
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $day 요일
 * @property string|null $start 시작 시간
 * @property string|null $end 끝 시간
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelTour onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelTour withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelTour withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelTour extends Model
{
    use SoftDeletes;
    protected $table = 'add_hotel_tours';
    protected $guarded =[];
}
