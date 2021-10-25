<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelFacility
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 명칭
 * @property string|null $explanation 설명
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelFacility onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelFacility withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelFacility withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelFacility extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_facilities';
    protected $guarded = [];
}
