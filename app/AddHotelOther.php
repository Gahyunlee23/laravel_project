<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelOther
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 호텔 매니저 성명
 * @property string|null $phone_number 연락처 hot line
 * @property string|null $department_name 부서명
 * @property string|null $department_position 부서 직급
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOther onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereDepartmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereDepartmentPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelOther withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOther withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelOther extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_others';
    protected $guarded = [];
}
