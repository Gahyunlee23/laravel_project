<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelAmenity
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 어메니티 명칭
 * @property string|null $without 1=불포함
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelAmenity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereWithout($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelAmenity withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelAmenity withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelAmenity extends Model
{
    use SoftDeletes;
    protected $table = 'add_hotel_amenities';
    protected $guarded = [];
}
