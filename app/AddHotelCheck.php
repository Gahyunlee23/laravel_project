<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelCheck
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $date 입력시 해당 일 제한
 * @property string|null $start 시작 시간
 * @property string|null $end 끝 시간
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheck onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheck withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheck withoutTrashed()
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereDeletedAt($value)
 */
class AddHotelCheck extends Model
{
    use SoftDeletes;
    protected $table ='add_hotel_checks';
    protected $guarded =[];
}
