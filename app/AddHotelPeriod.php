<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelPeriod
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 기간 명칭
 * @property string|null $order
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelPeriod onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelPeriod withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelPeriod withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelPeriod extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_periods';
    protected $guarded =[];
}
