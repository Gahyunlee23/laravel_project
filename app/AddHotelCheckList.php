<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelCheckList
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property int|null $check_group_id 체크 그룹 ID
 * @property int|null $check_list_id 체크 list ID
 * @property string|null $answer 답변 : Y, N / String / Number / Date 등
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckList onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereCheckGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereCheckListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckList withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckList withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $input
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereInput($value)
 */
class AddHotelCheckList extends Model
{
    use SoftDeletes;
    protected $table='add_hotel_check_lists';
    protected $guarded =[];
}
